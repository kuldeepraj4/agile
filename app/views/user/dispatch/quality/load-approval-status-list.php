<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<section class="rv content-box" style="margin: auto;max-width: 1350px">
    <h1 class="rv-heading">Approval Status List</h1>

    <section class="rv-action-bar"></section>

    <section class="rv-filter-section">
        <!-- input used for sory by call-->
        <input type="hidden" id="sort_by" value="">
        <!-- //input used for sory by call-->


        <div class="filter-item fourth">
            <label>Search</label>
            <input type="text" data-filter="search" placeholder="ID, PO, Customer name" onchange="set_params('search', this.value), goto_page(1),show_group_list()">

        </div>

        <div class="filter-item fourth">
            <label>Approval Status</label>
            <select data-filter="approval_status" onchange="set_params('approval_status', this.value), goto_page(1)" >
                <option value="">All</option>
                <option value="APPROVED">Approved</option>
                <option value="PENDING">Pending</option>
                <option value="REJECTED">Rejected</option>
            </select>
        </div>
        <div class="filter-item fourth"></div>            
        <div class="filter-item fourth"></div>            

    </section>

    <div class="rv-table">
        <table data-my-table>
             <input type='hidden' id='sort' value='asc'>
            <thead>
                <tr>
                    <th data-table-sort-by="approval_status">App. Status</th>
                    <th data-table-sort-by="id">ID</th>
                    <th>Type</th>
                    <th data-table-sort-by="customer_code">Cust.</th>
                    <th data-table-sort-by="po_number" style="text-align:right;white-space: nowrap;">PO No.</th>
                    <th>Pick Up</th>
                    <th>Delivery</th>
                    <th>Drop at Shipper</th>
                    <th data-table-sort-by="shipper_date">Pick Up Date</th>
                    <th>Pick Up Time</th>
                    <th>First Delivery Date</th>
                    <th>First Delivery Time</th>
                    <th data-table-sort-by="consignee_date">Final Delivery Date</th>
                    <th>Final Delivery Time</th>
                    <th>Pick From Consignee</th>
                    <th data-table-sort-by="load_status_id">Status</th>
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
    $('[data-filter="search"]').val(check_url_params('search'))
    $(`[data-filter='is_team_driver'] option[value="${check_url_params('is_team_driver')}"]`).prop('selected', true);
    $(`[data-filter='approval_status'] option[value="${(check_url_params('approval_status')!='')?check_url_params('approval_status'):'PENDING'}"]`).prop('selected', true);

    function show_list(){
        show_processing_modal()
        $.ajax({
            url:'../user/dispatch/quality/approval-status-list-ajax',
            type:'POST',
            data:{
                sort_by:$('#sort_by').val(),
                sort_by_order_type: $('#sort').val(),
                page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
                batch:(check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
                search:check_url_params('search'),
                approval_status:check_url_params('approval_status')
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
                     $.each(data.response.list, function(index, item) {
                            row_bg_class = get_load_row_bg(item.status_id)
                            is_high_priority_note = (item.high_priority_note == 'YES') ? '<span class="ic exclamation" style="color:yellow;text-shadow: 2px 2px #FF0000;"></span>' : '';

                            pick_up_time_bg_color = ""
                            pick_up_time="";
                            if (item.pick_up_datetime_tbd == "YES") {
                                pick_up_time = 'TBD';
                                pick_up_time_bg_color = "bg-light-purple"
                            }else{
                               if (item.pick_up_time_from == item.pick_up_time_to) {
                                pick_up_time=item.pick_up_time_from;
                            }else{
                                pick_up_time=item.pick_up_time_from+' -' + item.pick_up_time_to
                            }                               
                        }


                        first_delivery_time_bg_color = ""
                        first_delivery_time="";
                        if (item.first_delivery_datetime_tbd == "YES") {
                            first_delivery_time = 'TBD';
                            first_delivery_time_bg_color = "bg-light-purple"
                        }else{
                           if (item.first_delivery_time_from == item.first_delivery_time_to) {
                            first_delivery_time=item.first_delivery_time_from;
                        }else{
                            first_delivery_time=item.first_delivery_time_from+' -' + item.first_delivery_time_to
                        }                               
                    }




                        delivery_time_bg_color = ""
                        delivery_time="";
                        if (item.delivery_datetime_tbd == "YES") {
                            delivery_time = 'TBD';
                            delivery_time_bg_color = "bg-light-purple"
                        }else{
                           if (item.delivery_time_from == item.delivery_time_to) {
                            delivery_time=item.delivery_time_from;
                        }else{
                            delivery_time=item.delivery_time_from+' -' + item.delivery_time_to
                        }                               
                    }

                    drop_at_shipper = (item.has_shipper_range == "YES") ? date_format(item.drop_at_shipper_date) : ''
                    pick_from_consignee = (item.has_consignee_range == "YES") ? date_format(item.pick_at_consignee_date) : ''
                    var reefer_temperature = (item.temperature_as_per_shipper == 'YES') ? 'As Per Shipper' : item.reefer_temperature + '<br>' + item.reefer_mode
                    show_t=(item.allocated_is_team_driver=='TEAM')?'T':'';


                        var row=`<tr id="row${item.id}" class="${row_bg_class}">
                        <td>${item.approval_status}</td>
                        <td style="white-space:nowrap">
                        <a class="text-link" href="../user/dispatch/express-loads/details?eid=`+item.eid+`">${is_high_priority_note} ${item.id}</a></td>
                        <td>${item.load_type_abbr}</td>
                        <td><span class="tooltip">${item.customer_code}<span class="tooltiptext">${item.customer_name}</span></span></td>
                        <td style="text-align:right;">${item.po_number}</td>
                        <td style="text-align:left; white-space:nowrap">${item.pick_ups}</td>
                        <td style="text-align:left; white-space:nowrap">${item.deliveries}</td>
                        <td style="white-space:nowrap">${drop_at_shipper}</td>
                        <td style="white-space:nowrap">${date_format(item.pick_up_date)}</td>
                        <td style="white-space:nowrap" class="${pick_up_time_bg_color}">${pick_up_time}</td>
                        <td style="white-space:nowrap">${date_format(item.first_delivery_date)}</td>
                        <td style="white-space:nowrap" class="${first_delivery_time_bg_color}">${first_delivery_time}</td>
                        <td style="white-space:nowrap">${date_format(item.delivery_date)}</td>
                        <td style="white-space:nowrap" class="${delivery_time_bg_color}">${delivery_time}</td>
                        <td>${pick_from_consignee}</td>
                        <td>${item.status_id}</td>`

                        row+=`</td><td>`;
                        if(item.approval_status=='PENDING'){
                            if( item.has_comparison=='YES'){
                           row+=`<button class="btn_blue"><a title="Compare History" href="../user/dispatch/quality/loads-compare-express-history?eid=`+item.eid+`">Compare</a></button>`;
                       }else{
                             row+=`<button class="btn_blue"><a title="Compare History" href="../user/dispatch/quality/loads-express-approve-new?eid=`+item.eid+`">Approve</a></button>`;
                       }
                        }else{
                           
                        }
                        
                       row+=`</td><td style="white-space:nowrap" class="act-box">
                       <a href="../user/dispatch/express-loads/details?eid=`+item.eid+`"><i class="ic view" title="View details"></i></a>`                      
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