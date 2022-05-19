<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
$details=$data['details'];
?>
<br><br><br>
<br>
<section class="lg-form-outer">
  <div class="lg-form-header">Update Driver Team</div>
 
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-111" style="max-width: 500px"> 
      <input type="hidden" name="update_eid" value="<?php echo $details['eid']; ?>">    
      <div>
        <fieldset>
          <legend></legend>

          <div style="display:flex;">
            <div class="field-section single-column"   style="width:100%">

              <div class="field-p">
                <label>Driver</label>
                 <p style="text-align:center;"><?php echo (isset($_GET['driver-name']))?$_GET['driver-name']:''; ?></p>
              </div>

              <div class="field-p">
                <label>Team</label>
                <select data-default-select="<?php echo $details['team_id'] ?>" name="team_id"></select>
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
      var obj={
       update_eid:$('[name="update_eid"]').val(),
       team_id:$('[name="team_id"]').val()
     }
     $.ajax({
      url:'../user/masters/drivers/update-driver-team-action',
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
<script type="text/javascript">
  quick_list_driver_teams().then(function(data) {
  // Run this when your request was successful

  if(data.status){



    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option value="${item.id}">${item.name}</option>`;               

      })

      $('[name="team_id"]').html(options);
      select_default('[name="team_id"]')     

    }

  }

})
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>