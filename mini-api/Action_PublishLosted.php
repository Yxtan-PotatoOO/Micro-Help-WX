<?php
$usrID = $_POST['usrid'];
$status = '0';
$lostedAddress = $_POST['lostedAddress'];
$lostedTime = $_POST['lostedTime'];
$lostedRemarks = $_POST['lostedRemarks'];
$phone = $_POST['phone'];
$contactID = $_POST['contactID'];

include ("connect.php");

$sql = "INSERT INTO tb_lostedinfo(usrID,status,lostedAddress,lostedTime,lostedRemarks,sendDateTime,phone,contactID) VALUES ('$usrID','$status','$lostedAddress','$lostedTime','$lostedRemarks',now(),'$phone','$contactID')";

class newid{
	public $id;
}

$data = array();
if(mysqli_query($conn,$sql)){
	$check_sql = "SELECT MAX(id) FROM tb_lostedinfo;";
	$result = mysqli_query($conn,$check_sql);
	$row = mysqli_fetch_row($result);
	if (mysqli_num_rows($result) > 0) {
		$new_id = new newid();
		$new_id -> id = $row;
		$data[] = $new_id;
	}
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
} 

mysqli_close($conn);
?>