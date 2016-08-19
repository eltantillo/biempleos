<?php
require 'paypal/autoload.php';

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

class PayPal{
	public static function checkout($product, $price){
		$successUrl = 'http://localhost' . Yii::app()->request->baseUrl . '/webService/paypal?success=true';
		$failureUrl = 'http://localhost' . Yii::app()->request->baseUrl . '/webService/paypal?success=false';

		$paypal = new \PayPal\Rest\ApiContext(
		new \PayPal\Auth\OAuthTokenCredential(
			'AR9zeq_hE6dp42MjbG6QARQnlMkCIkGFTsQTTSjJyIgwOvKZiB2yL49L6BSVjqXXuC7SU7GQYN7rz5pB',
			'EF5M7H-oXJD5YyjNyDik4SbS9z5HCUvpRebboAZSjLcIQeqyHwlOE2oigWXr7w3dLykT39mL7TlhM6x9'
			)
		);

		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		$item = new Item();
		$item->setName($product)
		     ->setCurrency('MXN')
		     ->setQuantity(1)
		     ->setPrice($price);

		$itemList = new ItemList();
		$itemList->setItems([$item]);

		$details = new Details();
		$details->setSubtotal($price);z

		$amount = new Amount();
		$amount->setCurrency('MXN')
		       ->setTotal($price)
		       ->setDetails($details);

		$transaction = new Transaction();
		$transaction->setAmount($amount)
		            ->setItemList($itemList)
		            ->setDescription('Pay for Something')
		            ->setInvoiceNumber(uniqid());

		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl($successUrl)
		             ->setCancelUrl($failureUrl);

		$payment = new Payment();
		$payment->setIntent('sale')
		        ->setPayer($payer)
		        ->setRedirectUrls($redirectUrls)
		        ->setTransactions([$transaction]);

		try {
			$payment->create($paypal);
		} catch (Exception $e) {
			die($e);
		}

		$approvalUrl = $payment->getApprovalLink();

		header("Location: {$approvalUrl}");
	}

	public static function process($paymentID, $payerID){
		$paypal = new \PayPal\Rest\ApiContext(
		new \PayPal\Auth\OAuthTokenCredential(
			'AR9zeq_hE6dp42MjbG6QARQnlMkCIkGFTsQTTSjJyIgwOvKZiB2yL49L6BSVjqXXuC7SU7GQYN7rz5pB',
			'EF5M7H-oXJD5YyjNyDik4SbS9z5HCUvpRebboAZSjLcIQeqyHwlOE2oigWXr7w3dLykT39mL7TlhM6x9'
			)
		);

		$payment = Payment::get($paymentID, $paypal);
		$execute = new PaymentExecution();
		$execute->setPayerId($payerID);

		try {
			$result = $payment->execute($execute, $paypal);
		} catch (Exception $e) {
			$data = json_decode($e->getData());
			echo $data->message;
			return false;
		}

		return true;
	}
}
?>