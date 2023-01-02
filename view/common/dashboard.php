<?php include "./header.php"; ?>
<div class="container">
  <div class="row justify-content-center">            
    <!-- member listing -->
    <ul class="row birthlisting"></ul> 
    <!-- profile  -->
    <ul class="row profileForm"></ul>
  </div>
</div>
<div class="container profileform">
  <a class="btn btn-success" href="bannerImges.php">Banner Images</a>
  <a class="btn btn-success" href="products.php">Products</a>
</div>


<script>
  //member listing
jQuery.ajax({ 
  url : "https://development.ikf.in/emp-management/admin/API/memberlistapi.php",  
  type : "GET",
  dataType: "JSON",
  success : function(resp){   
  var output = ""; 
    resp.forEach( (ele,index)=>{
      output += `<li class="col-lg-4">`;
      output += `<div class="card text-white bg-info " style="width: 18rem;">`;
      output += ` <img class="card-img-top" src="..." alt="Card image cap" />`;
      output += `<div class="card-body">`;
      output += `<h5 class="card-title">${ele['fname']} ${ele['lname']}</h5>`;
      output += `<span>${ele['id']}</span>`;
      output += `<span></span>`;
      output += `<span>${ele['birthd']}</span>`;
      output += `</div>`;  
      output += `</div>`;      
      output += `</li>`;     
    });
    jQuery(".birthlisting").html(output);
  }
});

// Profile Page
jQuery.ajax({ 
  url : "https://development.ikf.in/emp-management/admin/API/getSingleData.php?username=<?php echo $_SESSION['user_name'];?>",  
  type : "POST",
  dataType: "JSON",
  success : function(resprof){
    //console.log(resprof); 
    var proOut = "";
    resprof.forEach( (elemProf,index)=>{
      username = `${elemProf['user_name']}`;
      role_id = `${elemProf['role_id']}`;
      proOut += `<li>`;
      proOut += `<div>${elemProf['id']}</div>`;
      proOut += `<div>${elemProf['role_id']}</div>`;
      proOut += `<div>${elemProf['user_name']}</div>`;
      proOut += `<div>${elemProf['user_pass']}</div>`;
      proOut += `<button class="bg-warning updateProfile" onclick="getProfile('${username}', ${role_id})" >update</button>`;
      proOut += `</li>`;
    });
    jQuery(".profileForm").html(proOut);
  }
});

//Update Profile
function getProfile(username, role_id){
  jQuery.ajax({ 
  url : `https://development.ikf.in/emp-management/admin/API/updateProfile.php`,
  data: {'username': username,'role_id': role_id},
  type : "POST",
  dataType: "JSON",
  success : function(resprof){    
    var prfOutput = "";
    resprof.forEach( (profElem, index )=>{
      var up_user = `${profElem['user_name']}`;
      var up_user_pass = `${profElem['user_pass']}`;
      var role_id = `${profElem['role_id']}`;
      prfOutput += `<form>`;      
      prfOutput += `<div class="form-group">`;
      prfOutput +=`<input type="text" id="upUser" class="form-control" value="${profElem['user_name']}" placeholder="Name">`;
      prfOutput +=`</div>`;
      prfOutput += `<div class="form-group">`;
      prfOutput += `<input type="text" id="upPass" class="form-control" value="${profElem['user_pass']}"placeholder="Password" disabled="true">`;
      prfOutput +=`</div>`;      
      prfOutput += `<button type="button" id="updateProfileBtn" onclick="insertUpddatedProfile('${up_user}','${up_user_pass}');" class="btn btn-primary">Update</button>`;
      prfOutput += `</form>`;  
      prfOutput += `<span class='form_resp'></span>`    
    }) ; 
    jQuery(".profileform").html(prfOutput);
    } 
  })   
}

function insertUpddatedProfile(up_user,up_user_pass){
  var upuser = jQuery('#upUser').val();
  var uppass = jQuery('#upPass').val();
  jQuery.ajax({ 
  url : `https://development.ikf.in/emp-management/admin/API/updateProfileInsert.php`,
  data: {'up_user': up_user,'up_user_pass': up_user_pass,'upuser':upuser,'uppass':uppass,'role_id' : role_id},
  type : "POST",
  dataType: "JSON",
  success : function(resData){    
    //console.log(resData.status);
    var updateDataOutput = '';
    if(resData.status === 'error'){        
      updateDataOutput = `<span class="${resData.status}">${resData.msg}</span>`;                
    }
    if(resData.status === 'success'){                    
      updateDataOutput = `<span class="${resData.status}">${resData.msg}</span>`;       
    }        
    jQuery('.form_resp').html(updateDataOutput);
    } 
  })  

}

</script>
<?php include "./footer.php"; ?>