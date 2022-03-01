<?php
include ("connect.php");
$id = $_POST["id"];
$from = $_POST["from"];

class pickedinfo{
	public $id;	
	public $status;
	public $phone;
	public $contactID;
}
class lostedinfo{
	public $id;	
	public $status;
	public $phone;
	public $contactID;
}
class idle{
	public $id;	
	public $status;
	public $phone;
	public $contactID;
}

if($from == 'picked'){
	$sql = "SELECT * FROM tb_PickedInfo WHERE id = '$id'";
	$result = mysqli_query($conn, $sql);
	$data = array();
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$tb_pickedinfo = new pickedinfo();
			$tb_pickedinfo -> id = $row["id"];
			$tb_pickedinfo -> phone = $row["phone"];
			$tb_pickedinfo -> contactID = $row["contactID"];
			$tb_pickedinfo -> status = $row["status"];
			if($tb_pickedinfo -> status == 0){
				$tb_pickedinfo -> status = "待领取";
			}
			else{
				$tb_pickedinfo -> status = "已归还";
			}
			
			if($tb_pickedinfo -> phone == NULL){
				$tb_pickedinfo -> phone = "";
			}
			if($tb_pickedinfo -> contactID == NULL){
				$tb_pickedinfo -> contactID = "";
			}
			$data[] = $tb_pickedinfo;
		}
		echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	}

}else if($from == 'losted'){
	$sql = "SELECT * FROM tb_LostedInfo WHERE id = '$id'";
	$result = mysqli_query($conn, $sql);
	$data = array();
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$tb_lostedinfo = new lostedinfo();
			$tb_lostedinfo -> id = $row["id"];
			$tb_lostedinfo -> phone = $row["phone"];
			$tb_lostedinfo -> contactID = $row["contactID"];
			$tb_lostedinfo -> status = $row["status"];
			if($tb_lostedinfo -> status == 0){
				$tb_lostedinfo -> status = "寻找中";
			}
			else{
				$tb_lostedinfo -> status = "已找回";
			}
			
			if($tb_lostedinfo -> phone == NULL){
				$tb_lostedinfo -> phone = "";
			}
			if($tb_lostedinfo -> contactID == NULL){
				$tb_lostedinfo -> contactID = "";
			}
			$data[] = $tb_lostedinfo;
		}
		echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	}
	
}else{
	$sql = "SELECT * FROM tb_idle WHERE id = '$id'";
	$result = mysqli_query($conn, $sql);
	$data = array();
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$tb_idle = new idle();
			$tb_idle -> id = $row["id"];
			$tb_idle -> phone = $row["phone"];
			$tb_idle -> contactID = $row["contactID"];
			$tb_idle -> status = $row["status"];
			if($tb_idle -> status == 0){
				$tb_idle -> status = "未出售";
			}
			else{
				$tb_idle -> status = "已出售";
			}
			
			if($tb_idle -> phone == NULL){
				$tb_idle -> phone = "";
			}
			if($tb_idle -> contactID == NULL){
				$tb_idle -> contactID = "";
			}
			$data[] = $tb_idle;
		}
		echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	}
}

mysqli_close($conn);
?>