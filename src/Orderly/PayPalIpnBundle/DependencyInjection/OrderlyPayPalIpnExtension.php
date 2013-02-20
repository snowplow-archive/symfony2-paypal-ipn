<?php

namespace Orderly\PayPalIpnBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

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
 *  Setting container parameters
 * 
 * @param array $configs 
 * @param ContainerBuilder $container
 * 
 */
class OrderlyPayPalIpnExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $container->setParameter('orderly.paypalipn.islive', $config['islive']);
        
        if($config['islive'])
        {
            $container->setParameter('orderly.paypalipn.email', $config['email']);
            $container->setParameter('orderly.paypalipn.url', $config['url']);
            $container->setParameter('orderly.paypalipn.debug', $config['debug']);
        }
        else
        {
            $container->setParameter('orderly.paypalipn.email', $config['sandbox_email']);
            $container->setParameter('orderly.paypalipn.url', $config['sandbox_url']);
            $container->setParameter('orderly.paypalipn.debug', $config['sandbox_debug']);
        }

        $driver = null;
        if (isset($config['drivers']))
        {

            if (isset($config['drivers']['orm']))
            {
                $this->loadORMDriver($container, $loader, $config['drivers']['orm']);
                $driver = 'orm';
            }
            elseif(isset($config['drivers']['odm']))
            {
                $this->loadODMDriver($container, $loader, $config['drivers']['odm']);
                $driver = 'odm';
            }
        }

        $loader->load('services.xml');
    }

    private function loadORMDriver($container, $loader, $config)
    {
        $classes = isset($config['classes']) ? $config['classes'] : array();

        $params = array(
            "ipn_log","ipn_order_items","ipn_orders"
        );

        $container->setAlias('paypal_ipn.driver.object_manager', $config['object_manager']);

        foreach($params as $param)
        {
            if (isset($classes[$param]))
            {
                $container->setParameter(sprintf('paypal_ipn.class.%s', $param), $classes[$param]);
            }
        }
    }

    private function loadODMDriver($container, $loader, $config)
    {

        $classes = isset($config['classes']) ? $config['classes'] : array();

        $params = array(
          "ipn_log","ipn_order_items","ipn_orders"
        );

        $container->setAlias('paypal_ipn.driver.object_manager', $config['object_manager']);

        foreach($params as $param)
        {
            $container->setParameter(sprintf('paypal_ipn.class.%s', $param), $classes[$param]);
        }
    }
}