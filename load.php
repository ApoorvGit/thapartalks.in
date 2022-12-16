<?php
     session_start();
     include_once("abcd.php");
     date_default_timezone_set("Asia/Calcutta"); 
     $previously=$_POST['previously'];
     if($previously==0){
      
         $_SESSION['updateTIME']=date("Y-m-d H:i:s");
         include('func.php');
         load();
         exit(" ");

     }
     $ID=$_SESSION['ID'];
       
     $chatwithID=$_COOKIE['chatwithID'];
     $currenttime=date("Y-m-d H:i");
     $queryt="UPDATE profiles SET lastonline='$currenttime' WHERE ID='$ID' ";
     $runt=mysqli_query($con,$queryt);
     $query="SELECT timesent,seen,fromID FROM messages2 WHERE (fromID='$ID' AND toID='$chatwithID') OR (toID='$ID') ORDER BY timesent DESC LIMIT 1";
     $run=mysqli_query($con,$query);
     $data=mysqli_fetch_assoc($run);
     if($data==NULL){
       echo "<h3><center>No messages2</center></h3>";
       exit(" ");
     }
     if($data['timesent']>$_SESSION['updateTIME']||time()-strtotime($_SESSION['updateTIME'])>=45){
         
        //loading starts here
        $_SESSION['updateTIME']=date("Y-m-d H:i:s");
        include('func.php');
        load();
        
     }
     else if($_COOKIE['more']==1){
      $_SESSION['updateTIME']=date("Y-m-d H:i:s");
      include('func.php');
      setcookie('more',0);
      load();
     }
     else if($_COOKIE['seen']==0&&$data['seen']==1&&$data['fromID']==$ID){
       setcookie('seen',1);
       $_SESSION['updateTIME']=date("Y-m-d H:i:s");
       include('func.php');
       setcookie('more',0);
       load();
     }
     else{
       
       $res=$_POST['res'];
       $res=str_replace("x104kx%%##",'&',$res);
       echo $res;

     }

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
     $subquery="INSERT INTO `messages2`(`fromID`, `toID`, `type`, `msg`, `timesent`, `seen`) VALUES ('$fromID','$toID','text','$msg','$timesent','0')";
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

?>
 <?php  /*             
                     $query="SELECT typing FROM buddylist WHERE ID1='$chatwithID' AND ID2='$ID' ";
                     $run=mysqli_query($con,$query);
                     $data=mysqli_fetch_assoc($run);
                     if($data['typing']==0){
                      echo "fuck";
                     ?>
                     <img src="images/typingicon.gif">
                     <?php }
                     */
                     ?>

     



    
    
                