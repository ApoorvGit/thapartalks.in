<?php


include('abcd.php');
$ID=$_SESSION['ID'];
$queryp="SELECT * FROM feeds ORDER BY time DESC";
$runp=mysqli_query($con,$queryp);
$count=0;
while($datap=mysqli_fetch_assoc($runp)){
  $fID=$datap['ID'];
  $queryb="SELECT ID2 FROM buddylist WHERE ID1='$fID' AND ID2='$ID' ";
  $runb=mysqli_query($con,$queryb);
  $datab=mysqli_fetch_assoc($runb);
  if($datab!=NULL){
    $count++;
    if($count==6){
    break;
    }
    $queryx="SELECT profilePic FROM profiles WHERE ID='$fID'";
    $runx=mysqli_query($con,$queryx);
    $datax=mysqli_fetch_assoc($runx);
    $queryz="SELECT fname, lname FROM logindetails WHERE ID='$fID' ";
    $runz=mysqli_query($con,$queryz);
    $dataz=mysqli_fetch_assoc($runz);
    $arr=explode('-',$datap['likedBy']);
    $countp=0;
    foreach($arr as $PID){
      if($PID==$ID){
        $countp++;
      }
    }
    ?>
  <div id="maine1">
  <img onerror='this.onerror=null;this.src="images/unknown.png";' src="<?php echo $datax['profilePic']; ?>" style="width:60px; height:60px; border-radius:50%;">
  <div id="pro1">
  <span style="font-size:20px;"><?php echo $dataz['fname'].' '.$dataz['lname']; ?></span>
  <div id="date"><?php echo $datap['time']; ?></div>
  </div>
  <?php if($datap['typed']!=NULL){
    ?>
  <div id="pro1"><?php echo $datap['typed'];  ?></div>
   <?php
  }
  ?>
  <div id="pro1" onclick="like(<?php echo $datap['postID']; ?>,this)" style="font-size:25px; color:<?php if($countp==1){echo 'red'; } else{ echo 'white'; } ?>"><?php echo $datap['likes']; ?>&#10084;</div>
  </div>
                      
               <div id="post">
                  <img onerror="this.onerror=null;this.src='images/unknown.png';" src="<?php echo $datap['location'];  ?>" alt="Profile Picture" style="pointer-events: none; user-select: none; cursor: default; width:100%; height:auto;">
              </div><br><br>

<?php
  }
}


?> 