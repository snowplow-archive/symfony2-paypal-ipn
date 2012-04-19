<?php

namespace Orderly\PayPalIpnBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

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

class OrderlyPayPalIpnBundle extends Bundle
{
    public function boot()
    {      
        if (!\Doctrine\DBAL\Types\Type::hasType('enumorderstatus')){
            \Doctrine\DBAL\Types\Type::addType('enumorderstatus', 'Orderly\PayPalIpnBundle\Types\EnumOrderStatus');
            $em = $this->container->get('doctrine')->getEntityManager();
            $em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enumorderstatus', 'string');
        }
    }
}
