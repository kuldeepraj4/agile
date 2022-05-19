<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<section class="form-a" style="max-width: 600px">
  <div class="form-a-header">ADD NEW EARNING/DEDUCTION</div>
  <form method="POST" id="MyForm" onsubmit="return add_new()">
    <input type="hidden" name="driver_eid" value="<?php echo $_GET['eid']; ?>">
    <div>
      <label>Parameter Type</label>
      <select name="parameter_id" required="required"></select>
    </div>
    <div>
      <label>Amount</label>
      <input type="text" name="amount" pattern="[0-9.]{1,}" required="required">
    </div>
    <div class="field-p">
      <label>Remarks</label>
      <textarea name="remarks" style="height: 80px;"></textarea>
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
         // console.log(data)
          if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         alert(data.message);
         if(data.status){
          //location.reload();
          window.history.back();
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
<script type="text/javascript">
  function show_salary_parameters(){
   get_salary_parameters().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="parameter_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_salary_parameters()
</script>



<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>