<?php

namespace Orderly\PayPalIpnBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Doctrine\Common\Persistence\ObjectManager;

use Orderly\PayPalIpnBundle\Ipn;

class PayPalEvent extends Event {
    private $ipn;

    public function __construct(Ipn $ipn) {
        $this->ipn = $ipn;
    }

    public function getIPN() {
        return $this->ipn;
    }
}
