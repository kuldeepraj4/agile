<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];

?>
<br><br>
<section class="form-a" style="max-width: 600px">
    <div class="form-a-header">UPDATE - CLAIM TYPE</div>
    <form method="POST" id="MyForm" onsubmit="return update()">
        <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
        <div>
            <label>Claim Type Name</label>
            <input type="text" name="name" required="required" value="<?php echo $details[
                'name'
            ]; ?>">
        </div><br>
        <div class="filter-item">
        <label>Status</label>
        <select name="status" id="status" data-filter="status" data-default-select="<?php echo $details['status']; ?>">
          <option disabled>--Select--</option>
          <option value="ACTIVE">Active</option>
          <option value="INACTIVE">Inactive</option>
        </select>
      </div>  
        <div>
            <button class="form-submit-btn" id="submit">SAVE</button>
        </div>
        <div style="text-align:center;"><button type="button" class="form-submit-btn" onclick="window.history.back()">BACK</button></div>
    </form>
</section>

<script type="text/javascript">
    function update(){
        submit_to_wait_btn('#submit','loading')
        $('#formErro').show()
        var form = document.getElementById('MyForm');
//         let $select = $form.find('#status');
//         if($select.val() === ''){
//     $select.attr('disabled', 'disabled');
//   }
        var isValidForm = form.checkValidity();
        var currentForm = $('#MyForm')[0];
        var formData=new FormData(currentForm);
        if(isValidForm){
            var arr=$('#MyForm').serializeArray();
            var obj={}
            for(var a=0;a<arr.length;a++ ){
                obj[arr[a].name]=arr[a].value
            }
            console.log(obj)
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
                    location.href="../user/maintenance/masters/claim-type"
                    wait_to_submit_btn('#submit','Save')
                }else{
                    wait_to_submit_btn('#submit','Save')
                }
            }
        })
        }
        return false
    }
</script>
<?php require_once APPROOT . '/views/includes/user/footer.php';
?>
