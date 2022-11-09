<?php
include('api.php');
$a = wether_fun();
$data =  $a->data;
$weather = $data->weather;//天气
$rain = $data->rain;//是否有雨（0/1）
//判断是否有雨
if($rain==0){
    $content_rain = "今日有雨，请带雨伞！";
}else{
    $content_rain = "今日无雨，么么哒！";
}

/*穿衣指数*/
$index =  $data->index;
$chuangyi = $index->chuangyi;
$content_chuanyi = $chuangyi->content;//穿衣指数

/*大同市气象台预警*/
$alarm = $data->alarm;
$alarm=$alarm[0];
$title_alarm = $alarm->title;
//echo $title_alarm;//预警指数
//print_r($alarm[0]);

$content_qywx = "易校园打卡！\n $content_rain\n$content_chuanyi\n$title_alarm";
//echo $content_chuanyi;
//print_r($a);
?>