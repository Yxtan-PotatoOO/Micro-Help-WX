<?php
$code = $_GET["code"];
$appid = ""; // 自己的微信
$secret = ""; // 自己的微信
$api = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . $appid . '&secret=' . $secret . '&js_code=' . $code . '&grant_type=authorization_code';

$info = file_get_contents($api);
$json = json_decode($info);
$arr = get_object_vars($json);
$openid = $arr['openid'];
echo $openid;
?>