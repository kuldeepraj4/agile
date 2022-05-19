<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="rv content-box" style="margin: auto;max-width: 2000px !important;">
    <h1 class="rv-heading">Dispatch Continuity</h1>
    <section class="rv-filter-section">
        <!-- input used for sory by call-->
        <input type="hidden" id="sort_by" value="">
        <!-- //input used for sory by call-->
        <div class="filter-item fourth">
            <label>Report Type</label>
            <select data-filter="report_type" onchange="set_params('report_type', this.value)">
                <option value="">--- Select ---</option>
                <option value="TRUCK">Truck</option>
                <option value="TRAILER">Trailer</option>
                <option value="DRIVER">Driver</option>
            </select>
        </div>
        <div class="filter-item fourth">
            <label>Terminal</label>
            <select data-filter="terminal_id" onchange="set_params('terminal_id', this.value)"></select>
        </div>
        <div class="filter-item fourth">
            <label>Origin Date From</label>
            <input type="text" data-date-picker="" data-origindate_from data-filter="origin_date_from" onchange="set_params('origin_date_from', this.value)">
        </div>
        <div class="filter-item fourth">
            <label>Origin Date To</label>
            <input data-date-picker="" type="text" data-origindate_to data-filter="origin_date_to" onchange="set_params('origin_date_to', this.value)" />
        </div>
        <div class="filter-item fourth">
            <label>Driver ID</label>
            <input type="text" list="quick_list_drivers" data-filter="driver_id" data-driver-id>
        </div>
        <div class="filter-item fourth">
            <label>Trailer No.</label>
            <input type="text" data-filter="trailer_id" list="quick_list_trailers" data-trailer-id>
        </div>
        <div class="filter-item fourth">
            <label>Destination Date From</label>
            <input type="text" data-date-picker="" data-destinationdate-from data-filter="destinationdate-from" onchange="set_params('destinationdate_from', this.value)">
        </div>
        <div class="filter-item fourth">
            <label>Destination Date To</label>
            <input data-date-picker="" type="text" data-destinationdate-to data-filter="destinationdate-to" onchange="set_params('destinationdate_to', this.value)">
        </div>
        <div class="filter-item fourth">
            <label>Truck No.</label>
            <input type="text" data-filter="truck_id" list="quick_list_trucks" data-truck-id>
        </div>
        <div class="filter-item fourth">
        </div>
        <div class="filter-item fourth">
        </div>
        <div class="filter-item fourth">
        </div>
    </section>
    <section>
        <div class="filter-item" style="width: 10%!important;margin-top: 0px;margin-bottom: 10px;float:right;">
            <button class="search_stage_filter form-submit-btn">Search</button>
        </div>

    </section>
    <div class="rv-table fixedheader">
        <input type='hidden' id='sort' value='asc'>
        <table data-my-table>
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Dispatch ID</th>
                    <th>Load ID</th>
                    <th>Terminal</th>
                    <th>Driver</th>
                    <th>Tractor</th>
                    <th>Trailer</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Origin Date</th>
                    <th>Destination Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
    </div>
    <div data-pagination></div>
</section>
<script type="text/javascript">
    var url_params = get_params();
    if (url_params.hasOwnProperty('origin_date_from')) {
        $("[data-filter='origin_date_from']").val(url_params.origin_date_from);
    }
    if (url_params.hasOwnProperty('origin_date_to')) {
        $("[data-filter='origin_date_to']").val(url_params.origin_date_to);
    }
    if (url_params.hasOwnProperty('destinationdate_from')) {
        $("[data-filter='destinationdate_from']").val(url_params.destinationdate_from);
    }
    if (url_params.hasOwnProperty('destinationdate_to')) {
        $("[data-filter='destinationdate_to']").val(url_params.destinationdate_to);
    }
    if (url_params.hasOwnProperty('report_type')) {
        $("[data-filter='report_type'] option[value=" + url_params.report_type + "]").prop('selected', true);
    }
</script>
<script type="text/javascript">
    $(document.body).on('click', '.search_stage_filter', function() {
        goto_page(1);
    });
</script>
<script>
    $(document.body).on('change', '[data-origindate_from]', function() {
        var g1 = new Date(check_url_params('origin_date_from'))
        var g2 = new Date(check_url_params('origin_date_to'))
        if (g1.getTime() > g2.getTime()) {
            alert("Please enter the valid date!. Origin date From should be less than Origin date To")
            $("[data-filter='origin_date_from']").val("");
            set_params('origin_date_from', "")
            goto_page(1)
        }
    });
    $(document.body).on('change', '[data-origindate_to]', function() {
        var g1 = new Date(check_url_params('origin_date_from'))
        var g2 = new Date(check_url_params('origin_date_to'))
        if (g1.getTime() > g2.getTime()) {
            alert("Please enter the valid date!. Origin date To should be greater than Origin date From")
            $("[data-filter='origin_date_to']").val("");
            set_params('origin_date_to', "")
            goto_page(1)
        }
    });
</script>
<script>
    $(document.body).on('change', '[data-destinationdate-from]', function() {
        var g1 = new Date(check_url_params('destinationdate-from'))
        var g2 = new Date(check_url_params('destinationdate-to'))
        if (g1.getTime() > g2.getTime()) {
            alert("Please enter the valid date!. Destination Date From should be less than Destination Date To")
            $("[data-filter='destinationdate-from']").val("");
            set_params('destinationdate-from', "")
            goto_page(1)
        }
    });
    $(document.body).on('change', '[data-destinationdate-to]', function() {
        var g1 = new Date(check_url_params('destinationdate-from'))
        var g2 = new Date(check_url_params('destinationdate-to'))
        if (g1.getTime() > g2.getTime()) {
            alert("Please enter the valid date!. Destination Date To should be greater than Destination Date From")
            $("[data-filter='destinationdate-to']").val("");
            set_params('destinationdate-to', "")
            goto_page(1)
        }
    });
</script>
<script type="text/javascript">
    function show_list() {
        $.ajax({
            url: '../user/dispatch/reporting/dispatch-continuity-ajax',
            type: 'POST',
            data: {
                sort_by: $('#sort_by').val(),
                sort_by_order_type: $('#sort').val(),
                page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
                batch: (check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
                webapi: 'pagination',
                report_type: check_url_params('report_type'),
                terminal_id: check_url_params('terminal_id'),
                origin_date_from: check_url_params('origin_date_from'),
                origin_date_to: check_url_params('origin_date_to'),
                destinationdate_from: check_url_params('destinationdate_from'),
                destinationdate_to: check_url_params('destinationdate_to'),
                origin_date_to: check_url_params('origin_date_to'),
                origin_date_to: check_url_params('origin_date_to'),
                origin_date_to: check_url_params('origin_date_to'),
                trailer_id: check_url_params('trailer_id'),
                driver_id: check_url_params('driver_id'),
                truck_id: check_url_params('truck_id'),
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
                        var $driver_a="";
                        var $driver_b="";
                        var $truck="";
                        var $trailer="";
                        $.each(data.response.list, function(index, item) {
                            var row = `<tr>
                                    <td>${item.sr_no}</td>
                                    <td>${item.id}</td>
                                    <td>${item.load_id}</td>
                                    <td>${item.load_terminal}</td>`;
                            row += `<td style="white-space:nowrap" class="bg-white">`;
                            if (item.driver_eid != "") {
                                var $driver_a = item.driver_name;
                                row += `<b>${((item.is_team_driver)=='TEAM')?'T':''}</b> <span class="text-link"  onclick="open_quick_view_driver('${item.driver_eid}')">${item.driver_name}</span>`;
                            }

                            if (item.driver_b_eid != "") {
                                var $driver_b = item.driver_b_name;
                                row += `<br><span class="text-link"  onclick="open_quick_view_driver('${item.driver_b_eid}')">${item.driver_b_name} </span>`;
                            }
                            row += `</td>`;
                            if (item.truck_eid != "") {
                                $truck = item.truck_code;
                                row += `<td class="bg-white"><span class="text-link"  onclick="open_quick_view_truck('${item.truck_eid}')">${item.truck_code}</span></td>`;
                            } else {
                                row += `<td class="bg-white"></td>`;
                            }

                            if (item.trailer_eid != "") {
                                $trailer = item.trailer_code;
                                row += `<td class="bg-white"><span class="text-link"  onclick="open_quick_view_trailer('${item.trailer_eid}')">${item.trailer_code}</span></td>`;
                            } else {
                                row += `<td class="bg-white"></td>`;
                            }
                            row += ` <td>${item.origin_location}</td>
                                    <td>${item.destination_location}</td>
                                    <td>${item.origin_datetime}</td>
                                    <td>${item.destination_datetime}</td>`;
                            row += `<td><span class="text-link" style="font-weight:bolder" onclick="open_child_window({url:'../user/dispatch/reporting/dispatch-continuity/add-empty-miles?truck-id=${item.truck_id}&trailer-id=${item.trailer_id}&driver-a-id=${item.driver_id}&driver-b-id=${item.driver_b_id}&driver_a_display_name=${$driver_a}&driver_b_display_name=${$driver_b}&truck_code=${$truck}&trailer_code=${$trailer}',width:1000,height:500,name:'Add Empty Miles'})">Add Empty Miles</span></td>`;
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
                        $('#tabledata').html("");
                        var row = `<tr><td colspan="5">` + data.message + `</td></tr>`;
                        $('#tabledata').append(row);
                        $('[data-pagination]').html('');
                    }
                }
            }
        })
    }
    // show_list()
</script>



<script type="text/javascript">
    function show_terminals() {
        get_companies().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('[data-filter="terminal_id"]').html(options);
                    if (url_params.hasOwnProperty('terminal_id')) {
                        $("[data-filter='terminal_id'] option[value=" + url_params.terminal_id + "]").prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_terminals()
</script>


<!-- -----------------------------Driver function start here ------------------------------------------------------>
<script type="text/javascript">
    $(document.body).on('input', '[data-driver-id]', function() {
        id_selected = $(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
        if (id_selected != undefined) {
            $(this).data('driver-id', id_selected)
            set_params('driver_id', id_selected)
            set_params('driver_name', $(`[data-driver-id]`).val())
            //goto_page(1)
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
            // goto_page(1)
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
            //goto_page(1)
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
            // goto_page(1)
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
            // goto_page(1)
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