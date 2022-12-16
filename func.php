<?php
              function load(){  
                include("abcd.php");

                  ?> 
             
                    <?php
                      date_default_timezone_set("Asia/Calcutta");      
                      $currenttime=date("Y-m-d H:i");
                      $ID=$_SESSION['ID'];
                      $chatwithID=$_COOKIE['chatwithID'];
                      $queryt="UPDATE profiles SET lastonline='$currenttime' WHERE ID='$ID' ";
                      $runt=mysqli_query($con,$queryt);
                      $query1="SELECT fname,lname FROM logindetails WHERE ID='$chatwithID' ";
                      $run1=mysqli_query($con,$query1);
                      $data1=mysqli_fetch_assoc($run1);

                      $chatwithname=$data1['fname'].' '.$data1['lname'];
                      $queryt="SELECT lastonline FROM profiles WHERE ID='$chatwithID' ";
                      $runt=mysqli_query($con,$queryt);
                      $datat=mysqli_fetch_assoc($runt);
                      ?>
                      <body id="hide">
                      <div class="col-1">
             <div class="panel panel-default margin-10">
                      <div class="panel-heading"><h2 style="display:inline-block;" class="text-uppercase"><?php echo $chatwithname; if($datat['lastonline']==date("Y-m-d H:i:00")){echo '<img style="width:20px; height:20px; pointer-events: none; user-select: none; cursor: default;"src="images/online.png">';}
                                                                                                       else{echo '</h2><h5 style="display:inline-block; ">'.' [ '.$datat['lastonline'].' ]</h5>';} ?></div>
               <div class="panel-body">
               <table>
              
                      <?php
                      
                      $load=$_COOKIE['load'];
                      $query="SELECT fromID,type,timesent,msg,seen FROM (SELECT fromID,type,timesent,msg,seen FROM messages2 WHERE (toID='$ID' AND fromID='$chatwithID') OR (toID='$chatwithID' AND fromID='$ID') ORDER BY timesent DESC LIMIT $load) sub ORDER BY timesent ASC  ";
                      $run=mysqli_query($con,$query);
                      while($data=mysqli_fetch_assoc($run)){
                       $msg=$data['msg'];
                       $time=$data['timesent'];
                       $fromID=$data['fromID'];
                       $type=$data['type'];
                       $seen=$data['seen'];
                       ?>
                       
                       <?php
                       
                       if($fromID==$ID){
                       ?>
                         <div id="maine1">
                         <?php $xID=$fromID;   
                               include('loadProPic.php');  
                          ?>
                         <img onerror="this.onerror=null;this.src='images/unknown.png';" src="<?php echo $pic; ?>" style="width:60px; height:50px; border-radius:50%; pointer-events: none; user-select: none; cursor: default;">
                         <div id="pro1">
                           <?php 
                           
                            
                           if($type=='text') {  echo $msg;}
                           elseif($type=='sticker'){echo '<img style="width:100%; height:auto;" src="images/stickers/'.$msg.'">'; }

                           else{   
                             
                                   ?><a href="viewer.php?file=<?php echo $msg; ?>&type=<?php echo $type; ?>&p=0">
                                   <?php
                                   if($type=='image'){
                                   ?> 
                                    <img style="width:100%; height:auto; user-select: none; cursor: default;" src="<?php echo $msg; ?>">
                                    </a>
                                    <?php }
                                 elseif($type=='video'){ echo '<img style="width:100%; height:auto;" src="images/video.png">'; }
                                 elseif($type=='music'){ echo '<img style="width:100%; height:auto;" src="images/music.png">';}
                                 elseif($type=='doc'){ echo '<img style="width:100%; height:auto;" src="images/document.png">';}
                                 ?>
                                 </a>
                                 <?php }
                                 
                                 if($seen=='1'){
                                  echo '<div style="display:inline-block; float: right;"><img style=" width:20px; height:20px;" src="images/tick.svg"></div>';
                           
                                 }
                                 ?>
                                 <div id="date" style="display:inline-block;">
                             <?php echo $time; ?>
                            </div>
                          </div>
                        </div></br>
                        <?php
                       }  elseif($fromID==$chatwithID){
                         $query1="UPDATE messages2 SET seen='1',timesent='$time' WHERE fromID='$chatwithID' AND toID='$ID' AND msg='$msg' AND timesent='$time' ";
                         $run1=mysqli_query($con,$query1);
                         $query1="UPDATE lastmsg SET seen='1',timesent='$time' WHERE fromID='$chatwithID' AND toID='$ID' AND msg='$msg' ";
                         $run1=mysqli_query($con,$query1);
                         ?>
                         <div id="maine2">
                         <?php $xID=$fromID;   
                               include('loadProPic.php');  
                         ?>
                          <a href="profile.php?ID=<?php echo $fromID; ?>" ><img onerror="this.onerror=null;this.src='images/unknown.png';" src="<?php echo $pic; ?>" style="width:60px; height:50px; border-radius:50%; pointer-events: none; user-select: none; cursor: default;"></a>
                          <div id="pro2">
                          <?php if($type=='text') {  echo $msg;}
                                elseif($type=='sticker'){echo '<img style="width:100%; height:auto;" src="images/stickers/'.$msg.'">'; }
                                else{
                                 
                                 ?><a href="viewer.php?file=<?php echo $msg; ?>&type=<?php echo $type; ?>&p=0">
                                 <?php
                                 if($type=='image'){echo '<img  style="width:100%; height:auto;" src="'.$msg.'">'; }
                                 elseif($type=='video'){echo '<img  style="width:100%; height:auto;"  src="images/video.png">'; }
                                 elseif($type=='music'){ echo '<img  style="width:100%; height:auto;" src="images/music.png">';}
                                 elseif($type=='doc'){ echo '<img  style="width:100%; height:auto;" src="images/document.png">';}
                                 ?>
                                 </a>
                                 <?php
                                }
                                 ?>
                            <div id="date">
                              <?php echo $time; ?>
                             </div>
                           </div>
                         </div></br>
                         <?php
                           }
                      
                          }  ?>
                          
                     </table>
                    
                     </div>
             </div>
             </div>              
           </div>
           <div>
           <?php
            $query="SELECT fromID FROM lastmsg WHERE toID='$ID' AND SEEN='0' AND fromID!='$chatwithID' ORDER BY timesent DESC LIMIT 5 ";
            $run=mysqli_query($con,$query);
            while($data=mysqli_fetch_assoc($run)){

            
            ?>
            <?php if($data!=NULL){
             $fromID=$data["fromID"];
             ?>
             <div style="display:inline-block;">
        <form action="newmsg.php" method="post" class="templatemo-login-form"> 
       
       <img style="width:20px; height:20px; display:inline-block;  margin-left:10px; pointer-events: none; user-select: none; cursor: default;" src="images/new.png">     

                       
                       
                        
                          <button style="width:60px; height:50px; border-radius:50%; border:0px;" type="submit" name="chatwithID" value="<?php echo $fromID; ?>">
                          <?php $xID=$fromID;   
                                include('loadProPic.php');  
                          ?>
                          <center><img onerror="this.onerror=null;this.src='images/unknown.png';" src="<?php  echo $pic; ?>" style="width:60px; height:50px; border-radius:50%; pointer-events: none; user-select: none; cursor: default;"></center></button>
          
            </form>
            </div>
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
            
                     
       
       <?php }
            }
        ?>
        <div>
        
        </br>
        <?php
              }
              ?>