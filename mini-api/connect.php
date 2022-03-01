<?php
$host_name = "localhost";
$db_usrname = "sql_127_0_0_1";
$db_pwd = "mRXZy5R5PfeNz6DB";
$db_name = "sql_127_0_0_1";

$conn = mysqli_connect($host_name, $db_usrname, $db_pwd, $db_name)or trigger_error(mysqli_error(),E_USER_ERROR);

// mysqli_query($conn, "set names utf8");

if(!$conn){
	echo "MySQL数据库连接失败！";
}

?>
