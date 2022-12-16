<?php
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
session_start();
include_once("abcd.php");
date_default_timezone_set("Asia/Calcutta"); 
$ID=$_SESSION['ID'];
$toID=$_COOKIE['chatwithID'];

$fileext=strtolower(pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION));

$upload=1;
if($fileext=='jpg'||$fileext=='gif'||$fileext=='png'||$fileext=='jfif'||$fileext=='webp'){
$type='image';
}
elseif($fileext=='mp4'||$fileext=='mov'||$fileext=='avi'||$fileext=='mkv'||$fileext=='mpeg'){
    $type='video';
}
elseif($fileext=='docx'||$fileext=='doc'||$fileext=='pdf'||$fileext=='xlsx'||$fileext=='txt'){
    $type='doc';
}
elseif($fileext=='mp3'||$fileext=='aac'){
    $type='music';
}
else{ $upload=0;
    header("location: uploadmenu.php?error=type");
}

if($upload==1){
    $timesent=date("Y-m-d H:i:s");
    $target_dir=$a;
$target_file=$target_dir.bin2hex(random_bytes(8)).'.'.$fileext;
if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)){
$msg=$target_file;
$timesent=date("Y-m-d H:i:s");
$query="INSERT INTO `messages`(`fromID`, `toID`, `type`, `msg`, `timesent`) VALUES ('$ID','$toID','$type','$msg','$timesent')";
$run=mysqli_query($con,$query);
$query="DELETE FROM lastmsg WHERE fromID='$ID' AND toID='$toID' ";
$run=mysqli_query($con,$query);
$query="DELETE FROM lastmsg WHERE fromID='$toID' AND toID='$ID' ";
$run=mysqli_query($con,$query);
$query="INSERT INTO `lastmsg`(`fromID`, `toID`, `type`, `msg`, `timesent`) VALUES ('$ID','$toID','$type','$msg','$timesent')";
$run=mysqli_query($con,$query);
header('location: cnow.php');
}}

?>