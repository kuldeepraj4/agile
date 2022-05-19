<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<style type="text/css">
    .dtlv {
        box-shadow: 0 0 10px -1px darkgrey;
        background: white;
        text-align: center;
        padding: 10px;
        display: block;
        border-radius: 12px;
    }

    .dtlv-heading {
        margin-bottom: 10px;
        font-size: 2em;
        color: var(--theme-color-four);
    }

    .dtlv>section {
        border: 1px solid lightgrey;
        border-radius: 8px;
        overflow: hidden;
        margin: 25px auto;
    }

    .dtlv .dtlv-sec-head {
        display: flex;
        justify-content: space-between;
        padding: 5px 10px;
        background: #486e94;
        border-bottom: 1px solid lightgrey;
    }

    .dtlv .dtlv-sec-heading {
        font-weight: bold;
        font-size: 1.1em;
        color: white;
    }

    .dtlv-sec-heading.angle_down::after {
        color: grey;
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        content: "\f107";
        font-size: 1.2em;
    }

    .dtlv .dtlv-sec-head a {
        color: white;
    }


    .dtlv .dtlv-dtl .dtlv-dtl-content {
        padding: 8px;
        display: flex;
        justify-content: space-between;
    }

    .dtlv .dtlv-dtl .dtlv-dtl-action-bar {
        display: flex;
        justify-content: flex-end;
    }

    .dtlv .dtlv-dtl .dtlv-dtl-content>div {
        margin: 8px;
        flex-grow: 1;
    }


    .dtlv .dtlv-attr-val-list li {
        display: flex;
    }

    .dtlv .dtlv-attr-val-list li>div {
        padding: 3px 10px;
    }

    .dtlv .dtlv-attr-val-list li>div:nth-child(1) {
        width: 40%;
        font-style: italic;
        text-align: left;
    }

    .dtlv .dtlv-attr-val-list li>div:nth-child(2) {
        width: 55%;
        flex-grow: 1;
        text-align: left;
    }

    .dtlv-dtl-list>table {
        border: 1px solid darkgrey;
        border-collapse: collapse;
        background: white;
        overflow: auto;
        box-sizing: border-box;
        width: 95%;
        margin: 8px auto;
    }

    .dtlv-dtl-list>table>thead {
        background: #f2f2f2;
        color: black;
    }

    .dtlv-dtl-list>table>thead>tr {
        border-bottom: 1px solid darkgrey;
    }

    .dtlv-dtl-list>table>thead>tr>th {
        padding: 8px 12px;
        font-weight: normal;
    }

    .dtlv-dtl-list>table>tbody>tr>td {
        padding: 8px 12px;
    }

    .dtlv-dtl-list>table>tbody>tr {
        border-bottom: 1px solid #f0f0f0
    }

    .dtlv-dtl-list>table>tbody>tr:last-child {
        border-bottom: none;
    }

    .dtlv-dtl-list>table>thead>tr>td {
        text-align: center;
    }

    .dtlv-dtl-list>table>tbody>tr>td {
        text-align: center;
    }

    .dtlv-dtl-list.dtlv-dtl-list-a>table>thead {
        background: #486e94;
    }

    .dtlv-dtl-list.dtlv-dtl-list-a>table>thead>tr {
        border: 1px solid grey;
    }

    .dtfv-top-action-bar {
        display: flex;
        justify-content: flex-end;
        padding: 4px 1px;
    }
</style>
<section class="dtlv content-box" style="margin: auto;max-width: 1150px">
    <h1 class="dtlv-heading">Tracking Load Detail</h1>
    <section>
        <div class="dtlv-sec-head" data-hide-show-details>
            <div class="dtlv-sec-heading">Load Information</div>
        </div>
        <div class="dtlv-dtl">
            <div class="dtlv-dtl-content">
                <div class="dtlv-attr-val-list" style="max-width: 500px;">
                    <ul style="font-weight: bold;margin-bottom:10px;">
                        <li>Shipper</li>
                    </ul>
                    <ul>
                        <li>
                            <div>Address</div>
                            <div>addresss is herer</div>
                        </li>
                        <li>
                            <div>Appt:</div>
                            <div>07/28</div>
                        </li>
                        <li>
                            <div>Arrived:</div> 
                            <div>07/28</div>
                        </li>
                        <li>
                            <div>Departed</div>
                            <div>chdfgdhsfg</div>
                        </li>
                        <li>
                            <div>Detention:</div>
                            <div>jhgfagdiuasg</div>
                        </li>

                    </ul>
                </div>


                <div class="dtlv-attr-val-list" style="max-width: 500px;">
                    <ul style="font-weight: bold;margin-bottom:10px;">
                        <li>Consignee</li>
                    </ul>
                    <ul>
                        <li>
                            <div>Address</div>
                            <div>addresss is herer</div>
                        </li>
                        <li>
                            <div>Tracking Status</div>
                            <div>On Time</div>
                        </li>
                        <li>
                            <div>Appt:</div>
                            <div>07/28</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section>
    <div style="width:100%;height:100%;border:1px solid grey;">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13771.561838154592!2d76.3974363!3d30.3540629!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3e9fcdc279398431!2sSIGEA%20SOLUTIONS!5e0!3m2!1sen!2sin!4v1631860245440!5m2!1sen!2sin" style="border:0; width: 100%;height: 100%;" allowfullscreen="" loading="lazy"></iframe>
  </div>
    </section>
</section>

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
                                       <td>${counter}</td>
                                       <td>${counter}</td>
                                       <td>${counter}</td>
                                       <td>${counter}</td>
                                       <td>${counter}</td>
                                       <td>${counter}</td>
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