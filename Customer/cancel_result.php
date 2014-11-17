<?php
include("dbconnect.php");
?>

<!DOCTYPE html>
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License
Name       : Doubtless 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130428
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css">
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body>
<div id="logo" class="container">
	<h1><a href="#">JAT Hotels</a></h1>
</div>
<div id="menu-wrapper">
	<div id="menu" class="container">
		<ul>
			<li><a href="index.php">Homepage</a></li>
			<li><a href="rent.php">Rent a Room</a></li>
			<li><a href="#">Manager Login</a></li>
			<li><a href="#">About Us</a></li>
			<li class="current_page_item"><a href="cancel.php">Cancel Reservation</a></li>
			<li><a href="#">Contact Us</a></li>
		</ul>
	</div>
</div>
<div id="page" class="container">
	<div id="box1">
		<h2 class="title"><a href="#">Welcome to JAT Hotels</a></h2>
		<div style="clear: both;">&nbsp;</div>
		<div class="entry">
			<p>I'm going to need to do something to show it was deleted successfully?</p>
			
			<?php 
				$sDate  = $_GET['startDate'];
				$eDate  = $_GET['endDate'];
				$hotel  = $_GET['hotel'];
				$roomNo = $_GET['roomNo'];
				
				$cid    = $conn->query("SELECT cID FROM customer 
										WHERE rStartDate = '$sDate' AND rEndDate = '$eDate'
										AND rID = '$roomNo';");
				$cid = $cid->fetch_assoc();
				$hID    = $conn->query("SELECT hID FROM hotels WHERE companyName = '$hotel'");
				$hID = $hID->fetch_assoc();
				$sql = "UPDATE rooms SET occupied=FALSE WHERE hID='" . $hID['hID'] . "' AND rID='$roomNo';";
				$conn->query($sql);
				
				$sql = "DELETE from customer WHERE cID = '" . $cid['cID'] . "' AND hID = '" . $hID['hID'] . "' AND rID = '$roomNo';";
				$conn->query($sql);
			?>
			
		</div>
	</div>
	
</div>
<div id="footer" class="container">
	<p>&copy; Untitled. All rights reserved. Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. </p>
</div>
</body>
</html>
