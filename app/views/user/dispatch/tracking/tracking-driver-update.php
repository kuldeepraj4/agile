<?php
require_once APPROOT . '/views/includes/user/header-quick-view.php';
if (isset($_GET['driver_display_name']) && $_GET['driver_display_name'] != "") {
    $driver_display_name = $_GET['driver_display_name'];
} else {
    $driver_display_name = "";
}
if (isset($_GET['current_status_id']) && $_GET['current_status_id'] != "") {
    $current_status_id = $_GET['current_status_id'];
} else {
    $current_status_id = "";
}
?>
<section class="lg-form-outer">
    <div class="lg-form-header">Update Status of Driver : <?php echo $driver_display_name; ?></div>
    <form class="lg-form" method="POST" id="MyForm">
        <section class="section-111" style="max-width: 700px">
        <input type="hidden" name="eid" value="<?php echo $_GET['eid']; ?>">  
            <div>
                <fieldset>
                    <legend>Update Status Info</legend>

                    <div style="display:flex;">
                        <div class="field-section single-column" style="width:100%">

                            <div class="field-p" data-status>
                                <label>Status</label>
                                <select data-filter="current_status_id" name="current_status_id"></select>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </section>
        <section class="lg-form-action-button-box">
            <button type="submit" id="button" class="btn_green" onclick="add_new()">SAVE</button>
        </section>
    </form>
</section>






<br><br>



<script type="text/javascript">
    var url_params = get_params();
</script>
<script type="text/javascript">
    function add_new() {
        var obj = {
            eid: $('[name="eid"]').val(),
            current_status_id: $('[name="current_status_id"]').val(),
        }
        $.ajax({
            url: '../user/dispatch/tracking/tracking-driver-update-action',
            type: 'POST',
            data: obj,
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                }
                alert(data.message)
                if (data.status) {
                    window.opener.show_list()
                    window.close();
                }
                hide_processing_modal()
            }
        })

    }
</script>

<script type="text/javascript">
    get_asset_current_status_driver().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
            //Run this if response has list
            if (data.response.list) {
                var options = "";
                options += `<option value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option value="` + item.id + `">` + item.name + `</option>`;
                })
                $('[data-filter="current_status_id"]').html(options);
                if (url_params.hasOwnProperty('current_status_id')) {
                    $("[data-filter='current_status_id'] option[value=" + check_url_params('current_status_id') + "]").prop('selected', true);
                }
            }
        }
    }).catch(function(err) {
        // Run this when promise was rejected via reject()
    })
</script>