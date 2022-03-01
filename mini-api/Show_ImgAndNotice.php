<?php
include ("connect.php");
include ("imgPrefix.php");

$sql = "SELECT * FROM tb_scrollandnotice WHERE id = 1";

$result = mysqli_query($conn, $sql);

class scrollandnotice{
	public $id;	
	public $scrollImg1;
	public $scrollImg2;
	public $scrollImg3;
	public $notice;
}

//转换为[]
$data = array();
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$tb_scrollandnotice = new scrollandnotice();
		$tb_scrollandnotice -> id = $row["id"];
		$tb_scrollandnotice -> scrollImg1 = $scroll_imgPrefix.$row["scrollImg1"];
		$tb_scrollandnotice -> scrollImg2 = $scroll_imgPrefix.$row["scrollImg2"];
		$tb_scrollandnotice -> scrollImg3 = $scroll_imgPrefix.$row["scrollImg3"];
		$tb_scrollandnotice -> notice = $row["notice"];
		$data[] = $tb_scrollandnotice;
	}
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
}

mysqli_close($conn);
?>
