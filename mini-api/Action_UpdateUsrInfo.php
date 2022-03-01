<?php
include ("connect.php");
$openid = $_POST["usrid"];
$nickName = $_POST["nickName"];

if($nickName == ''){
}else{
	$sql = "UPDATE tb_users SET nickName = '$nickName' WHERE openID = '$openid'";
	$result = mysqli_query($conn, $sql);
	if($result){
		echo "成功";
	}else{
		echo "失败";
	}
}

mysqli_close($conn);
?>