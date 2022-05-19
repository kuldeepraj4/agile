<style>
    body {
        font-size: 14px;
    }
</style>
<?php

require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];

require_once APPROOT . '/views/user/quick-details/quick-trailer-excel.php';
?>
<!-- ------------------------------TRAILER BASIC INFORMATION SECTION START HERE------------------------------------------------------------------------------------------------------------- -->
<section class="lg-form-outer lg-form list-200 content-box profile-ms">
    <section class="profile-ms-outer">
        <div class="profile-ms-header" style="margin-top:-23px; font-weight:bolder; color:brown;">TRAILER ID <?php echo $details['code']; ?></div>

        <div>
<div class="dropdown" style="float:right; margin-right:10px;margin-top:-35px;">
  <button class="dropbtn"><i class="fas fa-file-excel"></i>&nbsp;Excel &nbsp; <span style="border-left:1px solid #fff; padding-left:10px; ">  <i class="fas fa-caret-down"></i></span></button>
  <div class="dropdown-content">
  <a onclick="tableToExcel('personal', 'All TRAILERS DATA')" >All</a>
  <a onclick="tableToExcel('tabledata_document_excel', 'Document Excel Data')">Trailer Documents</a>
  <a onclick="tableToExcel('tabledata_ro_excel', 'RO Excel Data')">Repair Order</a>
  <a onclick="tableToExcel('tabledata_wo_excel', 'WO Excel Data')">Work Order</a>
  <a onclick="tableToExcel('tabledata_su_excel', 'Schedule/Unschedule Excel Data')">Schedule/Unschedule</a>
  </div>
</div>


        <!-- <form class="profile-ms" method="POST" id="MyForm" onsubmit="return add_new()"> -->
        <section class="profile-ms-section-3" style="margin-bottom:-25px;">
            <div>
                <fieldset>
                    <legend>Basic Details 1</legend>
                    <div class="field-section">
                        <div class="field">
                            <label>Trailer ID</label>
                            <div><?php echo $details['code']; ?></div>
                        </div>
                        <div class="field">
                            <label>Company</label>
                            <div><?php echo $details['company']; ?></div>
                        </div>
                        <div class="field">
                            <label>Make Year</label>
                            <div><?php echo $details['make_year']; ?></div>
                        </div>
                        <div class="field">
                            <label>Make</label>
                            <div><?php echo $details['make']; ?></div>
                        </div>
                        <div class="field">
                            <label>Model</label>
                            <div><?php echo $details['model']; ?></div>
                        </div>
                        <div class="field">
                            <label>Body Type</label>
                            <div><?php echo $details['body_type']; ?></div>
                        </div>
                        <div class="field">
                            <label>Reefer Type</label>
                            <div><?php echo $details['reefer_company']; ?></div>
                        </div>
                        <div class="field">
                            <label>VIN</label>
                            <div><?php echo $details['vin']; ?></div>
                        </div>
                        <div class="field">
                            <label>Licence tag no.</label>
                            <div><?php echo $details['licence_tag_no']; ?></div>
                        </div>
                        <div class="field">
                            <label>Licence tag expiry</label>
                            <div><?php echo $details['licence_tag_expiry_date']; ?></div>
                        </div>
                        <div class="field">
                            <label>State</label>
                            <div><?php echo $details['licence_state']; ?></div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div>
                <fieldset>
                    <legend>Status</legend>
                    <div class="field-section">
                        <div class="field">
                            <label>Status</label>
                            <div><?php echo $details['status']; ?></div>
                        </div>
                    </div>
                    <legend>Insurance details</legend>
                    <div class="field-section">
                        <div class="field">
                            <label>Insurance status</label>
                            <div><?php echo $details['insurance_status']; ?></div>
                        </div>
                        <div class="field">
                            <label>Insurance carrier</label>
                            <div><?php echo $details['insurance_company_name']; ?></div>
                        </div>
                        <div class="field">
                            <label>Insurance start date</label>
                            <div><?php echo $details['insurance_start_date']; ?></div>
                        </div>
                        <div class="field">
                            <label>Insurance Expiry date</label>
                            <div><?php echo $details['insurance_expiry_date']; ?></div>
                        </div>
                        <div class="field">
                            <label>P/D value</label>
                            <div><?php echo $details['pd_value']; ?></div>
                        </div>
                        <div class="field">
                            <label>Loss pay info</label>
                            <div><?php echo $details['loss_pay_info']; ?></div>
                        </div>
                        <div class="field">
                            <label>P/D value new</label>
                            <div><?php echo $details['new_pd_value']; ?></div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div>
                <fieldset>
                    <legend>---</legend>
                    <div class="field-section">
                        <div class="field">
                            <label>Device type</label>
                            <div><?php echo $details['device_company_name']; ?></div>
                        </div>
                        <div class="field">
                            <label>Device Sr. no.</label>
                            <div><?php echo $details['device_serial_no']; ?></div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Lease details</legend>
                    <div class="field-section">
                        <div class="field">
                            <label>Ownership Type</label>
                            <div><?php echo $details['ownership_type']; ?></div>
                        </div>
                        <div class="field">
                            <label>Lease Ref no</label>
                            <div><?php echo $details['lease_ref_no']; ?></div>
                        </div>
                        <div class="field">
                            <label>Leasing company</label>
                            <div><?php echo $details['lease_company']; ?></div>
                        </div>
                        <div class="field">
                            <label>Leasing expiry</label>
                            <div><?php echo $details['lease_expiry_date']; ?></div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>IoT Devices</legend>
                    <div class="field-section">
                        <div class="field">
                            <label>Engine Hours Update Type</label>
                            <div><?php echo $details['engine_hours_update_type']; ?></div>
                        </div>
                        <div class="field">
                            <label>Current Engine Hours</label>
                            <div><?php echo $details['current_engine_hours']; ?></div>
                        </div>
                        <div class="field">
                            <label>Updated On</label>
                            <div><?php echo $details['engine_updated_on']; ?></div>
                        </div>
                    </div>
                </fieldset>
            </div>

        </section>
        <!-- </form> -->
    </section>
</section><BR>
<!-- ------------------------------TRAILER BASIC INFORMATION SECTION END HERE------------------------------------------------------------------------------------------------------------- -->
<!-- ---------------------SET BATCH AND PAGINATION SECTION START HERE--------------------------------------------------------------------------------- -->
<script type="text/javascript">
    function goto_page_my(pageno, pagename) {
        set_params('pageno_' + pagename, pageno)
        switch (pagename) {
            case "document":
                goto_page_my(1, 'document');
                show_list_document();
                break;
            case "rolist":
                goto_page_my(1, 'rolist');
                show_list_rolist();
                break;
            case "wolist":
                goto_page_my(1, 'wolist');
                show_list_wolist();
                break;
            case "unsc":
                goto_page_my(1, 'unsc');
                show_list_unsc();
                break;
            default:
                break;
        }
    }
</script>
<script type="text/javascript">
    function set_batch_my(param, value) {
        var items = value;
        if (items <= 12) {
            $(".table-a").css("height", "auto");
        } else {
            $(".table-a").css("height", "90%");
        }
        set_params('batch_' + param, value)
        switch (param) {
            case "document":
                show_list_document();
                break;
            case "rolist":
                show_list_rolist();
                break;
                case "wolist":
                show_list_wolist();
                break;
                case "unsc":
                show_list_unsc();
                break;
            default:
                break;
        }
    }
</script>
<!-- ---------------------SET BATCH AND PAGINATION SECTION END HERE--------------------------------------------------------------------------------- -->

<!-- ---------------------ALL TRUCK REPAIR ORDER SECTION START HERE--------------------------------------------------------------------------------- -->
<br><br><br>
<section class="list-200 content-box" style="margin: auto;">
    <h1 class="list-200-heading">Repair Order List</h1>
    <section class="list-200-top-action">
        <div class="list-200-top-action-left">
            <!-- input used for sory by call-->
        </div>
        <div class="list-200-top-action-right">
        </div>
    </section>
    <div class="table  table-a">
        <table data-ro-table-rolist id="tabledata_ro_excel">
            <input type='hidden' id='sort' value='asc'>
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th data-table-sort-by-none="id">Order ID</th>
                    <th data-table-sort-by-none="created_on">Created on</th>
                    <th data-table-sort-by-none="status">Status</th>
                    <th data-table-sort-by-none="class">Class</th>
                    <th data-table-sort-by-none="type">Type</th>
                    <th data-table-sort-by-none="driver">Driver</th>
                    <th data-table-sort-by-none="stage">Stage</th>
                    <th data-table-sort-by-none="vehicle">Vehicle</th>
                    <th data-table-sort-by-none="vehicle_id">Vehicle ID</th>
                    <th data-table-sort-by-none="start_date">Start Date</th>
                    <th data-table-sort-by-none="end_date">End Date</th>
                    <th style="min-width:500px;" data-table-sort-by-none="last_follow_up">Last Follow Up</th>
                    <th data-table-sort-by-none="next_follow_up">Next Follow Up Date</th>
                    <th style="text-align: left;" data-table-sort-by-none="issues_reported">Issues Reported</th>
                    <th style="text-align: left;" data-table-sort-by-none="issues_description">Issues Description</th>
                    <th>Created By</th>
                    <th>Resolved By</th>
                    <th>Closed By</th>
                    <!-- <th></th>
                    <th></th> -->
                </tr>
            </thead>
            <tbody id="tabledata_rolist"></tbody>
        </table>
    </div>
    <div data-pagination-rolist></div>
</section>
<script type="text/javascript">
    function show_list_rolist() {
        // var sort_by = $('#sort_by').val();
        // var sort_by_order_type = $('#sort').val();
        var page_no = (check_url_params('pageno_rolist') != undefined) ? check_url_params('pageno_rolist') : 1;
        var batch = (check_url_params('batch_rolist') != undefined) ? check_url_params('batch_rolist') : 10;
        var vehicle_type = 'TRAILER';
        var vehicle_id = check_url_params('eid');
        $.ajax({
            url: location.pathname + '-rolist',
            type: 'POST',
            data: {
                //sort_by_order_type:sort_by_order_type,
                page: page_no,
                // sort_by: sort_by,
                batch: batch,
                vehicle_type: vehicle_type,
                vehicle_id: vehicle_id,
            },
            beforeSend: function() {
                show_table_data_loading('[data-ro-table-rolist]')
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    $('#tabledata_rolist').html("");
                    if (data.status) {
                        var counter = 0;
                        $.each(data.response.list, function(index, item) {
                            issue_reported = []
                            issue_description = []
                            $.each(item.issues_list, function(in2, it2) {
                                if (it2['issue_reported'] != "") {
                                    issue_reported.push(it2['issue_reported'])
                                    issue_description.push(it2['issue_description'])
                                }
                            })
                            issue_reported = (issue_reported.length > 0) ? issue_reported.join(',<br>') : ''
                            issue_description = (issue_description.length > 0) ? issue_description.join(',<br>') : ''
                            counter++;
                            var row = `<tr>
           <td>${item.sr_no}</td>
           <td>${item.id}</td>
           <td>${item.added_on_datetime}</td>
           <td data-filter="st">${item.status}</td>
           <td>${item.class}</td>
           <td>${item.type}</td>
           <td>${item.driver_code} ${item.driver_name}</td>
           <td>${item.stage}</td>
           <td>${item.vehicle_type}</td>
           <td>${item.vehicle_code}</td>
           <td>${item.start_date}</td>
           <td>${item.end_date}</td>
           <td>${item.last_follow_up}</td>
           <td>${item.next_follow_up_datetime}</td>
           <td style="min-width:150px;text-align:left">${issue_reported}</td>
           <td style="min-width:150px;text-align:left">${issue_description}</td>
           <td>${item.added_by_user_code} ${item.added_by_user_name} ${item.added_on_datetime}</td>
           <td>${item.ro_resolved_by} ${item.ro_resolved_on}</td>
           <td>${item.closed_by_user_code} ${item.closed_by_user_name} ${item.closed_on_datetime}</td>`;
                            <?php
                            if (in_array('P0228', USER_PRIV)) {
                            ?>
                                // row += `<button title="View" class="btn_grey_c"><a href="../user/maintenance/repair-orders/details?eid=${item.eid}"><i class="fa fa-eye"></i></a></button>`;
                            <?php
                            }
                            if (in_array('P0229', USER_PRIV)) {
                            ?>
                                // row += `<button title="Edit" class="btn_grey_c"><a href="../user/maintenance/repair-orders/update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button>`;
                            <?php
                            }
                            // if (in_array('P0230', USER_PRIV)) {
                            ?>
                            //   row += `<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="${item.eid}"><i class="fa fa-trash"></i></button>`;
                            <?php
                            // }
                            //if (in_array('P0232', USER_PRIV)) {
                            // ?>// row += `<button class="btn_blue" onclick="open_child_window({url:'../user/maintenance/repair-orders/add-followup&eid=${item.eid}',width:1000,height:600})">Follow Up</button>`;
                            // row += `&nbsp;&nbsp;<button class="btn_blue"><a href="../user/maintenance/work-orders/add-new?ro-eid=${item.eid}">Create Work Order</a></button>`;
                        <?php
                           // } ?>
                        row += `</tr>`;
                         $('#rolist_excel').append(row);
                        $('#tabledata_rolist').append(row);
                        //stats.push(item.status) 
                        })
                        set_pagination_batch(data.response.batch, data.response.totalPages, data.response.currentPage, "rolist")
                    } else {
                        $('[data-pagination-rolist]').html('')
                        var false_message = `<tr><td colspan="18">` + data.message + `<td></tr>`;
                        $('#rolist_excel').html(false_message);
                        $('#tabledata_rolist').html(false_message);
                    }
                }
            }
        })
    }
    show_list_rolist()
</script>
<script type="text/javascript">
    function sort_table() {
        show_list_rolist()
    }
</script>
<!-- ---------------------ALL TRUCK REPAIR ORDER SECTION END HERE--------------------------------------------------------------------------------- -->
<!-- ---------------------ALL TRUCK WORK ORDER SECTION START HERE--------------------------------------------------------------------------------- -->
<br><br><br><section class="list-200 content-box" style="margin: auto;max-width: 1400px">
    <h1 class="list-200-heading">Work Order List</h1>
    <section class="list-200-top-section">
    </section>
    <section class="list-200-top-action">
        <div class="list-200-top-action-left">
            <!-- input used for sory by call-->
            <input type="hidden" id="sort_by" value="">
            <!-- //input used for sort by call-->
        </div>      
    </section>
    <div class="table  table-a">
        <input type='hidden' id='sort' value='asc'>
        <table data-ro-table-wolist id="tabledata_wo_excel">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th data-table-sort-by-none="id">ID</th>
                    <th data-table-sort-by-none="date">Date</th>
                    <th data-table-sort-by-none="repair_order_id">Repair Order ID</th>
                    <th data-table-sort-by-none="repair_order_status">Repair Order Status</th>
                    <th data-table-sort-by-none="vehicle">Vehicle</th>
                    <th data-table-sort-by-none="vehicle_code">Vehicle Code</th>
                    <th data-table-sort-by-none="vehicle_hours">Vehicle Hours</th>
                    <th data-table-sort-by-none="odometer">Odometer</th>
                    <th data-table-sort-by-none="vendor">Vendor</th>
                    <th data-table-sort-by-none="city">Vendor City, State</th>
                    <th data-table-sort-by-none="amount">Amount</th>
                    <th data-table-sort-by-none="invoice_no">Invoice No.</th>
                    <th data-table-sort-by-none="Invoice">Invoice</th>
                    <th data-table-sort-by-none="payment_status">Payment Status</th>
                    <th data-table-sort-by-none="payment_mode">Payment Mode</th>
                    <th data-table-sort-by-none="payment_ref">Payment Ref No.</th>
                    <th data-table-sort-by-none="payment_date">Payment Date</th>
                    <th data-table-sort-by-none="payment_remarks">Payment Remarks</th>
                    <th>Reconciliation Status</th>
                    <th>Created By</th>
                    <!-- <th></th> -->
                </tr>
            </thead>
            <tbody id="tabledata_wolist"></tbody>
        </table>
    </div>
    <div data-pagination-wolist></div>
</section>
<script type="text/javascript">
    function show_list_wolist() {
       // var sort_by = $('#sort_by').val();
       // var sort_by_order_type = $('#sort').val();
       var page_no = (check_url_params('pageno_wolist') != undefined) ? check_url_params('pageno_wolist') : 1;
        var batch = (check_url_params('batch_wolist') != undefined) ? check_url_params('batch_wolist') : 10;
        var vehicle_type = 'TRAILER';
        var vehicle_id = check_url_params('eid')
        $.ajax({
            url: location.pathname + '-wolist',
            type: 'POST',
            beforeSend: function() {
                show_table_data_loading('[data-ro-table-wolist]')
            },
            data: {
                page: page_no,
               // sort_by: sort_by,
                batch: batch,
                vehicle_type: vehicle_type,
                vehicle_id: vehicle_id,
                //sort_by_order_type: sort_by_order_type
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    $('#tabledata_wolist').html("");
                    if (data.status) {
                        $.each(data.response.list, function(index, item) {
                            var row = `<tr>
           <td>${item.sr_no}</td>
           <td>${item.id}</td>
           <td>${item.date}</td>
           <td>${item.repair_order_id}</td>
           <td>${item.repair_order_status}</td>
           <td>${item.vehicle_type}</td>
           <td>${item.vehicle_code}</td>
           <td>${item.engine_hours}</td>
           <td>${item.odometer_reading}</td>
           <td>${item.vendor_name}</td>`;
                            if (item.vendor_city_name != "" || item.vendor_state_name != "") {
                                row += ` <td>${item.vendor_city_name},<br>${item.vendor_state_name} </td>`;
                            } else {
                                row += `<td></td>`;
                            }
                            row += ` <td>${item.amount}</td>
          <td>${item.invoice_no}</td>`
                            if (item.invoice_file != '') {
                                row += `<td><span onclick='open_document("${item.invoice_file}")' class="fa fa-file" title="View Invoice" style="color:  grey;cursor:pointer;"></span></td>`;
                            } else {
                                row += '<td></td>';
                            }
                            row += `<td>${item.payment_status}</td>
          <td>${item.payment_mode}</td>
          <td>${item.payment_ref_no}</td>
          <td>${item.payment_date}</td>
          <td>${item.payment_remarks}</td>
          <td>${item.status}</td>
          <td>${item.added_by_user_code} ${item.added_by_user_name}
          <br>
          ${item.added_on_datetime}</td>`;
          // <td style="white-space:nowrap">
                            //row += `<button title="View" class="btn_grey_c"><a href="../user/maintenance/work-orders/details?eid=${item.eid}"><i class="fa fa-eye"></i></a></button>`;
                            <?php
                            //if (in_array('P0234', USER_PRIV)) {
                            ?>
                              //  row += `<button title="Edit" class="btn_grey_c"><a href="../user/maintenance/work-orders/update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button>`;
                            <?php
                           // }
                           // if (in_array('P0235', USER_PRIV)) {
                            ?>
                            //    row += `<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="${item.eid}"><i class="fa fa-trash"></i></button>`;
                            <?php
                           // } ?>
                            row += `</tr>`;                
                            $('#wolist_excel').append(row);  
                            $('#tabledata_wolist').append(row);
                        })
                        set_pagination_batch(data.response.batch, data.response.totalPages, data.response.currentPage, "wolist")
                    } else {
                        $('#tabledata_wolist').html("");
                        var row = `<tr><td colspan="20">` + data.message + `</td></tr>`;
                        $('#tabledata_wolist').append(row);
                         $('#wolist_excel').append(row); 
                        $('[data-pagination-wolist]').html('');
                    }
                }
            }
        })
    }
    show_list_wolist()
</script>
<script type="text/javascript">
    function sort_table() {
        show_list_wolist()
    }
</script>
<!-- ---------------------ALL TRUCK WORK ORDER SECTION END HERE--------------------------------------------------------------------------------- -->
<!-- ---------------------ALL TRUCKS SCHEDULE-UNSCHEDULE SECTION START HERE--------------------------------------------------------------------------------- -->
<style type="text/css">
    table,
    th,
    td {
        border: 1px solid #ddd;
        border-collapse: collapse;
    }

    .lightblue {
        background-color: #cdf4fa;
    }

    .darkblue {
        background-color: #486e94;
        color: white;
        text-decoration: none;
    }
</style>
<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto; ">
    <h1 class="list-200-heading">Dashboard - Schedule/Unschedule</h1>
    <section class="list-200-top-section">
        <div>
        </div>
        <div>
        </div>
    </section>
    <section class="list-200-top-action">
        <div class="list-200-top-action-left">
            <!-- input used for sory by call-->
            <input type="hidden" id="sort_by" value="">
            <!-- //input used for sort by call-->
        </div>
        <div class="list-200-top-action-right">
        </div>
    </section>
    <div class="table  table-a">
        <input type='hidden' id='sort' value='asc'>
        <table data-ro-table-unsc style="font-size: 12px;" id="tabledata_su_excel">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Unit No.</th>
                    <th>Location</th>
                    <th>RO No - Schedule</th>
                    <th data-table-sort-by-none="sc_repairorder_date">Date Created</th>
                    <th data-table-sort-by-none="sc_tat">TAT - Turn Around Time</th>
                    <th>Stage</th>
                    <th>Criticality Level</th>
                    <th>Job Work</th>
                    <th style="min-width:250px; padding:0px 0px; margin: 0px 0px;">Last Note</th>
                    <th data-table-sort-by-none="sc_next_followup">Followup Date</th>
                    <th>Followup Added By</th>
                    <!-- <th>Followup</th>
                    <th>Gen WO</th> -->
                    <th>RO No - Unschedule</th>
                    <th data-table-sort-by-none="un_repairorder_date">Date Created</th>
                    <th data-table-sort-by-none="un_tat">TAT - Turn Around Time</th>
                    <th>Stage</th>
                    <th>Criticality Level</th>
                    <th>Issue Reported</th>
                    <th style="min-width:250px; padding:0px 0px; margin: 0px 0px;">Last Note</th>
                    <th data-table-sort-by-none="un_next_followup">Followup Date</th>
                    <th>Followup Added By</th>
                    <!-- <th>Followup</th>
                    <th>Gen WO</th> -->
                </tr>
            </thead>
            <tbody id="tabledata_unsc"></tbody>
        </table>
    </div>
    <div data-pagination-unsc></div>
</section>
<script type="text/javascript">
    function show_list_unsc() {
        // check url for values or filters by default by swaran start here
        //var sort_by = $('#sort_by').val();
        // var sort_by_order_type = $('#sort').val();
        var page_no = (check_url_params('pageno_unsc') != undefined) ? check_url_params('pageno_unsc') : 1;
        var batch = (check_url_params('batch_unsc') != undefined) ? check_url_params('batch_unsc') : 10;
        var unit_type_id = 'TRAILER'
        $.ajax({
            url: location.pathname + '-unsc',
            type: 'POST',
            data: {
                page: page_no,
                // sort_by: sort_by,
                batch: batch,
                unit_type_id: unit_type_id,
                unit_id: check_url_params('eid'),
                // sort_by_order_type:sort_by_order_type
            },
            beforeSend: function() {
                show_table_data_loading('[data-ro-table-unsc]')
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    // console.log(data)
                    $('#tabledata_unsc').html("");
                    if (data.status) {
                        $.each(data.response.list, function(index, item) {
                            // console.log(item)
                            sc_criticality_level = []
                            $.each(item.sc_clevel_list, function(in2, it2) {
                                if (it2['criticality_level'] != "") {
                                    sc_criticality_level.push(it2['criticality_level'])
                                }
                            })
                            sc_criticality_level = (sc_criticality_level.length > 0) ? sc_criticality_level.join('/') : ''
                            sc_job_work = []
                            $.each(item.sc_jobwork_list, function(in2, it2) {
                                if (it2['job_work_name'] != "") {
                                    sc_job_work.push(it2['job_work_name'])
                                }
                            })
                            sc_job_work = (sc_job_work.length > 0) ? sc_job_work.join('/') : ''
                            un_criticality_level = []
                            $.each(item.un_clevel_list, function(in2, it2) {
                                if (it2['criticality_level'] != "") {
                                    un_criticality_level.push(it2['criticality_level'])
                                }
                            })
                            un_criticality_level = (un_criticality_level.length > 0) ? un_criticality_level.join('/') : ''
                            un_job_work = []
                            $.each(item.un_jobwork_list, function(in2, it2) {
                                if (it2['job_work_name'] != "") {
                                    un_job_work.push(it2['job_work_name'])
                                }
                            })
                            un_job_work = (un_job_work.length > 0) ? un_job_work.join('/') : ''
                            var row = `<tr>
              <td>${item.sr_no}</td>`;
                            if (unit_type_id == "") {
                                row += `<td>${item.unit_code}</td>`;
                            }
                            if (unit_type_id == "TRUCK") {
                                row += `<td>${item.unit_code}</td>`;
                            }
                            if (unit_type_id == "TRAILER") {
                                row += `<td>${item.unit_code}</td>`;
                            }
                            row += `
              <td>${item.current_location}</td>`;
                            if (item.sc_repairorder_id != '0') {
                                row += ` <td style="color:white; background-color: #486e94;">${item.sc_repairorder_id}</td>`;
                            } else {
                                row += ` <td ></td>`;
                            }
                            row += `  <td>${item.sc_repairorder_date}</td>
              <td>${item.sc_tat}</td>
              <td>${item.sc_stage}</td>`;
                            if (sc_criticality_level.indexOf('HIGH') >= 0) {
                                row += `<td style="background-color:#ffcce0">${sc_criticality_level}</td>`;
                            } else if (sc_criticality_level.indexOf('HIGH') <= -1 && sc_criticality_level.indexOf('MEDIUM') >= 0) {
                                row += `<td style="background-color:#fff0b3">${sc_criticality_level}</td>`;
                            } else {
                                row += `<td style="background-color:white">${sc_criticality_level}</td>`;
                            }
                            row += `
             <td style="min-width:150px;text-align:left">${sc_job_work}</td>
             <td class="lightblue" style="min-width:250px; padding:0px 0px;">${item.sc_last_note}</td>
             <td class="lightblue">${item.sc_next_followup}</td>`;
             row += `<td> ${item.follow_sc_user_code} ${item.follow_sc_user_name}<br> ${item.follow_sc_next_datetime}</td>`;

                            <?php
                            if (in_array('P0228', USER_PRIV)) {
                            ?>
                                // if (item.repairorder_id !== "") {
                                //   row += `<button class=""><a href="../user/maintenance/repair-orders/update?eid=${item.repairorder_eid}"></a></button>&nbsp;`;
                                // } 
                            <?php
                            }
                            if (in_array('P0229', USER_PRIV)) {
                            ?>
                                if (item.sc_repairorder_id == "" || item.sc_repairorder_id == 0) {
                                    // row += `<td class="lightblue"></td>`;
                                } else {
                                    // row += `<td class="lightblue"><button class="btn_blue" style="padding: 2px 3px;" onclick="open_child_window({url:'../user/maintenance/repair-orders/add-followup&eid=${item.sc_repairorder_eid}',width:1000,height:600})">Followup</button></td>`;
                                }
                            <?php
                            }
                            if (in_array('P0232', USER_PRIV)) {
                            ?>
                                if (item.sc_repairorder_id == "" || item.sc_repairorder_id == 0) {
                                    // row += `<td></td>`;
                                } else {
                                    // row += `<td><button class="btn_blue" style="padding: 2px 3px;"><a href="../user/maintenance/work-orders/add-new?ro-eid=${item.sc_repairorder_eid}">Gen. WO</a></button></td>`;
                                }
                            <?php
                            } ?>
                            if (item.un_repairorder_id == '0') {
                                row += ` <td ></td>`;
                            } else {
                                row += `
              <td style="color:white; background-color: #486e94;">${item.un_repairorder_id}</td> `;
                            }
                            row += ` <td>${item.un_repairorder_date}</td>
              <td>${item.un_tat}</td>
              <td>${item.un_stage}</td>`;
                            if (un_criticality_level.indexOf('HIGH') >= 0) {
                                row += `<td style="background-color:#ffcce0">${un_criticality_level}</td>`;
                            } else if (un_criticality_level.indexOf('HIGH') <= -1 && un_criticality_level.indexOf('MEDIUM') >= 0) {
                                row += `<td style="background-color:#fff0b3">${un_criticality_level}</td>`;
                            } else {
                                row += `<td style="background-color:white">${un_criticality_level}</td>`;
                            }
                            row += `
             <td style="min-width:150px;text-align:left">${un_job_work}</td>
             <td class="lightblue" style="min-width:250px; padding:0px 0px;">${item.un_last_note}</td>
             <td class="lightblue">${item.un_next_followup}</td>`;
              row += `<td> ${item.follow_uc_user_code} ${item.follow_uc_user_name}<br> ${item.follow_uc_next_datetime}</td>`;
                            <?php
                            if (in_array('P0228', USER_PRIV)) {
                            ?>
                                // if (item.repairorder_id !== "") {
                                //   row += `<button class=""><a href="../user/maintenance/repair-orders/update?eid=${item.repairorder_eid}"></a></button>&nbsp;`;
                                // }
                            <?php
                            }
                            if (in_array('P0229', USER_PRIV)) {
                            ?>
                               // if (item.un_repairorder_id == "" || item.un_repairorder_id == 0) {
                                  //  row += `<td class="lightblue"></td>`;
                               // } else {
                                 //   row += `<td class="lightblue"><button class="btn_blue" style="padding: 2px 3px;" onclick="open_child_window({url:'../user/maintenance/repair-orders/add-followup&eid=${item.un_repairorder_eid}',width:1000,height:600})">Followup</button></td>`;
                               // }
                            <?php
                            // }
                            // if (in_array('P0232', USER_PRIV)) {
                            ?>
                                //if (item.un_repairorder_id == "" || item.un_repairorder_id == 0) {
                                  //  row += `<td></td>`;
                                //} else {
                                   // row += `<td><button class="btn_blue" style="padding: 2px 3px;"><a href="../user/maintenance/work-orders/add-new?ro-eid=${item.un_repairorder_eid}">Gen. WO</a></button></td>`;
                              //  }
                            <?php
                            } ?>
                            row += `</tr>`;
                            $('#sulist_excel').append(row);  
                            $('#tabledata_unsc').append(row);
                        })
                        set_pagination_batch(data.response.batch, data.response.totalPages, data.response.currentPage, "unsc")
                    } else {
                        $('#tabledata_unsc').html("");
                         $('#sulist_excel').append(row);
                        var row = `<tr><td colspan="25">` + data.message + `</td></tr>`;
                        $('#tabledata_unsc').append(row);
                        $('[data-pagination-unsc]').html('');
                    }
                }
            }
        })
    }
    show_list_unsc()
</script>
<script type="text/javascript">
    function sort_table() {
        show_list_unsc()
    }
</script>
<!-- ---------------------ALL TRUCKS SCHEDULE-UNSCHEDULE SECTION END HERE--------------------------------------------------------------------------------- -->
<!-- ---------------------ALL TRAILERS NOTES SECTION START HERE--------------------------------------------------------------------------------- -->
<br><br>
<style type="text/css">
      .notes-area{
        width: 95%;
        /*max-width:580px;*/
        margin:auto;
        background: lightblue;
        border:1px solid grey;
        overflow: hidden;
        border-radius: 8px;
      }
      .notes-area h1{
        text-align: center;
        background: #f1f1f1;
      }  
      .notes-area .notes-box{
       height:400px;
       overflow-y: auto;
       padding: 5px
     }
     .notes-area .note{
      background: white;
      padding:6px;
      border-radius:8px;
      margin:5px auto;
      display: flex;
      width: 90%;
    }
    .notes-area .note.user-other{
      float: left;
    }
    .notes-area .note.user-self{
      float: right;
    }
    .notes-area .note.high-priority-true{
      background: var(--theme-color-red-light) !important;
    }
    .notes-area .note>div:nth-child(1){
      width:30px;
      text-align: center;
    }
    .notes-area .note .note-info{
      padding:0 4px;
      color: grey;
      text-align: right;
      font-size: .8em;
      display: flex;
      align-items: center;
      margin-bottom:5px;
    }
    .notes-area .note .note-info>div:nth-child(1){
      width: 70%;
      text-align: left;
      color: var(--theme-color-blue)
    }
    .notes-area .note .note-info>div:nth-child(2){
      width: 25%;
      flex-grow: 1;
      display: flex;
      align-items: center;
      justify-content: flex-end; 
      text-align: right;      
    }    
    .notes-area .note .note-text{
      white-space: pre-line;
      text-align: left;
      min-height: 50px;
    }
   .notes-area .notes-add-new-box{
    display: flex;
    align-items: center;
    padding: 10px;
    padding-top: 15px;
    background: #f2f2f2;
  }
  .notes-area .notes-add-new-box>div:nth-child(2){
    width:80px; 
    padding:8px;
  }
  .notes-area .notes-add-new-box>div:nth-child(1){
    flex-grow: 1;
  }
  .notes-area .notes-add-new-box textarea{
    width: 100%;
    min-height: 100px;
  }
  .notes-area .notes-save-button{
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    font-size: 25px;
    background: var(--theme-color-green);
  } 
</style>
<script type="text/javascript"></script>
<div data-notes-area="first"></div>
<script type="text/javascript">
  function create_notes_section(param){
    $(`[data-notes-area="${param.notes_area}"]`).html(`<section class="notes-area">
      <h1>Notes</h1>
      <div class="notes-box"></div>
      <div class="notes-add-new-box">
      <div><textarea name="text" placeholder="Type something here. . . . "></textarea></div>
      <div><button  class="notes-save-button" title="Add notes" data-action="add-notes"><i class="fab fa-telegram-plane" style="color:white"></i></button></div>
      </div>
      </section>`);
  }
var last_note_eid=0;
$driver_eid = check_url_params('eid');
  function show_notes(param1){
   param2={
    reference_eid:  check_url_params('eid'),
    reference_type_id:'TRAILERS',
    document_type_eid:check_url_params('eid'),
   }
   let param = Object.assign(param1, param2);
   var notes_area=`[data-notes-area="${param.notes_area}"]`;   
   $.ajax({
    url:"<?php echo AJAXROOT; ?>"+'user/miscellaneous/notes/list-ajax',
    type:'POST',
    data:param,
    beforeSend:function(){
     // $(notes_area+` .notes-box`).html(`<i class="fa fa-spinner fa-span">Loading</i>`);
    },
    success:function(data){
      if((typeof data)=='string'){
       data=JSON.parse(data)
      // $(notes_area+` .notes-box`).html(``);
       if(data.status){
        last_note_eid=data.response.last_note_eid;
        $.each(data.response.list, function(index, item) {
          var user_type='user-self';
          if(item.user_type=='OTHER'){
            user_type='user-other';
          }
          var high_priority_status='';
          var high_priority_status_checked='';
          if(item.high_priority_status=='ON'){
            high_priority_status='high-priority-true';
            high_priority_status_checked='checked'
          }
          var note=`<div class="note ${user_type} ${high_priority_status}"  data-note-eid="${item.eid}">
          <div style="flex-grow:1">
          <div class="note-info">
          <div><b>${item.added_by_user_code} </b> (${item.added_by_user_name}) <span style="color:grey">${item.added_on_datetime} </span></div>
          <div>`
          if(user_type=='user-self'){
            note+=`<input type="checkbox" data-notes-toggle-high-priority-status ${high_priority_status_checked} title="highpriority status"/> &nbsp<i data-note-delete class="fa fa-trash" style="font-size:.9em;color:var(--theme-color-grey)"></i>`
          }
         note+= `</div>
          </div>
          <div class="note-text">${item.text}</div>
          </div></div>`;
          $(notes_area+` .notes-box`).append(note);
        })
        $(notes_area+` .notes-box`).animate({scrollTop: $(notes_area+` .notes-box`)[0].scrollHeight},0);
        $(notes_area+' [name="text"]').val('')
      }
    }
  }
})
 }
 create_notes_section({notes_area:'first'})
show_notes({notes_area:'first',})
</script>
<div id="demo"></div>
<script>
var myVar;    

    function showTime(){
show_notes({notes_area:'first',reference_eid:$driver_eid,last_note_eid:last_note_eid})
    }
    function stopFunction(){
        clearInterval(myVar); // stop the timer
    }
    $(document).ready(function(){
        myVar = setInterval("showTime()", 10000);
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
   $(document).on("click", "[data-action='add-notes']",function(){
    var text =$(this).parent().parent().find('[name="text"]').val()
    if(text.length){
     $.ajax({
      url:"<?php echo AJAXROOT; ?>"+'user/miscellaneous/notes/add-new-action',
      type:'POST',
      data:{
        reference_eid:  check_url_params('eid'),
    reference_type_id:'TRAILERS',
    document_type_eid:check_url_params('eid'),
        text:text
      },
      context: this,
      success:function(data){
        console.log(data)
        if((typeof data)=='string'){
         data=JSON.parse(data) 
       }
       if(data.status){
        show_notes({notes_area:'first',reference_eid:$driver_eid,last_note_eid:last_note_eid});
        var text =$(this).parent().parent().find('[name="text"]').val('')
      }else{
        alert(data.message)
      }
    }
  })
   }else{
    alert('Please write some text')
  }
});
 });
</script>
<!-- ---------------------ALL TRAILERS NOTES SECTION ENDS HERE--------------------------------------------------------------------------------- -->

<br><br>
<section class="lg-form-outer lg-form list-200 content-box">
    <section class="" style="margin: auto;max-width: auto;">
        <h1 class="list-200-heading">Trailer Documents <?php echo (isset($_GET['trailer-code'])) ? $_GET['trailer-code'] : ''; ?></h1>
        <div class="table  table-a">
            <table id="tabledata_document_excel">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th style='text-align:left'>Document Name</th>
                        <th>Is Required</th>
                        <th>Is Uploaded</th>
                        <th>Expiry Days Left</th>
                        <th>Expiry Date</th>
                        <th></th>
                        <th>Verify</th> 
                        <th>Uploaded By</th>
                        <th>Verified By</th>
                        <th>Rejected By</th>
                        <th>Remarks</th>
                        <!-- <th></th> -->
                    </tr>
                </thead>
                <tbody id="tabledata_document">
                </tbody>
            </table>
        </div>
    </section>
</section>
<script type="text/javascript">
    var dd = check_url_params('eid')
    function show_list_document() {
        
        var dd = check_url_params('eid')
        $.ajax({
            url: location.pathname + '-document',
            type: 'POST',
            data: {
                trailer_eid: dd
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    $('#tabledata_document').html("");
                    if (data.status) {
                        var counter = 0;
                        $.each(data.response.list, function(index, item) {
                            
                            let required_option_class = 'cross-red'
                            let required_option_verify = 'NO'
                            if (item.type_required_option) {
                                required_option_class = 'check-green'
                                required_option_verify = 'YES'
                            }
                            let remarks = "";
                            let row = `<tr>
              <td>${++counter}</td>
              <td style='text-align:left'>${item.type_name}</td>
              <td><span class='${required_option_class}'><span><span class='d-none'>${required_option_verify}</span></td>`
                            if (item.is_uploaded) {
                                remarks = item.document_details.remarks;
                                let expiry_alert = (item.document_details.expiry_alert) ? 'bg-red text-white' : '';

                                row += `<td><span class='check-green'></span><span class='d-none'>YES</span></td>`;
                                 if(item.document_details.is_expired == true){
                                    row += ` <td class='bg-red text-white'>${item.document_details.expiry_days_left}</td>`;
                                    }else

                                   if(item.document_details.expiry_alert == true){
                                        row += ` <td class='bg-orange text-white'>${item.document_details.expiry_days_left}</td>`;
                                     }else
                                    if(item.document_details.expiry_days_left != ""){
                                          row += ` <td>${item.document_details.expiry_days_left}</td>`;
                                     }else{
                                       row += `<td></td>`;
                                 }

              
               row += `<td>${item.document_details.expiry_date}</td>
               <td>
               <button class='btn_grey_c' onclick="open_document('${item.document_details.file_path}')"><i class='fa fa-file'></i></button>`
                                <?php if (in_array('P0145', USER_PRIV)) {
                                ?>
                                    // row += `<button title="Edit" class="btn_grey_c"><a href="../user/masters/trailers/documents/upload?trailer_eid=${dd}&document_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-upload"></i></a></button>`;
                                <?php
                                } ?>
                                if (item.document_details.verification_status == 'PENDING') {
                                    <?php //if (in_array('P0146', USER_PRIV)) {
                                    ?>
                                     // row += `<td>
                //  <select data-action="update-verification-status" data-document-eid="${item.document_details.eid}">
                //  <option value="" > Select</option>
                //  <option value="VERIFIED"> VERIFY </option>
                //  <option value="REJECTED"> REJECT </option>
                // </select>
                //   </td>`
                                    <?php
                                   // } else {
                                    ?>
                                       row += `<td>PENDING</td>`
                                    <?php
                                   //}
                                    ?>
                                } else {
                                    row += `<td>${item.document_details.verification_status}</td>`;
                               }
                                row += `<td>${item.document_details.added_by_user_code} <br>${item.document_details.added_by_user_name}<br> <span style="white-space:nowrap"> ${item.document_details.added_on_datetime}</span></td>
              <td>${item.document_details.verified_by_user_code} <br> ${item.document_details.verified_by_user_name}  <br><span style="white-space:nowrap"> ${item.document_details.verified_on_datetime}</span></td>
              <td>${item.document_details.rejected_by_user_code} <br> ${item.document_details.rejected_by_user_name}  <br><span style="white-space:nowrap"> ${item.document_details.rejected_on_datetime}</span></td>`
                            } else {
                                row += `<td><span class='cross-red'><span><span class='d-none'>NO</span></td>
             
              <td></td>
              <td style="white-space:nowrap">
              <button disabled style="cursor:auto"><i class="fa fa-upload"></i></button>`
                                <?php if (in_array('P0145', USER_PRIV)) {
                                ?>
                                    // row += `<button title="Edit" class="btn_grey_c"><a href="../user/masters/trailers/documents/upload?trailer_eid=${dd}&document_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-upload"></i></a></button>`;
                                <?php
                                } ?>
                                row += `<td></td>
              <td></td>
              <td></td>`
                            }
                            if(item.remarks == null || item.remarks == ""){
                                row += `<td></td>`;
                            }else{
                                row += `<td>${item.remarks}</td>`;
                            }
            //           row+=`<td style="white-space:nowrap">
            // <button title="History" class="btn_grey_c"><a href="../user/masters/trailers/documents/document-history?trailer_eid=${dd}&document_type_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-history"></i></a></button>
            // <button title="Notes" class="btn_grey_c" onclick="open_notes({url:'../user/miscellaneous/notes/details?reference=TRAILER-DOCUMENT&eid=${dd}&document-type-eid=${item.type_eid}'})"><i class="fa fa-sticky-note"></i></a></button></td>`
                            row += `</tr>`
                             $('#document_excel').append(row);
                            $('#tabledata_document').append(row);
                        })
                    } else {
                        var false_message = `<tr><td colspan="18">` + data.message + `<td></tr>`;
                        $('#document_excel').html(false_message);
                        $('#tabledata_document').html(false_message);
                    }
                }
            }
        })
    }
    show_list_document()
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("change", "[data-action='update-verification-status']", function() {
            var eid = $(this).data('document-eid');
            var verification_status = $(this).val();
            if (verification_status == 'VERIFIED') {
                var url = window.location.pathname + '/verify'
            } else if (verification_status == 'REJECTED') {
                var url = window.location.pathname + '/reject'
            }
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    document_eid: eid,
                    verification_status: verification_status,
                },
                context: this,
                success: function(data) {
                    // alert(data)
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                    }
                    alert(data.message)
                    if (data.status) {
                        show_list_document()
                    } else {
                        alert(data.message)
                    }
                }
            })
        });
    });
</script>



<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>