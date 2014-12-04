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
		<li class="current_page_item"><a href="feedback.php">Leave Feedback</a></li>
	</ul>
</div>

<div id="page" class="container">
	<div id="box1">
		<h2 class="title"><a>JAT Hotel Reservation Feedback</a></h2>
		<div style="clear: both;">&nbsp;</div>
		<div class="entry">
		<!--need to implement rate_check.php for form action-->
		<form action="rating.php">
			<p>
				<select name="hotel">
					<option value='' style='display:none;'>Select Hotel</option>
					<option value="Hilton">Hilton</option>
					<option value="Marriott">Marriott</option>
					<option value="Embassy Suites">Embassy Suites</option>
					<option value="Hyatt">Hyatt</option>
					<option value="Caesars Palace">Caesars Palace</option>
				</select>
				<select name="stars">
					<option value='' style='display:none;'>How Many Stars?</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</p>
			<p>Comments:<br/><textarea name="areview" rows="10" cols="85"></textarea></p>
			<input type="submit" value="Submit Feedback">
		</form>
		</div>
	</div>
	<div id="box2">
		<img src="../images/typetypetype.gif" alt="Typing Cat" style="width:120px;height:120px">
		<img src="../images/Caesarspalace.jpg" alt="Ceasars Palace" style="width:120px;height:120px">
		<img src="../images/EmbassySuites.jpg" alt="Embassy Suites" style="width:120px;height:120px">
		<img src="../images/Hilton.jpg" alt="Hilton" style="width:120px;height:120px">
		<img src="../images/Hyatt.jpg" alt="Hyatt" style="width:120px;height:100px">
		<img src="../images/Marriott.jpg" alt="Marriott" style="width:120px;height:120px">
	</div>
	<div id="box3">
		<h2><a>Other Ratings</a></h2>
		<?php
			$hotels     = $conn->query("SELECT companyName FROM hotels GROUP BY companyName ORDER BY companyName");
			$avg_rating = "SELECT avg(rating) as avg, companyName, review FROM viewratings WHERE companyName='";
			while ($row = $hotels->fetch_assoc())
			{
				$query  = $avg_rating . $row['companyName'] . "'";        // sets up query
				$result = $conn->query($query);                           // gets average rating for particular hotel
				if (mysqli_num_rows($result) > 0) {                       // oh, there's something for this hotel
					foreach ($result as $res)
					{
						if ($row['companyName'] == $res['companyName']) { // double checking
							echo "<b>" . $row['companyName'] . "</b>: " . $res['avg'];
							echo "<br/>" . $res['review'] . "<br/><br/>";
						}
					}
				} else {
					echo "<b>Womp, womp, womp.</b><br/>No reviews to display";
				}
			}
		?>
	</div>
</div>

<div id="footer" class="container">
	<p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
</div>
</body>
</html>