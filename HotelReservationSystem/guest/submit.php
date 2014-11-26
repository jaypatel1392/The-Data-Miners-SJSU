<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
<link href="../default.css" rel="stylesheet" type="text/css" media="all" />

<?php include("../dbconnect.php") ?>
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body>
<div id="logo" class="container">
	<h1><a href="../index.php">JAT HOTEL RESERVATION</a></h1>
</div>
<div id="menu" class="container">
	<ul>
		<li><a href="../index.php">Homepage</a></li>
       	<li><a href="rent.php">Reserve a Room</a></li>
		<li><a href="cancel.php">Cancel Reservation</a></li>
		<li><a href="rating_view.php">Hotel Ratings</a></li>
		<li><a href="feedback.php">Leave Feedback</a></li>
	</ul>
</div>
<div id="page" class="container">
	<div id="box1">
		<h2 class="title"><a>JAT Hotels Room Reservation</a></h2>
		<div style="clear: both;">&nbsp;</div>
		<div class="entry">
			<?php 
				$error = false;
				$hotel = $_POST['hotel'];
				$room = $_POST['room'];
				$eDate = $_POST['eDate'];
				$sDate = $_POST['sDate'];
				$name = mysqli_real_escape_string($conn,$_POST['name']);
				$address = mysqli_real_escape_string($conn,$_POST['address']);
				$credit = mysqli_real_escape_string($conn,$_POST['CC']);
				$discount = mysqli_real_escape_string($conn,$_POST['discount']);
				$smoke = mysqli_real_escape_string($conn,$_POST['smoke']);
				if(empty($hotel) || empty($room) || empty($name) || empty($address) || empty($credit) || empty($smoke))
				{
					$error = true;
				}
				if($error)
					echo "<p>You must fill out the form correctly! Please try to make a reservation again </p>";
				else
				{
					$sql = "SELECT hID FROM hotels WHERE companyName = '$hotel'";
					$result = $conn->query($sql);
					$HID = $result->fetch_assoc();
					$HID = $HID['hID'];
					$sql = "SELECT count(*) AS number FROM customer";
					$result = $conn->query($sql);
					$counter = $result->fetch_assoc(); 
					$counter = $counter['number'];
					$query =  "INSERT INTO `customer` (`cID`, `hID`, `rID`, `name`, `address`, `ccNo`, `smoker`, `rStartDate`, `rEndDate`, `discount`, `updatedAt`)  VALUES( '$counter', '$HID', '$room', '$name', '$address', '$credit', '$smoke', '$sDate', '$eDate', '$discount', CURRENT_TIMESTAMP);"; 
					$result = mysqli_query($conn, $query);
					if (!$result)
					{
						die('Invalid query: ' . mysqli_error($conn));
					}
					echo "<p>Successfully added your reservation for $hotel in " . $_POST['location'] . " room: $room on $sDate to $eDate</p>";
					echo "<p>Your is Hotel ID is: " . $HID . " , your Room Number is $room and your customer ID is: $counter. You can use this informaton to view or cancel your reservation.";
				}
					
			?>	
		</div>
	</div>
	
</div>
<div id="footer" class="container">
	<p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
</div>
</body>
</html>
