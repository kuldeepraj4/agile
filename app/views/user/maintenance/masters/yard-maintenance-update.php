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
    <div class="form-a-header">UPDATE - YARD MAINTENANCE MASTER</div>
    <form method="POST" id="MyForm" onsubmit="return update()">
        <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">    

        <div>
            <label>Yard Name</label>
            <input type="text" name="yard_name" id="yard_name" required="required" value="<?php echo $details['yard_name']; ?>" >
        </div>

        <div>
            <label>Yard State</label>
            <select name="yard_state_id"  id="yard_state_id" type="text" data-default-select="<?php echo $details['yard_state_id'] ?>" onchange="show_cities({state_id:this.value})" required data-optional></select>
        </div>
        <div>
            <label>Yard City</label>
            <select name="yard_city_id"  id="yard_city_id" type="text"  data-default-select="<?php echo $details['yard_city_id'] ?>" required data-optional></select>
        </div>

        <div>
          <label>Status</label>
          <select name="status" id="status" data-filter="status" data-default-select="<?php echo $details['status']; ?>">
            <option disabled>--Select--</option>
            <option value="ACTIVE">Active</option>
            <option value="INACTIVE">Inactive</option>
          </select>
        </div>  

        <div>
            <button class="form-submit-btn" id="submit">UPDATE</button>
       </div>
       <div style="text-align:center;"><button type="button" class="form-submit-btn" onclick="back_alret()">BACK</button></div>
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
                location.href="../user/maintenance/masters/yard-maintenance";
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
  get_states().then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="` + item.id + `">` + item.name + `</option>`;
        })
        $('[name="yard_state_id"]').html(options);
        select_default('[name="yard_state_id"]')
        show_cities({
          state_id: '<?php echo $details['yard_state_id']; ?>'
        });
      }
    }

  })
</script>

<script type="text/javascript">
  function show_cities(param) {
    if (param.yard_state_id === '') {
      $('[name="yard_city_id"]').html('');
    } else if (param.yard_state_id !== '') {
      get_cities(param).then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options += `<option value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options += `<option value="` + item.id + `">` + item.name + `</option>`;
            })
            $('[name="yard_city_id"]').html(options);
            select_default('[name="yard_city_id"]');
          }
        } else {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $('[name="yard_city_id"]').html(options);
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    }
  }
</script>
<script>
  function back_alret(){
    if(confirm('Are you Sure ?')){
      window.history.back();
    }
  }
</script>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>