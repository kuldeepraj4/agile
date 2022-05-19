<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 500px">
    <h1 class="list-200-heading">Purchase Orders</h1>


    <section class="list-200-top-action">
        <div class="list-200-top-action-left">

            <!-- input used for sory by call-->
            <input type="hidden" id="sort_by" value="">
            <!-- //input used for sory by call-->

            <!-- <div class="filter-item-full">
                <label>Search</label>
                <input type="text" placeholder="name / status" data-filter="search" onkeyup="show_list()">
                </select>
            </div> -->
            <div class="filter-item">
                <label>PO Number</label>
                <input type="text" data-filter="po_number" onchange="set_params('po_number', this.value), goto_page(1)">
            </div>
            <div class="filter-item">
                <label>Vendor</label>
                <select data-filter="vendor_id" onchange="set_params('vendor_id', this.value), goto_page(1)">
                </select>
            </div>
            <div class="filter-item">
                <label>Payment Terms</label>
                <select data-filter="payment_term_id" onchange="set_params('payment_term_id', this.value), goto_page(1)">
                </select>
            </div><div class="filter-item">
                <label>Shipment Preference</label>
                <select data-filter="shipment_preference_id" onchange="set_params('shipment_preference_id', this.value), goto_page(1)">
                </select>
            </div><div class="filter-item">
                <label>Location</label>
                <select data-filter="location_id" onchange="set_params('location_id', this.value), goto_page(1)">
                </select>
            </div>
            <div class="filter-item">
                <label>Status</label>
                <select data-filter="po_status" onchange="set_params('po_status', this.value), goto_page(1)">
                    <option value="">- - Select - -</option>
                    <option value="Open">Open</option>
                    <option value="Pending">Pending</option>
                    <option value="Closed">Closed</option>
                    <option value="Cancelled">Cancelled</option>
                    <option value="Rejected">Rejected</option>
                </select>
            </div>

        </div>
        <div class="list-200-top-action-right">
            <div>
                <?php
                if (in_array('P0416', USER_PRIV)) {
                    echo "<button class='btn_grey button_href'><a href='../user/inventory/purchase-orders/add-new'>Add New</a></button>";
               }
                ?>
            </div>
        </div>

    </section>

    <div class="table  table-a">
        <table>
            <thead>
                <input type='hidden' id='sort' value='asc'>
                <tr>
                    <th>Sr. No.</th>
                    <th  data-table-sort-by="po_number">PO Number</th>
                    <th data-table-sort-by="po_date">PO Date</th>
                    <th data-table-sort-by="vendor_name">Vendor</th>
                    <th data-table-sort-by="expected_delivery_date">Expected Delivery</th>
                    <th data-table-sort-by="shipment_preference">Shipment Preference</th>
                    <th data-table-sort-by="payment_term">Payment Term</th>
                    <th data-table-sort-by="location">Location</th>
                    <th data-table-sort-by="po_status">Status</th>
                    <th>Added By</th>
                    <th>Updated By</th>
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
  
    if (url_params.hasOwnProperty('po_number')) {
        $("[data-filter='po_number']").val(url_params.po_number);
    }
    if (url_params.hasOwnProperty('location_id')) {
        $("[data-filter='location_id']").val(url_params.location_id);
    }
    if (url_params.hasOwnProperty('vendor_id')) {
        $("[data-filter='vendor_id']").val(url_params.vendor_id);
    }
    if (url_params.hasOwnProperty('payment_term_id')) {
        $("[data-filter='payment_term_id']").val(url_params.payment_term_id);
    }
    if (url_params.hasOwnProperty('shipment_preference_id')) {
        $("[data-filter='shipment_preference_id']").val(url_params.shipment_preference_id);
    }
    if (url_params.hasOwnProperty('po_status')) {
        $("[data-filter='po_status']").val(url_params.po_status);
    }
  
</script>
<script type="text/javascript">
    function show_list() {
        var sort_by = $('#sort_by').val();
        var sort_by_order_type = $('#sort').val();
        var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
        var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
        var webapi = "pagination";
        //var value = $('[data-filter="search"]').val().toUpperCase();
        var po_number = check_url_params('po_number');
        var vendor_id = check_url_params('vendor_id');
        var shipment_preference_id = check_url_params('shipment_preference_id');
        var payment_term_id = check_url_params('payment_term_id');
        var location_id = check_url_params('location_id');
        var po_status = check_url_params('po_status');

        let param = {
           // value: value,
            page: page_no,
            sort_by: sort_by,
            batch: batch,
            sort_by_order_type: sort_by_order_type,
            webapi: webapi,
            po_number: po_number,
            vendor_id: vendor_id,
            shipment_preference_id: shipment_preference_id,
            payment_term_id: payment_term_id,
            location_id: location_id,
            po_status: po_status,
            
        }


        $.ajax({
        url: location.pathname + '-list-ajax',
        type: 'POST',
        data: param,
        beforeSend:function(){
            $('#tabledata').html(`<tr><td colspan="7">Loading . . . <td></tr>`);
        },
        success:function(data){
            data=JSON.parse(data);
          
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    $('#tabledata').html("");
                    var counter = 0;
                    $.each(data.response.list, function(index, item) {
                            counter++;
                            var row = ``;
                            row += `<tr>`;
                            row += `<td>` + item.sr_no + `</td>`;
                            row += `<td>` + item.po_number + `</td>`;
                            row += `<td>` + item.po_date + `</td>`;
                            row += `<td>` + item.vendor_name + `</td>`;
                            row += `<td>` + item.expected_delivery_date + `</td>`;
                            row += `<td>` + item.shipment_preference + `</td>`;
                            row += `<td>` + item.payment_term + `</td>`;
                            row += `<td>` + item.location + `</td>`;
                            row += `<td>` + item.po_status + `</td>`;
                            row += `<td>` + item.po_added_by.user_code + `<br>` + item.po_added_by.user_name + `<br>` + item.po_added_on + `</td>`;
                            row += `<td>` + item.po_updated_by.user_code + `<br>` + item.po_updated_by.user_name + `<br>` + item.po_updated_on + `</td>`;
                            row += `<td style="white-space: nowrap">`;

                            <?php if (in_array('P0417', USER_PRIV)) {
                            ?>
                            row += `<button title="View" class="btn_grey_c"><a href="../user/inventory/purchase-orders/details?eid=${item.eid}"><i class="fa fa-eye"></i></a></button>`;
                            <?php
                            } ?>

                            <?php if (in_array('P0418', USER_PRIV)) {
                            ?>
                                 row += `<button title="Edit" class="btn_grey_c"><a href="../user/inventory/purchase-orders/update?eid=` + item.eid + `"><i class="fa fa-pen"></i></a></button>`;
                            <?php
                            } ?>
                            <?php if (in_array('P0419', USER_PRIV)) {
                            ?>
                                if(item.po_status != 'Closed'){
                                row += `<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="` + item.eid + `"><i class="fa fa-trash"></i></button>`;
                                }
                            <?php
                            } ?>
                             <?php if (in_array('P0421', USER_PRIV)) {
                            ?>
                            if(item.po_status != 'Closed'){
                                 row += `<button title="Receipt" class="btn_grey_c"><a href="../user/inventory/receipts/add-new?po-eid=` + item.eid + `">Receipt</a></button>`;
                            }
                            <?php
                            } ?>

                            row += `</td>`;

                            row += `</tr>`;
                            $('#tabledata').append(row);

                        
                        set_pagination({
                            selector: '[data-pagination]',
                            totalPages: data.response.totalPages,
                            currentPage: data.response.currentPage,
                            batch: data.response.batch
                        })
                    })
                }
            } else {
                $('#tabledata').html("");
                var row = `<tr><td colspan="5">` + data.message + `</td></tr>`;
                $('#tabledata').append(row);
                $('[data-pagination]').html('');
            }
        }
        });
        
    }
    show_list()
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", "[data-action='delete']", function() {
            if (confirm('Do you want to delete item ?')) {
                var eid = $(this).data("eid");
                $.ajax({
                    url: window.location.pathname + '/delete-action',
                    type: 'POST',
                    data: {
                        delete_eid: eid
                    },
                    context: this,
                    success: function(data) {
                        console.log(data);
                        if ((typeof data) == 'string') {
                            data = JSON.parse(data)
                        }

                        if (data.status) {
                            $(this).parent().parent();
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

<script>
    function show_vendors() {
        get_maintenace_vendors().then(function(data) {
            // Run this when your request was successful
            if (data.status) {

                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="${item.id}">${item.name}</option>`;
                    })
                    $('[data-filter="vendor_id"]').html(options);
                    if (url_params.hasOwnProperty('vendor_id')) {
                        $("[data-filter='vendor_id'] option[value=" + url_params.vendor_id + "]").prop('selected', true);
                    }
                    
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }

    show_vendors();

    function show_shipment_preferences() {
        get_shipment_preferences().then(function(data) {
            // Run this when your request was successful
            if (data.status) {

                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="${item.id}">${item.shipment_preference}</option>`;
                    })
                    $('[data-filter="shipment_preference_id"]').html(options);
                    if (url_params.hasOwnProperty('shipment_preference_id')) {
                        $("[data-filter='shipment_preference_id'] option[value=" + url_params.shipment_preference_id + "]").prop('selected', true);
                    }

                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }

    show_shipment_preferences();

    function show_payment_terms() {
        get_payment_terms().then(function(data) {
            // Run this when your request was successful
            if (data.status) {

                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="${item.id}">${item.payment_term}</option>`;
                    })
                    $('[data-filter="payment_term_id"]').html(options);
                    if (url_params.hasOwnProperty('payment_term_id')) {
                        $("[data-filter='payment_term_id'] option[value=" + url_params.payment_term_id + "]").prop('selected', true);
                    }

                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }

    show_payment_terms();

    function show_locations() {
        get_product_locations().then(function(data) {
            // Run this when your request was successful
            if (data.status) {

                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="${item.id}">${item.location}</option>`;
                    })
                    $('[data-filter="location_id"]').html(options);
                    if (url_params.hasOwnProperty('location_id')) {
                        $("[data-filter='location_id'] option[value=" + url_params.location_id + "]").prop('selected', true);
                    }
                
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }

    show_locations();
</script>

<script type="text/javascript">
    function sort_table() {
        show_list()
    }
</script>

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>