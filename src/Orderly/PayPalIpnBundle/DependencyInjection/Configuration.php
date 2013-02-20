<?php

namespace Orderly\PayPalIpnBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

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
 *  Setting config validators 
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $tb = new TreeBuilder();
        $rootNode = $tb->root('orderly_pay_pal_ipn');

        $this->addDriverSection($rootNode);

        $rootNode->children()
                ->booleanNode('islive')->defaultValue(true)->end()
                ->scalarNode('email')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('url')->defaultValue('https://www.paypal.com/cgi-bin/webscr')->end()
                ->booleanNode('debug')->defaultValue('%kernel.debug%')->end()
                ->scalarNode('sandbox_email')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('sandbox_url')->defaultValue('https://www.sandbox.paypal.com/cgi-bin/webscr')->end()
                ->booleanNode('sandbox_debug')->defaultValue(true)->end()
            ->end()
        ->end();

        return $tb;
    }

    protected function addDriverSection($rootNode)
    {
        $rootNode
            ->validate()
                ->ifTrue(function($v) {
                    return !isset($v['drivers']) || (count($v['drivers']) == 0);
                })
                ->thenInvalid("Please define a driver")
            ->end()
            ->children()
                ->arrayNode('drivers')
                    ->validate()
                        ->ifTrue(function($v) {
                            return count($v) > 1;
                        })
                        ->thenInvalid('Please define only one driver.')
                    ->end()
                    ->children()
                        ->arrayNode('orm')
                            ->children()
                                ->scalarNode('object_manager')
                                    ->isRequired()
                                    ->cannotBeEmpty()
                                    ->example('doctrine.orm.entity_manager')
                                ->end()
                                ->arrayNode('classes')
                                    ->children()
                                        ->scalarNode('ipn_log')
                                            ->defaultValue('Orderly\PayPalIpnBundle\Entity\IpnLog')
                                        ->end()
                                        ->scalarNode('ipn_order_items')
                                            ->defaultValue('Orderly\PayPalIpnBundle\Entity\IpnOrderItems')
                                        ->end()
                                        ->scalarNode('ipn_orders')
                                            ->defaultValue('Orderly\PayPalIpnBundle\Entity\IpnOrders')
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('odm')
                            ->children()
                                ->scalarNode('object_manager')
                                    ->isRequired()
                                    ->cannotBeEmpty()
                                    ->example('doctrine.odm.mongodb.document_manager')
                                ->end()
                                ->arrayNode('classes')
                                    ->children()
                                        ->arrayNode('classes')
                                            ->children()
                                                ->scalarNode('ipn_log')
                                                    ->defaultValue('Orderly\PayPalIpnBundle\Document\IpnLog')
                                                ->end()
                                                ->scalarNode('ipn_order_items')
                                                    ->isRequired()
                                                    ->defaultValue('Orderly\PayPalIpnBundle\Document\IpnOrderItems')
                                                ->end()
                                                ->scalarNode('ipn_orders')
                                                    ->isRequired()
                                                    ->defaultValue('Orderly\PayPalIpnBundle\Document\IpnOrders')
                                                ->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
