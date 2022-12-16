<?php

      if(!isset($_COOKIE['link'])){
          header('location: watch.php');
      }
      setcookie('link',$_COOKIE['link']-1);
      header('location: watch.php');


?>