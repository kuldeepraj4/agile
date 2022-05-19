<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details']; 
?>
<br><br>
<section class="form-a" style="max-width: 600px">
    <div class="form-a-header">UPDATE- REPAIR ORDER RFC REASON</div>
    <form method="POST" id="MyForm" onsubmit="return update()">
        <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
        <div>
          <label>Name</label>
          <input type="text" name="name"  required="required" value="<?php echo $details['name'] ?>">
      </div>
      <div>
      <select name="status_id" id="status" data-filter="status" data-default-select="<?php echo $details['status_id']; ?>" required>
          <option disabled>--Select--</option>
          <option value="1">Active</option>
          <option value="3">Inactive</option>
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
           // console.log(obj)
            $.ajax(
            {
                url:window.location.pathname+'-action',
                type:'POST',
                data: obj,
                success:function(data)
                {
                //    // alert(data)
                  //  console.log(data)
                 if((typeof data)=='string')
                 {
                     data=JSON.parse(data) 
                 }
                 alert(data.message);
                 if(data.status)
                {
                    window.history.back();
                    wait_to_submit_btn('#submit','SAVE')
                }
                else
                {
                    wait_to_submit_btn('#submit','SAVE')
                }
            }
        }
        )
        }
        return false
    }
</script>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>