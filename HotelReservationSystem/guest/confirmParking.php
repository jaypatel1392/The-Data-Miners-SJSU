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
       	<li><a href="rent.php">Reserve a Room</a></li>
		<li><a href="price_calculator.php">Compare Prices</a></li>
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
				$hotel = $_POST['HID'];
				$customer = $_POST['CID'];
				$parking = $_POST['pType'];
				if($parking == 'NonValet Parking')
				{
					$parking = 0;
				}
				else if($parking == "Valet Parking")
				{
					$parking = 1;
				}
			
				
					$sql = "SELECT max(pID) + 1 AS number FROM parking";
					$result = $conn->query($sql);
					$pcount = $result->fetch_assoc(); 
					$pcount = $pcount['number'];
					$query =  "INSERT INTO `parking` (`pID`, `hID`, `valet`, `cID`, `updatedAt`)  VALUES( '$pcount', '$hotel', '$parking', '$customer', CURRENT_TIMESTAMP);"; 
					$result = mysqli_query($conn, $query);
					if (!$result)
					{
						//die('Invalid query: ' . mysqli_error($conn));
						die('Oops... something went wrong!');
					}
					echo "<p>Successfully added your parking spot to your reservation for you</p>";
				
					
			?>	
		</div>
	</div>
	
</div>
<div id="footer" class="container">
	<p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
</div>
</body>
</html>