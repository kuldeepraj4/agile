<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];

// echo "<pre>";
// print_r($details);
// echo "</pre>";

?>

<br><br>

<section class="lg-form-outer">

  <div class="lg-form-header">UPDATE - INCIDENT</div>

  <br>

  <div class="lg-form-header">Incident ID : <?php echo $details['id']; ?></div>
  <section class="lg-form" style="text-align:right;">
  <?php
  if (in_array('P0279', USER_PRIV)) {
  ?>
    <button class='btn_blue' onclick="location.href='../user/maintenance/incidents/details?eid=<?php echo $_GET['eid']; ?>'">View Incident/Change Status</button>
  <?php
  }
  ?>
  <?php
  if (in_array('P0279', USER_PRIV)) {
  ?>
    <button class='btn_blue' onclick="open_child_window({url:'../user/maintenance/incidents/quick-documents?eid=<?php echo $_GET['eid']; ?>',width:1000,height:700,name:'Upload-Documents'})">Upload/View Documents</button>
  <?php
  }
  ?>
  </section>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return update()">
    <input type="hidden" name="update_eid" value="<?php echo $details['eid']; ?>">

    <section class="section-111">

      <div>

        <fieldset>
          <legend>Basic Information</legend>
          <div class="field-section single-column" group-enable-disable>

          <div class="field-p">
              <label>Status</label>
               <div><?php echo $details['in_status_id'] ?></div>
            </div>


            <div class="field-p">

              <label>Date of Incident</label>

              <input name="in_incident_date" type="text" value="<?php echo $details['in_incident_date'] ?>" data-date-picker required>

            </div>

            <div class="field-p">

              <label>Date Reported</label>

              <input name="in_reported_date" type="text" value="<?php echo $details['in_reported_date'] ?>" data-date-picker required>

            </div>

            <div class="field-p">

              <label>Follow Up Date</label>

              <input name="in_followup_date" type="text" value="<?php echo $details['in_followup_date'] ?>" data-date-picker required>

            </div>

            <div class="field-p">

              <label>Load ID</label>

              <input name="in_load_id" type="text" value="<?php echo $details['in_load_id'] ?>">

            </div>

            <div class="field-p">

              <label>Load Terminal</label>

              <select name="in_load_terminal_id_fk" data-filter="load_terminal_id" data-default-select="<?php echo $details['in_load_terminal_id_fk'] ?>">

              </select>

            </div>

            <div class="field-p">

              <label>Driver Name</label>

              <select name="in_driver_id_fk" data-filter="driver_id" data-default-select="<?php echo $details['in_driver_id_fk'] ?>">

              </select>

            </div>

            <div class="field-p">

              <label>Driver Terminal</label>

              <select name="in_driver_terminal_id_fk" data-filter="driver_terminal_id" data-default-select="<?php echo $details['in_driver_terminal_id_fk'] ?>">

              </select>

            </div>

            <div class="field-p">

              <label>Truck ID</label>

              <select name="in_truck_id_fk" data-filter="truck_id" data-default-select="<?php echo $details['in_truck_id_fk'] ?>">

              </select>

            </div>
            <div class="field-p">

              <label>Trailer ID</label>

              <select name="in_trailer_id_fk" data-filter="trailer_id" data-default-select="<?php echo $details['in_trailer_id_fk'] ?>">

              </select>

            </div>

            <div class="field-p">

              <label>Owner</label>

              <select name="in_owner_id_fk" type="text" data-default-select="<?php echo $details['in_owner_id_fk'] ?>">
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

              <input name="in_overall_event_reserve" type="text" value="<?php echo $details['in_overall_event_reserve'] ?>">

            </div>

            <div class="field-p">

              <label>Initial Rep</label>

              <input name="in_initial_rep" type="text" value="<?php echo $details['in_initial_rep'] ?>">

            </div>

          </div>

        </fieldset>

      </div>

      <div>

        <fieldset>
          <legend>Location Information</legend>
          <div class="field-section single-column" group-enable-disable>

            <div class="field-p">

              <label>Location</label>

              <input name="in_accident_location_name" type="text" value="<?php echo $details['in_accident_location_name'] ?>" required>

            </div>

            <div class="field-p">
              <label>Address</label>
              <input name="in_accident_location_address" type="text" value="<?php echo $details['in_accident_location_address'] ?>" required>
            </div>

            <div class="field-p">
              <label>State</label>
              <select name="in_accident_state_id_fk" data-filter="state_id" onchange="show_cities({state_id:this.value})" data-default-select="<?php echo $details['in_accident_state_id_fk'] ?>" required></select>
            </div>

            <div class="field-p">
              <label>City</label>
              <select name="in_accident_city_id_fk" data-filter="city_id" onchange="show_accident_zip_codes({city_id:this.value})" data-default-select="<?php echo $details['in_accident_city_id_fk'] ?>" required></select>
            </div>

            <div class="field-p">
              <label>Zip</label>
              <select name="in_accident_zip_id_fk" data-filter="zip_id"></select>

            </div>

          </div>

        </fieldset>


        <fieldset>
          <legend>Drug Test Information</legend>
          <div class="field-section single-column" group-enable-disable>

            <div class="field-p">

              <label>DOT Reportable</label>
              <select id="mySelectDOT" name="in_dot_reportable_id_fk" data-filter="dot_reportable_id" data-default-select="<?php echo $details['in_dot_reportable_id_fk'] ?>" required data-optional>
                <option value="">--Select--</option>
                <option value="YES">Yes</option>
                <option value="NO">No</option>
              </select>


            </div>

            <div class="field-p">

              <label>Required</label>

              <select name="in_drug_test_required_id" type="text" data-default-select="<?php echo $details['in_drug_test_required_id_fk'] ?>" class="required" required>
                <option value="">--Select--</option>
                <option value="YES">Yes</option>
                <option value="NO">No</option>
              </select>

            </div>

            <div class="field-p">

              <label>Collected</label>

              <select name="in_drug_test_collected_id" type="text" data-default-select="<?php echo $details['in_drug_test_collected_id_fk'] ?>" class="collected" required>
                <option value="">--Select--</option>
                <option value="YES">Yes</option>
                <option value="NO">No</option>
              </select>

            </div>

            <div class="field-p">

              <label>Address</label>

              <input name="in_drug_test_address" type="text" value="<?php echo $details['in_drug_test_address'] ?>" class="address">

            </div>

            <div class="field-p">

              <label>State</label>

              <select name="in_drug_test_state_id_fk" type="text" data-filter="drug_state_id" onchange="show_drug_cities({state_id:this.value})" data-default-select="<?php echo $details['in_drug_test_state_id_fk'] ?>" class="state"></select>

            </div>

            <div class="field-p">

              <label>City</label>

              <!-- <select name="in_drug_test_city_id_fk" type="text" data-filter="drug_city_id" data-default-select="<?php echo $details['in_drug_test_city_id_fk'] ?>" class="city"></select> -->

              <select name="in_drug_test_city_id_fk" data-filter="drug_city_id" onchange="show_drug_test_zip_codes({city_id:this.value})" data-default-select="<?php echo $details['in_drug_test_city_id_fk'] ?>" class="city"></select>

            </div>

            <div class="field-p">

              <label>Zip</label>
              <select name="in_drug_test_zip_id_fk" data-filter="zip_id" class="city"></select>
            </div>

            <div class="field-p">

              <label>Phone</label>

              <input name="in_drug_test_phone_no" type="text" value="<?php echo $details['in_drug_test_phone_no'] ?>" class="phone">

            </div>

          </div>

        </fieldset>

        <fieldset>
          <legend>Other Party Details</legend>
          <div class="field-section single-column" group-enable-disable>

            <div class="field-p">
              <label>Company Name</label>
              <input type="text" name="other_claim_id" value="<?php echo $details['other_party_claim_id'] ?>" />
            </div>
            <div class="field-p">
              <label>Contact Person name</label>
              <input type="text" name="other_claim_name" value="<?php echo $details['other_party_adjusters_name'] ?>" />
            </div>
            <div class="field-p">
              <label>Contact Email ID</label>
              <input type="text" name="other_claim_email" value="<?php echo $details['other_party_adjusters_email'] ?>" />
            </div>
            <div class="field-p">
              <label>contact number</label>
              <input type="text" name="other_claim_contact" value="<?php echo $details['other_party_adjusters_phone'] ?>" />
            </div>

          </div>

        </fieldset>

      </div>

      <div>

        <fieldset>
          <legend>Police Department Information</legend>
          <div class="field-section" group-enable-disable>

            <div class="field-p">

              <label>Police Department</label>

              <input name="in_police_department" type="text" value="<?php echo $details['in_police_department'] ?>">

            </div>

            <div class="field-p">

              <label>Police Dept. Phone #</label>

              <input name="in_police_department_phone_no" type="text" value="<?php echo $details['in_police_department_phone_no'] ?>">

            </div>

            <div class="field-p">

              <label>Officer Name</label>

              <input name="in_office_name" type="text" value="<?php echo $details['in_office_name'] ?>">

            </div>

            <div class="field-p">

              <label>Police Report # </label>

              <input name="in_police_report_no" type="text" value="<?php echo $details['in_police_report_no'] ?>">

            </div>

            <div class="field-p">

              <label>Fatality</label>
              <select name="in_fatality_id_fk" data-filter="fatality_id" data-default-select="<?php echo $details['in_fatality_id_fk'] ?>" required>
                <option value="">--Select--</option>
                <option value="YES">Yes</option>
                <option value="NO">No</option>
              </select>

            </div>

            <div class="field-p">

              <label>Bodily Injury</label>
              <select name="in_bodily_injury_fk" data-filter="bodily_injury_id" data-default-select="<?php echo $details['in_bodily_injury_id_fk'] ?>" required>
                <option value="">--Select--</option>
                <option value="YES">Yes</option>
                <option value="NO">No</option>
              </select>

            </div>

            <div class="field-p">

              <label>Driver Citations</label>
              <select name="in_driver_citation_fk" data-filter="driver_citations_id" data-default-select="<?php echo $details['in_driver_citation_id_fk'] ?>" required>
                <option value="">--Select--</option>
                <option value="YES">Yes</option>
                <option value="NO">No</option>
              </select>

            </div>

          </div>

        </fieldset>

        <fieldset>

        </fieldset>

        <fieldset>
          <legend>Claim Information</legend>
          <div class="field-section single-column" group-enable-disable>

            <div class="field-p">
              <label>Cargo Claim</label>
              <input type='checkbox' class='chkbox' name='in_cargo_checked' id='in_cargo_checkedbox' onclick="ShowHideDiv(this)">
            </div>

            <div id="in_cargo_checked" style="display: none">
              <div class="field-p">
                <label>Claim Id</label>
                <input type="text" id="cargoclaimid" value="<?php echo $details['cargo_name'] ?>" />
              </div>
              <div class="field-p">
                <label>Adjusters name</label>
                <input type="text" name="cargo_adjusters_name" value="<?php echo $details['cargo_adjusters_name'] ?>" />
              </div>
              <div class="field-p">
                <label>Adjusters Email ID</label>
                <input type="text" name="cargo_adjusters_email" value="<?php echo $details['cargo_adjusters_email'] ?>" />
              </div>
              <div class="field-p">
                <label>Adjusters contact number</label>
                <input type="text" name="cargo_adjusters_contact" value="<?php echo $details['cargo_adjusters_phone'] ?>" />
              </div>
            </div>

            <div class="field-p">
              <label>Physical Damage</label>
              <input type='checkbox' class='chkbox' name='in_physical_checked' id='in_physical_checkedbox' onclick="ShowHideDiv1(this)">
            </div>

            <div id="in_physical_checked" style="display: none">
              <div class="field-p">
                <label>Claim Id</label>
                <input type="text" id="physicalid" value="<?php echo $details['physical_name'] ?>" />
              </div>
              <div class="field-p">
                <label>Adjusters name</label>
                <input type="text" name="phys_adjusters_name" value="<?php echo $details['physical_adjusters_name'] ?>" />
              </div>
              <div class="field-p">
                <label>Adjusters Email ID</label>
                <input type="text" name="phys_adjusters_email" value="<?php echo $details['physical_adjusters_email'] ?>" />
              </div>
              <div class="field-p">
                <label>Adjusters contact number</label>
                <input type="text" name="phys_adjusters_contact" value="<?php echo $details['physical_adjusters_phone'] ?>" />
              </div>
            </div>

            <div class="field-p">
              <label>Third Party Damage</label>
              <input type='checkbox' class='chkbox' name='in_third_party_checked' id='in_third_party_checkedbox' onclick="ShowHideDiv2(this)">
            </div>

            <div id="in_third_party_checked" style="display: none">
              <div class="field-p">
                <label>Claim Id</label>
                <input type="text" id="thirdparty" value="<?php echo $details['third_party_name'] ?>" />
              </div>
              <div class="field-p">
                <label>Adjusters name</label>
                <input type="text" name="thirdparty_adjusters_name" value="<?php echo $details['third_party_adjusters_name'] ?>" />
              </div>
              <div class="field-p">
                <label>Adjusters Email ID</label>
                <input type="text" name="thirdparty_adjusters_email" value="<?php echo $details['third_party_adjusters_email'] ?>" />
              </div>
              <div class="field-p">
                <label>Adjusters contact number</label>
                <input type="text" name="thirdparty_adjusters_contact" value="<?php echo $details['third_party_adjusters_phone'] ?>" />
              </div>
            </div>


            <div class="field-p">
              <label>Claim Type</label>
              <select name="in_claim_type_id_fk" data-filter="in_claim_type_id_fk" data-default-select="<?php echo $details['in_claim_type_id_fk'] ?>"></select>
            </div>
            <div class="field-p">
              <label>Remarks</label>
              <textarea name="in_claim_remarks" class="control-enable-disable" style="height: 100px"><?php echo $details['in_claim_remarks'] ?></textarea>
            </div>
          </div>
        </fieldset>
      </div>
    </section>

    <section class="section-1" style="width:100%">
      <div>
        <fieldset>
          <legend>Incident Description</legend>
          <div class="field-section single-column" group-enable-disable>
            <div class="field-p">
              <textarea name="in_incident_description" class="control-enable-disable" style="height: 100px" required><?php echo $details['in_incident_description'] ?></textarea>
            </div>
          </div>
        </fieldset>
      </div>
    </section>

    <section class="section-1" style="width:100%">

      <div>

        <fieldset>

          <legend>List of Documents</legend>
          <div class="field-section table-rows" group-enable-disable>
            <table style="width: 100%">
              <thead>
                <tr>

                  <th>Sr. No.</th>
                  <th></th>
                  <th>Document ID</th>
                  <th>Document Required</th>
                  <th>Remarks</th>
                  <th></th>
                  <th>Upload</th>
                  <th></th>
                  <th>View File</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="issue_table">
                <!-- <tr id="issue_row1" data-stop-row>
                  <td>1</td>
                  <td><input type="text" class="w-150" name="document_id" required></td>
                  <td><select class="w-150" name="document_required" required></select></td>
                  <td><input type="text" class="w-150" name="document_remarks" required></td>
                  <td></td>
                </tr> -->
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="10">
                    <!-- <button type="button" class="btn_blue" xyz onclick="add_row({})">Add Row</button> -->
                    <?php
                    echo '<button type="button" class="btn_blue add-row" onclick="add_row({})">Add Row</button>';
                    ?>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </fieldset>
      </div>
    </section>
    <section class="action-button-box">

      <!-- <button type="submit" class="btn_green">SAVE</button>
        <span style="background-color:#296327;color:white;border-radius:3px;padding:5px 5px;cursor: pointer;margin-left:10px" onclick="window.history.back()">BACK</span> -->

      <!-- <button type="submit" class="btn_green abc">SAVE</button> -->
      <?php
      echo '<button type="submit" class="btn_green save">SAVE</button>';
      ?>
      &nbsp &nbsp
      <button type="button" class="btn_green" onclick="back_alert()">BACK</button>
    </section>

  </form>

</section>

<script type="text/javascript">
  function ShowHideDiv(chkPassport) {
    var dvPassport = document.getElementById("in_cargo_checked");
    dvPassport.style.display = chkPassport.checked ? "block" : "none";
  }

  function ShowHideDiv1(chkPassport) {
    var dvPassport = document.getElementById("in_physical_checked");
    dvPassport.style.display = chkPassport.checked ? "block" : "none";
  }

  function ShowHideDiv2(chkPassport) {
    var dvPassport = document.getElementById("in_third_party_checked");
    dvPassport.style.display = chkPassport.checked ? "block" : "none";
  }
</script>

<!-- <script type="text/javascript">
  function show_status_filter() {
    get_repair_order_status().then(function(data) {
      if (data.status) {
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[name="in_status_id"]').html(options);
          select_default('[name="in_status_id"]')
        }
      }
    }).catch(function(err) {})
  }
  show_status_filter()
</script> -->
<!-- <script type="text/javascript">
  $(document).on('change', '[name="in_status_id"]', function() {
    //alert($('[name="refnocount"]').val());
    //lert($(this).val());
    if ($('[name="refnocount"]').val() != "" && ($(this).val() == "RESOLVED" ||
        $(this).val() == "CLOSED" || $(this).val() == "OPEN" ||
        $(this).val() == "RFC")) {
      if (confirm('Do you want to update status ?')) {
        $.ajax({
          //url:window.location.pathname+'/../update-status-action',
          url: '<?php //echo AJAXROOT; ?>/user/maintenance/incidents/update-status-action',
          type: 'POST',
          data: {
            eid: '<?php //echo $details['eid'] ?>',
            status: $(this).val()
          },
          context: this,
          success: function(data) {
            if ((typeof data) == 'string') {
              data = JSON.parse(data)
            }
            //alert(data.message)
            if (data.status) {
              alert(data.message)
            } else {
              alert(data.message);
              window.location.reload();
            }
          }
        })
      } else {
        window.location.reload();
      }
    } else if ($('[name="refnocount"]').val() == "" && ($(this).val() == "OPEN" || $(this).val() == "RFC")) {
      if (confirm('Do you want to update status ?')) {
        $.ajax({
          url: window.location.pathname + '/../update-status-action',
          type: 'POST',
          data: {
            eid: '<?php //echo $details['eid'] ?>',
            status: $(this).val()
          },
          context: this,
          success: function(data) {
            if ((typeof data) == 'string') {
              data = JSON.parse(data)
            }
            //alert(data.message)
            if (data.status) {
              alert(data.message)
            } else {
              alert(data.message);
              window.location.reload();
            }
          }
        })
      } else {
        window.location.reload();
      }
    } else if ($('[name="refnocount"]').val() == "" && ($(this).val() == "CLOSED")) {
      if ($('[name="cargo_name"]').val() !== "" || $('[name="physical_name"]').val() !== "" || $('[name="third_party_name"]').val() !== "") {
        if (confirm('Do you want to update status ?')) {
          $.ajax({
            url: window.location.pathname + '/../update-status-action',
            type: 'POST',
            data: {
              eid: '<?php //echo $details['eid'] ?>',
              status: $(this).val()
            },
            context: this,
            success: function(data) {
              if ((typeof data) == 'string') {
                data = JSON.parse(data)
              }
              //alert(data.message)
              if (data.status) {
                alert(data.message)
              } else {
                alert(data.message);
                window.location.reload();
              }
            }
          })
        } else {
          window.location.reload();
        }
      } else {
        alert("Claim information OR Claim No does not exist for this record you need to add one option value in edit incidents");
        window.location.reload();
      }
    } else {
      alert("Claim information does not exist for this record");
      window.location.reload();
    }
  })
</script> -->


</script>

<script type="text/javascript">
  function show_incident_documents_list(param) {
    get_incident_documents_list().then(function(data) {
      if (data.status) {
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            if (item.status == 'ACTIVE') {
              options += `<option value="` + item.id + `">` + item.name + `</option>`;
            }
          })
          $('tr#' + param.row_id + ' [name="in_document_id"]').html(options);
          if (param.hasOwnProperty('default_select')) {
            $('tr#' + param.row_id + ' [name="in_document_id"] option[value="' + param.default_select + '"]').prop('selected', true);
          }
        }
      }
    }).catch(function(err) {})
  }
  show_incident_documents_list('issue_row1')
</script>

<script type="text/javascript">
  var status = '<?php echo $details['in_status_id']; ?>';
  if (status === "CLOSED") {
    //$(".save").prop('disabled', true)
    //$(".add-row").prop('disabled', true)
    $(document).find('input, select, .save, .add-row, textarea').prop('disabled', true);
    //$(".control-enable-disable").prop('disabled', true)
  } else if (status === "OPEN") {
    // $(".save").prop('disabled', false)
    // $(".add-row").prop('disabled', false)
    $(document).find('input, select, .save, .add-row, textarea').prop('disabled', false);
    // $(".control-enable-disable").prop('disabled', false)
  }
</script>

<script type='text/javascript'>
  function back_alert() {
    if (confirm('Are you sure to go back?')) {
      window.history.back();
      //window.location.href = '../user/maintenance/inspection-sheet';
    }
  }
</script>

<script type="text/javascript">
  $(document).ready(function() {
    var disableText = '<?php echo $details['in_dot_reportable_id_fk']; ?>';
    checkValidityDOT(disableText);
    var cargo_name = '<?php echo $details['cargo_name']; ?>';
    var physical_name = '<?php echo $details['physical_name']; ?>';
    var third_party_name = '<?php echo $details['third_party_name']; ?>';
    if (cargo_name != "") {
      var dvPassport = document.getElementById("in_cargo_checked");
      dvPassport.style.display = "block";
      document.getElementById('in_cargo_checkedbox').checked = true;
    }
    if (physical_name != "") {
      var dvPassport = document.getElementById("in_physical_checked");
      dvPassport.style.display = "block";
      document.getElementById('in_physical_checkedbox').checked = true;
    }
    if (third_party_name != "") {
      var dvPassport = document.getElementById("in_third_party_checked");
      dvPassport.style.display = "block";
      document.getElementById('in_third_party_checkedbox').checked = true;
    }
  });

  function checkValidityDOT(disableText) {
    var status = '<?php echo $details['in_status_id']; ?>';
    if (status == "CLOSED") {
      var value = "NO";
    } else {
      var value = disableText;
    }
    if (value === "YES") {
      $(".required,.collected,.address,.state,.city,.zip,.phone").prop('disabled', false);
      // $(".required").prop('disabled', false)
      // $(".collected").prop('disabled', false)
      // $(".address").prop('disabled', false)
      // $(".state").prop('disabled', false)
      // $(".city").prop('disabled', false)
      // $(".zip").prop('disabled', false)
      // $(".phone").prop('disabled', false)
    } else if (value === "NO" || value === "") {
      $(".required,.collected,.address,.state,.city,.zip,.phone").prop('disabled', true).val('');
      // $(".required").prop('disabled', true)
      // $(".collected").prop('disabled', true)
      // $(".address").prop('disabled', true)
      // $(".state").prop('disabled', true)
      // $(".city").prop('disabled', true)
      // $(".zip").prop('disabled', true)
      // $(".phone").prop('disabled', true)
    }
    // else if (value === "") {
    //   $(".required").prop('disabled', true)
    //   $(".collected").prop('disabled', true)
    //   $(".address").prop('disabled', true)
    //   $(".state").prop('disabled', true)
    //   $(".city").prop('disabled', true)
    //   $(".zip").prop('disabled', true)
    //   $(".phone").prop('disabled', true)
    // }
  }
</script>

<script type="text/javascript">
  $(document.body).on('change', '#mySelectDOT', function() {
    var status = '<?php echo $details['in_status_id']; ?>';
    if (status == "CLOSED") {
      var value = "NO";
    } else {
      var value = $(this).val();
    }
    if (value === "YES") {
      $(".required,.collected,.address,.state,.city,.zip,.phone").prop('disabled', false);
      // $(".collected").prop('disabled', false)
      // $(".address").prop('disabled', false)
      // $(".state").prop('disabled', false)
      // $(".city").prop('disabled', false)
      // $(".zip").prop('disabled', false)
      // $(".phone").prop('disabled', false)
    } else if (value === "NO" || value === "") {
      $(".required,.collected,.address,.state,.city,.zip,.phone").prop('disabled', true).val('');
      // $(".required").prop('disabled', true)
      // $(".collected").prop('disabled', true)
      // $(".address").prop('disabled', true)
      // $(".state").prop('disabled', true)
      // $(".city").prop('disabled', true)
      // $(".zip").prop('disabled', true)
      // $(".phone").prop('disabled', true)
    }
    // else if (value === "") {
    //   $(".required").prop('disabled', true)
    //   $(".collected").prop('disabled', true)
    //   $(".address").prop('disabled', true)
    //   $(".state").prop('disabled', true)
    //   $(".city").prop('disabled', true)
    //   $(".zip").prop('disabled', true)
    //   $(".phone").prop('disabled', true)
    // }
  });
</script>

<script type="text/javascript">
  function update() {
    //submit_to_wait_btn('#submit','loading')
    $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    var formData = new FormData(currentForm);

    var cargo = "";
    if ($('#in_cargo_checkedbox').is(":checked") && $('#cargoclaimid').val() != "") {
      cargo = $('#cargoclaimid').val();
    }
    if ($('#in_cargo_checkedbox').is(":checked") && $('#cargoclaimid').val() == "") {
      alert('Please add Cargo Claim id');
      return;
    }
    var physical = "";
    if ($('#in_physical_checkedbox').is(":checked") && $('#physicalid').val() != "") {
      physical = $('#physicalid').val();
    }
    if ($('#in_physical_checkedbox').is(":checked") && $('#physicalid').val() == "") {
      alert('Please add Physical Damage Claim id');
      return;
    }
    var third_party = "";
    if ($('#in_third_party_checkedbox').is(":checked") && $('#thirdparty').val() != "") {
      third_party = $('#thirdparty').val();
    }
    if ($('#in_third_party_checkedbox').is(":checked") && $('#thirdparty').val() == "") {
      alert('Please add Third Party Damage Claim id');
      return;
    }
    //console.log(cargo);
    //console.log(physical);
    //console.log(third_party);


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
          in_document_docpath: $data_stop_row.find('[name="in_document_docpath"]').val(),
          in_document_checked: ($data_stop_row.find('[name="in_documents_checked"]').prop('checked') == true) ? 'ON' : 'OFF'
        }
        issues_array.push(stop_row)
      })

      var obj = {
        update_eid: $('[name="update_eid"]').val(),
        //in_status_id_fk: $('[name="in_status_id"]').val(),
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
        in_drug_test_state_id_fk: $('[name="in_drug_test_state_id_fk"]').val(),
        in_drug_test_city_id_fk: $('[name="in_drug_test_city_id_fk"]').val(),
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

        in_claim_type_id_fk: $('[name="in_claim_type_id_fk"]').val(),
        in_claim_remarks: $('[name="in_claim_remarks"]').val(),


        other_claim_id: $('[name="other_claim_id"]').val(),
        other_claim_name: $('[name="other_claim_name"]').val(),
        other_claim_email: $('[name="other_claim_email"]').val(),
        other_claim_contact: $('[name="other_claim_contact"]').val(),

        cargo_adjusters_name: $('[name="cargo_adjusters_name"]').val(),
        cargo_adjusters_email: $('[name="cargo_adjusters_email"]').val(),
        cargo_adjusters_contact: $('[name="cargo_adjusters_contact"]').val(),


        phys_adjusters_name: $('[name="phys_adjusters_name"]').val(),
        phys_adjusters_email: $('[name="phys_adjusters_email"]').val(),
        phys_adjusters_contact: $('[name="phys_adjusters_contact"]').val(),

        thirdparty_adjusters_name: $('[name="thirdparty_adjusters_name"]').val(),
        thirdparty_adjusters_email: $('[name="thirdparty_adjusters_email"]').val(),
        thirdparty_adjusters_contact: $('[name="thirdparty_adjusters_contact"]').val(),


        stops: issues_array,

        cargo: cargo,
        physical: physical,
        third_party: third_party
        //stops: JSON.stringify(data_doc_array)
      }

      //console.log(obj)

      $.ajax({
        url: window.location.pathname + '-action',
        type: 'POST',
        data: obj,
        success: function(data) {
          //console.log(data)
          // alert(data)
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
        }
      })
    }
    return false
  }
</script>

<script type="text/javascript">
  var counter = 0
  var status = '<?php echo $details['in_status_id']; ?>';
  if (status === "CLOSED") {
    var $disabled = 'disabled';
  }
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
    if (param.hasOwnProperty('default_in_incident_filename')) {
      default_in_incident_filename = param.default_in_incident_filename
    } else {
      default_in_incident_filename = ''
    }
    if (param.hasOwnProperty('default_in_incident_filepath')) {
      default_in_incident_filepath = param.default_in_incident_filepath
    } else {
      default_in_incident_filepath = ''
    }

    var addrefdoc = "";
    if (default_in_doc_id != '') {
      addrefdoc = "<td><button title='Upload' type='button' class='btn_grey_c upload' " + $disabled + "><i class='fa fa-upload'></i></button></td>";
    } else {
      addrefdoc = "<td><button title='Upload' type='button' class='btn_grey_c upload' " + $disabled + "><i class='fa fa-upload' hidden></i></button></td>";
    }

    var viewrefdoc = "<td><button title='open' type='button' class='btn_grey_c opendoc'  " + $disabled + "><i class='fa fa-file'></i></button>";
    if (default_in_incident_filename == '') {
      viewrefdoc = "<td></td>";
    }

    var deldoc = "";
    if (default_in_doc_id != '') {
      if (default_in_incident_filename != '') {
        deldoc = "<td><input type='checkbox' class='chkbox' name='in_documents_checked' checked disabled " + $disabled + "></td>";
      } else {
        deldoc = "<td><input type='checkbox' class='chkbox' name='in_documents_checked' checked " + $disabled + "></td>";
      }
    } else {
      deldoc = "<td><button type='button' class='btn_red_c' data-remove-button><i class='fa fa-trash'></i></button></td>";
    }


    var $add_rowissue = `<tr id="issue_row${counter}" data-stop-row>
    <td class="counter">${counter}</td>
    <td><input style="width:50" class="in_doc_id" name="in_doc_id" value='${default_in_doc_id}' type="text" disabled hidden ${$disabled}> </td>
    <td><select id="myselect1" name="in_document_id" ${$disabled}>
    </select></td>
    <td><select id="myselect" style="width:90" name="in_document_required" ${$disabled}>
    <option value="">--Select--</option>
    <option value="YES" selected>Yes</option>
    <option value="NO">No</option>
    </select></td>
    <td><input type="text" style="width:300" name="in_document_remarks" ${$disabled} value='${default_in_incident_remarks}'></td>

    <td><input class="w-150 in_document_docpath" ${$disabled} name="in_document_docpath" value='${default_in_incident_filepath}' type="text" disabled hidden></td>

    ${addrefdoc}
    <td><input class="text in_document_filename"  style="width:225" name="in_document_filename" value='${default_in_incident_filename}' type="text" disabled hidden></td>
    ${viewrefdoc}
    ${deldoc}
    </td>

    
    </tr>`;

    $('#issue_table').append($add_rowissue);
    //$(`tr#issue_row${counter} [name="in_document_id"] option[value="${param.default_select_in_document_id}"]`).prop('selected',true);
    show_incident_documents_list({
      row_id: 'issue_row' + counter,
      default_select: default_select_in_document_id
    })

    $(`tr#issue_row${counter} [name="in_document_required"] option[value="${param.default_select_in_document_required}"]`).prop('selected', true);
  }
  $(document.body).on('click', '[data-remove-button]', function() {
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
  //-----------/remove stop
</script>
<script type="text/javascript">
  $(document.body).on('click', '.upload', function() {
    var in_doc_id = $(this).parent().siblings().find('.in_doc_id').val()
    if (in_doc_id == '') {
      alert("Save Record First");
    } else {
      open_child_window({
        url: '../user/maintenance/incidents/upload-document?eid=<?php echo $details['eid'] ?>&doc_id=' + in_doc_id,
        width: 600,
        height: 500
      });
      //window.location.href = '../user/maintenance/incidents/upload-document?eid=<?php echo $details['eid'] ?>&doc_id='+ in_doc_id;
    }
  });
</script>

<script type="text/javascript">
  $(document.body).on('click', '.opendoc', function() {
    var in_document_filename = $(this).parent().siblings().find('.in_document_filename').val()
    var in_document_filepath = $(this).parent().siblings().find('.in_document_docpath').val()
    if (in_document_filename == '') {
      alert("Upload Document First");
    } else {
      open_document(in_document_filepath);
    }
  });
</script>

<script type="text/javascript">
  function show_drivers() {

    quick_list_drivers().then(function(data) {

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
  function show_claim_filter(param) {
    get_claim_type_list().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[data-filter="in_claim_type_id_fk"]').html(options);
          select_default('[data-filter="in_claim_type_id_fk"]')
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_claim_filter()
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
          select_default('[data-filter="state_id"]')

          show_cities({
            state_id: '<?php echo $details['in_accident_state_id_fk']; ?>'
          });
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
          $('[name="in_accident_city_id_fk"] option[value="<?php echo $details['in_accident_city_id_fk']; ?>"]').prop('selected', true);

          show_accident_zip_codes({
            city_id: '<?php echo $details['in_accident_city_id_fk']; ?>'
          });
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
</script>

<script type="text/javascript">
  function show_accident_zip_codes(param) {
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
          $('[name="in_accident_zip_id_fk"]').html(options);
          $('[name="in_accident_zip_id_fk"] option[value="<?php echo $details['in_accident_zip_code']; ?>"]').prop('selected', true);
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
</script>

<script type="text/javascript">
  function show_drug_test_zip_codes(param) {
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
          $('[name="in_drug_test_zip_id_fk"]').html(options);
          $('[name="in_drug_test_zip_id_fk"] option[value="<?php echo $details['in_drug_test_zipe_code']; ?>"]').prop('selected', true);
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

          show_drug_cities({
            state_id: '<?php echo $details['in_drug_test_state_id_fk']; ?>'
          });
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
          $('[name="in_drug_test_city_id_fk"]').html(options);
          $('[name="in_drug_test_city_id_fk"] option[value="<?php echo $details['in_drug_test_city_id_fk']; ?>"]').prop('selected', true);

          show_drug_test_zip_codes({
            city_id: '<?php echo $details['in_drug_test_city_id_fk']; ?>'
          });
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
</script>

<script type="text/javascript">
  async function f() {
    var issue_list = '<?php echo json_encode($details['in_doc_list']) ?>';
    issue_list = JSON.parse(issue_list)
    //console.log(issue_list)
    $.each(issue_list, function(index, item) {
      add_row({
        default_in_doc_id: item.in_doc_id,
        default_select_in_document_id: item.in_document_id,
        default_select_in_document_required: item.in_document_required,
        default_in_incident_remarks: item.in_incident_remarks,
        default_in_incident_filename: item.in_document_filename,
        default_in_incident_filepath: item.in_document_filepath,
      })
    })
  }
  f()
</script>

<!-- <section class = 'list-200 content-box' style = 'margin: auto;max-width: 1200px'>
  <h1 class = 'list-200-heading'>Documents List</h1>
  <section class = 'list-200-top-section'>
    <div>
    </div>
    <div>
    </div>
  </section>
  <div class = 'table  table-a'>
    <table data-document-table>
      <thead>
        <tr>
          <th style="width: 10%">Sr. No.</th>
          <th style="width: 30%; text-align: left;">Name</th>
          <th style="width: 40%;text-align: left;">Remarks</th>
          <th style="width: 20%;">Uploaded By</th>
          <th></th>
        </tr>
      </thead>
      <tbody data-documents-list></tbody>
      <tfoot>
       <tr><td colspan="3"></td><td style="padding: 4px;text-align: right;"><button type="button" class="btn_blue" onclick="open_child_window({url:'../user/maintenance/incidents/upload-document&eid=<?php echo $details['eid'] ?>&doc_id=',width:600,height:500})">Add Document</button></td></tr>
     </tfoot>
   </table>
 </div>
</section> -->

<br><br>

<script type='text/javascript'>
  function show_documents() {
    $.ajax({
      url: '<?php echo AJAXROOT; ?>/user/maintenance/incidents/documents-list-ajax',
      type: 'POST',
      data: {
        incident_eid: '<?php echo $details['eid']; ?>'
      },
      beforeSend: function(data) {
        show_table_data_loading('[data-document-table]')
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          $('[data-documents-list]').html('');
          if (data.status) {
            var counter = 0;
            $.each(data.response.list, function(index, item) {
              var row = `<tr>
              <td>${++counter}</td>
              <td style ='text-align: left;' class="text-link" onclick="open_document('${item.file_path}')">${item.name}</td>
              <td style ='text-align: left;'>${item.remarks}</td>
              <td>${item.added_by_user_code} - ${item.added_by_user_name} - ${item.added_on_datetime}</td>
              </tr>`;
              $('[data-documents-list]').append(row);
            })
          } else {
            var false_message = `<tr><td colspan = '4'>` + data.message + `<td></tr>`;
            $('[data-documents-list]').html(false_message);
          }
        }
      }
    })
  }
  show_documents()
</script>

<script type='text/javascript'>
  function show_resetincidentwindow() {
    window.location.reload();
  }
</script>

<?php

require_once APPROOT . '/views/includes/user/footer.php';

?>