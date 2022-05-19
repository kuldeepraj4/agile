<?php
require_once APPROOT . '/views/includes/user/header.php';
$ro_details = $data['ro_details'];
// print_r($ro_details)
?>
<br>
<section class="lg-form-outer">
  <div class="lg-form-header">Create Work Order</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-111" style="max-width: 1200px">
      <div>
        <fieldset>
          <legend>Repair Order Details</legend>
          <div class="field-section single-column">

            <div class="field-p">
              <label>ID</label>
              <div><?php echo $ro_details['id']; ?></div>
            </div>
            <div class="field-p">
              <label>Unit</label>
              <div><?php echo $ro_details['vehicle_type']; ?></div>
            </div>
            <div class="field-p">
              <label>Unit ID</label>
              <div><?php echo $ro_details['vehicle_code']; ?></div>
            </div>
            <div class="field-p">
              <label>VIN No</label>
              <div><?php echo $ro_details['vehicle_vin_number']; ?></div>
            </div>
            <div class="field-p">
              <label>Date</label>
              <input name="date" type="text" data-date-picker required>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>Other Information</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Odometer Reading</label>
              <div><?php echo $ro_details['current_odometer_reading']; ?></div>
              <input name="odometer_reading" type="text" value="<?php echo $ro_details['current_odometer_reading'] ?>" required>
            </div>
            <div class="field-p">
              <label>Engine Hours</label>
              <div><?php echo $ro_details['current_engine_hours']; ?></div>
              <input name="engine_hours" type="text" value="<?php echo $ro_details['current_engine_hours'] ?>" required>
            </div>
            <div class="field-p">
              <label>Technician Comments</label>
              <textarea name="technician_comments" style="height: 80px"></textarea>
            </div>
          </div>
        </fieldset>
      </div>
      <div>
        <fieldset>
          <legend>Repaired At / By</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Is at Yard ?</label>
              <input type="checkbox" name="is_at_yard" data-chage-required-field>
            </div>
            <div class="field-p">
              <label>Is by Driver ?</label>
              <input type="checkbox" name="is_by_driver" data-chage-required-field>
            </div>

            <div class="field-p">
              <label>Is on Leasing ?</label>
              <input type="checkbox" name="is_on_lease" data-chage-required-field>
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
              <select class="removereq mode10" name="yard_id" id="yard_id" type="text" data-default-select="<?php echo $ro_details['ro_yard_id_fk'] ?>" style="text-overflow: ellipsis;overflow: hidden !important;max-width: 250px" required data-optional></select>
            </div>
          </div>
      </fieldset>
      <fieldset>
        <legend> Vendor Details </legend>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Vendor Name</label>
            <select class="removereq mode11" name="vendor_id" id="vendor_id" type="text" data-default-select="<?php echo $ro_details['ro_vendor_id_fk'] ?>" style="text-overflow: ellipsis;overflow: hidden !important;max-width: 250px" required data-optional></select>
          </div>
          <div class="field-p">
            <label>Vendor State</label>
            <select class="removereq mode12" name="vendor_state_id" id="vendor_state_id" type="text" data-default-select="<?php echo $ro_details['ro_vendor_state_id_fk'] ?>"  onchange="show_cities({state_id:this.value})" required data-optional></select>
          </div>
          <div class="field-p">
            <label>Vendor City</label>
            <select class="removereq mode13" name="vendor_city_id" id="vendor_city_id" type="text" data-default-select="<?php echo $ro_details['ro_vendor_city_id_fk'] ?>" required data-optional></select>
          </div>
        </div>
    </fieldset>

    <fieldset>
      <legend> Contact Details </legend>
      <div class="field-section single-column">
        <div class="field-p">
          <label>Contact Person</label>
          <input name="vendor_contact_person" type="text" required value="" data-optional>
        </div>
        <div class="field-p">
          <label>Contact No</label>
          <input name="vendor_contact_no" type="text" required value="" data-optional pattern="[0-9][0-9]{9}" placeholder="1234567890">
        </div>
        <div class="field-p">
          <label>Email ID</label>
          <input name="vendor_email_id" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" value="">
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
          <select id="mySelect" name="payment_status" required value="" data-optional>
            <option value=""> - - Select - -</option>
            <option value="PAID">Paid</option>
            <option selected value="UNPAID">Unpaid</option>
          </select>
        </div>
        <div class="field-p">
          <label>Payment Mode</label>
          <select class="removereq mode1" name="payment_mode_id" id="payment_mode_id" type="text" required data-optional></select>
        </div>
        <div class="field-p">
          <label>Payment Ref No</label>
          <input class="removereq mode2" name="payment_ref_no" type="text" required value="" data-optional>
        </div>
        <div class="field-p">
          <label>Invoice No</label>
          <input class="inv_no" name="invoice_no" type="text" required value="" data-optional>
        </div>
        <div class="field-p">
          <label>Date Paid</label>
          <input class="removereq mode3" name="payment_date" type="text" data-date-picker="" required value="" data-optional>
        </div>

        <div class="field-p">
          <label>Payment Notes</label>
          <textarea name="payment_remarks" style="height: 80px"></textarea>
        </div>
        <div class="field-p">
          <label>Invoice File</label>
          <input class="inv_no" type="file" id="invoice_file" name="" required data-optional>
        </div>

      </div>
    </fieldset>
  </div>
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
            <tr id="issue_row1" data-job-work-row>
              <td>1</td>
              <td><select class="w-150" name="job_work_type_id" required></select></td>
              <td><select class="w-150" name="job_work_id" required></select></td>
              <td><input class="w-150" name="description" type="text" required></td>
              <td><input type="checkbox" class="chk2" name="is_no_charge" id="checkbox1"></td>
              <td><select style="width: 100px" name="warranty_type" required>
                <option value="NONE" selected>None</option>
                <option value="DAYS">Days</option>
                <option value="HOURS">Hours</option>
                <option value="MILES">Miles</option>
              </select>
            </td>
            <td><input style="width: 70px" class="zero" name="warranty_period" type="number" step="any" value="0" required></td>
            <td><input style="width: 70px" class="zero" name="quantity" value="1" type="number" step="any" required onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>
            <td><input style="width: 80px" class="" value="" class="removerate" name="rate" type="number" step="any" required onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>
            <td><input style="width: 100px" value="0" value='' name="amount" type="text" data-row-amount onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>
            <td></td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="8"><button type="button" class="btn_blue" onclick="add_row()">Add Row</button></td>
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
  <button type="submit" class="btn_green">SAVE</button>
  &nbsp &nbsp<button type="button" class="btn_green" onclick="back_alert()">BACK</button>
</section>
</form>
</section>


<script type='text/javascript'>
  //RANJIT DISABLE CHECKBOX SYSTEM TWO VARIABLE PASS

  $(document).ready(function() {
    var ro_yard_id_fk = '<?php echo $ro_details['ro_yard_id_fk']; ?>';
    var driver_id = '<?php echo $ro_details['driver_id']; ?>';
    var ro_vendor_id_fk = '<?php echo $ro_details['ro_vendor_id_fk']; ?>';
    if(ro_yard_id_fk){
      $(".removereq").prop('required', false)
      $('.mode11').prop('selectedIndex',0).prop('disabled', true);
      $('.mode12').prop('disabled', true);
      $('.mode13').prop('disabled', true);
      $('.mode10').prop('disabled', false);
      $('[name="is_at_yard"]').prop('disabled', false).prop('checked', true)
      $('[name="is_by_driver"],[name="is_on_lease"],[name="is_at_vendor"]').prop('disabled', true).prop('checked', false)
    }/*else if(driver_id) {
        $(".removereq").prop('required', false)
        $('.mode11').val('').prop('disabled', true);
        $('.mode12').val('').prop('disabled', true);
        $('.mode13').val('').prop('disabled', true);
        $('.mode10').val('').prop('disabled', false);
        $('[name="is_by_driver"]').prop('disabled', false).prop('checked', true)
        $('[name="is_by_driver"],[name="is_on_lease"],[name="is_at_vendor"]').prop('disabled', true).prop('checked', false)
      } */
      else if(ro_vendor_id_fk) {
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
     }
   });

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


  $(document.body).on('click', '[name="is_at_vendor"]', function() {
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



  function back_alert() {
    if (confirm('Are you Sure ?')) {
      window.history.back();
    }
  }
</script>
<script type="text/javascript">
  $(document.body).on('change', '[name="job_work_type_id"]', function() {
    var txt=$(this).find('option:selected').text()
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
  $(document.body).on('click', '.chk2', function() {
    if ($(this).is(":checked")) {
      // $(".removerate").removeAttr('required')
      $(this).parent().next().next().next().next().children().prop('required', false)
      // $(this).parent().next().next().next().next().children().val('0')
    } else if ($(this).is(":not(:checked)")) {
      // $(".removerate").attr('required', 'required')
      $(this).parent().next().next().next().next().children().prop('required', true)
    }
  });
</script>



<script type="text/javascript">

 $(".removereq").prop('required', false)
 $('.mode1').prop('selectedIndex',0).prop('disabled', true);
 $('.mode2').val('').prop('disabled', true);
 $('.mode3').val('').prop('disabled', true);

 $(document.body).on('change', '#mySelect' ,function() {
  var value = $(this).val();
  if (value === "UNPAID") {
    $(".removereq").prop('required', false)
    $(".inv_no").prop('required', false)
    $('.mode1').prop('selectedIndex', 0).prop('disabled', true);
    $('.mode2').val('').prop('disabled', true);
    $('.mode3').val('').prop('disabled', true);
  } else if (value === "PAID") {
    $(".inv_no").prop('required', true)
    $(".removereq").prop('required', true)
    $(".removereq").prop('disabled', false)
  } else if (value === "") {
    $(".inv_no").prop('required', true)
    $(".removereq").prop('required', false)
    $('.mode1').prop('selectedIndex', 0).prop('disabled', true);
    $('.mode2').val('').prop('disabled', true);
    $('.mode3').val('').prop('disabled', true);
  }
  $('[data-chage-required-field]').each(function(e) {
    if ($(this).prop("checked") == true) {
      $('[data-optional]').prop('required', false)
    }
  })
});
</script>

<!-- code added by swaran end here -->
<script type="text/javascript">
  $('[data-chage-required-field]').on('change', function() {
    //---set all targate field as required
    $('[data-optional]').prop('required', true)
    //----if any of the selector is true make all targated fields as not required
    $('[data-chage-required-field]').each(function(e) {
      if ($(this).prop("checked") == true) {
        $('[data-optional]').prop('required', false)
      }else{
        pay_status()
      }
    })
  })
</script>
<script type="text/javascript">
  function pay_status(){
    var val = $('#mySelect').val();
    if (val === "UNPAID") {
      $(".inv_no").prop('required', false)
      $(".removereq").prop('required', false)
    }else if (val === "PAID") {
      $(".removereq").prop('required', true)
    }
  }
</script>


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
      property = '';
      if (document.getElementById('invoice_file').files.length != 0) {
        var property = document.getElementById('invoice_file').files[0];
      }


      var form_data = new FormData();

      form_data.append(`document`, property);

      var $job_work_rows = $("[data-job-work-row]");
      job_works_array = []

      $job_work_rows.each(function(index) {
        var $job_work_row = $(this);
        var job_work_row = {
          job_work_type_id: $job_work_row.find('[name="job_work_type_id"]').val(),
          job_work_id: $job_work_row.find('[name="job_work_id"]').val(),
          description: $job_work_row.find('[name="description"]').val(),
          is_no_charge: ($job_work_row.find('[name="is_no_charge"]').prop("checked")) ? 'YES' : 'NO',
          warranty_type: $job_work_row.find('[name="warranty_type"]').val(),
          warranty_period: $job_work_row.find('[name="warranty_period"]').val(),
          quantity: $job_work_row.find('[name="quantity"]').val(),
          rate: $job_work_row.find('[name="rate"]').val()
          //amount : $job_work_row.find('[name="amount"]').val()
        }
        job_works_array.push(job_work_row)
      })

      var obj = {
        repair_order_id: '<?php echo $ro_details['id']; ?>',
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
        vendor_city_id: ($('[name="vendor_city_id"]').val() !== null) ? $('[name="vendor_city_id"]').val() : '',
        vendor_contact_person: $('[name="vendor_contact_person"]').val(),
        vendor_contact_no: $('[name="vendor_contact_no"]').val(),
        vendor_email: $('[name="vendor_email_id"]').val(),
        payment_mode_id: $('[name="payment_mode_id"]').val(),
        payment_ref_no: $('[name="payment_ref_no"]').val(),
        invoice_no: $('[name="invoice_no"]').val(),
        payment_date: $('[name="payment_date"]').val(),
        payment_status: $('[name="payment_status"]').val(),
        payment_remarks: $('[name="payment_remarks"]').val(),
        job_works: JSON.stringify(job_works_array),
      }
      for (var key in obj) {
        form_data.append(key, obj[key]);
      }

      form_data.append(key, obj[key]);


      $.ajax({
        url: window.location.pathname + '-action',
        type: 'POST',
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message);
          if (data.status) {
            //location.href="../user/maintenance/repair-orders/details?eid=<?php echo $ro_details['eid'] ?>"
            window.history.back();
            wait_to_submit_btn('#submit', 'ADD')
            hide_processing_modal()
          } else {
            hide_processing_modal()
            wait_to_submit_btn('#submit', 'ADD')
          }
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
        select_default('[name="vendor_state_id"]');
        show_cities({
          state_id: '<?php echo $ro_details['ro_vendor_state_id_fk']; ?>'
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
            select_default('[name="vendor_city_id"]');
          }
        }
        else {
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
      }
    }
  })
</script>

<script type="text/javascript">
  function show_unittype_filter() {
    get_vehicles().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[name="unittype_id"]').html(options);
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_unittype_filter()
</script>

<script type="text/javascript">
  function show_unit_filter(param) {
    if (param.unittype_id == 1) {
      get_trucks().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options += `<option value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options += `<option value="` + item.id + `">` + item.code + `</option>`;
            })
            $('[name="unit_id"]').html(options);
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    } else if (param.unittype_id == 2) {
      get_trailers().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options += `<option value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options += `<option value="` + item.id + `">` + item.code + `</option>`;
            })
            $('[name="unit_id"]').html(options);
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    }
  }
</script>

<script type="text/javascript">
  var counter = 1
  var $issue_table = $('#issue_table');

  function add_row() {

    ++counter;
    var $add_rowissue = `<tr id="issue_row${counter}"  data-job-work-row>
    <td class="counter">${counter}</td>
    <td><select class="w-150" name="job_work_type_id" required></select></td>
    <td><select class="w-150" name="job_work_id" required></select></td>
    <td><input  class="w-150" name="description" type="text" required></td>
    <td><input class="chk2" type="checkbox" name="is_no_charge" class="checkrate"></td>
    <td><select style="width: 100px" name="warranty_type" required>
    <option value="NONE" selected>None</option>
    <option value="DAYS">Days</option> 
    <option value="HOURS">Hours</option>
    <option value="MILES">Miles</option> 
    </select>
    </td>
    <td><input style="width: 70px" name="warranty_period" class="zero" value="0" type="number" step="any" required></td>
    <td><input style="width: 70px" value="1" name="quantity" class="zero" type="number" step="any" required onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>
    <td><input style="width: 80px" value="" required name="rate" class=""  onkeyup="cal_total_amount()" type="number" step="any" ></td>
    <td><input style="width: 100px" value='0' name="amount" type="text" data-row-amount onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>

    <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>
    </tr>`;
    $('#issue_table').append($add_rowissue);
    show_jobworktype('issue_row' + counter)
    show_jobwork('issue_row' + counter)
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
    counter = 1;
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
  function show_jobworktype(row_id) {
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
          $('tr#' + row_id + ' [name="job_work_type_id"]').html(options);
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_jobworktype('issue_row1')
</script>

<script type="text/javascript">
  function show_jobwork(row_id) {
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
          $('tr#' + row_id + ' [name="job_work_id"]').html(options);
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_jobwork('issue_row1')
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