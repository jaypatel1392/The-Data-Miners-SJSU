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
	<?php
		$hotelname = $_SESSION['hotelname'];
		$hID = $_SESSION["hid"]; 
		$managername = $_SESSION['managername'];
		print "<h2 align='center'>$hotelname Manager Services</h2>"; 
		print "<h3 align='center'>Fire an employee</h3>";
		
			$sql = "SELECT name, eID
				FROM employee 
				WHERE hID = '$hID'
				AND name <> '$managername';";
				$result = mysqli_query($conn, $sql);?>
<?if(empty(mysqli_fetch_array($result))):?>
<p>You have no employees to fire!</p>
<?else:?>
<div class="container">
	<form action="fireConfirm.php" method="post"> 
		<table align="center">
				<tr>
		<td><label class="formtext">Select an employee to fire: </label></td>
		<td>
		<select name="employee" class="inputs">

		<?php
		
	
		
				if($result) 
				{
						while(list($name, $eID) = mysqli_fetch_array($result)) 
						{
						print "<option  value=\"$eID\">ID: $eID Name: $name</option>";
				}
				}
		?>
		                    </select>
		                </td>
		            </tr>
		            <tr>
            	<td colspan="2" align="center">
            		<input type="submit" value="Fire this employee" class="btn"/>
                </td>
            </tr>
		            </table>
		            </form>
<?endif?>
</div>


<div id="footer" class="container">
	<p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
</div>
</body>
</html>