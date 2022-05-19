<?php
require_once APPROOT . '/views/includes/user/header-quick-view.php';
if (isset($_GET['cross_dock_status']) && $_GET['cross_dock_status'] != "") {
    $cross_dock_status = $_GET['cross_dock_status'];
} else {
    $cross_dock_status = "";
}
if (isset($_GET['remarks']) && $_GET['remarks'] != "") {
    $remarks = $_GET['remarks'];
} else {
    $remarks = "";
}
?>
<br><br><br>
<br>
<section class="lg-form-outer">
    <div class="lg-form-header">Cross Dock Info Update</div>
    <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
        <section class="section-111" style="max-width: 600px">
            <input type="hidden" name="dispatch_stop_eid" value="<?php echo $_GET['eid']; ?>">
            <div>
                <fieldset>
                    <legend></legend>

                    <div style="display:flex;">
                        <div class="field-section single-column" style="width:100%">

                            <div class="field-p">
                                <label>Cross Dock Status</label>
                                <select name="cross_dock_status" data-default-select="<?php echo $cross_dock_status; ?>">
                                    <option value="">- - Select - -</option>
                                    <option value="PENDING">Pending</option>
                                    <option value="MOVED">Moved</option>
                                    <option value="UNLOADED">Unloaded</option>
                                </select>
                            </div>
                            <div class="field-p">
                                <label>Remarks</label>
                                <textarea name="remarks" placeholder="Write remarks here" style="height:110px"><?php echo $remarks; ?></textarea>
                            </div>

                        </div>
                    </div>
                </fieldset>
            </div>
        </section>
        <section class="action-button-box">
            <button type="submit" class="btn_green">SAVE</button>
        </section>
    </form>
</section>

<script type="text/javascript">
    function save() {

        submit_to_wait_btn('#submit', 'loading')
        $('#formErro').show()
        var form = document.getElementById('MyForm');
        var isValidForm = form.checkValidity();
        var currentForm = $('#MyForm')[0];
        var formData = new FormData(currentForm);
        if (isValidForm) {
            var arr = $('#MyForm').serializeArray();
            var obj = {}
            for (var a = 0; a < arr.length; a++) {
                obj[arr[a].name] = arr[a].value
            }
            $.ajax({
                url: '../user/dispatch/cross-docks-info-update-action',
                type: 'POST',
                data: obj,
                success: function(data) {
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                    }
                    if (data.status) {
                        alert(data.message);
                        if (window.opener && (typeof window.opener.show_list != 'undefined')) {
                            window.opener.show_list();
                        }
                        window.close()
                        wait_to_submit_btn('#submit', 'SAVE')
                    } else {
                        alert(data.message);
                        wait_to_submit_btn('#submit', 'SAVE')
                    }
                }
            })
        }
        return false
    }
</script>
<script type="text/javascript">
    quick_list_users().then(function(data) {
        // Run this when your request was successful

        if (data.status) {



            //Run this if response has list

            if (data.response.list) {

                var options = "";

                options += `<option value="">- - Select - -</option>`

                $.each(data.response.list, function(index, item) {

                    options += `<option value="${item.id}">${item.name}</option>`;

                })

                $('[name="booked_by_id"]').html(options);
                select_default('[name="booked_by_id"]')

            }

        }

    })
</script>

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>