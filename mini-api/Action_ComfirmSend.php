<?php
include ("connect.php");
$id = $_POST['id'];
$result = mysqli_query($conn,"UPDATE tb_Tasks SET sendCom = '1',sendComTime = now(),status = '4' WHERE id = '$id'");
if($result){
	echo "成功";
	$sql = "UPDATE tb_Tasks SET completeTime = now(),status = '2' WHERE id = '$id' and sendCom = '1' and recCom = '1'";
	$update_result = mysqli_query($conn, $sql);
}else{
	echo "失败";
}
mysqli_close($conn);
?>