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
       	<li class="current_page_item"><a href="rent.php">Reserve a Room</a></li>
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
		<form action="rentcheck.php">
			<p>Please enter the start date of your reservation (YYYY-MM-DD):</p>
			<input type="text" name="startDate"></input>
			<p>Please enter the end date of your reservation (YYYY-MM-DD):</p>
			<input type="text" name="endDate"></input>	
			<p>Please select from one of our many locations:</p>
			<select name="location">
			<option value="San Francisco">San Francisco</option>
			<option value="New York">New York</option>
			<option value="Boston">Boston</option>
			<option value="Chicago">Chicago</option>
			<option value="Las Vegas">Las Vegas</option>
			</select><br><br><br>
		<input type="submit" value="Check for available rooms!">	
		</form>
		</div>
	</div>
	
</div>
<div id="footer" class="container">
	<p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
</div>
</body>
</html>