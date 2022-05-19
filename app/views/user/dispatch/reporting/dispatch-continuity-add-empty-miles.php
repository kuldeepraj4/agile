<?php
require_once APPROOT . '/views/includes/user/header-quick-view.php';
if ($_GET['driver-b-id'] != "") {
  $team = "TEAM";
} else {
  $team = "SOLO";
}

if ($_GET['driver-a-id'] != "") {
  $driver_a_id = $_GET['driver-a-id'];
  $driver_a_display_name = $_GET['driver_a_display_name'];
} else {
  $driver_a_id = "";
  $driver_a_display_name = "";
}
if ($_GET['truck-id'] != "") {
  $truck_id = $_GET['truck-id'];
  $truck_code = $_GET['truck_code'];
} else {
  $truck_id = "";
  $truck_code = "";
}
if ($_GET['trailer-id'] != "") {
  $trailer_id = $_GET['trailer-id'];
  $trailer_code = $_GET['trailer_code'];
} else {
  $trailer_id = "";
  $trailer_code = "";
}
?>
<style type="text/css">
  .add-load-table {
    border: 1px solid red;
    border-collapse: collapse;
  }

  .add-load-table td,
  .add-load-table th {
    border: 1px solid grey;
  }
</style>
<section class="lg-form-outer">
  <div class="lg-form-header">Add Empty Miles</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-1" style="max-width: 1000px;">
      <div>
        <fieldset>
          <legend>Assets Information</legend>
          <div style="display:flex;">
            <div class="field-section single-column" style="width:50%">
              <div class="field-p">
                <label>Team/ Solo</label>
                <select name="is_team_driver" onchange="hide_show_driver_b_option()" data-default-select="<?php echo $team; ?>" required>
                  <option value=""> - - Select - -</option>
                  <option value="SOLO">SOLO</option>
                  <option value="TEAM">TEAM</option>
                </select>
              </div>
              <div class="field-p">
                <label>Driver A</label>
                <input style="width:70px" type="text" list="quick_list_drivers" value="<?php echo $driver_a_display_name; ?>" data-selected-driver-id="<?php echo $driver_a_id; ?>" data-search-driver name="driver_id" required>
              </div>
              <div class="field-p" data-driver-b>
                <?php
                if ($team == "TEAM") {
                  if ($_GET['driver-b-id'] != "" && $_GET['driver-b-id'] !== "undefined") {
                    $driver_b_id = $_GET['driver-b-id'];
                    $driver_b_display_name = $_GET['driver_b_display_name'];
                  } else {
                    $driver_b_id = "";
                    $driver_b_display_name = "";
                  }
                ?>
                  <label>Driver B</label>
                  <input style="width:70px" type="text" list="quick_list_drivers" data-selected-driver-id="<?php echo $driver_b_id; ?>" value="<?php echo $driver_b_display_name; ?>" data-search-driver name="driver_b_id">
                <?php
                }
                ?>
              </div>
              <div class="field-p">
                <label>Truck</label>
                <input style="width:70px" type="text" list="quick_list_trucks" value="<?php echo $truck_code; ?>" data-selected-truck-id="<?php echo $truck_id; ?>" name="truck_id" required>
              </div>
              <div class="field-p">
                <label>Trailer</label>
                <input style="width:70px" type="text" list="quick_list_trailers" value="<?php echo $trailer_code; ?>" data-selected-trailer-id="<?php echo $trailer_id; ?>" name="trailer_id" required>
              </div>
            </div>
            <div class="field-section single-column" style="width:50%"></div>
          </div>
        </fieldset>
      </div>
    </section>
    <section class="section-1" style="width:1000px;">
      <div>
        <fieldset>
          <legend>Origin and Destination Details</legend>
          <div style="display: flex;flex-direction:row;">
            <div class="field-section single-column" style="width:50%">
              <div class="field-p">
                <label>Origin </label>
                <input type="text" value="" list="quick_list_addresses" data-selected-address-id="" data-filter="addresses_id_search" name="origin_address_id" required>
              </div>
              <div class="field-p">
                <label>Origin Date-Time</label>
                <input type="text" placeholder="date" name="origin_date" data-date-picker style="width:100px"><input type="text" placeholder="time" name="origin_time" data-time-picker style="width:60px">
              </div>
            </div>
            <div class="field-section single-column" style="width:50%">
              <div class="field-p">
                <label>Destination </label>
                <input type="text" value="" list="quick_list_addresses" data-selected-address-id="" data-filter="addresses_id_search" name="destination_address_id" required>
              </div>
              <div class="field-p">
                <label>Destination Date-Time</label>
                <input type="text" name="destination_date" placeholder="date" data-date-picker style="width:100px"><input type="text" placeholder="time" name="destination_time" data-time-picker style="width:60px">
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </section>
    <section class="lg-form-action-button-box">
      <button class="btn_green">SAVE</button>
    </section>
  </form>
</section>
<script type="text/javascript">
  function save() {
    show_processing_modal()
    obj = {};
    driver_b_id = (($('[name="driver_b_id"]').length) == 1) ? $('[name="driver_b_id"]').data('selected-driver-id') : ''
    is_team_driver = $('[name="is_team_driver"]').val()
    var obj = {
      truck_id: $('[name="truck_id"]').data('selected-truck-id'),
      trailer_id: $('[name="trailer_id"]').data('selected-trailer-id'),
      origin_address_id: $('[name="origin_address_id"]').data('selected-address-id'),
      origin_date: $('[name="origin_date"]').val(),
      origin_time: $('[name="origin_time"]').val(),
      destination_address_id: $('[name="destination_address_id"]').data('selected-address-id'),
      destination_date: $('[name="destination_date"]').val(),
      destination_time: $('[name="destination_time"]').val(),
      is_team_driver: is_team_driver,
      driver_id: $('[name="driver_id"]').data('selected-driver-id'),
      driver_b_id: driver_b_id,
    }
    $.ajax({
      url: '../user/dispatch/reporting/dispatch-continuity/add-empty-miles-action',
      type: 'POST',
      data: obj,
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
        }
        alert(data.message)
        if (data.status) {
          window.opener.show_list()
          window.close();
        }
        hide_processing_modal()
      }
    })

  }
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
            driver_id: driver_id_selected
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
            truck_id: truck_id_selected
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
    status_ids: 'ACTIVE',
    'body_type': '<?php echo ($details['trailer_type'] == "VAN/REEFER") ? "" : $details['trailer_type'] ?>'
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
            trailer_id: trailer_id_selected
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
  $(document.body).on('change', '[data-filter="addresses_id_search"]', function() {
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
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>