<?php
session_start();
include_once("abcd.php");
$ID=$_SESSION['ID'];
 date_default_timezone_set("Asia/Calcutta"); 
 if($_POST['a']==0){
    $currenttime=date("Y-m-d H:i");
    $queryt="UPDATE profiles SET lastonline='$currenttime' WHERE ID='$ID' ";
    $runt=mysqli_query($con,$queryt);
   
 }
 else{
     $postID=$_POST['a'];
     $query="SELECT likedBy,likes FROM feeds WHERE postID='$postID' ";
     $run=mysqli_query($con,$query);
     $data=mysqli_fetch_assoc($run);
     $count=0;
     if($data!=NULL){
         $arr=explode('-',$data['likedBy']);
         foreach($arr as $xID){
             if($xID==$ID){
                 $count++;
             }
         }
         if($count==0){
             if(strlen($data['likedBy'])==0){
                 $likedBy=$ID;
             }
             else{
             $likedBy=$data['likedBy'].'-'.$ID;}
             $likes=$data['likes']+1;
             $queryl="UPDATE feeds SET likedBy='$likedBy',likes='$likes' WHERE postID='$postID' "; 
             $runl=mysqli_query($con,$queryl);
             echo $likes.'&#10084;';
         }
         else{
             echo $data['likes'].'&#10084;';
         }
     }
 }
 ?>