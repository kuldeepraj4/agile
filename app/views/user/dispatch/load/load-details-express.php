<?php
require_once APPROOT . '/views/includes/user/header.php';
require_once APPROOT . '/views/includes/user/quick-menu-dispatch-loads.php';
$dtl = $data['details'];
// echo "<pre>";
// print_r($dtl);
// echo "</pre>";
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

    .dtlv .dtlv-dtl {}

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

    .dtlv .dtlv-attr-val-list ul {}

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

    .icon {
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
    }

    .icon:hover {
        transform: scale(1.1);
    }

    .icon.white {
        color: white !important;
    }

    .icon.grey {
        color: grey !important;
    }

    .icon.view::after {
        content: "\f06e";
    }

    .icon.view:hover {
        color: green;
    }

    .icon.edit::after {
        content: "\f304";
    }

    .icon.edit:hover {
        color: steelblue;
    }

    .icon.delete::after {
        content: "\f1f8";
    }

    .icon.delete:hover {
        color: red;
    }

    .icon.angle_down::after {
        content: "\f107";
        font-size: 1.2em;
    }

    .icon.angle_up::after {
        content: "\f106";
        font-size: 1.2em;
    }

    .icon.toggle-on::after {
        content: "\f205";
        font-size: 1.2em;
    }

    .icon.toggle-off::after {
        content: "\f204";
        font-size: 1.2em;
    }

    .icon.toggle-off:hover,
    .icon.toggle-on:hover {
        color: steelblue;
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


    .dtlv-dtl-list.dtlv-dtl-list-a {}

    .dtlv-dtl-list.dtlv-dtl-list-a>table>thead {
        background: #486e94;
    }

    .dtlv-dtl-list.dtlv-dtl-list-a>table>thead>tr {
        border: 1px solid grey;
    }

    /* ------------------css for notes start here-------------- */
    .aaf {
        display: flex;
    }

    .add-action {
        width: 80%;
    }

    .aaf-a {
        width: 70%;
    }

    .aaf-b {
        padding-left: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        justify-content: space-between;
        width: 30%
    }

    .aaf-b>div {
        width: 100%;
    }

    .aaf-b>div select {
        height: 35px
    }

    .bg-high-priority {
        background: pink;
    }

    .notes-th {
        background-color: #f2f2f2 !important;
        color: black;
    }

    /* ------------------css for notes end here ---------------- */
</style>
<br><br>
<section class="dtlv content-box" style="margin: auto;max-width: 1150px">
    <h1 class="dtlv-heading">LOAD <?php echo $dtl['id']; ?></h1>
    <section style="border-style: none;margin:0px;"><span style="float:left;" data-high-notes></span></section>
    <section>
        <div class="dtlv-sec-head" data-hide-show-details>
            <div class="dtlv-sec-heading">Load Information</div>
            <div>
                <button class="icon angle_up white" data-up-down-button></button>
            </div>
        </div>
        <div class="dtlv-dtl">
            <div class="dtlv-dtl-content">
                <div class="dtlv-attr-val-list" style="max-width: 500px;">
                    <ul>
                        <li>
                            <div>Customer</div>
                            <div><?php echo $dtl['customer_code'].' - '.$dtl['customer_name']; ?></div>
                        </li>
                        <li>
                            <div>PO Number</div>
                            <div><?php echo $dtl['po_number']; ?></div>
                        </li>
                        <li>
                            <div>Rate</div>
                            <div><?php echo $dtl['rate']; ?></div>
                        </li>
                    </ul>
                </div>


                <div class="dtlv-attr-val-list" style="max-width: 500px;">
                    <ul>
                        <li>
                            <div style="line-height: 1.7em;min-height: 1.7em;">Status</div>
                            <div style="font-weight:bolder;font-size: 1.7em"><?php echo $dtl['load_status_id']; ?></div>
                        </li>
                        <li>
                            <div>Trailer Type</div>
                            <div><?php echo $dtl['trailer_type']; ?></div>
                        </li>
                        <li>
                            <div>Reefer Temperature</div>
                            <div><?php echo $dtl['reefer_temperature']; ?></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>



    <?php
    foreach ($data['details']['stops'] as $stop) {
    ?>

        <section>
            <div class="dtlv-sec-head hide" data-hide-show-details>
                <div class="dtlv-sec-heading"><?php echo $stop['category']; ?> <span style="font-weight: normal;font-style: italic;font-size: .8em;"><?php echo $stop['location']; ?></span></div>
                <div>
                    <button class="icon angle_down white" data-up-down-button></button>
                </div>
            </div>

            <div class="dtlv-dtl">
                <!-- <div class="dtlv-dtl-action-bar">
                    <button title="Edit" class="icon edit grey" onclick="open_child_window({url:'../user/dispatch/loads/stop-information-update&eid=<?php //echo $stop['eid']; 
                                                                                                                                                    ?>',width:1000,height:500})"></button>
                </div> -->
                <div class="dtlv-dtl-content">
                    <div class="dtlv-attr-val-list" style="max-width: 500px;">
                        <ul>
                            <li>
                                <div>Category</div>
                                <div><?php echo $stop['category']; ?></div>
                            </li>
                            <li>
                                <div>Location</div>
                                <div><?php echo $stop['location']; ?></div>
                            </li>
                            <li>
                                <div>Type</div>
                                <div><?php echo $stop['type']; ?></div>
                            </li>


                        </ul>
                    </div>

                    <div class="dtlv-attr-val-list" style="max-width: 500px;">
                        <ul>
                            <li>
                                <div>Appointment Type</div>
                                <div><?php echo $stop['appointment_type']; ?></div>
                            </li>
                            <li>
                                <div>Date</div>
                                <div><?php echo $stop['date']; ?></div>
                            </li>
                            <li>
                                <div>Time</div>
                                <div><?php
                                        echo $stop['time'];
                                        ?></div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>
    <?php
    }

    ?>

    <section>
        <div class="dtlv-sec-head hide" data-hide-show-details>
            <div class="dtlv-sec-heading">Documents</div>
            <div>
                <button class="icon angle_down white" data-up-down-button></button>
            </div>
        </div>
        <div class="dtlv-dtl">
            <div class="dtlv-dtl-list" style="max-width:1000px;margin: auto;">
                <table>
                    <thead>
                        <tr>
                            <th style="width:15%">#</th>
                            <th style="text-align:left;width: 70%;">Document Name</th>
                            <th style="width:15%">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 15%;">1</td>
                            <td style="text-align:left;width:70%">Rate of Contract (ROC)</td>
                            <td style="width: 15%;"><?php if ($dtl['documents']['roc'] != "") { ?> <i class="ic file" style="color:grey" title="View PO" onclick="open_document('<?php echo  $dtl['documents']['roc'] ?>')"></i> &nbsp
                                    <i class="ic history" style="color:grey" title="View PO" onclick="open_child_window({url:'../user/dispatch/loads/roc-history-list&eid=<?php echo  $dtl['eid'] ?>',width:900,height:500,name:'show-roc-history'})"></i>
                                <?php } else {
                                                        echo "N/a";
                                                    } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- -----------------HTML CODE FOR NOTES FUNCTIONALITY START HERE----------START HERE------------------ -->
    <section>
        <div class="dtlv-sec-head hide" data-hide-show-details>
            <div class="dtlv-sec-heading">NOTES</div>
            <div>
                <button class="icon angle_down white" data-up-down-button></button>
            </div>
        </div>
        <div class="dtlv-dtl">
            <div class="dtlv-dtl-list" style="max-width:100%;margin: 0px 15px;">
                <div style="display: flex;padding: 5px;justify-content: flex-end;"><button data-action="open-add-new-note" class="btn_blue">Add New Note</button></div>
                <div id="addNewNoteSec" style="margin: 10px auto;display: none;">
                    <div style="display: flex;padding: 5px;justify-content: flex-end;"><button data-action="close-add-new-note" class="btn_red">Close</button></div>
                    <form method='POST' id='addNewNoteForm' class='aaf' onsubmit='return add_d_note()'>
                        <input type='hidden' name='load_eid' value="<?php echo $_GET['eid'] ?>">
                        <div class="aaf-a">
                            <textarea name='description' style='min-height:100px;width:100%' placeholder='Write note description here'></textarea>
                        </div>
                        <div class='aaf-b'>
                            <div>
                                <label>High Priority &nbsp<input type="checkbox" name="high_priority"></label>
                            </div>
                            <div>
                                <button class='form-submit-btn' id='saveNote' style="width: 100%;">Save</button>
                            </div>
                        </div>
                        <div>
                        </div>
                    </form>
                </div>
                <div class='table  table-a'>
                    <table data-follow-up-table>
                        <thead>
                            <tr>
                                <th class="notes-th" style='width: 200px;'>Datetime</th>
                                <th class="notes-th" style='text-align: left;'>Description</th>
                                <th class="notes-th" style='width: 200px;'>Added by</th>
                                <th class="notes-th" style='width: 120px;'>High Priority</th>
                                <th class="notes-th"></th>
                            </tr>
                        </thead>
                        <tbody data-follow-ups-list>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
    <!-- -----------------HTML CODE FOR NOTES FUNCTIONALITY END HERE----------END HERE------------------ -->
</section>



<script type="text/javascript">
    $('[data-hide-show-details]').each(function() {

        if ($(this).hasClass('hide')) {
            $(this).siblings('.dtlv-dtl').slideUp(1);
        }
    })
    // $(document.body).on('change', '[name="customer_id_search"]' ,function(){
    $(document.body).on('click', '[data-hide-show-details]', function() {
        if ($(this).hasClass('hide')) {
            $(this).siblings('.dtlv-dtl').slideDown('fast')
            $(this).find('[data-up-down-button]').removeClass('angle_down')
            $(this).find('[data-up-down-button]').addClass('angle_up')
            $(this).removeClass('hide')
        } else {
            $(this).siblings('.dtlv-dtl').slideUp('fast')
            $(this).find('[data-up-down-button]').removeClass('angle_up')
            $(this).find('[data-up-down-button]').addClass('angle_down')

            $(this).addClass('hide')
        }

    })
</script>



<!-- -----------------JAVASCRIPT CODE FOR NOTES FUNCTIONALITY START HERE----------START HERE------------------ -->
<script type='text/javascript'>
    function show_d_notes() {
        $.ajax({
            url: '../user/dispatch/notes/loads/notes-list-ajax',
            type: 'POST',
            data: {
                load_eid: '<?php echo $_GET['eid']; ?>'
            },
            beforeSend: function(data) {
                show_table_data_loading('[data-follow-up-table]')
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    $('[data-follow-ups-list]').html('');
                    if (data.status) {
                        $.each(data.response.list, function(index, item) {
                            var high_priority_class = (item.high_priority == 'YES') ? 'bg-high-priority' : '';
                            var high_priority_checked = (item.high_priority == 'YES') ? 'checked' : '';
                            var row = `<tr class="${high_priority_class}" data-eid="${item.eid}">
                <td style = 'width: 200px;'>${item.added_on_datetime}</td>
                <td style ='text-align: left;'>${item.description}</td>
                <td style = 'width: 200px;'>${item.added_by_user}</td>`
                            if (item.added_by_user_type == 'SELF') {
                                row += `<td style = 'width: 120px;'><input type="checkbox" data-toggle-high-priority-status ${high_priority_checked}></td>
                  <td><i class="ic delete" data-delete-d-note></i></td>`
                            } else {
                                row += `<td></td><td></td>`
                            }
                            row += `</tr>`;
                            $('[data-follow-ups-list]').append(row);
                        })
                    } else {
                        var false_message = `<tr><td colspan = '4'>` + data.message + `<td></tr>`;
                        $('[data-follow-ups-list]').html(false_message);
                    }
                }
            }
        })
    }
    show_d_notes()
</script>
<script type='text/javascript'>
    function add_d_note() {
        var form = document.getElementById('addNewNoteForm');
        var isValidForm = form.checkValidity();
        var currentForm = $('#addNewNoteForm')[0];
        if (isValidForm) {
            var arr = $('#addNewNoteForm').serializeArray();
            var obj = {}
            obj['reference_type_id'] = 'LOAD';
            for (var a = 0; a < arr.length; a++) {
                obj[arr[a].name] = arr[a].value
            }
            obj['high_priority'] = ($('[name="high_priority"]').prop("checked") == true) ? 'YES' : 'NO';
            $.ajax({
                url: '../user/dispatch/notes/add-new-action',
                type: 'POST',
                data: obj,
                success: function(data) {
                    // alert(data)
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                    }
                    if (data.status) {
                        show_d_notes()
                        show_small_notes()
                        $('#addNewNoteForm')[0].reset()
                    } else {
                        alert(data.message);
                    }
                }
            })
        }
        return false
    }
</script>
<script type="text/javascript">
    $(document).on("click", "[data-action='open-add-new-note']", function() {
        $('#addNewNoteSec').slideDown();
        $("[data-action='open-add-new-note']").parent().slideUp()
    })
    $(document).on("click", "[data-action='close-add-new-note']", function() {
        $('#addNewNoteSec').slideUp();
        $("[data-action='open-add-new-note']").parent().slideDown()
    })
</script>
<script type="text/javascript">
    $(document).on("click", "[data-toggle-high-priority-status]", function() {
        var note_eid = $(this).parents('tr').data('eid')
        var high_priority = ($(this).prop("checked")) ? 'YES' : 'NO';
        $.ajax({
            url: "<?php echo AJAXROOT; ?>" + 'user/dispatch/notes/toggle-high-priority-status-action',
            type: 'POST',
            data: {
                note_eid: note_eid,
                high_priority: high_priority
            },
            context: this,
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                }
                if (data.status) {
                    if (high_priority == 'YES') {
                        $(this).parents('tr').addClass('bg-high-priority');
                        show_small_notes()
                    } else {
                        $(this).parents('tr').removeClass('bg-high-priority');
                        show_small_notes()
                    }
                } else {
                    alert(data.message)
                }
            }
        })
    });
    $(document).on("click", "[data-delete-d-note]", function() {
        if (confirm('Do you want to delete note ?')) {
            var note_eid = $(this).parents('tr').data('eid')
            $.ajax({
                url: "<?php echo AJAXROOT; ?>" + 'user/dispatch/notes/delete-action',
                type: 'POST',
                data: {
                    note_eid: note_eid,
                },
                context: this,
                success: function(data) {
                    //console.log(data)
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                    }
                    if (data.status) {
                        show_d_notes()
                        show_small_notes()
                        $(this).parents('tr').slideUp();

                    } else {
                        alert(data.message)
                    }
                }
            })
        }
    });
</script>
<script type='text/javascript'>
    function show_small_notes() {
        $.ajax({
            url: '../user/dispatch/notes/loads/notes-list-ajax',
            type: 'POST',
            data: {
                load_eid: '<?php echo $_GET['eid']; ?>',
                is_high_priority: 'YES',
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    var counter = 1;
                    data = JSON.parse(data)
                    $('[data-high-notes]').html('');
                    if (data.status) {
                        $.each(data.response.list, function(index, item) {
                            var row = `<p style ='text-align: left;font-size:.8em;color:#B00000;margin-bottom:3px;'>${counter}. ${item.description} - ${item.added_by_user}</p>`;
                            $('[data-high-notes]').append(row);
                            counter++;
                        })
                    }
                }
            }
        })
    }
    show_small_notes()
</script>
<!-- -----------------JAVASCRIPT CODE FOR NOTES FUNCTIONALITY END HERE----------END HERE------------------ -->
<script type="text/javascript">
    function sort_table() {
        show_list()
    }
</script>
<br><br><br>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>