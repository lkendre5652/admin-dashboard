<?php 
require "../config.php";
header("Content-Yype: application/json;");
header('Access-Control-Allow-Origin: *');
$imglink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://".$_SERVER['HTTP_HOST'];

if($_FILES['file']['name'] != ''){
	$test = explode('.', $_FILES['file']['name']);
	$extension = end($test);    
	$name = rand(100,999).'.'.$extension;
	$location = '../uploads/'.$name;
	move_uploaded_file($_FILES['file']['tmp_name'], $location);
	$fileUrl = $imglink."/emp-management/admin/uploads/".$name;
}
 $careerTitle =  $_POST['careerTitle'];
 $careerCatId =  $_POST['careerCatId'];
 $bannerCategory =  $_POST['bannerCategory'];
 $careerDesc =  $_POST['careerDesc'];
 //$fileUrl =  $_POST['fileUrl'];
$conn = $GLOBALS['conn'];
if(!empty($careerTitle ) && !empty($careerCatId ) && !empty($bannerCategory ) && !empty($careerDesc ) && !empty($fileUrl )  ){
	$sqlQuery = "INSERT INTO  career_list (career_name,career_description,career_img,cid) VALUES('$careerTitle','$careerDesc','$fileUrl','$careerCatId')";
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