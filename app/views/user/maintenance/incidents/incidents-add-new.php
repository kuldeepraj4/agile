<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">ADD NEW - INCIDENT</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">

    <section class="section-111">

      <div>

        <fieldset>
          <legend>Basic Information</legend>
          <div class="field-section single-column">

            <!-- <div class="field-p"> -->
              <!-- <label>Status</label> -->
              <select name="in_status_id" disabled hidden>
                <option value="">--Select--</option>
                <option value="OPEN" selected>Open</option>
                <option value="CLOSED">Closed</option>
              </select>
              <!-- </div> -->

              <div class="field-p">

                <label>Date of Incident</label>

                <input name="in_incident_date" type="text" data-date-picker required>

              </div>

              <div class="field-p">

                <label>Date Reported</label>

                <input name="in_reported_date" type="text" data-date-picker required>

              </div>

              <div class="field-p">

                <label>Follow Up Date</label>

                <input name="in_followup_date" type="text" data-date-picker required>

              </div>

              <div class="field-p">

                <label>Load ID</label>

                <input name="in_load_id" type="text">

              </div>

              <div class="field-p">

                <label>Load Terminal</label>

                <select name="in_load_terminal_id_fk" data-filter="load_terminal_id">

                </select>

              </div>

              <div class="field-p">

                <label>Driver Name</label>

                <select name="in_driver_id_fk" data-filter="driver_id">

                </select>

              </div>

              <div class="field-p">

                <label>Driver Terminal</label>

                <select name="in_driver_terminal_id_fk" data-filter="driver_terminal_id">

                </select>

              </div>

              <div class="field-p">

                <label>Truck ID</label>

                <select name="in_truck_id_fk" data-filter="truck_id">

                </select>

              </div>
              <div class="field-p">

                <label>Trailer ID</label>

                <select name="in_trailer_id_fk" data-filter="trailer_id"></select>

              </div>

              <div class="field-p">

                <label>Owner</label>

                <select name="in_owner_id_fk" type="text">
                  <option value="">--Select--</option>
                </select>

              </div>

              <div class="field-p">

                <label>Broker Carrier</label>

                <select name="in_broker_carrier_id_fk" type="text">
                  <option value="">--Select--</option>
                </select>

              </div>

              <div class="field-p">

                <label>Overall Event Reserve</label>

                <input name="in_overall_event_reserve" type="text">

              </div>

              <div class="field-p">

                <label>Initial Rep</label>

                <input name="in_initial_rep" type="text">

              </div>      

            </fieldset>

          </div>

          <div>

            <fieldset>
              <legend>Location Information</legend>
              <div class="field-section single-column">

                <div class="field-p">

                  <label>Location</label>

                  <input name="in_accident_location_name" type="text" required>

                </div>

                <div class="field-p">
                  <label>Address</label>
                  <input name="in_accident_location_address" type="text" required>
                </div>

                <div class="field-p">
                  <label>State</label>
                  <select name="in_accident_state_id_fk" data-filter="state_id" onchange="show_cities({state_id:this.value})" required></select>
                </div>

                <div class="field-p">
                  <label>City</label>
                  <select name="in_accident_city_id_fk" data-filter="city_id" onchange="show_accident_zip_codes({city_id:this.value})" required></select>
                </div>

                <div class="field-p">
                  <label>Zip</label>
                  <select name="in_accident_zip_id_fk" data-filter="zip_id"></select>
                </div>

              </div>

            </fieldset>

            <fieldset>
              <legend>Drug Test Information</legend>
              <div class="field-section single-column">

                <div class="field-p">

                  <label>DOT Reportable</label>
                  
                  <select id="mySelectDOT" name="in_dot_reportable_id_fk" required data-optional>
                    <option value="">--Select--</option>
                    <option value="YES">Yes</option>
                    <option value="NO">No</option>
                  </select>
                </div>

                <div class="field-p">

                  <label>Required</label>

                  <select name="in_drug_test_required_id" type="text" class="required" required>
                    <option value="">--Select--</option>
                    <option value="YES">Yes</option>
                    <option value="NO">No</option>
                  </select>

                </div>

                <div class="field-p">

                  <label>Collected</label>

                  <select name="in_drug_test_collected_id" type="text" class="collected">
                    <option value="">--Select--</option>
                    <option value="YES">Yes</option>
                    <option value="NO">No</option>
                  </select>

                </div>

                <div class="field-p">

                  <label>Address</label>

                  <input name="in_drug_test_address" type="text" class="address">

                </div>

                <div class="field-p">

                  <label>State</label>

                  <select name="in_drug_test_state_id" type="text" data-filter="drug_state_id" onchange="show_drug_cities({state_id:this.value})" class="state"></select>

                </div>

                <div class="field-p">

                  <label>City</label>
                  <select name="in_drug_test_city_id" type="text" data-filter="drug_city_id" onchange="show_drug_test_zip_codes({city_id:this.value})" class="city" required></select>

                </div>
                <div class="field-p">

                  <label>Zip</label>
                  <select name="in_drug_test_zip_id_fk" data-filter="drug_zip_id" class="zip"></select>

                </div>

                <div class="field-p">

                  <label>Phone</label>

                  <input name="in_drug_test_phone_no" type="text" class="phone">

                </div>

              </div>

            </fieldset>

          </div>

          <div>

            <fieldset>
              <legend>Police Department Information</legend>
              <div class="field-section">

                <div class="field-p">

                  <label>Police Department</label>

                  <input name="in_police_department" type="text">

                </div>

                <div class="field-p">

                  <label>Police Dept. Phone #</label>

                  <input name="in_police_department_phone_no" type="text">

                </div>

                <div class="field-p">

                  <label>Officer Name</label>

                  <input name="in_office_name" type="text">

                </div>

                <div class="field-p">

                  <label>Police Report # </label>

                  <input name="in_police_report_no" type="text">

                </div>

                

                <div class="field-p">

                  <label>Fatality</label>
                  <select name="in_fatality_id_fk" data-filter="fatality_id" required>
                    <option value="">--Select--</option>
                    <option value="YES">Yes</option>
                    <option value="NO">No</option>
                  </select>
                </div>

                <div class="field-p">

                  <label>Bodily Injury</label>
                  <select name="in_bodily_injury_fk" data-filter="bodily_injury_id" required>
                    <option value="">--Select--</option>
                    <option value="YES">Yes</option>
                    <option value="NO">No</option>
                  </select>
                </div>

                <div class="field-p">
                  <label>Driver Citations</label>
                  <select name="in_driver_citation_fk" data-filter="driver_citations_id" required>
                    <option value="">--Select--</option>
                    <option value="YES">Yes</option>
                    <option value="NO">No</option>
                  </select>
                </div>

              </div>

            </fieldset>

        <!-- <fieldset>
          <legend>Incident Description</legend>
          <div class="field-section single-column">

            <div class="field-p">

              <textarea name="in_incident_description" style="height: 150px" required></textarea>

            </div>

          </div>

        </fieldset> -->

      </div>

    </section>

    <section class="section-1" style="width:100%">
      <div>
        <fieldset>
          <legend>Incident Description</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <textarea name="in_incident_description" style="height: 100px" required></textarea>
            </div>
          </div>
        </fieldset>
      </div>
    </section>

    <section class="section-1" style="width:100%">

      <div>

        <fieldset>

          <legend>List of Documents</legend>

          <div class="field-section table-rows">

            <table style="width: 100%">

              <thead>

                <tr>

                  <th>Sr. No.</th>

                  <th></th>

                  <th>Document ID</th>

                  <th>Document Required</th>

                  <th>Remarks</th>

                  <th>Action</th>

                </tr>

              </thead>

              <tbody id="issue_table">

                <tr id="issue_row1" data-stop-row>

                  <td>1</td>
                  <td><input type="text" name="in_doc_id" disabled hidden></td>
                  <td><select name="in_document_id"></select>
                    <td><select style="width:90" name="in_document_required">
                      <option value="">--Select--</option>
                      <option value="YES" selected>Yes</option>
                      <option value="NO">No</option>
                    </select>
                  </td>
                  <td><input type="text" style="width:300" name="in_document_remarks"></td>

                  <td></td>

                </tr>

              </tbody>

              <tfoot>

                <tr>
                  <td colspan="8"><button type="button" class="btn_blue" onclick="add_row({})">Add Row</button></td>
                </tr>

              </tfoot>

            </table>

          </div>

        </fieldset>

      </div>

    </section>

    <section class="action-button-box">

      <button type="submit" class="btn_green">Save</button>
      <span style="background-color:#296327;color:white;border-radius:3px;padding:5px 5px;cursor: pointer;margin-left:10px" onclick="window.history.back()">Back</span>
    </section>

  </form>

</section>

<script type="text/javascript">
  function show_incident_documents_list(row_id) {
    get_incident_documents_list().then(function(data) {
      
      if (data.status) {
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            if(item.status == 'ACTIVE'){
              options += `<option value="` + item.id + `">` + item.name + `</option>`;
            }
          })
          $('tr#' + row_id + ' [name="in_document_id"]').html(options);
        }
      }
    }).catch(function(err) {})
  }
  show_incident_documents_list('issue_row1')
</script>

<script type="text/javascript">
 $(document).ready(function() {
  /*var disableText = '<?php echo $details['in_dot_reportable_id_fk']; ?>';*/
  var disableText = '';
  checkValidityDOT(disableText);
});
 function checkValidityDOT(disableText)
 {
  var value = disableText;
  if (value === "YES") {
    $(".required").prop('disabled', false)
    $(".collected").prop('disabled', false)
    $(".address").prop('disabled', false)
    $(".state").prop('disabled', false)
    $(".city").prop('disabled', false)
    $(".zip").prop('disabled', false)
    $(".phone").prop('disabled', false)
  } else if (value === "NO") {
    $(".required").prop('disabled', true)
    $(".collected").prop('disabled', true)
    $(".address").prop('disabled', true)
    $(".state").prop('disabled', true)
    $(".city").prop('disabled', true)
    $(".zip").prop('disabled', true)
    $(".phone").prop('disabled', true)
  } else if (value === "") {
    $(".required").prop('disabled', true)
    $(".collected").prop('disabled', true)
    $(".address").prop('disabled', true)
    $(".state").prop('disabled', true)
    $(".city").prop('disabled', true)
    $(".zip").prop('disabled', true)
    $(".phone").prop('disabled', true)
  }
}
</script>

<script type="text/javascript">

  $(document.body).on('change', '#mySelectDOT' ,function() {
    var value = $(this).val();
    if (value === "YES") {
      $(".required").prop('disabled', false)
      $(".collected").prop('disabled', false)
      $(".address").prop('disabled', false)
      $(".state").prop('disabled', false)
      $(".city").prop('disabled', false)
      $(".zip").prop('disabled', false)
      $(".phone").prop('disabled', false)
    } else if (value === "NO") {
      $(".required").prop('disabled', true)
      $(".collected").prop('disabled', true)
      $(".address").prop('disabled', true)
      $(".state").prop('disabled', true)
      $(".city").prop('disabled', true)
      $(".zip").prop('disabled', true)
      $(".phone").prop('disabled', true)
    } else if (value === "") {
      $(".required").prop('disabled', true)
      $(".collected").prop('disabled', true)
      $(".address").prop('disabled', true)
      $(".state").prop('disabled', true)
      $(".city").prop('disabled', true)
      $(".zip").prop('disabled', true)
      $(".phone").prop('disabled', true)
    }
  });


</script>


<script type="text/javascript">

  /*$(document.body).on('change', '#mySelectDOT' ,function() {
    var value = $(this).val();
    //alert(value);
    if (value === "YES") {
      $(".required").prop('required', true)
    } else if (value === "NO") {
      $(".required").prop('required', false)
    } else if (value === "") {
      $(".required").prop('required', false)
    }
  });*/

  function save() {
    //submit_to_wait_btn('#submit','loading')
    $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    var formData = new FormData(currentForm);
    if (isValidForm) {
      var arr = $('#MyForm').serializeArray();
      var $issue_rows = $("[data-stop-row]");
      issues_array = []

      $issue_rows.each(function(index) {
        var $data_stop_row = $(this);
        var stop_row = {
          in_doc_id: $data_stop_row.find('[name="in_doc_id"]').val(),
          in_document_id: $data_stop_row.find('[name="in_document_id"]').val(),
          in_document_required: $data_stop_row.find('[name="in_document_required"]').val(),
          in_document_remarks: $data_stop_row.find('[name="in_document_remarks"]').val(),
          in_document_checked: ($data_stop_row.find('[name="in_documents_checked"]').prop('checked')==true)?'ON':'OFF'
        }
        issues_array.push(stop_row)
      })

      var obj = {
        update_eid: $('[name="update_eid"]').val(),
        in_status_id_fk: $('[name="in_status_id"]').val(),
        in_incident_date: $('[name="in_incident_date"]').val(),
        in_reported_date: $('[name="in_reported_date"]').val(),
        in_followup_date: $('[name="in_followup_date"]').val(),

        
        in_load_id: $('[name="in_load_id"]').val(),
        in_load_terminal_id_fk: $('[name="in_load_terminal_id_fk"]').val(),
        in_driver_id_fk: $('[name="in_driver_id_fk"]').val(),
        in_driver_terminal_id_fk: $('[name="in_driver_terminal_id_fk"]').val(),
        in_truck_id_fk: $('[name="in_truck_id_fk"]').val(),
        in_trailer_id_fk: $('[name="in_trailer_id_fk"]').val(),

        in_accident_location_name: $('[name="in_accident_location_name"]').val(),
        in_accident_location_address: $('[name="in_accident_location_address"]').val(),
        in_accident_state_id_fk: $('[name="in_accident_state_id_fk"]').val(),
        in_accident_city_id_fk: $('[name="in_accident_city_id_fk"]').val(),
        in_accident_zip_id_fk: $('[name="in_accident_zip_id_fk"]').val(),
        
        in_owner_id_fk: $('[name="in_owner_id_fk"]').val(),
        in_broker_carrier_id_fk: $('[name="in_broker_carrier_id_fk"]').val(),
        in_overall_event_reserve: $('[name="in_overall_event_reserve"]').val(),
        in_initial_rep: $('[name="in_initial_rep"]').val(),

        in_drug_test_required_id_fk: $('[name="in_drug_test_required_id"]').val(),
        in_drug_test_collected_id_fk: $('[name="in_drug_test_collected_id"]').val(),
        in_drug_test_address: $('[name="in_drug_test_address"]').val(),
        in_drug_test_state_id_fk: $('[name="in_drug_test_state_id"]').val(),
        in_drug_test_city_id_fk: $('[name="in_drug_test_city_id"]').val(),
        in_drug_test_zip_id_fk: $('[name="in_drug_test_zip_id_fk"]').val(),
        in_drug_test_phone_no: $('[name="in_drug_test_phone_no"]').val(),

        in_police_department: $('[name="in_police_department"]').val(),
        in_police_department_phone_no: $('[name="in_police_department_phone_no"]').val(),
        in_office_name: $('[name="in_office_name"]').val(),
        in_police_report_no: $('[name="in_police_report_no"]').val(),
        in_dot_reportable_id_fk: $('[name="in_dot_reportable_id_fk"]').val(),
        in_fatality_id_fk: $('[name="in_fatality_id_fk"]').val(),
        in_bodily_injury_id_fk: $('[name="in_bodily_injury_fk"]').val(),
        in_driver_citation_id_fk: $('[name="in_driver_citation_fk"]').val(),

        in_incident_description: $('[name="in_incident_description"]').val(),
        
        stops: issues_array,
        //stops: JSON.stringify(data_doc_array)
      }
      console.log(obj)
      $.ajax({
        url: window.location.pathname + '-action',
        type: 'POST',
        data: obj,
        success: function(data) {
          console.log(data)
          // alert(data)
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message);
          if (data.status) {
           wait_to_submit_btn('#submit', 'ADD')
           window.history.back();
         } else {
          wait_to_submit_btn('#submit', 'ADD')
        }
      }
    })
    }
    return false
  }
</script>

<script type="text/javascript">
  var counter = 1

  var $issue_table = $('#issue_table');

  function add_row(param) {

    ++counter;
    if (param.hasOwnProperty('default_in_doc_id')) {
      default_in_doc_id = param.default_in_doc_id
    } else {
      default_in_doc_id = ''
    }
    if (param.hasOwnProperty('default_select_in_document_id')) {
      default_select_in_document_id = param.default_select_in_document_id
    } else {
      default_select_in_document_id = ''
    }
    if (param.hasOwnProperty('default_select_in_document_required')) {
      default_select_in_document_required = param.default_select_in_document_required
    } else {
      default_select_in_document_required = ''
    }
    if (param.hasOwnProperty('default_in_incident_remarks')) {
      default_in_incident_remarks = param.default_in_incident_remarks
    } else {
      default_in_incident_remarks = ''
    }

    var $add_rowissue = `<tr id="issue_row${counter}"  data-stop-row>
    <td class="counter">${counter}</td>
    <td><input class="in_doc_id" name="in_doc_id" value='${default_in_doc_id}' type="text" disabled hidden></td>
    <td><select id="myselect1" class="" name="in_document_id" required>

    </select></td>
    <td><select id="myselect" style="width:90" name="in_document_required" required>
    <option value="">--Select--</option>
    <option value="YES" selected>Yes</option>
    <option value="NO">No</option>
    </select></td>
    <td><input type="text" style="width:300" name="in_document_remarks" value='${default_in_incident_remarks}'></td>
    <td><button type="button" class="btn_red_c" data-remove-drivers-button=""><i class="fa fa-trash"></i></button></td>

    </tr>`;
    $('#issue_table').append($add_rowissue);

        //$(`tr#issue_row${counter} [name="in_document_id"] option[value="${param.default_select_in_document_id}"]`).prop('selected',true);
        show_incident_documents_list('issue_row' + counter)
        $(`tr#issue_row${counter} [name="in_document_required"] option[value="${param.default_select_in_document_required}"]`).prop('selected',true);
      }
      $(document.body).on('click', '[data-remove-drivers-button=""]' ,function(){
        $(this).parent().parent().remove();
  // for re-calculating total amount code by swaran
  var a = 0;
  var b =0;
  $('[data-row-amount]').each(function(index,item){
    b = $(this).val();
    a = eval(a) + eval(b);
  })
  $('[data-total-amount]').val(a)
    // for re-calculating total amount code by swaran ENDS HERE
    // for re-setting dynamic-counter code by swaran
    counter = 1;
    $('.counter').each(function(index,item){
      counter= counter+1;
      $(this).html(counter)
    })
  });
    //-----------/remove stop
  </script>




  <script type="text/javascript">
    function show_drivers() {

      quick_list_drivers({status_ids:'ACTIVE'}).then(function(data) {

      // Run this when your request was successful

      if (data.status) {

        //Run this if response has list

        if (data.response.list) {

          var options = "";

          options += `<option value="">- - Select - -</option>`

          $.each(data.response.list, function(index, item) {

            options += `<option value="` + item.id + `">` + item.code + ' ' + item.name + `</option>`;

          })

          $('[data-filter="driver_id"]').html(options);
          select_default('[data-filter="driver_id"]')

        }

      }

    }).catch(function(err) {

      // Run this when promise was rejected via reject()

    })

  }

  show_drivers()
</script>
<script type="text/javascript">
  function show_unit_filter(param) {

    quick_list_trucks().then(function(data) {

      // Run this when your request was successful

      if (data.status) {

        //Run this if response has list

        if (data.response.list) {

          var options = "";

          options += `<option value="">- - Select - -</option>`

          $.each(data.response.list, function(index, item) {

            options += `<option value="` + item.id + `">` + item.code + `</option>`;

          })

          $('[data-filter="truck_id"]').html(options);
          select_default('[data-filter="truck_id"]')

        }

      }

    }).catch(function(err) {

      // Run this when promise was rejected via reject()

    })

  }

  show_unit_filter()
</script>
<script type="text/javascript">
  function show_unit_filter2(param) {

    quick_list_trailers().then(function(data) {

      // Run this when your request was successful

      if (data.status) {

        //Run this if response has list

        if (data.response.list) {

          var options = "";

          options += `<option value="">- - Select - -</option>`

          $.each(data.response.list, function(index, item) {
            //console.log(item)
            options += `<option value="` + item.id + `">` + item.code + `</option>`;

          })

          $('[data-filter="trailer_id"]').html(options);
          select_default('[data-filter="trailer_id"]')

        }

      }

    }).catch(function(err) {

      // Run this when promise was rejected via reject()

    })

  }

  show_unit_filter2()
</script>
<script type="text/javascript">
  function load_terminal() {

    get_companies().then(function(data) {

      // Run this when your request was successful

      if (data.status) {

        //Run this if response has list

        if (data.response.list) {

          var options = "";

          options += `<option value="">- - Select - -</option>`

          $.each(data.response.list, function(index, item) {
            //console.log(item)

            options += `<option value="` + item.id + `">` + item.name + `</option>`;

          })

          $('[data-filter="load_terminal_id"]').html(options);
          select_default('[data-filter="load_terminal_id"]')
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  load_terminal()
</script>


<script type="text/javascript">
  function driver_terminal() {
    get_companies().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            //console.log(item)
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[data-filter="driver_terminal_id"]').html(options);
          select_default('[data-filter="driver_terminal_id"]')
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  driver_terminal()
</script>

<script type="text/javascript">
  function show_states() {
    get_states().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            //console.log(item)
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[data-filter="state_id"]').html(options);
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_states()
</script>

<script type="text/javascript">  
  function show_cities(param) {
    get_cities(param).then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            //console.log(item)
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[name="in_accident_city_id_fk"]').html(options);
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
</script>

<script type="text/javascript">
  function show_accident_zip_codes(param){
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
      $('[name="in_accident_zip_id_fk"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
</script>

<script type="text/javascript">
  function show_drug_test_zip_codes(param){
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
      $('[name="in_drug_test_zip_id_fk"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
</script>

<script type="text/javascript">
  function show_drug_states() {
    get_states().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            //console.log(item)
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[data-filter="drug_state_id"]').html(options);
          select_default('[data-filter="drug_state_id"]')
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_drug_states()
</script>

<script type="text/javascript">
  function show_drug_cities(param) {
    get_cities(param).then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            //console.log(item)
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[name="in_drug_test_city_id"]').html(options);
          //select_default('[data-filter="drug_city_id"]')
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
</script>

<script type="text/javascript">

</script>

<?php

require_once APPROOT . '/views/includes/user/footer.php';

?>