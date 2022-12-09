<?php 
// // web services.
// echo $_POST['up_user'];
// echo $_POST['upuser'];
// die();
$uppass = md5($_POST['uppass']);

require "../config.php";
header("Content-Yype: application/json;");
header('Access-Control-Allow-Origin: *');
$apiQuery = "UPDATE user SET user_name = '{$_POST['upuser']}' WHERE  user_name = '{$_POST['up_user']}' AND role_id = {$_POST['role_id']} ";
//$apiQuery = "SELECT * FROM user where user_name = '{$_POST['username']}' AND role_id='{$_POST['role_id']}' ";
$query = mysqli_query($conn, $apiQuery)or die('Unable to Query');
if($query){
	echo json_encode(array('msg' => 'Successfullt Updated', 'status' => 'success') );
}else{
	echo json_encode(array('msg' => 'Not found!!', 'status' => 'error') );
}
// if(mysqli_num_rows($query) > 0 ){	
// 	echo json_encode(array('msg' => 'Successfullt Updated', 'status' => 'Success') );
// }else{
// 	echo json_encode(array('msg' => 'Not found!!', 'status' => 'Error') );
// }
?>