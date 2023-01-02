<?php 
require "../config.php";
header("Content-Yype: application/json;");
header('Access-Control-Allow-Origin: *');
$prodid = $_POST['prodid'];
$apiQuery = "DELETE FROM products where prod_id = '{$prodid}'";
$deleteQuery = mysqli_query($conn, $apiQuery)or die('Unable to Query'); 
if($deleteQuery){
	echo json_encode(array('msg' => 'Product Deleted', 'status' => 'Success') );
}else{
	echo json_encode(array('msg' => 'Not found!!', 'status' => 'Error') );
}
?>