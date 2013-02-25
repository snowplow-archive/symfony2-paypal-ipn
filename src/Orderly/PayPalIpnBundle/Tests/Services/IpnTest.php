<?php

namespace Orderly\PayPalIpnBundle\Tests\Services;

use Orderly\PayPalIpnBundle\Test\ContainerAwareTestCase;

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
 * Test
 *
 * Bundle should be tested by sending IPN Notyfications messages from PayPal testing tool
 * more on https://developer.paypal.com/us/cgi-bin/devscr
 */
class IpnTest extends ContainerAwareTestCase
{
    public function setUp()
    {
        $this->service = $this->container->get('orderly_pay_pal_ipn');
    }

    public function testIndex()
    {
        $this->assertTrue(true==true);
    }
}
