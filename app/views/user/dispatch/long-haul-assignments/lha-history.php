<?php require_once APPROOT.'/views/includes/user/header.php';?>
<section class="rv content-box" style="margin: auto;max-width: 1350px">
    <h1 class="rv-heading">Long Haul Assignment History</h1>

<section class="rv-filter-section"></section>

<section class="rv-filter-buttons">
    <ul id="rv-filter-buttons-container"></ul>
    <div></div>
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
                <th>ETA to planned Load</th>
                <th>Tentative Start Date</th>
                <th>Planned Load</th>
                <th>Added By</th>
                <th>Updated By</th>
                <th></th>
            </tr>                       
        </thead>
        <tbody id="tabledata"></tbody>
    </table>
    </div>
<div data-pagination></div>
</section>



<script type="text/javascript">      
    function show_list(){
        show_processing_modal()
        $.ajax({
            url:'../user/dispatch/long-haul-assignments/history-ajax',
            type:'POST',
            data:{
                 lha_eid:'<?php echo $_GET['eid'] ?>',
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
                        <td style="white-space:nowrap">
                        <span class="text-link"  onclick="open_quick_view_driver('${item.driver_eid}')">${item.driver_code} ${item.driver_name}</span>`


                        if(item.driver_b_eid!=""){
                            row+=`<br><span class="text-link"  onclick="open_quick_view_driver('${item.driver_b_eid}')">${item.driver_b_code} ${item.driver_b_name}</span>`
                        }

                        row+=`</td>
                        <td><span class="text-link"  onclick="open_quick_view_truck('${item.truck_eid}')">${item.truck_code}</span></td>
                        <td>${item.driver_start_date}</td>
                        <td>${item.driver_start_day}</td>
                        <td>${item.driver_notes}</td>
                        <td>${item.driver_current_status}</td>
                        <td>${item.driver_current_location}</td>
                        <td>${item.driver_eta_to_planned_load}</td>
                        <td></td>
                        <td>${item.planned_load_id}</td>
                        <td>${item.added_by_user_name}<br><span style="white-space:nowrap">${item.added_on_datetime}</span></td>
                        <td>${item.updated_by_user_name}<br><span style="white-space:nowrap">${item.updated_on_datetime}</span></td>
                        `


                    row+=`</td></tr>`;
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
<br><br><br>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>