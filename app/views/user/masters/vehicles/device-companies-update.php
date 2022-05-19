<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details'];
?>
<br><br>
        <section class="form-a" style="max-width: 600px">
            <div class="form-a-header">UPDATE DEVICE COMPANY</div>
            <form method="POST" id="MyForm" onsubmit="return update()">
                      <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
                <div>
                    <label>Name</label>
                    <input type="text" name="name" pattern="[a-zA-Z ]{3,}" required="required" value="<?php echo $details['name'] ?>">
                </div>
                <div>
                    <button class="form-submit-btn" id="submit">SAVE</button>
                    <button type="button" class="form-submit-btn" onclick="back_alert()" style="margin-top: 10px;">BACK</button>
                </div>
            </form>
         </section>
<script type="text/javascript">

function back_alert() {
        if (confirm('Are you Sure ?')) {
        window.history.back();
        }
    }
    
    function update(){
        submit_to_wait_btn('#submit','loading')
                $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    var formData=new FormData(currentForm);
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
                location.href="../user/masters/vehicles/device-companies"
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

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>