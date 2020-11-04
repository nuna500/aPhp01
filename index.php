<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
</head>
 <?php

   $accessToken = "Ek0Jo6EYTVLSTeQlCiRe29lu7WZ4BJeG6NprVBCMz4RdB6K2rdCAoc5myPf551x7i6L6OPaTVz744tsqv4h/TNO2xfPJXxMd9fI4J3taNgqFLmwU5IhqBiszasnkt5xEzOUV1ZE4agbtisNhxAofTgdB04t89/1O/w1cDnyilFU=";
  // $content = file_get_contents('php://input');
   //$arrayJson = json_decode($content, true);
   $arrayHeader = array();
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";
   //รับข้อความจากผู้ใช้
   //$message = $arrayJson['events'][0]['message']['text'];
   //รับ id ของผู้ใช้
   $id = "Ue1799a5aaf2dc3e089e6bd93c4428dd8";
 
   //if($message == "สวัสดี"){
      $arrayPostData['to'] = $id;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = $_POST['text'];
      //$arrayPostData['messages'][1]['type'] = "sticker";
      //$arrayPostData['messages'][1]['packageId'] = "2";
     // $arrayPostData['messages'][1]['stickerId'] = "34";
      pushMsg($arrayHeader,$arrayPostData);
   //}
   function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
   exit;
?>
<body> 
</body>
</html>
