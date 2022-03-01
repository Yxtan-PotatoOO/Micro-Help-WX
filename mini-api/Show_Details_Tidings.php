<?php
include ("connect.php");
include ("imgPrefix.php");

$usrID = $_POST['usrid'];

$sql = "SELECT a.id,a.usrID,a.sendDateTime,a.status,a.tidingsRemarks,a.imgUrl1,a.imgUrl2,a.imgUrl3,b.grade,b.nickName,b.avatarUrl FROM tb_tidings a, tb_users b WHERE a.usrID = b.openID and a.usrID = '$usrID' and b.usrStatus = 0 order by a.sendDateTime DESC";

$result = mysqli_query($conn, $sql);

class tidings{
	public $id;	
	public $usrID;
	public $sendDateTime;
	public $status;
	public $tidingsRemarks;
	public $imgUrl1;
	public $imgUrl2;
	public $imgUrl3;
	public $statusclass;
	public $grade;	
	public $nickName;
	public $avatarUrl;
}

//转换为[]
$data = array();
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$tb_tidings = new tidings();
		$tb_tidings -> id = $row["id"];
		$tb_tidings -> usrID = $row["usrID"];
		$tb_tidings -> sendDateTime = substr($row["sendDateTime"],5);
		$tb_tidings -> status = $row["status"];
		$tb_tidings -> tidingsRemarks = $row["tidingsRemarks"];
		$tb_tidings -> imgUrl1 = $row["imgUrl1"];
		$tb_tidings -> imgUrl2 = $row["imgUrl2"];
		$tb_tidings -> imgUrl3 = $row["imgUrl3"];
		$tb_tidings -> statusclass = $row["status"];
		$tb_tidings -> grade = $row["grade"];
		$tb_tidings -> nickName = $row["nickName"];
		$tb_tidings -> avatarUrl = $avatar_imgPrefix.$row["avatarUrl"];
		if($tb_tidings -> status == 0){
			$tb_tidings -> status = "日常吐槽";
			$tb_tidings -> statusclass = "daily";
		}
		else{
			$tb_tidings -> status = "表白一下";
			$tb_tidings -> statusclass = "love";
		}
		if($tb_tidings -> imgUrl1 != ''){
			$tb_tidings -> imgUrl1 = $tidings_imgPrefix.$row["imgUrl1"];
		}
		if($tb_tidings -> imgUrl2 != ''){
			$tb_tidings -> imgUrl2 = $tidings_imgPrefix.$row["imgUrl2"];
		}
		if($tb_tidings -> imgUrl3 != ''){
			$tb_tidings -> imgUrl3 = $tidings_imgPrefix.$row["imgUrl3"];
		}
		
		$data[] = $tb_tidings;
	}
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
}


mysqli_close($conn);
?>
