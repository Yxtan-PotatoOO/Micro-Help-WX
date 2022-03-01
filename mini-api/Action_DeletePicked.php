<?php
include ("connect.php");
$id = $_POST['id'];
$result = mysqli_query($conn,"DELETE FROM tb_pickedinfo WHERE id = $id");
if($result){
	echo "成功";
}else{
	echo "失败";
}
mysqli_close($conn);
?>