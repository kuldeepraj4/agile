<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
?>

<br><br> 

<br><br>
<section class="form-a" style="max-width: 600px;margin:auto;">
  <div class="form-a-header">Upload Document - Incident</div>
  <form method="POST" id="MyForm" onsubmit="return add_new()" enctype="multipart/form-data">
    <div>
      <label>Select File</label>
      <input type="file" id="file" name="file" required="required">
    </div>
        <div>
      <label>Remarks</label>
      <textarea name="remarks" style="height: 100px" required></textarea>
    </div>
    <div>
     <button type="submit" class="btn_full btn_green">SAVE</button>
   </div>
 </form>
</section>

<input name="doc_id" type="text" value="" disabled hidden>   
<script type="text/javascript">
    var url_params = get_params();
    if (url_params.hasOwnProperty('doc_id')) {
    $('[name="doc_id"]').val(url_params.doc_id);
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

      if(jQuery.inArray(image_extension,['eml','gif','jpg','pdf','jpeg','png','','doc','docx','flv','mpeg4','mp4','avi','mov','ppt','pptx','xls','xlsx']) == -1){
        alert("Invalid image, video or document file");
        return;
      }

      var form_data = new FormData();
      form_data.append(`document`,property);
    form_data.append(`incident_eid`,'<?php echo $data['eid']; ?>');
    form_data.append(`doc_id`,$('[name="doc_id"]').val());
    form_data.append(`remarks`,$('[name="remarks"]').val());
      $.ajax({
        url:'../user/maintenance/incidents/upload-document-action',
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