<?php include("includes/mainheader.php"); 

$host = "localhost";
$user = "root";
$password = "";
$database = "electronic_shop";

$mn_name = "";
$mn_adress = "";
$mn_phone = "";

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
	$posts[0] = $_POST['mn_name'];
	$posts[1] = $_POST['mn_adress'];
	$posts[2] = $_POST['mn_phone'];
	
	return $posts;
}


$sql = "SELECT * FROM manufacturer ORDER BY 'ASC' ";
// $query = mysqli_query($connect, $sql);
if (!$result = mysqli_query($connect, $sql)) {
	echo "Can not connect to database!";
	exit;

}
function showTable($connect){
	$sql = "SELECT * FROM manufacturer ORDER BY 'ASC' ";
	$res = mysqli_query($connect, $sql);
	echo "<table>\n";
	echo "<thead><tr><th> Name</th><th> Adress</th><th> Phone</th></tr></thead>\n";

	while ($manufacturer = $res->fetch_assoc()) {
		echo "<tr>\n";
		echo "<td>" . $manufacturer['mn_name'] . "</td><td>". $manufacturer['mn_adress'] . "</td><td>" . $manufacturer['mn_phone'] . "</td>";
		echo "</tr>";
	}
	echo "</table>\n";
}

			// Search
if(isset($_POST['search']))
{
	$data = getPosts();
	$s_mn_name = filter_var($data[0], FILTER_SANITIZE_SPECIAL_CHARS);
	$search_Query = "SELECT * FROM manufacturer WHERE mn_name = '$s_mn_name'";

	$search_Result = mysqli_query($connect, $search_Query);

	if($search_Result)
	{
		if(mysqli_num_rows($search_Result))
		{
			while($row = mysqli_fetch_array($search_Result))
			{
				$mn_name = $row['mn_name'];
				$mn_adress = $row['mn_adress'];
				$mn_phone = $row['mn_phone'];
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
	$s_mn_name = filter_var($data[0], FILTER_SANITIZE_SPECIAL_CHARS);
	$s_mn_address = filter_var($data[1], FILTER_SANITIZE_SPECIAL_CHARS);
	$s_mn_phone = filter_var($data[2], FILTER_SANITIZE_NUMBER_INT);	
	$insert_Query = "INSERT INTO `manufacturer`(`mn_name`, `mn_adress`, `mn_phone`) VALUES ('$s_mn_name','$s_mn_address','$s_mn_phone')";
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


			// Delete
if(isset($_POST['delete']))
{
	$data = getPosts();
	$s_mn_name = filter_var($data[0], FILTER_SANITIZE_SPECIAL_CHARS);
	$delete_Query = "DELETE FROM `manufacturer` WHERE `mn_name` = '$s_mn_name'";
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
	$s_mn_name = filter_var($data[0], FILTER_SANITIZE_SPECIAL_CHARS);
	$s_mn_address = filter_var($data[1], FILTER_SANITIZE_SPECIAL_CHARS);
	$s_mn_phone = filter_var($data[2], FILTER_SANITIZE_NUMBER_INT);	
	$update_Query = "UPDATE `manufacturer` SET `mn_adress`='$s_mn_address',`mn_phone`='$s_mn_phone' WHERE `mn_name` = '$s_mn_name'";
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


?>

<form action="manufacturer.php" id="fields" method="post"name="fields">
	<article >
		Manufacturer
	</article>
	<input class="inputs" type="text" name = "mn_name" placeholder = "name" value="<?php echo $mn_name;?>"><br><br>
	<input class="inputs" type="text" name = "mn_adress" placeholder = "adress" value="<?php echo $mn_adress;?>"><br><br>
	<input class="inputs" type="number" name = "mn_phone" placeholder = "phone" min="0" value="<?php echo $mn_phone;?>"><br><br>

	<div id="buttons">
		<input type="submit" name = "insert" value="Add"onclick="refreshContent()">
		<input type="submit" name = "update" value="Update"onclick="refreshContent()">
		<input type="submit" name = "delete" value="Delete"onclick="refreshContent()">
		<input type="submit" name = "search" value="Search">
	</div>
	<br>
</form>

<?php
showTable($connect);
?>
<script type="text/javascript">
function refreshContent(){
	$( "#content" ).load(window.location.href + " #content" );
}
</script>
<?php
include("includes/footer.php");