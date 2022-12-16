<!DOCTYPE html>
<?php
     session_start();
     if(!isset($_COOKIE['chatwithID'])&&!isset($_POST['chatwithID'])){
      header('location: chat.php');
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
     
<html lang="en">
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
        <div class="profile-photo-container">
          <img onerror="this.onerror=null;this.src='images/unknown.png';" src='images/profilePics/<?php echo $_SESSION['ID']; ?>.jpg' alt="Profile Photo" class="img-responsive"> 
          <div class="profile-photo-overlay"></div>
        </div>      
        <!-- Search box -->
        <form class="templatemo-search-form" role="search" action="findbuddy.php">
          <div class="input-group">
              <button type="submit" class="fa fa-search"></button>
              <input type="text" class="form-control" placeholder="Search By Email" name="email" id="srch-term">           
          </div>
        </form>
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>
        <nav class="templatemo-left-nav">          
          <ul>
            <li><a href="index.php" ><i class="fa fa-home fa-fw"></i>Home</a></li>
            <li><a href="chat.php" class="active"><i class="fa fa-database fa-fw"></i>Chats</a></li>
            <li><a href="buddylist.php"><i class="fa fa-users fa-fw"></i>buddies</a></li>
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
                <li><a href="sendrequest.php">Find Buddy</a></li>
                <li><a href="about.php">About Shmooze</a></li>
                
              </ul>  
            </nav> 
          </div>
        </div>
        <div class="templatemo-content-container">

          <div class="templatemo-flex-row flex-content-row">
            
            
                      
          </div> 
          <!-- Second row ends -->
           
               
                  <center><iframe style="border:1px;" src="moremsg.php" width="100px" height="45px" scrolling="no"></iframe></center>
                  <div id="auto"></div>
                  
                  
                                
           <center> <iframe height="100px" width="250px" src="sendmsg.php" style="border-radius:6%; border:4px;" scrolling="no"></iframe>
           <form style="border:1px; border-radius:6%; background-color: #39ADB4; width:250px; height:100px;" method="post" action="stickermenu.php">
<div style="border-radius:50%; padding:0px; border:0px solid white; background-color:white; width:50px;  display:inline-block;"><a href="uploadmenu.php"> <img width="50px" height="50px" src="images/clip-512.webp"></a></div>
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
    <script type="text/javascript">
    window.onload = setupRefresh;
    function setupRefresh()
    {
        setInterval("refreshBlock();",1000);
    }
    
    function refreshBlock()
    {
       $('#auto').load("load.php");
    }
  </script>
    <script src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script src="js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    <script src="https://www.google.com/jsapi"></script> <!-- Google Chart -->
    <script>
      /* Google Chart 
      -------------------------------------------------------------------*/
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart); 
      
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

          // Create the data table.
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Topping');
          data.addColumn('number', 'Slices');
          data.addRows([
            ['Mushrooms', <?php echo '6'; ?>],
            ['Onions', 1],
            ['Olives', 1],
            ['Zucchini', 1],
            ['Pepperoni', 2]
          ]);

          // Set chart options
          var options = {'title':'How Much Pizza I Ate Last Night'};

          // Instantiate and draw our chart, passing in some options.
          var pieChart = new google.visualization.PieChart(document.getElementById('pie_chart_div'));
          pieChart.draw(data, options);

          var barChart = new google.visualization.BarChart(document.getElementById('bar_chart_div'));
          barChart.draw(data, options);
      }

      $(document).ready(function(){
        if($.browser.mozilla) {
          //refresh page on browser resize
          // http://www.sitepoint.com/jquery-refresh-page-browser-resize/
          $(window).bind('resize', function(e)
          {
            if (window.RT) clearTimeout(window.RT);
            window.RT = setTimeout(function()
            {
              this.location.reload(false); /* false to get page from cache */
            }, 200);
          });      
        } else {
          $(window).resize(function(){
            drawChart();
          });  
        }   
      });
      
    </script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->

  </body>
</html>