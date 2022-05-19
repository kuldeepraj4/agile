<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details'];
 ?>
<section class="lg-form-outer">
  <div class="lg-form-header">UPDATE DRIVER <?php echo $details['code'] ?></div>
  <section class="lg-form" style="text-align:right;">
    <?php
  if (in_array('P0009', USER_PRIV)) {
  ?>
    <button class='btn_blue' onclick="open_quick_view_driver('<?php echo $data['eid']; ?>')">View Driver</button>
  <?php
  }
  ?>
  </section>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">
    <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
    <input type="hidden" name="code1" value="<?php echo $details['code'] ?>">
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
        <legend>Personal Details</legend>
        <div class="field-section single-column">
        <!-- <div class="field-p">
          <label>Driver ID</label>
          <input type="text" name="code" pattern="[a-zA-Z0-9]{3,}" required="required" value="<?php echo $details['code'] ?>">
        </div> -->
        <div class="field-p">
          <label>Prefix</label>
          <select name="prefix_id" required="required"></select>
        </div>
        <div class="field-p">
          <label>First Name</label>
          <input type="text" name="name_first" required="required" value="<?php echo $details['name_first'] ?>"></select>
        </div>
        <div class="field-p">
          <label>Middle Name</label>
          <input type="text" name="name_middle" value="<?php echo $details['name_middle'] ?>">
        </div>
        <div class="field-p">
          <label>Last Name</label>
          <input type="text" name="name_last" value="<?php echo $details['name_last'] ?>" required="required">
        </div>
        <div class="field-p">
          <label>Date of Birth</label>
          <input type="text" data-date-picker="" name="dob" value="<?php echo $details['dob'] ?>"   placeholder="MM/DD/YYYY" required="required">
        </div>       
        </div>                  
      </fieldset>
      <fieldset>
        <legend>Contact Information</legend>
        <div class="field-section single-column">
        <div class="field-p">
          <label>Mobile No.</label>
          <div>
            <select style="width: 30%" name="mobile_country_code_id"></select>
            <input style="width: 50%" type="text" name="mobile_number" value="<?php echo $details['mobile_number'] ?>"  pattern="[0-9][0-9]{9}" required="required"></div>
        </div>
       
        <div class="field-p">
          <label>Email ID</label>
          <input type="email" name="email" value="<?php echo $details['email'] ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
        </div>
                      
        </div>                  
      </fieldset>
  <fieldset>
        <legend>Present Address</legend>
        <div class="field-section single-column">
                  <div class="field-p">
          <label>Address Line</label>
          <input type="text" name="address_line" value="<?php echo $details['address_line'] ?>" required="required">
        </div>        
        <div class="field-p">
          <label>State</label>
          <select name="address_state_id" onchange="show_addess_cities({state_id:this.value})" required="required"></select>
        </div>
        <div class="field-p">
          <label>City</label>
          <select name="address_city_id" onchange="show_address_zipcodes({city_id:this.value})" required="required"></select>
        </div>
        <div class="field-p">
          <label>ZIP Code</label>
          <select name="address_zipcode_id"></select>
        </div>                              
        </div>                  
      </fieldset>
</div>


<div>
  <fieldset>
    <legend>------</legend>
    <div class="field-section single-column">
        <div class="field-p">
        <label>Company Name</label>
        <select name="company_id" required="required"></select>
      </div>
    <div class="field-p">
        <label>Joining Date</label>
        <input type="text" data-date-picker="" name="date_of_joining"   placeholder="MM/DD/YYYY" value="<?php echo $details['date_of_joining'] ?>" required="required">
      </div>
      <div class="field-p">
        <label>Route Type</label>
        <select name="route_type_id"></select>
      </div>        
      <div class="field-p">
        <label>CDL No.</label>
        <input type="text" name="cdl_no" value="<?php echo $details['cdl_number'] ?>" required="required">
      </div>                               
      <div class="field-p">
        <label>CDL State</label>
        <select name="cdl_state_id" required="required"></select>
      </div>                               
      <!-- <div class="field-p">
        <label>CDL Issue Date</label>
        <input type="text" name="cdl_issue_date" data-date-picker="" data-date-from data-filter="cdl_issue_date_from"  placeholder="MM/DD/YYYY" value="<?php //echo $details['cdl_issue_date'] ?>">
      </div>        
      <div class="field-p">
        <label>CDL Expiry Date</label>
        <input type="text" name="cdl_expiry_date" data-date-picker=""  data-date-to data-filter="cdl_issue_date_to" placeholder="MM/DD/YYYY" value="<?php //echo $details['cdl_expiry_date'] ?>" required="required">
      </div> -->
    <div class="field-p">
        <label>SSN No.</label>
        <input type="text" name="ssn_number" value="<?php echo $details['ssn_number'] ?>">
    </div>
    <div class="field-p">
        <label>Residency</label>
        <select name="residency_id"></select>
    </div>
        <!--   <div class="field-p">
        <label>Residency Expiry Date</label>
        <input type="text" name="residency_expiry_date" data-date-picker=""   placeholder="MM/DD/YYYY" value="<?php //echo $details['residency_expiry_date'] ?>" <?php //if($details['residency_expiry_date']==''){// echo 'disabled'; }; ?> >
      </div> -->
      <!--     <div class="field-p">
        <label>Medical Issue Date</label>
        <input type="text" name="medical_issue_date" data-date-picker="" data-medical-from  data-filter="medical_issue_date_from" placeholder="MM/DD/YYYY" value="<?php //echo $details['medical_issue_date'] ?>">
      </div>        
      <div class="field-p">
        <label>Medical Expiry Date</label>
        <input type="text" name="medical_expiry_date" data-date-picker=""  data-medical-to  data-filter="medical_issue_date_to" placeholder="MM/DD/YYYY" value="<?php// echo $details['medical_expiry_date'] ?>">
      </div> -->
    <div class="field-p">
        <label>GFR</label>
        <input type="text" name="gfr"value="<?php echo $details['gfr'] ?>">
      </div>
    <div class="field-p">
        <label>EPN Enroll</label>
        <select name="epn_enroll_status">
                      <option value=""> - - select - -</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>

    </div>                  
  </fieldset>
</div>


<div>
  <fieldset>
    <legend>Followups / Technical Details</legend>
    <div class="field-section single-column">        
      <!-- <div class="field-p">
        <label>Last Annual Review Date</label>
        <input type="text" name="last_annual_review_date" data-date-picker=""  data-annual-from data-filter="last_annual_review_date_from" value="<?php //echo $details['last_annual_review_date'] ?>">
      </div>
      <div class="field-p">
        <label>Next Annual Review Date</label>
        <input type="text" name="next_annual_review_date"data-date-picker="" data-annual-to data-filter="last_annual_review_date_to" value="<?php //echo $details['next_annual_review_date'] ?>">
      </div>   -->     
        <div class="field-p">
        <label>Truck Assigned</label>
        <select name="assigned_truck_id"></select>
      </div> 
    <div class="field-p">
        <label>Insurance Added</label>
        <select name="insurance_added_status">
            <option value=""> - - select - -</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>
        <div class="field-p">
        <label>Group</label>
        <select name="group_id"></select>
    </div>
    <div class="field-p">
        <label>Driver Type</label>
        <select name="driver_type" required></select>
    </div>                                
    </div>                  
  </fieldset>
</div>

    </section>
    <section class="action-button-box">
      <button type="submit" class="btn_green">SAVE</button>
       <?php
       
       if($_GET['page']=='verify'){
     
      ?>
        <button type='button' id='button' class='btn_green' onclick='set_pref("VERIFIED")' style="margin-left: 10px;">SAVE AS VERIFIED</button>
      <?php
      }
    

      ?>
      <button type="button" class="btn_green" onclick="back_alert()" style="margin-left: 10px;">BACK</button>
      <button type="submit" data-submit></button>
    </section>
  </form>
</section>



<script>

  $(document.body).on('change', '[name="residency_id"]', function() {

     if ($(this).val() != "3") {
    $('[name="residency_expiry_date"]').prop('disabled', true).prop('selectedIndex', 0).val('')
   $('[name="residency_expiry_date"]').prop('disabled', true).prop('selectedIndex', 0).val('')
  }else{
    $('[name="residency_expiry_date"]').prop('required', true).prop('disabled', false).prop('selectedIndex', 0)
    }
  })

   $(document.body).on('change', '[name="address_state_id"]', function() {
     if ($(this).val() == "") {
   $('[name="address_city_id"]').prop('disabled', true).prop('selectedIndex', 0)
   $('[name="address_zipcode_id"]').prop('disabled', true).prop('selectedIndex', 0)
  }else{
    $('[name="address_city_id"]').prop('required', true).prop('disabled', false).prop('selectedIndex', 0)
    
  }
  })



   $(document.body).on('change', '[name="address_city_id"]', function() {
     if ($(this).val() == "") {
   $('[name="address_zipcode_id"]').prop('disabled', true).prop('selectedIndex', 0)
  }else{
   
    $('[name="address_zipcode_id"]').prop('disabled', false).prop('selectedIndex', 0)
  }
  })
 


  
  $(document.body).on('change', '[data-date-from]', function() {
    var g1 = new Date(check_url_params('cdl_issue_date_from'))
    var g2 = new Date(check_url_params('cdl_issue_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("CDL Issue Date should be less than from CDL Expiry Date")
      $("[data-filter='cdl_issue_date_from']").val("").focus();
    }

  });

  $(document.body).on('change', '[data-date-to]', function() {
    var g1 = new Date(check_url_params('cdl_issue_date_from'))
    var g2 = new Date(check_url_params('cdl_issue_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("CDL Expiry Date should be greater than from CDL Issue Date")
      $("[data-filter='cdl_issue_date_to']").val("").focus();
     
    }
  });
</script>


<!--  Check Medical Issue Date -->
<script>
  $(document.body).on('change', '[data-medical-from]', function() {
    var g1 = new Date(check_url_params('medical_issue_date_from'))
    var g2 = new Date(check_url_params('medical_issue_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Medical Issue Date should be less than from Medical Expiry Date")
      $("[data-filter='medical_issue_date_from']").val("").focus();
    }

  });

  $(document.body).on('change', '[data-medical-to]', function() {
    var g1 = new Date(check_url_params('medical_issue_date_from'))
    var g2 = new Date(check_url_params('medical_issue_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Medical Expiry Date should be greater than from Medical Issue Date")
      $("[data-filter='medical_issue_date_to']").val("").focus();
     
    }
  });
</script>



<!--  Check Annual Review  Date -->
<script>
  $(document.body).on('change', '[data-annual-from]', function() {
    var g1 = new Date(check_url_params('last_annual_review_date_from'))
    var g2 = new Date(check_url_params('last_annual_review_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Last Annual Review Date should be less than from Next Annual Review Date")
      $("[data-filter='last_annual_review_date_from']").val("").focus();
    }

  });

  $(document.body).on('change', '[data-annual-to]', function() {
    var g1 = new Date(check_url_params('last_annual_review_date_from'))
    var g2 = new Date(check_url_params('last_annual_review_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Next Annual Review Date should be greater than from Last Annual Review Date")
      $("[data-filter='last_annual_review_date_to']").val("").focus();
     
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
                 location.href = 'user/masters/drivers';
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
function show_employee_status(){
 get_employees_status().then(function(data) {
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
show_employee_status()
</script>

<script type="text/javascript">
function show_driver_groups(){
 get_driver_groups().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('[name="group_id"]').html(options);
        $('[name="group_id"] option[value="<?php echo $details['group_id']; ?>"]').prop('selected',true);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_driver_groups()
</script>


<script type="text/javascript">
function show_route_types(){
 get_route_types().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('[name="route_type_id"]').html(options);
        $('[name="route_type_id"] option[value="<?php echo $details['route_type_id']; ?>"]').prop('selected',true);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_route_types()
</script>


<script type="text/javascript">
function show_mobile_country_code(){
 get_mobile_country_codes().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('[name="mobile_country_code_id"]').html(options); 
         $('[name="mobile_country_code_id"] option[value="<?php echo $details['mobile_country_code_id']; ?>"]').prop('selected',true);    
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_mobile_country_code()
</script>




<script type="text/javascript">
function show_employee_prefix(){
 get_employees_prefix().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('[name="prefix_id"]').html(options);
        $('[name="prefix_id"] option[value="<?php echo $details['prefix_id']; ?>"]').prop('selected',true);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_employee_prefix()
</script>

<script type="text/javascript">
function show_cdl_states(){
 get_states().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('[name="cdl_state_id"]').html(options);
        $('[name="cdl_state_id"] option[value="<?php echo $details['cdl_state_id']; ?>"]').prop('selected',true);      
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_cdl_states()
</script>

<script type="text/javascript">
function show_addess_states(){
 get_states().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('[name="address_state_id"]').html(options);
        $('[name="address_state_id"] option[value="<?php echo $details['address_state_id']; ?>"]').prop('selected',true);
             show_addess_cities({state_id:'<?php echo $details['address_state_id']; ?>'});
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_addess_states()
</script>

<script type="text/javascript">
function show_addess_cities(param){
 get_cities(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('[name="address_city_id"]').html(options);
        $('[name="address_city_id"] option[value="<?php echo $details['address_city_id']; ?>"]').prop('selected',true);

        show_address_zipcodes({city_id:'<?php echo $details['address_city_id']; ?>'});     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
</script>



<script type="text/javascript">
function show_address_zipcodes(param){
 get_zipcodes(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('[name="address_zipcode_id"]').html(options);
        $('[name="address_zipcode_id"] option[value="<?php echo $details['address_zipcode_id']; ?>"]').prop('selected',true);     
    }
    else{
      var options="";
      options+=`<option value="">- - Select - -</option>`;
      $('[name="address_zipcode_id"]').html(options);
    }
  }
  else{

      var options="";
      options+=`<option value="">- - Select - -</option>`;
      $('[name="address_zipcode_id"]').html(options);
    }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
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
function show_residency_options(){
 get_employees_residency().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('[name="residency_id"]').html(options);
        $('[name="residency_id"] option[value="<?php echo $details['residency_id']; ?>"]').prop('selected',true);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_residency_options()
</script>


<script type="text/javascript">
function show_truck_id_options(){
 get_trucks().then(function(data) {
 // console.log(data)
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.code+`</option>`;               
        })
        $('[name="assigned_truck_id"]').html(options);
        $('[name="assigned_truck_id"] option[value="<?php echo $details['assigned_truck_id']; ?>"]').prop('selected',true);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_truck_id_options()
</script>


<script type="text/javascript">
function show_driver_type(){
 quick_list_driver_types().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('[name="driver_type"]').html(options);
        $('[name="driver_type"] option[value="<?php echo $details['driver_type_id']; ?>"]').prop('selected',true);         
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_driver_type()
</script>


<script type="text/javascript">
  $('[name="epn_enroll_status"] option[value="<?php echo $details['epn_enroll_status']; ?>"]').prop('selected',true);
   $('[name="insurance_added_status"] option[value="<?php echo $details['insurance_added_status']; ?>"]').prop('selected',true);  
</script>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>