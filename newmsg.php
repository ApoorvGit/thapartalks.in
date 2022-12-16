<html oncontextmenu="return false">
<head>
</head>
<body>
<?php
     $chatwithID=$_POST["chatwithId"];
     setcookie('chatwithID','0',time()-600);
     setcookie('load',0,time()-600);
     setcookie('chatwithID',$_POST['chatwithID']);
     header('location: cnow.php');
?>
</body>

