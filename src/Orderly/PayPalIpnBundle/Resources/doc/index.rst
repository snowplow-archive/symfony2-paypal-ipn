============
Installation
============

    First copy Orderly/PayPalIpnBundle to Your project "src" directory. The <code>OrderlyPayPalIpnBundle.php</code> file
    should be under <code>"Your Symfony2 root flder"/src/Orderly/PaypalIpnBundle/OrderlyPayPalIpnBundle.php</code>

    Now bundle should be register. Find <code>"Your Symfony2 root flder"/app/AppKernel.php</code> file 
    and add the following on the end of the $bundles array in "<code>registerBundles()</code>" method:

    <code>new Orderly\PayPalIpnBundle\OrderlyPayPalIpnBundle()</code>

    
    To create the MySQL tables required by OrderlyPayPalIpnBundle, run the SQL file <code>create_mysql_tables.sql</code> found
    in the <code>Orderly/PayPalIpnBundle/Resources/config</code> folder against your db (RECOMMENDED).

    Alternatively (NOT RECOMMENDED) You can install tables in database simply type this in your project console:
    <code>php app/console doctrine:schema:update --force</code>

    (NOTE: the second method (using app/console) will not add the table fields comments in Your database etc.)

    At the end tell to routing system, where he can find our sample controllers - add the following
    to the <code>app/config/routing.yml</code> file:

<pre>
<code>

    //YAML
    OrderlyPayPalIpnBundleEmail:
        resource: "@OrderlyPayPalIpnBundle/Controller/TwigNotificationEmailController.php"
        type:     annotation
        prefix:   /

    OrderlyPayPalIpnBundleNoEmail:
        resource: "@OrderlyPayPalIpnBundle/Controller/NoNotificationController.php"
        type:     annotation
        prefix:   /
</code>
</pre>
    this will import Routes patterns from controllers annotations 

    Under the following urls our PayPal IPN service is listen for incomming requests:
 
    "<code>http://example.com/ipn-no-notification</code>"

    "<code>http://example.com/ipn-twig-email-notification</code>"

       

Dependencies
------------
Depends on Symfony standard and Doctrine 2

Configuration
-------------
<pre>
<code>

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
</code>
</pre>
=====
Usage
=====

Example of usage with email notyfication:
<code>Orderly/PayPalIpnBundle/Controller/TwigNotificationEmailController.php</code>

Example of usage without notyfication
<code>Orderly/PayPalIpnBundle/Controller/NoNotificationController.php</code>

Controller address with this service should be provided as IPN listener in Your PalPal Account
