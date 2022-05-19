<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
$details=$data['details'];
?>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">DRIVER <?php echo $details['code'].' '.$details['name']; ?></div>
  <section class="lg-form" style="text-align:right;">
  <?php
  if (in_array('P0010', USER_PRIV)) {
  ?>
    <button class='btn_blue' onclick="location.href='../user/masters/drivers/update?eid=<?php echo $_GET['eid']; ?>&page='">Edit Driver</button>
  <?php
  }
  ?>
  </section>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">
    <section class="section-111">
<div></div>
<div>
      <fieldset>
        <legend>Status</legend>
        <div class="field-section single-column">
        <div class="field-p">
          <label>Status</label>
          <div><?php echo $details['status']; ?></div>
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
          <label>Driver ID</label>
         <div><?php echo $details['code']; ?></div>
        </div>
        <div class="field-p">
          <label>Name</label>
          <div><?php echo $details['prefix'].' '.$details['name']; ?></div>
        </div>
        <div class="field-p">
          <label>Date of Birth</label>
          <div><?php echo $details['dob']; ?></div>
        </div>       
        </div>                  
      </fieldset>
      <fieldset>
        <legend>Contact Information</legend>
        <div class="field-section single-column">
        <div class="field-p">
          <label>Mobile No.</label>
          <div><?php echo $details['mobile_number_display']; ?></div>
        </div>
       
        <div class="field-p">
          <label>Email iD</label>
          <div><?php echo $details['email']; ?></div>
        </div>
                      
        </div>                  
      </fieldset>

  <fieldset>
        <legend>Present Address</legend>
        <div class="field-section single-column">
                  <div class="field-p">
          <label>Address Line</label>
          <div><?php echo $details['address_line']; ?></div>
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
</div>
<div>
    <fieldset>
    <legend>------</legend>
    <div class="field-section single-column">
        <div class="field-p">
        <label>Company Name</label>
        <div><?php echo $details['company']; ?></div>
      </div>
    <div class="field-p">
        <label>Joining Date</label>
        <div><?php echo $details['date_of_joining']; ?></div>
      </div>
      <div class="field-p">
        <label>Route Type</label>
        <div><?php echo $details['route_type']; ?></div>
      </div>        
      <div class="field-p">
        <label>CDL No.</label>
        <div><?php echo $details['cdl_number']; ?></div>
      </div>                               
      <div class="field-p">
        <label>CDL State</label>
       <div><?php echo $details['cdl_state']; ?></div>
      </div>                               
      <div class="field-p">
        <label>CDL Issue Date</label>
        <div><?php echo $details['cdl_issue_date']; ?></div>
      </div>        
      <div class="field-p">
        <label>CDL Expiry Date</label>
        <div><?php echo $details['cdl_expiry_date']; ?></div>
      </div>
    <div class="field-p">
        <label>SSN No.</label>
       <div><?php echo $details['ssn_number_enc']; ?></div>
    </div>
    <div class="field-p">
        <label>Residency</label>
        <div><?php echo $details['residency_type']; ?></div>
    </div>
          <div class="field-p">
        <label>Residency Expiry Date</label>
        <div><?php echo $details['residency_expiry_date']; ?></div>
      </div>
          <div class="field-p">
        <label>Medical Issue Date</label>
        <div><?php echo $details['medical_issue_date']; ?></div>
      </div>        
      <div class="field-p">
        <label>Medical Expiry Date</label>
       <div><?php echo $details['medical_expiry_date']; ?></div>
      </div>
    <div class="field-p">
        <label>GFR</label>
        <div><?php echo $details['gfr']; ?></div>
      </div>
    <div class="field-p">
        <label>EPN Enroll</label>
        <div><?php echo $details['epn_enroll_status']; ?></div>
    </div>

    </div>                  
  </fieldset>
</div>

<div>
  <fieldset>
    <legend>Followups / Technical Details</legend>
    <div class="field-section">        
      <div class="field-p">
        <label>Last Annual Review Date</label>
        <div><?php echo $details['last_annual_review_date']; ?></div>
      </div>
      <div class="field-p">
        <label>Next Annual Review Date</label>
        <div><?php echo $details['next_annual_review_date']; ?></div>
      </div>       
        <div class="field-p">
        <label>Truck Assigned</label>
        <div><?php echo $details['truck_code']; ?></div>
      </div> 
    <div class="field-p">
        <label>Insurance Added</label>
        <div><?php echo $details['insurance_added_status']; ?></div>
    </div>
        <div class="field-p">
        <label>Group</label>
        <div><?php echo $details['group']; ?></div>
    </div> 
    <div class="field-p">
              <label>Driver Type</label>
              <div id="match28"><?php echo $details['driver_type_name']; ?></div>
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