<?php
require_once APPROOT . '/views/includes/user/header-quick-view.php';
$details = $data['details'];
// echo "<pre>";
// print_r($details);
// echo "</pre>";
$shipper = $data['details']['shipper'];
$consignee = $data['details']['consignee'];
$load_type_id = $details['load_type_id'];
?>

<br><br>



<script type="text/javascript">
  show_processing_modal()

  function show_stop_locations(param, row_id) {
    $('tr#' + row_id + ' [name="stop_location_id"]').html(``)
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
          $('tr#' + row_id + ' [name="stop_location_id"]').html(options);
          $(`tr#` + row_id + ` [name="stop_location_id"] option[value="${param.default_select}"]`).prop(`selected`, true);
        }
      }
    }).catch(function(err) {

      // Run this when promise was rejected via reject()

    })

  }
</script>

<script type="text/javascript">
  function show_stop_states(param, row_id) {
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
          $('tr#' + row_id + ' [name="stop_state_id"]').html(options);

          if (param.hasOwnProperty('default_select')) {
            $(`tr#` + row_id + ` [name="stop_state_id"] option[value="${param.default_select}"]`).prop(`selected`, true);
            show_stop_locations({
              state_id: param.default_select,
              default_select: param.default_select_location_id
            }, row_id)

          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }

  $(document.body).on('change', '[name="stop_state_id"]', function() {
    let row_id = $(this).parents('tr').attr('id')
    show_stop_locations({
      state_id: $(this).val()
    }, row_id)
    // driver_id_selected=$(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    // if(driver_id_selected!=undefined){
    //   $(this).data('selected-driver-id',driver_id_selected)
    // }
  });
</script>
<style type="text/css">
  [data-location-refresh] {
    color: grey;
    font-size: .9em;
  }

  [data-add-city] {
    color: grey;
    font-size: .9em;
    cursor: pointer;
  }
</style>

<section class="lg-form-outer">

  <div class="lg-form-header">UPDATE EXPRESS LOAD <?php echo $details['id'] ?></div>

  <form class="lg-form" method="POST" id="MyForm" onsubmit="return update()">

    <section class="section-1" style="max-width: 900px;">

      <input type="hidden" name="update_eid" value="<?php echo $details['eid']; ?>">

      <div>

        <fieldset>

          <legend>Primary Detials</legend>

          <div class="field-section single-column">

            <div class="field-p">

              <label>Customer</label>

              <input type="hidden" name="customer_id" value="<?php echo $details['customer_id'] ?>" required><br>

              <input type="text" value="<?php echo $details['customer_code'] . ' - ' . $details['customer_name'] ?>" list="quick_list_customers" name="customer_id_search" required>

            </div>

            <div class="field-p">

              <label>PO Number</label>

              <input type="text" name="po_number" value="<?php echo $details['po_number'] ?>" onchange="validate_po(this.value)" required>

            </div>
            <div class="field-p">
              <label>Load Type</label>
              <select name="load_type_id" data-default-select="<?php echo $details['load_type_id']  ?>" required> </select>
            </div>

            <div class="field-p" data-trailer-option>
              <?php if ($load_type_id == 'LOT01' || $load_type_id == 'LOT03') {
                ?>
                <label>Trailer Type</label>
                <select name="trailer_type" data-default-select="<?php echo $details['trailer_type']  ?>" required>
                  <option value="">- - Select - -</option>
                  <option value="REEFER">Reefer</option>
                  <option value="VAN">Van</option>
                  <option value="VAN/REEFER">Van/Reefer</option>
                </select>
                <?php
              }
              ?>

            </div>


            <div class="field-p" data-temperature-option>
              <?php if (($load_type_id == 'LOT01' || $load_type_id == 'LOT03') && $details['trailer_type'] == 'REEFER') {
                ?>
                <label>Reefer temperature ( in <span>&#8457;</span> )</label>
                <div>
                  <input type="text" class="w-150" name="reefer_temperature" value="<?php echo $details['reefer_temperature']; ?>" pattern="[0-9.-]{1,}">
                  <select class="w-150" name="reefer_mode" data-default-select="<?php echo $details['reefer_mode']; ?>">
                    <option value=""> - - Select - - </option>
                    <option value="START/STOP">START/STOP</option>
                    <option value="CONTINUOUS">CONTINUOUS</option>
                  </select>
                  <input type="checkbox" name="temperature_as_per_shipper" <?php echo ($details['temperature_as_per_shipper'] == 'YES') ? 'checked' : '' ?>> As Per Shipper
                </div>
                <?php
              } ?>

            </div>

            <div class="field-p">
              <label>Rate (in USD)</label>
              <input type="text" name="rate" value="<?php echo $details['rate'] ?>" pattern="[0-9.-]{1,}" required>
            </div>
          </div>
        </fieldset>
      </div>

    </section>





    <section class="section-1" style="width:1400px;">

      <div>

        <fieldset>

          <legend>Stops</legend>

          <div class="field-section table-rows">

            <table style="width: 100%">

              <thead>

                <tr>

                  <th></th>

                  <th>Stop Type</th>

                  <th>Appointment Type</th>

                  <th>State</th>

                  <th>City</th>

                  <th style="white-space: nowrap;">Date</th>

                  <th>Time</th>

                  <th>TBD*</th>

                  <th></th>
                  <th></th>
                  <th><span data-hide-range style="<?php echo ($load_type_id == 'LOT03') ? '' : 'display:none'; ?>">Has Range ?</span></th>


                </tr>

              </thead>

              <tbody id="stops_table">

                <?php if ($load_type_id == 'LOT03') {

                  $hsr = ($details['has_shipper_range'] == 'YES') ? true : false;

                  ?>
                  <tr data-drop-at-shipper style="display: <?php echo ($hsr != true) ? 'none' : ''; ?>;">
                    <td style="text-align: left;">Drop at Shipper</td>

                    <td></td>

                    <td></td>

                    <td></td>
                    <td></td>

                    <td><input class="w-100" type="text" name="drop_at_shipper_date" value="<?php echo $details['drop_at_shipper_date'] ?>" data-date-picker="" <?php echo ($hsr == true) ? 'required' : ''; ?>></td>

                    <td>
                      <input class="w-100" type="text" data-time-picker style="width:60px" name="drop_at_shipper_time_from" value="<?php echo $details['drop_at_shipper_time_from'] ?>" <?php echo ($hsr == true) ? 'required' : ''; ?>> &nbsp <input class="w-100" type="text" data-time-picker style="width:60px" name="drop_at_shipper_time_to" value="<?php echo $details['drop_at_shipper_time_to'] ?>" <?php echo ($hsr == true) ? 'required' : ''; ?>>
                    </td>

                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                <?php } ?>

                <tr id="shipper_row" data-stop-row data-stop-category="SHIPPER">

                  <td class="counter">Shipper</td>

                  <td><select class="w-100" name="stop_type" required disabled>
                    <option value="PICK" selected>PICK</option>
                    <option value="DROP">DROP</option>
                  </select>

                </td>

                <td><select class="w-100" name="appointment_type" data-default-select="<?php echo $shipper['appointment_type'] ?>" required>

                  <option value="">- Select -</option>

                  <option value="FCFS">FCFS</option>

                  <option value="FIRM">FIRM</option>

                </select>

              </td>
              <td><select class="w-150" name="stop_state_id" data-default-select="<?php echo $shipper['state_id'] ?>" required></select></td>
              <td><select class="w-150" name="stop_location_id" data-default-select="<?php echo $shipper['city_id'] ?>" required></select> <i data-location-refresh class="fas fa-sync-alt" title="Refresh Cities List"></i> <i data-add-city class="fa fa-plus" title="Add City"></i></td>

              <td><input class="w-100" type="text" name="stop_date" value="<?php echo $shipper['date'];  ?>" data-date-picker="" required></td>

              <td>
                <input class="w-100" type="text" data-time-picker style="width:60px" name="stop_time_from" value="<?php echo $shipper['time_from'];  ?>" <?php
                if ($shipper['datetime_tbd'] == 'YES') {
                  echo "disabled";
                }
                if ($shipper['datetime_tbd'] == 'NO') {
                  echo "required";
                }
              ?>>

              &nbsp
              <input class="w-100" type="text" data-time-picker style="width:60px" value="<?php echo $shipper['time_to'];  ?>" name="stop_time_to" <?php
              if ($shipper['datetime_tbd'] == 'YES') {
                echo "disabled";
              }
              if ($shipper['datetime_tbd'] == 'NO') {
                echo "required";
              }
            ?>>
          </td>

          <td> <input type="checkbox" name="stop_datetime_tbd" <?php if ($shipper['datetime_tbd'] == 'YES') {
            echo "checked";
          } ?>></td>
          <td class="arrows"><i class="fas fa-caret-square-down fa-lg down"></i></td>
          <td class="delete"></td>
          <td class="range"><input data-hide-range type="checkbox" <?php echo ($load_type_id == 'LOT03' && $details['has_shipper_range'] == 'YES') ? 'checked' : ''; ?> style="<?php echo ($load_type_id == 'LOT03') ? '' : 'display:none'; ?>" name="has_shipper_range"></td>
        </tr>
        <script type="text/javascript">
          show_stop_states({
            default_select: '<?php echo $shipper['state_id']; ?>',
            default_select_location_id: '<?php echo $shipper['city_id']; ?>'
          }, 'shipper_row');
        </script>

        <?php

        $count = 0;

        $total_stops = count($details['stops']);

        foreach ($details['stops'] as $stop) {

          $count++;
          $row_id = 'stop_row' . $count;
          $row_name = 'Stop ' . $count;
          ?>
          <tr id="<?php echo $row_id; ?>" data-stop-row data-stop-category="STOP">

            <td class="counter"><?php echo $row_name; ?></td>

            <td><select class="w-100" name="stop_type" data-default-select="<?php echo $stop['stop_type'];  ?>" required>

              <option value="">- Select - </option>

              <option value="PICK">PICK</option>

              <option value="DROP">DROP</option>

            </select>

          </td>

          <td><select class="w-100" name="appointment_type" data-default-select="<?php echo $stop['appointment_type'];  ?>" required>

            <option value="">- Select -</option>

            <option value="FCFS">FCFS</option>

            <option value="FIRM">FIRM</option>

          </select>

        </td>
        <td><select class="w-150" name="stop_state_id" data-default-select="<?php echo $stop['state_id'] ?>" required></select></td>
        <td>

          <select class="w-150" name="stop_location_id" data-default-select="<?php echo $stop['city_id'];  ?>" required></select><i data-location-refresh class="fas fa-sync-alt" title="Refresh Cities List"></i> <i data-add-city class="fa fa-plus" title="Add City"></i>

        </td>

        <td>

          <input class="w-100" type="text" name="stop_date" value="<?php echo $stop['date'];  ?>" data-date-picker="" required>

        </td>

        <td>

          <input class="w-100" type="text" data-time-picker style="width:60px" value="<?php echo $stop['time_from'];  ?>" name="stop_time_from" <?php
          if ($stop['datetime_tbd'] == 'YES') {
            echo "disabled";
          }
          if ($stop['datetime_tbd'] == 'NO') {
            echo "required";
          }
        ?>>
        &nbsp
        <input class="w-100" type="text" data-time-picker style="width:60px" value="<?php echo $stop['time_to'];  ?>" name="stop_time_to" <?php
        if ($stop['datetime_tbd'] == 'YES') {
          echo "disabled";
        }
        if ($stop['datetime_tbd'] == 'NO') {
          echo "required";
        }
      ?>>

    </td>

    <td>

      <input type="checkbox" name="stop_datetime_tbd" <?php if ($stop['datetime_tbd'] == 'YES') {
        echo "checked";
      } ?>>

    </td>
    <td class="arrows"><i class="fas fa-caret-square-up fa-lg up"></i>&nbsp;&nbsp;<i class="fas fa-caret-square-down fa-lg down"></i></td>
    <td class="delete"><button type="button" class="btn_red_c" data-remove-stop-button><i class="fa fa-trash"></i></button></td>
    <td class="range"></td>

  </tr>

  <script type="text/javascript">
    show_stop_states({
      default_select: '<?php echo $stop['state_id']; ?>',
      default_select_location_id: '<?php echo $stop['city_id']; ?>'
    }, '<?php echo $row_id; ?>');
  </script>

  <?php
}
?>
<tr id="consignee_row" data-stop-row data-stop-category="CONSIGNEE">

  <td class="counter">Consignee</td>

  <td><select class="w-100" name="stop_type" required disabled>
    <option value="PICK">PICK</option>
    <option value="DROP" selected>DROP</option>
  </select>

</td>

<td>
  <select class="w-100" name="appointment_type" data-default-select="<?php echo $consignee['appointment_type'] ?>" required>
    <option value="">- Select -</option>
    <option value="FCFS">FCFS</option>
    <option value="FIRM">FIRM</option>
  </select>
</td>
<td><select class="w-150" name="stop_state_id" data-default-select="<?php echo $consignee['state_id'] ?>" required></select></td>
<td><select class="w-150" name="stop_location_id" data-default-select="<?php echo $consignee['city_id'] ?>" required></select> <i data-location-refresh class="fas fa-sync-alt" title="Refresh Cities List"></i> <i data-add-city class="fa fa-plus" title="Add City"></i></td>

<td><input class="w-100" type="text" name="stop_date" value="<?php echo $consignee['date'];  ?>" data-date-picker="" required></td>

<td>
  <input class="w-100" type="text" data-time-picker style="width:60px" name="stop_time_from" value="<?php echo $consignee['time_from'];  ?>" <?php
  if ($consignee['datetime_tbd'] == 'YES') {
    echo "disabled";
  }
  if ($consignee['datetime_tbd'] == 'NO') {
    echo "required";
  }
?>>
&nbsp
<input class="w-100" type="text" data-time-picker style="width:60px" value="<?php echo $consignee['time_to'];  ?>" name="stop_time_to" <?php
if ($consignee['datetime_tbd'] == 'YES') {
  echo "disabled";
}
if ($consignee['datetime_tbd'] == 'NO') {
  echo "required";
}
?>>
</td>

<td> <input type="checkbox" name="stop_datetime_tbd" <?php if ($consignee['datetime_tbd'] == 'YES') {
  echo "checked";
} ?>></td>

<td class="arrows"><i class="fas fa-caret-square-up fa-lg up"></i></td>
<td class="delete"></td>


<td class="range"><input data-hide-range type="checkbox" <?php echo ($load_type_id == 'LOT03' && $details['has_consignee_range'] == 'YES') ? 'checked' : ''; ?> style="<?php echo ($load_type_id == 'LOT03') ? '' : 'display:none'; ?>" name="has_consignee_range"></td>

</tr>

<?php if ($load_type_id == 'LOT03') {
  $hcr = ($details['has_consignee_range'] == 'YES') ? true : false;
  ?>
  <tr data-pick-at-consignee style="display: <?php echo ($hcr != true) ? 'none' : ''; ?>;">
    <td style="text-align: left;">Pick from consignee</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><input class="w-100" type="text" name="pick_from_consignee_date" value="<?php echo $details['pick_from_consignee_date'] ?>" data-date-picker="" <?php echo ($hcr == true) ? 'required' : ''; ?>></td>
    <td>
      <input class="w-100" type="text" data-time-picker style="width:60px" name="pick_from_consignee_time_from" value="<?php echo $details['pick_from_consignee_time_from'] ?>" <?php echo ($hcr == true) ? 'required' : ''; ?>> &nbsp <input class="w-100" type="text" data-time-picker style="width:60px" name="pick_from_consignee_time_to" value="<?php echo $details['pick_from_consignee_time_to'] ?>" <?php echo ($hcr == true) ? 'required' : ''; ?>>
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
<?php } ?>

<script type="text/javascript">
  show_stop_states({
    default_select: '<?php echo $consignee['state_id']; ?>',
    default_select_location_id: '<?php echo $consignee['city_id']; ?>'
  }, 'consignee_row');
</script>
</tbody>

<tfoot>

  <tr>

    <td colspan="6" style="text-align: left;">

      <br>

      *Mark the check box under TBD (To Be Done) if appointment time is not available

    </td>

    <td colspan="2">

      <button type="button" class="btn_blue" onclick="add_stop()">Add Stop</button>

    </td>

  </tr>

</tfoot>

</table>

</div>

</fieldset>

</div>

</section>

<section class="lg-form-action-button-box">
  <button type="button" id="button" class="btn_green" onclick="set_pref('save')">SAVE</button>
  <?php
  if (in_array('DIS056', USER_PRIV)) {
    ?>
    <button type='button' id='button' class='btn_green' onclick='set_pref("VERIFIED")'>SAVE AS VERIFIED</button>
    <?php
  }

  ?>

  <button type="submit" data-submit></button>
</section>

</form>

</section>

<datalist id="quick_list_customers"></datalist>

<script type="text/javascript">
  $(document.body).on('change', '[name="customer_id_search"]', function() {

    customer_id_selected = $(`[data-customer-filter-rows="${$(this).val()}"]`).data('value');

    if (customer_id_selected != undefined) {

      $('[name="customer_id"]').val(customer_id_selected)

    }

    if ($(this).val() != '') {
      if (customer_id_selected == undefined) {
        alert('Invalid customer selected');
        customer_id_selected = ''
        $(this).val('')
        $(this).focus()
      }
    } else {
      customer_id_selected = ''
    }
    $('[name="customer_id"]').val(customer_id_selected)

  });




  function show_quick_list_customers() {

    quick_list_customers().then(function(data) {

      // Run this when your request was successful

      if (data.status) {



        //Run this if response has list

        if (data.response.list) {

          var options = "";

          options += `<option data-customer-filter-rows="" data-value="" value="">- - Select - -</option>`

          $.each(data.response.list, function(index, item) {

            options += `<option data-customer-filter-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" value="` + item.code + ' ' + item.name + `"></option>`;

          })

          $('#quick_list_customers').html(options);

        }

      }

    }).catch(function(err) {

      // Run this when promise was rejected via reject()

    })

  }

  show_quick_list_customers()
</script>

<script type="text/javascript">
  function toggle_drop_and_hook() {
    if ($('[name="load_type_id"]').val() == 'LOT03') {

      //-----add row DROP AT SHIPPER before Shipper row
      $('#shipper_row').before(`<tr data-drop-at-shipper style="display:none"><td style="text-align: left;">Drop at Shipper</td>

        <td></td>

        <td></td>

        <td></td>
        <td></td>

        <td><input class="w-100" type="text" name="drop_at_shipper_date" data-date-picker="" ></td>

        <td>
        <input class="w-100" type="text" data-time-picker style="width:60px" name="drop_at_shipper_time_from" > &nbsp <input class="w-100" type="text" data-time-picker style="width:60px" name="drop_at_shipper_time_to" >
        </td>

        <td></td>
        <td></td>
        <td></td></tr>`)
      $("[data-date-picker]").datepicker();


      //-----add row PICK FROM CONSIGNEE after consignee row

      $('#consignee_row').after(`<tr data-pick-at-consignee style="display:none"><td style="text-align: left;">Pick from consignee</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><input class="w-100" type="text" name="pick_from_consignee_date" data-date-picker="" ></td>
        <td>
        <input class="w-100" type="text" data-time-picker style="width:60px" name="pick_from_consignee_time_from" > &nbsp <input class="w-100" type="text" data-time-picker style="width:60px" name="pick_from_consignee_time_to" > 
        </td>
        <td></td>
        <td></td>
        <td></td></tr>`)
      $("[data-date-picker]").datepicker();

      //--------show/hide stop range
      $('[data-hide-range]').prop('checked', false)
      $('[data-hide-range]').show();
      //--------show/hide stop range

    } else {
      $('[data-hide-range]').hide();
      $(`[data-drop-at-shipper]`).remove()
      $(`[data-pick-at-consignee]`).remove()
    }
  }
</script>


<script type="text/javascript">
  $(document.body).on('change', '[name="load_type_id"]', function() {
    if ($(this).val() == 'LOT01' || $(this).val() == 'LOT03') {
      // $('[data-trailer-option]').html('');
      // $('[data-temperature-option]').html('');
      $('[data-trailer-option]').show();

      $('[data-trailer-option]').html(`<label>Trailer Type</label>
        <select name="trailer_type" required>
        <option value="">- - Select - -</option>
        <option value="REEFER">Reefer</option>
        <option value="VAN">Van</option>
        <option value="VAN/REEFER">Van/Reefer</option>
        </select> 
        `);
    } else {
      $('[data-trailer-option]').html('');
      $('[data-temperature-option]').html('');
      $('[data-trailer-option]').hide();
      $('[data-temperature-option]').hide();
    }

    toggle_drop_and_hook();

  });
</script>



<script type="text/javascript">
  //-------- hide/show temperature to maintain option based on the trailer type selection

  $(document.body).on('change', '[name="trailer_type"]', function() {

    if ($(this).val() == 'REEFER') {

      $('[data-temperature-option]').show();

      $('[data-temperature-option]').html(`<label>Reefer Temperature ( in <span>&#8457;</span> )</label>
        <div>
        <input type="text" class="w-150" name="reefer_temperature" pattern="[0-9.-]{1,}"> 
        <select  class="w-150" name="reefer_mode">
        <option value=""> - - Select - - </option>
        <option value="CONTINUOUS" selected>CONTINUOUS</option>
        <option value="START/STOP">START/STOP</option>
        </select>
        <input type="checkbox" name="temperature_as_per_shipper"> As Per Shipper
        </div>`);



    } else {

      $('[data-temperature-option]').hide();

    }

  });

  //--------/ hide/show temperature to maintain option based on the trailer type selection
</script>

<script type="text/javascript">
  //-------- add/remove required attribute based on TBD check box 
  $(document.body).on('change', '[name="has_consignee_range"]', function() {
    if ($(this).prop("checked") == true) {
      $(`[data-pick-at-consignee]`).show()
      $(`[data-pick-at-consignee]`).find('[name="pick_from_consignee_date"]').prop('required', true)
      $(`[data-pick-at-consignee]`).find('[name="pick_from_consignee_time_from"]').prop('required', true)
      $(`[data-pick-at-consignee]`).find('[name="pick_from_consignee_time_to"]').prop('required', true)
    } else {
      $(`[data-pick-at-consignee]`).hide()
      $(`[data-pick-at-consignee]`).find('[name="pick_from_consignee_date"]').prop('required', false)
      $(`[data-pick-at-consignee]`).find('[name="pick_from_consignee_time_from"]').prop('required', false)
      $(`[data-pick-at-consignee]`).find('[name="pick_from_consignee_time_to"]').prop('required', false)
    }

  });
  //--------/ add/remove required attribute based on TBD check box 
</script>

<script type="text/javascript">
  //-------- add/remove required attribute based on TBD check box 

  $(document.body).on('change', '[name="has_shipper_range"]', function() {
    if ($(this).prop("checked") == true) {
      $(`[data-drop-at-shipper]`).show()
      $(`[data-drop-at-shipper]`).find('[name="drop_at_shipper_date"]').prop('required', true)
      $(`[data-drop-at-shipper]`).find('[name="drop_at_shipper_time_from"]').prop('required', true)
      $(`[data-drop-at-shipper]`).find('[name="drop_at_shipper_time_to"]').prop('required', true)
    } else {
      $(`[data-drop-at-shipper]`).hide()
      $(`[data-drop-at-shipper]`).find('[name="drop_at_shipper_date"]').prop('required', false)
      $(`[data-drop-at-shipper]`).find('[name="drop_at_shipper_time_from"]').prop('required', false)
      $(`[data-drop-at-shipper]`).find('[name="drop_at_shipper_time_to"]').prop('required', false)
    }
  });
  //--------/ add/remove required attribute based on TBD check box 
</script>


<script type="text/javascript">
  //-------- add/remove required attribute based on TBD check box 

  $(document.body).on('change', '[name="stop_datetime_tbd"]', function() {

    if ($(this).prop("checked") == true) {

      //$(this).parent().siblings().children('[name="stop_date"]').removeAttr('required')

      $(this).parent().siblings().children('[name="stop_time_from"]').removeAttr('required')
      $(this).parent().siblings().children('[name="stop_time_from"]').prop('disabled', true)
      $(this).parent().siblings().children('[name="stop_time_from"]').val('')

      $(this).parent().siblings().children('[name="stop_time_to"]').removeAttr('required')
      $(this).parent().siblings().children('[name="stop_time_to"]').prop('disabled', true)
      $(this).parent().siblings().children('[name="stop_time_to"]').val('')

    } else if ($(this).prop("checked") == false) {

      //$(this).parent().siblings().children('[name="stop_date"]').attr('required',true)

      $(this).parent().siblings().children('[name="stop_time_from"]').attr('required', true)
      $(this).parent().siblings().children('[name="stop_time_from"]').prop('disabled', false)
      $(this).parent().siblings().children('[name="stop_time_to"]').attr('required', true)
      $(this).parent().siblings().children('[name="stop_time_to"]').prop('disabled', false)

    }

  });

  //--------/ add/remove required attribute based on TBD check box 
</script>



<script type="text/javascript">
  /*function show_customer_id_options(){

   quick_list_customers().then(function(data) {

  // Run this when your request was successful

  if(data.status){

    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option value="${item.eid}">${item.eid} - ${item.customer_name}</option>`;               

      })

      $('[name="customer_id"]').html(options);     

    }

  }

}).catch(function(err) {

  // Run this when promise was rejected via reject()

}) 

}

show_customer_id_options()*/
</script>
<script type="text/javascript">
  ///-----------Add new stop


  var counter = <?php echo $count; ?>

  var $stops_table = $('#stops_table');

  function add_stop() {
    ++counter
    var $stop_row = `<tr id="stop_row${counter}"  data-stop-row  data-stop-category="STOP">

    <td class="counter">Stop ${counter}</td>

    <td><select class="w-100" name="stop_type" required>

    <option value="">- Select -  </option>

    <option value="PICK">PICK</option>

    <option value="DROP">DROP</option>

    </select>

    </td>

    <td><select class="w-100" name="appointment_type" required>

    <option value="">- Select -</option>

    <option value="FCFS">FCFS</option>

    <option value="FIRM">FIRM</option>

    </select>

    </td>
    <td><select class="w-150" name="stop_state_id" required></select></td>
    <td><select class="w-150" name="stop_location_id" required></select> <i data-location-refresh class="fas fa-sync-alt" title="Refresh Cities List"></i>  <i data-add-city class="fa fa-plus" title="Add City"></i></td>

    <td><input class="w-100" type="text" name="stop_date" data-date-picker="" required></td>

    <td><input class="w-100" type="text" data-time-picker style="width:60px" name="stop_time_from" required>&nbsp <input class="w-100" type="text" data-time-picker style="width:60px" name="stop_time_to" required></td>

    <td><input  type="checkbox" name="stop_datetime_tbd"></td>      
    <td class="arrows"><i class="fas fa-caret-square-up fa-lg up"></i>&nbsp;&nbsp;<i class="fas fa-caret-square-down fa-lg down"></i></td>  

    <td class="delete"><button type="button" class="btn_red_c" data-remove-stop-button><i class="fa fa-trash"></i></button></td>
    <td class="range"></td>
    </tr>`;

    $('#consignee_row').before($stop_row);

    $("[data-date-picker]").datepicker();
    //    show_stop_locations({},'stop_row'+counter)
    show_stop_states({}, 'stop_row' + counter)
  }

  ///-----------//Add new stop

  ///-----------remove stop



  $(document.body).on('click', '[data-remove-stop-button]', function() {

    $(this).parent().parent().remove();

    counter = 0;
    $('.counter').each(function(index, item) {
      var length = $('.counter').length
      var last_index = eval(length) - eval(1)
      if (index == 0) {
        $(this).html("Shipper")
      } else if (index == last_index) {
        $(this).html("Consignee")
      } else {
        counter = counter + 1;
        $(this).html("Stop " + counter)
        $(this).parent().attr('id', 'stop_row' + counter);
      }
    })
  });

  ///-----------/revmove stop
</script>

<script type="text/javascript">
  $(document.body).on('click', '.down', function() {
    var drop_type = $('[name="load_type_id"]').val()
    var has_shipper_range;
    var has_consignee_range;
    var trhtml = $(this).parent().parent().html();
    var this_tr = $(this).parent().parent();
    if (this_tr.find("[name=stop_datetime_tbd]").prop("checked") == true) {
      stop_datetime_tbd = 'YES';
    } else {
      stop_datetime_tbd = 'NO';
    }
    if ($('#shipper_row').find("[name=has_shipper_range]").prop("checked") == true) {
      has_shipper_range = 'YES';
    } else {
      has_shipper_range = 'NO';
    }
    if ($('#consignee_row').find("[name=has_consignee_range]").prop("checked") == true) {
      has_consignee_range = 'YES';
    } else {
      has_consignee_range = 'NO';
    }
    var stop_type = this_tr.find('[name="stop_type"]').val();
    var appointment_type = this_tr.find('[name="appointment_type"]').val();
    var stop_state_id = this_tr.find('[name="stop_state_id"]').val();
    var stop_location_id = this_tr.find('[name="stop_location_id"]').val();
    var stop_date = this_tr.find('[name="stop_date"]').val();
    var stop_time_from = this_tr.find('[name="stop_time_from"]').val();
    var stop_time_to = this_tr.find('[name="stop_time_to"]').val();
    var range = this_tr.find('[name="has_shipper_range"]').val()
    row_id = this_tr.attr('id');
    data_stop_category = this_tr.data('stop-category');
    $(this).parent().parent().next().after(`<tr id="${row_id}"  data-stop-row  data-stop-category="${data_stop_category}">${trhtml}</tr>`);
    $(this).parent().parent().remove();
    $(`#${row_id}`).find(`[name="stop_type"] option[value="${stop_type}"]`).prop('selected', true);
    $(`#${row_id}`).find(`[name="appointment_type"] option[value="${appointment_type}"]`).prop('selected', true);
    $(`#${row_id}`).find(`[name="stop_state_id"] option[value="${stop_state_id}"]`).prop('selected', true);
    $(`#${row_id}`).find(`[name="stop_location_id"] option[value="${stop_location_id}"]`).prop('selected', true);
    $(`#${row_id}`).find(`[name="stop_date"]`).val(stop_date);
    $(`#${row_id}`).find(`[name="stop_time_from"]`).val(stop_time_from);
    $(`#${row_id}`).find(`[name="stop_time_to"]`).val(stop_time_to);
    if (stop_datetime_tbd == 'YES') {
      $(`#${row_id}`).find(`[name="stop_datetime_tbd"]`).prop('checked', true);
    } else {
      $(`#${row_id}`).find(`[name="stop_datetime_tbd"]`).prop('checked', false);
    }
    counter = 0;
    $('.counter').each(function(index, item) {
      var length = $('.counter').length
      var last_index = eval(length) - eval(1)
      if (index == 0) {
        $(this).html("Shipper")
        $(this).parent().attr('data-stop-category', 'SHIPPER');
        $(this).parent().attr('id', 'shipper_row');
        $(this).parent().find('.arrows').html('<i class="fas fa-caret-square-down fa-lg down"></i>');
        $(this).parent().find('.delete').html('');
        $(this).parent().find('[name="stop_type"] option[value="PICK"]').prop('selected', true);
        $(this).parent().find('[name="stop_type"]').prop('disabled', true);
        if (drop_type == "LOT03" && has_shipper_range == "YES") {
          $('#shipper_row').find('.range').html(`<input data-hide-range type="checkbox" checked name="has_shipper_range">`);
        } else if (drop_type == "LOT03" && has_shipper_range == "NO") {
          $('#shipper_row').find('.range').html(`<input data-hide-range type="checkbox" name="has_shipper_range">`);
        } else {
          $('#shipper_row').find('.range').html(`<input data-hide-range style="display: none;" type="checkbox" name="has_shipper_range">`);
        }
      } else if (index == last_index) {
        $(this).html("Consignee")
        $(this).parent().attr('data-stop-category', 'CONSIGNEE');
        $(this).parent().attr('id', 'consignee_row');
        $(this).parent().find('.arrows').html('<i class="fas fa-caret-square-up fa-lg up"></i>')
        $(this).parent().find('.delete').html('')
        $(this).parent().find('[name="stop_type"] option[value="DROP"]').prop('selected', true);
        $(this).parent().find('[name="stop_type"]').prop('disabled', true);
        if (drop_type == "LOT03" && has_consignee_range == "YES") {
          $('#consignee_row').find('.range').html(`<input data-hide-range type="checkbox" checked name="has_consignee_range">`);
        } else if (drop_type == "LOT03" && has_consignee_range == "NO") {
          $('#consignee_row').find('.range').html(`<input data-hide-range type="checkbox" name="has_consignee_range">`);
        } else {
          $('#consignee_row').find('.range').html(`<input data-hide-range style="display: none;" type="checkbox" name="has_consignee_range">`);
        }
      } else {
        counter = counter + 1;
        $(this).html("Stop " + counter)
        $(this).parent().attr('data-stop-category', 'STOP');
        $(this).parent().attr('id', 'stop_row' + counter);
        $(this).parent().find('.arrows').html('<i class="fas fa-caret-square-up fa-lg up"></i>&nbsp;&nbsp;<i class="fas fa-caret-square-down fa-lg down"></i>')
        $(this).parent().find('.delete').html('<button type="button" class="btn_red_c" data-remove-stop-button><i class="fa fa-trash"></i></button>')
        $(this).parent().find('.range').html('')
        $(this).parent().find('[name="stop_type"]').prop('disabled', false);
      }
    })
    $("[data-date-picker]").removeAttr('id') //
    $("[data-date-picker]").removeClass('hasDatepicker') //code to reset calender and make it work in new created shuffled row
    $("[data-date-picker]").datepicker(); //
  })



$(document.body).on('click', '.up', function() {
  var drop_type = $('[name="load_type_id"]').val()
  var has_shipper_range;
  var has_consignee_range;
  var trhtml = $(this).parent().parent().html();
  var this_tr = $(this).parent().parent();
  if (this_tr.find("[name=stop_datetime_tbd]").prop("checked") == true) {
    stop_datetime_tbd = 'YES';
  } else {
    stop_datetime_tbd = 'NO';
  }
  if ($('#shipper_row').find("[name=has_shipper_range]").prop("checked") == true) {
    has_shipper_range = 'YES';
  } else {
    has_shipper_range = 'NO';
  }
  if ($('#consignee_row').find("[name=has_consignee_range]").prop("checked") == true) {
    has_consignee_range = 'YES';
  } else {
    has_consignee_range = 'NO';
  }
  var stop_type = this_tr.find('[name="stop_type"]').val();
  var appointment_type = this_tr.find('[name="appointment_type"]').val();
  var stop_state_id = this_tr.find('[name="stop_state_id"]').val();
  var stop_location_id = this_tr.find('[name="stop_location_id"]').val();
  var stop_date = this_tr.find('[name="stop_date"]').val();
  var stop_time_from = this_tr.find('[name="stop_time_from"]').val();
  var stop_time_to = this_tr.find('[name="stop_time_to"]').val();
  row_id = this_tr.attr('id');
  data_stop_category = this_tr.data('stop-category');
  $(this).parent().parent().prev().before(`<tr id="${row_id}"  data-stop-row  data-stop-category="${data_stop_category}">${trhtml}</tr>`);
  $(this).parent().parent().remove();
  $(`#${row_id}`).find(`[name="stop_type"] option[value="${stop_type}"]`).prop('selected', true);
  $(`#${row_id}`).find(`[name="appointment_type"] option[value="${appointment_type}"]`).prop('selected', true);
  $(`#${row_id}`).find(`[name="stop_state_id"] option[value="${stop_state_id}"]`).prop('selected', true);
  $(`#${row_id}`).find(`[name="stop_location_id"] option[value="${stop_location_id}"]`).prop('selected', true);
  $(`#${row_id}`).find(`[name="stop_date"]`).val(stop_date);
  $(`#${row_id}`).find(`[name="stop_time_from"]`).val(stop_time_from);
  $(`#${row_id}`).find(`[name="stop_time_to"]`).val(stop_time_to);
  if (stop_datetime_tbd == 'YES') {
    $(`#${row_id}`).find(`[name="stop_datetime_tbd"]`).prop('checked', true);
  } else {
    $(`#${row_id}`).find(`[name="stop_datetime_tbd"]`).prop('checked', false);
  }
  counter = 0;
  $('.counter').each(function(index, item) {
    var length = $('.counter').length
    var last_index = eval(length) - eval(1)
    if (index == 0) {
      $(this).html("Shipper")
      $(this).parent().attr('data-stop-category', 'SHIPPER');
      $(this).parent().attr('id', 'shipper_row');
      $(this).parent().find('.arrows').html('<i class="fas fa-caret-square-down fa-lg down"></i>')
      $(this).parent().find('.delete').html('')
      $(this).parent().find('[name="stop_type"] option[value="PICK"]').prop('selected', true);
      $(this).parent().find('[name="stop_type"]').prop('disabled', true);
      if (drop_type == "LOT03" && has_shipper_range == "YES") {
        $('#shipper_row').find('.range').html(`<input data-hide-range type="checkbox" checked name="has_shipper_range">`);
      } else if (drop_type == "LOT03" && has_shipper_range == "NO") {
        $('#shipper_row').find('.range').html(`<input data-hide-range type="checkbox" name="has_shipper_range">`);
      } else {
        $('#shipper_row').find('.range').html(`<input data-hide-range style="display: none;" type="checkbox" name="has_shipper_range">`);
      }
    } else if (index == last_index) {
      $(this).html("Consignee")
      $(this).parent().attr('data-stop-category', 'CONSIGNEE');
      $(this).parent().attr('id', 'consignee_row');
      $(this).parent().find('.arrows').html('<i class="fas fa-caret-square-up fa-lg up"></i>')
      $(this).parent().find('.delete').html('')
      $(this).parent().find('[name="stop_type"] option[value="DROP"]').prop('selected', true);
      $(this).parent().find('[name="stop_type"]').prop('disabled', true);
      if (drop_type == "LOT03" && has_consignee_range == "YES") {
        $('#consignee_row').find('.range').html(`<input data-hide-range type="checkbox" checked name="has_consignee_range">`);
      } else if (drop_type == "LOT03" && has_consignee_range == "NO") {
        $('#consignee_row').find('.range').html(`<input data-hide-range type="checkbox" name="has_consignee_range">`);
      } else {
        $('#consignee_row').find('.range').html(`<input data-hide-range style="display: none;" type="checkbox" name="has_consignee_range">`);
      }
    } else {
      counter = counter + 1;
      $(this).html("Stop " + counter)
      $(this).parent().attr('data-stop-category', 'STOP');
      $(this).parent().attr('id', 'stop_row' + counter);
      $(this).parent().find('.arrows').html('<i class="fas fa-caret-square-up fa-lg up"></i>&nbsp;&nbsp;<i class="fas fa-caret-square-down fa-lg down"></i>')
      $(this).parent().find('.delete').html('<button type="button" class="btn_red_c" data-remove-stop-button><i class="fa fa-trash"></i></button>')
      $(this).parent().find('.range').html('')
      $(this).parent().find('[name="stop_type"]').prop('disabled', false);
    }
  })
    $("[data-date-picker]").removeAttr('id') //
    $("[data-date-picker]").removeClass('hasDatepicker') //code to reset calender and make it work in new created shuffled row
    $("[data-date-picker]").datepicker(); //
  })
</script>




<script type="text/javascript">
  var allow_duplicate_po_number = false;
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
      var $data_stop_rows = $("[data-stop-row]");
      data_stop_array = []
      $data_stop_rows.each(function(index) {
        var $data_stop_row = $(this);
        var stop_datetime_tbd = 'NO';
        if ($(this).find("[name=stop_datetime_tbd]").prop("checked") == true) {
          stop_datetime_tbd = 'YES';
        }
        switch ($data_stop_row.attr('id')) {
          case 'shipper_row':
          var stop_cat = 'SHIPPER';
          break;
          case 'consignee_row':
          var stop_cat = 'CONSIGNEE';
          break;
          default:
          var stop_cat = 'STOP';
        }
        var stop_row = {
          stop_category: stop_cat,
          stop_type: $data_stop_row.find("[name=stop_type]").val(),
          appointment_type: $data_stop_row.find("[name=appointment_type]").val(),
          stop_location_id: $data_stop_row.find("[name=stop_location_id]").val(),
          stop_date: $data_stop_row.find("[name=stop_date]").val(),
          stop_time_from: $data_stop_row.find("[name=stop_time_from]").val(),
          stop_time_to: $data_stop_row.find("[name=stop_time_to]").val(),
          stop_datetime_tbd: stop_datetime_tbd
        }
        data_stop_array.push(stop_row)
        // console.log(data_stop_array)
      })

      var load_type_id = $("[name='load_type_id']").val();
      var trailer_type = '';
      var reefer_temperature = '';
      var reefer_mode = '';
      var has_shipper_range = 'NO';
      var drop_at_shipper_date = '';
      var drop_at_shipper_time_from = '';
      var drop_at_shipper_time_to = '';
      var has_consignee_range = 'NO';
      var pick_from_consignee_date = '';
      var pick_from_consignee_time_from = '';
      var pick_from_consignee_time_to = '';
      var temperature_as_per_shipper = 'NO';

      if (load_type_id == 'LOT01' || load_type_id == 'LOT03') {
        trailer_type = $('[name="trailer_type"]').val()
      }

      if (trailer_type == 'REEFER') {
        reefer_temperature = $('[name="reefer_temperature"]').val()
        reefer_mode = $('[name="reefer_mode"]').val()
        temperature_as_per_shipper = ($('[name="temperature_as_per_shipper"]').prop("checked") == true) ? 'YES' : 'NO';
      }

      if (load_type_id == 'LOT03') {
        if ($('[name="has_shipper_range"]').prop("checked") == true) {
          has_shipper_range = 'YES';
          drop_at_shipper_date = $('[name="drop_at_shipper_date"]').val();
          drop_at_shipper_time_from = $('[name="drop_at_shipper_time_from"]').val();
          drop_at_shipper_time_to = $('[name="drop_at_shipper_time_to"]').val();
        }
        if ($('[name="has_consignee_range"]').prop("checked") == true) {
          has_consignee_range = 'YES';
          pick_from_consignee_date = $('[name="pick_from_consignee_date"]').val();
          pick_from_consignee_time_from = $('[name="pick_from_consignee_time_from"]').val();
          pick_from_consignee_time_to = $('[name="pick_from_consignee_time_to"]').val();
        }
      }

      var obj = {
        update_eid: $('[name="update_eid"]').val(),
        customer_id: $('[name="customer_id"]').val(),
        po_number: $('[name="po_number"]').val(),
        load_type_id: load_type_id,
        trailer_type: trailer_type,
        rate: $('[name="rate"]').val(),
        booked_by_id: $('[name="booked_by_id"]').val(),
        temperature_as_per_shipper: temperature_as_per_shipper,
        reefer_temperature: reefer_temperature,
        reefer_mode: reefer_mode,
        stops: data_stop_array,
        allow_duplicate_po_number: allow_duplicate_po_number,
        has_consignee_range: has_consignee_range,
        has_shipper_range: has_shipper_range,
        drop_at_shipper_date: drop_at_shipper_date,
        drop_at_shipper_time_from: drop_at_shipper_time_from,
        drop_at_shipper_time_to: drop_at_shipper_time_to,
        pick_from_consignee_date: pick_from_consignee_date,
        pick_from_consignee_time_from: pick_from_consignee_time_from,
        pick_from_consignee_time_to: pick_from_consignee_time_to,
        is_verified: is_verified
      }
      $.ajax({

        url: '../user/dispatch/loads/express-update-action',

        type: 'POST',

        data: obj,

        success: function(data) {
         // alert(data)
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          if (data.status) {
            alert(data.message)
            if (get_from_url('call-back-page') == '') {
              window.opener.show_group_list()
              window.opener.show_list()
              window.close();
            } else {
              location.href = get_from_url('call-back-page')
            }

          } else {

            if (data.message == "CONFIRM") {
              switch (data.confirm) {
                case 'ALLOW DUPLICATE PO NUMBER':
                let conf = confirm(data.confirm_message);
                if (conf == true) {
                  allow_duplicate_po_number = true;
                  update()
                }
                break;
              }
            } else {
              alert(data.message)
            }
          }

          hide_processing_modal()
          wait_to_submit_btn('#submit', 'SAVE')
        }

      })

    }

    return false

  }
</script>

<script type="text/javascript">
  /*
 var allow_duplicate_po_number=false;


 function update(){

    //show_processing_modal()

    //submit_to_wait_btn('#submit','loading')

    $('#formErro').show()

    var form = document.getElementById('MyForm');

    var isValidForm = form.checkValidity();

    var currentForm = $('#MyForm')[0];

    var formData=new FormData(currentForm);

    if(isValidForm){

      var arr=$('#MyForm').serializeArray();

      

      var $data_stop_rows = $("[data-stop-row]");

      data_stop_array=[]

      $data_stop_rows.each(function (index) {

        var $data_stop_row = $(this);



        var stop_datetime_tbd='NO';

        if($(this).find("[name=stop_datetime_tbd]").prop("checked") == true){

          stop_datetime_tbd='YES'

        }





        var stop_row={
          stop_category:$data_stop_row.data('stop-category'),
          stop_type : $data_stop_row.find("[name=stop_type]").val(),
          appointment_type : $data_stop_row.find("[name=appointment_type]").val(),
          stop_location_id : $data_stop_row.find("[name=stop_location_id]").val(),
          stop_date : $data_stop_row.find("[name=stop_date]").val(),
          stop_time_from : $data_stop_row.find("[name=stop_time_from]").val(),
          stop_time_to : $data_stop_row.find("[name=stop_time_to]").val(),
          stop_datetime_tbd : stop_datetime_tbd
        }

        data_stop_array.push(stop_row)

      })

      var temperature_to_maintain='';
      var reefer_mode=''
      if($("[name='trailer_type'] :selected").text()=='REEFER'){

        temperature_to_maintain=$('[name="temperature_to_maintain"]').val()
        reefer_mode=$('[name="reefer_mode"]').val()
      }

      var obj={

        update_eid:$('[name="update_eid"]').val(),

        customer_id:$('[name="customer_id"]').val(),

        po_number:$('[name="po_number"]').val(),

        trailer_type:$('[name="trailer_type"]').val(),

        rate:$('[name="rate"]').val(),

        temperature_to_maintain:temperature_to_maintain,
        reefer_mode:reefer_mode,
        stops:data_stop_array,
        allow_duplicate_po_number:allow_duplicate_po_number
      }

      $.ajax({

        url:window.location.pathname+'-action',

        type:'POST',

        data: obj,

        success:function(data){
          console.log(data)
          if((typeof data)=='string'){

           data=JSON.parse(data) 
           console.log(data)
         }

         if(data.status){
           window.opener.show_list()
           window.close();
         }else{


          if(data.message=="CONFIRM"){
            switch(data.confirm){
              case 'ALLOW DUPLICATE PO NUMBER':
              let conf = confirm(data.confirm_message);
              if(conf==true){
                allow_duplicate_po_number=true;
                update()
              }
              break;
            }
          }

        }

        hide_processing_modal()

      }

    })

    }

    return false

  }
  */
</script>

<script type="text/javascript">
  $(document).on("click", "[data-location-refresh]", function() {

    let row_id = $(this).parents('tr').attr('id')
    //---check the state id selected for this row
    let state_id = $(this).parents('tr').find('[name="stop_state_id"]').val();
    //--if a state id is selected than show cities belongs to this this
    if (state_id != '') {
      show_stop_locations({
        state_id: state_id
      }, row_id)
    }

  });
  $(document).on("click", "[data-add-city]", function() {
    open_child_window({
      url: '../user/masters/locations/cities/quick-add-new',
      name: 'AddCity',
      width: 500,
      height: 500
    })
  });
</script>

<script type="text/javascript">
  hide_processing_modal()

  //setInterval(hide_processing_modal, 1000)
</script>


<script type="text/javascript">
  function validate_po(value) {
    show_processing_modal()
    $.ajax({
      url: "<?php echo AJAXROOT . '/user/dispatch/loads/validate-po-action' ?>",
      type: 'POST',
      data: {
        po: value,
        exclude_id: "<?php echo $details['id'] ?>"
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
        }

        if (!data.status) {
          alert(data.message);
        }
        hide_processing_modal()
      }
    })
  }
</script>
<script type="text/javascript">
  quick_load_types().then(function(data) {

    if (data.status) {
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="${item.id}">${item.name}</option>`;
        })
        $('[name="load_type_id"]').html(options);
        select_default('[name="load_type_id"]')
      }
    }

  })
</script>

<?php

require_once APPROOT . '/views/includes/user/footer.php';

?>