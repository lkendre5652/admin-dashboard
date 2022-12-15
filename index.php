<?php 
include "./header.php"; 
include "./config.php";
$userErr = "";
$passErr = "";
$comErr = "";
if(isset($_REQUEST['submitLogin'])){
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = $_POST['password'];
	
	if( empty($username)){
		$userErr="This field should not be blank.";
	}
	if( empty($password) ){
		$passErr="This field should not be blank.";
	}
	if( (!empty($username)) && (!empty($password)) ){		 
		$comErr = getUserData($username,$password,$conn);
	}else{
		$comErr = "Please check all fields.";
	}
}
function getUserData($username,$password){
	$conn = $GLOBALS['conn'];
	$pass = md5($password);
	$sqlQuery = "select role_id,user_name,user_pass from user where user_name = '{$username}' AND user_pass ='{$pass}'";
	$result = mysqli_query($conn, $sqlQuery);	
	if($row = mysqli_num_rows($result) > 0 ){
		while($rows = mysqli_fetch_assoc($result) ){			
			session_start();
			$_SESSION['role_id'] = $rows['role_id'];			
			$_SESSION['user_name'] = $rows['user_name'];			
			$_SESSION['user_pass'] = $rows['user_pass'];
			header("Location: https://development.ikf.in/emp-management/admin/view/common/dashboard.php");
		}
	}else{
		return $GLOBAL['comErr'] = "User name and Password is not correct.";

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
            <h1 class="h4 text-gray-900 mb-4 ">Login</h1>
          </div>
          <form method="post" action="">
            <div class="form-group text-center">
              <div class="form-group">
                <input type="text" name="username" value="<?php echo $username;?>" class="form-control rounded-pill form-control-user py-2" placeholder="User name" autocomplete="off" />
                <span class="error-msg"><?php echo (!empty($userErr))? $userErr: "";?></span>
              </div>
            </div>
            <div class="form-group py-4 text-center">
              <div class="form-group">
                <input name="password" value="<?php echo $password;?>" class="form-control rounded-pill form-control-user py-2" placeholder="Password" type="password" autocomplete="off" />
                <span class="error-msg"><?php echo (!empty($passErr))? $passErr : "";?></span>
              </div>
            </div>
            <input type="submit" name="submitLogin"class="btn w-100 rounded-pill btn-primary btn w-100 m-0 btn-hover color-3 py-2" value="Login" />
          </form>
          <span class="error-msg"><?php echo (!empty($comErr))? $comErr : "";?></span>          
        </div>
        <a href="./view/forgotpassword.php">forgot password</a>
      </div>
    </div>
  </div>
</div>
<?php include "./view/common/footer.php"; ?>