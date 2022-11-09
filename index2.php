<?php
/**
 * PHP cURL企业微信群机器人推送消息
 * @$key:群机器人key
 * @$content:推送内容
 * @中午吃啥，肉抄豆芽
 */
 
include('api.php');
function qyWxBot($key,$content){
    // 机器人key
    $webhook = "https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key=".$key;
    // 初始化
    $curl = curl_init();
    // 设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $webhook);
    // 设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 1);
    // 设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // 设置post方式提交
    curl_setopt($curl, CURLOPT_POST, 1);
    // 设置post数据
    // $post_data = '{"msgtype":"text","text":{"content":"hello","mentioned_list":"@all"}}'; // @群里所有人
    $post_data = '{"msgtype":"markdown","markdown":{"content":"'.$content.'"}';// 直接发送消息
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    // 执行命令
    $data = curl_exec($curl);
    // 关闭URL请求
    curl_close($curl);
    // 显示获得的数据
    // print_r($data);
    return $data;
}

// 执行推送
/*$content = "今日**新增用户**反馈<font color='warning'>132例</font>，请相关同事注意。\n
         >类型:<font color='comment'>用户反馈</font>
         >普通用户反馈:<font color='comment'>117例</font>
         >VIP用户反馈:<font color='comment'>15例</font>
         ";
         */
$key = 'fd34d5c6-b6cf-498a-9369-dc16ba44e419';/*中午吃啥，肉炒豆芽*/
$content = qywx_rcdy();
$data = qyWxBot($key,$content);
print_r($data);
?>