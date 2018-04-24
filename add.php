<?php
	session_start();
	$link = mysqli_connect("127.0.0.1", "root", "", "first_db");
	if($_SESSION['user']) {
		
	} else {
		header("location:index.php");
	}
	if($_SERVER['REQUEST_METHOD'] == "POST") {
	$userId = $_SESSION['user'];
	$details = mysqli_real_escape_string($link,$_POST['details']);
	$time = strftime("%X"); //time
	$date = strftime("%B %d, %Y"); //date
	$decision = "no";
	
	
	mysqli_select_db($link, "first_db") or die("Cannot connect to database");
	
	foreach($_POST['public'] as $each_check) {
		if($each_check != null) {
			$decision = "yes";
		}
	}
	
	mysqli_query($link, "INSERT INTO list(details, date_posted, time_posted, public, userId) VALUES
		('$details', '$date', '$time', '$decision', '$userId')"); ///SQL Query to insert post
		header("location:home.php");
	} else {
		header("location:home.php");
	}
	
	//Print "$time - $date - $details";
?>