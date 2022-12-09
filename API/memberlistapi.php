<?php  
// web services.
require "../config.php";
header("Content-Yype: application/json;");
header('Access-Control-Allow-Origin: *');
$apiQuery = "SELECT * FROM members";
$query = mysqli_query($conn, $apiQuery)or die('Unable to Query'); 
if(mysqli_num_rows($query) > 0 ){
	$data = array();
	while($result = mysqli_fetch_assoc($query)){
		$data[] = array(
			'id' => $result['mid'],
			'fname' => $result['fname'],
			'lname' => $result['lname'],
			'birthd' => $result['birthd'],
		);
	}
	echo json_encode($data);
}else{
	echo json_encode(array('msg' => 'Not found!!', 'status' => 'Error') );
}
?>