<?php include "../header.php";  
	include "../config.php";
	include('smtp/PHPMailerAutoload.php');
?>


<?php   
//forgot form
 $token = $_GET[sha1('lklink')]; 

$userErr = "";
if(isset($_REQUEST['updateForgotPass'])){
	$newPass = $_POST['newPass'];
	$newPassCfrm = $_POST['newPassCfrm'];
	if( empty($newPass)){
		$newPassErr="This field should not be blank.";
	}else if( !preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $newPass) ){		
		$newPassErr= "Password must be like ex: Exampl$1";
	}else{
		$matchPass = 1 ;
	}
	if( empty($newPassCfrm)){
		$newPassCfrmErr="This field should not be blank.";
	}
	if( empty($newPass) && empty($newPassCfrm) ){
		$newPassCommErr="Please check your fields, It should not blank.";
	}else if( ($newPassCfrm != $newPass ) || ($matchPass != 1) ){
		$newPassCfrmErr= "Please check confirm Password not  matching.";
	}else{
			//$newP = md5($newPass);
			echo isSetPassword(md5($newPass),$GLOBALS['conn'],$token);
	
		$sentemailResp="Hey, Your Password has been updated successfully!";
	}
}

function isSetPassword($newP,$conn,$token){	 		
			$updtPassQuery = "UPDATE user set user_pass = '{$newP}' WHERE set_token = '{$token}' ";
			$res = mysqli_query($conn,$updtPassQuery);
			if($res){				
				$updtTokenQuery = "UPDATE user set set_token = 'NULL' WHERE set_token = '{$token}' ";
				$resToken = mysqli_query($conn,$updtTokenQuery);
				return ($resToken) ? 'Token Update': 'Not token update' ;
			}else{
				return 'Failed';
			}
}

?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-9 bg-white py-5 border shadow-lg">
		  <div class="row">
		    <div class="col-lg-6 col-sm-12 d-flex justify-content-center login_form_img">
		      <i class="fas fa-sign-in-alt ligin_icon py-5"></i>
		    </div>
		    <div class="col-lg-6 col-sm-12 py-4 px-5">
		      <div class="text-center">
		        <h1 class="h4 text-gray-900 mb-4 ">Resent Password</h1>
		      </div>
		      <form method="post" action="">
		      	
<!-- password reset -->
		        <div class="form-group py-4 text-center">
	              <div class="form-group">
	                <input name="newPass" value="<?php echo $newPass;?>" class="form-control rounded-pill form-control-user py-2" placeholder="Enter your new Password" type="password" autocomplete="off" />
	                <span class="error-msg"><?php echo (!empty($newPassErr))? $newPassErr : "";?></span>
	              </div>
	            </div>

<!-- password reset -->
	            <div class="form-group py-4 text-center">
	              <div class="form-group">
	                <input name="newPassCfrm" value="<?php echo $newPassCfrm;?>" class="form-control rounded-pill form-control-user py-2" placeholder="Confirm Password" type="password" autocomplete="off" />
	                <span class="error-msg"><?php echo (!empty($newPassCfrmErr))? $newPassCfrmErr : "";?></span>
	              </div>
	            </div>

<!-- password reset -->

		        <input type="submit" name="updateForgotPass"class="btn w-100 rounded-pill btn-primary btn w-100 m-0 btn-hover color-3 py-2" value="Save Password" />
		      </form> 
		      <span class="error-msg"><?php echo (!empty($newPassCommErr))? $newPassCommErr : "";?></span>                   
		      <span class="sentResp"><?php echo (!empty($sentemailResp))? $sentemailResp : "";?></span>                   
		    </div>        
		  </div>
		</div>
	</div>
</div>

<?php include "./common/footer.php"; ?>
