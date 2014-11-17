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
	<h1><a href="../index.html">JAT HOTEL RESERVATION</a></h1>
</div>
<div id="menu" class="container">
	<ul>
		<li><a href="../index.html">Homepage</a></li>
       	<li><a href="rent.php">Reserve a Room</a></li>
		<li><a href="cancel.php">Cancel Reservation</a></li>
	</ul>
</div>

<div id="page" class="container">
	<div id="box1">
		<h2 class="title"><a href="#">Welcome to JAT Hotels</a></h2>
		<div style="clear: both;">&nbsp;</div>
		<div class="entry">
			
			
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
				$result = $conn->query($sql);
				if (!$result)
				{
					die('Invalid query: ' . mysqli_error($conn));
				}
				else 
				{
					echo "<p>We have successfully removed your reservation.</p>";
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