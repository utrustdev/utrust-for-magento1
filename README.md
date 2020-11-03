![Utrust integrations](https://user-images.githubusercontent.com/1558992/67495646-1e356b00-f673-11e9-8854-1beac877c586.png)

# Utrust for Magento 1.9

**Demo Store:** https://magento1.store.utrust.com/

Accept Bitcoin, Ethereum, Utrust Token and other cryptocurrencies directly on your store with the Utrust payment gateway for Magento.
Utrust is cryptocurrency agnostic and provides fiat settlements.
The Utrust plugin extends Magento allowing you to take cryptocurrency payments directly on your store via the Utrust API.
Find out more about Utrust at [utrust.com](https://utrust.com).

## Requirements

- Utrust Merchant account
- Online store in Magento 1.9.x

## Install and Update

### Install automatically

Go to the [Utrust Payment extension page](https://marketplace.magento.com/utrust-utrust-payment.html) on Magento's marketplace and follow the usual process of [adding an extension to your store](https://docs.magento.com/m2/ee/user_guide/magento/magento-marketplace.html).

### Install manually

1. Download our latest release zip file on the [releases page](https://github.com/utrustdev/utrust-for-magento1/releases).
2. Go to your Magento admin dashboard (it should be something like https://<your-store.com>/admin).
3. Navigate to _System_ -> _Magento Connect_ -> _Magento Connect Manager_
4. Login with the same credentails used for the admin dashboard
5. Go to _Direct package file upload_ and upload the zip
6. A success message should appear on the logs on the bottom.

### Updating manually

You can always check our [releases page](https://github.com/utrustdev/utrust-for-magento1/releases) for a new version. You can update by following the same instructions as installing.

## Setup

### On the Utrust side

1. Go to [Utrust merchant dashboard](https://merchants.utrust.com).
2. Log in or sign up if you didn't yet.
3. On the left sidebar choose _Integrations_.
4. Select _Magento 1_ and click the button _Generate Credentials_.
5. You will see now your `Api Key` and `Webhook Secret`, save them somewhere safe temporarily.

   :warning: You will only be able to see the `Webhook Secret` once, after refreshing or changing page it will be no longer available to copy; if needed, you can always generate new credentials.

   :no_entry_sign: Don't share your credentials with anyone. They can use it to place orders **on your behalf**.

### On the Magento side

1. Go to your Magento admin dashboard.
2. Navigate to _System_ -> _Configuration_.
3. On the left sidebar go to _Sales_ section and click on _Payment Methods_.
4. Click on _Utrust_.
5. Select _Enable_.
6. Add your `Api Key` and `Webhook Secret` and click _Save Config_ button on top.
7. Done!

## Features

:sparkles: These are the features already implemented and planned for the Utrust for Magento 1 plugin:

- [x] Creates Order and redirects to Utrust payment widget
- [x] Receives and handles webhook payment received
- [x] Receives and handles webhook payment cancelled
- [ ] Starts automatic refund on Utrust when refund initiated in Magento

## Support

Feel free to reach [by opening an issue on GitHub](https://github.com/utrustdev/utrust-for-magento1/issues/new) if you need any help with the Utrust for Magento 1 plugin.

If you're having specific problems with your account, then please contact support@utrust.com.

In both cases, our team will be happy to help :purple_heart:.

## Contribute

This plugin was initially written by a third-party contractor (Moisés Sequeira from [CloudInfo](https://cloudinfo.pt/)), and is now maintained by the Utrust development team.

We have now opened it to the world so that the community using this plugin may have the chance of shaping its development.

You can contribute by simply letting us know your suggestions or any problems that you find [by opening an issue on GitHub](https://github.com/utrustdev/utrust-for-magento1/issues/new).

You can also fork the repository on GitHub and open a pull request for the `master` branch with your missing features and/or bug fixes.
Please make sure the new code follows the same style and conventions as already written code.
Our team is eager to welcome new contributors into the mix :blush:.

### Development

If you want to get your hands dirty and make your own changes to the Utrust for Magento plugin, we recommend you to install it in a local Magento store (either directly on your computer or using a virtual host) so you can make the changes in a controlled environment.
Alternatively, you can also do it in a Magento online store that you have for testing/staging.

Once the plugin is installed in your store, the source code should be in `app/code/local`. All the changes there should be reflected live in the store.
If something goes wrong with the module, logs can be found in `var/log/utrust.log`.

## Publishing

For now only members of the Utrust development team can publish new versions of the Utrust for Magento 1 plugin.

To publish a new version, simply follow [these instructions](https://github.com/utrustdev/utrust-for-magento1/wiki/Publishing).

## License

The Utrust for Magento 1 plugin is maintained with :purple_heart: by the Utrust development team, and is available to the public under the GNU GPLv3 license. Please see [LICENSE](https://github.com/utrustdev/magento1/blob/master/LICENSE) for further details.

&copy; Utrust 2019
