<?php

     session_start();
     $ID=$_SESSION['ID'];
     include('abcd.php');
     $pwd=md5(mysqli_real_escape_string($con,$_POST['psw']));
     $query="UPDATE logindetails SET pwd='$pwd' WHERE ID='$ID' ";
     $run=mysqli_query($con,$query);
     echo '<div style="border:1px green solid; border-radius:3px; color:green; max-width:150px"><center><h2>UPDATED</h2></center></div>';

?>