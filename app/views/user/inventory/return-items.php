<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 500px">
    <h1 class="list-200-heading">Item Returned</h1>


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
                <label>Item Code</label>
                <input type="text" data-filter="item_code" onchange="set_params('item_code', this.value), goto_page(1)">
            </div>
            <div class="filter-item">
                <label>Location</label>
                <select data-filter="location_id" onchange="set_params('location_id', this.value), goto_page(1)">
                </select>
            </div>
            <div class="filter-item">
                <label>Issue Number</label>
                <input type="text" data-filter="issued_number" onchange="set_params('issued_number', this.value), goto_page(1)">
            </div>
            <div class="filter-item">
                <label>Return Number</label>
                <input type="text" data-filter="returned_number" onchange="set_params('returned_number', this.value), goto_page(1)">
            </div>
           

        </div>
        <div class="list-200-top-action-right">
            <div>
                <?php
                if (in_array('P0431', USER_PRIV)) {
                    if(!empty($_GET['issue-eid'])){
                    echo "<button class='btn_grey button_href'><a href='../user/inventory/return-items/add-new?issue-eid=".$_GET['issue-eid']."'>Return Item</a></button>";
                    }
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
                    <th data-table-sort-by="issued_number">Issue Number</th>
                    <th data-table-sort-by="returned_number">Return Number</th>
                    <th data-table-sort-by="item_name">Item</th>
                    <th data-table-sort-by="location">Location</th>
                    <th data-table-sort-by="returned_date">Returned Date</th>
                    <th>Returned To</th>
                    <th>Returned By</th>
                    <th>Returned Quantity</th>
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
<script>
    var url_params = get_params();
  
  
  if (url_params.hasOwnProperty('item_code')) {
      $("[data-filter='item_code']").val(url_params.item_code);
  }
  if (url_params.hasOwnProperty('issued_number')) {
      $("[data-filter='issued_number']").val(url_params.issued_number);
  }
  if (url_params.hasOwnProperty('returned_number')) {
      $("[data-filter='returned_number']").val(url_params.returned_number);
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
        var issue_eid = (check_url_params('issue-eid') != undefined) ? check_url_params('issue-eid') : '';
        var item_code = check_url_params('item_code');
        var issued_number = check_url_params('issued_number');
        var returned_number = check_url_params('returned_number');
        var location_id = check_url_params('location_id');

        let param = {
           // value: value,
            page: page_no,
            sort_by: sort_by,
            batch: batch,
            sort_by_order_type: sort_by_order_type,
            webapi: webapi,
            issue_eid: issue_eid,

            item_code: item_code,
            issued_number: issued_number,
            returned_number: returned_number,
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
                            row += `<td>` + item.issued_number + `</td>`;
                            row += `<td>` + item.returned_number + `</td>`;
                            row += `<td>` + item.item_name + `</td>`;
                            row += `<td>` + item.location + `</td>`;
                            row += `<td>` + item.returned_date + `</td>`;
                            row += `<td>` + item.returned_to + `</td>`;
                            row += `<td>` + item.returned_by + `</td>`;
                            row += `<td>` + item.returned_quantity + `</td>`;

                            row += `<td>` + item.ri_added_by.user_code + `<br>` + item.ri_added_by.user_name + `<br>` + item.ri_added_on + `</td>`;
                            row += `<td>` + item.ri_updated_by.user_code + `<br>` + item.ri_updated_by.user_name + `<br>` + item.ri_updated_on + `</td>`;
                            
                            row += `<td style="white-space: nowrap">`;
                            <?php if (in_array('P0433', USER_PRIV)) {
                            ?>
                                 row += `<button title="Edit" class="btn_grey_c"><a href="../user/inventory/return-items/update?eid=` + item.eid + `"><i class="fa fa-pen"></i></a></button>`;
                            <?php
                            } ?>
                            <?php if (in_array('P0434', USER_PRIV)) {
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