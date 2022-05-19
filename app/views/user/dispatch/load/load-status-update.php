<?php
require_once APPROOT . '/views/includes/user/header-quick-view.php';
$data=$data['details'];
?>
<br><br><br>
<br>
<section class="lg-form-outer">
  <div class="lg-form-header">Update Load Status <?php echo $data['id']; ?></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-111" style="max-width: 700px">
      <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
      <div>
        <fieldset>
          <legend></legend>
          <div style="display:flex;">
            <div class="field-section single-column" style="width:100%">
              <div class="field-p" data-status>
                <label>Status</label>
                <select data-default-select="<?php echo $data['status_id'] ?>" name="status_id" onchange="show_reason_of_cancellation(this.value)">
                  <option> - - Select - - </option>
                  <option value="CANCELLED">Cancelled</option>
                  <option value="TONU">TONU</option>
                </select>
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
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    if (isValidForm) {
      var obj = {
        update_eid: $('[name="update_eid"]').val(),
        status_id: $('[name="status_id"]').val(),
        reason_of_cancellation: $('[name="reason_of_cancellation"]').val(),
      }
      $.ajax({
        url: '../user/dispatch/loads/load-status-update-action',
        type: 'POST',
        data: obj,
        success: function(data) {
          alert(data)
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
            $('[name="reason_of_cancellation"] option[value="<?php echo $data['reason_of_cancellation_id']; ?>"]').prop('selected', true);
          }
        }
      })
    }
  }
  show_reason_of_cancellation('<?php echo $data['status_id'] ?>')
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