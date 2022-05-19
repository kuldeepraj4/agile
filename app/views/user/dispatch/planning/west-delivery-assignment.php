<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br>
<style type="text/css">
  .bg-grey-column{
    background: #f2f2f2 !important;
  }
  .hide-row-content{
    color: white !important;
    border-top: none !important;
  }
</style>
<section class="rv content-box" style="margin: auto;max-width: 1600px">
  <h1 class="rv-heading">West Delivery Assignment</h1>
  <section class="rv-filter-section">
    <!-- input used for sory by call-->
    <input type="hidden" id="sort_by" value="">
    <!-- //input used for sory by call-->
    <!-- <div class="filter-item fourth">
      <label>Status</label>
      <select data-filter="status_id" onchange="set_params('status_id', this.value), goto_page(1)"></select>
    </div> -->
<!--     <div class="filter-item fourth">
      <label>Driver ID</label>
      <input type="text" list="quick_list_drivers" data-filter="driver_id" data-driver-id>
    </div> -->
    <div class="filter-item fourth">
      <label>Delivery Zone</label>
      <select data-filter="delivery_zone_id" onchange="set_params('delivery_zone_id', this.value), goto_page(1),show_group_list()"></select>
    </div>
<!--     <div class="filter-item fourth">
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
    </div>
    <div class="filter-item fourth">
      <label>Trailer No.</label>
      <input type="text" data-filter="trailer_id" list="quick_list_trailers" data-trailer-id>
    </div>
    <div class="filter-item fourth">
      <label>Delivery Date From</label>
      <input type="text" data-date-picker="" data-deliverydate-from data-filter="delivery_date_from" onchange="set_params('delivery_date_from', this.value), goto_page(1)">
    </div>
    <div class="filter-item fourth">
      <label>Delivery Date To</label>
      <input data-date-picker="" type="text" data-deliverydate-to data-filter="delivery_date_to" onchange="set_params('delivery_date_to', this.value), goto_page(1)">
    </div> -->
    <div class="filter-item fourth"></div>
    <div class="filter-item fourth"></div>
    <div class="filter-item fourth"></div>
  </section>
  <section class="rv-filter-buttons">
    <ul id="rv-filter-buttons-container" style="justify-content:center;margin:5px 0px 12px 0px;"></ul>
  </section>
  <div class="rv-table fixedheader">
    <input type='hidden' id='sort' value='asc'>
    <table data-my-table>
      <thead>
        <tr>
          <th rowspan="2">Load No.</th>
          <th rowspan="2">Load Status</th>
          <th rowspan="2">Customer</th>
          <th rowspan="2">PO</th>
          <th rowspan="2">Reefer Temp.</th>
          <th rowspan="2" data-table-sort-by="driver_id">Drivers</th>
          <th rowspan="2">Truck</th>
          <th rowspan="2">Trailer</th>
          <th rowspan="2">Trailer Location</th>
          <th rowspan="2">Delivery</th>                  
          <th rowspan="2">Appointment</th>
          <th rowspan="2">Load Pick up Numbers</th>        
          <th rowspan="2">#</th>        
          <th colspan="2">As per BOL</th>
          <th rowspan="2">Remarks</th>
          <th rowspan="2">Delivery Zone</th>
          <th rowspan="2">Dispatch Status</th>
          <th rowspan="2"></th>
          <th rowspan="2">Reefer Set Temp</th>
          <th rowspan="2">Truck Location</th>
        </tr>
        <tr>
          <th>Cases</th>
          <th>Pallets</th>

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
<!-- --------START---------------Date changing code by swaran START  START    START   here-------START----------START------------------------------- -->
<script type="text/javascript">
  var weekday = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
  var months = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"]
  // --------------this month, date and year-----------start here------------------------------
  var d = new Date();
  var this_month = d.getMonth();
  var this_mon = months[this_month];
  var today_date = d.getDate();
  var toda_date = ('0' + today_date).slice(-2);
  var this_year = d.getFullYear();
  // --------------this month, date and year-----------end here--------------------------------------

  //---------------------one day previuos date    start here-----------------------------------------
  d.setDate(d.getDate() - 1);
  var date = d.getDate();
  var dd = ('0' + date).slice(-2);
  var mm = d.getMonth();
  var mmm = months[mm];
  var yy = d.getFullYear();
  //---------------------one day previuos date    end here--------------------------------------------
  // ------------six days next month,date and year from one date previous code start here-------------
  d.setDate(d.getDate() + 6);
  var end_date = d.getDate();
  var end_dd = ('0' + end_date).slice(-2);
  var mont = d.getMonth();
  var month = months[mont];
  var year = d.getFullYear();
  //  ------------six days next month,date and year from one date previous code end here----------------

  var url_params = get_params();
  if (url_params.hasOwnProperty('st_date')) {} else {
    set_params('st_date', mmm + '/' + dd + '/' + yy)
    set_params('end_date', month + '/' + end_dd + '/' + year)
    set_params('calender_delivery_date', this_mon + '/' + toda_date + '/' + this_year)
  }

  function show_active_date() {
    $('.calender_delivery_date').removeClass('active-date');
    $(`[data-date="${check_url_params('calender_delivery_date')}"]`).addClass('active-date')
  }
</script>
<script type="text/javascript">
  $(document.body).on('click', '.left', function() {
    var d2 = new Date(check_url_params('st_date'));
    d2.setDate(d2.getDate() - 7);
    var new_start_date = d2.getDate();
    var new_start_dd = ('0' + new_start_date).slice(-2);
    var new_start_mont = d2.getMonth();
    var new_start_month = months[new_start_mont];
    var new_start_year = d2.getFullYear();
    var d3 = new Date(check_url_params('end_date'));
    d3.setDate(d3.getDate() - 7);
    var new_end_date3 = d3.getDate();
    var new_end_dd3 = ('0' + new_end_date3).slice(-2);
    var new_end_mont3 = d3.getMonth();
    var new_end_month3 = months[new_end_mont3];
    var new_end_year3 = d3.getFullYear();
    set_params('st_date', new_start_month + '/' + new_start_dd + '/' + new_start_year)
    set_params('end_date', new_end_month3 + '/' + new_end_dd3 + '/' + new_end_year3)
    calender_days()

  })
  $(document.body).on('click', '.right', function() {
    var d4 = new Date(check_url_params('st_date'));
    d4.setDate(d4.getDate() + 7);
    var new_start_date4 = d4.getDate();
    var new_start_dd4 = ('0' + new_start_date4).slice(-2);
    var new_start_mont4 = d4.getMonth();
    var new_start_month4 = months[new_start_mont4];
    var new_start_year4 = d4.getFullYear();
    var d5 = new Date(check_url_params('end_date'));
    d5.setDate(d5.getDate() + 7);
    var new_end_date5 = d5.getDate();
    var new_end_dd5 = ('0' + new_end_date5).slice(-2);
    var new_end_mont5 = d5.getMonth();
    var new_end_month5 = months[new_end_mont5];
    var new_end_year5 = d5.getFullYear();
    set_params('st_date', new_start_month4 + '/' + new_start_dd4 + '/' + new_start_year4)
    set_params('end_date', new_end_month5 + '/' + new_end_dd5 + '/' + new_end_year5)
    calender_days()
  })
</script>
<script type="text/javascript">
  function calender_days() {
    $.ajax({
      url: '../user/dispatch/west-delivery-assignment/date-wise-total-deliveries-ajax',
      type: 'POST',
      data: {
        delivery_date_from: check_url_params('st_date'),
        delivery_date_to: check_url_params('end_date'),
        delivery_zone_id: check_url_params('delivery_zone_id'),
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          if (data.status) {
            var days = `<button class="left" style="background-color:#0552b0;"><<</button>&nbsp;&nbsp;`;
            $.each(data.response.list, function(index, item) {
              days += `<li style="border:1px solid grey" class="calender_delivery_date" data-date="${item.date}"><label><span style="font-weight:normal;font-style:italic">${item.short_date} ${item.week_day}</span> <span> &nbsp ${item.total_loads}</span></label></li>`;

            })
            days += `&nbsp;&nbsp;<button class="right" style="background-color:#0552b0;">>></button>`;
            $('#rv-filter-buttons-container').html(days)

            show_active_date()
          }

        }

      }
    })
  }
</script>
<script type="text/javascript">
  $(document.body).on('click', '.calender_delivery_date', function() {
    var calender_delivery_date = $(this).data('date');
    set_params('calender_delivery_date', calender_delivery_date);
    show_list();
  })
</script>
<!-- ---------END----END----------Date changing code by swaran END  END    END   here-------END----------END---------------END----------END------------------------------------- -->
<script type="text/javascript">
  function show_list() {
    $.ajax({
      url:'../user/dispatch/west-delivery-assignment-ajax',
      type: 'POST',
      data: {
        sort_by: $('#sort_by').val(),
        sort_by_order_type: $('#sort').val(),
        //status_id: check_url_params('status_id'),
        delivery_zone_id: check_url_params('delivery_zone_id'),
        //driver_id: check_url_params('driver_id'),
        //delivery_date_from: check_url_params('delivery_date_from'),
        //delivery_date_to: check_url_params('delivery_date_to'),
        //truck_id: check_url_params('truck_id'),
       // trailer_id: check_url_params('trailer_id'),
       // po_number: check_url_params('po_number'),
        //load_type_id: check_url_params('load_type_id'),
        delivery_date: check_url_params('calender_delivery_date'),
      },
      beforeSend: function() {
        show_table_data_loading("[data-my-table]")
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          $('#tabledata').html("");
          if (data.status) {
            // var counter = 1;
            var repeat_load=0;
            var hide_row_content=false
            $.each(data.response.list, function(index, item) {
              if(index==0){
               repeat_load=item.load_id;
               hide_row_content=false;
             }else{
              if(repeat_load!=item.load_id){
               repeat_load=item.load_id;
               hide_row_content=false;
             }else{
               hide_row_content=true;
             }
           }

//---calculate appointment cell color
           switch(item.shipper_confirmation_status){
              case 'PENDING':
                var appointment_cell_bg='#e8b717';
                break;
              default:
              var appointment_cell_bg='white';
              break;
           }

//---/calculate appointment cell color


//---calculate stop row color
  
  switch(item.drop_completion_stage){
    case 'FIRST':
    var stop_bg='white';
    break;
    
    case 'SECOND':
    var stop_bg='#edda32';
    break;
    
    case 'THIRD':
    var stop_bg='#d495e6';
    break;

    case 'FOURTH':
    var stop_bg='#4dab52';
    break;

    default:
    var stop_bg='white';
    break;
  }
//---/calculate stop row color
              let quantity_details =item.quantity_details
              
              var pick_up_number=Object.keys(quantity_details).map(function(k){return quantity_details[k]['pd_number']}).join("<br>");
              var pallet_count_bol=Object.keys(quantity_details).map(function(k){return quantity_details[k]['pallet_count_bol']}).join("<br>");
              var case_count_bol=Object.keys(quantity_details).map(function(k){return quantity_details[k]['case_count_bol']}).join("<br>");

                          if(hide_row_content==false){
                            var row = `<tr><td colspan="27" style="padding:0;background:lightgrey !important;height:6px"></td></tr><tr>`
                          }else{
                            var row = `<tr>`  
                          }
                          if(hide_row_content==false){
                            row+=`<td class="${hide_row_content}">${item.load_id}</td>
                            <td class="${get_load_row_bg(item.load_status)}"> ${item.load_status}</td>
                            <td class="${hide_row_content}"><span class="tooltip">${item.customer_code}<span class="tooltiptext">${item.customer_name}</span></span></td>
                            <td class="${hide_row_content}">${item.po_number}</td>
                            <td class="${hide_row_content}">${item.reefer_temperature}</td>`
                          }else{
                            row+=`<td colspan="5"></td>`
                          }
                          
                          if(item.stop_assignment_status=='ASSIGNED'){
                            row+=`<td style="white-space:nowrap;text-align:left;background:${stop_bg}">${item.dis_driver_display_name}`
                            if(item.dis_driver_b_display_name!=''){
                              row+=`<br><b>T</b> ${item.dis_driver_b_display_name}`
                            }
                            row+=`</td>
                            <td style="background:${stop_bg}">${item.dis_truck_code}</td>
                            <td style="background:${stop_bg}">${item.dis_trailer_code}</td>
                            <td style="background:${stop_bg}">${item.dis_trailer_location}</td>`
                          }else{
                            row+=`<td style="white-space:nowrap;text-align:left;background:${stop_bg}">${item.al_driver_display_name}`
                            if(item.al_driver_b_display_name!=''){
                              row+=`<br><b>T</b> ${item.al_driver_b_display_name}`
                            }
                            row+=` <i class="ic edit" style="color:grey" title="Update opreration info"  onclick="open_child_window({url:'../user/dispatch/loads/stop-allocation-info-update&eid=${item.load_stop_eid}',width:700,height:500})"></i></td>
                            <td style="background:${stop_bg}">${item.al_truck_code}</td><td></td><td></td>`      
                          }


                          row+=`
                          <td style="background:${stop_bg}">${item.delivery_location}</td>
                          <td style="background:${stop_bg}">${item.appointment_type} ${date_format(item.appointment_date)} <br><span style="white-space:nowrap">${item.appointment_time_from} ${(item.appointment_time_from!=item.appointment_time_to)?item.appointment_time_to:''}</span></td>
                          <td style="background:${stop_bg}">${item.load_pick_up_numbers}</td>
                          <td style="background:${stop_bg}">${pick_up_number}</td>
                          <td style="background:${stop_bg}" class="bg-grey-column">${pallet_count_bol}</td>
                          <td style="background:${stop_bg}" class="bg-grey-column">${case_count_bol}</td>
                          <td style="background:${stop_bg}"></td>
                          <td style="background:${stop_bg}">${item.delivery_zone}</td>
                          <td>${item.dispatch_status}</td>
                          <td style="white-space:nowrap">`
                          if(item.is_express_load=='L' && item.dispatch_id!=""){
                            row+=`<i class="ic truck" style="color:grey" title="Update dispatch info"  onclick="open_child_window({url:'../user/dispatch/loads/dispatch-update&eid=${item.dispatch_eid}',width:900,height:700})"></i>`
                          }
                        row+=`</td>
                          <td>${item.dis_trailer_set_point_temp}</td>
                          <td>${item.dis_truck_location}</td>
                          </tr>`;
                          $('#tabledata').append(row);
                        })
} else {
  $('#tabledata').html("");
  var row = `<tr><td colspan="5">` + data.message + `</td></tr>`;
  $('#tabledata').append(row);
  $('[data-pagination]').html('');
}
calender_days()
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
<script type="text/javascript">
  $(document.body).on('change', '[data-pick-confirmed-with-customer]', function() {
let is_confirmed=(($(this).prop('checked'))==true)?'YES':'NO';
if(confirm('Do you want to proceed ?')){
$.ajax({
        url: '../user/dispatch/loads/toggle-pick-confirmed-with-customer-action',
        type: 'POST',
        data: {
          stop_eid:$(this).data('stop-eid'),
          is_confirmed:is_confirmed
        },
        success: function(data) {
                  if ((typeof data) == 'string') {
          data = JSON.parse(data)
          if (data.status) {
            show_list();
          }else{
            alert(data.message)
          }

        }
        }

      })
}else{
  $(this).prop('checked',(is_confirmed=='YES')?false:true)
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
<script type="text/javascript">
    get_location_zones_quick_list().then(function(data) {
      console.log(data)
        // Run this when your request was successful
        if (data.status) {
            //Run this if response has list
            if (data.response.list) {
                var options = "";
                options += `<option value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option value="` + item.id + `">` + item.name + `</option>`;
                })
                $('[data-filter="delivery_zone_id"]').html(options);
                $("[data-filter='delivery_zone_id'] option[value=" + check_url_params('delivery_zone_id') + "]").prop('selected', true);
            }
        }
    }).catch(function(err) {
        // Run this when promise was rejected via reject()
    })
</script>
<script type="text/javascript">
  // get_location_regions().then(function(data) {
  //       // Run this when your request was successful
  //       if (data.status) {
  //           //Run this if response has list
  //           if (data.response.list) {
  //             var options = "";
  //             options += `<option value="">- - Select - -</option>`
  //             $.each(data.response.list, function(index, item) {
  //               options += `<option value="` + item.id + `">` + item.name + `</option>`;
  //             })
  //             $('[data-filter="region_id"]').html(options);
  //             $("[data-filter='region_id'] option[value=" + check_url_params('region_id') + "]").prop('selected', true);
  //           }
  //         }
  //       }).catch(function(err) {
  //       // Run this when promise was rejected via reject()
  //     })
    </script>
    <?php
    require_once APPROOT . '/views/includes/user/footer.php';
  ?>