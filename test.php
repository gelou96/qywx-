<?php
 $url = 'https://c.m.163.com/ug/api/wuhan/app/data/list-total';
 $file = file_get_contents($url);
 $result = json_decode($file);
 $china = $result->data->areaTree[2];
 $shanxi = $china->children[29];
 $datong = $shanxi->children[0];
 $name = $datong->name;
 print_r($name)

 ?>