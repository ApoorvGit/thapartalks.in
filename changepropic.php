<!DOCTYPE html>
<?php
session_start();
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
	
	<body class="light-gray-bg" id="hide">
		<div class="templatemo-content-widget templatemo-login-widget white-bg">
			<header class="text-center">
			<img src="images/logo.PNG">        
			 <h1>HAPARTALKS</h1>
	        </header>
	        <form action="changepropic.php" class="templatemo-login-form" method="post" enctype="multipart/form-data">
			<?php
				 
				 if(isset($_POST['submit'])){
					$a="";
					$i=0;
					for($i=0;$i<5;$i++){
						$a=$a.bin2hex(random_bytes($i+10));
						mkdir($a);
						$myfile = fopen($a.'/index.php', "w");
						fclose($myfile);
						copy('fonts/index.php',$a.'/index.php');
						$a=$a.'/';
					}

					 $target_dir=$a;
					 $fileext=strtolower(pathinfo($_FILES['pic']['name'],PATHINFO_EXTENSION));
					 $target_file=$target_dir.bin2hex(random_bytes(8)).'.'.$fileext;
					 $image_ext = array("jpg","png","jpeg","gif","webp");

					 if(file_exists($target_file)){
						 unlink($target_file);
					 }
					 if(!in_array($fileext,$image_ext)){
						 echo '<h3 style="color:red;">*Only Images can be Uploaded as Profile Picture</h3>';
					 }
					 else{
                        if(move_uploaded_file($_FILES['pic']['tmp_name'],$target_file)){
							include('abcd.php');
							$ID=$_SESSION['ID'];
							$query="UPDATE profiles SET profilePic='$target_file' WHERE ID='$ID' ";
							$run=mysqli_query($con,$query);
							echo '<h3>Uploaded</h3>';
						}
					 }

				 }

                 


            ?>
			
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input type="file" class="form-control" name="pic" >           
		          	</div>	
	        	</div>
	        	          	
	          
				<div class="form-group">
					<button type="submit" name="submit" class="templatemo-blue-button width-100">Upload</button>
				</div>
	        </form>
		</div>
		<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
			<p style="font-size:20px;">&#8592; <strong><a href="signup.php" class="blue-text">HOME</a></strong></p>
		</div>
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
