<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="rv content-box" style="margin: auto;max-width: 1300px !important;">
    <h1 class="rv-heading">Trailer Tracking</h1>
    <section class="rv-filter-section">
        <!-- input used for sory by call-->
        <input type="hidden" id="sort_by" value="">
        <!-- //input used for sory by call-->
        <div class="filter-item fourth">
            <label>Trailer</label>
            <input type="text" data-filter="trailer_id" list="quick_list_trailers" data-trailer-id>
        </div>
        <div class="filter-item fourth">
            <label>Current Status</label>
            <select data-filter="current_status_id" onchange="set_params('current_status_id', this.value), goto_page(1)"></select>
        </div>
        <div class="filter-item fourth">
        </div>
        <div class="filter-item fourth">
        </div>
    </section>
    <div class="rv-table fixedheader">
        <input type='hidden' id='sort' value='asc'>
        <table data-my-table>
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th data-table-sort-by="code">Trailer</th>
                    <th data-table-sort-by="current_status_id">Current Status</th>
                    <th>Driver</th>
                    <th>Trailer</th>
                    <th>Load</th>
                    <th>Delivery Location</th>
                    <th data-table-sort-by="delivery_date">Delivery Date</th>
                    <th>Delivery Time</th>
                    <th>Load Status</th>
                    <th style="max-width: 200px !important;">Location</th>
                    <th></th>
                    <th>Exp. Delivery datetime</th>
                   <!--  <th>Action</th> -->
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
            url: '../user/dispatch/tracking/tracking-trailer-ajax',
            type: 'POST',
            data: {
                sort_by: $('#sort_by').val(),
                sort_by_order_type: $('#sort').val(),
               // page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
                //batch: (check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
               // webapi: 'pagination',
                current_status_id: check_url_params('current_status_id'),
                trailer_id: check_url_params('trailer_id'),
            },
            beforeSend: function() {
                show_table_data_loading("[data-my-table]")
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    console.log(data)
                    $('#tabledata').html("");
                    if (data.status) {
                        // var counter = 1;
                        $.each(data.response.list, function(index, item) {
                            var row = `<tr>
                                    <td>${item.sr_no}</td>`;
                            if (item.eid != "") {
                                row += `<td class="bg-white"><span class="text-link"  onclick="open_quick_view_trailer('${item.eid}')">${item.trailer_code}</span></td>`;
                            } else {
                                row += `<td class="bg-white"></td>`;
                            }
                            row += ` <td>${item.current_status}</td>
                            <td>${item.driver_a} ${(item.is_team_driver=='TEAM')?`<b>T</b><br>${item.driver_b}`:''}</td>
           <td>${item.truck_code}</td>
                                    <td>${item.load_id}</td>
                                    <td>${item.load_consignee_location}</td>
           <td>${(item.load_delivery_date!="")?date_format(item.load_delivery_date):""}</td>
           <td>${item.load_delivery_time}</td>
           <td>${item.load_status}</td>
                                    <td style="max-width: 200px !important;">${item.location}</td>`;
                                    if(item.updated_mode == "AUTO"){
                                    row+=`<td>${item.updated_on}<br>Auto</td>`;
                                    }else{
                                        row+=`<td>${item.updated_on}<br>${item.updated_by}</td>`;
                                    }
                                    row+=`<td>${item.load_expected_delivery} ${(item.load_expected_delivery!='')?`<i onclick="open_child_window({url:'../user/dispatch/loads/update-expected-delivery?eid=${item.load_eid}',width:500,height:500,name:'edit-expected-delivery'})" class="ic edit" title="Update Expected Delivery"></i>`:``}</td>`
                                    //row += `<td></td>`;
                            row += `</tr>`;
                            $('#tabledata').append(row);
                        })
                        // set_pagination({
                        //     selector: '[data-pagination]',
                        //     totalPages: data.response.totalPages,
                        //     currentPage: data.response.currentPage,
                        //     batch: data.response.batch
                        // })
                    } else {
                        $('#tabledata').html("");
                        var row = `<tr><td colspan="5">` + data.message + `</td></tr>`;
                        $('#tabledata').append(row);
                        // $('[data-pagination]').html('');
                    }
                }
            }
        })
    }
    show_list()
</script>
<!-- -----------------------------trailer function start here ---------------------------------------->
<datalist id="quick_list_trailers"></datalist>
<script type="text/javascript">
    $(document.body).on('input', '[data-trailer-id]', function() {
        id_selected = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
        //eid_selected = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('eid');
        if (id_selected != undefined) {
            $(this).data('trailer-id', id_selected)
            set_params('trailer_id', id_selected)
            set_params('trailer_name', $(`[data-trailer-id]`).val())
             goto_page(1)
        }
    });
</script>
<script type="text/javascript">
    $(document.body).on('change', '[data-trailer-id]', function() {
        id_selected = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
        if (id_selected == undefined) {
            alert("Please enter correct TrailerID")
            set_params('trailer_id', '')
            set_params('trailer_name', '')
            $(`[data-trailer-id]`).val('')
            goto_page(1)
        }
    });
</script>
<script type="text/javascript">
    quick_list_trailers().then(function(data) {
        if (data.status) {
            if (data.response.list) {
                var options = "";
                options += `<option data-trailer-id-rows="" data-value="" value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option data-trailer-id-rows="` + item.code + `" data-value="${item.id}" data-eid="${item.eid}" value="` + item.code + `"></option>`;
                })
                $('#quick_list_trailers').html(options);
                if (url_params.hasOwnProperty('trailer_name')) {
                    $(`[data-trailer-id]`).val(check_url_params('trailer_name'))
                }
            }
        }
    }).catch(function(err) {})
</script>
<!-- -----------------------------trailer function end here ---------------------------------------->

<script type="text/javascript">
    get_asset_current_status_trailer().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
            //Run this if response has list
            if (data.response.list) {
                var options = "";
                options += `<option value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option value="` + item.id + `">` + item.name + `</option>`;
                })
                $('[data-filter="current_status_id"]').html(options);
                if (url_params.hasOwnProperty('current_status_id')) {
                    $("[data-filter='current_status_id'] option[value=" + check_url_params('current_status_id') + "]").prop('selected', true);
                }
            }
        }
    }).catch(function(err) {
        // Run this when promise was rejected via reject()
    })
</script>

<script type="text/javascript">
    function sort_table() {
        show_list()
    }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>