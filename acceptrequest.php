<?php
     session_start();
     
     $fromID=$_POST['fromID'];
     $ID=$_SESSION['ID'];
     include_once("abcd.php");
     $query="INSERT INTO `buddylist`(`ID1`, `ID2`) VALUES ('$ID','$fromID')";
     $run=mysqli_query($con,$query);
     $query="INSERT INTO `buddylist`(`ID1`, `ID2`) VALUES ('$fromID','$ID')";
     $run=mysqli_query($con,$query);
     $query="DELETE FROM requests WHERE fromID='$fromID' AND toID='$ID' ";
     $run=mysqli_query($con,$query);
     $name=$_SESSION['fname'].' '.$_SESSION['lname'].' ';
     $notification=$name."accepted your Buddy Request";
     $query="INSERT INTO `notifications`(`ID`, `notification`) VALUES ('$fromID','$notification')";
     $run=mysqli_query($con,$query);
     $lo=$_SERVER['HTTP_REFERER'];
     header("location: $lo");



?>