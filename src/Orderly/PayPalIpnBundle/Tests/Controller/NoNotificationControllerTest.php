<?php

namespace Orderly\PayPalIpnBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
class NoNotificationControllerTest extends WebTestCase
{
    private $postdata = 'a:36:{s:8:"test_ipn";s:1:"1";s:12:"payment_type";s:6:"echeck";s:12:"payment_date";s:25:"01:05:22 Apr 27, 2012 PDT";s:14:"payment_status";s:9:"Completed";s:14:"address_status";s:9:"confirmed";s:12:"payer_status";s:8:"verified";s:10:"first_name";s:4:"John";s:9:"last_name";s:5:"Smith";s:11:"payer_email";s:23:"buyer@paypalsandbox.com";s:8:"payer_id";s:13:"TESTBUYERID01";s:12:"address_name";s:10:"John Smith";s:15:"address_country";s:13:"United States";s:20:"address_country_code";s:2:"US";s:11:"address_zip";s:5:"95131";s:13:"address_state";s:2:"CA";s:12:"address_city";s:8:"San Jose";s:14:"address_street";s:15:"123, any street";s:8:"business";s:24:"seller@paypalsandbox.com";s:14:"receiver_email";s:24:"seller@paypalsandbox.com";s:11:"receiver_id";s:13:"TESTSELLERID1";s:17:"residence_country";s:2:"US";s:9:"item_name";s:9:"something";s:11:"item_number";s:7:"AK-1234";s:8:"quantity";s:1:"1";s:8:"shipping";s:4:"3.04";s:3:"tax";s:4:"2.02";s:11:"mc_currency";s:3:"USD";s:6:"mc_fee";s:4:"0.44";s:8:"mc_gross";s:5:"12.34";s:8:"txn_type";s:10:"web_accept";s:6:"txn_id";s:7:"2242785";s:14:"notify_version";s:3:"2.1";s:6:"custom";s:6:"xyz123";s:7:"invoice";s:7:"abc1234";s:7:"charset";s:12:"windows-1252";s:11:"verify_sign";s:56:"ANynA0jMWQcMYG.j0mGa9lL.YtA6AEIMNrCW4IiWOlSOJ-B2Rn3qij4z";}';
    
    public function testIndex()
    {
        $clientPost = static::createClient();

        $clientPost->request('POST', '/ipn-no-notification', unserialize($this->postdata));

        $this->assertTrue($clientPost->getResponse()->getContent()=="");
    }
}
