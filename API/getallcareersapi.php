<?php 
$username = $_GET['username'];
require "../config.php";
header("Content-Yype: application/json;");
header('Access-Control-Allow-Origin: *');
$apiQuery = "SELECT * FROM career_list natural join career_cats";
$query = mysqli_query($conn, $apiQuery)or die('Unable to Query'); 
if(mysqli_num_rows($query) > 0 ){	
	$data = array();
	while ($rows = mysqli_fetch_assoc($query) ) {		
		$data[] = array(
			'clid' => $rows['clid'],
			'career_name' => $rows['career_name'],
			'career_description'	=> $rows['career_description'],
			'career_img' => $rows['career_img'],
			'cid' => $rows['cid'],	
			'cat_name'=> $rows['cat_name'],	
		);	
	}
	echo json_encode($data);
}else{
	echo json_encode(array('msg' => 'Not found!!', 'status' => 'Error') );
}
?>