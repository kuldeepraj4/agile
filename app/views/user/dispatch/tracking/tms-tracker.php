<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="rv content-box" style="margin: auto;max-width: 1600px">
    <h1 class="rv-heading">TMS Tracker</h1>
    <h1 class="rv-heading" style="font-size:medium;margin-bottom:-10px;">Long Haul</h1>
    <div class="rv-table fixedheader">
        <input type='hidden' id='sort' value='asc'>
        <table data-my-table>      <!--  table for LONG HAUL TRUCK - trailer-->
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Truck</th>
                    <th>Group</th>
                    <th>Driver</th>
                    <th>Route</th>
                    <th>Broker</th>
                    <th>Load #</th>
                    <th>Trailer</th>
                    <th>Pick Up Location</th>
                    <th>No. Of Drops</th>
                    <th>Delivery Location</th>
                    <th>Next Action</th>
                    <th>Delivery Date</th>
                    <th>Delivery TIme</th>
                    <th>Reefer</th>
                    <th>Load Status</th>
                    <th>Current Location</th>
                    <th>ETA</th>
                    <th>Tracking Status</th>
                    <th>Truck Wise Plan</th>
                    <th>Trailer Wise Planning - Back Haul</th>
                </tr>
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
    </div>
    <div data-pagination></div>
</section>
<script type="text/javascript">
    function show_list() {            // show list function for LONG HAUL TRUCK - trailer
        $.ajax({
            url: '../user/dispatch/tracking/tms-truck-group-wise-ajax',
            type: 'POST',
            data: {
                sort_by: $('#sort_by').val(),
                sort_by_order_type: $('#sort').val(),
                // page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
                // batch: (check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
                // webapi: 'pagination',
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
           <td>${item.sr_no}</td>
           <td>${item.truck_code}</td>                 
           <td>${item.truck_group}</td>                 
           <td>${item.driver_name}</td>`

           if(item.load_id!=""){
               row+= `                
           <td>${item.shipper_location} to ${item.consignee_location}</td>                 
           <td>${item.customer_code}</td>
           <td>${item.load_id}</td>                    
           <td>${item.trailer_code}</td>               
           <td>${item.shipper_location}</td>           
           <td>${item.total_drops}</td>                
           <td>${item.consignee_location}</td>         
           <td>${item.truck_code}</td>                 
           <td>${date_format(item.delivery_date)}</td>              
           <td>${item.delivery_time}</td>              
           <td>${item.reefer_temperature}</td>         
           <td>${item.load_status_id}</td>             
           `
           }else{
            row+=`<td></td>                    
           <td></td>               
           <td></td>               
           <td></td>               
           <td></td>           
           <td></td>         
           <td></td>                 
           <td></td>              
           <td></td>              
           <td></td>         
           <td></td>             
           <td></td>`
           }                 
                        
           row+=`<td>${item.truck_current_location}</td>
           <td></td>                 
           <td></td>                 
           <td></td>                 
           <td></td>`;               
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