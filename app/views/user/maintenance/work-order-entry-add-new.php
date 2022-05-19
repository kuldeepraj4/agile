<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">ADD NEW - WORK ORDER</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">

<section class="section-111">
      <div>
        <fieldset>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Work Order No</label>
              <input name="workorder_no" id="workorder_no" type="text" required="required" value="" disabled=true>
            </div>
          </div>                  
        </fieldset>
      </div>
      <div>
        <fieldset>
          <div class="field-section single-column">
            <div class="field-p">
             <label>Enter Date</label>
             <input name="workorder_date" id="workorder_date" data-date-picker="" type="text" required="required" value="" >
           </div>
         </div>
       </fieldset>
     </div>
     <div>
      <fieldset>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Repair Order No</label>
            <input name="repairorder_no" id="repairorder_no" type="text" required="required" value="">
          </div>
        </div>       
      </fieldset>
    </div>
  </section>

  <section class="section-111">     
    <div>

      <fieldset>

      </fieldset> 
      <fieldset>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Unit Type</label>
            <select name="unittype_id" id="unittype_id" type="text" onchange="show_unit_filter({unittype_id:this.value})"></select>
          </div>
          <div class="field-p">
            <label>Unit No</label>
             <select name="unit_id" id="unit_id" type="text"></select>
            </select>
          </div>
          <div class="field-p">
            <label>Odometer Reading / Engine Hours</label>
            <input name="engine_reading" type="text">
          </div>
          <div class="field-p">
            <label>Technician Comments</label>
            <input name="technician_comments" type="text">
          </div>
        </div>
      </fieldset>          
    </div>
    <div>
      <fieldset>
        <div class="field-section single-column">  
          <div class="field-p">
            <label>Vendor Name</label>
            <select name="vendor_id" type="text"></select>
          </div>
          <div class="field-p">
            <label>Vendor State</label>
            <select name="state_id" id="state_id" type="text" onchange="show_cities({state_id:this.value})"></select>
          </div>
          <div class="field-p">
            <label>Vendor City</label>
            <select name="city_id" type="text" required="required"></select>
          </div>
          <div class="field-p">
            <label>Contact Person</label>
            <input name="contact_person" type="text" required="required" value="" >
          </div>
          <div class="field-p">
            <label>Contact No</label>
            <input name="contact_no" type="text" required="required" value="" >
          </div>
          <div class="field-p">
            <label>Email ID</label>
            <input name="email_id" type="text" required="required" value="" >
          </div>
        </div> 
      </fieldset>
    </div>
    <div>
      <fieldset>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Billing Method</label>
            <select name="billingmethod_id" id="billingmethod_id" type="text" required="required">
              <option value="0"> - - Select - -</option>
              <option value="1">EFS</option>
              <option value="2">Loves Account</option>
              <option value="3">Bridgestone Account</option>              
              <option value="4">COM Check</option> 
              <option value="5">Others</option>
            </select>
          </div>
          <div class="field-p">
            <label>Invoice No</label>
            <input name="invoice_no" type="text" required="required" value="" >
          </div>
          <div class="field-p">
            <label>Date Paid</label>
            <input name="paid_date" type="text" data-date-picker="" required="required" value="" >
          </div>
          <div class="field-p">
            <label>Payment Status</label>
            <select name="paymentstatus_id" id="paymentstatus_id" required="required" value="" >
              <option value="0"> - - Select - -</option>
              <option value="1">Paid</option>
              <option value="2">Credit</option>
            </select>
          </div>
          <div class="field-p">
            <label>Payment Notes</label>
            <input name="payment_notes" id="payment_notes" type="text" required="required" value="" >
          </div>
          <div class="field-p">
            <label>Amount</label>
            <input name="amount" type="text" required="" value="" >
          </div>
        </div> 
      </fieldset>
    </div>
  </section>

  <section class="section-1" style="width:100%">
    <div>
      <fieldset>
        <legend>Job Work List</legend>
        <div class="field-section table-rows">
          <table style="width: 100%">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Type</th>
                <th>Job Work</th>
                <th>Description</th>
                <th>No Charge</th>
                <th>Warranty</th>
                <th>Expire Miles</th>
                <th>Expire Days</th>
                <th>Expire Hours</th>
                <th>Quantity</th>
                <th>Cost</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody id="issue_table">
              <tr id="issue_row1" data-stop-row>
                <td>1</td>
                <td><select class="w-150" name="jobworktype_id" required></select></td>
                <td><select class="w-150" name="jobwork_id" required></select></td>
                <td><input  class="w-150" name="description" type="text" required></td>
                <td><select class="w-150" name="nocharge_id" required>
                <option value="0"> - - Select - -</option>
                <option value="Yes">Yes</option>
                <option value="Yes">No</option>
                </select></td>
                <td><select class="w-150" name="warranty_id" required>
                <option value="0"> - - Select - -</option>
                <option value="Yes">Yes</option>
                <option value="Yes">No</option> 
                </select></td>
                <td><input class="w-150" name="expiremiles" type="text" required></td>
                <td><input class="w-150" name="expiredays" type="text" required></td>
                <td><input class="w-150" name="expirehours" type="text" required></td>
                <td><input class="w-150" name="quantity" type="text" required></td>
                <td><input class="w-150" name="cost" type="text" required></td>
                <td><input class="w-150" name="amount" type="text" required></td>
                <td></td>
              </tr>
            </tbody>
            <tfoot>
             <tr>
             <td colspan="10"><button type="button" class="btn_blue" onclick="add_row()">Add Row</button></td>
             </tr>
             <td >Total</td>
              <td ><input type="text" class="w-150" min="0" data-total-amount disabled></td>
           </tfoot>
         </table>
       </div>                  
     </fieldset>
   </div>
 </section>

 <section class="action-button-box">
  <button type="submit" class="btn_green">Save Work Order</button>
</section>

</form>
</section>

<script type="text/javascript">
  function show_vendor_filter(){
   get_vendormaster().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="vendor_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_vendor_filter()
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
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="state_id"]').html(options);                 
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_states()
</script>

<script type="text/javascript">
  function show_cities(param){
   get_cities(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="city_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
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
      $('[name="unittype_id"]').html(options);     
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
    if(param.unittype_id==1){
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
      $('[name="unit_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
})
}else if(param.unittype_id==2){
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
      $('[name="unit_id"]').html(options);     
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

  function add_row(){
    ++counter;
    var $add_rowissue=`<tr id="issue_row${counter}"  data-job-work-row>
    <td>${counter}</td>
    <td><select class="w-150" name="jobworktype_id" required></select></td>
    <td><select class="w-150" name="jobwork_id" required></select></td>
    <td><input  class="w-150" name="description" type="text" required></td>
    <td><select class="w-150" name="nocharge_id" required>
    <option value="0"> - - Select - -</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
    </select></td>
    <td><select class="w-150" name="warranty_id" required>
    <option value="0"> - - Select - -</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
    </select></td>
    <td><input class="w-150" name="expiremiles" type="text" required></td>
    <td><input class="w-150" name="expiredays" type="text" required></td>
    <td><input class="w-150" name="expirehours" type="text" required></td>
    <td><input class="w-150" name="quantity" type="text" required onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>
    <td><input class="w-150" name="cost" type="text" required onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>
    <td><input class="w-150" value='' name="amount" type="text" data-row-amount onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>

    <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>
    </tr>`;
    $('#issue_table').append($add_rowissue);
    show_jobworktype('issue_row'+counter)
    show_jobwork('issue_row'+counter)
    cal_total_amount()
  }

  $(document.body).on('click', '[data-remove-stop-button=""]' ,function(){
    $(this).parent().parent().remove();
  });
  //-----------/remove stop
</script>

<script type="text/javascript">
  function cal_total_amount() {
    $total_rows=$('[data-job-work-row]');
    let amount=0;
    $total_rows.each(function(index,item){
      qty=parseFloat($(this).find('[name="quantity"').val());
      qty=isNaN(qty)?0:qty;
      cost=parseFloat($(this).find('[name="cost"').val());
      cost=isNaN(cost)?0:cost;
      sub_amount=cost*qty;
      $(this).find('[name="amount"').val(sub_amount);
      amount+=sub_amount
    })
    $('[data-total-amount]').val(amount)
  }
</script>

<script type="text/javascript">
  function show_jobworktype(row_id){
   get_job_work_type().then(function(data) {
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
      $('tr#'+row_id+' [name="jobworktype_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_jobworktype('issue_row1')
</script>

<script type="text/javascript">
  function show_jobwork(row_id){
   get_job_work().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('tr#'+row_id+' [name="jobwork_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_jobwork('issue_row1')
</script>

<script type="text/javascript">
  function save(){
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
          jobworktype_id : $data_stop_row.find('[name="jobworktype_id"]').val(),
          jobwork_id : $data_stop_row.find('[name="jobwork_id"]').val(),
          description : $data_stop_row.find('[name="description"]').val(),
          nocharge_id : $data_stop_row.find('[name="nocharge_id"]').val(),
          warranty_id : $data_stop_row.find('[name="warranty_id"]').val(),
          expiremiles : $data_stop_row.find('[name="expiremiles"]').val(),
          expiredays : $data_stop_row.find('[name="expiredays"]').val(),
          expirehours : $data_stop_row.find('[name="expirehours"]').val(),
          quantity : $data_stop_row.find('[name="quantity"]').val(),
          cost : $data_stop_row.find('[name="cost"]').val()
          //amount : $data_stop_row.find('[name="amount"]').val()
  }
  data_stop_array.push(stop_row)
})

var obj={
        order_date:$('[name="workorder_date"]').val(),
        repairorder_id:$('[name="repairorder_no"]').val(),
        unittype_id:$('[name="unittype_id"]').val(),
        unit_id:$('[name="unit_id"]').val(),
        enginereading:$('[name="engine_reading"]').val(),
        vendor_id:$('[name="vendor_id"]').val(),
        state_id:$('[name="state_id"]').val(),
        city_id:$('[name="city_id"]').val(),
        contact_person:$('[name="contact_person"]').val(),
        contact_no:$('[name="contact_no"]').val(),
        email_id:$('[name="email_id"]').val(),
        billingmethod_id:$('[name="billingmethod_id"]').val(),
        invoice_no:$('[name="invoice_no"]').val(),
        payment_date:$('[name="paid_date"]').val(),
        paymentstatus_id:$('[name="paymentstatus_id"]').val(),
        paymentnotes:$('[name="payment_notes"]').val(),
        techniciancomments:$('[name="technician_comments"]').val(),

  //stops:data_stop_array,
  stops:JSON.stringify(data_stop_array)
}
console.log(obj)
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
     location.href="../user/maintenance/work-order-entry"
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