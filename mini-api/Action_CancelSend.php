<?php
include ("connect.php");
$id = $_POST['id'];
$result = mysqli_query($conn,"UPDATE tb_Tasks SET sendCancel = '1',sendCancelTime = now(),status = '6' WHERE id = '$id'");
if($result){
	echo "成功";
	$sql = "UPDATE tb_Tasks SET CancelTime = now(),status = '3' WHERE id = '$id' and sendCancel = '1' and recCancel = '1'";
	$update_result = mysqli_query($conn, $sql);
}else{
	echo "失败";
}
mysqli_close($conn);
?>