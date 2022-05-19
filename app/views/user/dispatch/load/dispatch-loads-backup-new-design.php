<?php
require_once APPROOT.'/views/includes/user/header.php';
require_once APPROOT.'/views/includes/user/quick-menu-dispatch-loads.php';
?>
<section class="rv content-box" style="margin: auto;max-width: 1600px">
    <h1 class="rv-heading">Dispatch Loads</h1>

    <section class="rv-filter-section">
        <!-- input used for sory by call-->
        <input type="hidden" id="sort_by" value="">
        <!-- //input used for sory by call-->


        <div class="filter-item fourth">
            <label>Search</label>
            <input type="text" data-filter="search" placeholder="ID, PO, Customer name" onchange="set_params('search', this.value), goto_page(1),show_group_list()">

        </div>            
        <div class="filter-item fourth">
            <label>Team/Solo</label>
            <select data-filter="is_team_driver" onchange="set_params('is_team_driver', this.value), goto_page(1),show_group_list()" >
                <option value="">ALL</option>
                <option value="TEAM">Team</option>
                <option value="SOLO">Solo</option>
            </select>
        </div>
        <div class="filter-item fourth">
            <label>Pick Date From</label>
            <input type="text" data-date-picker="" data-filter="pick_up_date_from" onchange="set_params('pick_up_date_from', this.value), goto_page(1),show_group_list()" value="">
        </div>
        <div class="filter-item fourth">
            <label>Pick Date To</label>
            <input data-date-picker="" type="text" data-filter="pick_up_date_to" onchange="set_params('pick_up_date_to', this.value), goto_page(1),show_group_list()" value="" />
        </div>
        <div class="filter-item fourth">
            <label>Region</label>
            <select data-filter="region_id" onchange="set_params('region_id', this.value), goto_page(1),show_group_list()"></select>
        </div>
        <div class="filter-item fourth">
            <label>Pick up Zone</label>
            <select data-filter="zone_id" onchange="set_params('zone_id', this.value), goto_page(1),show_group_list()"></select>
        </div>
        <div class="filter-item fourth">
            <label>Delivery Date From</label>
            <input type="text" data-date-picker="" data-filter="delivery_date_from" onchange="set_params('delivery_date_from', this.value), goto_page(1),show_group_list()">
        </div>
        <div class="filter-item fourth">
            <label>Delivery Date To</label>
            <input data-date-picker="" type="text" data-filter="delivery_date_to" onchange="set_params('delivery_date_to', this.value), goto_page(1),show_group_list()"/>
        </div>
        <div class="filter-item fourth">
            <label>Driver</label>
            <input type="hidden" data-filter="driver_id">
            <input type="text" list="quick_list_drivers_for_search" data-search-driver />
        </div>

        <div class="filter-item fourth">
            <label>Truck</label>
            <input type="hidden" data-filter="truck_id">
            <input type="text" list="quick_list_trucks_search" data-search-trucks>
        </div>
        <div class="filter-item fourth">
            <label>Trailer</label>
            <input type="hidden" data-filter="trailer_id">
            <input type="text" list="quick_list_trailer_search" data-search-trailer>
        </div>
        <div class="filter-item fourth">
            <label>Booked By</label>
            <input type="hidden" data-filter="booked_by_id">
            <input type="text" list="quick_list_booked_by_search" data-search-booked-by>
        </div>
        <div class="filter-item fourth">
            <label>Load Type</label>
            <select data-filter="load_type_id" onchange="set_params('load_type_id', this.value), goto_page(1),show_group_list()">
                <option value="">- - Select - -</option>
                <option value="LOT01">Truck Load</option>
                <option value="LOT02">Power Only</option>
                <option value="LOT03">Drop & Hook</option>
            </select>
        </div>
        <div class="filter-item fourth"></div>
        <div class="filter-item fourth"></div>
        <div class="filter-item fourth"></div>
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
                    <th>Status</th>                
                    <th>Type</th>
                    <th data-table-sort-by="po_number" style="text-align:right;white-space: nowrap;">PO No.</th>
                    <th data-table-sort-by="customer_code">Cust.</th>
                    <th data-table-sort-by="shipper_date">Pick Up Date</th>
                    <th data-table-sort-by="consignee_date">Delivery Date</th>
                    <th>Delivery</th>
                    <th>Drops</th>
                    <th>Reefer Temp</th>
                    <th>Driver</th>
                    <th>Truck</th>
                    <th>Trailer</th>
                    <th>Pick Up</th>
                    <th>Dispatch Cr Status</th>
                    <th>Next Action Datetime</th>
                    <th>Current Loaction</th>
                    <th>ETA</th>
                    <th></th>
                    <th></th>
                </tr>     
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
    </div>
    <div data-pagination></div>
</section>
<script type="text/javascript">
    var active_status_id_array = ['NEW', 'AT SITE', 'UNDER DECISION', 'TONU', 'ALLOCATED', 'ON DOCK', 'DISPATCHED']

    function show_group_list() {
        // $.ajax({
        //     url: 'user/dispatch/loads/dispatch-loads-status-wise-list-ajax',
        //     type: 'POST',
        //     data: {
        //         // search: check_url_params('search'),
        //         // pick_up_date_from: check_url_params('pick_up_date_from'),
        //         // pick_up_date_to: check_url_params('pick_up_date_to'),
        //         // delivery_date_from: check_url_params('delivery_date_from'),
        //         // delivery_date_to: check_url_params('delivery_date_to'),
        //         // driver_id: check_url_params('driver_id'),
        //         // truck_id: check_url_params('truck_id'),
        //         // trailer_id: check_url_params('trailer_id'),
        //         // region_id: check_url_params('region_id'),
        //         // zone_id: check_url_params('zone_id'),
        //         // load_type_id: check_url_params('load_type_id'),
        //         // booked_by: check_url_params('booked_by_id'),
        //         // is_team_driver: check_url_params('is_team_driver'),
        //     },
        //     success: function(data) {
        //         if ((typeof data) == 'string') {
        //             data = JSON.parse(data)
        //             $('#rv-filter-buttons-container').html("");
        //             if (data.status) {
        //                 var counter = 1;
        //                 $.each(data.response.list, function(index, item) {
        //                     let checked = (active_status_id_array.includes(item.load_status_id)) ? 'checked' : ''
        //                     $('#rv-filter-buttons-container').append(`<li data-group-selector-button class="` + get_load_row_bg(item.load_status_id) + `"><label><input type="checkbox" data-status-id-group ${checked} value="${item.load_status_id}"><span> ${item.load_status_name}</span> <span> ${item.total_loads}</span></label></li>`);
        //                 })
        //             }
        //         }
        //     }
        // })
    }
    show_group_list()
</script>



<script type="text/javascript">

    function get_load_row_bg(status_id){
        switch(status_id){
            case 'ALLOCATED':
            row_bg_class='bg-mild-grey';
            break;
            case 'DISPATCHED':
            row_bg_class='bg-mild-yellow';
            break;
            case 'PICKED':
            row_bg_class='bg-mild-green';    
            break;
            case 'AT SITE':
            row_bg_class='bg-mild-blue';    
            break;
            case 'BOUNCED':
            row_bg_class='bg-mild-red';    
            break;
            case 'CANCELLED':
            row_bg_class='bg-mild-red';    
            break;
            case 'TONU':
            row_bg_class='bg-cyan';    
            break;
            case 'UNDER DECISION':
            row_bg_class='bg-light-red';    
            break;         
            default:
            row_bg_class=''
            break


        }
        return row_bg_class;
    }
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
            url:'../user/dispatch/loads/dispatch-loads-list-ajax',
            type:'POST',
            data:{
                sort_by:$('#sort_by').val(),
                sort_by_order_type:$('#sort').val(),
                page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
                batch:(check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
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
                //status_ids:active_status_id_array.toString(),
                webapi:  'pagination',
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
                   console.log(data)
                   $('#tabledata').html("");
                   if(data.status){
                       var counter=1;    
                       var repeat_load=0;
                       var hide_row_content=false
                       $.each(data.response.list, function(index, item) {
                          if(index==0){
                             repeat_load=item.load_id;
                             hide_row_content=false;
                         }else{
                          if(repeat_load!=item.load_id){
                             repeat_load=item.load_id;
                             hide_row_content=false;
                         }else{
                             hide_row_content=true;
                         }
                     }
                     if(hide_row_content==false){
                        var row = `<tr><td colspan="27" style="padding:0;background:lightgrey !important;height:10px"></td></tr><tr class="${get_load_row_bg(item.load_status_id)}">`
                    }else{
                        var row = `<tr id="row${item.load_id}" class="${get_load_row_bg(item.load_status_id)}">`  
                    }
                    if(hide_row_content==false){
                        row+=`<td style="white-space:nowrap">
                        <a class="text-link" href="../user/dispatch/loads/details?eid=${item.load_eid}"><b>${item.load_id}</b></a></td>
                        <td>${item.load_status_id} <br> <span style="white-space:nowrap;font-size:.8em">P ${item.load_picked_ratio} &nbsp D ${item.load_delivered_ratio}</span></td>
                        <td>${item.load_type_abbr}</td>
                        <td>${item.po_number}</td>
                        <td><span class="tooltip">${item.customer_code}<span class="tooltiptext">${item.customer_name}</span></span></td>
                        <td>${(item.pick_up_date != "") ? date_format(item.pick_up_date) : ''}</td>
                        <td>${(item.delivery_date != "") ? date_format(item.delivery_date) : ''}</td>
                        <td>${item.deliveries}</td>
                        <td>${item.total_drops}</td>
                        <td> ${item.reefer_temperature} </td>`
                    }else{
                        row+=`<td colspan="10"></td>`
                    }


                    row+=`<td style="white-space:nowrap" class="bg-white">`
                    if(item.driver_eid!=""){
                        row+=`<b>${((item.is_team_driver)=='TEAM')?'T':''}</b> <span class="text-link"  onclick="open_quick_view_driver('${item.driver_eid}')">${item.driver_name}</span>`
                    }

                    if(item.driver_b_eid!=""){
                        row+=`<br><span class="text-link"  onclick="open_quick_view_driver('${item.driver_b_eid}')">${item.driver_b_name} </span>`
                    }
                    row+=`</td>`
                    if(item.truck_eid!=""){
                        row+=`<td class="bg-white"><span class="text-link"  onclick="open_quick_view_truck('${item.truck_eid}')">${item.truck_code}</span></td>`
                    }else{
                        row+=`<td class="bg-white"></td>`;
                    }

                    if(item.trailer_eid!=""){
                        row+=`<td class="bg-white"><span class="text-link"  onclick="open_quick_view_trailer('${item.trailer_eid}')">${item.trailer_code}</span></td>`
                    }else{
                        row+=`<td class="bg-white"></td>`;
                    }
                    row+= `

                    <td>${item.pick_ups}</td>
                    <td>${item.dispatch_status_id} <span style="white-space:nowrap;font-size:.8em">P ${item.dispatch_picked_ratio} &nbsp D ${item.dispatch_delivered_ratio}</span></td>
                    <td>Next Action Datetime</td>

                    <td>Cr Location</td>
                    <td>ETA </td>
                    <td style="white-space:nowrap">
                    <i class="ic truck" style="color:grey" title="Update dispatch info"  onclick="open_child_window({url:'../user/dispatch/loads/dispatch-update&eid=${item.eid}',width:900,height:700})"></i>
                    </td>
                    <td>`
                    if(item.load_stop_assignment_status=='UNASSIGNED' || item.load_stop_assignment_status=='HALF-ASSIGNED'){
                        row+=`<span class="text-link" style="white-space:nowrap;font-weight:bolder" onclick="open_child_window({url:'../user/dispatch/loads/add-dispatch?eid=${item.load_eid}',width:900,height:700})">Add Dispatch</span>`
                    }


                    row+=`</td></tr>`;
                    $('#tabledata').append(row);
                })
set_pagination({selector:'[data-pagination]',totalPages:data.response.totalPages,currentPage:data.response.currentPage,batch:data.response.batch})
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


<datalist id="quick_list_booked-by"></datalist>

<script type="text/javascript">
/*
  $(document.body).on('change', '[name="quick_list_booked-by_search"]' ,function(){

     let booked-by_id_selected=$(`[data-booked-by-filter-rows="${$(this).val()}"]`).data('value');
     if(booked-by_id_selected!=undefined){
      $(this).data('selected-booked-by-id',booked-by_id_selected)
  }
});

*/
</script>




<script type="text/javascript">
  function sort_table(){
    show_list()
}
</script>

<datalist id="quick_list_drivers_for_search"></datalist>

<script type="text/javascript">

  $(document.body).on('change', '[data-search-driver]' ,function(){
    driver_id_filter=$(`[data-driver-search-rows="${$(this).val()}"]`).data('value');
    if(driver_id_filter!=undefined){
        $('[data-filter="driver_id"]').val(driver_id_filter)
        set_params('driver_id', driver_id_filter);
        set_params('driver_name', $(this).val());
        goto_page(1);
        show_group_list()
    }
});
  function bind_quick_list_drivers_in_search(){

     quick_list_drivers().then(function(data) {

  // Run this when your request was successful

  if(data.status){



    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option data-driver-search-rows="" data-value="" value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option data-driver-search-rows="`+item.code+' '+item.name+`" data-value="${item.id}" value="`+item.code+' '+item.name+`"></option>`;               

    })

      $('#quick_list_drivers_for_search').html(options);     

  }

}

}).catch(function(err) {

  // Run this when promise was rejected via reject()

}) 
}
bind_quick_list_drivers_in_search()
</script>

<datalist id="quick_list_trucks_search"></datalist>

<script type="text/javascript">

  $(document.body).on('change', '[data-search-trucks]' ,function(){
    truck_id_filter=$(`[data-truck-search-rows="${$(this).val()}"]`).data('value');
    if(truck_id_filter!=undefined){
        $('[data-filter="truck_id"]').val(truck_id_filter)
        set_params('truck_id', truck_id_filter);
        set_params('truck_name', $(this).val());
        goto_page(1);
        show_group_list()
    }
});

  quick_list_trucks().then(function(data) {
  // Run this when your request was successful

  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option data-truck-search-rows="" data-value="" value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {

        options+=`<option data-truck-search-rows="`+item.code+`" data-value="${item.id}" value="`+item.code+`"></option>`;               

    })

      $('#quick_list_trucks_search').html(options);   

  }

}

}) 

</script>
<script type="text/javascript">
 get_location_regions().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
    })
      $('[data-filter="region_id"]').html(options);
      $("[data-filter='region_id'] option[value=" + check_url_params('region_id') + "]").prop('selected', true);     
  }
}

}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 

</script>
<script type="text/javascript">
 get_location_zones_quick_list().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
    })
      $('[data-filter="zone_id"]').html(options);
      $("[data-filter='zone_id'] option[value=" + check_url_params('zone_id') + "]").prop('selected', true);     
  }
}

}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 

</script>
<datalist id="quick_list_trailer_search"></datalist>

<script type="text/javascript">

  $(document.body).on('change', '[data-search-trailer]' ,function(){
    trailer_id_filter=$(`[data-trailer-search-rows="${$(this).val()}"]`).data('value');
    if(trailer_id_filter!=undefined){
        $('[data-filter="trailer_id"]').val(trailer_id_filter)
        set_params('trailer_id', trailer_id_filter);
        set_params('trailer_name', $(this).val());
        goto_page(1);
        show_group_list()
    }
});

  quick_list_trailers().then(function(data) {
  // Run this when your request was successful

  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option data-trailer-search-rows="" data-value="" value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {

        options+=`<option data-trailer-search-rows="`+item.code+`" data-value="${item.id}" value="`+item.code+`"></option>`;               

    })

      $('#quick_list_trailer_search').html(options);   

  }

}

}) 

</script>

<datalist id="quick_list_booked_by_search"></datalist>

<script type="text/javascript">

  $(document.body).on('change', '[data-search-booked-by]' ,function(){
    booked_by_id_filter=$(`[data-booked-by-search-rows="${$(this).val()}"]`).data('value');
    if(booked_by_id_filter!=undefined){
        $('[data-filter="booked_by_id"]').val(booked_by_id_filter)
        set_params('booked_by_id', booked_by_id_filter);
        set_params('booked_by_name', $(this).val());
        goto_page(1);
        show_group_list()
    }
});

  quick_list_users().then(function(data) {
  // Run this when your request was successful

  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option data-booked-by-search-rows="" data-value="" value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {

        options+=`<option data-booked-by-search-rows="`+item.name+`" data-value="${item.id}" value="`+item.name+`"></option>`;               

    })

      $('#quick_list_booked_by_search').html(options);   

  }

}

}) 

</script>
<br><br><br>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>