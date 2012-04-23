============
Installation
============

    To create the MySQL tables required by OrderlyPayPalIpnBundle, run the SQL file "create_mysql_tables.sql" found
    in the @Orderly/PayPalIpnBundle/Resources/config@ folder against your db.

    Alternatively You can install tables in database simply type this in your project console:
    php app/console doctrine:schema:update --force

    NOTE: the second method (using app/console) will not add the table fields comments in Your database. The first does.


Dependencies
------------
Depends on Symfony standard and Doctrine 2

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

Example of usage with email notyfication:
Orderly/PayPalIpnBundle/Controller/TwigNotificationEmailController.php

Example of usage without notyfication
Orderly/PayPalIpnBundle/Controller/NoNotificationController.php

Controller address with this service should be provided as IPN listener in Your PalPal Account
