<?php 
  include "./header.php";
  $conn = mysqli_connect('localhost','ikfsmtp','l25kd89@#$xdfg','smtp_db')or die("Unable to connect!!");
?>
<div class="container">
  <div class="row justify-content-center">            
    <!-- member listing -->
    <ul class="row birthlisting"></ul> 
    <!-- profile  -->
    <ul class="row profileForm"></ul>
  </div>
</div>
<?php 
$imglink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://".$_SERVER['HTTP_HOST'];

$productImageErr = "";
$productImageErr1 = "";
$productImageSucc = "";

$productTitleErr = "";

$productCategoryErr = "";

$productTitleSucc = '';

$productDescErr = "";


if(isset($_REQUEST['submitBanner'])){    
   $productCatId = $_POST['productCatId'];
   $productCategory = $_POST['productCategory'];  
   $productTitle = $_POST['productTitle'];  
   $productDesc = $_POST['productDesc'];
   $productImage = $_FILES['productImage'];

  

  if( empty($productImage)){
    $productImageErr="This field should not be blank.";
  }else{   
    $target_dir = "../../uploads/products/";
    $target_path = $target_dir.basename( $_FILES['productImage']['name']);
    $imguplink = $imglink."/emp-management/admin/uploads/".basename( $_FILES['productImage']['name']);
    if(move_uploaded_file($_FILES['productImage']['tmp_name'], $target_path)) {  
      $productImageSucc = "File uploaded successfully!";  
    } else{  
      $productImageErr1 = "Sorry, file not uploaded, please try again!";  
    } 
  }


  if( empty($productTitle) ){
    $productTitleErr="This field should not be blank.";
  }

  if( empty($productCategory) ){
    $productCategoryErr="This field should not be blank.";
  }

  if( empty($productDesc) ){
    $productDescErr="This field should not be blank.";
  }

  if( (!empty($productImage)) && (!empty($productTitle)) && (!empty($productCategory)) && (!empty($productDesc))  ){ 
  $productCatIds = (!empty($productCatId))? $productCatId: '1';   
    $comResp = productInsertion($conn,$productCatIds,$productCategory,$productTitle,$productDesc,$imguplink);
  }else{
    $comErr = "Please check all fields.";
  }
}
function productInsertion($conn,$productCatIds,$productCategory,$productTitle,$productDesc,$imguplink){
  //echo '$target_path','$bannerTitle','$bannerCategory';
  $bnnerQuery = "INSERT INTO  products (prod_parent_cat_id,prod_parent_cat_name,prod_name ,prod_desc, prod_img) VALUES('$productCatIds','$productCategory','$productTitle','$productDesc','$imguplink')";
  $res= mysqli_query($conn,$bnnerQuery);
  if($res){
    return "Your product has been saved successfully!!.";
  }else{
    return "Sorry, unable to save your product please try after sometime.";
  }
}
?>
<div class="container">  
 <div class="d-flex align-items-center justify-content-center row">
        <div class="p-2 m-2 bg-info text-white shadow rounded-2 col-md-10 text-center">      
          <a href="<?php echo $imglink?>/emp-management/admin/view/common/dashboard.php" >Home</a>
        </div>
  </div>  
  <div class="d-flex align-items-center justify-content-center row">
      <div class="p-2 m-2 bg-info text-white shadow rounded-2 col-md-10 text-center">      
        <form method="post" action="" enctype="multipart/form-data" onsubmit="//insertBanner()" id="bannerForm">
          <div class="form-group">
            <label for="productImage">Product Image*</label> 
            <input type="file" class="form-control" value="<?php echo $_FILES['productImage']['name'];?>"name="productImage" id="productImage" autocomplete="off" >
            <?php 
            if( (!empty($productImageSucc)) ){                
                echo '<small id="bannerIMGErr" class="form-text text-muted success">"'.$productImageSucc.'"</small>';  
            }else if( !empty($productImageErr) ){              
              echo '<small id="bannerIMGErr" class="form-text text-muted error">"'.$productImageErr.'"</small>';  
            }else if( !empty($productImageErr1) ){              
              echo '<small id="bannerIMGErr" class="form-text text-muted error">"'.$productImageErr1.'"</small>';  
            }else{
              echo '<small id="bannerIMGErr" class="form-text text-muted"> </small>';  
            }
            ?>         
          </div>
          <div class="form-group">
            <label for="bannerTitle">Product Title*</label>
            <input maxlength="100" type="text" class="form-control" id="productTitle" name="productTitle" value="<?php echo $_POST['productTitle'];?>" autocomplete="off" placeholder="Product Title*" >
            <small id="bannerTtlErr" class="form-text text-muted"><?php echo (!empty($productTitleErr))? $productTitleErr : "";?></small>
          </div>
          <div class="form-group">
            <label for="productCatId">Product Category Id</label>
            <input maxlength="100" type="text" class="form-control" id="productCatId" name="productCatId" value="<?php echo $_POST['productCatId'];?>" autocomplete="off" placeholder="Product Category Id" >
            <small id="productCatIdErr" class="form-text text-muted"><?php echo (!empty($productCatIdErr))? $productCatIdErr : "";?></small>
          </div>
          <div class="form-group">
            <label for='productCategory' >Product Category*</label> 
            <select class="form-control" id="bannerCategory" name="productCategory" >
            <option value="">Select Product Category*</option>
            <option value="1">First Banner</option>
            <option value="2">Second Banner</option>
            <option value="3">Third Banner</option>
            <option value="4">Fourth Banner</option>
            <option value="5">Fifth Banner</option>
            </select>
            <small id="productCatErr" class="form-text text-muted"><?php echo (!empty($productCategoryErr))? $productCategoryErr : "";?></small>
          </div>
          <div class="form-group">
            <label for="productDesc">Product Description*</label>
            <textarea class="form-control" name="productDesc"id="productDesc" rows="3" style="resize: none;" maxlength="250"><?php echo $_POST['productDesc']; ?></textarea>
            <small id="productDescErr" class="form-text text-muted"><?php echo (!empty($productDescErr))? $productDescErr : "";?></small>
          </div>                   
          <button type="submit" class="btn btn-primary mt-2" name="submitBanner" >Submit</button>
        </form>
        <small id="bannerCatErr" class="form-text text-muted"><?php echo (!empty($comResp))? $comResp : "";?></small>        
        <small id="bannerCatErr" class="form-text text-muted"><?php echo (!empty($comErr))? $comErr : "";?></small>        
      </div>   
  </div>

 <div class="d-flex align-items-center justify-content-center row">
    <div class="p-2 m-2 bg-info text-white shadow rounded-2 col-md-10 text-center">              
    <table class="table table-hover table-dark">
      <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col"><h5>Product Image</h5></th>
        <th scope="col"><h5>Cat Id</h5></th>
        <th scope="col"><h5>Cat Name</h5></th>
        <th scope="col"><h5>Product Id</h5></th>
        <th scope="col"><h5>Product Name</h5></th>
        <th scope="col">Banner Action</th>
      </tr>
      </thead>
      <tbody id="bannerImage-body"></tbody>       
    </table>    
  </div>
</div>
</div>
<script>
  $(document).ready(function(){
    $.ajax({
      url: 'https://development.ikf.in/emp-management/admin/API/getallproductsapi.php',
      type: 'post',
      dataType: 'JSON',
      success: function(bannerdata){
        console.log(bannerdata);
        var outupt = '';
        bannerdata.forEach( (items,index)=>{
          outupt += `<tr>`;
          outupt += `<td>${index}</td>`;
          outupt += `<td><img src="${items.prod_img}" alt="${items.prod_name}" class="img-thumbnail"></td>`;
          outupt += `<td>${items.prod_parent_cat_id}</td>`;
          outupt += `<td>${items.prod_parent_cat_name}</td>`;
          outupt += `<td>${items.prod_id}</td>`;                              
          outupt += `<td>${items.prod_name}</td>`;
          outupt += `<td><!-- <button class="btn btn-success">Edit</button> --><button onclick="removeProduct(${items.prod_id})" class="btn btn-warning">Delete</button></td>`;
          outupt += `</tr>`;          
        });
        $("#bannerImage-body").html(outupt);
      }
    })
  })

// function insertBanner(){
//   event.preventDefault();
//   var bannerForm = document.getElementById('bannerForm');
//   const formData = new FormData(bannerForm);  
//   console.log(formData);
//   for(const [key,value] of formData){
//     console.log(`${key} - ${value}`);

//   }
      
// } 
function removeProduct(pid){
  alert(pid)
  $.ajax({
    url: 'https://development.ikf.in/emp-management/admin/API/deleteProductApi.php',
    type: 'post',
    data: {'prodid': pid},
    dataType: 'JSON',
    success: function(resp){
      if(resp.status == "Error" ){
        alert(resp.msg);
        location.reload(true);
      }
      if(resp.status == "Success" ){
        alert(resp.msg);
        location.reload(true);
      }                      
    }
  });
}


</script>
<?php include "./footer.php"; ?>