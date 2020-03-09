# Magento 2 Reindex From Backend
![Alt text](header.png?raw=true "Magento 2 Reindex From Backend")

This extension will add the ability to Reindex from backend. Magento 2 [Reindex From Backend](https://www.kashyapsoftware.com/reindex-from-backend.html) by Kashyap Software allows store admins to update individual or all indexes manually right from the admin backend easily instead of running command line.

## Installation without composer
* Download zip file of this extension
* Place all the files of the extension in your Magento 2 installation in the folder `app/code/Kashyap/Reindex`
* Enable the extension: `php bin/magento --clear-static-content module:enable Kashyap_Reindex`
* Upgrade db scheme: `php bin/magento setup:upgrade`
* Deply Static Content: `php bin/magento setup:static-content:deploy -f` Developer Mode
* Deply Static Content: `php bin/magento setup:static-content:deploy` Production Mode


---

[![Alt text](https://www.kashyapsoftware.com/pub/media/logo/stores/1/ks_logo.png "kashyapsoftware.com")](https://www.kashyapsoftware.com/)

