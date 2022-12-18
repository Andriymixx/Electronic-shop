<?php include("includes/mainheader.php"); 
$host = "localhost";
$user = "root";
$password = "";
$database = "electronic_shop";

$warehouse_id = "";
$w_address = "";
$manager = "";

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
	$posts[0] = $_POST['warehouse_id'];
	$posts[1] = $_POST['w_address'];
	$posts[2] = $_POST['manager'];
	return $posts;
}

$sql = "SELECT * FROM warehouse ORDER BY 'ASC' ";

if (!$result = mysqli_query($connect, $sql)) {
	echo "Can not connect to database! ";
	exit;
}
function showTable($connect){
	$sql = "SELECT * FROM warehouse ORDER BY 'ASC' ";
	$res = mysqli_query($connect, $sql);
	echo "<table>\n";

	echo "<thead><tr><th> Id</th><th> Address</th><th> Manager</th></tr></thead>\n";

	while ($warehouse = $res->fetch_assoc()) {
		echo "<tr>\n";
		echo "<td>" . $warehouse['warehouse_id'] . "</td><td>". $warehouse['w_address'] . "</td><td>" . $warehouse['manager'] . "</td>" ;
		echo "</tr>";
	}
	echo "</table>\n";
}
			// Search
if(isset($_POST['search']))
{
	$data = getPosts();
$s_w_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	
	$search_Query = "SELECT * FROM warehouse WHERE warehouse_id = $s_w_id";

	$search_Result = mysqli_query($connect, $search_Query);

	if($search_Result)
	{
		if(mysqli_num_rows($search_Result))
		{
			while($row = mysqli_fetch_array($search_Result))
			{
				$warehouse_id = $row['warehouse_id'];
				$w_address = $row['w_address'];
				$manager = $row['manager'];
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
	$s_w_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$s_w_address = filter_var($data[1], FILTER_SANITIZE_SPECIAL_CHARS);
	$s_w_manager = filter_var($data[2], FILTER_SANITIZE_SPECIAL_CHARS);
	$insert_Query = "INSERT INTO `warehouse`(`warehouse_id`, `w_address`, `manager`) VALUES ('$s_w_id','$s_w_address','$s_w_manager')";
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
	$s_gs_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$delete_Query = "DELETE FROM `warehouse` WHERE `warehouse_id` = $s_w_id";
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
	$s_w_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$s_w_address = filter_var($data[1], FILTER_SANITIZE_SPECIAL_CHARS);
	$s_w_manager = filter_var($data[2], FILTER_SANITIZE_SPECIAL_CHARS);
	$update_Query = "UPDATE `warehouse` SET `w_address`='$s_w_address',`manager`='$s_w_manager' WHERE `warehouse_id` = $s_w_id";
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
<form type="submit"action="warehouse.php"  id="fields" method="post"name="fields">
	<article id="customer">
		Warehouse
	</article>
	<input class="inputs" type="number" name = "warehouse_id" placeholder = "warehouse id" min="0" value="<?php echo $warehouse_id;?>"><br><br>
	<input class="inputs" type="text" name = "w_address" placeholder = "address" value="<?php echo $w_address;?>"><br><br>
	<input class="inputs" type="text" name = "manager" placeholder = "manager" value="<?php echo $manager;?>"><br><br>

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
