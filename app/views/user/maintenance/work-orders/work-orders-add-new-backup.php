<?php
require_once APPROOT.'/views/includes/user/header.php';
$ro_details=$data['ro_details'];

?>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">Create Work Order</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-111">

    </section>
    <section class="section-111" style="max-width: 1200px">     
      <div>
        <fieldset>
          <legend>Repair Order Details</legend>
          <div class="field-section single-column">

            <div class="field-p">
              <label>ID</label>
              <div><?php  echo $ro_details['id']; ?></div>
            </div>
            <div class="field-p">
              <label>Unit</label>
              <div><?php  echo $ro_details['vehicle_type']; ?></div>
            </div>
            <div class="field-p">
              <label>Unit ID</label>
              <div><?php  echo $ro_details['vehicle_code']; ?></div>
            </div>
            <div class="field-p">
              <label>VIN No</label>
              <div><?php  echo $ro_details['vehicle_vin_number']; ?></div>
            </div>
            <div class="field-p">
              <label>Date</label>
              <input name="date" type="text" data-date-picker required>
            </div>                  
          </div>                  
        </fieldset>


        <fieldset>
          <legend>Other Information</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Odometer Reading</label>
              <input name="odometer_reading" type="text" required>
            </div>
              <div class="field-p">
              <label>Engine Hours</label>
              <input name="engine_hours" type="text" required>
            </div>          
            <div class="field-p">
              <label>Technician Comments</label>
              <textarea name="technician_comments" style="height: 80px"></textarea>
            </div>

          </div>                  
        </fieldset>
      </div>
      <div> 
        <fieldset>
          <legend> Vendor Details </legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Vendor Name</label>
              <select name="vendor_id" type="text" style="text-overflow: ellipsis;overflow: hidden !important;max-width: 250px" required></select>
            </div>
            <div class="field-p">
              <label>Vendor State</label>
              <select name="vendor_state_id" id="vendor_state_id" type="text" onchange="show_cities({state_id:this.value})" required></select>
            </div>
            <div class="field-p">
              <label>Vendor City</label>
              <select name="vendor_city_id" type="text" required></select>
            </div>
            <div class="field-p">
              <label>Contact Person</label>
              <input name="vendor_contact_person" type="text" required value="" >
            </div>
            <div class="field-p">
              <label>Contact No</label>
              <input name="vendor_contact_no" type="text" required value="" >
            </div>
            <div class="field-p">
              <label>Email ID</label>
              <input name="vendor_email_id" type="text" value="" >
            </div>       
          </div>                  
        </fieldset>
      </div>
      <div>
        <fieldset>
          <legend> Billing Details </legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Payment Status</label>
              <select name="payment_status"required value="" >
                <option value=""> - - Select - -</option>
                <option value="PAID">Paid</option>
                <option value="CREDIT">Credit</option>
              </select>
            </div>
            <div class="field-p">
              <label>Payment Mode</label>
              <select name="payment_mode_id" id="payment_mode_id" type="text" required></select>
            </div>
            <div class="field-p">
              <label>Payment Ref No</label>
              <input name="payment_ref_no" type="text" required value="" >
            </div>
            <div class="field-p">
              <label>Invoice No</label>
              <input name="invoice_no" type="text" required value="" >
            </div>
            <div class="field-p">
              <label>Date Paid</label>
              <input name="payment_date" type="text" data-date-picker="" required value="" >
            </div>

            <div class="field-p">
              <label>Payment Notes</label>
              <textarea name="payment_remarks" style="height: 80px"></textarea>
            </div>
            <div class="field-p">
              <label>Invoice File</label>
              <textarea name="invoice_file" style="height: 80px"></textarea>
            </div>

          </div>                  
        </fieldset>
      </div>
    </section>
    <section class="section-1" style="width:100%;overflow:auto;">
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
                  <th>Warranty Period</th>
                  <th>Quantity</th>
                  <th>Rate</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody id="issue_table">
                <tr id="issue_row1" data-job-work-row>
                  <td>1</td>
                  <td><select class="w-150" name="job_work_type_id" required></select></td>
                  <td><select class="w-150" name="job_work_id" required></select></td>
                  <td><input  class="w-150" name="description" type="text" required></td>
                  <td><input type="checkbox" name="is_no_charge"></td>
                  <td><select style="width: 100px" name="warranty_type" required>
                    <option value="NONE" selected>None</option>
                    <option value="DAYS">Days</option> 
                    <option value="HOURS">Hours</option>
                    <option value="MILES">Miles</option> 
                  </select>
                </td>
                <td><input style="width: 70px" name="warranty_period" type="text" value="0" required></td>
                <td><input style="width: 70px" name="quantity" value="0" type="text" required onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>
                <td><input style="width: 80px" value="0" name="rate" type="text" required onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>
                <td><input style="width: 100px" value="0" value='' name="amount" type="text" data-row-amount onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>
                <td></td>
              </tr>
            </tbody>
            <tfoot>
             <tr>
               <td colspan="8"><button type="button" class="btn_blue" onclick="add_row()">Add Row</button></td>
               <td >Total</td>
               <td ><input type="text" style="width: 100px" min="0" data-total-amount disabled></td>
             </tr>
           </tfoot>
         </table>
       </div>                  
     </fieldset>
   </div>
 </section>

 <section class="action-button-box">
  <button type="submit" class="btn_green">SAVE</button>
</section>
</form>
</section>
<script type="text/javascript">
  function save(){
    //show_processing_modal()
    //submit_to_wait_btn('#submit','loading')
    $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    var formData=new FormData(currentForm);
    if(isValidForm){
      var arr=$('#MyForm').serializeArray();

      var $job_work_rows = $("[data-job-work-row]");
      job_works_array=[]

      $job_work_rows.each(function (index) 
      {
        var $job_work_row = $(this);
        var job_work_row=
        {
          job_work_type_id : $job_work_row.find('[name="job_work_type_id"]').val(),
          job_work_id : $job_work_row.find('[name="job_work_id"]').val(),
          description : $job_work_row.find('[name="description"]').val(),
          is_no_charge : $job_work_row.find('[name="is_no_charge"]').prop("checked"),
          warranty_type : $job_work_row.find('[name="warranty_type"]').val(),
          warranty_period : $job_work_row.find('[name="warranty_period"]').val(),
          quantity : $job_work_row.find('[name="quantity"]').val(),
          rate : $job_work_row.find('[name="rate"]').val()
          //amount : $job_work_row.find('[name="amount"]').val()
        }
        job_works_array.push(job_work_row)
      })

      var obj={
        repair_order_id:'<?php  echo $ro_details['id']; ?>',
        date:$('[name="date"]').val(),
        odometer_reading:$('[name="odometer_reading"]').val(),
        engine_hours:$('[name="engine_hours"]').val(),
        technician_comments:$('[name="technician_comments"]').val(),
        vendor_id:$('[name="vendor_id"]').val(),
        vendor_state_id:$('[name="vendor_state_id"]').val(),
        vendor_city_id:$('[name="vendor_city_id"]').val(),
        vendor_contact_person:$('[name="vendor_contact_person"]').val(),
        vendor_contact_no:$('[name="vendor_contact_no"]').val(),
        vendor_email:$('[name="vendor_email_id"]').val(),
        payment_mode_id:$('[name="payment_mode_id"]').val(),
        payment_ref_no:$('[name="payment_ref_no"]').val(),
        invoice_no:$('[name="invoice_no"]').val(),
        payment_date:$('[name="payment_date"]').val(),
        payment_status:$('[name="payment_status"]').val(),
        payment_remarks:$('[name="payment_remarks"]').val(),
        job_works:job_works_array,
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
     //window.history.back();
     wait_to_submit_btn('#submit','SAVE')
     hide_processing_modal()
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
 get_maintenace_vendors().then(function(data) {
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
}) 


</script>

<script type="text/javascript">
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
      $('[name="vendor_state_id"]').html(options);                 
    }
  }
})
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
      $('[name="vendor_city_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
</script>



<script type="text/javascript">
 quick_list_payment_modes().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="payment_mode_id"]').html(options);                 
    }
  }
})
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
    <td><select class="w-150" name="job_work_type_id" required></select></td>
    <td><select class="w-150" name="job_work_id" required></select></td>
    <td><input  class="w-150" name="description" type="text" required></td>
    <td><input type="checkbox" name="is_no_charge"></td>
    <td><select style="width: 100px" name="warranty_type" required>
    <option value="NONE" selected>None</option>
    <option value="DAYS">Days</option> 
    <option value="HOURS">Hours</option>
    <option value="MILES">Miles</option> 
    </select>
    </td>
    <td><input style="width: 70px" name="warranty_period" value="0" type="text" required></td>
    <td><input style="width: 70px" value="0" name="quantity" type="text" required onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>
    <td><input style="width: 80px" value="0" name="rate" type="text" required onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>
    <td><input style="width: 100px" value='0' name="amount" type="text" data-row-amount onchange="cal_total_amount()" onkeyup="cal_total_amount()"></td>

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
      qty=parseFloat($(this).find('[name="quantity"]').val());
      qty=isNaN(qty)?0:qty;
      rate=parseFloat($(this).find('[name="rate"]').val());
      rate=isNaN(rate)?0:rate;
      sub_amount=rate*qty;
      $(this).find('[name="amount"]').val(sub_amount);
      amount+=sub_amount
    })
    $('[data-total-amount]').val(amount)
  }
</script>

<script type="text/javascript">
  function show_jobworktype(row_id){
   get_job_work_type().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('tr#'+row_id+' [name="job_work_type_id"]').html(options);     
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
      $('tr#'+row_id+' [name="job_work_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_jobwork('issue_row1')
</script>



<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>