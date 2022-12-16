<?php
session_start();
include_once("abcd.php");
date_default_timezone_set("Asia/Calcutta"); 
$ID=$_SESSION['ID'];
$toID=$_COOKIE['chatwithID'];
$sticker=$_POST['sticker'];
$type="sticker";
$timesent=date("Y-m-d H:i:s");
$query="INSERT INTO `messages`(`fromID`, `toID`, `type`, `msg`, `timesent`) VALUES ('$ID','$toID','$type','$sticker','$timesent')";
$run=mysqli_query($con,$query);
$query="DELETE FROM lastmsg WHERE fromID='$ID' AND toID='$toID' ";
$run=mysqli_query($con,$query);
$query="DELETE FROM lastmsg WHERE fromID='$toID' AND toID='$ID' ";
$run=mysqli_query($con,$query);
$query="INSERT INTO `lastmsg`(`fromID`, `toID`, `type`, `msg`, `timesent`) VALUES ('$ID','$toID','$type','$sticker','$timesent')";
$run=mysqli_query($con,$query);
header('location: cnow.php');
?>