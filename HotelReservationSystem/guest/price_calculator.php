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
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
</style>

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
       	<li><a href="rent.php">Reserve a Room</a></li>
       	<li class="current_page_item"><a href="price_calculator.php">Compare Prices</a></li>
		<li><a href="cancel.php">Cancel Reservation</a></li>
		<li><a href="rating_view.php">Hotel Ratings</a></li>
		<li><a href="feedback.php">Leave Feedback</a></li>
	</ul>
</div>

<div id="page" class="container">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post"> <!--SEND TO charge.php afterwards -->
	<?php
		$formSubmitted = $_SERVER["REQUEST_METHOD"] == "POST";
        echo "<div id=\"box3\"><h3>Filter Price for following Rooms: </h3>
    		<input type='radio' name='change_value' value='true'><label>Smoking Rooms Only</label><br/>
			<input type='radio' name='change_value' value='false'><label>Non-Smoking Rooms Only</label><br/>
			<input type='radio' name='change_value' value='both'><label>Smoking and Non-Smoking Rooms</label><br/>
			<input type=\"submit\"></div>
			</form>";
		
		function displayRev($option, $conn) {
			$sql = "SELECT companyName, avg(price) as price
					FROM ROOMS NATURAL JOIN HOTELS
					GROUP BY hID, SMOKING
					HAVING smoking = $option
					ORDER BY avg(price);";
			$result = mysqli_query($conn, $sql);
	        if($result) {
    	    	if ($option == 'true') {
	    	    	echo "<h2>Prices for Smoking Rooms</h2>";
	    	    } else {
	    	    	echo "<h2>Prices for Non-Smoking Rooms</h2>";
	    	    }
				echo "<table><tr>
								<th>
									Hotel Name
								</th>
								<th>
									Room Price
								</th>
					  		 </tr>";
				while($row = $result->fetch_assoc()) {
					print "<tr align='center'>";
       				print "<td>{$row['companyName']}</td>" .
						  "<td>{$row['price']}</td>"; 
					print "</tr>"; 	
				}
				echo "</table>";
	        }
		}
		
		function display($conn) {
			$sql = "SELECT companyName, min(price) as min, max(price) as max
					FROM ROOMS NATURAL JOIN HOTELS
					GROUP BY hID
					ORDER BY min(price), max(price);";
			$result = mysqli_query($conn, $sql);
	        if($result) {
				echo "<h2>Price Range for the Hotels: </h2>";
				echo "<table><tr>
								<th>
									Hotel Name
								</th>
									
								<th>
									Minimum Price
								</th>
								<th>
									Maximum Price
								</th>
					  		 </tr>";
				while($row = $result->fetch_assoc()) {
					print "<tr align='center'>";
       				print "<td>{$row['companyName']}</td>" .
						  "<td>{$row['min']}</td>" .
						  "<td>{$row['max']}</td>"; 
					print "</tr>"; 	
				}
				echo "</table>";
			}
		}
		
		$option = null;
		if ($formSubmitted) {
			if (isset($_POST['change_value'])) {
				$option = $_POST['change_value'];
			}
		}
		
		if (is_null($option) || $option == "both") {
			echo display($conn);
		} else {
			echo displayRev($option, $conn);
		}
	?>
</div>

<div id="footer" class="container">
	<p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
</div>
</body>
</html>