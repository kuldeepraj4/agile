<?php

require_once APPROOT . '/views/includes/user/header.php';

$details = $data['details'];

/*echo "<pre>";
print_r($details);
echo "</pre>"; */

?>

<br><br>

<section class="lg-form-outer">

  <div class="lg-form-header">Update Work Order - <?php echo $details['id']; ?></div>
  <section class="lg-form" style="text-align:right;">
    <button class='btn_blue' onclick="location.href='../user/maintenance/work-orders/details?eid=<?php echo $_GET['eid']; ?>'">View Work Order</button>
  </section>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">


    <section class="section-111">

    </section>

    <section class="section-111" style="max-width: 1200px">

      <div>

        <fieldset>

          <legend>Repair Order Details</legend>

          <div class="field-section single-column">

            <div class="field-p">

              <label>ID</label>

              <div><?php echo $details['repair_order_id']; ?></div>

            </div>

            <div class="field-p">

              <label>Unit</label>

              <div><?php echo $details['vehicle_type']; ?></div>

            </div>

            <div class="field-p">

              <label>Unit ID</label>

              <div><?php echo $details['vehicle_code']; ?></div>

            </div>

            <div class="field-p">

              <label>VIN No</label>

              <div><?php echo $details['vehicle_vin_number']; ?></div>

            </div>

            <div class="field-p">

              <label>Date</label>

              <input name="date" type="text" value="<?php echo $details['date'] ?>" data-date-picker required>

            </div>

          </div>

        </fieldset>

        <fieldset>

          <legend>Other Information</legend>

          <div class="field-section single-column">

            <div class="field-p">

              <label>Odometer Reading</label>

              <input name="odometer_reading" type="text" value="<?php echo $details['odometer_reading'] ?>" required>

            </div>

            <div class="field-p">

              <label>Engine Hours</label>

              <input name="engine_hours" type="text" value="<?php echo $details['engine_hours'] ?>" required>

            </div>

            <div class="field-p">

              <label>Technician Comments</label>

              <textarea name="technician_comments" style="height: 80px"><?php echo $details['technician_comments'] ?></textarea>

            </div>

          </div>

        </fieldset>

      </div>

      <div>

        <fieldset>

          <legend> Repaired At / By </legend>

          <div class="field-section single-column">
            <div class="field-p">
              <label>Is at Yard ?</label>
              <input type="checkbox" name="is_at_yard" <?php if ($details['is_at_yard'] == 'YES') {
                echo "checked";
              } ?> data-chage-required-field>
            </div>
            <div class="field-p">
              <label>Is by Driver ?</label>
              <input type="checkbox" name="is_by_driver" <?php if ($details['is_by_driver'] == 'YES') {
                echo "checked";
              } ?> data-chage-required-field>
            </div>

            <div class="field-p">
              <label>Is on Leasing ?</label>
              <input type="checkbox" name="is_on_lease" <?php if ($details['is_on_lease'] == 'YES') {
                echo "checked";
              } ?> data-chage-required-field>
            </div>
            <div class="field-p">
              <label>Is At Vendor ?</label>
              <input type="checkbox" name="is_at_vendor" data-chage-required-field>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend> Yard Details </legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Yard Name</label>
              <select class="removereq mode10" name="yard_id" type="text" data-default-select="<?php echo $details['yard_id'] ?>" style="text-overflow: ellipsis;overflow: hidden !important;max-width: 250px" required data-optional></select>
            </div>
          </fieldset>
          <fieldset>
            <legend> Vendor Details </legend>
            <div class="field-section single-column">
              <div class="field-p">
                <label>Vendor Name</label>
                <select class="removereq mode11" name="vendor_id" type="text" data-default-select="<?php echo $details['vendor_id'] ?>" style="text-overflow: ellipsis;overflow: hidden !important;max-width: 250px" required data-optional></select>
              </div>

              <div class="field-p">
                <label>Vendor State</label>
                <select class="removereq mode12" name="vendor_state_id" id="vendor_state_id" type="text" data-default-select="<?php echo $details['vendor_state_id'] ?>" onchange="show_cities({state_id:this.value})" required data-optional></select>
              </div>

              <div class="field-p">
                <label>Vendor City</label>
                <select class="removereq mode13" name="vendor_city_id" type="text" required data-default-select="<?php echo $details['vendor_city_id'] ?>" data-optional></select>
              </div>
            </div>

          </fieldset>
          <fieldset>
            <legend> Contact Details  </legend>
            <div class="field-section single-column">
              <div class="field-p">
                <label>Contact Person</label>
                <input name="vendor_contact_person" type="text" required value="<?php echo $details['vendor_contact_person'] ?>" data-optional>
              </div>

              <div class="field-p">
                <label>Contact No</label>
                <input name="vendor_contact_no" type="text" required value="<?php echo $details['vendor_contact_number'] ?>" data-optional pattern="[0-9][0-9]{9}" placeholder="1234567890">
              </div>

              <div class="field-p">
                <label>Email ID</label>
                <input name="vendor_email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo $details['vendor_email'] ?>">
              </div>

            </div>

          </fieldset>

        </div>

        <div>

          <fieldset>

            <legend> Billing Details </legend>

            <div class="field-section single-column">

              <div class="field-p">

                <label>Payment Status</label>

                <select id="mySelect" class="mode0 unpaid" name="payment_status" required data-default-select="<?php  echo $details['payment_status'] ?>" data-optional>

                  <option value=""> - - Select - -</option>

                  <option value="PAID">Paid</option>

                  <option value="UNPAID">Unpaid</option>

                </select>

              </div>

              <div class="field-p">

                <label>Payment Mode</label>

                <select class="removereq mode1" name="payment_mode_id" id="payment_mode_id" type="text" required data-default-select="<?php echo $details['payment_mode_id'] ?>"></select>

              </div>

              <div class="field-p">

                <label>Payment Ref No</label>

                <input class="removereq mode2" name="payment_ref_no" type="text" required value="<?php echo $details['payment_ref_no'] ?>">

              </div>

              <div class="field-p">

                <label>Invoice No</label>

                <input class="inv_no" name="invoice_no" class="mode4" type="text" required value="<?php echo $details['invoice_no'] ?>" data-optional>

              </div>

              <div class="field-p">

                <label>Date Paid</label>

                <input class="removereq mode3" name="payment_date" type="text" data-date-picker="" required value="<?php echo $details['payment_date'] ?>">

              </div>

              <div class="field-p">

                <label>Payment Notes</label>

                <textarea name="payment_remarks" class="mode5" style="height: 80px"><?php echo $details['payment_remarks'] ?></textarea>

              </div>

            </div>

          </fieldset>

<!--</div>

  <div> -->
    <fieldset>
      <legend> Approval Status</legend>
      <div class="field-section single-column">
        <div class="field-p">
          <label>Approval Status</label>
          <input name="approval_status_id" type="text" disabled value="<?php  echo $details['approval_status'] ?>">
        </div>
      </div>
      <div class="field-section single-column">
        <div class="field-p">
          <label>Remarks</label>
          <label name="approval_status_remarks" type="label"><?php  echo $details['approval_remarks'] ?></label>
        </div>
      </div>  


      <div class="field-p">
        <label>WO Remarks</label>
        <textarea name="wo_remarks" style="height: 40px"><?php  echo $details['remarks'] ?></textarea>
      </div>

    </fieldset>
    <!-- </div> -->

  </section>

  <section class="section-1" style="width:100%;overflow:auto;">

    <div>

      <fieldset>

        <legend>Job Work List</legend>

        <div class="field-section table-rows">

          <table style="width: 100%">

            <thead>

              <tr>

                <th>Sr. No.</th>

                <th>Type</th>

                <th>Job Work</th>

                <th>Description</th>

                <th>No Charge</th>

                <th>Warranty</th>

                <th>Warranty Period</th>

                <th>Quantity</th>

                <th>Rate</th>

                <th>Amount</th>

              </tr>

            </thead>

            <tbody id="issue_table">

            </tbody>

            <tfoot>

              <tr>
                <td colspan="8"><button type="button" class="btn_blue" onclick="add_row({})">Add Row</button></td>

                <td>Total</td>

                <td><input type="text" style="width: 100px" min="0" data-total-amount disabled></td>

              </tr>

            </tfoot>

          </table>

        </div>

      </fieldset>

    </div>

  </section>

  <section class="action-button-box">

    <?php 
    echo '<button type="submit" class="btn_green">SAVE</button>';
    ?>
    <button type="button" class="btn_green" onclick="back_alert()" style="margin-left: 10px;">BACK</button>

  </section>

</form>

</section>

<script type='text/javascript'>
 $(document).ready(function() {
    var is_at_yard = '<?php echo $details['is_at_yard']; ?>';
    var is_by_driver = '<?php echo $details['is_by_driver']; ?>';
    var is_on_lease = '<?php echo $details['is_on_lease']; ?>';
    var vendor_id = '<?php echo $details['vendor_id']; ?>';
    if(is_at_yard=="YES"){
      $(".removereq").prop('required', false)
      $('.mode11').prop('selectedIndex',0).prop('disabled', true);
      $('.mode12').prop('disabled', true);
      $('.mode13').prop('disabled', true);
      $('.mode10').prop('disabled', false);
      $('[name="is_at_yard"]').prop('disabled', false).prop('checked', true)
      $('[name="is_by_driver"],[name="is_on_lease"],[name="is_at_vendor"]').prop('disabled', true).prop('checked', false)
    }else if(is_by_driver=="YES") {
        $(".removereq").prop('required', false)
        $('.mode11').val('').prop('disabled', true);
        $('.mode12').val('').prop('disabled', true);
        $('.mode13').val('').prop('disabled', true);
        $('.mode10').val('').prop('disabled', false);
        $('[name="is_by_driver"]').prop('disabled', false).prop('checked', true)
        $('[name="is_at_yard"],[name="is_on_lease"],[name="is_at_vendor"]').prop('disabled', true).prop('checked', false)
        $('[name="yard_id"]').prop('disabled', true);
    } else if(vendor_id) {
        $(".removereq").prop('required', false)
        $('.mode11').prop('disabled', false);
        $('.mode12').prop('disabled', false);
        $('.mode13').prop('disabled', false);
        $('.mode10').prop('disabled', true);
        $('[name="is_at_vendor"]').prop('disabled', false).prop('checked', true)
        $('[name="is_by_driver"],[name="is_on_lease"],[name="is_at_yard"]').prop('disabled', true).prop('checked', false)
    } else {
       $(".removereq").prop('required', false)
       $('.mode11').prop('selectedIndex',0).prop('disabled', true);
       $('.mode12').prop('disabled', true);
       $('.mode13').prop('disabled', true);
       $('.mode10').prop('disabled', true);
       $('[name="is_on_lease"]').prop('disabled', false).prop('checked', true)
       $('[name="is_by_driver"],[name="is_at_vendor"],[name="is_at_yard"]').prop('disabled', true).prop('checked', false)
     }

  })
  $(document.body).on('click', '[name="is_at_yard"]', function() {
    if ($(this).prop("checked") == true) {
      $('[name="is_by_driver"],[name="is_on_lease"],[name="is_at_vendor"]').prop('disabled', true).prop('checked', false)
      $('.mode10').prop('disabled', false);
      $('.mode11').prop('disabled', true);
      $('.mode12').prop('disabled', true);
      $('.mode13').prop('disabled', true);
    }else{
      $('[name="is_by_driver"],[name="is_on_lease"],[name="is_at_vendor"]').prop('disabled', false)
      $('.mode10').prop('disabled', true);
      $('.mode11').prop('disabled', true);
      $('.mode12').prop('disabled', true);
      $('.mode13').prop('disabled', true);
    }
  })

  $(document.body).on('click', '[name="is_by_driver"]', function() {
    if ($(this).prop("checked") == true) {
      $('[name="is_at_yard"],[name="is_on_lease"],[name="is_at_vendor"]').prop('disabled', true).prop('checked', false)
      $('.mode10').prop('disabled', true);
      $('.mode11').prop('disabled', true);
      $('.mode12').prop('disabled', true);
      $('.mode13').prop('disabled', true);
    }else{
      $('[name="is_at_yard"],[name="is_on_lease"],[name="is_at_vendor"]').prop('disabled', false)
      $('.mode11').prop('disabled', true);
      $('.mode12').prop('disabled', true);
      $('.mode13').prop('disabled', true);
    }
  })

  $(document.body).on('click', '[name="is_on_lease"]', function() {
    if ($(this).prop("checked") == true) {
      $('[name="is_by_driver"],[name="is_at_yard"],[name="is_at_vendor"]').prop('disabled', true).prop('checked', false)
      $('.mode10').prop('disabled', true);
      $('.mode11').prop('disabled', true);
      $('.mode12').prop('disabled', true);
      $('.mode13').prop('disabled', true);
    }else{
      $('[name="is_by_driver"],[name="is_at_yard"],[name="is_at_vendor"]').prop('disabled', false)
      $('.mode11').prop('disabled', true);
      $('.mode12').prop('disabled', true);
      $('.mode13').prop('disabled', true);
    }
  })


  $(document.body).on('click', '[name="is_at_vendor"]', function(){
    if ($(this).prop("checked") == true) {
      $('[name="is_by_driver"],[name="is_on_lease"],[name="is_at_yard"]').prop('disabled', true).prop('checked', false)
      $('.mode10').prop('disabled', true);
      $('.mode11').prop('disabled', false);
      $('.mode12').prop('disabled', false);
      $('.mode13').prop('disabled', false);
    }else{
      $('[name="is_by_driver"],[name="is_on_lease"],[name="is_at_yard"]').prop('disabled', false)
      $('.mode10').prop('disabled', true);
      $('.mode11').prop('disabled', true);
      $('.mode12').prop('disabled', true);
      $('.mode13').prop('disabled', true);
    }
  })

  //RANJIT DISABLE CHECKBOX SYSTEM TWO VARIABLE PASS
  /*$(document.body).on('click', '[name="is_at_yard"]', function() {
    if ($(this).prop("checked") == true) {
      $('[name="is_by_driver"],[name="is_on_lease"]').prop('disabled', true).prop('checked', false)
    }else{
      $('[name="is_by_driver"],[name="is_on_lease"]').prop('disabled', false)
    }

  })

  $(document.body).on('click', '[name="is_by_driver"]', function() {
    if ($(this).prop("checked") == true) {
      $('[name="is_at_yard"],[name="is_on_lease"]').prop('disabled', true).prop('checked', false)
    }else{
      $('[name="is_at_yard"],[name="is_on_lease"]').prop('disabled', false)
    }

  })

  $(document.body).on('click', '[name="is_on_lease"]', function() {
    if ($(this).prop("checked") == true) {
      $('[name="is_by_driver"],[name="is_at_yard"]').prop('disabled', true).prop('checked', false)
    }else{
      $('[name="is_by_driver"],[name="is_at_yard"]').prop('disabled', false)
    }

  })*/
  
  function back_alert() {
    if (confirm('Are you Sure ?')) {
      window.history.back();
    }
  }
</script>
<script type="text/javascript">
  $(document.body).on('change', '[name="job_work_type_id"]', function() {
    var txt = $(this).find('option:selected').text()
    if ($(this).val() == 6 || $(this).val() == 8 || $(this).val() == 9 || $(this).val() == 10 || txt == "Tax" || txt == "Sublet" || txt == "Miscellaneous Charges" || txt == "Miscellaneous  Supplies ") {
      //$(this).parent().nextAll().children().prop('disabled', true).prop('required', false)
      $(this).parent().siblings().find('[name="job_work_id"]').prop('disabled', true).prop('selectedIndex', 0)
      $(this).parent().siblings().find('[name="description"]').prop('disabled', true).val("")
      $(this).parent().siblings().find('[name="is_no_charge"]').prop('disabled', true).prop('checked', false)
      $(this).parent().siblings().find('[name="warranty_type"]').prop('disabled', true).prop('selectedIndex', 0)
      $(this).parent().siblings().find('[name="warranty_period"]').prop('disabled', true).val("0")
      $(this).parent().siblings().find('[name="job_work_id"]').prop('required', false)
      $(this).parent().siblings().find('[name="description"]').prop('required', false)
      $(this).parent().siblings().find('[name="warranty_type"]').prop('required', false)
      $(this).parent().siblings().find('[name="warranty_period"]').prop('required', false)
      $(this).parent().siblings().find('[name="rate"]').prop('required', true)
      // $(this).parent().siblings().find('[name="quantity"]').val("1")
      // $(this).parent().siblings().find('[name="rate"]').val("0")
      cal_total_amount()
    } else {
      $(this).parent().nextAll().children().prop('disabled', false)
      $(this).parent().siblings().find('[name="job_work_id"]').prop('required', true)
      $(this).parent().siblings().find('[name="description"]').prop('required', true)
      $(this).parent().siblings().find('[name="warranty_type"]').prop('required', true)
      $(this).parent().siblings().find('[name="warranty_period"]').prop('required', true)
      //$(this).parent().siblings().find('[name="quantity"]').prop('required', true)
      // $(this).parent().siblings().find('[name="rate"]').prop('required', true)
      cal_total_amount()
    }
  })
</script>

<script type="text/javascript">
  var val_2 ="<?php echo $details['payment_status']; ?>"
  //var check = false;
  $(document).ready(function() {
    $('[data-chage-required-field]').each(function(e) {
      if ($(this).prop("checked") == true) {
        $('[data-optional]').prop('required', false)
        // check = true;
      } else {
        if (val_2 === "UNPAID") {
          $(".inv_no").prop('required', false)
          $(".removereq").prop('required', false)
        } else if (val_2 === "PAID") {
          $(".removereq").prop('required', true)
        }
      }
    })
  })
</script>
<script type="text/javascript">
  $('[data-chage-required-field]').on('change', function() {
    //---set all targate field as required
    $('[data-optional]').prop('required', true)
    //check = false;
    //----if any of the selector is true make all targated fields as not required
    $('[data-chage-required-field]').each(function(e) {
      if ($(this).prop("checked") == true) {
        $('[data-optional]').prop('required', false)
        // check = true;
      } else {
        var val = $('#mySelect').val();
        if (val === "UNPAID") {
          $(".inv_no").prop('required', false)
          $(".removereq").prop('required', false)
        } else if (val === "PAID") {
          $(".removereq").prop('required', true)
        }
      }
    })
  })
</script>


<script type="text/javascript">
  var a = "<?php echo $details['approval_status']; ?>"
  if(a === "RFC" || a === "APPROVED"){
    $(".unpaid").prop('disabled', true)
   // $(".removereq").val('').prop('required', false)
 }else if(a === ""){
    //$(".removereq").prop('disabled', true)
   // $(".removereq").val('').prop('required', false)
 }
</script>


<script type="text/javascript">
  var a = "<?php echo $details['payment_status']; ?>"
  if (a === "UNPAID") {
    $(".removereq").prop('disabled', true)
    $(".removereq").val('').prop('required', false)
  } else if (a === "") {
    $(".removereq").prop('disabled', true)
    $(".removereq").val('').prop('required', false)
  }
</script>
<!-- code added by swaran -->
<script type="text/javascript">
  //$('.chkbox[type="checkbox"]').click(function(){
    $(document.body).on('click', '.chkbox', function() {
      if ($(this).is(":checked")) {
      // $(".removerate").removeAttr('required')
      // $(this).parent().next().next().next().next().children().removeAttr('required')
      $(this).parent().next().next().next().next().children().prop('required', false)
      // $(this).parent().next().next().next().next().children().val('0')
      //console.log("Checkbox is checked.");s
    } else if ($(this).is(":not(:checked)")) {
      // $(".removerate").attr('required', 'required')
      //$(this).parent().next().next().next().next().children().attr('required', 'required')
      $(this).parent().next().next().next().next().children().prop('required', true)
      //console.log("Checkbox is unchecked.");
    }
  });
</script>

<script type="text/javascript">
  $(document.body).on('change', '#mySelect', function() {
    var value = $(this).val();
    //if(!check){
      if (value === "UNPAID") {
      //console.log(check)
      $(".inv_no").prop('required', false)
      $(".removereq").prop('required', false)
      $('.mode1').prop('selectedIndex', 0).prop('disabled', true);
      $('.mode2').val('').prop('disabled', true);
      $('.mode3').val('').prop('disabled', true);
    } else if (value === "PAID") {
      $(".inv_no").prop('required', true)
      $(".removereq").prop('required', true)
      $(".removereq").prop('disabled', false)
    } else if (value === "") {
      $(".removereq").prop('required', false)
      $('.mode1').prop('selectedIndex', 0).prop('disabled', true);
      $('.mode2').val('').prop('disabled', true);
      $('.mode3').val('').prop('disabled', true);
      // $('.mode4').val('').attr('disabled', 'disabled');
      // $('.mode5').val('').attr('disabled', 'disabled');
    }
    $('[data-chage-required-field]').each(function(e) {
      if ($(this).prop("checked") == true) {
        $('[data-optional]').prop('required', false)
      }
    })
    //}
  });
</script>
<!-- code added by swaran end here -->


<script type="text/javascript">
  function save() {
    show_processing_modal()
    submit_to_wait_btn('#submit', 'loading')

    $('#formErro').show()

    var form = document.getElementById('MyForm');

    var isValidForm = form.checkValidity();

    var currentForm = $('#MyForm')[0];

    var formData = new FormData(currentForm);

    if (isValidForm) {

      var arr = $('#MyForm').serializeArray();

      var $job_work_rows = $("[data-job-work-row]");

      job_works_array = []

      $job_work_rows.each(function(index)

      {

        var $job_work_row = $(this);

        var job_work_row =

        {

          job_work_type_id: $job_work_row.find('[name="job_work_type_id"]').val(),

          job_work_id: $job_work_row.find('[name="job_work_id"]').val(),

          description: $job_work_row.find('[name="description"]').val(),

          is_no_charge: $job_work_row.find('[name="is_no_charge"]').prop("checked"),

          warranty_type: $job_work_row.find('[name="warranty_type"]').val(),

          warranty_period: $job_work_row.find('[name="warranty_period"]').val(),

          quantity: $job_work_row.find('[name="quantity"]').val(),

          rate: $job_work_row.find('[name="rate"]').val()

        }

        job_works_array.push(job_work_row)

      })

      var obj = {
        update_eid: '<?php echo $details['eid']; ?>',

        repair_order_id: '<?php echo $details['repair_order_id']; ?>',

        date: $('[name="date"]').val(),

        odometer_reading: $('[name="odometer_reading"]').val(),
        engine_hours: $('[name="engine_hours"]').val(),

        technician_comments: $('[name="technician_comments"]').val(),
        is_at_yard: $("[name='is_at_yard']").prop("checked") ? 'YES' : 'NO',
        is_by_driver: $("[name='is_by_driver']").prop("checked") ? 'YES' : 'NO',
        is_on_lease: $("[name='is_on_lease']").prop("checked") ? 'YES' : 'NO',
        is_at_vendor: $("[name='is_at_vendor']").prop("checked") ? 'YES' : 'NO',
        yard_id: $('[name="yard_id"]').val(),
        vendor_id: $('[name="vendor_id"]').val(),

        vendor_state_id: $('[name="vendor_state_id"]').val(),

        vendor_city_id: $('[name="vendor_city_id"]').val(),

        vendor_contact_person: $('[name="vendor_contact_person"]').val(),

        vendor_contact_no: $('[name="vendor_contact_no"]').val(),

        vendor_email: $('[name="vendor_email"]').val(),

        payment_mode_id: $('[name="payment_mode_id"]').val(),

        payment_ref_no: $('[name="payment_ref_no"]').val(),

        invoice_no: $('[name="invoice_no"]').val(),

        payment_date: $('[name="payment_date"]').val(),

        payment_status: $('[name="payment_status"]').val(),

        payment_remarks: $('[name="payment_remarks"]').val(),

        approval_status:$('[name="approval_status_id"]').val(),

        wo_remarks:$('[name="wo_remarks"]').val(),

        job_works:JSON.stringify(job_works_array),

      }


      $.ajax({

        url: window.location.pathname + '-action',

        type: 'POST',

        data: obj,

        success: function(data) {
          if ((typeof data) == 'string') {

            data = JSON.parse(data)

          }

          alert(data.message);

          if (data.status) {

            window.history.back();

            wait_to_submit_btn('#submit', 'ADD')

          } else {
            wait_to_submit_btn('#submit', 'ADD')
          }
          hide_processing_modal()

        }

      })

    }

    return false

  }
</script>

<script type="text/javascript">
  var yard_status = {
    yard_status: 1
  }
  get_maintenace_yard(yard_status).then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="` + item.id + `">` + item.name + `</option>`;
        })
        $('[name="yard_id"]').html(options);
        select_default('[name="yard_id"]')
      }
    }
  })
</script>

<script type="text/javascript">
  var vendor_status = {
    vendor_status: 1
  }
  get_maintenace_vendors(vendor_status).then(function(data) {

    // Run this when your request was successful

    if (data.status) {

      //Run this if response has list

      if (data.response.list) {

        var options = "";

        options += `<option value="">- - Select - -</option>`

        $.each(data.response.list, function(index, item) {

          options += `<option value="` + item.id + `">` + item.name + `</option>`;

        })

        $('[name="vendor_id"]').html(options);

        select_default('[name="vendor_id"]')

      }

    }

  })
</script>

<script type="text/javascript">
  get_states().then(function(data) {

    // Run this when your request was successful

    if (data.status) {

      //Run this if response has list

      if (data.response.list) {

        var options = "";

        options += `<option value="">- - Select - -</option>`

        $.each(data.response.list, function(index, item) {

          options += `<option value="` + item.id + `">` + item.name + `</option>`;

        })

        $('[name="vendor_state_id"]').html(options);

        select_default('[name="vendor_state_id"]')

        show_cities({
          state_id: '<?php echo $details['vendor_state_id']; ?>'
        });

      }

    }

  })
</script>

<script type="text/javascript">
  function show_cities(param) {
    if (param.state_id === '') {
      $('[name="vendor_city_id"]').html('');
    } else if (param.state_id !== '') {
      get_cities(param).then(function(data) {

        // Run this when your request was successful

        if (data.status) {

          //Run this if response has list

          if (data.response.list) {

            var options = "";

            options += `<option value="">- - Select - -</option>`

            $.each(data.response.list, function(index, item) {

              options += `<option value="` + item.id + `">` + item.name + `</option>`;

            })

            $('[name="vendor_city_id"]').html(options);

            select_default('[name="vendor_city_id"]')

          }

        } else {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $('[name="vendor_city_id"]').html(options);
        }

      }).catch(function(err) {

        // Run this when promise was rejected via reject()

      })
    }
  }
</script>

<script type="text/javascript">
  quick_list_payment_modes().then(function(data) {

    // Run this when your request was successful

    if (data.status) {

      //Run this if response has list

      if (data.response.list) {

        var options = "";

        options += `<option value="">- - Select - -</option>`

        $.each(data.response.list, function(index, item) {

          options += `<option value="` + item.id + `">` + item.name + `</option>`;

        })

        $('[name="payment_mode_id"]').html(options);

        select_default('[name="payment_mode_id"]')

      }

    }

  })
</script>

<script type="text/javascript">
  var counter = 0

  var $issue_table = $('#issue_table');

  function add_row(param) {

    ++counter;

    if (param.hasOwnProperty('default_select_job_work_type_id')) {
      default_select_job_work_type_id = param.default_select_job_work_type_id
      if (default_select_job_work_type_id == 6 || default_select_job_work_type_id == 8 || default_select_job_work_type_id == 9 || default_select_job_work_type_id == 10) {
        var disabled = 'disabled';
        var required = '';
      } else {
        var disabled = '';
        var required = 'required';
      }
    } else {
      default_select_job_work_type_id = ''
    }

    if (param.hasOwnProperty('default_select_job_work_id')) {
      default_select_job_work_id = param.default_select_job_work_id
    } else {
      default_select_job_work_id = ''
    }

    if (param.hasOwnProperty('default_description')) {
      default_description = param.default_description
    } else {
      default_description = ''
    }

    if (param.hasOwnProperty('default_checked_is_no_charge')) {
      default_checked_is_no_charge = param.default_checked_is_no_charge
    } else {
      default_checked_is_no_charge = ''
    }
    checkbox = (default_checked_is_no_charge) ? 'checked' : '';

    if (param.hasOwnProperty('default_select_warranty_type')) {
      default_select_warranty_type = param.default_select_warranty_type
    } else {
      default_select_warranty_type = ''
    }

    if (param.hasOwnProperty('default_warranty_period')) {
      default_warranty_period = param.default_warranty_period
    } else {
      default_warranty_period = ''
    }

    if (param.hasOwnProperty('default_quantity')) {
      default_quantity = param.default_quantity
    } else {
      default_quantity = ''
    }

    if (param.hasOwnProperty('default_rate') && param.default_rate != 0) {
      default_rate = param.default_rate
    } else {
      default_rate = ''
    }

    var $add_rowissue = `<tr id="issue_row${counter}"  data-job-work-row>

    <td class="counter">${counter}</td>
    <td><select class="w-150" name="job_work_type_id" required></select></td>
    <td><select class="w-150" name="job_work_id" ${disabled} ${required}></select></td>
    <td><input class="w-150" name="description" value='${default_description}' type="text" ${required} ${disabled}></td>
    <td><input type="checkbox" class="chkbox" name="is_no_charge" ${checkbox} ${disabled}></td>
    <td><select class="w-150" name="warranty_type" data-default-select='${default_select_warranty_type}' ${required} ${disabled}>
    <option value="NONE" selected>None</option>
    <option value="DAYS">Days</option> 
    <option value="HOURS">Hours</option> 
    <option value="MILES">Miles</option> 
    </select>
    </td>
    <td><input style="width: 70px" name="warranty_period" class="zero" value='${(default_warranty_period) ? default_warranty_period : 0 }' type="number" step="any" ${required} ${disabled}></td>
    <td><input style="width: 70px" name="quantity" class="zero" value='${(default_quantity) ? default_quantity : 1 }' type="number" step="any" required onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>`;
    if(default_checked_is_no_charge){
      $add_rowissue+=`<td><input style="width: 80px" class="removerate" name="rate" value='${(default_rate)}' onkeyup="cal_total_amount()" type="number" step="any"></td>`;
    }else{
      $add_rowissue+=`<td><input style="width: 80px" class="removerate" name="rate" value='${(default_rate)}' onkeyup="cal_total_amount()" type="number" step="any" required ></td>`;
    }
    $add_rowissue+=`<td><input style="width: 100px" value='' name="amount" type="text" data-row-amount onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>`;
    if(counter > 1){
     $add_rowissue+=` <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>`;
   }


   $add_rowissue+=` </tr>`;

   $('#issue_table').append($add_rowissue);

   show_job_work_type({
    row_id: 'issue_row' + counter,
    default_select: default_select_job_work_type_id
  })

   show_job_work({
    row_id: 'issue_row' + counter,
    default_select: default_select_job_work_id
  })

   cal_total_amount()

 }

 $(document.body).on('click', '[data-remove-stop-button=""]', function() {

  $(this).parent().parent().remove();
    // for re-calculating total amount code by swaran
    var a = 0;
    var b = 0;
    $('[data-row-amount]').each(function(index, item) {
      b = $(this).val();
      a = eval(a) + eval(b);
    })
    $('[data-total-amount]').val(a)
    // for re-calculating total amount code by swaran ENDS HERE

    // for re-setting dynamic-counter code by swaran
    counter = 0;
    $('.counter').each(function(index, item) {
      counter = counter + 1;
      $(this).html(counter)
    })
  });

  // for re-setting dynamic-counter code by swaran ends here
</script>

<script type="text/javascript">
  function cal_total_amount() {

    $total_rows = $('[data-job-work-row]');

    let amount = 0;

    $total_rows.each(function(index, item) {

      qty = parseFloat($(this).find('[name="quantity"]').val());

      qty = isNaN(qty) ? 0 : qty;

      rate = parseFloat($(this).find('[name="rate"]').val());

      rate = isNaN(rate) ? 0 : rate;

      sub_amount = rate * qty;
      $(this).find('[name="amount"]').val(sub_amount.toFixed(4));
      amount += sub_amount
    })
    $('[data-total-amount]').val(amount.toFixed(4))

  }
</script>

<script type="text/javascript">
  function show_job_work_type(param) {

    get_job_work_type().then(function(data) {

      // Run this when your request was successful

      if (data.status) {

        //Run this if response has list

        if (data.response.list) {

          var options = "";

          options += `<option value="">- - Select - -</option>`

          $.each(data.response.list, function(index, item) {
            if(item.status == 'ACTIVE'){
              options += `<option value="` + item.id + `">` + item.name + `</option>`;
            }
          })

          $('tr#' + param.row_id + ' [name="job_work_type_id"]').html(options);

          if (param.hasOwnProperty('default_select')) {

            $('tr#' + param.row_id + ' [name="job_work_type_id"] option[value="' + param.default_select + '"]').prop('selected', true);

          }

        }

      }

    }).catch(function(err) {

      // Run this when promise was rejected via reject()

    })

  }

  show_job_work_type('issue_row1')
</script>

<script type="text/javascript">
  function show_job_work(param) {

    get_job_work().then(function(data) {

      // Run this when your request was successful

      if (data.status) {

        //Run this if response has list

        if (data.response.list) {

          var options = "";

          options += `<option value="">- - Select - -</option>`

          $.each(data.response.list, function(index, item) {

            if (item.status == "ACTIVE") {
              options += `<option value="` + item.id + `">` + item.name + `</option>`;
            }

          })

          $('tr#' + param.row_id + ' [name="job_work_id"]').html(options);

          if (param.hasOwnProperty('default_select')) {
            $('tr#' + param.row_id + ' [name="job_work_id"] option[value="' + param.default_select + '"]').prop('selected', true);
          }

        }

      }

    }).catch(function(err) {

      // Run this when promise was rejected via reject()

    })

  }

  show_job_work('issue_row1')
</script>

<script type="text/javascript">
  async function f() {
    var issue_list = '<?php echo json_encode($details['job_works_list']) ?>';
    issue_list = JSON.parse(issue_list)
    $.each(issue_list, function(index, item) {
      add_row({
        default_select_job_work_type_id: item.job_work_type_id,
        default_select_job_work_id: item.job_work_id,
        default_description: item.description,
        default_checked_is_no_charge: item.is_no_charge,
        default_select_warranty_type: item.warranty_type,
        default_warranty_period: item.warranty_period,
        default_quantity: item.quantity,
        default_rate: item.rate,
      })
    })
  }
  f()
</script>
<script type="text/javascript">
  $(document.body).on('change', '.zero', function() {
    if ($(this).val().trim().length === 0) {
      $(this).val(0);
    }
  })
</script>

<?php

require_once APPROOT . '/views/includes/user/footer.php';

?>