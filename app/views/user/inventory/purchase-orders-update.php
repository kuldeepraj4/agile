<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];

// echo '<pre>';
// print_r($details);
// echo '</pre>';
//exit; 

?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - Update PO</div>
    <form autocomplete="off" class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
        <section class="section-111" style="max-width: 400px">
        <div>
            <fieldset>
                     <legend>Purchase Order</legend>
                    <div class="field-section single-column">
                    <div class="field-p">
                        <label>PO Number</label>
                        <input name="po_number" type="text" value="<?php echo $details['po_number'] ?>" readonly>
                    </div>
                    <div class="field-p">
                        <label>PO Date</label>
                        <input required name="po_date" type="text"  data-date-picker="" value="<?php echo $details['po_date'] ?>">
                    </div>
                    <div class="field-p">
                    <label>Status</label>
                    <?php if($details['po_status'] == 'Closed') { ?>

                        <input  required type="text" name ="po_status" value="<?php echo $details['po_status']; ?>" disabled>

                        <?php } else { ?>
                        <select  required name="po_status" id="status" data-filter="status" required data-default-select="<?php echo $details['po_status']; ?>">
                            <option value="Open">Open</option>
                            <option value="Pending">Pending</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                        <?php }  ?>
                    </div>
                    </div>
            </fieldset>
        </div>
        </section>
        <section class="section-111" style="max-width: 1200px">
            <div>
                <fieldset>
                   
                    <legend>Purchase Order Details</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Vendor</label>
                            <select  required name="vendor_id_fk" data-default-select="<?php echo $details['vendor_id_fk'] ?>"></select>
                        </div>
                        <div class="field-p">
                            <label>Delivery Date</label>
                            <input  required name="expected_delivery_date" type="text" data-date-picker="" value="<?php echo $details['expected_delivery_date'] ?>">
                        </div>
                        <div class="field-p">
                            <label>Shipment Preference</label>
                            <select  required name="shipment_preference_id_fk" data-default-select="<?php echo $details['shipment_preference_id_fk'] ?>"></select>
                        </div>
                        <div class="field-p">
                            <label>Payment Terms</label>
                            <select  required name="payment_term_id_fk" data-default-select="<?php echo $details['payment_term_id_fk'] ?>"></select>
                        </div>
                        <div class="field-p">
                            <label>Location</label>
                            <select required name="location_id_fk" data-default-select="<?php echo $details['location_id_fk'] ?>"></select>
                        </div>
                    </div>
                </fieldset>
                <br>

            </div>
        </section>
        <section class="section-111">
            <div>
                <fieldset>
                    <legend>Item Details</legend>
                    <div class="field-section table-rows">
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Rate</th>
                                    <th>Tax (%)</th>
                                    <th>Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="item_tbody">

                            </tbody>
                            <tfoot>

                                <tr>
                                    <td colspan="6" style="padding-right:50px;"><span id="total" data-total-amount>Total: 0</span></td>
                                    <td><button type="button" class="btn_blue" onclick="add_row({})">Add</button></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>
            </div>
        </section>
        <section class="action-button-box">

            <button type="submit" class="btn_green">SAVE</button>
            &nbsp; &nbsp;&nbsp;<button type="button" class="btn_green" onclick="back_alert()">BACK</button>
        </section>
    </form>
</section>
<script type="text/javascript">
    function save() {
        var $data_item_rows = $("[data-item-row]");
        var data_item_array = []

        $data_item_rows.each(function(index) {
            var $data_item_row = $(this);
            if ($data_item_row.find("[name=item_location_id_fk]").val()) {
                var stop_row = {
                    po_detail_id: $data_item_row.find("[name=po_detail_id]").val(),
                    po_detail_id_status: $data_item_row.find("[name=po_detail_id_status]").val(),
                    item_location_id_fk: $data_item_row.find("[name=item_location_id_fk]").val(),
                    quantity: $data_item_row.find("[name=quantity]").val(),
                    rate: $data_item_row.find("[name=rate]").val(),
                    tax: $data_item_row.find("[name=tax]").val(),
                }
                data_item_array.push(stop_row)
            }
        })
        if(!data_item_array.length){
            alert('Select atleast one item');
            return false;
        }
        //show_processing_modal()
        //submit_to_wait_btn('#submit', 'loading')
        $('#formErro').show()
        var form = document.getElementById('MyForm');
        var isValidForm = form.checkValidity();
        //var currentForm = $('#MyForm')[0];
        // var formData = new FormData(currentForm);
        if (isValidForm) {
            var arr = $('#MyForm').serializeArray();

            var form_data = new FormData();

            var obj = {
                update_eid: '<?php echo $details['eid']; ?>',
                vendor_id_fk: $('[name="vendor_id_fk"]').val(),
                expected_delivery_date: $('[name="expected_delivery_date"]').val(),
                shipment_preference_id_fk: $('[name="shipment_preference_id_fk"]').val(),
                payment_term_id_fk: $('[name="payment_term_id_fk"]').val(),
                po_date: $('[name="po_date"]').val(),
                po_status: $('[name="po_status"]').val(),
                location_id_fk: $('[name="location_id_fk"]').val(),
                item_array: JSON.stringify(data_item_array)

            }
            // console.log(obj);return false;
            // alert("data logged in console")
            for (var key in obj) {
                form_data.append(key, obj[key]);
            }
            form_data.append(key, obj[key]);
            $.ajax({
                url: window.location.pathname + '-action',
                type: 'POST',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                    }
                    alert(data.message);
                    if (data.status) {
                        window.history.back();
                        wait_to_submit_btn('#submit', 'ADD')
                        hide_processing_modal()
                    } else {
                        hide_processing_modal()
                        wait_to_submit_btn('#submit', 'ADD')
                    }
                }
            })
        }
        return false
    }
</script>
<script>
     function show_locations() {
        get_product_locations().then(function(data) {
            // Run this when your request was successful
            if (data.status) {

                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if(item.location_status == 'ACTIVE'){
                            options += `<option value="${item.id}">${item.location}</option>`;
                        }
                    })
                    $('[name="location_id_fk"]').html(options);
                    select_default('[name="location_id_fk"]')
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }

    show_locations();
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
                    $('[name="vendor_id_fk"]').html(options);
                    select_default('[name="vendor_id_fk"]')
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }

    show_vendors()

    function show_shipment_preferences() {
        get_shipment_preferences().then(function(data) {
            // Run this when your request was successful
            if (data.status) {

                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if(item.shipment_preference_status == 'ACTIVE'){
                            options += `<option value="${item.id}">${item.shipment_preference}</option>`;
                        }
                    })
                    $('[name="shipment_preference_id_fk"]').html(options);
                    select_default('[name="shipment_preference_id_fk"]')
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
                        if(item.payment_term_status == 'ACTIVE'){
                            options += `<option value="${item.id}">${item.payment_term}</option>`;
                        }
                    })
                    $('[name="payment_term_id_fk"]').html(options);
                    select_default('[name="payment_term_id_fk"]')
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }

    show_payment_terms()

    var items = [];
    $(document.body).on('change', '[name="location_id_fk"]', function() {
        var location_id = $(this).val();
        if(location_id){
            get_items(location_id);
        }
        else {
            html = `<tr><td colspan="7">Please select location</td></tr>`;
            $('#item_tbody').html(html);
            counter = 0;
            items = [];
            $('#add_btn').prop('disabled', true);
        }
        cal_total_amount();
    });
    get_items(<?php echo $details['location_id_fk'] ?>);

    function get_items(location_id){
    
        $.ajax({
        url: 'user/inventory/masters/items-location-list-ajax',
        type: 'POST',
        data: {location_id: location_id},
        beforeSend:function(){
            $('#item_tbody').html('');
            $('#add_btn').prop('disabled', true)
            items = [];
            counter = 0;
        },
        success:function(data){
            data=JSON.parse(data);
            
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    items = data.response.list;  
                    // add_item();
                    $('#add_btn').prop('disabled', false);
                    f();
                }
            } 
        }
        });
    }
</script>

<script>
    // var row_count = 1;

    // function add_item() {
    //     var html = `
    //     <tr id="row_${row_count}" data-item-row>
    //         <td></td>
    //         <td>
    //             <select style="width: 300px" name="item_location_id_fk" data-calulate-amount></select>
    //         </td>
    //         <td>
    //             <input name="quantity" type="number" value="0" data-calulate-amount>
    //         </td>
    //         <td>
    //             <input name="rate" type="number" value="0" data-calulate-amount>
    //         </td>
    //         <td>
    //             <input name="tax" type="number" value="0" data-calulate-amount>
    //         </td>
    //         <td>
    //             <input name="amount" type="number" readonly value="0">
    //         </td>
    //         <td>
    //             <button type="button" class="btn_red_c" data-remove-row=""><i class="fa fa-trash"></i></button>
    //         </td>
    //     </tr>
    //     `;
    //     // $('#row_'+(row_count-1)).after(html);
    //     $('#item_tbody').append(html);
    //     show_items('row_' + row_count);
    //     row_count += 1;
    // }
    function show_items(param) {
        if(items.length){
            var options = "";
            options += `<option value="">- - Select - -</option>`
            $.each(items, function(index, item) {
                if(item.status == 'ACTIVE'){
                    options += `<option value="${item.id}">${item.item_name}</option>`;
                }
            });
            $('tr#' + param.row_id + ' [name="item_location_id_fk"]').html(options);
            if (param.hasOwnProperty('default_select')) {
                $('tr#' + param.row_id + ' [name="item_location_id_fk"] option[value="' + param.default_select + '"]').prop('selected', true);
            }
        }
        
    }

    // function show_items(param) {
    //     get_items_list().then(function(data) {
    //         // Run this when your request was successful
    //         if (data.status) {

    //             //Run this if response has list
    //             if (data.response.list) {
    //                 var options = "";
    //                 options += `<option value="">- - Select - -</option>`
    //                 $.each(data.response.list, function(index, item) {
    //                     options += `<option value="${item.id}">${item.item_code} - ${item.product} ${item.maker} ${item.model}</option>`;
    //                 });
    //                 //$('tr#' + row_id + ' [name="item_location_id_fk"]').html(options);
    //                 $('tr#' + param.row_id + ' [name="item_location_id_fk"]').html(options);
    //                 if (param.hasOwnProperty('default_select')) {
    //                     $('tr#' + param.row_id + ' [name="item_location_id_fk"] option[value="' + param.default_select + '"]').prop('selected', true);
    //                 }
    //             }
    //         }
    //     }).catch(function(err) {
    //         // Run this when promise was rejected via reject()
    //     })
    // }

    //show_items('row_0');

    $(document.body).on('click', '[data-remove-row]', function() {
        let row_id=$(this).parents('tr').attr('id');
        if($('tr#'+row_id+' [name="po_detail_id"]').val()){
            $('tr#'+row_id+' [name="po_detail_id_status"]').val('DEL');
            $(this).parent().parent().hide();
        }
        else {
            $(this).parent().parent().remove();
        }
        // $(this).parent().parent().remove();
        cal_total_amount();
    });

    $(document.body).on('change', '[data-calulate-amount]', function() {
        let row_id = $(this).parents('tr').attr('id');
        let item = $('tr#' + row_id + ' [name="item_location_id_fk"]').val();
        if (item) {
            cal_total_amount()
        } else {
            $('tr#' + row_id + ' [name="quantity"]').val('1');
            $('tr#' + row_id + ' [name="rate"]').val('0');
            $('tr#' + row_id + ' [name="tax"]').val('0');
            $('tr#' + row_id + ' [name="amount"]').val('0');
            cal_total_amount();
        }
    });
</script>
<script type="text/javascript">
    function cal_total_amount() {
        $total_rows = $('[data-item-row]');
        let amount = 0;
        $total_rows.each(function(index, item) {
            let display = $(this).css('display') != 'none';

            if(display)
            {
                quantity = parseFloat($(this).find('[name="quantity"]').val());
                quantity = isNaN(quantity) ? 0 : quantity;
                rate = parseFloat($(this).find('[name="rate"]').val());
                rate = isNaN(rate) ? 0 : rate;
                tax = parseFloat($(this).find('[name="tax"]').val());
                tax = isNaN(tax) ? 0 : tax;
                sub_amount = rate * quantity;
                if (tax > 0) {
                    sub_amount = sub_amount + (tax / 100) * sub_amount;
                }
                $(this).find('[name="amount"]').val(sub_amount.toFixed(4));
                amount += sub_amount
            }
            
        })
        $('[data-total-amount]').html('Total: ' + amount.toFixed(2))
    }
</script>
<script type="text/javascript">
    var counter = 0
    var $issue_table = $('#storage_tbody');

    function add_row(param) {
        ++counter;
        if (param.hasOwnProperty('po_detail_id')) {
            po_detail_id = param.po_detail_id
        } else {
            po_detail_id = ''
        }
        if (param.hasOwnProperty('po_detail_id_status')) {
            po_detail_id_status = param.po_detail_id_status
        } else {
            po_detail_id_status = 'ACT'
        }
        if (param.hasOwnProperty('default_select_item_location_id_fk')) {
            default_select_item_location_id_fk = param.default_select_item_location_id_fk
        } else {
            default_select_item_location_id_fk = ''
        }
        if (param.hasOwnProperty('default_quantity')) {
            default_quantity = param.default_quantity
        } else {
            default_quantity = ''
        }
        if (param.hasOwnProperty('default_rate')) {
            default_rate = param.default_rate
        } else {
            default_rate = ''
        }
        if (param.hasOwnProperty('default_tax')) {
            default_tax = param.default_tax
        } else {
            default_tax = ''
        }
        var $add_row = `<tr id="row_${counter}" data-item-row>
            <td></td>
            <td>
                <input type="hidden" name="po_detail_id" value="${po_detail_id}" >
                <input type="hidden" name="po_detail_id_status" value="${po_detail_id_status}" >
                
                <select required style="width: 300px" name="item_location_id_fk" data-calulate-amount></select>
            </td>
            <td>
                <input required name="quantity" min="1" type="number" value="${(default_quantity) ? default_quantity : 1 }" data-calulate-amount>
            </td>
            <td>
                <input required name="rate" min="0" type="number" value="${(default_rate) ? default_rate : 0 }" data-calulate-amount>
            </td>
            <td>
                <input required name="tax" min="0" max="100" type="number" value="${(default_tax) ? default_tax : 0 }" data-calulate-amount>
            </td>
            <td>
                <input name="amount" type="number" readonly value="">
            </td>`;
        if (counter > 1) {
            $add_row += ` <td><button type="button" class="btn_red_c" data-remove-row=""><i class="fa fa-trash"></i></button></td>`;
        }
        $add_row += ` </tr>`;
        $('#item_tbody').append($add_row);
        show_items({
            row_id: 'row_' + counter,
            default_select: default_select_item_location_id_fk
        })
        cal_total_amount()
    }
</script>
<script type="text/javascript">
    async function f() {
        var items_list = '<?php echo json_encode($details['items']) ?>';
        items_list = JSON.parse(items_list)
        $.each(items_list, function(index, item) {
            add_row({
                po_detail_id: item.po_detail_id,
                po_detail_id_status: item.po_detail_id_status,
                default_select_item_location_id_fk: item.item_location_id_fk,
                default_quantity: item.quantity,
                default_rate: item.rate,
                default_tax: item.tax
                // default_po_detail_id: item.po_detail_id,
            })
        })
    }
    // f()
</script>
<script type="text/javascript">
    function back_alert() {
        if (confirm('Are you Sure ?')) {
            window.history.back();
        }
    }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>