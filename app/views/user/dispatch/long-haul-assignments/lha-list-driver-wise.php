<?php require_once APPROOT . '/views/includes/user/header.php'; ?>
<style>
  .active-date {
    background: darkgrey;
    color: white;
  }
</style>
<section class="rv content-box" style="margin: auto;max-width: 1350px">
  <h1 class="rv-heading">Long Haul Assignments Driver Wise</h1>

  <section class="rv-action-bar">

    <?php
    if (in_array('DIS052', USER_PRIV)) {
    ?>
      <button class='btn_blue' onclick="open_child_window({url:'../user/dispatch/long-haul-assignments/add-new',width:1000,height:500})">Add New</button>
    <?php
    }
    ?>
  </section>
  <section class="rv-filter-section">
    <!-- input used for sory by call-->
    <input type="hidden" id="sort_by" value="">
    <!-- //input used for sory by call-->
    <div class="filter-item fourth">
      <label>Team/Solo</label>
      <select data-filter="is_team_driver" onchange="set_params('is_team_driver', this.value), goto_page(1)">
        <option value="">ALL</option>
        <option value="TEAM">Team</option>
        <option value="SOLO">Solo</option>
      </select>
    </div>

    <div class="filter-item fourth">
      <label>Driver</label>
      <input type="hidden" data-filter="driver_id">
      <input type="text" list="quick_list_drivers_for_search" data-search-driver />
    </div>


    <!-- 
    <div class="filter-item fourth">
      <label>Start Date From</label>
      <input type="text" data-date-picker="" data-filter="driver_start_date_from" onchange="set_params('driver_start_date_from', this.value), goto_page(1)" value="<?php echo date('m/d/Y', strtotime('-1 day')) ?>">
    </div>
    <div class="filter-item fourth">
      <label>Start Date To</label>
      <input data-date-picker="" type="text" data-filter="driver_start_date_to" onchange="set_params('driver_start_date_to', this.value), goto_page(1)" value="<?php echo date('m/d/Y', strtotime('+7 day')) ?>" />
    </div> -->
    <div class="filter-item fourth">
      <label>Truck</label>
      <input type="hidden" data-filter="truck_id">
      <input type="text" list="quick_list_trucks_search" data-search-trucks>
    </div>
    <div class="filter-item fourth">
      <label>LHA Status</label>
      <select data-filter="lha_status_id" onchange="set_params('lha_status_id', this.value), goto_page(1)"></select>
    </div>
    <!-- <div class="filter-item fourth"></div>
    <div class="filter-item fourth"></div> -->
  </section>

  <section class="rv-filter-buttons">
    <ul id="rv-filter-buttons-container" style="justify-content:center;margin:5px 0px 12px 0px;"></ul>
  </section>

  <div class="rv-table">
    <table data-my-table>
      <input type='hidden' id='sort' value='asc'>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th data-table-sort-by="team_solo">Team/Solo</th>
          <th>Driver</th>
          <th data-table-sort-by="truck_code">Truck</th>
          <th data-table-sort-by="driver_start_date">Start Date</th>
          <th>Start Day</th>
          <th>Notes</th>
          <th>Current Status</th>
          <th>Current Location</th>
          <th>ETA to planned Load</th>
          <th data-table-sort-by="tentative_start_date">Tentative Start Date</th>
          <th>Planned Load</th>
          <th>Driver Started At</th>
          <th>Last Note</th>
          <th>Added By</th>
          <th>Last Updated</th>

          <th></th>
          <th>Reason of Cancelation</th>
        </tr>
      </thead>
      <tbody id="tabledata"></tbody>
    </table>

  </div>
  <div data-pagination></div>
</section>
<br><br>
<br><br>
<br><br>

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
    set_params('driver_start_date', this_mon + '/' + toda_date + '/' + this_year)
  }

  function show_active_date() {
    $('.driver_start_date').removeClass('active-date');
    $(`[data-date="${check_url_params('driver_start_date')}"]`).addClass('active-date')
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
      url: '../user/dispatch/long-haul-assignments/date-wise-total-drivers-ajax',
      type: 'POST',
      data: {
        driver_start_date_from: check_url_params('st_date'),
        driver_start_date_to: check_url_params('end_date'),
        lha_status_id: check_url_params('lha_status_id'),
        is_team_driver: check_url_params('is_team_driver'),
        driver_id: check_url_params('driver_id'),
        truck_id: check_url_params('truck_id'),
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          if (data.status) {
            var days = `<button class="left" style="background-color:#0552b0;"><<</button>&nbsp;&nbsp;`;
            $.each(data.response.list, function(index, item) {
              days += `<li style="border:1px solid grey" class="driver_start_date" data-date="${item.date}"><label><span style="font-weight:normal;font-style:italic">${item.short_date} ${item.week_day}</span> <span> &nbsp ${item.total_lha_drivers}</span></label></li>`;

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
  $(document.body).on('click', '.driver_start_date', function() {
    var dvr_start_date = $(this).data('date');
    set_params('driver_start_date', dvr_start_date);
    show_list();
  })
</script>
<!-- ---------END----END----------Date changing code by swaran END  END    END   here-------END----------END---------------END----------END------------------------------------- -->


<script type="text/javascript">
  // $('[data-filter="driver_start_date_from"]').val(check_url_params('driver_start_date_from'))
  // $('[data-filter="driver_start_date_to"]').val(check_url_params('driver_start_date_to'))
  $(`[data-filter='is_team_driver'] option[value="${check_url_params('is_team_driver')}"]`).prop('selected', true);
  $('[data-filter="driver_id"]').val(check_url_params('driver_id'))
  $('[data-search-driver]').val(check_url_params('driver_name'))
  $('[data-filter="truck_id"]').val(check_url_params('truck_id'))
  $('[data-search-trucks]').val(check_url_params('truck_name'))

  function show_list() {
    show_processing_modal()
    $.ajax({
      url: '../user/dispatch/long-haul-assignments-driver-wise-ajax',
      type: 'POST',
      data: {
        sort_by: $('#sort_by').val(),
        sort_by_order_type: $('#sort').val(),
        page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
        batch: (check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
        // driver_start_date_from: check_url_params('driver_start_date_from'),
        // driver_start_date_to: check_url_params('driver_start_date_to'),
        driver_start_date: check_url_params('driver_start_date'),
        lha_status_id: check_url_params('lha_status_id'),
        is_team_driver: check_url_params('is_team_driver'),
        driver_id: check_url_params('driver_id'),
        truck_id: check_url_params('truck_id'),
      },
      beforeSend: function() {
        show_table_data_loading("[data-my-table]")
      },
      complete: function() {
        hide_processing_modal()
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          $('#tabledata').html("");
          if (data.status) {
            $.each(data.response.list, function(index, item) {
              has_high_priority_note = (item.has_high_priority_note == 'YES') ? '<span class="ic exclamation" style="color:yellow;text-shadow: 2px 2px #FF0000;"></span>' : '';

              row_bg_class = ''
              if (item.lha_status == 'ASSIGNED') {
                row_bg_class = 'bg-mild-yellow'
              } else if (item.lha_status == 'UN-ASSIGNED') {
                row_bg_class = ''
              } else if (item.lha_status == 'IN-TRANSIT') {
                row_bg_class = 'bg-mild-green'
              } else if (item.lha_status == 'CANCELLED' || item.lha_status == 'REFUSED') {
                row_bg_class = 'bg-mild-red'
              }
              driver_b_display = (item.is_team_driver == false) ? 'none' : '';
              //team_checked=(item.is_team_driver=='')?'TEAM':'SOLO';
              driver_b_display = (item.is_team_driver == false) ? 'none' : '';
              pick_up_location = item.shipper.location;
              pick_up_time = item.shipper.time_from
              pick_up_date = (item.shipper.date != "") ? date_format(item.shipper.date) : ''

              if (item.shipper.time_to != item.shipper.time_from) {
                pick_up_time += ' -' + item.shipper.time_to

              }
              pick_up_time_bg_color = ""
              if (item.shipper.datetime_tbd == "YES") {
                pick_up_time = 'TBD';
                pick_up_time_bg_color = "bg-light-purple"
              }
              drop_location = item.consignee.location;
              drop_time = item.consignee.time_from
              drop_date = (item.consignee.date != "") ? date_format(item.consignee.date) : ''

              if (item.consignee.time_to != item.consignee.time_from) {
                drop_time += ' -' + item.consignee.time_to

              }
              drop_time_bg_color = ""
              if (item.consignee.datetime_tbd == "YES") {
                drop_time = 'TBD';
                drop_time_bg_color = "bg-light-purple"
              }
              pick_up_appointment_type = (item.shipper.appointment_type == 'FIRM') ? `<span class="icon-clock" style="font-size:.6em"></span>` : ''

              drop_appointment_type = (item.consignee.appointment_type == 'FIRM') ? `<span class="icon-clock" style="font-size:.6em"></span>` : ''


              var drops = []
              $.each(item.stops, function(index2, item2) {
                if (item2.type == 'DROP') {
                  drops.push(item2)
                  drop_location += '/ ' + item2.location
                } else if (item2.type == 'PICK') {
                  pick_up_location += '/ ' + item2.location
                }
              })
              var first_delivery_date = ""
              var first_delivery_time = ""
              var first_delivery_time_bg_color = ""

              if (drops[0]) {
                first_delivery_date = (drops[0].date != "") ? date_format(drops[0].date) : '';
                first_delivery_time = drops[0].time_from;
                if (drops[0].time_to != drops[0].time_from) {
                  first_delivery_time += ' -' + drops[0].time_to

                }
                if (drops[0].datetime_tbd == 'YES') {
                  first_delivery_time = 'TBD'
                  first_delivery_time_bg_color = "bg-light-purple"
                }
              }

              drop_at_shipper = (item.has_shipper_range == "YES") ? date_format(item.drop_at_shipper_date) : ''
              pick_from_consignee = (item.has_consignee_range == "YES") ? date_format(item.pick_at_consignee_date) : ''




              var row = `<tr id="row${item.id}" class="${row_bg_class}">
                    <td style="white-space:nowrap">${has_high_priority_note} ${item.sr_no}</td>
                    <td>${item.is_team_driver}</td>
                    <td style="white-space:nowrap">
                    <span class="text-link"  onclick="open_quick_view_driver('${item.driver_eid}')">${item.driver_code} ${item.driver_name}</span>`


              if (item.driver_b_eid != "") {
                row += `<br><span class="text-link"  onclick="open_quick_view_driver('${item.driver_b_eid}')">${item.driver_b_code} ${item.driver_b_name}</span>`
              }

              row += `</td>
                    <td><span class="text-link"  onclick="open_quick_view_truck('${item.truck_eid}')">${item.truck_code}</span></td>
                    <td>${item.driver_start_date}</td>
                    <td>${item.driver_start_day}</td>
                    <td style="max-width:200px">${item.driver_notes}</td>
                    <td style="max-width:150px">${item.driver_current_status}</td>
                    <td style="max-width:180px">${item.truck_location}<br>${item.truck_location_updated_on}</td>
                    <td>${item.driver_eta_to_planned_load}</td>
                    <td>${item.tentative_start_date}</td><td>`
              if (item.lha_status == 'UN-ASSIGNED') {
                row += `<i onclick="open_child_window({url:'../user/dispatch/long-haul-assignments/assign-load?lha-id=${item.id}&&tentative-start-date=${item.driver_start_date}',width:1200,height:500})" class="ic edit" title="Edit assigned load"></i>`
              } else if (item.lha_status == 'ASSIGNED' || item.lha_status == 'IN-TRANSIT') {
                row += ` <span class="text-link"  onclick="open_child_window({url:'../user/dispatch/express-loads/details?eid=` + item.planned_load_eid + `',width:1000,height:500})">${pick_up_location} TO ${drop_location} -  ${item.customer_code}  -  ${item.po_number}</span> <i class="ic cross" data-lha-eid="${item.eid}" data-action="un-assign-driver" title="Delete planned load"></i> `
              }

              row += `<td>`;
              if (item.lha_status == 'IN-TRANSIT') {
                row += item.driver_started_at_datetime;
              }
              if (item.lha_status == 'IN-TRANSIT' || item.lha_status == 'ASSIGNED') {
                row += ` <i onclick="open_child_window({url:'../user/dispatch/long-haul-assignments/update-driver-started-at-datetime?eid=` + item.eid + `',width:700,height:400})" class="ic edit" title="Update driver started datetime"></i>`
              }

              row += `</td>
                    <td>${item.last_note} <br> ${item.last_note_added_by}</td>
                    <td>${item.added_by_user_name}<br><span style="white-space:nowrap">${item.added_on_datetime}</span></td>
                    <td>${item.updated_by_user_name}<br><span style="white-space:nowrap">${item.updated_on_datetime}</span></td></td>
                    
                    <td style="white-space:nowrap" class="act-box">
                    <i class="fa fa-sticky-note" style="color:grey;cursor:pointer" title="LHA Notes"  onclick="open_child_window({url:'../user/dispatch/long-haul-assignments/notes?eid=${item.eid}',width:1050,height:500,name:'express-load-note'})"></i>

                    <a href="../user/dispatch/long-haul-assignments/history?eid=` + item.eid + `"><i class="ic history" title="View details"></i></a>
                    `;
              <?php if (in_array('DIS054', USER_PRIV)) {
              ?>
                row += `<i onclick="open_child_window({url:'../user/dispatch/long-haul-assignments/update?eid=` + item.eid + `',width:800,height:500})" class="ic edit" title="Edit basic info"></i>
                <i onclick="open_child_window({url:'../user/dispatch/long-haul-assignments/cancel?eid=` + item.eid + `',width:600,height:500,name:'cancel lha entry'})" class="ic delete" title="Set as Cancel/ Delete/ Denied"></i>
                `;
              <?php
              }
              ?>

              row += `</td><td style="max-width:150px">`


              if (item.lha_status == 'CANCELLED' || item.lha_status == 'REFUSED') {
                row += '<b>' + item.lha_status + ' </b>: ' + item.reason_of_cancelation
              }

              row += `</td>
              </tr>`;
              $('#tabledata').append(row);
            })
            set_pagination({
              selector: '[data-pagination]',
              totalPages: data.response.totalPages,
              currentPage: data.response.currentPage,
              batch: data.response.batch
            })
          } else {
            var false_message = `<tr><td colspan="18">` + data.message + `<td></tr>`;
            $('#tabledata').html(false_message);
          }
          calender_days()
        }

      }

    })
  }
  show_list()
</script>


<datalist id="quick_list_booked-by"></datalist>

<script type="text/javascript">
  /*
  $(document.body).on('change', '[name="quick_list_booked-by_search"]' ,function(){

     let booked-by_id_selected=$(`[data-booked-by-filter-rows="${$(this).val()}"]`).data('value');
     if(booked-by_id_selected!=undefined){
      $(this).data('selected-booked-by-id',booked-by_id_selected)
  }
});

*/
</script>




<script type="text/javascript">
  function sort_table() {
    show_list()
  }
</script>

<datalist id="quick_list_drivers_for_search"></datalist>

<script type="text/javascript">
  $(document.body).on('change', '[data-search-driver]', function() {
    driver_id_filter = $(`[data-driver-search-rows="${$(this).val()}"]`).data('value');
    if (driver_id_filter != undefined) {
      $('[data-filter="driver_id"]').val(driver_id_filter)
      set_params('driver_id', driver_id_filter);
      set_params('driver_name', $(this).val());
      goto_page(1);
      show_group_list()
    }
  });

  function bind_quick_list_drivers_in_search() {

    quick_list_drivers().then(function(data) {

      // Run this when your request was successful

      if (data.status) {



        //Run this if response has list

        if (data.response.list) {

          var options = "";

          options += `<option data-driver-search-rows="" data-value="" value="">- - Select - -</option>`

          $.each(data.response.list, function(index, item) {

            options += `<option data-driver-search-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" value="` + item.code + ' ' + item.name + `"></option>`;

          })

          $('#quick_list_drivers_for_search').html(options);

        }

      }

    }).catch(function(err) {

      // Run this when promise was rejected via reject()

    })
  }
  bind_quick_list_drivers_in_search()
</script>

<datalist id="quick_list_trucks_search"></datalist>

<script type="text/javascript">
  $(document.body).on('change', '[data-search-trucks]', function() {
    truck_id_filter = $(`[data-truck-search-rows="${$(this).val()}"]`).data('value');
    if (truck_id_filter != undefined) {
      $('[data-filter="truck_id"]').val(truck_id_filter)
      set_params('truck_id', truck_id_filter);
      set_params('truck_name', $(this).val());
      goto_page(1);
      show_group_list()
    }
  });

  quick_list_trucks().then(function(data) {
    // Run this when your request was successful

    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option data-truck-search-rows="" data-value="" value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {

          options += `<option data-truck-search-rows="` + item.code + `" data-value="${item.id}" value="` + item.code + `"></option>`;

        })

        $('#quick_list_trucks_search').html(options);

      }

    }

  })
</script>
<script type="text/javascript">
  get_location_regions().then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="` + item.id + `">` + item.name + `</option>`;
        })
        $('[data-filter="region_id"]').html(options);
        $("[data-filter='region_id'] option[value=" + check_url_params('region_id') + "]").prop('selected', true);
      }
    }

  }).catch(function(err) {
    // Run this when promise was rejected via reject()
  })
</script>

<datalist id="quick_list_trailer_search"></datalist>

<script type="text/javascript">
  $(document.body).on('change', '[data-search-trailer]', function() {
    trailer_id_filter = $(`[data-trailer-search-rows="${$(this).val()}"]`).data('value');
    if (trailer_id_filter != undefined) {
      $('[data-filter="trailer_id"]').val(trailer_id_filter)
      set_params('trailer_id', trailer_id_filter);
      set_params('trailer_name', $(this).val());
      goto_page(1);
      show_group_list()
    }
  });

  quick_list_trailers().then(function(data) {
    // Run this when your request was successful

    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option data-trailer-search-rows="" data-value="" value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {

          options += `<option data-trailer-search-rows="` + item.code + `" data-value="${item.id}" value="` + item.code + `"></option>`;

        })

        $('#quick_list_trailer_search').html(options);

      }

    }

  })
</script>

<datalist id="quick_list_booked_by_search"></datalist>

<script type="text/javascript">
  $(document.body).on('change', '[data-search-booked-by]', function() {
    booked_by_id_filter = $(`[data-booked-by-search-rows="${$(this).val()}"]`).data('value');
    if (booked_by_id_filter != undefined) {
      $('[data-filter="booked_by_id"]').val(booked_by_id_filter)
      set_params('booked_by_id', booked_by_id_filter);
      set_params('booked_by_name', $(this).val());
      goto_page(1);
      show_group_list()
    }
  });

  quick_list_users().then(function(data) {
    // Run this when your request was successful

    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option data-booked-by-search-rows="" data-value="" value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {

          options += `<option data-booked-by-search-rows="` + item.name + `" data-value="${item.id}" value="` + item.name + `"></option>`;

        })

        $('#quick_list_booked_by_search').html(options);

      }

    }

  })
</script>
<br><br><br>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on("click", "[data-action='un-assign-driver']", function() {
      if (confirm('Do you want to delete ?')) {
        $.ajax({
          url: '../user/dispatch/long-haul-assignments/un-assign-load-action',
          type: 'POST',
          data: {
            lha_eid: $(this).data('lha-eid')
          },
          context: this,
          success: function(data) {
            if ((typeof data) == 'string') {
              data = JSON.parse(data)
            }

            if (data.status) {
              show_list()
            } else {
              alert(data.message)
            }
          }
        })
      }

    });
  });
</script>
<script type="text/javascript">
  get_long_haul_assignment_status().then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="` + item.id + `">` + item.name + `</option>`;
        })
        $('[data-filter="lha_status_id"]').html(options);
        $("[data-filter='lha_status_id'] option[value=" + check_url_params('lha_status_id') + "]").prop('selected', true);
      }
    }

  }).catch(function(err) {
    // Run this when promise was rejected via reject()
  })
</script>
<br><br>
<br><br>
<br><br>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>