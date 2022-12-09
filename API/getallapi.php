<?php 
 $username = $_GET['username'];
// web services.
require "../config.php";
header("Content-Yype: application/json;");
header('Access-Control-Allow-Origin: *');
$apiQuery = "SELECT * FROM user where user_name = '{$username}'";
$query = mysqli_query($conn, $apiQuery)or die('Unable to Query'); 
if(mysqli_num_rows($query) > 0 ){
	$result = mysqli_fetch_assoc($query);
	echo json_encode($result);	
}else{
	echo json_encode(array('msg' => 'Not found!!', 'status' => 'Error') );
}
?>