<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details'];
?>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">UPDATE USER</div>
    <form method="POST" class="lg-form" id="MyForm" onsubmit="return add_new()">
        <input type="hidden" name="update_eid" value="<?php echo $details['eid']; ?>">
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
        <div class="field-p">
              <label>ID</label>
              <input type="text" name="code" pattern="[a-zA-Z0-9]{3,}" value="<?php echo $details['code']; ?>" required="required">
          </div>

          <div class="field-p">
  
              <label>First Name</label>
              <input type="text" name="name" pattern="[a-zA-Z0-9 ]{3,}" required="required" value="<?php echo $details['name']; ?>"></select>
          </div>

          <div  class="field-p">
              <label>Middle Name</label>
              <input type="text" name="middle_name" pattern="[a-zA-Z0-9 ]{3,}" value="<?php echo $details['middle_name']; ?>"></select>
          </div>
          <div  class="field-p">
              <label>Last Name</label>
              <input type="text" name="last_name" pattern="[a-zA-Z0-9 ]{3,}" value="<?php echo $details['last_name']; ?>"></select>
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
            <input style="width: 60%" type="text" name="mobile_number"  value="<?php echo $details['mobile']; ?>" pattern="[0-9][0-9]{9}"></div>
        </div>
       

        <div class="field-p">
          
              <label>Office Phone</label>
              

              <input  type="text" name="office_number" value="<?php echo $details['office_phone']; ?>">
          </div>

          <div class="field-p">
              <label>Extension</label>
              <input  type="text" name="extension" value="<?php echo $details['extension']; ?>">
          </div>
     

      <div class="field-p">
          <label>Email ID</label>

          <input  type="email" name="email" required="required" value="<?php echo $details['email']; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">


      </div>  


      <div class="field-p">
    
          <label>Official Company Email ID</label>
          <input  type="email" name="company_email" value="<?php echo $details['company_email']; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
      </div>
      <div class="field-p">
          <label>Personal Email ID</label>
          <input  type="email" name="personal_email" value="<?php echo $details['personal_email']; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
          </div>       
        </div>                  
      </fieldset>
      
</div>
<div>
  <fieldset>
        <legend>Present Address</legend>
        <div class="field-section single-column" >

<div class="field-p"> 
      <label>Address</label>
    
        <input  type="text" name="address" required="required" value="<?php echo $details['address']; ?>">
   

    </div>


    <div class="field-p">
          <label>State</label>
          <select name="state" onchange="show_addess_cities({state_id:this.value})" required="required"></select>
        </div>
        <div class="field-p">
          <label>City</label>
          <select name="city" onchange="show_address_zipcodes({city_id:this.value})" required="required" disabled></select>
        </div>
        <div class="field-p">
          <label>ZIP Code</label>
          <select name="zipcode" disabled></select>
        </div>


                                
        </div>                  
      </fieldset>
    <fieldset>
    <legend>Designation Information</legend>
    <div class="field-section single-column">
    





    <div class="field-p"> 
      <label>Company</label>
     
        
        <select name="company" required="required"></select>
   

    </div> 
     
    <div class="field-p">
      <label>Department</label>
    
        <select name="department" required="required"></select>
   
    </div> 
    <div class="field-p"> 
      <label>Designation</label>

         <select name="designation" required="required"></select>
   

    </div> 
    <div class="field-p">
      <label>Team</label>
  
        <select name="team"></select>
  

   
 



     </div>                              
        </div>                  
      </fieldset>
</div>
<div>
    <fieldset>
    <legend>Technical Details</legend>
    <div class="field-section single-column">
    





  
         
         

    <div class="field-p">
      

          <label>Force Password Renewal </label>
          <select name="force_renewal" data-default-select="<?php echo $details['force_password_renewal'] ?>">
            <option value="0">- - Select - -</option>
            <option value="YES">YES</option>
            <option value="NO">NO</option>
        </select>

    </div>
    <div  class="field-p"> 

      <label>Force Password Renewal Period In Month</label>
      <input type="number" name="force_renewal_period" placeholder="MM" max="12" maxlength="2" value="<?php echo $details['force_password_renewal_period'] ?>" <?php if(empty($details['force_password_renewal_period'])){ echo 'disabled'; };?>>
      <!-- <select name="force_renewal_period" data-default-select="">
        <option value="">- - Select - -</option>
        <option value="1">1 Month</option>
        <option value="2">2 Month</option>
        <option value="3">3 Month</option>
        <option value="4">4 Month</option>
    </select> -->
    </div>
  




    <div class="field-p">
     

          <label>Account Locked Out</label>
          <select name="account_locked_out" data-default-select="<?php echo $details['account_locked_out']; ?>">
            <option value="0">- - Select - -</option>
            <option value="YES">YES</option>
            <option value="NO">NO</option>
        </select>

    </div>
    <div class="field-p"> 

      <label>Account Locked Out Period In Minutes</label>
      <input type="number" name="account_locked_out_period"  max="60" placeholder="MM" maxlength="2" value="<?php echo $details['account_locked_out_period']; ?>" <?php if(empty($details['account_locked_out_period'])){ echo 'disabled'; };?>>
      <?php  ?>
      <!-- <select name="account_locked_out_period" data-default-select="<?php echo $details['account_locked_out_period'] ?>">
        <option value="">- - Select - -</option>
        <option value="15">15 Minutes</option>
        <option value="30">30 Minutes</option>
        <option value="45">45 Minutes</option>
        <option value="60">60 Minutes</option>
    </select> -->
    </div>                                
    </div>                  
  </fieldset>
</div>

</section>

    <section class="action-button-box">
       
      <button class="btn_green" id="submit">SAVE</button>
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



<script type="text/javascript">
   var check_city = '<?php echo $details['city'] ?>';
    var check_zipcode = '<?php echo $details['zipcode'] ?>';

if(check_city != "" && check_city != 0){
 $('[name="city"]').prop('disabled', false);
}


if(check_zipcode != "" && check_zipcode != 0){
 $('[name="zipcode"]').prop('disabled', false);
}



  $(document.body).on('change', '[name="state"]', function() {
     if ($(this).val() == "") {
   $('[name="city"]').prop('disabled', true).prop('selectedIndex', 0)
    $('[name="zipcode"]').prop('disabled', true).prop('selectedIndex', 0)
   
  }else{
    $('[name="city"]').prop('required', true).prop('disabled', false).prop('selectedIndex', 0)
    
  }
  })  



   $(document.body).on('change', '[name="city"]', function() {
     if ($(this).val() == "") {
   $('[name="zipcode"]').prop('disabled', true).prop('selectedIndex', 0)
  }else{
   
    $('[name="zipcode"]').prop('disabled', false).prop('selectedIndex', 0)
  }
  })


</script>




<script type='text/javascript'>
  function back_alert() {
    if (confirm('Are you Sure ?')) {
      window.history.back();
    }
  }
</script>

<script type="text/javascript">
  $(document.body).on('change', '[name="state"]', function() {
     if ($(this).val() == "") {
   $('[name="city"]').prop('selectedIndex', 0)
  }
  })
</script>

<script type="text/javascript">
  var check = '<?php echo $details['force_password_renewal'] ?>';
  $(document.body).on('change', '[name="force_renewal"]', function() {
    var txt = $(this).find('option:selected').text();
    var check = '<?php echo $details['force_password_renewal'] ?>';
   


    if ($(this).val() == "YES") {
      $('[name="force_renewal_period"]').prop('required', true).prop('disabled', false).val('');
    }else{
      $('[name="force_renewal_period"]').prop('disabled', true).val('');
    }
  })

  if(check != "YES"){
    $('[name="force_renewal_period"]').prop('disabled', true).val('');
  }
 
</script>

<script type="text/javascript">

  $(document.body).on('change', '[name="account_locked_out_period"]', function() {
    if ($(this).val() == "") {
      $('[name="account_locked_out_period"]').prop('required', true)

    }

  })


   $(document.body).on('change', '[name="force_renewal_period"]', function() {
    if ($(this).val() == "") {
      $('[name="force_renewal_period"]').prop('required', true)
      
    }

  })


  var check = '<?php echo $details['account_locked_out']; ?>';
  $(document.body).on('change', '[name="account_locked_out"]', function() {
    var txt = $(this).find('option:selected').text()
    if ($(this).val() == "YES") {
      $('[name="account_locked_out_period"]').prop('required', true).prop('disabled', false).val('');
    }else{
      $('[name="account_locked_out_period"]').prop('disabled', true).val('');
    }
  })

   if(check != "YES"){
    $('[name="account_locked_out_period"]').prop('disabled', true).val('');
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
                location.href='../user/masters/users';
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
        function show_employee_status(){
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
          $('[name="company"]').html(options);
        $('[name="company"] option[value="<?php echo $details['company']; ?>"]').prop('selected',true);     
      }
    }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    }) 
    }
    show_employee_status()
    </script>



    <script type="text/javascript">
        function show_employee_status(){
           get_department().then(function(data) {
      // Run this when your request was successful
      if(data.status){
        //Run this if response has list
        if(data.response.list){
          var options="";
          options+=`<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
           //if(item.status=='Active'){
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;    
            //}           
        })
          $('[name="department"]').html(options);  
          $('[name="department"] option[value="<?php echo $details['department']; ?>"]').prop('selected',true);   
      }
    }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    }) 
    }
    show_employee_status()
    </script>

    <script type="text/javascript">
        function show_employee_status(){
           get_designation().then(function(data) {
      // Run this when your request was successful
      if(data.status){
        //Run this if response has list
        if(data.response.list){
          var options="";
          options+=`<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            if(item.status=='Active') {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;     
            }          
        })
          $('[name="designation"]').html(options); 
           $('[name="designation"] option[value="<?php echo $details['designation']; ?>"]').prop('selected',true);     
      }
    }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    }) 
    }
    show_employee_status()
    </script>


    <script type="text/javascript">
        function show_employee_status(){
          quick_list_driver_teams().then(function(data) {
      // Run this when your request was successful
      if(data.status){
        //Run this if response has list
        if(data.response.list){
          var options="";
          options+=`<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
          $('[name="team"]').html(options);
          $('[name="team"] option[value="<?php echo $details['team']; ?>"]').prop('selected',true);      
      }
    }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    }) 
    }
    show_employee_status()
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
        $('[name="state"]').html(options);  
        $('[name="state"] option[value="<?php echo $details['state']; ?>"]').prop('selected',true);    
        show_addess_cities({state_id:'<?php echo $details['state']; ?>'});
    
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
        $('[name="city"]').html(options); 
         $('[name="city"] option[value="<?php echo $details['city']; ?>"]').prop('selected',true); 
         show_address_zipcodes({city_id:'<?php echo $details['city']; ?>'});         
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_addess_cities()
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
        $('[name="zipcode"]').html(options);
        $('[name="zipcode"] option[value="<?php echo $details['zipcode']; ?>"]').prop('selected',true);

    }
  } else {
      var options="";
      options+=`<option value="">- - Select - -</option>`;
      $('[name="zipcode"]').html(options);
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}

</script>

<!-- 
    <script type="text/javascript">
        function show_employee_status(){
           get_cities().then(function(data) {
      // Run this when your request was successful
      if(data.status){
        //Run this if response has list
        if(data.response.list){
          var options="";
          options+=`<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
          $('[name="city"]').html(options); 
          $('[name="city"] option[value="<?php echo $details['city']; ?>"]').prop('selected',true);    
      }
    }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    }) 
    }
    show_employee_status()
    </script> -->



<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>