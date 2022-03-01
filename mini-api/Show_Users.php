<?php
$usrid = $_GET['usrid'];
include ("imgPrefix.php");

include('connect.php');
$sql="SELECT * FROM tb_users WHERE openID = '$usrid'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

class users{
	public $id;	
	public $openID;
	public $nickName;
	public $avatarUrl;
	public $stuID;
	public $grade;
	public $usrStatus;
}

$data = array();
if (mysqli_num_rows($result) > 0){
	$tb_users = new users();
	$tb_users -> openID = $row['openID'];
	$tb_users -> nickName = $row['nickName'];
	$tb_users -> avatarUrl = $avatar_imgPrefix.$row['avatarUrl'];
	$tb_users -> stuID = $row['stuID'];
	$tb_users -> grade = $row['grade'];
	$tb_users -> usrStatus = $row['usrStatus'];
	$data[] = $tb_users;
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
}
$conn->close();
?>
