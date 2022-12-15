<?php    
  session_start();  
  if(!isset($_SESSION['user_name'])){
    header("Location: https://development.ikf.in/emp-management/admin/");
  }
?>
<?php 
$url = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'http://' : 'https://'.$_SERVER['SERVER_NAME'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Membership</title>
    <link
      href='<?php echo $url."/emp-management/admin/view/styles/bootstrap/bootstrap.min.css";?>'
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
    <link
      href='<?php echo $url."/emp-management/admin/view/styles/vendor/fontawesome-free/css/all.min.css";?>'
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="'<?php echo $url."/emp-management/admin/view/styles/css/style.css";?>'"
      rel="stylesheet"
      type="text/css"
    />    
    <script src='<?php echo $url."/emp-management/admin/view/styles/js/custom.js";?>'></script>
    <script src='<?php echo $url."/emp-management/admin/view/styles/js/jquery.min.js";?>'></script>
  </head>
  <body class="login_form_body bg-primary">
    <span class="logoutbtn"> <a href="logout.php" class="btn btn-warning">Logout | <?php echo $_SESSION['user_name']; ?></a></span>