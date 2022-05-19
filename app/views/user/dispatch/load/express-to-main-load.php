<?php
require_once APPROOT . '/views/includes/user/header.php';
$exdtl = $data['details'];
$load_type_id = $exdtl['load_type_id'];
// echo "<pre>";
// print_r($exdtl);
// echo "</pre>";
?>

<br><br>
<style type="text/css">
  .field-table {
    padding: 10px 4px;
  }

  .field-table i {
    cursor: pointer;
  }

  .field-table i.fa-trash {
    color: red;
    font-size: .8em;
  }

  [data-stops-section] hr {
    height: :2px;
    border: 4px solid #f2f2f2;
  }

  .stops-header {
    background: var(--theme-color-grey);
    padding: 5px;
    color: white;
    display: flex;
    justify-content: space-between;
    padding: 2px 8px;
    font-weight: normal;
    margin: 2px 5px;
  }

  [data-stop-display="hidden"]+[data-stop-row] {
    display: none;
  }

  [data-stop-display="show"]+[data-stop-row] {
    display: inherit;
  }

  .btn-dark-red {
    color: brown;
  }
  [data-address-refresh] {
    color: grey;
    font-size: .9em;
    cursor: pointer;
  }
  [data-add-address] {
    color: grey;
    font-size: .9em;
    cursor: pointer;
  }
</style>

<section class="lg-form-outer" style="display:flex;flex-direction:column;align-items:center">
  <div class="lg-form-header">Express To Main Load</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()" style="margin:0">
    <section class="action-button-box" style="justify-content: flex-end;margin: 0px;">
    </section>
    <section class="section-111" style="margin: 0;">
      <div>
        <fieldset id="shipper">

          <legend>Shipper Information</legend>
          <div class="field-section single-column" data-stop-row data-stop-category="SHIPPER" data-stop-id="<?php echo $exdtl['shipper']['id']  ?>">
            <input type="hidden" name="stop_type" value="PICK">
            <input type="hidden" name="address_id">

            <div class="field-p">
              <label>Search</label>
              <input style="width:165px;" type="text" value="" list="quick_list_addresses" name="addresses_id_search" required><i data-address-refresh class="fas fa-sync-alt" title="Refresh Addresses List"></i><i data-add-address class="fa fa-plus" title="Add Address"></i>
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
              <table>
                <thead>
                  <th>P/U #</th>
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
              <select class="w-100" name="appointment_type" data-default-select="<?php echo $exdtl['shipper']['appointment_type']  ?>">
                <option value="">- Select -</option>
                <option value="FCFS">FCFS</option>
                <option value="FIRM">FIRM</option>
              </select>
            </div>
            <div class="field-p">
              <label>Date</label>
              <input class="w-100" value="<?php echo $exdtl['shipper']['date']  ?>" type="text" name="stop_date" data-date-picker="">
            </div>
            <div class="field-p">
              <label>Time</label>

              <input data-time-picker style="width:60px" value="<?php echo $exdtl['shipper']['time_from'];  ?>" type="text" name="stop_time_from" <?php echo ($exdtl['shipper']['datetime_tbd'] == 'YES') ? 'disabled' : ''; ?>>
              <input data-time-picker style="width:60px" value="<?php echo $exdtl['shipper']['time_to']  ?>" type="text" name="stop_time_to" <?php echo ($exdtl['shipper']['datetime_tbd'] == 'YES') ? 'disabled' : ''; ?>>
              <input type="checkbox" name="stop_datetime_tbd" title="TBD" <?php echo ($exdtl['shipper']['datetime_tbd'] == 'YES') ? 'checked' : ''; ?>> TBD
            </div>

            <div class="field-p">
              <label>Special Instructions/Directions</label>
              <div>
                <textarea style="width: 100%;height:80px !important" name="special_instructions"></textarea>
              </div>
            </div>

          </div>
        </fieldset>
      </div>
      <div>
        <fieldset id="consignee">
          <legend>Consignee Information</legend>
          <div class="field-section single-column" data-stop-row data-stop-category="CONSIGNEE" data-stop-id="<?php echo $exdtl['consignee']['id']  ?>">
            <input type="hidden" name="address_id">
            <input type="hidden" name="stop_type" value="DROP">
            <div class="field-p">

              <label>Search</label>
              <input style="width:165px;" type="text" value="" list="quick_list_addresses" name="addresses_id_search" required><i data-address-refresh class="fas fa-sync-alt" title="Refresh Addresses List"></i><i data-add-address class="fa fa-plus" title="Add Address"></i>
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
              <table>
                <thead>
                  <th>D/O #</th>
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
              <select class="w-100" name="appointment_type" data-default-select="<?php echo $exdtl['consignee']['appointment_type']  ?>">
                <option value="">- Select -</option>
                <option value="FCFS">FCFS</option>
                <option value="FIRM">FIRM</option>
              </select>
            </div>
            <div class="field-p">
              <label>Date</label>
              <input class="w-100" value="<?php echo $exdtl['consignee']['date']  ?>" type="text" name="stop_date" data-date-picker="">
            </div>
            <div class="field-p">
              <label>Time</label>
              <input data-time-picker style="width:60px" value="<?php echo $exdtl['consignee']['time_from']  ?>" type="text" name="stop_time_from" <?php echo ($exdtl['consignee']['datetime_tbd'] == 'YES') ? 'disabled' : ''; ?>>
              <input data-time-picker style="width:60px" value="<?php echo $exdtl['consignee']['time_to']  ?>" type="text" name="stop_time_to" <?php echo ($exdtl['consignee']['datetime_tbd'] == 'YES') ? 'disabled' : ''; ?>>
              <input type="checkbox" name="stop_datetime_tbd" title="TBD" <?php echo ($exdtl['consignee']['datetime_tbd'] == 'YES') ? 'checked' : ''; ?>> TBD
            </div>


            <div class="field-p">
              <label>Special Instructions/Directions</label>
              <div>
                <textarea style="width: 100%;height:80px !important" name="special_instructions"></textarea>
              </div>
            </div>

          </div>
        </fieldset>
      </div>
      <div>



        <fieldset data-stops-section>
          <legend>Stops</legend>



          <?php
          foreach ($exdtl['stops'] as $stop) {
          ?>



            <div data-stop-item>
              <h1 class="stops-header " data-stop-display="show">
                <p>Stop -<span data-stop-type> <?php echo $stop['type'] ?></span>
                <p data-search-name style="margin-left:-20px;"></p>
                </p>
                <p>
                  <i data-show-angle class="fa fa-angle-down"></i>
                </p>
              </h1>
              <div class="field-section single-column" data-stop-row data-stop-category="STOP" data-stop-id="<?php echo $stop['id']  ?>">
                <div class="field-p">
                  <label>Stop Type</label>
                  <select class="w-100" name="stop_type" data-default-select="<?php echo $stop['type'] ?>" >
                    <option value="">- Select - </option>
                    <option value="PICK">PICK</option>
                    <option value="DROP">DROP</option>
                  </select>
                </div>

                <input type="hidden" name="address_id">

                <div class="field-p">
                  <label>Search</label>
                  <input style="width:165px;" type="text" value="" list="quick_list_addresses" name="addresses_id_search" ><i data-address-refresh class="fas fa-sync-alt" title="Refresh Addresses List"></i><i data-add-address class="fa fa-plus" title="Add Address"></i>
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
                  <table>
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
                  <input class="w-100" value="<?php echo $stop['date']  ?>" type="text" name="stop_date" data-date-picker="">
                </div>
                <div class="field-p">
                  <label>Time</label>
                  <input data-time-picker style="width:60px" value="<?php echo $stop['time_from']  ?>" type="text" name="stop_time_from" <?php echo ($stop['datetime_tbd'] == 'YES') ? 'disabled' : ''; ?>>
                  <input data-time-picker style="width:60px" value="<?php echo $stop['time_to']  ?>" type="text" name="stop_time_to" <?php echo ($stop['datetime_tbd'] == 'YES') ? 'disabled' : ''; ?>>
                  <input type="checkbox" name="stop_datetime_tbd" title="TBD" <?php echo ($stop['datetime_tbd'] == 'YES') ? 'checked' : ''; ?>> TBD
                </div>
                <div class="field-p">
                  <label>Special Instructions/Directions</label>
                  <div>
                    <textarea style="width: 100%;height:80px !important" name="special_instructions"></textarea>
                  </div>
                </div>
              </div>
            </div>

          <?php
          }
          ?>
        </fieldset>
      </div>
    </section>

    <section class="section-111">
      <div>
        <fieldset>
          <legend>Load Information</legend>

          <div style="display:flex;">
            <div class="field-section single-column" style="width:50%">

              <div class="field-p">

                <label>Customer</label>

                <input type="hidden" name="customer_id" value="<?php echo $exdtl['customer_id'] ?>" required><br>

                <input type="text" value="<?php echo $exdtl['customer_code'] . ' - ' . $exdtl['customer_name'] ?>" list="quick_list_customers" name="customer_id_search" required>

              </div>

              <div class="field-p">
                <label>Rate</label>
                <input type="text" name="rate" value="<?php echo $exdtl['rate']; ?>">
              </div>

              <div class="field-p">
                <label>PO Number</label>
                <input type="text" name="po_number" value="<?php echo $exdtl['po_number']; ?>">
              </div>
              <div class="field-p">
                <label>Commodity Type</label>
                <select name="commodity_type_id"></select>
              </div>
              <div class="field-p">
                <label>Bill of Lading</label>
                <input type="text" name="bill_of_lading">
              </div>



            </div>
            <div class="field-section single-column" style="width:50%">



              <div class="field-p" data-trailer-option>
                <?php if ($load_type_id == 'LOT01' || $load_type_id == 'LOT03') {
                ?>
                  <label>Trailer Type</label>
                  <select name="trailer_type" data-default-select="<?php echo $exdtl['trailer_type']  ?>" required>
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
                <?php if (($load_type_id == 'LOT01' || $load_type_id == 'LOT03') && $exdtl['trailer_type'] == 'REEFER') {
                ?>
                  <label>Reefer Temperature ( in <span>&#8457;</span> )</label>
                  <div>
                    <input type="text" class="w-150" name="reefer_temperature" value="<?php echo $exdtl['reefer_temperature']; ?>" pattern="[0-9.-]{1,}">
                    <select class="w-150" name="reefer_mode" data-default-select="<?php echo $exdtl['reefer_mode']; ?>">
                      <option value=""> - - Select - - </option>
                      <option value="START/STOP">START/STOP</option>
                      <option value="CONTINUOUS">CONTINUOUS</option>
                    </select><br>
                    <input type="checkbox" name="temperature_as_per_shipper" <?php echo ($exdtl['temperature_as_per_shipper'] == 'YES') ? 'checked' : '' ?>> As Per Shipper
                  </div>
                <?php
                } ?>

              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </section>

    <script type="text/javascript">
$(document).on("click", "[data-address-refresh]", function() {
  show_processing_modal()
  show_quick_list_addresses();
  hide_processing_modal()
  alert("Address list is refreshed");
});

$(document).on("click", "[data-add-address]", function() {
    open_child_window({
      url: '../user/masters/locations/location-addresses/quick-add-new',
      name: 'AddAddress',
      width: 1000,
      height: 800,
    })
  });
</script>

    <script type="text/javascript">
      // $(document.body).on('change', '[name="customer_id_search"]' ,function(){
      $(document.body).on('click', '[data-stop-display]', function() {
        //  $('[data-stop-display]').siblings('.field-section').slideUp('fast')
        //$('[data-stop-display]').find('i').removeClass('fa-angle-up')
        //$('[data-stop-display]').find('i').addClass('fa-angle-down')
        if ($(this).attr('data-stop-display') == 'show') {
          // $('[data-stop-display]').not(this).siblings('.field-section').slideUp('fast')
          $(this).attr('data-stop-display', 'hidden')
          $(this).siblings('.field-section').slideUp('fast')
          $(this).find('i').removeClass('fa-angle-up')
          $(this).find('i').addClass('fa-angle-down')
        } else if ($(this).attr('data-stop-display') == 'hidden') {
          $(this).attr('data-stop-display', 'show')
          $('[data-stop-display]').not(this).siblings('.field-section').slideUp('fast')
          $('[data-stop-display]').not(this).attr('data-stop-display', 'hidden')
          $('[data-stop-display]').not(this).find('i').removeClass('fa-angle-up')
          $('[data-stop-display]').not(this).find('i').addClass('fa-angle-down')
          $(this).siblings('.field-section').slideDown('fast')
          $(this).find('i').removeClass('fa-angle-down')
          $(this).find('i').addClass('fa-angle-up')
        }
      })
    </script>
    <script type="text/javascript">
      $(document.body).on('click', '[data-action="add-pick-up-row"]', function() {
        /*-----------appned $this table body with fresh row*/
        $(this).parents('table').children('tbody').append(`<tr data-quantity-details-row>
          <td style="min-width: 50px;max-width: 120px;"><input name="pd_number" type="text" style="width: 100%;"></td>
          <td style="min-width: 50px;max-width: 80px;"><input name="case_count" type="text" style="width: 100%;"></td>
          <td style="min-width: 50px;max-width: 80px;"><input name="pallet_count" type="text" style="width: 100%;"></td>
          <td style="min-width: 50px;max-width: 120px;"><input name="reference_number" type="text" style="width: 100%;"></td>
          <td style="width: 20px;"><button type="button" class="btn-dark-red" data-action="delete-pickup-row"><i class="fa fa-trash"></i></button></td>
          </tr>`)
      })
    </script>

    <script type="text/javascript">
      $(document.body).on('click', '[data-action="delete-pickup-row"]', function() {
        $(this).parents('tr').remove()
      })
    </script>


    <script type="text/javascript">
      $(document.body).on('click', '[data-add-product-ref-code]', function() {
        $(this).parent().siblings('[data-product-ref-section]').append(`<div style="display:flex;align-items:center"><input width="w-100"  type="text" name="product_code"> <i style="color:red;font-size:.8em" class="fa fa-trash" data-delete-product-ref-code></i></div>`)
      })
      $(document.body).on('click', '[data-delete-product-ref-code]', function() {
        $(this).parent().hide()
      })
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
            <br>
            <input type="checkbox" name="temperature_as_per_shipper"> As Per Shipper
            </div>`);
        } else {

          $('[data-temperature-option]').hide();

        }

      });

      //--------/ hide/show temperature to maintain option based on the trailer type selection
    </script>

    <script type="text/javascript">
      ///-----------Add new stop

      var $stops_table = $('#stops_table');

      function add_stop() {
        //--------before appending new stop, close already opened stops
        $('[data-stop-display]').attr('data-stop-display', 'hidden')
        $('[data-stop-display]').siblings('.field-section').slideUp('fast')
        $('[data-stop-display]').find('i').removeClass('fa-angle-up')
        $('[data-stop-display]').find('i').addClass('fa-angle-down')
        //--------/before appending new stop, close already opened stops

        counter = ($('[data-stop-row]').length) - 1
        var $stop_row = `<div data-stop-item>
        <h1 class="stops-header" data-stop-display="show"><p>Stop-
        <p data-search-name style="margin-left:-20px;"></p>
        </p><p><i class="fas fa-caret-square-up fa-lg up"></i>&nbsp;&nbsp;<i class="fas fa-caret-square-down fa-lg down"></i>
        &nbsp;&nbsp;
        <button type="button" class="btn-dark-red" data-remove-stop-button=""><i class="fa fa-trash"></i></button>&nbsp;&nbsp;<i data-show-angle class="fa fa-angle-down"></i></p></h1>
        <div class="field-section single-column" data-stop-row data-stop-category="STOP">
        <div class="field-p">
        <label>Stop Type</label>
        <select class="w-100" name="stop_type" required>
        <option value="">- Select -  </option>
        <option value="PICK">PICK</option>
        <option value="DROP">DROP</option>
        </select>
        </div>

        <input type="hidden" name="address_id">

        <div class="field-p">
        <label>Search</label>
        <input style="width:165px;" type="text" value="" list="quick_list_addresses" name="addresses_id_search" required><i data-address-refresh class="fas fa-sync-alt" title="Refresh Addresses List"></i><i data-add-address class="fa fa-plus" title="Add Address"></i>
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
        <table>
        <thead><th>#</th><th>Case</th><th>Pallet</th><th>Reference No.</th></thead>
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
        </tr></tfoot>
        </tbody>
        </table>
        </div>
        <div class="field-p">
        <label>Appointment Type</label>
        <select class="w-100" name="appointment_type"  >
        <option value="">- Select -</option>
        <option value="FCFS">FCFS</option>
        <option value="FIRM">FIRM</option>
        </select>
        </div>          
        <div class="field-p">
        <label>Date</label>
        <input class="w-100"  type="text" name="stop_date" data-date-picker="" >
        </div>
        <div class="field-p">
        <label>Time</label>
        <input data-time-picker style="width:60px"  type="text" name="stop_time_from">
        <input data-time-picker style="width:60px"  type="text" name="stop_time_to">
        <input  type="checkbox" name="stop_datetime_tbd" title="TBD"> TBD          
        </div>
        <div class="field-p">
        <label>Special Instructions/Directions</label>
        <div>
        <textarea style="width: 100%;height:80px !important" name="special_instructions"></textarea>
        </div>
        </div>                            
        </div>
        </div>
        `;
        $('[data-stops-section]').append($stop_row);
        $("[data-date-picker]").datepicker();
        $('[data-stop-item]').find('.up').css('visibility', 'visible')
        $('[data-stop-item]').find('.down').css('visibility', 'visible')
        $('[data-stop-item]').first().find('.up').css('visibility', 'hidden')
        $('[data-stop-item]').last().find('.down').css('visibility', 'hidden')
        //show_stop_locations({},'stop_row'+counter)
      }
      ///-----------//Add new stop
      ///-----------remove stop

      $(document.body).on('click', '[data-remove-stop-button]', function() {
        if (confirm('Are you sure you want to delete this stop ?')) {
          $(this).parents('[data-stop-item]').remove();
          $('[data-stop-item]').find('.up').css('visibility', 'visible')
          $('[data-stop-item]').find('.down').css('visibility', 'visible')
          $('[data-stop-item]').first().find('.up').css('visibility', 'hidden')
          $('[data-stop-item]').last().find('.down').css('visibility', 'hidden')
        }
      });
      ///-----------/revmove stop
    </script>


    <script>
      $(document).ready(function() {
        $('[data-stop-item]').first().find('.up').css('visibility', 'hidden')
        $('[data-stop-item]').last().find('.down').css('visibility', 'hidden')
        $('[data-stop-display]').attr('data-stop-display', 'hidden')
        $('[data-stop-display]').siblings('.field-section').slideUp('fast')
        $('[data-stop-display]').find('i').removeClass('fa-angle-up')
        $('[data-stop-display]').find('i').addClass('fa-angle-down')
      });
    </script>

    <script type="text/javascript">
      $(document.body).on('click', '.down', function() {
        var quantity_array = [];
        var stop_datetime_tbd;
        var div = $(this).parents('[data-stop-item]').html();
        $(this).parents('[data-stop-item]').next().after(`<div data-stop-item id="777">${div}</div>`);
        var this_div = $(this).parents('[data-stop-item]');
        var stop_type = this_div.find('[name="stop_type"]').val();
        var addresses_id_search = this_div.find('[name="addresses_id_search"]').val();
        var company = this_div.find('[name="company"]').val();
        var address_line = this_div.find('[name="address_line"]').val();
        var state = this_div.find('[name="state"]').val();
        var city = this_div.find('[name="city"]').val();
        var zipcode = this_div.find('[name="zipcode"]').val();
        var phone_number = this_div.find('[name="phone_number"]').val();
        var fax_number = this_div.find('[name="fax_number"]').val();
        var email = this_div.find('[name="email"]').val();
        var appointment_type = this_div.find('[name="appointment_type"]').val();
        var stop_date = this_div.find('[name="stop_date"]').val();
        var stop_time_from = this_div.find('[name="stop_time_from"]').val();
        var stop_time_to = this_div.find('[name="stop_time_to"]').val();
        if (this_div.find("[name=stop_datetime_tbd]").prop("checked") == true) {
          stop_datetime_tbd = 'YES';
        } else {
          stop_datetime_tbd = 'NO';
        }
        var special_instructions = this_div.find('[name="special_instructions"]').val();
        var quantity = this_div.find('[data-quantity-details-row]')
        quantity.each(function(index, item) {
          quantity_array.push({
            pd_number: $(this).find('[name="pd_number"]').val(),
            case_count: $(this).find('[name="case_count"]').val(),
            pallet_count: $(this).find('[name="pallet_count"]').val(),
            reference_number: $(this).find('[name="reference_number"]').val(),
          });
        })
        $(this).parents('[data-stop-item]').remove();
        $('#777').find(`[name="stop_type"] option[value="${stop_type}"]`).prop('selected', true);
        $('#777').find(`[name="addresses_id_search"]`).val(addresses_id_search);
        $('#777').find(`[name="company"]`).val(company);
        $('#777').find(`[name="address_line"]`).val(address_line);
        $('#777').find(`[name="state"]`).val(state);
        $('#777').find(`[name="city"]`).val(city);
        $('#777').find(`[name="zipcode"]`).val(zipcode);
        $('#777').find(`[name="phone_number"]`).val(phone_number);
        $('#777').find(`[name="fax_number"]`).val(fax_number);
        $('#777').find(`[name="email"]`).val(email);
        $('#777').find(`[name="appointment_type"] option[value="${appointment_type}"]`).prop('selected', true);
        $('#777').find(`[name="stop_date"]`).val(stop_date);
        $('#777').find(`[name="stop_time_from"]`).val(stop_time_from);
        $('#777').find(`[name="stop_time_to"]`).val(stop_time_to);
        if (stop_datetime_tbd == 'YES') {
          $('#777').find(`[name="stop_datetime_tbd"]`).prop('checked', true);
        } else {
          $('#777').find(`[name="stop_datetime_tbd"]`).prop('checked', false);
        }
        $('#777').find(`[name="special_instructions"]`).val(special_instructions);
        var quantity2 = $('#777').find('[data-quantity-details-row]');
        var counter = 0;
        quantity2.each(function(index, item) {
          $(this).find('[name="pd_number"]').val(quantity_array[counter].pd_number)
          $(this).find('[name="case_count"]').val(quantity_array[counter].case_count)
          $(this).find('[name="pallet_count"]').val(quantity_array[counter].pallet_count)
          $(this).find('[name="reference_number"]').val(quantity_array[counter].reference_number)
          counter++;
        })


        $("[data-date-picker]").removeAttr('id') //
        $("[data-date-picker]").removeClass('hasDatepicker') //code to reset calender and make it work in new created shuffled row
        $("[data-date-picker]").datepicker(); //
        $('[data-stop-item]').find('.up').css('visibility', 'visible')
        $('[data-stop-item]').find('.down').css('visibility', 'visible')
        $('[data-stop-item]').first().find('.up').css('visibility', 'hidden')
        $('[data-stop-item]').last().find('.down').css('visibility', 'hidden')
        $('#777').removeAttr('id');
      })
    </script>
    <script type="text/javascript">
      $(document.body).on('click', '.up', function() {
        var quantity_array = [];
        var stop_datetime_tbd;
        var div = $(this).parents('[data-stop-item]').html();
        $(this).parents('[data-stop-item]').prev().before(`<div data-stop-item id="777">${div}</div>`);
        var this_div = $(this).parents('[data-stop-item]');
        var stop_type = this_div.find('[name="stop_type"]').val();
        var addresses_id_search = this_div.find('[name="addresses_id_search"]').val();
        var company = this_div.find('[name="company"]').val();
        var address_line = this_div.find('[name="address_line"]').val();
        var state = this_div.find('[name="state"]').val();
        var city = this_div.find('[name="city"]').val();
        var zipcode = this_div.find('[name="zipcode"]').val();
        var phone_number = this_div.find('[name="phone_number"]').val();
        var fax_number = this_div.find('[name="fax_number"]').val();
        var email = this_div.find('[name="email"]').val();
        var appointment_type = this_div.find('[name="appointment_type"]').val();
        var stop_date = this_div.find('[name="stop_date"]').val();
        var stop_time_from = this_div.find('[name="stop_time_from"]').val();
        var stop_time_to = this_div.find('[name="stop_time_to"]').val();
        if (this_div.find("[name=stop_datetime_tbd]").prop("checked") == true) {
          stop_datetime_tbd = 'YES';
        } else {
          stop_datetime_tbd = 'NO';
        }
        var special_instructions = this_div.find('[name="special_instructions"]').val();
        var quantity = this_div.find('[data-quantity-details-row]')
        quantity.each(function(index, item) {
          quantity_array.push({
            pd_number: $(this).find('[name="pd_number"]').val(),
            case_count: $(this).find('[name="case_count"]').val(),
            pallet_count: $(this).find('[name="pallet_count"]').val(),
            reference_number: $(this).find('[name="reference_number"]').val(),
          });
        })
        $(this).parents('[data-stop-item]').remove();
        $('#777').find(`[name="stop_type"] option[value="${stop_type}"]`).prop('selected', true);
        $('#777').find(`[name="addresses_id_search"]`).val(addresses_id_search);
        $('#777').find(`[name="company"]`).val(company);
        $('#777').find(`[name="address_line"]`).val(address_line);
        $('#777').find(`[name="state"]`).val(state);
        $('#777').find(`[name="city"]`).val(city);
        $('#777').find(`[name="zipcode"]`).val(zipcode);
        $('#777').find(`[name="phone_number"]`).val(phone_number);
        $('#777').find(`[name="fax_number"]`).val(fax_number);
        $('#777').find(`[name="email"]`).val(email);
        $('#777').find(`[name="appointment_type"] option[value="${appointment_type}"]`).prop('selected', true);
        $('#777').find(`[name="stop_date"]`).val(stop_date);
        $('#777').find(`[name="stop_time_from"]`).val(stop_time_from);
        $('#777').find(`[name="stop_time_to"]`).val(stop_time_to);
        if (stop_datetime_tbd == 'YES') {
          $('#777').find(`[name="stop_datetime_tbd"]`).prop('checked', true);
        } else {
          $('#777').find(`[name="stop_datetime_tbd"]`).prop('checked', false);
        }
        $('#777').find(`[name="special_instructions"]`).val(special_instructions);
        var quantity2 = $('#777').find('[data-quantity-details-row]');
        var counter = 0;
        quantity2.each(function(index, item) {
          $(this).find('[name="pd_number"]').val(quantity_array[counter].pd_number)
          $(this).find('[name="case_count"]').val(quantity_array[counter].case_count)
          $(this).find('[name="pallet_count"]').val(quantity_array[counter].pallet_count)
          $(this).find('[name="reference_number"]').val(quantity_array[counter].reference_number)
          counter++;
        })


        $("[data-date-picker]").removeAttr('id') //
        $("[data-date-picker]").removeClass('hasDatepicker') //code to reset calender and make it work in new created shuffled row
        $("[data-date-picker]").datepicker(); //
        $('[data-stop-item]').find('.up').css('visibility', 'visible')
        $('[data-stop-item]').find('.down').css('visibility', 'visible')
        $('[data-stop-item]').first().find('.up').css('visibility', 'hidden')
        $('[data-stop-item]').last().find('.down').css('visibility', 'hidden')
        $('#777').removeAttr('id');
      })
    </script>

    <section class="action-button-box">
      <button type="submit" class="btn_green">SAVE</button>
    </section>
  </form>
</section>

<datalist id="quick_list_addresses"></datalist>
<script type="text/javascript">
  $(document.body).on('change', '[name="addresses_id_search"]', function() {
    address_id_selected = $(`[data-addresses-filter-rows="${$(this).val()}"]`).data('value');
    if (address_id_selected != undefined) {
      row_parent = $(this).parents('[data-stop-row]')
      row_parent.find('[name="address_id"]').val(address_id_selected)
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
  var allow_duplicate_po_number = false;

  function add_new() {
    show_processing_modal()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    if (isValidForm) {

      var arr = $('#MyForm').serializeArray();
      var $data_stop_rows = $("[data-stop-row]");
      data_stop_array = []

      $data_stop_rows.each(function(index) {
        var $data_stop_row = $(this);
        prod_code_array = []
        $data_stop_row.find('[name="product_code"]').each(function(index) {
          prod_code_array.push($(this).val())
        })

        var quantity_details = [];
        //------iterate through quantity details rows of $this stop
        ($(this).find('[data-quantity-details-row]')).each(function(ind) {

          pd_row = ($(this));
          quantity_details.push({
            pd_number: pd_row.find('[name="pd_number"]').val(),
            case_count: pd_row.find('[name="case_count"]').val(),
            pallet_count: pd_row.find('[name="pallet_count"]').val(),
            reference_number: pd_row.find('[name="reference_number"]').val(),
          });
        })
        data_stop_array.push({
          id: $data_stop_row.data('stop-id'),
          category: $data_stop_row.data('stop-category'),
          type: $data_stop_row.find('[name="stop_type"]').val(),
          address_id: $data_stop_row.find('[name="address_id"]').val(),
          appointment_type: $data_stop_row.find('[name="appointment_type"]').val(),
          date: $data_stop_row.find('[name="stop_date"]').val(),
          datetime_tbd: ($(this).find("[name=stop_datetime_tbd]").prop("checked") == true) ? 'YES' : 'NO',
          time_from: $data_stop_row.find('[name="stop_time_from"]').val(),
          time_to: $data_stop_row.find('[name="stop_time_to"]').val(),
          special_instructions: $data_stop_row.find('[name="special_instructions"]').val(),
          quantity_details: quantity_details
        })
      })
      var load_type_id = '<?php echo $load_type_id; ?>'
      var temperature_as_per_shipper = 'NO';
      var reefer_mode = '';
      var reefer_temperature = '';
      var trailer_type = ''

      if (load_type_id == 'LOT01' || load_type_id == 'LOT03') {
        trailer_type = $('[name="trailer_type"]').val()
      }

      if (trailer_type == 'REEFER') {
        reefer_temperature = $('[name="reefer_temperature"]').val()
        reefer_mode = $('[name="reefer_mode"]').val()
        temperature_as_per_shipper = ($('[name="temperature_as_per_shipper"]').prop("checked") == true) ? 'YES' : 'NO';
      }

      var obj = {
        load_eid: '<?php echo $exdtl['eid'] ?>',
        customer_id: $('[name="customer_id"]').val(),
        po_number: $('[name="po_number"]').val(),
        rate: $('[name="rate"]').val(),
        commodity_type_id: $('[name="commodity_type_id"]').val(),
        bill_of_lading: $('[name="bill_of_lading"]').val(),
        trailer_type: $('[name="trailer_type"]').val(),
        reefer_temperature: reefer_temperature,
        reefer_mode: reefer_mode,
        temperature_as_per_shipper: temperature_as_per_shipper,
        stops: data_stop_array,
        allow_duplicate_po_number: allow_duplicate_po_number
      }
      $.ajax({
        url: 'user/dispatch/loads/express-to-main-load-action',
        type: 'POST',
        data: obj,
        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          if (data.status) {
            location.href = 'user/dispatch/loads/details?eid=' + data.response.new_eid;
            alert(data.message);
          } else {
            if (data.message == "CONFIRM") {
              switch (data.confirm) {
                case 'ALLOW DUPLICATE PO NUMBER':
                  let conf = confirm(data.confirm_message);
                  if (conf == true) {
                    allow_duplicate_po_number = true;
                    add_new()
                  }
                  break;
              }
            } else {
              alert(data.message);
            }

          }
          hide_processing_modal()
        }

      })
    }

    return false

  }
</script>



<datalist id="quick_list_customers"></datalist>

<script type="text/javascript">
  $(document.body).on('change', '[name="customer_id_search"]', function() {

    customer_id_selected = $(`[data-customer-filter-rows="${$(this).val()}"]`).data('value');

    if (customer_id_selected != undefined) {

      $('[name="customer_id"]').val(customer_id_selected)

    }

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
  function show_commodity_types() {
    get_commodity_types().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[name="commodity_type_id"]').html(options);
        }
      }
    }).catch(function(err) {
      console.log(err)
      // Run this when promise was rejected via reject()
    })
  }
  show_commodity_types()
</script>


<script type="text/javascript">
  function show_addess_states() {
    get_states().then(function(data) {
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
  show_addess_states()
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
</script>

<script type="text/javascript">
  function show_companies_options() {
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
          $('[name="company_id"]').html(options);
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_companies_options()
</script>
<script type="text/javascript">
  //-------- add/remove required attribute based on TBD check box 

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

  //--------/ add/remove required attribute based on TBD check box 
</script>

<script type="text/javascript">
  //-------- add/remove required attribute based on TBD check box 

  $(document.body).on('change', '[name="temperature_as_per_shipper"]', function() {
    if ($(this).prop("checked") == true) {
      $(this).siblings('[name="reefer_temperature"]').removeAttr('required')
      $(this).siblings('[name="reefer_temperature"]').prop('disabled', true)
      $(this).siblings('[name="reefer_temperature"]').val('')
      $(this).siblings('[name="reefer_mode"]').children('option[value=""]').prop(`selected`, true);
      $(this).siblings('[name="reefer_mode"]').removeAttr('required')
      $(this).siblings('[name="reefer_mode"]').prop('disabled', true)
    } else if ($(this).prop("checked") == false) {
      $(this).siblings('[name="reefer_temperature"]').attr('required', true)
      $(this).siblings('[name="reefer_temperature"]').prop('disabled', false)
      $(this).siblings('[name="reefer_mode"]').attr('required', true)
      $(this).siblings('[name="reefer_mode"]').prop('disabled', false)
    }

  });

  //--------/ add/remove required attribute based on TBD check box 

  $(document).on('change', '[name="stop_type"]', function() {
    $(this).parents('[data-stop-row]').siblings('h1').find('[data-stop-type]').html($(this).val())
  })
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>