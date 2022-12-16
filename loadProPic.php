<?php

     include_once('abcd.php');
     $querypro="SELECT profilePic FROM profiles WHERE ID='$xID' ";
     $runpro=mysqli_query($con,$querypro);
     $datapro=mysqli_fetch_assoc($runpro);
     $pic=$datapro['profilePic'];

?>