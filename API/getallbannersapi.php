<?php 
$username = $_GET['username'];
require "../config.php";
header("Content-Yype: application/json;");
header('Access-Control-Allow-Origin: *');
$apiQuery = "SELECT * FROM bannner";
$query = mysqli_query($conn, $apiQuery)or die('Unable to Query'); 
if(mysqli_num_rows($query) > 0 ){	
	$data = array();
	while ($rows = mysqli_fetch_assoc($query) ) {		
		$data[] = array(
			'bannerid' => $rows['bannerid'],
			'bannertitle' => $rows['bannertitle'],
			'bannerimage' => $rows['bannerimage'],
			'bannercategory' => $rows['bannercategory'],			
		);	
	}
	echo json_encode($data);
}else{
	echo json_encode(array('msg' => 'Not found!!', 'status' => 'Error') );
}
?>