<?php
include ("connect.php");
$id = $_POST["id"];
$from = $_POST["from"];
$lostedStatus = $_POST["lostedStatus"];
$pickedStatus = $_POST["pickedStatus"];
$idleStatus = $_POST["idleStatus"];
$phone = $_POST["phone"];
$contactID = $_POST["contactID"];

if($from == 'picked'){
	if($pickedStatus=='1' && $phone == '' && $contactID == ''){
		$sql = "UPDATE tb_PickedInfo SET status = '$pickedStatus',comTime = now() WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else if($pickedStatus=='1' && preg_match("/^1[34578]\d{9}$/",$phone) && $phone != '' && $contactID == ''){
		$sql = "UPDATE tb_PickedInfo SET status = '$pickedStatus',comTime = now(),phone = '$phone' WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else if($pickedStatus=='1' && $phone == '' && $contactID != ''){
		$sql = "UPDATE tb_PickedInfo SET status = '$pickedStatus',comTime = now(),contactID = '$contactID' WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else if($pickedStatus=='1' && preg_match("/^1[34578]\d{9}$/",$phone) && $phone != '' && $contactID != ''){
		$sql = "UPDATE tb_PickedInfo SET status = '$pickedStatus',comTime = now(),phone = '$phone',contactID = '$contactID' WHERE id = '$id'";
		mysqli_query($conn,$sql);
		
	}else if($pickedStatus=='0' && preg_match("/^1[34578]\d{9}$/",$phone) && $phone != '' && $contactID == ''){
		$sql = "UPDATE tb_PickedInfo SET phone = '$phone' WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else if($pickedStatus=='0' && $phone == '' && $contactID != ''){
		$sql = "UPDATE tb_PickedInfo SET contactID = '$contactID' WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else if($pickedStatus=='0' && preg_match("/^1[34578]\d{9}$/",$phone) && $phone != '' && $contactID != ''){
		$sql = "UPDATE tb_PickedInfo SET phone = '$phone',contactID = '$contactID' WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else{
		echo "失败";
	}
}else if($from == 'losted'){
	if($lostedStatus=='1' && $phone == '' && $contactID == ''){
		$sql = "UPDATE tb_lostedinfo SET status = '$lostedStatus',comTime = now() WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else if($lostedStatus=='1' && preg_match("/^1[34578]\d{9}$/",$phone) && $phone != '' && $contactID == ''){
		$sql = "UPDATE tb_lostedinfo SET status = '$lostedStatus',comTime = now(),phone = '$phone' WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else if($lostedStatus=='1' && $phone == '' && $contactID != ''){
		$sql = "UPDATE tb_lostedinfo SET status = '$lostedStatus',comTime = now(),contactID = '$contactID' WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else if($lostedStatus=='1' && preg_match("/^1[34578]\d{9}$/",$phone) && $phone != '' && $contactID != ''){
		$sql = "UPDATE tb_lostedinfo SET status = '$lostedStatus',comTime = now(),phone = '$phone',contactID = '$contactID' WHERE id = '$id'";
		mysqli_query($conn,$sql);
		
	}else if($lostedStatus=='0' && preg_match("/^1[34578]\d{9}$/",$phone) && $phone != '' && $contactID == ''){
		$sql = "UPDATE tb_lostedinfo SET phone = '$phone' WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else if($lostedStatus=='0' && $phone == '' && $contactID != ''){
		$sql = "UPDATE tb_lostedinfo SET contactID = '$contactID' WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else if($lostedStatus=='0' && preg_match("/^1[34578]\d{9}$/",$phone) && $phone != '' && $contactID != ''){
		$sql = "UPDATE tb_lostedinfo SET phone = '$phone',contactID = '$contactID' WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else{
		echo "失败";
	}
}else{
	if($idleStatus=='1' && $phone == '' && $contactID == ''){
		$sql = "UPDATE tb_idle SET status = '$idleStatus',comTime = now() WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else if($idleStatus=='1' && preg_match("/^1[34578]\d{9}$/",$phone) && $phone != '' && $contactID == ''){
		$sql = "UPDATE tb_idle SET status = '$idleStatus',comTime = now(),phone = '$phone' WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else if($idleStatus=='1' && $phone == '' && $contactID != ''){
		$sql = "UPDATE tb_idle SET status = '$idleStatus',comTime = now(),contactID = '$contactID' WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else if($idleStatus=='1' && preg_match("/^1[34578]\d{9}$/",$phone) && $phone != '' && $contactID != ''){
		$sql = "UPDATE tb_idle SET status = '$idleStatus',comTime = now(),phone = '$phone',contactID = '$contactID' WHERE id = '$id'";
		mysqli_query($conn,$sql);
		
	}else if($idleStatus=='0' && preg_match("/^1[34578]\d{9}$/",$phone) && $phone != '' && $contactID == ''){
		$sql = "UPDATE tb_idle SET phone = '$phone' WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else if($idleStatus=='0' && $phone == '' && $contactID != ''){
		$sql = "UPDATE tb_idle SET contactID = '$contactID' WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else if($idleStatus=='0' && preg_match("/^1[34578]\d{9}$/",$phone) && $phone != '' && $contactID != ''){
		$sql = "UPDATE tb_idle SET phone = '$phone',contactID = '$contactID' WHERE id = '$id'";
		mysqli_query($conn,$sql);
	}else{
		echo "失败";
	}
}

mysqli_close($conn);
?>