<?php
session_start();
$ID=$_SESSION['ID'];
include_once("abcd.php");
$query="DELETE FROM notifications WHERE ID='$ID'";
$run=mysqli_query($con,$query);

$lo=$_SERVER['HTTP_REFERER'];
header("location: $lo");


?>