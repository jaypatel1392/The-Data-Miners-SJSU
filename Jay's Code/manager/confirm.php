<?php
		session_start(); 
		include("../dbconnect.php");
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM managerlogin WHERE username = '$username'  and password = '$password' ";
		$result = mysqli_query($conn, $sql);
		
		if($result) {
			if(list($username, $password, $eID, $hID) = mysqli_fetch_array($result)) {
				$eid = $eID;
				$hid = $hID;
				
				$_SESSION['username'] = $username;
				$_SESSION['hid'] = $hid;
				$_SESSION['eid'] = $eid;
				
				$q = "SELECT name FROM employee where eID = $eid and hID = $hid";
				$h = "SELECT companyName FROM hotels where hID = $hid";
				$res = mysqli_query($conn, $q); 
				$res2 = mysqli_query($conn, $h);
				
				if($res && $res2) {
					if($r = mysqli_fetch_array($res) && $a = mysqli_fetch_array($res2)) {
						$_SESSION['managername'] = $r["name"];
						$_SESSION['hotelname'] = $a["companyName"];
						header('location: home.php');
					} 
				} else {
					header('location: relogin.php');
				}
			} else {
				header('location: relogin.php');
			}
		}
?>