<?php
session_start();
if(!isset($_SESSION["session_username"])):
header("location:login.php");
else:
?>
<?php include("includes/header.php"); ?>
<div id="welcome">
<h2>Welcome, <span><?php echo $_SESSION['session_username'];?>! </span></h2>
   <p> Continue to <a href="main.php">Main page</a></p>
  <p><a href="logout.php">Log out</a> from system</p>
</div>
<?php include("includes/footer.php"); ?>
<?php endif; ?>

