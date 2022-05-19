<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
?>
<br><br><br>
<br>
<section class="lg-form-outer">
  <div class="lg-form-header">Update Location of Trailer <?php echo $data['trailer-code']; ?></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-111" style="max-width: 700px"> 
      <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">    
      <div>
        <fieldset>
          <legend>Location Details</legend>

          <div style="display:flex;">
            <div class="field-section single-column"   style="width:100%">

              <div class="field-p">
                <label>Location</label>
                <input type="text" name="location" value="<?php echo $data['location'] ?>" required>
              </div>

              <div class="field-p">
                <label>Longitude</label>
                <input type="text" name="longitude" value="<?php echo $data['longitude'] ?>" required>
              </div>
                            <div class="field-p">
                <label>Latitude</label>
                <input type="text" name="latitude" value="<?php echo $data['latitude'] ?>" required>
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
      url:'../user/masters/trailers/locations/update-action',
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

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>