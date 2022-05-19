<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">ADD NEW - REPAIR ORDER FOLLOWUP</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">

    <section class="section-111">
      <div>
        <fieldset>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Class</label>
              <select name="order_class_id" required="required" disabled="true"></select>
            </div>
          </div>                  
        </fieldset>
      </div>
      <div>
        <fieldset>
          <div class="field-section single-column">
            <div class="field-p">
             <label>Enter Date</label>
             <input name="order_date" type="text" data-date-picker="" required disabled="true">
            </div>
         </div>
       </fieldset>
     </div>
     <div>
      <fieldset>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Status</label>
            <select name="order_status_id" required disabled="true"></select>
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
            <select name="order_driver_id" type="text" disabled="true"></select>
          </div>
        </div>                  
      </fieldset>
      <fieldset>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Type</label>
            <select name="order_type_id" type="text" disabled="true"></select>
          </div>     
          <div class="field-p">
            <label>Stage</label>
            <select name="order_stage_id" type="text" disabled="true"></select>
          </div>
        </div> 
      </fieldset> 
      <fieldset>
        <div class="field-section single-column">  
          <div class="field-p">
            <label>Start Date</label>
            <input name="order_start_date" type="text" data-date-picker="" required disabled="true">
          </div>
          <div class="field-p">
            <label>Start Time</label>
            <input name="order_start_time" type="time" required disabled="true">
          </div>
          <div class="field-p">
            <label>End Date</label>
            <input name="order_end_date" type="text" data-date-picker="" disabled="true">
          </div>
          <div class="field-p">
            <label>End Time</label>
            <input name="order_end_time" type="time" disabled="true">
          </div>
        </div> 
      </fieldset>          
      <fieldset>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Contact Person</label>
            <input name="order_contact_person" type="text" disabled="true">
          </div>     
          <div class="field-p">
            <label>Contact No</label>
            <input name="order_contact_no" type="text" disabled="true">
          </div>
        </div> 
      </fieldset>
    </div>
    <div>
      <fieldset>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Unit Type</label>
            <select data-filter="unit_type_id" onchange="show_unit_filter({unit_type_id:this.value})" disabled="true"></select>
          </div>
          <div class="field-p">
            <label>Unit No</label>
            <select data-filter="unit_id" disabled="true">
            </select>
          </div>
          <div class="field-p">
            <label>VIN No</label>
            <input name="order_vin_no" type="text" disabled="true">
          </div>
        </div>
      </fieldset>
    </div>
    <div>
      <fieldset>
        <div class="field-section">        
          <div class="field-p">
            <label>Ref Doc Name</label>
            <select name="order_refdoctype_id" disabled="true">
              <option value="0"> - - Select - -</option>
              <option value="Inspection Sheet">Inspection Sheet</option>
            </select>
          </div>
          <div class="field-p">
            <label>Ref Doc No</label>
            <input name="order_refdoc_no" type="text" disabled="true">
          </div>                                      
        </div>                  
      </fieldset>
    </div>
  </section>

  <section class="section-1" style="width:100%">
    <div>
      <fieldset>
        <legend>Issue List</legend>
        <div class="field-section table-rows">
          <table style="width: 100%">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Note Date</th>
                <th>Note Time</th>
                <th>Notes Remarks</th>
                <th>Next Note </th>
                <th>Note By</th>
              </tr>
            </thead>
            <tbody id="issue_table">
              <tr id="issue_row1" data-stop-row>
                <td>1</td>
                <td><input name="note_date" type="text" data-date-picker="" required></input></td>
                <td><input name="note_time" type="time" required></select></td>
                <td><input name="note_remarks" type="text" class="w-150" required></td>
                <td><input name="next_note" type="text" data-date-picker="" required></td>
                <td><input name="note_by" type="text" required></td>
                <td></td>
              </tr>

            </tbody>
            <tfoot>
             <tr><td colspan="8"><button type="button" class="btn_blue" onclick="add_stop()">Add Row</button></td></tr>
           </tfoot>
         </table>
       </div>                  
     </fieldset>
   </div>
 </section>

<section class="action-button-box">
  <button type="submit" class="btn_green">Save Repair Order</button>
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
      $('[name="order_class_id"]').html(options);     
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
      $('[name="order_status_id"]').html(options);     
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
      $('[name="order_type_id"]').html(options);     
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
      $('[name="order_stage_id"]').html(options);     
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
      $('[name="order_driver_id"]').html(options);                 
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
      $('[data-filter="unit_type_id"]').html(options);     
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
    if(param.unit_type_id==1){
      get_trucks().then(function(data){
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.code+`</option>`;               
      })
      $('[data-filter="unit_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
})
}else if(param.unit_type_id==2){
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
      $('[data-filter="unit_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
})
} 
}
</script>

<script type="text/javascript">
  var counter=1
  var $issue_table = $('#issue_table');

  function add_stop(){
    ++counter;
    var $add_rowissue=`<tr id="issue_row${counter}"  data-stop-row>
    <td>${counter}</td>
                <td><input name="note_date" type="text" data-date-picker="" required></input></td>
                <td><input name="note_time" type="time" required></select></td>
                <td><input name="note_remarks" type="text" class="w-150" required></td>
                <td><input name="next_note" type="text" data-date-picker="" required></td>
                <td><input name="note_by" type="text" required></td>
    <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>
    </tr>`;
    $('#issue_table').append($add_rowissue);
    show_repairordercategory('issue_row'+counter)
    show_repairordercriticalitylevel('issue_row'+counter)
    show_repairorderjobwork('issue_row'+counter)
  }

  $(document.body).on('click', '[data-remove-stop-button=""]' ,function(){
    $(this).parent().parent().remove();
  });
  //-----------/remove stop
</script>

<script type="text/javascript">
  function show_repairordercategory(row_id){
   get_repairordercategory().then(function(data) {
  //console.log(data);
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('tr#'+row_id+' [name="categoryid"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_repairordercategory('issue_row1')
</script>

<script type="text/javascript">
  function show_repairordercriticalitylevel(row_id){
   get_repairordercriticalitylevel().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('tr#'+row_id+' [name="criticalitylevelid"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_repairordercriticalitylevel('issue_row1')
</script>

<script type="text/javascript">
  function show_repairorderjobwork(row_id){
   get_jobwork().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('tr#'+row_id+' [name="jobworkid"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_repairorderjobwork('issue_row1')
</script>

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
/*
var obj={}
for(var a=0;a<arr.length;a++ ){
  obj[arr[a].name]=arr[a].value
}
*/

var $data_stop_rows = $("[data-stop-row]");
data_stop_array=[]

$data_stop_rows.each(function (index) 
{
  var $data_stop_row = $(this);
  var stop_row=
  {
    categoryid : $data_stop_row.find('[name="categoryid"]').val(),
    criticalitylevelid : $data_stop_row.find('[name="criticalitylevelid"]').val(),
    jobworkid : $data_stop_row.find('[name="jobworkid"]').val(),
    issuereported : $data_stop_row.find('[name="issuereported"]').val(),
    issuedescription : $data_stop_row.find('[name="issuedescription"]').val()
  }
  data_stop_array.push(stop_row)
})

var obj={
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
  order_unittype_id:$('[name="unit_type_id"]').val(),
  order_unit_no:$('[name="order_unit_no"]').val(),
  order_refdoctype_id:$('[name="order_refdoctype_id"]').val(),
  order_refdoc_no:$('[name="order_refdoc_no"]').val(),
  order_contact_person:$('[name="order_contact_person"]').val(),
  order_contact_no:$('[name="order_contact_no"]').val(),
  //stops:data_stop_array,
  stops:JSON.stringify(data_stop_array)
}
//console.log(obj)
$.ajax({
  url:window.location.href+'-action',
  type:'POST',
  data: obj,
  success:function(data){
    //console.log(data)
    // alert(data)
    if((typeof data)=='string'){
     data=JSON.parse(data) 
   }
   alert(data.message);
   if(data.status){
     location.href="../user/maintenance/repair-order-entry"
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

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>