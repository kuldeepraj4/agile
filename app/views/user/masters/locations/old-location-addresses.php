<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1200px">
    <h1 class="list-200-heading">OLD Location Addresses</h1>
    <section class="list-200-top-action">
        <div class="list-200-top-action-left">
            <input type="hidden" id="sort_by" value="">
            <input type='hidden' id='sort' value='asc'>
            <div class="filter-item-full">
                <label>Status</label>
                <select data-filter="status_id" onchange="set_params('status_id', this.value), goto_page(1)">
                    <option value="">--- Select ---</option>
                    <option value="CONVERTED">Converted</option>
                    <option value="PENDING">Pending</option>
                    <option value="REJECTED">Rejected</option>
                    <!-- <input type="text" placeholder="ID/ Name/ City/ State" data-filter="search" onkeyup="set_params('page_no', 1);show_list()"> -->
                </select>
            </div>
            <!-- <div class="filter-item-full">
                <label>State</label>
                <select data-filter="state_id" onchange="set_params('state_id', this.value), show_cities({state_id:this.value}), goto_page(1)"></select>
            </div>
            <div class="filter-item-full">
                <label>City</label>
                <select data-filter="city_id" onchange="set_params('city_id', this.value), goto_page(1)"></select>
            </div> -->

        </div>
        <div class=" list-200-top-action-right">
            <div>
                <?php
                // if (in_array('P0178', USER_PRIV)) {
                //     echo "<button class='btn_grey button_href'><a href='../user/masters/locations/location-addresses/add-new'>Add New</a></button>";
                // }
                ?>
            </div>
        </div>
    </section>
    <div class="table  table-a">
        <table data-table-td-counter>
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th style="text-align:left;">Location Name</th>
                    <th data-table-sort-by="address" style="text-align:left;">Address</th>
                    <th data-table-sort-by="state" style="text-align:left;">State</th>
                    <th data-table-sort-by="city" style="text-align:left;">City</th>
                    <th data-table-sort-by="zipcode" style="text-align:left;">Zipcode</th>
                    <th style="text-align:left;">Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
    </div>
    <div data-pagination></div>
</section>
<script type="text/javascript">
    var url_params = get_params();
    if (url_params.hasOwnProperty('status_id')) {} else {
        set_params('status_id', 'PENDING')

    }
    if (url_params.hasOwnProperty('status_id') && url_params.status_id == "PENDING") {
        $("[data-filter='status_id'] option[value='PENDING']").prop('selected', true);
    }
    if (url_params.hasOwnProperty('status_id') && url_params.status_id == "CONVERTED") {
        $("[data-filter='status_id'] option[value='CONVERTED']").prop('selected', true);
    }
    if (url_params.hasOwnProperty('status_id') && url_params.status_id == "REJECTED") {
        $("[data-filter='status_id'] option[value='REJECTED']").prop('selected', true);
    }
</script>
<script type="text/javascript">
    function show_list() {
        show_table_data_loading('[data-table-td-counter]');
        var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
        var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
        var webapi = "pagination";
        var sort_by = check_url_params('sort_by_value');
        //var value = $('[data-filter="status_id"]').val().toUpperCase();
        var value = check_url_params('status_id')
        var city_id = check_url_params('city_id')
        var state_id = check_url_params('state_id')
        var sort_by_order_type = check_url_params('sort_asc_desc');
        let param = {
            sort_by_order_type: sort_by_order_type,
            sort_by: sort_by,
            page: page_no,
            batch: batch,
            webapi: webapi,
            value: value
        }
        get_old_location_addresses(param).then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    $('#tabledata').html("");
                    $.each(data.response.list, function(index, item) {
                        // if (item.name.toUpperCase().includes(value) || item.address_line.toUpperCase().includes(value) || item.city.toUpperCase().includes(value) || item.state.toUpperCase().includes(value)) {
                        var row = `<tr>
    <td>${item.sr_no}</td>
    <td style="text-align:left;">${item.name}</td>
    <td style="text-align:left;">${item.address}</td>
    <td style="text-align:left;">${item.state}</td>
    <td style="text-align:left;">${item.city}</td>
    <td style="text-align:left;">${item.zipcode}</td>
    <td style="text-align:left;">${item.status}</td>`;
                        row += `<td>`;
                        if (item.status == "CONVERTED" || item.status == "REJECTED") {
                            row += ``;
                        } else {
                            row += `<button class="btn_grey button_href"><a href="../user/masters/locations/old-location-addresses/convert-from-old?eid=` + item.eid + `">Convert</a></button>&nbsp;<button title="Delete" class="btn_grey" data-action="reject" data-eid="` + item.eid + `">REJECT</button>`;
                        }
                        row += `</td>`;




                        <?php if (in_array('P0181', USER_PRIV)) {
                        ?>
                            //row+=`<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="`+item.eid+`"><i class="fa fa-trash"></i></button>`;
                        <?php
                        } ?>

                        row += `</tr>`;
                        $('#tabledata').append(row);
                        // }
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
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_list()
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", "[data-action='delete']", function() {
            if (confirm('Do you want to delete address location ?')) {
                var eid = $(this).data("eid");
                $.ajax({
                    url: window.location.pathname + '/delete-action',
                    type: 'POST',
                    data: {
                        delete_eid: eid
                    },
                    context: this,
                    success: function(data) {
                        if ((typeof data) == 'string') {
                            data = JSON.parse(data)
                        }
                        if (data.status) {
                            $(this).parent().parent().fadeOut();
                        } else {
                            alert(data.message)
                        }
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", "[data-action='reject']", function() {
            if (confirm('Do you want to reject this address location ?')) {
                var eid = $(this).data("eid");
                $.ajax({
                    url: window.location.pathname + '/reject-action',
                    type: 'POST',
                    data: {
                        reject_eid: eid
                    },
                    context: this,
                    success: function(data) {
                        if ((typeof data) == 'string') {
                            data = JSON.parse(data)
                        }
                        if (data.status) {
                            $(this).parent().parent().fadeOut();
                        } else {
                            alert(data.message)
                        }
                    }
                });
            }
        });
    });
</script>
<!-- <script type="text/javascript">
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
                $('[data-filter="state_id"]').html(options);
            }
        }
    })


    function show_cities(param) {
    if (param.state_id === '') {
      $('[data-filter="city_id"]').html('');
  } else if (param.state_id !== '') {
      get_cities(param).then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options += `<option value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
            $('[data-filter="city_id"]').html(options);
        }
    }
    else {
      var options = "";
      options += `<option value="">- - Select - -</option>`
      $('[data-filter="city_id"]').html(options);
  }
}).catch(function(err) {
        // Run this when promise was rejected via reject()
    })
}
}
</script> -->
<script type="text/javascript">
    function sort_table() {
        show_list()
    }
</script>
<script>
    $(document).ready(function() {
      $("[data-table-sort-by]").on("click", function() {
        var sort_asc_desc = $("#sort").val();
       if (sort_asc_desc == "asc") {
         // $("#sort").val("desc");
          set_params('sort_asc_desc', "desc")
        } else {
         // $("#sort").val("asc");
          set_params('sort_asc_desc', "asc")
        }
        //--remove the active sort by tag from all options
       // $("[data-table-sort-by]").removeAttr("data-table-sort-by-active");
        //---add sort by tag to the currently selected option
        //$(this).attr("data-table-sort-by-active", "");
        //---get the value by which sort is clickd
        let sort_by_value = $(this).data("table-sort-by");
        set_params('sort_by_value', sort_by_value)
        //---assign this value to #sort_by input filed;  
       // $('#sort_by').val(sort_by);
        sort_table()
      });
    });
  </script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>