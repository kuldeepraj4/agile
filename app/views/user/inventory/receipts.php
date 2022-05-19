<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 500px">
    <h1 class="list-200-heading">Receipts</h1>


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
                <label>Payment Status</label>
                <select data-filter="payment_status" onchange="set_params('payment_status', this.value), goto_page(1)">
                    <option value="">- - Select - -</option>
                    <option value="PAID">Paid</option>
                    <option value="UNPAID">Unpaid</option>
                </select>
            </div>
            <div class="filter-item">
                <label>Location</label>
                <select data-filter="location_id" onchange="set_params('location_id', this.value), goto_page(1)">
                </select>
            </div>

        </div>
        <div class="list-200-top-action-right">
            <div>
                <?php
                //if (in_array('P0421', USER_PRIV)) {
                    // echo "<button class='btn_grey button_href'><a href='../user/inventory/receipts/add-new'>Add New Item</a></button>";
               // }
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
                    <th data-table-sort-by="number">PO Number</th>
                    <th data-table-sort-by="vendor">Vendor</th>
                    <th data-table-sort-by="amount">Amount</th>
                    <th data-table-sort-by="receipt">Receipt Date</th>
                    <th data-table-sort-by="payment_status">Payment Status</th>
                    <th data-table-sort-by="receiver">Received BY</th>
                    <th data-table-sort-by="location">Location</th>
                    <th>Invoice</th>
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

    if (url_params.hasOwnProperty('vendor_id')) {
        $("[data-filter='vendor_id']").val(url_params.vendor_id);
    }
    
    if (url_params.hasOwnProperty('payment_status')) {
        $("[data-filter='payment_status']").val(url_params.payment_status);
    }
    if (url_params.hasOwnProperty('location_id')) {
        $("[data-filter='location_id']").val(url_params.location_id);
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
        var payment_status = check_url_params('payment_status');
        var location_id = check_url_params('location_id');

        let param = {
           // value: value,
            page: page_no,
            sort_by: sort_by,
            batch: batch,
            sort_by_order_type: sort_by_order_type,
            webapi: webapi,

            po_number: po_number,
            vendor_id: vendor_id,
            payment_status: payment_status,
            location_id: location_id,
            
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
                            row += `<td>` + item.vendor_name + `</td>`;
                            row += `<td>` + item.amount + `</td>`;
                            row += `<td>` + item.receipt_date + `</td>`;
                            row += `<td>` + item.payment_status + `</td>`;
                            row += `<td>` + item.receiver + `</td>`;
                            row += `<td>` + item.location + `</td>`;
                            if (item.invoice_file != '') {
                                row += `<td><span onclick='open_document("${item.invoice_file}")' class="fa fa-file" title="View Invoice" style="color:  grey;cursor:pointer;"></span></td>`;
                            } else {
                                row += '<td></td>';
                            }

                            row += `<td>` + item.receipt_added_by.user_code + `<br>` + item.receipt_added_by.user_name + `<br>` + item.receipt_added_on + `</td>`;
                            row += `<td>` + item.receipt_updated_by.user_code + `<br>` + item.receipt_updated_by.user_name + `<br>` + item.receipt_updated_on + `</td>`;

                            row += `<td style="white-space: nowrap">`;
                            <?php if (in_array('P0422', USER_PRIV)) {
                            ?>
                            row += `<button title="View" class="btn_grey_c"><a href="../user/inventory/receipts/details?eid=${item.eid}"><i class="fa fa-eye"></i></a></button>`;
                            <?php
                            } ?>
                            
                            <?php if (in_array('P0423', USER_PRIV)) {
                            ?>
                                 row += `<button title="Edit" class="btn_grey_c"><a href="../user/inventory/receipts/update?eid=` + item.eid + `"><i class="fa fa-pen"></i></a></button>`;
                            <?php
                            } ?>
                            <?php if (in_array('P0424', USER_PRIV)) {
                            ?>
                                row += `<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="` + item.eid + `"><i class="fa fa-trash"></i></button>`;
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