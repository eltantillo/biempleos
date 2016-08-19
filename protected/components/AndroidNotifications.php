<?php
class AndroidNotifications{
	public static function send($gcm, $id, $title){
		define( 'API_ACCESS_KEY', 'AIzaSyB9LdyLbYj4xZofwhYiYGaDxD7ikD2NGqg' );
		$registrationIds = array($gcm);

		// prep the bundle
		$msg = array(
			'message'    => 'Boson',
			'title'      => $title,
			'subtitle'   => $id,
			'tickerText' => 'asdasd',
			'vibrate'    => 1,
			'sound'      => 1
		);

		$fields = array
		(
			'registration_ids' => $registrationIds,
			'data'             => $msg
		);

		$headers = array
		(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
	}
}