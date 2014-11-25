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
			<?php 
				$sDate = $_GET['startDate'];
				$eDate = $_GET['endDate'];
				$location = $_GET['location'];
				$error = false;
				if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$sDate) 
						|| !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$eDate) )
				{
					$error =  true;
				}
				
				if(!$error)
				{
					echo "<p>These are the rooms we found available on your selected date and location!</p>";
					$sql = "SELECT distinct hotels.hID AS HID, hotels.companyName AS CNAME, rooms.rID AS RID, rooms.smoking AS SMOKE, rooms.price AS PRICE
					FROM hotels NATURAL JOIN rooms JOIN customer
					WHERE location = '$location' 
					       AND rooms.rID NOT IN( SELECT rooms.rID
					                             FROM customer JOIN rooms
					                             WHERE customer.rID = rooms.rID
					                            		AND rStartDate <= '$sDate'
					                            		AND rEndDate >=  '$eDate')";
					$result = $conn->query($sql);
					$rs = $result->fetch_assoc();
				
					echo "<table>
				<thead>
			    <tr>	
				<th>HotelID</th>
				<th>Hotel Name</th>
				<th>Room Number</th>
				<th>Smoking</th>
				<th>Price</th>
			</tr>
		</thead>";
					$HID = array();
					$RID = array();
					while($row = mysqli_fetch_array($result))
					{   //Creates a loop to loop through results
						if($row['SMOKE'] == 1)
						{
							$row['SMOKE'] = "Yes";
						}
						else
						{
							$row['SMOKE'] = "No";
						}
					$HID[] = $row['CNAME'];
					$RID[] = $row['RID'];	
					echo "<tr><td>" . $row['HID'] . "</td><td>" . $row['CNAME'] . "</td><td>" . $row['RID'] . "</td><td>" . $row['SMOKE'] . "</td><td>" .$row['PRICE']. "</td></tr>"; 
					}
					$HID = array_unique($HID);
					echo "</table>";
					echo "<form action= submit.php method = 'post'>
						<p>Please Select a Hotel:</p>
						<select name= 'hotel'>";					
					foreach($HID as $item)
					{
						echo "<option value='$item'>$item</option>";
					}	
					echo "</select><br>";
					echo "<p>Please Select a room:</p>
						<select name= 'room'>";
					foreach($RID as $room)
					{
						echo "<option value='$room'>$room</option>";
					}
					echo "</select><br><br>
							<p>Please enter your name:</p>
				<input type='text' name='name'></input><br>
							<p>Please enter your address:</p>
				<input type='text' name='address'></input><br>
							<p>Please enter your credit card number:</p>
				<input type='text' name='CC'></input>
							<p>Please enter your discount amount:</p>
				<select name='discount'>
				<option value='0'>0%</option>
				<option value='5'>5%</option>
				<option value='10'>10%</option> 
				<option value='15'>15%</option>
				</select><br><br>
				<p>Are you a smoker?</p>
							<input type='radio' name='smoke' value='true'>Smoker
							<input type='radio' name='smoke' value='false'>Non Smoker
					<input type='hidden' name='sDate' value='$sDate' />
					<input type='hidden' name='location' value='$location' />
					<input type='hidden' name='eDate' value='$eDate' />";
					echo "<br><br><input type='submit' value='Confirm your reservation'>	
					</form>";	
				}
				else
					echo "<p>Please try again with a correct starting date and end date!</p>";
			?>
			
		</div>
	</div>
	
</div>
<div id="footer" class="container">
	<p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
</div>
</body>
</html>