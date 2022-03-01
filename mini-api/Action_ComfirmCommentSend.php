<?php
include ("connect.php");
$id = $_POST['id'];
$comment = $_POST['comment'];
$usrid = $_POST['usrid'];
$result = mysqli_query($conn,"INSERT INTO tb_taskscomments(usrID,taskNo,comments,usrStatus,evaluatesTime) VALUES ('$usrid','$id','$comment','0',now())");
if($result){
	echo "成功";
}else{
	echo "失败";
}
mysqli_close($conn);
?>