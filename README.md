# Gateway Fees Plugin for WHMCS

Version: **2.5.1**
Oct23 2022

This is an open-source forked version of the (Original) Gateway Fees plugin for WHMCS, https://github.com/ajarmoszuk/WHMCS-Gateway-Fees (now closed)

It will allow you to set a fee for using a payment gateway module in WHMCS. In other words you can on-charge a gateway "convenience fee", or whatever you want to call it, to your end customer.  For example, if your credit card company charges you 3% per transaction, you may wish to pass on x% of that fee back to the customer.  With this module you can do that.  

Bear in mind that in some countries / and / or for some payment providers (PayPal is one) - "on charging" a fee to the end customer, can be illegal / against the payment processor's terms of service... So you might need to consider that.  Also use this sensibly... this is supposed to help you and be fair to your customers... If you got a bill with a large "payment fee" on it, would you be happy?  Would you pay it?  Think of your customers and use carefully.

Examples of usage:

Go Cardless Direct Debit facility charges you, the WHMCS owner, 1% for each direct debit transaction.  Should you pay this fee for your customer?  Instead, you can set the gateway fee for Go Cardless to be 1% and charge that fee back to your client, afterall, it's their choice to use this facility. 

You can also set the max-fee payable for each gateway - which is useful if you set the fee as a percentage.  In the Go Cardless example, they charge 1% fee to a maximum of $4.  So therefore, you can set the same terms on this module.  Your customer would be charged a 1% convenience fee, and if you set the maximum, at $4 that can be a fair compromise.

Before you use this module on your precious production site - we strongly advise you to install ona development / staging site to test it out.  

To install this addon module, upload the **gateway_fees** directory to **/modules/addons/**.

Go to WHMCS > Setup -> Addon Modules, active and configure. Your activated payment gateways will be shown there. Against each one, you can set fixed fee price $ and/or % per transaction - and also select if you want to add a max fee and if the fee should be taxable.

To test it, go to any invoice and change the payment method to one that you have added a fee to.  It should now show the new fee.
This should work for all newly generated invoices.

NO SUPPORT - USE AS IS.  However, if you do come up with an issue, open a thread in the issues section, or in WHMCS forums, you might get some help there.

Thanks to Dev @leemahoney3 and tester @solaceten for modernising this and keeping it alive.  

If you found it useful, please consider a donation:

https://www.buymeacoffee.com/leemahoney3

https://www.buymeacoffee.com/solaceten


