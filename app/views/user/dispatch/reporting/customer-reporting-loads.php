<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="rv content-box" style="margin: auto;max-width: 1600px">
    <h1 class="rv-heading">Customer Loads</h1>
    <section class="rv-action-bar">
        <?php
        if (in_array('DIS003', USER_PRIV)) {
            ?>
            <button class='btn_blue' onclick="open_child_window({url:'../user/dispatch/reporting/customer-reporting/make?eid=<?php echo $_GET['eid']; ?>',width:1400,height:500,name:'Make-Format'})">Make Report</button>
            <?php
        }
        ?>
    </section>
    <section class="rv-filter-section">
        <!-- input used for sory by call-->
        <input type="hidden" id="sort_by" value="">
        <!-- //input used for sory by call-->
        <div class="filter-item fourth">
            <label>Load Status</label>
            <select data-filter="load_status" onchange="set_params('load_status', this.value), goto_page(1)"></select>
        </div>
        <div class="filter-item fourth">
            <label>Terminal</label>
            <select data-filter="terminal_id" onchange="set_params('terminal_id', this.value), goto_page(1)"></select>
        </div>
        <div class="filter-item fourth">
            <label>Pickup State</label>
            <select data-filter="pick_up_state_id" onchange="set_params('pick_up_state_id', this.value), goto_page(1)"></select>
        </div>
        <div class="filter-item fourth">
            <label>Pickup Date</label>
            <input data-date-picker="" type="text" data-filter="pick_up_date" onchange="set_params('pick_up_date', this.value), goto_page(1)" />
        </div>
        <div class="filter-item fourth">
            <label>Load Type</label>
            <select data-filter="load_type_id" onchange="set_params('load_type_id', this.value), goto_page(1)">
                <option value="">- - Select - -</option>
                <option value="LOT01">Truck Load</option>
                <option value="LOT02">Power Only</option>
                <option value="LOT03">Drop & Hook</option>
            </select>
        </div>
        <div class="filter-item fourth">
        </div>
        <div class="filter-item fourth">
            <label>Delivery State</label>
            <select data-filter="delivery_state_id" onchange="set_params('delivery_state_id', this.value), goto_page(1)"></select>
        </div>
        <div class="filter-item fourth">
            <label>Delivery Date</label>
            <input data-date-picker="" type="text" data-filter="delivery_date" onchange="set_params('delivery_date', this.value), goto_page(1)">
        </div>
    </section>
    <div class="rv-table fixedheader">
        <input type='hidden' id='sort' value='asc'>
        <table data-my-table>
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Customer</th>
                    <th>PO#</th>
                    <th>Current Location</th>
                    <th>Load Status</th>
                    <th>Reefer Temperature</th>
                    <th>Pick Up to Delivery</th>
                    <th>Next Action Appointment</th>
                    <th>Delivery Stops</th>
                    <th>Load ID</th>
                    <th>Truck</th>
                    <th>Driver</th>
                    <th>Trailer</th>
                </tr>
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
    </div>
    <div data-pagination></div>
</section>
<script type="text/javascript">
    var url_params = get_params();
    if (url_params.hasOwnProperty('pick_up_date')) {
        $("[data-filter='pick_up_date']").val(url_params.pick_up_date);
    }
    if (url_params.hasOwnProperty('delivery_date')) {
        $("[data-filter='delivery_date']").val(url_params.delivery_date);
    }
    if (url_params.hasOwnProperty('load_type_id')) {
        $("[data-filter='load_type_id'] option[value=" + url_params.load_type_id + "]").prop('selected', true);
    }
</script>
<script type="text/javascript">
    function show_list() {
        var customer_eid = "<?php echo $_GET['eid']; ?>";
        $.ajax({
            url: location.pathname + '-ajax',
            type: 'POST',
            data: {
                sort_by: $('#sort_by').val(),
                sort_by_order_type: $('#sort').val(),
                page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
                batch: (check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
                webapi: 'pagination',
                load_status: check_url_params('load_status'),
                customer_eid: customer_eid,
                terminal_id: check_url_params('terminal_id'),
                pick_up_state_id: check_url_params('pick_up_state_id'),
                pick_up_date: check_url_params('pick_up_date'),
                delivery_state_id: check_url_params('delivery_state_id'),
                delivery_date: check_url_params('delivery_date'),
                trailer_type: check_url_params('trailer_type'),
                sales_agent_id: check_url_params('sales_agent_id'),
                load_type_id: check_url_params('load_type_id'),
            },
            beforeSend: function() {
                show_table_data_loading("[data-my-table]")
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    $('#tabledata').html("");
                    if (data.status) {
                        var counter = 1;
                        $.each(data.response.list, function(index, item) {
                            var row = `<tr>
                            <td>${counter}</td>
                            <td>${item.customer_code} - ${item.customer_name}</td>
                            <td>${item.po_number}</td>
                            <td>${item.truck_location}</td>
                            <td>${item.load_status_id}</td>
                            <td>${item.reefer_temperature}</td>
                            <td>${item.route}</td>
                            <td>${item.next_action_plan}</td>
                            <td>${item.load_total_drops}</td>
                            <td>${item.load_id}</td>
                            <td>${item.truck_code}</td>
                            <td>${item.driver_name}</td>
                            <td>${item.trailer_code}</td>`;
                            row += `</tr>`;
                            $('#tabledata').append(row);
                            counter++;
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
<datalist id="quick_list_customers"></datalist>
<script type="text/javascript">
    $(document.body).on('change', '[data-filter="customer_id"]', function() {
        customer_id_selected = $(`[data-customer-filter-rows="${$(this).val()}"]`).data('value');
        if (customer_id_selected != undefined) {
            $('[data-filter="customer_id"]').val(customer_id_selected)
        }
        if ($(this).val() != '') {
            if (customer_id_selected == undefined) {
                alert('Invalid customer selected');
                customer_id_selected = ''
                $(this).val('')
                $(this).focus()
            }
        } else {
            customer_id_selected = ''
        }
        $('[data-filter="customer_id"]').val(customer_id_selected)
    });

    function show_quick_list_customers() {
        quick_list_customers().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option data-customer-filter-rows="" data-value="" value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option data-customer-filter-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" value="` + item.code + ' ' + item.name + `"></option>`;
                    })
                    $('#quick_list_customers').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_quick_list_customers()
</script>
<script type="text/javascript">
    function show_pickup_states() {
        get_states().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('[data-filter="pick_up_state_id"]').html(options);
                    if (url_params.hasOwnProperty('pick_up_state_id')) {
                        $("[data-filter='pick_up_state_id'] option[value=" + url_params.pick_up_state_id + "]").prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_pickup_states();
</script>
<script type="text/javascript">
    function show_delivery_states() {
        get_states().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('[data-filter="delivery_state_id"]').html(options);
                    if (url_params.hasOwnProperty('delivery_state_id')) {
                        $("[data-filter='delivery_state_id'] option[value=" + url_params.delivery_state_id + "]").prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_delivery_states();
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
<script type="text/javascript">
    function sort_table() {
        show_list()
    }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>