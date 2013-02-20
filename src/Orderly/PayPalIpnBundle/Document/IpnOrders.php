<?php
namespace Orderly\PayPalIpnBundle\Document;

use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert,
    Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

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
 * Orderly\PayPalIpnBundle\Document\IpnOrders
 *
 * @MongoDB\Document(collection="ipn_orders")
 */
class IpnOrders
{
    /**
     * @var string $id
     *
     * @MongoDB\Id(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $notifyVersion
     *
     * @MongoDB\Field(name="notify_version", type="string")
     * @Assert\MaxLength(64)
     */
    private $notifyVersion;

    /**
     * @var string $verifySign
     *
     * @MongoDB\Field(name="verify_sign", type="string")
     * @Assert\MaxLength(127)
     */
    private $verifySign;

    /**
     * @var integer $testIpn
     *
     * @MongoDB\Field(name="test_ipn", type="int")
     */
    private $testIpn;

    /**
     * @var string $protectionEligibility
     *
     * @MongoDB\Field(name="protection_eligibility", type="string")
     * @Assert\MaxLength(24)
     */
    private $protectionEligibility;

    /**
     * @var string $charset
     *
     * @MongoDB\Field(name="charset", type="string")
     * @Assert\MaxLength(127)
     */
    private $charset;

    /**
     * @var string $btnId
     *
     * @MongoDB\Field(name="btn_id", type="string")
     * @Assert\MaxLength(40)
     */
    private $btnId;

    /**
     * @var string $addressCity
     *
     * @MongoDB\Field(name="address_city", type="string")
     * @Assert\MaxLength(40)
     */
    private $addressCity;

    /**
     * @var string $addressCountry
     *
     * @MongoDB\Field(name="address_country", type="string")
     * @Assert\MaxLength(64)
     */
    private $addressCountry;

    /**
     * @var string $addressCountryCode
     *
     * @MongoDB\Field(name="address_country_code", type="string")
     * @Assert\MaxLength(2)
     */
    private $addressCountryCode;

    /**
     * @var string $addressName
     *
     * @MongoDB\Field(name="address_name", type="string")
     * @Assert\MaxLength(128)
     */
    private $addressName;

    /**
     * @var string $addressState
     *
     * @MongoDB\Field(name="address_state", type="string")
     * @Assert\MaxLength(40)
     */
    private $addressState;

    /**
     * @var string $addressStatus
     *
     * @MongoDB\Field(name="address_status", type="string")
     * @Assert\MaxLength(20)
     */
    private $addressStatus;

    /**
     * @var string $addressStreet
     *
     * @MongoDB\Field(name="address_street", type="string")
     * @Assert\MaxLength(200)
     */
    private $addressStreet;

    /**
     * @var string $addressZip
     *
     * @MongoDB\Field(name="address_zip", type="string")
     * @Assert\MaxLength(20)
     */
    private $addressZip;

    /**
     * @var string $firstName
     *
     * @MongoDB\Field(name="first_name", type="string")
     * @Assert\MaxLength(64)
     */
    private $firstName;

    /**
     * @var string $lastName
     *
     * @MongoDB\Field(name="last_name", type="string")
     * @Assert\MaxLength(64)
     */
    private $lastName;

    /**
     * @var string $payerBusinessName
     *
     * @MongoDB\Field(name="payer_business_name", type="string")
     * @Assert\MaxLength(127)
     */
    private $payerBusinessName;

    /**
     * @var string $payerEmail
     *
     * @MongoDB\Field(name="payer_email", type="string")
     * @Assert\MaxLength(127)
     */
    private $payerEmail;

    /**
     * @var string $payerId
     *
     * @MongoDB\Field(name="payer_id", type="string")
     * @Assert\MaxLength(13)
     */
    private $payerId;

    /**
     * @var string $payerStatus
     *
     * @MongoDB\Field(name="payer_status", type="string")
     * @Assert\MaxLength(20)
     */
    private $payerStatus;

    /**
     * @var string $contactPhone
     *
     * @MongoDB\Field(name="contact_phone", type="string")
     * @Assert\MaxLength(20)
     */
    private $contactPhone;

    /**
     * @var string $residenceCountry
     *
     * @MongoDB\Field(name="residence_country", type="string")
     * @Assert\MaxLength(2)
     */
    private $residenceCountry;

    /**
     * @var string $business
     *
     * @MongoDB\Field(name="business", type="string")
     * @Assert\MaxLength(127)
     */
    private $business;

    /**
     * @var string $receiverEmail
     *
     * @MongoDB\Field(name="receiver_email", type="string")
     * @Assert\MaxLength(127)
     */
    private $receiverEmail;

    /**
     * @var string $receiverId
     *
     * @MongoDB\Field(name="receiver_id", type="string")
     * @Assert\MaxLength(13)
     */
    private $receiverId;

    /**
     * @var string $custom
     *
     * @MongoDB\Field(name="custom", type="string")
     * @Assert\MaxLength(255)
     */
    private $custom;

    /**
     * @var string $invoice
     *
     * @MongoDB\Field(name="invoice", type="string")
     * @Assert\MaxLength(127)
     */
    private $invoice;

    /**
     * @var string $memo
     *
     * @MongoDB\Field(name="memo", type="string")
     * @Assert\MaxLength(255)
     */
    private $memo;

    /**
     * @var float $tax
     *
     * @MongoDB\Field(name="tax", type="float")
     */
    private $tax;

    /**
     * @var string $authId
     *
     * @MongoDB\Field(name="auth_id", type="string")
     * @Assert\MaxLength(19)
     */
    private $authId;

    /**
     * @var string $authExp
     *
     * @MongoDB\Field(name="auth_exp", type="string")
     * @Assert\MaxLength(28)
     */
    private $authExp;

    /**
     * @var integer $authAmount
     *
     * @MongoDB\Field(name="auth_amount", type="int")
     */
    private $authAmount;

    /**
     * @var string $authStatus
     *
     * @MongoDB\Field(name="auth_status", type="string")
     * @Assert\MaxLength(20)
     */
    private $authStatus;

    /**
     * @var integer $numCartItems
     *
     * @MongoDB\Field(name="num_cart_items", type="int")
     */
    private $numCartItems;

    /**
     * @var string $parentTxnId
     *
     * @MongoDB\Field(name="parent_txn_id", type="string")
     * @Assert\MaxLength(19)
     */
    private $parentTxnId;

    /**
     * @var string $paymentDate
     *
     * @MongoDB\Field(name="payment_date", type="string")
     * @Assert\MaxLength(28)
     */
    private $paymentDate;

    /**
     * @var string $paymentStatus
     *
     * @MongoDB\Field(name="payment_status", type="string")
     * @Assert\MaxLength(20)
     */
    private $paymentStatus;

    /**
     * @var string $paymentType
     *
     * @MongoDB\Field(name="payment_type", type="string")
     * @Assert\MaxLength(10)
     */
    private $paymentType;

    /**
     * @var string $pendingReason
     *
     * @MongoDB\Field(name="pending_reason", type="string")
     * @Assert\MaxLength(20)
     */
    private $pendingReason;

    /**
     * @var string $reasonCode
     *
     * @MongoDB\Field(name="reason_code", type="string")
     * @Assert\MaxLength(20)
     */
    private $reasonCode;

    /**
     * @var integer $remainingSettle
     *
     * @MongoDB\Field(name="remaining_settle", type="int")
     */
    private $remainingSettle;

    /**
     * @var string $shippingMethod
     *
     * @MongoDB\Field(name="shipping_method", type="string")
     * @Assert\MaxLength(64)
     */
    private $shippingMethod;

    /**
     * @var float $shipping
     *
     * @MongoDB\Field(name="shipping", type="float")
     */
    private $shipping;

    /**
     * @var string $transactionEntity
     *
     * @MongoDB\Field(name="transaction_entity", type="string")
     * @Assert\MaxLength(20)
     */
    private $transactionEntity;

    /**
     * @var string $txnId
     *
     * @MongoDB\Field(name="txn_id", type="string")
     * @Assert\MaxLength(19)
     */
    private $txnId;

    /**
     * @var string $txnType
     *
     * @MongoDB\Field(name="txn_type", type="string")
     * @Assert\MaxLength(20)
     */
    private $txnType;

    /**
     * @var float $exchangeRate
     *
     * @MongoDB\Field(name="exchange_rate", type="float")
     */
    private $exchangeRate;

    /**
     * @var string $mcCurrency
     *
     * @MongoDB\Field(name="mc_currency", type="string")
     * @Assert\MaxLength(3)
     */
    private $mcCurrency;

    /**
     * @var float $mcFee
     *
     * @MongoDB\Field(name="mc_fee", type="float")
     */
    private $mcFee;

    /**
     * @var float $mcGross
     *
     * @MongoDB\Field(name="mc_gross", type="float")
     */
    private $mcGross;

    /**
     * @var float $mcHandling
     *
     * @MongoDB\Field(name="mc_handling", type="decimal")
     */
    private $mcHandling;

    /**
     * @var float $mcShipping
     *
     * @MongoDB\Field(name="mc_shipping", type="float")
     */
    private $mcShipping;

    /**
     * @var float $paymentFee
     *
     * @MongoDB\Field(name="payment_fee", type="float")
     */
    private $paymentFee;

    /**
     * @var float $paymentGross
     *
     * @MongoDB\Field(name="payment_gross", type="float")
     */
    private $paymentGross;

    /**
     * @var float $settleAmount
     *
     * @MongoDB\Field(name="settle_amount", type="float")
     */
    private $settleAmount;

    /**
     * @var string $settleCurrency
     *
     * @MongoDB\Field(name="settle_currency", type="string")
     */
    private $settleCurrency;

    /**
     * @var string $auctionBuyerId
     *
     * @MongoDB\Field(name="auction_buyer_id", type="string")
     * @Assert\MaxLength(64)
     */
    private $auctionBuyerId;

    /**
     * @var string $auctionClosingDate
     *
     * @MongoDB\Field(name="auction_closing_date", type="string")
     * @Assert\MaxLength(28)
     */
    private $auctionClosingDate;

    /**
     * @var integer $auctionMultiItem
     *
     * @MongoDB\Field(name="auction_multi_item", type="int")
     */
    private $auctionMultiItem;

    /**
     * @var string $forAuction
     *
     * @MongoDB\Field(name="for_auction", type="string")
     * @Assert\MaxLength(10)
     */
    private $forAuction;

    /**
     * @var string $subscrDate
     *
     * @MongoDB\Field(name="subscr_date", type="string")
     * @Assert\MaxLength(28)
     */
    private $subscrDate;

    /**
     * @var string $subscrEffective
     *
     * @MongoDB\Field(name="subscr_effective", type="string")
     * @Assert\MaxLength(28)
     */
    private $subscrEffective;

    /**
     * @var string $period1
     *
     * @MongoDB\Field(name="period1", type="string")
     * @Assert\MaxLength(10)
     */
    private $period1;

    /**
     * @var string $period2
     *
     * @MongoDB\Field(name="period2", type="string")
     * @Assert\MaxLength(10)
     */
    private $period2;

    /**
     * @var string $period3
     *
     * @MongoDB\Field(name="period3", type="string")
     * @Assert\MaxLength(10)
     */
    private $period3;

    /**
     * @var float $amount1
     *
     * @MongoDB\Field(name="amount1", type="float")
     */
    private $amount1;

    /**
     * @var float $amount2
     *
     * @MongoDB\Field(name="amount2", type="float")
     */
    private $amount2;

    /**
     * @var float $amount3
     *
     * @MongoDB\Field(name="amount", type="float")
     */
    private $amount3;

    /**
     * @var float $mcAmount1
     *
     * @MongoDB\Field(name="mc_amount1", type="decimal")
     */
    private $mcAmount1;

    /**
     * @var float $mcAmount2
     *
     * @MongoDB\Field(name="mc_amount2", type="float")
     */
    private $mcAmount2;

    /**
     * @var float $mcAmount3
     *
     * @MongoDB\Field(name="mc_amount3", type="float")
     */
    private $mcAmount3;

    /**
     * @var string $recurring
     *
     * @MongoDB\Field(name="recurring", type="string")
     * @Assert\MaxLength(1)
     */
    private $recurring;

    /**
     * @var string $reattempt
     *
     * @MongoDB\Field(name="reattempt", type="string")
     * @Assert\MaxLength(1)
     */
    private $reattempt;

    /**
     * @var string $retryAt
     *
     * @MongoDB\Field(name="retry_at", type="string")
     * @Assert\MaxLength(28)
     */
    private $retryAt;

    /**
     * @var integer $recurTimes
     *
     * @MongoDB\Field(name="recur_times", type="int")
     */
    private $recurTimes;

    /**
     * @var string $username
     *
     * @MongoDB\Field(name="username", type="string")
     * @Assert\MaxLength(64)
     */
    private $username;

    /**
     * @var string $password
     *
     * @MongoDB\Field(name="password", type="string")
     * @Assert\MaxLength(24)
     */
    private $password;

    /**
     * @var string $subscrId
     *
     * @MongoDB\Field(name="subscr_id", type="string")
     * @Assert\MaxLength(19)
     */
    private $subscrId;

    /**
     * @var string $caseId
     *
     * @MongoDB\Field(name="case_id", type="string")
     * @Assert\MaxLength(28)
     */
    private $caseId;

    /**
     * @var string $caseType
     *
     * @MongoDB\Field(name="case_type", type="string")
     * @Assert\MaxLength(28)
     */
    private $caseType;

    /**
     * @var string $caseCreationDate
     *
     * @MongoDB\Field(name="case_creation_date", type="string")
     * @Assert\MaxLength(28)
     */
    private $caseCreationDate;

    /**
     * @var string $orderStatus
     *
     * @MongoDB\Field(name="order_status", type="string")
     */
    private $orderStatus;

    /**
     * @var float $discount
     *
     * @MongoDB\Field(name="discount", type="float")
     */
    private $discount;

    /**
     * @var float $shippingDiscount
     *
     * @MongoDB\Field(name="shipping_discount", type="float")
     */
    private $shippingDiscount;

    /**
     * @var string $ipnTrackId
     *
     * @MongoDB\Field(name="ipn_track_id", type="string")
     * @Assert\MaxLength(127)
     */
    private $ipnTrackId;

    /**
     * @var string $transactionSubject
     *
     * @MongoDB\Field(name="transaction_subject", type="string")
     * @Assert\MaxLength(255)
     */
    private $transactionSubject;

    /**
     * @var datetime $createdAt
     *
     * @MongoDB\Field(name="created_at", type="date")
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @MongoDB\Field(name="updated_at", type="date")
     */
    private $updatedAt;



    /**
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = trim($id);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set notifyVersion
     *
     * @param string $notifyVersion
     */
    public function setNotifyVersion($notifyVersion)
    {
        $this->notifyVersion = $notifyVersion;
    }

    /**
     * Get notifyVersion
     *
     * @return string
     */
    public function getNotifyVersion()
    {
        return $this->notifyVersion;
    }

    /**
     * Set verifySign
     *
     * @param string $verifySign
     */
    public function setVerifySign($verifySign)
    {
        $this->verifySign = $verifySign;
    }

    /**
     * Get verifySign
     *
     * @return string
     */
    public function getVerifySign()
    {
        return $this->verifySign;
    }

    /**
     * Set testIpn
     *
     * @param integer $testIpn
     */
    public function setTestIpn($testIpn)
    {
        $this->testIpn = intval($testIpn);
    }

    /**
     * Get testIpn
     *
     * @return integer
     */
    public function getTestIpn()
    {
        return $this->testIpn;
    }

    /**
     * Set protectionEligibility
     *
     * @param string $protectionEligibility
     */
    public function setProtectionEligibility($protectionEligibility)
    {
        $this->protectionEligibility = $protectionEligibility;
    }

    /**
     * Get protectionEligibility
     *
     * @return string
     */
    public function getProtectionEligibility()
    {
        return $this->protectionEligibility;
    }

    /**
     * Set charset
     *
     * @param string $charset
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
    }

    /**
     * Get charset
     *
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * Set btnId
     *
     * @param string $btnId
     */
    public function setBtnId($btnId)
    {
        $this->btnId = $btnId;
    }

    /**
     * Get btnId
     *
     * @return string
     */
    public function getBtnId()
    {
        return $this->btnId;
    }

    /**
     * Set addressCity
     *
     * @param string $addressCity
     */
    public function setAddressCity($addressCity)
    {
        $this->addressCity = $addressCity;
    }

    /**
     * Get addressCity
     *
     * @return string
     */
    public function getAddressCity()
    {
        return $this->addressCity;
    }

    /**
     * Set addressCountry
     *
     * @param string $addressCountry
     */
    public function setAddressCountry($addressCountry)
    {
        $this->addressCountry = $addressCountry;
    }

    /**
     * Get addressCountry
     *
     * @return string
     */
    public function getAddressCountry()
    {
        return $this->addressCountry;
    }

    /**
     * Set addressCountryCode
     *
     * @param string $addressCountryCode
     */
    public function setAddressCountryCode($addressCountryCode)
    {
        $this->addressCountryCode = $addressCountryCode;
    }

    /**
     * Get addressCountryCode
     *
     * @return string
     */
    public function getAddressCountryCode()
    {
        return $this->addressCountryCode;
    }

    /**
     * Set addressName
     *
     * @param string $addressName
     */
    public function setAddressName($addressName)
    {
        $this->addressName = $addressName;
    }

    /**
     * Get addressName
     *
     * @return string
     */
    public function getAddressName()
    {
        return $this->addressName;
    }

    /**
     * Set addressState
     *
     * @param string $addressState
     */
    public function setAddressState($addressState)
    {
        $this->addressState = $addressState;
    }

    /**
     * Get addressState
     *
     * @return string
     */
    public function getAddressState()
    {
        return $this->addressState;
    }

    /**
     * Set addressStatus
     *
     * @param string $addressStatus
     */
    public function setAddressStatus($addressStatus)
    {
        $this->addressStatus = $addressStatus;
    }

    /**
     * Get addressStatus
     *
     * @return string
     */
    public function getAddressStatus()
    {
        return $this->addressStatus;
    }

    /**
     * Set addressStreet
     *
     * @param string $addressStreet
     */
    public function setAddressStreet($addressStreet)
    {
        $this->addressStreet = $addressStreet;
    }

    /**
     * Get addressStreet
     *
     * @return string
     */
    public function getAddressStreet()
    {
        return $this->addressStreet;
    }

    /**
     * Set addressZip
     *
     * @param string $addressZip
     */
    public function setAddressZip($addressZip)
    {
        $this->addressZip = $addressZip;
    }

    /**
     * Get addressZip
     *
     * @return string
     */
    public function getAddressZip()
    {
        return $this->addressZip;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set payerBusinessName
     *
     * @param string $payerBusinessName
     */
    public function setPayerBusinessName($payerBusinessName)
    {
        $this->payerBusinessName = $payerBusinessName;
    }

    /**
     * Get payerBusinessName
     *
     * @return string
     */
    public function getPayerBusinessName()
    {
        return $this->payerBusinessName;
    }

    /**
     * Set payerEmail
     *
     * @param string $payerEmail
     */
    public function setPayerEmail($payerEmail)
    {
        $this->payerEmail = $payerEmail;
    }

    /**
     * Get payerEmail
     *
     * @return string
     */
    public function getPayerEmail()
    {
        return $this->payerEmail;
    }

    /**
     * Set payerId
     *
     * @param string $payerId
     */
    public function setPayerId($payerId)
    {
        $this->payerId = $payerId;
    }

    /**
     * Get payerId
     *
     * @return string
     */
    public function getPayerId()
    {
        return $this->payerId;
    }

    /**
     * Set payerStatus
     *
     * @param string $payerStatus
     */
    public function setPayerStatus($payerStatus)
    {
        $this->payerStatus = $payerStatus;
    }

    /**
     * Get payerStatus
     *
     * @return string
     */
    public function getPayerStatus()
    {
        return $this->payerStatus;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;
    }

    /**
     * Get contactPhone
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set residenceCountry
     *
     * @param string $residenceCountry
     */
    public function setResidenceCountry($residenceCountry)
    {
        $this->residenceCountry = $residenceCountry;
    }

    /**
     * Get residenceCountry
     *
     * @return string
     */
    public function getResidenceCountry()
    {
        return $this->residenceCountry;
    }

    /**
     * Set business
     *
     * @param string $business
     */
    public function setBusiness($business)
    {
        $this->business = $business;
    }

    /**
     * Get business
     *
     * @return string
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * Set receiverEmail
     *
     * @param string $receiverEmail
     */
    public function setReceiverEmail($receiverEmail)
    {
        $this->receiverEmail = $receiverEmail;
    }

    /**
     * Get receiverEmail
     *
     * @return string
     */
    public function getReceiverEmail()
    {
        return $this->receiverEmail;
    }

    /**
     * Set receiverId
     *
     * @param string $receiverId
     */
    public function setReceiverId($receiverId)
    {
        $this->receiverId = $receiverId;
    }

    /**
     * Get receiverId
     *
     * @return string
     */
    public function getReceiverId()
    {
        return $this->receiverId;
    }

    /**
     * Set custom
     *
     * @param string $custom
     */
    public function setCustom($custom)
    {
        $this->custom = $custom;
    }

    /**
     * Get custom
     *
     * @return string
     */
    public function getCustom()
    {
        return $this->custom;
    }

    /**
     * Set invoice
     *
     * @param string $invoice
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get invoice
     *
     * @return string
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * Set memo
     *
     * @param string $memo
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;
    }

    /**
     * Get memo
     *
     * @return string
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * Set tax
     *
     * @param decimal $tax
     */
    public function setTax($tax)
    {
        $this->tax = floatval($tax);
    }

    /**
     * Get tax
     *
     * @return decimal
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Set authId
     *
     * @param string $authId
     */
    public function setAuthId($authId)
    {
        $this->authId = $authId;
    }

    /**
     * Get authId
     *
     * @return string
     */
    public function getAuthId()
    {
        return $this->authId;
    }

    /**
     * Set authExp
     *
     * @param string $authExp
     */
    public function setAuthExp($authExp)
    {
        $this->authExp = $authExp;
    }

    /**
     * Get authExp
     *
     * @return string
     */
    public function getAuthExp()
    {
        return $this->authExp;
    }

    /**
     * Set authAmount
     *
     * @param integer $authAmount
     */
    public function setAuthAmount($authAmount)
    {
        $this->authAmount = intval($authAmount);
    }

    /**
     * Get authAmount
     *
     * @return integer
     */
    public function getAuthAmount()
    {
        return $this->authAmount;
    }

    /**
     * Set authStatus
     *
     * @param string $authStatus
     */
    public function setAuthStatus($authStatus)
    {
        $this->authStatus = $authStatus;
    }

    /**
     * Get authStatus
     *
     * @return string
     */
    public function getAuthStatus()
    {
        return $this->authStatus;
    }

    /**
     * Set numCartItems
     *
     * @param integer $numCartItems
     */
    public function setNumCartItems($numCartItems)
    {
        $this->numCartItems = intval($numCartItems);
    }

    /**
     * Get numCartItems
     *
     * @return integer
     */
    public function getNumCartItems()
    {
        return $this->numCartItems;
    }

    /**
     * Set parentTxnId
     *
     * @param string $parentTxnId
     */
    public function setParentTxnId($parentTxnId)
    {
        $this->parentTxnId = $parentTxnId;
    }

    /**
     * Get parentTxnId
     *
     * @return string
     */
    public function getParentTxnId()
    {
        return $this->parentTxnId;
    }

    /**
     * Set paymentDate
     *
     * @param string $paymentDate
     */
    public function setPaymentDate($paymentDate)
    {
        $this->paymentDate = $paymentDate;
    }

    /**
     * Get paymentDate
     *
     * @return string
     */
    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    /**
     * Set paymentStatus
     *
     * @param string $paymentStatus
     */
    public function setPaymentStatus($paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;
    }

    /**
     * Get paymentStatus
     *
     * @return string
     */
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    /**
     * Set paymentType
     *
     * @param string $paymentType
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
    }

    /**
     * Get paymentType
     *
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * Set pendingReason
     *
     * @param string $pendingReason
     */
    public function setPendingReason($pendingReason)
    {
        $this->pendingReason = $pendingReason;
    }

    /**
     * Get pendingReason
     *
     * @return string
     */
    public function getPendingReason()
    {
        return $this->pendingReason;
    }

    /**
     * Set reasonCode
     *
     * @param string $reasonCode
     */
    public function setReasonCode($reasonCode)
    {
        $this->reasonCode = $reasonCode;
    }

    /**
     * Get reasonCode
     *
     * @return string
     */
    public function getReasonCode()
    {
        return $this->reasonCode;
    }

    /**
     * Set remainingSettle
     *
     * @param integer $remainingSettle
     */
    public function setRemainingSettle($remainingSettle)
    {
        $this->remainingSettle = intval($remainingSettle);
    }

    /**
     * Get remainingSettle
     *
     * @return integer
     */
    public function getRemainingSettle()
    {
        return $this->remainingSettle;
    }

    /**
     * Set shippingMethod
     *
     * @param string $shippingMethod
     */
    public function setShippingMethod($shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
    }

    /**
     * Get shippingMethod
     *
     * @return string
     */
    public function getShippingMethod()
    {
        return $this->shippingMethod;
    }

    /**
     * Set shipping
     *
     * @param decimal $shipping
     */
    public function setShipping($shipping)
    {
        $this->shipping = floatval($shipping);
    }

    /**
     * Get shipping
     *
     * @return decimal
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * Set transactionEntity
     *
     * @param string $transactionEntity
     */
    public function setTransactionEntity($transactionEntity)
    {
        $this->transactionEntity = $transactionEntity;
    }

    /**
     * Get transactionEntity
     *
     * @return string
     */
    public function getTransactionEntity()
    {
        return $this->transactionEntity;
    }

    /**
     * Set txnId
     *
     * @param string $txnId
     */
    public function setTxnId($txnId)
    {
        $this->txnId = $txnId;
    }

    /**
     * Get txnId
     *
     * @return string
     */
    public function getTxnId()
    {
        return $this->txnId;
    }

    /**
     * Set txnType
     *
     * @param string $txnType
     */
    public function setTxnType($txnType)
    {
        $this->txnType = $txnType;
    }

    /**
     * Get txnType
     *
     * @return string
     */
    public function getTxnType()
    {
        return $this->txnType;
    }

    /**
     * Set exchangeRate
     *
     * @param decimal $exchangeRate
     */
    public function setExchangeRate($exchangeRate)
    {
        $this->exchangeRate = floatval($exchangeRate);
    }

    /**
     * Get exchangeRate
     *
     * @return decimal
     */
    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }

    /**
     * Set mcCurrency
     *
     * @param string $mcCurrency
     */
    public function setMcCurrency($mcCurrency)
    {
        $this->mcCurrency = $mcCurrency;
    }

    /**
     * Get mcCurrency
     *
     * @return string
     */
    public function getMcCurrency()
    {
        return $this->mcCurrency;
    }

    /**
     * Set mcFee
     *
     * @param decimal $mcFee
     */
    public function setMcFee($mcFee)
    {
        $this->mcFee = floatval($mcFee);
    }

    /**
     * Get mcFee
     *
     * @return decimal
     */
    public function getMcFee()
    {
        return $this->mcFee;
    }

    /**
     * Set mcGross
     *
     * @param decimal $mcGross
     */
    public function setMcGross($mcGross)
    {
        $this->mcGross = floatval($mcGross);
    }

    /**
     * Get mcGross
     *
     * @return decimal
     */
    public function getMcGross()
    {
        return $this->mcGross;
    }

    /**
     * Set mcHandling
     *
     * @param decimal $mcHandling
     */
    public function setMcHandling($mcHandling)
    {
        $this->mcHandling = floatval($mcHandling);
    }

    /**
     * Get mcHandling
     *
     * @return decimal
     */
    public function getMcHandling()
    {
        return $this->mcHandling;
    }

    /**
     * Set mcShipping
     *
     * @param decimal $mcShipping
     */
    public function setMcShipping($mcShipping)
    {
        $this->mcShipping = floatval($mcShipping);
    }

    /**
     * Get mcShipping
     *
     * @return decimal
     */
    public function getMcShipping()
    {
        return $this->mcShipping;
    }

    /**
     * Set paymentFee
     *
     * @param decimal $paymentFee
     */
    public function setPaymentFee($paymentFee)
    {
        $this->paymentFee = floatval($paymentFee);
    }

    /**
     * Get paymentFee
     *
     * @return decimal
     */
    public function getPaymentFee()
    {
        return $this->paymentFee;
    }

    /**
     * Set paymentGross
     *
     * @param decimal $paymentGross
     */
    public function setPaymentGross($paymentGross)
    {
        $this->paymentGross = floatval($paymentGross);
    }

    /**
     * Get paymentGross
     *
     * @return decimal
     */
    public function getPaymentGross()
    {
        return $this->paymentGross;
    }

    /**
     * Set settleAmount
     *
     * @param decimal $settleAmount
     */
    public function setSettleAmount($settleAmount)
    {
        $this->settleAmount = floatval($settleAmount);
    }

    /**
     * Get settleAmount
     *
     * @return decimal
     */
    public function getSettleAmount()
    {
        return $this->settleAmount;
    }

    /**
     * Set settleCurrency
     *
     * @param string $settleCurrency
     */
    public function setSettleCurrency($settleCurrency)
    {
        $this->settleCurrency = $settleCurrency;
    }

    /**
     * Get settleCurrency
     *
     * @return string
     */
    public function getSettleCurrency()
    {
        return $this->settleCurrency;
    }

    /**
     * Set auctionBuyerId
     *
     * @param string $auctionBuyerId
     */
    public function setAuctionBuyerId($auctionBuyerId)
    {
        $this->auctionBuyerId = $auctionBuyerId;
    }

    /**
     * Get auctionBuyerId
     *
     * @return string
     */
    public function getAuctionBuyerId()
    {
        return $this->auctionBuyerId;
    }

    /**
     * Set auctionClosingDate
     *
     * @param string $auctionClosingDate
     */
    public function setAuctionClosingDate($auctionClosingDate)
    {
        $this->auctionClosingDate = $auctionClosingDate;
    }

    /**
     * Get auctionClosingDate
     *
     * @return string
     */
    public function getAuctionClosingDate()
    {
        return $this->auctionClosingDate;
    }

    /**
     * Set auctionMultiItem
     *
     * @param integer $auctionMultiItem
     */
    public function setAuctionMultiItem($auctionMultiItem)
    {
        $this->auctionMultiItem = intval($auctionMultiItem);
    }

    /**
     * Get auctionMultiItem
     *
     * @return integer
     */
    public function getAuctionMultiItem()
    {
        return $this->auctionMultiItem;
    }

    /**
     * Set forAuction
     *
     * @param string $forAuction
     */
    public function setForAuction($forAuction)
    {
        $this->forAuction = $forAuction;
    }

    /**
     * Get forAuction
     *
     * @return string
     */
    public function getForAuction()
    {
        return $this->forAuction;
    }

    /**
     * Set subscrDate
     *
     * @param string $subscrDate
     */
    public function setSubscrDate($subscrDate)
    {
        $this->subscrDate = $subscrDate;
    }

    /**
     * Get subscrDate
     *
     * @return string
     */
    public function getSubscrDate()
    {
        return $this->subscrDate;
    }

    /**
     * Set subscrEffective
     *
     * @param string $subscrEffective
     */
    public function setSubscrEffective($subscrEffective)
    {
        $this->subscrEffective = $subscrEffective;
    }

    /**
     * Get subscrEffective
     *
     * @return string
     */
    public function getSubscrEffective()
    {
        return $this->subscrEffective;
    }

    /**
     * Set period1
     *
     * @param string $period1
     */
    public function setPeriod1($period1)
    {
        $this->period1 = $period1;
    }

    /**
     * Get period1
     *
     * @return string
     */
    public function getPeriod1()
    {
        return $this->period1;
    }

    /**
     * Set period2
     *
     * @param string $period2
     */
    public function setPeriod2($period2)
    {
        $this->period2 = $period2;
    }

    /**
     * Get period2
     *
     * @return string
     */
    public function getPeriod2()
    {
        return $this->period2;
    }

    /**
     * Set period3
     *
     * @param string $period3
     */
    public function setPeriod3($period3)
    {
        $this->period3 = $period3;
    }

    /**
     * Get period3
     *
     * @return string
     */
    public function getPeriod3()
    {
        return $this->period3;
    }

    /**
     * Set amount1
     *
     * @param decimal $amount1
     */
    public function setAmount1($amount1)
    {
        $this->amount1 = floatval($amount1);
    }

    /**
     * Get amount1
     *
     * @return decimal
     */
    public function getAmount1()
    {
        return $this->amount1;
    }

    /**
     * Set amount2
     *
     * @param decimal $amount2
     */
    public function setAmount2($amount2)
    {
        $this->amount2 = floatval($amount2);
    }

    /**
     * Get amount2
     *
     * @return decimal
     */
    public function getAmount2()
    {
        return $this->amount2;
    }

    /**
     * Set amount3
     *
     * @param decimal $amount3
     */
    public function setAmount3($amount3)
    {
        $this->amount3 = floatval($amount3);
    }

    /**
     * Get amount3
     *
     * @return decimal
     */
    public function getAmount3()
    {
        return $this->amount3;
    }

    /**
     * Set mcAmount1
     *
     * @param decimal $mcAmount1
     */
    public function setMcAmount1($mcAmount1)
    {
        $this->mcAmount1 = floatval($mcAmount1);
    }

    /**
     * Get mcAmount1
     *
     * @return decimal
     */
    public function getMcAmount1()
    {
        return $this->mcAmount1;
    }

    /**
     * Set mcAmount2
     *
     * @param decimal $mcAmount2
     */
    public function setMcAmount2($mcAmount2)
    {
        $this->mcAmount2 = floatval($mcAmount2);
    }

    /**
     * Get mcAmount2
     *
     * @return decimal
     */
    public function getMcAmount2()
    {
        return $this->mcAmount2;
    }

    /**
     * Set mcAmount3
     *
     * @param decimal $mcAmount3
     */
    public function setMcAmount3($mcAmount3)
    {
        $this->mcAmount3 = floatval($mcAmount3);
    }

    /**
     * Get mcAmount3
     *
     * @return decimal
     */
    public function getMcAmount3()
    {
        return $this->mcAmount3;
    }

    /**
     * Set recurring
     *
     * @param string $recurring
     */
    public function setRecurring($recurring)
    {
        $this->recurring = $recurring;
    }

    /**
     * Get recurring
     *
     * @return string
     */
    public function getRecurring()
    {
        return $this->recurring;
    }

    /**
     * Set reattempt
     *
     * @param string $reattempt
     */
    public function setReattempt($reattempt)
    {
        $this->reattempt = $reattempt;
    }

    /**
     * Get reattempt
     *
     * @return string
     */
    public function getReattempt()
    {
        return $this->reattempt;
    }

    /**
     * Set retryAt
     *
     * @param string $retryAt
     */
    public function setRetryAt($retryAt)
    {
        $this->retryAt = $retryAt;
    }

    /**
     * Get retryAt
     *
     * @return string
     */
    public function getRetryAt()
    {
        return $this->retryAt;
    }

    /**
     * Set recurTimes
     *
     * @param integer $recurTimes
     */
    public function setRecurTimes($recurTimes)
    {
        $this->recurTimes = intval($recurTimes);
    }

    /**
     * Get recurTimes
     *
     * @return integer
     */
    public function getRecurTimes()
    {
        return $this->recurTimes;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set subscrId
     *
     * @param string $subscrId
     */
    public function setSubscrId($subscrId)
    {
        $this->subscrId = $subscrId;
    }

    /**
     * Get subscrId
     *
     * @return string
     */
    public function getSubscrId()
    {
        return $this->subscrId;
    }

    /**
     * Set caseId
     *
     * @param string $caseId
     */
    public function setCaseId($caseId)
    {
        $this->caseId = $caseId;
    }

    /**
     * Get caseId
     *
     * @return string
     */
    public function getCaseId()
    {
        return $this->caseId;
    }

    /**
     * Set caseType
     *
     * @param string $caseType
     */
    public function setCaseType($caseType)
    {
        $this->caseType = $caseType;
    }

    /**
     * Get caseType
     *
     * @return string
     */
    public function getCaseType()
    {
        return $this->caseType;
    }

    /**
     * Set caseCreationDate
     *
     * @param string $caseCreationDate
     */
    public function setCaseCreationDate($caseCreationDate)
    {
        $this->caseCreationDate = $caseCreationDate;
    }

    /**
     * Get caseCreationDate
     *
     * @return string
     */
    public function getCaseCreationDate()
    {
        return $this->caseCreationDate;
    }

    /**
     * Set orderStatus
     *
     * @param string $orderStatus
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

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
     * Set discount
     *
     * @param decimal $discount
     */
    public function setDiscount($discount)
    {
        $this->discount = floatval($discount);
    }

    /**
     * Get discount
     *
     * @return decimal
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set shippingDiscount
     *
     * @param decimal $shippingDiscount
     */
    public function setShippingDiscount($shippingDiscount)
    {
        $this->shippingDiscount = floatval($shippingDiscount);
    }

    /**
     * Get shippingDiscount
     *
     * @return decimal
     */
    public function getShippingDiscount()
    {
        return $this->shippingDiscount;
    }

    /**
     * Set ipnTrackId
     *
     * @param string $ipnTrackId
     */
    public function setIpnTrackId($ipnTrackId)
    {
        $this->ipnTrackId = $ipnTrackId;
    }

    /**
     * Get ipnTrackId
     *
     * @return string
     */
    public function getIpnTrackId()
    {
        return $this->ipnTrackId;
    }

    /**
     * Set transactionSubject
     *
     * @param string $transactionSubject
     */
    public function setTransactionSubject($transactionSubject)
    {
        $this->transactionSubject = $transactionSubject;
    }

    /**
     * Get transactionSubject
     *
     * @return string
     */
    public function getTransactionSubject()
    {
        return $this->transactionSubject;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }


    /**
     * Get createdAt
     *
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * PrePersist createdAt
     *
     * @MongoDB\PrePersist
     */
    public function setCreatedAtValue(\DateTime $createdAt = null)
    {
        if($createdAt==null && $this->createdAt == null){
            $this->createdAt = new \DateTime();
        }else if($createdAt instanceof \DateTime){
            $this->createdAt = $createdAt;
        }
    }


    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * PrePersist and PreUpdate UpdatedAt-Value
     *
     * @MongoDB\PreUpdate
     * @MongoDB\PrePersist
     */
    public function setUpdatedAtValue(\DateTime $updatedAt = null)
    {
        if($updatedAt==null && $this->updatedAt == null){
            $this->updatedAt = new \DateTime();
        }else if($updatedAt instanceof \DateTime){
            $this->updatedAt = $updatedAt;
        }else{
            $this->updatedAt = new \DateTime();
        }
    }
}