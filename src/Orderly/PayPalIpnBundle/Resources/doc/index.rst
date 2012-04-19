============
Installation
============

  
    To instal tables in database simply type this in your project console:

    php app/console doctrine:schema:update --force


Dependencies
------------
Depends on standard Symfony 2 libs and Doctrine 2

Configuration
-------------
::

    // YAML
    orderly_pay_pal_ipn:
        # Constants for the live environment
        email:   sales@CHANGEME.com
        url:     https://www.paypal.com/cgi-bin/webscr
        debug:   %kernel.debug%
        # Debugging simply caches the latest PayPal IPN post data into the database, and retrieves it if
        # validateIPN is called without post data. This is useful for directly trying a validateIPN call from
        # the controller.

        # Constants for the sandbox environment ; Default settings configured in Configuration.php
        sandbox_email:   seller@paypalsandbox.com
        sandbox_url:     https://www.sandbox.paypal.com/cgi-bin/webscr
        sandbox_debug:   true

        # islive: if set to false then service loads settings with "sandbox_" prefix
        islive:          false 

=====
Usage
=====
Example of usage OrderlyPayPalIpnBundle/Controller/DefaultController.php

Controller address with this service should be provided as IPN listener in Your PalPal Account
