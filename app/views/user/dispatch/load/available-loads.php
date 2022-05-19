<?php
require_once APPROOT.'/views/includes/user/header.php';
require_once APPROOT.'/views/includes/user/quick-menu-dispatch-loads.php';
?>
<section class="rv content-box" style="margin: auto;max-width: 1600px">
    <h1 class="rv-heading">Available Loads</h1>


    <section class="rv-filter-section">
        <!-- input used for sory by call-->
        <input type="hidden" id="sort_by" value="">
        <!-- //input used for sory by call-->


        <div class="filter-item fourth">
            <label>Search</label>
            <input type="text" data-filter="search" placeholder="ID, PO, Customer name" onchange="set_params('search', this.value), goto_page(1)">

        </div>            
        <div class="filter-item fourth">
            <label>Load Type</label>
            <select data-filter="load_type_id" onchange="set_params('load_type_id', this.value), goto_page(1)">
                <option value="">- - Select - -</option>
                <option value="LOT01">Truck Load</option>
                <option value="LOT02">Power Only</option>
                <option value="LOT03">Drop & Hook</option>
            </select>
        </div>
        <div class="filter-item fourth">
            <label>Pick Date From</label>
            <input type="text" data-date-picker="" data-filter="pick_up_date_from" onchange="set_params('pick_up_date_from', this.value), goto_page(1)" >
        </div>
        <div class="filter-item fourth">
            <label>Pick Date To</label>
            <input data-date-picker="" type="text" data-filter="pick_up_date_to" onchange="set_params('pick_up_date_to', this.value), goto_page(1)" />
        </div>
        <div class="filter-item fourth"></div>
        <div class="filter-item fourth"></div>
<!--         <div class="filter-item fourth">
            <label>Truck</label>
            <input type="hidden" data-filter="truck_id">
            <input type="text" list="quick_list_trucks_search" data-search-trucks>
        </div>
        <div class="filter-item fourth">
            <label>Trailer</label>
            <input type="hidden" data-filter="trailer_id">
            <input type="text" list="quick_list_trailer_search" data-search-trailer>
        </div> -->

        <div class="filter-item fourth">
            <label>Delivery Date From</label>
            <input type="text" data-date-picker="" data-filter="delivery_date_from" onchange="set_params('delivery_date_from', this.value), goto_page(1)">
        </div>
        <div class="filter-item fourth">
            <label>Delivery Date To</label>
            <input data-date-picker="" type="text" data-filter="delivery_date_to" onchange="set_params('delivery_date_to', this.value), goto_page(1)"/>
        </div>
        <div class="filter-item fourth" style="display:none;">
            <label>Driver</label>
            <input type="hidden" data-filter="driver_id">
            <input type="text" list="quick_list_drivers_for_search" data-search-driver />
        </div>
    </section>

    <section class="rv-filter-buttons">
        <ul id="rv-filter-buttons-container"></ul>
        <div></div>
    </section>

    <div class="rv-table">
        <table data-my-table>
            <input type='hidden' id='sort' value='asc'>
            <thead>
                <tr>
                    <th data-table-sort-by="id">ID</th>
                    <th>Type</th>
                    <th data-table-sort-by="customer_code">Cust.</th>               
                    <th data-table-sort-by="po_number" style="text-align:right;white-space: nowrap;">PO No.</th>
                    <th>Pick Up</th>
                    <th>Delivery</th>
                    <th data-table-sort-by="shipper_date">Pick Up Date</th>
                    <th>Pick Up Time</th>
                    <th data-table-sort-by="consignee_date">Delivery Date</th>
                    <th>Delivery Time</th>
                    <th>Drops</th>
                    <th data-table-sort-by="trailer_type">Trailer <br>Type</th>
                    <th>Reefer Temp.</th>
                    <th>Status</th>
                    <th></th>
                </tr>     
            </thead>
            <tbody id="tabledata"></tbody>
        </table>

    </div>
    <div data-pagination></div>
</section>
<script type="text/javascript">
    // var active_status_id_array = ['NEW', 'AT SITE', 'UNDER DECISION', 'TONU', 'ALLOCATED', 'ON DOCK', 'DISPATCHED']

    // function // show_group_list() {
    //     $.ajax({
    //         url: 'user/dispatch/loads/load-status-wise-list-ajax',
    //         type: 'POST',
    //         data: {
    //             // search: check_url_params('search'),
    //             // pick_up_date_from: check_url_params('pick_up_date_from'),
    //             // pick_up_date_to: check_url_params('pick_up_date_to'),
    //             // delivery_date_from: check_url_params('delivery_date_from'),
    //             // delivery_date_to: check_url_params('delivery_date_to'),
    //             // driver_id: check_url_params('driver_id'),
    //             // truck_id: check_url_params('truck_id'),
    //             // trailer_id: check_url_params('trailer_id'),
    //             // region_id: check_url_params('region_id'),
    //             // zone_id: check_url_params('zone_id'),
    //             // load_type_id: check_url_params('load_type_id'),
    //             // booked_by: check_url_params('booked_by_id'),
    //             // is_team_driver: check_url_params('is_team_driver'),
    //         },
    //         success: function(data) {
    //             if ((typeof data) == 'string') {
    //                 data = JSON.parse(data)
    //                 $('#rv-filter-buttons-container').html("");
    //                 if (data.status) {
    //                     var counter = 1;
    //                     $.each(data.response.list, function(index, item) {
    //                         let checked = (active_status_id_array.includes(item.load_status_id)) ? 'checked' : ''
    //                         $('#rv-filter-buttons-container').append(`<li data-group-selector-button class="` + get_load_row_bg(item.load_status_id) + `"><label><input type="checkbox" data-status-id-group ${checked} value="${item.load_status_id}"><span> ${item.load_status_name}</span> <span> ${item.total_loads}</span></label></li>`);
    //                     })
    //                 }
    //             }
    //         }
    //     })
    // }
    // // show_group_list()
</script>
<script type="text/javascript">
    //---select or deselect group button checkboxes
    $(document.body).on('click', '[data-group-selector-button]', function() {
        $(this).children("input").click()
        active_status_id_array = [];
        $('[data-status-id-group]:checked').each(function() {
            active_status_id_array.push($(this).val())
        })
        show_list()
    });
    //---/select or deselect group button checkboxes
</script>



<script type="text/javascript">

    $('[data-filter="search"]').val(check_url_params('search'))
    $(`[data-filter='is_team_driver'] option[value="${check_url_params('is_team_driver')}"]`).prop('selected', true);
    $(`[data-filter='load_type_id'] option[value="${check_url_params('load_type_id')}"]`).prop('selected', true);
    $('[data-filter="pick_up_date_from"]').val(check_url_params('pick_up_date_from'))
    $('[data-filter="pick_up_date_to"]').val(check_url_params('pick_up_date_to'))
    $('[data-filter="delivery_date_from"]').val(check_url_params('delivery_date_from'))
    $('[data-filter="delivery_date_to"]').val(check_url_params('delivery_date_to'))
    $('[data-filter="driver_id"]').val(check_url_params('driver_id'))
    $('[data-search-driver]').val(check_url_params('driver_name'))
    $('[data-filter="truck_id"]').val(check_url_params('truck_id'))
    $('[data-search-trucks]').val(check_url_params('truck_name'))
    $('[data-filter="trailer_id"]').val(check_url_params('trailer_id'))
    $('[data-search-trailer]').val(check_url_params('trailer_name'))
    $('[data-filter="booked_by_id"]').val(check_url_params('booked_by_id'))
    $('[data-search-booked-by]').val(check_url_params('booked_by_name'))
     //---create array of selected staus types         
     function show_list(){
        show_processing_modal()
        $.ajax({
            url:'../user/dispatch/loads/available-loads-list-ajax',
            type:'POST',
            data:{
                sort_by:$('#sort_by').val(),
                sort_by_order_type:$('#sort').val(),
                search:check_url_params('search'),
                pick_up_date_from:check_url_params('pick_up_date_from'),
                pick_up_date_to:check_url_params('pick_up_date_to'),
                delivery_date_from:check_url_params('delivery_date_from'),
                delivery_date_to:check_url_params('delivery_date_to'),
                driver_id:check_url_params('driver_id'),
                truck_id:check_url_params('truck_id'),
                trailer_id:check_url_params('trailer_id'),
                region_id:check_url_params('region_id'),
                zone_id:check_url_params('zone_id'),
                load_type_id:check_url_params('load_type_id'),
                booked_by:check_url_params('booked_by_id'),
                is_team_driver:check_url_params('is_team_driver'),
            },
            beforeSend:function() {
                show_table_data_loading("[data-my-table]")
            },
            complete:function() {
                hide_processing_modal()
            },
            success:function(data){
                if((typeof data)=='string'){
                 data=JSON.parse(data)
                 $('#tabledata').html("");
                 if(data.status){
                      
                     $.each(data.response.list, function(index, item) {

                        row_bg_class = get_load_row_bg(item.status_id)
                        is_high_priority_note = (item.high_priority_note == 'YES') ? '<span class="ic exclamation" style="color:yellow;text-shadow: 2px 2px #FF0000;"></span>' : '';

                        pick_up_date = (item.pick_up_date != "") ? date_format(item.pick_up_date) : ''
                        if(item.pick_up_datetime_tbd=='YES'){
                            pick_up_time='TBD';
                        }else{
                            pick_up_time = item.pick_up_time_from
                            
                            if (item.pick_up_time_to != item.pick_up_time_from) {
                                pick_up_time += ' -' + item.pick_up_time_to
                            }      
                        }

                        delivery_date = (item.delivery_date != "") ? date_format(item.delivery_date) : ''
                        if(item.delivery_datetime_tbd=='YES'){
                            delivery_time='TBD';
                        }else{
                            delivery_time = item.delivery_time_from
                            
                            if (item.delivery_time_to != item.delivery_time_from) {
                                delivery_time += ' -' + item.delivery_time_to
                            }      
                        }
                            row=""
                            row+=`<tr id="row${item.id}">

                            <td style="white-space:nowrap">`
                            if(item.is_express_load=='L'){
                                row+=`<a class="text-link"  href="../user/dispatch/loads/details?eid=` + item.eid + `">${is_high_priority_note} ${item.id}</a>`
                            }else{
                               row+=`<a class="text-link"  href="../user/dispatch/loads/load-details-express?eid=` + item.eid + `">${is_high_priority_note} ${item.id}</a>`
                            }

                            row+=`</td><td>${item.type}</td><td><span class="tooltip">${item.customer_code}<span class="tooltiptext">${item.customer_name}</span></span></td>
                            <td style="text-align:right;">${item.po_number}</td>
                            <td style="text-align:left; white-space:nowrap;font-weight:bold" title='click copy load details' data-copy-to-clipboard="">${item.pick_up_locations}</td>
                            <td style="text-align:left; white-space:nowrap">${item.delivery_locations}</td>
                            <td style="white-space:nowrap">${pick_up_date}</td>
                            <td style="white-space:nowrap">${pick_up_time}</td>
                            <td style="white-space:nowrap">${delivery_date}</td>
                            <td style="white-space:nowrap">${delivery_time}</td>
                            <td style="white-space:nowrap">${item.total_drops}</td>
                            <td>${item.trailer_type}</td>
                            <td> ${item.reefer_temperature}</td>
                            <td> ${item.status_id}</td>
                            <td>`
                            if(item.is_express_load=='L'){
                                    row+=`<span class="text-link" style="white-space:nowrap;font-weight:bolder" onclick="open_child_window({url:'../user/dispatch/loads/add-dispatch?eid=${item.eid}',width:900,height:700})">Add Dispatch</span>`
                            }else{
                                <?php
                                 if (in_array('DIS002', USER_PRIV)) {
                                            ?>
                                    row += `<a href="../user/dispatch/loads/express-to-main-load?exp-load=` + item.eid + `"><i class="ic arrow-circle-right" title="Create main load"></i></a>`;
                                <?php
                                    }
                                    ?>
                            }
                            
                            row+=`</td>
                            </tr>`;
                            $('#tabledata').append(row);
                    })
                 }else{
                    var false_message=`<tr><td colspan="18">`+data.message+`<td></tr>`;
                    $('#tabledata').html(false_message);
                }
            }

        }

    })
}
show_list()

</script>


<script type="text/javascript">
  function sort_table(){
    show_list()
}
</script>

<datalist id="quick_list_drivers_for_search"></datalist>

<script type="text/javascript">

//   $(document.body).on('change', '[data-search-driver]' ,function(){
//     driver_id_filter=$(`[data-driver-search-rows="${$(this).val()}"]`).data('value');
//     if(driver_id_filter!=undefined){
//         $('[data-filter="driver_id"]').val(driver_id_filter)
//         set_params('driver_id', driver_id_filter);
//         set_params('driver_name', $(this).val());
//         goto_page(1);
//         // show_group_list()
//     }
// });
//   function bind_quick_list_drivers_in_search(){

//    quick_list_drivers().then(function(data) {

//   // Run this when your request was successful

//   if(data.status){



//     //Run this if response has list

//     if(data.response.list){

//       var options="";

//       options+=`<option data-driver-search-rows="" data-value="" value="">- - Select - -</option>`

//       $.each(data.response.list, function(index, item) {

//         options+=`<option data-driver-search-rows="`+item.code+' '+item.name+`" data-value="${item.id}" value="`+item.code+' '+item.name+`"></option>`;               

//     })

//       $('#quick_list_drivers_for_search').html(options);     

//   }

// }

// }).catch(function(err) {

//   // Run this when promise was rejected via reject()

// }) 
// }
// bind_quick_list_drivers_in_search()
</script>

<datalist id="quick_list_trucks_search"></datalist>

<script type="text/javascript">

//   $(document.body).on('change', '[data-search-trucks]' ,function(){
//     truck_id_filter=$(`[data-truck-search-rows="${$(this).val()}"]`).data('value');
//     if(truck_id_filter!=undefined){
//         $('[data-filter="truck_id"]').val(truck_id_filter)
//         set_params('truck_id', truck_id_filter);
//         set_params('truck_name', $(this).val());
//         goto_page(1);
//         // show_group_list()
//     }
// });

//   quick_list_trucks().then(function(data) {
//   // Run this when your request was successful

//   if(data.status){
//     //Run this if response has list
//     if(data.response.list){
//       var options="";
//       options+=`<option data-truck-search-rows="" data-value="" value="">- - Select - -</option>`
//       $.each(data.response.list, function(index, item) {

//         options+=`<option data-truck-search-rows="`+item.code+`" data-value="${item.id}" value="`+item.code+`"></option>`;               

//     })

//       $('#quick_list_trucks_search').html(options);   

//   }

// }

// }) 

</script><datalist id="quick_list_trailer_search"></datalist>

<script type="text/javascript">

//   $(document.body).on('change', '[data-search-trailer]' ,function(){
//     trailer_id_filter=$(`[data-trailer-search-rows="${$(this).val()}"]`).data('value');
//     if(trailer_id_filter!=undefined){
//         $('[data-filter="trailer_id"]').val(trailer_id_filter)
//         set_params('trailer_id', trailer_id_filter);
//         set_params('trailer_name', $(this).val());
//         goto_page(1);
//         // show_group_list()
//     }
// });

//   quick_list_trailers().then(function(data) {
//   // Run this when your request was successful

//   if(data.status){
//     //Run this if response has list
//     if(data.response.list){
//       var options="";
//       options+=`<option data-trailer-search-rows="" data-value="" value="">- - Select - -</option>`
//       $.each(data.response.list, function(index, item) {

//         options+=`<option data-trailer-search-rows="`+item.code+`" data-value="${item.id}" value="`+item.code+`"></option>`;               

//     })

//       $('#quick_list_trailer_search').html(options);   

//   }

// }

// }) 

</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>