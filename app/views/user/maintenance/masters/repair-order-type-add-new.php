<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<section class="form-a" style="max-width: 600px">
    <div class="form-a-header">ADD NEW - REPAIR ORDER TYPE</div>
    <form method="POST" id="MyForm" onsubmit="return add_new()">
        <div>
          <label>Type Name</label>
          <input type="text" name="name" pattern="[a-zA-Z ]{3,}" required="required">
      </div>
      <div>
            <label>Class ID</label>
            <select name="class_id" required="required" id="class_id"></select>
        </div>
      <div>
        <button class="form-submit-btn" id="submit">SAVE</button>
    </div>
    <div style="text-align:center;"><button type="button" class="form-submit-btn" onclick="window.history.back()">BACK</button></div>
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
           // console.log(obj)
            $.ajax(
            {
                url:window.location.href+'-action',
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
                    location.href='../user/maintenance/masters/repair-order-type';
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
<script type="text/javascript">
  function show_repair_order_class_list(){
  get_repair_order_class_list().then(function(data) {
    console.log(data)
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
    })
      $('#class_id').html(options);     
  }
}
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_repair_order_class_list()
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>