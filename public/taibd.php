<?php

function get_total_balance(){
	try {
		#$ch = curl_init("http://codular.com/curl-with-php");
		$ch = curl_init("http://localhost:3000/merchant/0f24de6a-9aa6-4b81-b606-84f0e92e20c1/balance?password=Itbuiductai_317");
		$result = curl_exec($ch);
		#$result = '{"balance": 18093556}';
		$result = json_decode(str($result), true);
		if(curl_error($ch)){
			echo 'error:' . curl_error($ch);
			return -1;
		}
		curl_close($ch);
		print $result["balance"];
		return $result["balance"];
	}
	catch(Exception $e){
		print "get_total_balance(): " . $e ;
		return -1;
	}
}

function send_money_to_wallet($account, $amount, $db){
	try {
		//extract data from the post
		//set POST variables
		$url = 'http://127.0.0.1:3000/merchant/0f24de6a-9aa6-4b81-b606-84f0e92e20c1/payment';
		$fields = array(
			'password' => "Itbuiductai_317",
			'to' => $account,
			'amount' => $amount,
			'from' => $db
		);
		
		//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		$result = curl_exec($ch);
		
		//result:
		if(curl_error($ch)){
			echo 'error:' . curl_error($ch);
			return false;
		}
		//close connection
		curl_close($ch);
		
		print $result;
		return true;
		
	}catch(Exception $e){
		print "send_money_to_wallet(): " . $e ;
		return false;
	}
}

get_total_balance();
//send_money_to_wallet("135x8NpvX8V4xVMS2Ky6mpyiXLZSmUVbpZ", 293556, 0);
?>
