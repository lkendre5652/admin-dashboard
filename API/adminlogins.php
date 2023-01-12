<?php 
require "../config.php";
header("Content-Yype: application/json;");
header('Access-Control-Allow-Origin: *');
$username= $_GET['username'];
$password = $_GET['password'];
$conn = $GLOBALS['conn'];
$pass = md5($password);
$sqlQuery = "select role_id,user_name,user_pass from user where user_name = '{$username}' AND user_pass ='{$pass}'";
$result =  mysqli_query($conn ,$sqlQuery);
if( $rows = mysqli_num_rows($result) > 0 ){
	$results = mysqli_fetch_assoc($result);	
	echo json_encode($results);	
}else{
	echo json_encode(array('msg' => 'Not found!!', 'status' => 'Error') );
}
?>