<?php
	$elasticSearch = getenv('ELASTIC_SEARCH');
?>

<?php
	// $data = array('key1' => 'value1', 'key2' => 'value2');
	// use key 'http' even if you send the request to https://...
	$options = array(
		'http' => array(
//	        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'GET' //,
	//        'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($elasticSearch, false, $context);
	if ($result === FALSE) {
		echo 'error';
	} else {
		// echo $result;
		$someObject = json_decode($result);
		// var_dump( $someObject );
		echo $someObject->version->number;
		echo isset($someObject->name2) ? $someObject->name2 : 'pnf';
		var_dump($http_response_header);
	}
?>

<hr>

<?php
	$url  = $elasticSearch;
	//$data = ['key' => 'value'];
	$ch   = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	//curl_setopt($ch, CURLOPT_GET, 1);
	//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	$result = curl_exec($ch);
	if ($result === FALSE) {
		echo 'error';
	}
	echo $result;
	var_dump($http_response_header);
	
	curl_close($ch);
?>
