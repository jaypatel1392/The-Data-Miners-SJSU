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
		<li class="current_page_item"><a href="rating_view.php">Hotel Ratings</a></li>
		<li><a href="feedback.php">Leave Feedback</a></li>
	</ul>
</div>

<div id="page" class="container">
	<div id="box1">
		<h2 class="title"><a>Hotel Ratings</a></h2>
		<div style="clear: both;">&nbsp;</div>
		<div class="entry">
			<?php
				$query  = "SELECT * FROM viewratings";
				$result = $conn->query($query);
				if (mysqli_num_rows($result) > 0) {	
					$prev = null;                         // keeps track if Hotel name needs to be echo'd
					$rating_echo = false;                 // keeps track if the rating has been echo'd or not
					while ($row = $result->fetch_assoc()) // loop through viewratings view
					{
						// first time entering loop OR looking at reviews for new hotel
						if (is_null($prev) || $prev['companyName'] != $row['companyName']) {
							echo "<h3>" . $row['companyName'] . " hotel</h3>";
						} else {
							if (empty($row['review'])) {
								echo $row['rating'] . " stars: no comment.<br/><br/>";
							} else {
								echo $row['rating'] . " stars: " . $row['review'] . "<br/><br/>";
							}
							$rating_echo = true;
						}
						// ratings have not been echo'd, echo them						
						if (!$rating_echo) { 
							if (empty($row['review'])) {
								echo $row['rating'] . " stars: no comment.<br/><br/>";
							} else {
								echo $row['rating'] . " stars: " . $row['review'] . "<br/><br/>";
							}
						}						
						$prev = $row;         // 'incrementing' here
						$rating_echo = false; // set rating_echo back to false for next iteration
					}
				} else {
					echo "<b>Look what we have here... Or lack thereof.</b>
					<br/><br/>We currently do not have any reviews to dispaly.
					<br/>It looks like you will be the first to leave a review.";
				}
			?>
		</div>
	</div>
	<div id="box2">
		<h2><a>Average Ratings</a></h2>
		<?php
			$hotels     = $conn->query("SELECT companyName FROM hotels GROUP BY companyName ORDER BY companyName");
			$avg_rating = "SELECT avg(rating) as avg, companyName FROM viewratings WHERE companyName='";
			while ($row = $hotels->fetch_assoc())
			{
				$query  = $avg_rating . $row['companyName'] . "'";        // sets up query
				$result = $conn->query($query);                           // gets average rating for particular hotel
				if (mysqli_num_rows($result) > 0) {                       // oh, there's something for this hotel
					foreach ($result as $res)
					{
						if ($row['companyName'] == $res['companyName']) { // double checking
							echo "<b>" . $row['companyName'] . "</b>: " . $res['avg'] . "<br><br>";
						}
					}
				} else {
					echo "<b>Womp, womp, womp.</b><br/>No reviews to display";
				}
			}
		?>
	</div>
	<div id="box3">
		<h2><a>Friendly Filter</a></h2>
		<form method="post" action="rating_viewfilter.php">
		<?php
			$hotels = $conn->query("SELECT * FROM hotels GROUP BY companyName ORDER BY companyName");
			while ($row = $hotels->fetch_assoc())
			{
				$h_name = $row['companyName'];
				// make a checklist for filter with the hotel names
				echo "<input type=\"checkbox\" name='hotels[]' value='" . $h_name . "'>" . $h_name . "</input><br>";
			}
		?>
		<br>
		<input type='submit' value='Filter'></input>
		</form>
	</div>
</div>

<div id="footer" class="container">
	<p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
</div>
</body>
</html>