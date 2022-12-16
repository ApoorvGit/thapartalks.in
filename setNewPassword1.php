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
	    <title>THAPARTALKS - SignUp</title>
        <meta name="description" content="">
        <meta name="author" content="templatemo">
        
	    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
	    <link href="css/font-awesome.min.css" rel="stylesheet">
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="css/templatemo-style.css" rel="stylesheet">
		<link href="css/signup.css" rel="stylesheet">
	</head>
	<?php 
	    if(!isset($_SESSION['email'])){
			?>
	<body class="light-gray-bg" id="hide">
		<div class="templatemo-content-widget templatemo-login-widget white-bg">
			<header class="text-center">
			<img src="images/logo.PNG">        
			 <h1>THAPARTALKS</h1>
	        </header>
    <?php
     if(isset($_SESSION['verified'])){
         
            
                 echo "<p><center><h2>OTP verified</center></h2></br><center><h3>Login with New Password</h3></center></p>";
                 $email=$_SESSION['reset'];
                 $pwd=md5(mysqli_real_escape_string($con,$_POST['pwd']));
                 $query="UPDATE logindetails SET pwd='$pwd' WHERE email='$email' ";
                 $run=mysqli_query($con,$query);
                 session_unset();
                 session_destroy();
                 $query="DELETE FROM forgotpassword WHERE email='$email' ";
			     $run=mysqli_query($con,$query);
                 ?>
                 <div class="form-group">
                 <a href="index.php"><center><button type="submit" name="submit" class="templatemo-blue-button width-100">LOGIN</button></center></a>
                 </div>
       <?php
             }
         
         else{
             header('location: forgotpassword.php');
         }	 
     }
     else{
         header('location: login.php');
     }
	 ?>
				<script src="js/signup.js"></script>
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
