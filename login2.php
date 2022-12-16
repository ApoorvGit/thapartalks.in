<?php
session_start();
if(isset($_SESSION['email'])) header('location: index.php');
if(isset($_POST['email'])) header('location: login.php');
include("abcd.php");
$name=$_POST['name'];
$email=$_POST['email'];
$nametemp=explode(" ",$name);
$fname=$nametemp[0];
if($nametemp[1]==null){
    $lname=" ";
}
else{
    $lname=$nametemp[1];
}
$query="SELECT ID FROM logindetails WHERE email='$email' ";
$run=mysqli_query($con,$query);
$data=mysqli_fetch_assoc($run);
if($data==NULL){
    $query="INSERT INTO logindetails (email,pwd,fname, lname) VALUES ('$email','a1b2','$fname','$lname')";
    $run=mysqli_query($con,$query);
    $query="SELECT ID FROM logindetails where email='$email' ";
	$run=mysqli_query($con,$query);
    $data=mysqli_fetch_assoc($run);
    $ID=$data['ID'];
    $_SESSION['email']=$email;
	$_SESSION['fname']=$fname;
	$_SESSION['lname']=$lname;
    $_SESSION['ID']=$ID;
    $query="INSERT INTO `profiles`(`ID`) VALUES ('$ID')";
    $run=mysqli_query($con,$query);
}
else{
    //login
    $_SESSION['ID']=$data['ID'];
    $_SESSION['email']=$email;
    $_SESSION['fname']=$fname;
    $_SESSION['lname']=$lname;
}
?>