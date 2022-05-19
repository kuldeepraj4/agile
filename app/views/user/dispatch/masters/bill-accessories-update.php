<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details'];
?>
<br><br>
        <section class="form-a" style="max-width: 600px">
            <div class="form-a-header">UPDATE BILL ACCESSORY</div>
            <form method="POST" id="MyForm" onsubmit="return add_new()">
                <input type="hidden" name="update_eid" value="<?php echo $details['eid']; ?>">
                <div>
                    <label>Name</label>
                    <input type="text" name="name" pattern="[a-zA-Z ]{3,}" required="required" value="<?php echo $details['name']; ?>">
                </div>
                <div>
                    <button class="form-submit-btn" id="submit">SAVE</button>
                </div>
            </form>
         </section>
<script type="text/javascript">
    function add_new(){
        show_processing_modal()
        submit_to_wait_btn('#submit','loading')
                $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    if(isValidForm){
    var arr=$('#MyForm').serializeArray();
    var obj={}
    for(var a=0;a<arr.length;a++ ){
        obj[arr[a].name]=arr[a].value
    }
    $.ajax({

        url:'../user/dispatch/masters/bill-accessories/update-action',
        type:'POST',
        data: obj,
        success:function(data){
               if((typeof data)=='string'){
               data=JSON.parse(data) 
               }
               alert(data.message);
               if(data.status){
                window.history.back()
                wait_to_submit_btn('#submit','SAVE')
               }else{
                wait_to_submit_btn('#submit','SAVE')
               }
               hide_processing_modal()
        }
    })
}
return false
    }
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>