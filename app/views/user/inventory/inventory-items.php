<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 500px">
    <h1 class="list-200-heading">Inventory - Items</h1>


    <section class="list-200-top-action">
        <div class="list-200-top-action-left">

            <!-- input used for sory by call-->
            <input type="hidden" id="sort_by" value="">
            <!-- //input used for sory by call-->

            <div class="filter-item">
                <label>Item Code</label>
                <input type="text" data-filter="item_code" onchange="set_params('item_code', this.value), goto_page(1)">
            </div>
            <div class="filter-item">
                <label>Location</label>
                <select data-filter="location_id" onchange="set_params('location_id', this.value), goto_page(1)">
                </select>
            </div>
            
            <!-- <div class="filter-item-full">
                <label>Search</label>
                <input type="text" placeholder="name / status" data-filter="search" onkeyup="show_list()">
                </select>
            </div> -->

        </div>
        

    </section>

    <div class="table  table-a">
        <table>
            <thead>
                <input type='hidden' id='sort' value='asc'>
                <tr>
                    <th>Sr. No.</th>
                    <th data-table-sort-by="code">Item Code</th>
                    <th data-table-sort-by="name">Item</th>
                    <th data-table-sort-by="location">Location</th>
                    <th data-table-sort-by="quantity_in">Quantity In</th>
                    <th data-table-sort-by="quantity_out">Quantity Out</th>
                    <th data-table-sort-by="quantity">Current Inventory</th>
                    <th>Amount</th>
                    <th>Reorder Level</th>
                    <th>Pending PO Quantity</th>
                    <th>Pending PO</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
    </div>
    <div data-pagination></div>
</section>
<script>

var url_params = get_params();
   
  if (url_params.hasOwnProperty('item_code')) {
      $("[data-filter='item_code']").val(url_params.item_code);
  }
  if (url_params.hasOwnProperty('location_id')) {
        $("[data-filter='location_id']").val(url_params.location_id);
    }

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
    function show_list() {
        var sort_by = $('#sort_by').val();
        var sort_by_order_type = $('#sort').val();
        var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
        var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
        var webapi = "pagination";
        //var value = $('[data-filter="search"]').val().toUpperCase();
        var item_code = check_url_params('item_code');
        var location_id = check_url_params('location_id');

        let param = {
           // value: value,
            page: page_no,
            sort_by: sort_by,
            batch: batch,
            sort_by_order_type: sort_by_order_type,
            webapi: webapi,
            item_code: item_code,
            location_id: location_id,
            
        }

        $.ajax({
            url: 'user/inventory/inventory-items-list-ajax',
            type: 'POST',
            data: param,
            beforeSend:function(){
                
            },
            success:function(data){
                data=JSON.parse(data);
                console.log(data); 
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
                                row += `<td>` + item.item_code + `</td>`;
                                row += `<td>` + item.product + ` ` + item.maker + ` ` + item.model + `</td>`;
                                row += `<td>` + item.location + `</td>`;
                                row += `<td>` + item.quantity_in + `</td>`;
                                row += `<td>` + item.quantity_out + `</td>`;
                                row += `<td>` + item.quantity + `</td>`;
                                row += `<td>` + item.amount + `</td>`;
                                row += `<td> Min:` + item.reorder_min + `<br> Max: ` + item.reorder_max + `</td>`;
                                row += `<td>` + item.po_quantity +  `</td>`;
                                row += `<td>`; 
                                // item.pos.forEach((m) => {
                                //     row += '<a href="#" >'+ m.po_number +'</a>';
                                //     ow += ()r 
                                // })
                                <?php if (in_array('P0417', USER_PRIV)) {
                                ?>
                                if(item.pos.length){
                                    for(let i=0; i<item.pos.length; i++){
                                        row += `<a  class="btn_grey_c" href="../user/inventory/purchase-orders/details?eid='${item.pos[i].po_eid}'">`+ item.pos[i].po_number +`</a>`;
                                        row += (i != (item.pos.length-1)) ? `,` : ``;
                                    }
                                }
                                <?php
                                } ?>

                                row +=`</td>`;
                                row += `<td>`;
                                <?php if (in_array('P0416', USER_PRIV)) {
                                ?>
                                    row += `<button title="Create PO" class="btn_grey_c"><a href="../user/inventory/purchase-orders/add-new?item-location-eid=`+item.eid+`">Create PO</a></button>`;
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
    function sort_table() {
        show_list()
    }
</script>

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>