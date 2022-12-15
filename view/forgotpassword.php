<?php include "../header.php";  
	include "../config.php";
	include('smtp/PHPMailerAutoload.php');
?>

<?php 
// from  email landing
if( empty($_GET[sha1('lklink')])){

?>
<?php
$userErr = "";
if(isset($_REQUEST['forgotPassSmt'])){
	$useremail = $_POST['useremail'];
	if( empty($useremail)){
		$userErr="This field should not be blank.";
	}else{						
		$userErr =  getRegistEmail($useremail);		
	}	
}
function getRegistEmail($userEmail){
	$conn = $GLOBALS['conn'];
	$sqlQuery = "select role_id,user_name,user_pass,user_email from user where user_email = '{$userEmail}' ";
	$result = mysqli_query($conn, $sqlQuery);		
	$sendResp = '';
	if($row = mysqli_num_rows($result) > 0 ){
		$rs = mysqli_fetch_assoc($result);		
		$role_id = $rs['role_id'];
		$user_name = $rs['user_name'];
		//$user_email = $rows['user_email'];
		$token = sha1(rand(10,10000000));
		$tokanQuery = "update user set  set_token = '{$token}' where role_id = '{$role_id}' AND user_name='{$user_name}' ";
		$updateResult = mysqli_query($conn, $tokanQuery);		
		if($updateResult == 1){	
			$sentemailResp = sendForgorPassLink($userEmail,$user_name,$token);					
		}else{
			$sendResp= "OOPS!, something went wrong with you please try again!!";	
		}			
	}else{
		$sendResp = 'Sorry, Your email id is not associated with us!';
	}
	return $sendResp;
}
function sendForgorPassLink($userEmail,$user_name,$token){
	
	$downloadLink = sha1('lklink');
	$dlink = "https://development.ikf.in/emp-management/admin/view/forgotpassword.php?".$downloadLink."=".$token;	
	$subject = "Forgot Password Link";
	 $msg = "Dear ".$user_name.",<br><br> You have received below Password reset link from <strong>Laxman</strong>.<br>";             
    $msg .= "<br>Email:".$to;    
    $msg .= "<a href='".$dlink."' title='click here!!' target='_NEW'>Reset Password</a>";
    $msg .= "<br><br><br>";
    $msg .= "Thanks & Regards,<br>";
    $msg .= "<strong>Laxman Kendre</strong>";
	$mail = new PHPMailer(); 
	$mail->SMTPDebug  = 3;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com"; // smtp change
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "helpdesk@ikf.co.in"; // smtp email
	$mail->Password = "Help987$#"; // pass
	$mail->SetFrom("laxman.kendre@ikf.co.in"); // email
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($userEmail);
	$mail->ClearReplyTos();
	$mail->addReplyTo('laxman.kendre@ikf.co.in', 'IKF Dashboard');
	$mail->SMTPOptions=array('ssl'=>array(
	'verify_peer'=>false,
	'verify_peer_name'=>false,
	'allow_self_signed'=>false
	));
	$resp = [];
	if(!$mail->Send()){ 
		return $user_name.'not sent';
	}else{
		return $user_name.'Please check your email your for Forgot Password.';
	}
	
}



?>
<?php 
$url = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'http://' : 'https://'.$_SERVER['SERVER_NAME'];
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
            <h1 class="h4 text-gray-900 mb-4 ">Forgot Password</h1>
          </div>
          <form method="post" action="">
            <div class="form-group text-center py-4 ">
              <div class="form-group">
                <input type="text" name="useremail" value="<?php echo $username;?>" class="form-control rounded-pill form-control-user py-2" placeholder="Enter your email" autocomplete="off" />
                <span class="error-msg"><?php echo (!empty($userErr))? $userErr: "";?></span>
              </div>
            </div>
          
            <input type="submit" name="forgotPassSmt"class="btn w-100 rounded-pill btn-primary btn w-100 m-0 btn-hover color-3 py-2" value="Forgot Password" />
          </form> 
          <span class="sentResp"><?php echo (!empty($sentemailResp))? $sentemailResp : "";?></span>                   
        </div>        
      </div>
    </div>
  </div>
</div>
<?php 
}else{  // forgot form ?>
	

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
	                <input name="password" value="<?php echo $password;?>" class="form-control rounded-pill form-control-user py-2" placeholder="Enter your new Password" type="password" autocomplete="off" />
	                <span class="error-msg"><?php echo (!empty($passErr))? $passErr : "";?></span>
	              </div>
	            </div>

<!-- password reset -->
	            <div class="form-group py-4 text-center">
	              <div class="form-group">
	                <input name="passwordconfirm" value="<?php echo $password;?>" class="form-control rounded-pill form-control-user py-2" placeholder="Confirm Password" type="password" autocomplete="off" />
	                <span class="error-msg"><?php echo (!empty($passConfErr))? $passConfErr : "";?></span>
	              </div>
	            </div>

<!-- password reset -->

		        <input type="submit" name="forgotPassSmt"class="btn w-100 rounded-pill btn-primary btn w-100 m-0 btn-hover color-3 py-2" value="Save Password" />
		      </form> 
		      <span class="sentResp"><?php echo (!empty($sentemailResp))? $sentemailResp : "";?></span>                   
		    </div>        
		  </div>
		</div>
	</div>
</div>


<?php // forgot form 

} ?>

<?php include "./common/footer.php"; ?>
