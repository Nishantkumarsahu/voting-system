<?php
$cnn = mysqli_connect("127.0.0.1","root","","voting");
if(!$cnn) { echo "Connect error: ".mysqli_connect_error(); }
else { echo "Connected OK"; }
?>
