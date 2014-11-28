<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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
		print "<br/><br/>";
		
		$sql = "SELECT * FROM customer where hID = $hID";
		$result = mysqli_query($conn, $sql);
		      
        if($result) {
			print "<p><label class=\"formtext\">Choose a customer: </label>";
			print "<select name=\"customer\" class=\"inputs\">";   
			
			$cid = -1;
            while(list($cID, $hid, $rID, $name, $address, $ccNo, $somker, $rStartDate, $rEndDate, $discount) = mysqli_fetch_array($result)) {
				$list = array("$cID", "$rID", "$name", "$address", "$ccNo", "$smoker", "$rStartDate", "$rEndDate", "$discount");
				$info = implode("//", $list);
				print "<option value='$info'> $name staying at Room #$rID</option>";
			}
			print "</select></p>";
			
			print "<br/>";
			
			print "<p>";
			print "<label class=\"formtext\">Reassign a new room to: </label>";
			print "<input type='radio' name='change_value' value='true'>";
			print "<label class=\"formtext\">Smoking Room</label>";
			print "<input type='radio' name='change_value' value='false'>";		
			print "<label class=\"formtext\">Non-Smoking Room</label>";
			print "</p>";
			
			print "<p><input type=\"submit\" class=\"btn\"/></p>";
        }
		print "</form>";
		
		$formSubmitted = $_SERVER["REQUEST_METHOD"] == "POST";
		if($formSubmitted) {
			
			$values = explode("//", $_POST['customer']);
			$smoke = $_POST['change_value'];
			$startDate = $values[6];
			$endDate = $values[7];
						
			$sql = "SELECT MIN(rooms.rID) rID FROM rooms where hID = $hID and rID NOT IN (SELECT rooms.rID
					                           											 FROM customer JOIN rooms  
					                             										 WHERE customer.rID = rooms.rID
																						 AND customer.hID = $hID
					                            										 AND rStartDate <= '$startDate'
					                            										 AND rEndDate >=  '$endDate')
																		  and smoking = $smoke";
			$result = mysqli_query($conn, $sql);
			
				if ($result) {
					while(list($rID) = mysqli_fetch_array($result)) {
						$customerId = $values[0];
						$update_customer = "UPDATE customer SET rID = $rID WHERE cID = $customerId AND hID = $hID";
						mysqli_query($conn, $update_customer);
						
						if(mysql_affected_rows() >= 0) {
							$c_name = $values[2];
			
							print "<span align='center'>";
							print "<p><label class=\"formtext\">$c_name your new Room is $rID</label></p>";
							print "<p align='center'><button onclick='window.location.href = \"home.php\" ' class=\"btn\" >Back to Home!</button></p>";
							print "</span>";
						} else {	
							print "<span align='center'>";
							print "<p><label class=\"formtext\">Something went wrong, Please try again.</label></p>";
							print "<p align='center'><button onclick='window.location.href = \"home.php\" ' class=\"btn\" >Back to Home!</button></p>";
							print "</span>";
						}
					}
				}
		} 
	?>
</div>


<div id="footer" class="container">
	<p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
</div>
</body>
</html>