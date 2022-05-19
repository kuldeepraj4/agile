<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];

// echo "<pre>";
// print_r($details);
// echo "</pre>"; 

?>

<br><br>

<section class="lg-form-outer">

  <div class="lg-form-header">VIEW DETAIL - INSPECTION SHEET</div>
  
  <br>

  <div class="lg-form-header">Inspection ID : <?php echo $details['id']; ?></div>
  <section class="lg-form" style="text-align:right;">
  <?php
  if (in_array('P0268', USER_PRIV)) {
  ?>
    <button class='btn_blue' onclick="location.href='../user/maintenance/inspection-sheet/update?eid=<?php echo $_GET['eid']; ?>'">Edit Inspection</button>
  <?php
  }
  ?>
  </section>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <input type="hidden" name="refnocount" id="refnocount" value="111">

    <section class="section-111">
      <div></div>
      <div>
        <fieldset>
          <legend>Status</legend>
          <div class="field-section single-column">
            <!-- <div class="field-p">
              <label>Status</label>
              <div><?php //echo $details['status_id'] ?></div>

            </div> -->
            <div class="field-p">
              <label>Status</label>
              <select name="status" <?php if (!in_array('P0268', USER_PRIV)) { echo 'disabled'; }; ?> data-default-select="<?php echo $details['status_id']?>">
              </select>
            </div>

            <!-- <div class="field-section single-column">
                <div class="field-p">
              <label>Remarks</label>
              <textarea name="in_remarks" class="control-enable-disable" style="height: 100px"><?php echo $details['in_remarks'] ?></textarea>
            </div> -->
          </div>
        </fieldset>
        <br>
        <!-- <fieldset>
          <legend>Claim Information</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Claim Type</label>
              <div name="in_claim_type_name_fk"></div>
            </div>
            <div class="field-p">
              <label>Remarks</label>
              <div name="in_claim_remarks"></div>
            </div>
          </div>
        </fieldset> -->
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
                  url:'<?php echo AJAXROOT; ?>/user/maintenance/inspection-sheet/update-status-action',
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
          } else {
            alert("Claim information does not exist for this record");
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
            <!-- <div class="field-p">
              <label>Status</label>
              <div><?php echo $details['status_id'] ?></div>
            </div> -->
            <div class="field-p">
              <label>Inspection Date</label>
              <div><?php echo $details['inspection_date'] ?></div>
            </div>
            <div class="field-p">
              <label>Start Time</label>
              <div><?php echo $details['from_time'] ?></div>
            </div>
            <div class="field-p">
              <label>End Time</label>
              <div><?php echo $details['to_time'] ?></div>
            </div>
            <div class="field-p">
              <label>Reference No.</label>
              <div><?php echo $details['reference_no'] ?></div>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend>Asset Information</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Driver ID</label>
              <div><?php echo $details['driver_a_code'] ?> <?php echo $details['driver_a_name_first'] ?> <?php echo $details['driver_a_name_middle'] ?> <?php echo $details['driver_a_name_last'] ?></div>
            </div>
            <div class="field-p">
              <label>Co-driver ID</label>
              <div><?php echo $details['driver_b_code'] ?> <?php echo $details['driver_b_name_first'] ?> <?php echo $details['driver_b_name_middle'] ?> <?php echo $details['driver_b_name_last'] ?></div>
            </div>
            <div class="field-p">
              <label>Truck ID</label>
              <div><?php echo $details['truck_code'] ?></div>
            </div>
            <div class="field-p">
              <label>Trailer ID</label>
              <div><?php echo $details['trailer_code'] ?></div>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>Level</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Level</label>
              <div><?php echo $details['level_id'] ?></div>
            </div>
          </div>
        </fieldset>
      </div>

      <div>
        <fieldset>
          <legend>Verbal Warning Information</legend>
          <div class="field-section single-column" group-enable-disable>
            <div class="field-p">
              <label>Given By</label>
              <div><?php echo $details['user_name'] ?></div>
              </select>
            </div>
            <div class="field-p">
              <label>Date & Time</label>
              <div><?php echo $details['verbal_warning_given_date'] ?></div>
              <div><?php echo $details['verbal_warning_given_time'] ?></div>
              </input>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>Driver Statement</legend>
          <div class="field-section single-column" group-enable-disable>
            <div class="field-p">
              <div><?php echo $details['driver_statement'] ?></div>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>Book Transfer Information</legend>
          <div class="field-section single-column" group-enable-disable>
            <div class="field-p">
              <label>Book Transfer</label>
              <div><?php echo $details['book_transfer_id'] ?></div>
            </div>
            <div class="field-p">
              <label>Book Tag</label>
              <div><?php echo $details['book_tag_id'] ?></div>
            </div>
          </div>
        </fieldset>
      </div>

      <div>
        <fieldset>
          <legend>Location Information</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Company Name</label>
              <div><?php echo $details['company_name'] ?></div>
            </div>
            <div class="field-p">
              <label>Location</label>
              <div><?php echo $details['location'] ?></div>
            </div>
            <div class="field-p">
              <label>State</label>
              <div><?php echo $details['state_name'] ?></div>
            </div>
            <div class="field-p">
              <label>City</label>
              <div><?php echo $details['city_name'] ?></div>
            </div>
        </fieldset>
        <fieldset>
          <legend>Asset Information</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Violation Reported</label>
              <div><?php echo $details['violation_reported_name'] ?></div>
            </div>
            <div class="field-p">
              <label>Fined Amount</label>
              <div><?php echo $details['fined_amount'] ?></div>
            </div>
            <div class="field-p">
              <label>Bond Amount</label>
              <div><?php echo $details['bond_amount'] ?></div>
            </div>
        </fieldset>
        <fieldset>
          <legend>Remarks</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Remarks</label>
              <div><?php echo $details['remarks'] ?></div>
            </div>
          </div>

      </div>
    </section>

    <section class='list-200 content-box' style='margin: auto;max-width: 1200px'>
      <h1 class='list-200-heading'>Driver's List</h1>
      <div>
        <fieldset>
          <div class='table  table-a'>
            <table style="width: 100%">
              <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>ID</th>
                  <th>Reason</th>
                  <th>Remarks</th>
                  <th>Corrective Action</th>
                  <th>Ref. Document No.</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $counter = 0;
                foreach ($details['asset_list_drivers'] as $jwl) {
                  echo "
              <tr>
              <td>" . ++$counter . "</td>
              <td>" . $jwl['asset_reason_name_drivers'] . "</td>
              <td>" . $jwl['asset_remarks_drivers'] . "</td>
              <td>" . $jwl['asset_corrective_name_drivers'] . "</td>
              <td>" . $jwl['asset_reference_document_id_drivers'] . "</td>
              </tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
    </section>
    <br><br>
    <section class='list-200 content-box' style='margin: auto;max-width: 1200px'>
      <h1 class='list-200-heading'>Truck's List</h1>
      <div>
        <fieldset>
          <div class='table  table-a'>
            <table style="width: 100%">
              <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>ID</th>
                  <th>Reason</th>
                  <th>Remarks</th>
                  <th>Corrective Action</th>
                  <th>Ref. Document No.</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $counter = 0;
                foreach ($details['asset_list_trucks'] as $jwl) {
                  echo "
                <tr>
                <td>" . ++$counter . "</td>
                <td>" . $jwl['asset_reason_name_trucks'] . "</td>
                <td>" . $jwl['asset_remarks_trucks'] . "</td>
                <td>" . $jwl['asset_corrective_name_trucks'] . "</td>
                <td>" . $jwl['asset_reference_document_id_trucks'] . "</td>
                </tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
    </section>
    <br><br>
    <section class='list-200 content-box' style='margin: auto;max-width: 1200px'>
      <h1 class='list-200-heading'>Trailer's List</h1>
      <div>
        <fieldset>
          <div class='table  table-a'>
            <table style="width: 100%">
              <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>ID</th>
                  <th>Reason</th>
                  <th>Remarks</th>
                  <th>Corrective Action</th>
                  <th>Ref. Document No.</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $counter = 0;
                foreach ($details['asset_list_trailers'] as $jwl) {
                  echo "
                  <tr>
                  <td>" . ++$counter . "</td>
                  <td>" . $jwl['asset_reason_name_trailers'] . "</td>
                  <td>" . $jwl['asset_remarks_trailers'] . "</td>
                  <td>" . $jwl['asset_corrective_name_trailers'] . "</td>
                  <td>" . $jwl['asset_reference_document_id_trailers'] . "</td>
                  </tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
    </section>
    <br><br>
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
              <th style="width: 30%">Document Name</th>
              <th style="width: 40%">Remarks</th>
              <th style="width: 40%">Uploaded By</th>
              <th></th>
            </tr>
          </thead>
          <tbody data-documents-list></tbody>
          <tfoot>
            <!-- <tr><td colspan="3"></td><td style="padding: 4px;text-align: right;"><button type="button" class="btn_blue" onclick="open_child_window({url:'../user/maintenance/inspection-sheet/upload-document&eid=<?php echo $details['eid'] ?>',width:600,height:500})">Add Document</button></td></tr> -->
          </tfoot>
        </table>
      </div>
    </section>
</section>

<br>

<section class="action-button-box">
  <button type="button" class="btn_green" onclick="window.history.back()">BACK</button>
</section>

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
  function show_documents() {
    $.ajax({
      url: '<?php echo AJAXROOT; ?>/user/maintenance/inspection-sheet/documents-list-ajax',
      type: 'POST',
      data: {
        repair_order_eid: '<?php echo $details['eid']; ?>'
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
                <td style ='text-align: center;'>${item.remarks}</td>
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
<br><br>
<br><br>
<br><br>
</section>

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>