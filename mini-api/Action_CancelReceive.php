<?php
include ("connect.php");
$id = $_POST['id'];
$result = mysqli_query($conn,"UPDATE tb_Tasks SET recCancel = '1',recCancelTime = now(),status = '7' WHERE id = '$id'");
if($result){
	echo "成功";
	$sql = "UPDATE tb_Tasks SET CancelTime = now(),status = '3' WHERE id = '$id' and sendCancel = '1' and recCancel = '1'";
	$update_result = mysqli_query($conn, $sql);
}else{
	echo "失败";
}
mysqli_close($conn);
?>