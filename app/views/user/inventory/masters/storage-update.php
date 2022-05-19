<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];

// echo '<pre>';
// print_r($details);
// echo '</pre>';


?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - Update Storage</div>
    <form autocomplete="off" class="lg-form" method="POST" id="MyForm" onsubmit="return update()">
        <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
        <section class="section-111">
        </section>
        <section class="section-111" style="max-width: 1200px">
            <div>
                <fieldset>
                    <legend>Update Storage</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Storage Type</label>
                            <select name="type_id_fk" data-default-select="<?php echo $details['type_id_fk'] ?>"  required></select>
                        </div>
                    </div>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Storage Name</label>
                            <input name="storage" type="text" value="<?php echo $details['storage']; ?>" required>
                        </div>
                    </div>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Status</label>
                            <select name="storage_status" id="status" data-filter="status" required data-default-select="<?php echo $details['storage_status']; ?>">
                            <option value="">--Select--</option>
                            <option value="ACTIVE">Active</option>
                            <option value="INACTIVE">Inactive</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
                <br>
                <section class="action-button-box">

                    <button type="submit" class="btn_green">SAVE</button>
                    &nbsp; &nbsp;&nbsp;<button type="button" class="btn_green" onclick="back_alert()">BACK</button>
                </section>
            </div>
        </section>
    </form>
</section>
<script type="text/javascript">
    function update() {
        submit_to_wait_btn('#submit', 'loading')
        $('#formErro').show()
        var form = document.getElementById('MyForm');
        var isValidForm = form.checkValidity();
        //var currentForm = $('#MyForm')[0];
        //var formData=new FormData(currentForm);
        if (isValidForm) {
            var arr = $('#MyForm').serializeArray();
            var obj = {}
            for (var a = 0; a < arr.length; a++) {
                obj[arr[a].name] = arr[a].value
            }
            $.ajax({
                url: window.location.pathname + '-action',
                type: 'POST',
                data: obj,
                success: function(data) {
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                    }
                    alert(data.message);
                    if (data.status) {
                        location.href = "../user/inventory/masters/storage"
                        wait_to_submit_btn('#submit', 'SAVE')
                    } else {
                        wait_to_submit_btn('#submit', 'SAVE')
                    }
                }
            })
        }
        return false
    }
</script>
<script type="text/javascript">
    function show_storage_type() {
        get_storage_types().then(function(data) {
            // Run this when your request was successful
            if (data.status) {

                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if(item.storage_type_status == 'ACTIVE'){
                            options += `<option value="${item.id}">${item.storage_type}</option>`;
                        }
                    })
                    $('[name="type_id_fk"]').html(options);
                    select_default('[name="type_id_fk"]');
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }

    show_storage_type()
</script>
<script type="text/javascript">
    function back_alert() {
        if (confirm('Are you Sure ?')) {
            window.history.back();
        }
    }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>