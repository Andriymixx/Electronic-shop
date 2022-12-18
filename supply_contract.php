<?php include("includes/mainheader.php"); 
$host = "localhost";
$user = "root";
$password = "";
$database = "electronic_shop";

$contract_id = "";
$gs_id = "";
$sl_price = "";
$sl_quantity = "";
$contract_date = "";
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
	$posts[0] = $_POST['contract_id'];
	$posts[1] = $_POST['gs_id'];
	$posts[2] = $_POST['sl_price'];
	$posts[3] = $_POST['sl_quantity'];
	$posts[4] = $_POST['contract_date'];
	return $posts;
}

$sql = "SELECT * FROM supply_contract ORDER BY 'ASC' ";

if (!$result = mysqli_query($connect, $sql)) {
	echo "Can not connect to database! ";
	exit;
}
function showTable($connect){
	$sql = "SELECT * FROM supply_contract ORDER BY 'ASC' ";
	$res = mysqli_query($connect, $sql);
	echo "<table>\n";

	echo "<thead><tr><th> Id</th><th> Goods</th><th> Price</th><th> Quantity</th><th> Date of contract</th></tr></thead>\n";

	while ($supply_contract = $res->fetch_assoc()) {
		
		echo "<tr>\n";
	echo "<td>" . $supply_contract['contract_id'] . "</td><td>". $supply_contract['gs_id'] . "</td><td>" .$supply_contract['sl_price']. "</td><td>" .$supply_contract['sl_quantity']. "</td><td>" . $supply_contract['contract_date'] . "</td>" ;
		echo "</tr>";
		echo "</tr>";
	}
	echo "</table>\n";
}
			// Search
if(isset($_POST['search']))
{
	$data = getPosts();
	$s_contract_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$search_Query = "SELECT * FROM supply_contract WHERE contract_id = $s_contract_id";

	$search_Result = mysqli_query($connect, $search_Query);

	if($search_Result)
	{
		if(mysqli_num_rows($search_Result))
		{
			while($row = mysqli_fetch_array($search_Result))
			{
				$contract_id = $row['contract_id'];
				$gs_id = $row['gs_id'];
				$sl_price = $row['sl_price'];
				$sl_quantity = $row['sl_quantity'];
				$contract_date = $row['contract_date'];
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
	$s_contract_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$s_gs_id = filter_var($data[1], FILTER_SANITIZE_NUMBER_INT);
	$s_sl_price = filter_var($data[2], FILTER_SANITIZE_NUMBER_INT);
	$s_sl_quantity = filter_var($data[3], FILTER_SANITIZE_NUMBER_INT);
	$s_date = filter_var($data[4], FILTER_SANITIZE_NUMBER_INT);
	$insert_Query = "INSERT INTO `supply_contract`(`contract_id`,`gs_id`, `sl_price`,`sl_quantity`, `contract_date`) VALUES ('$s_contract_id','$s_gs_id','$s_sl_price','$s_sl_quantity','$s_date')";
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
	$s_contract_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$delete_Query = "DELETE FROM `supply_contract` WHERE `contract_id` = $s_contract_id";
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
	$s_contract_id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
	$s_gs_id = filter_var($data[1], FILTER_SANITIZE_NUMBER_INT);
	$s_sl_price = filter_var($data[2], FILTER_SANITIZE_NUMBER_INT);
	$s_sl_quantity = filter_var($data[3], FILTER_SANITIZE_NUMBER_INT);
	$s_date = filter_var($data[4], FILTER_SANITIZE_NUMBER_INT);
	$update_Query = "UPDATE `supply_contract` SET `gs_id`='$s_gs_id',`sl_price`='$s_sl_price',`sl_quantity`='$s_sl_quantity',`contract_date`='$s_date' WHERE `contract_id` = $s_contract_id";
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
<form type="submit"action="supply_contract.php"  id="fields" method="post"name="fields">
	<article id="customer">
		Supply contract
	</article>
	<input class="inputs" type="number" name = "contract_id" placeholder = "contract id" min="0" value="<?php echo $contract_id;?>"><br><br>
	<input class="inputs" type="number" name = "gs_id" placeholder = "goods id" min="0" value="<?php echo $gs_id;?>"><br><br>
	<input class="inputs" type="number" name = "sl_price" placeholder = "price" min="0" value="<?php echo $sl_price;?>"><br><br>
	<input class="inputs" type="number" name = "sl_quantity" placeholder = "quantity" min="0" value="<?php echo $sl_quantity;?>"><br><br>
	<input class="inputs" type="text" name = "contract_date" placeholder = "date of contract (yyyy-mm-dd)" value="<?php echo $contract_date;?>"><br><br>

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
