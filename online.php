<?php
session_start();
include_once("abcd.php");
 date_default_timezone_set("Asia/Calcutta"); 
 $currenttime=date("Y-m-d H:i");
 $ID=$_SESSION['ID'];
 ##online
 $queryt="UPDATE profiles SET lastonline='$currenttime' WHERE ID='$ID' ";
 $runt=mysqli_query($con,$queryt);
 ##timetravel
 $time=date("Y-m-d H:i:s");
 $query="SELECT count(msg) FROM timestravel WHERE timesent<='$time' AND (fromID='$ID' OR toID='$ID') ";
 $run=mysqli_query($con,$query);
 $data=mysqli_fetch_assoc($run);
 if($data['count(msg)']!=0){
 $query="SELECT * FROM timestravel WHERE timesent<='$time' AND (fromID='$ID' OR toID='$ID') ";
 $run=mysqli_query($con,$query);
 while($data=mysqli_fetch_assoc($run)){
     $fromID=$data['fromID'];
     $toID=$data['toID'];
     $msg=$data['msg'];
     $timesent=$data['timesent'];
     ##inserting to message table
     $subquery="INSERT INTO `messages`(`fromID`, `toID`, `type`, `msg`, `timesent`, `seen`) VALUES ('$fromID','$toID','text','$msg','$timesent','0')";
     $subrun=mysqli_query($con,$subquery);
     ##inserting into lastmsg table
     $querydel="DELETE FROM lastmsg WHERE (fromID='$fromID' AND toID='$toID') OR (fromID='$toID' AND toID='$fromID') ";
     $rundel=mysqli_query($con,$querydel);
     $type='text';
     $queryin="INSERT INTO `lastmsg`(`fromID`, `toID`, `type`, `msg`, `timesent`) VALUES ('$fromID','$toID','$type','$msg','$timesent')";
     $runin=mysqli_query($con,$queryin);
  
 }
$querydel="DELETE FROM timestravel WHERE timesent<='$time' AND (fromID='$ID' OR toID='$ID') ";
$rundel=mysqli_query($con,$querydel);
}
 echo "<div style='max-width:40%; background:white; border:2px grey solid; border-radius:10px;'>".date("l jS \of F Y h:i:s A")."</div>";
?>




