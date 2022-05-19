<?php require_once APPROOT . '/views/includes/user/header.php'; ?>
<style>
    .active-date {
        background: darkgrey;
        color: white;
    }
</style>
<section class="rv content-box" style="margin: auto;max-width: 1600px">
    <h1 class="rv-heading">Long Haul Assignement Load Wise</h1>
    <section class="rv-filter-section">
        <!-- input used for sory by call-->
        <input type="hidden" id="sort_by" value="">
        <!-- //input used for sory by call-->


        <div class="filter-item fourth">
            <label>Search</label>
            <input type="text" data-filter="search" placeholder="ID, PO, Customer name" onchange="set_params('search', this.value), goto_page(1)">

        </div>
        <div class="filter-item fourth">
            <label>Trailer</label>
            <input type="hidden" data-filter="trailer_id">
            <input type="text" list="quick_list_trailer_search" data-search-trailer>
        </div>
        <div class="filter-item fourth">
            <label>Pick Date From</label>
            <input type="text" data-date-picker="" data-filter="pick_up_date_from" onchange="set_params('pick_up_date_from', this.value), goto_page(1)" value="">
        </div>
        <div class="filter-item fourth">
            <label>Pick Date To</label>
            <input data-date-picker="" type="text" data-filter="pick_up_date_to" onchange="set_params('pick_up_date_to', this.value), goto_page(1)" value="" />
        </div>
        <div class="filter-item fourth">
            <label>Region</label>
            <select data-filter="region_id" onchange="set_params('region_id', this.value), goto_page(1)"></select>
        </div>
        <div class="filter-item fourth">
            <label>LHA Status</label>
            <select data-filter="lha_status_id" onchange="set_params('lha_status_id', this.value), goto_page(1)"></select>
        </div>
        <div class="filter-item fourth">
            <label>Delivery Date From</label>
            <input type="text" data-date-picker="" data-filter="delivery_date_from" onchange="set_params('delivery_date_from', this.value), goto_page(1)" value="">
        </div>
        <div class="filter-item fourth">
            <label>Delivery Date To</label>
            <input data-date-picker="" type="text" data-filter="delivery_date_to" onchange="set_params('delivery_date_to', this.value), goto_page(1)" value="" />
        </div>

    </section>
    <section class="rv-filter-buttons">
        <ul id="rv-filter-buttons-container"></ul>
        <div></div>
    </section>
    <section class="rv-filter-buttons">
        <ul id="rv-filter-buttons-container2" style="justify-content:center;margin:5px 0px 12px 0px;"></ul>
    </section>
    <div class="rv-table">
        <table data-my-table>
            <input type='hidden' id='sort' value='asc'>
            <thead>
                <tr>
                    <th data-table-sort-by="id">ID</th>
                    <th>Ten. Start Date</th>
                    <th>Type</th>
                    <th data-table-sort-by="customer_code">Cust.</th>
                    <th data-table-sort-by="po_number" style="text-align:right;white-space: nowrap;">PO No.</th>
                    <th>Pick Up</th>
                    <th>Delivery</th>
                    <th data-table-sort-by="shipper_date">Pick Up Date</th>
                    <th>Pick Up Time</th>
                    <th data-table-sort-by="first_delivery_datetime">First Delivery Date</th>
                    <th>First Delivery Time</th>
                    <th data-table-sort-by="consignee_date">Final Delivery Date</th>
                    <th>Final Delivery Time</th>
                    <th>Region</th>
                    <th data-table-sort-by="load_status_id">Status</th>
                    <th>Trailer</th>
                    <th>Assigned Driver</th>
                    <th>Assigned Truck</th>
                    <th>Truck location</th>
                    <th>Driver Started at</th>
                </tr>
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
        <div data-pagination></div>
    </div>
</section>

<!-- --------START---------------Date changing code by swaran START  START    START   here-------START----------START------------------------------- -->
<script type="text/javascript">
   var weekday = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
  var months = ["01","02","03","04","05","06","07","08","09","10","11","12"]
  // --------------this month, date and year-----------start here------------------------------
  var d = new Date();
  var this_month = d.getMonth();
  var this_mon = months[this_month];
  var today_date = d.getDate();
  var toda_date = ('0' + today_date).slice(-2);
  var this_year = d.getFullYear();
// --------------this month, date and year-----------end here--------------------------------------

//---------------------one day previuos date    start here-----------------------------------------
  d.setDate(d.getDate() -1);
  var date = d.getDate();
  var dd = ('0' + date).slice(-2);
  var mm = d.getMonth();
  var mmm = months[mm];
  var yy = d.getFullYear();
  //---------------------one day previuos date    end here--------------------------------------------
  // ------------six days next month,date and year from one date previous code start here-------------
  d.setDate(d.getDate() +6);
  var end_date = d.getDate();
  var end_dd = ('0' + end_date).slice(-2);
  var mont = d.getMonth();
  var month = months[mont];
  var year = d.getFullYear();
  //  ------------six days next month,date and year from one date previous code end here----------------
  
    var url_params = get_params();
  if (url_params.hasOwnProperty('st_date')) {} else {
    set_params('st_date', mmm+'/'+dd +'/'+yy)
    set_params('end_date', month+'/'+end_dd +'/'+year)
    set_params('tentative_start_date', this_mon+'/'+toda_date +'/'+this_year)
  }

    function show_active_date() {
        $('.tentative_start_date').removeClass('active-date');
        $(`[data-date="${check_url_params('tentative_start_date')}"]`).addClass('active-date')
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
            url: '../user/dispatch/long-haul-assignments/date-wise-total-loads-ajax',
            type: 'POST',
            data: {
                tentative_start_date_from: check_url_params('st_date'),
                tentative_start_date_to: check_url_params('end_date'),
                search: check_url_params('search'),
                pick_up_date_from: check_url_params('pick_up_date_from'),
                pick_up_date_to: check_url_params('pick_up_date_to'),
                delivery_date_from: check_url_params('delivery_date_from'),
                delivery_date_to: check_url_params('delivery_date_to'),
                trailer_id: check_url_params('trailer_id'),
                region_id: check_url_params('region_id'),
                lha_status_id: check_url_params('lha_status_id'),
                load_status_ids: active_status_id_array.toString()
            },
            success: function(data) {
                console.log(data)
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    if (data.status) {
                        var days = `<button class="left" style="background-color:#0552b0;"><<</button>&nbsp;&nbsp;`;
                        $.each(data.response.list, function(index, item) {
                            days += `<li style="border:1px solid grey" class="tentative_start_date" data-date="${item.date}"><label><span style="font-weight:normal;font-style:italic">${item.short_date} ${item.week_day}</span> <span> &nbsp ${item.total_loads}</span></label></li>`;

                        })
                        days += `&nbsp;&nbsp;<button class="right" style="background-color:#0552b0;">>></button>`;
                        $('#rv-filter-buttons-container2').html(days)

                        show_active_date()
                    }

                }

            }
        })
    }

</script>
<script type="text/javascript">
    $(document.body).on('click', '.tentative_start_date', function() {
        var tnt_start_date = $(this).data('date');
        set_params('tentative_start_date', tnt_start_date);
        show_list();
    })
</script>
<!-- ---------END----END----------Date changing code by swaran END  END    END   here-------END----------END---------------END----------END------------------------------------- -->





<script type="text/javascript">
    $('[data-filter="search"]').val(check_url_params('search'))
    $('[data-filter="pick_up_date_from"]').val(check_url_params('pick_up_date_from'))
    $('[data-filter="pick_up_date_to"]').val(check_url_params('pick_up_date_to'))
    $('[data-filter="delivery_date_from"]').val(check_url_params('delivery_date_from'))
    $('[data-filter="delivery_date_to"]').val(check_url_params('delivery_date_to'))
    $('[data-filter="trailer_id"]').val(check_url_params('trailer_id'))
    $('[data-search-trailer]').val(check_url_params('trailer_name'))

    function show_list() {
        show_processing_modal()
        $.ajax({
            url: '../user/dispatch/long-haul-assignments-load-wise-ajax',
            type: 'POST',
            data: {
                sort_by: $('#sort_by').val(),
                sort_by_order_type: $('#sort').val(),
                page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
                batch: (check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
                search: check_url_params('search'),
                pick_up_date_from: check_url_params('pick_up_date_from'),
                pick_up_date_to: check_url_params('pick_up_date_to'),
                delivery_date_from: check_url_params('delivery_date_from'),
                delivery_date_to: check_url_params('delivery_date_to'),
                trailer_id: check_url_params('trailer_id'),
                region_id: check_url_params('region_id'),
                lha_status_id: check_url_params('lha_status_id'),
                tentative_start_date: check_url_params('tentative_start_date'),
                webapi: 'pagination',
                load_status_ids: active_status_id_array.toString()
            },
            beforeSend: function() {
                show_table_data_loading("[data-my-table]")
            },
            complete: function() {
                hide_processing_modal()
            },
            success: function(data) {
                console.log(data)
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    $('#tabledata').html("");
                    if (data.status) {
                        var counter = 0;
                        $.each(data.response.list, function(index, item) {

                            row_bg_class = ''
                            if (item.lha_status == 'ASSIGNED') {
                                row_bg_class = 'bg-mild-yellow'
                            } else if (item.lha_status == 'UN-ASSIGNED') {
                                row_bg_class = ''
                            } else if (item.lha_status == 'IN-TRANSIT') {
                                row_bg_class = 'bg-mild-green'
                            }
                            is_high_priority_note = (item.high_priority_note == 'YES') ? '<span class="ic exclamation" style="color:yellow;text-shadow: 2px 2px #FF0000;"></span>' : '';
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

                            var temperature_to_maintain = (item.temperature_as_per_shipper == 'YES') ? 'As Per Shipper' : item.temperature_to_maintain + '<br>' + item.reefer_mode


                            var row = `<tr id="row${item.id}" class="${row_bg_class}">
                        <td style="white-space:nowrap">
                        <a class="text-link" href="../user/dispatch/express-loads/details?eid=` + item.eid + `">${is_high_priority_note} ${item.id}</a></td>
                        <td style="white-space:nowrap">${item.tentative_start_date} <i onclick="open_child_window({url:'../user/dispatch/express-loads/quick-update-tentative-start-date?id=${item.id}&eid=${item.eid}&tentative-start-date=${item.tentative_start_date}',width:500,height:500,name:'update-ex-load-tentative-start-date'})" class="ic edit" title="Edit tentative start date"></i></td>
                        <td>${item.load_type_abbr}</td>
                        <td><span class="tooltip">${item.customer_code}<span class="tooltiptext">${item.customer_name}</span></span></td>
                        <td style="text-align:right;">${item.po_number}</td>
                        <td style="text-align:left; white-space:nowrap">${pick_up_location} ${pick_up_appointment_type}</td>
                        <td style="text-align:left; white-space:nowrap">${drop_location} ${drop_appointment_type}</td>
                        <td style="white-space:nowrap">${pick_up_date}</td>
                        <td style="white-space:nowrap" class="${pick_up_time_bg_color}">${pick_up_time}</td>
                        <td style="white-space:nowrap">${first_delivery_date}</td>
                        <td style="white-space:nowrap" class="${first_delivery_time_bg_color}">${first_delivery_time}</td>
                        <td style="white-space:nowrap">${drop_date}</td>
                        <td style="white-space:nowrap" class="${drop_time_bg_color}">${drop_time}</td>
                        <td>${item.shipper_region}</td>
                        <td>${item.status_id}</td>`
                            if (item.alloted_trailer_eid != "") {
                                row += `<td><span class="text-link"  onclick="open_quick_view_trailer('${item.trailer_eid}')">${item.trailer_code}</span></td>
                            `
                            } else {
                                row += `<td></td>`;
                            }

                            row += `<td style="white-space:nowrap;background:white">
                        <span class="text-link"  onclick="open_quick_view_driver('${item.driver_eid}')">${item.driver_code} ${item.driver_name}</span>`


                            if (item.driver_b_eid != "") {
                                row += `<br><span class="text-link"  onclick="open_quick_view_driver('${item.driver_b_eid}')">${item.driver_b_code} ${item.driver_b_name}</span>`
                            }
                            if (item.lha_status == 'ASSIGNED' || item.lha_status == 'IN-TRANSIT') {
                                row += `<i class="ic cross" data-lha-eid="${item.lha_eid}" data-action="un-assign-driver" title="Delete assigned driver"></i>`
                            } else if (item.lha_status == 'UN-ASSIGNED') {
                                row += `<i onclick="open_child_window({url:'../user/dispatch/long-haul-assignments/assign-driver-truck?id=` + item.id + `&driver-start-date=${item.tentative_start_date}',width:1200,height:500})" class="ic edit" title="Edit assigned driver/truck"></i>`
                            }
                            row += `</td>`
                            if (item.alloted_truck_id != "") {
                                row += `<td style="background:white"><span class="text-link"  onclick="open_quick_view_truck('${item.assigned_truck_eid}')">${item.assigned_truck_code}</span></td>
                            <td style="background:white">${item.assigned_truck_location}<br>${item.assigned_truck_location_updated_on}</td>`
                            } else {
                                row += `<td></td><td></td>`;
                            }

                            //  if(item.lha_status=='ASSIGNED'){
                            //     row+=` <i class="ic cross" data-lha-eid="${item.lha_eid}" data-action="un-assign-driver" title="Delete assigned driver"></i>`                      
                            // }else if(item.lha_status=='UN-ASSIGNED'){
                            //     row+=` <i onclick="open_child_window({url:'../user/dispatch/long-haul-assignments/assign-driver-truck?id=`+item.id+`',width:1200,height:500})" class="ic edit" title="Edit assigned driver/truck"></i>` 
                            // }
                            row += `<td style="background:white">`;
                            if (item.lha_status == 'IN-TRANSIT') {
                                row += item.driver_started_at_datetime;
                            }
                            if (item.lha_status == 'IN-TRANSIT' || item.lha_status == 'ASSIGNED') {
                                row += ` <i onclick="open_child_window({url:'../user/dispatch/long-haul-assignments/update-driver-started-at-datetime?eid=` + item.lha_eid + `',width:700,height:400})" class="ic edit" title="Update driver started datetime"></i>`
                            }
                            row += `</td>`

                            row += `</tr>`;
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
</script>

<script type="text/javascript">
    function sort_table() {
        show_list()
    }
</script>
<script type="text/javascript">
    function get_load_row_bg(status_id) {
        switch (status_id) {
            case 'ALLOCATED':
                row_bg_class = 'bg-mild-grey';
                break;
            case 'DISPATCHED':
                row_bg_class = 'bg-mild-yellow';
                break;
            case 'PICKED':
                row_bg_class = 'bg-mild-green';
                break;
            case 'AT SITE':
                row_bg_class = 'bg-mild-blue';
                break;
            case 'BOUNCED':
                row_bg_class = 'bg-mild-red';
                break;
            case 'CANCELLED':
                row_bg_class = 'bg-mild-red';
                break;
            case 'TONU':
                row_bg_class = 'bg-cyan';
                break;
            case 'UNDER DECISION':
                row_bg_class = 'bg-light-red';
                break;
            default:
                row_bg_class = ''
                break
        }
        return row_bg_class;
    }
</script>

<script type="text/javascript">
    var active_status_id_array = ['NEW', 'AT SITE', 'UNDER DECISION', 'ALLOCATED', 'ON DOCK', 'DISPATCHED'];
    $('#rv-filter-buttons-container').html("");

    function show_load_status_groups() {
        get_load_status({load_status_belongs_to:'LHA'}).then(function(data) {

            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    $.each(data.response.list, function(index, item) {
                        let checked = (active_status_id_array.includes(item.id)) ? 'checked' : ''
                        $('#rv-filter-buttons-container').append(`<li data-group-selector-button class="` + get_load_row_bg(item.id) + `"><label><input type="checkbox" data-status-id-group ${checked} value="${item.id}"><span> ${item.name}</span></label></li>`);
                    })
                    bind_regions()

                }
            }

        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_load_status_groups()
</script>

<script type="text/javascript">
    //---select or deselect group button checkboxes
    $(document.body).on('click', '[data-group-selector-button]', function() {
        $(this).children("input").click()
        active_status_id_array = [];
        $('[data-status-id-group]:checked').each(function() {
            active_status_id_array.push($(this).val())

        })
        show_list()
    });
    //---/select or deselect group button checkboxes
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", "[data-action='choose-exp-load']", function() {

            $.ajax({
                url: '../user/dispatch/long-haul-assignments/assign-load-action',
                type: 'POST',
                data: {
                    lha_eid: check_url_params('eid'),
                    express_load_id: $(this).data("express-load-id")
                },
                context: this,
                success: function(data) {
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                    }

                    if (data.status) {
                        window.opener.show_list()
                        window.close();
                    } else {
                        alert(data.message)
                    }
                }
            })

        });
    });
</script>
<br><br><br>
<script type="text/javascript">
    function bind_regions() {
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
                    if (check_url_params('region_id') == '') {
                        $("[data-filter='region_id'] option[value='2']").prop('selected', true);
                    } else {
                        $("[data-filter='region_id'] option[value=" + check_url_params('region_id') + "]").prop('selected', true);
                    }
                    show_list()
                }
            }

        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
</script>
<script type="text/javascript">
    //    get_load_status().then(function(data) {
    //   // Run this when your request was successful
    //   if(data.status){
    //     //Run this if response has list
    //     if(data.response.list){
    //       var options="";
    //       options+=`<option value="">- - Select - -</option>`
    //       $.each(data.response.list, function(index, item) {
    //         options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
    //     })
    //       $('[data-filter="load_status_id"]').html(options);
    //       $("[data-filter='load_status_id'] option[value=" + check_url_params('load_status_id') + "]").prop('selected', true);     
    //   }
    // }

    // }).catch(function(err) {
    //   // Run this when promise was rejected via reject()
    // }) 
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
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>