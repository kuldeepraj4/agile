<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
?>
<br><br><br>
<br>
<section class="lg-form-outer">
  <div class="lg-form-header">Update Driver Started At Datetime</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-111" style="max-width: 600px"> 
      <input type="hidden" name="lha_eid" value="<?php echo $_GET['eid']; ?>">    
      <div>
        <fieldset>
          <legend>Basic Info</legend>

          <div style="display:flex;">
            <div class="field-section single-column"   style="width:100%">

              <div class="field-p">
                <label>Started at datetime</label>
                <input type="text" name="started_at_date" data-date-picker value="<?php echo $data['driver_start_date'] ?>" placeholder="mm/dd/yyyy">
                <input type="text" name="started_at_time" style="width: 100px;" placeholder="00:00" value="<?php echo $data['driver_start_time'] ?>" data-time-picker value="">
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
      url:'../user/dispatch/lh-assignment/update-driver-started-at-datetime-action',
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