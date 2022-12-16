<!DOCTYPE html>
<?php
     session_start();
     if(!isset($_SESSION['email'])){
       header('location: login.php');
     }
     
?>
     
<html lang="en" oncontextmenu="return false">
  <head>
     <link rel="stylesheet" href="css/load.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="icon" href="images/logo.PNG" type="image/PNG"> 
    <title>THAPARTALKS - Profile</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
   
    
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  </head>
  <body>  
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <div class="square" style="color: #138963;"><center><b>T</b></center></div>
          <h1>THAPARTALKS</h1>
        </header>
        <div class="profile-photo-container">
        <?php $xID=$_SESSION['ID'];   
              include('loadProPic.php');  
              ?>
          <img onerror="this.onerror=null;this.src='images/unknown.png';" src='<?php echo $pic; ?>' alt="Profile Photo" class="img-responsive" style="pointer-events: none; user-select: none; cursor: default;"> 
          <div class="profile-photo-overlay"></div>
        </div>      
        <!-- Search box -->
        <br><br>
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>
        <nav class="templatemo-left-nav">          
          <ul>
            <li><a href="index.php" ><i class="fa fa-home fa-fw"></i>Home</a></li>
            <li><a href="feeds.php"><i class="fa fa-bar-chart fa-fw"></i>Posts</a></li>
            <li><a href="c.php"><i class="fa fa-database fa-fw"></i>Chats</a></li>
            <li><a href="buddylist.php"><i class="fa fa-users fa-fw"></i>buddies</a></li>
            <!--<li><a href="settings.php"><i class="fa fa-sliders fa-fw"></i>Settings</a></li> -->
            <li><a href="logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
          </ul>  
        </nav>
      </div>
      <!-- Main content --> 
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <ul class="text-uppercase">
                <li><a href="profile.php" class="active">profile</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="findbuddy.php">Find Buddy</a></li>
                <li><a href="about.php">About THAPARTALKS</a></li>
                
              </ul>  
            </nav> 
          </div>
        </div>
        <div class="templatemo-content-container">

          <div class="templatemo-flex-row flex-content-row">
            
            
                      
          </div> 
          <!-- Second row ends -->
          <?php 
               include('abcd.php');
               if(!isset($_GET['ID'])){
                   $proID=$_SESSION['ID'];
               }
               else{
                   $proID=$_GET['ID'];
                   if($proID!=4){
                       $my=$_SESSION['ID'];
                       $query="SELECT ID1 FROM buddylist WHERE ID1='$my' AND ID2='$proID' ";
                       $run=mysqli_query($con,$query);
                       $data=mysqli_fetch_assoc($run);
                       if($data==null){
                            header('location: access_denied.php');
                        }
                   }
               }
               
               
               $query="SELECT fname,lname FROM logindetails WHERE ID='$proID' ";
               $run=mysqli_query($con,$query);
               $data=mysqli_fetch_assoc($run);
               $fname=$data['fname'];
               $lname=$data['lname'];
               $name=$fname.' '.$lname;
               
               $query="SELECT about FROM profiles WHERE ID='$proID' ";
               $run=mysqli_query($con,$query);
               $data=mysqli_fetch_assoc($run);
               $about=$data['about'];
               $ID=$_SESSION['ID'];
               if(isset($_GET['ID'])){
                $query="SELECT count(msg) FROM messages WHERE toID='$ID' AND fromID='$proID' ";
               }
               else{
                $query="SELECT count(msg) FROM messages WHERE toID='$ID' "; 
               }
               $run=mysqli_query($con,$query);
               $data=mysqli_fetch_assoc($run);
               if($data==NULL){
                $noOfMsg=0;  
               }
               else{
                $noOfMsg=$data['count(msg)'];
               }
               if(isset($_GET['ID'])){
                $query="SELECT count(msg) FROM messages WHERE toID='$ID' AND fromID='$proID' AND (type='image' OR type='audio' OR type='video' OR type='doc' ) "; 
               }
               else{
                $query="SELECT count(msg) FROM messages WHERE toID='$ID' AND (type='image' OR type='audio' OR type='video' OR type='doc' ) ";
               }
               $run=mysqli_query($con,$query);
               $data=mysqli_fetch_assoc($run);
               $noOfFiles=$data['count(msg)'];
               if($data==NULL){
                $noOfFiles=0;  
               }
               else{
                $noOfFiles=$data['count(msg)'];
               }
          ?>

            <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="media margin-bottom-30">
                <div class="media-left padding-right-25">
                <?php $xID=$proID;   
              include('loadProPic.php');  
              ?>
                    <img onerror="this.onerror=null;this.src='images/unknown.png';" class="media-object img-circle templatemo-img-bordered" src="<?php echo $pic;   ?>" alt="Profile Pic" style=" pointer-events: none; user-select: none; cursor: default;">
                  
                </div>
                <div class="media-body">
                  <h2 class="media-heading text-uppercase blue-text"><?php echo $name; ?></h2>
                  <p><?php echo $about; ?></p>
                </div>        
              </div>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td><div class="circle green-bg"></div></td>
                      <td>Messages sent to you</td>
                      <td><?php echo $noOfMsg; ?></td>                    
                    </tr> 
                    <tr>
                      <td><div class="circle pink-bg"></div></td>
                      <td>Posts</td>
                      <td>0</td>                    
                    </tr>  
                    <tr>
                      <td><div class="circle blue-bg"></div></td>
                      <td>Total Likes</td>
                      <td>0</td>                    
                    </tr>  
                    <tr>
                      <td><div class="circle yellow-bg"></div></td>
                      <td>Files sent to you</td>
                      <td><?php echo $noOfFiles; ?></td>                    
                    </tr>                                      
                  </tbody>
                </table>
              </div>             
            </div>
            
            <div class="templatemo-content-widget white-bg col-1 text-center templatemo-position-relative">
              <i class="fa fa-times"></i>
              <h3 class="text-uppercase margin-bottom-70">Files Sent to you</h3>
              <?php

                   include_once('abcd.php');
                   if(isset($_GET['ID'])){
                    $query="SELECT msg,type FROM messages WHERE fromID='$proID' AND toID='$ID' AND type!='text' AND type!='sticker' LIMIT 5";
                   }
                   else{
                    $query="SELECT msg,type FROM messages WHERE toID='$ID' AND type!='text' AND type!='sticker' LIMIT 5";
                   }
                   $run=mysqli_query($con,$query);
                   while($data=mysqli_fetch_assoc($run)){
                     $type=$data['type'];
                     $msg=$data['msg'];
                    
                     
                     ?><a href="viewer.php?file=<?php echo $msg; ?>&type=<?php echo $type; ?>&p=0">
                     <?php
                     if($type=='image'){echo '<img  style="width:25%; height:auto;" src="'.$msg.'">'; }
                     elseif($type=='video'){echo '<img  style="width:25%; height:auto;"  src="images/video.png">'; }
                     elseif($type=='music'){ echo '<img  style="width:25%; height:auto;" src="images/music.png">';}
                     elseif($type=='doc'){ echo '<img  style="width:25%; height:auto;" src="images/document.png">';}
                     
                   }


               ?>
               </a>
            </div>
            <div class="templatemo-content-widget white-bg col-1 templatemo-position-relative templatemo-content-img-bg">
            <?php $xID=$proID;   
              include('loadProPic.php');  
              ?>
              <img onerror="this.onerror=null;this.src='images/unknown.png';" src="<?php echo $pic; ?>" alt="Profile Picture" class="img-responsive content-bg-img" style=" pointer-events: none; user-select: none; cursor: default;">
              <i class="fa fa-heart"></i>
              <h2 class="templatemo-position-relative white-text">Profile Pic</h2>
              <div class="view-img-btn-wrap">
                <form method="get" action="viewer.php">
                <?php 
                
                  
                ?>
                  <input type="hidden" value="<?php echo $pic; ?>" name="file">
                  <input type="hidden" value="<?php echo "image"; ?>" name="type">
                  <input type="hidden" value="1" name="p">
                <button type="submit" class="btn btn-default templatemo-view-img-btn">View</button>  
                </form>
              </div>             
            </div>
          </div>
        
            <!--POST---->

<div class="templatemo-content-container">

<div class="templatemo-flex-row flex-content-row">           
</div> 

<div class="col-1">
    <div class="panel panel-default margin-10">
            
      <div class="panel-body">  
      <!--post body-->
      <?php


include('abcd.php');
$ID=$_SESSION['ID'];
$queryp="SELECT * FROM feeds WHERE ID='$proID' ORDER BY time DESC";
$runp=mysqli_query($con,$queryp);
$count=0;
while($datap=mysqli_fetch_assoc($runp)){
  if(1){
    $count++;
    if($count==6){
    break;
    }
    $arr=explode('-',$datap['likedBy']);
    $countp=0;
    foreach($arr as $PID){
      if($PID==$ID){
        $countp++;
      }
    }
    ?>
  <div id="maine1">
  <img onerror='this.onerror=null;this.src="images/unknown.png";' src="<?php echo $pic; ?>" style="width:60px; height:60px; border-radius:50%;">
  <div id="pro1">
  <span style="font-size:20px;"><?php echo $name; ?></span>
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
      <!--post body end-->
      </div> 
   </div>     
</div>   

<!--end post-->
          <footer class="text-right">
            <p>Copyright &copy; 2020 Apoorv Computing Solutions </p>
          </footer>         
        </div>
      </div>
    </div>
    
    <!-- JS -->
    <script type="text/javascript">
     window.onload = setupRefresh();
    function setupRefresh()
    {
        setInterval("refreshBlock(0,0);",5000);
    }
  function like(y,event){
    refreshBlock(y,event);
    changeheartcolour(event);
  }
  function refreshBlock(y,event)
  {   
    let x=new XMLHttpRequest();
       x.onreadystatechange=function(){
                       if(this.status==200&&this.readyState==4){
                       res=this.responseText;
                       event.innerHTML=res;

                    }
                    
                    };
       x.open("POST","like.php",true);
       x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       x.send("a="+y);
  }
  function changeheartcolour(e){
    e.style.color="red";
  }
  function backcolor(e){
    e.style.color="white";
  }
</script>
    <script src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script src="js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
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
  </body>
</html>