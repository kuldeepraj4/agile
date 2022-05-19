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
                <label>Type</label>
                <select data-filter="type_id" onchange="set_params('type_id', this.value), goto_page(1)">
                </select>
            </div>
            <div class="filter-item">
                <label>Item</label>
                <select data-filter="product_id" onchange="set_params('product_id', this.value), goto_page(1)">
                </select>
            </div>
            <div class="filter-item">
                <label>Maker</label>
                <select data-filter="maker_id" onchange="set_params('maker_id', this.value), goto_page(1)">
                </select>
            </div>
            <div class="filter-item">
                <label>Model</label>
                <select data-filter="model_id" onchange="set_params('model_id', this.value), goto_page(1)">
                </select>
            </div>
            <div class="filter-item">
                <label>Status</label>
                <select data-filter="status" onchange="set_params('status', this.value), goto_page(1)">
                    <option value="">- - Select - -</option>
                    <option value="ACTIVE">ACTIVE</option>
                    <option value="INACTIVE">INACTIVE</option>
                </select>
            </div>
            <!-- <div class="filter-item-full">
                <label>Search</label>
                <input type="text" placeholder="name / status" data-filter="search" onkeyup="show_list()">
                </select>
            </div> -->

        </div>
        <div class="list-200-top-action-right">
            <div>
                <?php
                if (in_array('P0411', USER_PRIV)) {
                    echo "<button class='btn_grey button_href'><a href='../user/inventory/masters/items/add-new'>Add New</a></button>";
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
                    <th data-table-sort-by="code">Item Code</th>
                    <th data-table-sort-by="type">Type</th>
                    <th data-table-sort-by="name">Item Name</th>
                    <th data-table-sort-by="maker">Maker</th>
                    <th data-table-sort-by="model">Model</th>
                    <th>Description</th>
                    <th>Reorder Level</th>
                    <th>UOM</th>
                    <th data-table-sort-by="status">Status</th>
                    <th>Image</th>
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
  
  
    if (url_params.hasOwnProperty('item_code')) {
        $("[data-filter='item_code']").val(url_params.item_code);
    }
    if (url_params.hasOwnProperty('type_id')) {
        $("[data-filter='type_id']").val(url_params.type_id);
    }
    if (url_params.hasOwnProperty('product_id')) {
        $("[data-filter='product_id']").val(url_params.product_id);
    }
    if (url_params.hasOwnProperty('maker_id')) {
        $("[data-filter='maker_id']").val(url_params.maker_id);
    }
    if (url_params.hasOwnProperty('model_id')) {
        $("[data-filter='model_id']").val(url_params.model_id);
    }
    if (url_params.hasOwnProperty('status')) {
        $("[data-filter='status']").val(url_params.status);
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
        var item_code = check_url_params('item_code');
        var type_id = check_url_params('type_id');
        var product_id = check_url_params('product_id');
        var maker_id = check_url_params('maker_id');
        var model_id = check_url_params('model_id');
        var status = check_url_params('status');

        let param = {
           // value: value,
            page: page_no,
            sort_by: sort_by,
            batch: batch,
            sort_by_order_type: sort_by_order_type,
            webapi: webapi,
            item_code: item_code,
            product_id: product_id,
            type_id: type_id,
            maker_id: maker_id,
            model_id: model_id,
            status: status,
        }


        get_items_list(param).then(function(data) {
            // Run this when your request was successful
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
                            row += `<td>` + item.product_type + `</td>`;
                            row += `<td>` + item.product + `</td>`;
                            row += `<td>` + item.maker + `</td>`;
                            row += `<td>` + item.model + `</td>`;
                            row += `<td>` + item.description + `</td>`;
                            row += `<td> Min:` + item.reorder_min + `<br> Max: ` + item.reorder_max + `</td>`;
                            row += `<td>` + item.uom + `</td>`;
                            row += `<td>` + item.status + `</td>`;
                            if (item.item_image != '') {
                                row += `<td><span onclick='open_document("${item.item_image}")' class="fa fa-file" title="View Invoice" style="color:  grey;cursor:pointer;"></span></td>`;
                            } else {
                                row += '<td></td>';
                            }
                            row += `<td>` + item.item_added_by.user_code + `<br>` + item.item_added_by.user_name + `<br>` + item.item_added_on + `</td>`;
                            row += `<td>` + item.item_updated_by.user_code + `<br>` + item.item_updated_by.user_name + `<br>` + item.item_updated_on + `</td>`;
                            row += `<td style="white-space: nowrap">`;

                            <?php if (in_array('P0412', USER_PRIV)) {
                            ?>
                            row += `<button title="View" class="btn_grey_c"><a href="../user/inventory/masters/items/details?eid=${item.eid}"><i class="fa fa-eye"></i></a></button>`;
                            <?php
                            } ?>

                            <?php if (in_array('P0413', USER_PRIV)) {
                            ?>
                                 row += `<button title="Edit" class="btn_grey_c"><a href="../user/inventory/masters/items/update?eid=` + item.eid + `"><i class="fa fa-pen"></i></a></button>`;
                            <?php
                            } ?>
                            <?php if (in_array('P0414', USER_PRIV)) {
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
                if(check_url_params('page_no') > 1){
                    goto_page(1);
                   
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
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
    function show_products(){
        get_product_names({}).then(function(data) {
            // Run this when your request was successful
            if (data.status) {

                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                            options += `<option value="${item.id}">${item.product}</option>`;
                    })
                    $('[data-filter="product_id"]').html(options);
                    if (url_params.hasOwnProperty('product_id')) {
                        $("[data-filter='product_id'] option[value=" + url_params.product_id + "]").prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_products();

    function show_makers(){
        get_product_makers({}).then(function(data) {
                // Run this when your request was successful
                console.log(data);
                if (data.status) {

                    //Run this if response has list
                    if (data.response.list) {
                        var options = "";
                        options += `<option value="">- - Select - -</option>`
                        $.each(data.response.list, function(index, item) {
                                options += `<option value="${item.id}">${item.maker}</option>`;
                        })
                        $('[data-filter="maker_id"]').html(options);
                        if (url_params.hasOwnProperty('maker_id')) {
                            $("[data-filter='maker_id'] option[value=" + url_params.maker_id + "]").prop('selected', true);
                        }
                    }
                }
            }).catch(function(err) {
                // Run this when promise was rejected via reject()
            })
        }
        show_makers();

    function show_models(){
        get_product_models({}).then(function(data) {
                // Run this when your request was successful
            console.log(data);
            if (data.status) {

                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                            options += `<option value="${item.id}">${item.model}</option>`;
                    })
                    $('[data-filter="model_id"]').html(options);
                    if (url_params.hasOwnProperty('model_id')) {
                        $("[data-filter='model_id'] option[value=" + url_params.model_id + "]").prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_models();
    function show_product_type() {
        get_product_type().then(function(data) {
            // Run this when your request was successful
            if (data.status) {

                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                            options += `<option value="${item.id}">${item.product_type}</option>`;
                    })
                    $('[data-filter="type_id"]').html(options);
                    if (url_params.hasOwnProperty('type_id')) {
                        $("[data-filter='type_id'] option[value=" + url_params.type_id + "]").prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }

    show_product_type()
</script>

<script type="text/javascript">
    function sort_table() {
        show_list()
    }
</script>

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>