<?php 
require "../config.php";
header("Content-Yype: application/json;");
header('Access-Control-Allow-Origin: *');

$careerCat =  $_POST['careerCat'];
 
$conn = $GLOBALS['conn'];
if(!empty($careerCat )  ){

	$sqlQuery = "INSERT INTO  career_cats( cat_name ) VALUES('$careerCat')";
	$result =  mysqli_query($conn ,$sqlQuery);
	if( $result ){	
		echo json_encode(array('msg' => 'Data Inserted Successfully', 'status' => 'success') );
	}else{
		echo json_encode(array('msg' => 'Not found!!', 'status' => 'error') );
	}
}else{
	echo json_encode(array('msg' => 'Not found1!!', 'status' => 'error') );
}
?>