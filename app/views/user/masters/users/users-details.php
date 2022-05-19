<?php
require_once APPROOT.'/views/includes/user/header.php';

$details=$data['details'];
?>

<style type="text/css">
  .none-text {
    border: 0px !important;
    color: black !important;
    background: none !important ;
    opacity: 1 !important;
    padding: 0px !important;
    -webkit-appearance: none;
  }
 
</style>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">USER <?php echo $details['code'].' '.$details['name'].' '.$details['middle_name'].' '.$details['last_name']; ?></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">
    <section class="section-111">
<div></div>
<div>
      <fieldset>
        <legend>Status</legend>
        <div class="field-section single-column">
        <div class="field-p">
          <label>Status</label>
          <div><?php echo $details['status_name']; ?></div>
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
              <div><?php echo $details['code']; ?></div>
          </div>

          <div class="field-p">
  
              <label>First Name</label>
              <div><?php echo $details['name']; ?></div>
          </div>

          <div  class="field-p">
              <label>Middle Name</label>
              <div><?php echo $details['middle_name']; ?></div>
          </div>
          <div  class="field-p">
              <label>Last Name</label>
              <div><?php echo $details['last_name']; ?></div>
           </div>       
        </div>                  
      </fieldset>
      <fieldset>
        <legend>Contact Information</legend>
        <div class="field-section single-column">
        <div class="field-p">
          <label>Mobile No</label>
          <div><?php if($details['mobile_cc'] > '0'){ echo '+'.$details['mobile_cc']; }?> <?php echo $details['mobile']; ?></div>
        </div>
       
        <div class="field-p">
          
              <label>Office Phone</label>
              

              <div><?php if($details['office_phone'] > '0'){echo $details['office_phone']; } ?></div>
          </div>

          <div class="field-p">
              <label>Extension</label>
              <div><?php if($details['extension'] > '0'){  echo $details['extension']; } ?></div>
          </div>
     

      <div class="field-p">
          <label>Email ID</label>

          <div><?php echo $details['email']; ?></div>


      </div>  


      <div class="field-p">
    
          <label>Official Company Email ID</label>
          <div><?php echo $details['company_email']; ?></div>
      </div>
      <div class="field-p">
          <label>Personal Email ID</label>
          <div><?php echo $details['personal_email']; ?></div>
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
          <div><?php echo $details['address']; ?></div>
        </div>        
        <div class="field-p">
          <label>State</label>
          <div><?php echo $details['address_state_name']; ?></div>
        </div>
        <div class="field-p">
          <label>City</label>
           <div><?php echo $details['address_city_name']; ?></div>
        </div>
        <div class="field-p">
          <label>ZIP Code</label>
         <div><?php echo $details['address_zipcode_name']; ?></div>
        </div>                              
        </div>                  
      </fieldset>

    <fieldset>
    <legend>Designation Information</legend>
    <div class="field-section single-column">
        <div class="field-p">
        <label>Company</label>
         <div><?php echo $details['company_name']; ?></div>
       
      </div>
    <div class="field-p">
        <label>Department</label>
        <div><?php echo $details['department_name']; ?></div>
      </div>
      <div class="field-p">
        <label>Designation</label>
       <div><?php echo $details['designation_name']; ?></div>
      </div>        
      <div class="field-p">
        <label>Team</label>
        <div><?php echo $details['team_name']; ?></div>
         </div>                              
        </div>                  
      </fieldset>
</div>
<div>
    <fieldset>
    <legend>Technical Details</legend>
    <div class="field-section single-column">
    <div class="field-section">        
      <div class="field-p">
        <label>Force Password Renewal</label>
        <div><?php if($details['force_password_renewal'] > '0'){  echo $details['force_password_renewal']; }
        ?></div>
      </div>
      <div class="field-p">
        <label>Force Password Renewal Period</label>
        <div><?php if($details['force_password_renewal_period'] > '0'){ echo $details['force_password_renewal_period'].' Month'; }?> </div>
      </div>       
        <div class="field-p">
        <label>Account Locked Out</label>
        <div><?php if($details['account_locked_out'] > '0'){ echo $details['account_locked_out']; }?> </div>
      </div> 
    <div class="field-p">
        <label>Account Locked Out Period</label>
        <div><?php if($details['account_locked_out_period'] > '0'){ echo $details['account_locked_out_period'].' Minutes'; } ?> </div>
    </div>
                                        
    </div>                  
  </fieldset>
</div>

</section>

  </form>
</section>


<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>