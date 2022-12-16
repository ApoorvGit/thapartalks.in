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
     <link rel="stylesheet" href="css/load.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="icon" href="images/logo.PNG" type="image/PNG"> 
    <title>THAPARTALKS - Page under Construction</title>
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
            <li><a href="c.php"><i class="fa fa-database fa-fw"></i>Chats</a></li>
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
                <li><a href="about.php">About THAPARTALKS</a></li>
                
              </ul>  
            </nav> 
          </div>
        </div>
        <div class="templatemo-content-container">

          <div class="templatemo-flex-row flex-content-row">
            
            
                      
          </div> 
          <!-- Second row ends -->
  
           
          <div class="col-1">
              <div class="panel panel-default margin-10">
                      
                       <div class="panel-heading"><h2 style="display:inline-block;" class="text-uppercase"><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><img src="images/back2.png" style="width:35px; height:auto; padding-right:10px;"></a>Under Construction</h2></div>
                <div class="panel-body">  
               <img src="images/construction.png" style="width:100%; height:auto;">
                </div> 
             </div>     
         </div>   
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