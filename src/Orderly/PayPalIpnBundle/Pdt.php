<?php

namespace Orderly\PayPalIpnBundle;

use Symfony\Component\DependencyInjection as DI;

/**
 * PayPal PDT Library
 *
 * A Symfony library to act as a listener for the Payment Data Transfer (PDT) interface.
 * Uses Doctrine 2.0
 */

class Pdt
{
    private $_sc; // Symfony container

    // Configuration constants
    private $isLive; // The flag used to indicate we are operating in the live environment
    private $pdtURL; // The PayPal PDT URL we're using
    private $pdtToken; // The merchant's PDT token connected to PayPal
    private $mockResponse; // Mock the return response from Paypal, if present, we won't hit the server
    private $proxyUrl; // Proxy URL to connect to in order to talk with Paypal

    // Used for logging
    private $logID; // The ID of our IpnLog record
    private $transactionID; // The transaction ID aka txn_id (from PayPal)

    private $objectManager; // Object Manger holding reference to DB-Driver

    /** The constructor. Loads the helpers and configuration files, sets the configuration constants
     *
     * @param DI\ContainerInterface $container 
     */
    function __construct(DI\ContainerInterface $container, $objectManager, $ipnLog)
    {
        $this->_sc =& $container;

        $this->objectManager = $objectManager;

        // Settings  
        $this->pdtURL = $this->_sc->getParameter('orderly.paypalipn.url');
        $this->pdtToken = $this->_sc->getParameter('orderly.paypalipn.pdttoken');
        $this->isLive = $this->_sc->getParameter('orderly.paypalipn.islive');
        $this->mockResponse = $this->_sc->getParameter('orderly.paypalipn.pdtresponse');
        $this->proxyUrl = $this->_sc->getParameter('orderly.paypalipn.proxy');

        // Class instance
        $this->clsIpnLog = $ipnLog;
    }

    /**
     * The key functionality in this library. Gets the data from Paypal with a transaction id obtained from an IPN call.
     * 
     * @param string $transactionID Transaction Id returned from an IPN call.
     * @return array
     */
    public function getPdt($transactionID)
    {
        $this->transactionID = $transactionID;
        
        // Now we need to ask PayPal to tell us if it sent this notification
        $pdtResponse = $this->_postData($this->pdtURL, array('cmd' => '_notify-synch', 'tx' => $transactionID, 'at' => $this->pdtToken));
        if ($pdtResponse === FALSE) { // Bail out if we have an error.
            return FALSE;
        }

        // Phew! We have a valid PDT transaction, log it.
        $this->_logTransaction('PDT', 'SUCCESS', 'Parsing complete', $pdtResponse);
        return $pdtResponse;
    }

    /**
     * Sending data to PayPal PDT service
     * 
     * @param string $url
     * @param array $postData
     * 
     * @return string
     */
    function _postData($url, $postData)
    {
        if ($this->mockResponse !== null) {
            return $this->mockResponse;
        }

        // Put the postData into a string
        $postString = '';
        foreach ($postData as $field => $value) {
            $postString .= $field . '=' . urlencode(stripslashes($value)) . '&'; // Trailing & at end of post string is forgivable
        }

        $curl = \curl_init();
        \curl_setopt($curl, CURLOPT_URL, $url);
        \curl_setopt($curl, CURLOPT_POST, 1);
        \curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        \curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        \curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

        if (!empty($this->proxyUrl)) {
            \curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
            \curl_setopt($curl, CURLOPT_PROXY, $this->proxyUrl);
        }

        \curl_setopt($curl, CURLOPT_POSTFIELDS, $postString);

        $response = \curl_exec($curl);

        // Log and return if we have an error
        if (\curl_error($curl)) {
            $this->_logTransaction("PDT", "ERROR", "curl error number " . \curl_errno($curl) . ": " . \curl_error($curl) . " connecting to " . $url);

            return FALSE;
        }

        \curl_close($curl);

        if (preg_match("/(SUCCESS|FAIL)/", $response, $matches)) {
            $response_array = explode("\n", $response);
            if ($response_array[0] === "SUCCESS") {
                // Get rid of SUCCESS
                array_shift($response_array);

                // Get rid of null line
                array_pop($response_array);

                $final_response = array();
                foreach ($response_array as $value) {
                    $temp = explode("=", $value);
                    $final_response[urldecode($temp[0])] = urldecode($temp[1]);
                }

                return $final_response;
            } else {
                $this->_logTransaction('PDT', 'ERROR', 'PayPal rejected the PDT call as invalid - potentially call was spoofed or was not checked within 30s', $response);
            }
        } else {
            $this->_logTransaction('PDT', 'ERROR', 'PayPal did not respond properly to the PDT call', $response);
        }

        return FALSE;
    }

    /** The transaction logger. Currently tracks:
     *
     * - Successful and failed calls by the PayPal PDT
     *  
     * @param string $listenerName
     * @param string $transactionStatus
     * @param string $transactionMessage
     * @param string $pdtResponse
     */
    function _logTransaction($listenerName, $transactionStatus, $transactionMessage, $pdtResponse = null)
    {
        // Store the standard log information
        $om = $this->objectManager;
        if (!is_null($this->logID)) {
            $ipnLog  = $om->getRepository($this->clsIpnLog)->find($this->logID);
        } else {
            $ipnLog = new $this->clsIpnLog;
        }
        
        $ipnLog->setListenerName($listenerName);
        $ipnLog->setTransactionType(null);
        $ipnLog->setTransactionId($this->transactionID);
        $ipnLog->setStatus($transactionStatus);
        $ipnLog->setMessage($transactionMessage);
        
        if(!$ipnLog->getCreatedAt())
            $ipnLog->setCreatedAt(new \DateTime());
        $ipnLog->setUpdatedAt(new \DateTime());

        if ($transactionStatus == 'FAIL' || !$this->isLive) {
            $detailJSON = array();
            $detailJSON['pdt_response'] = $pdtResponse;
            $ipnLog->setDetail(json_encode($detailJSON));
        } else {
            $ipnLog->setDetail(null); // Turn it back to null (as it might have been set previously)
        }

        // Finally save down the log record.
        $om->persist($ipnLog);
        $om->flush();

        if (is_null($this->logID)) {
            $this->logID = $ipnLog->getId(); // Save the log ID for next time if we need to.
        }
    }
}
