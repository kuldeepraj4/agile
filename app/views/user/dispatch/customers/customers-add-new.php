<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<style>
  [data-zipcode-refresh] {
    color: grey;
    font-size: .9em;
    cursor: pointer;
  }

  [data-add-zipcode] {
    color: grey;
    font-size: .9em;
    cursor: pointer;
  }
</style>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">ADD NEW CUSTOMER</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">
    <section class="section-111">
      <div>
        <fieldset>
          <legend>Basic Details</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Terminal</label>
              <select name="terminal_id" required="required"></select>
            </div>
            <div class="field-p">
              <label>Customer Code</label>
              <input type="text" name="code" pattern="[a-zA-Z0-9 -]{1,}" required="required" placeholder="Enter Customer Code here">
            </div>
            <div class="field-p">
              <label>Customer Type</label>
              <select name="customer_type_id" required="required">
                <option value=""> - - - Select - - - </option>
                <option value="BROKER">Broker</option>
                <option value="SHIPPER"> Shipper </option>
                <option value="3PL"> 3PL </option>
              </select>
            </div>
            <div class="field-p">
              <label>Customer Name</label>
              <input type="text" name="customer_name" required="required" placeholder="Enter Customer Name here">
            </div>

        </fieldset>

        <fieldset>
          <legend>Address</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Address Line</label>
              <input type="text" name="address_line" placeholder="Enter Address here">
            </div>
            <div class="field-p">
              <label>Country</label>
              <select name="address_country_id" onchange="show_addess_states({country_id:this.value});clearStateCityZip();" required="required"></select>
            </div>

            <div class="field-p">
              <label>State</label>
              <select name="address_state_id" onchange="show_addess_cities({state_id:this.value});clearCity();"></select>
            </div>
            <div class="field-p">
              <label>City</label>
              <select name="address_city_id" onchange="show_address_zipcodes({city_id:this.value});clearZipcode();"></select>
            </div>
            <div class="field-p">
              <label>ZIP Code</label>
              <select name="address_zipcode_id"></select><i data-zipcode-refresh class="fas fa-sync-alt" title="Refresh Zipcode List"></i><i data-add-zipcode class="fa fa-plus" title="Add Zipcode"></i>
            </div>
          </div>
        </fieldset>


        <fieldset>
          <legend>Contact Information</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Toll Free Number</label>
              <div>
                <input style="width: 100%" type="text" name="toll_free_number" placeholder="Enter Toll Free Number here">
              </div>
            </div>
            <div class="field-p">
              <label>Phone Number</label>
              <div>
                <input style="width: 100%" type="text" name="phone_number" placeholder="Enter Phone Number here">
              </div>
            </div>

            <div class="field-p">
              <label>Fax Phone Number</label>
              <div>
                <input style="width: 100%" type="text" name="fax_phone_number" placeholder="Enter Fax Number here">
              </div>
            </div>

            <div class="field-p">
              <label>Company Email</label>
              <input type="email" name="company_email" placeholder="Enter Company Email here">
            </div>
            <div class="field-p">
              <label>Load Notification Email</label>
              <div>
                <input style="width: 100%" type="text" name="load_notification_email" placeholder="Enter Load Notification Email here">
              </div>
            </div>

            <div class="field-p">
              <label>After Hour Email</label>
              <input type="email" name="after_hours_email" multiple placeholder="Enter After Hour Email here">
            </div>
            <div class="field-p">
              <label>After Hour Phone</label>
              <input type="text" name="after_hours_phone_number" placeholder="Enter After Hour Phone here">
            </div>
            <div class="field-p">
              <label>Dispatch Notes</label>
              <div>
                <textarea style="width: 100%" name="dispatch_notes" placeholder="Enter Dispatch Notes here"></textarea>
              </div>
            </div>
            <div class="field-p">
              <label>Dispatcher Notice</label>
              <div>
                <textarea style="width: 100%" name="dispatcher_notice" placeholder="Enter Dispatcher Notice here"></textarea>
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
              <select name="deliverable_receipt_option_id">
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
              <select name="credit_status_id">
                <option value=""> - - - Select - - - </option>
                <option value="APPROVED"> APPROVED </option>
                <option value="NOT-APPROVED"> NOT APPROVED </option>
              </select>
            </div>
            <div class="field-p">
              <label>Billing Fax Number</label>
              <input type="text" name="billing_fax_number" placeholder="Enter Billing Fax Number here">
            </div>
            <div class="field-p">
              <label>Billing Email</label>
              <input type="text" name="billing_email" placeholder="Enter Billing Email here">
            </div>
            <div class="field-p">
              <label>Net Terms</label>
              <select name="net_terms">
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
      &nbsp; &nbsp;<button type="button" class="btn_green" onclick="back_alert()">BACK</button>
    </section>
  </form>
</section>
<script>
  function back_alert() {
    if (confirm('Are you Sure ?')) {
      window.history.back();
    }
  }
</script>
<script type="text/javascript">
function refresh_zipcode(){
  clearZipcode();
  var city_val = $('[name="address_city_id"]').val();
  if(city_val!="" && city_val!=null && city_val!=undefined){
  show_address_zipcodes({city_id:city_val})
  alert("Zipcode list refreshed")
  }else{
    alert("Please select city")
  }
}
</script>
<script type="text/javascript">
  $(document).on("click", "[data-zipcode-refresh]", function() {
    show_processing_modal();
    refresh_zipcode();
    hide_processing_modal();
  });

  $(document).on("click", "[data-add-zipcode]", function() {
    open_child_window({
      url: '../user/masters/locations/zipcodes/quick-add-new',
      name: 'AddAddress',
      width: 1000,
      height: 800,
    })
  });
</script>


<script type="text/javascript">
  function add_new() {
    show_processing_modal()
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
  function clearStateCityZip() {
    var options = "";
    options += `<option value="">- - Select - -</option>`
    $('[name="address_state_id"]').html(options);
    var options = "";
    options += `<option value="">- - Select - -</option>`
    $('[name="address_city_id"]').html(options);
    var options = "";
    options += `<option value="">- - Select - -</option>`
    $('[name="address_zipcode_id"]').html(options);
  }

  function clearCity() {
    var options = "";
    options += `<option value="">- - Select - -</option>`
    $('[name="address_city_id"]').html(options);
    var options = "";
    options += `<option value="">- - Select - -</option>`
    $('[name="address_zipcode_id"]').html(options);

  }

  function clearZipcode() {
    var options = "";
    options += `<option value="">- - Select - -</option>`
    $('[name="address_zipcode_id"]').html(options);
  }

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
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_terminal_options()
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
        } else {
          var options = "";
          options += `<option value="">- - Select - -</option>`
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
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>