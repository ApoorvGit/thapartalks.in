<?php
 $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
 $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$url=$_SERVER['HTTP_HOST'];
$url=$protocol.$url;
header("location: $url");
?>