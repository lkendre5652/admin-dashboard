<?php 
require "../config.php";
header("Content-Yype: application/json;");
header('Access-Control-Allow-Origin: *');
$cid = $_POST['cid'];
$apiQuery = "DELETE FROM career_list where clid = {$cid}";

$deleteQuery = mysqli_query($conn, $apiQuery)or die('Unable to Query'); 
if($deleteQuery){
	echo json_encode(array('msg' => 'Product Deleted', 'status' => 'Success') );
}else{
	echo json_encode(array('msg' => 'Not found!!', 'status' => 'Error') );
}
?>