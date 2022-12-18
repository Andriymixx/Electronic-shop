

<?php include("includes/mainheader.php"); 
$host = "localhost";
$user = "root";
$password = "";
$database = "electronic_shop";

$cr_id = "";
$cr_name = "";
$phone = "";
$email = "";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

		// connect to mysql database
try{
	$connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
	echo 'Error';
}

function getPosts()
{
	$posts = array();
	$posts[0] = $_POST['cr_id'];
	$posts[1] = $_POST['cr_name'];
	$posts[2] = $_POST['phone'];
	$posts[3] = $_POST['email'];
	return $posts;
}

$sql = "SELECT * FROM customer ORDER BY 'ASC' ";

if (!$result = mysqli_query($connect, $sql)) {
	echo "Can not connect to database! ";
	exit;
}

function showTable($connect){
	$sql = "SELECT * FROM customer ORDER BY 'ASC' ";
	$res = mysqli_query($connect, $sql);
	echo "<table>\n";

	echo "<thead><tr><th> Id</th><th> Name</th><th> Phone</th><th> E-mail</th></tr></thead>\n";

	while ($customer = $res->fetch_assoc()) {
		echo "<tr>\n";
		echo "<td>" . $customer['cr_id'] . "</td><td>". $customer['cr_name'] . "</td><td>" . $customer['phone'] . "</td><td>" . $customer['email'] . "</td>" ;
		echo "</tr>";
	}
	echo "</table>\n";
}
			// Search
if(isset($_POST['search']))
{
	$data = getPosts();
	$s_cr_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$search_Query = "SELECT * FROM customer WHERE cr_id = $s_cr_id";
	$search_Result = mysqli_query($connect, $search_Query);
	if($search_Result)
	{
		if(mysqli_num_rows($search_Result))
		{
			while($row = mysqli_fetch_array($search_Result))
			{
				$cr_id = $row['cr_id'];
				$cr_name = $row['cr_name'];
				$phone = $row['phone'];
				$email = $row['email'];
			}
		}else{
			echo 'No Data For This Id';
		}
	} else{
		echo 'Result Error';
	}
	
}
			// Insert
if(isset($_POST['insert']))
{	
	$data = getPosts();
	$s_cr_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$s_name = filter_var($data[1], FILTER_SANITIZE_SPECIAL_CHARS);
	$s_phone = filter_var($data[2], FILTER_SANITIZE_NUMBER_INT);
	$s_email = filter_var($data[3], FILTER_SANITIZE_EMAIL);

	if(filter_var($s_email, FILTER_VALIDATE_EMAIL)){
	$insert_Query = "INSERT INTO `customer`(`cr_id`,`cr_name`, `phone`, `email`) VALUES ('$s_cr_id','$s_name','$s_phone','$s_email')";
	try{
		$insert_Result = mysqli_query($connect, $insert_Query);

		if($insert_Result)
		{
			if(mysqli_affected_rows($connect) > 0)
			{
				echo 'Data Inserted';
			}else{
				echo 'Data Not Inserted';
			}
		}
	} catch (Exception $ex) {
		echo 'Error Insert '.$ex->getMessage();
	}
}
	else{
	echo "You entered wrong email";
	}
}


			// Delete
if(isset($_POST['delete']))
{
	$data = getPosts();
		$s_cr_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	
	$delete_Query = "DELETE FROM `customer` WHERE `cr_id` = $s_cr_id";
	try{
		$delete_Result = mysqli_query($connect, $delete_Query);

		if($delete_Result)
		{
			if(mysqli_affected_rows($connect) > 0)
			{
				echo 'Data Deleted';
			}else{
				echo 'Data Not Deleted';
			}
		}
	} catch (Exception $ex) {
		echo 'Error Delete '.$ex->getMessage();
	}

}
			// Edit
if(isset($_POST['update']))
{   
	$data = getPosts();
	$s_cr_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$s_name = filter_var($data[1], FILTER_SANITIZE_SPECIAL_CHARS);
	$s_phone = filter_var($data[2], FILTER_SANITIZE_NUMBER_INT);
	$s_email = filter_var($data[3], FILTER_SANITIZE_EMAIL);
	
	if(filter_var($s_email, FILTER_VALIDATE_EMAIL)){
	$update_Query = "UPDATE `customer` SET `cr_name`='$s_name',`phone`='$s_phone',`email`='$s_email' WHERE `cr_id` = $s_cr_id";
	try{
		$update_Result = mysqli_query($connect, $update_Query);

		if($update_Result)
		{
			if(mysqli_affected_rows($connect) > 0)
			{
				echo 'Data Updated';
			}else{
				echo 'Data Not Updated';
			}
		}
	} catch (Exception $ex) {
		echo 'Error Update '.$ex->getMessage();
	}
}
else{
	echo "You entered wrong email";
}
}

?>
<form type="submit"action="customer.php"  id="fields" method="post"name="fields">
	<article id="customer">
		Customer
	</article>
	<input class="inputs" type="number" name = "cr_id" placeholder = "customer id" min="0" value="<?php echo $cr_id;?>"><br><br>
	<input class="inputs" type="text" name = "cr_name" placeholder = "customer name" value="<?php echo $cr_name;?>"><br><br>
	<input class="inputs" type="number" name = "phone" placeholder = "phone" min="0" value="<?php echo $phone;?>"><br><br>
	<input class="inputs" type="text" name = "email" placeholder = "e-mail" value="<?php echo $email;?>"><br><br>

	<div id="buttons">
	
		<input type="submit" name = "insert" value="Add" onclick="refreshContent()">
		<input type="submit" name = "update" value="Update"onclick="refreshContent()">
		<input type="submit" name = "delete" value="Delete"onclick="refreshContent()">
		<input type="submit" name = "search" value="Search">
	
	</div>
	<br>
</form>
<div id="content">
<?php
showTable($connect);
?>
</div>
<script type="text/javascript">
function refreshContent(){
	$( "#content" ).load(window.location.href + " #content" );
}
</script>


<?php
// mysqli_close($connect);

include("includes/footer.php");
