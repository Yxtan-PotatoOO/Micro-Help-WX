<?php
include ("connect.php");
$openid = $_GET["openid"];
$check_sql = "SELECT * FROM tb_users WHERE openID = '$openid' AND usrStatus = 0";
$check_result = mysqli_query($conn, $check_sql);
$check_row = mysqli_fetch_assoc($check_result);
if($check_row){
	echo "有";
}else{
	$sql = "SELECT * FROM tb_users WHERE openID = '$openid' AND usrStatus = 1";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if($row){
		echo "账号已封";
	}else{
		echo "无";
	}
}
?>