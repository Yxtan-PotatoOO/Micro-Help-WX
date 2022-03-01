<?php
$code = $_GET["code"];
$appid = "wx528329915b1d3db7";
$secret = "797588b4edccc53ab3df4af9c44e1f2f";
$api = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . $appid . '&secret=' . $secret . '&js_code=' . $code . '&grant_type=authorization_code';

$info = file_get_contents($api);
$json = json_decode($info);
$arr = get_object_vars($json);
$openid = $arr['openid'];
echo $openid;
?>