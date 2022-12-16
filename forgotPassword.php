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
	    <title>THAPARTALKS - Login</title>
        <meta name="description" content="">
        <meta name="author" content="templatemo">
        
	    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
	    <link href="css/font-awesome.min.css" rel="stylesheet">
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="css/templatemo-style.css" rel="stylesheet">
	    
	   
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
	        <form action="forgotPassword.php" class="templatemo-login-form" method="post">
			<?php
     if(isset($_POST['email'])){
  
		 $email=mysqli_real_escape_string($con,$_POST['email']);
		 $query="SELECT fname FROM logindetails WHERE email='$email' ";
		 $run=mysqli_query($con,$query);
		 $data=mysqli_fetch_assoc($run);
		 if($data==NULL){
			 echo '<h4 style="color:red;">*The Email is not registered</h4>';
		 }
		 else{
             include_once("sendMail.php");
             $otp=mt_rand(10000000,99999999);
             $query="DELETE FROM forgotPassword WHERE email='$email' ";
             $run=mysqli_query($con,$query);
             $query="INSERT INTO `forgotPassword`(`email`,`otp`) VALUES ('$email','$otp')";
			 $run=mysqli_query($con,$query);
             $message="Hello ".$data['fname']."\r\n We got a request to reset your password.\r\nOTP to reset your password is ".$otp;
             sendMail($message,$email,"noreply@thapartalks.in","Reset Your Password");
             $_SESSION['reset']=$email;
             header('location: setNewPassword.php');
         }
		 

		 
	 }
	 ?>
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input type="text" class="form-control" name="email" placeholder="Email">           
		          	</div>	
	        	</div>
	        		          	
	          	
				<div class="form-group">
					<button type="submit" name="submit" class="templatemo-blue-button width-100">Send OTP</button>
				</div>
	        </form></br>
			<center><strong><a href="login.php" class="blue-text">Login</a></strong></center>
		</div>
		<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
			<p>Not a registered user yet? <strong><a href="signup.php" class="blue-text">Sign up now!</a></strong></p>
		</div>
		<?php }
		else{
			header('location: index.php');
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
