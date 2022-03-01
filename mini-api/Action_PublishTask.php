<?php
$usrID = $_POST['usrid'];
$status = "0";
$taskTitle = $_POST['taskTitle'];
$taskNum = $_POST['taskNum'];
$taskPrice = $_POST['taskPrice'];
$taskTakeAddress = $_POST['taskTakeAddress'];
$taskToAddress = $_POST['taskToAddress'];
$taskRemarks = $_POST['taskRemarks'];
$phone = $_POST['phone'];
$contactID = $_POST['contactID'];

if($taskNum == NULL){
	$taskNum = 0;
}

include ("connect.php");

$sql = "INSERT INTO tb_tasks(usrID,status,sendTasksDateTime,taskTitle,taskNum,taskPrice,taskTakeAddress,taskToAddress,taskRemarks,phone,contactID,delSend,delRec) VALUES ('$usrID','$status',now(),'$taskTitle','$taskNum','$taskPrice','$taskTakeAddress','$taskToAddress','$taskRemarks','$phone','$contactID','0','0')";

mysqli_query($conn,$sql); 

mysqli_close($conn);
?>