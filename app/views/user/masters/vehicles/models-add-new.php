<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<section class="form-a" style="max-width: 600px">
  <div class="form-a-header">ADD NEW VEHICLE MODEL</div>
  <form method="POST" id="MyForm" onsubmit="return add_new()">
    <div>
      <label>Name</label>
      <input type="text" name="name" pattern="[a-zA-Z 0-9-]{1,}" required="required">
    </div>
    <div>
      <label>Vehicle</label>
      <select name="vehicle_id" onchange="show_makers({vehicle_id:this.value})" required="required"></select>
    </div>
    <div>
      <label>Maker</label>
      <select name="maker_id" required="required"></select>
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

            var makers_of = [];
            $.each($("input[name='makers-of']:checked"), function(){
                makers_of.push($(this).val());
            });


    submit_to_wait_btn('#submit','loading')
    $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    var formData=new FormData(currentForm);
    if(isValidForm){
      var arr=$('#MyForm').serializeArray();
      var obj={vehicles_id:makers_of.toString()}
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
          location.href="../user/masters/vehicles/models"
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
function show_vehicles_options(){
 get_vehicles().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
          options=`<option value=""> - - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options+=`<option value="`+item.id+`">`+item.name+`</option>`;              
        })
        $('[name="vehicle_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_vehicles_options()
</script>








<script type="text/javascript">
function show_makers(param){

 get_vehicle_makers(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    // if(data.response.list){
    //       options=`<option value=""> - - Select - -</option>`
    //     $.each(data.response.list, function(index, item) {
    //       options+=`<option value="`+item.id+`">`+item.name+`</option>`;              
    //     })
    //     $('[name="maker_id"]').html(options);    
    // }
    if(data.response.list && param.vehicle_id == 'TRUCK'){
      var options="";
          options+=`<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            if(item.makes.length == 2 && (item.makes[0].id == 'TRUCK' || item.makes[1].id == 'TRUCK')){
              options+=`<option value="`+item.id+`">`+item.name+`</option>`
            }
            if(item.makes.length == 1 && item.makes[0].id == 'TRUCK'){
              options+=`<option value="`+item.id+`">`+item.name+`</option>`;
            }
          });
        $('[name="maker_id"]').html(options);     
    }
    if(data.response.list && param.vehicle_id == 'TRAILER'){
      var options="";
      options+=`<option value="">- - Select - -</option>`;
       $.each(data.response.list, function(index, item) {
          if(item.makes.length == 2 && (item.makes[0].id == 'TRAILER' || item.makes[1].id == 'TRAILER')){
            options+=`<option value="`+item.id+`">`+item.name+`</option>`
          }
          if(item.makes.length == 1 && item.makes[0].id == 'TRAILER'){
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;
          }
        });
        $('[name="maker_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>