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
	<?php
		$hotelname = $_SESSION['hotelname'];
		$managername = $_SESSION['managername'];
		
		print "<h2 align='center'>$hotelname Manager Services</h2>"; 
		print "<h3 align='center'>Welcome $managername</h3>";
		print "\n\n";
		
		print "<table align='center'>
				<tr align='center'>
					<td>
						<button onclick='window.location.href = \"view_rev.php\" '  class=\"btn\" >View Revenue</button>
					</td>
				</tr>
			   <tr align='center'>
					<td>
						<button onclick='window.location.href = \"charge.php\" '  class=\"btn\" >Charge Customer</button>
					</td>
			   </tr>
			   
			  	<tr align='center'>
					<td>
						<button onclick='window.location.href = \"assign_new_room.php\" '  class=\"btn\" >Assign New room to Customer</button>
					</td>
			  	</tr>
			   
			   <tr align='center'>
					<td>
						<button onclick='window.location.href = \"cancel_reservation.php\" '  class=\"btn\" >Cancel Customer's Reservation</button>
					</td>
			  </tr>
			  
			  <tr align='center'>
					<td>
						<button onclick='window.location.href = \"check-available-rooms.php\" '  class=\"btn\" >Check Available Rooms</button>
					</td>
			  </tr>
			  <tr align='center'>
					<td>
						<button onclick='window.location.href = \"hire.php\" '  class=\"btn\" >Hire an employee</button>
					</td>
			  </tr>
			<tr align='center'>
					<td>
						<button onclick='window.location.href = \"fire.php\" '  class=\"btn\" >Fire an employee</button>
					</td>
			  </tr>
			  </table>";
	?>
</div>


<div id="footer" class="container">
	<p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
</div>
</body>
</html>