<?php
require_once APPROOT . '/views/includes/user/header.php';
require_once APPROOT . '/views/includes/user/quick-menu-dispatch-loads.php';
$dtl = $data['details'];
// echo "<pre>";
// print_r($dtl);
// echo "</pre>";
?>
<style type="text/css">
  .dtlv {
    box-shadow: 0 0 10px -1px darkgrey;
    background: white;

    text-align: center;
    padding: 10px;
    display: block;
    border-radius: 12px;
  }

  .dtlv-heading {
    margin-bottom: 10px;
    font-size: 2em;
    color: var(--theme-color-four);
  }

  .dtlv>section {
    border: 1px solid lightgrey;
    border-radius: 8px;
    overflow: hidden;
    margin: 25px auto;
  }

  .dtlv .dtlv-sec-head {
    display: flex;
    justify-content: space-between;
    padding: 5px 10px;
    background: #486e94;
    border-bottom: 1px solid lightgrey;
  }

  .dtlv .dtlv-sec-heading {
    font-weight: bold;
    font-size: 1.1em;
    color: white;
  }

  .dtlv-sec-heading.angle_down::after {
    color: grey;
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\f107";
    font-size: 1.2em;
  }

  .dtlv .dtlv-sec-head a {
    color: white;
  }

  .dtlv .dtlv-dtl {}

  .dtlv .dtlv-dtl .dtlv-dtl-content {
    padding: 8px;
    display: flex;
    justify-content: space-between;
  }

  .dtlv .dtlv-dtl .dtlv-dtl-action-bar {
    display: flex;
    justify-content: flex-end;
  }

  .dtlv .dtlv-dtl .dtlv-dtl-content>div {
    margin: 8px;
    flex-grow: 1;
  }

  .dtlv .dtlv-attr-val-list ul {}

  .dtlv .dtlv-attr-val-list li {
    display: flex;
  }

  .dtlv .dtlv-attr-val-list li>div {
    padding: 3px 10px;
  }

  .dtlv .dtlv-attr-val-list li>div:nth-child(1) {
    width: 40%;
    font-style: italic;
    text-align: left;
  }

  .dtlv .dtlv-attr-val-list li>div:nth-child(2) {
    width: 55%;
    flex-grow: 1;
    text-align: left;
  }

  .icon {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
  }

  .icon:hover {
    transform: scale(1.1);
  }

  .icon.white {
    color: white !important;
  }

  .icon.grey {
    color: grey !important;
  }

  .icon.view::after {
    content: "\f06e";
  }

  .icon.view:hover {
    color: green;
  }

  .icon.edit::after {
    content: "\f304";
  }

  .icon.edit:hover {
    color: steelblue;
  }

  .icon.delete::after {
    content: "\f1f8";
  }

  .icon.delete:hover {
    color: red;
  }

  .icon.angle_down::after {
    content: "\f107";
    font-size: 1.2em;
  }

  .icon.angle_up::after {
    content: "\f106";
    font-size: 1.2em;
  }

  .icon.toggle-on::after {
    content: "\f205";
    font-size: 1.2em;
  }

  .icon.toggle-off::after {
    content: "\f204";
    font-size: 1.2em;
  }

  .icon.toggle-off:hover,
  .icon.toggle-on:hover {
    color: steelblue;
  }

  .dtlv-dtl-list>table {
    border: 1px solid darkgrey;
    border-collapse: collapse;
    background: white;
    overflow: auto;
    box-sizing: border-box;
    width: 95%;
    margin: 8px auto;
  }

  .dtlv-dtl-list>table>thead {
    background: #f2f2f2;
    color: black;
  }

  .dtlv-dtl-list>table>thead>tr {
    border-bottom: 1px solid darkgrey;
  }

  .dtlv-dtl-list>table>thead>tr>th {
    padding: 8px 12px;
    font-weight: normal;
  }

  .dtlv-dtl-list>table>tbody>tr>td {
    padding: 8px 12px;

  }

  .dtlv-dtl-list>table>tbody>tr {
    border-bottom: 1px solid #f0f0f0
  }

  .dtlv-dtl-list>table>tbody>tr:last-child {
    border-bottom: none;
  }

  .dtlv-dtl-list>table>thead>tr>td {
    text-align: center;
  }

  .dtlv-dtl-list>table>tbody>tr>td {
    text-align: center;
  }


  .dtlv-dtl-list.dtlv-dtl-list-a {}

  .dtlv-dtl-list.dtlv-dtl-list-a>table>thead {
    background: #486e94;
  }

  .dtlv-dtl-list.dtlv-dtl-list-a>table>thead>tr {
    border: 1px solid grey;
  }

  .dtfv-top-action-bar {
    display: flex;
    justify-content: flex-end;
    padding: 4px 1px;
  }

  /* ------------------css for notes start here-------------- */
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
    width: 30%
  }

  .aaf-b>div {
    width: 100%;
  }

  .aaf-b>div select {
    height: 35px
  }

  .bg-high-priority {
    background: pink;
  }

  .notes-th {
    background-color: #f2f2f2 !important;
    color: black;
  }

  /* ------------------css for notes end here ---------------- */
</style>
<br><br>
<section class="dtlv content-box" style="margin: auto;max-width: 1150px">
  <h1 class="dtlv-heading">LOAD <?php echo $dtl['id']; ?></h1>
  <div class="dtfv-top-action-bar">
    <button class="btn_blue" data-add-stop>Add Stop</button> &nbsp
    <button class="btn_blue" data-add-stop-off>Add Stop Off</button> &nbsp
    <button class="btn_blue" onclick="open_child_window({url:'../user/dispatch/loads/load-status-update?eid=<?php echo $dtl['eid'].'&load-status='.$dtl['load_status_id'].'&load-id='.$dtl['id']; ?>',width:500,height:500,name:'Update load status'})">Update Status</button> &nbsp
  </div>

  <section style="border-style: none;margin:0px;"><span style="float:left;" data-high-notes></span></section>
  <section data-top-action-sec style="padding:20px;display: none;"> </section>
  <section>
    <div class="dtlv-sec-head" data-hide-show-details>
      <div class="dtlv-sec-heading">Load Information</div>
      <div>
        <button class="icon angle_up white" data-up-down-button></button>
      </div>
    </div>
    <div class="dtlv-dtl">
      <div class="dtlv-dtl-action-bar">
        <button title="Edit" class="icon edit grey" onclick="open_child_window({url:'../user/dispatch/loads/load-information-update&eid=<?php echo $dtl['eid']; ?>',width:1000,height:500})"></button>
      </div>
      <div class="dtlv-dtl-content">
        <div class="dtlv-attr-val-list" style="max-width: 500px;">
          <ul>
            <li>
              <div>Customer</div>
              <div><?php echo $dtl['customer_code']." - ".$dtl['customer_name']; ?></div>
            </li>
            <li>
              <div>PO Number</div>
              <div><?php echo $dtl['po_number']; ?></div>
            </li>
            <li>
              <div>Rate</div>
              <div><?php echo $dtl['rate']; ?></div>
            </li>

          </ul>
        </div>


        <div class="dtlv-attr-val-list" style="max-width: 500px;">
          <ul>
            <li>
              <div style="line-height: 1.7em;min-height: 1.7em;">Status</div>
              <div style="font-weight:bolder;font-size: 1.7em"><?php echo $dtl['load_status_id']; ?></div>
            </li>
            <li>
              <div>Commodity Type</div>
              <div><?php echo $dtl['commodity_type']; ?></div>
            </li>
            <li>
              <div>Trailer Type</div>
              <div><?php echo $dtl['trailer_type']; ?></div>
            </li>
            <li>
              <div>Reefer Temperature</div>
              <div><?php echo $dtl['reefer_temperature_string']; ?></div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>



  <?php
  foreach ($data['details']['stops'] as $stop) {
  ?>

    <section>
      <div class="dtlv-sec-head hide" data-hide-show-details>
        <div class="dtlv-sec-heading" style="width:45%;text-align:left;"><?php echo $stop['stop_category_abbr']; ?> <span style="font-weight: normal;font-style: italic;font-size: .8em;"><?php echo $stop['location_full_address']; ?></span>
        </div>
        <div class="dtlv-sec-heading" style="width:45%;text-align: right;font-weight: normal;"><?php echo $stop['date'] . " <span style='font-size:.7em;font-style:italic'>" . $stop['time'] . "</span>"; ?></div>
        <div style="width:10%;max-width: 20px;">
          <button class="icon angle_down white" data-up-down-button></button>
        </div>
      </div>

      <div class="dtlv-dtl">
        <div class="dtlv-dtl-action-bar">
          <?php if ($stop['stop_category_abbr'] != 'SH' && $stop['stop_category_abbr'] != 'CN') {
            echo '<button title="Delete" class="icon delete grey" data-delete-stop="' . $stop["eid"] . '"></button>';
          } ?>

          <button title="Edit" class="icon edit grey" onclick="open_child_window({url:'../user/dispatch/loads/stop-information-update&eid=<?php echo $stop['eid']; ?>',width:1000,height:500})"></button>
        </div>
        <div class="dtlv-dtl-content">
          <div class="dtlv-attr-val-list" style="max-width: 500px;">
            <ul>
              <li>
                <div>Category</div>
                <div><?php echo $stop['category']; ?></div>
              </li>
              <li>
                <div>Type</div>
                <div><?php echo $stop['type']; ?></div>
              </li>
              <li>
                <div>Appointment Type</div>
                <div><?php echo $stop['appointment_type']; ?></div>
              </li>
            </ul>
          </div>

          <div class="dtlv-attr-val-list" style="max-width: 500px;">
            <ul>
              <li>
                <div>Date</div>
                <div><?php echo $stop['date']; ?></div>
              </li>
              <li>
                <div>Time</div>
                <div><?php echo $stop['time_from'] . ' - ' . $stop['time_to']; ?></div>
              </li>
              <li>
                <div>Special Instructions </div>
                <div><?php echo $stop['special_instructions']; ?></div>
              </li>
            </ul>
          </div>
        </div>


        <div class="dtlv-dtl-list" style="max-width:700px;margin: auto;">
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Pallet</th>
                <th>Case</th>
                <th>Reference</th>
              </tr>
            </thead>
            <tbody>
              <?php
              //----print quantity details
              foreach ($stop['quantity'] as $qty) {
                echo "<tr>
                    <td>" . $qty['pd_number'] . "</td>
                    <td>" . $qty['pallet_count'] . "</td>
                    <td>" . $qty['case_count'] . "</td>
                    <td>" . $qty['reference_number'] . "</td>
                    </tr>";
              }
              ?>
            </tbody>
          </table>
        </div>

      </div>
    </section>
  <?php
  }

  ?>

  <section>
    <div class="dtlv-sec-head hide" data-hide-show-details>
      <div class="dtlv-sec-heading">Billing Information </div>
      <div>
        <button class="icon angle_down white" data-up-down-button></button>
      </div>
    </div>
    <div class="dtlv-dtl">
      <div class="dtlv-dtl-action-bar">
        <button title="Edit" class="icon edit grey" onclick="open_child_window({url:'../user/dispatch/loads/billing-information-update&eid=<?php echo $dtl['eid']; ?>',width:1000,height:500})"></button>
      </div>
      <div class="dtlv-dtl-content">
        <div class="dtlv-attr-val-list" style="max-width: 500px;">
          <ul>
            <li>
              <div>
                Freight/ Line Haul Charges</div>
              <div><?php echo $dtl['rate'] ?></div>
            </li>
          </ul>
        </div>

        <div class="dtlv-attr-val-list" style="max-width: 500px;">
        </div>
      </div>


      <div class="dtlv-dtl-list" style="max-width:500px;margin: auto;">
        <table>
          <thead>
            <tr>
              <th colspan="4" style="font-weight:bolder;background: lightgrey;">Accessories</th>
            </tr>
            <tr>
              <th>#</th>
              <th style='text-align:left'>Type</th>
              <th style='text-align:right;'>Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php
            //----print bill accessories details
            $bl_acc_c = 0;
            foreach ($dtl['billing_information']['accessories'] as $bl_acc) {
              echo "<tr>
                    <td>" . ++$bl_acc_c . "</td>
                    <td style='text-align:left'>" . $bl_acc['name'] . "</td>
                    <td style='text-align:right'>" . $bl_acc['amount'] . "</td>
                    </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

    </div>

  </section>


  <section>
    <div class="dtlv-sec-head hide" data-hide-show-details>
      <div class="dtlv-sec-heading">Documents</div>
      <div>
        <button class="icon angle_down white" data-up-down-button></button>
      </div>
    </div>
    <div class="dtlv-dtl">
      <div class="dtlv-dtl-list" style="max-width:1000px;margin: auto;">
        <table>
          <thead>
            <tr>
              <th style="width:15%">#</th>
              <th style="text-align:left;width: 70%;">Document Name</th>
              <th style="width:15%">View</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="width: 15%;">1</td>
              <td style="text-align:left;width:70%">Rate of Contract (ROC)</td>
              <td style="width: 15%;"><?php if ($dtl['documents']['roc'] != "") { ?> <i class="ic file" style="color:grey" title="View PO" onclick="open_document('<?php echo  $dtl['documents']['roc'] ?>')"></i> &nbsp
                  <i class="ic history" style="color:grey" title="View PO" onclick="open_child_window({url:'../user/dispatch/loads/roc-history-list&eid=<?php echo  $dtl['eid'] ?>',width:900,height:500,name:'show-roc-history'})"></i>
                <?php } else {
                                        echo "N/a";
                                      } ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <!-- -----------------HTML CODE FOR NOTES FUNCTIONALITY START HERE----------START HERE------------------ -->
  <section>
    <div class="dtlv-sec-head hide" data-hide-show-details>
      <div class="dtlv-sec-heading">NOTES</div>
      <div>
        <button class="icon angle_down white" data-up-down-button></button>
      </div>
    </div>
    <div class="dtlv-dtl">
      <div class="dtlv-dtl-list" style="max-width:100%;margin: 0px 15px;">
        <div style="display: flex;padding: 5px;justify-content: flex-end;"><button data-action="open-add-new-note" class="btn_blue">Add New Note</button></div>
        <div id="addNewNoteSec" style="margin: 10px auto;display: none;">
          <div style="display: flex;padding: 5px;justify-content: flex-end;"><button data-action="close-add-new-note" class="btn_red">Close</button></div>
          <form method='POST' id='addNewNoteForm' class='aaf' onsubmit='return add_d_note()'>
            <input type='hidden' name='load_eid' value="<?php echo $_GET['eid'] ?>">
            <div class="aaf-a">
              <textarea name='description' style='min-height:100px;width:100%' placeholder='Write note description here'></textarea>
            </div>
            <div class='aaf-b'>
              <div>
                <label>High Priority &nbsp<input type="checkbox" name="high_priority"></label>
              </div>
              <div>
                <button class='form-submit-btn' id='saveNote' style="width: 100%;">Save</button>
              </div>
            </div>
            <div>
            </div>
          </form>
        </div>
        <div class='table  table-a'>
          <table data-follow-up-table>
            <thead>
              <tr>
                <th class="notes-th" style='width: 200px;'>Datetime</th>
                <th class="notes-th" style='text-align: left;'>Description</th>
                <th class="notes-th" style='width: 200px;'>Added by</th>
                <th class="notes-th" style='width: 120px;'>High Priority</th>
                <th class="notes-th"></th>
              </tr>
            </thead>
            <tbody data-follow-ups-list>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </section>
  <!-- -----------------HTML CODE FOR NOTES FUNCTIONALITY END HERE----------END HERE------------------ -->
</section>


<script type="text/javascript">
  $(document).on('click', '[data-delete-stop]', function() {

    if (confirm('Do you want to delete stop ?') == true)
      $.ajax({
        url: '../user/dispatch/loads/delete-stop-action',
        type: 'POST',
        data: {
          stop_eid: $(this).data('delete-stop'),
        },
        success: function(data) {
          alert(data)
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message);
          if (data.status) {
            window.location.reload()
          }
          wait_to_submit_btn('#submit', 'Save')
        }
      })
  })
</script>


<script type="text/javascript">
  //---closing top action section
  $(document).on('click', '[data-close-top-action-sec]', function() {
    $(`[data-top-action-sec]`).slideUp()
  })
  //---/closing top action section


  $(document).on('click', '[data-add-stop-off]', function() {

    $(`[data-top-action-sec]`).html(`<div>
      <section style="max-width:400px;margin:auto">
        <div><label style="width:30%">Stop Off Location</label>
      <input type="text" value=""  style="width:70%" list="quick_list_addresses" data-selected-address-id="" name="stop_off_address_id" required></div>
      <div style="margin-top:10px"><button type="button" class="btn_green" onclick="add_stop_off()">Save</button> &nbsp<button class="btn_red" data-close-top-action-sec>Close</button></div>
      </section>
        
      </div>`)
    $(`[data-top-action-sec]`).slideDown()
  })

  function add_stop_off() {
    submit_to_wait_btn('#submit', 'loading')
    $.ajax({
      url: '../user/dispatch/loads/add-stop-off-action',
      type: 'POST',
      data: {
        address_id: $('[name="stop_off_address_id"]').data('selected-address-id'),
        load_eid: '<?php echo $dtl["eid"]; ?>',
        stop_off_type: $('[name="stop_off_type"]').val()
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
        }
        alert(data.message);
        if (data.status) {
          window.location.reload()
        }
        wait_to_submit_btn('#submit', 'Save')
      }
    })
    return false
  }




  $(document).on('click', '[data-add-stop]', function() {

    $(`[data-top-action-sec]`).html(`<form class="lg-form" method="POST" data-stop-row id="AddNewStop" onsubmit="return add_new_stop()">
    <section class="section-111" style="max-width: 700px;">    
      <div>
        <fieldset>
          <legend>Stop Information</legend>

          <div style="display:flex;">
            <div class="field-section single-column"   style="width:100%">

<div class="field-p">
                  <label>Stop Type</label>
                  <select class="w-100" name="stop_type" data-default-select="" required>
                    <option value="">- Select - </option>
                    <option value="PICK">PICK</option>
                    <option value="DROP">DROP</option>
                  </select>
                </div>
<div class="field-p">
                  <label>Search</label>
                  <input type="text" value="" list="quick_list_addresses" name="addresses_id_new_stop" data-new-stop-address-id="" required>
                </div>

                <div class="field-p">
                  <label>Company</label>
                  <input type="text" name="company" disabled>
                </div>
                <div class="field-p">
                  <label>Address Line</label>
                  <input type="text" name="address_line" disabled>
                </div>
                <div class="field-p">
                  <label>State</label>
                  <input type="text" name="state" disabled>
                </div>
                <div class="field-p">
                  <label>City</label>
                  <input type="text" name="city" disabled>
                </div>
                <div class="field-p">
                  <label>Zip Code</label>
                  <input type="text" name="zipcode" disabled>
                </div>
                <div class="field-p">
                  <label>Phone Number</label>
                  <input type="text" name="phone_number" disabled>
                </div>
<div class="field-p">
                  <label>Fax Number</label>
                  <input type="text" name="fax_number" disabled>
                </div>
                <div class="field-p">
                  <label>Email</label>
                  <input type="email" name="email" disabled>
                </div>
                <div class="field-table">
                  <table style="margin:auto;">
                    <thead>
                      <th>#</th>
                      <th>Case</th>
                      <th>Pallet</th>
                      <th>Reference No.</th>
                    </thead>
                    <tbody>
                      <tr data-quantity-details-row>
                        <td style="min-width: 50px;max-width: 120px;"><input name="pd_number" type="text" style="width: 100%;"></td>
                        <td style="min-width: 50px;max-width: 80px;"><input name="case_count" type="text" style="width: 100%;"></td>
                        <td style="min-width: 50px;max-width: 80px;"><input name="pallet_count" type="text" style="width: 100%;"></td>
                        <td style="min-width: 50px;max-width: 120px;"><input name="reference_number" type="text" style="width: 100%;"></td>
                        <td style="width: 20px;"></td>
                      </tr>
                      <tfoot>
                        <tr>
                          <td colspan="4" style="padding:8px;text-align:right;"><button type="button" data-action="add-pick-up-row" class="btn_blue">Add</button></td>
                        </tr>
                      </tfoot>
                    </tbody>
                  </table>
                </div>

<div class="field-p">
                  <label>Appointment Type</label>
                  <select class="w-100" name="appointment_type" data-default-select="<?php echo $stop['appointment_type']  ?>">
                    <option value="">- Select -</option>
                    <option value="FCFS">FCFS</option>
                    <option value="FIRM">FIRM</option>
                  </select>
                </div>
                <div class="field-p">
                  <label>Date</label>
                  <input class="w-100" type="text" name="stop_date" data-date-picker="" required>
                </div>
                <div class="field-p">
                  <label>Time</label>
                  <input data-time-picker style="width:60px"  type="text" name="stop_time_from" required>
                  <input data-time-picker style="width:60px"  type="text" name="stop_time_to" required>
                  <input type="checkbox" name="stop_datetime_tbd" title="TBD" > TBD
                </div>
                <div class="field-p">
                  <label>Special Instructions/Directions</label>
                  <div>
                    <textarea style="width: 100%;height:80px !important" name="special_instructions"></textarea>
                  </div>
                </div>


            </div>            
          </div>                
        </fieldset>
      </div>
    </section>
    <section class="action-button-box">
      <button type="submit" class="btn_green">SAVE</button> &nbsp<button class="btn_red" data-close-top-action-sec>Close</button>
    </section>
  </form>`)
    $(`[data-top-action-sec]`).slideDown()
    $("[data-date-picker]").datepicker();
  })
</script>



<script type="text/javascript">
  $('[data-hide-show-details]').each(function() {

    if ($(this).hasClass('hide')) {
      $(this).siblings('.dtlv-dtl').slideUp(1);
    }
  })
  // $(document.body).on('change', '[name="customer_id_search"]' ,function(){
  $(document.body).on('click', '[data-hide-show-details]', function() {
    if ($(this).hasClass('hide')) {
      $(this).siblings('.dtlv-dtl').slideDown('fast')
      $(this).find('[data-up-down-button]').removeClass('angle_down')
      $(this).find('[data-up-down-button]').addClass('angle_up')
      $(this).removeClass('hide')
    } else {
      $(this).siblings('.dtlv-dtl').slideUp('fast')
      $(this).find('[data-up-down-button]').removeClass('angle_up')
      $(this).find('[data-up-down-button]').addClass('angle_down')

      $(this).addClass('hide')
    }

  })
</script>


<datalist id="quick_list_addresses"></datalist>
<script type="text/javascript">
  $(document.body).on('change', '[data-selected-address-id]', function() {
    address_id_selected = $(`[data-addresses-filter-rows="${$(this).val()}"]`).data('value');
    if ($(this).val() != '') {
      if (address_id_selected == undefined) {
        alert('Invalid address selected');
        address_id_selected = ''
        $(this).val('')
        $(this).focus()
      }
    } else {
      address_id_selected = ''
    }
    $(this).data('selected-address-id', address_id_selected);
  });


  function show_quick_list_addresses() {
    quick_list_location_addresses().then(function(data) {
      // Run this when your request was successful
      if (data.status) {

        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option data-addresses-filter-rows="" data-value="" value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option data-addresses-filter-rows="` + item.id + ' ' + item.name + `" data-value="${item.id}" data-eid="${item.eid}" value="` + item.id + ' ' + item.name + `"></option>`;
          })
          $('#quick_list_addresses').html(options);
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_quick_list_addresses()
</script>

<br><br><br>
<script type="text/javascript">
  $(document.body).on('change', '[name="stop_datetime_tbd"]', function() {

    if ($(this).prop("checked") == true) {
      $(this).siblings('[data-time-picker]').removeAttr('required')
      $(this).siblings('[data-time-picker]').prop('disabled', true)
      $(this).siblings('[data-time-picker]').val('')
    } else if ($(this).prop("checked") == false) {
      $(this).siblings('[data-time-picker]').attr('required', true)
      $(this).siblings('[data-time-picker]').prop('disabled', false)
    }

  });

  $(document.body).on('click', '[data-action="add-pick-up-row"]', function() {
    /*-----------appned $this table body with fresh row*/
    $(this).parents('table').children('tbody').append(`<tr data-quantity-details-row>
          <td style="min-width: 50px;max-width: 120px;"><input name="pd_number" type="text" style="width: 100%;"></td>
          <td style="min-width: 50px;max-width: 80px;"><input name="case_count" type="text" style="width: 100%;"></td>
          <td style="min-width: 50px;max-width: 80px;"><input name="pallet_count" type="text" style="width: 100%;"></td>
          <td style="min-width: 50px;max-width: 120px;"><input name="reference_number" type="text" style="width: 100%;"></td>
          <td style="width: 20px;"><button type="button" class="btn-dark-red" data-action="delete-pickup-row" style="color:brown;"><i class="fa fa-trash"></i></button></td>
          </tr>`)
  })

  $(document.body).on('click', '[data-action="delete-pickup-row"]', function() {
    $(this).parents('tr').remove()
  })

  $(document.body).on('change', '[name="addresses_id_new_stop"]', function() {
    address_id_selected = $(`[data-addresses-filter-rows="${$(this).val()}"]`).data('value');
    $(this).data('new-stop-address-id', '')
    if (address_id_selected != undefined) {
      row_parent = $(this).parents('[data-stop-row]')
      $(this).data('new-stop-address-id', address_id_selected)
      var div_parent = $(this).parents('[data-stop-item]')
      get_location_address_details({
        eid: $(`[data-addresses-filter-rows="${$(this).val()}"]`).data('eid')
      }).then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.details) {
            var details = data.response.details;
            row_parent.find('[name="company"]').val(details.name)
            row_parent.find('[name="address_line"]').val(details.address_line)
            row_parent.find('[name="state"]').val(details.state)
            row_parent.find('[name="city"]').val(details.city)
            row_parent.find('[name="zipcode"]').val(details.zipcode)
            row_parent.find('[name="phone_number"]').val(details.phone_number)
            row_parent.find('[name="fax_number"]').val(details.fax_number)
            row_parent.find('[name="email"]').val(details.email)
            div_parent.find('[data-search-name]').html(details.id + " " + details.name)
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    }
  });

  function add_new_stop() {
    show_processing_modal()
    $('#formErro').show()
    var form = document.getElementById('AddNewStop');
    var isValidForm = form.checkValidity();
    if (isValidForm) {

      var $data_stop_row = $('#AddNewStop');
      prod_code_array = []
      $data_stop_row.find('[name="product_code"]').each(function(index) {
        prod_code_array.push($(this).val())
      })

      var quantity_details = [];
      //------iterate through quantity details rows of $this stop
      ($data_stop_row.find('[data-quantity-details-row]')).each(function(ind) {

        pd_row = ($(this));
        quantity_details.push({
          pd_number: pd_row.find('[name="pd_number"]').val(),
          case_count: pd_row.find('[name="case_count"]').val(),
          pallet_count: pd_row.find('[name="pallet_count"]').val(),
          reference_number: pd_row.find('[name="reference_number"]').val(),
        });
      })
      obj = {
        load_eid: '<?php echo  $dtl['eid'] ?>',
        type: $data_stop_row.find('[name="stop_type"]').val(),
        address_id: $data_stop_row.find('[name="addresses_id_new_stop"]').data('new-stop-address-id'),
        appointment_type: $data_stop_row.find('[name="appointment_type"]').val(),
        date: $data_stop_row.find('[name="stop_date"]').val(),
        datetime_tbd: ($data_stop_row.find("[name=stop_datetime_tbd]").prop("checked") == true) ? 'YES' : 'NO',
        time_from: $data_stop_row.find('[name="stop_time_from"]').val(),
        time_to: $data_stop_row.find('[name="stop_time_to"]').val(),
        special_instructions: $data_stop_row.find('[name="special_instructions"]').val(),
        quantity_details: quantity_details
      }
      $.ajax({
        url: '../user/dispatch/loads/add-new-stop-action',
        type: 'POST',
        data: obj,
        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message);
          if (data.status) {
            window.location.reload();

          }
          hide_processing_modal()
        }
      })
    }
    return false
  }
</script>

<!-- -----------------JAVASCRIPT CODE FOR NOTES FUNCTIONALITY START HERE----------START HERE------------------ -->
<script type='text/javascript'>
  function show_d_notes() {
    $.ajax({
      url: '../user/dispatch/notes/loads/notes-list-ajax',
      type: 'POST',
      data: {
        load_eid: '<?php echo $_GET['eid']; ?>'
      },
      beforeSend: function(data) {
        show_table_data_loading('[data-follow-up-table]')
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          $('[data-follow-ups-list]').html('');
          if (data.status) {
            $.each(data.response.list, function(index, item) {
              var high_priority_class = (item.high_priority == 'YES') ? 'bg-high-priority' : '';
              var high_priority_checked = (item.high_priority == 'YES') ? 'checked' : '';
              var row = `<tr class="${high_priority_class}" data-eid="${item.eid}">
                <td style = 'width: 200px;'>${item.added_on_datetime}</td>
                <td style ='text-align: left;'>${item.description}</td>
                <td style = 'width: 200px;'>${item.added_by_user}</td>`
              if (item.added_by_user_type == 'SELF') {
                row += `<td style = 'width: 120px;'><input type="checkbox" data-toggle-high-priority-status ${high_priority_checked}></td>
                  <td><i class="ic delete" data-delete-d-note></i></td>`
              } else {
                row += `<td></td><td></td>`
              }
              row += `</tr>`;
              $('[data-follow-ups-list]').append(row);
            })
          } else {
            var false_message = `<tr><td colspan = '4'>` + data.message + `<td></tr>`;
            $('[data-follow-ups-list]').html(false_message);
          }
        }
      }
    })
  }
  show_d_notes()
</script>
<script type='text/javascript'>
  function add_d_note() {
    var form = document.getElementById('addNewNoteForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#addNewNoteForm')[0];
    if (isValidForm) {
      var arr = $('#addNewNoteForm').serializeArray();
      var obj = {}
      obj['reference_type_id'] = 'LOAD';
      for (var a = 0; a < arr.length; a++) {
        obj[arr[a].name] = arr[a].value
      }
      obj['high_priority'] = ($('[name="high_priority"]').prop("checked") == true) ? 'YES' : 'NO';
      $.ajax({
        url: '../user/dispatch/notes/add-new-action',
        type: 'POST',
        data: obj,
        success: function(data) {
          // alert(data)
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          if (data.status) {
            show_d_notes()
            show_small_notes()
            $('#addNewNoteForm')[0].reset()
          } else {
            alert(data.message);
          }
        }
      })
    }
    return false
  }
</script>
<script type="text/javascript">
  $(document).on("click", "[data-action='open-add-new-note']", function() {
    $('#addNewNoteSec').slideDown();
    $("[data-action='open-add-new-note']").parent().slideUp()
  })
  $(document).on("click", "[data-action='close-add-new-note']", function() {
    $('#addNewNoteSec').slideUp();
    $("[data-action='open-add-new-note']").parent().slideDown()
  })
</script>
<script type="text/javascript">
  $(document).on("click", "[data-toggle-high-priority-status]", function() {
    var note_eid = $(this).parents('tr').data('eid')
    var high_priority = ($(this).prop("checked")) ? 'YES' : 'NO';
    $.ajax({
      url: "<?php echo AJAXROOT; ?>" + 'user/dispatch/notes/toggle-high-priority-status-action',
      type: 'POST',
      data: {
        note_eid: note_eid,
        high_priority: high_priority
      },
      context: this,
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
        }
        if (data.status) {
          if (high_priority == 'YES') {
            $(this).parents('tr').addClass('bg-high-priority');
            show_small_notes()
          } else {
            $(this).parents('tr').removeClass('bg-high-priority');
            show_small_notes()
          }
        } else {
          alert(data.message)
        }
      }
    })
  });
  $(document).on("click", "[data-delete-d-note]", function() {
    if (confirm('Do you want to delete note ?')) {
      var note_eid = $(this).parents('tr').data('eid')
      $.ajax({
        url: "<?php echo AJAXROOT; ?>" + 'user/dispatch/notes/delete-action',
        type: 'POST',
        data: {
          note_eid: note_eid,
        },
        context: this,
        success: function(data) {
          //console.log(data)
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          if (data.status) {
            show_d_notes()
            show_small_notes()
            $(this).parents('tr').slideUp();

          } else {
            alert(data.message)
          }
        }
      })
    }
  });
</script>
<script type='text/javascript'>
  function show_small_notes() {
    $.ajax({
      url: '../user/dispatch/notes/loads/notes-list-ajax',
      type: 'POST',
      data: {
        load_eid: '<?php echo $_GET['eid']; ?>',
        is_high_priority: 'YES',
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          var counter = 1;
          data = JSON.parse(data)
          $('[data-high-notes]').html('');
          if (data.status) {
            $.each(data.response.list, function(index, item) {
              var row = `<p style ='text-align: left;font-size:.8em;color:#B00000;margin-bottom:3px;'>${counter}. ${item.description} - ${item.added_by_user}</p>`;
              $('[data-high-notes]').append(row);
              counter++;
            })
          }
        }
      }
    })
  }
  show_small_notes()
</script>
<!-- -----------------JAVASCRIPT CODE FOR NOTES FUNCTIONALITY END HERE----------END HERE------------------ -->

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>