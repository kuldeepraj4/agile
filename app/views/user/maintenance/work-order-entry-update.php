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

<section class="lg-form-outer">
  <div class="lg-form-header">UPDATE - WORK ORDER</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return update()">
    <input hidden="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">

    <section class="section-111">
      <div>
        <fieldset>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Work Order No</label>
              <input name="workorder_no" id="workorder_no" type="text" required="required" value="<?php echo $details['workorder_id'] ?>" disabled=true>
            </div>
          </div>                  
        </fieldset>
      </div>
      <div>
        <fieldset>
          <div class="field-section single-column">
            <div class="field-p">
             <label>Enter Date</label>
             <input name="workorder_date" id="workorder_date" type="text" required="required" value="<?php echo $details['workorder_date'] ?>">
           </div>
         </div>
       </fieldset>
     </div>
     <div>
      <fieldset>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Repair Order No</label>
            <input data-filter="repairorder_no" id="repairorder_no" type="text" required="required" value="<?php echo $details['repairorder_id'] ?>" value="" disabled=true>
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
            <input name="engine_reading" type="text" value="<?php echo $details['engine_reading'] ?>">
          </div>
          <div class="field-p">
            <label>Technician Comments</label>
            <input name="technician_comments" type="text" value="<?php echo $details['technician_comments'] ?>">
          </div>
        </div>
      </fieldset>          
    </div>
    <div>
      <fieldset>
        <div class="field-section single-column">  
          <div class="field-p">
            <label>Vendor Name</label>
            <select name="vendor_id" id="vendor_id" type="text"></select>
          </div>
          <div class="field-p">
            <label>Vendor State</label>
            <select name="state_id" id="state_id" type="text" onchange="show_cities({state_id:this.value})"></select>
          </div>
          <div class="field-p">
            <label>Vendor City</label>
            <select data-filter="city_id" name="city_id"></select>
          </div>
          <div class="field-p">
            <label>Contact Person</label>
            <input name="contact_person" type="text" required="required" value="<?php echo $details['contactperson_name'] ?>">
          </div>
          <div class="field-p">
            <label>Contact No</label>
            <input name="contact_no" type="text" required="required" value="<?php echo $details['vendor_phone'] ?>">
          </div>
          <div class="field-p">
            <label>Email ID</label>
            <input name="email_id" type="text" required="required" value="<?php echo $details['vendor_email'] ?>">
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
              <option value="1" <?php if($details['billingmethod_id']=='1'){echo 'selected';} ?>>EFS</option>
              <option value="2" <?php if($details['billingmethod_id']=='2'){echo 'selected';} ?>>Loves Account</option>
              <option value="3" <?php if($details['billingmethod_id']=='3'){echo 'selected';} ?>>Bridgestone Account</option>              
              <option value="4" <?php if($details['billingmethod_id']=='4'){echo 'selected';} ?>>COM Check</option> 
              <option value="5" <?php if($details['billingmethod_id']=='5'){echo 'selected';} ?>>Others</option>
            </select>
          </div>
          <div class="field-p">
            <label>Invoice No</label>
            <input name="invoice_no" type="text" required="required" value="<?php echo $details['invoice_no'] ?>">
          </div>
          <div class="field-p">
            <label>Date Paid</label>
            <input name="paid_date" type="text" data-date-picker="" required="required" value="<?php echo $details['payment_date'] ?>">
          </div>
          <div class="field-p">
            <label>Payment Status</label>
            <select name="paymentstatus_id" id="paymentstatus_id" required="required" value="<?php echo $details['paymentstatus_id'] ?>">>
              <option value="0"> - - Select - -</option>
              <option value="1" <?php if($details['paymentstatus_id']=='1'){echo 'selected';} ?>>Paid</option>
              <option value="2" <?php if($details['paymentstatus_id']=='2'){echo 'selected';} ?>>Credit</option>
            </select>
          </div>
          <div class="field-p">
            <label>Payment Notes</label>
            <input name="payment_notes" type="text" required="required" value="<?php echo $details['payment_notes'] ?>">
          </div>
          <div class="field-p">
            <label>Amount</label>
            <input name="amount" type="text" required="required" value="<?php echo $details['amount'] ?>">
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

            </tbody>
            <tfoot>
             <tr>
              <td colspan="10"><button type="button" class="btn_blue" onclick="add_row({})">Add Row</button></td>
              <td >Total</td>
              <td ><input type="text" class="w-150" min="0" data-total-amount disabled></td>
            </tr>
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

<script type="text/javascript"></script>
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
      $('#vendor_id').html(options);
      $('#vendor_id option[value="<?php echo $details['vendor_id']; ?>"]').prop('selected',true);     
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
      $('#state_id').html(options);
      $('#state_id option[value="<?php echo $details['state_id']; ?>"]').prop('selected',true);  
      show_cities({state_id:'<?php echo $details['state_id']; ?>'});                
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
    console.log(data)
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="city_id"]').html(options);
      $('[name="city_id"] option[value="<?php echo $details['city_id']; ?>"]').prop('selected',true);
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
      $('#unittype_id').html(options);
      $('#unittype_id option[value="<?php echo $details['unittype_id']; ?>"]').prop('selected',true);    
      show_unit_filter({unittype_id:'<?php echo $details['unittype_id']; ?>'}); 
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
      $('#unit_id').html(options);
      $('#unit_id option[value="<?php echo $details['unit_id']; ?>"]').prop('selected',true);
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
      $('#unit_id').html(options);
      $('#unit_id option[value="<?php echo $details['unit_id']; ?>"]').prop('selected',true); 
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

  function add_row(param){
    console.log(param)
    ++counter;

    if(param.hasOwnProperty('default_select_jobworktype_id')){
      default_select_jobworktype_id=param.default_select_jobworktype_id
    }else{
      default_select_jobworktype_id=''
    }

    if(param.hasOwnProperty('default_select_jobwork_id')){
      default_select_jobwork_id=param.default_select_jobwork_id
    }else{
      default_select_jobwork_id=''
    }

    if(param.hasOwnProperty('default_description')){
      default_description=param.default_description
    }else{
      default_description=''
    }

    if(param.hasOwnProperty('default_select_nocharge_id')){
      default_select_nocharge_id=param.default_select_nocharge_id
    }else{
      default_select_nocharge_id=''
    }

    if(param.hasOwnProperty('default_select_warranty_id')){
      default_select_warranty_id=param.default_select_warranty_id
    }else{
      default_select_warranty_id=''
    }

    if(param.hasOwnProperty('default_expiremiles')){
      default_expiremiles=param.default_expiremiles
    }else{
      default_expiremiles=''
    }

    if(param.hasOwnProperty('default_expiredays')){
      default_expiredays=param.default_expiredays
    }else{
      default_expiredays=''
    }

    if(param.hasOwnProperty('default_expirehours')){
      default_expirehours=param.default_expirehours
    }else{
      default_expirehours=''
    }

    if(param.hasOwnProperty('default_quantity')){
      default_quantity=param.default_quantity
    }else{
      default_quantity=''
    }

    if(param.hasOwnProperty('default_cost')){
      default_cost=param.default_cost
    }else{
      default_cost=''
    }

    var $add_rowissue=`<tr id="issue_row${counter}"  data-stop-row>
    <td>${counter}</td>
    <td><select class="w-150" name="jobworktype_id" required></select></td>
    <td><select class="w-150" name="jobwork_id" required></select></td>
    <td><input  class="w-150" value='${default_description}' name="description" type="text" required></td>
    <td><select class="w-150" name="nocharge_id" data-default-select="${default_select_nocharge_id}" required>
    <option value="0"> - - Select - -</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
    </select></td>
    <td><select class="w-150" name="warranty_id" data-default-select="${default_select_warranty_id}" required>
    <option value="0"> - - Select - -</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
    </select></td>
    <td><input class="w-150" value='${default_expiremiles}' name="expiremiles" type="text" required></td>
    <td><input class="w-150" value='${default_expiredays}' name="expiredays" type="text" required></td>
    <td><input class="w-150" value='${default_expirehours}' name="expirehours" type="text" required></td>
    <td><input class="w-150" value='${default_quantity}' name="quantity" type="text" required onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>
    <td><input class="w-150" value='${default_cost}' name="cost" type="text" required onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>
    <td><input class="w-150" value='' name="amount" type="text" data-row-amount onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>

    <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>
    </tr>`;
    $('#issue_table').append($add_rowissue);
    show_jobworktype({row_id:'issue_row'+counter,default_select:default_select_jobworktype_id})
    show_jobwork({row_id:'issue_row'+counter,default_select:default_select_jobwork_id})
    cal_total_amount()
  }

  $(document.body).on('click', '[data-remove-stop-button=""]' ,function(){
    $(this).parent().parent().remove();
  });
  //-----------/remove stop
</script>

<script type="text/javascript">
  function cal_total_amount() {
    $total_rows=$('[data-stop-row]');
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
  function show_jobworktype(param){
//console.log(param)
   get_jobworktype().then(function(data) {
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
      $('tr#'+param.row_id+' [name="jobworktype_id"]').html(options);
      if(param.hasOwnProperty('default_select'))
      {
        $('tr#'+param.row_id+' [name="jobworktype_id"] option[value="'+param.default_select+'"]').prop('selected',true); 
      } 
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_jobworktype('issue_row1')
</script>

<script type="text/javascript">
  function show_jobwork(param){
  //console.log(param)
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
      $('tr#'+param.row_id+' [name="jobwork_id"]').html(options);     
      if(param.hasOwnProperty('default_select'))
      {
        $('tr#'+param.row_id+' [name="jobwork_id"] option[value="'+param.default_select+'"]').prop('selected',true);
      } 
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_jobwork('issue_row1')
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
        update_eid:$('[name="update_eid"]').val(),
        order_date:$('[name="workorder_date"]').val(),
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
        //amount:$('[name="amount"]').val(),
        
  //stops:data_stop_array,
  stops:JSON.stringify(data_stop_array)
}
console.log(obj)
$.ajax({
  url:window.location.pathname+'-action',
  type:'POST',
  data: obj,
  success:function(data){
          console.log(data)
          // alert(data)
          if((typeof data)=='string'){
           data=JSON.parse(data) 
           console.log(data)
         }
         alert(data.message);
         if(data.status){
          //location.href="../user/maintenance/work-order-entry"
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
    var issue_list='<?php echo json_encode($details['stop_list']) ?>';
    issue_list=JSON.parse(issue_list)
    //console.log(issue_list)
    $.each(issue_list,function(index,item) 
    {
      add_row(
      {
        default_select_jobworktype_id:item.jobworktype_id,
        default_select_jobwork_id:item.jobwork_id,
        default_description:item.description,
        default_select_nocharge_id:item.nocharge_id,
        default_select_warranty_id:item.warranty_id,
        default_expiremiles:item.expire_miles,
        default_expiredays:item.expire_days,
        default_expirehours:item.expire_hours,
        default_quantity:item.quantity,
        default_cost:item.cost,
      }
      )
    }
    )
  }
  f()
</script>



<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>