<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="rv content-box" style="margin: auto;max-width: 1600px">
    <h1 class="rv-heading">West Delivery Assignment</h1>
    <div class="rv-table fixedheader">
        <input type='hidden' id='sort' value='asc'>
        <table data-my-table>
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Driver/Truck Assignment</th>
                    <th>Current Truck On Dispatch</th>
                    <th>Customer</th>
                    <th>PO#</th>
                    <th>Trailer</th>
                    <th>First Delivery</th>
                    <th>Destination</th>
                    <th>First Delivery Date</th>
                    <th>First Delivery Appt. Time</th>
                    <th>Temp</th>
                    <th>Remarks</th>
                    <th>Arrival In and Out</th>
                    <th>Load Status</th>
                    <th>Current Trailer Location</th>
                    <th>Trailer Type</th>
                    <th>Zone</th>
                    <th>Next Plan</th>
                    <th>Trailer RO Open</th>
                    <th>Criticality Level</th>
                    <th>Assigned</th>
                    <th>Delivered</th>
                    <th>BOLS Updated</th>
                    <th>Checked by</th>
                </tr>
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
    </div>
    <div data-pagination></div>
</section>
<script type="text/javascript">
    function show_list() {
        $.ajax({
            url: '../user/dispatch/trailers-planning-ajax',
            type: 'POST',
            data: {
                sort_by: $('#sort_by').val(),
                sort_by_order_type: $('#sort').val(),
                page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
                batch: (check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
                webapi: 'pagination',
            },
            beforeSend: function() {
                show_table_data_loading("[data-my-table]")
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    $('#tabledata').html("");
                    if (data.status) {
                        var counter = 1;
                        $.each(data.response.list, function(index, item) {
                            var row = `<tr>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>
           <td>${counter}</td>`;
                            row += `</tr>`;
                            $('#tabledata').append(row);
                        })
                        set_pagination({
                            selector: '[data-pagination]',
                            totalPages: data.response.totalPages,
                            currentPage: data.response.currentPage,
                            batch: data.response.batch
                        })
                    } else {
                        $('#tabledata').html("");
                        var row = `<tr><td colspan="5">` + data.message + `</td></tr>`;
                        $('#tabledata').append(row);
                        $('[data-pagination]').html('');
                    }
                }
            }
        })
    }
    show_list()
</script>
<!-- -----------------------------Driver function start here ------------------------------------------------------>
<!-- <script type="text/javascript">
    $(document.body).on('input', '[data-driver-id]', function() {
        id_selected = $(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
        if (id_selected != undefined) {
            $(this).data('driver-id', id_selected)
            set_params('driver_id', id_selected)
            set_params('driver_name', $(`[data-driver-id]`).val())
            goto_page(1)
        }
    });
</script>
<script type="text/javascript">
    $(document.body).on('change', '[data-driver-id]', function() {
        id_selected = $(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
        if (id_selected == undefined) {
            alert("Please enter correct DriverID")
            set_params('driver_id', '')
            set_params('driver_name', '')
            $(`[data-driver-id]`).val('')
            goto_page(1)
        }
    });
</script>
<datalist id="quick_list_drivers"></datalist>
<script type="text/javascript">
    function show_quick_list_drivers() {
        quick_list_drivers().then(function(data) {
            if (data.status) {
                if (data.response.list) {
                    var options = "";
                    options += `<option data-driver-filter-rows="" data-value="" value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option data-driver-filter-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" value="` + item.code + ' ' + item.name + `"></option>`;
                    })
                    $('#quick_list_drivers').html(options);
                    if (url_params.hasOwnProperty('driver_name')) {
                        $(`[data-driver-id]`).val(check_url_params('driver_name'))
                        // $("[data-filter='vehicle_id'] option[value=" + url_params.vehicle_id + "]").prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {})
    }
    show_quick_list_drivers()
</script> -->
<!-- -----------------------------Driver function end here ------------------------------------------------------>
<!-- -----------------------------truck function start here ------------------------------------------------------>
<!-- <datalist id="quick_list_trucks"></datalist>
<script type="text/javascript">
    $(document.body).on('input', '[data-truck-id]', function() {
        id_selected = $(`[data-truck-id-rows="${$(this).val()}"]`).data('value');
        //eid_selected = $(`[data-truck-id-rows="${$(this).val()}"]`).data('eid');
        if (id_selected != undefined) {
            $(this).data('truck-id', id_selected)
            set_params('truck_id', id_selected)
            set_params('truck_name', $(`[data-truck-id]`).val())
            goto_page(1)
        }
    });
</script>
<script type="text/javascript">
    $(document.body).on('change', '[data-truck-id]', function() {
        id_selected = $(`[data-truck-id-rows="${$(this).val()}"]`).data('value');
        if (id_selected == undefined) {
            alert("Please enter correct TruckID")
            set_params('truck_id', '')
            set_params('truck_name', '')
            $(`[data-truck-id]`).val('')
            goto_page(1)
        }
    });
</script>
<script type="text/javascript">
    quick_list_trucks().then(function(data) {
        if (data.status) {
            if (data.response.list) {
                var options = "";
                options += `<option data-truck-id-rows="" data-value="" value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option data-truck-id-rows="` + item.code + `" data-value="${item.id}" data-eid="${item.eid}" value="` + item.code + `"></option>`;
                })
                $('#quick_list_trucks').html(options);
                if (url_params.hasOwnProperty('truck_name')) {
                    $(`[data-truck-id]`).val(check_url_params('truck_name'))
                }
            }
        }
    }).catch(function(err) {})
</script> -->
<!-- -----------------------------truck function end here ---------------------------------------->
<!-- -----------------------------trailer function start here ---------------------------------------->
<!-- <datalist id="quick_list_trailers"></datalist>
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
</script> -->
<!-- -----------------------------trailer function end here ---------------------------------------->
<script type="text/javascript">
    function sort_table() {
        show_list()
    }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>