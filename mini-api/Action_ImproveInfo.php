<?php
include ("connect.php");
$openid = $_GET["openid"];
$nickName = $_GET["nickName"];
$stuID = $_GET["stuID"];
$grade = $_GET["grade"];
$usrStatus = 0;
$avatarUrl = mt_rand(1,9).".jpg";

$check_sql = "SELECT * FROM tb_users WHERE openID = '$openid'";
$check_result = mysqli_query($conn, $check_sql);
$row = mysqli_fetch_assoc($check_result);
if(!$row){
	$sql = "INSERT INTO tb_users(openID,nickName,stuID,avatarUrl,grade,usrStatus) VALUES ('$openid','$nickName','$stuID','$avatarUrl','$grade','$usrStatus')";
	if(mysqli_query($conn,$sql)){
		echo "成功";
	}else{
		echo "失败";
	}
}
?>