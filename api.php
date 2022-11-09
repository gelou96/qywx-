<?php
//include(".php");
/**
始于2022-03-04
author:xgelou

**/

//天气api
function api_weather(){
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://v2.alapi.cn/api/tianqi",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "token=fLHz9eHHeuTIeyjT&city=大同&city_id=101100201&ip=183.203.130.164&lon=&lat=&province=",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/x-www-form-urlencoded",
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      $result =  "error";
    } else {
      $result = $response;
    }
    return $result;
}

//处理天气json数据
function wether_fun(){
    $data = api_weather();
    if ($data=='error'){
        $result = '系统错误';
    }else{
        $result = json_decode($data);
        //$result = var_dump(json_decode($result,true));
        
    }
    return $result;
}

//大同新冠现存确诊
function xg_datong(){
    //新浪
    $url = 'https://interface.sina.cn/news/wap/fymap2020_data.d.json';
    $file = file_get_contents($url);
    $result = $file;
	$results = json_decode($result);
	$times = $results->data->times;
	$datong = $results->data->list[23]->city[5];
	//现存确诊
	$econNum = $datong->econNum;
	$xg_datong = $times.',大同市现存确诊：'.$econNum.'例，抗疫必胜（新浪数据）。';
	return $xg_datong;
}
//大同新冠新增本土无症状
function xg_qz(){
    $url = 'https://c.m.163.com/ug/api/wuhan/app/data/list-total';
    $file = file_get_contents($url);
    $result = json_decode($file);
    $china = $result->data->areaTree[2];
    $shanxi = $china->children[29];
    $datong = $shanxi->children[0];
    $confirm = $datong->today->confirm;//新增本土无症状
    $name = $datong->name;//更新城市名称
    $lastUpdateTime = $datong->lastUpdateTime;//更新时间
    $xg_qz = '截止'.$lastUpdateTime.',【'.$name.'市】'.'新增本土无症状：'.$confirm.'例(136数据)。';
    return $xg_qz;
}


//企业微信数据//固体所
function qywx_hykj(){
    $a = wether_fun();
    $data =  $a->data;
    $update_time = $data->update_time;//更新时间
    $weather = $data->weather;//天气
    $rain = $data->rain;//是否有雨的概率（0-1）
    //判断是否有雨
    if($rain>0.5){
        $content_rain = "今日天气：".$weather."；下雨概率：".$rain."；建议带雨伞！（".$update_time."）";
    }else{
        $content_rain = "今日天气：".$weather."，么么哒！（更新于".$update_time."）";
    }
    
    /*穿衣指数*/
    $index =  $data->index;
    $chuangyi = $index->chuangyi;
    $content_chuanyi = $chuangyi->content;//穿衣指数
    if($content_chuanyi==''){
        $content_chuanyi = "今日暂无穿衣推荐";
    }else{
        $content_chuanyi =$content_chuanyi;
    }
    /*大同市气象台预警*/
    $alarm = $data->alarm;
    $alarm=$alarm[0];
    $content_qxyj = $alarm->title;
    if($content_qxyj==''){
        $content_qxyj = "今日暂无【大同市】气象预警";
    }else{
        $content_qxyj = $content_qxyj;
    }
    //echo $title_alarm;//预警指数
    //print_r($alarm[0]);
    $content_dtxg = xg_datong();
    $xg_qz = xg_qz();
    $n = '\n';
    //$tip = '温小杰提醒您：';
    /*
    $content_qywx = '**易校园打卡！**'.$n.
                    "<font color='warning'>".$content_dtxg."</font>".$n.
                    '————————————'.$n.
                    "<font color='warning'>".$xg_qz."</font>".$n.
                    '>'.$content_rain.$n.
                    '————————————'.$n.
                    "><font color='comment'>".$content_chuanyi."</font>";*/
    $content_qywx = '**易校园打卡！**'.$n.
                    "<font color='warning'>".$content_dtxg."</font>".$n.
                    '————————————'.$n.
                    '>'.$content_rain.$n.
                    '————————————'.$n.
                    "><font color='comment'>".$content_chuanyi."</font>".
                    '————————————'.$n.
                    "><font color='comment'>".$content_qxyj."</font>";
    return $content_qywx;
}
//企业微信数据//班级群
function qywx_rcdy(){
    $a = wether_fun();
    $data =  $a->data;
    $update_time = $data->update_time;//更新时间
    $weather = $data->weather;//天气
    $rain = $data->rain;//是否有雨的概率（0-1）
    //判断是否有雨
    if($rain>0.5){
        $content_rain = "今日天气：".$weather."；下雨概率：".$rain."；建议带雨伞！（".$update_time."）";
    }else{
        $content_rain = "今日天气：".$weather."，么么哒！（更新于".$update_time."）";
    }
    
    /*穿衣指数*/
    $index =  $data->index;
    $chuangyi = $index->chuangyi;
    $content_chuanyi = $chuangyi->content;//穿衣指数
    if($content_chuanyi==''){
        $content_chuanyi = "今日暂无穿衣推荐";
    }else{
        $content_chuanyi =$content_chuanyi;
    }
    /*大同市气象台预警*/
    $alarm = $data->alarm;
    $alarm=$alarm[0];
    $content_qxyj = $alarm->title;
    if($content_qxyj==''){
        $content_qxyj = "今日暂无【大同市】气象预警";
    }else{
        $content_qxyj = $content_qxyj;
    }
    //echo $title_alarm;//预警指数
    //print_r($alarm[0]);
    
    $n = '\n';
    $content_dtxg = xg_datong();
    $xg_qz = xg_qz();
    //$tip = '白小丽提醒您：';
    $content_qywx = '**易校园打卡！**'.$n.
                    "<font color='warning'>".$content_dtxg."</font>".$n.
                    '————————————'.$n.
                    "<font color='warning'>".$content_rain."</font>".$n.
                    '>'.$content_chuanyi.$n.
                    '————————————'.$n.
                    "><font color='comment'>".$content_qxyj."</font>";
    return $content_qywx;
}
?>