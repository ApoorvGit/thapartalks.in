<!DOCTYPE html>
<?php
     session_start();
     if(!isset($_SESSION['email'])){
       header('location: login.php');
     }
      
      include_once("abcd.php");
     
      setcookie('load',2);
      if(!isset($_COOKIE['link'])){
        setcookie('link',1);
      }

?>
     
<html lang="en" oncontextmenu="return false">
  <head>
     <link rel="stylesheet" href="css/load.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="icon" href="images/logo.PNG" type="image/PNG"> 
    <title>SHMOOZE</title>
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
          <div class="square" style="color: #138963;"><center><b>S</b></center></div>
          <h1>SHMOOZE</h1>
        </header>
                  <div id="output"></div>
                  
                  
                         
           <center> <iframe height="120px" width="250px" src="sendmsg.php" style="border-radius:6%; border:4px;" scrolling="no"></iframe></center>
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
                <li><a href="about.php">About Shmooze</a></li>
                
              </ul>  
            </nav> 
          </div>
        </div>
        <div class="templatemo-content-container">

          <div class="templatemo-flex-row flex-content-row">
            
            
                      
          </div> 
          <!-- Second row ends -->
          <?php

               include_once('abcd.php');
               
               include('abcd.php');
               $num=$_COOKIE['link'];
               $query="SELECT link,name FROM watch WHERE num='$num' ";
               $run=mysqli_query($con,$query);
               $data=mysqli_fetch_assoc($run);
               if($data==NULL){
                 setcookie('link',1);
                 header('location: watch.php');
               }
               $name=$data['name'];


          ?>
           
          <div class="col-1">
              <div class="panel panel-default margin-10">
                       <div class="panel-heading"><h2 style="display:inline-block;" class="text-uppercase"><?php echo $name; ?></h2></div>
                <div class="panel-body"> 
                <?php
               
                $link=$data['link'];
                echo $link;
           ?>
           </br>
           <button templatemo-blue-button><a href="back.php">Previous</a></button>

           <button templatemo-blue-button><a href="next.php">NEXT</a></button>

                
                </div> 
             </div>     
         </div>             
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