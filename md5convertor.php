<?php
     include('abcd.php');
         $pwd=md5("shmooze@1276.com");
         $queryup="UPDATE logindetails SET pwd='$pwd' ";
         $runup=mysqli_query($con,$queryup);
     

?>