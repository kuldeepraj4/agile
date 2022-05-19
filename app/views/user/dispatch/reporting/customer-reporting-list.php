<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="rv content-box" style="margin: auto;max-width: 1200px !important;">
    <h1 class="rv-heading">Customer Reporting List</h1>
    <section class="rv-filter-section">
        <!-- input used for sory by call-->
        <input type="hidden" id="sort_by" value="">
        <!-- //input used for sory by call-->
        <div class="filter-item fourth">
            <label>Customer ID</label>
            <!-- <input type="text" list="quick_list_customers" data-filter="customer_id" data-driver-id> -->
            <input type="text" value="" list="quick_list_customers" data-filter="customer_id">
        </div>
    </section>
    <div class="rv-table fixedheader">
        <input type='hidden' id='sort' value='asc'>
        <table data-my-table>
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th data-table-sort-by="customer_name">Customer Name</th>
                    <th>Last Report Date-Time</th>
                    <th>Last Report Sent By</th>
                    <th>Action</th>
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
            url: location.pathname + '-ajax',
            type: 'POST',
            data: {
                sort_by: $('#sort_by').val(),
                sort_by_order_type: $('#sort').val(),
                page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
                batch: (check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
                webapi: 'pagination',
                customer_id: check_url_params('customer_id'),
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
           <td>${item.sr_no}</td>
           <td>${item.customer_code} - ${item.customer_name}</td>
           <td  style="font-weight:bolder"> <span class="text-link" title="View Last Report Details"  onclick="open_child_window({url:'../user/dispatch/reporting/customer-reporting/report-details?eid=${item.last_report_eid}',width:700,height:500})" >${item.last_report_datetime}</span></td>
           <td>${item.last_report_send_by}</td>`;
                            row += `<td><a href="../user/dispatch/reporting/customer-reporting/loads?eid=` + item.customer_eid + `"><i class="ic view" title="View details"></i></a></td>`;
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
    function sort_table() {
        show_list()
    }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>