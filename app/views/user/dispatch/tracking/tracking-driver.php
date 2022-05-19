<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="rv content-box" style="margin: auto;max-width: 1300px !important;">
    <h1 class="rv-heading">Driver Tracking</h1>
    <section class="rv-filter-section">
        <!-- input used for sory by call-->
        <input type="hidden" id="sort_by" value="">
        <!-- //input used for sory by call-->
        <div class="filter-item fourth">
            <label>Driver</label>
            <input type="text" list="quick_list_drivers" data-filter="driver_id" data-driver-id>
        </div>
        <div class="filter-item fourth">
            <label>Current Status</label>
            <select data-filter="current_status_id" onchange="set_params('current_status_id', this.value), goto_page(1)"></select>
        </div>
        <div class="filter-item fourth">
        </div>
        <div class="filter-item fourth">
        </div>
    </section>
    <div class="rv-table fixedheader">
        <input type='hidden' id='sort' value='asc'>
        <table data-my-table>
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th style="max-width: 100px !important;" data-table-sort-by="code">Driver Code</th>
                    <th style="max-width: 100px !important;" data-table-sort-by="name">Driver Name</th>
                    <th>Current Status</th>
                    <th>Dispatch ID</th>
                    <th>Last Updated</th>
                  <!--   <th>Action</th> -->
                </tr>
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
    </div>
    <div data-pagination></div>
</section>
<script type="text/javascript">
    var url_params = get_params();
</script>
<script type="text/javascript">
    function show_list() {
        $.ajax({
            url: '../user/dispatch/tracking/tracking-driver-ajax',
            type: 'POST',
            data: {
                sort_by: $('#sort_by').val(),
                sort_by_order_type: $('#sort').val(),
                //page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
               // batch: (check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
               // webapi: 'pagination',
                current_status_id: check_url_params('current_status_id'),
                driver_id: check_url_params('driver_id'),
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
                        $.each(data.response.list, function(index, item) {
                            var row = `<tr>
                                    <td>${item.sr_no}</td>`;
                                    if (item.driver_code != "") {
                                row += `<td><span class="text-link"  onclick="open_quick_view_driver('${item.eid}')">${item.driver_code}</span></td>`;
                            } else {
                                row += `<td></td>`;
                            }
                            if (item.eid != "") {
                                row += `<td style="text-align:left;max-width: 100px !important;"><span class="text-link"  onclick="open_quick_view_driver('${item.eid}')">${item.first_name} ${item.middle_name} ${item.last_name}</span></td>`;
                            } else {
                                row += `<td></td>`;
                            }
                            row += ` <td>${item.current_status}</td>
                                    <td>${item.dispatch_id}</td>`;
                                    if(item.updated_mode == "AUTO"){
                                    row+=`<td>${item.updated_on}<br>Auto</td>`;
                                    }else{
                                        row+=`<td>${item.updated_on}<br>${item.updated_by}</td>`;
                                    }
                                    //row += `<td><span class="text-link" style="font-weight:bolder" onclick="open_child_window({url:'../user/dispatch/tracking/tracking-driver-update?driver_display_name=${item.driver_display_name}&eid=${item.eid}&current_status_id=${item.current_status_id}',width:500,height:300,name:'Update Driver Status'})">Update</span></td>`;
                            row += `</tr>`;
                            $('#tabledata').append(row);
                        })
                        // set_pagination({
                        //     selector: '[data-pagination]',
                        //     totalPages: data.response.totalPages,
                        //     currentPage: data.response.currentPage,
                        //     batch: data.response.batch
                        // })
                    } else {
                        $('#tabledata').html("");
                        var row = `<tr><td colspan="5">` + data.message + `</td></tr>`;
                        $('#tabledata').append(row);
                        // $('[data-pagination]').html('');
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

<script type="text/javascript">
    get_asset_current_status_driver().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
            //Run this if response has list
            if (data.response.list) {
                var options = "";
                options += `<option value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option value="` + item.id + `">` + item.name + `</option>`;
                })
                $('[data-filter="current_status_id"]').html(options);
                if (url_params.hasOwnProperty('current_status_id')) {
                    $("[data-filter='current_status_id'] option[value=" + check_url_params('current_status_id') + "]").prop('selected', true);
                }
            }
        }
    }).catch(function(err) {
        // Run this when promise was rejected via reject()
    })
</script>

<script type="text/javascript">
    function sort_table() {
        show_list()
    }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>