<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details'];
$filename = $details['file_upload_url'];
?>
<br><br>
<style type="text/css">
  .search-checkboxes-conatiner{
    display: flex;
    justify-content: space-between;

  }
  .search-checkboxes{
    border:1px solid #f2f2f2;
    margin:20px 0;
    width: 45%;
    padding-bottom:8px;

  }
  .search-checkboxes .search-checkboxes-search{
    width: 100%;
  }
  .search-checkboxes .search-checkboxes-result-container{
    margin:10px 0;
    max-height: 300px;
    overflow-y: auto;
    padding: 5px 
  }
  .search-checkboxes .search-checkboxes-result-container li{
    margin-bottom: 5px;
  }     
</style>
<section class="content-box" style="max-width: 700px;margin:auto;">
  <h2 style="text-align: center;">Update Ticket <?php echo $details['id']; ?></h2>
  <form method="POST" id="MyForm" onsubmit="return save()">
    <input type="hidden" name="update_eid" value="<?php echo $details['eid']; ?>">

    <div>
      <label>Ticket</label>
      <textarea name="ticket_text" style="width:100%;min-height: 100px" required="required"><?php echo $details['text']; ?></textarea>
    </div>
    <br>
    <div style="display: flex;justify-content: space-between;align-items: center;">

      <div style="width: 45%;" class="form-field direction-column">
        <label>Due Date Time</label>
        <div style="display: flex;">
         <input type="text" name="ticket_due_date" style="width: 45%;flex-grow: 1" data-date-picker="" placeholder="mm/dd/yyyy" value="<?php echo $details['due_date']; ?>">  &nbsp
        <input type="text" name="ticket_due_time" style="width: 45%;flex-grow: 1" data-time-picker="" placeholder="hh:mm" value="<?php echo $details['due_time']; ?>"> 
        </div> 
        
      </div>



      <div style="width:45%" class="form-field direction-column">
        <label>Priority <?php echo $details['priority_id'] ?></label> 
        <select name="priority_id" data-default-select="<?php echo $details['priority_id'] ?>" required="required" class="width-100-p"></select>
      </div>      

    </div>
    <br>

    <div style="display: flex;justify-content: space-between;align-items: center;">
        <div style="width: 45%;" class="form-field direction-column">
          <label>Notification</label>
          <div style="display: flex;">
              <?php  if($details['notification'] == '1') {?>
                <label><input type = "radio" name = "notification" id ="yes" value="1" checked>Yes</label>  
                <label><input type = "radio" name = "notification" id ="no" value="0">No</label> 
              <?php  } else { ?>
                  <label><input type = "radio" name = "notification" id ="yes" value="1">Yes</label>
                  <label><input type = "radio" name = "notification" id ="no" value="0" checked>No</label> 
              <?php  } ?>
          </div> 
        </div>
        <div style="width:45%" class="form-field direction-column">
           <label>View Document</label> 
           <td style="white-space:nowrap">
           <?php
          if ($filename) {
          ?>
            <button class='btn_grey_c' type="button" onclick="open_document('<?php echo $details['file_upload_url'] ?>')"><i class='fa fa-file'></i></button>
          <?php
          } else {
            echo "No File Exist";
          }
          ?>
            </td>
            <div style="width:45%" class="form-field direction-column">
              <label>Upload Document</label> 
              <input type="file" id="file" name="document">
            </div>
        </div>      
    </div>
    </br>


    <div class="search-checkboxes-conatiner">
      <div class="search-checkboxes">
        <input data-level-search class="search-checkboxes-search" placeholder="Search levels" type="text"  onkeyup="show_levels_result(this.value)">
        <ul data-level-search-results class="search-checkboxes-result-container scroll-mini"></ul>
      </div>

      <div class="search-checkboxes">
        <input data-users-search class="search-checkboxes-search" placeholder="Search users" type="text"  onkeyup="show_users_result(this.value)">
        <ul data-users-search-results class="search-checkboxes-result-container scroll-mini"></ul>
      </div>
    </div>





    <div style="text-align: right;">
      <button class="btn_green" style="width: 200px;" id="submit" >SAVE</button>
    </div> 

  </form>
</section>


<script type="text/javascript">


    function show_levels_result(){
      var targate=$('[data-level-search-results]');
      var value=targate.siblings('[data-level-search]').val();
      targate.html('')
      $.each(levels, function(index, item) {
        if(item.name.toLowerCase().includes(value)){
          let checked =(selected_levels.includes(item.id))?'checked':'';
          var row=`<li><input type="checkbox" data-level-checkbox value="${item.id}" ${checked}> ${item.name}</li>`;
          targate.append(row);

        }
      }) 
    }


   var levels=[]//---declare levels array
   var assigned_to_levels = JSON.parse('<?php echo json_encode($details['assigned_to_levels']); ?>');
   selected_levels = assigned_to_levels.map(a => a.level_id);
   quick_list_hierarchy_levels().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    levels=data.response.list
    show_levels_result()
  }
})

   $(document.body).on('change', '[data-level-checkbox]',function(){
    if($(this).prop("checked") == true){
      selected_levels.push($(this).val())
    }
    else if($(this).prop("checked") == false){
      selected_levels.splice(selected_levels.indexOf($(this).val()),1)
    }
  });

</script>





<script type="text/javascript">
  var assigned_to_users = JSON.parse('<?php echo json_encode($details['assigned_to_users']); ?>');
  selected_users = assigned_to_users.map(a => a.user_id);
//--------fetch users list
quick_list_users({sort_by:'name',status_ids:['ACTIVE'].toString()}).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    users=data.response.list
    show_users_result()
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
})

function show_users_result(){
  var targate=$('[data-users-search-results]');
  var value=targate.siblings('[data-users-search]').val();
  targate.html('')
  $.each(users, function(index, item) {


    let checked =(selected_users.includes(item.id))?'checked':'';
    if(item.name.toLowerCase().includes(value)){
      var row=`<li><input type="checkbox" data-user-checkbox value="${item.id}" ${checked}> ${item.name}</li>`;
      targate.append(row);

    }
  }) 
}

</script>

<script>
  $(document).ready(function(){
   $(document.body).on('change', '[data-user-checkbox]',function(){
    if($(this).prop("checked") == true){
      selected_users.push($(this).val())
    }
    else if($(this).prop("checked") == false){
      selected_users.splice(selected_users.indexOf($(this).val()),1)
    }
  });
 });
</script>

<script type="text/javascript">
  function save(){
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

    obj['levels_array']=selected_levels
    obj['users_array']=selected_users

    obj['notification'] = $("#MyForm input[type='radio']:checked").val();

    var property = '';
    if(document.getElementById('file').files[0]) {
      property = document.getElementById('file').files[0];
      var image_name = property.name;
      var image_extension = image_name.split('.').pop().toLowerCase();

      if(jQuery.inArray(image_extension,['eml','gif','jpg','pdf','jpeg','png','']) == -1){
        alert("Invalid image file");
      }
    }

    console.log('DATABASE VALUES');
    console.log(property);

    var form_data = new FormData();
    form_data.append(`document`,property);
    form_data.append(`levels_array`, selected_levels);
    form_data.append(`users_array`, selected_users);
    form_data.append(`notification`, $("#MyForm input[type='radio']:checked").val());
    form_data.append(`ticket_text`, $('[name="ticket_text"]').val());
    form_data.append(`priority_id`, $('[name="priority_id"]').val());
    form_data.append(`ticket_due_date`, $('[name="ticket_due_date"]').val());
    form_data.append(`ticket_due_time`, $('[name="ticket_due_time"]').val());
    form_data.append(`update_eid`, $('[name="update_eid"]').val());

    $.ajax({
      url:window.location.pathname+'-action',
      type:'POST',
      data: form_data,
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#msg').html('Loading......');
      },
      success:function(data){
       if((typeof data)=='string'){
         data=JSON.parse(data) 
       }
       alert(data.message);
       if(data.status){
        location.href='user/task-management/tickets/details?eid=<?php echo $details['eid']; ?>';
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
  var targate=$(`[name="priority_id"]`);
  get_ticket_priorities().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      targate.html("");
      $.each(data.response.list, function(index, item) {
       targate.append(`<option value="${item.id}">${item.name}</option>`);
       select_default(targate)
     })   
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 

</script>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>