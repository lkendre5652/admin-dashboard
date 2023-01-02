<?php 
$username = $_GET['username'];
require "../config.php";
header("Content-Yype: application/json;");
header('Access-Control-Allow-Origin: *');
$apiQuery = "SELECT * FROM products";
$query = mysqli_query($conn, $apiQuery)or die('Unable to Query'); 
if(mysqli_num_rows($query) > 0 ){	
	$data = array();
	while ($rows = mysqli_fetch_assoc($query) ) {		
		$data[] = array(
			'prod_parent_cat_id' => $rows['prod_parent_cat_id'],
			'prod_parent_cat_name' => $rows['prod_parent_cat_name'],
			'prod_id'	=> $rows['prod_id'],
			'prod_name' => $rows['prod_name'],
			'prod_desc' => $rows['prod_desc'],	
			'prod_img'	=> $rows['prod_img'],		
		);	
	}
	echo json_encode($data);
}else{
	echo json_encode(array('msg' => 'Not found!!', 'status' => 'Error') );
}
?>