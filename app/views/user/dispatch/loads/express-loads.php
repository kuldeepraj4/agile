<?php
require_once APPROOT . '/views/includes/user/header.php';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
?>
<section class="rv content-box" style="margin: auto;max-width: 1600px">
    <h1 class="rv-heading">Express Loads</h1>
    <section class="rv-action-bar">
        <?php
        if (in_array('P0175', USER_PRIV)) {
        ?>
            <button class='btn_blue' onclick="open_child_window({url:'../user/dispatch/express-loads/add-new',width:1400,height:500,name:'create-express-load'})">Add New</button>
        <?php
        }
        ?>
        <div class="form-group col-md-12 mb-0 row justify-content-end">
            <div class="col-md-3">
                <button class='btn_green' data-button-export-to-excel onclick="proceedExportRequest()" style="background: rgb(29, 111, 66) none repeat scroll 0% 0%; color: rgb(255, 255, 255);"><i class="fas fa-file-excel"></i> Excel</button>
            </div>
        </div>
    </section>
    <section class="rv-filter-section">
        <!-- input used for sory by call-->
        <input type="hidden" id="sort_by" value="">
        <!-- //input used for sory by call-->
        <div class="filter-item fourth">
            <label>Search</label>
            <input type="text" data-filter="search" placeholder="ID, PO, Customer name" onchange="set_params('search', this.value), goto_page(1),show_group_list()">
        </div>
        <div class="filter-item fourth">
            <label>Team/Solo</label>
            <select data-filter="is_team_driver" onchange="set_params('is_team_driver', this.value), goto_page(1),show_group_list()">
                <option value="">ALL</option>
                <option value="TEAM">Team</option>
                <option value="SOLO">Solo</option>
            </select>
        </div>
        <div class="filter-item fourth">
            <label>Pick Date From</label>
            <input type="text" data-date-picker="" data-filter="pick_up_date_from" onchange="set_params('pick_up_date_from', this.value), goto_page(1),show_group_list()" value="<?php echo date('m/d/Y', strtotime('-1 day')) ?>">
        </div>
        <div class="filter-item fourth">
            <label>Pick Date To</label>
            <input data-date-picker="" type="text" data-filter="pick_up_date_to" onchange="set_params('pick_up_date_to', this.value), goto_page(1),show_group_list()" value="<?php echo date('m/d/Y', strtotime('+15 day')) ?>" />
        </div>
        <div class="filter-item fourth">
            <label>Region</label>
            <select data-filter="region_id" onchange="set_params('region_id', this.value), goto_page(1),show_group_list()"></select>
        </div>
        <div class="filter-item fourth">
            <label>Pick up Zone</label>
            <select data-filter="zone_id" onchange="set_params('zone_id', this.value), goto_page(1),show_group_list()"></select>
        </div>
        <div class="filter-item fourth">
            <label>Delivery Date From</label>
            <input type="text" data-date-picker="" data-filter="delivery_date_from" onchange="set_params('delivery_date_from', this.value), goto_page(1),show_group_list()">
        </div>
        <div class="filter-item fourth">
            <label>Delivery Date To</label>
            <input data-date-picker="" type="text" data-filter="delivery_date_to" onchange="set_params('delivery_date_to', this.value), goto_page(1),show_group_list()" />
        </div>
        <div class="filter-item fourth">
            <label>Driver</label>
            <input type="hidden" data-filter="driver_id">
            <input type="text" list="quick_list_drivers_for_search" data-search-driver />
        </div>
        <div class="filter-item fourth">
            <label>Truck</label>
            <input type="hidden" data-filter="truck_id">
            <input type="text" list="quick_list_trucks_search" data-search-trucks>
        </div>
        <div class="filter-item fourth">
            <label>Trailer</label>
            <input type="hidden" data-filter="trailer_id">
            <input type="text" list="quick_list_trailer_search" data-search-trailer>
        </div>
        <div class="filter-item fourth">
            <label>Booked By</label>
            <input type="hidden" data-filter="booked_by_id">
            <input type="text" list="quick_list_booked_by_search" data-search-booked-by>
        </div>
        <div class="filter-item fourth">
            <label>Load Type</label>
            <select data-filter="load_type_id" onchange="set_params('load_type_id', this.value), goto_page(1),show_group_list()">
                <option value="">- - Select - -</option>
                <option value="LOT01">Truck Load</option>
                <option value="LOT02">Power Only</option>
                <option value="LOT03">Drop & Hook</option>
            </select>
        </div>
        <div class="filter-item fourth"></div>
        <div class="filter-item fourth"></div>
        <div class="filter-item fourth"></div>
    </section>
    <section class="rv-filter-buttons">
        <ul id="rv-filter-buttons-container"></ul>
        <div></div>
    </section>
    <div class="rv-table">
        <table data-my-table>
            <input type='hidden' id='sort' value='asc'>
            <thead>
                <tr>
                    <th data-table-sort-by="id">ID</th>
                    <th>Truck</th>
                    <th>Trailer</th>
                    <th>Driver</th>
                    <th>Status</th>
                    <th data-table-sort-by="customer_code">Cust.</th>
                    <th data-table-sort-by="po_number" style="text-align:right;white-space: nowrap;">PO No.</th>
                    <th>Pick Up</th>
                    <th>Delivery</th>
                    <th>Drop at Shipper</th>
                    <th data-table-sort-by="shipper_date">Pick Up Date</th>
                    <th>Pick Up Time</th>
                    <th data-table-sort-by="first_delivery_datetime">First Delivery Date</th>
                    <th>First Delivery Time</th>
                    <th data-table-sort-by="consignee_date">Final Delivery Date</th>
                    <th>Final Delivery Time</th>
                    <th>Pick From Consignee</th>
                    <th data-table-sort-by="trailer_type">Trailer <br>Type</th>
                    <th>Reefer Temp.</th>
                    <th>Type</th>
                    <th>Is Team ?</th>
                    <th>Zone</th>
                    <th data-table-sort-by="region_name">Region</th>
                    <th>Rate</th>
                    <th>Booked By</th>
                    <th>Received On</th>
                    <th>ROC</th>
                    <th>ROC Remarks</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
    </div>
    <div data-pagination></div>
</section>
<script type="text/javascript">
    var active_status_id_array = ['NEW', 'AT SITE', 'UNDER DECISION', 'TONU', 'ALLOCATED', 'ON DOCK', 'DISPATCHED']

    function show_group_list() {
        $.ajax({
            url: 'user/dispatch/express-loads-load-status-wise-list-ajax',
            type: 'POST',
            data: {
                search: check_url_params('search'),
                pick_up_date_from: check_url_params('pick_up_date_from'),
                pick_up_date_to: check_url_params('pick_up_date_to'),
                delivery_date_from: check_url_params('delivery_date_from'),
                delivery_date_to: check_url_params('delivery_date_to'),
                driver_id: check_url_params('driver_id'),
                truck_id: check_url_params('truck_id'),
                trailer_id: check_url_params('trailer_id'),
                region_id: check_url_params('region_id'),
                zone_id: check_url_params('zone_id'),
                load_type_id: check_url_params('load_type_id'),
                booked_by: check_url_params('booked_by_id'),
                is_team_driver: check_url_params('is_team_driver'),
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    $('#rv-filter-buttons-container').html("");
                    if (data.status) {
                        var counter = 1;
                        $.each(data.response.list, function(index, item) {
                            let checked = (active_status_id_array.includes(item.load_status_id)) ? 'checked' : ''
                            $('#rv-filter-buttons-container').append(`<li data-group-selector-button class="` + get_load_row_bg(item.load_status_id) + `"><label><input type="checkbox" data-status-id-group ${checked} value="${item.load_status_id}"><span> ${item.load_status_name}</span> <span> ${item.total_express_loads}</span></label></li>`);
                        })
                    }
                }
            }
        })
    }
    show_group_list()
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
    $('[data-filter="search"]').val(check_url_params('search'))
    $(`[data-filter='is_team_driver'] option[value="${check_url_params('is_team_driver')}"]`).prop('selected', true);
    $(`[data-filter='load_type_id'] option[value="${check_url_params('load_type_id')}"]`).prop('selected', true);
    $('[data-filter="pick_up_date_from"]').val(check_url_params('pick_up_date_from'))
    $('[data-filter="pick_up_date_to"]').val(check_url_params('pick_up_date_to'))
    $('[data-filter="delivery_date_from"]').val(check_url_params('delivery_date_from'))
    $('[data-filter="delivery_date_to"]').val(check_url_params('delivery_date_to'))
    $('[data-filter="driver_id"]').val(check_url_params('driver_id'))
    $('[data-search-driver]').val(check_url_params('driver_name'))
    $('[data-filter="truck_id"]').val(check_url_params('truck_id'))
    $('[data-search-trucks]').val(check_url_params('truck_name'))
    $('[data-filter="trailer_id"]').val(check_url_params('trailer_id'))
    $('[data-search-trailer]').val(check_url_params('trailer_name'))
    $('[data-filter="booked_by_id"]').val(check_url_params('booked_by_id'))
    $('[data-search-booked-by]').val(check_url_params('booked_by_name'))
    //---create array of selected staus types         
    function show_list() {
        show_processing_modal()
        $.ajax({
            url: '../user/dispatch/express-loads-ajax',
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
                driver_id: check_url_params('driver_id'),
                truck_id: check_url_params('truck_id'),
                trailer_id: check_url_params('trailer_id'),
                region_id: check_url_params('region_id'),
                zone_id: check_url_params('zone_id'),
                load_type_id: check_url_params('load_type_id'),
                booked_by: check_url_params('booked_by_id'),
                is_team_driver: check_url_params('is_team_driver'),
                status_ids: active_status_id_array.toString(),
                webapi: 'pagination',
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
                        var counter = 1;
                        $.each(data.response.list, function(index, item) {
                            row_bg_class = get_load_row_bg(item.status_id)
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
                            drop_location = '';
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
                            drop_location += '/ ' +item.consignee.location;
                            drop_location = drop_location.replace(/(^\/)/gi, "")
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
                            show_t=(item.is_team_driver=='TEAM')?'T':'';
                            var row = `<tr id="row${item.id}" class="${row_bg_class}">
                        <td style="white-space:nowrap" class="bg-white">
                        <a class="text-link"  href="../user/dispatch/express-loads/details?eid=` + item.eid + `">${is_high_priority_note} ${item.id}</a> </td>`
                            if (item.alloted_truck_eid != "") {
                                row += `<td class="bg-white"><span class="text-link"  onclick="open_quick_view_truck('${item.alloted_truck_eid}')">${item.alloted_truck_code}</span></td>`
                            } else {
                                row += `<td class="bg-white"></td>`;
                            }
                            if (item.alloted_trailer_eid != "") {
                                row += `<td class="bg-white"><span class="text-link"  onclick="open_quick_view_trailer('${item.alloted_trailer_eid}')">${item.alloted_trailer_code}</span></td>`
                            } else {
                                row += `<td class="bg-white"></td>`;
                            }
                            row += `
                        <td style="white-space:nowrap" class="bg-white">`
                            if (item.alloted_driver_eid != "") {
                                row += `<b>${show_t}</b> <span class="text-link"  onclick="open_quick_view_driver('${item.alloted_driver_eid}')">${item.alloted_driver_code} ${item.alloted_driver_name}</span>`
                            }
                            if (item.alloted_driver_b_eid != "") {
                                row += `<br><span class="text-link"  onclick="open_quick_view_driver('${item.alloted_driver_b_eid}')">${item.alloted_driver_b_code} ${item.alloted_driver_b_name}</span>`
                            }
                            row += `</td>`
                            row += `<td class="text-link" style="font-weight:bolder;color:black;" onclick="open_child_window({url:'../user/dispatch/express-loads/operation-info-update&eid=${item.eid}',width:700,height:500})">${item.status_id}</td><td><span class="tooltip">${item.customer_code}<span class="tooltiptext">${item.customer_name}</span></span></td>
                            <td>`;
                            if (item.roc_file != "") {
                                row += `<span style="text-align:right;font-weight:bolder;cursor:pointer;" onclick="open_document('${item.roc_file}')">${item.po_number}</span>`;
                            } else {
                                row += `<span style="text-align:right;">${item.po_number}</span>`;
                            }
                            row += `</td><td style="text-align:left;font-weight:bold;min-width: 150px;max-width:151px;overflow-wrap: break-word;" title='click copy load details' data-copy-to-clipboard="${pick_up_location} to ${drop_location} - ${item.customer_code} - ${item.po_number}">${pick_up_location} ${pick_up_appointment_type}</td>
                        <td style="text-align:left;min-width:120px;max-width:121px;overflow-wrap: break-word;">${drop_location} ${drop_appointment_type}</td>
                        <td style="white-space:nowrap">${drop_at_shipper}</td>
                        <td style="white-space:nowrap">${pick_up_date}</td>
                        <td style="white-space:nowrap" class="${pick_up_time_bg_color}">${pick_up_time}</td>
                        <td style="white-space:nowrap">${first_delivery_date}</td>
                        <td style="white-space:nowrap" class="${first_delivery_time_bg_color}">${first_delivery_time}</td>
                        <td style="white-space:nowrap">${drop_date}</td>
                        <td style="white-space:nowrap" class="${drop_time_bg_color}">${drop_time}</td>
                        <td>${pick_from_consignee}</td>
                        <td>${item.trailer_type}</td>
                        <td> ${temperature_to_maintain} </td>`
                            row += `
                        <td>${item.load_type_abbr}</td>
                        <td style="width:30px;">${item.is_team_driver}</td>
                        <td>${item.shipper_zone}</td>
                        <td>${item.shipper_region}</td>
                        <td>${item.rate}</td>
                        <td style="text-align:left" class="bg-white">${item.booked_by_user}
                        </td>
                        <td class="bg-white">${item.received_on_datetime}</td>
                        <td style="width:30px; white-space:nowrap"  class="act-box bg-white">`
                            if (item.roc_file != "") {
                                row += `
                            <i class="ic file" style="color:grey" title="View PO"  onclick="open_document('${item.roc_file}')"></i>
                            <i class="ic upload" style="color:grey" title="Update PO"  onclick="open_child_window({url:'../user/dispatch/express-loads/document-update-roc-file&eid=${item.eid}',width:600,height:500})"></i>`
                            } else {
                                row += `
                            <i class="ic no-icon"></i>
                            <i class="ic upload" style="color:grey" title="Update PO"  onclick="open_child_window({url:'../user/dispatch/express-loads/document-update-roc-file&eid=${item.eid}',width:600,height:500})"></i>
                            `
                            }
                            row += `</td>
                        <td class="bg-white">${item.roc_remarks}</td>
                        <td style="white-space:nowrap" class="act-box bg-white">
                        <i class="fa fa-sticky-note" style="color:grey;cursor:pointer" title="Notes"  onclick="open_child_window({url:'../user/dispatch/express-loads/notes?eid=${item.eid}',width:1050,height:500,name:'express-load-note'})"></i>
                        <a href="../user/dispatch/express-loads/details?eid=` + item.eid + `"><i class="ic view" title="View details"></i></a>
                        <i class="ic truck" style="color:grey" title="Update opreration info"  onclick="open_child_window({url:'../user/dispatch/express-loads/operation-info-update&eid=${item.eid}',width:700,height:500})"></i>
                        <i class="ic booking" title="Update booking info"  onclick="open_child_window({url:'../user/dispatch/express-loads/booking-info-update&eid=${item.eid}',width:700,height:500})"></i>
                        `;
                            <?php if (in_array('P0177', USER_PRIV)) {
                            ?>
                                row += `<i onclick="open_child_window({url:'../user/dispatch/express-loads/update?eid=` + item.eid + `',width:1400,height:500,name:'edit-express-load'})" class="ic edit" title="Edit basic info"></i>`;
                            <?php
                            }
                            ?>
                            row += `</td></tr>`;
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
<script type="text/javascript">
    get_location_zones_quick_list().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
            //Run this if response has list
            if (data.response.list) {
                var options = "";
                options += `<option value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option value="` + item.id + `">` + item.name + `</option>`;
                })
                $('[data-filter="zone_id"]').html(options);
                $("[data-filter='zone_id'] option[value=" + check_url_params('zone_id') + "]").prop('selected', true);
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
    $(document.body).on('click', '[data-copy-to-clipboard]', function() {
        copyToClipboard($(this).data('copy-to-clipboard'))
    });
</script>
<div id="reportSection"></div>
<script type="text/javascript">
    function proceedExportRequest(param2) {
        param1 = {}
        let param = Object.assign(param1, param2);
        if (param.hasOwnProperty('filetype') == false) {
            param.filetype = 'CSV';
        }
        var sort_by = $('#sort_by').val();
        $.ajax({
            url: '../user/dispatch/express-loads-excel-ajax',
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
                driver_id: check_url_params('driver_id'),
                truck_id: check_url_params('truck_id'),
                trailer_id: check_url_params('trailer_id'),
                region_id: check_url_params('region_id'),
                zone_id: check_url_params('zone_id'),
                load_type_id: check_url_params('load_type_id'),
                booked_by: check_url_params('booked_by_id'),
                is_team_driver: check_url_params('is_team_driver'),
                status_ids: active_status_id_array.toString(),
                webapi: 'pagination',
            },
            beforeSend: function() {
                show_processing_modal();
                $('#reportSection').show();
                $('#reportSection').html(`<table id="reportTable"><thead><tr>
            <th>ID</th>
            <th>Region</th>
            <th>Type</th>
            <th>Cust.</th>
            <th>PO No.</th>
            <th>Pick Up</th>
            <th>Delivery</th>
            <th>Drop at Shipper</th>
            <th>Pick Up Date</th>
            <th>Pick Up Time</th>
            <th>First Delivery Date</th>
            <th>First Delivery Time</th>
            <th>Final Delivery Date</th>
            <th>Final Delivery Time</th>
            <th>Pick From Consignee</th>
            <th>Pick Up Zone</th>
            <th>Trailer <br>Type</th>
            <th>Reefer Temp.</th>
            <th>Rate</th>
            <th>Status</th>
            <th>Truck</th>
            <th>Trailer</th>
            <th>Is Team ?</th>
            <th>Driver</th>
            <th>Booked By</th>
            <th>Received On</th>
            <th>RC</th>                
            </tr>                       
            </thead>
            <tbody id="reportTableBody"></tbody></table>`);
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    if (data.status) {
                        var counter = 1;
                        $.each(data.response.list, function(index, item) {
                            row_bg_class = get_load_row_bg(item.status_id)
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
                <a class="text-link" href="../user/dispatch/express-loads/details?eid=` + item.eid + `">${is_high_priority_note} ${item.id}</a> </td>
                <td>${item.shipper_region}</td>
                <td>${item.load_type_abbr}</td>
                <td>${item.customer_name}</td>
                <td style="text-align:right;">${item.po_number}</td>
                <td style="text-align:left; white-space:nowrap;font-weight:bold" title='click copy load details' data-copy-to-clipboard="${pick_up_location} to ${drop_location} - ${item.customer_code} - ${item.po_number}">${pick_up_location} ${pick_up_appointment_type}</td>
                <td style="text-align:left; white-space:nowrap">${drop_location} ${drop_appointment_type}</td>
                <td style="white-space:nowrap">${drop_at_shipper}</td>
                <td style="white-space:nowrap">${pick_up_date}</td>
                <td style="white-space:nowrap" class="${pick_up_time_bg_color}">${pick_up_time}</td>
                <td style="white-space:nowrap">${first_delivery_date}</td>
                <td style="white-space:nowrap" class="${first_delivery_time_bg_color}">${first_delivery_time}</td>
                <td style="white-space:nowrap">${drop_date}</td>
                <td style="white-space:nowrap" class="${drop_time_bg_color}">${drop_time}</td>
                <td>${pick_from_consignee}</td>
                <td>${item.shipper_zone}</td>
                <td>${item.trailer_type}</td>
                <td> ${temperature_to_maintain} </td>
                <td>${item.rate}</td>
                <td>${item.status_id}</td>`
                            if (item.alloted_truck_eid != "") {
                                row += `<td class="bg-white"><span class="text-link"  onclick="open_quick_view_truck('${item.alloted_truck_eid}')">${item.alloted_truck_code}</span></td>`
                            } else {
                                row += `<td class="bg-white"></td>`;
                            }
                            if (item.alloted_trailer_eid != "") {
                                row += `<td class="bg-white"><span class="text-link"  onclick="open_quick_view_trailer('${item.alloted_trailer_eid}')">${item.alloted_trailer_code}</span></td>`
                            } else {
                                row += `<td class="bg-white"></td>`;
                            }
                            row += `
                <td style="white-space:nowrap" class="bg-white">`
                            if (item.alloted_driver_eid != "") {
                                row += `<span class="text-link"  onclick="open_quick_view_driver('${item.alloted_driver_eid}')">${item.alloted_driver_code} ${item.alloted_driver_name}</span>`
                            }
                            if (item.alloted_driver_b_eid != "") {
                                row += `<br><span class="text-link"  onclick="open_quick_view_driver('${item.alloted_driver_b_eid}')">${item.alloted_driver_b_code} ${item.alloted_driver_b_name}</span>`
                            }
                            row += `</td><td style="width:30px;" class="bg-white">${item.is_team_driver}</td>
                <td style="text-align:left" class="bg-white">${item.booked_by_user}
                </td>
                <td class="bg-white">${item.received_on_datetime}</td>
                <td style="width:30px; white-space:nowrap"  class="act-box bg-white">`
                            if (item.roc_file != "") {
                                row += `
                    <i class="ic file" style="color:grey" title="View PO"  onclick="open_document('${item.roc_file}')"></i>
                    <i class="ic upload" style="color:grey" title="Update PO"  onclick="open_child_window({url:'../user/dispatch/express-loads/document-update-roc-file&eid=${item.eid}',width:600,height:500})"></i>`
                            } else {
                                row += `
                    <i class="ic no-icon"></i>
                    <i class="ic upload" style="color:grey" title="Update PO"  onclick="open_child_window({url:'../user/dispatch/express-loads/document-update-roc-file&eid=${item.eid}',width:600,height:500})"></i>
                    `
                            }
                            row += `</td></tr>`;
                            $('#reportTableBody').append(row);
                        })
                        /*$('#reportTableBody').append(row);
            // default action is 'download'
        })*/
                        if (param.filetype == 'CSV') {
                            $('#reportTable').first().table2csv({
                                filename: 'express-loads.csv'
                            });
                        }
                        $('#reportSection').hide();
                        hide_processing_modal()
                        ///--pagination
                        $('[data-list-pagination]').data('list-pagination-total-pages', data.response.totalPages); //set total page value to pagination
                        $('[data-list-pagination]').data('list-pagination-active-pages', data.response.currentPage);
                        do_pagination()
                        ///--/pagination
                    } else {
                        $('#reportSection').hide();
                        alert(data.message);
                        hide_processing_modal();
                    }
                }
            }
        })
    }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>