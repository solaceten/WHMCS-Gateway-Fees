<?php

use WHMCS\Billing\Currency;
use WHMCS\Module\GatewaySetting;
use WHMCS\Module\Addon\Setting as AddonSetting;

if (!defined('WHMCS'))  {
	die('This file cannot be accessed directly');
}

function gateway_fees_config() {
	
	$configArray = [
		'name' 			=> 'Gateway Fees for WHMCS',
		'description' 	=> 'Add fees based on the gateway being used.',
		'version' 		=> '1.0.2',
		'author' 		=> 'Open Source',
	];

	$gateways = GatewaySetting::all();

	foreach ($gateways as $gateway) {

		$configArray['fields']["fixed_fee_{$gateway->gateway}"] = [
			'FriendlyName' 	=> $gateway->gateway,
			'Type' 			=> 'text',
			'Default' 		=> '0.00',
			'Description' 	=> Currency::defaultCurrency()->first()->prefix . ' Fee',
		];

		$configArray['fields']["percentage_fee_{$gateway->gateway}"] = [
			'FriendlyName' 	=> $gateway->gateway,
			'Type' 			=> 'text',
			'Default' 		=> '0.00',
			'Description' 	=> '% Fee'
		];

		$configArray['fields']["max_fee_{$gateway->gateway}"] = [
			'FriendlyName'	=> $gateway->gateway,
			'Type'			=> 'text',
			'Default'		=> '0.00',
			'Description'	=> 'Maximum Fee',
		];

		$configArray['fields']["enable_tax_{$gateway->gateway}"] = [
			'FriendlyName' => $gateway->gateway,
			'Type' => 'yesno',
			'Default' => '',
			'Description' => 'Make Fee Taxable<br />',
		];

	}

	return $configArray;

}

?>