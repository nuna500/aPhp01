<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
</head>
 
 <?php
   $acToken = "Ek0Jo6EYTVLSTeQlCiRe29lu7WZ4BJeG6NprVBCMz4RdB6K2rdCAoc5myPf551x7i6L6OPaTVz744tsqv4h/TNO2xfPJXxMd9fI4J3taNgqFLmwU5IhqBiszasnkt5xEzOUV1ZE4agbtisNhxAofTgdB04t89/1O/w1cDnyilFU=";
   $content = file_get_contents('php://input');
   $arJ = json_decode($content, true);
   $arH = array();
   $arH[] = "Content-Type: application/json";
   $arH[] = "Authorization: Bearer ". $acToken);  
   $message = $arJ['events'][0]['message']['text'];  
   $id = $arJ['events'][0]['source']['userId'];
   if($message == "5"){
       for($i=1;$i<=5;$i++){
          $arP['to'] = $id;
          $arP['messages'][0]['type'] = "text";
          $arP['messages'][0]['text'] = $i;
          pushMsg($arH,$arP);
       }
    }
   function pushMsg($arH,$arP){
      $strUrl = "https://api.line.me/v2/bot/message/push";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arH);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arP));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
   exit;
?>
<body>
 Hello heroku!
</body>
</html>
