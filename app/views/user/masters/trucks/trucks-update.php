<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details'];
?>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">UPDATE TRUCK</div>
  <section class="lg-form" style="text-align:right;">
    <?php
  if (in_array('P0015', USER_PRIV)) {
  ?>
    <button class='btn_blue' onclick="location.href='../user/masters/trucks/details?eid=<?php echo $_GET['eid']; ?>'">View Truck</button>
  <?php
  }
  ?>
  </section>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return update()">
    <input type="hidden" name="code1" value="<?php echo $details['code'] ?>">
    <section class="section-111">

      <div></div>
      <div>
        <fieldset>
          <legend>Status</legend>
          <div class="field-section single-column">
            <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
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
          <div class="field-section single-column">
            <div class="field-p">
              <label>Truck ID</label>
              <input type="text" name="code" pattern="[a-zA-Z0-9]{3,}" required="required" value="<?php echo $details['code']; ?>">
            </div>
            <div class="field-p">
              <label>Equipment group</label>
              <select name="group">
                <option value=""> - - Select - - </option>
                <option value="Short Haul">Short Haul</option>
                <option value="Long Haul">Long Haul</option>
              </select>
            </div>
            <div class="field-p">
              <label>Company Name</label>
              <select name="company_id" required="required"></select>
            </div>
            <div class="field-p">
              <label>Make Year</label>
              <input type="text" name="make_year" required="required" value="<?php echo $details['make_year']; ?>">
            </div>
            <div class="field-p">
              <label>Make Company</label>
              <select name="maker_id" required="required" onchange="show_model_options({maker_id:this.value})"></select>
            </div>
            <div class="field-p">
              <label>Model</label>
              <select name="model_id"></select>
            </div>
            <div class="field-p">
              <label>Color</label>
              <select name="color_id"></select>
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
              <input type="text" data-date-picker="" value="<?php echo $details['licence_tag_expiry_date']; ?>" required="required" name="licence_tag_expiry_date">
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
          <div class="field-section single-column">
            <div class="field-p">
              <label>Insurance status</label>
              <select name="insurance_status">
                <option value=""> - - Select - -</option>
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
              <input type="text" name="insurance_start_date" data-date-picker="" class="datepicker" data-start-from data-filter="insurance_start_date" value="<?php echo $details['insurance_start_date']; ?>">
            </div>
            <div class="field-p">
              <label>Insurance expiry date</label>
              <input type="text" class="datepicker" data-date-picker="" name="insurance_expiry_date"  data-start-to data-filter="insurance_expiry_date" value="<?php echo $details['insurance_expiry_date']; ?>">
            </div>        
            <div class="field-p">
              <label>Liability</label>
              <select name="liability_status">
                <option value="">- - Select - -</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="field-p">
              <label>Cargo</label>
              <select name="cargo_status">
                <option value="">- - Select - -</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
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
          <legend>Permits</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>FHVUT</label>
              <select name="fhvut_status">
                <option value=""> - - Select - - </option>
                <option value="Paid">Paid</option>
                <option value="Unpaid">Un-paid</option>
              </select>
            </div>        
            <div class="field-p">
              <label>Paid date</label>
              <input type="text" data-date-picker="" name="fhvut_paid_date" value="<?php echo $details['fhvut_paid_date']; ?>">
            </div>
            <div class="field-p">
              <label>Oregon permit issue</label>
              <select name="oregon_permit_status">
                <option value="">- - Select - -</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="field-p">
              <label>Family engine no.</label>
              <input type="text" name="family_engine_number" value="<?php echo $details['family_engine_number']; ?>">
            </div>        
            <div class="field-p">
              <label>IFTA</label>
              <select name="ifta_status">
                <option value="">- - Select - -</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="field-p">
              <label>PIFTA</label>
              <select name="pifta_status">
                <option value="">- - Select - -</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="field-p">
              <label>NM permit</label>
              <select name="nm_status">
                <option value="">- - Select - -</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>        

            <div class="field-p">
              <label>Pre pass</label>
              <input type="text" name="pre_pass" value="<?php echo $details['pre_pass']; ?>">
            </div>        
            <div class="field-p">
              <label>Pre pass remark</label>
              <input type="text" name="pre_pass_remark" value="<?php echo $details['pre_pass_remark']; ?>">
            </div>
            <div class="field-p">
              <label>HUT</label>
              <input type="text" name="hut" value="<?php echo $details['hut']; ?>">
            </div>
            <div class="field-p">
              <label>HUT remarks</label>
              <input type="text" name="hut_remark" value="<?php echo $details['hut_remark']; ?>">
            </div>                                
          </div>                  
        </fieldset>
      </div>

    </section>
    <section class="section-111">
      <div>
        <fieldset>
          <legend>Lease details</legend>
          <div class="field-section single-column">
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
              <select name="lease_company_id" id="city_id"></select>
            </div>        
            <div class="field-p">
              <label>Leasing expiry</label>
              <input type="text" data-date-picker="" name="lease_expiry_date" value="<?php echo $details['lease_expiry_date']; ?>">
            </div>                               
          </div>                  
        </fieldset>
      </div>


      <div>
        <fieldset>
          <legend>---</legend>
          <div class="field-section single-column">
              <div class="field-p">
        <label>Truck type</label>
          <select name="truck_type" required data-default-select="<?php echo $details['truck_type']; ?>">
          <option>- -Select- -</option>  
          <option value="Normal">Normal</option>
          <option value="Box">Box</option>
       </select>
      </div>        
            <div class="field-p">
              <label>Device type</label>
              <select name="device_company_id"></select>
            </div>
            <div class="field-p">
              <label>Gateway serial no.</label>
              <input type="text" name="device_serial_no" value="<?php echo $details['device_serial_no']; ?>">
            </div>       
            <div class="field-p">
              <label>Dash cam no</label>
              <input type="text" name="device_dash_cam_no" value="<?php echo $details['device_dash_cam_no']; ?>">
            </div>
            <div class="field-p">
              <label>Halo no.</label>
              <input type="text" name="halo" value="<?php echo $details['halo']; ?>">
            </div>                                
          </div>                  
        </fieldset>
      </div>
      <div>
  <fieldset>
    <legend>IOT Devices</legend>
    <div class="field-section  single-column">
      <div class="field-p">
        <label>Odometer Update Type</label>
        <select name="odometer_update_type" required="required">
          <option value=""> - - Select - - </option>
          <option value="AUTO">Auto</option>
          <option value="MANUAL">Manual</option>
        </select>
      </div>
       <div class="field-p">
        <label>Engine Hours Update Type</label>
        <select name="engine_hours_update_type">
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
       <button type="button" class="btn_green" onclick="back_alert()" style="margin-left: 10px;">BACK</button>
    </section>
  </form>
</section>

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




  function update(){
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
          console.log(data)
          if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         alert(data.message);
         if(data.status){
          location.href="user/masters/trucks"
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



<!--  check CDL Issue Date -->
<script>
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
          if(item.makes.length == 2 && item.makes[1].id == 'TRUCK'){
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;
          }
          else if(item.makes.length == 1 && item.makes[0].id == 'TRUCK')
          options+=`<option value="`+item.id+`">`+item.name+`</option>`;
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
  function show_color_options(param){
   get_vehicles_colors(param).then(function(data) {
  // Run this when your request was successful
  $('[name="color_id"]').html(`<option value="">- - Select - -</option>`); 
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="color_id"]').html(options);
      $('[name="color_id"] option[value="<?php echo $details['color_id']; ?>"]').prop('selected',true);      
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_color_options()
</script>

<script type="text/javascript">
  function show_states_options(param){
   get_states(param).then(function(data) {
  // Run this when your request was successful
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

  ///--auto selection of miscellaneous <select> tags
  $('[name="group"] option[value="<?php echo $details['group']; ?>"]').prop('selected',true);
  $('[name="insurance_status"] option[value="<?php echo $details['insurance_status']; ?>"]').prop('selected',true);
  $('[name="liability_status"] option[value="<?php echo $details['liability_status']; ?>"]').prop('selected',true);
  $('[name="cargo_status"] option[value="<?php echo $details['cargo_status']; ?>"]').prop('selected',true);
  $('[name="fhvut_status"] option[value="<?php echo $details['fhvut_status']; ?>"]').prop('selected',true);
  $('[name="oregon_permit_status"] option[value="<?php echo $details['oregon_permit_status']; ?>"]').prop('selected',true);
  $('[name="ifta_status"] option[value="<?php echo $details['ifta_status']; ?>"]').prop('selected',true);
  $('[name="pifta_status"] option[value="<?php echo $details['pifta_status']; ?>"]').prop('selected',true);
  $('[name="nm_status"] option[value="<?php echo $details['nm_status']; ?>"]').prop('selected',true);
  $('[name="odometer_update_type"] option[value="<?php echo $details['odometer_update_type']; ?>"]').prop('selected',true);
  $('[name="engine_hours_update_type"] option[value="<?php echo $details['engine_hours_update_type']; ?>"]').prop('selected',true);
  
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>