<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">ADD NEW TRUCK</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">
    <section class="section-111">

<div></div>
<div>
      <fieldset>
        <legend>Status</legend>
        <div class="field-section single-column">
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
        <legend>Basic Details 1</legend>
        <div class="field-section">
        <div class="field-p">
          <label>Truck ID</label>
          <input type="text" name="code" pattern="[a-zA-Z0-9]{3,}" required="required">
        </div>
        <div class="field-p">
          <label>Equipment Group</label>
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
          <input type="text" name="make_year" required="required">
        </div>
        <div class="field-p">
          <label>Make Company</label>
          <select name="maker_id" required="required" onchange="show_model_options({maker_id:this.value})"></select>
        </div>
        <div class="field-p">
          <label>Model</label>
          <select name="model_id" disabled></select>
        </div>
        <div class="field-p">
          <label>Color</label>
          <select name="color_id"></select>
        </div>
        <div class="field-p">
          <label>VIN</label>
          <input type="text" name="vin_number" required="required">
        </div>
        <div class="field-p">
          <label>Licence tag no.</label>
          <input type="text" name="licence_tag_no" required="required">
        </div>
                <div class="field-p">
          <label>Licence tag Expiry</label>
          <input type="text" data-date-picker="" name="licence_tag_expiery" required="required">
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
        <div class="field-section  single-column">
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
          <input type="text" name="insurance_start_date" data-date-picker="" class="datepicker" data-start-from data-filter="insurance_start_date">
        </div>
        <div class="field-p">
          <label>Insurance expiry date</label>
          <input type="text" class="datepicker" data-date-picker="" name="insurance_expiry_date" data-start-to data-filter="insurance_expiry_date"> 
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
          <input type="text" name="pd_value">
        </div>        
        <div class="field-p">
          <label>Loss pay info</label>
          <input type="text" name="loss_pay_info">
        </div>        
        <div class="field-p">
          <label>P/D value new</label>
          <input type="text" name="new_pd_value">
        </div>                        
        </div>                  
      </fieldset>
</div>
<div>
  <fieldset>
        <legend>Permits</legend>
        <div class="field-section  single-column">
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
          <input type="text" data-date-picker="" name="fhvut_paid_date">
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
          <input type="text" name="family_engine_number">
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
          <input type="text" name="pre_pass">
        </div>        
        <div class="field-p">
          <label>Pre pass remark</label>
          <input type="text" name="pre_pass_remark">
        </div>
      <div class="field-p">
        <label>HUT</label>
        <input type="text" name="hut">
      </div>
      <div class="field-p">
        <label>HUT remarks</label>
        <input type="text" name="hut_remark">
      </div>                                
        </div>                  
      </fieldset>
</div>
</section>
<section class="section-111">

<div>
  <fieldset>
    <legend>Lease details</legend>
    <div class="field-section  single-column">
      <div class="field-p">
        <label>Ownership Type</label>
        <select name="ownership_type_id" required="required"></select>
      </div>        
      <div class="field-p">
        <label>Lease Ref no</label>
        <input type="text" name="lease_ref_no">
      </div>                               
      <div class="field-p">
        <label>Leasing company</label>
        <select name="lease_company_id" id="city_id"></select>
      </div>        
      <div class="field-p">
        <label>Leasing expiry</label>
        <input type="text" data-date-picker="" name="lease_expiry_date">
      </div>                               
    </div>                  
  </fieldset>
</div>


<div>
  <fieldset>
    <legend>---</legend>
    <div class="field-section  single-column">  
       <div class="field-p">
        <label>Truck type</label>
        <select name="truck_type" required>
          <option value="">- -Select- -</option>  
          <option value="normal">Normal</option>
          <option value="box">Box</option>
        </select>
      </div>      
      <div class="field-p">
        <label>Device type</label>
        <select name="device_company_id"></select>
      </div>
      <div class="field-p">
        <label>Gateway serial no.</label>
        <input type="text" name="device_serial_no" id="city_id">
      </div>       
      <div class="field-p">
        <label>Dash cam no</label>
        <input type="text" name="device_dash_cam_no">
      </div>
        <div class="field-p">
        <label>Halo no.</label>
        <input type="text" name="halo" id="city_id">
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
    <button type="button" class="btn_green" onclick="back_alert()" style="margin-left: 10px;">BACK</button>
  </section>
  </form>
</section>


<!--  check insurance_start Issue Date -->
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


<script type='text/javascript'>
  function back_alert() {
    if (confirm('Are you Sure ?')) {
      window.history.back();
    }
  }
</script>


<script type="text/javascript">
    function add_new(){
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
        url:window.location.href+'-action',
        type:'POST',
        data: obj,
        success:function(data){
               if((typeof data)=='string'){
               data=JSON.parse(data) 
               }
               alert(data.message);
               if(data.status){
                //GTU_masters_locations_cities();
                wait_to_submit_btn('#submit','SAVE')
                window.history.back();
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
  $('[name="model_id"]').html(`<option value="">- - Select - -</option>`); 
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('[name="color_id"]').html(options);     
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
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_lease_companies_options()
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>