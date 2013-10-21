# Symfony2 PayPal IPN Bundle

## Overview

[symfony2-paypal-ipn](https://github.com/orderly/symfony2-paypal-ipn) is a Symfony2 bundle for working with the PayPal IPN (Instant Payment Notification) service. The bundle acts as a listener for the PayPal IPN service and logs the incoming orders to your database using Doctrine. Sending order confirmation emails is easy too (see the [sample Twig email controller] [twigcontroller] for details).

symfony2-paypal-ipn is available on [Packagist] [packagist] and [KnpBundles] [knpbundles] as well as on GitHub.

## Description

symfony2-paypal-ipn is a direct port of [codeigniter-paypal-ipn] [codeigniterpaypalipn], an equivalent library for CodeIgniter users, also by Orderly Ltd.

This library ("bundle" in Symfony language) focuses on the "post-payment" workflow, i.e. the processing required once the payment has been made and PayPal has posted an Instant Payment Notification call to the IPN controller.

This library handles:

1. Validating the IPN call
2. Logging the IPN call
3. Extracting the order and line item information from the IPN call
4. Interpreting PayPal's payment status
5. Storing the order and line items in the database
6. Dispathing an event so that other bundles can do their stuff

All pre-payment functionality (e.g. posting the checkout information to PayPal) and custom post-payment workflow (e.g. sending emails) is left as an exercise for the reader. If you require a more general-purpose Symfony2 toolkit for working with PayPal, please see the [JMSPaymentPaypalBundle] [jmspaymentbundle].

## Dependencies

The Symfony PayPal IPN Bundle depends on [Symfony2] [symfony2] and [Doctrine 2.0] [doctrine2.0].

An example order confirmation email which uses the [Twig] [twig] templating language is also provided. 

## Installation

### 1. Install from GitHub

We're going to install the PayPalIPNBundle directly into your Symfony `vendor` directory:

```bash
$ cd {{YOUR SYMFONY APP}}/vendor
$ git clone git://github.com/orderly/symfony2-paypal-ipn.git
...
$ mv symfony2-paypal-ipn orderly
```

Now the all-important `OrderlyPayPalIpnBundle.php` file should now be available here: 

    {{YOUR SYMFONY APP}}/vendor/orderly/src/Orderly/PaypalIpnBundle/OrderlyPayPalIpnBundle.php

### 2. Register the bundle

We now need to register the new bundle. Edit your `AppKernel.php` file:

    {{YOUR SYMFONY APP}}/app/AppKernel.php 

and add the following line to the end of the `$bundles` array in the `registerBundles()` method:

    new Orderly\PayPalIpnBundle\OrderlyPayPalIpnBundle(),

Now edit your `autoload.php` file:

    {{YOUR SYMFONY APP}}/app/autoload.php 

and add the following line to the end of your `registerNamespaces()` invocation:

    'Orderly'          => __DIR__.'/../vendor/orderly/src',

### 3. Deploy the database tables
With the PayPalIPN Bundle you have the choice of storing your date in a  rational database like MySQL or to use MongoDB.
The next section provides information on how to use the two different systems.

#### 3.1  Deploy the database tables using ORM (MySQL)
If you're going to use a rational database system like MySQL you have to configure the driver to use a doctrine ORM.
You can achive this by adding the following configuration to your bundles configuration:

```yaml
orderly_pay_pal_ipn:
    # ... Rest of the configuration
    drivers:
        orm:
            object_manager: doctrine.orm.entity_manager
            classes: ~
```

The next step is to update/create the necessary database tables required by PayPalIpnBundle. There are two different ways of deploying the three database tables:

##### Using the Symfony console

You can install the tables with the following command in your project console:

```bash
$ php app/console doctrine:schema:update --force
```

Note that this method does **not** copy across the table field comments found in the SQL file. 

##### Manually running the MySQL script

Alternatively, you can run the `create_mysql_tables.sql` MySQL file against your database. You can find the file here:

    Orderly/PayPalIpnBundle/Resources/config

If you choose this option, you may want to modify the `DEFAULT CHARSET` for each table (currently set to "utf8") before running. 

#### 3.2  Deploy the database tables using ODM (MongoDB)
To use MongoDB for your data store, make sure to install the [DoctrineMongoDBBundle](http://symfony.com/doc/current/bundles/DoctrineMongoDBBundle/index.html) before activating the ODM Driver in your section.
More information on how to configure the bundle can be found on the [Symfony2 website](http://symfony.com/doc/current/bundles/DoctrineMongoDBBundle/index.html).

```yaml
orderly_pay_pal_ipn:
    #....
    drivers:
        odm:
            object_manager: doctrine.odm.mongodb.document_manager
            classes: ~
```
**Note:** A fully configured example can be found under **4.1 Use MongoDB backend**

##### Create the database tables
By running the following command your going to create/update the MonogoDB Collections:

```bash
$ php app/console doctrine:mongodb:update --force
```

### 4. Configure

Now we need to configure the bundle. Add the below into your Symfony2 YAML configuration file `app/config/config.yml`:

```yaml
# PaypalIpnBundle Configuration
orderly_pay_pal_ipn:

    # If set to false then service loads settings with "sandbox_" prefix
    islive:  false

    # Constants for the live environment (default settings in Configuration.php)
    email:   sales@CHANGEME.com
    url:     https://www.paypal.com/cgi-bin/webscr
    debug:   %kernel.debug%

    # Constants for the sandbox environment (default settings in Configuration.php)
    sandbox_email:    system_CHANGEME_biz@CHANGEME.com
    sandbox_url:      https://www.sandbox.paypal.com/cgi-bin/webscr
    sandbox_debug:    true
    sandbox_response: VERIFIED

    drivers:
        orm:
            object_manager: doctrine.orm.entity_manager
            classes: ~
```

Make sure to update the `email` and `sandbox_email` settings to your own PayPal account's.

The value of `sandbox_response` allows you to mock Paypal's response. This is available only when `islive` is set to false. If you don't set its value, your server will hit the Paypal server and most likely return INVALID.

A note on the `debug` setting: if set to true, then PayPalIpnBundle will store the last IPN access which had IPN data (i.e. POST variables) into the database. Then when you access the IPN URL directly without data, it reloads the cached data. So it's effectively a "replay" mode which let's you directly inspect what the `validateIPN()` IPN handler is doing.

#### 4.1 Use MongoDB backend

To use the IPN listener with a MongoDB backend change the drivers section to **odm** and provide the name of your MongoDB object manager. Enclosed is a basic example configuration.

```yaml
# PaypalIpnBundle Configuration
orderly_pay_pal_ipn:

    # If set to false then service loads settings with "sandbox_" prefix
    islive:  false

    # Constants for the live environment (default settings in Configuration.php)
    email:   sales@CHANGEME.com
    url:     https://www.paypal.com/cgi-bin/webscr
    debug:   %kernel.debug%

    # Constants for the sandbox environment (default settings in Configuration.php)
    sandbox_email:    system_CHANGEME_biz@CHANGEME.com
    sandbox_url:      https://www.sandbox.paypal.com/cgi-bin/webscr
    sandbox_debug:    true
    sandbox_response: VERIFIED

    drivers:
        odm:
            object_manager: doctrine.odm.mongodb.document_manager
            classes: ~
```

### 5. Setup routing (optional but recommended)

To tell Symfony's routing system where to find one of our sample controllers, first open up the following file:

    {{YOUR SYMFONY APP}}/app/config/routing.yml

#### To send order confirmations with Twig

Assuming you want to send order confirmation emails using [Twig] [twig], add in this controller:

```yaml
OrderlyPayPalIpnBundleEmail:
    resource: "@OrderlyPayPalIpnBundle/Controller/TwigNotificationEmailController.php"
    type:     annotation
    prefix:   /ipn/
```

Your site will now be listening for incoming Instant Payment Notifications on the URL:

    http://{{YOUR DOMAIN}}/ipn/ipn-twig-email-notification

Note that the sample email template provided depends on Twig's [`number_format`] [numberformat] filter, which was added in December 2012 (you may need to update your Twig version to use this). Don't forget to tell PayPal about your new PayPal IPN URL.


#### To log orders but not send notifications

Alternatively if you just want to log orders in the database (and not send out any notifications), then add in this controller:

```bash
OrderlyPayPalIpnBundleNoEmail:
    resource: "@OrderlyPayPalIpnBundle/Controller/NoNotificationController.php"
    type:     annotation
    prefix:   /ipn/
```

Your site will now be listening for incoming IPNs on:

    http://{{YOUR DOMAIN}}/ipn/ipn-no-notification

Don't forget to tell PayPal about your new PayPal IPN URL.

**Disclaimer: the sample controllers provided are exactly that - samples. Please update one or other of these sample files with your own business logic before putting this bundle into production.**



### 6. Subscribing to events (if you need custom processing)

After an IPN is received and if it is a valid one, an event with the incoming IPN will be dispatched. You can then subscribe a listener and perform whatever you need to do. Change your `config.yml` with something like this:

    services:
        # ...

        paypal_im_received:
            class: Your\OwnBundle\Event\YourPayPalListener
            arguments: ["@doctrine.orm.entity_manager"]
            tags:
                - { name: kernel.event_listener, event: paypal.ipn.receive, method: onIPNReceive }


Now you just need to code your custom listener

    namespace Your\OwnBundle\Event;

    use Orderly\PayPalIpnBundle\Event\PayPalEvent;
    use Doctrine\Common\Persistence\ObjectManager;

    class YourPayPalListener {

        private $om;

        public function __construct(ObjectManager $om) {
            $this->om = $om;
        }

        public function onIPNReceive(PayPalEvent $event) {
            $ipn = $event->getIPN();
            // do your stuff
        }
    }





### 7. Test and troubleshoot

Now it's time to test. First, make sure that `islive` is set to false, and `sandbox_debug` is set to true.

Once debugging is switched on, this is how you test:

* Run through your checkout process as normal, making your PayPal sandbox payment etc
* PayPal will send the IPN POST data to your new PayPal IPN URL
* Check the PayPal IPN history for success or failure (e.g. HTTP status code 500)
* Check you received the order confirmation email (if you're sending one)
* Check the order and line items are stored in your database

If you have problems with any of your checks, then the next step is to manually invoke your IPN URL in a browser and see what happens (for example a PHP or Symfony error, or perhaps a database or Twig not found error). This works because of the debug "replay" functionality explained in step 3 above. Next:

* Fix the bug
* Repeat

### 8. Full configuration

```yaml
# PaypalIpnBundle Configuration
orderly_pay_pal_ipn:

    # If set to false then service loads settings with "sandbox_" prefix
    islive:  false

    # Constants for the live environment (default settings in Configuration.php)
    email:   sales@CHANGEME.com
    url:     https://www.paypal.com/cgi-bin/webscr
    debug:   %kernel.debug%

    # Constants for the sandbox environment (default settings in Configuration.php)
    sandbox_email:    system_CHANGEME_biz@CHANGEME.com
    sandbox_url:      https://www.sandbox.paypal.com/cgi-bin/webscr
    sandbox_debug:    true
    sandbox_response: VERIFIED

    drivers: # Define one driver only.
        orm:
            object_manager: doctrine.orm.entity_manager
            classes:
                ipn_log: Orderly\PayPalIpnBundle\Entity\IpnLog
                ipn_order_items: Orderly\PayPalIpnBundle\Entity\IpnOrderItems
                ipn_orders: Orderly\PayPalIpnBundle\Entity\IpnOrders
        # OR for MongoDB support
        odm:
            object_manager: doctrine.odm.mongodb.document_manager
            classes:
                ipn_log: Orderly\PayPalIpnBundle\Document\IpnLog
                ipn_order_items: Orderly\PayPalIpnBundle\Document\IpnOrderItems
                ipn_orders: Orderly\PayPalIpnBundle\Document\IpnOrders

```

## Support and bugs

For support requests, please email [Orderly Ltd] [orderlyemail]. If you think there is a bug in the library, or a missing feature you would like to see added, please raise a [new GitHub issue] [newissue].

## Credits

This library is a port of the [Codeigniter PayPal IPN library] [codeigniterpaypalipn], also released by Orderly Ltd.

Many thanks to all the contributors to symfony2-paypal-ipn:

* Author: [Kemor] [kemor]
* Contributor: [Strife] [strife]
* Contributor: [Alex Dean] [alexdean]
* Contributor: [Ivo Azirjans] [ivoaz]
* Contributor: [Alexander Pirsig] [piscis]
* Contributor: [Carles Climent] [carlescliment]

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

Additionally this library does **not** properly handle refunds. Typically refunds are stored as
a new order line in `ipn_orders` with a negative balance, but even this is not 100% predicatable.

## Copyright

symfony2-paypal-ipn is copyright (c) 2012 Orderly Ltd.

## License

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at:

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

[codeigniterpaypalipn]: https://github.com/orderly/codeigniter-paypal-ipn
[twigcontroller]: /orderly/symfony2-paypal-ipn/blob/master/src/Orderly/PayPalIpnBundle/Controller/TwigNotificationEmailController.php
[packagist]: http://packagist.org/packages/orderly/paypal-ipn-bundle
[knpbundles]: http://knpbundles.com/orderly/symfony2-paypal-ipn
[jmspaymentbundle]: https://github.com/schmittjoh/JMSPaymentPaypalBundle
[symfony2]: http://symfony.com/
[doctrine2.0]: http://www.doctrine-project.org/
[twig]: http://twig.sensiolabs.org/
[numberformat]: https://github.com/fabpot/Twig/commit/0edcfdd
[orderlyemail]: orderly-support@keplarllp.com
[newissue]: https://github.com/orderly/symfony2-paypal-ipn/issues/new
[kemor]: https://github.com/kemor
[strife]: https://github.com/strife
[alexdean]: https://github.com/alexanderdean
[ivoaz]: https://github.com/ivoaz
[piscis]: https://github.com/piscis
[carlescliment]: https://github.com/carlescliment
