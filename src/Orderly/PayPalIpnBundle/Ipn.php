<?php

namespace Orderly\PayPalIpnBundle;

use Symfony\Component\DependencyInjection as DI;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\BrowserKit\Request;
use Orderly\PayPalIpnBundle\Entity;
use Orderly\PayPalIpnBundle\Entity\IpnLog;
use Orderly\PayPalIpnBundle\Entity\IpnOrders;
use Orderly\PayPalIpnBundle\Entity\IpnOrderItems;

/*
 * Copyright 2012 Orderly Ltd 
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * PayPal IPN Library
 *
 * A Symfony library to act as a listener for the PayPal Instant Payment Notification
 * (IPN) interface. Uses Doctrine 2.0
 *
 * DISCLAIMER: The author Alex Dean does not accept any liability for any processing errors made by
 * this library, or any financial losses incurred through its use. In particular, this library
 * does NOT fulfil the PayPal IPN requirement to "verify that the payment amount actually
 * matches what you intend to charge. Although not technically an IPN issue, if you do
 * not encrypt buttons, it is possible for someone to capture the original transmission
 * and change the price. Without this check, you could accept a lesser payment than what
 * you expected." (This verification step is out of scope for this library because it
 * would require integration with your product catalogue.)
 *
 * This library focuses on the "post-payment" workflow, i.e. the processing required once
 * the payment has been made and PayPal has posted an Instant Payment Notification call to
 * the IPN controller.
 *
 * This library handles:
 *  - Validating the IPN call
 *  - Extracting the order and line item information from the IPN call
 *  - Interpreting PayPal's payment status
 *  - Storing the order and line item in the database
 *
 * All pre-payment functionality (e.g. posting the checkout information to PayPal) and custom
 * post-payment workflow (e.g. sending emails) is left as an exercise to the reader.
 *
 * This library is inspired by:
 *  - Ran Aroussi's PayPal_Lib for CodeIgniter, http://aroussi.com/ci/
 *  - Micah Carrick's Paypal PHP class, http://www.micahcarrick.com
 * 
 * This library is ported from existing Codeigniter PayPal IPN library available at:
 * https://github.com/orderly/codeigniter-paypal-ipn
 *
 */

class Ipn
{
    private $_sc; // Symfony container

    private $ipnData = array(); // Contains the POST values for IPN
    private $order = null; // Contains the fields pertaining to an order
    private $orderItems = array(); // Contains the order items within an order
    private $orderStatus; // All-important variable: whether the order has been paid for yet or not

    // Configuration constants
    private $isLive; // The flag used to indicate we are operating in the live environment
    private $ipnURL; // The PayPal IPN URL we're using
    private $merchantEmail; // The merchant's email address connected to PayPal

    // Used for logging
    private $logID; // The ID of our IpnLog record
    private $transactionID; // The transaction ID aka txn_id (from PayPal)
    private $transactionType; // The type of transaction (from PayPal)

    // Payment status constants we use, more user-friendly than the PayPal ones
    const PAID = 'PAID';
    const WAITING = 'WAITING';
    const REJECTED = 'REJECTED';

    /** The constructor. Loads the helpers and configuration files, sets the configuration constants
     *
     * @param DI\ContainerInterface $container 
     */
    function __construct(DI\ContainerInterface $container)
    {
        $this->_sc =& $container;

        // Settings  
        $this->ipnURL = $this->_sc->getParameter('orderly.paypalipn.url');
        $this->merchantEmail = $this->_sc->getParameter('orderly.paypalipn.email');
        $this->debug = $this->_sc->getParameter('orderly.paypalipn.debug');
        $this->isLive = $this->_sc->getParameter('orderly.paypalipn.islive');
    }

    /**
     * The key functionality in this library. Extracts the fields from the IPN notification and then
     * sends them back to PayPal to make sure that the post is not bogus.
     * We also carry out the following validations as per PayPal's guidelines (https://cms.paypal.com/cgi-bin/marketingweb?cmd=_render-content&content_ID=developer/e_howto_admin_IPNIntro):
     * - "Verify that you are the intended recipient of the IPN message by checking the email address in the message;
     *    this handles a situation where another merchant could accidentally or intentionally attempt to use your listener."
     * - "Avoid duplicate IPN messages. Check that you have not already processed the transaction identified by the transaction
     *    ID returned in the IPN message. You may need to store transaction IDs returned by IPN messages in a file or database so
     *    that you can check for duplicates. If the transaction ID sent by PayPal is a duplicate, you should not process it again."
     *    Actually PayPal is wrong on this last one - duplicate transaction IDs are fine, PayPal can send multiple different
     *    messages with the same transaction ID. That's why we store the md5 instead. 
     * 
     * @return bool
     */
    public function validateIPN()
    {
        // Set these all to null
        $this->logID = null;
        $this->transactionID = null;
        $this->transactionType = null;

        $usingCache = FALSE;
        $request = $this->_sc->get('request');

        //get post parameters
        $parameters = $request->request->all();
        // First check that we have post data.
        if ($request->getMethod() == 'POST' && !empty($parameters)) {
            $ipnDataRaw = $parameters;

            // If we're in debugging mode, then we cache this POST data in the log for potential use later
            if ($this->debug) {
                $this->_cacheIPN($ipnDataRaw);
            }
        } else {
            // If we're in debug mode, let's try to get the last cached IPN data instead
            if ($this->debug) {
                if ($ipnDataRaw = $this->_getCachedIPN()) {
                    $usingCache = TRUE;
                } else {
                    $this->_logTransaction('IPN', 'ERROR', 'No POST data and no cached IPN data');
                    
                    return FALSE;
                }
            } else {// Not in debug mode
                $this->_logTransaction('IPN', 'ERROR', 'No POST data'); // Nulls because we don't have a transaction type or ID yet
                
                return FALSE;
            }
        }

        // First thing we do is to log this transaction. This way if the script silently fails, there is still a record of the IPN call.
        // (If the script succeeds, or another error occurs, then this error message will be overwritten).
        $this->_logTransaction('IPN', 'ERROR', 'Script failed silently, detail field contains the serialized data from PayPal', serialize($ipnDataRaw));

        // Before doing anything else, let's clean up our post data.
        foreach (array_keys($ipnDataRaw) as $field) {
            if (!$usingCache) {
                $value = $request->request->get($field);
                // Put line feeds back to \r\n for PayPal otherwise multi-line data will be rejected as INVALID
                $ipnDataRaw[$field] = str_replace("\n", "\r\n", $value);
            }

            // Let's also store this in this class, turning empty strings back to null to avoid breaking Doctrine later
            $this->ipnData[$field] = ($ipnDataRaw[$field] == '') ? null : $ipnDataRaw[$field];
        }
        
        // Let's now set the transaction type and transaction ID, we'll use these for logging.
        $this->transactionID = (isset($this->ipnData['txn_id']) ? $this->ipnData['txn_id'] : null);
        $this->transactionType = (isset($this->ipnData['txn_type']) ? $this->ipnData['txn_type'] : null);

        // Now we need to check that we haven't received this message from PayPal before.
        // Luckily we store an md5 hash of each IPN dataset so we can cross-check whether this one is new.
        $ipnDataHash = md5(serialize($ipnDataRaw));
        if (!$usingCache && $this->_checkForDuplicates($ipnDataHash)) {
            $this->_logTransaction('IPN', 'ERROR', 'This is a duplicate call: md5 hash ' . $ipnDataHash . ' already logged');
            
            return FALSE;
        }

        // Now we need to ask PayPal to tell us if it sent this notification
        $ipnResponse = $this->_postData($this->ipnURL, array_merge(
                                                                    array('cmd' => '_notify-validate'),
                                                                    $ipnDataRaw
                                                            ));
        if ($ipnResponse === FALSE) { // Bail out if we have an error.
            return FALSE;
        }

        // Check that PayPal says that the IPN call we received is not invalid
        if (stristr("INVALID", $ipnResponse)) {
            // Invalid IPN transaction.  Check the log for details.
            $this->_logTransaction('IPN', 'ERROR', 'PayPal rejected the IPN call as invalid - potentially call was spoofed or was not checked within 30s', $ipnResponse);
            
            return FALSE;
        }

        // The IPN transaction is a genuine one - now we need to validate its contents.
        // First we check that the receiver email matches our email address.
        if ($this->ipnData['receiver_email'] != $this->merchantEmail) {
            $this->_logTransaction('IPN', 'ERROR', 'Receiver email ' . $this->ipnData['receiver_email'] . ' does not match merchant\'s', $ipnResponse);
            
            return FALSE;
        }

        // Now we check that PayPal and this listener agree on whether this is a test or not
        $testIPN = (isset($this->ipnData['test_ipn']) && $this->ipnData['test_ipn'] == 1);
        if ($testIPN == $this->isLive) {
            $this->_logTransaction('IPN', 'ERROR', 'Listener\'s environment does not match test_ipn flag ' . $this->ipnData['test_ipn'], $ipnResponse);
            
            return FALSE;
        }

        // The final check is of the payment status. We need to surface this
        // as a class variable so that the calling code can decide how to respond.
        //
        // PayPal has various different payment statuses' - we list them below,
        // but for simplicity we generalise these into three categories:
        //  - PAID - meaning the merchant can now dispatch the order
        //  - WAITING - wait for another update from PayPal with this transaction_id
        //  - REJECTED - meaning that payment failed and the order should be rejected
        // The following page was invaluable in understanding the different PayPal payment
        // statuses: http://www.coderprofile.com/networks/discussion-forum/1305/paypal-help-ipn-payment_status
        //
        // We throw an error if the payment_status code is unrecognised.
        switch ($this->ipnData['payment_status']) {
            case "Completed": // Order has been paid for
                $this->orderStatus = self::PAID;
                break;
            case "Pending": // Payment is still waiting to go through
            case "Processed": // Mostly used to indicate that a cheque has been received and is currently going through the verification process
                $this->orderStatus = self::WAITING;
                break;
            case "Voided": // Bounced or cancelled check
            case "Expired": // Credit card company didn't recognise card
            case "Reversed": // Credit card holder has got the credit card co to reverse the charge
                $this->orderStatus = self::REJECTED;
                break;
            default:
                $this->_logTransaction('IPN', 'ERROR', 'Payment status of ' . $this->ipnData['payment_status'] . ' is not recognised', $ipnResponse);
                
                return FALSE;
        }

        // Phew! We have a valid IPN transaction, log it.
        $this->_logTransaction('IPN', 'SUCCESS', 'Parsing, authentication and validation complete', $ipnResponse);
        return true;
    }

    /**
     *  Function to extract the order and order items from the $ipnData
     */
    public function extractOrder()
    {
        $this->order = new IpnOrders();
        // First extract the actual order record itself
        foreach ($this->ipnData as $key=>$value) {
            // This is very simple: the order fields are any fields which do not end in a number
            // (because those fields belong to the order items)
            // period, amount, mcAmount ends with number and belongs to order. Think condition line should be commented
            if (preg_match("/.*?(\d+)$/", $key) == 0){
                //this code iterate over ipnData fields, check if order have related field and set it
                $parts = explode('_',$key);
                foreach($parts as $i => $part)
                    $parts[$i] = ucfirst ($part);
                $method = join('',$parts);
                $method = 'set'.$method;
                if(method_exists($this->order, $method))
                    $this->order->$method($value);
            }
        }

        // Let's store the payment status too
        $this->order->setOrderStatus($this->orderStatus);
        
        //Updating dates
        if(!$this->order->getCreatedAt())
            $this->order->setCreatedAt(new \DateTime());
        $this->order->setUpdatedAt(new \DateTime());

    
        // Now retrieve the line items which belong to this order
        $hasCart = ($this->order->getTxnType() == 'cart');
        $numItems = $hasCart ? (int)$this->order->getNumCartItems() : 1;

        $totalBeforeDiscount = 0;
        for ($i = 0; $i < $numItems; $i++) {
            
            // Suffixes are different depending on whether there are multiple items (a cart) or not
            $suffix = $hasCart ? ($i + 1) : '';
            $suffixUnderscore = $hasCart ? '_' . $suffix : $suffix;

            $this->orderItems[$i] = new IpnOrderItems();
            if(isset($this->ipnData['item_name' . $suffix]))
                $this->orderItems[$i]->setItemName($this->ipnData['item_name' . $suffix]);
            if(isset($this->ipnData['item_number' . $suffix]))
                $this->orderItems[$i]->setItemNumber($this->ipnData['item_number' . $suffix]);
            if(isset($this->ipnData['quantity' . $suffix]))
                $this->orderItems[$i]->setQuantity($this->ipnData['quantity' . $suffix]);
            if(isset($this->ipnData['mc_gross' . $suffixUnderscore]))
                $this->orderItems[$i]->setMcGross($this->ipnData['mc_gross' . $suffixUnderscore]);
            if(isset($this->ipnData['mc_gross' . $suffixUnderscore]) && isset($this->ipnData['quantity' . $suffix]))
                $this->orderItems[$i]->setCostPerItem(floatval($this->ipnData['mc_gross' . $suffixUnderscore]) / intval($this->ipnData['quantity' . $suffix])); // Should be fine because quantity can never be 0
            
            // Update the total before the discount was applied
            $totalBeforeDiscount +=  $this->orderItems[$i]->getMcGross();
            
            if(isset($this->ipnData['mc_handling' . $suffix]))
                $this->orderItems[$i]->setMcHandling($this->ipnData['mc_handling' . $suffix]);
            if(isset($this->ipnData['mc_shipping' . $suffix]))
                $this->orderItems[$i]->setMcShipping($this->ipnData['mc_shipping' . $suffix]);
            if(isset($this->ipnData['tax' . $suffix]))
                $this->orderItems[$i]->setTax($this->ipnData['tax' . $suffix]); // Tax is not always set on an item
                        
            
            // Set the order item options if any
            // $count = 7 because PayPal allows you to set a maximum of 7 options per item
            // Reference: https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_html_Appx_websitestandard_htmlvariables
            for ($ii = 1, $count = 7; $ii < $count; $ii++)
            {
                if(isset($this->ipnData['option_name'.$ii.'_'.$suffix])) {
                    $method = 'setOptionName' . $ii;
                    $this->orderItems[$i]->$method($this->ipnData['option_name'.$ii.'_'.$suffix]);
                }
                if(isset($this->ipnData['option_selection'.$ii.'_'.$suffix])) {
                    $method = 'setOptionSelection' . $ii;
                    $this->orderItems[$i]->$method($this->ipnData['option_selection'.$ii.'_'.$suffix]);
                }
            }
            
            //Updating dates
            if(!$this->orderItems[$i]->getCreatedAt())
                $this->orderItems[$i]->setCreatedAt(new \DateTime());
            $this->orderItems[$i]->setUpdatedAt(new \DateTime());
        }

        // And calculate the discount, as it's useful to add this into emails etc
        $this->order->setDiscount($totalBeforeDiscount - $this->order->getMcGross());
    }

    /**
     * sending data to PayPal IPN service
     * 
     * @param string $url
     * @param array $postData
     * 
     * @return string
     */
    function _postData($url, $postData)
    {
        // Put the postData into a string
        $postString = '';
        foreach ($postData as $field=>$value) {
            $postString .= $field . '=' . urlencode(stripslashes($value)) . '&'; // Trailing & at end of post string is forgivable
        }

        $parsedURL = parse_url($url);

        // fsockopen is a bit odd - it just takes the host without the scheme - unless you want to use
        // ssl, in which case you need to use ssl://, not http://
        $ipnURL = ($parsedURL['scheme'] == "https") ? "ssl://" . $parsedURL['host'] : $parsedURL['host'];
        // Likewise, if using ssl, then need to change port from 80 to 443
        $ipnPort = ($parsedURL['scheme'] == "https") ? 443 : 80;
        $fp = @fsockopen($ipnURL, $ipnPort, $errorNumber, $errorString, 30);

        // Log and return if we have an error
        if (!$fp) {
            $this->_logTransaction("IPN", "ERROR", "fsockopen error number $errorNumber: $errorString connecting to " . $parsedURL['host'] . " on port " . $ipnPort);
            
            return FALSE;
        }

        fputs($fp, "POST $parsedURL[path] HTTP/1.1\r\n");
        fputs($fp, "Host: $parsedURL[host]\r\n");
        fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-length: " . strlen($postString) . "\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $postString . "\r\n\r\n");

        $response = '';
        while (!feof($fp)) {
            $response .= fgets($fp, 1024);
        }
        fclose($fp); // Close connection

        if (strlen($response) == 0) {
            $this->_logTransaction("IPN", "ERROR", "Response from PayPal was empty");
            
            return FALSE;
        }

        return $response;
    }

    /** 
     * Code below this point is all ORM-specific. In this version, it is dependent on Doctrine 2 
     * Save an IPN record (insert/update depending on if there is an existing row or not)
     * 
     * @param array $ipnDataRaw
     */
    function _cacheIPN($ipnDataRaw)
    {
        $em = $this->_sc->get('doctrine')->getEntityManager();
        
        // If we don't already have a cache row,
        if (!($cache = $em->getRepository('OrderlyPayPalIpnBundle:IpnLog')
                ->findOneBy(array('listenerName' => 'IPN', 'transactionType' => 'cache')))) {
            $cache = new IpnLog(); // Create a new one
            $cache->setListenerName('IPN');
            $cache->setTransactionType('cache');
        }

        // Let's log the raw IPN data - either update or insert
        $cache->setDetail(serialize($ipnDataRaw));
        if(!$cache->getCreatedAt())
            $cache->setCreatedAt(new \DateTime());
        $cache->setUpdatedAt(new \DateTime());
        $em->persist($cache);
        $em->flush();
    }

    /**
     * Retrieve the cached IPN record if there is one, false if there isn't
     * 
     * @return array
     */
    function _getCachedIPN()
    {   
        $em = $this->_sc->get('doctrine')->getEntityManager();

        if (!($cache = $em->getRepository('OrderlyPayPalIpnBundle:IpnLog')
                ->findOneBy(array('listenerName' => 'IPN', 'transactionType' => 'cache')))) {
            return FALSE;
        } else {
            return unserialize($cache->getDetail());
        }
    }

    /**
     *  Check for a duplicate IPN call using the md5 hash
     * 
     * @param string $hash
     * @return IpnLog
     */
    function _checkForDuplicates($hash)
    {
        return $this->_sc->get('doctrine')->getEntityManager()->getRepository('OrderlyPayPalIpnBundle:IpnLog')
                ->findOneByIpnDataHash($hash);
    }

    /**
     * Function to persist the order and the order items to the database.
     * Note is that an order may already exist in the system, and this IPN
     * call is just to update the record - e.g. changing its payment status.
     */
    public function saveOrder()
    {
        $em = $this->_sc->get('doctrine')->getEntityManager();

        // First check if the order needs an insert or an update
        if (($ipnOrder = $em->getRepository('OrderlyPayPalIpnBundle:ipnOrders')
                ->findOneByTxnId($this->ipnData['txn_id']))) {
            $this->order->setId($ipnOrder->getId());//Update
            $em->merge($this->order);// Let's save/merge the order down
        } else {
            $em->persist($this->order); //If not exist in database, create new
            $em->flush(); //save order to get insert id
        }

        // Now let's save the order's line items
        foreach ($this->orderItems as $i => $item) {
            // We need to check if we have already saved this into the database...
            if (($ipnOrderItem = $em->getRepository('OrderlyPayPalIpnBundle:ipnOrderItems')
                    ->findOneBy(array('itemName' => $item->getItemName(), 'orderId' => $this->order->getId())))) {
                $this->orderItems[$i]->setId($ipnOrderItem->getId()); //Update
                $this->orderItems[$i]->setOrderId($this->order->getId()); // set related order
                $em->merge($this->orderItems[$i]);// Let's save/merge the order down
            } else {
                $em->persist($this->orderItems[$i]); //If not exist in database, create new
            }          
            $this->orderItems[$i]->setOrderId($this->order->getId());
        }
        // Let's store all of the data (order and order items)
        $em->flush();
    }

    /** The transaction logger. Currently tracks:
     *
     * - Successful and failed calls by the PayPal IPN
     * - Successful and failed calls by one or more third-party APIs
     * - (In sandbox mode) Caches the last transaction fields so we can run the IPN script directly
     *  
     * @param string $listenerName
     * @param string $transactionStatus
     * @param string $transactionMessage
     * @param string $ipnResponse
     */
    function _logTransaction($listenerName, $transactionStatus, $transactionMessage, $ipnResponse = null)
    {
        // Store the standard log information
        $em = $this->_sc->get('doctrine')->getEntityManager();
        if (!is_null($this->logID)) {
            $ipnLog  = $em->getRepository('OrderlyPayPalIpnBundle:IpnLog')->find($this->logID);
        } else {
            $ipnLog = new IpnLog();
        }
        
        $ipnLog->setListenerName($listenerName);
        $ipnLog->setTransactionType($this->transactionType);
        $ipnLog->setTransactionId($this->transactionID);
        $ipnLog->setStatus($transactionStatus);
        $ipnLog->setMessage($transactionMessage);
        $ipnLog->setIpnDataHash(md5(serialize($this->ipnData)));
        
        if(!$ipnLog->getCreatedAt())
            $ipnLog->setCreatedAt(new \DateTime());
        $ipnLog->setUpdatedAt(new \DateTime());
        
        // We also log the ipnResponse and the ipnData if we have an error and/or are in the sandbox (test) environment.
        if ($transactionStatus == 'ERROR' || !$this->isLive) {
            $detailJSON = array();
            $detailJSON['ipn_data'] = $this->ipnData;
            $detailJSON['ipn_response'] = $ipnResponse;
            $ipnLog->setDetail(json_encode($detailJSON));
        } else {
            $ipnLog->setDetail(null); // Turn it back to null (as it might have been set previously)
        }

        // Finally save down the log record.
        $em->persist($ipnLog);
        $em->flush();
            

        if (is_null($this->logID)) {
            $this->logID = $ipnLog->getId(); // Save the log ID for next time if we need to.
        }
    }
    
    //getters for Ipn private properties
    
    /**
     * Get orderStatus
     *
     * @return string 
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }
    
    /**
     * Get order
     *
     * @return object 
     */
    public function getOrder()
    {
        return $this->order;
    }
    
    /**
     * Get orderItems
     *
     * @return array 
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }
}