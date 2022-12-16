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
            <li><a href="buddylist.php" class="active"><i class="fa fa-users fa-fw"></i>buddies</a></li>
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
                <li><a href="profile.php" >profile</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="findbuddy.php" class="active">Find Buddy</a></li>
                <li><a href="about.php">About ThaparTalks</a></li>
                
              </ul>  
            </nav> 
          </div>
        </div>
        <div class="templatemo-content-container">
          <?php
           
            $ID=$_SESSION['ID'];
            $query="SELECT ID2 FROM buddylist where ID1='$ID' ";
            $run=mysqli_query($con,$query);
            $i=0;
            while($data=mysqli_fetch_assoc($run)){
              $i++;
             $buddyID=$data['ID2'];
             $query1="SELECT fname, lname FROM logindetails WHERE ID='$buddyID' ";
             $run1=mysqli_query($con,$query1);
             $data1=mysqli_fetch_assoc($run1);
             $fname=$data1['fname'];
             $lname=$data1['lname'];
             $query2="SELECT about FROM profiles WHERE ID='$buddyID' ";
             $run2=mysqli_query($con,$query2);
             $data2=mysqli_fetch_assoc($run2);
             $about=$data2['about'];
             ?>
            <div class="templatemo-content-widget white-bg col-1 text-center templatemo-position-relative">
              <i class="fa fa-times"></i>
              <?php $xID=$buddyID;   
              include('loadProPic.php');  
              ?>
              <img onerror="this.onerror=null;this.src='images/unknown.png';" style="width:150px; height:auto; pointer-events: none; user-select: none; cursor: default;" src="<?php echo $pic;   ?>" alt="Profile Pic" class="img-circle img-thumbnail margin-bottom-30">
              <h2 class="text-uppercase blue-text margin-bottom-5"><a href="profile.php?ID=<?php echo $buddyID;  ?>"><?php echo $fname.' '.$lname;  ?></a></h2>
              <h3 class="text-uppercase margin-bottom-70"><?php echo $about;  ?></h3>
              
            </div>
            
            <?php
           
            }
            
            
         ?>
          </div> <!-- Second row ends -->
          <center><div id="auto"></div></center>
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