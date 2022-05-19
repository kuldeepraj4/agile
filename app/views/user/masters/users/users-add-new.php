<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
 <section class="lg-form-outer">
  <div class="lg-form-header">ADD NEW USER</div>
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
        <div class="field-p">
              <label>ID</label>
              <input type="text" name="code" pattern="[a-zA-Z0-9]{3,}" required="required">
          </div>

          <div class="field-p">
  
              <label>First Name</label>
              <input type="text" name="name" pattern="[a-zA-Z0-9 ]{3,}" required="required"></select>
          </div>

          <div  class="field-p">
              <label>Middle Name</label>
              <input type="text" name="middle_name" pattern="[a-zA-Z0-9 ]{3,}" ></select>
          </div>
          <div  class="field-p">
              <label>Last Name</label>
              <input type="text" name="last_name" pattern="[a-zA-Z0-9 ]{3,}"></select>
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
            <input style="width: 60%" type="text" name="mobile_number" required="required" pattern="[0-9][0-9]{9}"></div>
        </div>
       

        <div class="field-p">
          
              <label>Office Phone</label>
              

              <input  type="text" name="office_number">
          </div>

          <div class="field-p">
              <label>Extension</label>
              <input  type="text" name="extension">
          </div>
     

      <div class="field-p">
          <label>Email ID</label>

          <input  type="email" required="required" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">


      </div>  


      <div class="field-p">
    
          <label>Official Company Email ID</label>
          <input  type="email" name="company_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
      </div>
      <div class="field-p">
          <label>Personal Email ID</label>
          <input  type="email" name="personal_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
          </div>       
        </div>                  
      </fieldset>
      
</div>
<div>
  <fieldset>
        <legend>Present Address</legend>
        <div class="field-section single-column">

<div class="field-p"> 
      <label>Address</label>
    
        <input  type="text" name="address" required="required">
   

    </div>

    <div class="field-p">
          <label>State</label>
          <select name="state" onchange="show_addess_cities({state_id:this.value})" required="required"></select>
        </div>
        <div class="field-p">
          <label>City</label>
          <select name="city" onchange="show_address_zipcodes({city_id:this.value})" required="required" disabled ></select>
        </div>
        <div class="field-p">
          <label>ZIP Code</label>
          <select name="zipcodes" disabled ></select>
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
      
              <label>New Password</label>
              <input type="text" name="password" required="required" pattern="[a-zA-Z0-9]{3,}" >
          </div>
          <div  class="field-p">
              <label>Confirm Password</label>
              <input type="text" name="con_password" required="required" pattern="[a-zA-Z0-9]{3,}" >
          </div>
         

    <div class="field-p">
      

          <label>Force Password Renewal</label>
          <select name="force_renewal" >
            <option value="0">- - Select - -</option>
            <option>YES</option>
            <option>NO</option>
        </select>

    </div>
    <div  class="field-p"> 

      <label>Force Password Renewal Period In Month</label>
      <input type="number" name="force_renewal_period" placeholder="MM" disabled max="12" maxlength="2">
        <!-- <option value="" >- - Select - -</option>
        <option value="1">1 Month</option>
        <option value="2">2 Month</option>
        <option value="3">3 Month</option>
        <option value="4">4 Month</option>
    </select> -->
    </div>
  




    <div class="field-p">
     

          <label>Account Locked Out</label>
          <select name="account_locked_out">
            <option value="0">- - Select - -</option>
            <option>YES</option>
            <option>NO</option>
        </select>

    </div>
    <div class="field-p"> 

      <label>Account Locked Out Period In Minutes</label>
      <input type="number" name="account_locked_out_period" disabled max="60" placeholder="MM" maxlength="2">
      <!-- <select name="account_locked_out_period" disabled >
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
      
      <button class="btn_green" id="submit">SAVE AND ASSIGN ROLES</button>
      <button type="button" class="btn_green" onclick="back_alert()" style="margin-left: 10px;">BACK</button>
    </section>
  </form>
</section>

<script type="text/javascript">
  $(document.body).on('change', '[name="state"]', function() {
     if ($(this).val() == "") {
   $('[name="city"]').prop('disabled', true).prop('selectedIndex', 0)
   $('[name="zipcodes"]').prop('disabled', true).prop('selectedIndex', 0)
  }else{
    $('[name="city"]').prop('required', true).prop('disabled', false).prop('selectedIndex', 0)
    
  }
  })



   $(document.body).on('change', '[name="city"]', function() {
     if ($(this).val() == "") {
   $('[name="zipcodes"]').prop('disabled', true).prop('selectedIndex', 0)
  }else{
   
    $('[name="zipcodes"]').prop('disabled', false).prop('selectedIndex', 0)
  }
  })


</script>



<script type="text/javascript">
  $(document.body).on('change', '[name="force_renewal"]', function() {
    var txt = $(this).find('option:selected').text()
    if ($(this).val() == "YES") {
      $('[name="force_renewal_period"]').prop('required', true).prop('disabled', false).val('');
    }else{
      $('[name="force_renewal_period"]').prop('disabled', true).val('');
    }
  })
</script>

<script type="text/javascript">
  $(document.body).on('change', '[name="account_locked_out"]', function() {
    var txt = $(this).find('option:selected').text()
    if ($(this).val() == "YES") {
      $('[name="account_locked_out_period"]').prop('required', true).prop('disabled', false).val('');
    }else{
      $('[name="account_locked_out_period"]').prop('disabled', true).val('');
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
                       
                        wait_to_submit_btn('#submit','SAVE AND ASSIGN ROLES');
                         location.href='../user/masters/users/assign-roles-group?eid='+data.response.new_eid;

                    }else{
                        wait_to_submit_btn('#submit','SAVE AND ASSIGN ROLES')
                    }
                }
            })
            }
            return false
        }
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
            if(item.status=='Active') {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;   
            }            
        })
          $('[name="department"]').html(options);     
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
           get_roles_groups().then(function(data) {
      // Run this when your request was successful
      if(data.status){
        //Run this if response has list
        if(data.response.list){
          var options="";
          options+=`<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
          $('[name="permissions"]').html(options);     
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
        $('[name="zipcodes"]').html(options);     
    }
  }
  else {
      var options="";
      options+=`<option value="">- - Select - -</option>`;
      $('[name="zipcodes"]').html(options);
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}

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
          $('[name="status_id"] option[value="1"]').prop('selected',true);    
      }
    }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    }) 
    }
    show_employee_status()
    </script>




<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>