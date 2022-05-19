<?php
require_once APPROOT . '/views/includes/user/header-quick-view.php';
$dtl=$data['details'];
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
  <div class="lg-form-header">Update Empty Movement</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-1" style="width:1000px;">
      <div>
        <fieldset>
          <legend>Origin and Destination Details</legend>
          <div style="display: flex;flex-direction:row;">
            <div class="field-section single-column" style="width:50%">
              <div class="field-p">
                <label>Origin </label>
                <input type="text" value="<?php echo $dtl['origin_address'] ?>" list="quick_list_addresses" data-selected-address-id="<?php echo $dtl['origin_address_id'] ?>" data-filter="addresses_id_search" name="origin_address_id" required>
              </div>
              <div class="field-p">
                <label>Origin Datetime</label>
                <input type="text" placeholder="date" name="origin_date" value="<?php echo $dtl['origin_date'] ?>" data-date-picker style="width:100px"><input type="text" placeholder="time" name="origin_time" data-time-picker style="width:60px" value="<?php echo $dtl['origin_time'] ?>">
              </div>
            </div>
            <div class="field-section single-column" style="width:50%">
              <div class="field-p">
                <label>Destination </label>
                <input type="text" value="<?php echo $dtl['destination_address'] ?>" list="quick_list_addresses" data-selected-address-id="<?php echo $dtl['destination_address_id'] ?>" data-filter="addresses_id_search" name="destination_address_id" required>
              </div>
              <div class="field-p">
                <label>Destination Datetime</label>
                <input type="text" name="destination_date" value="<?php echo $dtl['destination_date'] ?>" placeholder="date" data-date-picker style="width:100px"><input type="text" placeholder="time" value="<?php echo $dtl['destination_time'] ?>" name="destination_time" data-time-picker style="width:60px">
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
     obj = {
      eid: '<?php echo $dtl["eid"] ?>',
      origin_address_id: $('[name="origin_address_id"]').data('selected-address-id'),
      origin_date: $('[name="origin_date"]').val(),
      origin_time: $('[name="origin_time"]').val(),
      destination_address_id: $('[name="destination_address_id"]').data('selected-address-id'),
      destination_date: $('[name="destination_date"]').val(),
      destination_time: $('[name="destination_time"]').val(),
    }
    $.ajax({
      url: '../user/dispatch/loads/empty-movements/update-action',
      type: 'POST',
      data: obj,
      success: function(data) {
        alert(data)
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
    return false
  }
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

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>