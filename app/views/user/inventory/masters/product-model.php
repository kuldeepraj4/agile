<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 500px">
    <h1 class="list-200-heading">Inventory - Models</h1>


    <section class="list-200-top-action">
        <div class="list-200-top-action-left">

            <!-- input used for sory by call-->
            <input type="hidden" id="sort_by" value="">
            <!-- //input used for sory by call-->

            <div class="filter-item-full">
                <label>Search</label>
                <input type="text" placeholder="Model/ Maker/ Product/ Product Type/ Status" data-filter="search" onkeyup="goto_page(1)">
                </select>
            </div>

        </div>
        <div class="list-200-top-action-right">
            <div>
                <?php
                if (in_array('P0406', USER_PRIV)) {
                echo "<button class='btn_grey button_href'><a href='../user/inventory/masters/product-model/add-new'>Add New</a></button>";
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
                    <th data-table-sort-by="model">Model</th>
                    <th data-table-sort-by="maker">Maker</th>
                    <th data-table-sort-by="product">Product Name</th>
                    <th data-table-sort-by="product_type">Product Type</th>
                    <th data-table-sort-by="status">Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
    </div>
    <div data-pagination></div>
</section>

<script type="text/javascript">
    function show_list() {
        var sort_by = $('#sort_by').val();
        var sort_by_order_type = $('#sort').val();
        var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
        var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
        var webapi = "pagination";
        var value = $('[data-filter="search"]').val().toUpperCase();

        let param = {
            // value: value,
            page: page_no,
            sort_by: sort_by,
            batch: batch,
            sort_by_order_type: sort_by_order_type,
            webapi: webapi,
            value: value

        }


        get_product_models(param).then(function(data) {
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
                        row += `<td>` + item.model + `</td>`;
                        row += `<td>` + item.maker + `</td>`;
                        row += `<td>` + item.product + `</td>`;
                        row += `<td>` + item.product_type + `</td>`;
                        row += `<td>` + item.model_status + `</td>`;
                        row += `<td>`;
                        <?php if (in_array('P0408', USER_PRIV)) {
                        ?>
                        row += `<button title="Edit" class="btn_grey_c"><a href="../user/inventory/masters/product-model/update?eid=` + item.eid + `"><i class="fa fa-pen"></i></a></button>`;
                        <?php
                        } 
                        ?>
                        <?php if (in_array('P0409', USER_PRIV)) {
                        ?>
                        row += `<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="` + item.eid + `"><i class="fa fa-trash"></i></button>`;
                        <?php
                        } 
                        ?>

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

<script type="text/javascript">
    function sort_table() {
        show_list()
    }
</script>

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>