<?php
require_once APPROOT . '/views/includes/user/header-quick-view.php';
$details = $data['details'];
?>
<br><br><br>
<br>
<section class="lg-form-outer">
  <div class="lg-form-header">Update Weight Details of Load <?php echo $details['load_id']; ?></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-111" style="max-width: 700px">
      <input type="hidden" name="update_eid" value="<?php echo $details['load_eid']; ?>">
      <div>
        <fieldset>
          <legend>Load Weight Information</legend>
          <div style="display:flex;">
            <div class="field-section single-column" style="width:100%">
              <div class="field-p">
                <label>Steer Axle Weight</label>
                <input type="text" value="<?php echo $details['steer_axle_weight'] ?>"  name="steer_axle_weight">
              </div>

              <div class="field-p">
                <label>Drive Axle Weight</label>
                <input type="text" value="<?php echo $details['drive_axle_weight'] ?>"  name="drive_axle_weight">
              </div>
              <div class="field-p">
                <label>Trailer Weight</label>
                <input type="text" value="<?php echo $details['trailer_axle_weight'] ?>"  name="trailer_axle_weight">
              </div>



            </div>
          </div>
        </fieldset>
      </div>

    </section>
    <section class="action-button-box">
    <button type="submit" class="btn_green">SAVE</button>
  </section>
  </form>
</section>

<script type="text/javascript">
  function save() {
    submit_to_wait_btn('#submit', 'loading')

    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();

    if (isValidForm) {
            var arr=$('#MyForm').serializeArray();
            var obj={}
            for(var a=0;a<arr.length;a++ ){
                obj[arr[a].name]=arr[a].value
            }
      $.ajax({
        url: '../user/dispatch/loads/weight-detials-update-action',
        type: 'POST',
        data: obj,
        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          if (data.status) {
            alert(data.message);
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
  $(document.body).on('change', '[data-search-driver]', function() {
    driver_id_selected = $(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if ($(this).val() != '') {
      if (driver_id_selected == undefined) {
        alert('Invalid driver selected');
        driver_id_selected = ''
        $(this).val('')
        $(this).focus()
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
  var truck_flag = "YES";
  $(document.body).on('input', '[data-selected-truck-id]', function() {
    truck_id_selected = $(`[data-driv-filter-rows="${$(this).val()}"]`).data('value');
   // if ($(this).val() != '') {
      if (truck_id_selected != undefined) {
        truck_flag = "YES";
        $(this).data('selected-truck-id', truck_id_selected)
        truck_id = truck_id_selected
        truck_name = $(`[data-selected-truck-id]`).val()
      } else {
        truck_flag = "NO";
      }
   // }
  });
</script>
<script type="text/javascript">
  $(document.body).on('change', '[data-selected-truck-id]', function() {
    truck_id_selected = $(`[data-driv-filter-rows="${$(this).val()}"]`).data('value');
    // truck_id_selected=$(`option[value="${$(this).val()}"]`).data('value');
   // if ($(this).val() != '') {
      if (truck_id_selected == undefined) {
        alert('Invalid truck selected');
        truck_flag = "NO";
        truck_id = ''
        truck_name = '';
        //$(`[data-selected-truck-id]`).val("");
        $(this).data('selected-truck-id', "")
        //$(this).focus()
      } else {
        truck_flag = "YES";
        truck_id = truck_id_selected;
        truck_name = $(`[data-selected-truck-id]`).val();
        $(this).data('selected-truck-id', truck_id_selected)
      }
   // }
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
          options += `<option data-driv-filter-rows="` + item.code + `" data-value="${item.id}" data-eid="${item.eid}" value="` + item.code + `"></option>`;
          // options+=`<option data-value="${item.id}" value="`+item.code+`"></option>`;               
        })
        $('#quick_list_trucks').html(options);
      }
    }
  })
</script>
<script type="text/javascript">
  function validator() {
    if (truck_flag == "NO") {
      alert("Please remove the invalid data from truck input field")
    } else {
      save()
    }
  }
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
      }
    } else {
      trailer_id_selected = ''
    }
    $(this).data('selected-trailer-id', trailer_id_selected);
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
        options += `<option data-value="" value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option data-value="${item.id}" value="` + item.code + `"></option>`;
        })
        $('#quick_list_trailers').html(options);
      }
    }
  })
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>