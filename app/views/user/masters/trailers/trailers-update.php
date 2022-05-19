<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details'];
?>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">UPDATE TRAILER</div>
  <section class="lg-form" style="text-align:right;">
    <?php
  if (in_array('P0024', USER_PRIV)) {
  ?>
    <button class='btn_blue' onclick="location.href='../user/masters/trailers/details?eid=<?php echo $_GET['eid']; ?>'">View Trailer</button>
  <?php
  }
  ?>
  </section>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">
    <input type="hidden" name="code1" value="<?php echo $details['code'] ?>">
    <section class="section-111">

      <div></div>
      <div>
        <fieldset>
          <legend>Status</legend>
          <div class="field-section">
            <div class="field-section"><input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
              <div class="field-p">
                <label>Status</label>
                <select name="status_id" required="required"></select>
              </div>
            </div>                  
          </fieldset>
        </div>
        <div></div>
      </section>
      <section class="section-111">
        <div>
          <fieldset>
            <legend>Basic Details</legend>
            <div class="field-section">
              <div class="field-p">
                <label>Trailer ID</label>
                <input type="text" name="code" pattern="[a-zA-Z0-9]{3,}" required="required" value="<?php echo $details['code']; ?>" required="required">
              </div>
              <div class="field-p">
                <label>Company Name</label>
                <select name="company_id" required="required" required="required"></select>
              </div>
              <div class="field-p">
                <label>Make Year</label>
                <input type="text" name="make_year" required="required" value="<?php echo $details['make_year']; ?>" required="required">
              </div>
              <div class="field-p">
                <label>Make Company</label>
                <select name="maker_id" required="required" onchange="show_model_options({maker_id:this.value})" required="required"></select>
              </div>
              <div class="field-p">
                <label>Model</label>
                <select name="model_id" required="required" required="required" ></select>
              </div>

              <div class="field-p">
                <label>Body Type</label>
                <select name="body_type" required="required">
                  <option value=""> - - Select - -</option>
                  <option value="REEFER">Reefer</option>
                  <option value="VAN">Van</option>
                </select>
              </div>

              <div class="field-p">
                <label>Reefer Type</label>
                <select name="reefer_company_id" required="required">
                </select>
              </div>


              <div class="field-p">
                <label>VIN</label>
                <input type="text" name="vin_number" value="<?php echo $details['vin']; ?>" required="required">
              </div>
              <div class="field-p">
                <label>Licence tag no.</label>
                <input type="text" name="licence_tag_no" value="<?php echo $details['licence_tag_no']; ?>" required="required">
              </div>
              <div class="field-p">
                <label>Licence tag Expiry</label>
                <input type="text" data-date-picker="" name="licence_tag_expiry" value="<?php echo $details['licence_tag_expiry_date']; ?>">
              </div> 
              <div class="field-p">
                <label>State</label>
                <select name="licence_state_id" required="required"></select>
              </div>        
            </div>                  
          </fieldset>
        </div>
        <div>
          <fieldset>
            <legend>Insurance details</legend>
            <div class="field-section">
              <div class="field-p">
                <label>Insurance status</label>
                <select name="insurance_status">
                  <option value=""> - - select - -</option>
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>
              <div class="field-p">
                <label>Insurance carrier</label>
                <select name="insurance_company_id"  id="city_id"></select>
              </div>        
              <div class="field-p">
                <label>Insurance start date</label>
                <input type="text" name="insurance_start_date" data-date-picker="" class="datepicker" value="<?php echo $details['insurance_start_date']; ?>" data-start-from data-filter="insurance_start_date">
              </div>
              <div class="field-p">
                <label>Insurance Expiry date</label>
                <input type="text" class="datepicker" data-date-picker="" name="insurance_expiry_date" value="<?php echo $details['insurance_expiry_date']; ?>" data-start-to data-filter="insurance_expiry_date">
              </div>
              <div class="field-p">
                <label>P/D value</label>
                <input type="text" name="pd_value" value="<?php echo $details['pd_value']; ?>">
              </div>
              <div class="field-p">
                <label>Loss pay info</label>
                <input type="text" name="loss_pay_info" value="<?php echo $details['loss_pay_info']; ?>">
              </div>        
              <div class="field-p">
                <label>P/D value new</label>
                <input type="text" name="new_pd_value" value="<?php echo $details['new_pd_value']; ?>">
              </div>
              
            </div>                  
          </fieldset>


        </div>


        <div>
          <fieldset>
            <legend>---</legend>
            <div class="field-section">        
              <div class="field-p">
                <label>Device type</label>
                <select name="device_company_id"></select>
              </div>
              <div class="field-p">
                <label>Device Sr. no.</label>
                <input type="text" name="device_serial_no" value="<?php echo $details['device_serial_no']; ?>">
              </div>
              
            </div>                  
          </fieldset>

          <fieldset>
            <legend>Lease details</legend>
            <div class="field-section">
              <div class="field-p">
                <label>Ownership Type</label>
                <select name="ownership_type_id" required="required"></select>
              </div>        
              <div class="field-p">
                <label>Lease Ref no</label>
                <input type="text" name="lease_ref_no" value="<?php echo $details['lease_ref_no']; ?>">
              </div>                               
              <div class="field-p">
                <label>Leasing company</label>
                <select name="lease_company_id"></select>
              </div>        
              <div class="field-p">
                <label>Leasing expiry</label>
                <input type="text" data-date-picker="" name="lease_expiry_date" value="<?php echo $details['lease_expiry_date']; ?>">
              </div>                               
            </div>                  
          </fieldset>

          <fieldset>
            <legend>IOT Devices</legend>
            <div class="field-section single-column">
              <div class="field-p">
                <label>Engine Hours Update Type</label>
                <select name="engine_hours_update_type" required="required">
                  <option value=""> - - Select - - </option>
                  <option value="AUTO">Auto</option>
                  <option value="MANUAL">Manual</option>
                </select>
              </div>                                      
            </div>                  
          </fieldset>
        </div>
    
    </section>
    <section class="lg-form-action-button-box">
      <button type="submit" class="btn_green">SAVE</button>
       <?php
       
       if($_GET['page']=='verify'){
     
      ?>
        <button type='submit' id='button' data-submit class='btn_green' onclick='set_pref("VERIFIED")' style="margin-left: 10px;">SAVE AS VERIFIED</button>
      <?php
      }
    

      ?>
      <div style="text-align:center;"><button type="button" class="btn_green" onclick="back_alert()">BACK</button></div>
    </section>
  </form>
    </div>
</section>




<!--  check insurance_start Issue Date -->
<script>
   $(document).ready(function(){
    var body_type = '<?php echo $details['body_type']; ?>';
    if ($('[name="body_type"]').val() != 'REEFER') {
        $("[name='reefer_company_id']").attr('disabled',true).val('0');
    } else {
        $("[name='reefer_company_id']").attr('disabled',false).prop('selectedIndex', 0);;
    }
  });

  $(document.body).on('change', '[data-start-from]', function() {
    var g1 = new Date(check_url_params('insurance_start_date'))
    var g2 = new Date(check_url_params('insurance_expiry_date'))
    if (g1.getTime() > g2.getTime()) {
      alert("Insurance Start Date should be less than Insurance Expiry Date")
      $("[data-filter='insurance_start_date']").val("").focus();
    }

  });

  $(document.body).on('change', '[data-start-to]', function() {
    var g1 = new Date(check_url_params('insurance_start_date'))
    var g2 = new Date(check_url_params('insurance_expiry_date'))
    if (g1.getTime() > g2.getTime()) {
      alert("Insurance Expiry Date should be greater than Insurance Start Date")
      $("[data-filter='insurance_expiry_date']").val("").focus();
     
    }
  });



  $(document.body).on('change', '[name="maker_id"]', function() {
    
       if($('[name="maker_id"]').val() != ""){
          $("[name='model_id']").attr('disabled',false).prop('selectedIndex', 0);
      }else{
         $("[name='model_id']").attr('disabled',true).prop('selectedIndex', 0);
      }

  });

  $(document.body).on('change', '[name="body_type"]', function() {
    
    if ($('[name="body_type"]').val() != 'REEFER') {
      $("[name='reefer_company_id']").attr('disabled',true).val('0');
     
    }else{
         $("[name='reefer_company_id']").attr('disabled',false).prop('selectedIndex', 0);;
    }

  });

  
</script>

<script type='text/javascript'>
  function back_alert() {
    if (confirm('Are you Sure ?')) {
      window.history.back();
    }
  }
</script>


<script type="text/javascript">

  var is_verified = 'NO';

  function set_pref(val) {
    is_verified = (val == 'VERIFIED') ? 'YES' : 'NO';
    $('[data-submit]').trigger('click');
  }


  function add_new(){
    submit_to_wait_btn('#submit','loading')
    $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    var formData=new FormData(currentForm);
    if(isValidForm){
      var arr=$('#MyForm').serializeArray();
      var obj={
      is_verified:is_verified
    }
      for(var a=0;a<arr.length;a++ ){
        obj[arr[a].name]=arr[a].value
      }
      $.ajax({
        url:window.location.pathname+'-action',
        type:'POST',
        data: obj,
        success:function(data){
         if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         alert(data.message);
         if(data.status){
          location.href="user/masters/trailers"
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
  function show_truck_status_filter(){
   get_vehicles_status().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="status_id"]').html(options);
      $('[name="status_id"] option[value="<?php echo $details['status_id']; ?>"]').prop('selected',true);      
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_truck_status_filter()
</script>

<script type="text/javascript">
  function show_reefer_type_filter(){
   get_reefer_companies().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="reefer_company_id"]').html(options);
      $('[name="reefer_company_id"] option[value="<?php echo $details['reefer_company_id']; ?>"]').prop('selected',true);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_reefer_type_filter()
</script>












<script type="text/javascript">
  function show_companies_options(){
   get_companies().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="company_id"]').html(options);
      $('[name="company_id"] option[value="<?php echo $details['company_id']; ?>"]').prop('selected',true);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_companies_options()
</script>

<script type="text/javascript">
  function show_maker_options(){
   get_vehicle_makers().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        if(item.makes[0].id == 'TRAILER'){
        options+=`<option value="`+item.id+`">`+item.name+`</option>`; 
        }              
      })
      $('[name="maker_id"]').html(options);
      $('[name="maker_id"] option[value="<?php echo $details['maker_id']; ?>"]').prop('selected',true);
      show_model_options({maker_id:'<?php echo $details['maker_id']; ?>'})

    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_maker_options()
</script>


<script type="text/javascript">
  function show_model_options(param){
   get_vehicle_models(param).then(function(data) {
  // Run this when your request was successful
  $('[name="model_id"]').html(`<option value="">- - Select - -</option>`); 
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="model_id"]').html(options);
      $('[name="model_id"] option[value="<?php echo $details['model_id']; ?>"]').prop('selected',true);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
</script>


<script type="text/javascript">
  function show_states_options(param){
   get_states(param).then(function(data) {
  // Run this when your request was successful
  console.log(data)
  $('[name="licence_state_id"]').html(`<option value="">- - Select - -</option>`); 
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="licence_state_id"]').html(options);
      $('[name="licence_state_id"] option[value="<?php echo $details['licence_state_id']; ?>"]').prop('selected',true);      
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_states_options()
</script>


<script type="text/javascript">
  function show_device_company_options(param){
   get_device_companies(param).then(function(data) {
  // Run this when your request was successful
  console.log(data)
  $('[name="device_company_id"]').html(`<option value="">- - Select - -</option>`); 
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="device_company_id"]').html(options);
      $('[name="device_company_id"] option[value="<?php echo $details['device_company_id']; ?>"]').prop('selected',true);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_device_company_options()
</script>



<script type="text/javascript">
  function show_insurance_company_options(param){
   get_insurance_companies(param).then(function(data) {
  // Run this when your request was successful
  console.log(data)
  $('[name="insurance_company_id"]').html(`<option value="">- - Select - -</option>`); 
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="insurance_company_id"]').html(options);     
      $('[name="insurance_company_id"] option[value="<?php echo $details['insurance_company_id']; ?>"]').prop('selected',true);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_insurance_company_options()
</script>



<script type="text/javascript">
  function show_ownership_type_options(param){
   get_vehicles_ownership_types(param).then(function(data) {
  // Run this when your request was successful
  $('[name="ownership_type_id"]').html(`<option value="">- - Select - -</option>`); 
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="ownership_type_id"]').html(options);
      $('[name="ownership_type_id"] option[value="<?php echo $details['ownership_type_id']; ?>"]').prop('selected',true);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_ownership_type_options()
</script>


<script type="text/javascript">
  function show_lease_companies_options(param){
   get_lease_companies(param).then(function(data) {
  // Run this when your request was successful
  $('[name="lease_company_id"]').html(`<option value="">- - Select - -</option>`); 
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="lease_company_id"]').html(options);
      $('[name="lease_company_id"] option[value="<?php echo $details['lease_company_id']; ?>"]').prop('selected',true);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_lease_companies_options()
</script>


<script type="text/javascript">
  $('[name="body_type"] option[value="<?php echo $details['body_type']; ?>"]').prop('selected',true);
  $('[name="insurance_status"] option[value="<?php echo $details['insurance_status']; ?>"]').prop('selected',true);
  $('[name="engine_hours_update_type"] option[value="<?php echo $details['engine_hours_update_type']; ?>"]').prop('selected',true);
</script>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>