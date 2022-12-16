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
     if(isset($_SESSION['reset'])){
         if(!isset($_POST['pin'])){

		?>
	    <form action="setNewPassword.php" class="templatemo-login-form" method="post">
        <p><center><h2>OTP Sent</h2></center></p>
        <p><center><h5><?php echo $_SESSION['reset'];?></h4></center></p>
        <div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>	        		
		              	<input required type="number" class="form-control" name="pin" placeholder="Pin" required>           
		          	</div>	
		 </div>
         <div class="form-group">
					<center><button type="submit" name="submit" class="templatemo-blue-button width-100">Verify</button></center>
		  </div>
		</form>
		 

	<?php	 
     }
     else{
         $otp=$_POST['pin'];
         $email=$_SESSION['reset'];
         $query="SELECT * FROM forgotPassword WHERE email='$email' ";
         $run=mysqli_query($con,$query);
         $data=mysqli_fetch_assoc($run);
         if($otp==$data['otp']){
           $_SESSION['verified']=1276;
             ?>
            <form action="setNewPassword1.php" class="templatemo-login-form" method="post">
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
					<button type="submit" name="submit" class="templatemo-blue-button width-100">UPDATE</button>
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
            
            
<?php
         }
         else{
             echo "<center><h2>Wrong OTP!!</h2></br><a href='forgotPassword.php'><button class='templatemo-blue-button width-100'>Generate New OTP</button></a></center>";
         }
     }
    }
     else{
         header('location: login.php');
     }
	 ?>
	        	
		
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
