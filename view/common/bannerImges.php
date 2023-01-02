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
$bannerTitleErr = "";
$bannerTitleErr = "";
$bannerCategoryErr = "";
$bannerTitleSucc = '';
if(isset($_REQUEST['submitBanner'])){    
  $bannerImage = $_FILES['bannerImage'];
  $bannerTitle = $_POST['bannerTitle'];
  $bannerCategory = $_POST['bannerCategory'];
  
  if( empty($bannerImage)){
    $bannerTitleErr="This field should not be blank.";
  }else{   
    $target_dir = "../../uploads/";
    $target_path = $target_dir.basename( $_FILES['bannerImage']['name']);
    $imguplink = $imglink."/emp-management/admin/uploads/".basename( $_FILES['bannerImage']['name']);
    if(move_uploaded_file($_FILES['bannerImage']['tmp_name'], $target_path)) {  
      $bannerTitleSucc = "File uploaded successfully!";  
    } else{  
      $bannerTitleErr = "Sorry, file not uploaded, please try again!";  
    } 
  }

  if( empty($bannerTitle) ){
    $bannerTitleErr="This field should not be blank.";
  }

   if( empty($bannerCategory) ){
    $bannerCategoryErr="This field should not be blank.";
  }

  if( (!empty($bannerImage)) && (!empty($bannerTitle)) && (!empty($bannerCategory))  ){    
    $comResp = bannerInser($conn,$imguplink,$bannerTitle,$bannerCategory);
  }else{
    $comErr = "Please check all fields.";
  }
}

function bannerInser($conn,$imguplink,$bannerTitle,$bannerCategory){
  //echo '$target_path','$bannerTitle','$bannerCategory';
  $bnnerQuery = "INSERT INTO  bannner (bannerimage,bannertitle,bannercategory) VALUES('$imguplink','$bannerTitle','$bannerCategory')";
  $res= mysqli_query($conn,$bnnerQuery);
  if($res){
    return "Inserted";

  }else{
    return "Inserted not ";
  }
}
?>
<div class="container">    
  <div class="d-flex align-items-center justify-content-center row">
        <div class="p-2 m-2 bg-info text-white shadow rounded-2 col-md-7 text-center">      
          <a href="<?php echo $imglink?>/emp-management/admin/view/common/dashboard.php" >Home</a>
        </div>
  </div>
  <div class="d-flex align-items-center justify-content-center row">
      <div class="p-2 m-2 bg-info text-white shadow rounded-2 col-md-7 text-center">      
        <form method="post" action="" enctype="multipart/form-data" onsubmit="//insertBanner()" id="bannerForm">
          <div class="form-group">
            <label for="bannerTitle">Banner Image*</label> 
            <input type="file" class="form-control" value="<?php echo $_FILES['bannerImage']['name'];?>"name="bannerImage" id="bannerImage" autocomplete="off" >
            <?php 
            if( (!empty($bannerTitleSucc)) ){                
                echo '<small id="bannerIMGErr" class="form-text text-muted success">"'.$bannerTitleSucc.'"</small>';  
            }else if( !empty($bannerTitleErr) ){              
              echo '<small id="bannerIMGErr" class="form-text text-muted error">"'.$bannerTitleErr.'"</small>';  
            }else{
              echo '<small id="bannerIMGErr" class="form-text text-muted"> </small>';  
            }
            ?>         
          </div>
          <div class="form-group">
            <label for="bannerTitle">Banner Title*</label>
            <input type="text" class="form-control" id="bannerTitle" name="bannerTitle" value="<?php echo $_POST['bannerTitle'];?>" autocomplete="off" placeholder="Banner Title*" >
            <small id="bannerTtlErr" class="form-text text-muted"><?php echo (!empty($bannerTitleErr))? $bannerTitleErr : "";?></small>
          </div>
          <div class="form-group">
            <label for='bannerCategory' >Banner Category*</label> 
            <select class="form-control" id="bannerCategory" name="bannerCategory" >
            <option value="">Select Banner Category*</option>
            <option value="1">First Banner</option>
            <option value="2">Second Banner</option>
            <option value="3">Third Banner</option>
            <option value="4">Fourth Banner</option>
            <option value="5">Fifth Banner</option>
            </select>
            <small id="bannerCatErr" class="form-text text-muted"><?php echo (!empty($bannerCategoryErr))? $bannerCategoryErr : "";?></small>
          </div>
          <button type="submit" class="btn btn-primary" name="submitBanner" >Submit</button>
        </form>
        <small id="bannerCatErr" class="form-text text-muted"><?php echo (!empty($comResp))? $comResp : "";?></small>        
      </div>   
  </div>

 <div class="d-flex align-items-center justify-content-center row">
    <div class="p-2 m-2 bg-info text-white shadow rounded-2 col-md-7 text-center">              
    <table class="table table-hover table-dark">
      <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col"><h4>Banner Image</h4></th>
        <th scope="col"><h4>Banner Title</h4></th>
        <th scope="col"><h4>Banner Category</h4></th>
        <th scope="col">Banner Action</th>
      </tr>
      </thead>
      <tbody id="bannerImage-body">
      <tr>
        <td>1</td>
        <td><img src="..." alt="..." class="img-thumbnail"></td>
        <td>Laxman Kendre</td>
        <td>Category Types</td>
        <td><button class="btn btn-warning">Delete</button></td>
      </tr>   
  
      </tbody>
    </table>    
  </div>
</div>
</div>
<script>
  $(document).ready(function(){
    $.ajax({
      url: 'https://development.ikf.in/emp-management/admin/API/getallbannersapi.php',
      type: 'post',
      dataType: 'JSON',
      success: function(bannerdata){
        console.log(bannerdata);
        var outupt = '';
        bannerdata.forEach( (items,index)=>{
          outupt += `<tr>`;
          outupt += `<td>${items.bannerid}</td>`;
          outupt += `<td><img src="${items.bannerimage}" alt="${items.bannertitle}" class="img-thumbnail"></td>`;
          outupt += `<td>${items.bannertitle}</td>`;
          outupt += `<td>${items.bannercategory}</td>`;
          outupt += `<td><!-- <button class="btn btn-success">Edit</button> --><button onclick="deleteBannr(${items.bannerid})" class="btn btn-warning">Delete</button></td>`;
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
function deleteBannr(bid){
  alert(bid)
  $.ajax({
    url: 'https://development.ikf.in/emp-management/admin/API/deleteBannerApi.php',
    type: 'post',
    data: {'bannerid': bid},
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