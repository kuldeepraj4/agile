<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<script type="text/javascript">
/*
      //-------- add/remove required attribute based on TBD check box 

      $(document.body).on('change', '[data-time-24]' ,function(){
        let entered_time=$(this).val()
        output='';
        switch (entered_time.length){
            case 4:
            var a =entered_time.slice(0,2);
            var b=entered_time.slice(2,4)
            output =a+':'+b
            break;
            default:
            alert('wrong time');
        }
        $(this).val(output)

});

      //--------/ add/remove required attribute based on TBD check box 
*/
  </script>

<style type="text/css">

.rv{
    background: white;
    padding:5px;
    border-radius:8px;
    box-shadow: 0 0 10px -1px darkgrey;
    font-size: 12px;
}

.rv-heading{
    background: white;
    color: var(--theme-color-four);
    font-size:2em;
    text-align: center;
    padding:10px;
    display: block;
}
.rv-action-bar{
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-end;
}
.rv-action-bar button{
    margin: 0 2px;
}

.rv-filter-section{
    background: white;
    padding: 8px;
    display: flex;
    flex-wrap: wrap;
    width: 100%;
}
.rv-filter-section div.filter-item{
    width:100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin:2px;
    padding:2px;
    background:#f2f2f2;
    border: 1px solid #f4f4f4;
    border-radius: 5px;
    flex-grow: 1;
}
.rv-filter-section div.filter-item.half{
    width: 50%;
}
.rv-filter-section div.filter-item.half{
    width: 32%;
}
.rv-filter-section div.filter-item.fourth{
    width: 24%;
}
.rv-filter-section div.filter-item label{
    width: 40%;
    flex-grow: 1;
    font-size: 1.2em;
    padding:5px 8px;
    background: #f1f1f1;
    margin-right: 5px;
}
.rv-filter-section div.filter-item input,
.rv-filter-section div.filter-item select{
   width:55%;
   border: none;
}
.rv-filter-buttons ul{
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    font-size: 1.2em;
}
.rv-filter-buttons ul li{
    border: 1px solid #f2f2f2;
    border-radius: 5px;
    margin: 3px;
    padding:1px 5px;
    display: flex;
    align-items: center;
    cursor: pointer;
}
.rv-filter-buttons input[type='checkbox']{
    width: 10px;
}
.rv-filter-buttons ul li span{
    display: block;
    padding:1px 3px;
    font-weight: bold;
}

.rv-table{
    background: white;
    width:100%;
    overflow-x: auto;
}


.rv-table-a .rv-table-info{
    display: flex;
    flex-wrap: wrap;
}
.rv-table-a .rv-table-info>div{
    width: 50%;
}

.rv-table-a .rv-table-info>div.full-width{
    width: 100%;
}
.rv-table-a .rv-table-info>div.error-message{
 color: red;
 text-align: center;
 font-size: bolder;
}

.rv-table>table{
    border:1px solid darkgrey;
    border-collapse: collapse;
    background: white;
    box-sizing: border-box;
    width: 100%;
    font-size: 1.1em;
}
.rv-table>table>thead{
    background: #486e94;
    color: white;
}
.rv-table>table>thead>tr>th{
    padding:3px 3px;
    font-weight: normal;
    border: 1px solid grey;
    font-weight: bold;
}
[data-table-sort-by]:after{
    font-family: "Font Awesome 5 Free"; 
    font-weight: 900; 
    content: "\f0dc";
    margin-left: 5px;
    font-size: .8em;
    color: white;
}

[data-table-sort-by-active]:after{
    font-size: 1.1em;
}
.rv-table>table>tbody>tr>td{
    padding: 0px 5px;
    border: .5px solid grey;
    text-align: center;
}
.rv-table>table>tbody>tr>td input,
.rv-table>table>tbody>tr>td select{
    height: 1.6em !important;
    font-size: .9em;
    padding: 2px !important;
    margin: 1.5px;
}

.rv-table>table>tbody>tr{
    border-bottom: 1px solid #f0f0f0
}
.rv-table>table>tbody>tr:last-child{
    border-bottom: none;
}
</style>



<section class="rv content-box" style="margin: auto;max-width: 1350px">
    <h1 class="rv-heading">Express Loads</h1>

    <section class="rv-action-bar">
       <?php
       echo in_array('P0168', USER_PRIV)?"<button class='btn_grey button_href'><a href='../user/dispatch/express-loads/add-new'>Add New</a></button>":"";
       ?>
   </section>

   <section class="rv-filter-section">
    <!-- input used for sory by call-->
    <input type="hidden" id="sort_by" value="">
    <!-- //input used for sory by call-->


    <div class="filter-item fourth">
        <label>Search</label>
        <input type="text" data-filter="common_search" placeholder="ID, PO, Customer name" onkeyup="show_list()">

    </div>            
    <div class="filter-item fourth">
        <label>Team/Solo</label>
        <select data-filter="is_team_driver" onchange="show_list()">
            <option value="">ALL</option>
            <option value="1">Team</option>
            <option value="0">Solo</option>
        </select>
    </div>
    <div class="filter-item fourth">
        <label>Pick Date From</label>
        <input type="text" data-date-picker="" data-filter="shipper_date_from" onchange="show_list()" value="">
    </div>
        <div class="filter-item fourth">
        <label>Pick Date To</label>
        <input data-date-picker="" type="text" data-filter="shipper_date_to" onchange="show_list()"/>
    </div>
    <div class="filter-item fourth">
        <label>Truck</label>
        <input type="hidden" data-filter="truck_id">
        <input type="text" list="quick_list_trucks_search" data-search-trucks>
    </div>
    <div class="filter-item fourth">
        <label>Driver</label>
        <input type="hidden" data-filter="driver_id">
        <input type="text" list="quick_list_drivers_for_search" data-search-driver />
    </div>
    <div class="filter-item fourth">
        <label>Delivery Date From</label>
        <input type="text" data-date-picker="" data-filter="consignee_date_from" onchange="show_list()" value="">
    </div>
        <div class="filter-item fourth">
        <label>Delivery Date To</label>
        <input data-date-picker="" type="text" data-filter="consignee_date_to" onchange="show_list()"/>
    </div>
    <div class="filter-item fourth">
        <label>Region</label>
        <select data-filter="region_id" onchange="show_list()"></select>
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
        <thead>
            <tr>
                <th data-table-sort-by="id">ID</th>
                <th data-table-sort-by="customer_code">Cust.</th>
                <th data-table-sort-by="po_number" style="text-align:right;white-space: nowrap;">PO No.</th>
                <th>Pick Up</th>
                <th>Delivery</th>
                <th>Pick Up Date</th>
                <th>Pick Up Time</th>
                <th>First Delivary Date</th>
                <th>First Delivary Time</th>
                <th>Final Delivary Date</th>
                <th>Final Delivary Time</th>
                <th data-table-sort-by="region_name">Region</th>
                <th data-table-sort-by="trailer_type">Trailer</th>
                <th>Temp. to Maintain</th>
                <th>Rate</th>
                <th>Status</th>
                <th>Truck</th>
                <th>Team</th>
                <th>Driver</th>
                <th></th>
                <th>Booked By</th>
                <th>Pending R/C</th>
                <th></th>
                <th></th>
            </tr>                       
        </thead>
        <tbody id="tabledata"></tbody>
    </table>
</div>
</section>

<script type="text/javascript">
    var active_status_id_array=['','ALLOCATED','AT SITE','ON DOCK','PICKED','UNDER DECISION','CANCELLED','DISPATCHED','TONU']
    function show_group_list(){
        $.ajax({
            url:'user/dispatch/express-loads-load-status-wise-list-ajax',
            type:'POST',
            data:{},
            success:function(data){

             if((typeof data)=='string'){
                 data=JSON.parse(data)
                 $('#rv-filter-buttons-container').html("");
                 if(data.status){
                     var counter=1;    
                     $.each(data.response.list, function(index, item) {

                        let checked=(active_status_id_array.includes(item.load_status_id))?'checked':''
                        $('#rv-filter-buttons-container').append(`<li data-group-selector-button class="`+get_load_row_bg(item.load_status_id)+`"><input type="checkbox" data-status-id-group ${checked} value="${item.load_status_id}"><span> ${item.load_status_name}</span> <span> ${item.total_express_loads}</span></li>`);
                    })
                 }
             }

         }

     })
    }
    show_group_list()

</script>
<script type="text/javascript">

    //---select or deselect group button checkboxes
    $(document.body).on('click', '[data-group-selector-button]' ,function(){
      let group_checkbox=$(this).children("input")
      let act_on_status_id=$(this).children("input").val()
      if($(group_checkbox).prop("checked") == true){
        $(group_checkbox).prop("checked",false)
        active_status_id_array.splice(active_status_id_array.indexOf(act_on_status_id),1);
    } else{
     $(group_checkbox).prop("checked",true)
     active_status_id_array.push(act_on_status_id)

 }
 show_list()
});
    //---/select or deselect group button checkboxes
</script>

<script type="text/javascript">

      //-------- add/remove required attribute based on TBD check box 

      $(document.body).on('change', '[data-team-checkbox]' ,function(){
        var row_driver_td=$(this).parents("tr").find('[data-driver-b]');
    //alert(row_driver_td)
    if($(this).prop("checked") == true){
        row_driver_td.css('display','block')

    } else{
        row_driver_td.css('display','none')

    }

});

      //--------/ add/remove required attribute based on TBD check box 

  </script>


  <script type="text/javascript">

    function get_load_row_bg(status_id){
        switch(status_id){
            case 'ALLOCATED':
            row_bg_class='bg-grey';
            break;
            case 'DISPATCHED':
            row_bg_class='bg-mild-yellow';
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


    $(document).ready(function(){
       $(document).on("click", "[data-action='update-opration-info']",function(){
        if(confirm('Do you want to update opration info ?')){

            //---if driver b id exists
            driver_b_id=(($(this).parents("tr").find('[data-driver-b]').length)==1)?$(this).parents("tr").find('[data-driver-b]').data('selected-driver-id'):''

            status_id=$(this).parents("tr").find('[data-load-status]').val(),
            $.ajax({
              url:'user/dispatch/express-loads/update-opration-info-action',
              type:'POST',
              data:{
               update_eid:$(this).data('eid'),
               status_id:status_id,
               truck_id:$(this).parents("tr").find('[name="quick_list_trucks_search"]').data('selected-truck-id'),
               is_team_driver:($(this).parents("tr").find('[data-team-checkbox]').prop("checked"))?true:false,
               driver_id:$(this).parents("tr").find('[data-driver-a]').data('selected-driver-id'),
               driver_b_id:driver_b_id
           },
           context: this,
           success:function(data){
            if((typeof data)=='string'){
             data=JSON.parse(data) 
         }
         if(data.status){
            $(this).parents('tr').removeClass();
            $(this).parents('tr').addClass(get_load_row_bg(status_id));
        }else{
            alert(data.message)
        }
    }
})
        }
    });
   });
</script>

<script type="text/javascript">
        $(document).ready(function(){
       $(document).on("click", "[data-action='update-booking-info']",function(){
        if(confirm('Do you want to update booking info ?')){

console.log({
               update_eid:$(this).data('eid'),
               booker_id:$(this).parents("tr").find('[name="quick_list_booker_search"]').data('selected-booker-id'),
               pending_rc:($(this).parents("tr").find('[data-pending-rc-checkbox]').prop("checked"))?true:false,
           })
           $.ajax({
              url:'user/dispatch/express-loads/update-booking-info-action',
              type:'POST',
              data:{
               update_eid:$(this).data('eid'),
               booked_by_id:$(this).parents("tr").find('[name="quick_list_booker_search"]').data('selected-booker-id'),
               is_pending_rc:($(this).parents("tr").find('[data-pending-rc-checkbox]').prop("checked"))?true:false,
           },
           context: this,
           success:function(data){
            console.log(data)
            if((typeof data)=='string'){
             data=JSON.parse(data) 
         }alert(data.message)
    }
})
        }
    });
   });
</script>

<script type="text/javascript">

    function show_list(){
        var sort_by=$('#sort_by').val();
        var common_search=$('[data-filter="common_search"]').val();
        $.ajax({
            url:location.pathname+'-ajax',
            type:'POST',
            data:{
                sort_by:sort_by,
                common_search:common_search,
                shipper_date_from:$('[data-filter="shipper_date_from"]').val(),
                shipper_date_to:$('[data-filter="shipper_date_to"]').val(),
                consignee_date_from:$('[data-filter="consignee_date_from"]').val(),
                consignee_date_from:$('[data-filter="consignee_date_from"]').val(),
                driver_id:$('[data-filter="driver_id"]').val(),
                truck_id:$('[data-filter="truck_id"]').val(),
                region_id:$('[data-filter="region_id"]').val(),
                is_team_driver:$('[data-filter="is_team_driver"]').val(),
                status_id:active_status_id_array.toString()
            },
            beforeSend:function() {
                show_table_data_loading("[data-my-table]")
            },
            success:function(data){
                if((typeof data)=='string'){
                 data=JSON.parse(data)
                 console.log(data)
                 $('#tabledata').html("");
                 if(data.status){
                     var counter=1;    
                     $.each(data.response.list, function(index, item) {
                        row_bg_class=get_load_row_bg(item.status_id)
                        team_checked=(item.is_team_driver==true)?'checked':'';
                        pending_rc_checked=(item.pending_rc==true)?'checked':'';
                        driver_b_display=(item.is_team_driver==false)?'none':'';
                        
                        pick_up_location=item.shipper.location;
                        pick_up_time=item.shipper.time_from
                        pick_up_date=(item.shipper.date!="")?date_format(item.shipper.date):''

                        if(item.shipper.time_to!=item.shipper.time_from){
                            pick_up_time+=' -'+item.shipper.time_to

                        }
                        drop_location=item.consignee.location;
                        drop_time=item.consignee.time_from
                        drop_date=(item.consignee.date!="")?date_format(item.consignee.date):''

                        if(item.consignee.time_to!=item.consignee.time_from){
                            drop_time+=' -'+item.consignee.time_to

                        }

                        pick_up_appointment_type =(item.shipper.appointment_type=='FIRM')?`<span class="icon-clock" style="font-size:.6em"></span>`:''

                        drop_appointment_type =(item.consignee.appointment_type=='FIRM')?`<span class="icon-clock" style="font-size:.6em"></span>`:''


                        var drops=[]
                        $.each(item.stops, function(index2, item2) {
                            if(item2.type=='DROP'){
                                drops.push(item2)
                                drop_location+='/ '+item2.location
                            }else if(item2.type=='PICK'){
                                pick_up_location+='/ '+item2.location       
                            }
                        })
                        var first_delivery_date=""
                        var first_delivery_time=""

                        if(drops[0]){
                            first_delivery_date=(drops[0].date!="")?date_format(drops[0].date):'';
                            first_delivery_time=drops[0].time_from;
                            if(drops[0].time_to!=drops[0].time_from){
                                first_delivery_time+=' -'+drops[0].time_to

                            }
                        }



                        var row=`<tr id="row${item.id}" class="${row_bg_class}">
                        <td>${item.id}</td>
                        <td><span class="tooltip">${item.customer_code}<span class="tooltiptext">${item.customer_name}</span></span></td>
                        <td style="text-align:right;">${item.po_number}</td>
                        <td style="text-align:left; white-space:nowrap">${pick_up_location} ${pick_up_appointment_type}</td>
                        <td style="text-align:left; white-space:nowrap">${drop_location} ${drop_appointment_type}</td>
                        <td style="white-space:nowrap">${pick_up_date}</td>
                        <td style="white-space:nowrap">${pick_up_time}</td>
                        <td style="white-space:nowrap">${first_delivery_date}</td>
                        <td style="white-space:nowrap">${first_delivery_time}</td>
                        <td style="white-space:nowrap">${drop_date}</td>
                        <td style="white-space:nowrap">${drop_time}</td>
                        


                        <td>${item.shipper_region}</td>
                        <td>${item.trailer_type}</td>
                        <td> ${item.temperature_to_maintain} </td>
                        <td>${item.rate}</td>
                        <td style="width:100px !important"><select data-load-status="" ></select></td>
                        <td style="width:100px !important"><input style="width:70px" type="text" value="${item.alloted_truck_code}" list="quick_list_trucks" data-selected-truck-id="${item.alloted_truck_id}" name="quick_list_trucks_search" ></td>
                        <td style="width:30px;"><input type="checkbox" data-team-checkbox ${team_checked}></td>
                        <td style="width:150px !important" data-drivers-options-td>
                        <input type="text"  list="quick_list_drivers" data-selected-driver-id="${item.alloted_driver_id}" value="${item.alloted_driver_code} ${item.alloted_driver_name}" data-driver-a name="quick_list_drivers_search" >
                        <input type="text" style="margin-top:5px;display:${driver_b_display}"  list="quick_list_drivers" data-selected-driver-id="${item.alloted_driver_b_id}" value="${item.alloted_driver_b_code} ${item.alloted_driver_b_name}" data-driver-b name="quick_list_drivers_search">
                        </td>
                        <td style="white-space:nowrap" ><button class="btn_green" data-action="update-opration-info" title="Save opreration info" data-eid="${item.eid}">Save</button>
                        </td>
                        <td>
                        <input style="width:100px" type="text"  list="quick_list_booker" data-selected-booker-id="${item.booked_by_user_id}" value="${item.booked_by_user_code}" data-booker name="quick_list_booker_search" >
                        </td>
                        <td style="width:30px;"><input type="checkbox" data-pending-rc-checkbox ${pending_rc_checked}></td>
                        <td style="white-space:nowrap" ><button class="btn_green" data-action="update-booking-info" title="Save booking info" data-eid="${item.eid}">Save</button>
                        </td>                        
                        <td style="white-space:nowrap">`;
                        <?php  if(in_array('P0170', USER_PRIV)){
                            ?>
                            row+=`<button title="Edit" class="btn_grey_c"><a href="../user/dispatch/express-loads/update?eid=`+item.eid+`"><i class="fa fa-pen"></i></a></button>`;
                            <?php
                        }
                        if(in_array('P0173', USER_PRIV)){
                            ?>
                            row+=`<button title="Crete Load"><a href="../user/dispatch/loads/add-new?exp-load=`+item.eid+`"><i class="fa fa-arrow-circle-right clr-blue" style="font-size:1.3em;"></i></a></button>`;
                            <?php
                        }

                        ?>

                        row+=`</td></tr>`;
                        $('#tabledata').append(row);
                        bind_load_status({row_id:`row${item.id}`,default_select:item.status_id})

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
  function bind_load_status(param){
   get_load_status().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
    })
      $(`#`+param.row_id).find('[data-load-status]').html(options);
      $(`#`+param.row_id).find(`[data-load-status] option[value="${param.default_select}"]`).prop('selected',true);     
  }
}
}).catch(function(err) {
  console.log(err)
  // Run this when promise was rejected via reject()
}) 
}

</script>

<datalist id="quick_list_booker"></datalist>

<script type="text/javascript">

  $(document.body).on('change', '[name="quick_list_booker_search"]' ,function(){

     let booker_id_selected=$(`[data-booker-filter-rows="${$(this).val()}"]`).data('value');
     if(booker_id_selected!=undefined){
      $(this).data('selected-booker-id',booker_id_selected)
  }
});




  quick_list_users().then(function(data) {
    console.log(data)
  // Run this when your request was successful

  if(data.status){



    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option data-booker-filter-rows="" data-value="" value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option data-booker-filter-rows="`+item.code+`" data-value="${item.id}" value="`+item.code+`"></option>`;               

    })

      $('#quick_list_booker').html(options);     

  }

}

}) 
</script>


<datalist id="quick_list_drivers"></datalist>

<script type="text/javascript">

  $(document.body).on('change', '[name="quick_list_drivers_search"]' ,function(){

    driver_id_selected=$(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if(driver_id_selected!=undefined){
      $(this).data('selected-driver-id',driver_id_selected)
  }
});



  function bind_quick_list_drivers(){

   quick_list_drivers().then(function(data) {

  // Run this when your request was successful

  if(data.status){



    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option data-driver-filter-rows="" data-value="" value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option data-driver-filter-rows="`+item.code+' '+item.name+`" data-value="${item.id}" value="`+item.code+' '+item.name+`"></option>`;               

    })

      $('#quick_list_drivers').html(options);     

  }

}

}).catch(function(err) {

  // Run this when promise was rejected via reject()

}) 

}

bind_quick_list_drivers()

</script>

<datalist id="quick_list_trucks"></datalist>

<script type="text/javascript">

  $(document.body).on('change', '[name="quick_list_trucks_search"]' ,function(){
    truck_id_selected=$(`option[value="${$(this).val()}"]`).data('value');
    if(truck_id_selected!=undefined){
      $(this).data('selected-truck-id',truck_id_selected)

  }
});





  function bind_quick_list_trucks(){

   quick_list_trucks().then(function(data) {

  // Run this when your request was successful

  if(data.status){



    //Run this if response has list

    if(data.response.list){


      var options="";

      options+=`<option data-driv-filter-rows="" data-value="" value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option data-value="${item.id}" value="`+item.code+`"></option>`;               

    })

      $('#quick_list_trucks').html(options);   

  }

}

}).catch(function(err) {

  // Run this when promise was rejected via reject()

}) 

}

bind_quick_list_trucks()

</script>


<script type="text/javascript">
  function sort_table(){
    show_list()
}
</script>

<datalist id="quick_list_drivers_for_search"></datalist>

<script type="text/javascript">

  $(document.body).on('change', '[data-search-driver]' ,function(){

    driver_id_filter=$(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if(driver_id_filter!=undefined){
        $('[data-filter="driver_id"]').val(driver_id_filter)
        alert(driver_id_filter)
        show_list()
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
        alert(truck_id_filter)
        show_list()
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
  }
}
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 

</script>

<script type="text/javascript">


//alert(date_format('01/02/1990'))

</script>

<br><br><br>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>