<?php require_once APPROOT.'/views/includes/user/header-quick-view.php';
$data=$_GET;
$default_date=(isset($data['driver-start-date']) && $data['driver-start-date']!='')?date('m/d/Y',strtotime($data['driver-start-date'])):'';
?>
<section class="rv content-box" style="margin: auto;max-width: 1350px">
    <h1 class="rv-heading">Choose Driver/Truck</h1>

<section class="rv-filter-section">

    <div class="filter-item fourth">
        <label>Start Date From</label>
        <input type="text" data-date-picker="" data-filter="driver_start_date_from" onchange="set_params('driver_start_date_from', this.value), goto_page(1)" value="<?php echo $default_date; ?>">
    </div>
    <div class="filter-item fourth">
        <label>Start Date To</label>
        <input data-date-picker="" type="text" data-filter="driver_start_date_to" onchange="set_params('driver_start_date_to', this.value), goto_page(1)" value="<?php echo $default_date; ?>" />
    </div>
    <div class="filter-item fourth"></div>
    <div class="filter-item fourth"></div>
</section>

<div class="rv-table">
    <table data-my-table>
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Team/Solo</th>
                <th>Driver</th>
                <th>Truck</th>
                <th>Start Date</th>
                <th>Start Day</th>
                <th>Notes</th>
                <th>Current Status</th>
                <th>Current Location</th>
                <th></th>
                <th>Reason of Cancelation</th>
            </tr>                       
        </thead>
        <tbody id="tabledata"></tbody>
    </table>
    </div>
<div data-pagination></div>
</section>


<script type="text/javascript">
    $('[data-filter="driver_start_date_from"]').val(check_url_params('driver_start_date_from'))
    $('[data-filter="driver_start_date_to"]').val(check_url_params('driver_start_date_to'))

     
    function show_list(){
        show_processing_modal()
        $.ajax({
            url:'../user/dispatch/long-haul-assignments-driver-wise-un-assigned-quick-list-ajax',
            type:'POST',
            data:{
                sort_by:$('#sort_by').val(),
                page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
                batch:(check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
                driver_start_date_from:check_url_params('driver_start_date_from'),
                driver_start_date_to:check_url_params('driver_start_date_to'),
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
                        driver_b_display=(item.is_team_driver==false)?'none':'';

                        var row=`<tr id="row${item.id}" class="">
                        <td style="white-space:nowrap">${item.sr_no}</td>
                        <td>${item.is_team_driver}</td>
                        <td style="white-space:nowrap;text-align:left">
                        <span class="text-link"  onclick="open_quick_view_driver('${item.driver_eid}')">${item.driver_code} ${item.driver_name}</span>`


                        if(item.driver_b_eid!=""){
                            row+=`<br><span class="text-link"  onclick="open_quick_view_driver('${item.driver_b_eid}')">${item.driver_b_code} ${item.driver_b_name}</span>`
                        }

                        row+=`</td>
                        <td><span class="text-link"  onclick="open_quick_view_truck('${item.truck_eid}')">${item.truck_code}</span></td>
                        <td>${item.driver_start_date}</td>
                        <td>${item.driver_start_day}</td>
                        <td style="max-width:200px;text-align:left">${item.driver_notes}</td>
                        <td style="max-width:150px;text-align:left">${item.driver_current_status}</td>
                        <td style="max-width:150px;text-align:left">${item.driver_current_location}</td>
                      `


                        row+=`</td>
                        <td style="background:white !important"><button class="btn_green" data-action="choose-driver-truck-load" data-lha-id="${item.id}">Choose</button></td>
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
  $(document).ready(function(){
   $(document).on("click", "[data-action='choose-driver-truck-load']",function(){
      $.ajax({
        url:'../user/dispatch/long-haul-assignments/assign-load-action',
        type:'POST',
        data:{
          lha_id:$(this).data("lha-id"),
          express_load_id:check_url_params('id')
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