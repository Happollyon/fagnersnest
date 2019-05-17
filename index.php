<?php

require_once 'header.php';
echo"<br><span calss='main'>welcome to $appname,</span>";
if($loggedin)

    echo "$user, you are logged in";
else echo" please sign up and/or log in to join in.";
?>