<?php
include ("connect.php");
include ("imgPrefix.php");

$usrID = $_POST['usrid'];

$sql = "SELECT a.id,a.usrID,a.status,a.sendIdleDateTime,a.idleTitle,a.idleRemarks,a.idlePrice,a.imgUrl1,a.imgUrl2,a.phone,a.contactID,a.comTime,b.grade,b.nickName,b.avatarUrl FROM tb_idle a, tb_users b WHERE a.usrID = b.openID and a.usrID = '$usrID' and b.usrStatus = 0 order by  case when a.status=0 then 1 else 0 end DESC, a.sendIdleDateTime DESC";

$result = mysqli_query($conn, $sql);

class idle{
	public $id;
	public $usrID;
	public $status;
	public $sendIdleDateTime;
	public $idleTitle;
	public $idleRemarks;
	public $idlePrice;
	public $imgUrl1;
	public $imgUrl2;
	public $phone;
	public $contactID;
	public $comTime;
	public $grade;
	public $nickName;
	public $avatarUrl;
	public $staClass;
}

//转换为[]
$data = array();
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$tb_idle = new idle();
		$tb_idle -> id = $row["id"];
		$tb_idle -> usrID = $row["usrID"];
		$tb_idle -> status = $row["status"];
		$tb_idle -> grade = $row["grade"];
		$tb_idle -> sendIdleDateTime = substr($row["sendIdleDateTime"],5);
		$tb_idle -> idleTitle = $row["idleTitle"];
		$tb_idle -> idleRemarks = $row["idleRemarks"];
		$tb_idle -> idlePrice = $row["idlePrice"];
		$tb_idle -> imgUrl1 = $row["imgUrl1"];
		$tb_idle -> imgUrl2 = $row["imgUrl2"];
		$tb_idle -> phone = $row["phone"];
		$tb_idle -> contactID = $row["contactID"];	
		$tb_idle -> comTime = substr($row["comTime"],5);
		$tb_idle -> nickName = $row["nickName"];
		$tb_idle -> avatarUrl = $avatar_imgPrefix.$row["avatarUrl"];
		if($tb_idle -> phone == NULL){
			$tb_idle -> phone = "";
		}
		if($tb_idle -> contactID == NULL){
			$tb_idle -> contactID = "";			
		}
		if($tb_idle -> status == 0){
			$tb_idle -> status = "未出售";
			$tb_idle -> staClass = '';			
		}else{
			$tb_idle -> status = "已出售";
			$tb_idle -> staClass = 'fin';
		}
		if($tb_idle -> imgUrl1 != ''){
			$tb_idle -> imgUrl1 = $idle_imgPrefix.$row["imgUrl1"];
		}
		if($tb_idle -> imgUrl2 != ''){
			$tb_idle -> imgUrl2 = $idle_imgPrefix.$row["imgUrl2"];
		}
		$data[] = $tb_idle;
	}
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
}


mysqli_close($conn);
?>
