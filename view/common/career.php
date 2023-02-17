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

$careerImageErr = "";
$careerImageErr1 = "";
$careerImageSucc = "";

$careerTitleErr = "";

$careerCategoryErr = "";

$careerTitleSucc = '';

$careerDescErr = "";


if(isset($_REQUEST['submitBanner'])){    
   $careerCatId = $_POST['careerCatId'];
   $careerCategory = $_POST['careerCategory'];  
   $careerTitle = $_POST['careerTitle'];  
   $careerDesc = $_POST['careerDesc'];
   $careerImage = $_FILES['careerImage'];

  

  if( empty($careerImage)){
    $careerImageErr="This field should not be blank.";
  }else{   
    $target_dir = "../../uploads/products/";
    $target_path = $target_dir.basename( $_FILES['careerImage']['name']);
    $imguplink = $imglink."/emp-management/admin/uploads/products/".basename( $_FILES['careerImage']['name']);

    if(move_uploaded_file($_FILES['careerImage']['tmp_name'], $target_path)) {  
      $careerImageSucc = "File uploaded successfully!";  
    } else{  
      $careerImageErr1 = "Sorry, file not uploaded, please try again!";  
    } 
  }


  if( empty($careerTitle) ){
    $careerTitleErr="This field should not be blank.";
  }

  if( empty($careerCategory) ){
    $careerCategoryErr="This field should not be blank.";
  }

  if( empty($careerDesc) ){
    $careerDescErr="This field should not be blank.";
  }

  if( (!empty($careerImage)) && (!empty($careerTitle)) && (!empty($careerCategory)) && (!empty($careerDesc))  ){ 
  $careerCatIds = (!empty($careerCatId))? $careerCatId: '1';   
    $comResp = careerInsertion($conn,$careerCatIds,$careerCategory,$careerTitle,$careerDesc,$imguplink);
  }else{
    $comErr = "Please check all fields.";
  }
}
function careerInsertion($conn,$careerCatIds,$careerCategory,$careerTitle,$careerDesc,$imguplink){
 

  //echo '$target_path','$bannerTitle','$bannerCategory';
  $bnnerQuery = "INSERT INTO  career_list (career_name,career_description,career_img,cid) VALUES('$careerTitle','$careerDesc','$imguplink','$careerCatIds')";
  $res= mysqli_query($conn,$bnnerQuery);
  if($res){
    return "Your Career has been saved successfully!!.";
  }else{
    return "Sorry, unable to save your Career please try after sometime.";
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
            <label for="careerImage">Career Image*</label> 
            <input type="file" class="form-control" value="<?php echo $_FILES['careerImage']['name'];?>"name="careerImage" id="careerImage" autocomplete="off" >
            <?php 
            if( (!empty($careerImageSucc)) ){                
                echo '<small id="bannerIMGErr" class="form-text text-muted success">"'.$careerImageSucc.'"</small>';  
            }else if( !empty($careerImageErr) ){              
              echo '<small id="bannerIMGErr" class="form-text text-muted error">"'.$careerImageErr.'"</small>';  
            }else if( !empty($careerImageErr1) ){              
              echo '<small id="bannerIMGErr" class="form-text text-muted error">"'.$careerImageErr1.'"</small>';  
            }else{
              echo '<small id="bannerIMGErr" class="form-text text-muted"> </small>';  
            }
            ?>         
          </div>
          <div class="form-group">
            <label for="bannerTitle">Career Title*</label>
            <input maxlength="100" type="text" class="form-control" id="careerTitle" name="careerTitle" value="<?php echo $_POST['careerTitle'];?>" autocomplete="off" placeholder="Career Title*" >
            <small id="bannerTtlErr" class="form-text text-muted"><?php echo (!empty($careerTitleErr))? $careerTitleErr : "";?></small>
          </div>
          <div class="form-group" style="display: none;">
            <label for="careerCatId">Career Category Id</label>
            <input maxlength="100" type="text" class="form-control" id="careerCatId" name="careerCatId" value="<?php echo $_POST['careerCatId'];?>" autocomplete="off" placeholder="Career Category Id" >
            <small id="careerCatIdErr" class="form-text text-muted"><?php echo (!empty($careerCatIdErr))? $careerCatIdErr : "";?></small>
          </div>
          <div class="form-group">
            <label for='careerCategory' >Career Category*</label> 
            <select class="form-control" id="bannerCategory" name="careerCategory" >
            <option value="">Select Career Category*</option>
            <?php  
            $query = "SELECT * FROM CAREER_CATS";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0 ){
              while ($rows = mysqli_fetch_assoc($result) ) { ?>                
                <option value="<?php echo $rows['cat_name']; ?>" id="<?php echo $rows['cid']; ?>"><?php echo $rows['cat_name']; ?></option>
              <?php }
            }
            ?>  
            </select>
            <small id="careerCatErr" class="form-text text-muted"><?php echo (!empty($careerCategoryErr))? $careerCategoryErr : "";?></small>
          </div>
          <div class="form-group">
            <label for="careerDesc">Career Description*</label>
            <textarea class="form-control" name="careerDesc"id="careerDesc" rows="3" style="resize: none;" maxlength="250"><?php echo $_POST['careerDesc']; ?></textarea>
            <small id="careerDescErr" class="form-text text-muted"><?php echo (!empty($careerDescErr))? $careerDescErr : "";?></small>
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
        <th scope="col"><h6>Career Image</h6></th>
        <th scope="col"><h6>Cat Id</h6></th>
        <th scope="col"><h6>Cat Name</h6></th>
        <th scope="col"><h6>Career Id</h6></th>
        <th scope="col"><h6>Career Name</h6></th>
        <th scope="col"><h6>Career Description</h6></th>
        <th scope="col"><h6>Action</h6></th>
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
      url: 'https://development.ikf.in/emp-management/admin/API/getallcareersapi.php',
      type: 'post',
      dataType: 'JSON',
      success: function(bannerdata){
        console.log(bannerdata);
        var outupt = '';
        bannerdata.forEach( (items,index)=>{
          outupt += `<tr>`;
          outupt += `<td>${index}</td>`;
          outupt += `<td><img src="${items.career_img}" alt="${items.career_name}" class="img-thumbnail"></td>`;
          outupt += `<td>${items.cid}</td>`;
          outupt += `<td>${items.cat_name}</td>`;
          outupt += `<td>${items.clid}</td>`;                              
          outupt += `<td>${items.career_name}</td>`;
          outupt += `<td>${items.career_description}</td>`;
          outupt += `<td><!-- <button class="btn btn-success">Edit</button> --><button onclick="removeCareer(${items.clid})" class="btn btn-warning">Delete</button></td>`;
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
function removeCareer(cid){
  alert(cid)
  $.ajax({
    url: 'https://development.ikf.in/emp-management/admin/API/deleteCareerApi.php',
    type: 'post',
    data: {'cid': cid},
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

$(document).ready(()=>{
  $("#bannerCategory").on("change",function(){
    var catid = $(this).find("option:selected").attr('id');
    $("#careerCatId").val(catid);       
  })
})
</script>
<?php include "./footer.php"; ?>