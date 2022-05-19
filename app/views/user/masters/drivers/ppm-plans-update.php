<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details'];
?>
<br><br>
        <section class="form-a" style="max-width: 600px">
            <div class="form-a-header">UPDATE PPM PLAN</div>
            <form method="POST" id="MyForm" onsubmit="return update()">
                  <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
                <div>
                    <label>Group Type</label>
                    <select name="driver_group_id" required="required"></select>
                </div>
                <div>
                  <label>Plan Name</label>
                    <input type="text" name="name" pattern="[a-zA-Z  0-9]{3,}" required="required" value="<?php echo $details['name'] ?>">
                </div>
                 <div>
                  <label>Pay Per Mile</label>
                   <input type="text" name="pay_per_mile" pattern="[0-9.-]{1,}" required="required" value="<?php echo $details['pay_per_mile'] ?>">
                </div>
                 <div>
                  <label>Incentive Per Mile</label>
                   <input type="text" name="incentive_per_mile" pattern="[0-9.-]{1,}" required="required" value="<?php echo $details['incentive_per_mile'] ?>">
                </div>                
                <div>
                    <button class="form-submit-btn" id="submit">SAVE</button>
                     <button type="button" class="form-submit-btn" style="margin-top:10px" onclick="back_alert()">BACK</button>
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

        url:window.location.pathname+'-action',
        type:'POST',
        data: obj,
        success:function(data){
               if((typeof data)=='string'){
               data=JSON.parse(data) 
               }
               alert(data.message);
               if(data.status){
                location.href='../user/masters/drivers/ppm-plans';
                wait_to_submit_btn('#submit','SAVE')
               }else{
                wait_to_submit_btn('#submit','SAVE')
               }
        }
    })
}
return false
    }



      function back_alert() {
    if (confirm('Are you Sure ?')) {
      window.history.back();
    }
  }
</script>
<script type="text/javascript">
function show_countries(){
 get_driver_groups().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('[name="driver_group_id"]').html(options); 
        $('[name="driver_group_id"] option[value="<?php echo $details['driver_group_id']; ?>"]').prop('selected',true);      
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_countries()
</script>



<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>