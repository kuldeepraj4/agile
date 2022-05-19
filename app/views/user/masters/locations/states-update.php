<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details'];
?>
<br><br>
<section class="form-a" style="max-width: 600px">
  <div class="form-a-header">UPDATE STATE</div>
  <form method="POST" id="MyForm" onsubmit="return update()">
    <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
    <div>
      <label>Country</label>
      <select name="country_id" data-default-select="<?php echo $details['country_id']; ?>" required="required" id="country_id" ></select>
    </div>
    <div>
      <label>Region</label>
      <select name="region_id" data-default-select="<?php echo $details['region_id']; ?>" ></select>
    </div> 
    <div>
      <label>State Name</label>
      <input type="text" name="name" pattern="[a-zA-Z ]{3,}" required="required" value="<?php echo $details['name']; ?>">
    </div>
    <div>
      <label>Mini code</label>
      <input type="text" name="mini_code" pattern="[a-zA-Z ]{2,}" value="<?php echo $details['mini_code']; ?>">
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
          location.href='../user/masters/locations/states';
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
  function show_contries(){


   get_countries().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option>- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('#country_id').html(options);
      select_default($('#country_id'))
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}

show_contries()

</script>

<script type="text/javascript">
 get_location_regions().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name=region_id]').html(options);
      select_default($('[name="region_id"]'))     
    }
  }
})
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>