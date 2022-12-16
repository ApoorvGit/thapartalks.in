<?php

session_start();
$fromID=$_SESSION['ID'];
$toID=$_COOKIE['chatwithID'];
include('abcd.php');
$query="UPDATE buddylist SET typing='0' WHERE ID1='$fromID' AND ID2='$toID' ";
$run=mysqli_query($con,$query);
?>