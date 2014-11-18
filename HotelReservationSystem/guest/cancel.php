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
		<li class="current_page_item"><a href="cancel.php">Cancel Reservation</a></li>
		<li><a href="feedback.php">Leave Feedback</a></li>
	</ul>
</div>

<div id="page" class="container">
	<div id="box1">
		<h2 class="title"><a>Cancel My Reservation, please.</a></h2>
		<div style="clear: both;">&nbsp;</div>
		<div class="entry">
		<form action="cancel_result.php">
			<br/>Please select your hotel and room number:
			<p>
				<select name="hotel">
					<option value='' style='display:none;'>Select Hotel</option>
					<option value="Hilton">Hilton</option>
					<option value="Marriott">Marriott</option>
					<option value="Embassy Suites">Embassy Suites</option>
					<option value="Hyatt">Hyatt</option>
					<option value="Caesars Palace">Caesars Palace</option>
				</select>
				<select name="roomid">
					<option value='' style='display:none;'>Room Number</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				</select>
			</p>
			<p>
				Please enter your reservation date (YYYY-MM-DD):<br/>
				<input type="text" name="startDate" placeholder="Start Date"></input>
				<input type="text" name="endDate" placeholder="End Date"></input>
			</p>
		<input type="submit" value="Submit Request">	
		</form>
		</div>
	</div>
</div>

<div id="footer" class="container">
	<p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
</div>
</body>
</html>