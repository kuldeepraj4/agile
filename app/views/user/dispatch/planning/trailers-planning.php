<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="rv content-box" style="margin: auto;max-width: 1600px">
  <h1 class="rv-heading">Trailer Planning</h1>
  <section class="rv-filter-section">
    <!-- input used for sory by call-->
    <input type="hidden" id="sort_by" value="">
    <!-- //input used for sory by call-->
<!--     <div class="filter-item fourth">
      <label>Status</label>
      <select data-filter="status_id" onchange="set_params('status_id', this.value), goto_page(1)"></select>
    </div>
    <div class="filter-item fourth">
      <label>Driver ID</label>
      <input type="text" list="quick_list_drivers" data-filter="driver_id" data-driver-id>
    </div>
    <div class="filter-item fourth">
      <label>Pickup Date From</label>
      <input type="text" data-date-picker="" data-pickupdate-from data-filter="pick_up_date_from" onchange="set_params('pick_up_date_from', this.value), goto_page(1)">
    </div>
    <div class="filter-item fourth">
      <label>Pickup Date To</label>
      <input data-date-picker="" type="text" data-pickupdate-to data-filter="pick_up_date_to" onchange="set_params('pick_up_date_to', this.value), goto_page(1)" />
    </div>
    <div class="filter-item fourth">
      <label>Truck No.</label>
      <input type="text" data-filter="truck_id" list="quick_list_trucks" data-truck-id>
    </div> -->
    <div class="filter-item fourth">
      <label>Trailer No.</label>
      <input type="text" data-filter="trailer_id" list="quick_list_trailers" data-trailer-id>
    </div>
<!--     <div class="filter-item fourth">
      <label>Delivery Date From</label>
      <input type="text" data-date-picker="" data-deliverydate-from data-filter="delivery_date_from" onchange="set_params('delivery_date_from', this.value), goto_page(1)">
    </div>
    <div class="filter-item fourth">
      <label>Delivery Date To</label>
      <input data-date-picker="" type="text" data-deliverydate-to data-filter="delivery_date_to" onchange="set_params('delivery_date_to', this.value), goto_page(1)">
    </div>
    <div class="filter-item fourth">
      <label>PO No.</label>
      <input type="text" data-filter="po_number" onchange="set_params('po_number', this.value), goto_page(1)">
    </div>
    <div class="filter-item fourth">
      <label>Load Type</label>
      <select data-filter="load_type_id" onchange="set_params('load_type_id', this.value), goto_page(1)">
        <option value="">- - Select - -</option>
        <option value="LOT01">Truck Load</option>
        <option value="LOT02">Power Only</option>
        <option value="LOT03">Drop & Hook</option>
      </select>
    </div> -->
    <div class="filter-item fourth"></div>
    <div class="filter-item fourth"></div>
    <div class="filter-item fourth"></div>
  </section>
  <div class="rv-table fixedheader">
    <input type='hidden' id='sort' value='asc'>
    <table data-my-table>
      <thead>
        <tr>
          <th>Sr No</th>
          <th data-table-sort-by="truck_id">Trailer</th>
          <th data-table-sort-by="driver_id">Driver</th>
          <th data-table-sort-by="trailer_id">Truck</th>
          <th>Delivery Location</th>
          <th data-table-sort-by="delivery_date">Delivery Date</th>
          <th>Delivery Time</th>
          <th>Load Status</th>
          <th>Current Location</th>
          <th data-table-sort-by="eta">ETA</th>
          <th>Next Plan</th>
        </tr>
      </thead>
      <tbody id="tabledata"></tbody>
    </table>
  </div>
  <div data-pagination></div>
</section>
<script type="text/javascript">
  var url_params = get_params();
  if (url_params.hasOwnProperty('po_number')) {
    $("[data-filter='po_number']").val(url_params.po_number);
  }
  if (url_params.hasOwnProperty('pick_up_date_from')) {
    $("[data-filter='pick_up_date_from']").val(url_params.pick_up_date_from);
  }
  if (url_params.hasOwnProperty('pick_up_date_to')) {
    $("[data-filter='pick_up_date_to']").val(url_params.pick_up_date_to);
  }
  if (url_params.hasOwnProperty('delivery_date_from')) {
    $("[data-filter='delivery_date_from']").val(url_params.delivery_date_from);
  }
  if (url_params.hasOwnProperty('delivery_date_to')) {
    $("[data-filter='delivery_date_to']").val(url_params.delivery_date_to);
  }
  if (url_params.hasOwnProperty('load_type_id')) {
    $("[data-filter='load_type_id'] option[value=" + url_params.load_type_id + "]").prop('selected', true);
  }
</script>
<script>
  $(document.body).on('change', '[data-pickupdate-from]', function() {
    var g1 = new Date(check_url_params('pick_up_date_from'))
    var g2 = new Date(check_url_params('pick_up_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Please enter the valid date!. Pickup Start date should be less than Pickup end date")
      $("[data-filter='pick_up_date_from']").val("");
      set_params('pick_up_date_from', "")
      goto_page(1)
    }
  });
  $(document.body).on('change', '[data-pickupdate-to]', function() {
    var g1 = new Date(check_url_params('pick_up_date_from'))
    var g2 = new Date(check_url_params('pick_up_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Please enter the valid date!. Pickup End date should be greater than Pickup start date")
      $("[data-filter='pick_up_date_to']").val("");
      set_params('pick_up_date_to', "")
      goto_page(1)
    }
  });
</script>
<script>
  $(document.body).on('change', '[data-deliverydate-from]', function() {
    var g1 = new Date(check_url_params('delivery_date_from'))
    var g2 = new Date(check_url_params('delivery_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Please enter the valid date!. Delivery Start date should be less than Delivery end date")
      $("[data-filter='delivery_date_from']").val("");
      set_params('delivery_date_from', "")
      goto_page(1)
    }
  });
  $(document.body).on('change', '[data-deliverydate-to]', function() {
    var g1 = new Date(check_url_params('delivery_date_from'))
    var g2 = new Date(check_url_params('delivery_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Please enter the valid date!. Delivery End date should be greater than Delivery start date")
      $("[data-filter='delivery_date_to']").val("");
      set_params('delivery_date_to', "")
      goto_page(1)
    }
  });
</script>
<script type="text/javascript">
  function show_list() {
    $.ajax({
      url: location.pathname + '-ajax',
      type: 'POST',
      data: {
        sort_by: $('#sort_by').val(),
        sort_by_order_type: $('#sort').val(),
        page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
        batch: (check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
        webapi: 'pagination',
        // status_id: check_url_params('status_id'),
        // driver_id: check_url_params('driver_id'),
        // pick_up_date_from: check_url_params('pick_up_date_from'),
        // pick_up_date_to: check_url_params('pick_up_date_to'),
        // delivery_date_from: check_url_params('delivery_date_from'),
        // delivery_date_to: check_url_params('delivery_date_to'),
        // truck_id: check_url_params('truck_id'),
        trailer_id: check_url_params('trailer_id'),
        // po_number: check_url_params('po_number'),
        // load_type_id: check_url_params('load_type_id'),
      },
      beforeSend: function() {
        show_table_data_loading("[data-my-table]")
      },
      success: function(data) {
        console.log(data)
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          $('#tabledata').html("");
          if (data.status) {
            // var counter = 1;
            $.each(data.response.list, function(index, item) {
              var row = `<tr>
           <td>${item.sr_no}</td>
           <td>${item.code}</td>
           <td>${item.driver_a} ${(item.is_team_driver=='TEAM')?`<b>T</b><br>${item.driver_b}`:''}</td>
           <td>${item.truck_code}</td>
           <td>${item.load_shipper_location}</td>
           <td>${(item.load_delivery_date!="")?date_format(item.load_delivery_date):""}</td>
           <td>${item.load_delivery_time}</td>
           <td>${item.load_status}</td>
           <td style="text-align:left">${item.current_location}</td>
           <td></td>
           <td></td>`;
              row += `</tr>`;
              $('#tabledata').append(row);
            })
          } else {
            $('#tabledata').html("");
            var row = `<tr><td colspan="5">` + data.message + `</td></tr>`;
            $('#tabledata').append(row);
            $('[data-pagination]').html('');
          }
        }
      }
    })
  }
  show_list()
</script>
<!-- -----------------------------Driver function start here ------------------------------------------------------>
<script type="text/javascript">
  $(document.body).on('input', '[data-driver-id]', function() {
    id_selected = $(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if (id_selected != undefined) {
      $(this).data('driver-id', id_selected)
      set_params('driver_id', id_selected)
      set_params('driver_name', $(`[data-driver-id]`).val())
      goto_page(1)
    }
  });
</script>
<script type="text/javascript">
  $(document.body).on('change', '[data-driver-id]', function() {
    id_selected = $(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if (id_selected == undefined) {
      alert("Please enter correct DriverID")
      set_params('driver_id', '')
      set_params('driver_name', '')
      $(`[data-driver-id]`).val('')
      goto_page(1)
    }
  });
</script>
<datalist id="quick_list_drivers"></datalist>
<script type="text/javascript">
  function show_quick_list_drivers() {
    quick_list_drivers().then(function(data) {
      if (data.status) {
        if (data.response.list) {
          var options = "";
          options += `<option data-driver-filter-rows="" data-value="" value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option data-driver-filter-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" value="` + item.code + ' ' + item.name + `"></option>`;
          })
          $('#quick_list_drivers').html(options);
          if (url_params.hasOwnProperty('driver_name')) {
            $(`[data-driver-id]`).val(check_url_params('driver_name'))
            // $("[data-filter='vehicle_id'] option[value=" + url_params.vehicle_id + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {})
  }
  show_quick_list_drivers()
</script>
<!-- -----------------------------Driver function end here ------------------------------------------------------>
<!-- -----------------------------truck function start here ------------------------------------------------------>
<datalist id="quick_list_trucks"></datalist>
<script type="text/javascript">
  $(document.body).on('input', '[data-truck-id]', function() {
    id_selected = $(`[data-truck-id-rows="${$(this).val()}"]`).data('value');
    //eid_selected = $(`[data-truck-id-rows="${$(this).val()}"]`).data('eid');
    if (id_selected != undefined) {
      $(this).data('truck-id', id_selected)
      set_params('truck_id', id_selected)
      set_params('truck_name', $(`[data-truck-id]`).val())
      goto_page(1)
    }
  });
</script>
<script type="text/javascript">
  $(document.body).on('change', '[data-truck-id]', function() {
    id_selected = $(`[data-truck-id-rows="${$(this).val()}"]`).data('value');
    if (id_selected == undefined) {
      alert("Please enter correct TruckID")
      set_params('truck_id', '')
      set_params('truck_name', '')
      $(`[data-truck-id]`).val('')
      goto_page(1)
    }
  });
</script>
<script type="text/javascript">
  quick_list_trucks().then(function(data) {
    if (data.status) {
      if (data.response.list) {
        var options = "";
        options += `<option data-truck-id-rows="" data-value="" value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option data-truck-id-rows="` + item.code + `" data-value="${item.id}" data-eid="${item.eid}" value="` + item.code + `"></option>`;
        })
        $('#quick_list_trucks').html(options);
        if (url_params.hasOwnProperty('truck_name')) {
          $(`[data-truck-id]`).val(check_url_params('truck_name'))
        }
      }
    }
  }).catch(function(err) {})
</script>
<!-- -----------------------------truck function end here ---------------------------------------->
<!-- -----------------------------trailer function start here ---------------------------------------->
<datalist id="quick_list_trailers"></datalist>
<script type="text/javascript">
  $(document.body).on('input', '[data-trailer-id]', function() {
    id_selected = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
    //eid_selected = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('eid');
    if (id_selected != undefined) {
      $(this).data('trailer-id', id_selected)
      set_params('trailer_id', id_selected)
      set_params('trailer_name', $(`[data-trailer-id]`).val())
      goto_page(1)
    }
  });
</script>
<script type="text/javascript">
  $(document.body).on('change', '[data-trailer-id]', function() {
    id_selected = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
    if (id_selected == undefined) {
      alert("Please enter correct TrailerID")
      set_params('trailer_id', '')
      set_params('trailer_name', '')
      $(`[data-trailer-id]`).val('')
    }
  });
</script>
<script type="text/javascript">
  quick_list_trailers().then(function(data) {
    if (data.status) {
      if (data.response.list) {
        var options = "";
        options += `<option data-trailer-id-rows="" data-value="" value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option data-trailer-id-rows="` + item.code + `" data-value="${item.id}" data-eid="${item.eid}" value="` + item.code + `"></option>`;
        })
        $('#quick_list_trailers').html(options);
        if (url_params.hasOwnProperty('trailer_name')) {
          $(`[data-trailer-id]`).val(check_url_params('trailer_name'))
        }
      }
    }
  }).catch(function(err) {})
</script>
<!-- -----------------------------trailer function end here ---------------------------------------->
<script type="text/javascript">
  function sort_table() {
    show_list()
  }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>