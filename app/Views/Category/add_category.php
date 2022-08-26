
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

<link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
<script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

</head>
<style>
#category_form {
    background-color: white;
    /* padding: 20px; */
}
</style>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <div class="row-6">

                                <h4 class="card-title">Add Form </h4>
                                <hr>
                                <?php $validation = \Config\Services::validation();?>
                                <form id="category_form" method="post" action="store_form" enctype="multipart/form-data"
                                    onsubmit="return false">
                                    <div class="form-group">
                                        <label for="username">Full Name <span class="text-danger"> * </span>
                                        </label> <span class="error_message_preview text-danger"> </span>
                                        <input type="text" id="username"
                                            class=" form-control <?php if ($validation->getError('username')): ?>is-invalid<?php endif?>"
                                            name="username" placeholder="Category Name"
                                            value="" />
                                        <div style="color: red;" id="usernameerror"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Email">Email <span class="text-danger"> * </span>
                                        </label> <span class="error_message_preview text-danger"> </span>
                                        <input type="text" id="Email"
                                            class=" form-control <?php if ($validation->getError('Email')): ?>is-invalid<?php endif?>"
                                            name="Email" placeholder="Category Name"
                                            value="" />
                                        <div style="color: red;" id="Emailerror"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Contact">Contact <span class="text-danger"> * </span>
                                        </label> <span class="error_message_preview text-danger"> </span>
                                        <input type="text" id="Contact"
                                            class=" form-control <?php if ($validation->getError('Contact')): ?>is-invalid<?php endif?>"
                                            name="Contact" placeholder="Category Name"
                                            value="" />
                                    </div>  
                            <div class=" col-md-3form-group">
                                        <label for="Gender">Gender <span class="text-danger"> * </span>
                                        </label> <span class="error_message_preview text-danger"> </span>
                                                    <select id="Gender" name="Gender" >	
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>		
                                            
                                            </select>	
                           

                                             <label for="Contact">Qualification <span class="text-danger"> * </span>
                                            </label> <span class="error_message_preview text-danger"> </span>

                                            <select id="languages" name="languages[]" multiple >						    
                                                <option value="10">10th</option>
                                                <option value="12">12th</option>		
                                                <option value="BCA">BCA</option>
                                                <option value="MCa">MCa</option>
                                                
                                            </select>	
                                                
                                            </div>

                                            </div>



                                        <div class="form-group col-6">
                                            <label for="Categoryimage">Category Image <span class="text-danger"> *
                                                </span> </label> <span class="error_message_preview text-danger">
                                            </span>
                                            <input type="file" accept="image/*" class="form-control" id="Categoryimage"
                                                 name="Categoryimage"><br>
                                        </div>
                                    

                                    <div class="form-group">
<label for="country">States</label>
<select class="form-control" name="state_id" id="state_id">
<option value="">Select States</option>
<?php

foreach($countries as $c){?>
<option id="state_id" value="<?php

    
    echo $c->id;?>"><?php echo $c->name;?></option>"
<?php }?>
</select>
</div>
                                    <div class="form-group">
<label for="state">Cities</label>
<select class="form-control" name="city_id" id="city_id">
</select>
</div>                        


                                  

                                    <button type="submit" class="btn btn-primary mb-2" id="button">Submit</button>
                                </form>

                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {       
	$('#languages').multiselect({		
		nonSelectedText: 'Select Qualification:'				
	});
    $('#Gender').multiselect({		
		nonSelectedText: 'Select Gender:'				
	});
});



var baseURL= "<?php echo base_url();?>";
$(document).ready(function(){
$('#state_id').change(function(){
var state_id = $(this).val();
$.ajax({
url:'getCities',
method: 'post',
data: {state_id: state_id},
dataType: 'json',
success: function(response){
$('#city_id').find('option').not(':first').remove();
$.each(response,function(index,data){
$('#city_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
});
}
});
});
});


$('form').on('submit', (function(e) {


e.preventDefault();

$(".error_message_preview").text("");

let category_name = $('#username').val();
let Email = $('#Email').val();
let Contact = $('#Contact').val();
let languages = $('#languages').val();
let Gender = $('#Gender').val();
let state_id = $('#state_id').val();
let city_id = $('#city_id').val();
let error_status = false;
if (category_name == ""){
    $("#username").parent().find(".error_message_preview").text("This category name field is required.");
    error_status = true;
}
if (languages == ""){
    $("#languages").parent().find(".error_message_preview").text("This languages  field is required.");
    error_status = true;
}
let image = $('#Categoryimage').val();
let imageurl = $('#category_image').attr('src');
if(image == "" && imageurl == ""){
    $("#Categoryimage").parent().find(".error_message_preview").text("This category image field is required.");
    error_status = true;
}

var formData = new FormData(this);

$.ajax({
    type: 'POST',
    url: "store_form",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function(data) {
        let result = JSON.parse(data);
        console.log(result);
        if (result.success == 1) {
            $.notify(result.message, {
                type: 'success',
                allow_dismiss: true,
              });
              window.location ='/projectt/public/show';

        } else {
            let error_message = result.validation_message;
            if (error_message != "") {
                $.each(error_message, function(key, val) {
                    $("#" + key).parent().find(".error_message_preview").text(val);
                });
            }
            if(result.message!=undefined && result.message!=null){
            $.notify(result.message, {
                type: 'danger',
                allow_dismiss: true,
              });
            }
        }
    },
    error: function(data) {
        console.log("error");
        console.log(data);
    }
});
}));









</script>

<script src="<?=base_url('public')?>/Js/category.js"></script>
