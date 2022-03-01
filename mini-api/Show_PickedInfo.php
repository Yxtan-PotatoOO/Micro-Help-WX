<?php
include ("connect.php");
include ("imgPrefix.php");

$sql = "SELECT a.id,a.usrID,a.sendDateTime,a.status,a.imgUrl1,a.imgUrl2,a.pickedAddress,a.pickedTime,a.pickedRemarks,a.phone,a.contactID,a.comTime,b.grade,b.nickName,b.avatarUrl FROM tb_PickedInfo a, tb_users b WHERE a.usrID = b.openID and a.status=0 order by case when a.status=0 then 1 else 0 end DESC, a.sendDateTime DESC";

$result = mysqli_query($conn, $sql);

class pickedinfo{
	public $id;	
	public $usrID;
	public $sendDateTime;
	public $status;
	public $imgUrl1;
	public $imgUrl2;
	public $pickedAddress;
	public $pickedTime;
	public $pickedRemarks;
	public $phone;
	public $contactID;
	public $comTime;
	public $grade;	
	public $nickName;
	public $avatarUrl;
}

$data = array();
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$tb_pickedinfo = new pickedinfo();
		$tb_pickedinfo -> id = $row["id"];
		$tb_pickedinfo -> usrID = $row["usrID"];
		$tb_pickedinfo -> grade = $row["grade"];
		$tb_pickedinfo -> sendDateTime = substr($row["sendDateTime"],5);
		$tb_pickedinfo -> imgUrl1 = $row["imgUrl1"];
		$tb_pickedinfo -> imgUrl2 = $row["imgUrl2"];
		$tb_pickedinfo -> pickedAddress = $row["pickedAddress"];
		$tb_pickedinfo -> pickedTime = $row["pickedTime"];
		$tb_pickedinfo -> pickedRemarks = $row["pickedRemarks"];
		$tb_pickedinfo -> phone = $row["phone"];
		$tb_pickedinfo -> contactID = $row["contactID"];
		$tb_pickedinfo -> comTime = substr($row["comTime"],5);		
		$tb_pickedinfo -> status = $row["status"];
		$tb_pickedinfo -> nickName = $row["nickName"];
		$tb_pickedinfo -> avatarUrl = $avatar_imgPrefix.$row["avatarUrl"];
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
		if($tb_pickedinfo -> imgUrl1 != ''){
			$tb_pickedinfo -> imgUrl1 = $picked_imgPrefix.$row["imgUrl1"];
		}
		if($tb_pickedinfo -> imgUrl2 != ''){
			$tb_pickedinfo -> imgUrl2 = $picked_imgPrefix.$row["imgUrl2"];
		}

		$data[] = $tb_pickedinfo;
	}
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
}


mysqli_close($conn);
?>
