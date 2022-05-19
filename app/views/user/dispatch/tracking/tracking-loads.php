<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<section class="rv content-box" style="margin: auto;max-width: 1600px !important;">
    <h1 class="rv-heading">Tracking Loads</h1>
    <section class="rv-filter-section">
        <!-- input used for sory by call-->
        <input type="hidden" id="sort_by" value="">
        <!-- //input used for sory by call-->
        <div class="filter-item fourth">
            <label>Search</label>
            <input type="text" data-filter="search" placeholder="search here..." onchange="set_params('search', this.value), goto_page(1), show_group_list()">
        </div>
        <div class="filter-item fourth" style="visibility:hidden !important;"></div>
        <div class="filter-item fourth" style="visibility:hidden !important;"></div>  
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
                    <th>Sr.No</th>
                    <th>Load No.</th>
                    <th>Load Status</th>
                    <th>Route</th>
                    <th>PO No.</th>
                    <th>Tracking Status</th>
                    <th>Tracking Notes</th>
                    <th>Updated By</th>
                    <th>Next Followup</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
    </div>
</section>
<script type="text/javascript">
    var active_status_id_array = ['Accident', 'At Risk', 'Delay Breakdown', 'Delay Inspection', 'Early', 'Late', 'Needs Appointment', 'On Time','To Be Updated']

    function show_group_list() {
        $.ajax({
            url: '../user/dispatch/tracking/loads-tracking-status-wise-total',
            type: 'POST',
            data: {
                search: check_url_params('search'),
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    $('#rv-filter-buttons-container').html("");
                    if (data.status) {
                        $.each(data.response.list, function(index, item) {

                            let checked = (active_status_id_array.includes(item.load_tracking_status)) ? 'checked' : ''
                            $('#rv-filter-buttons-container').append(`<li data-group-selector-button class="` + get_row_bg(item.load_tracking_status) + `"><label><input type="checkbox" data-status-id-group ${checked} value="${item.load_tracking_status}"><span> ${item.load_tracking_status}</span> <span> ${item.total_loads}</span></label></li>`);
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
    $(document.body).on('change', '[data-group-selector-button]', function() {
        // $(this).find("input").click()
        active_status_id_array = [];
        $('[data-status-id-group]:checked').each(function() {
            active_status_id_array.push($(this).val())
        })
        show_list()
    });
    //---/select or deselect group button checkboxes
</script>
<script type="text/javascript">
    function show_list() {
        show_processing_modal()
        $.ajax({
            url: '../user/dispatch/tracking/loads-ajax',
            type: 'POST',
            data: {
                sort_by: $('#sort_by').val(),
                sort_by_order_type: $('#sort').val(),
                search: check_url_params('search'),
                tracking_status: active_status_id_array.toString(),
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
                        $.each(data.response.list, function(index, item) {
                            var row = `<tr>
                                       <td>${counter}</td>
                                       <td>${item.id}</td>
                                       <td class="${get_load_row_bg(item.load_status)}">${item.load_status}</td>
                                       <td style="text-align:left;">${item.shipper_location} to ${item.consignee_location}</td>
                                       <td>${item.po_number}</td>
                                       <td class="${get_row_bg(item.tracking_status)}">${item.tracking_status}</td>
                                       <td>${item.tracking_note}</td>
                                       <td style="background:${(item.is_tracking_delayed=='YES')?'red':''}">${item.tracking_updated_by}<br>${item.tracking_updated_on}</td>
                                       <td style="background:${(item.next_follow_up_status=='PENDING')?'red':''}">${item.next_follow_up_on}</td>
                                       <td class="act-box">
                                       <i class="ic history" title="View Tracking History" onclick="open_child_window({url:'../user/dispatch/tracking/load-tracking-history?eid=${item.eid}',width:1300,height:900})"></i>
                                       <i class="fa fa-eye" style="color:grey" title="View Tracking Load"  onclick="open_child_window({url:'../user/dispatch/tracking/load-details&eid=${item.eid}',width:1300,height:900})"></i>&nbsp;&nbsp;<i class="ic edit" style="color:grey" title="Update Tracking"  onclick="open_child_window({url:'../user/dispatch/loads/update-tracking&eid=${item.eid}',width:800,height:500})"></i></td>
                            </tr>`;

                            $('#tabledata').append(row);
                            counter++;
                        })
                    } else {
                        var false_message = `<tr><td colspan="18">` + data.message + `<td></tr>`;
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