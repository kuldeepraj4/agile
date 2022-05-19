<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>


        <section class="form-a" style="max-width: 600px">
            <div class="form-a-header">UPDATE PASSWORD</div>
            <form method="POST" id="MyForm" onsubmit="return add_new()">
              <input type="hidden" name="update_eid" value="<?php echo $_GET['eid']; ?>">
        <div>
          <label>Password</label>
          <input type="text" name="password" pattern="[a-zA-Z0-9]{3,}" ></select>
        </div>
                <div>
                    <button class="form-submit-btn" id="submit">SAVE</button>
                </div>
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
        url:window.location.pathname+'-action',
        type:'POST',
        data: obj,
        success:function(data){
          // alert(data)
               if((typeof data)=='string'){
               data=JSON.parse(data) 
               }
               alert(data.message);
               if(data.status){
                location.href='../user/masters/users';
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
function show_employee_status(){
 get_employees_status().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    console.log(data)
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('[name="status_id"]').html(options);
        $('[name="status_id"] option[value="<?php echo $details['status_id']; ?>"]').prop('selected',true);

    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_employee_status()
</script>

<script type="text/javascript">
function show_mobile_country_code(){
 get_mobile_country_codes().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('[name="mobile_country_code_id"]').html(options);
        $('[name="mobile_country_code_id"] option[value="<?php echo $details['mobile_country_code_id']; ?>"]').prop('selected',true);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_mobile_country_code()
</script>


<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>