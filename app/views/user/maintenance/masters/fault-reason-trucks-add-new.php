<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<section class="form-a" style="max-width: 600px">
    <div class="form-a-header">ADD NEW - Fault Reason Truck's</div>
    <form method="POST" id="MyForm" onsubmit="return add_new()">
        <div>
            <label>Fault Reason Name</label>
            <input type="text" name="name" pattern="[a-zA-Z ]{1,}" required="required">
        </div>
        <div>
            <button class="form-submit-btn" id="submit">Save</button>
        </div>
        <div style="text-align:center;"><button type="button" class="form-submit-btn" onclick="window.history.back()">BACK</button></div>
    </form>
</section>
<script type="text/javascript">
    function add_new(){
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
                    console.log(data)
                    if((typeof data)=='string'){
                     data=JSON.parse(data) 
                 }
                 alert(data.message);
                 if(data.status){
                    location.href="../user/maintenance/masters/fault-reason-trucks"
                    wait_to_submit_btn('#submit','ADD')
                }else{
                    wait_to_submit_btn('#submit','ADD')
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