<?php include "./header.php"; ?>
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
                <input type="text" name="username" value="" class="form-control rounded-pill form-control-user py-2" placeholder="User name" autocomplete="off" />
                <span class="error-msg"></span>
              </div>
            </div>
            <div class="form-group py-4 text-center">
              <div class="form-group">
                <input name="password" value="" class="form-control rounded-pill form-control-user py-2" placeholder="Password" type="password" autocomplete="off" />
                <span class="error-msg"></span>
              </div>
            </div>
            <input type="submit" name="submitLogin"class="btn w-100 rounded-pill btn-primary btn w-100 m-0 btn-hover color-3 py-2" value="Login" />
          </form>
          <span class="error-msg"></span>
          <span class="error-msg"></span>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include "./footer.php"; ?>