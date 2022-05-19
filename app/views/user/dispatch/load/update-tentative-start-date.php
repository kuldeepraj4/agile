<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
$data=$_GET;
$default_date=(isset($data['tentative-start-date']) && $data['tentative-start-date']!='')?date('m/d/Y',strtotime($data['tentative-start-date'])):'';
?>
<br><br><br>
<br>
<section class="lg-form-outer">
  <div class="lg-form-header">Update Tentative Start Date of Load <?php echo (isset($data['id']))?$data['id']:''; ?></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-111" style="max-width: 700px"> 
      <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">    
      <div>
        <fieldset>
          <legend>Tentative Start Date Info</legend>

          <div style="display:flex;">
            <div class="field-section single-column"   style="width:100%">
              <div class="field-p">
                <label>Tentative Start Date</label>
                <input type="text" name="tentative_start_date" data-date-picker value="<?php echo $default_date; ?>">
              </div>

            </div>            
          </div>                
        </fieldset>
      </div>
    </section>
    <section class="action-button-box">
      <button type="submit" class="btn_green">SAVE</button>
    </section>
  </form>
</section>

<script type="text/javascript">
  function save(){

    submit_to_wait_btn('#submit','loading')
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
     $.ajax({
      url:'../user/dispatch/loads/update-tentative-start-date-action',
      type:'POST',
      data: obj,
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data) 
       }
       alert(data.message);
       if(data.status){
         window.opener.show_list()
         window.close()
        wait_to_submit_btn('#submit','SAVE')
      }else{
        wait_to_submit_btn('#submit','SAVE')
      }
    }
  })
   }
   return false
 }
</script>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>