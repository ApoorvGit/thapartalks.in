<!DOCTYPE html>
<?php
     session_start();
     if(!isset($_SESSION['email'])){
       header('location: login.php');
     }
    
     setcookie('chatwithID','0',time()-600);
     setcookie('load',0,time()-600);
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
            <div class="col-1">              
              <div class="templatemo-content-widget orange-bg">
                <i class="fa fa-times"></i>                
                <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img  src="images/notification.png" alt="NOTIFICATIONS">
                    </a>
                  </div>
                  <div class="media-body">
                    <h2 class="media-heading text-uppercase">Notifications</h2></br>
                    <p>     
                    
                        <?php
                        
                              $ID=$_SESSION['ID'];
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
                          <img onerror="this.onerror=null;this.src='images/unknown.png';" style="width:50px; height:auto; border-radius:50%;" src="images/profilePics/<?php echo $fromID.".jpg"; ?>"> <?php     echo $sendername;?> <button type="submit" style="background-color:#138963; color: white; border-radius: 8px;" value="<?php  echo $data['fromID'];  ?>" name="fromID">Accept</button>
                          </form>
                          <hr>

                      <?php
                    }



              ?>  
                                    
            </div>
                  </div> <!-- Second row ends -->
          <div class="templatemo-flex-row flex-content-row">
          <div class="col-1">
              <div class="panel panel-default margin-10">
                <div class="panel-heading"><h2 class="text-uppercase">CHATS</h2></div>
                <div class="panel-body">
                  <table>
                 <?php 
                       $query="SELECT fromID,toID,timesent,type,msg FROM lastmsg WHERE toID='$ID' OR fromID='$ID' ORDER by timesent DESC";
                       $run=mysqli_query($con,$query);
                       while($data=mysqli_fetch_assoc($run)){
                        $msg=$data['msg'];
                        $time=$data['timesent'];
                        $fromID=$data['fromID'];
                        $toID=$data['toID'];
                        if($fromID==$ID){
                          $query1="SELECT fname,lname FROM logindetails WHERE ID='$toID' ";
                        $run1=mysqli_query($con,$query1);
                        $data1=mysqli_fetch_assoc($run1);
                        }
                        else{
                        $query1="SELECT fname,lname FROM logindetails WHERE ID='$fromID' ";
                        $run1=mysqli_query($con,$query1);
                        $data1=mysqli_fetch_assoc($run1);
                        }
                        $sendername=$data1['fname'].' '.$data1['lname'];   
                       

                 ?>
                  <form action="chatnow.php" method="post" class="templatemo-login-form">
                    <tr><td style="padding-top:15px; padding-bottom:7px"><h3><?php echo $sendername; ?></h3></td></tr>
                    <tr>
                     
                        <td>
                        <?php if($fromID==$ID){?>
                        
                          <div id="maine1">
                           <img onerror="this.onerror=null;this.src='images/unknown.png';" src="images/profilePics/<?php  if($toID==$ID){ echo $fromID.'.jpg';}
                                                               elseif($fromID==$ID){echo $toID.'.jpg';} ?>" style="width:60px; height:50px; border-radius:50%;">
                           <div id="pro1">
                           <?php if($data['type']=='text'){echo $data['msg'];}
                                      elseif($data['type']=='image'){echo 'You sent an Image';}
                                      elseif($data['type']=='video'){echo 'You sent a video ';}
                                      elseif($data['type']=='music'){echo 'You sent an Audio File ';}
                                      elseif($data['type']=='doc'){ echo 'You sent a document ';}
                                      elseif($data['type']=='sticker'){ echo 'You sent a sticker';} ?>
                             <div id="date">
                               <?php echo $time; ?>
                              </div>
                            </div>
                          </div>
                       <?php }
                       else{  ?><div id="maine1">
                        <img onerror="this.onerror=null;this.src='images/unknown.png';" src="images/profilePics/<?php  if($toID==$ID){ echo $fromID.'.jpg';}
                                                            elseif($fromID==$ID){echo $toID.'.jpg';} ?>" style="width:60px; height:50px; border-radius:50%;">
                        <div id="pro2">
                        <?php if($data['type']=='text'){echo $data['msg'];}
                                   elseif($data['type']=='image'){echo 'You received an Image';}
                                   elseif($data['type']=='video'){echo 'You received a video ';}
                                   elseif($data['type']=='music'){echo 'You received an Audio File ';}
                                   elseif($data['type']=='doc'){ echo 'You received a document ';} 
                                   elseif($data['type']=='sticker'){ echo 'Sent you a sticker';} ?>
                                   
                          <div id="date">
                            <?php echo $time; ?>
                           </div>
                         </div>
                       </div> <?php  } ?>
                        </td>
                       <td>
                       <div class="form-group">
                           <button style="margin-left:50px;" type="submit" name="chatwithID" value="<?php  if($toID==$ID){ echo $fromID;}
                                                               elseif($fromID==$ID){echo $toID;} ?>" class="templatemo-blue-button">Reply</button>
                        </div>
                      </td>
                     </tr>
                  </form>
                  </div>
                       <?php 
                      }  ?>
                      </table>
                </div>                
              </div> 
                          
            </div>
            <div class="col-1">  
              <div class="templatemo-content-widget blue-bg">
                <i class="fa fa-times"></i>
                <h2 class="text-uppercase margin-bottom-10">Buddy List</h2>
                <p class="margin-bottom-0">
                  <?php 
                         $query="SELECT ID2 FROM buddylist WHERE ID1='$ID' ";
                         $run=mysqli_query($con,$query); ?>
                         <table>
                           <?php while($data=mysqli_fetch_assoc($run)){
                             $buddyID=$data['ID2'];
                             $query1="SELECT fname,lname FROM logindetails WHERE ID='$buddyID' ";
                             $run1=mysqli_query($con,$query1);
                             $data1=mysqli_fetch_assoc($run1);
                             $buddyname=$data1['fname'].' '.$data1['lname'];
                             ?><form method="post" action="chatnow.php">
                              <tr>
                                
                                <td style="padding-top:15px; padding-bottom:7px; padding-right:10px; "><?php echo '<a href="profile.php?ID='.$buddyID.'">'; ?><img onerror="this.onerror=null;this.src='images/unknown.png';" style="border-radius:50%; width:50px; height:50px; " src="images/profilePics/<?php echo $buddyID.'.jpg';?>"></a><b style="font-size:15px;"><?php echo ' '.$buddyname;  ?></b></td>
                                <td style="padding-top:15px; padding-bottom:7px"><button type="submit" value="<?php echo $buddyID; ?>" name="chatwithID" style="color:blue;"><b>CHAT</b></button></td>
                                
                              </tr>   
                              </form>
                              <?php } ?>
                           
                           </table>
                           
                
                
                
                </p>                
              </div> 
              </div> 
                    </div>
          <footer class="text-right">
            <p>Copyright &copy; 2020 Apoorv Computing Solutions </p>
            <div id="auto"></div>
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
       $('#auto').load("online.php");
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