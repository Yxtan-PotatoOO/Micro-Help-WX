<?php
$usrID = $_POST['usrid'];

$status = 1;
$id = $_POST['id'];
$recContact = $_POST['recContact'];

include ("connect.php");

$check_sql = "SELECT * FROM tb_tasks a, tb_students b WHERE a.usrID = b.stuID and a.id='$id' and a.status != 0";
$check_result = mysqli_query($conn, $check_sql);

class tasks{
	public $successed;
}

$data = array();
if (mysqli_num_rows($check_result) > 0) {
	$tb_tasks = new tasks();
	$tb_tasks -> successed = "失败";
	$data[] = $tb_tasks;
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
}else{
	$tb_tasks = new tasks();
    $tb_tasks -> successed = "成功";
	$data[] = $tb_tasks;
	$sql = "UPDATE tb_Tasks SET status = '$status',recID ='$usrID',recContact='$recContact',recDateTime=now() WHERE id='$id' and status = 0";
	mysqli_query($conn,$sql);
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
}

mysqli_close($conn);
?>