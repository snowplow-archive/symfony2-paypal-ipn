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
 * Orderly\PayPalIpnBundle\Entity\IpnLog
 *
 * @ORM\Table(name="ipn_log")
 * @ORM\Entity
 */
class IpnLog
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
     * @var string $listenerName
     *
     * @ORM\Column(name="listener_name", type="string", length=3, nullable=true)
     */
    private $listenerName;

    /**
     * @var string $transactionType
     *
     * @ORM\Column(name="transaction_type", type="string", length=255, nullable=true)
     */
    private $transactionType;

    /**
     * @var string $transactionId
     *
     * @ORM\Column(name="transaction_id", type="string", length=19, nullable=true)
     */
    private $transactionId;

    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", length=16, nullable=true)
     */
    private $status;

    /**
     * @var string $message
     *
     * @ORM\Column(name="message", type="string", length=512, nullable=true)
     */
    private $message;

    /**
     * @var string $ipnDataHash
     *
     * @ORM\Column(name="ipn_data_hash", type="string", length=32, nullable=true)
     */
    private $ipnDataHash;

    /**
     * @var text $detail
     *
     * @ORM\Column(name="detail", type="text", nullable=true)
     */
    private $detail;

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
     * Set listenerName
     *
     * @param string $listenerName
     */
    public function setListenerName($listenerName)
    {
        $this->listenerName = $listenerName;
    }

    /**
     * Get listenerName
     *
     * @return string 
     */
    public function getListenerName()
    {
        return $this->listenerName;
    }

    /**
     * Set transactionType
     *
     * @param string $transactionType
     */
    public function setTransactionType($transactionType)
    {
        $this->transactionType = $transactionType;
    }

    /**
     * Get transactionType
     *
     * @return string 
     */
    public function getTransactionType()
    {
        return $this->transactionType;
    }

    /**
     * Set transactionId
     *
     * @param string $transactionId
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * Get transactionId
     *
     * @return string 
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set message
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set ipnDataHash
     *
     * @param string $ipnDataHash
     */
    public function setIpnDataHash($ipnDataHash)
    {
        $this->ipnDataHash = $ipnDataHash;
    }

    /**
     * Get ipnDataHash
     *
     * @return string 
     */
    public function getIpnDataHash()
    {
        return $this->ipnDataHash;
    }

    /**
     * Set detail
     *
     * @param text $detail
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    /**
     * Get detail
     *
     * @return text 
     */
    public function getDetail()
    {
        return $this->detail;
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
