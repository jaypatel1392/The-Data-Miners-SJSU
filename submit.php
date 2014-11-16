<?php
include("dbconnect.php");
?>
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
	<h1><a href="../index.php">JAT Hotels</a></h1>
</div>
<div id="menu-wrapper">
	<div id="menu" class="container">
		<ul>
			<li><a href="../index.php">Homepage</a></li>
			<li class="current_page_item"><a href="rent.php">Rent a Room</a></li>
			<li><a href="manager/login.php">Manager Login</a></li>
			<li><a href="cancel.php">Cancel Reservation</a></li>
			<li><a href="#">About Us</a></li>
			<li><a href="#">Contact Us</a></li>
		</ul>
	</div>
</div>
<div id="page" class="container">
	<div id="box1">
		<h2 class="title"><a href="#">Welcome to JAT Hotels</a></h2>
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
					$query = "INSERT INTO customer VALUES( '$counter', '$HID', '$room', '$name', '$address', '$credit', '$smoke', '$sDate', '$eDate', '$discount');"; 
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
	<p>&copy; Untitled. All rights reserved. Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. </p>

</div>
</body>
</html>
