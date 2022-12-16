<html oncontextmenu="return false">
    <body>
    <center>
        <form action="moremsg.php" method="post">
           <button style="width:80px; height:30px; border:1px solid; border-radius:20%; background-color: #39ADB4; color: white;" name="load" type="submit">MORE</button>
         </form>
    </center>
</html>
<?php

if(isset($_POST['load'])){
    
    setcookie('load',$_COOKIE['load']+5);
    setcookie('more',1);
}
?>

