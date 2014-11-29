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
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post"> <!--SEND TO check-available-rooms.php afterwards -->
        <?php
			function create_form() {
				print "<p><label class=\"formtext\">View available rooms in range:     </label>";
				print "<input class=\"formtext\" type='text' name='startDate' placeholder='Start Time [yyyy-mm-dd]' required></input>";
				print "    ";
				print "<input class=\"formtext\" type='text' name='endDate' placeholder='End Time [yyyy-mm-dd]' required></input></p>";					
				print "<p>";
				print "<label class=\"formtext\">Check available rooms by: </label>";
				print "<input type='radio' name='date' value='date' >";
				print "<label class=\"formtext\">Date</label>";
				print "<input type='radio' name='date' value='month'>";		
				print "<label class=\"formtext\">Month</label>";
				print "</p>";
				
				print "<p><input type=\"submit\" class=\"btn\"/></p><br/>";
				print "</form>";
			} 
		?>
        
		<?php
			$hotelname = $_SESSION['hotelname'];
			$managername = $_SESSION['managername'];
			$hID = $_SESSION['hid'];
			print "<h2 align='center'>$hotelname Manager Services</h2>"; 
			print "<h3 align='center'>Welcome $managername</h3>";
			print "<br/><br/>";
			
			create_form();
			
			$formSubmitted = $_SERVER["REQUEST_METHOD"] == "POST";
			if($formSubmitted) {
				$startDate = $_POST['startDate'];
				$endDate = $_POST['endDate'];
				$filter = $_POST['date'];
				
				$startdate = date('Y-m-d', strtotime($startDate));
				$enddate = date('Y-m-d', strtotime($endDate));
				
				if(empty($startDate) || empty($endDate)) {
					print "<p align='center'><label class=\"formtext\">You must fill out both Start Date and End Date</label></p>";
					print "<p align='center'><button onclick='window.location.href = \"check-available-rooms.php\" '  class=\"btn\" >Retry</button></p>";
				}
				
				if($endDate < $startDate) {
					print "<p align='center'><label class=\"formtext\">END DATE MUST BE GREATER THAN START DATE, PLEASE TRY AGAIN</label></p>";
					print "<p align='center'><button onclick='window.location.href = \"check-available-rooms.php\" '  class=\"btn\" >Retry</button></p>";
				} else {
					if($filter == 'date') {
						$sql = "SELECT rID 
								FROM 
									(SELECT rID, hID
									 FROM rooms
									 WHERE hID = '$hID') AS a 
								LEFT OUTER JOIN 
									(SELECT rID, hID
									FROM customer
									WHERE (rStartDate >= '$startDate' AND  rEndDate <= '$endDate') AND hID = '$hID') AS b 
								USING (rID, hID)
								WHERE b.rID IS NULL";
						$result = mysqli_query($conn, $sql);
						
						if($result) {
							print "<p align='center'><label class=\"formtext\">Rooms available between $startDate and $endDate are: </label></p>";
							
							print "<table align='center'>";
            				while(list($room) = mysqli_fetch_array($result)) {								
								print "<tr align='center'><td><label class=\"formtext\">$room</label><td></tr>";
							}
							print "</table>";
						} else {
							print "<p align='center'><label class=\"formtext\">Something Went Wrong</label></p>";
						}
					} else {
						$sql = "SELECT rID 
								FROM 
									(SELECT rID, hID
									FROM rooms
									WHERE hID = $hID) AS a 
								LEFT OUTER JOIN 
									(SELECT rID, hID
									FROM customer
									WHERE (DATE_FORMAT(rStartDate, \"%Y-%m\") >= DATE_FORMAT('$startDate', \"%Y-%m\") 
											AND  DATE_FORMAT(rStartDate, \"%Y-%m\") <= DATE_FORMAT('$endDate', \"%Y-%m\")) AND hID = $hID) AS b USING (rID, hID)
								WHERE b.rID IS NULL";
						$result = mysqli_query($conn, $sql);
						
						if($result) {
							print "<p align='center'><label class=\"formtext\">Rooms available between $startDate and $endDate are: </label></p>";
							
							print "<table align='center'>";
            				while(list($room) = mysqli_fetch_array($result)) {								
								print "<tr align='center'><td><label class=\"formtext\">$room</label><td></tr>";
							}
							print "</table>";
						} else {
							print "<p align='center'><label class=\"formtext\">Something Went Wrong</label></p>";
						}
					}
				}
				print "<p align='center'><button onclick='window.location.href = \"home.php\" ' class=\"btn\" >Back to Home!</button></p>";	
			}
		?>
</div>


<div id="footer" class="container">
	<p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
</div>
</body>
</html>