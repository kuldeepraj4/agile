<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details'];
?>
<section class="profile-ms-outer">
  <div class="profile-ms-header">TRUCK ID <?php echo $details['code']; ?></div>
  <section class="lg-form" style="text-align:right;">
  <?php
  if (in_array('P0020', USER_PRIV)) {
  ?>
    <button class='btn_blue' onclick="location.href='../user/masters/trucks/update?eid=<?php echo $_GET['eid']; ?>&page='">Edit Truck</button>
  <?php
  }
  ?>
  </section>
  <div class="profile-ms">
    <section class="profile-ms-section-3">

<div></div>
<div>
      <fieldset>
        <legend>Status</legend>
        <div class="field-section">
        <div class="field">
          <label>Status</label>
          <div><?php echo $details['status']; ?></div>
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
          <div><?php echo $details['code']; ?></div>
        </div>
        <div class="field">
          <label>Equipment group</label>
          <div><?php echo $details['group']; ?></div>
        </div>
        <div class="field">
          <label>Company</label>
          <div><?php echo $details['company']; ?></div>
        </div>
        <div class="field">
          <label>Make Year</label>
          <div><?php echo $details['make_year']; ?></div>
        </div>
        <div class="field">
          <label>Make</label>
          <div><?php echo $details['make']; ?></div>
        </div>
        <div class="field">
          <label>Model</label>
          <div><?php echo $details['model']; ?></div>
        </div>
        <div class="field">
          <label>Color</label>
          <div><?php echo $details['color']; ?></div>
        </div>
        <div class="field">
          <label>VIN</label>
         <div><?php echo $details['vin']; ?></div>
        </div>
        <div class="field">
          <label>Licence tag no.</label>
          <div><?php echo $details['licence_tag_no']; ?></div>
        </div>
                <div class="field">
          <label>Licence tag Expiry</label>
          <div><?php echo $details['licence_tag_expiry_date']; ?></div>
        </div>
        <div class="field">
          <label>State</label>
          <div><?php echo $details['licence_state']; ?></div>
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
          <div><?php echo $details['insurance_status']; ?></div>
        </div>

        <div class="field">
          <label>Insurance carrier</label>
          <div><?php echo $details['insurance_company_name']; ?></div>
        </div>        
        <div class="field">
          <label>Insurance start date</label>
          <div><?php echo $details['insurance_start_date']; ?></div>
        </div>
        <div class="field">
          <label>Insurance expiry date</label>
          <div><?php echo $details['insurance_expiry_date']; ?></div>
        </div>        
        <div class="field">
          <label>Liability</label>
          <div><?php echo $details['liability_status']; ?></div>
        </div>
        <div class="field">
          <label>Cargo</label>
          <div><?php echo $details['cargo_status']; ?></div>
        </div>        
        <div class="field">
          <label>P/D value</label>
          <div><?php echo $details['pd_value']; ?></div>
        </div>        
        <div class="field">
          <label>Loss pay info</label>
          <div><?php echo $details['loss_pay_info']; ?></div>
        </div>        
        <div class="field">
          <label>P/D value new</label>
          <div><?php echo $details['new_pd_value']; ?></div>
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
         <div><?php echo $details['fhvut_status']; ?></div>
        </div>        
        <div class="field">
          <label>Paid date</label>
          <div><?php echo $details['fhvut_paid_date']; ?></div>
        </div>
        <div class="field">
          <label>Oregon permit issue</label>
          <div><?php echo $details['oregon_permit_status']; ?></div>
        </div>
        <div class="field">
          <label>Family engine no.</label>
          <div><?php echo $details['family_engine_number']; ?></div>
        </div>        
        <div class="field">
          <label>IFTA</label>
          <div><?php echo $details['ifta_status']; ?></div>
        </div>
        <div class="field">
          <label>PIFTA</label>
          <div><?php echo $details['pifta_status']; ?></div>
        </div>
        <div class="field">
          <label>NM permit</label>
            <div><?php echo $details['nm_status']; ?></div>
        </div>        
        
        <div class="field">
          <label>Pre pass</label>
          <div><?php echo $details['pre_pass']; ?></div>
        </div>        
        <div class="field">
          <label>Pre pass remark</label>
          <div><?php echo $details['pre_pass_remark']; ?></div>
        </div>
      <div class="field">
        <label>HUT</label>
        <div><?php echo $details['hut']; ?></div>
      </div>
      <div class="field">
        <label>HUT remarks</label>
        <div><?php echo $details['hut_remark']; ?></div>
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
        <div><?php echo $details['ownership_type']; ?></div>
      </div>        
      <div class="field">
        <label>Lease Ref no</label>
        <div><?php echo $details['lease_ref_no']; ?></div>
      </div>                               
      <div class="field">
        <label>Leasing company</label>
        <div><?php echo $details['lease_company']; ?></div>
      </div>        
      <div class="field">
        <label>Leasing expiry</label>
        <div><?php echo $details['lease_expiry_date']; ?></div>
      </div>                               
    </div>                  
  </fieldset>
</div>


<div>
  <fieldset>
    <legend>---</legend>
    <div class="field-section">   
    <div class="field">
        <label>Truck type</label>
        <?php echo $details['truck_type']; ?>
      </div>       
      <div class="field">
        <label>Device type</label>
        <div><?php echo $details['device_company_name']; ?></div>
      </div>
      <div class="field">
        <label>Gateway serial no.</label>
        <div><?php echo $details['device_serial_no']; ?></div>
      </div>       
      <div class="field">
        <label>Dash cam no</label>
        <div><?php echo $details['device_dash_cam_no']; ?></div>
      </div>
        <div class="field">
        <label>Halo no.</label>
        <div><?php echo $details['halo']; ?></div>
      </div>                                
    </div>                  
  </fieldset>
</div>
<div>
  <fieldset>
    <legend>IOT Devices</legend>
    <div class="field-section">
      <div class="field">
        <label>Odometer update type</label>
        <div><?php echo $details['odometer_update_type']; ?></div>
      </div>
       <div class="field">
        <label>Engine Hours Update Type</label>
        <div><?php echo $details['engine_hours_update_type']; ?></div>
      </div>                                      
    </div>                  
  </fieldset>
</div>

<div>

</div>
    </section>
    <section class="action-button-box">
       <div style="text-align:center;">
        <button type="button" class="btn_green" onclick="back_alert()">BACK</button>
      </div>
    </section>
  </div>
</section>

<script type='text/javascript'>
  function back_alert() {
      window.history.back();
  }
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>