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
		$formSubmitted = $_SERVER["REQUEST_METHOD"] == "POST";
		print "<h1 align='center'>Welcome $managername</h1>";
		print "<h2 align='center'>$hotelname Revenue</h2>"; 
		print "<br/><br/>";
		
        echo "<div id=\"box3\"><h3>Revenue Options</h3>
    		<input type='radio' name='change_value' value='true'><label>Smoking Rooms Only</label><br/>
			<input type='radio' name='change_value' value='false'><label>Non-Smoking Rooms Only</label><br/>
			<input type='radio' name='change_value' value='both'><label>Smoking and Non-Smoking Rooms</label><br/>
			<input type=\"submit\"></div>
			</form>";
		
		function displayRev($hname, $hid, $option, $conn) {
			$sql = "SELECT companyName as h_name, sum(price) as revenue
					FROM rooms AS r LEFT OUTER JOIN customer AS c 
						ON r.rID = c.rID AND r.hID = c.hID
						AND r.hID = $hid AND c.hID = $hid
					JOIN hotels
					WHERE companyName = '$hname' AND r.smoking = $option
					ORDER BY price";
			$result = mysqli_query($conn, $sql);
	        if($result) {
    	    	$result = $result->fetch_assoc();
    	    	if ($option) {
	    	    	echo "<h2>$hname Revenue for Smoking Rooms</h2>";
	    	    } else {
	    	    	echo "<h2>$hname Revenue for Non-Smoking Rooms</h2>";
	    	    }
        		echo $result['h_name'] . " and " . " profit: $" . $result['revenue'];
	        }
		}
		
		function display($hname, $hid, $conn) {
			$sql = "SELECT companyName as h_name, sum(price) as revenue
					FROM rooms AS r LEFT OUTER JOIN customer AS c 
						ON r.rID = c.rID AND r.hID = c.hID
						AND r.hID = $hid AND c.hID = $hid
					JOIN hotels
					WHERE companyName = '$hname'
					ORDER BY price";
			$result = mysqli_query($conn, $sql);
	        if($result) {
    	    	$result = $result->fetch_assoc();
    	    	echo "<h2>$hname Total Revenue</h2>";
        		echo $result['h_name'] . " and " . " profit: $" . $result['revenue'];
	        }
		}
		
		$option = null;
		if ($formSubmitted) {
			if (isset($_POST['change_value'])) {
				$option = $_POST['change_value'];
			}
		}
		
		if (is_null($option) || $option == "both") {
			echo display($hotelname, $hID, $conn);
		} else {
			echo displayRev($hotelname, $hID, $option, $conn);
		}
	?>
</div>


<div id="footer" class="container">
	<p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
</div>
</body>
</html>