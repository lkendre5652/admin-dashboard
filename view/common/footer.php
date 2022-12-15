<?php 
$url = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'http://' : 'https://'.$_SERVER['SERVER_NAME'];
?>
<script
      src='<?php echo $url."/emp-management/admin/view/styles/bootstrap/popper.min.js";?>'
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
      crossorigin="anonymous"
    ></script>
    <script
      src='<?php echo $url."/emp-management/admin/view/styles/bootstrap/bootstrap.min.js";?>'
      integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
      crossorigin="anonymous"
    ></script>
    <script
      src='<?php echo $url."/emp-management/admin/view/styles/bootstrap/bootstrap.bundle.min.js";?>'
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
