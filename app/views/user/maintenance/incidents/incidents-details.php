<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];

// echo "<pre>";
// print_r($details);
// echo "</pre>";

?>

<br><br>

<section class="lg-form-outer">

    <div class="lg-form-header">VIEW DETAIL - INCIDENT</div>

    <br>

    <div class="lg-form-header">Incident ID : <?php echo $details['id']; ?></div>
    <section class="lg-form" style="text-align:right;">
    <?php
  if (in_array('P0280', USER_PRIV)) {
  ?>
    <button class='btn_blue' onclick="location.href='../user/maintenance/incidents/update?eid=<?php echo $_GET['eid']; ?>'">Edit Incident</button>
  <?php
  }
  ?>
  </section>
    <form class="lg-form" method="POST" id="MyForm" onsubmit="return update()">
        <input type="hidden" name="refnocount" id="refnocount" value="<?php echo $details['in_claim_type_name_fk'] ?>">

        <input type="hidden" name="cargo_name" id="cargo_name" value="<?php echo $details['cargo_name'] ?>">
        <input type="hidden" name="physical_name" id="physical_name" value="<?php echo $details['physical_name'] ?>">
        <input type="hidden" name="third_party_name" id="third_party_name" value="<?php echo $details['third_party_name'] ?>">

        <section class="section-111">
            <div></div>
            <div>
                <fieldset>
                    <legend>Status</legend>
                    <div class="field-section single-column">
                    <div class="field-p">
                  <label>Status</label>
                  <select name="status"  <?php if (!in_array('P0280', USER_PRIV)) { echo 'disabled'; }; ?> data-default-select="<?php echo $details['in_status_id']?>">
                  </select>
              </div>

                        <!-- <div class="field-section single-column">
                <div class="field-p">
              <label>Remarks</label>
              <textarea name="in_remarks" class="control-enable-disable" style="height: 100px"><?php //echo $details['in_remarks'] ?></textarea>
            </div> -->
                    </div>
                </fieldset>
                <br>
                <fieldset>
                    <legend>Claim Information</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Claim Type</label>
                            <div name="in_claim_type_name_fk"><?php echo $details['in_claim_type_name_fk'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Remarks</label>
                            <div name="in_claim_remarks"><?php echo $details['in_claim_remarks'] ?></div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <script type="text/javascript">
    $(document).on('change', '[name="status"]', function() {
          //alert($('[name="refnocount"]').val());
          //lert($(this).val());
          if($('[name="refnocount"]').val() !="" && ($(this).val() == "RESOLVED" 
            || $(this).val() == "CLOSED" || $(this).val() == "OPEN" 
            || $(this).val() == "RFC")) {
              if(confirm('Do you want to update status ?')){
                $.ajax({
                  //url:window.location.pathname+'/../update-status-action',
                  url:'<?php echo AJAXROOT; ?>/user/maintenance/incidents/update-status-action',
                  type:'POST',
                  data:{
                    eid:'<?php echo $details['eid'] ?>',
                    status:$(this).val()
                },
                context: this,
                success:function(data){
                    if((typeof data)=='string'){
                     data=JSON.parse(data) 
                 }
                   //alert(data.message)
                   if(data.status){
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
        if(confirm('Do you want to update status ?')){
            $.ajax({
              url:window.location.pathname+'/../update-status-action',
              type:'POST',
              data:{
                eid:'<?php echo $details['eid'] ?>',
                status:$(this).val()
            },
            context: this,
            success:function(data){
                if((typeof data)=='string'){
                 data=JSON.parse(data) 
             }
                   //alert(data.message)
                   if(data.status){
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
      if($('[name="cargo_name"]').val()!=="" || $('[name="physical_name"]').val()!==""  || $('[name="third_party_name"]').val()!=="" ) {
          if(confirm('Do you want to update status ?')){
              $.ajax({
                url:window.location.pathname+'/../update-status-action',
                type:'POST',
                data:{
                  eid:'<?php echo $details['eid'] ?>',
                  status:$(this).val()
              },
              context: this,
              success:function(data){
                if((typeof data)=='string'){
                  data=JSON.parse(data) 
                }
                //alert(data.message)
                if(data.status){
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
        alert("Cargo Claim Information OR Physical Damage OR Third Party Damage does not exist for this record you need to add one option value in edit incidents");
        window.location.reload();
      }
  } else {
    alert("Claim information does not exist for this record");
    window.location.reload();
  }
})
</script>
            <div></div>
        </section>

        <section class="section-111">
            <div>
                <fieldset>
                    <legend>Basic Information</legend>
                    <div class="field-section single-column">

                        <div class="field-p">

                            <label>ID</label>

                            <div><?php echo $details['id']; ?></div>

                        </div>

                        <!-- <div class="field-p">

                    <label>Status</label>

                    <div><?php echo $details['in_status_id'] ?>
                </div>
            </div> -->

                        <div class="field-p">

                            <label>Date of Incident</label>

                            <div><?php echo $details['in_incident_date'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Date Reported</label>

                            <div><?php echo $details['in_reported_date'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Follow Up Date</label>

                            <div><?php echo $details['in_followup_date'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Close Date</label>

                            <div><?php echo $details['in_close_date'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Load ID</label>

                            <div><?php echo $details['in_load_id'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Load Terminal</label>

                            <div><?php echo $details['in_load_terminal_name_fk'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Driver Name</label>

                            <div><?php echo $details['in_driver_code_fk'] ?> - <?php echo $details['in_driver_name_fk'] ?>

                            </div>

                        </div>

                        <div class="field-p">

                            <label>Driver Terminal</label>
                            <div><?php echo $details['in_driver_terminal_name_fk'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Truck ID</label>
                            <div><?php echo $details['in_truck_name_fk'] ?></div>

                        </div>
                        <div class="field-p">

                            <label>Trailer ID</label>
                            <div><?php echo $details['in_trailer_name_fk'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Owner</label>
                            <div><?php echo $details['in_owner_name_fk'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Broker Carrier</label>
                            <div><?php echo $details['in_broker_carrier_id'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Overall Event Reserve</label>

                            <div><?php echo $details['in_overall_event_reserve'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Initial Rep</label>

                            <div><?php echo $details['in_initial_rep'] ?></div>

                        </div>

                    </div>

                </fieldset>

            </div>

            <div>

                <fieldset>
                    <legend>Location Information</legend>
                    <div class="field-section single-column">

                        <div class="field-p">

                            <label>Location</label>

                            <div><?php echo $details['in_accident_location_name'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Address</label>

                            <div><?php echo $details['in_accident_location_address'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>State</label>
                            <!-- <div name="in_accident_state_id_fk" data-filter="state_id" onchange="show_cities({state_id:this.value})" data-default-select="<?php echo $details['in_accident_state_id_fk'] ?>"></div> -->
                            <div><?php echo $details['in_accident_state_name_fk'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>City</label>
                            <!-- <select name="in_accident_city_id_fk" data-filter="city_id" onchange="show_address_zipcodes({city_id:this.value})" data-default-select="<?php echo $details['in_accident_city_id_fk'] ?>"></select> -->
                            <div><?php echo $details['in_accident_city_name_fk'] ?></div>
                        </div>

                        <div class="field-p">

                            <label>Zip</label>

                            <!-- <select name="in_accident_zip_code" data-default-select=""></select> -->
                            <div><?php echo $details['in_accident_zip_name_fk'] ?></div>

                        </div>
                    </div>

                </fieldset>

                <fieldset>
                    <legend>Drug Test Information</legend>
                    <div class="field-section single-column">

                        <div class="field-p">

                            <label>Required</label>

                            <div><?php echo $details['in_drug_test_required_id_fk'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Collected</label>

                            <div><?php echo $details['in_drug_test_collected_id_fk'] ?></div>


                        </div>

                        <div class="field-p">

                            <label>Address</label>

                            <div><?php echo $details['in_drug_test_address'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>State</label>
                            <div><?php echo $details['in_drug_test_state_name_fk'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>City</label>
                            <div><?php echo $details['in_drug_test_city_name_fk'] ?></div>

                        </div>
                        <div class="field-p">

                            <label>Zip</label>
                            <div><?php echo $details['in_drug_test_zipe_code'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Phone</label>

                            <div><?php echo $details['in_drug_test_phone_no'] ?></div>

                        </div>

                    </div>

                </fieldset>

            </div>

            <div>

                <fieldset>
                    <legend>Police Department Information</legend>
                    <div class="field-section">

                        <div class="field-p">

                            <label>Police Dept. Phone #</label>

                            <div><?php echo $details['in_police_department_phone_no'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Officer Name</label>

                            <div><?php echo $details['in_office_name'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Police Report # </label>

                            <div><?php echo $details['in_police_report_no'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>DOT Reportable</label>
                            <div><?php echo $details['in_dot_reportable_id_fk'] ?></div>



                        </div>

                        <div class="field-p">

                            <label>Fatality</label>
                            <div><?php echo $details['in_fatality_id_fk'] ?></div>



                        </div>

                        <div class="field-p">

                            <label>Bodily Injury</label>
                            <div><?php echo $details['in_bodily_injury_id_fk'] ?></div>


                        </div>

                        <div class="field-p">

                            <label>Driver Citations</label>
                            <div><?php echo $details['in_driver_citation_id_fk'] ?></div>



                        </div>



                    </div>

                </fieldset>


                <fieldset>
                    <legend>Other Party Details</legend>
                    <div class="field-section">



                        <div class="field-p">

                            <label>Company Name</label>

                            <div><?php echo $details['other_party_claim_id'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Contact Person Name</label>

                            <div><?php echo $details['other_party_adjusters_name'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Contact Email ID</label>
                            <div><?php echo $details['other_party_adjusters_email'] ?></div>



                        </div>

                        <div class="field-p">

                            <label>Contact number</label>
                            <div><?php echo $details['other_party_adjusters_phone'] ?></div>



                        </div>

                    </div>

                </fieldset>


                <!-- <fieldset>
      <legend>Incident Description</legend>
      <div class="field-section single-column">
        <div class="field-p">
            <div name="in_incident_description" style="height: 150px" required><?php echo $details['in_incident_description'] ?></div>
        </div>
      </div>
  </fieldset> -->



            </div>

        </section>

        <section class="section-1" style="width:100%">

            <div>
                <fieldset>
                    <legend>Cargo Claim Information</legend>
                    <div class="field-section">



                        <div class="field-p">

                            <label>Claim Id</label>

                            <div><?php echo $details['cargo_name'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Adjusters name</label>

                            <div><?php echo $details['cargo_adjusters_name'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Adjusters Email ID</label>
                            <div><?php echo $details['cargo_adjusters_email'] ?></div>



                        </div>

                        <div class="field-p">

                            <label>Adjusters contact number</label>
                            <div><?php echo $details['cargo_adjusters_phone'] ?></div>



                        </div>

                    </div>

                </fieldset>
            </div>
            <div>
                <fieldset>
                    <legend>Physical Damage</legend>
                    <div class="field-section">



                        <div class="field-p">

                            <label>Claim Id</label>

                            <div><?php echo $details['physical_name'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Adjusters name</label>

                            <div><?php echo $details['physical_adjusters_name'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Adjusters Email ID</label>
                            <div><?php echo $details['physical_adjusters_email'] ?></div>



                        </div>

                        <div class="field-p">

                            <label>Adjusters contact number</label>
                            <div><?php echo $details['physical_adjusters_phone'] ?></div>



                        </div>

                    </div>

                </fieldset>
            </div>
            <div>
                <fieldset>
                    <legend>Third Party Damage</legend>
                    <div class="field-section">



                        <div class="field-p">

                            <label>Claim Id</label>

                            <div><?php echo $details['third_party_name'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Adjusters name</label>

                            <div><?php echo $details['third_party_adjusters_name'] ?></div>

                        </div>

                        <div class="field-p">

                            <label>Adjusters Email ID</label>
                            <div><?php echo $details['third_party_adjusters_email'] ?></div>



                        </div>

                        <div class="field-p">

                            <label>Adjusters contact number</label>
                            <div><?php echo $details['third_party_adjusters_phone'] ?></div>



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
                            <div name="in_incident_description" style="height: 100px" required><?php echo $details['in_incident_description'] ?></div>
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
                                    <th>Document ID</th>
                                    <th>Document Required</th>
                                    <th>Remarks</th>
                                    <th>File Name</th>

                                </tr>

                            </thead>

                            <tbody id="issue_table">
                                <?php
                                $counter = 0;
                                foreach ($details['in_doc_list'] as $doc) {
                                    $link = "'" . $doc['in_document_filepath'] . "'";
                                    echo '<tr><td>' . ++$counter . '</td>
                            <td>' . $doc['in_document_name'] . '</td>
                            <td>' . $doc['in_document_required'] . '</td>
                            <td>' . $doc['in_incident_remarks'] . '</td>
                            <td style="text-align: center;" class="text-link" onclick="open_document(' . $link . ')">' . $doc['in_document_filename'] . '</td>
                            </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </div>
        </section>
    </form>
</section>

<br>

<br>

<section class='list-200 content-box' style='margin: auto;max-width: 1200px'>
    <h1 class='list-200-heading'>Documents List</h1>
    <section class='list-200-top-section'>
        <div>
        </div>
        <div>
        </div>
    </section>
    <div class='table  table-a'>
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
                <tr>
                    <!-- <td colspan="3"></td><td style="padding: 4px;text-align: right;"><button type="button" class="btn_blue" onclick="open_child_window({url:'../user/maintenance/incidents/upload-document&eid=<?php echo $details['eid'] ?>',width:600,height:500})">Add Document</button>
        </td> -->
                </tr>
            </tfoot>
        </table>
    </div>
</section>

<br><br>

<section class='list-200 content-box' style='margin: auto;max-width: 1200px'>
    <h1 class='list-200-heading'>Follow Ups</h1>
    <form method='POST' id='MyForm_action' class='aaf' onsubmit='return add_follow_up()'>

        <input type='hidden' name='repair_order_eid' value="<?php echo $details['eid'] ?>">
        <div class="aaf-a">
            <textarea name='description' style='min-height:100px;width: 100%' placeholder='Write description here' hidden></textarea>
        </div>
        <div class='aaf-b'>
            <div>
                <!-- <label>Next Follow Date &nbsp </label> -->
                <input type='text' name='follow_up_next_date' required='required' data-date-picker style="width: 100%;" hidden>
            </div>
            <div>
                <button class='form-submit-btn' id='submit' style="width: 100%;" hidden>Save</button>
            </div>
        </div>
        <div>
        </div>
    </form>
    <br>
    <div class='table  table-a'>
        <table data-follow-up-table>
            <thead>
                <tr>
                    <th style='width: 20px;'>Datetime</th>
                    <th style='width: 500px;text-align: left;'>Description</th>
                    <th style='width: 10px;'>Next Follow-Up Date</th>
                    <th style='width: 20px;'>Added by</th>
                </tr>
            </thead>
            <tbody data-follow-ups-list>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        function show_status_filter() {
            get_repair_order_status().then(function(data) {

                if (data.status) {

                    if (data.response.list) {
                        var options = "";
                        options += `<option value="">- - Select - -</option>`
                        $.each(data.response.list, function(index, item) {
                            options += `<option value="` + item.id + `">` + item.name + `</option>`;
                        })
                        $('[name="status"]').html(options);
                        select_default('[name="status"]')
                    }
                }
            }).catch(function(err) {

            })
        }
        show_status_filter()
    </script>

    <script type='text/javascript'>
        function show_follow_ups() {
            $.ajax({
                url: '<?php echo AJAXROOT; ?>/user/maintenance/incidents/follow-up-list-ajax',
                type: 'POST',
                data: {
                    repair_order_eid: '<?php echo $details['eid']; ?>'
                },
                beforeSend: function(data) {
                    show_table_data_loading('[data-follow-up-table]')
                },
                success: function(data) {
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                        $('[data-follow-ups-list]').html('');
                        if (data.status) {
                            var counter = 0;
                            $.each(data.response.list, function(index, item) {
                                counter++;
                                var row = `<tr>
              `;

                                if (item.added_on_datetime < '12/31/1799') {

                                    row += `<td>${item.added_on_datetime}</td>`;
                                } else {
                                    row += `<td></td>`;
                                }

                                row += `

              <td style ='width: 100px;text-align: left;'>${item.description}</td>

              `;

                                if (item.follow_up_next_date < '12/31/1799') {

                                    row += `<td>${item.follow_up_next_date}</td>`;
                                } else {
                                    row += `<td></td>`;
                                }

                                row += `

              <td>${item.added_by_user_code}-${item.added_by_user_name}</td>
              </tr>`;
                                $('[data-follow-ups-list]').append(row);
                            })
                        } else {
                            var false_message = `<tr><td colspan = '3'>` + data.message + `<td></tr>`;
                            $('[data-follow-ups-list]').html(false_message);
                        }
                    }
                }
            })
        }
        show_follow_ups()
    </script>

    <script type='text/javascript'>
        function add_follow_up() {
            show_processing_modal()
            submit_to_wait_btn('#submit', 'loading')
            $('#formErro').show()
            var form = document.getElementById('MyForm_action');
            var isValidForm = form.checkValidity();

            var currentForm = $('#MyForm_action')[0];
            var formData = new FormData(currentForm);
            if (isValidForm) {
                var arr = $('#MyForm_action').serializeArray();
                var obj = {

                }

                for (var a = 0; a < arr.length; a++) {
                    obj[arr[a].name] = arr[a].value
                }

                $.ajax({
                    url: '<?php echo AJAXROOT; ?>' + 'user/maintenance/incidents/add-follow-up-action',
                    type: 'POST',
                    data: obj,

                    success: function(data) {

                        if ((typeof data) == 'string') {
                            data = JSON.parse(data)
                        }
                        console.log(data);
                        if (data.status) {
                            $('#MyForm_action')[0].reset()
                            show_follow_ups()
                            wait_to_submit_btn('#submit', 'SAVE')
                            hide_processing_modal()
                            RefreshParent()
                        } else {
                            alert(data.message);
                            wait_to_submit_btn('#submit', 'SAVE')
                            hide_processing_modal()
                        }

                    }
                })
            }
            return false
        }
    </script>
</section>

<script type="text/javascript">
    function RefreshParent() {
        if (window.opener != null && !window.opener.closed) {
            window.opener.location.reload();
            window.close();
            alert('Followup added successfully')
        }
    }
</script>

<br><br>

<section class="action-button-box">
    <button type="button" class="btn_green" onclick="window.history.back()">Back</button>
</section>

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

<br><br>

<style type='text/css'>
    .aaf {
        display: flex;
    }

    .add-action {
        width: 80%;
    }

    .aaf-a {
        width: 70%;
    }

    .aaf-b {
        padding-left: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        justify-content: space-between;
    }

    .aaf-b>div {
        width: 100%
    }

    .aaf-b>div input {
        height: 35px
    }
</style>

<?php

require_once APPROOT . '/views/includes/user/footer.php';

?>