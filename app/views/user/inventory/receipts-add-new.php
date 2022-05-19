<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];
// echo '<pre>';
// print_r($details);
// echo '</pre>';
// exit;
?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - Receipts</div>
    <form autocomplete="off" class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
        <section class="section-111">
            
        </section>
        <section class="section-111">
            <div>
                <fieldset>
                    <legend>PO Details</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>PO Number</label>
                            <div><?php echo $details['po_number'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>PO Date</label>
                            <div><?php echo $details['po_date'] ?></div>
                        </div>           
                        <div class="field-p">
                            <label>Vendor</label>
                            <div><?php echo $details['vendor_name'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Delivery Expected</label>
                            <div><?php echo $details['expected_delivery_date'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Shipment Preference</label>
                            <div><?php echo $details['shipment_preference'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Payment Term</label>
                            <div><?php echo $details['payment_term'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Location</label>
                            <div><?php echo $details['location'] ?></div>
                        </div>
                        
                    </div>
                </fieldset>
                </div>
                <div>
                    <fieldset>
                    <legend> Billing Details </legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                        <label>Payment Status</label>
                        <select id="mySelect" name="payment_status" required value="" data-optional>
                            <option value=""> - - Select - -</option>
                            <option value="PAID">Paid</option>
                            <option selected value="UNPAID">Unpaid</option>
                        </select>
                        </div>
                        <div class="field-p">
                            <label>Payment Mode</label>
                            <select disabled class="removereq mode1" name="payment_mode_id" id="payment_mode_id" type="text" required data-optional></select>
                        </div>
                        <div class="field-p">
                            <label>Payment Ref No</label>
                            <input disabled class="removereq mode2" name="payment_ref_no" type="text" required value="" data-optional>
                        </div>
                        <div class="field-p">
                            <label>Invoice No</label>
                            <input class="inv_no" name="invoice_no" type="text" required value="" data-optional>
                        </div>
                        <div class="field-p">
                            <label>Date Paid</label>
                            <input disabled class="removereq mode3" name="payment_date" type="text" data-date-picker="" required value="" data-optional>
                        </div>

                        <div class="field-p">
                            <label>Payment Notes</label>
                            <textarea name="payment_remarks" style="height: 80px"></textarea>
                        </div>
                        <div class="field-p">
                            <label>Invoice File</label>
                            <input class="inv_no" type="file" id="invoice_file" name="" required data-optional>
                        </div>
                        <div class="field-p">
                            <label>Received By</label>
                            <select disabled name="received_by"></select>
                        </div>

                    </div>
                    </fieldset>
                </div>
               
        </section>
        <section class="section-111">
            <div>
                <fieldset>
                    <legend>PO Item Details</legend>
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
                                    
                                </tr>
                            </thead>
                            <tbody id="po_item_tbody">
                                
                            </tbody>
                            <tfoot>

                                <tr>
                                <td colspan="6" style="padding-right:50px;font-weight: bold;"><span id="total">Total: 0</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>
            </div>
            <div>
                <fieldset>
                    <legend>Final Item Details</legend>
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
                                    
                                </tr>
                            </thead>
                            <tbody id="receipt_item_tbody">
                                
                            </tbody>
                            <tfoot>

                                <tr>
                                <td colspan="5" style="padding-right:50px;"><span id="total" data-total-amount>Total: 0</span></td>
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

            if (document.getElementById('invoice_file').files.length != 0) {
                var property = document.getElementById('invoice_file').files[0];
            }
            var form_data = new FormData();
            form_data.append(`document`, property);

            var obj = {
                
                po_id_fk: <?php echo $details['id'] ?>,
                amount: total_amount,
                payment_status: $('[name="payment_status"]').val(),
                payment_mode_id: $('[name="payment_mode_id"]').val(),
                payment_date: $('[name="payment_date"]').val(),
                payment_ref_no: $('[name="payment_ref_no"]').val(),
                invoice_no: $('[name="invoice_no"]').val(),
                payment_remarks: $('[name="payment_remarks"]').val(),
                received_by: $('[name="received_by"]').val(),
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
     $(document.body).on('change', '#mySelect' ,function() {
    var value = $(this).val();
    if (value === "UNPAID") {
      $(".removereq").prop('required', false)
      $(".inv_no").prop('required', false)
      $('.mode1').prop('selectedIndex', 0).prop('disabled', true);
      $('.mode2').val('').prop('disabled', true);
      $('.mode3').val('').prop('disabled', true);
      $('[name="received_by"]').val('').prop('disabled', true);
    } else if (value === "PAID") {
      $(".inv_no").prop('required', true)
      $(".removereq").prop('required', true)
      $(".removereq").prop('disabled', false)
      $('[name="received_by"]').val('').prop('disabled', false);
    } else if (value === "") {
      $(".inv_no").prop('required', true)
      $(".removereq").prop('required', false)
      $('.mode1').prop('selectedIndex', 0).prop('disabled', true);
      $('.mode2').val('').prop('disabled', true);
      $('.mode3').val('').prop('disabled', true);
      $('[name="received_by"]').val('').prop('disabled', true);
    }
    $('[data-chage-required-field]').each(function(e) {
      if ($(this).prop("checked") == true) {
        $('[data-optional]').prop('required', false)
      }
    })
  });

  
</script>
<script type="text/javascript">
  quick_list_payment_modes().then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="` + item.id + `">` + item.name + `</option>`;
        })
        $('[name="payment_mode_id"]').html(options);
      }
    }
  })
</script>
<script type="text/javascript">

    function set_po_items()
    {
        var items_list = '<?php echo json_encode($details['items']) ?>';
        items_list = JSON.parse(items_list);
        if(items_list.length > 0){

            let count = 1;
            let total = 0;
            $.each(items_list, function(index, item) {
                let sub_total = 0;
                sub_total = item.rate * item.quantity;
                if (item.tax > 0) {
                    sub_total = sub_total + (item.tax / 100) * sub_total;
                }
                total = total + sub_total;
                html = `
                    <tr>
                        <td>${count}</td>
                        <td>${item.item_name}</td>
                        <td>${item.quantity}</td>
                        <td>${item.rate}</td>
                        <td>${item.tax}</td>
                        <td>${sub_total.toFixed(2)}</td>
                    </tr>
                    `;
                $('#po_item_tbody').append(html);
                count++;
            });
            $('#total').html('Total: '+total.toFixed(2));
        }
    }
    set_po_items();
    

</script>
<script type="text/javascript">
    var counter = 0
    var $issue_table = $('#receipt_item_tbody');

    function add_row(param) {
        ++counter;

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
                
                <select required style="width: 200px" name="item_location_id_fk" data-calulate-amount></select>
            </td>
            <td>
                <input required style="width: 100px" name="quantity" type="number" min="1" value="${(default_quantity) ? default_quantity : 1 }" data-calulate-amount>
            </td>
            <td>
                <input required style="width: 100px" min="0" name="rate" type="number" value="${(default_rate) ? default_rate : 0 }" data-calulate-amount>
            </td>
            <td>
                <input required style="width: 100px" min="0" max="100" name="tax" type="number" value="${(default_tax) ? default_tax : 0 }" data-calulate-amount>
            </td>
            <td>
                <input style="width: 100px" name="amount" type="number" readonly value="">
            </td>`;
        if (counter > 1) {
            $add_row += ` <td><button type="button" class="btn_red_c" data-remove-row=""><i class="fa fa-trash"></i></button></td>`;
        }
        $add_row += ` </tr>`;
        $('#receipt_item_tbody').append($add_row);
        show_items({
            row_id: 'row_' + counter,
            default_select: default_select_item_location_id_fk
        })
        cal_total_amount();
    }

    var items = [];
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
    var total_amount = 0;
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
                $(this).find('[name="amount"]').val(sub_amount.toFixed(2));
                amount += sub_amount
            }
            
        })
        total_amount = amount.toFixed(2);
        $('[data-total-amount]').html('Total: ' + amount.toFixed(2));
    }
    $(document.body).on('change', '[data-calulate-amount]', function() {
        let row_id = $(this).parents('tr').attr('id');
        let item = $('tr#' + row_id + ' [name="item_location_id_fk"]').val();
        if (item) {
            cal_total_amount()
        } else {
            $('tr#' + row_id + ' [name="quantity"]').val('0');
            $('tr#' + row_id + ' [name="rate"]').val('0');
            $('tr#' + row_id + ' [name="tax"]').val('0');
            $('tr#' + row_id + ' [name="amount"]').val('0');
            cal_total_amount();
        }
    });
    $(document.body).on('click', '[data-remove-row]', function() {
        $(this).parent().parent().remove();
        cal_total_amount()
    });
</script>
<script type="text/javascript">
    async function f() {
        var items_list = '<?php echo json_encode($details['items']) ?>';
        items_list = JSON.parse(items_list)
        $.each(items_list, function(index, item) {
            add_row({
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
  function get_users() {
    quick_list_users().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[name="received_by"]').html(options);
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  
  get_users();
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