<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];

// echo '<pre>';
// print_r($details);
// echo '</pre>';

?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - Update Model</div>
    <form autocomplete="off" class="lg-form" method="POST" id="MyForm" onsubmit="return update()">
        <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
        <section class="section-111">
        </section>
        <section class="section-111" style="max-width: 1200px">
            <div>
                <fieldset>
                    <legend>Update Model</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Product Type</label>
                            <select name="type_id_fk" data-default-select="<?php echo $details['type_id_fk'] ?>" required></select>
                        </div>
                    </div>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Product Name</label>
                            <select name="product_id_fk" id="makes" type="text" data-default-select="<?php echo $details['product_id_fk'] ?>" required></select>
                        </div>
                    </div>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Maker/ Brand</label>
                            <select name="maker_id_fk" data-default-select="<?php echo $details['maker_id_fk'] ?>" required></select>
                        </div>
                    </div>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Model</label>
                            <input name="model" type="text" value="<?php echo $details['model'] ?>" required>
                        </div>
                    </div>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Status</label>
                            <select name="model_status" id="status" data-filter="status" required data-default-select="<?php echo $details['model_status']; ?>">
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
                        location.href = "../user/inventory/masters/product-model"
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
    function show_product_type() {
        get_product_type().then(function(data) {
            // Run this when your request was successful
            if (data.status) {

                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if(item.product_type_status == 'ACTIVE'){
                            options += `<option value="${item.id}">${item.product_type}</option>`;
                        }
                    })
                    $('[name="type_id_fk"]').html(options);
                    select_default('[name="type_id_fk"]')
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }

    show_product_type()
</script>
<script type="text/javascript">
    $(document.body).on('change', '[name="type_id_fk"]', function() {
        $('[name="product_id_fk"]').html('');
        $('[name="maker_id_fk"]').html('');
        $('[name="model"]').val('');
       
        var id = $(this).val();
        if (id != '') {
            show_type_products(id);
        }

    });
    function show_type_products(id)
    {
        get_product_names({
                type_id_fk: id
            }).then(function(data) {
                // Run this when your request was successful
                if (data.status) {

                    //Run this if response has list
                    if (data.response.list) {
                        var options = "";
                        options += `<option value="">- - Select - -</option>`
                        $.each(data.response.list, function(index, item) {
                            if(item.product_status == 'ACTIVE'){
                                options += `<option value="${item.id}">${item.product}</option>`;
                            }
                        })
                        $('[name="product_id_fk"]').html(options);
                        select_default('[name="product_id_fk"]')
                        show_makers(<?php echo $details['product_id_fk'] ?>);
                    }
                }
            }).catch(function(err) {
                // Run this when promise was rejected via reject()
            })
    }
    show_type_products(<?php echo $details['type_id_fk'] ?>)
</script>
<script type="text/javascript">

$(document.body).on('change', '[name="product_id_fk"]', function() {
        $('[name="maker_id_fk"]').html('');
        $('[name="model"]').val('');
       
        var id = $(this).val();
        if (id != '') {
            show_makers(id);
        }

    });

    function show_makers(id) {
        get_product_makers({
            product_id_fk: id
        }).then(function(data) {
            // Run this when your request was successful
            if (data.status) {

                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if(item.maker_status == 'ACTIVE'){
                            options += `<option value="${item.id}">${item.maker}</option>`;
                        }
                    })
                    $('[name="maker_id_fk"]').html(options);
                    select_default('[name="maker_id_fk"]')
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }

    show_makers(<?php echo $details['product_id_fk'] ?>);
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