    <style> 
   .error-msg{
       color:red;
   }
   .downloadForm_wrap {
    position: relative;
    z-index: 1;
}

.downloadForm_wrap .container {
    background: #fff;
    max-width: 750px;
}

.downloadForm_wrap .container form#downloadForm {
    padding: 25px 15px 20px;
}

.downloadForm_wrap .container form#downloadForm .form-group {
    display: flex;
}

.downloadForm_wrap .container form#downloadForm .form-group .form_email_1 {
    width: 87%;
}

.downloadForm_wrap .container form#downloadForm .form-group .form_email_2 {
    width: 150px;
    padding-left: 20px;
}

.downloadForm_wrap .container form#downloadForm .form-group .form_email_2 button#formSubmit-pop {
    background: #3d93d6;
    font-family: 'Poppins', sans-serif;
    width: 100%;
    border: 0;
    border-radius: 0;
    font-size: 16px;
    padding: 10px 15px 8px;
    text-transform: uppercase;
    height: 50px;
    line-height: 30px;
}

.downloadForm_wrap .container form#downloadForm .form-group .form_email_1 input#email {
    background: #e7f4fb;
    font-family: 'Poppins', sans-serif;
    width: 100%;
    border: 0;
    border-radius: 0;
    font-size: 16px;
    height: 50px;
    line-height: 50px;
    padding: 10px 20px;
    box-shadow: 0 0 0 transparent;
}

.downloadForm_wrap .container form#downloadForm .email-wrap label.email {
    font-size: 18px;
    color: #464646;
    margin: 3px 0 12px;
}
.downloadForm_wrap .container.downloadLinkcontainer {
    text-align: left;
    padding: 0 30px 20px;
    box-shadow: 0px 10px 10px #8d8d8d2e;
}

.downloadForm_wrap .container.downloadLinkcontainer div#downloadLink a {
    color: #5091d5;
    font-weight: 300;
    font-size: 20px;
}

.downloadForm_wrap .container.downloadLinkcontainer div#ErrorNotFound {
    color: red;
}
.downloadForm_wrap .container.downloadLinkcontainer div#downloadLink a img {
    position: relative;
    top: -2px;
    margin: 0 5px 0 0;
}
   </style>
<div class="downloadForm_wrap">
  <div class="container">
    <form action="" method="post" id="downloadForm">
      <div class="email-wrap">
        <label class="email" for="exampleInputEmail1">Email address</label>
      </div>
      <div class="form-group">
        <div class="form_email_1">
          <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">       
          <span  class="form-text error-msg" id="emailError-service"></span>        
        </div>
        <div class="form_email_2">
          <button type="submit" class="btn btn-primary" id="formSubmit-pop">Search</button>
        </div>
      </div>      
    </form>
  </div>
  <div class="container downloadLinkcontainer">
    <div class="row">
      <div class="col-md-12">
        <div id="downloadLink" style="display: none;"><a href="" download><img src="https://ikfstage.metasyssoftware.com/wp-content/uploads/2022/12/down-arrow.png"> Download Link</a></div>
        <div id="ErrorNotFound" class="text-center" style="display: none;">Not Found!!</div>
      </div>
    </div>
  </div>
</div>
<script>  
//enq service form
jQuery(document).ready(function(){ 
  jQuery('#downloadForm').on('submit',function(event){  
  var email = jQuery('#email').val();
  // Email validation 
  var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (!email.match(email_regex) || email.length == 0) {    
    jQuery('#emailError-service').html("<span id='mailErr-service' >Please enter a valid email address.</span>"); // This Segment Displays The Validation Rule For Email
    jQuery("#email").focus();
    return false;
  }else{
     jQuery("#mailErr-service").fadeOut();
  }  
  
  });
});

jQuery(function () {
        jQuery('#downloadForm').on('submit', function (e) {          
          e.preventDefault();
          jQuery.ajax({
          type: 'POST',
            url: 'https://ikfstage.metasyssoftware.com/downloadProcess.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,            
            beforeSend: function() {                            
              jQuery("#formSubmit-pop").attr('disabled',true)
            },
            complete: function() {
              jQuery("#formSubmit-pop").attr('disabled',false)               
            },                      
            success: function (data,status) {               
              if(data.found === 1 ){                
                jQuery("#ErrorNotFound").hide();
                jQuery("#downloadLink a").attr('href',data.url);
                jQuery("#downloadLink").show();
              }else{                
                jQuery("#ErrorNotFound").show();
                jQuery("#downloadLink a").attr('href',"");
                jQuery("#downloadLink").hide();
              }                                               
            }            
          });
        });
      });
</script>
 

