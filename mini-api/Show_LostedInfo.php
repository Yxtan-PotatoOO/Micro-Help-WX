<?php
include ("connect.php");
include ("imgPrefix.php");

$sql = "SELECT a.id,a.usrID,a.sendDateTime,a.status,a.imgUrl1,a.imgUrl2,a.lostedAddress,a.lostedTime,a.lostedRemarks,a.phone,a.contactID,a.comTime,b.grade,b.nickName,b.avatarUrl FROM tb_LostedInfo a, tb_users b WHERE a.usrID = b.openID and a.status=0 order by a.sendDateTime DESC";

$result = mysqli_query($conn, $sql);

class lostedinfo{
	public $id;	
	public $usrID;
	public $sendDateTime;
	public $status;
	public $imgUrl1;
	public $imgUrl2;
	public $lostedAddress;
	public $lostedTime;
	public $lostedRemarks;
	public $phone;
	public $contactID;
	public $comTime;	
	public $grade;
	public $nickName;
	public $avatarUrl;
}

//转换为[]
$data = array();
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$tb_lostedinfo = new lostedinfo();
		$tb_lostedinfo -> id = $row["id"];
		$tb_lostedinfo -> usrID = $row["usrID"];
		$tb_lostedinfo -> grade = $row["grade"];
		$tb_lostedinfo -> sendDateTime = substr($row["sendDateTime"],5);
		$tb_lostedinfo -> imgUrl1 = $row["imgUrl1"];
		$tb_lostedinfo -> imgUrl2 = $row["imgUrl2"];
		$tb_lostedinfo -> lostedAddress = $row["lostedAddress"];
		$tb_lostedinfo -> lostedTime = $row["lostedTime"];
		$tb_lostedinfo -> lostedRemarks = $row["lostedRemarks"];
		$tb_lostedinfo -> phone = $row["phone"];
		$tb_lostedinfo -> contactID = $row["contactID"];
		$tb_lostedinfo -> comTime = substr($row["comTime"],5);		
		$tb_lostedinfo -> status = $row["status"];
		$tb_lostedinfo -> nickName = $row["nickName"];
		$tb_lostedinfo -> avatarUrl = $avatar_imgPrefix.$row["avatarUrl"];
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
		if($tb_lostedinfo -> imgUrl1 != ''){
			$tb_lostedinfo -> imgUrl1 = $losted_imgPrefix.$row["imgUrl1"];
		}
		if($tb_lostedinfo -> imgUrl2 != ''){
			$tb_lostedinfo -> imgUrl2 = $losted_imgPrefix.$row["imgUrl2"];
		}
		$data[] = $tb_lostedinfo;
	}
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
}


mysqli_close($conn);
?>
