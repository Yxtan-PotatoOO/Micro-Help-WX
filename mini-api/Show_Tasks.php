<?php
include ("connect.php");
include ("imgPrefix.php");

// $sql = "SELECT a.id,a.usrID,a.sendTasksDateTime,a.status,a.taskTitle,a.taskNum,a.taskPrice,a.taskTakeAddress,a.taskToAddress,a.taskRemarks,a.phone,a.contactID,a.recID,a.recDateTime,a.sendCom,a.recCom,a.completeTime,b.grade,b.nickName,b.avatarUrl FROM tb_tasks a, tb_users b WHERE a.usrID = b.openID and a.status=0 or a.status=2 order by case when a.status=0 then 1 else 0 end DESC, a.sendTasksDateTime DESC";

$sql = "SELECT a.openID,a.nickName, a.avatarUrl, a.grade, b.* FROM tb_Users a, tb_Tasks b WHERE b.usrID = a.openID and (b.status=0 or b.status=2) and delSend != 1 order by case when b.status=0 then 1 else 0 end DESC, b.sendTasksDateTime DESC";

$result = mysqli_query($conn, $sql);

class tasks{
	public $id;
	public $usrID;
	public $sendNickName;
	public $sendAvatarUrl;
	public $sendGrade;
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
	public $recgrade;
	public $recNickName;
	public $recAvatarUrl;
	public $recContact;
	public $recDateTime;
	public $sendCom;
	public $sendComTime;
	public $recCom;
	public $recComTime;
	public $completeTime;
	public $sendCancel;
	public $sendCancelReason;
	public $sendCancelTime;
	public $recCancel;
	public $recCancelReason;
	public $recCancelTime;
	public $CancelTime;
	public $delSend;
	public $delRec;
	public $sendComm;
	public $sendEvaluatesTime;
	public $recComm;
	public $recEvaluatesTime;
	public $staClass;
}

$data = array();
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$tb_tasks = new tasks();
		$tb_tasks -> id = $row["id"];
		$tb_tasks -> usrID = $row["usrID"];
		$tb_tasks -> sendNickName = $row["nickName"];
		$tb_tasks -> sendAvatarUrl = $avatar_imgPrefix.$row["avatarUrl"];
		$tb_tasks -> sendGrade = $row["grade"];
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
		$tb_tasks -> recgrade = NULL;
		$tb_tasks -> recNickName = NULL;
		$tb_tasks -> recAvatarUrl = NULL;
		$tb_tasks -> recContact = $row["recContact"];
		$tb_tasks -> recDateTime = $row["recDateTime"];
		$tb_tasks -> sendCom = $row["sendCom"];
		$tb_tasks -> sendComTime = $row["sendComTime"];
		$tb_tasks -> recCom = $row["recCom"];
		$tb_tasks -> recComTime = $row["recComTime"];
		$tb_tasks -> completeTime = $row["completeTime"];
		$tb_tasks -> sendCancel = $row["sendCancel"];
		$tb_tasks -> sendCancelReason = $row["sendCancelReason"];
		$tb_tasks -> sendCancelTime = $row["sendCancelTime"];
		$tb_tasks -> recCancel = $row["recCancel"];
		$tb_tasks -> recCancelReason = $row["recCancelReason"];
		$tb_tasks -> recCancelTime = $row["recCancelTime"];
		$tb_tasks -> CancelTime = $row["CancelTime"];
		$tb_tasks -> delSend = $row["delSend"];
		$tb_tasks -> delRec = $row["delRec"];
		$tb_tasks -> sendComm = NULL;
		$tb_tasks -> sendEvaluatesTime = NULL;
		$tb_tasks -> recComm = NULL;
		$tb_tasks -> recEvaluatesTime = NULL;
		
		
		if($tb_tasks -> status == 0){
			$tb_tasks -> status = "?????????";
			$tb_tasks -> staClass = '';
		}
		else if($tb_tasks -> status == 1){
			$tb_tasks -> status = "?????????";
			$tb_tasks -> staClass = 'doing';
		}
		else if($tb_tasks -> status == 2){
			$tb_tasks -> status = "?????????";
			$tb_tasks -> staClass = 'fin';
		}
		else if($tb_tasks -> status == 3){
			$tb_tasks -> status = "?????????";
			$tb_tasks -> staClass = 'cancel';
		}else if($tb_tasks -> status == 4){
			$tb_tasks -> status = "A?????????";
			$tb_tasks -> staClass = 'fin';
		}else if($tb_tasks -> status == 5){
			$tb_tasks -> status = "B?????????";
			$tb_tasks -> staClass = 'fin';
		}else if($tb_tasks -> status == 6){
			$tb_tasks -> status = "A?????????";
			$tb_tasks -> staClass = 'cancel';
		}else{
			$tb_tasks -> status = "B?????????";
			$tb_tasks -> staClass = 'cancel';
		}
		
		if($tb_tasks -> taskTitle == 0){
			$tb_tasks -> taskTitle = "?????????";
		}
		else if($tb_tasks -> taskTitle == 1){
			$tb_tasks -> taskTitle = "?????????";
		}
		else{
			$tb_tasks -> taskTitle = "????????????";
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
		if($tb_tasks -> sendCancelReason == null && $tb_tasks -> sendCancelTime != null){
			$tb_tasks -> sendCancelReason = '???';
		}
		if($tb_tasks -> recCancelReason == null && $tb_tasks -> recCancelTime != null){
			$tb_tasks -> recCancelReason = '???';
		}
		if($tb_tasks -> sendCancelTime == null){
			$tb_tasks -> sendCancelReason = '??????';
			$tb_tasks -> sendCancelTime = '0000-00-00 00:00:00';
		}
		if($tb_tasks -> recCancelTime == null){
			$tb_tasks -> recCancelReason = '??????';
			$tb_tasks -> recCancelTime = '0000-00-00 00:00:00';
		}
		
		
		
		
		if($tb_tasks -> recID != NULL){
			$rec_sql = "SELECT a.grade,a.nickName,a.avatarUrl,b.recID FROM tb_Users a, tb_Tasks b WHERE a.openID = '{$tb_tasks -> recID}' AND b.recID = a.openID";
			$rec_result = mysqli_query($conn, $rec_sql);
			$rec_row = mysqli_fetch_assoc($rec_result);
			$tb_tasks -> recgrade = $rec_row["grade"];
			$tb_tasks -> recNickName = $rec_row["nickName"];
			$tb_tasks -> recAvatarUrl = $avatar_imgPrefix.$rec_row["avatarUrl"];
			// echo $rec_sql;
		}
		if($tb_tasks -> sendCom != NULL || $tb_tasks -> recCom != NULL){
			$sendcomment_sql = "SELECT * FROM tb_Tasks a, tb_TasksComments b WHERE a.id = {$row["id"]} AND a.id = b.taskNo AND b.usrStatus = 0";
			$sendcomment_result = mysqli_query($conn, $sendcomment_sql);
			$sendcomment_row = mysqli_fetch_assoc($sendcomment_result);
			
			$reccomment_sql = "SELECT * FROM tb_Tasks a, tb_TasksComments b WHERE a.id = {$row["id"]} AND a.id = b.taskNo AND b.usrStatus = 1";
			$reccomment_result = mysqli_query($conn, $reccomment_sql);
			$reccomment_row = mysqli_fetch_assoc($reccomment_result);
			
			$tb_tasks -> sendComm = $sendcomment_row['comments'];
			$tb_tasks -> sendEvaluatesTime = $sendcomment_row['evaluatesTime'];
			$tb_tasks -> recComm = $reccomment_row['comments'];
			$tb_tasks -> recEvaluatesTime = $reccomment_row['evaluatesTime'];
			if($tb_tasks -> sendComm == null && $tb_tasks -> sendEvaluatesTime != null){
				$tb_tasks -> sendComm = '???';
			}
			if($tb_tasks -> recComm == null && $tb_tasks -> recEvaluatesTime != null){
				$tb_tasks -> recComm = '???';
			}
			if($tb_tasks -> sendEvaluatesTime == null){
				$tb_tasks -> sendComm = '??????';
				$tb_tasks -> sendEvaluatesTime = '0000-00-00 00:00:00';
			}
			if($tb_tasks -> recEvaluatesTime == null){
				$tb_tasks -> recComm = '??????';
				$tb_tasks -> recEvaluatesTime = '0000-00-00 00:00:00';
			}
		}
		$data[] = $tb_tasks;
	}
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
}


mysqli_close($conn);
?>
