<?php 
session_start();
include_once("abcd.php");
$ID=$_SESSION['ID'];
$toID=$_COOKIE['chatwithID'];

?>
<!DOCTYPE html >
<html oncontextmenu="return false">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */

</style>
<body>
<?php
if(isset($_GET['error'])&&$_GET['error']=='type'){
  echo '<h3 style="color:red;"><center>Unsupported File Type</center></h3>';
}

?>
<a href="cnow.php"><img src="images/back.png" ></a>
<div style="margin-left: 27%; margin-top: 3%; border: 5px solid gray; max-width: 52%; border-radius: 7%;" id="box">
 <center>
  
  <label onclick="openForm1()"> <img style=" width:50%; height:auto; " src="images/music.png"></label>
  <label onclick="openForm2()"> <img style=" width:50%; height:auto; " src="images/photo.png"></br></label>
 
  <label onclick="openForm3()"> <img style=" width:50%; height:auto;" src="images/video.png"></label>
  <label onclick="openForm4()"> <img style=" width:50%; height:auto;" src="images/document.png"></label>
 
</center>
</div>
<div class="form-popup" id="mus">
  <form action="upload.php" class="form-container" method="POST" enctype="multipart/form-data">
    <h1>Music</h1>
    <input type="file" name="file" required>

    <button type="submit" name="type" value="music" class="btn">Upload</button>
    <button type="button" class="btn cancel" onclick="closeForm1()">Close</button>
  </form>
</div>

<div class="form-popup" id="ima">
  <form action="upload.php" class="form-container" method="POST" enctype="multipart/form-data">
    <h1>Images</h1>
    <input type="file" name="file" required>

    <button type="submit" name="type" value="image" class="btn">Upload</button>
    <button type="button" class="btn cancel" onclick="closeForm2()">Close</button>
  </form>
</div>
<div class="form-popup" id="vid">
  <form action="upload.php" class="form-container" method="POST" enctype="multipart/form-data">
    <h1>Video</h1>
    <input type="file" name="file" required>

    <button type="submit" name="type" value="video" class="btn">Upload</button>
    <button type="button" class="btn cancel" onclick="closeForm3()">Close</button>
  </form>
</div>
<div class="form-popup" id="doc">
  <form action="upload.php" class="form-container" method="POST" enctype="multipart/form-data">
    <h1>Document</h1>
    <input type="file" name="file" required>

    <button type="submit" name="type" value="doc" class="btn">Upload</button>
    <button type="button" class="btn cancel" onclick="closeForm4()">Close</button>
  </form>
</div>
<script src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
<script src="js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    
<script>
  function openForm1() {
  document.getElementById("mus").style.display = "block";
}

function closeForm1() {
  document.getElementById("mus").style.display = "none";
}
function openForm2() {
  document.getElementById("ima").style.display = "block";
}

function closeForm2() {
  document.getElementById("ima").style.display = "none";
}
function openForm3() {
  document.getElementById("vid").style.display = "block";
}

function closeForm3() {
  document.getElementById("vid").style.display = "none";
}
function openForm4() {
  document.getElementById("doc").style.display = "block";
}

function closeForm4() {
  document.getElementById("doc").style.display = "none";
}
</script>
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
