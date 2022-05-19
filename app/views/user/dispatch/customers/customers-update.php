<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];
?>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">UPDATE CUSTOMER</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return update()">
    <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
    <section class="section-111">
      <div></div>
      <div style="display:none;">
        <fieldset>
          <legend>Status</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Status</label>
              <select name="status_id"></select>
            </div>
          </div>
        </fieldset>
      </div>
      <div></div>
    </section>
    <section class="section-111">
      <div>
        <fieldset>
          <legend>Basic Details</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Terminal</label>
              <select name="terminal_id" required="required" data-default-select="<?php echo $details['terminal_id'] ?>"></select>
            </div>
            <div class="field-p">
              <label>Customer Code</label>
              <input type="text" name="code" pattern="[a-zA-Z0-9 -]{1,}" required="required" value="<?php echo $details['customer_code_new'] ?>" placeholder="Enter Customer Code here">
            </div>
            <div class="field-p">
              <label>Customer Type</label>
              <select name="customer_type_id" data-default-select="<?php echo $details['customer_type'] ?>" required="required">
                <option value=""> - - - Select - - - </option>
                <option value="BROKER">Broker</option>
                <option value="SHIPPER"> Shipper </option>
                <option value="3PL"> 3PL </option>
              </select>
            </div>
            <div class="field-p">
              <label>Customer Name</label>
              <input type="text" name="customer_name" required="required" value="<?php echo $details['customer_name'] ?>" placeholder="Enter Customer Name here">
            </div>

        </fieldset>

        <fieldset>
          <legend>Address</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Address Line</label>
              <input type="text" name="address_line" value="<?php echo $details['address_line'] ?>" placeholder="Enter Address here">
            </div>
            <div class="field-p">
              <label>Country</label>
              <select name="address_country_id" onchange="show_addess_states({country_id:this.value})" required="required"></select>
            </div>

            <div class="field-p">
              <label>State</label>
              <select name="address_state_id" onchange="show_addess_cities({state_id:this.value})"></select>
            </div>
            <div class="field-p">
              <label>City</label>
              <select name="address_city_id" onchange="show_address_zipcodes({city_id:this.value})"></select>
            </div>
            <div class="field-p">
              <label>ZIP Code</label>
              <select name="address_zipcode_id"></select>
            </div>
          </div>
        </fieldset>


        <fieldset>
          <legend>Contact Information</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Toll Free Number</label>
              <div>
                <input style="width: 100%" type="text" name="toll_free_number" value="<?php echo $details['toll_free_number'] ?>" placeholder="Enter Toll Free Number here">
              </div>
            </div>
            <div class="field-p">
              <label>Phone Number</label>
              <div>
                <input style="width: 100%" type="text" name="phone_number" value="<?php echo $details['phone_number'] ?>" placeholder="Enter Phone Number here">
              </div>
            </div>

            <div class="field-p">
              <label>Fax Phone Number</label>
              <div>
                <input style="width: 100%" type="text" name="fax_phone_number" value="<?php echo $details['fax_phone_no'] ?>" placeholder="Enter Fax Number here">
              </div>
            </div>

            <div class="field-p">
              <label>Company Email</label>
              <input type="email" name="company_email" value="<?php echo $details['company_email'] ?>" placeholder="Enter Company Email here">
            </div>
            <div class="field-p">
              <label>Load Notification Email</label>
              <div>
                <input style="width: 100%" type="text" name="load_notification_email" value="<?php echo $details['load_notification_email'] ?>" placeholder="Enter Load Notification Email here">
              </div>
            </div>

            <div class="field-p">
              <label>After Hour Email</label>
              <input type="email" name="after_hours_email" value="<?php echo $details['after_hours_email'] ?>" multiple placeholder="Enter After Hour Email here">
            </div>
            <div class="field-p">
              <label>After Hour Phone</label>
              <input type="text" name="after_hours_phone_number" value="<?php echo $details['after_hours_phone_number'] ?>" placeholder="Enter After Hour Phone here">
            </div>
            <div class="field-p">
              <label>Dispatch Notes</label>
              <div>
                <textarea style="width: 100%" name="dispatch_notes" placeholder="Enter Dispatch Notes here"><?php echo $details['dispatch_notes'] ?></textarea>
              </div>
            </div>
            <div class="field-p">
              <label>Dispatcher Notice</label>
              <div>
                <textarea style="width: 100%" name="dispatcher_notice" placeholder="Enter Dispatcher Notice here"><?php echo $details['dispatcher_notice'] ?></textarea>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
      <div>
        <fieldset>
          <legend> Other Information </legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Deliverable Receipt Options</label>
              <select name="deliverable_receipt_option_id" data-default-select="<?php echo $details['deliverable_receipt_option'] ?>">
                <option value=""> - - - Select - - - </option>
                <option value="EMAIL"> EMAIL</option>
                <option value="EDI"> EDI</option>
                <option value="FTP"> FTP</option>
                <option value="API"> API</option>
              </select>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>Customer Credit Information</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Credit Status</label>
              <select name="credit_status_id" data-default-select="<?php echo $details['credit_status_id'] ?>">
                <option value=""> - - - Select - - - </option>
                <option value="APPROVED"> APPROVED </option>
                <option value="NOT-APPROVED"> NOT APPROVED </option>
              </select>
            </div>
            <div class="field-p">
              <label>Billing Fax Number</label>
              <input type="text" name="billing_fax_number" value="<?php echo $details['billing_fax_number'] ?>" placeholder="Enter Billing Fax Number here">
            </div>
            <div class="field-p">
              <label>Billing Email</label>
              <input type="text" name="billing_email" value="<?php echo $details['billing_email'] ?>" placeholder="Enter Billing Email here">
            </div>
            <div class="field-p">
              <label>Net Terms</label>
              <select name="net_terms" data-default-select="<?php echo $details['net_terms'] ?>">
                <option value=""> - - - Select - - - </option>
                <option value="15"> 15 Days </option>
                <option value="30"> 30 Days </option>
              </select>
            </div>
        </fieldset>

      </div>

    </section>

    <section class="action-button-box">
      <button type="submit" class="btn_green">SAVE</button>
      <?php if ($_GET['page'] == 'verify') { ?> <button type='submit' id='button' data-submit class='btn_green' onclick='set_pref("VERIFIED")' style="margin-left: 10px;">SAVE AS VERIFIED</button> <?php } ?>
      &nbsp; &nbsp;<button type="button" class="btn_green" onclick="back_alert()">BACK</button>
    </section>
  </form>
</section>




<script type="text/javascript">
  var is_verified = 'NO';

  function set_pref(val) {
    is_verified = (val == 'VERIFIED') ? 'YES' : 'NO';
    $('[data-submit]').trigger('click');
  }




  function update() {
    show_processing_modal()
    submit_to_wait_btn('#submit', 'loading')
    $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    var formData = new FormData(currentForm);
    if (isValidForm) {
      var arr = $('#MyForm').serializeArray();
      var obj = {
        is_verified: is_verified
      }
      for (var a = 0; a < arr.length; a++) {
        obj[arr[a].name] = arr[a].value
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
            location.href = '../user/dispatch/customers'
          } else {
            hide_processing_modal()
            wait_to_submit_btn('#submit', 'SAVE')
          }
        }
      })
    }
    return false
  }
</script>
<script type="text/javascript">
  function show_terminal_options() {
    get_companies().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[name="terminal_id"]').html(options);
          $('[name="terminal_id"] option[value="<?php echo $details['terminal_id']; ?>"]').prop('selected', true);
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_terminal_options()
</script>
<script type="text/javascript">
  function show_address_countries() {
    get_countries().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[name="address_country_id"]').html(options);
          $('[name="address_country_id"] option[value="<?php echo $details['address_country_id']; ?>"]').prop('selected', true);
          show_addess_states({
            country_id: '<?php echo $details['address_country_id']; ?>'
          });
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_address_countries()
</script>

<script type="text/javascript">
  function show_addess_states(param) {
    get_states(param).then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[name="address_state_id"]').html(options);
          $('[name="address_state_id"] option[value="<?php echo $details['address_state_id']; ?>"]').prop('selected', true);
          show_addess_cities({
            country_id: '<?php echo $details['address_state_id']; ?>'
          });
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
</script>

<script type="text/javascript">
  function show_addess_cities(param) {
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
          $('[name="address_city_id"]').html(options);
          $('[name="address_city_id"]').html(options);
          $('[name="address_city_id"] option[value="<?php echo $details['address_city_id']; ?>"]').prop('selected', true);
          show_address_zipcodes({
            city_id: '<?php echo $details['address_city_id']; ?>'
          });
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
</script>



<script type="text/javascript">
  function show_address_zipcodes(param) {
    get_zipcodes(param).then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[name="address_zipcode_id"]').html(options);
          $('[name="address_zipcode_id"] option[value="<?php echo $details['address_zipcode_id']; ?>"]').prop('selected', true);
        }
      } else {
        var options = "";
        options += `<option value="">- - Select - -</option>`;
        $('[name="address_zipcode_id"]').html(options);
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
</script>
<script>
  function back_alert() {
    if (confirm('Are you Sure ?')) {
      window.history.back();
    }
  }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>