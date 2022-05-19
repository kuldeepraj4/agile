<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<section class="form-a" style="max-width: 600px">
    <div class="form-a-header">ADD NEW CITY</div>
    <form method="POST" id="MyForm" onsubmit="return add_new()">
        <div>
            <label>State</label>
            <select name="state_id" required="required"></select>
        </div>
        <div>
            <label>Zone (optional)</label>
            <select name="zone_id"></select>
        </div>                
        <div>
          <label>City Name</label>
          <input type="text" name="name" pattern="[a-zA-Z ]{3,}" required="required">
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
                 if((typeof data)=='string'){
                     data=JSON.parse(data) 
                 }
                 alert(data.message);
                 if(data.status){
                    location.href='../user/masters/locations/cities';
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
    function show_states(){
       get_states().then(function(data) {
  // Run this when your request was successful
  if(data.status){

    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="${item.id}">${item.name} ${item.country}</option>`;               
    })
      $('[name="state_id"]').html(options);     
  }
}
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}

show_states()




$(document.body).on('change', '[name="state_id"]' ,function(){

    $('[name="zone_id"]').attr('disabled',true).val('0');
    if($(this).val()!=''){
       get_location_zones_quick_list({state_id:$(this).val()}).then(function(data) {
  // Run this when your request was successful
  if(data.status){

    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="${item.id}">${item.name}</option>`;               
    })
      $('[name="zone_id"]').html(options).removeAttr('disabled');     
  }
}
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
});
</script>



<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>