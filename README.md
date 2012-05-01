# Symfony2 PayPal IPN Bundle

## Overview

symfony2-paypal-ipn is a Symfony2 bundle for working with the PayPal IPN (Instant Payment Notification) service.
The bundle acts as a listener for the PayPal IPN service and logs the incoming orders to your database using Doctrine. 

## Description

symfony2-paypal-ipn is a near-direct port of [codeigniter-paypal-ipn] [codeigniterpaypalipn], an equivalent library for CodeIgniter users. symfony2-paypal-ipn acts as a listener for the PayPal Instant Payment Notification (IPN) interface, and
uses Doctrine 2.0 to log the received orders to your database.

This library (bundle in Symfony2 language) focuses on the "post-payment" workflow, i.e. the processing required once the
payment has been made and PayPal has posted an Instant Payment Notification call to the IPN controller.

This library handles:

* Validating the IPN call
* Logging the IPN call
* Extracting the order and line item information from the IPN call
* Interpreting PayPal's payment status
* Storing the order and line items in the database

All pre-payment functionality (e.g. posting the checkout information to PayPal) and custom post-payment workflow (e.g.
sending emails) is left as an exercise for the reader. For a much more general-purpose PayPal toolkit for Symfony2, please
see the [JMSPaymentPaypalBundle] [jmspaymentbundle].

## Dependencies

The Symfony PayPal IPN Bundle depends on the PHP framework [Symfony2] [symfony2] and [Doctrine 2.0] [doctrine2.0]. An example order confirmation email built in the [Twig] [twig] templating language is also provided. 

## Installation

### 1. Install and register the bundle

First copy `src/Orderly` from this repository to your project's own `src` directory. The `OrderlyPayPalIpnBundle.php` file
should now be available here: 

    [[Your Symfony2 root]]/src/Orderly/PaypalIpnBundle/OrderlyPayPalIpnBundle.php

Next, we need to register the new bundle. So edit your `AppKernel.php` file:

    [[Your Symfony2 root]]/app/AppKernel.php 

and add the following to the end of the `$bundles` array in the `registerBundles()` method:

    new Orderly\PayPalIpnBundle\OrderlyPayPalIpnBundle()

### 2. Deploy the database tables

To create the MySQL tables required by PayPalIpnBundle, the **recommended** approach is to run the
`create_mysql_tables.sql` SQL file against your database. You can find the file here:

    `src/Orderly/PayPalIpnBundle/Resources/config`

The alternative approach is to install the tables by type the following in your project console:

    php app/console doctrine:schema:update --force

Note that this second method does **not** copy across the table field comments found in the SQL file. 

### 4. Setup routing (suggested fourth step)

To tell the Symfony2 routing system where to find one of our sample controllers, first open up the
following file:

    [[Your Symfony2 root]]/app/config/routing.yml

If you want to send order confirmation emails using Twig, then add in this controller:

    OrderlyPayPalIpnBundleEmail:
        resource: "@OrderlyPayPalIpnBundle/Controller/TwigNotificationEmailController.php"
        type:     annotation
        prefix:   /ipn/

Your site will now be listening for incoming Instant Payment Notifications on the URL:

    http://[[Your domain]]/ipn/ipn-twig-email-notification

Alternatively if you just want to log orders in the database (and not send out any notifications), then add
in this controller:

    OrderlyPayPalIpnBundleNoEmail:
        resource: "@OrderlyPayPalIpnBundle/Controller/NoNotificationController.php"
        type:     annotation
        prefix:   /ipn/

Your site will now be listening for incoming IPNs on:

    http://[[Your domain]]/ipn/ipn-no-notification

**Disclaimer: the sample controllers provided are exactly that - samples. Please update one or other of these
sample files with your own business logic before putting this bundle into production.**

h2. Configuration

bc.. // YAML
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

## Support

For support requests, please contact [Orderly Ltd] [orderlyemail] or raise a [GitHub issue] [newissue].

## Credits

This library is a port from the [Codeigniter PayPal IPN library] [codeigniterpaypalipn] written by [Alex Dean] [alexdean].

The contributors to symfony2-paypal-ipn are as follows:

* Author: [Kemor] [kemor]
* Contributor: [Strife] [strife]
* Contributor: [Alex Dean] [alexdean]

## Disclaimer and warning

Orderly Ltd does not accept any liability for any processing errors made by the Symfony2 PayPal
IPN Bundle, or any financial losses incurred through its use.

In particular, this library does *not* fulfil the PayPal IPN requirement to:

> verify that the payment amount actually matches what you intend to charge. Although not technically
> an IPN issue, if you do not encrypt buttons, it is possible for someone to capture the original
> transmission and change the price. Without this check, you could accept a lesser payment
> than what you expected.

(This verification step is out of scope for this bundle because it would require integration with
your product catalogue.)

Additionally this library does *not* properly handle refunds. Typically refunds are stored as
a new order line in `ipn_orders` with a negative balance, but even this is not 100% predicatable.

## Copyright

symfony2-paypal-ipn is copyright (c) 2012 Orderly Ltd.

## License

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

[codeigniterpaypalipn]: https://github.com/orderly/codeigniter-paypal-ipn
[jmspaymentbundle]: https://github.com/schmittjoh/JMSPaymentPaypalBundle
[symfony2]: http://symfony.com/
[doctrine2.0]: http://www.doctrine-project.org/
[twig]: http://twig.sensiolabs.org/
[orderlyemail]: orderly-support@keplarllp.com
[newissue]: https://github.com/orderly/symfony2-paypal-ipn/issues/new
[kemor]: https://github.com/kemor
[strife]: https://github.com/strife
[alexdean]: https://github.com/alexanderdean