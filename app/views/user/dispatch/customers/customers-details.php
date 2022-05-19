<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];
// echo "<pre>";
// print_r($details);
// echo "</pre>";
?>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">CUSTOMER CODE <?php echo $details['customer_code']; ?></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">
    <section class="section-111">
      <div>
        <fieldset>
          <legend>Basic Details</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Terminal</label>
              <div><?php echo $details['terminal_name']; ?></div>
            </div>
            <div class="field-p">
              <label>Customer Code</label>
              <div><?php echo $details['customer_code']; ?></div>
            </div>
            <div class="field-p">
              <label>Customer Type</label>
              <div><?php echo $details['customer_type']; ?></div>
            </div>
            <div class="field-p">
              <label>Customer Name</label>
              <div><?php echo $details['customer_name']; ?></div>
            </div>

        </fieldset>

        <fieldset>
          <legend>Address</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Address Line</label>
              <div><?php echo $details['address_line']; ?></div>
            </div>
            <div class="field-p">
              <label>Country</label>
              <div><?php echo $details['address_country']; ?></div>
            </div>

            <div class="field-p">
              <label>State</label>
              <div><?php echo $details['address_state']; ?></div>
            </div>
            <div class="field-p">
              <label>City</label>
              <div><?php echo $details['address_city']; ?></div>
            </div>
            <div class="field-p">
              <label>ZIP Code</label>
              <div><?php echo $details['address_zipcode']; ?></div>
            </div>
          </div>
        </fieldset>


        <fieldset>
          <legend>Contact Information</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Toll Free Number</label>
              <div><?php echo $details['toll_free_number']; ?></div>
            </div>
            <div class="field-p">
              <label>Phone Number</label>
              <div><?php echo $details['phone_number']; ?></div>
            </div>

            <div class="field-p">
              <label>Fax Phone Number</label>
              <div><?php echo $details['fax_phone_no']; ?></div>
            </div>

            <div class="field-p">
              <label>Company Email</label>
              <div><?php echo $details['company_email']; ?></div>
            </div>
            <div class="field-p">
              <label>Load Notification Email</label>
              <div><?php echo $details['load_notification_email']; ?></div>
            </div>

            <div class="field-p">
              <label>After Hour Email</label>
              <div><?php echo $details['after_hours_email']; ?></div>
            </div>
            <div class="field-p">
              <label>After Hour Phone</label>
              <div><?php echo $details['after_hours_phone_number']; ?></div>
            </div>
            <div class="field-p">
              <label>Dispatch Notes</label>
              <div>
                <div><?php echo $details['dispatch_notes']; ?></div>
              </div>
            </div>
            <div class="field-p">
              <label>Dispatcher Notice</label>
              <div>
                <div><?php echo $details['dispatcher_notice']; ?></div>
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
              <div><?php echo $details['deliverable_receipt_option']; ?></div>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>Customer Credit Information</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Credit Status</label>
              <div><?php echo $details['credit_status_id']; ?></div>
            </div>
            <div class="field-p">
              <label>Billing Fax Number</label>
              <div><?php echo $details['billing_fax_number']; ?></div>
            </div>
            <div class="field-p">
              <label>Billing Email</label>
              <div><?php echo $details['billing_email']; ?></div>
            </div>
            <div class="field-p">
              <label>Net Terms</label>
              <div><?php echo $details['net_terms']; ?></div>
            </div>
        </fieldset>

      </div>

    </section>

    <section class="action-button-box">
    <button type="button" class="btn_green" onclick="window.history.back()">BACK</button>
    </section>
  </form>
</section>



<!-- 
<script type="text/javascript">
  function add_new() {
    submit_to_wait_btn('#submit', 'loading')
    $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    var formData = new FormData(currentForm);
    if (isValidForm) {
      var arr = $('#MyForm').serializeArray();
      var obj = {}
      for (var a = 0; a < arr.length; a++) {
        obj[arr[a].name] = arr[a].value
      }
      $.ajax({
        url: window.location.href + '-action',
        type: 'POST',
        data: obj,
        success: function(data) {
          // alert(data)
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message);
          if (data.status) {
            GTU_masters_locations_cities();
            wait_to_submit_btn('#submit', 'SAVE')
          } else {
            wait_to_submit_btn('#submit', 'SAVE')
          }
        }
      })
    }
    return false
  }
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
          console.log(data.response.list)
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[name="address_state_id"]').html(options);
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
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
</script> -->

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>