<?php 
require "../config.php";
header("Content-Yype: application/json;");
header('Access-Control-Allow-Origin: *');
$bannerid = $_POST['bannerid'];
$apiQuery = "DELETE FROM bannner where bannerid = '{$bannerid}'";
$deleteQuery = mysqli_query($conn, $apiQuery)or die('Unable to Query'); 
if($deleteQuery){
	echo json_encode(array('msg' => 'Banner Deleted', 'status' => 'Success') );
}else{
	echo json_encode(array('msg' => 'Not found!!', 'status' => 'Error') );
}
?>