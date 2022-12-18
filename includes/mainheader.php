<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Electronic shop project</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
	<main>
		<header>
			"Electronic shop" project
		</div>
	</header>	
	<div class="navbar">
				<div class="dropdown" >
			
			<button class="dropbtn">Account
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-content">

				<?php
			if(isset($_SESSION["session_username"])){

				echo "<h2 style=\"color: white;font-weight: 300; padding: 0px 16px; font-size:16px;\">Logged into , <span>"; echo $_SESSION['session_username']; echo "</span></h2>
  				<a href=\"logout.php\">Log out</a>";
				}
				else
				echo "<a href=\"login.php\">Login</a>
				<a href=\"register.php\">Register</a>";

			?>
			</div>
		</div>
		<a href="main.php">Home</a>
		<a href="customer.php">Customer</a>
		<a href="info_order.php">Info order</a>
		<a href="goods.php">Goods</a>
		<a href="warehouse.php">Warehouse</a>
		<a href="manufacturer.php">Manufacturer</a>
		<a href="supply_contract.php">Supply contract</a>

	</div>



</div>
