<?php
$usrid=$_POST['usrid'];
$usrpwd=$_POST['usrpwd'];

include('connect.php');
$sql="SELECT * FROM tb_students WHERE stuID = '$usrid' and stuPwd = '$usrpwd'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

class students{
	public $id;	
	public $usrID;
	public $usrName;
	public $avatarURL;
	public $grade;
	public $successed;
}
$tb_students = new stdClass();
$data = array();
if (mysqli_num_rows($result) > 0){
	$tb_students = new students();
	$tb_students -> usrName = $row['usrName'];
	$tb_students -> avatarURL = $row['avatarURL'];
	$tb_students -> grade = $row['grade'];
	$tb_students -> successed = "认证成功";
	$data[] = $tb_students;
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
}else{
    $tb_students -> successed = "用户名或密码错误";
	$data[] = $tb_students;
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
}
$conn->close();
?>