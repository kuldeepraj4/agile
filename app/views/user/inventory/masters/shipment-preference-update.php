<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details']; 

// echo '<pre>';
// print_r($details);
// echo '</pre>';


?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - Update Shipment Preference</div>
    <form autocomplete="off" class="lg-form" method="POST" id="MyForm" onsubmit="return update()">
        <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
        <section class="section-111">
        </section>
        <section class="section-111" style="max-width: 1200px">
            <div>
                <fieldset>
                    <legend>Update Shipment Preference</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Shipment Preference</label>
                            <input name="shipment_preference" type="text" value="<?php echo $details['shipment_preference']; ?>" required>
                        </div>
                        <div class="field-p">
                            <label>Status</label>
                            <select name="shipment_preference_status" id="status" data-filter="status" required data-default-select="<?php echo $details['shipment_preference_status']; ?>">
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
    function update(){
        submit_to_wait_btn('#submit','loading')
        $('#formErro').show()
        var form = document.getElementById('MyForm');
        var isValidForm = form.checkValidity();
        //var currentForm = $('#MyForm')[0];
        //var formData=new FormData(currentForm);
        if(isValidForm){
            var arr=$('#MyForm').serializeArray();
            var obj={}
            for(var a=0;a<arr.length;a++ ){
                obj[arr[a].name]=arr[a].value
            }
            $.ajax({
                url:window.location.pathname+'-action',
                type:'POST',
                data: obj,
                success:function(data){
                 if((typeof data)=='string'){
                     data=JSON.parse(data) 
                 }
                 alert(data.message);
                 if(data.status){
                    location.href="../user/inventory/masters/shipment-preference"
                    wait_to_submit_btn('#submit','SAVE')
                }else{
                    wait_to_submit_btn('#submit','SAVE')
                }
            }
        })
        }
        return false
    }
</script>
<script type="text/javascript">
    function back_alert() {
        if (confirm('Are you Sure ?')) {
            window.history.back();
        }
    }
</script>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>