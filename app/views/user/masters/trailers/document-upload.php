<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<section class="form-a" style="max-width: 600px;margin:auto;">
  <div class="form-a-header">Upload <?php echo $data['document_name']; ?></div>
  <form method="POST" id="MyForm" onsubmit="return add_new()" enctype="multipart/form-data">               
    <div>
      <label>Expiry Date</label>
      <input type="text" data-date-picker="" name="expiry_date">
    </div>
    <div>
      <label>Select File</label>
      <input type="file" id="file" name="document" required="required">
    </div>
    <div>
      <label>Remarks</label>
      <textarea name="remarks" style="height: 100px"></textarea>
    </div>
    <div>
     <button type="submit" class="btn_full btn_green" onclick="check_file()">SAVE</button>
   </div>
 </form>
</section>


<script type="text/javascript">

  function check_file(){

    var property = document.getElementById('file').files[0];
      var image_name = property.name;
      var image_extension = image_name.split('.').pop().toLowerCase();

      if(jQuery.inArray(image_extension,['eml','gif','jpg','pdf','jpeg','png','']) == -1){
        alert("Invalid Document");
        $(`[name="document"]`).val('');
      }
  }



</script>

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
      form_data.append(`trailer_eid`,'<?php echo $data['trailer_eid']; ?>');
      form_data.append(`document_type_eid`,'<?php echo $data['document_eid']; ?>');
      form_data.append(`expiry_date`,$('[name="expiry_date"]').val());
      form_data.append(`remarks`,$('[name="remarks"]').val());
      console.log(form_data)
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
          if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         alert(data.message);
         if(data.status){
         //location.href='user/masters/trucks/documents?eid=<?php echo $data['trailer_eid']; ?>';
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