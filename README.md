# Gateway Fees Plugin for WHMCS

Version: **1.0.2**

This is an open-source fork version of the (Original) Gateway Fees plugin for WHMCS, https://github.com/ajarmoszuk/WHMCS-Gateway-Fees (now closed)

It will allow you to set a percentage fee or a set price fee for payment gateway modules in WHMCS.  In other words you can charge a gateway "convenience fee", or whatever you want to call it.  For example, if your credit card company charges you 3% per transaction, you may wish to pass on x% of that fee back to the customer.  With this module you can do that.  

Bear in mind that in some countries / and / or for some payment providers - "on charging" a fee to the end customer, can be illegal / against the payment processor's terms of service... So you might need to consider that.  Also use this sensibly. If you got a bill with a large "payment fee" on it, would you be happy?  Think of your customers!

To install this addon module, upload the **gateway_fees** directory to **/modules/addons/**.

Go to WHMCS > Setup -> Addon Modules, active and configure price ($ and/or % per transaction).

Your activated payment gateways will be automaticly shown there. You can set fixed fee or/and some percent of the total.

To test it, go to any invoice and change the payment method to one that you have added a fee to.  It should now show the new fee.

NO SUPPORT - USE AS IS 
