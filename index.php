<!DOCTYPE html>
<?php
     session_start();
     if(!isset($_SESSION['email'])){
       header('location: login.php');
     }

     include_once("abcd.php");
     


?>
     
<html lang="en" oncontextmenu="return false">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="icon" href="images/logo.PNG" type="image/PNG"> 
    <title>THAPARTALKS</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      

  </head>
  <body id="hide">  
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <div class="square" style="color: #138963;"><center><b>T</b></center></div>
          <h1>HAPARTALKS</h1>
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
            <li><a href="#" class="active"><i class="fa fa-home fa-fw"></i>Home</a></li>
            <li><a href="feeds.php"><i class="fa fa-bar-chart fa-fw"></i>Posts</a></li>
            <li><a href="c.php"><i class="fa fa-database fa-fw"></i>Chats</a></li>
            <li><a href="buddylist.php"><i class="fa fa-users fa-fw"></i>buddies</a></li>
            <!--<li><a href="settings.php"><i class="fa fa-sliders fa-fw"></i>Settings</a></li>-->
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
                <li><a href="profile.php" >profile</a></li>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="findbuddy.php">Find Buddy</a></li>
                <li><a href="about.php">About ThaparTalks</a></li>
                
              </ul>  
            </nav> 
          </div>
        </div>
<!--post-->


<div class="templatemo-content-container">

<div class="templatemo-flex-row flex-content-row">           
</div> 

<div class="col-1">
    <div class="panel panel-default margin-10">
            
      <div class="panel-body">  
      <!--post body-->
      
      <h2 class="templatemo-inline-block" >Shoutout to Gautam Gandu<img src="images/hair.jfif" style="pointer-events: none; user-select: none; cursor: default; width:10%; height:auto;"></h2><hr>
      <img onerror="this.onerror=null;this.src='images/unknown.png';" src="images/gau.PNG" alt="Profile Picture" style="pointer-events: none; user-select: none; cursor: default; width:100%; height:auto;">
      <!--post body end-->
      </div> 
   </div>     
</div>   

<!--end post-->
        <div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="square" style="color: #138963;"><center><b>T</b></center></div>
              <h2 class="templatemo-inline-block">About</h2><hr>
              <?php 

                   $ID=$_SESSION['ID']; 
                   $query="SELECT about FROM profiles WHERE ID='$ID' ";
                   $run=mysqli_query($con,$query);
                   $data=mysqli_fetch_assoc($run);
                   if($data['about']==NULL){
                     echo 'You have not added anything about yourself</br><a href="addabout.php" style="color:#138963;"><strong>click </strong></a> to add something';
                   }
                   else{
                   echo '<p>'.$data['about'].'</p>'.'<a href="addabout.php">Click</a> to make changes ';   }


              ?>
               </div>
            <div class="templatemo-content-widget white-bg col-1 text-center">
              <i class="fa fa-times"></i>
              <h2 class="text-uppercase"><?php echo $_SESSION['fname']; ?></h2>
              <h3 class="text-uppercase margin-bottom-10">profile picture</h3>
              <?php $xID=$_SESSION['ID'];   
              include('loadProPic.php');  
              ?>
              <img onerror="this.onerror=null;this.src='images/unknown.png';" src="<?php echo $pic;   ?>" alt="Profile Picture" class="img-circle img-thumbnail" style="pointer-events: none; user-select: none; cursor: default;">
              <p style="color:#138963;"><a href="changepropic.php">Change Profile Picture</a></p>
            </div>
            <div class="templatemo-content-widget white-bg col-1">
              <i class="fa fa-times"></i>
              <h2 class="text-uppercase">buddy requests</h2>
              <hr>
              <?php

                    $query="SELECT fromID FROM requests WHERE toID='$ID' ";
                    $run=mysqli_query($con,$query);
                    while($data=mysqli_fetch_assoc($run)){
                          
                          $fromID=$data['fromID'];
                        
                          $query1="SELECT fname,lname FROM logindetails WHERE ID='$fromID' ";
                          $run1=mysqli_query($con,$query1);
                          $data1=mysqli_fetch_assoc($run1);
                          
                          $sendername=$data1['fname'].' '.$data1['lname'];

                         ?>
                          
                          <form method="post" action="acceptrequest.php">
                          <?php $xID=$fromID;   
                                include('loadProPic.php');  
                           ?>
                          <a href="profile.php?ID=<?php echo $fromID;  ?>"><img onerror="this.onerror=null;this.src='images/unknown.png';" style="width:50px; height:auto; border-radius:50%; pointer-events: none; user-select: none; cursor: default;" src="<?php echo $pic; ?>" > </a>    <?php  echo $sendername; ?><button type="submit" style="background-color:#138963; color: white; border-radius: 8px;" value="<?php  echo $data['fromID'];  ?>" name="fromID">Accept</button>
                          </form>
                          <hr>

                      <?php
                    }



              ?>  
                                    
            </div>
          </div>
          <div class="templatemo-flex-row flex-content-row">
            <div class="col-1">              
              <div class="templatemo-content-widget orange-bg">
                <i class="fa fa-times"></i>                
                <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img  src="images/notification.png" alt="NOTIFICATIONS" style="pointer-events: none; user-select: none; cursor: default;">
                    </a>
                  </div>
                  <div class="media-body">
                    <h2 class="media-heading text-uppercase">Notifications</h2></br>
                    
                    <p>     
                    
                        <?php
                            
                               $query="SELECT notification FROM notifications WHERE ID='$ID' ORDER BY time DESC";
                               $run=mysqli_query($con,$query);
                               while($data=mysqli_fetch_assoc($run)){
                                 echo $data['notification'].'<hr>';
                               }


                            ?>
                            <h5><a style="color:white; border: 2px solid; background-color:#138963; border-radius:6px;" href="clearnotifications.php">Clear</a></h4>
                    
                    
                    
                    
                    </p>  
                  </div>        
                </div>                
              </div>            
                       
            </div>
            <div class="col-1">
              <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                <i class="fa fa-times"></i>
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">New Messages</h2></div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    
                    <tbody>
                    <?php 
                          $ID=$_SESSION['ID'];
                          $query="SELECT fromID,type,msg FROM lastmsg WHERE toID=$ID AND seen='0' ";
                          $run=mysqli_query($con,$query);
                          $i=0;
                          
                          while($data=mysqli_fetch_assoc($run)){
                            $i++;
                            $fromID=$data['fromID'];
                            $query1="SELECT fname,lname FROM logindetails WHERE ID='$fromID' ";
                            $run1=mysqli_query($con,$query1);
                            $data1=mysqli_fetch_assoc($run1);
                            $sendername=$data1['fname'].' '.$data1['lname'];
                            ?>
                            <tr>
                            <?php $xID=$fromID;   
                                  include('loadProPic.php');  
                            ?>
                            <td><?php echo '<a href="profile.php?ID='.$fromID.'"><img onerror="this.onerror=null;this.src=\'images/unknown.png\';" style="width:50px; height:auto; border-radius:50%; pointer-events: none; user-select: none; cursor: default;" src="'.$pic.'">';       echo $sendername.'</a>'; ?></td>
                            <td><?php if($data['type']=='text'){echo $data['msg'];}
                                      elseif($data['type']=='image'){echo 'You received an Image';}
                                      elseif($data['type']=='video'){echo 'You received a video';}
                                      elseif($data['type']=='music'){echo 'You received an Audio File';}
                                      elseif($data['type']=='doc'){ echo 'You received a document';} ?></td>
                          </tr>
                          <?php
                          }
                          if($i==0){
                            echo "<p><center>No New Messages</center></p>";
                          }
                         
                          ?>  
                      <tr>
                      <td></td>
                      <td><a href="c.php"><button style="border-radius:6px;">Reply</button></a></td>
                      </tr>     
                     
                                       
                    </tbody>
                  </table>    
                </div>                          
              </div>
            </div>           
          </div> <!-- Second row ends -->
          <center><div id="auto" ></div></center>
          <footer class="text-right">
            <p>Copyright &copy; 2020 Apoorv Computing Solutions </p>
            
          </footer>         
        </div>
      </div>
    </div>
    
    <!-- JS -->
    <script type="text/javascript">
    window.onload = setupRefresh;
    function setupRefresh()
    {
        setInterval("refreshBlock();",5000);
    }
    
    function refreshBlock()
    {    let x=new XMLHttpRequest();
         x.onreadystatechange=function(){
                         if(this.status==200&&this.readyState==4){
                         res=this.responseText;
                         document.getElementById("auto").innerHTML=res;

                      }
                      
                      };
         x.open("POST","online.php",true);
         x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         x.send("a=1");
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