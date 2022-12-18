<?php include("includes/mainheader.php"); 

$host = "localhost";
$user = "root";
$password = "";
$database = "electronic_shop";

$gs_id = "";
$gs_name = "";
$mn_name = "";
$gs_price = "";
$gs_quantity = "";
$warehouse_id = "";
//$columnname = "";
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
	$posts[0] = $_POST['gs_id'];
	$posts[1] = $_POST['gs_name'];
	$posts[2] = $_POST['mn_name'];
	$posts[3] = $_POST['gs_price'];
	$posts[4] = $_POST['gs_quantity'];
	$posts[5] = $_POST['warehouse_id'];
	return $posts;
}

$sql = "SELECT * FROM goods ORDER BY 'ASC' ";

if (!$result = mysqli_query($connect, $sql)) {
	echo "Can not connect to database!";
	exit;

}
function showTable($connect){
		$sql = "SELECT * FROM goods ORDER BY 'ASC' ";
	$res = mysqli_query($connect, $sql);
	echo "<table>\n";

	echo "<thead><tr><th> Id</th><th> Name</th><th> Manufacturer</th><th> Price</th><th> Quantity</th><th> Warehouse id</th></tr></thead>\n";

	while ($goods = $res->fetch_assoc()) {
		echo "<tr>\n";
		echo "<td>" . $goods['gs_id'] . "</td><td>". $goods['gs_name'] . "</td><td>" . $goods['mn_name'] . "</td><td>" . $goods['gs_price'] . "</td><td>" . $goods['gs_quantity'] . "</td><td>" . $goods['warehouse_id'] . "</td>" ;
		echo "</tr>";
	}
	echo "</table>\n";
}

			// Search
if(isset($_POST['search']))
{
	$data = getPosts();
	$s_gs_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$search_Query = "SELECT * FROM goods WHERE gs_id = $s_gs_id";

	$search_Result = mysqli_query($connect, $search_Query);

	if($search_Result)
	{
		if(mysqli_num_rows($search_Result))
		{
			while($row = mysqli_fetch_array($search_Result))
			{
				$gs_id = $row['gs_id'];
				$gs_name = $row['gs_name'];
				$mn_name = $row['mn_name'];
				$gs_price = $row['gs_price'];
				$gs_quantity = $row['gs_quantity'];
				$warehouse_id = $row['warehouse_id'];
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
	$s_gs_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$s_gs_name = filter_var($data[1], FILTER_SANITIZE_SPECIAL_CHARS);
	$s_mn_name = filter_var($data[2], FILTER_SANITIZE_SPECIAL_CHARS);
	$s_gs_price = filter_var($data[3], FILTER_SANITIZE_NUMBER_INT);
	$s_gs_quantity = filter_var($data[4], FILTER_SANITIZE_NUMBER_INT);
	$s_w_id = filter_var($data[5], FILTER_SANITIZE_NUMBER_INT);
	$insert_Query = "INSERT INTO `goods`(`gs_id`,`gs_name`, `mn_name`, `gs_price`,`gs_quantity`,`warehouse_id`) VALUES ('$s_gs_id','$s_gs_name','$s_mn_name','$s_gs_price','$s_gs_quantity','$s_w_id')";
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
	header("Refresh:2");
}


			// Delete
if(isset($_POST['delete']))
{
	$data = getPosts();
		$s_gs_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$delete_Query = "DELETE FROM `goods` WHERE `gs_id` = $s_gs_id";
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
header("Refresh:2");
}


			// Edit
if(isset($_POST['update']))
{
	$data = getPosts();
	$s_gs_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$s_gs_name = filter_var($data[1], FILTER_SANITIZE_SPECIAL_CHARS);
	$s_mn_name = filter_var($data[2], FILTER_SANITIZE_SPECIAL_CHARS);
	$s_gs_price = filter_var($data[3], FILTER_SANITIZE_NUMBER_INT);
	$s_gs_quantity = filter_var($data[4], FILTER_SANITIZE_NUMBER_INT);
	$s_w_id = filter_var($data[5], FILTER_SANITIZE_NUMBER_INT);
	$update_Query = "UPDATE `goods` SET `gs_name`='$s_gs_name',`mn_name`='$s_mn_name',`gs_price`='$s_gs_price',`gs_quantity`='$s_gs_quantity', `warehouse_id`='$s_w_id' WHERE `gs_id` = $s_gs_id";
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
	header("Refresh:2");
}


	
?>

<form action="goods.php" id="fields" method="post"name="fields">
	<article >
		Goods
	</article>

	<input class="inputs" type="number" name = "gs_id" placeholder = "id" min="0" value="<?php echo $gs_id;?>"><br><br>
	<input class="inputs" type="text" name = "gs_name" placeholder = "name" value="<?php echo $gs_name;?>"><br><br>
	<input class="inputs" type="text" name = "mn_name" placeholder = "manufacturer" value="<?php echo $mn_name;?>"><br><br>
	<!-- <select name="m_name" >
		<option selected disabled >--Select manufacturer--</option>
		<?php
		$selmn = "SELECT * FROM manufacturer ORDER BY 'ASC' ";
        $res = mysqli_query($connect, $selmn);
			while($row = mysqli_fetch_array($res)){
				$mn_name=$row["$columnname"];
				echo "<option>$mn_name<br></option>";	
		}
		
		?> 
		</select><br><br> -->
	<input class="inputs" type="number" name = "gs_price" placeholder = "price" min="0" value="<?php echo $gs_price;?>"><br><br>
	<input class="inputs" type="number" name = "gs_quantity" placeholder = "quantity" min="0" value="<?php echo $gs_quantity;?>"><br><br>
	<input class="inputs" type="number" name = "warehouse_id" placeholder = "warehouse id" min="0" value="<?php echo $warehouse_id;?>"><br><br>

	<div id="buttons">
		<input type="submit" name = "insert" value="Add" onclick="refreshContent()">
		<input type="submit" name = "update" value="Update" onclick="refreshContent()">
		<input type="submit" name = "delete" value="Delete" onclick="refreshContent()">
		<input type="submit" name = "search" value="Search">
	</div>
<br>
</form>
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
include("includes/footer.php");
