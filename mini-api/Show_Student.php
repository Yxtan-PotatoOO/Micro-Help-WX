<?php
$usrid = $_GET['usrid'];
include ("imgPrefix.php");

include('connect.php');
$sql="SELECT * FROM tb_students WHERE stuID = '$usrid'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

class students{
	public $id;	
	public $usrID;
	public $usrName;
	public $avatarURL;
	public $grade;
}

$data = array();
if (mysqli_num_rows($result) > 0){
	$tb_students = new students();
	$tb_students -> usrID = $row['usrID'];
	$tb_students -> usrName = $row['usrName'];
	$tb_students -> avatarURL = $avatar_imgPrefix.$row['avatarURL'];
	$tb_students -> grade = $row['grade'];
	$data[] = $tb_students;
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
}
$conn->close();
?>