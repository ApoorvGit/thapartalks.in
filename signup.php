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
	    
	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
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
	        <form action="signup.php" class="templatemo-login-form" method="post" onsubmit="return(validate());">
			<?php
     if(isset($_POST['email'])){

  
		 $fname=$_POST['fname'];
		 $lname=$_POST['lname'];
		 $email=$_POST['email'];
		 $pwd=$_POST['pwd'];
		 $confirmpwd=$_POST['confirmpwd'];
		 
		$query="SELECT COUNT(email) FROM logindetails where email='$email' ";
		$run=mysqli_query($con,$query);
		$data=mysqli_fetch_assoc($run);
		if($data['COUNT(email)']>0){
			echo '<h4 style="color:red;">*The Email is already registered</h4>';
		}
		else if($pwd!=$confirmpwd){
			echo '<h4 style="color:red;">*Enter same password in password and repeat password field</h4>';
		}
		else if(strlen($pwd)<8){
			echo '<h4 style="color:red;">*Password must be atleat 8 character long</h4>';

		}
		else{
			$pwd=md5(mysqli_real_escape_string($con,$pwd));
			$vcode = mt_rand(10000000,99999999); 
			$query="DELETE FROM verify WHERE email='$email' ";
			$run=mysqli_query($con,$query);
			$query="INSERT INTO `verify`(`email`, `pwd`, `fname`, `lname`,`vcode`) VALUES ('$email','$pwd','$fname','$lname','$vcode')";
			$run=mysqli_query($con,$query);
			$query="SELECT vID FROM verify where email='$email' ";
			$run=mysqli_query($con,$query);
			$data=mysqli_fetch_assoc($run);
			$vID=$data['vID'];
			$_SESSION['vID']=$vID;
			$_SESSION['vEmail']=$email;
			include_once("sendMail.php");
			$message="Welcome to ThaparTalks.in \r\n ".$fname." ".$lname."\r\nYour OTP for is ".$vcode;
			$to=$email;
			$from="noreply@thapartalks.in";
			$subject="Welcome! Confirm your email.";
			sendMail($message,$to,$from,$subject);
		    header('location: verify.php');
		}

		
		 
		 

		 
	 }
	 ?>
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input required type="text" class="form-control" name="fname" placeholder="First Name" id="fname">           
		          	</div>	
				</div>
				<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input required type="text" class="form-control" name="lname" placeholder="Last Name" id="lname">           
		          	</div>	
				</div>
				<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input required type="text" class="form-control" name="email" placeholder="Email ID">           
		          	</div>	
	        	</div>
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>	        		
		              	<input required type="password" class="form-control" name="pwd" placeholder="Password" id="psw"
						  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
						  title="Must contain at least one number,one uppercase,one lowercase letter,and at least 8 or more characters" required>           
		          	</div>	
				</div>	 
				<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>	        		
		              	<input  type="password" class="form-control" name="confirmpwd" placeholder="Repeat Password" id="conpsw" required>           
		          	</div>	
	        	</div>         	
	          <div id="conf" style="color:red;  padding: 10px 35px;"></div>
				<div class="form-group">
					<button type="submit" name="submit" class="templatemo-blue-button width-100">Send OTP</button>
				</div>
	        </form>
		</div>
		<div id="message" class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
		<h3>Password must contain the following :</h3>
		<p id="letter" class="invalid">A<b> Lowercase</b> letter</p>
		<p id="capital" class="invalid">A<b> Capital</b> letter</p>
		<p id="number" class="invalid">A<b> Number</b></p>
		<p id="length" class="invalid">Minimum <b>8 characters</b></p>
		</div>
		<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
			<p>Have an account? <strong><a href="login.php" class="blue-text">Log In</a></strong></p>
		</div>
		
		<?php }
		else{
			header('location: index.php');
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
