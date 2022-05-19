<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];
?>
<?php
require_once APPROOT . '/views/user/quick-details/quick-trip-excel.php';
?>
<!-- ------------------------------TRIP BASIC INFORMATION SECTION START HERE------------------------------------------------------------------------------------------------------------- -->
<br>
<section class="list-200 content-box" style="margin: auto;max-width: 1200px">

    <h1 class="list-200-heading">Trip Details<div class="dropdown" style="float:right; margin-right:10px;">
            <button class="dropbtn"><i class="fas fa-file-excel"></i>&nbsp;Excel &nbsp; <span style="border-left:1px solid #fff; padding-left:10px; "> <i class="fas fa-caret-down"></i></span></button>
            <div class="dropdown-content">
                <a onclick="tableToExcel('personal', 'All TRIPS DATA')">All</a>
                <a onclick="tableToExcel('tabledata_tripdetail_excel', 'Trip Excel Data')">Trip Details</a>
                <a onclick="tableToExcel('tabledata_tripstop_excel', 'Trip Stops Excel Data')">Trip Stops</a>
            </div>
    </h1>
    <div class="table  table-a">
        <table id="tabledata_tripdetail_excel">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Truck ID</th>
                    <th>Team/Solo</th>
                    <th>Miles</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Created By</th>
                    <th>Created Datetime</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    echo "<td>" . $details['id'] . "</td>
          <td>" . $details['truck_code'] . "</td>
          <td>" . $details['driver_group_name'] . "</td>
          <td>" . $details['miles'] . "</td>
          <td>" . $details['start_date'] . "</td>
          <td>" . $details['end_date'] . "</td>
          <td>" . $details['added_by_user_code'] . "<br>" . $details['added_by_user_name'] . "</td>
          <td>" . $details['added_on_date'] . " " . $details['added_on_time'] . "</td>
          ";  ?>
                </tr>
            </tbody>
        </table>
</section>
<br><br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1200px">

    <h1 class="list-200-heading">Trip Stops</h1>
    <div class="table  table-a">
        <table id="tabledata_tripstop_excel">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Miles</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($details['trip_stops'] as $ts) {
                    echo "<tr>
            <td>" . $ts['date'] . "</td>
            <td>" . $ts['stop_type_name'] . "</td>
            <td>" . $ts['location'] . "</td>
            <td>" . $ts['miles'] . "</td>
            <tr>";
                }
                ?>
            </tbody>
        </table>
</section>
<br><br>
<section style="display: flex; width: 1200px; justify-content: space-between;margin:auto;">
    <style type="text/css">
        .list-multi-desc {}

        .list-multi-desc>h1 {
            padding: 5px;
            background: #486e94;
            ;
            color: white;
            text-align: center;
        }

        .list-multi-desc>section {
            border: 1px solid grey;
            margin: 12px auto;
            border-radius: 2px;
            overflow: hidden;
        }

        .list-multi-desc>section>h2 {
            padding: 5px;
            font-weight: normal;
            background: #cfcaca;
            color: #595353;
            font-style: italic;
            font-weight: bold;
            text-align: center;
            font-size: 1em;
            text-align: left;
        }

        .list-multi-desc>section>div {}

        .list-multi-desc>section>div>div {
            display: flex;
            border-bottom: 1px solid #faf5f5;
            padding: 5px 10px;
            align-items: center;
        }

        .list-multi-desc>section>div>div>p:nth-child(1) {
            flex-grow: 1;
        }

        .list-multi-desc>section>div>div>p:nth-child(2) {
            width: 100px;
            text-align: right;
        }

        .list-multi-desc>section>div>h3 {
            display: flex;
            padding: 5px 10px;
            align-items: center;
            font-size: 1em;
            font-weight: normal;
        }

        .list-multi-desc>section>div>h3>p:nth-child(1) {
            flex-grow: 1;
        }

        .list-multi-desc>section>div>h3>p:nth-child(2) {
            width: 100px;
            text-align: right;
        }

        .list-multi-desc>section>h3 {
            display: flex;
            justify-content: space-between;
            border: 2px solid orange;
        }

        .list-multi-desc>section>h3>p:nth-child(1) {
            flex-grow: 1;
            border: 2px solid orange;
        }

        .list-multi-desc>section>h3>p:nth-child(2) {
            width: 100px;
            text-align: right;
        }

        .list-multi-desc>h3 {
            display: flex;
            padding: 0px 10px;
        }

        .list-multi-desc>h3>p:nth-child(1) {
            flex-grow: 1;
        }

        .list-multi-desc>h3>p:nth-child(2) {
            width: 100px;
            text-align: right;
        }
    </style>
    <?php
    foreach ($details['trip_drivers'] as $ts) {
    ?>
        <section class="content-box" style="margin: auto;width:550px">
            <div class="list-multi-desc">
                <h1><?php echo $ts['driver_code'] . " - " . $ts['driver_name']; ?></h1>
                <section>
                    <h2>BASIC</h2>
                    <div>
                        <div>
                            <p>Basic Earnings <br>( MILES x RATE ) <?php echo $ts['miles'] . ' x ' . $ts['pay_per_mile']; ?></p>
                            <p><?php echo $ts['basic_earnings']; ?></p>
                        </div>
                    </div>
                </section>
                <?php
                foreach ($ts['salary_parameters']['list'] as $ts_sp) {
                    if (count($ts_sp['parameters']) > 0) {
                ?>
                        <section>
                            <h2><?php echo $ts_sp['type']; ?></h2>
                            <div>
                                <?php
                                foreach ($ts_sp['parameters'] as $ts_sp_param) {
                                ?>
                                    <div>
                                        <p><?php echo $ts_sp_param['name']; ?></p>
                                        <p><?php echo $ts_sp_param['amount']; ?></p>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </section>
                <?php
                    }
                }
                ?>
                <h3>
                    <p>Net Payment</p>
                    <p><?php echo $ts['net_earnings']; ?></p>
                </h3>
                <section>
                    <h2>INCENTIVES</h2>
                    <div>
                        <div>
                            <p>MILES x INCENTIVES PER MILE<br><?php echo $ts['miles'] . ' x ' . $details['incentive_per_mile']; ?></p>
                            <p><?php echo $ts['incentive']; ?></p>
                        </div>
                    </div>
                </section>
                <section>
                    <h2>Remarks</h2>
                    <div>
                        <div>
                            <p style="white-space: pre;"><?php echo $ts['remarks'] ?></p>
                        </div>
                    </div>
                </section>
                <?php
                if ($details['approval_status'] == "PENDING" && in_array('P0134', USER_PRIV)) {
                }
                ?>
            </div>
        </section>
    <?php
    }
    ?>
</section>
<br><br>
<style type="text/css">
    .notes-area {
        width: 100%;
        max-width: 580px;
        margin: auto;
        background: lightblue;
        border: 1px solid grey;
        overflow: hidden;
        border-radius: 8px;
    }

    .notes-area h1 {
        text-align: center;
        background: #f1f1f1;
    }

    .notes-area .notes-box {
        height: 400px;
        overflow-y: auto;
        padding: 5px
    }

    .notes-area .note {
        background: white;
        padding: 6px;
        border-radius: 8px;
        margin: 5px auto;
        display: flex;
        width: 90%;
    }

    .notes-area .note.user-other {
        float: left;
    }

    .notes-area .note.user-self {
        float: right;
    }

    .notes-area .note.high-priority-true {
        background: var(--theme-color-red-light) !important;
    }

    .notes-area .note>div:nth-child(1) {
        width: 30px;
        text-align: center;
    }

    .notes-area .note .note-info {
        padding: 0 4px;
        color: grey;
        text-align: right;
        font-size: .8em;
        display: flex;
        align-items: center;
        margin-bottom: 5px;
    }

    .notes-area .note .note-info>div:nth-child(1) {
        width: 70%;
        text-align: left;
        color: var(--theme-color-blue)
    }

    .notes-area .note .note-info>div:nth-child(2) {
        width: 25%;
        flex-grow: 1;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        text-align: right;
    }

    .notes-area .note .note-text {
        white-space: pre-line;
        text-align: left;
        min-height: 50px;
    }

    .notes-area .notes-add-new-box {
        display: flex;
        align-items: center;
        padding: 10px;
        padding-top: 15px;
        background: #f2f2f2;
    }

    .notes-area .notes-add-new-box>div:nth-child(2) {
        width: 80px;
        padding: 8px;
    }

    .notes-area .notes-add-new-box>div:nth-child(1) {
        flex-grow: 1;
    }

    .notes-area .notes-add-new-box textarea {
        width: 100%;
        min-height: 100px;
    }

    .notes-area .notes-save-button {
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        font-size: 25px;
        background: var(--theme-color-green);
    }
</style>
<div data-notes-area="first"></div>
<script type="text/javascript">
    function create_notes_section(param) {
        $(`[data-notes-area="${param.notes_area}"]`).html(`<section class="notes-area">
      <h1>Notes</h1>
      <div class="notes-box"></div>
      <div class="notes-add-new-box">
      <div><textarea name="text" placeholder="Type something here. . . . "></textarea></div>
      <div><button  class="notes-save-button" title="Add notes" data-action="add-notes"><i class="fab fa-telegram-plane" style="color:white"></i></button></div>
      </div>
      </section>`);
    }
    var last_note_eid = 0;

    function show_notes(param1) {
        param2 = {
            reference_type_id: 'TRIP'
        }
        let param = Object.assign(param1, param2);
        var notes_area = `[data-notes-area="${param.notes_area}"]`;
        $.ajax({
            url: "<?php echo AJAXROOT; ?>" + 'user/miscellaneous/notes/list-ajax',
            type: 'POST',
            data: param,
            beforeSend: function() {
                // $(notes_area+` .notes-box`).html(`<i class="fa fa-spinner fa-span">Loading</i>`);
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    console.log(data)
                    // $(notes_area+` .notes-box`).html(``);
                    if (data.status) {
                        last_note_eid = data.response.last_note_eid;
                        $.each(data.response.list, function(index, item) {
                            var user_type = 'user-self';
                            if (item.user_type == 'OTHER') {
                                user_type = 'user-other';
                            }
                            var high_priority_status = '';
                            var high_priority_status_checked = '';
                            if (item.high_priority_status == 'ON') {
                                high_priority_status = 'high-priority-true';
                                high_priority_status_checked = 'checked'
                            }
                            var note = `<div class="note ${user_type} ${high_priority_status}"  data-note-eid="${item.eid}">
          <div style="flex-grow:1">
          <div class="note-info">
          <div><b>${item.added_by_user_code} </b><span style="color:grey">${item.added_on_datetime}</span></div>
          <div>`
                            if (user_type == 'user-self') {
                                note += `<input type="checkbox" data-notes-toggle-high-priority-status ${high_priority_status_checked} title="highpriority status"/> &nbsp<i data-note-delete class="fa fa-trash" style="font-size:.9em;color:var(--theme-color-grey)"></i>`
                            }
                            note += `</div>
          </div>
          <div class="note-text">${item.text}</div>
          </div></div>`;
                            $(notes_area + ` .notes-box`).append(note);
                        })
                        $(notes_area + ` .notes-box`).animate({
                            scrollTop: $(notes_area + ` .notes-box`)[0].scrollHeight
                        }, 0);
                        $(notes_area + ' [name="text"]').val('')
                    }
                }
            }
        })
    }
    create_notes_section({
        notes_area: 'first'
    })
    show_notes({
        notes_area: 'first',
        reference_eid: '<?php echo $details['eid'] ?>'
    })
</script>
<div id="demo"></div>
<script>
    var myVar;

    function showTime() {
        show_notes({
            notes_area: 'first',
            reference_eid: '<?php echo $details['eid'] ?>',
            last_note_eid: last_note_eid
        })
    }

    function stopFunction() {
        clearInterval(myVar); // stop the timer
    }
    $(document).ready(function() {
        myVar = setInterval("showTime()", 100000000);
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", "[data-action='add-notes']", function() {
            var text = $(this).parent().parent().find('[name="text"]').val()
            if (text.length) {
                $.ajax({
                    url: "<?php echo AJAXROOT; ?>" + 'user/miscellaneous/notes/add-new-action',
                    type: 'POST',
                    data: {
                        reference_eid: '<?php echo $data['eid']; ?>',
                        reference_type_id: 'TRIP',
                        text: text
                    },
                    context: this,
                    success: function(data) {
                        if ((typeof data) == 'string') {
                            data = JSON.parse(data)
                        }
                        if (data.status) {
                            show_notes({
                                notes_area: 'first',
                                reference_eid: '<?php echo $data['eid'] ?>',
                                last_note_eid: last_note_eid
                            });
                            var text = $(this).parent().parent().find('[name="text"]').val('')
                        } else {
                            alert(data.message)
                        }
                    }
                })
            } else {
                alert('Please write some text')
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", "[data-action='cancel']", function() {
            if (confirm('Do you want to cancel trip ?')) {
                var eid = '<?php echo $details['eid']; ?>';
                //alert(eid)
                $.ajax({
                    url: window.location.pathname + '/../cancel-action',
                    type: 'POST',
                    data: {
                        cancel_eid: eid
                    },
                    context: this,
                    success: function(data) {
                        // alert(data)
                        if ((typeof data) == 'string') {
                            data = JSON.parse(data)
                        }
                        if (data.status) {
                            $(this).parent().parent();
                            location.reload();
                            alert(data.message)
                        } else {
                            alert(data.message)
                        }
                    }
                })
            }
        });
    });
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>