<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<?php $details=$data['details']; ?>
<section class="form-a" style="max-width: 600px">
  <div class="form-a-header">UPDATE VEHICLE MAKER</div>
  <form method="POST" id="MyForm" onsubmit="return update()">
    <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
    <div>
      <label>Maker Name</label>
      <input type="text" name="name" pattern="[a-zA-Z ]{3,}" required="required" value="<?php echo $details['name'] ?>">
    </div>
    <div>
      <label>Makes</label>
      <div class="radio-check-box" data-makers-of="">
      </div>
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

    var makers_of = [];
    $.each($("input[name='makers-of']:checked"), function(){
        makers_of.push($(this).val());
    });

    if(!makers_of.length){
      alert('Please select atleast one item !!!');
      return;
    }

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
        url:window.location.pathname+'-action',
        type:'POST',
        data: obj,
        success:function(data){
         if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         alert(data.message);
         if(data.status){
          location.href='../user/masters/vehicles/makers'
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
          options=``
        $.each(data.response.list, function(index, item) {
          options+=`<div class="radio-check-box-item"><input name="makers-of" type="checkbox" value="`+item.id+`">`+item.name+`</div>`;              
        })
        $('[data-makers-of=""]').html(options);
          var makes=JSON.parse('<?php echo json_encode($details['makes']) ?>')
          $.each(makes, function(index, item) {  
           $('input:checkbox[name="makers-of"][value="'+item.id+'"]').prop('checked',true);   
        })     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_vehicles_options()
</script>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>