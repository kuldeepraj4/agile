<?php require_once APPROOT.'/views/includes/user/header-quick-view.php';
$data=$_GET;
$default_date=(isset($data['tentative-start-date']) && $data['tentative-start-date']!='')?date('m/d/Y',strtotime($data['tentative-start-date'])):'';
?>
<section class="rv content-box" style="margin: auto;max-width: 1350px">
    <h1 class="rv-heading">Choose Express Load</h1>
    <section class="rv-filter-section">

    <div class="filter-item fourth">
        <label>Start Date From</label>
        <input type="text" data-date-picker="" data-filter="tentative_start_date_from" onchange="set_params('tentative_start_date_from', this.value), goto_page(1)" value="<?php echo $default_date; ?>">
    </div>
    <div class="filter-item fourth">
        <label>Start Date To</label>
        <input data-date-picker="" type="text" data-filter="tentative_start_date_to" onchange="set_params('tentative_start_date_to', this.value), goto_page(1)" value="<?php echo $default_date; ?>" />
    </div>
    <div class="filter-item fourth"></div>
    <div class="filter-item fourth"></div>
</section>

<div class="rv-table">
    <table data-my-table>
        <thead>
            <tr>
                <th data-table-sort-by="id">ID</th>
                <th>Ten. Start Date</th>
                <th>Type</th>
                <th>Cust.</th>
                <th style="text-align:right;white-space: nowrap;">PO No.</th>
                <th>Pick Up</th>
                <th>Delivery</th>
                <th>Drop at Shipper</th>
                <th>Pick Up Date</th>
                <th>Pick Up Time</th>
                <th>First Delivery Date</th>
                <th>First Delivery Time</th>
                <th>Final Delivery Date</th>
                <th>Final Delivery Time</th>
                <th>Pick From Consignee</th>
                <th>Region</th>
                <th>Status</th>
                <th>Trailer</th>
                <th></th>
            </tr>                       
        </thead>
        <tbody id="tabledata"></tbody>
    </table>
    </div>
<div data-pagination></div>
</section>

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
    $('[data-filter="tentative_start_date_from"]').val(check_url_params('tentative_start_date_from'))
    $('[data-filter="tentative_start_date_to"]').val(check_url_params('tentative_start_date_to'))

     
    function show_list(){
        show_processing_modal()
        $.ajax({
            url:'../user/dispatch/long-haul-assignments-load-wise-un-assigned-quick-list-ajax',
            type:'POST',
            data:{
                lha_status_id:'UN-ASSIGNED',
                region_code:'WEST',
                tentative_start_date_from:check_url_params('tentative_start_date_from'),
                tentative_start_date_to:check_url_params('tentative_start_date_to'),                
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
                     var counter=1;    
                     $.each(data.response.list, function(index, item) {
                        row_bg_class=get_load_row_bg(item.status_id)
                        is_high_priority_note=(item.high_priority_note=='YES')?'<span class="ic exclamation" style="color:yellow;text-shadow: 2px 2px #FF0000;"></span>':'';
                        //team_checked=(item.is_team_driver=='')?'TEAM':'SOLO';
                        driver_b_display=(item.is_team_driver==false)?'none':'';
                        pick_up_location=item.shipper.location;
                        pick_up_time=item.shipper.time_from
                        pick_up_date=(item.shipper.date!="")?date_format(item.shipper.date):''

                        if(item.shipper.time_to!=item.shipper.time_from){
                            pick_up_time+=' -'+item.shipper.time_to

                        }
                        pick_up_time_bg_color=""
                        if(item.shipper.datetime_tbd=="YES"){
                            pick_up_time='TBD';
                            pick_up_time_bg_color="bg-light-purple"
                        }
                        drop_location=item.consignee.location;
                        drop_time=item.consignee.time_from
                        drop_date=(item.consignee.date!="")?date_format(item.consignee.date):''

                        if(item.consignee.time_to!=item.consignee.time_from){
                            drop_time+=' -'+item.consignee.time_to

                        }
                        drop_time_bg_color=""
                        if(item.consignee.datetime_tbd=="YES"){
                            drop_time='TBD';
                            drop_time_bg_color="bg-light-purple"
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
                        var first_delivery_time_bg_color=""

                        if(drops[0]){
                            first_delivery_date=(drops[0].date!="")?date_format(drops[0].date):'';
                            first_delivery_time=drops[0].time_from;
                            if(drops[0].time_to!=drops[0].time_from){
                                first_delivery_time+=' -'+drops[0].time_to

                            }
                            if(drops[0].datetime_tbd=='YES'){
                                first_delivery_time='TBD'
                                first_delivery_time_bg_color="bg-light-purple"
                            }
                        }

                        drop_at_shipper=(item.has_shipper_range=="YES")?date_format(item.drop_at_shipper_date):''
                        pick_from_consignee=(item.has_consignee_range=="YES")?date_format(item.pick_at_consignee_date):''

                        var temperature_to_maintain=(item.temperature_as_per_shipper=='YES')?'As Per Shipper':item.temperature_to_maintain+'<br>'+item.reefer_mode


                        var row=`<tr id="row${item.id}" class="${row_bg_class}">
                        <td style="white-space:nowrap">
                        <a class="text-link" href="../user/dispatch/express-loads/details?eid=`+item.eid+`">${is_high_priority_note} ${item.id}</a></td>
                        <td>${item.tentative_start_date}</td>
                        <td>${item.load_type_abbr}</td>
                        <td><span class="tooltip">${item.customer_code}<span class="tooltiptext">${item.customer_name}</span></span></td>
                        <td style="text-align:right;">${item.po_number}</td>
                        <td style="text-align:left; white-space:nowrap">${pick_up_location} ${pick_up_appointment_type}</td>
                        <td style="text-align:left; white-space:nowrap">${drop_location} ${drop_appointment_type}</td>
                        <td style="white-space:nowrap">${drop_at_shipper}</td>
                        <td style="white-space:nowrap">${pick_up_date}</td>
                        <td style="white-space:nowrap" class="${pick_up_time_bg_color}">${pick_up_time}</td>
                        <td style="white-space:nowrap">${first_delivery_date}</td>
                        <td style="white-space:nowrap" class="${first_delivery_time_bg_color}">${first_delivery_time}</td>
                        <td style="white-space:nowrap">${drop_date}</td>
                        <td style="white-space:nowrap" class="${drop_time_bg_color}">${drop_time}</td>
                        <td>${pick_from_consignee}</td>
                        <td>${item.shipper_region}</td>
                        <td>${item.status_id}</td>`
                        if(item.trailer_eid!=""){
                            row+=`<td><span class="text-link"  onclick="open_quick_view_trailer('${item.trailer_eid}')">${item.trailer_code}</span></td>`
                        }else{
                            row+=`<td></td>`;
                        }
                        row+=`
                          <td style="background:white !important"><button class="btn_green" data-action="choose-exp-load" data-express-load-id="${item.id}">Choose</button></td>
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



<script type="text/javascript">

  $(document).ready(function(){
   $(document).on("click", "[data-action='choose-exp-load']",function(){
      $.ajax({
        url:'../user/dispatch/long-haul-assignments/assign-load-action',
        type:'POST',
        data:{
          lha_id:check_url_params('lha-id'),
          express_load_id:$(this).data("express-load-id")
        },
        context: this,
        success:function(data){
         if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         if(data.status){
         window.opener.show_list()
         window.close();
        }else{
          alert(data.message)
        }
      }
    })
    
  });
 });

</script>
<br><br><br>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>