<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details'];
/*
echo "<pre>";
print_r($details);
echo "</pre>"; 
*/
?>

<br><br>

<section class="form-a" style="max-width: 600px">
    <div class="form-a-header">UPDATE - PREVENTIVE MAINTENANCE MASTER</div>
    <form method="POST" id="MyForm" onsubmit="return update()">
        <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">      
        <div>
            <label>PM Name</label>
            <select name="job_work_id"  data-msg="1" data-default-select="<?php echo $details['job_work_id'] ?>" required="required"></select>
        </div>
        <div>
            <label>Mode</label>
            <select name="mode" data-msg="2" data-default-select="<?php echo $details['mode'] ?>" required="required">
              <option value="">- - Select - -</option>
              <option value="DAYS">Days</option>
              <option value="MILES">Miles</option>
              <option value="HOUSRS">Hours</option>
            </select>
        </div>
        <div>
            <label>Value</label>
            <input type="text" name="value" data-msg="3" required="required" value="<?php echo $details['value']; ?>" >
        </div>
        <div>
            <label>Advance Alert (Miles/Hours/Days)</label>
            <input type="text" data-msg="4" name="advance_alert" required="required" value="<?php echo $details['advance_alert']; ?>">
        </div>
        <div>
            <label>Available For Equipment Categories</label>
            <select name="vehicle_type_id" data-msg="5" required="required" data-default-select="<?php echo $details['vehicle_type_id'] ?>"></select>
        </div>
        <div>
            <button class="form-submit-btn" id="submit">UPDATE</button>
       </div>
       <div style="text-align:center;"><button type="button" class="form-submit-btn" onclick="window.history.back()">BACK</button></div>
</form>
</section>

<script type="text/javascript">
    function update()
    {
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
                    location.href="../user/maintenance/masters/preventive-maintenance";
                    wait_to_submit_btn('#submit','UPDATE')
                }else{
                    wait_to_submit_btn('#submit','UPDATE')
                    $('[data-msg='+data.flagformessage+']').focus();
                }
            }
        })
        }
        return false
    }
</script>
<script type="text/javascript">
   get_quick_job_work().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="job_work_id"]').html(options);
      select_default('[name="job_work_id"]')     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 

</script>
<script type="text/javascript">
  function show_unittype_filter(){
   get_vehicles().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="vehicle_type_id"]').html(options);
      select_default('[name="vehicle_type_id"]')     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_unittype_filter()
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>