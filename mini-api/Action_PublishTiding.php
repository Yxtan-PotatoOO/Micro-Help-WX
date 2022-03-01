<?php
$usrID = $_POST['usrid'];
$status = $_POST['status'];
$tidingsRemarks = $_POST['tidingsRemarks'];

include ("connect.php");

$sql = "INSERT INTO tb_tidings(usrID,status,tidingsRemarks,sendDateTime) VALUES ('$usrID','$status','$tidingsRemarks',now())";

class newid{
	public $id;
}

$data = array();
if(mysqli_query($conn,$sql)){
	$check_sql = "SELECT MAX(id) FROM tb_tidings;";
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