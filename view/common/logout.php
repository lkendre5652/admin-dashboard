<?php 
session_start();
session_unset();
session_destroy();
header("Location: https://development.ikf.in/emp-management/admin/");
?>