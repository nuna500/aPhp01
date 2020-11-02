<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
</head>
 <?php 
	/*Get Data From POST Http Request*/
	$datas = file_get_contents('php://input');
	/*Decode Json From LINE Data Body*/
	$deCode = json_decode($datas,true);
 
	$replyToken = $deCode['events'][0]['replyToken'];
	$userId = $deCode['events'][0]['source']['userId'];
	$text = $deCode['events'][0]['message']['text'];

	$messages = [];
	$messages['replyToken'] = $replyToken;
	$messages['messages'][0] = getFormatTextMessage("เอ้ย ถามอะไรก็ตอบได้");

	$encodeJson = json_encode($messages);

	$LINEDatas['url'] = "https://api.line.me/v2/bot/message/push";
  	$LINEDatas['token'] = "Ek0Jo6EYTVLSTeQlCiRe29lu7WZ4BJeG6NprVBCMz4RdB6K2rdCAoc5myPf551x7i6L6OPaTVz744tsqv4h/TNO2xfPJXxMd9fI4J3taNgqFLmwU5IhqBiszasnkt5xEzOUV1ZE4agbtisNhxAofTgdB04t89/1O/w1cDnyilFU=";

  	$results = sentMessage($encodeJson,$LINEDatas);

	/*Return HTTP Request 200*/
	http_response_code(200);

	function getFormatTextMessage($text)
	{
		$datas = [];
		$datas['type'] = 'text';
		$datas['text'] = $text;

		return $datas;
	}

	function sentMessage($encodeJson,$datas)
	{
		$datasReturn = [];
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $datas['url'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $encodeJson,
		  CURLOPT_HTTPHEADER => array(
		    "authorization: Bearer ".$datas['token'],
		    "cache-control: no-cache",
		    "content-type: application/json; charset=UTF-8",
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		    $datasReturn['result'] = 'E';
		    $datasReturn['message'] = $err;
		} else {
		    if($response == "{}"){
			$datasReturn['result'] = 'S';
			$datasReturn['message'] = 'Success';
		    }else{
			$datasReturn['result'] = 'E';
			$datasReturn['message'] = $response;
		    }
		}

		return $datasReturn;
	}
?>
<body>
 Hello heroku!
</body>
</html>
