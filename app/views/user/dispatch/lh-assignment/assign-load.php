<?php require_once APPROOT.'/views/includes/user/header-quick-view.php';
$data=$_GET;
$default_date=(isset($data['tentative-start-date']) && $data['tentative-start-date']!='')?date('m/d/Y',strtotime($data['tentative-start-date'])):'';
?>
<section class="rv content-box" style="margin: auto;max-width: 1350px">
    <h1 class="rv-heading">Choose Load</h1>
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
                <th>Pick Up Date</th>
                <th>Pick Up Time</th>
                <th>First Delivery Date</th>
                <th>First Delivery Time</th>
                <th>Final Delivery Date</th>
                <th>Final Delivery Time</th>
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
            url:'../user/dispatch/lh-assignment/load-wise-un-assigned-quick-list-ajax',
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

                        delivery_time_bg_color = ""
                        delivery_time="";
                        if (item.delivery_datetime_tbd == "YES") {
                            delivery_time = 'TBD';
                            delivery_time_bg_color = "bg-light-purple"
                        }else if (item.delivery_time_from == item.delivery_time_to) {
                            delivery_time=item.delivery_time_from;
                        }else{
                            delivery_time=item.delivery_time_from+' -' + item.delivery_time_to
                        }


                        first_delivery_time_bg_color = ""
                        first_delivery_time="";
                        if (item.first_delivery_datetime_tbd == "YES") {
                            first_delivery_time = 'TBD';
                            first_delivery_time_bg_color = "bg-light-purple"
                        }else if (item.first_delivery_time_from == item.first_delivery_time_to) {
                            first_delivery_time=item.first_delivery_time_from;
                        }else{
                            first_delivery_time=item.first_delivery_time_from+' -' + item.first_delivery_time_to
                        }


                    var reefer_temperature = (item.temperature_as_per_shipper == 'YES') ? 'As Per Shipper' : item.reefer_temperature + '<br>' + item.reefer_mode
                    show_t=(item.allocated_is_team_driver=='TEAM')?'T':'';


                        var row=`<tr id="row${item.id}" class="${row_bg_class}">
                        <td style="white-space:nowrap">
                        <a class="text-link" href="../user/dispatch/express-loads/details?eid=`+item.eid+`">${item.id}</a></td>
                        <td>${item.tentative_start_date}</td>
                        <td>${item.load_type_abbr}</td>
                        <td><span class="tooltip">${item.customer_code}<span class="tooltiptext">${item.customer_name}</span></span></td>
                        <td style="text-align:right;">${item.po_number}</td>
                        <td style="text-align:left; white-space:nowrap">${item.pick_ups}</td>
                        <td style="text-align:left; white-space:nowrap">${item.deliveries}</td>
                        <td style="white-space:nowrap">${date_format(item.pick_up_date)}</td>
                        <td style="white-space:nowrap" class="${pick_up_time_bg_color}">${pick_up_time}</td>
                        <td style="white-space:nowrap">${date_format(item.first_delivery_date)}</td>
                        <td style="white-space:nowrap" class="${first_delivery_time_bg_color}">${first_delivery_time}</td>
                        <td style="white-space:nowrap">${date_format(item.delivery_date)}</td>
                        <td style="white-space:nowrap" class="${delivery_time_bg_color}">${delivery_time}</td>
                        <td>${item.pick_up_region}</td>
                        <td>${item.status_id}</td>
                        <td>Trailer</td>
                          <td style="background:white !important"><button class="btn_green" data-action="choose-load" data-load-id="${item.id}">Choose</button></td>
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
   $(document).on("click", "[data-action='choose-load']",function(){
      $.ajax({
        url:'../user/dispatch/lh-assignment/assign-load-action',
        type:'POST',
        data:{
          lha_id:check_url_params('lha-id'),
          load_id:$(this).data("load-id")
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