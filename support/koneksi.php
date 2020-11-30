<?php 


$servername = "localhost";
  $username = "root";
  $password = "";
 $dbname = "u6126859_kp";

// crearte connection
$connect = new Mysqli($servername, $username, $password, $dbname);

// check connection
if($connect->connect_error) {
	die("Connection Failed : " . $connect->error);
} else {
	// echo "Successfully Connected";	
}
date_default_timezone_set("Asia/Bangkok");

?>
