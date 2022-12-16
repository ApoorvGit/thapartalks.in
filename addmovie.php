<!DOCTYPE html>
<?php
session_start();
include_once("abcd.php");
?>
<html lang="en" oncontextmenu="return false">
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">  
		<link rel="icon" href="images/logo.PNG" type="image/PNG"> 
	    <title>Shmooze - Login</title>
        <meta name="description" content="">
        <meta name="author" content="templatemo">
        
	    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
	    <link href="css/font-awesome.min.css" rel="stylesheet">
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="css/templatemo-style.css" rel="stylesheet">
	    
	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<?php 
	    if(isset($_SESSION['email'])){
			?>
	<body class="light-gray-bg" id="hide">
		<div class="templatemo-content-widget templatemo-login-widget white-bg">
			<header class="text-center">
			<img src="images/logo.PNG">        
			 <h1>SMOOZE</h1>
	        </header>
	        <form action="addmovie.php" class="templatemo-login-form" method="post">
	
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input required type="text" class="form-control" name="name" placeholder="Show Name">           
		          	</div>	
				</div>
				<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input required type="text" class="form-control" name="link" placeholder="Link">           
		          	</div>	
				</div>
     	
	          	<div class="form-group">
				    				    
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="templatemo-blue-button width-100">Add</button>
				</div>
	        </form>
		</div>
		<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
			<p>Go Back <strong><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="blue-text"><img src="back2.png" style="width:30px; height:auto;"></a></strong></p>
		</div>
		
        <?php
             if(isset($_POST['link'])){
                 include('abcd.php');
                 $name=$_POST['name'];
                 $link=$_POST['link'];
                 $query="INSERT INTO `watch`(`name`, `link`) VALUES ('$name','$link')";
                 $run=mysqli_query($con,$query);
             }
    
    
    }
		else{
			header('location: login.php');
		}
		?>
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
