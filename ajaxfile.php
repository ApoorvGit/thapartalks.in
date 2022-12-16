<?php
include('abcd.php');
session_start();
$ID=$_SESSION['ID'];
date_default_timezone_set("Asia/Calcutta");      
if($_FILES==NULL){
	echo 'No Image Selected';
	exit();
}
$a="";
$i=0;
for($i=0;$i<5;$i++){
    $a=$a.bin2hex(random_bytes($i+10));
    mkdir($a);
    $myfile = fopen($a.'/index.php', "w");
    fclose($myfile);
    copy('fonts/index.php',$a.'/index.php');
    $a=$a.'/';
}
$fileext=strtolower(pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION));
$target_dir=$a;
$target_file=$target_dir.bin2hex(random_bytes(8)).'.'.$fileext;
$image_ext = array("jpg","png","jpeg","gif","webp");

$response = 0;
if(in_array($fileext,$image_ext)){
	// Upload file
	if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
		$time=date("Y-m-d H:i");
		$typed=strip_tags($_POST['typed']);
		$query="INSERT INTO `feeds`(`ID`, `location`, `time`, `typed`) VALUES ('$ID','$target_file','$time','$typed')";
		$run=mysqli_query($con,$query);
		$response = $target_file;
		echo "<center><h2 style='border:2px grey solid; color:grey; max-width:40%;'><center>Uploaded</center></h2></center><br><img src='".$target_file."' style='display: inline-block; width:100%; height:auto;'>";
	}
}
else{
	echo "<h3><center>*File type not AllowedM/center></h3>";
}

