<?php
$host_name = "localhost";
$db_usrname = ""; // 数据库用户名
$db_pwd = ""; // 数据库密码
$db_name = ""; // 数据库名

$conn = mysqli_connect($host_name, $db_usrname, $db_pwd, $db_name)or trigger_error(mysqli_error(),E_USER_ERROR);

// mysqli_query($conn, "set names utf8");

if(!$conn){
	echo "MySQL数据库连接失败！";
}

?>
