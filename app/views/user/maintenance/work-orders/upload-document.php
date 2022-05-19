<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
?>
<br><br>
<section class="form-a" style="max-width: 600px;margin:auto;">
  <div class="form-a-header">Upload Document</div>
  <form method="POST" id="MyForm" onsubmit="return add_new()" enctype="multipart/form-data">
    <div>
      <label>Select File</label>
      <input type="file" id="file" name="file" required="required">
    </div>
        <div>
      <label>Remarks</label>
      <textarea name="remarks" style="height: 100px"></textarea>
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
    form_data.append(`work_order_eid`,'<?php echo $data['eid']; ?>');
    form_data.append(`remarks`,$('[name="remarks"]').val());
      $.ajax({
        url:'../user/maintenance/work-orders/upload-document-action',
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
            window.opener.show_documents()
             window.close();
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