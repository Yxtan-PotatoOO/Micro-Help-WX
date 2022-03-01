<?php
include ("connect.php");
$id = $_POST['id'];
$phone = $_POST['phone'];
$result = mysqli_query($conn,"UPDATE tb_Tasks SET recContact = '$phone' WHERE id = $id");
if($result){
	echo "成功";
}else{
	echo "失败";
}
mysqli_close($conn);
?>