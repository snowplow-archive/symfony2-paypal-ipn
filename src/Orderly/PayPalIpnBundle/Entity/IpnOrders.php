<?php

namespace Orderly\PayPalIpnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
 * Orderly\PayPalIpnBundle\Entity\IpnOrders
 *
 * @ORM\Table(name="ipn_orders")
 * @ORM\Entity
 */
class IpnOrders
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $notifyVersion
     *
     * @ORM\Column(name="notify_version", type="string", length=64, nullable=true)
     */
    private $notifyVersion;

    /**
     * @var string $verifySign
     *
     * @ORM\Column(name="verify_sign", type="string", length=127, nullable=true)
     */
    private $verifySign;

    /**
     * @var integer $testIpn
     *
     * @ORM\Column(name="test_ipn", type="integer", nullable=true)
     */
    private $testIpn;

    /**
     * @var string $protectionEligibility
     *
     * @ORM\Column(name="protection_eligibility", type="string", length=24, nullable=true)
     */
    private $protectionEligibility;

    /**
     * @var string $charset
     *
     * @ORM\Column(name="charset", type="string", length=127, nullable=true)
     */
    private $charset;

    /**
     * @var string $btnId
     *
     * @ORM\Column(name="btn_id", type="string", length=40, nullable=true)
     */
    private $btnId;

    /**
     * @var string $addressCity
     *
     * @ORM\Column(name="address_city", type="string", length=40, nullable=true)
     */
    private $addressCity;

    /**
     * @var string $addressCountry
     *
     * @ORM\Column(name="address_country", type="string", length=64, nullable=true)
     */
    private $addressCountry;

    /**
     * @var string $addressCountryCode
     *
     * @ORM\Column(name="address_country_code", type="string", length=2, nullable=true)
     */
    private $addressCountryCode;

    /**
     * @var string $addressName
     *
     * @ORM\Column(name="address_name", type="string", length=128, nullable=true)
     */
    private $addressName;

    /**
     * @var string $addressState
     *
     * @ORM\Column(name="address_state", type="string", length=40, nullable=true)
     */
    private $addressState;

    /**
     * @var string $addressStatus
     *
     * @ORM\Column(name="address_status", type="string", length=20, nullable=true)
     */
    private $addressStatus;

    /**
     * @var string $addressStreet
     *
     * @ORM\Column(name="address_street", type="string", length=200, nullable=true)
     */
    private $addressStreet;

    /**
     * @var string $addressZip
     *
     * @ORM\Column(name="address_zip", type="string", length=20, nullable=true)
     */
    private $addressZip;

    /**
     * @var string $firstName
     *
     * @ORM\Column(name="first_name", type="string", length=64, nullable=true)
     */
    private $firstName;

    /**
     * @var string $lastName
     *
     * @ORM\Column(name="last_name", type="string", length=64, nullable=true)
     */
    private $lastName;

    /**
     * @var string $payerBusinessName
     *
     * @ORM\Column(name="payer_business_name", type="string", length=127, nullable=true)
     */
    private $payerBusinessName;

    /**
     * @var string $payerEmail
     *
     * @ORM\Column(name="payer_email", type="string", length=127, nullable=true)
     */
    private $payerEmail;

    /**
     * @var string $payerId
     *
     * @ORM\Column(name="payer_id", type="string", length=13, nullable=true)
     */
    private $payerId;

    /**
     * @var string $payerStatus
     *
     * @ORM\Column(name="payer_status", type="string", length=20, nullable=true)
     */
    private $payerStatus;

    /**
     * @var string $contactPhone
     *
     * @ORM\Column(name="contact_phone", type="string", length=20, nullable=true)
     */
    private $contactPhone;

    /**
     * @var string $residenceCountry
     *
     * @ORM\Column(name="residence_country", type="string", length=2, nullable=true)
     */
    private $residenceCountry;

    /**
     * @var string $business
     *
     * @ORM\Column(name="business", type="string", length=127, nullable=true)
     */
    private $business;

    /**
     * @var string $receiverEmail
     *
     * @ORM\Column(name="receiver_email", type="string", length=127, nullable=true)
     */
    private $receiverEmail;

    /**
     * @var string $receiverId
     *
     * @ORM\Column(name="receiver_id", type="string", length=13, nullable=true)
     */
    private $receiverId;

    /**
     * @var string $custom
     *
     * @ORM\Column(name="custom", type="string", length=255, nullable=true)
     */
    private $custom;

    /**
     * @var string $invoice
     *
     * @ORM\Column(name="invoice", type="string", length=127, nullable=true)
     */
    private $invoice;

    /**
     * @var string $memo
     *
     * @ORM\Column(name="memo", type="string", length=255, nullable=true)
     */
    private $memo;

    /**
     * @var decimal $tax
     *
     * @ORM\Column(name="tax", type="decimal", scale=2, nullable=true)
     */
    private $tax;

    /**
     * @var string $authId
     *
     * @ORM\Column(name="auth_id", type="string", length=19, nullable=true)
     */
    private $authId;

    /**
     * @var string $authExp
     *
     * @ORM\Column(name="auth_exp", type="string", length=28, nullable=true)
     */
    private $authExp;

    /**
     * @var integer $authAmount
     *
     * @ORM\Column(name="auth_amount", type="integer", nullable=true)
     */
    private $authAmount;

    /**
     * @var string $authStatus
     *
     * @ORM\Column(name="auth_status", type="string", length=20, nullable=true)
     */
    private $authStatus;

    /**
     * @var integer $numCartItems
     *
     * @ORM\Column(name="num_cart_items", type="integer", nullable=true)
     */
    private $numCartItems;

    /**
     * @var string $parentTxnId
     *
     * @ORM\Column(name="parent_txn_id", type="string", length=19, nullable=true)
     */
    private $parentTxnId;

    /**
     * @var string $paymentDate
     *
     * @ORM\Column(name="payment_date", type="string", length=28, nullable=true)
     */
    private $paymentDate;

    /**
     * @var string $paymentStatus
     *
     * @ORM\Column(name="payment_status", type="string", length=20, nullable=true)
     */
    private $paymentStatus;

    /**
     * @var string $paymentType
     *
     * @ORM\Column(name="payment_type", type="string", length=10, nullable=true)
     */
    private $paymentType;

    /**
     * @var string $pendingReason
     *
     * @ORM\Column(name="pending_reason", type="string", length=20, nullable=true)
     */
    private $pendingReason;

    /**
     * @var string $reasonCode
     *
     * @ORM\Column(name="reason_code", type="string", length=20, nullable=true)
     */
    private $reasonCode;

    /**
     * @var integer $remainingSettle
     *
     * @ORM\Column(name="remaining_settle", type="integer", nullable=true)
     */
    private $remainingSettle;

    /**
     * @var string $shippingMethod
     *
     * @ORM\Column(name="shipping_method", type="string", length=64, nullable=true)
     */
    private $shippingMethod;

    /**
     * @var decimal $shipping
     *
     * @ORM\Column(name="shipping", type="decimal", scale=2, nullable=true)
     */
    private $shipping;

    /**
     * @var string $transactionEntity
     *
     * @ORM\Column(name="transaction_entity", type="string", length=20, nullable=true)
     */
    private $transactionEntity;

    /**
     * @var string $txnId
     *
     * @ORM\Column(name="txn_id", type="string", length=19, nullable=true)
     */
    private $txnId;

    /**
     * @var string $txnType
     *
     * @ORM\Column(name="txn_type", type="string", length=20, nullable=true)
     */
    private $txnType;

    /**
     * @var decimal $exchangeRate
     *
     * @ORM\Column(name="exchange_rate", type="decimal", scale=2, nullable=true)
     */
    private $exchangeRate;

    /**
     * @var string $mcCurrency
     *
     * @ORM\Column(name="mc_currency", type="string", length=3, nullable=true)
     */
    private $mcCurrency;

    /**
     * @var decimal $mcFee
     *
     * @ORM\Column(name="mc_fee", type="decimal", scale=2, nullable=true)
     */
    private $mcFee;

    /**
     * @var decimal $mcGross
     *
     * @ORM\Column(name="mc_gross", type="decimal", scale=2, nullable=true)
     */
    private $mcGross;

    /**
     * @var decimal $mcHandling
     *
     * @ORM\Column(name="mc_handling", type="decimal", scale=2, nullable=true)
     */
    private $mcHandling;

    /**
     * @var decimal $mcShipping
     *
     * @ORM\Column(name="mc_shipping", type="decimal", scale=2, nullable=true)
     */
    private $mcShipping;

    /**
     * @var decimal $paymentFee
     *
     * @ORM\Column(name="payment_fee", type="decimal", scale=2, nullable=true)
     */
    private $paymentFee;

    /**
     * @var decimal $paymentGross
     *
     * @ORM\Column(name="payment_gross", type="decimal", scale=2, nullable=true)
     */
    private $paymentGross;

    /**
     * @var decimal $settleAmount
     *
     * @ORM\Column(name="settle_amount", type="decimal", scale=2, nullable=true)
     */
    private $settleAmount;

    /**
     * @var string $settleCurrency
     *
     * @ORM\Column(name="settle_currency", type="string", length=3, nullable=true)
     */
    private $settleCurrency;

    /**
     * @var string $auctionBuyerId
     *
     * @ORM\Column(name="auction_buyer_id", type="string", length=64, nullable=true)
     */
    private $auctionBuyerId;

    /**
     * @var string $auctionClosingDate
     *
     * @ORM\Column(name="auction_closing_date", type="string", length=28, nullable=true)
     */
    private $auctionClosingDate;

    /**
     * @var integer $auctionMultiItem
     *
     * @ORM\Column(name="auction_multi_item", type="integer", nullable=true)
     */
    private $auctionMultiItem;

    /**
     * @var string $forAuction
     *
     * @ORM\Column(name="for_auction", type="string", length=10, nullable=true)
     */
    private $forAuction;

    /**
     * @var string $subscrDate
     *
     * @ORM\Column(name="subscr_date", type="string", length=28, nullable=true)
     */
    private $subscrDate;

    /**
     * @var string $subscrEffective
     *
     * @ORM\Column(name="subscr_effective", type="string", length=28, nullable=true)
     */
    private $subscrEffective;

    /**
     * @var string $period1
     *
     * @ORM\Column(name="period1", type="string", length=10, nullable=true)
     */
    private $period1;

    /**
     * @var string $period2
     *
     * @ORM\Column(name="period2", type="string", length=10, nullable=true)
     */
    private $period2;

    /**
     * @var string $period3
     *
     * @ORM\Column(name="period3", type="string", length=10, nullable=true)
     */
    private $period3;

    /**
     * @var decimal $amount1
     *
     * @ORM\Column(name="amount1", type="decimal", scale=2, nullable=true)
     */
    private $amount1;

    /**
     * @var decimal $amount2
     *
     * @ORM\Column(name="amount2", type="decimal", scale=2, nullable=true)
     */
    private $amount2;

    /**
     * @var decimal $amount3
     *
     * @ORM\Column(name="amount3", type="decimal", scale=2, nullable=true)
     */
    private $amount3;

    /**
     * @var decimal $mcAmount1
     *
     * @ORM\Column(name="mc_amount1", type="decimal", scale=2, nullable=true)
     */
    private $mcAmount1;

    /**
     * @var decimal $mcAmount2
     *
     * @ORM\Column(name="mc_amount2", type="decimal", scale=2, nullable=true)
     */
    private $mcAmount2;

    /**
     * @var decimal $mcAmount3
     *
     * @ORM\Column(name="mc_amount3", type="decimal", scale=2, nullable=true)
     */
    private $mcAmount3;

    /**
     * @var string $recurring
     *
     * @ORM\Column(name="recurring", type="string", length=1, nullable=true)
     */
    private $recurring;

    /**
     * @var string $reattempt
     *
     * @ORM\Column(name="reattempt", type="string", length=1, nullable=true)
     */
    private $reattempt;

    /**
     * @var string $retryAt
     *
     * @ORM\Column(name="retry_at", type="string", length=28, nullable=true)
     */
    private $retryAt;

    /**
     * @var integer $recurTimes
     *
     * @ORM\Column(name="recur_times", type="integer", nullable=true)
     */
    private $recurTimes;

    /**
     * @var string $username
     *
     * @ORM\Column(name="username", type="string", length=64, nullable=true)
     */
    private $username;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=24, nullable=true)
     */
    private $password;

    /**
     * @var string $subscrId
     *
     * @ORM\Column(name="subscr_id", type="string", length=19, nullable=true)
     */
    private $subscrId;

    /**
     * @var string $caseId
     *
     * @ORM\Column(name="case_id", type="string", length=28, nullable=true)
     */
    private $caseId;

    /**
     * @var string $caseType
     *
     * @ORM\Column(name="case_type", type="string", length=28, nullable=true)
     */
    private $caseType;

    /**
     * @var string $caseCreationDate
     *
     * @ORM\Column(name="case_creation_date", type="string", length=28, nullable=true)
     */
    private $caseCreationDate;

    /**
     * @var string $orderStatus
     *
     * @ORM\Column(name="order_status", type="string", nullable=true)
     */
    private $orderStatus;

    /**
     * @var decimal $discount
     *
     * @ORM\Column(name="discount", type="decimal", scale=2, nullable=true)
     */
    private $discount;

    /**
     * @var decimal $shippingDiscount
     *
     * @ORM\Column(name="shipping_discount", type="decimal", scale=2, nullable=true)
     */
    private $shippingDiscount;

    /**
     * @var string $ipnTrackId
     *
     * @ORM\Column(name="ipn_track_id", type="string", length=127, nullable=true)
     */
    private $ipnTrackId;

    /**
     * @var string $transactionSubject
     *
     * @ORM\Column(name="transaction_subject", type="string", length=255, nullable=true)
     */
    private $transactionSubject;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    
    
    /**
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = intval($id);
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
        $this->amount2 = $floatval(amount2);
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
}