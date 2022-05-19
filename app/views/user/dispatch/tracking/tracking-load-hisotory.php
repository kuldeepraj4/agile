<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<section class="rv content-box" style="margin: auto;max-width: 1600px !important;">
    <h1 class="rv-heading" data-tracking-load>Load Tracking History</h1>

    <div class="rv-table">
        <table data-my-table>
            <input type='hidden' id='sort' value='asc'>
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Timestamp</th>
                    <th>Status</th>
                    <th style="text-align:left">Note</th>
                    <th>Next Follow Up</th>
                    <th>Added By</th>
                </tr>
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
    </div>
</section>
<script type="text/javascript">
    function get_row_bg(id) {
        switch (id) {
            case 'Accident':
                row_bg_class = 'bg-mild-grey';
                break;
            case 'At Risk':
                row_bg_class = 'bg-mild-yellow';
                break;
            case 'Delay Breakdown':
                row_bg_class = 'bg-mild-green';
                break;
            case 'Delay Inspection':
                row_bg_class = 'bg-mild-green';
                break;
            case 'Early':
                row_bg_class = 'bg-mild-blue';
                break;
            case 'Late':
                row_bg_class = 'bg-mild-red';
                break;
            case 'Needs Appointment':
                row_bg_class = 'bg-mild-red';
                break;
            case 'On Time':
                row_bg_class = 'bg-mild-green';
                break;
            default:
                row_bg_class = ''
                break
        }
        return row_bg_class;
    }
</script>
<script type="text/javascript">

    function show_list() {
        show_processing_modal()
        $.ajax({
            url: '../user/dispatch/tracking/load-tracking-history-ajax',
            type: 'POST',
            data:{
                load_eid:'<?php echo $data['eid'] ?>'
            },
            beforeSend: function() {
                show_table_data_loading("[data-my-table]")
            },
            complete: function() {
                hide_processing_modal()
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    $('#tabledata').html("");
                    if (data.status) {
                        var counter = 1;

                        $('[data-tracking-load]').append(` - ${data.response.details.load_id}`)

                        if(data.response.details.tracking_history.length>0){
                            $.each(data.response.details.tracking_history, function(index, item) {
                            var row = `<tr>
                                       <td>${item.sr_no}</td>
                                       <td style="white-space:nowrap">${item.added_on}</td>
                                       <td class="${get_row_bg(item.status)}">${item.status}</td>
                                       <td style="text-align:left">${item.note}</td>
                                       <td>${item.next_follow_up_on}</td>
                                       <td>${item.added_by}</td>
                                       </tr>`;

                            $('#tabledata').append(row);
                            counter++;
                        })
                        }else{
                            $('#tabledata').html(`<tr><td colspan="6" style="color:red;"> No Tracking History Found</td></tr>`);
                        }
                        
                    } else {
                        var false_message = `<tr><td colspan="18">` + data.message + `</td></tr>`;
                        $('#tabledata').html(false_message);
                    }
                }
            }
        })
    }
    show_list()
</script>


<script type="text/javascript">
    function get_row_bg(id) {
        switch (id) {
            case 'Accident':
                row_bg_class = 'bg-mild-grey';
                break;
            case 'At Risk':
                row_bg_class = 'bg-mild-yellow';
                break;
            case 'Delay Breakdown':
                row_bg_class = 'bg-mild-green';
                break;
            case 'Delay Inspection':
                row_bg_class = 'bg-mild-green';
                break;
            case 'Early':
                row_bg_class = 'bg-mild-blue';
                break;
            case 'Late':
                row_bg_class = 'bg-mild-red';
                break;
            case 'Needs Appointment':
                row_bg_class = 'bg-mild-red';
                break;
            case 'On Time':
                row_bg_class = 'bg-mild-green';
                break;
            default:
                row_bg_class = ''
                break
        }
        return row_bg_class;
    }
</script>