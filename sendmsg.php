<?php

session_start();

$ID=$_SESSION['ID'];
$toID=$_COOKIE['chatwithID'];
include_once("abcd.php");
date_default_timezone_set("Asia/Calcutta");
?>

<html oncontextmenu="return false">
<link rel="stylesheet" href="css/load.css">
    <body style="background-color: #39ADB4;" id="hide">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
 
    <form method="post" action="sendmsg.php" id="form">
               
               <textarea style="border-radius:10%; border:1px solid" id="xyz" name="msg"></textarea>
               <img src="images/timetravel.png" style="width:40px; height:auto;" onclick="timetravel()">
               <div id="typing"></div>
               <button class="button" type="submit" name="submit" >Send</button>
               
               
</form>



          </p>


<?php
      
     if(isset($_POST['submit'])){
      $msg=strip_tags($_POST['msg']);
       if(!isset($_POST['time'])){
       $timesent=date("Y-m-d H:i:s");
       $query="SELECT fromID FROM lastmsg WHERE fromID='$ID' AND toID='$toID' ";
       $run=mysqli_query($con,$query);
       $data=mysqli_fetch_assoc($run);
       $query="SELECT fromID FROM lastmsg WHERE fromID='$toID' AND toID='$ID' ";
       $run=mysqli_query($con,$query);
       $data1=mysqli_fetch_assoc($run);
       $type='text';
       if($data!=NULL||$data1!=NULL){
         $time=time();
         $query="DELETE FROM lastmsg WHERE fromID='$ID' AND toID='$toID' ";
         $run=mysqli_query($con,$query);
         $query="DELETE FROM lastmsg WHERE fromID='$toID' AND toID='$ID' ";
         $run=mysqli_query($con,$query);
         $query="INSERT INTO `lastmsg`(`fromID`, `toID`, `type`, `msg`, `timesent`) VALUES ('$ID','$toID','$type','$msg','$timesent')";
         $run=mysqli_query($con,$query);
       }
       else{
         $query="INSERT INTO `lastmsg`(`fromID`, `toID`, `type`, `msg`, `timesent`) VALUES ('$ID','$toID','$type','$msg','$timesent')";
         $run=mysqli_query($con,$query);
       }
       setcookie('seen',0);
       $query="INSERT INTO `messages2`(`fromID`, `toID`, `type`, `msg`, `timesent`) VALUES ('$ID','$toID','$type','$msg','$timesent')";
       $run=mysqli_query($con,$query);
       $query="INSERT INTO `messages`(`fromID`, `toID`, `type`, `msg`, `timesent`) VALUES ('$ID','$toID','$type','$msg','$timesent')";
       $run=mysqli_query($con,$query);
     }
     else{
       $timetravel=$_POST['time'];
       $query="INSERT INTO `timestravel`(`fromID`, `toID`, `msg`, `timesent`) VALUES ('$ID','$toID','$msg','$timetravel')";
       $run=mysqli_query($con,$query);

     }

    }


?>
<script>
function timetravel(){
  let a=document.createElement('input');
  a.name="time";
  a.type="datetime-local";
  let b=document.getElementById('xyz');
  document.getElementById('form').insertBefore(a,b);
}

</script>
<script>  
//preventing user from opening Inspect elements by pressing F12
document.onkeypress = function (event) {  
event = (event || window.event);  
if (event.keyCode == 123) {  
return false;  
}  
}  
  
document.onkeydown = function (event) {  
event = (event || window.event);  
if (event.keyCode == 123) {  
return false;  
}  
} 
//end preventing

//preventing user from saving the webpage as a html file
$(window).bind('keydown', 'ctrl+s', function () {
      $('#save').click(); return false;
  });
//ends
</script> 
  <!-- <script >
   let count=0;
   let x=new XMLHttpRequest();
   x.open("POST",'typing.php',true);
   window.onload=refreshEnd;
   function refreshEnd(){
    setInterval("refreshBlock();",4000);
   }
   function refreshBlock(){
     x.send("a=0");
     count=0;
   }
      function typing(){
        
                if(count%4==0){                 
                  x.send("a=1");                }
                
                count++;
            }
    </script>
    -->
    