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
		<h2 class="title"><a>JAT Hotel Reservation Feedback</a></h2>
		<div style="clear: both;">&nbsp;</div>
		<div class="entry">
			
			<?php
				// grabbing vars
				$hotel    = $_GET['hotel'];
				$stars    = $_GET['stars'];
				$areview  = $_GET['areview'];
				
				$hid      = $conn->query("SELECT hID from hotels WHERE companyName = '$hotel'");
				$hid      = $hid->fetch_assoc();
				$hotelID  = $hid['hID'];
				$bullshit = false;
				
				// check if input is empty or invalid data
				if (!$hotel && !$stars)
				{
					$bullshit = true;
					echo "<h1>Whoop-dee-doo!</h1>
					<p>We would love to accept your feedback, but there seems to be none.
					<br/>Please go back and select your hotel and a 5-star rating.</p>";
				}
				else if (!$stars)
				{
					$bullshit = true;
					echo "<h1>WHOOOPSiE!</h1>
					<p>It looks like you didn't give the hotel a rating.
					<br/>Please go back to select a rating</p>";
				}
				else if (!$hotel)
				{
					$bullshit = true;
					echo "<h1>Aw man!</h1>
					<p>Which hotel did you want to give the ratings for?
					<br/>Please go back to select your hotel.</p>";
				}

				if (!$bullshit)
				{
					// calling stored procedure to cancel
					if (!$conn->query("CALL rateHotel('$hotelID', '$stars', '$areview')"))
					{
						die('Invalid query: ' . mysqli_error($conn));
					}
					else 
					{
						echo "Thank you for your feedback.";
					}
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