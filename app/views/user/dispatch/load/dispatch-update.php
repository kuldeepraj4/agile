<?php
require_once APPROOT . '/views/includes/user/header-quick-view.php';
$dtl = $data['details'];
// echo "<pre>";
// print_r($dtl);
// echo "</pre>";
?>
<style type="text/css">
  .dtfv {
    box-shadow: 0 0 10px -1px darkgrey;
    background: white;

    text-align: center;
    padding: 10px;
    display: block;
    border-radius: 12px;
  }

  .dtfv-heading {
    margin-bottom: 10px;
    font-size: 2em;
    color: var(--theme-color-four);
  }

  .dtfv>section {
    border: 1px solid lightgrey;
    border-radius: 8px;
    overflow: hidden;
    margin: 25px auto;
  }

  .dtfv .dtfv-sec-head {
    display: flex;
    justify-content: space-between;
    padding: 5px 10px;
    background: #486e94;
    border-bottom: 1px solid lightgrey;
  }

  .dtfv .dtfv-sec-heading {
    font-weight: bold;
    font-size: 1.1em;
    color: white;
  }

  .dtfv-sec-heading.angle_down::after {
    color: grey;
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\f107";
    font-size: 1.2em;
  }

  .dtfv .dtfv-sec-head a {
    color: white;
  }

  .dtfv .dtfv-dtl {}

  .dtfv .dtfv-dtl-double {
    display: flex;
  }

  .dtfv .dtfv-dtl-double>div {
    padding: 10px;
    width: 50%;
  }

  .dtfv .dtfv-dtl-double>div:first-child {
    border-right: 1px solid #f2f2f2;
  }

  .dtfv .dtfv-dtl-double>div>ul {
    max-width: 450px;
    margin: auto;
  }

  .dtfv .dtfv-dtl-double>div>ul>li {
    display: flex;
    margin-bottom: 6px;
  }

  .dtfv .dtfv-dtl-double>div>ul>li>label {
    width: 35%;
    text-align: left;
    white-space: pre-wrap;
    padding-right: 10px;
  }

  .dtfv .dtfv-dtl-double>div>ul>li>select,
  .dtfv .dtfv-dtl-double>div>ul>li>input,
  .dtfv .dtfv-dtl-double>div>ul>li>div {
    width: 60%;
    text-align: left;
    flex-grow: 1;
  }

  .dtfv-dtl-action-bar {
    padding: 10px;
  }

  .dtfv-dtl-sec-action-bar {
    display: flex;
    padding: 4px 4px 1px 4px;
    justify-content: flex-end;
  }

  .dtfv-top-action-bar {
    display: flex;
    justify-content: flex-end;
    padding: 4px 1px;
  }

  .dtfv-dtl-table>table {
    border: 1px solid darkgrey;
    border-collapse: collapse;
    background: white;
    overflow: auto;
    box-sizing: border-box;
    width: 95%;
    margin: 8px auto;
  }

  .dtfv-dtl-table>table>thead {
    background: #f2f2f2;
    color: black;
  }

  .dtfv-dtl-table .bg-grey {
    background: grey;
    color: white;
  }

  .dtfv-dtl-table>table>thead>tr {
    border-bottom: 1px solid darkgrey;
  }

  .dtfv-dtl-table>table>thead>tr>th {
    padding: 8px 12px;
    font-weight: normal;
    border: 1px solid grey;
  }

  .dtfv-dtl-table>table>thead>tr>th.bg-grey {
    background: lightgrey;
    color: black;
    font-weight: bold;

  }

  .dtfv-dtl-table>table>tbody>tr>td {
    padding: 8px 12px;

  }

  .dtfv-dtl-table>table>tbody>tr {
    border-bottom: 1px solid #f0f0f0
  }

  .dtfv-dtl-table>table>tbody>tr:last-child {
    border-bottom: none;
  }

  .dtfv-dtl-table>table>thead>tr>td {
    text-align: center;
  }

  .dtfv-dtl-table>table>tbody>tr>td {
    text-align: center;
  }

  .ic:hover {
    transform: scale(1.1);
  }

  .ic.white {
    color: white !important;
  }

  .ic.grey {
    color: grey !important;
  }

  .ic.view::after {
    content: "\f06e";
  }

  .ic.view:hover {
    color: green;
  }

  .ic.edit::after {
    content: "\f304";
  }

  .ic.edit:hover {
    color: steelblue;
  }

  .ic.delete::after {
    content: "\f1f8";
  }

  .ic.delete:hover {
    color: red;
  }

  .ic.angle_down::after {
    content: "\f107";
    font-size: 1.2em;
  }

  .ic.angle_up::after {
    content: "\f106";
    font-size: 1.2em;
  }

  .ic.toggle-on::after {
    content: "\f205";
    font-size: 1.2em;
  }

  .ic.toggle-off::after {
    content: "\f204";
    font-size: 1.2em;
  }

  .ic.toggle-off:hover,
  .ic.toggle-on:hover {
    color: steelblue;
  }
</style>
<br><br>
<section class="dtfv content-box" style="margin: auto;max-width: 1100px">
  <h1 class="dtfv-heading">Update Dispatch</h1>

  <div class="dtfv-top-action-bar" style="text-align:right;">
    <button class="btn_blue" onclick="open_child_window({url:'../user/dispatch/loads/dispatch-details-driver-share?eid=<?php echo $dtl['eid'] ?>',width:700,height:500,name:'driver-dispatch-info-share'})">Share With Driver</button> &nbsp
    <button class="btn_blue" data-change-stop-orders style="display:none;">Change Stop Order</button> &nbsp
    <button class="btn_blue" data-add-stop-off style="display: none;">Add Stop Off</button>
    <button class="btn_blue" data-unassign-stops style="display: none;">Un Assign Stops</button>
    <button class="btn_blue" data-assign-stops style="display:none;">Assign Stops</button> &nbsp
    <button class="btn_blue" data-stops-assginment>Stops Assignment</button>

  </div>
  <section data-top-action-sec style="padding:20px;display: none;">

  </section>
  <div>Status <b><?php echo $dtl['dispatch_status_id'] ?></b></div>
  <section>
    <div class="dtfv-sec-head" data-hide-show-details>
      <div class="dtfv-sec-heading">Basic Information</div>
      <div>
        <button class="ic angle_up white" data-up-down-button></button>
      </div>
    </div>
    <section class="dtfv-dtl">


      <form method="POST" id="MyForm" onsubmit="return save_basic_info()">
        <input type="hidden" name="eid" value="<?php echo $dtl['eid'] ?>">
        <div class="dtfv-dtl-double">
          <div>
            <ul>
              <li>
                <label>Driver Type </label>
                <select name="driver_type_id" data-default-select="<?php echo $dtl['driver_type_id'] ?>"></select>
              </li>
              <li>
                <label>Team/ Solo</label>
                <select name="is_team_driver" data-default-select="<?php echo $dtl['is_team_driver'] ?>" onchange="hide_show_driver_b_option()">
                  <option value=""> - - Select - -</option>
                  <option value="SOLO">SOLO</option>
                  <option value="TEAM">TEAM</option>
                </select>
              </li>
              <li>
                <label>Driver A</label>
                <input style="width:70px" type="text" list="quick_list_drivers" value="<?php echo $dtl['driver_a_display_name'] ?>" data-selected-driver-id="<?php echo $dtl['driver_a_id'] ?>" data-search-driver name="driver_id">
              </li>
              <li data-driver-b>
                <?php
                if ($dtl['is_team_driver'] == "TEAM") {
                  if ($dtl['driver_b_display_name'] != '') {
                    $driver_b_fn = $dtl['driver_b_display_name'];
                  } else {
                    $driver_b_fn = '';
                  }
                  ?>
                  <label>Driver B</label>
                  <input style="width:70px" type="text" list="quick_list_drivers" data-selected-driver-id="<?php echo $dtl['driver_b_id'] ?>" value="<?php echo $driver_b_fn; ?>" data-search-driver name="driver_b_id">
                  <?php
                }
                ?>
              </li>
            </ul>
          </div>
          <div>
            <ul>
              <li>
                <label>Truck</label>
                <input style="width:70px" type="text" list="quick_list_trucks" value="<?php echo $dtl['truck_code'] ?>" data-selected-truck-id="<?php echo $dtl['truck_id'] ?>" name="truck_id">
              </li>
              <li>
                <label>Trailer</label>
                <input style="width:70px" type="text" list="quick_list_trailers" value="<?php echo $dtl['trailer_code'] ?>" data-selected-trailer-id="<?php echo $dtl['trailer_id'] ?>" name="trailer_id">
              </li>
              <li>
                <label>Start From </label>
                <input type="text" value="<?php echo $dtl['start_address_id'] . ' ' . $dtl['start_address_name'] ?>" list="quick_list_addresses" data-selected-address-id="<?php echo $dtl['start_address_id'] ?>" name="addresses_id_search" required>
              </li>
              <li>
                <label>Start Datetime </label>
                <div><input type="text" value="<?php echo $dtl['start_date'] ?>" name="start_address_date" data-date-picker style="width:60%"><input type="text" value="<?php echo $dtl['start_time'] ?>" name="start_address_time" data-time-picker style="width:40%">
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="dtfv-dtl-action-bar">
          <button class="btn_green">Save</button>
        </div>
      </form>
    </section>



  </section>




  <?php
  foreach ($dtl['stops'] as $stop) {
    ?>

    <section>
      <div class="dtfv-sec-head hide" data-hide-show-details>
        <div class="dtfv-sec-heading"><?php echo $stop['stop_category_abbr']; ?> <span style="font-weight: normal;font-style: italic;font-size: .8em;"><?php echo $stop['location_address']; ?></span></div>
        <div style="display: flex;flex-direction:row;flex-wrap:nowrap;color:white;">
          <div style="width:100%;text-align: right;font-weight: normal;"><?php echo $stop['appointment_date'] . " <span style='font-size:.7em;font-style:italic'>" . $stop['appointment_time'] . "</span>"; ?></div>
          <div>
            <button class="ic angle_down white" data-up-down-button></button> 
          </div>
        </div>
      </div>
      <section class="dtfv-dtl">
        <div class="dtfv-dtl-sec-action-bar">
          <button title="Earning & Losses" type="button" onclick="open_child_window({url:'../user/dispatch/loads/stop-earning-losses-update&eid=<?php echo $stop['load_stop_eid']; ?>',width:1000,height:500,name:'stop earning and losses types'})" style="color: blue;">Earning & Losses</button>
        </div>

        <form method="POST" id="stop_form<?php echo $stop['dispatch_stop_id'] ?>" onsubmit="return save_stop_info('stop_form<?php echo $stop['dispatch_stop_id'] ?>')" class="dtfv-dtl">
          <input type="hidden" name="stop_eid" value="<?php echo $stop['dispatch_stop_eid'] ?>">
          <div class="dtfv-dtl-double">
            <div>
              <ul>
                <li>
                  <label>Arrival Datetime </label>
                  <div><input type="text" value="<?php echo $stop['arrival_date'] ?>" name="arrival_date" data-date-picker style="width:60%"><input type="text" value="<?php echo $stop['arrival_time'] ?>" name="arrival_time" data-time-picker style="width:40%">
                  </div>
                </li>
                <li>
                  <label>Departure Datetime </label>
                  <div><input type="text" value="<?php echo $stop['departure_date'] ?>" name="departure_date" data-date-picker style="width:60%"><input type="text" value="<?php echo $stop['departure_time'] ?>" name="departure_time" data-time-picker style="width:40%">
                  </div>
                </li>
              </ul>
            </div>
            <div>
              <ul>
                <li>
                  <label style="width:50%">Seal Numbers</label>
                  <div style="width:35%"><input type="text" name="seal_numbers" value="<?php echo $stop['seal_numbers'] ?>">
                  </div>
                </li>

                <?php
                if ($stop['stop_type'] == 'PICK') {
                  ?>
                  <li>
                    <label style="width:60%">Shift to another trailer ?</label>
                    <div style="width:35%">

                      <input type="checkbox" name="is_trailer_shift" <?php echo ($stop['is_trailer_shift'] == 'YES') ? 'checked' : '' ?>>
                      <select name="shift_to_trailer_id" style="visibility:<?php echo ($stop['is_trailer_shift'] == 'YES') ? '' : 'hidden' ?>" data-default-select="<?php echo $stop['shift_to_trailer_id'] ?>"> <?php echo ($stop['is_trailer_shift'] == 'YES') ? 'required' : '' ?>></select>

                    </div>
                  </li>

                  <li>
                    <label style="width:60%">Temp info matches with shipper ?</label>
                    <div style="width:35%">
                      <input type="checkbox" name="temp_info_matches" <?php echo ($stop['temp_info_matches'] == 'YES') ? 'checked' : '' ?>>
                      <input type="text"  name="temp_info_changed_value" style="visibility:<?php echo ($stop['temp_info_matches'] == 'YES') ? 'hidden' : '' ?>;max-width: 100px" placeholder="value" value="<?php echo $stop['temp_info_changed_value'] ?>">
                    </div>
                  </li>

                  <li>
                    <label style="width:60%">Current Reefer Temp. Confirmed ?</label>
                    <div style="width:35%">
                      <input type="checkbox" name="temp_confirmed" <?php echo ($stop['temp_confirmed'] == 'YES') ? 'checked' : '' ?>>
                    </div>
                  </li>

                  <?php
                }

                ?>

              </ul>
            </div>
          </div>

          <div class="dtfv-dtl-table" style="width:100%;max-width: 700px;margin: auto;">
            <table>
              <thead>
                <tr>
                  <th rowspan="2">#</th>
                  <th rowspan="2">Ref No</th>
                  <th colspan="2" class="bg-grey">As Per ROC</th>
                  <th colspan="2" class="bg-grey">As Per Shipper</th>
                  <th colspan="2" class="bg-grey">As per BOL</th>
                </tr>
                <tr>
                  <th>Pallet</th>
                  <th>Case</th>
                  <th>Pallet</th>
                  <th>Case</th>
                  <th>Pallet</th>
                  <th>Case</th>
                  <?php
                  if ($stop['stop_type'] == 'PICK') {
                    echo "<th rowspan='2'>BOL</th>";
                  } else {
                    echo "<th rowspan='2'>POD</th>";
                  }
                  ?>

                </tr>
              </thead>
              <tbody>

                <?php foreach ($stop['quantity_roc'] as $qty) {
                  ?>
                  <tr data-quantity-details-row>
                    <td style="min-width:150px"><?php echo $qty['pd_number'] ?></td>
                    <td style="min-width:150px"><?php echo $qty['reference_number'] ?></td>
                    <td style="min-width:70"><?php echo $qty['pallet_count_roc'] ?></td>
                    <td style="min-width:70"><?php echo $qty['case_count_roc'] ?></td>
                    <td style="min-width:70"><?php echo $qty['pallet_count_ship'] ?></td>
                    <td style="min-width:70"><?php echo $qty['case_count_ship'] ?></td>

                    <td>
                      <input type="hidden" name="quantity_row_id" value="<?php echo $qty['id'] ?>">
                      <input type="text" name="pallet_count_bol" style="width:80px" value="<?php echo $qty['pallet_count_bol'] ?>">
                    </td>
                    <td><input type="text" name="case_count_bol" style="width:80px" value="<?php echo $qty['case_count_bol'] ?>"></td>
                    <?php
                    if ($stop['stop_type'] == 'PICK') {
                      ?>
                      <td style="white-space:nowrap;">
                        <?php if ($qty['bol_file_path'] != "") {
                          ?>
                          <i class="ic file" style="color:grey" title="View BOL" onclick="open_document('<?php echo $qty['bol_file_path'] ?>')"></i>
                          <?php
                        }
                        ?>
                        <i class="ic upload" style="color:grey" title="Update BOL" onclick="open_child_window({url:'../user/dispatch/loads/update-bol-file&eid=<?php echo $qty['eid'] ?>',width:600,height:500,name:'update-bol-file'})"></i>
                      </td>
                      <?php
                    } elseif ($stop['stop_type'] == 'DROP') { {
                      ?>
                      <td style="white-space:nowrap;">
                        <?php if ($qty['pod_file_path'] != "") {
                          ?>
                          <i class="ic file" style="color:grey" title="View POD" onclick="open_document('<?php echo $qty['pod_file_path'] ?>')"></i>
                          <?php
                        }
                        ?>
                        <i class="ic upload" style="color:grey" title="Update POD" onclick="open_child_window({url:'../user/dispatch/loads/update-pod-file&eid=<?php echo $qty['eid'] ?>',width:600,height:500,name:'update-pod-file'})"></i>
                      </td>
                      <?php
                    }
                  }
                  ?>

                </tr>
                <?php
              } ?>


            </tbody>
          </table>
        </div>





        <div class="dtfv-dtl-action-bar">
          <button type="submit" data-save-stop-info-real>4 </button>
          <button class="btn_green" type="button" data-save-stop-info>Save</button>
        </div>
      </form>

      <?php

      if (count($stop['earning_and_losses']) > 0) {
        ?>


        <div class="dtfv-dtl-table" style="width:100%;max-width: 700px;margin: auto;">
          <table>
            <thead>
              <tr>
                <th colspan="3" class="bg-grey">Earnings & Deductions</th>
              </tr>
              <tr>
                <th>Type</th>
                <th>Amount</th>
                <th>Receipt</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($stop['earning_and_losses'] as $enl) {
                ?>
                <tr data-quantity-details-row>
                  <td style="min-width:150px"><?php echo $enl['name'] ?></td>
                  <td style="min-width:150px"><?php echo $enl['amount'] ?></td>
                  <td style="white-space:nowrap;">
                    <i class="ic upload" style="color:grey" title="Update BOL" onclick="open_child_window({url:'../user/dispatch/loads/update-enl-file&eid=<?php echo $enl['eid'] ?>',width:600,height:500,name:'update-enl-file'})"></i>
                    <?php if ($enl['receipt_path'] != "") {
                      ?>
                      <i class="ic file" style="color:grey" title="View BOL" onclick="open_document('<?php echo $enl['receipt_path'] ?>')"></i>
                      <?php
                    }
                    ?>
                  </td>

                </tr>
                <?php
              } ?>


            </tbody>
          </table>
        </div>
        <?php
      }

      ?>


    </section>
  </section>
  <?php
}
?>
<div>
  <?php
  if($dtl['completion_status']=='INCOMPLETE'){
    ?>
    <button class="btn_blue" type="button" data-mark-as-completed data-eid='<?php echo $dtl['eid'] ?>'>Mark as Completed</button>
    
    <?php
  }elseif ($dtl['completion_status']=='COMPLETED') {
    ?>
    <button class="btn_blue" type="button"  onclick="reopen_dispatch()">Re Open</button>
    <?php
  }elseif ($dtl['completion_status']=='RE OPENED') {
    ?>
    <button class="btn_blue" type="button"  onclick="resubmit_dispatch()">Re Submit</button>
    <?php
  }
  ?>


</div>
<div class="dtfv-dtl-table" style="width:100%;max-width: 1000px;margin: auto;" data-cross-dock-sec>

</div>




<section class="dtfv-dtl" data-dispatch-complete-sec style="display:none;">
  <form method="POST" id="MarkAsCompleted" onsubmit="return mark_as_completed()">
    <input type="hidden" name="dispatch_eid" value="<?php echo $dtl['eid'] ?>">
    <div class="dtfv-dtl-double">
      <div>
        <ul data-next-action-fields>
          <li>
            <label>Next Action Plan</label>
            <select name="next_action_plan">
              <option value=""> - - Select - - </option>
              <option value="NAP001">Waiting For Next Load</option>
              <option value="NAP002">Assign Next Load</option>
              <option value="NAP003">Drop At Yard</option>
              <option value="NAP004">Drop at other site</option>
            </select>
          </li>

        </ul>
      </div>
      <div>
      </div>
    </div>
    <div class="dtfv-dtl-action-bar">
      <button class="btn_green">Save</button> &nbsp <button class="btn_red" data-close-dispatch-complete-sec type="button">Cancel</button>
    </div>
  </form>
</section>



</section>

<script type="text/javascript">
  $(document).ready(function() {

    $(document).on("change", "[name='next_action_plan']", function() {
      let next_action = $(this).val();
      $('[data-drop-at-yard-sec]').remove();

      if (next_action == 'NAP003') {
        $('[data-next-action-fields]').append(`<li data-drop-at-yard-sec>
          <label>Yard</label>
          <select name="drop_at_yard_id"></select>
          </li>`)
        get_yards_quick_list().then(function(data) {
          if (data.status) {
            if (data.response.list) {
              var options = "";
              options += `<option value="">- - Select - -</option>`
              $.each(data.response.list, function(index, item) {
                options += `<option value="${item.id}">${item.name}</option>`;
              })
              $('[name="drop_at_yard_id"]').html(options);
            }
          }
        })
      } else if (next_action == 'NAP004') {
        $('[data-next-action-fields]').append(`<li data-drop-at-yard-sec>
          <label>Drop at location</label>
          <input type="text" value="" list="quick_list_addresses" data-selected-drop-address-id="" name="drop_at_address_id" required>
          </li>`)
      }


    })

    $(document).on("click", "[data-mark-as-completed]", function() {
      $('[data-dispatch-complete-sec]').slideDown()
      $('[data-mark-as-completed]').slideUp()

    });

    $(document).on("click", "[data-close-dispatch-complete-sec]", function() {
      $(`[data-dispatch-complete-sec]`).slideUp()
      $('[data-mark-as-completed]').slideDown()
    })

  });

  function mark_as_completed() {
    show_processing_modal()
    var form = document.getElementById('MarkAsCompleted');
    var isValidForm = form.checkValidity();
    if (isValidForm) {
      var arr = $('#MarkAsCompleted').serializeArray();
      obj = {}
      for (var a = 0; a < arr.length; a++) {
        obj[arr[a].name] = arr[a].value
      }
      obj.drop_at_address_id = $('[name="drop_at_address_id"]').data('selected-drop-address-id');
      $.ajax({
        url: '../user/dispatch/loads/dispath-mark-as-completed',
        type: 'POST',
        data: obj,
        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message)
          if (data.status) {
            window.location.reload()
            window.opener.show_list();
          }
          hide_processing_modal()
        }
      })
    }
    return false
  }

  function reopen_dispatch() {
    show_processing_modal()

      $.ajax({
        url: '../user/dispatch/loads/dispath-reopen',
        type: 'POST',
        data: {
          dispatch_eid:"<?php echo $dtl['eid'] ?>"
        },
        success: function(data) {
          alert(data)
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message)
          if (data.status) {
            window.location.reload()
            window.opener.show_list();
          }
          hide_processing_modal()
        }
      })
  }

function resubmit_dispatch() {
    show_processing_modal()

      $.ajax({
        url: '../user/dispatch/loads/dispath-re-submit',
        type: 'POST',
        data: {
          dispatch_eid:"<?php echo $dtl['eid'] ?>"
        },
        success: function(data) {
          alert(data)
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message)
          if (data.status) {
            window.location.reload()
            window.opener.show_list();
          }
          hide_processing_modal()
        }
      })
  }
</script>





<script type="text/javascript">
  quick_list_trailers({
    status_ids: 'ACTIVE'
  }).then(function(data) {

    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="${item.id}">${item.code}</option>`;

        })

        $('[name="shift_to_trailer_id"]').html(options);
        select_default('[name="shift_to_trailer_id"]')

      }

    }

  })


  $(document.body).on('change', '[name="is_trailer_shift"]', function() {
    if ($(this).prop("checked") == true) {
      $(this).siblings('[name="shift_to_trailer_id"]').css('visibility', 'visible');
    } else {
      $(this).siblings('[name="shift_to_trailer_id"]').css('visibility', 'hidden');
    }
  });

  $(document.body).on('change', '[name="temp_info_matches"]', function() {
    if ($(this).prop("checked") == true) {
      $(this).siblings('[name="temp_info_changed_value"]').css('visibility', 'hidden');
    } else {
      $(this).siblings('[name="temp_info_changed_value"]').css('visibility', 'visible');
    }
  });

</script>


<script type="text/javascript">
  <?php
  $ordr = 0;
  $reorder_content_b = "<div class='dtfv-dtl-table' style='width:100%;max-width: 700px;margin: auto;'><table><thead><tr><th></th><th>Category</th><th>Address</th><th></th></tr></thead><tbody>";
  //$total_stops= count($dtl['stops']);
  foreach ($dtl['stops'] as $stp) {
    if ($stp['arrival_date'] == "") {
      $reorder_content_b .= "<tr data-unassign-stop-row data-eid='" . $stp['dispatch_stop_eid'] . "'><td><input type='checkbox' name='is_included'></td><td>" . $stp['stop_category_abbr'] . "</td><td style='text-align:left;'>" . $stp['location_address'] . "</td><td style='white-space:nowrap;'>  <i class='fas fa-caret-square-up fa-lg' data-stop-order-up></i> &nbsp<i class='fas fa-caret-square-down fa-lg' data-stop-order-down></i></td></tr>";
    }
  }
  $reorder_content_b .= '<tfoot><td colspan="4" style="text-align:center;padding: 10px;"><button onclick="unassign_stops()" class="btn_green">Save</button> &nbsp<button class="btn_red" data-close-top-action-sec>Close</button></td></tfoot></tbody></table></div>'
  ?>
  $(document).on('click', '[data-unassign-stops]', function() {

    $(`[data-top-action-sec]`).html(`<?php echo $reorder_content_b; ?>`)
    $(`[data-top-action-sec]`).slideDown()
  })

  function unassign_stops() {
    let stops_array = [];
    stop_order_no = 0;
    $('[data-unassign-stop-row] [name="is_included"]:checked').each(function(index) {
      stops_array.push({
        stop_order_no: ++stop_order_no,
        stop_eid: $(this).parents('tr').data('eid'),
      })
    })
    $.ajax({
      url: '../user/dispatch/loads/dispatch-unassign-stops-action',
      type: 'POST',
      data: {
        dispatch_eid: '<?php echo $dtl['eid'] ?>',
        unassigned_stops: stops_array
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
        }
        alert(data.message)
        if (data.status) {
          window.location.reload()
        }
        hide_processing_modal()
      }
    })
    return false
  }
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
      <div style="margin:8px auto">
      <label  style="width:30%">Stop Off Type</label>
      <select  style="width:70%" name="stop_off_type">
      <option value=""> - - Select - - </option>
      <option value="TR-DROP"> Trailer Drop </option>
      </select>
      </div>
      <div style="margin-top:"><button type="button" class="btn_green" onclick="add_stop_off()">Save</button> &nbsp<button class="btn_red" data-close-top-action-sec>Close</button></div>
      </section>

      </div>`)
    $(`[data-top-action-sec]`).slideDown()
  })
</script>

<script type="text/javascript">
  function append_cross_dock_stops(list) {
    $.each(list, function(index, item) {
      var row = `<tr data-stops-assginment-row="YES" data-merging-type="CROSS DOCK" data-eid="${item.stop_eid}">
      <td>${item.load_id}</td>
      <td><input type="checkbox" name="is_included"></td>
      <td>${item.category_abbr}</td>
      <td style="max-width: 200px;text-align: left;">${item.address}</td>
      <td style='white-space:nowrap;'>  <i class='fas fa-caret-square-up fa-lg' data-stop-order-up></i> &nbsp<i class='fas fa-caret-square-down fa-lg' data-stop-order-down></i></td>
      <td>CROSS DOCK</td>
      </tr>`;
      $('[data-assign-stops-table]').append(row);
    })

  }




  $(document).on('click', '[data-stops-assginment]', function() {
    let dispatch_id = "<?php echo $dtl['id'] ?>"
    $.ajax({
      url: '../user/dispatch/loads/dispatch-stops-assignment-status-ajax',
      type: 'POST',
      data: {
        dispatch_eid: '<?php echo $dtl['eid'] ?>'
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
        }
        if (data.status) {
          $(`[data-top-action-sec]`).html(`<div class='dtfv-dtl-table' style='width:100%;max-width: 900px;margin: auto;'><table><thead><tr><th>Load ID</th><th>Type</th> <th>Category</th><th>Address</th><th colspan="2"></th></tr></thead><tbody data-assign-stops-table></tbody><tfoot><td colspan="4" style="text-align:center;padding: 10px;"><button onclick="update_dispatch_stops_assignment()" class="btn_green">Save</button> &nbsp <button class="btn_blue" onclick="open_child_window({url:'../user/dispatch/loads/available-cross-docks-list',width:1200,height:500,name:'available-cross-dock-loads'})">Create Cross Dock</button> &nbsp<button class="btn_red" data-close-top-action-sec>Close</button></td></tfoot></table></div>`)
          $(`[data-top-action-sec]`).slideDown()

          $.each(data.response.list, function(index, item) {

            var checkbox = ''
            var same_dispatch = "YES";

            if (item.assignment_status == 'ASSIGNED') {
              if (dispatch_id == item.dispatch_id) {
                checkbox = 'checked'
              } else {
                checkbox = 'checked disabled';
                same_dispatch = "";
              }
            }

            var row = `<tr data-stops-assginment-row="${same_dispatch}" data-eid="${item.stop_eid}" data-merging-type="${item.stop_merging_type}">
            <td>${item.load_id}</td>
            <td><input type="checkbox" name="is_included" ${checkbox}></td>
            <td>${item.category_abbr}</td>
            <td style="max-width: 200px;text-align: left;">${item.address}</td>
            <td style='white-space:nowrap;'>  <i class='fas fa-caret-square-up fa-lg' data-stop-order-up></i> &nbsp<i class='fas fa-caret-square-down fa-lg' data-stop-order-down></i></td>
            </tr>`;
            $('[data-assign-stops-table]').append(row);
          })
        } else {
          alert(data.message)
        }
        hide_processing_modal()
      }
    })
  })

  function update_dispatch_stops_assignment() {
    let stops_array = [];
    stop_order_no = 0;
    $('[data-stops-assginment-row="YES"] [name="is_included"]:checked').each(function(index) {
      stops_array.push({
        stop_order_no: ++stop_order_no,
        stop_eid: $(this).parents('tr').data('eid'),
        stop_merging_type: $(this).parents('tr').data('merging-type')
      })
    })
    $.ajax({
      url: '../user/dispatch/loads/dispatch-update-stops-assignment-action',
      type: 'POST',
      data: {
        dispatch_eid: '<?php echo $dtl['eid'] ?>',
        assigned_stops: stops_array
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
        }
        alert(data.message)
        if (data.status) {
          window.location.reload()
        }
        hide_processing_modal()
      }
    })
    return false
  }
</script>


<script type="text/javascript">
  var return_to = 'close'

  function set_pref(val) {
    return_to = val;
    $('[data-submit]').trigger('click');
  }
</script>


<script type="text/javascript">
  // $(document).on("click", "[data-create-cross-dock]",function(){
  //   $.ajax({
  //     url:'../user/dispatch/loads/available-cross-dock-loads-ajax',
  //     type:'POST',
  //     data:{
  //       exclude_load_id:'<?php echo  $dtl['load_id'] ?>'
  //     },
  //     context: this,
  //     beforeSend:function(){
  //       $('[data-cross-dock-sec]').html('Loading. . .')
  //     },
  //     success:function(data){
  //       if ( ( typeof data ) == 'string' ) {

  //         data = JSON.parse( data )


  //         if ( data.status ) {
  //           $('[data-cross-dock-sec]').html(`<table style="width: 100%" class="add-load-table">
  //             <thead>
  //             <tr>
  //             <th>Load id</th>
  //             <th style="text-align:left;">PO Number</th>
  //             <th style="text-align:left;">Assignment Status</th>
  //             <th></th>
  //             </tr>
  //             </thead>
  //             <tbody data-cross-dock-loads-table></tbody>

  //             </table>`)
  //           $.each ( data.response.list, function( index, item ) {
  //             var row = `<tr data-eid="${item.eid}">
  //             <td style = 'width: 200px;'>${item.id}</td>
  //             <td style = 'width: 200px;text-align:left'>${item.po_number}</td>
  //             <td style ='text-align: left;'>${item.stop_assignment_status}</td>
  //             <td style ='width:150px'><button type="button" data-eid="${item.eid}" data-action="fetch-load-stops" class="btn_green">Choose</button></td>
  //             </tr>`;
  //             $( '[data-cross-dock-loads-table]' ).append(row);
  //           }
  //           )

  //         } else {
  //           var false_message = `<tr><td colspan = '4'>`+data.message+`<td></tr>`;
  //           $( '[data-cross-dock-sec]' ).html(`<div style="text-align:center;color:red">${false_message}</div>`);

  //         }
  //         $('[data-cross-dock-sec]').css('display','block');
  //       }
  //     }
  //   })

  // });
</script>
<script type="text/javascript">
  $(document.body).on('change', '[name="dispatch_status_id"]', function() {
    //---check if empty status is selected
    if ($(this).val() != '') {
      show_processing_modal()
      submit_to_wait_btn('#submit', 'loading')
      //--if valid there is valid status change, then call update api
      $.ajax({
        url: '../user/dispatch/loads/update-dispatch-status-action',
        type: 'POST',
        data: {
          dispatch_eid: $('[name="eid"]').val(),
          status_id: $('[name="dispatch_status_id"]').val()
        },
        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message)
          if (data.status) {
            window.opener.show_list()
            window.location.reload()
          }
          hide_processing_modal()
        }
      })


    } else {
      alert('Please select valid status')
    }
    $(this).data('selected-address-id', address_id_selected);
  });
</script>



<script type="text/javascript">
  $(document).on('click', '[data-save-stop-info]', function() {
    $(this).parents('form').find('[data-save-stop-info-real]').click()
  })

  function save_stop_info(form_id) {
    show_processing_modal()
    submit_to_wait_btn('#submit', 'loading')
    var form = document.getElementById(form_id);
    var isValidForm = form.checkValidity();
    if (isValidForm) {

      //--targate current form
      cur_form = $('#' + form_id);

      var quantity_details_bol = [];
      //------iterate through quantity details rows of $this stop
      (cur_form.find('[data-quantity-details-row]')).each(function(ind) {

        pd_row = ($(this));
        quantity_details_bol.push({
          quantity_row_id: pd_row.find('[name="quantity_row_id"]').val(),
          case_count_bol: pd_row.find('[name="case_count_bol"]').val(),
          pallet_count_bol: pd_row.find('[name="pallet_count_bol"]').val(),
        });
      })



      obj = {};

      var obj = {
        dispatch_stop_eid: cur_form.find('[name="stop_eid"]').val(),
        arrival_date: cur_form.find('[name="arrival_date"]').val(),
        arrival_time: cur_form.find('[name="arrival_time"]').val(),
        departure_date: cur_form.find('[name="departure_date"]').val(),
        departure_time: cur_form.find('[name="departure_time"]').val(),
        seal_numbers: cur_form.find('[name="seal_numbers"]').val(),
        is_trailer_shift: (cur_form.find('[name=is_trailer_shift]').prop("checked") == true) ? 'YES' : 'NO',
        shift_to_trailer_id: cur_form.find('[name=shift_to_trailer_id]').val(),
        temp_info_matches: (cur_form.find('[name=temp_info_matches]').prop("checked") == true) ? 'YES' : 'NO',
        temp_info_changed_value: cur_form.find('[name=temp_info_changed_value]').val(),
        temp_confirmed: (cur_form.find('[name=temp_confirmed]').prop("checked") == true) ? 'YES' : 'NO',
        quantity_details_bol: quantity_details_bol
      }
      $.ajax({
        url: '../user/dispatch/loads/update-dispatch-stop-info-action',
        type: 'POST',
        data: obj,
        success: function(data) {
          console.log(data)
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message)
          if (data.status) {
            if ( window.opener && (typeof window.opener.show_list != 'undefined') ){
              window.opener.show_list();
            }

            window.location.reload()
          }
          hide_processing_modal()
        }
      })
    }
    return false
  }
</script>



<script type="text/javascript">
  function save_basic_info() {
    show_processing_modal()
    submit_to_wait_btn('#submit', 'loading')
    $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    if (isValidForm) {

      obj = {};
      driver_b_id = (($('[name="driver_b_id"]').length) == 1) ? $('[name="driver_b_id"]').data('selected-driver-id') : ''
      is_team_driver = $('[name="is_team_driver"]').val()
      var obj = {
        dispatch_eid: $('[name="eid"]').val(),
        truck_id: $('[name="truck_id"]').data('selected-truck-id'),
        trailer_id: $('[name="trailer_id"]').data('selected-trailer-id'),
        start_address_id: $('[name="addresses_id_search"]').data('selected-address-id'),
        start_date: $('[name="start_address_date"]').val(),
        start_time: $('[name="start_address_time"]').val(),
        driver_type_id:$('[name="driver_type_id"]').val(),
        is_team_driver: is_team_driver,
        driver_id: $('[name="driver_id"]').data('selected-driver-id'),
        driver_b_id: driver_b_id,
      }
      $.ajax({
        url: '../user/dispatch/loads/update-dispatch-basic-info-action',
        type: 'POST',
        data: obj,
        success: function(data) {
          alert(data)
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message)
          if (data.status) {
            window.location.reload()
          }
          hide_processing_modal()
        }
      })
    }
    return false
  }
</script>


<script type="text/javascript">
  quick_list_driver_types().then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option data-value="" value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="${item.id}">${item.name}</option>`;

        })

        $('[name="driver_type_id"]').html(options);
        select_default('[name="driver_type_id"]')

      }

    }

  })
</script>

<datalist id="quick_list_drivers"></datalist>

<script type="text/javascript">
  $(document.body).on('change', '[data-search-driver]', function() {
    driver_id_selected = $(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if ($(this).val() != '') {
      if (driver_id_selected == undefined) {
        alert('Invalid driver selected');
        driver_id_selected = ''
        $(this).val('')
        $(this).focus()
      } else {
        show_processing_modal()
        $.ajax({
          url: '../user/dispatch/loads/validate-driver-dispatch-assignment',
          type: 'POST',
          data: {
            driver_id: driver_id_selected,
            exclude_dispatch_eid: $('[name="eid"]').val()
          },
          success: function(data) {
            if ((typeof data) == 'string') {
              data = JSON.parse(data)
            }
            if (data.status == false) {
              alert(data.message)
            }
            hide_processing_modal()
          }
        })
      }
    } else {
      driver_id_selected = ''
    }
    $(this).data('selected-driver-id', driver_id_selected);
  });

  quick_list_drivers({
    status_ids: 'ACTIVE'
  }).then(function(data) {
    // Run this when your request was successful

    if (data.status) {



      //Run this if response has list

      if (data.response.list) {

        var options = "";

        options += `<option data-driver-filter-rows="" data-value="" value="">- - Select - -</option>`

        $.each(data.response.list, function(index, item) {

          options += `<option data-driver-filter-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" value="` + item.code + ' ' + item.name + `"></option>`;

        })

        $('#quick_list_drivers').html(options);

      }

    }

  })
</script>

<datalist id="quick_list_trucks"></datalist>

<script type="text/javascript">
  $(document.body).on('change', '[data-selected-truck-id]', function() {
    truck_id_selected = $(`option[value="${$(this).val()}"]`).data('value');
    if ($(this).val() != '') {
      if (truck_id_selected == undefined) {
        alert('Invalid truck selected');
        truck_id_selected = ''
        $(this).val('')
        $(this).focus()
      } else {
        show_processing_modal()
        $.ajax({
          url: '../user/dispatch/loads/validate-truck-dispatch-assignment',
          type: 'POST',
          data: {
            truck_id: truck_id_selected,
            exclude_dispatch_eid: $('[name="eid"]').val()
          },
          success: function(data) {
            if ((typeof data) == 'string') {
              data = JSON.parse(data)
            }
            if (data.status == false) {
              alert(data.message)
            }
            hide_processing_modal()
          }
        })
      }
    } else {
      truck_id_selected = ''
    }
    $(this).data('selected-truck-id', truck_id_selected);
  });


  quick_list_trucks({
    status_ids: 'ACTIVE'
  }).then(function(data) {

    // Run this when your request was successful

    if (data.status) {



      //Run this if response has list

      if (data.response.list) {


        var options = "";

        options += `<option data-driv-filter-rows="" data-value="" value="">- - Select - -</option>`

        $.each(data.response.list, function(index, item) {

          options += `<option data-value="${item.id}" value="` + item.code + `"></option>`;

        })

        $('#quick_list_trucks').html(options);

      }

    }

  })
</script>
<script type="text/javascript">
  function hide_show_driver_b_option() {
    if ($('[name="is_team_driver"]').val() == 'SOLO') {
      $('[data-driver-b]').html('');
    } else if ($('[name="is_team_driver"]').val() == 'TEAM') {
      $('[data-driver-b]').html(`<label>Driver B</label>
        <input style="width:70px" type="text" list="quick_list_drivers" data-search-driver  name="driver_b_id">`)
    }
  }
</script>

<datalist id="quick_list_trailers"></datalist>

<script type="text/javascript">
  $(document.body).on('change', '[data-selected-trailer-id]', function() {

    trailer_id_selected = $(`option[value="${$(this).val()}"]`).data('value');
    if ($(this).val() != '') {
      if (trailer_id_selected == undefined) {
        alert('Invalid trailer selected');
        trailer_id_selected = ''
        $(this).val('')
        $(this).focus()
      } else {
        show_processing_modal()
        $.ajax({
          url: '../user/dispatch/loads/validate-trailer-dispatch-assignment',
          type: 'POST',
          data: {
            trailer_id: trailer_id_selected,
            exclude_dispatch_eid: $('[name="eid"]').val()
          },
          success: function(data) {
            if ((typeof data) == 'string') {
              data = JSON.parse(data)
            }
            if (data.status == false) {
              alert(data.message)
            }
            hide_processing_modal()
          }
        })
      }
    } else {
      trailer_id_selected = ''
    }
    $(this).data('selected-trailer-id', trailer_id_selected);

  });


  quick_list_trailers({
    status_ids: 'ACTIVE'
  }).then(function(data) {

    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option data-value="" value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option data-value="${item.id}" value="` + item.code + `"></option>`;

        })

        $('#quick_list_trailers').html(options);

      }

    }

  })
</script>
<datalist id="quick_list_addresses"></datalist>
<script type="text/javascript">
  $(document.body).on('change', '[data-selected-drop-address-id]', function() {
    drop_address_id_selected = $(`[data-addresses-filter-rows="${$(this).val()}"]`).data('value');

    if ($(this).val() != '') {
      if (drop_address_id_selected == undefined) {
        alert('Invalid address selected');
        drop_address_id_selected = ''
        $(this).val('')
        $(this).focus()
      }
    } else {
      drop_address_id_selected = ''
    }
    $('[data-selected-drop-address-id]').data('selected-drop-address-id', drop_address_id_selected);
  });



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


















<script type="text/javascript">
  $('[data-hide-show-details]').each(function() {

    if ($(this).hasClass('hide')) {
      $(this).siblings('.dtfv-dtl').slideUp(1);
    }
  })
  // $(document.body).on('change', '[name="customer_id_search"]' ,function(){
    $(document.body).on('click', '[data-hide-show-details]', function() {
      if ($(this).hasClass('hide')) {
        $(this).siblings('.dtfv-dtl').slideDown('fast')
        $(this).find('[data-up-down-button]').removeClass('angle_down')
        $(this).find('[data-up-down-button]').addClass('angle_up')
        $(this).removeClass('hide')
      } else {
        $(this).siblings('.dtfv-dtl').slideUp('fast')
        $(this).find('[data-up-down-button]').removeClass('angle_up')
        $(this).find('[data-up-down-button]').addClass('angle_down')

        $(this).addClass('hide')
      }

    })
  </script>
  <script type="text/javascript">
  //   //---change stop orders
  $(document).on('click', '[data-stop-order-up]', function() {
    let last_row = $(this).parents('tr').prev('tr');
    $(last_row).before($(this).parents('tr'))
  })
  $(document).on('click', '[data-stop-order-down]', function() {
    let next_row = $(this).parents('tr').next('tr');
    $(next_row).after($(this).parents('tr'))
  })
  // //---/change stop orders
</script>
<script type="text/javascript">
  function add_stop_off() {
    submit_to_wait_btn('#submit', 'loading')
    $.ajax({
      url: '../user/dispatch/loads/add-stop-off-action',
      type: 'POST',
      data: {
        address_id: $('[name="stop_off_address_id"]').data('selected-address-id'),
        load_eid: '<?php echo $dtl["load_eid"]; ?>',
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
</script>

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>