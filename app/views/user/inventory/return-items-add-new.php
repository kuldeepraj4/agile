<?php
require_once APPROOT . '/views/includes/user/header.php';
$details=$data['details']; 

// echo '<pre>';
//  print_r($details);
// echo '</pre>';
// exit;
?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - Issue Item</div>
    <form autocomplete="off" class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
        <section class="section-111">
        </section>
        <section class="section-111" style="max-width: 1200px">
            <div>
                <fieldset>
                    <legend>Issue Item</legend>
                    <div class="field-section single-column">
                        <input type="hidden" name="issued_id_fk" value="<?php echo $details['id'] ?>">
                        <div class="field-p">
                            <label>Location</label>
                            <input type="text" disabled value="<?php echo $details['location'] ?>">
                        </div>
                        <div class="field-p">
                            <label>Item </label>
                            <input type="text" disabled value="<?php echo $details['item_name'] ?>">
                        </div>
                        <div class="field-p">
                            <label>Issued ID</label>
                            <input name="issued_number" type="text" disabled value="<?php echo $details['issued_number'] ?>">
                        </div>
                        <div class="field-p">
                            <label>Issued Quantity</label>
                            <input type="text" disabled value="<?php echo $details['issued_quantity'] ?>">
                        </div>
                        <div class="field-p">
                            <label>Maximum Return Allowed</label>
                            <input type="text" disabled value="<?php echo ($details['issued_quantity']-$details['returned_so_far']) ?>">
                        </div>
                        <div class="field-p">
                            <label>Return</label>
                            <input required name="returned_quantity" min="<?php echo (($details['issued_quantity']-$details['returned_so_far'])>0)? '1': '0' ?>" max="<?php echo ($details['issued_quantity']-$details['returned_so_far']) ?>" type="number">
                        </div>
                        <div class="field-p">
                            <label>Returned To</label>
                            <input required name="returned_to" type="text">
                        </div>
                        
                        <div class="field-p">
                            <label>Returned By</label>
                            <input required name="returned_by" type="text">
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
    function save() {
        if($('[name="returned_quantity"]').val() < 1){
            alert('Quantity must be greater than 0');
            return;
        }
        //show_processing_modal()
        //submit_to_wait_btn('#submit', 'loading')
        $('#formErro').show()
        var form = document.getElementById('MyForm');
        var isValidForm = form.checkValidity();
        //var currentForm = $('#MyForm')[0];
        // var formData = new FormData(currentForm);
        if (isValidForm) {
            var arr = $('#MyForm').serializeArray();
            
            var form_data = new FormData();

            var obj = {
                issued_id_fk: $('[name="issued_id_fk"]').val(),
                returned_to: $('[name="returned_to"]').val(),
                returned_by: $('[name="returned_by"]').val(),
                returned_quantity: $('[name="returned_quantity"]').val(),
                item_location_id_fk: '<?php echo $details['item_location_id_fk'] ?>'
                
            }
            console.log(obj)
            // alert("data logged in console")
            for (var key in obj) {
                form_data.append(key, obj[key]);
            }
            form_data.append(key, obj[key]);
            $.ajax({
                url: window.location.pathname + '-action',
                type: 'POST',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                    }
                    alert(data.message);
                    if (data.status) {
                        window.history.back();
                        wait_to_submit_btn('#submit', 'ADD')
                        hide_processing_modal()
                    } else {
                        hide_processing_modal()
                        wait_to_submit_btn('#submit', 'ADD')
                    }
                }
            })
        }
        return false
    }
</script>

<script>
    
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