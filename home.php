<?php
session_start();
echo $_SESSION['fname']." ".$_SESSION['email'].$_SESSION['ID'];
?>