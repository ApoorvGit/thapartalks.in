<?php
if(isset($_GET['ID'])){
    include_once("abcd.php");
    session_start();
    $ID=$_SESSION['ID']; 
    $buddyID=$_GET['ID'];
    if($ID==$buddyID){
        header("location: findbuddy.php?status=self");
    }
    else{
        $query="INSERT INTO `requests`(`fromID`, `toID`) VALUES ('$ID','$buddyID')";
        $run=mysqli_query($con,$query);
        header("location: findbuddy.php?status=success");
    }
}
?>