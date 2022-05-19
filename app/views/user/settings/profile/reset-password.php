<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
        <section class="form-a" style="max-width: 600px">
            <div class="form-a-header">Reset Password</div>
            <form method="POST" id="MyForm" onsubmit="return update()">
                <div>
                </div>
                <div>
                 <label>New Password <br><span style="color: grey">( Min three alphanumeric characters.  _@& can be used as special characters.)</span></label>
                    <input type="text" name="new_password" pattern="[a-zA-Z0-9_@&]{3,}" required="required">
                </div>
                <div>
                    <button class="form-submit-btn" id="submit">SAVE</button>
                </div>
            </form>
         </section>
<script type="text/javascript">
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
        url:window.location.href+'-action',
        type:'POST',
        data: obj,
        success:function(data){
               if((typeof data)=='string'){
               data=JSON.parse(data) 
               }
               alert(data.message);
               if(data.status){
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