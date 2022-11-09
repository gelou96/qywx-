<?php

/*
****大同新冠每日播报
****祝早日结束，么么哒！
*/

	
	$url = 'https://interface.sina.cn/news/wap/fymap2020_data.d.json';
	//$result = get_curl($url);
	
	$file = file_get_contents($url);
	//echo $file;
	$result = $file;
	
	$results = json_decode($result);
	
	$times = $results->data->times;
	
	$datong = $results->data->list[23]->city[5];
	//现存确诊
	$econNum = $datong->econNum;
	//新增本土确诊
	
	print_r($econNum);
	
	/*
	$path = 'xgdata/';
	$file_name = $path.'test.json';
	$text_file = fopen($file_name, "w");
	fwrite($text_file, $result);
	fclose($text_file);
	*/
	
	
	/*
	$file = file_get_contents("xgdata/test.json");
	print_r($file);
	*/





	


?>