<?php 
include "./header.php"; 
include "./config.php";
$userErr = "";
$passErr = "";
$fnameErr = "";
$lnameErr = "";
$emailErr = "";
$mobileErr = "";
$dobErr = "";
$dojErr = "";
$addressErr = "";
$comErr = "";
if(isset($_REQUEST['registerSubmit'])){
	$username = mysqli_real_escape_string($conn, $_POST['userName']);
	$password = $_POST['password'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$emailId = $_POST['emailId'];
	$mobile = $_POST['mobile'];
	$dob = $_POST['dob'];
	$doj = $_POST['doj'];
	$profileImg = (!empty($_POST['profileImg']))? $_POST['profileImg'] : "NULL";
	$address = $_POST['address'];	
	if( empty($username)){
		$userErr="This field should not be blank.";
	}
	if( empty($password) ){
		$passErr="This field should not be blank.";
	}
	if( empty($firstName) ){
		$fnameErr="This field should not be blank.";
	}
	if( empty($lastName) ){
		$lnameErr="This field should not be blank.";
	}
	if( empty($emailId) ){
		$emailErr="This field should not be blank.";
	}
	if( empty($mobile) ){
		$mobileErr="This field should not be blank.";
	}
	if( empty($dob) ){
		$dobErr="This field should not be blank.";
	}
	if( empty($doj) ){
		$dojErr="This field should not be blank.";
	}
	// if( empty($profileImg) ){
	// 	$profileImgErr="This field should not be blank.";
	// }
	if( empty($address) ){
		$addressErr="This field should not be blank.";
	}

	if( (!empty($username)) && (!empty($password)) && (!empty($firstName))&& (!empty($lastName))&& (!empty($emailId))&& (!empty($mobile))&& (!empty($dob))&& (!empty($doj))&& (!empty($address)) ){			 	
			$sqlQuery = "insert into login (username,password,firstname,lastname,emailId,mobile,dob,doj,profileImg,address) values('$username','$password','$firstName','$lastName','$emailId','$mobile','$dob','$doj','$profileImg','$address')";
			$result = mysqli_query($conn, $sqlQuery);	
			if($result){
				$comErr="success";
			}else{
				$comErr="success not";
			}
	}else{ 
		$comErr = "Please check all fields.";
	}
}

?>
<div class="container">
	<form action="" method="post" enctype="multipart/form-data">
	  <div class="row">
	  	<div class="col-sm-6 mt-3">
	      <input name="userName" type="text" class="form-control" placeholder="User Name*" >
	      <span><?php echo (!empty($userErr))? $userErr: ''; ?></span>
	    </div>
	    <div class="col-sm-6 mt-3">
	      <input name="password" type="password" maxlength="20" class="form-control" placeholder="Password*" >
	      <span><?php echo (!empty($passErr))? $passErr: ''; ?></span>
	    </div>
	    <div class="col-sm-6 mt-3">
	      <input name="firstName" type="text" class="form-control" placeholder="First Name*" >
	      <span><?php echo (!empty($fnameErr))? $fnameErr: ''; ?></span>
	    </div>
	    <div class="col-sm-6 mt-3">
	      <input name="lastName" type="text" class="form-control" placeholder="Last Name*">
	      <span><?php echo (!empty($lnameErr))? $lnameErr: ''; ?></span>
	    </div>
			<div class="col-sm-6 mt-3">
	      <input name="emailId" type="text" class="form-control" placeholder="Email*">
	      <span><?php echo (!empty($emailErr))? $emailErr: ''; ?></span>
	    </div>
	    <div class="col-sm-6 mt-3">
	      <input name="mobile" type="text" class="form-control" placeholder="Mobile*">
	      <span><?php echo (!empty($mobileErr))? $mobileErr: ''; ?></span>
	    </div>
	    <div class="col-sm-6 mt-3">
	      <input name="dob" type="calender" class="form-control" placeholder="Date Of Birth*">
	      <span><?php echo (!empty($dobErr))? $dobErr: ''; ?></span>
	    </div>
	    <div class="col-sm-6 mt-3">
	      <input name="doj" type="calender" class="form-control" placeholder="Date Of Joining*">
	      <span><?php echo (!empty($dojErr))? $dojErr: ''; ?></span>
	    </div>
	    <div class="col-sm-6 mt-3">
	      <input name="profileImg" type="file" class="form-control" placeholder="Profile">	      
	    </div>
	    <div class="col-sm-6 mt-3">
	      <input name="address" type="text" class="form-control" placeholder="Address*">
	      <span><?php echo (!empty($addressErr))? $addressErr: ''; ?></span>
	    </div>
	    <div class="col-sm-12 text-center mt-3 ">
	      <input type="submit" class="btn btn-warning btn-md text-white" style="width:150px" name="registerSubmit" value="SUBMIT">
	    </div>
	  </div>
	</form> 
	<span><?php echo (!empty($comErr))? $comErr: ''; ?></span> 
</div>
<?php include "./view/common/footer.php"; ?>
<!-- 
<div class="row justify-content-center">
    <div class="col-lg-9 bg-white py-5 border shadow-lg">
      <div class="row">
        <div class="col-lg-6 col-sm-12 d-flex justify-content-center login_form_img">
          <i class="fas fa-sign-in-alt ligin_icon py-5"></i>
        </div>
        <div class="col-lg-6 col-sm-12 py-4 px-5">
          <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4 ">Login</h1>
          </div>
          <form method="post" action="">
            <div class="form-group text-center">
              <div class="form-group">
                <input type="text" name="username" value="<?php //echo $username;?>" class="form-control rounded-pill form-control-user py-2" placeholder="User name" autocomplete="off" />
                <span class="error-msg"><?php //echo (!empty($userErr))? $userErr: "";?></span>
              </div>
            </div>
            <div class="form-group py-4 text-center">
              <div class="form-group">
                <input name="password" value="<?php //echo $password;?>" class="form-control rounded-pill form-control-user py-2" placeholder="Password" type="password" autocomplete="off" />
                <span class="error-msg"><?php //echo (!empty($passErr))? $passErr : "";?></span>
              </div>
            </div>
            <input type="submit" name="submitLogin"class="btn w-100 rounded-pill btn-primary btn w-100 m-0 btn-hover color-3 py-2" value="Login" />
          </form>
          <span class="error-msg"><?php // echo (!empty($comErr))? $comErr : "";?></span>          
        </div>
        <a href="./view/forgotpassword.php">forgot password</a>
      </div>
    </div> -->