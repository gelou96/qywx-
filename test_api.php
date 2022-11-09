<?php

$curl = curl_init();
$token = 'fLHz9eHHeuTIeyjT';
$unix_time = time();//当前时间戳
$time = date("Y-m-d-h");
//echo $time;

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://v2.alapi.cn/api/zhihu/news",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "token=$token&id=9716101",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded",
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  print_r($response);
}

?>