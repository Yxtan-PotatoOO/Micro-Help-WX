<?php
include ("connect.php");
include ("imgPrefix.php");
$usrID = $_POST['usrid'];

$sql = "SELECT id,usrID,SerTitle,SerContent,SerDateTime FROM tb_sysinfo WHERE usrID = '$usrID' order by SerDateTime DESC";

$result = mysqli_query($conn, $sql);

class sysinfo{
	public $id;	
	public $usrID;
	public $SerTitle;
	public $SerContent;
	public $SerDateTime;
}

//转换为[]
$data = array();
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$tb_sysinfo = new sysinfo();
		$tb_sysinfo -> id = $row["id"];
		$tb_sysinfo -> usrID = $row["usrID"];
		$tb_sysinfo -> SerTitle = $row["SerTitle"];
		$tb_sysinfo -> SerContent = $row["SerContent"];
		$tb_sysinfo -> SerDateTime = $row["SerDateTime"];
		$data[] = $tb_sysinfo;
	}
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
}


mysqli_close($conn);
?>
