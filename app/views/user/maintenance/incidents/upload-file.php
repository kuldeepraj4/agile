<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
?>
<br><br>
<section class="form-a" style="max-width: 600px;margin:auto;">
  <div class="form-a-header">Upload File</div>
  <form method="POST" id="MyForm" onsubmit="return add_new()" enctype="multipart/form-data">               
    <div>
      <label>Name</label>
      <input type="text" name="name">
    </div>
    <div>
      <label>Select File</label>
      <input type="file" id="file" name="file" required="required">
    </div>
    <div>
     <button type="submit" class="btn_full btn_green">SAVE</button>
   </div>
 </form>
</section>


<script type="text/javascript">
  function add_new(){
   show_processing_modal();
    $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    var formData=new FormData(currentForm);
    if(isValidForm){
      var arr=$('#MyForm').serializeArray();
      var obj={}
      for(var a=0;a<arr.length;a++ ){
        obj[arr[a].name]=arr[a].value
      }


      var property = document.getElementById('file').files[0];
      var image_name = property.name;
      var image_extension = image_name.split('.').pop().toLowerCase();

      if(jQuery.inArray(image_extension,['eml','gif','jpg','pdf','jpeg','png','']) == -1){
        alert("Invalid image file");
      }

      var form_data = new FormData();
      form_data.append(`document`,property);
      form_data.append(`driver_eid`,'<?php echo $data['driver_eid']; ?>');
      form_data.append(`document_type_eid`,'<?php echo $data['document_eid']; ?>');
      form_data.append(`expiry_date`,$('[name="expiry_date"]').val());
      form_data.append(`remarks`,$('[name="remarks"]').val());
      $.ajax({
        url:window.location.pathname+'-action',
        method:'POST',
        data:form_data,
        contentType:false,
        cache:false,
        processData:false,
        beforeSend:function(){
          $('#msg').html('Loading......');
        },
        success:function(data){
            console.log(data)
          if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         alert(data.message);
         if(data.status){
          wait_to_submit_btn('#submit','SAVE')
        }else{
          wait_to_submit_btn('#submit','SAVE')
        }
        hide_processing_modal()
        }
      });

    }
    return false
  }


</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>