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
		<li class="current_page_item"><a href="../index.html">Homepage</a></li>
        <li><a href="Login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
	</ul>
</div>

<div id="managerpage" class="container">
	<form action="verify.php" method="post"> <!--SEND TO Verify.php afterwards -->
        <table align="center">
            <tr>
            	<td><label class="formtext">Select Your Hotel: </label></td>
                <td>
                	<select name="hotel" class="inputs">
					<?php 
                    $sql = "select companyName from hotels";
                    $result = mysqli_query($conn, $sql);
                    
                    if($result) {
                       while(list($name) = mysqli_fetch_array($result)) {
						   print "<option value=\"$name\">$name</option>";
					   }
                    }
					?>
                    </select>
                </td>
            </tr>
            <tr>
            	<td><label class="formtext">Name: </label></td>
                <td><input type="text" name="name" size=20 class="inputs" /></td>
            </tr>
            <tr>
            	<td><label class="formtext">User Name: </label></td>
				<td><input type="text" name="username" size=20 class="inputs" /></td>
            </tr>
            <tr>
            	<td><label class="formtext">Password: </label></td>
				<td><input type="password" name="password" size=20 class="inputs" /></td>
            </tr>
            <tr>
            	<td colspan="2" align="center">
            		<input type="submit" value="Register!" class="btn"/>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="footer" class="container">
	<p>&copy; JAT RESRVATION SYSTEM. All rights reserved. Design by JAT<p>
</div>
</body>
</html>
