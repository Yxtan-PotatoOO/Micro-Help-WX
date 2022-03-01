<?php
include ("connect.php");
include ("imgPrefix.php");

$usrID = $_POST['usrid'];

$sql = "SELECT a.id,a.usrID,a.sendTasksDateTime,a.status,a.taskTitle,a.taskNum,a.taskPrice,a.taskTakeAddress,a.taskToAddress,a.taskRemarks,a.phone,a.contactID,a.recID,a.recDateTime,a.sendCom,a.recCom,a.completeTime,b.grade,b.nickName,b.avatarUrl FROM tb_tasks a, tb_users b WHERE a.usrID = b.openID and a.usrID = '$usrID' and b.usrStatus = 0 and a.delSend != '1' order by case when a.status=1 then 1 else 0 end DESC,case when a.status=0 then 1 else 0 end DESC, a.sendTasksDateTime DESC";

$result = mysqli_query($conn, $sql);

class tasks{
	public $id;
	public $usrID;
	public $sendTasksDateTime;
	public $status;
	public $taskTitle;
	public $taskNum;
	public $taskPrice;
	public $taskTakeAddress;
	public $taskToAddress;
	public $taskRemarks;
	public $phone;
	public $contactID;
	public $recID;
	public $recDateTime;
	public $sendCom;
	public $recCom;
	public $completeTime;
	public $grade;
	public $nickName;
	public $avatarUrl;
	public $staClass;
}

//转换为[]
$data = array();
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$tb_tasks = new tasks();
		$tb_tasks -> id = $row["id"];
		$tb_tasks -> usrID = $row["usrID"];
		$tb_tasks -> sendTasksDateTime = substr($row["sendTasksDateTime"],5);
		$tb_tasks -> status = $row["status"];
		$tb_tasks -> taskTitle = $row["taskTitle"];
		$tb_tasks -> taskNum = $row["taskNum"];
		$tb_tasks -> taskPrice = $row["taskPrice"];
		$tb_tasks -> taskTakeAddress = $row["taskTakeAddress"];
		$tb_tasks -> taskToAddress = $row["taskToAddress"];
		$tb_tasks -> taskRemarks = $row["taskRemarks"];
		$tb_tasks -> phone = $row["phone"];
		$tb_tasks -> contactID = $row["contactID"];
		$tb_tasks -> recID = $row["recID"];
		$tb_tasks -> recDateTime = $row["recDateTime"];
		$tb_tasks -> sendCom = $row["sendCom"];
		$tb_tasks -> recCom = $row["recCom"];
		$tb_tasks -> completeTime = $row["completeTime"];
		$tb_tasks -> grade = $row["grade"];
		$tb_tasks -> nickName = $row["nickName"];
		$tb_tasks -> avatarUrl = $avatar_imgPrefix.$row["avatarUrl"];
		
		if($tb_tasks -> status == 0){
			$tb_tasks -> status = "待接单";
			$tb_tasks -> staClass = '';
		}
		else if($tb_tasks -> status == 1){
			$tb_tasks -> status = "已接单";
			$tb_tasks -> staClass = 'doing';
		}
		else if($tb_tasks -> status == 2){
			$tb_tasks -> status = "已结算";
			$tb_tasks -> staClass = 'fin';
		}
		else if($tb_tasks -> status == 3){
			$tb_tasks -> status = "已取消";
			$tb_tasks -> staClass = 'cancel';
		}else if($tb_tasks -> status == 4){
			$tb_tasks -> status = "A已确认";
			$tb_tasks -> staClass = 'fin';
		}else if($tb_tasks -> status == 5){
			$tb_tasks -> status = "B已确认";
			$tb_tasks -> staClass = 'fin';
		}else if($tb_tasks -> status == 6){
			$tb_tasks -> status = "A已取消";
			$tb_tasks -> staClass = 'cancel';
		}else{
			$tb_tasks -> status = "B已取消";
			$tb_tasks -> staClass = 'cancel';
		}
		
		if($tb_tasks -> taskTitle == 0){
			$tb_tasks -> taskTitle = "取快递";
		}
		else if($tb_tasks -> taskTitle == 1){
			$tb_tasks -> taskTitle = "取外卖";
		}
		else{
			$tb_tasks -> taskTitle = "其他任务";
		}
		
		if($tb_tasks -> taskNum == NULL){
			$tb_tasks -> taskNum = "0";
		}
		
		if($tb_tasks -> phone == NULL){
			$tb_tasks -> phone = "";
		}
		if($tb_tasks -> contactID == NULL){
			$tb_tasks -> contactID = "";
		}
		
		$data[] = $tb_tasks;
	}
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
}


mysqli_close($conn);
?>
