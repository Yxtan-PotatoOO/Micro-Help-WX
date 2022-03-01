<?php
include ("connect.php");
$id = $_POST['id'];
$result = mysqli_query($conn,"UPDATE tb_Tasks SET delSend = 1 WHERE id = $id");
if($result){
	echo "成功";
}else{
	echo "失败";
}
mysqli_close($conn);
?>