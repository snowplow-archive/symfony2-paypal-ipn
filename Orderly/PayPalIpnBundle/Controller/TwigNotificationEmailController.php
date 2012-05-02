<?php

namespace Orderly\PayPalIpnBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Orderly\PayPalIpnBundle\Ipn;

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
 *  Sample listener controller for IPN messages with twig email notification
 */
class TwigNotificationEmailController extends Controller
{
    
    public $paypal_ipn;
    /**
     * @Route("/ipn-twig-email-notification")
     * @Template()
     */
    public function indexAction()
    {
        //getting ipn service registered in container
        $this->paypal_ipn = $this->get('orderly_paypal_ipn');
        
        //validate ipn (generating response on PayPal IPN request)
        if ($this->paypal_ipn->validateIPN())
        {
            // Succeeded, now let's extract the order
            $this->paypal_ipn->extractOrder();

            // And we save the order now (persist and extract are separate because you might only want to persist the order in certain circumstances).
            $this->paypal_ipn->saveOrder();

            // Now let's check what the payment status is and act accordingly
            if ($this->paypal_ipn->getOrderStatus() == Ipn::PAID)
            {
                //preparing message
                $message = \Swift_Message::newInstance()
                    ->setSubject('Order confirmation')
                    ->setFrom('support@CHANGEME.com', 'TEST')
                    ->setTo($this->paypal_ipn->getOrder()->getPayerEmail(), $this->paypal_ipn->getOrder()->getFirstName() .' '. $this->paypal_ipn->getOrder()->getLastName())
                    ->setBody($this->renderView('OrderlyPayPalIpnBundle:Default:confirmation_email.html.twig',
                            // Prepare the variables to populate the email template:
                            array('order' => $this->paypal_ipn->getOrder(),
                                  'items' => $this->paypal_ipn->getOrderItems())
                            ), 'text/html')
                ;
                //send message
                $this->get('mailer')->send($message);
            }
        }
        else // Just redirect to the root URL
        {
            return $this->redirect('/');
        }

        $response = new Response();
        $response->setStatusCode(200);
        
        return $response;
    }
}
