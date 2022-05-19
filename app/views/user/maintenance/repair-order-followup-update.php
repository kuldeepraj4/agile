<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details'];

echo "<pre>";
print_r($details);
echo "</pre>"; 

?>

<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">UPDATE - REPAIR ORDER FOLLOWUP</div>
    <form class="lg-form" method="POST" id="MyForm" onsubmit="return update()">
        <input hidden="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">

    <section class="section-111">
      <div>
        <fieldset>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Order No</label>
              <input name="order_no" id="order_no" type="text" required="required" value="<?php echo $details['order_no'] ?>" disabled="true">
            </div>
          </div>                  
        </fieldset>
      </div>
      <div>
        <fieldset>
          <div class="field-section single-column">
            <div class="field-p">

            </div>
          </div>                  
        </fieldset>
      </div>
      <div>
        <fieldset>
          <div class="field-section single-column">
            <div class="field-p">

            </div>
          </div>                  
        </fieldset>
      </div>
    </section>

    <section class="section-111">
      <div>
        <fieldset>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Class</label>
              <select name="order_class_id" id="order_class_id" required="required" disabled="true"></select>
            </div>
          </div>                  
        </fieldset>
      </div>
      <div>
        <fieldset>
          <div class="field-section single-column">
            <div class="field-p">
             <label>Enter Date</label>
             <input name="order_date" id="order_date" type="text" data-date-picker="" required="required" disabled="true" value="<?php echo $details['order_date'] ?>">
           </div>
         </div>                  
       </fieldset>
     </div>
     <div>
      <fieldset>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Status</label>
            <select name="order_status_id" id="order_status_id" required="required" disabled="true"></select>
          </div>
        </div>                  
      </fieldset>  
    </div>
  </section>

  <section class="section-111">     
    <div>
      <fieldset>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Driver</label>
            <select name="order_driver_id" id="order_driver_id" type="text" required="required" disabled="true"></select>
          </div>
        </div>                  
      </fieldset>
      <fieldset>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Type</label>
            <select name="order_type_id" id="order_type_id" type="text" required="required" disabled="true"></select>
          </div>     
          <div class="field-p">
            <label>Stage</label>
            <select name="order_stage_id" id="order_stage_id" type="text" required="required" disabled="true"></select>
          </div>
        </div> 
      </fieldset> 
      <fieldset>
        <div class="field-section single-column">  
          <div class="field-p">
            <label>Start Date</label>
            <input name="order_start_date" id="order_start_date" type="text" data-date-picker="" required="required" required="required" disabled="true" value="<?php echo $details['order_start_date'] ?>">
          </div>
          <div class="field-p">
            <label>Start Time</label>
            <input name="order_start_time" type="time" required="required" required="required" disabled="true" value="<?php echo $details['order_start_time'] ?>">
          </div>
          <div class="field-p">
            <label>End Date</label>
            <input name="order_end_date" type="text" data-date-picker="" required="required" disabled="true" value="<?php echo $details['order_end_date'] ?>">
          </div>
          <div class="field-p">
            <label>End Time</label>
            <input name="order_end_time" type="time" required="required" disabled="true" value="<?php echo $details['order_end_time'] ?>">
          </div>
        </div> 
      </fieldset>          
      <fieldset>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Contact Person</label>
            <input name="order_contact_person" type="text" required="required" disabled="true" value="<?php echo $details['order_contact_person'] ?>">
          </div>     
          <div class="field-p">
            <label>Contact No</label>
            <input name="order_contact_no" type="text" required="required" disabled="true" value="<?php echo $details['order_contact_number'] ?>">
          </div>
        </div> 
      </fieldset>
    </div>
    <div>
      <fieldset>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Unit Type</label>
            <select name="order_unitype_id" id="order_unitype_id" type="text" required="required" disabled="true" onchange="show_unit_filter({state_id:this.value})"></select>
          </div>
          <div class="field-p">
            <label>Unit No</label>
            <select name="order_unit_no" id="order_unit_no" type="text" required="required" disabled="true"></select>
          </div>
          <div class="field-p">
            <label>VIN No</label>
            <input name="order_vin_no" type="text" disabled="true" required="required" disabled="true" value="<?php echo $details['order_vin_no'] ?>">
          </div>
        </div>                  
      </fieldset>
    </div>

    <div>
      <fieldset>
        <div class="field-section">        
          <div class="field-p">
            <label>Ref Doc Name</label>
            <select name="order_refdoctype_id" required="required" disabled="true">
              <option value="0"> - - Select - -</option>
              <option value="Inspection Sheet">Inspection Sheet</option>
            </select>
          </div>
          <div class="field-p">
            <label>Ref Doc No</label>
            <input name="order_refdoc_no" id="order_refdoc_no" type="text" required="required" disabled="true" value="<?php echo $details['order_refdoc_no'] ?>">
          </div>                                      
        </div>                  
      </fieldset>
    </div>
  </section>

  <section class="section-1" style="width:100%">
    <div>
      <fieldset>
        <legend>Note/s</legend>
        <div class="field-section table-rows">
          <table style="width: 100%">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Note Date</th>
                <th>Note Time</th>
                <th>Note Remarks</th>
                <th>Next Note </th>
                <th>Note By</th>
              </tr>
            </thead>
            <tbody id="issue_table"></tbody>
            <tfoot>
          <tr><td colspan="8"><button type="button" class="btn_blue" onclick="add_issue_row({})">Add Row</button></td></tr>
           </tfoot>
         </table>
       </div>                  
     </fieldset>
   </div>
 </section>

<section class="action-button-box">
  <button type="submit" class="btn_green">Save Notes</button>
</section>

</form>
</section>

<script type="text/javascript">
  function show_class_filter(){
   get_repairorderclass().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('#order_class_id').html(options);
      $('#order_class_id option[value="<?php echo $details['order_class_id']; ?>"]').prop('selected',true);    
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_class_filter()
</script>

<script type="text/javascript">
  function show_status_filter(){
   get_repairorderstatus().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('#order_status_id').html(options);
      $('#order_status_id option[value="<?php echo $details['order_status_id']; ?>"]').prop('selected',true);   
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_status_filter()
</script>

<script type="text/javascript">
  function show_type_filter(param){
   get_repairordertype1(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('#order_type_id').html(options);
      $('#order_type_id option[value="<?php echo $details['order_type_id']; ?>"]').prop('selected',true);      
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_type_filter()
</script>

<script type="text/javascript">
  function show_stage_filter(param){
   get_repairorderstage(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('#order_stage_id').html(options);
      $('#order_stage_id option[value="<?php echo $details['order_stage_id']; ?>"]').prop('selected',true);  
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_stage_filter()
</script>

<script type="text/javascript">
  function show_driver_filter(){
   get_drivers().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.code+' '+item.name_first+`</option>`;               
      })
      $('#order_driver_id').html(options);
      $('#order_driver_id option[value="<?php echo $details['order_driver_id']; ?>"]').prop('selected',true);                 
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_driver_filter()
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
      $('#order_unitype_id').html(options);
      $('#order_unitype_id option[value="<?php echo $details['order_unitype_id']; ?>"]').prop('selected',true);      
      show_unit_filter({state_id:'<?php echo $details['order_unitype_id']; ?>'});
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_unittype_filter()
</script>

<script type="text/javascript">
  function show_unit_filter(param){
    if(param.state_id==1){
    get_trucks().then(function(data){
  //console.log(data)
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.code+`</option>`;               
      })
       $('#order_unit_no').html(options);
       $('#order_unit_no option[value="<?php echo $details['order_unit_no']; ?>"]').prop('selected',true); 
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
})
}else if(param.state_id==2){
  get_trailers().then(function(data){
  //console.log(data)
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.code+`</option>`;               
      })
       $('#order_unit_no').html(options);
       $('#order_unit_no option[value="<?php echo $details['order_unit_no']; ?>"]').prop('selected',true); 
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
})
} 
}
</script>

<script type="text/javascript">
  var counter=0
  var $issue_table = $('#issue_table');

  function add_issue_row(param){
    //console.log(param)
    ++counter;

    if(param.hasOwnProperty('default_note_date')){
      default_note_date=param.default_note_date
    }else{
      default_note_date=''
    }

    if(param.hasOwnProperty('default_note_time')){
      default_note_time=param.default_note_time
    }else{
      default_note_time=''
    }

    if(param.hasOwnProperty('default_notes_remarks')){
      default_notes_remarks=param.default_notes_remarks
    }else{
      default_notes_remarks=''
    }

    if(param.hasOwnProperty('default_next_note_date')){
      default_next_note_date=param.default_next_note_date
    }else{
      default_next_note_date=''
    }

    if(param.hasOwnProperty('default_note_by')){
      default_note_by=param.default_note_by
    }else{
      default_note_by=''
    }    

    var $add_rowissue=`<tr id="issue_row${counter}"  data-stop-row>
    <td>${counter}</td>
    <td><input type="text" class="w-150" value='${default_note_date}' name="note_date" data-date-picker="" required></td>
    <td><input type="time" class="w-150" value='${default_note_time}' name="note_time" required></td>
    <td><input type="text" class="w-150" value='${default_notes_remarks}' name="notes_remarks" required></td>
    <td><input type="text" class="w-150" value='${default_next_note_date}' name="next_note_date" data-date-picker="" required></td>
    <td><input type="text" class="w-150" value='${default_note_by}' name="note_by" required></td>
    <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>
    </tr>`;
    $('#issue_table').append($add_rowissue);
  }

  $(document.body).on('click', '[data-remove-stop-button=""]' ,function(){
    $(this).parent().parent().remove();
  });
  //-----------/remove stop
</script>

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

      var $data_stop_rows = $("[data-stop-row]");
      data_stop_array=[]

      $data_stop_rows.each(function (index) 
      {
        var $data_stop_row = $(this);
        var stop_row=
        {
          note_date : $data_stop_row.find('[name="note_date"]').val(),
          note_time : $data_stop_row.find('[name="note_time"]').val(),
          notes_remarks : $data_stop_row.find('[name="notes_remarks"]').val(),
          next_note_date : $data_stop_row.find('[name="next_note_date"]').val(),
          note_by : $data_stop_row.find('[name="note_by"]').val()
        }
        data_stop_array.push(stop_row)
      })

      var obj={
        update_eid:$('[name="update_eid"]').val(),
        order_date:$('[name="order_date"]').val(),
        order_class_id:$('[name="order_class_id"]').val(),
        order_status_id:$('[name="order_status_id"]').val(),
        order_driver_id:$('[name="order_driver_id"]').val(),
        order_type_id:$('[name="order_type_id"]').val(),
        order_stage_id:$('[name="order_stage_id"]').val(),
        order_start_date:$('[name="order_start_date"]').val(),
        order_start_time:$('[name="order_start_time"]').val(),
        order_end_date:$('[name="order_end_date"]').val(),
        order_end_time:$('[name="order_end_time"]').val(),
        order_unitype_id:$('[name="order_unitype_id"]').val(),
        order_unit_no:$('[name="order_unit_no"]').val(),
        order_refdoctype_id:$('[name="order_refdoctype_id"]').val(),
        order_refdoc_no:$('[name="order_refdoc_no"]').val(),
        order_contact_person:$('[name="order_contact_person"]').val(),
        order_contact_no:$('[name="order_contact_no"]').val(),
  //stops:data_stop_array,
  stops:JSON.stringify(data_stop_array)
}
console.log(obj)
$.ajax({
  url:window.location.pathname+'-action',
  type:'POST',
  data: obj,
  success:function(data){
          //console.log(data)
          // alert(data)
          if((typeof data)=='string'){
           data=JSON.parse(data) 
           //console.log(data)
         }
         alert(data.message);
         if(data.status){
          location.href="../user/maintenance/repair-order-followup"
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
  async function f() 
  {
    var issue_list='<?php echo json_encode($details['issue_list']) ?>';
    issue_list=JSON.parse(issue_list)
    $.each(issue_list,function(index,item) 
    {
      add_issue_row(
      {
        default_note_date:item.note_date,
        default_note_time:item.note_time,
        default_notes_remarks:item.notes_remarks,
        default_next_note_date:item.next_note_date,
        default_note_by:item.note_by,
      }
      )
    }
    )
  }
  f()
</script>

<script type="text/javascript">
  var error='this is my error';
  //alert(error)
  //console.log(error)
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>