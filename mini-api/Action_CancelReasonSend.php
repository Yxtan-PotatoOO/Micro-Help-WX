<?php
include ("connect.php");
$id = $_POST['id'];
$comment = $_POST['comment'];
$result = mysqli_query($conn,"UPDATE tb_Tasks SET sendCancelTime = now(),sendCancelReason = '$comment' WHERE id = '$id'");
if($result){
	echo "成功";
}else{
	echo "失败";
}
mysqli_close($conn);
?>