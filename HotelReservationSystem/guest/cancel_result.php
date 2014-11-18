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
				$sDate    = $_GET['startDate'];
				$eDate    = $_GET['endDate'];
				$hotel    = $_GET['hotel'];
				$roomNo   = $_GET['roomNo'];
				$bullshit = false;
				
				# check if input is empty or invalid data
				if (!$roomNo || !is_numeric($roomNo))
				{
					echo "<h1>WHOOOPS!</h1><p>It looks like you didn't fill out the form completely.</p>";
					
					#check to see if date is in format: YYYY-MM-DD
					if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$sDate) 
						|| !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$eDate) )
					{
						echo "<p>Please go back and fill out the following fields:
						</br>Date (YYYY-MM-DD)</br>Room Number</p>";
					} 
					else 
					{
						echo "<p>Please go back and fill in your room number</p>";
					}
					$bullshit = true;
				}
				else
				{
					# check to see if request is REALLY valid
					$hid = $conn->query("SELECT * from hotels WHERE companyName = '$hotel'");
					$hid = $hid->fetch_assoc();

					$sql = "SELECT * from customer WHERE rStartDate='$sDate' AND rEndDate='$eDate' AND rID='$roomNo'";
					$result = $conn->query($sql);
					$result = $result->fetch_assoc();
					
					if ($hid['hID'] != $result['hID'])
					{
						$bullshit = true;
						echo "<h1>We're sorry...</h1><p>Your reservation could not be found.<br>
						Please go back and make sure your have entered in the correct reservation information.</p>"; 
					}
				}
				
				if (!$bullshit)
				{			
					# drop or create stored procedure
					if(!$conn->query("DROP PROCEDURE IF EXISTS cancelReservation") || 
						!$conn->query("CREATE PROCEDURE cancelReservation(IN sDate DATE, IN eDate DATE, IN hotel VARCHAR(50) CHARSET utf8, IN roomid INT)
						BEGIN 
							#remove customer's parking reservation...
   						 	#will implement later

						    #remove customer
						    DELETE FROM customer
						    WHERE rID=roomid AND rStartDate=sDate AND rEndDate=eDate
						    AND hID=(SELECT hID FROM hotels WHERE companyName=hotel group by hID);
						END;"))
					{
						echo "Stored procedure creation failed: (" . mysqli_error($conn) . ")";
					}
					
					# calling stored procedure to cancel
					if (!$conn->query("CALL cancelReservation('$sDate', '$eDate', '$hotel', '$roomNo')"))
					{
						die('Invalid query: ' . mysqli_error($conn));
					}
					else 
					{
						echo "<h1>Hooray! Cancellation in process.</h1><p>Please save for your records.</p>";
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