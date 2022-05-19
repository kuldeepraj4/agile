<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">ADD NEW DRIVER</div>
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
        <legend>Personal Details</legend>
        <div class="field-section single-column">
        <!-- <div class="field-p">
          <label>Driver ID</label>
          <input type="text" name="code" pattern="[a-zA-Z0-9]{3,}" required="required">
        </div> -->
        <div class="field-p">
          <label>Prefix</label>
          <select name="prefix_id" required="required"></select>
        </div>
        <div class="field-p">
          <label>First Name</label>
          <input type="text" name="name_first" required="required"></select>
        </div>
        <div class="field-p">
          <label>Middle Name</label>
          <input type="text" name="name_middle">
        </div>
        <div class="field-p">
          <label>Last Name</label>
          <input type="text" name="name_last" required="required">
        </div>
        <div class="field-p">
          <label>Date of Birth</label>
          <input type="text" data-date-picker="" name="dob" required="required">
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
            <input style="width: 50%" type="text" name="mobile_number" required="required" pattern="[0-9][0-9]{9}"></div>
        </div>
       
        <div class="field-p">
          <label>Email ID</label>
          <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
        </div>
                      
        </div>                  
      </fieldset>

  <fieldset>
        <legend>Present Address</legend>
        <div class="field-section single-column">
                  <div class="field-p">
          <label>Address Line</label>
          <input type="text" name="address_line" required="required">
        </div>        
        <div class="field-p">
          <label>State</label>
          <select name="address_state_id" onchange="show_addess_cities({state_id:this.value})" required="required" ></select>
        </div>
        <div class="field-p">
          <label>City</label>
          <select name="address_city_id" onchange="show_address_zipcodes({city_id:this.value})" required="required" disabled></select>
        </div>
        <div class="field-p">
          <label>ZIP Code</label>
          <select name="address_zipcode_id" disabled></select>
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
        <input type="text" data-date-picker="" name="date_of_joining" required="required">
      </div>
      <div class="field-p">
        <label>Route Type</label>
        <select name="route_type_id"></select>
      </div>        
      <div class="field-p">
        <label>CDL No.</label>
        <input type="text" name="cdl_no" required="required">
      </div>                               
      <div class="field-p">
        <label>CDL State</label>
        <select name="cdl_state_id" required="required"></select>
      </div>                               
    <!--   <div class="field-p">
        <label>CDL Issue Date</label>
        <input type="text" name="cdl_issue_date" data-date-picker="" data-date-from data-filter="cdl_issue_date_from">
      </div>        
      <div class="field-p">
        <label>CDL Expiry Date</label>
        <input type="text" name="cdl_expiry_date" data-date-picker="" required="required" data-date-to data-filter="cdl_issue_date_to">
      </div> -->
    <div class="field-p">
        <label>SSN No.</label>
        <input type="text" name="ssn_number">
    </div>
    <div class="field-p">
        <label>Residency</label>
        <select name="residency_id"></select>
    </div>
         <!--  <div class="field-p">
        <label>Residency Expiry Date</label>
        <input type="text" name="residency_expiry_date" data-date-picker="" disabled>
      </div> -->
       <!--    <div class="field-p">
        <label>Medical Issue Date</label>
        <input type="text" name="medical_issue_date" data-date-picker="" data-medical-from  data-filter="medical_issue_date_from">
      </div>        
      <div class="field-p">
        <label>Medical Expiry Date</label>
        <input type="text" name="medical_expiry_date" data-date-picker="" data-medical-to  data-filter="medical_issue_date_to">
      </div> -->
    <div class="field-p">
        <label>GFR</label>
        <input type="text" name="gfr">
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
    <div class="field-section">        
     <!--  <div class="field-p">
        <label>Last Annual Review Date</label>
        <input type="text" name="last_annual_review_date" data-date-picker="" data-annual-from data-filter="last_annual_review_date_from">
      </div>
      <div class="field-p">
        <label>Next Annual Review Date</label>
        <input type="text" name="next_annual_review_date"data-date-picker="" data-annual-to data-filter="last_annual_review_date_to">
      </div> -->       
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
      <button type="button" class="btn_green" onclick="back_alert()" style="margin-left: 10px;">BACK</button>
    </section>
  </form>
</section>



<script type="text/javascript">


  $(document.body).on('change', '[name="residency_id"]', function() {

     if ($(this).val() != "3") {
   $('[name="residency_expiry_date"]').prop('disabled', true).prop('selectedIndex', 0).val('')
   $('[name="residency_expiry_date"]').prop('disabled', true).prop('selectedIndex', 0).val('')
  }else{
    $('[name="residency_expiry_date"]').prop('required', true).prop('disabled', false)
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
 



</script>
<!--  check CDL Issue Date -->
<script>
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
                wait_to_submit_btn('#submit','SAVE')
                location.href='../user/masters/drivers/documents?eid='+data.response.new_eid;
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
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_driver_groups()
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
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_driver_type()
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
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_employee_prefix()
</script>




<!-- states, city and zip code selection -->

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
        $('[name="cdl_state_id"]').html(options);  
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
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_companies_options()
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
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_truck_id_options()
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
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_residency_options()
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>