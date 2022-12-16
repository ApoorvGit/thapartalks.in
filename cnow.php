<!DOCTYPE html>
<?php
     session_start();
     if(!isset($_COOKIE['chatwithID'])&&!isset($_POST['chatwithID'])){
      header('location: c.php');
     }
     if(!isset($_COOKIE['chatwithID'])){
     setcookie('chatwithID',$_POST['chatwithID']);
     
     }
     
     if(!isset($_SESSION['email'])){
       header('location: login.php');
     }
     

     
      setcookie('load',5);
      include_once("abcd.php");


?>
     
<html lang="en" oncontextmenu="return false">
  <head>
     <link rel="stylesheet" href="css/load.css">
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
            <li><a href="c.php" class="active"><i class="fa fa-database fa-fw"></i>Chats</a></li>
            <li><a href="buddylist.php"><i class="fa fa-users fa-fw"></i>buddies</a></li>
            <li><a href="settings.php"><i class="fa fa-sliders fa-fw"></i>Settings</a></li>
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
                <li><a href="profile.php">profile</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="findbuddy.php">Find Buddy</a></li>
                <li><a href="about.php">About ThaparTalks</a></li>
                
              </ul>  
            </nav> 
          </div>
        </div>
        <div class="templatemo-content-container">

          <div class="templatemo-flex-row flex-content-row">
            
            
                      
          </div> 
          <!-- Second row ends -->
           
               
                  <center><iframe style="border:1px;" src="moremsg.php" width="100px" height="45px" scrolling="no"></iframe></center>
                  <div id="output"></div>
                  
                         
           <center> <iframe height="133px" width="250px" src="sendmsg.php" style="border-radius:6%; border:4px;" scrolling="no"></iframe></center>
           <center><form style="border:1px; border-radius:6%; background-color: #39ADB4; width:250px; height:100px;" method="post" action="stickermenu.php">
<div style="border-radius:50%; padding:0px; border:0px solid white; background-color:white; width:50px;  display:inline-block;"><a href="uploadmenu.php"> <img width="50px" height="50px" src="images/clip-512.webp" style="pointer-events: none; user-select: none; cursor: default;"></a></div>
<button type="submit" name="sticker" value="user1" style="font-size:50px; border-radius:50%; padding:0px; border:0px solid white;  display:inline-block;">&#128522</button>
</form>
    </center>
          <footer class="text-right">
            <p>Copyright &copy; 2020 Apoorv Computing Solutions </p>
          </footer>         
        </div>
      </div>
    </div>
    
    <!-- JS -->
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
        window.onload=setupRefresh;
             var res="";
             let prev=0;
             function setupRefresh()
    {
        setInterval("refreshBlock();",1000);
    }
             function refreshBlock()
                      {
                        let x=new XMLHttpRequest();
                         x.onreadystatechange=function(){
                         if(this.status==200&&this.readyState==4){
                         res=this.responseText;
                         document.getElementById("output").innerHTML=res;

                      }
                      };
            
            x.open("POST","load.php",true);
            x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            res=res.replace(/&/g,"x104kx%%##");
            x.send("res="+res+"&previously="+prev);
            prev++;

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