<?php
require_once APPROOT . '/views/includes/user/header-quick-view.php';
$details = $data['details'];
if ($details['trailer_type'] == "REEFER") {
  $filter_trailer = "REEFER";
} elseif ($details['trailer_type'] == "VAN") {
  $filter_trailer = "VAN";
} else {
  $filter_trailer = "";
}
?>
<br><br><br>
<br>
<section class="lg-form-outer">
  <div class="lg-form-header">Update Allocation Information of Load <?php echo $details['id']; ?></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-111" style="max-width: 700px">
      <input type="hidden" name="update_eid" value="<?php echo $details['eid']; ?>">
      <div>
        <fieldset>
          <legend>Operation Info</legend>
          <div style="display:flex;">
            <div class="field-section single-column" style="width:100%">
              <div class="field-p" data-status>
                <label>Status</label>
                <select data-default-select="<?php echo $details['status_id'] ?>" name="status_id" onchange="show_reason_of_cancellation(this.value)">
                  <option> - - Select - - </option>
                  <option value="NEW">New</option>
                  <option value="ALLOCATED">Allocated</option>
                  <option value="CANCELLED">Cancelled</option>
                  <option value="BOUNCED">Bounced</option>
                  <option value="TONU">TONU</option>
                </select>
              </div>
              <div class="field-p">
                <label>Truck</label>
                <input style="width:70px" type="text" list="quick_list_trucks" value="<?php echo $details['truck_code'] ?>" data-selected-truck-id="<?php echo $details['truck_id'] ?>" name="truck_id">
              </div>
              <?php
              if (($details['load_type'] == 'LOT01' || $details['load_type'] == 'LOT03')) {
              ?>
                <div class="field-p">
                  <label>Trailer</label>
                  <input style="width:70px" type="text" list="quick_list_trailers" value="<?php echo $details['trailer_code'] ?>" data-selected-trailer-id="<?php echo $details['trailer_id'] ?>" name="trailer_id">
                </div>
              <?php
              }
              ?>
              <div class="field-p">
                <label>Team/ Solo</label>
                <select name="is_team_driver" onchange="hide_show_driver_b_option()" data-default-select="<?php echo $details['is_team_driver'] ?>">
                  <option value="SOLO">SOLO</option>
                  <option value="TEAM">TEAM</option>
                </select>
              </div>
              <div class="field-p">
                <label>Driver A</label>
                <input style="width:70px" type="text" list="quick_list_drivers" value="<?php echo $details['driver_display_name'] ?>" data-selected-driver-id="<?php echo $details['driver_id'] ?>" data-search-driver name="driver_id">
              </div>
              <div class="field-p" data-driver-b>
                <?php
                if ($details['is_team_driver'] == "TEAM") {
                  if ($details['driver_b_id'] != '') {
                    $driver_b_fn = $details['driver_b_display_name'];
                  } else {
                    $driver_b_fn = '';
                  }
                ?>
                  <label>Driver B</label>
                  <input style="width:70px" type="text" list="quick_list_drivers" data-selected-driver-id="<?php echo $details['driver_b_id'] ?>" value="<?php echo $driver_b_fn; ?>" data-search-driver name="driver_b_id">
                <?php
                }
                ?>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </section>

    <section class="action-button-box">
      <button type="submit" id="submit" class="btn_green">SAVE</button>
    </section>
  </form>
</section>

<script type="text/javascript">
  function save() {
    submit_to_wait_btn('#submit', 'loading')
    truck_id = $('[name="truck_id"]').data('selected-truck-id');
    trailer_id = $('[name="trailer_id"]').data('selected-trailer-id');
    driver_id = $('[name="driver_id"]').data('selected-driver-id');
    driver_b_id = (($('[name="driver_b_id"]').length) == 1) ? $('[name="driver_b_id"]').data('selected-driver-id') : ''
    if (truck_id == 'undefined') {
      alert("Please Provide Correct Truck Id")
      wait_to_submit_btn('#submit', 'SAVE')
      $('[data-selected-truck-id]').focus()
      return false;
    }
    if (trailer_id == 'undefined') {
      alert("Please Provide Correct Trailer Id")
      wait_to_submit_btn('#submit', 'SAVE')
      $('[data-selected-trailer-id]').focus()
      return false;
    }
    if (driver_id == 'undefined') {
      alert("Please Provide Correct Driver A Id")
      wait_to_submit_btn('#submit', 'SAVE')
      $('[name="driver_id"]').focus()
      return false;
    }
    if (driver_b_id == 'undefined') {
      alert("Please Provide Correct Driver B Id")
      wait_to_submit_btn('#submit', 'SAVE')
      $('[name="driver_b_id"]').focus()
      return false;
    }
    //$('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    if (isValidForm) {
      //driver_b_id = (($('[name="driver_b_id"]').length) == 1) ? $('[name="driver_b_id"]').data('selected-driver-id') : ''
      is_team_driver = $('[name="is_team_driver"]').val()
      var obj = {
        update_eid: $('[name="update_eid"]').val(),
        status_id: $('[name="status_id"]').val(),
        reason_of_cancellation: $('[name="reason_of_cancellation"]').val(),
        truck_id: truck_id,
        trailer_id: trailer_id,
        is_team_driver: is_team_driver,
        driver_id: driver_id,
        driver_b_id: driver_b_id
      }
      // console.log(obj)
      $.ajax({
        url: '../user/dispatch/loads/allocation-info-update-action',
        type: 'POST',
        data: obj,
        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          if (data.status) {
            alert(data.message);
            window.opener.show_group_list()
            window.opener.show_list()
            window.close();
          } else {
            alert(data.message);
          }
          wait_to_submit_btn('#submit', 'SAVE')
        }
      })
    }
    return false
  }
</script>

<datalist id="quick_list_drivers"></datalist>
<script type="text/javascript">
  $(document.body).on('input', '[data-search-driver]', function(event) {
    driver_id_selected = $(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if (driver_id_selected != undefined) {
      $(this).data('selected-driver-id', driver_id_selected)
    }
  });
</script>
<script type="text/javascript">
  $(document.body).on('change', '[data-search-driver]', function() {
    driver_id_selected = $(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if (driver_id_selected == undefined) {
      alert('Invalid driver selected');
      $(this).data('selected-driver-id', 'undefined')
    } else {
      $(this).data('selected-driver-id', driver_id_selected);
    }
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
          console.log(item.name+item.code)
          options += `<option data-driver-filter-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" value="` + item.code + ' ' + item.name + `"></option>`;
        })
        $('#quick_list_drivers').html(options);
      }
    }
  })
</script>
<script type="text/javascript">
  function show_reason_of_cancellation(sel_status) {
    //--remove if reason_of_cancellation
    $('[name="reason_of_cancellation"]').parents('.field-p').remove()
    if (sel_status == 'CANCELLED' || sel_status == "BOUNCED") {
      get_dispatch_load_cancellation_reason({
        group: sel_status
      }).then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          let sel_list = `<div class="field-p">
    <label>Reason of ${sel_status}</label><select name="reason_of_cancellation">`
          if (data.response.list) {
            var options = "";
            sel_list += `<option value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              sel_list += `<option value="${item.id}">${item.name}</option>`;
            })
            sel_list += `</select></div>`
            $('[data-status]').after(sel_list);
            $('[name="reason_of_cancellation"] option[value="<?php echo $details['reason_of_cancellation_id']; ?>"]').prop('selected', true);
          }
        }
      })
    }
  }
  show_reason_of_cancellation('<?php echo $details['status_id'] ?>')
</script>
<datalist id="quick_list_trucks"></datalist>
<script type="text/javascript">
  $(document.body).on('input', '[data-selected-truck-id]', function() {
    truck_id_selected = $(`[data-truck-filter-rows="${$(this).val()}"]`).data('value');
    if (truck_id_selected != undefined) {
      $(this).data('selected-truck-id', truck_id_selected)
    }
  });
</script>
<script type="text/javascript">
  $(document.body).on('change', '[data-selected-truck-id]', function() {
    truck_id_selected = $(`[data-truck-filter-rows="${$(this).val()}"]`).data('value');
    if (truck_id_selected == undefined) {
      alert('Invalid truck selected');
      $(this).data('selected-truck-id', 'undefined')
    } else {
      $(this).data('selected-truck-id', truck_id_selected)
    }
  });
  quick_list_trucks({
    status_ids: 'ACTIVE'
  }).then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option data-truck-filter-rows="" data-value="" value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option data-truck-filter-rows="` + item.code + `" data-value="${item.id}" data-eid="${item.eid}" value="` + item.code + `"></option>`;
          // options+=`<option data-value="${item.id}" value="`+item.code+`"></option>`;               
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
  $(document.body).on('input', '[data-selected-trailer-id]', function() {
    trailer_id_selected = $(`[data-trailer-filter-rows="${$(this).val()}"]`).data('value');
    if (trailer_id_selected != undefined) {
      $(this).data('selected-trailer-id', trailer_id_selected)
    }
  });
</script>
<script type="text/javascript">
  $(document.body).on('change', '[data-selected-trailer-id]', function() {
    trailer_id_selected = $(`[data-trailer-filter-rows="${$(this).val()}"]`).data('value');
    if (trailer_id_selected == undefined) {
      alert('Invalid trailer selected');
      $(this).data('selected-trailer-id', 'undefined')
    } else {
      $(this).data('selected-trailer-id', trailer_id_selected)
    }
  });
  quick_list_trailers({
    body_type: '<?php echo $filter_trailer; ?>',
    status_ids: 'ACTIVE'
  }).then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        //options += `<option data-value="" value="">- - Select - -</option>`
        options += `<option data-trailer-filter-rows="" data-value="" value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          //options += `<option data-value="${item.id}" value="` + item.code + `"></option>`;
          options += `<option data-trailer-filter-rows="` + item.code + `" data-value="${item.id}" data-eid="${item.eid}" value="` + item.code + `"></option>`;
        })
        $('#quick_list_trailers').html(options);
      }
    }
  })
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>