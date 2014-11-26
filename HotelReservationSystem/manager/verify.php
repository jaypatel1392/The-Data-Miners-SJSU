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
include("../dbconnect.php") 
?>
</head>
<body>
<div id="logo" class="container">
	<h1><a href="../index.php">JAT HOTEL RESERVATION</a></h1>
</div>
<div id="menu" class="container">
	<ul>
		<li><a href="../index.php">Homepage</a></li>
        <li><a href="register.php">Register</a></li>
	</ul>
</div>
	<?php 
		$hotel = $_POST['hotel'];
		$name = $_POST['name'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$query = "select hID, eID from employee natural join hotels where position = \"Manager\" and name = \"$name\" ";
		$result = mysqli_query($conn, $query);
		
		if($result) {
			if(list($hID, $eID) = mysqli_fetch_array($result)) {
				$q = "INSERT INTO managerlogin(employee_hID, employee_eID, username, password) values ($hID, $eID, \"$username\", \"$password\")";
				$res = mysqli_query($conn, $q);
				if($res) {
					$_SESSION['username'] = $username;
					$_SESSION['hid'] = $hID;
					$_SESSION['eid'] = $eID;
					$_SESSION['managername'] = $name;
					$_SESSION['hotelname'] = $hotel;
					
					header('Location: home.php');
				} else {
					header('Location: retry.php');
				}
			} else {
				header('Location: retry.php');
			}
		} 
	?>

    <div id="footer" class="container">
        <p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
    </div>
</body>
</html>