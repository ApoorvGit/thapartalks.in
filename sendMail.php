<?php
function sendMail($message,$to,$from,$subject){
   $headers = "From: ".$from;
   mail($to,$subject,$message,$headers);
}
?>