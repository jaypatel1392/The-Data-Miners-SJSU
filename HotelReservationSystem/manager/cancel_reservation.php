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

<?php 
session_start();
include("../dbconnect.php") ?>
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
		<li><a href="home.php">Manager Homepage</a></li>
        <li><a href="logout.php">Logout</a></li>
	</ul>
</div>

<div class="container">
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post"> <!--SEND TO charge.php afterwards -->
	<?php
		$hotelname = $_SESSION['hotelname'];
		$hID = $_SESSION["hid"]; 
		$managername = $_SESSION['managername'];
		print "<h2 align='center'>$hotelname Manager Services</h2>"; 
		print "<h3 align='center'>Welcome $managername</h3>";
		$sql = "SELECT * FROM customer where hID = $hID";
		$result = mysqli_query($conn, $sql);
		      
        if($result) {
			print "<p><label class=\"formtext\">Cancel Customer's Reservation: </label>";
			print "<select name=\"customer\" class=\"inputs\">";   
			
			$cid = -1;
            while(list($cID, $hid, $rID, $name, $address, $ccNo, $somker, $rStartDate, $rEndDate, $discount) = mysqli_fetch_array($result)) {
				$info = $rStartDate . "," . $rEndDate . "," . $rID . "," . $name;
				print "<option value='$info'>$name staying at Room #$rID</option>";
			}
			print "</select></p>";
			print "<p><input type=\"submit\" class=\"btn\"/></p>";
        }
		print "</form>";
		
		$formSubmitted = $_SERVER["REQUEST_METHOD"] == "POST";
		if($formSubmitted) {
			$values = $_POST['customer'];
			$in = explode(",", $values);
			
			$rStartDate = $in[0];
			$rEndDate = $in[1];
			$rID = $in[2];
			$name = $in[3];
			
			$query = "select location from hotels where hID=$hID";
			$city = $conn->query($query);
			$city = $city->fetch_assoc();
			$city = $city['location'];
			
			$conn = new PDO("mysql:=host=$servername;dbname=$dbname", $username, $password);
			$stmt = $conn->prepare("CALL cancelReservation(:sDate, :eDate, :hotel, :roomID, :city)");
			
			$stmt->bindParam(':sDate', $rStartDate, PDO::PARAM_STR);
			$stmt->bindParam(':eDate', $rEndDate, PDO::PARAM_STR);
			$stmt->bindParam(':hotel', $hotelname, PDO::PARAM_STR); 
			$stmt->bindParam(':roomID', $rID, PDO::PARAM_INT);
			$stmt->bindParam(':city', $city, PDO::PARAM_STR);


			// call the stored procedure
			if ($stmt->execute()) {				
				print "<span align='center'>";
				print "<p><label class=\"formtext\">Successfully cancelled $name's reservation.</label></p>";
				print "<p align='center'><button onclick='window.location.href = \"home.php\" ' class=\"btn\" >Back to Home!</button></p>";
				print "</span>";
			}
			
			$stmt->closeCursor();
		}
	?>
</div>


<div id="footer" class="container">
	<p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
</div>
</body>
</html>