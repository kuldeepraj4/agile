<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
$details=$data['details'];
if($details['is_auto_booked']=="YES"){
  $is_auto_booked_status='checked';
  $booked_by_default="";
  $booked_by_status="disabled";
}else{
  $is_auto_booked_status='';
  $booked_by_default=$details['booked_by_user_id'];
  $booked_by_status="";
}
?>
<br><br><br>
<br>
<section class="lg-form-outer">
  <div class="lg-form-header">Update Booking Info of Load <?php echo $details['id']; ?></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-111" style="max-width: 700px"> 
      <input type="hidden" name="update_eid" value="<?php echo $details['eid']; ?>">    
      <div>
        <fieldset>
          <legend>Operation Info</legend>

          <div style="display:flex;">
            <div class="field-section single-column"   style="width:100%">

              <div class="field-p">
                <label>Booked by user</label>
                              <div>
                <select name="booked_by_id" data-default-select="<?php echo $booked_by_default ?>" <?php echo $booked_by_status   ?>></select>
                <input type="checkbox" name="is_auto_booked" <?php echo  $is_auto_booked_status ?>> Auto Booked
              </div>
              </div>

              <div class="field-p">
                <label>Received on datetime</label>
                <input type="text" name="received_on_date" data-date-picker value="<?php echo $details['received_on_date']; ?>">
                <input type="text" name="received_on_time" style="width: 100px;" data-time-picker value="<?php echo $details['received_on_time']; ?>">
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
       booked_by_id:$('[name="booked_by_id"]').val(),
       is_auto_booked: ($('[name="is_auto_booked"]').prop("checked") == true) ? 'YES' : 'NO',
       received_on_date:$('[name="received_on_date"]').val(),
       received_on_time:$('[name="received_on_time"]').val(),
     }
     $.ajax({
      url:'../user/dispatch/loads/booking-info-update-action',
      type:'POST',
      data: obj,
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data) 
       }
       alert(data.message);
       if(data.status){
         window.opener.show_group_list()
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
  quick_list_users().then(function(data) {
  // Run this when your request was successful

  if(data.status){



    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option value="${item.id}">${item.name}</option>`;               

      })

      $('[name="booked_by_id"]').html(options);
      select_default('[name="booked_by_id"]')     

    }

  }

})
</script>
<script type="text/javascript">
  //-------- add/remove required attribute based on TBD check box 

  $(document.body).on('change', '[name="is_auto_booked"]', function() {

    if ($(this).prop("checked") == true) {
      $('[name="booked_by_id"]').prop('disabled', true)
      $('[name="booked_by_id"]').prop('selectedIndex', 0);

    } else {
      $('[name="booked_by_id"]').prop('disabled', false)
    }

  });

  //--------/ add/remove required attribute based on TBD check box 
</script>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>