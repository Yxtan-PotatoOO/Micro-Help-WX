<?php
include('connect.php');
$id = $_POST['newid'];
date_default_timezone_set("Asia/Shanghai");
if(is_uploaded_file($_FILES['file']['tmp_name'])) {  
    $tmpFile = $_FILES['file']['tmp_name'];
    $upToPath = $_SERVER['DOCUMENT_ROOT']."/images/Tidings";  
    $trueFile = $_FILES['file']['name']; 
	$saveName = time().rand(1,1000)."-".date("Y-m-d").substr($trueFile,strrpos($trueFile,"."));
    $move_to_file = $upToPath."/". $saveName;
    if(move_uploaded_file($tmpFile,iconv("utf-8","gb2312",$move_to_file))) {
		$check_sql = "SELECT imgUrl1 FROM tb_tidings WHERE id=$id";
		$check_result = mysqli_query($conn,$check_sql);
		$check_array = mysqli_fetch_array($check_result);
		
		$check_sql2 = "SELECT imgUrl2 FROM tb_tidings WHERE id=$id";
		$check_result2 = mysqli_query($conn,$check_sql2);
		$check_array2 = mysqli_fetch_array($check_result2);
		
		if($check_array['imgUrl1'] == NULL)
		{
			$sql = "UPDATE tb_tidings SET imgUrl1 = '$saveName' WHERE id=$id";
			if($conn->query($sql))
			{
				echo "成功";
			}
		}
		else if($check_array2['imgUrl2'] == NULL)
		{
			$sql = "UPDATE tb_tidings SET imgUrl2 = '$saveName' WHERE id=$id";
			if($conn->query($sql))
			{
				echo "成功";
			}
		}
		else
		{
			$sql = "UPDATE tb_tidings SET imgUrl3 = '$saveName' WHERE id=$id";
			if($conn->query($sql))
			{
				echo "成功";
			}
		}
    } else {  
        $sql = "DELETE tb_tidings WHERE id=$id";
		$conn->query($sql);
		echo "失败";
    }  
} else {  
    $sql = "DELETE tb_tidings WHERE id=$id";
	$conn->query($sql);
	echo "失败";
}
 
?>