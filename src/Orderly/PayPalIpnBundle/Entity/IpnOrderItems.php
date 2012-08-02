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
 * Orderly\PayPalIpnBundle\Entity\IpnOrderItems
 *
 * @ORM\Table(name="ipn_order_items")
 * @ORM\Entity
 */
class IpnOrderItems
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
     * @var integer $orderId
     *
     * @ORM\Column(name="order_id", type="integer", nullable=true)
     */
    private $orderId;

    /**
     * @var string $itemName
     *
     * @ORM\Column(name="item_name", type="string", length=127, nullable=true)
     */
    private $itemName;

    /**
     * @var string $itemNumber
     *
     * @ORM\Column(name="item_number", type="string", length=127, nullable=true)
     */
    private $itemNumber;

    /**
     * @var string $quantity
     *
     * @ORM\Column(name="quantity", type="string", length=127, nullable=true)
     */
    private $quantity;

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
     * @var decimal $tax
     *
     * @ORM\Column(name="tax", type="decimal", scale=2, nullable=true)
     */
    private $tax;

    /**
     * @var decimal $costPerItem
     *
     * @ORM\Column(name="cost_per_item", type="decimal", scale=2, nullable=true)
     */
    private $costPerItem;

    /**
     * @var string $optionName1
     *
     * @ORM\Column(name="option_name_1", type="string", length=64, nullable=true)
     */
    private $optionName1;

    /**
     * @var string $optionSelection1
     *
     * @ORM\Column(name="option_selection_1", type="string", length=200, nullable=true)
     */
    private $optionSelection1;

    /**
     * @var string $optionName2
     *
     * @ORM\Column(name="option_name_2", type="string", length=64, nullable=true)
     */
    private $optionName2;

    /**
     * @var string $optionSelection2
     *
     * @ORM\Column(name="option_selection_2", type="string", length=200, nullable=true)
     */
    private $optionSelection2;

    /**
     * @var string $optionName3
     *
     * @ORM\Column(name="option_name_3", type="string", length=64, nullable=true)
     */
    private $optionName3;

    /**
     * @var string $optionSelection3
     *
     * @ORM\Column(name="option_selection_3", type="string", length=200, nullable=true)
     */
    private $optionSelection3;

    /**
     * @var string $optionName4
     *
     * @ORM\Column(name="option_name_4", type="string", length=64, nullable=true)
     */
    private $optionName4;

    /**
     * @var string $optionSelection4
     *
     * @ORM\Column(name="option_selection_4", type="string", length=200, nullable=true)
     */
    private $optionSelection4;

    /**
     * @var string $optionName5
     *
     * @ORM\Column(name="option_name_5", type="string", length=64, nullable=true)
     */
    private $optionName5;

    /**
     * @var string $optionSelection5
     *
     * @ORM\Column(name="option_selection_5", type="string", length=200, nullable=true)
     */
    private $optionSelection5;

    /**
     * @var string $optionName6
     *
     * @ORM\Column(name="option_name_6", type="string", length=64, nullable=true)
     */
    private $optionName6;

    /**
     * @var string $optionSelection6
     *
     * @ORM\Column(name="option_selection_6", type="string", length=200, nullable=true)
     */
    private $optionSelection6;

    /**
     * @var string $optionName7
     *
     * @ORM\Column(name="option_name_7", type="string", length=64, nullable=true)
     */
    private $optionName7;

    /**
     * @var string $optionSelection7
     *
     * @ORM\Column(name="option_selection_7", type="string", length=200, nullable=true)
     */
    private $optionSelection7;

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
     * Set orderId
     *
     * @param integer $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = intval($orderId);
    }

    /**
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set itemName
     *
     * @param string $itemName
     */
    public function setItemName($itemName)
    {
        $this->itemName = $itemName;
    }

    /**
     * Get itemName
     *
     * @return string 
     */
    public function getItemName()
    {
        return $this->itemName;
    }

    /**
     * Set itemNumber
     *
     * @param string $itemNumber
     */
    public function setItemNumber($itemNumber)
    {
        $this->itemNumber = $itemNumber;
    }

    /**
     * Get itemNumber
     *
     * @return string 
     */
    public function getItemNumber()
    {
        return $this->itemNumber;
    }

    /**
     * Set quantity
     *
     * @param string $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Get quantity
     *
     * @return string 
     */
    public function getQuantity()
    {
        return $this->quantity;
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
     * Set costPerItem
     *
     * @param decimal $costPerItem
     */
    public function setCostPerItem($costPerItem)
    {
        $this->costPerItem = floatval($costPerItem);
    }

    /**
     * Get costPerItem
     *
     * @return decimal 
     */
    public function getCostPerItem()
    {
        return $this->costPerItem;
    }

    /**
     * Set optionName1
     *
     * @param string $optionName1
     */
    public function setOptionName1($optionName1)
    {
        $this->optionName1 = $optionName1;
    }

    /**
     * Get optionName1
     *
     * @return string 
     */
    public function getOptionName1()
    {
        return $this->optionName1;
    }

    /**
     * Set optionSelection1
     *
     * @param string $optionSelection1
     */
    public function setOptionSelection1($optionSelection1)
    {
        $this->optionSelection1 = $optionSelection1;
    }

    /**
     * Get optionSelection1
     *
     * @return string 
     */
    public function getOptionSelection1()
    {
        return $this->optionSelection1;
    }

    /**
     * Set optionName2
     *
     * @param string $optionName2
     */
    public function setOptionName2($optionName2)
    {
        $this->optionName2 = $optionName2;
    }

    /**
     * Get optionName2
     *
     * @return string 
     */
    public function getOptionName2()
    {
        return $this->optionName2;
    }

    /**
     * Set optionSelection2
     *
     * @param string $optionSelection2
     */
    public function setOptionSelection2($optionSelection2)
    {
        $this->optionSelection2 = $optionSelection2;
    }

    /**
     * Get optionSelection2
     *
     * @return string 
     */
    public function getOptionSelection2()
    {
        return $this->optionSelection2;
    }

    /**
     * Set optionName3
     *
     * @param string $optionName3
     */
    public function setOptionName3($optionName3)
    {
        $this->optionName3 = $optionName3;
    }

    /**
     * Get optionName3
     *
     * @return string 
     */
    public function getOptionName3()
    {
        return $this->optionName3;
    }

    /**
     * Set optionSelection3
     *
     * @param string $optionSelection3
     */
    public function setOptionSelection3($optionSelection3)
    {
        $this->optionSelection3 = $optionSelection3;
    }

    /**
     * Get optionSelection3
     *
     * @return string 
     */
    public function getOptionSelection3()
    {
        return $this->optionSelection3;
    }

    /**
     * Set optionName4
     *
     * @param string $optionName4
     */
    public function setOptionName4($optionName4)
    {
        $this->optionName4 = $optionName4;
    }

    /**
     * Get optionName4
     *
     * @return string 
     */
    public function getOptionName4()
    {
        return $this->optionName4;
    }

    /**
     * Set optionSelection4
     *
     * @param string $optionSelection4
     */
    public function setOptionSelection4($optionSelection4)
    {
        $this->optionSelection4 = $optionSelection4;
    }

    /**
     * Get optionSelection4
     *
     * @return string 
     */
    public function getOptionSelection4()
    {
        return $this->optionSelection4;
    }

    /**
     * Set optionName5
     *
     * @param string $optionName5
     */
    public function setOptionName5($optionName5)
    {
        $this->optionName5 = $optionName5;
    }

    /**
     * Get optionName5
     *
     * @return string 
     */
    public function getOptionName5()
    {
        return $this->optionName5;
    }

    /**
     * Set optionSelection5
     *
     * @param string $optionSelection5
     */
    public function setOptionSelection5($optionSelection5)
    {
        $this->optionSelection5 = $optionSelection5;
    }

    /**
     * Get optionSelection5
     *
     * @return string 
     */
    public function getOptionSelection5()
    {
        return $this->optionSelection5;
    }

    /**
     * Set optionName6
     *
     * @param string $optionName6
     */
    public function setOptionName6($optionName6)
    {
        $this->optionName6 = $optionName6;
    }

    /**
     * Get optionName6
     *
     * @return string 
     */
    public function getOptionName6()
    {
        return $this->optionName6;
    }

    /**
     * Set optionSelection6
     *
     * @param string $optionSelection6
     */
    public function setOptionSelection6($optionSelection6)
    {
        $this->optionSelection6 = $optionSelection6;
    }

    /**
     * Get optionSelection6
     *
     * @return string 
     */
    public function getOptionSelection6()
    {
        return $this->optionSelection6;
    }

    /**
     * Set optionName7
     *
     * @param string $optionName7
     */
    public function setOptionName7($optionName7)
    {
        $this->optionName7 = $optionName7;
    }

    /**
     * Get optionName7
     *
     * @return string 
     */
    public function getOptionName7()
    {
        return $this->optionName7;
    }

    /**
     * Set optionSelection7
     *
     * @param string $optionSelection7
     */
    public function setOptionSelection7($optionSelection7)
    {
        $this->optionSelection7 = $optionSelection7;
    }

    /**
     * Get optionSelection7
     *
     * @return string 
     */
    public function getOptionSelection7()
    {
        return $this->optionSelection7;
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