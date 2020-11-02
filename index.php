<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
</head>
 <?php
   $LINEData = file_get_contents('php://input');
  $jsonData = json_decode($LINEData,true);

  $replyToken = $jsonData["events"][0]["replyToken"];
  $userID = $jsonData["events"][0]["source"]["userId"];
  $replyText="GG";
  function sendMessage($replyJson, $sendInfo){
          $ch = curl_init($sendInfo["URL"]);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLINFO_HEADER_OUT, true);
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
              'Content-Type: application/json',
              'Authorization: Bearer ' . $sendInfo["AccessToken"])
              );
          curl_setopt($ch, CURLOPT_POSTFIELDS, $replyJson);
          $result = curl_exec($ch);
          curl_close($ch);
    return $result;
  }

  
  $lineData['URL'] = "https://api.line.me/v2/bot/message/reply";
  $lineData['AccessToken'] = "Ek0Jo6EYTVLSTeQlCiRe29lu7WZ4BJeG6NprVBCMz4RdB6K2rdCAoc5myPf551x7i6L6OPaTVz744tsqv4h/TNO2xfPJXxMd9fI4J3taNgqFLmwU5IhqBiszasnkt5xEzOUV1ZE4agbtisNhxAofTgdB04t89/1O/w1cDnyilFU=";
  $replyJson = [];
  $replyJson["replyToken"] = $replyToken;
  $replyJson["messages"][0] = $replyText;

  $encodeJson = json_encode($replyJson);

  $results = sendMessage($encodeJson,$lineData);
  echo $results;
  http_response_code(200); 
?>
<body>
 Hello heroku!
</body>
</html>
