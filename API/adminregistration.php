<?php 
require "../config.php";
header("Content-Yype: application/json;");
header('Access-Control-Allow-Origin: *');
$email = $_GET['email'];
$phonenumber = $_GET['phonenumber'];
$password = $_GET['password'];
$passwordConfirm = $_GET['passwordConfirm'];
//	email,password,confirmpassword	


$conn = $GLOBALS['conn'];
$pass = md5($password);
$confpass = md5($passwordConfirm);
if(!empty($email ) && !empty($phonenumber ) && !empty($password ) && !empty($passwordConfirm ) ){
	$sqlQuery = "insert into adminregistration(email,password,confirmpassword) VALUES('$email','$pass','$confpass')";
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