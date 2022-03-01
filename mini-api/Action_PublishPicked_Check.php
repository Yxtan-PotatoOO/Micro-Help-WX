<?php
include('connect.php');
$id = $_POST['id'];
$check_sql = "SELECT id FROM tb_pickedinfo WHERE id=$id";
$check_result = mysqli_query($conn,$check_sql);
$check_array = mysqli_fetch_array($check_result);

if($check_array['id'] == NULL){
	echo "失败";
}else{
	echo "成功";
}
?>