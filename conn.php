<?php

$conn = mysqli_connect("localhost","root","","emailactivation");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
 
?>