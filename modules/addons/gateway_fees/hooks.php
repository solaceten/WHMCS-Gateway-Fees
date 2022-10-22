<?php

use WHMCS\Session;
use WHMCS\User\Client;
use WHMCS\Billing\Invoice;
use WHMCS\Billing\Currency;
use WHMCS\Module\GatewaySetting;
use WHMCS\Billing\Invoice\Item as InvoiceItem;
use WHMCS\Module\Addon\Setting as AddonSetting;

function invoiceCreatedAdmin($vars) {

    $invoiceId = $vars['invoiceid'];

    updateInvoiceTotal($invoiceId);

}

function invoiceCreated($vars) {

    $invoiceId = $vars['invoiceid'];

    $invoice = Invoice::where('id', $invoiceId)->first();

    invoiceGatewayChange([
        'invoiceid'     => $invoice->id,
        'paymentmethod' => $invoice->paymentmethod,
    ]);

} 

function invoiceGatewayChange($vars) {

    $invoiceId      = $vars['invoiceid'];
    $paymentMethod  = $vars['paymentmethod'];

    

    InvoiceItem::where(['invoiceid' => $invoiceId, 'notes' => 'gateway_fees'])->delete();

    $fees = [];

    $gatewayFees = AddonSetting::where('module', "gateway_fees")->get();
   
    $taxable = false;
    $fee1 = $fee2 = $maxFee = 0;
    

    foreach ($gatewayFees as $fee) {
        if ($fee->setting == "fixed_fee_{$paymentMethod}") {
            $fee1 = $fee->value;
        }

        if ($fee->setting == "percentage_fee_{$paymentMethod}") {
            $fee2 = $fee->value;
        }

        if ($fee->setting == "max_fee_{$paymentMethod}") {
            $maxFee = $fee->value;
        }

        if ($fee->setting == "enable_tax_{$paymentMethod}") {
            $taxable = $fee->value;
        }

    }

    $invoiceData = localAPI('GetInvoice', ['invoiceid' => $invoiceId]);

    $total = $invoiceData['total'];

    if ($total > 0) {
        
        if ($maxFee != 0 && $maxFee < ($fee1 + $total * $fee2 / 100)) {

            $d          = Currency::defaultCurrency()->first()->prefix . number_format($maxFee, 2);
            $amountDue  = $maxFee;
            

        } else {

            $amountDue = $fee1 + $total * $fee2 / 100;

            if ($fee1 > 0 & $fee2 > 0) {
                $d = Currency::defaultCurrency()->first()->prefix . number_format($fee1, 2) . " + {$fee2}%";
            } else if ($fee2 > 0) {
                $d = "{$fee2}%";
            } else if ($fee1 > 0) {
                $d = number_format($fee1, 2);
            }
        
        }

    }

    if ($d) {

        InvoiceItem::insert([
            'userid'        => Session::get('uid'),
            'invoiceid'     => $invoiceId,
            'type'          => 'Fee',
            'notes'         => 'gateway_fees',
            'description'   => GatewaySetting::where(['gateway' => $paymentMethod, 'setting' => 'name'])->first()->value . " Fees ({$d})",
            'amount'        => $amountDue,
            'taxed'         => $taxable == 'on' ? '1' : '0',
            'duedate'       => date('Y-m-d H:i:s'),
            'paymentmethod' => $paymentMethod,
        ]);

    }

    updateInvoiceTotal($invoiceId);

}

add_hook("InvoiceCreated", 1, "invoiceCreated");
add_hook("InvoiceChangeGateway", 1, "invoiceGatewayChange");

add_hook("AdminInvoicesControlsOutput", 1, "invoiceCreated");
add_hook("AdminInvoicesControlsOutput", 2, "invoiceCreatedAdmin");

add_hook("InvoiceCreationAdminArea", 1, "invoiceCreated");
add_hook("InvoiceCreationAdminArea", 2, "invoiceCreatedAdmin");

?>
