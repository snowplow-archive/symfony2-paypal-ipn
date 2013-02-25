<?php
/**
 * Symfony2 ContainerAware TestCase Base class
 */
namespace Orderly\PayPalIpnBundle\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * ContainerAwareTestCase
 */
class ContainerAwareTestCase extends WebTestCase
{
    protected $container;

    public function __construct()
    {
        $kernel = self::getKernelClass();

        self::$kernel = new $kernel('dev', true);
        self::$kernel->boot();

        $this->container = self::$kernel->getContainer();
    }
}