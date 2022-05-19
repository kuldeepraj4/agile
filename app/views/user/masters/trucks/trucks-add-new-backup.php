<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<section class="form-ms-outer">
  <div class="form-ms-header">ADD NEW TRUCK</div>
  <form class="form-ms" method="POST" id="MyForm" onsubmit="return add_new()">
    <section class="form-ms-section-3">

<div></div>
<div>
      <fieldset>
        <legend>Status</legend>
        <div class="field-section">
        <div class="field">
          <label>Status</label>
          <select name="status_id" required="required"></select>
        </div>
        </div>                  
      </fieldset>
</div>
<div></div>
     
<div>
      <fieldset>
        <legend>Basic Details 1</legend>
        <div class="field-section">
        <div class="field">
          <label>Truck ID</label>
          <input type="text" name="code" pattern="[a-zA-Z0-9]{3,}" required="required">
        </div>
        <div class="field">
          <label>Equipment group</label>
          <select name="group">
            <option value=""> - - Select - - </option>
            <option value="Short Haul">Short Haul</option>
            <option value="Long Haul">Long Haul</option>
          </select>
        </div>
        <div class="field">
          <label>Company</label>
          <select name="company_id" required="required"></select>
        </div>
        <div class="field">
          <label>Make Year</label>
          <input type="text" name="make_year" required="required">
        </div>
        <div class="field">
          <label>Make</label>
          <select name="maker_id" required="required" onchange="show_model_options({maker_id:this.value})"></select>
        </div>
        <div class="field">
          <label>Model</label>
          <select name="model_id" required="required"></select>
        </div>
        <div class="field">
          <label>Color</label>
          <select name="color_id"></select>
        </div>
        <div class="field">
          <label>VIN</label>
          <input type="text" name="vin_number">
        </div>
        <div class="field">
          <label>Licence tag no.</label>
          <input type="text" name="licence_tag_no" >
        </div>
                <div class="field">
          <label>Licence tag Expiry</label>
          <input type="text" data-date-picker="" name="licence_tag_expiery">
        </div>
        <div class="field">
          <label>State</label>
          <select name="licence_state_id"></select>
        </div>        
        </div>                  
      </fieldset>
</div>
<div>
      <fieldset>
        <legend>Insurance details</legend>
        <div class="field-section">
        <div class="field">
          <label>Insurance status</label>
          <select name="insurance_status">
            <option value=""> - - select - -</option>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
          </select>
        </div>

        <div class="field">
          <label>Insurance carrier</label>
          <select name="insurance_company_id"  id="city_id"></select>
        </div>        
        <div class="field">
          <label>Insurance start date</label>
          <input type="text" name="insurance_start_date" data-date-picker="" class="datepicker">
        </div>
        <div class="field">
          <label>Insurance expiry date</label>
          <input type="text" class="datepicker" data-date-picker="" name="insurance_expiry_date">
        </div>        
        <div class="field">
          <label>Liability</label>
          <select name="liability_status">
            <option value="">- - select - -</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>
        <div class="field">
          <label>Cargo</label>
          <select name="cargo_status">
            <option value="">- - select - -</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>        
        <div class="field">
          <label>P/D value</label>
          <input type="text" name="pd_value">
        </div>        
        <div class="field">
          <label>Loss pay info</label>
          <input type="text" name="loss_pay_info">
        </div>        
        <div class="field">
          <label>P/D value new</label>
          <input type="text" name="new_pd_value">
        </div>                        
        </div>                  
      </fieldset>
</div>
<div>
  <fieldset>
        <legend>Permits</legend>
        <div class="field-section">
                  <div class="field">
          <label>FHVUT</label>
          <select name="fhvut_status">
            <option value=""> - - Select - - </option>
            <option value="Paid">Paid</option>
            <option value="Unpaid">Un-paid</option>
          </select>
        </div>        
        <div class="field">
          <label>Paid date</label>
          <input type="text" data-date-picker="" name="fhvut_paid_date">
        </div>
        <div class="field">
          <label>Oregon permit issue</label>
          <select name="oregon_permit_status">
            <option value="">- - select - -</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>
        <div class="field">
          <label>Family engine no.</label>
          <input type="text" name="family_engine_number">
        </div>        
        <div class="field">
          <label>IFTA</label>
          <select name="ifta_status">
            <option value="">- - select - -</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>
        <div class="field">
          <label>PIFTA</label>
          <select name="pifta_status">
            <option value="">- - select - -</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>
        <div class="field">
          <label>NM permit</label>
            <select name="nm_status">
            <option value="">- - select - -</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>        
        
        <div class="field">
          <label>Pre pass</label>
          <input type="text" name="pre_pass">
        </div>        
        <div class="field">
          <label>Pre pass remark</label>
          <input type="text" name="pre_pass_remark">
        </div>
      <div class="field">
        <label>HUT</label>
        <input type="text" name="hut">
      </div>
      <div class="field">
        <label>HUT remarks</label>
        <input type="text" name="hut_remark">
      </div>                                
        </div>                  
      </fieldset>
</div>


<div>
  <fieldset>
    <legend>Lease details</legend>
    <div class="field-section">
      <div class="field">
        <label>Ownership Type</label>
        <select name="ownership_type_id"></select>
      </div>        
      <div class="field">
        <label>Lease Ref no</label>
        <input type="text" name="lease_ref_no">
      </div>                               
      <div class="field">
        <label>Leasing company</label>
        <select name="lease_company_id" id="city_id"></select>
      </div>        
      <div class="field">
        <label>Leasing expiry</label>
        <input type="text" data-date-picker="" name="lease_expiry_date">
      </div>                               
    </div>                  
  </fieldset>
</div>


<div>
  <fieldset>
    <legend>---</legend>
    <div class="field-section">        
      <div class="field">
        <label>Device type</label>
        <select name="device_company_id"></select>
      </div>
      <div class="field">
        <label>Gateway serial no.</label>
        <input type="text" name="device_serial_no" id="city_id">
      </div>       
      <div class="field">
        <label>Dash cam no</label>
        <input type="text" name="device_dash_cam_no">
      </div>
        <div class="field">
        <label>Halo no.</label>
        <input type="text" name="halo" id="city_id">
      </div>                                
    </div>                  
  </fieldset>
</div>
<div>
  <fieldset>
    <legend>Odometer details</legend>
    <div class="field-section">
      <div class="field">
        <label>Updation type</label>
        <select name="odometer_update_type">
          <option value="Auto">Auto</option>
          <option value="Manual">Manual</option>
        </select>
      </div>
                                       
    </div>                  
  </fieldset>
</div>

<div>

</div>
    </section>
    <section class="action-button-box">
      <button type="submit" class="btn_green">SAVE</button>
    </section>
  </form>
</section>




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
          // alert(data)
               if((typeof data)=='string'){
               data=JSON.parse(data) 
               }
               alert(data.message);
               if(data.status){
                GTU_masters_locations_cities();
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