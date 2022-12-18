<?php include("includes/mainheader.php"); 
$host = "localhost";
$user = "root";
$password = "";
$database = "electronic_shop";

$or_id = "";
$cr_id = "";
$gs_id = "";
$date_of_order = "";
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
	$posts[0] = $_POST['or_id'];
	$posts[1] = $_POST['cr_id'];
	$posts[2] = $_POST['gs_id'];
	$posts[3] = $_POST['date_of_order'];
	return $posts;
}

$sql = "SELECT * FROM info_order ORDER BY 'ASC' ";

if (!$result = mysqli_query($connect, $sql)) {
	echo "Can not connect to database! ";
	exit;
}
function showTable($connect){
	$sql = "SELECT * FROM info_order ORDER BY 'ASC' ";
	$res = mysqli_query($connect, $sql);
	echo "<table>\n";

	echo "<thead><tr><th> Id</th><th> Customer</th><th> Goods</th><th> Date of order</th></tr></thead>\n";

	while ($info_order = $res->fetch_assoc()) {
		
		echo "<tr>\n";
		echo "<td>" . $info_order['or_id'] . "</td><td>". $info_order['cr_id'] . "</td><td>" .$info_order['gs_id']. "</td><td>" . $info_order['date_of_order'] . "</td>" ;
		echo "</tr>";
	}
	echo "</table>\n";
}
			// Search
if(isset($_POST['search']))
{
	$data = getPosts();
	$s_or_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$search_Query = "SELECT * FROM info_order WHERE or_id = $s_or_id";

	$search_Result = mysqli_query($connect, $search_Query);

	if($search_Result)
	{
		if(mysqli_num_rows($search_Result))
		{
			while($row = mysqli_fetch_array($search_Result))
			{
				$or_id = $row['or_id'];
				$cr_id = $row['cr_id'];
				$gs_id = $row['gs_id'];
				$date_of_order = $row['date_of_order'];
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
	$s_or_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$s_cr_id = filter_var($data[1], FILTER_SANITIZE_NUMBER_INT);
	$s_gs_id = filter_var($data[2], FILTER_SANITIZE_NUMBER_INT);
	$s_date = filter_var($data[3], FILTER_SANITIZE_NUMBER_INT);
	$insert_Query = "INSERT INTO `info_order`(`or_id`,`cr_id`, `gs_id`, `date_of_order`) VALUES ('$s_or_id','$s_cr_id','$s_gs_id','$s_date')";
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
	$s_or_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$delete_Query = "DELETE FROM `info_order` WHERE `or_id` = $s_or_id";
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
	$s_or_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$s_cr_id = filter_var($data[1], FILTER_SANITIZE_NUMBER_INT);
	$s_gs_id = filter_var($data[2], FILTER_SANITIZE_NUMBER_INT);
	$s_date = filter_var($data[3], FILTER_SANITIZE_NUMBER_INT);
	$update_Query = "UPDATE `info_order` SET `cr_id`='$s_cr_id',`gs_id`='$s_gs_id',`date_of_order`='$s_date' WHERE `or_id` = $s_or_id";
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
<form type="submit"action="info_order.php"  id="fields" method="post"name="fields">
	<article id="customer">
		Info order
	</article>
	<input class="inputs" type="number" name = "or_id" placeholder = "order id"  min="0" value="<?php echo $or_id;?>"><br><br>
	<input class="inputs" type="number" name = "cr_id" placeholder = "customer id" min="0" value="<?php echo $cr_id;?>"><br><br>
	<input class="inputs" type="number" name = "gs_id" placeholder = "goods id" min="0" value="<?php echo $gs_id;?>"><br><br>
	<input class="inputs" type="text" name = "date_of_order" placeholder = "date of order (yyyy-mm-dd)" min="0" value="<?php echo $date_of_order;?>"><br><br>

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
