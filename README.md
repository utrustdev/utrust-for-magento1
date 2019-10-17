# Utrust for Magento 1.9

**Demo Store:** https://magento1.store.utrust.com/

Accept Bitcoin, Ethereum, Utrust Token and other cryptocurrencies directly on your store with the Utrust payment gateway for Magento.
Utrust is cryptocurrency agnostic and provides fiat settlements.
The Utrust plugin extends Magento allowing you to take cryptocurrency payments directly on your store via Utrust’s API.
Find out more about Utrust in [utrust.com](https://utrust.com).

# Requirements

- Utrust Merchant account
- Online store in Magento 1.9.x

## Install and Update

### Installing

1. Download our latest release zip file on the [releases page](https://github.com/utrustdev/utrust-for-magento1/releases).
2. Go to your Magento admin dashboard (it should be something like https://<your-store.com>/admin).
3. Navigate to "System" -> "Magento Connect" -> "Magento Connect Manager"
4. Login with the same credentails used for the admin dashboard
5. Go to "Direct package file upload" and upload the zip
6. A success message should appear on the logs on the bottom.

### Updating

You can always check our [releases page](https://github.com/utrustdev/utrust-for-magento1/releases) for a new version. You can update by following the same instructions as installing.

# Setup

### On Utrust side

1. Go to [Utrust merchant dashboard](https://merchants.utrust.com).
2. Log in or sign up if you didn't yet.
3. On the left sidebar choose "Organization".
4. Click the button "Generate Credentials".
5. You will see now your `Client Id` and `Client Secret`, copy them – you will only be able to see the `Client Secret` once, after refreshing or changing page it will be no longer available to copy; if needed, you can always generate new credentials.

Note: It's important that you don't send your credentials to anyone otherwise they can use it to place orders _on your behalf_.

## On Magento side

1. Go to your Magento admin dashboard.
2. Navigate to "System" -> "Configuration".
3. On the left sidebar go to "Sales" section and click on "Payment Methods".
4. Click on "Utrust".
5. Select "Enable".
6. Add your `Client Id` and `Client Secret` and click "Save Config" button on top.
7. Done!

## Features

- Creates Order and redirects to Utrust payment widget
- Receives and handles webhook payment received
- Receives and handles webhook payment cancelled

## Support

You can create [issues](https://github.com/utrustdev/utrust-for-magento1/issues) on our repository. In case of specific problems with your account, please contact support@utrust.com.

# Contributing

We commit all our new features directly into our GitHub repository. But you can also request or suggest new features or code changes yourself!

### Adding code to the repo

If you have a fix or feature, submit a pull request through GitHub to the `dev` branch. The master branch is only for stable releases. Please make sure the new code follows the same style and conventions as already written code.

### Developing

If you want to change the code on our plugin, it's recommended to install it in a local Magento store (using a virtual host) so you can make changes in a controlled environment. Alternatively, you can also do it in a Magento online store that you have for testing/staging.
You can access the module code via FTP in `app/code/local`. All the changes there should be reflected live in the store. You should test things before opening a pull request on this repo.
If something goes wrong with the module, logs can be found in `var/log/utrust.log`.

### Publishing

If you are member of UTRUST devteam and want to publish a new version of the plugin follow these [instructions](https://github.com/utrustdev/utrust-for-magento1/wiki/Publishing).

# License

MIT, check LICENSE file for more info.
