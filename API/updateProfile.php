<?php 
// // web services.
require "../config.php";
header("Content-Yype: application/json;");
header('Access-Control-Allow-Origin: *');
$apiQuery = "SELECT * FROM user where user_name = '{$_POST['username']}' AND role_id='{$_POST['role_id']}' ";
$query = mysqli_query($conn, $apiQuery)or die('Unable to Query'); 
if(mysqli_num_rows($query) > 0 ){
	$data = array();
	while($result = mysqli_fetch_assoc($query)){
		$data[] = array(
			'id' => $result['id'],
			'role_id' => $result['role_id'],
			'user_name' => $result['user_name'],
			'user_pass' => $result['user_pass'],
		);
	}
	echo json_encode($data);	
}else{
	echo json_encode(array('msg' => 'Not found!!', 'status' => 'Error') );
}
?>