<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="rv content-box" style="margin: auto;max-width: 1300px !important;">
    <h1 class="rv-heading">Truck Tracking</h1>
    <section class="rv-filter-section">
        <!-- input used for sory by call-->
        <input type="hidden" id="sort_by" value="">
        <!-- //input used for sory by call-->
        <div class="filter-item fourth">
            <label>Truck</label>
            <input type="text" data-filter="truck_id" list="quick_list_trucks" data-truck-id>
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
                    <th data-table-sort-by="code">Truck</th>
                    <th data-table-sort-by="current_status_id">Current Status</th>
                    <th>Dispatch ID</th>
                    <th style="max-width: 100px !important;">Location</th>
                    <th>Last Updated</th>
                   <!--  <th>Action</th> -->
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
            url: '../user/dispatch/tracking/tracking-truck-ajax',
            type: 'POST',
            data: {
                sort_by: $('#sort_by').val(),
                sort_by_order_type: $('#sort').val(),
                current_status_id: check_url_params('current_status_id'),
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
                        $.each(data.response.list, function(index, item) {
                            var row = `<tr>
                                    <td>${item.sr_no}</td>`;
                            if (item.eid != "") {
                                row += `<td class="bg-white"><span class="text-link"  onclick="open_quick_view_truck('${item.eid}')">${item.truck_code}</span></td>`;
                            } else {
                                row += `<td class="bg-white"></td>`;
                            }
                            row += ` <td>${item.current_status}</td>
                                    <td>${item.dispatch_id}</td>
                                    <td style="max-width: 200px !important;">${item.location}</td>`;
                            if (item.updated_mode == "AUTO") {
                                row += `<td>${item.updated_on}<br>Auto</td>`;
                            } else {
                                row += `<td>${item.updated_on}<br>${item.updated_by}</td>`;
                            }
                            //row += `<td><span class="text-link" style="font-weight:bolder" onclick="open_child_window({url:'../user/dispatch/tracking/tracking-truck-update?truck_code=${item.truck_code}&eid=${item.eid}&current_status_id=${item.current_status_id}',width:500,height:300,name:'Update Truck Status'})">Update</span></td>`;
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

<script type="text/javascript">
    get_asset_current_status_truck().then(function(data) {
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