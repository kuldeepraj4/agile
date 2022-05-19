<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="rv content-box" style="margin: auto;max-width: 1600px">
    <h1 class="rv-heading">Cross Docks</h1>
    <section class="rv-filter-section">
        <!-- input used for sory by call-->
        <input type="hidden" id="sort_by" value="">
        <!-- //input used for sory by call-->
        <div class="filter-item fourth">
            <label>Load No.</label>
            <input type="text" data-filter="po_number" onchange="set_params('po_number', this.value), goto_page(1)">
        </div>
        <div class="filter-item fourth">
            <label>Shipper</label>
            <input type="text" data-filter="shipper" onchange="set_params('shipper', this.value), goto_page(1)">
        </div>
        <div class="filter-item fourth">
            <label>From Trailer</label>
            <input type="text" data-filter="trailer_id_from" name="trailer_id" list="quick_list_trailers" data-from-trailer-id>
        </div>
        <div class="filter-item fourth">
            <label>To Trailer</label>
            <input type="text" data-filter="trailer_id_to" name="trailer_id" list="quick_list_trailers" data-to-trailer-id>
        </div>
        <div class="filter-item fourth">
            <label>Pickup No.</label>
            <input type="text" data-filter="pick_up_number" onchange="set_params('pick_up_number', this.value), goto_page(1)">
        </div>
        <div class="filter-item fourth">
            <label>Driver</label>
            <input type="text" list="quick_list_drivers" data-filter="driver_id" data-driver-id>
        </div>
        <div class="filter-item fourth">
            <label>Truck</label>
            <input type="text" data-filter="truck_id" list="quick_list_trucks" data-truck-id>
        </div>
        <div class="filter-item fourth">
            <label>Cross Dock Status</label>
            <select data-filter="cross_dock_status" onchange="set_params('cross_dock_status', this.value), goto_page(1)">
                <option value="">- - Select - -</option>
                <option value="PENDING">Pending</option>
                <option value="MOVED">Moved</option>
                <option value="UNLOADED">Unloaded</option>
            </select>
        </div>
    </section>
    <div class="rv-table fixedheader">
        <input type='hidden' id='sort' value='asc'>
        <table data-my-table>
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Drivers</th>
                    <th>Truck</th>
                    <th>From Trailer</th>
                    <th>To Trailer</th>
                    <th>Shipper</th>
                    <th>Customer</th>
                    <th>Load No.</th>
                    <th>P/U No.</th>
                    <th>Cases</th>
                    <th>Pallets</th>
                    <th>Remarks</th>
                    <th>Cross Dock Status</th>
                    <th></th>
                    <th>Release Source Trailer</th>
                </tr>
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
    </div>
    <div data-pagination></div>
</section>
<script type="text/javascript">
    var url_params = get_params();
    if (url_params.hasOwnProperty('po_number')) {
        $("[data-filter='po_number']").val(url_params.po_number);
    }
    if (url_params.hasOwnProperty('shipper')) {
        $("[data-filter='shipper']").val(url_params.shipper);
    }
    if (url_params.hasOwnProperty('pick_up_number')) {
        $("[data-filter='pick_up_number']").val(url_params.pick_up_number);
    }
    if (url_params.hasOwnProperty('cross_dock_status')) {
        $("[data-filter='cross_dock_status'] option[value=" + url_params.cross_dock_status + "]").prop('selected', true);
    }
</script>
<script type="text/javascript">
    function show_list() {
        $.ajax({
            url: '../user/dispatch/cross-docks-ajax',
            type: 'POST',
            data: {
                sort_by: $('#sort_by').val(),
                sort_by_order_type: $('#sort').val(),
                page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
                batch: (check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
                webapi: 'pagination',
                driver_id: check_url_params('driver_id'),
                truck_id: check_url_params('truck_id'),
                trailer_id_from: check_url_params('trailer_id_from'),
                trailer_id_to: check_url_params('trailer_id_to'),
                po_number: check_url_params('po_number'),
                pick_up_number: check_url_params('pick_up_number'),
                shipper: check_url_params('shipper'),
                cross_dock_status: check_url_params('cross_dock_status'),
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
                            let quantity_bol = item.quantity_bol
                            var pick_up_number = Object.keys(quantity_bol).map(function(k) {
                                return quantity_bol[k]['pd_number']
                            }).join("<br>");
                            var pallet_count_bol = Object.keys(quantity_bol).map(function(k) {
                                return quantity_bol[k]['pallet_count_bol']
                            }).join("<br>");
                            var case_count_bol = Object.keys(quantity_bol).map(function(k) {
                                return quantity_bol[k]['case_count_bol']
                            }).join("<br>");

                            var row = `<tr>
                            <td>${counter}</td>
           <td>${item.driver_name}</td>
           <td>${item.truck_code}</td>
           <td>${item.trailer_code_from}</td>
           <td>${item.trailer_code_to}</td>
           <td>${item.shipper_location}</td>
           <td>${item.customer_code}</td>
           <td>${item.po_number}</td>
           <td>${pick_up_number}</td>
           <td>${case_count_bol}</td>
           <td>${pallet_count_bol}</td>
           <td>${item.remarks}</td>
           <td>${item.cross_dock_status}</td>`;
                            <?php if (in_array('DIS004', USER_PRIV)) {
                            ?>
                                row += `<td><button onclick="open_child_window({url:'../user/dispatch/cross-docks-info-update?eid=${item.dispatch_stop_eid}&remarks=${item.remarks}&cross_dock_status=${item.cross_dock_status}',width:800,height:500,name: 'Dispatch info update'})" class="btn_blue" title="Dispatch info update">Update</button></td>`;
                            <?php
                            }
                            ?>
                        row +=(item.is_source_trailer_released!='YES')? `<td><button class="btn_blue" data-action="release-source-trailer" title="Release Source Trailer" data-dispatch-stop-eid="${item.dispatch_stop_eid}">Release</button></td>`:`<td></td>`;
                            
                            row+=`</tr>`
                            $('#tabledata').append(row);
                            counter++;
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

<script type="text/javascript">

$(document).ready(function(){
 $(document).on("click", "[data-action='release-source-trailer']",function(){
    if(confirm('Do you want to release source trailer ?')){
        var eid=$(this).data("dispatch-stop-eid");
    $.ajax({
      url:'../user/dispatch/cross-docks/release-source-trailer-action',
      type:'POST',
       data:{
        dispatch_stop_eid:eid
       },
       context: this,
        success:function(data){
            alert(data)
               if((typeof data)=='string'){
               data=JSON.parse(data) 
               }
               
               if(data.status){
                    $(this).parent().parent().fadeOut();
                    show_list()
               }else{
                alert(data.message)
               }
      }
    })
    }
  });
});

</script>


<!-- -----------------------------Driver function start here ------------------------------------------------------>
<script type="text/javascript">
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
</script>
<!-- -----------------------------Driver function end here ------------------------------------------------------>
<!-- -----------------------------truck function start here ------------------------------------------------------>
<datalist id="quick_list_trucks"></datalist>
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
</script>
<!-- -----------------------------truck function end here ---------------------------------------->
<!-- -----------------------------trailer function start here ---------------------------------------->
<datalist id="quick_list_trailers"></datalist>
<!-- -------from trailer-------start here------- -->
<script type="text/javascript">
    $(document.body).on('input', '[data-from-trailer-id]', function() {
        id_selected = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
        //eid_selected = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('eid');
        if (id_selected != undefined) {
            $(this).data('from-trailer-id', id_selected)
            set_params('trailer_id_from', id_selected)
            set_params('trailer_name_from', $(`[data-from-trailer-id]`).val())
            goto_page(1)
        }
    });
</script>
<script type="text/javascript">
    $(document.body).on('change', '[data-from-trailer-id]', function() {
        id_selected = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
        if (id_selected == undefined) {
            alert("Please enter correct From TrailerID")
            set_params('trailer_id_from', '')
            set_params('trailer_name_from', '')
            $(`[data-from-trailer-id]`).val('')
        }
    });
</script>
<!-- -------from trailer-------end here------- -->
<!-- -------to trailer-------start here------- -->
<script type="text/javascript">
    $(document.body).on('input', '[data-to-trailer-id]', function() {
        id_selected2 = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
        //eid_selected = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('eid');
        if (id_selected2 != undefined) {
            $(this).data('to-trailer-id', id_selected2)
            set_params('trailer_id_to', id_selected2)
            set_params('trailer_name_to', $(`[data-to-trailer-id]`).val())
            goto_page(1)
        }
    });
</script>
<script type="text/javascript">
    $(document.body).on('change', '[data-to-trailer-id]', function() {
        id_selected2 = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
        if (id_selected2 == undefined) {
            alert("Please enter correct To TrailerID")
            set_params('trailer_id_to', '')
            set_params('trailer_name_to', '')
            $(`[data-to-trailer-id]`).val('')
        }
    });
</script>
<!-- -------to trailer-------end here------- -->
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
                if (url_params.hasOwnProperty('trailer_name_from')) {
                    $(`[data-from-trailer-id]`).val(check_url_params('trailer_name_from'))
                }
                if (url_params.hasOwnProperty('trailer_name_to')) {
                    $(`[data-to-trailer-id]`).val(check_url_params('trailer_name_to'))
                }
            }
        }
    }).catch(function(err) {})
</script>
<!-- -----------------------------trailer function end here ---------------------------------------->
<script type="text/javascript">
    function sort_table() {
        show_list()
    }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>