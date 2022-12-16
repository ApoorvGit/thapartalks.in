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
    <title>THAPARTALKS</title>
    <link href="css/load.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='bootstrap/js/bootstrap.min.js' type='text/javascript'></script>
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
            <li><a href="feeds.php" class="active"><i class="fa fa-bar-chart fa-fw"></i>Posts</a></li>
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
       
               <!-- upload button -->
               <div id="maine1">
               <div style="display:inline-block;"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadModal" style="border-radius:50%;"><img src="images/post.png" ></button></div>
               <div style="width:80%; display:inline-block;"><textarea type="text" name="typed" id="typed" placeholder="Write Something" style="width:100%;" rows="4"></textarea></div>
               </div>
<!-- Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">POST FEED</h4>
        </div>
        <div class="modal-body">
            <!-- Form -->
            <form method='post' enctype="multipart/form-data">
                <input type='file' name='file' id='file' class='form-control' required /><br>
                <input type='button' class='btn btn-info' value='Upload' id='btn_upload' required />
            </form>

            <!-- Preview-->
            <div id='preview'></div>
        </div>
        
    </div>

  </div>
</div>

<!-- Script -->
<script type='text/javascript'>
$(document).ready(function(){
    $('#btn_upload').click(function(){
let x=document.getElementById('file');
if(x.value!=null){


        var fd = new FormData();
        var files = $('#file')[0].files[0];
        var typed=document.getElementById('typed').value;
        fd.append('file',files);
        fd.append('typed',typed);

        // AJAX request
        $.ajax({
            url: 'ajaxfile.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                    // Show image preview
                    document.getElementById('preview').innerHTML=response;
                }else{
                    alert('file not uploaded');
                }
            }
        });
}});
});
</script>
<!-- end -->  
<!--post-->


<div class="templatemo-content-container">

<div class="templatemo-flex-row flex-content-row">           
</div> 

<div class="col-1">
    <div class="panel panel-default margin-10">
            
      <div class="panel-body">  
      <!--post body-->
      <?php
           include('func1.php');
           

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

</script> 
  </body>
</html>