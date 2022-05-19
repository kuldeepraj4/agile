<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>

<script type="text/javascript">
  show_processing_modal()
</script>
<style type="text/css">
  [data-location-refresh]{
    color: grey;
    font-size: .9em;
    cursor: pointer;
  }
  [data-add-city]{
        color: grey;
    font-size: .9em;
    cursor: pointer;
  }
</style>
<section class="lg-form-outer">
  <div class="lg-form-header">ADD NEW TRIP</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">
    <section class="section-1" style="max-width: 1000px;">

      <div>
        <fieldset>
          <legend>Primary Detials</legend> 
          <div class="field-section single-column">
            <div class="field-p">
              <label>Truck</label>
              <select name="truck_id" required></select>
            </div>
            <div class="field-p">
              <label>Driver Group Type</label>
              <select name="driver_group_id" required>
              </select>
            </div>

            <div class="field-p">
              <label>PPM Plan</label>
              <select name="ppm_plan_id" disabled required>
              </select>
            </div>

            <div class="field-p">
              <label>Pay Per Mile</label>
              <input type="text"  value="0" min="0" name="pay_per_mile" pattern="[0-9.-]{1,}" disabled>
            </div>

            <div class="field-p">
              <label>Incentive</label>
              <input type="text"  value="0" min="0" name="incentive_rate" onchange="cal_drivers_earnings()" onkeyup="cal_drivers_earnings()" pattern="[0-9.-]{1,}" required>
            </div>

            <div class="field-p">
              <label>Driver A</label>
              <select name="driver_a_id" required></select>
            </div>
            <div class="field-p" data-driver-b-option>
            </div>
          </div>
        </fieldset>
      </div>

    </section>


    <section class="section-1" style="width:1200px;">
      <div>
        <fieldset>
          <legend>Trip Stops</legend>
          <div class="field-section table-rows">
            <table style="width: 100%">
              <thead>
                <tr>
                  <th></th>
                  <th>Date</th>
                  <th style="white-space: nowrap;">Stop Type</th>
                  <th>State</th>
                  <th>City</th>
                  <th>Mile</th>

                </tr>
              </thead>
              <tbody id="stops_table">
                <tr id="start_row" data-stop-row>
                  <td>Start Point</td>
                  <td><input class="w-100" type="text" name="stop_date" data-date-picker="" required></td>
                  <td><select class="w-150" name="stop_type_id" required></select></td>
                  <td><select class="w-150" name="stop_state_id" required></select></td>
                  <td><select class="w-150" name="stop_location_id" required></select> <i data-location-refresh class="fas fa-sync-alt" title="Refresh Cities List"></i>  <i data-add-city class="fa fa-plus" title="Add City"></i></td>
                  <td><input  class="w-100 zero" type="number" pattern="[0-9.-]{1,}" name="stop_miles" value="0" disabled required></td>
                  <td></td>
                </tr>

                <tr id="end_row" data-stop-row>
                  <td>End Point</td>
                  <td><input class="w-100" type="text" name="stop_date" data-date-picker="" required></td>
                  <td><select class="w-150" name="stop_type_id" required></select></td>
                  <td><select class="w-150" name="stop_state_id" required></select></td>
                  <td><select class="w-150" name="stop_location_id" required></select> <i data-location-refresh class="fas fa-sync-alt" title="Refresh Cities List"></i>  <i data-add-city class="fa fa-plus" title="Add City"></i></td>
                  <td><input  class="w-100 zero" type="number" pattern="[0-9.-]{1,}" min="1" value="" name="stop_miles" onkeyup="cal_total_miles()" onchange="cal_total_miles()" required></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td style="text-align: right;"><b>Total Miles = </b></td>
                  <td><input class="w-100" type="number" pattern="[0-9.-]{1,}" value="0" name="total_miles" disabled></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
              <tfoot>
               <tr><td colspan="8"><button type="button" class="btn_blue" onclick="add_stop()">Add Stop</button></td></tr>
             </tfoot>
           </table>
         </div>                  
       </fieldset>
     </div>
   </section>







   <section class="section-111">
    <div>
      <fieldset>
        <legend>Driver A</legend>
        <div class="field-section">

          <div class="field-p">
            <label>Name</label>
            <div id="driver_a_details"></div>
          </div>
          <div class="field-p">
            <label>Miles Driven</label>
            <input name="driver_a_miles" class="w-100" type="number" pattern="[0-9.-]{1,}" value="0" disabled>
          </div>
          <div class="field-p">
            <label>Basic Earnings</label>
            <input name="driver_a_basic_earning" class="w-100" type="number" pattern="[0-9.-]{1,}" value="0" disabled>
          </div>
          <div class="field-p">
            <label>Incentives</label>
            <input name="driver_a_incentive" class="w-100" type="number" value="0" disabled pattern="[0-9.-]{1,}">
          </div> 
          <div class="field-p">
            <label>Remark</label>
            <textarea name="driver_a_remarks"></textarea>
          </div>                  
        </div>                  
      </fieldset>
      <br>
      <fieldset>
        <legend>Driver A's Earning & Deductions</legend>
        <div class="field-section table-rows">

          <table style="width: 100%">
            <thead>
              <tr>
                <th>Parameter Type</th>
                <th>Amount</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody id="salary_parameter_driver_a">

            </tbody>
            <tfoot>
             <tr><td colspan="8"><button type="button" class="btn_blue" onclick="add_salary_parameter_driver_a()">Add</button></td></tr>
           </tfoot>
         </table>



       </div>                  
     </fieldset>
   </div>
   <div driver-b-payment-section>

  </div>
</section>


<section class="lg-form-action-button-box">
<button type="submit" id="submit" class="btn_green">SAVE</button>
  <!-- &nbsp &nbsp<button type="button" class="btn_green" onclick="window.history.back()">Back to previous page</button> -->
    <?php if(in_array('P0120', USER_PRIV)){ ?>
  <div style="text-align:center;"><button type="button" class="btn_green" onclick="back_alert_main()">Back to Main Page</button></div>
<?php }else{ ?>
  <div style="text-align:center;"><button type="button" class="btn_green" onclick="back_alert_main()">Back</button></div>
<?php } ?>
</section>
</form></section>
<script type="text/javascript">
  function back_alert_main(){
  var r = confirm("Are You Sure to go back to main page ?");
        if (r == true) {
      <?php if(in_array('P0120', USER_PRIV)){ ?>
     window.location.href = '../user/accounts/trips'
      <?php }else{ ?>
        window.history.back();
      <?php } ?>
  }}
</script>
<script type="text/javascript">
$(document.body).on('keydown keyup keypress mouseenter mouseleave mouseover mousemove', '.zero' ,function(){
      // if($(this).val().trim().length === 0){
      //   $(this).val(0);
      // }
      if($(this).val().trim() < 0){
        alert("Negative values dont allowed")
        $(this).val(0);
        cal_total_miles()
      }
    })
</script>
<script type="text/javascript">
$(document.body).on('change', '[name="driver_a_id"],[name="driver_b_id"]' ,function(){
     var driver_a=$('[name="driver_a_id"]').val();
     var driver_b=$('[name="driver_b_id"]').val();
     if(driver_a == driver_b){
       alert("Driver A and Driver B cannot be same ")
       $('[name="driver_a_id"]').val("")
       $('[name="driver_b_id"]').val("")
       $('#driver_a_details').text("")
       $('#driver_b_details').text("")
     }
    })
</script>


<script type="text/javascript">
  function show_truck_id_options(){
   get_trucks({truck_status_id_fk:1}).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.code+`</option>`;               
      })
      $('[name="truck_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_truck_id_options()
</script>


<script type="text/javascript">
  function show_drivers_a(){
   get_drivers({truck_status_id_fk:1}).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        if(item.status == 'Active'){
        options+=`<option value="`+item.id+`">`+item.code+' '+item.name+`</option>`;
        }               
      })
      $('[name="driver_a_id"]').html(options);                 
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_drivers_a()



function show_drivers_b(){
 get_drivers({truck_status_id_fk:1}).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        if(item.status == 'Active'){
        options+=`<option value="`+item.id+`">`+item.code+' '+item.name+`</option>`;     
        }          
      })    
      $('[name="driver_b_id"]').html(options);          
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_drivers_b()

</script>


<script type="text/javascript">
    ///----------show drivers section
    function show_driver_b(){

    //---------show driver b selection option
    $("[data-driver-b-option]").show();
    $("[data-driver-b-option]").html(`<label>Driver B</label>
      <select name="driver_b_id" required onchange=""></select>`);
    show_drivers_b();






    //--------show driver b payment section
    let driver_row=`<fieldset>
      <legend>Driver B</legend>
      <div class="field-section">

        <div class="field-p">
          <label>Name</label>
          <div id="driver_b_details"></div>
        </div>
        <div class="field-p">
          <label>Miles Driven</label>
          <input name="driver_b_miles" class="w-100" type="number" pattern="[0-9.-]{1,}" value="0" disabled>
        </div>
        <div class="field-p">
          <label>Basic Earnings</label>
          <input name="driver_b_basic_earning" class="w-100" type="number" pattern="[0-9.-]{1,}" value="0" disabled>
        </div>
        <div class="field-p">
          <label>Incentives</label>
          <input name="driver_b_incentive" class="w-100" type="number" value="0" disabled pattern="[0-9.-]{1,}">
        </div>
          <div class="field-p">
            <label>Remark</label>
            <textarea name="driver_b_remarks"></textarea>
          </div>                 
      </div>                      
    </fieldset>
    <br>
<fieldset>
        <legend>Driver B's Earning & Deductions</legend>
        <div class="field-section table-rows">

          <table style="width: 100%">
            <thead>
              <tr>
                <th>Parameter Type</th>
                <th>Amount</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody id="salary_parameter_driver_b">

            </tbody>
            <tfoot>
             <tr><td colspan="8"><button type="button" class="btn_blue" onclick="add_salary_parameter_driver_b()">Add</button></td></tr>
           </tfoot>
         </table>



       </div>                  
     </fieldset>
    `;
    $('[driver-b-payment-section]').append(driver_row);   
  }

  function hide_driver_b(){
      //---------hide driver b selection option
      $("[data-driver-b-option]").html("");
      //--------hide driver b payment section
      $("#driver_b_row").remove();
      $('[driver-b-payment-section]').html("");

    }
  </script>







  <script type="text/javascript">
    var driver_group_id="Solo"
    $(document.body).on('change', '[name="driver_group_id"]' ,function(){
      var val = ($("[name='driver_group_id']").val());
      if(val == ""){
        $('[name="ppm_plan_id"]').val('')
        $('[name="ppm_plan_id"]').html('')
        $('[name="ppm_plan_id"]').prop('disabled',true)
      }
      else{
        $('[name="ppm_plan_id"]').prop('disabled',false)
      show_ppm_plans({driver_group_id:$(this).val()})

      if($("[name='driver_group_id'] :selected").text()=='Team'){

        driver_group_id="Team"
        show_driver_b();
      }else{

        driver_group_id="Solo";
        hide_driver_b();
      }
      cal_drivers_earnings()
    }
    });

    $(document.body).on('change', '[name="ppm_plan_id"]' ,function(){
      $('[name="pay_per_mile"]').val($(this).find(':selected').data('ppm'));
      $('[name="incentive_rate"]').val($(this).find(':selected').data('incentive-per-mile'));
      cal_drivers_earnings()
    })




//---change the names of drivers in payment section when a selection is changed
$(document.body).on('change', '[name="driver_a_id"]' ,function(){
  $('#driver_a_details').html($("[name='driver_a_id'] :selected").text())
});
$(document.body).on('change', '[name="driver_b_id"]' ,function(){
  $('#driver_b_details').html($("[name='driver_b_id'] :selected").text())
});
</script>


<script type="text/javascript">
 ///-----------Calculate Miles

 function  cal_total_miles(argument) {
  var $milse_rows = $('[name="stop_miles"]');
  var $pay_per_mile = $('[name="pay_per_mile"]').val();
  var total_miles=0;
  $milse_rows.each(function (index) {
   this_mile=parseFloat($(this).val());
   total_miles += isNaN(this_mile) ? 0 : this_mile;
 })
  $('[name="total_miles"]').val(total_miles)
  cal_drivers_earnings()
}
  ///------------//Calculate Miles



  ///-----------Calculate driver earnings

  function  cal_drivers_earnings() {
    var base_price = parseFloat($('[name="pay_per_mile"]').val());
    var total_miles = parseFloat($('[name="total_miles"]').val());
    var incentive_rate = parseFloat($('[name="incentive_rate"]').val());

    base_price = isNaN(base_price) ? 0 : base_price;
    total_miles = isNaN(total_miles) ? 0 : total_miles;
    incentive_rate = isNaN(total_miles) ? 0 : incentive_rate;
    
    //---get reimbursement and deductions of driver a

    if(driver_group_id=="Solo"){
      $('[name="driver_a_miles"]').val(total_miles)      
      $('[name="driver_a_basic_earning"]').val(parseFloat(base_price*total_miles).toFixed(2))         
      $('[name="driver_a_incentive"]').val(parseFloat(incentive_rate*total_miles).toFixed(2))      
    }
    if(driver_group_id=="Team"){
      var distributed_miles=total_miles/2
      var distributed_basic_earnings=total_miles*base_price/2
      var distributed_incentive=total_miles*incentive_rate/2

          //---get reimbursement and deductions of driver b

          $('[name="driver_a_miles"]').val(distributed_miles)            
          $('[name="driver_a_basic_earning"]').val(parseFloat(distributed_basic_earnings).toFixed(2))
          $('[name="driver_a_incentive"]').val(parseFloat(distributed_incentive).toFixed(2))       
          
          $('[name="driver_b_miles"]').val(distributed_miles)       
          $('[name="driver_b_basic_earning"]').val(parseFloat(distributed_basic_earnings).toFixed(2))
          $('[name="driver_b_incentive"]').val(parseFloat(distributed_incentive).toFixed(2))       
        }
      }
  ///------------//Calculate driver earnings
</script>
<script type="text/javascript">

  ///-----------Add new stop

  var counter=0
  var $stops_table = $('#stops_table');
  function add_stop(){
    ++counter;
    var $stop_row=`<tr id="stop_row${counter}"  data-stop-row>
    <td class="counter">Stop ${counter}</td>
    <td><input class="w-100" type="text" name="stop_date" data-date-picker="" required></td>
    <td><select class="w-150" name="stop_type_id" required></select></td>
    <td><select class="w-150" name="stop_state_id" required></select></td>
    <td><select class="w-150" name="stop_location_id" required></select> <i data-location-refresh class="fas fa-sync-alt" title="Refresh Cities List"></i>  <i data-add-city class="fa fa-plus" title="Add City"></i></td>
    <td><input class="w-100 zero" type="number" value="" min="1" name="stop_miles" onkeyup="cal_total_miles()" onchange="cal_total_miles()" required></td>
    <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>
    </tr>`;
    $('#end_row').before($stop_row);
    $( "[data-date-picker]" ).datepicker();
    show_stop_types('stop_row'+counter)
    //show_stop_locations({},'stop_row'+counter)
    show_stop_states({},'stop_row'+counter)
  }
  ///-----------//Add new stop



  ///-----------remove stop

  $(document.body).on('click', '[data-remove-stop-button=""]' ,function(){
    $(this).parent().parent().remove();
    counter = 0;
    $('.counter').each(function(index,item){
      counter= counter+1;
   $(this).html("Stop"+counter)
    })
    cal_total_miles()
  });
  ///-----------/revmove stop

</script>


<script type="text/javascript">
    ///-----------Add new stop
    var counter_driver_a_salary_parameter=0
    var $driver_a_salry_parameter = $('#driver_a_salry_parameter');
    function add_salary_parameter_driver_a(){
      ++counter_driver_a_salary_parameter;
      let row=`<tr id="salary_parameter_driver_a${counter_driver_a_salary_parameter}">
      <td><select style="width: 150px" name="parameter_id" required></select></td>
      <td><input style="width: 150px" type="text" pattern="[0-9.-]{1,}" name="parameter_amount" value="0" required></td>
      <td><input style="width: 150px" type="text" name="parameter_remarks" value=""></td>
      <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>
      </tr>`;
      $('#salary_parameter_driver_a').append(row)
      show_salary_parameters('salary_parameter_driver_a'+counter_driver_a_salary_parameter)
  }
  ///-----------//Add new stop
</script>

<script type="text/javascript">
    var counter_driver_b_salary_parameter=0
    var $driver_b_salry_parameter = $('#driver_b_salry_parameter');
    function add_salary_parameter_driver_b(){
      ++counter_driver_b_salary_parameter;
      let row=`<tr id="salary_parameter_driver_b${counter_driver_b_salary_parameter}">
      <td><select style="width: 150px" name="parameter_id" required></select></td>
      <td><input style="width: 150px" type="text" pattern="[0-9.-]{1,}" name="parameter_amount" value="0" required></td>
      <td><input style="width: 150px" type="text" name="parameter_remarks" value=""></td>
      <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>
      </tr>`;
      $('#salary_parameter_driver_b').append(row)
      show_salary_parameters('salary_parameter_driver_b'+counter_driver_b_salary_parameter)
    //show_stop_locations({},'stop_row'+counter)
  }

</script>









<script type="text/javascript">
  function add_new(){
    show_processing_modal()
    //submit_to_wait_btn('#submit','loading')
    $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    var formData=new FormData(currentForm);
    if(isValidForm){
      var arr=$('#MyForm').serializeArray();
      
      var $data_stop_rows = $("[data-stop-row]");
      data_stop_array=[]
      
      $data_stop_rows.each(function (index) {
        var $data_stop_row = $(this);
        var stop_row={
          stop_date : $data_stop_row.find("[name=stop_date]").val(),
          stop_type_id : $data_stop_row.find("[name=stop_type_id]").val(),
          stop_location_id : $data_stop_row.find("[name=stop_location_id]").val(),
          stop_mile : $data_stop_row.find("[name=stop_miles]").val()
        }
        data_stop_array.push(stop_row)
      })



///---------get driver a payment details
      var driver_a_salry_parameter_array=[];
      $('#salary_parameter_driver_a tr').each(function (index) {
      let row={
          parameter_id :$(this).find("[name=parameter_id]").val(),
          parameter_amount : $(this).find("[name=parameter_amount]").val(),
          parameter_remarks : $(this).find("[name=parameter_remarks]").val(),
        }
        driver_a_salry_parameter_array.push(row)
      })

      driver_a={
        id:$('[name="driver_a_id"]').val(),
        remarks:$('[name="driver_a_remarks"]').val(),
        salary_parameters:driver_a_salry_parameter_array
      }

///---------/get driver a payment details

      if(driver_group_id=="Team"){

      var driver_b_salry_parameter_array=[];
      $('#salary_parameter_driver_b tr').each(function (index) {
      let row={
          parameter_id :$(this).find("[name=parameter_id]").val(),
          parameter_amount : $(this).find("[name=parameter_amount]").val(),
          parameter_remarks : $(this).find("[name=parameter_remarks]").val(),
        }
        driver_b_salry_parameter_array.push(row)
      })

      driver_b={
        id:$('[name="driver_b_id"]').val(),
        remarks:$('[name="driver_b_remarks"]').val(),
        salary_parameters:driver_b_salry_parameter_array
      }

      }else{
        driver_b="";
      }

      var obj={
        truck_id:$('[name="truck_id"]').val(),
        driver_group_id:$('[name="driver_group_id"]').val(),
        ppm_plan_id:$('[name="ppm_plan_id"]').val(),
        pay_per_mile:$('[name="pay_per_mile"]').val(),
        incentive_rate:$('[name="incentive_rate"]').val(),
        driver_a:driver_a,
        driver_b:driver_b,
        stops:data_stop_array
      }
      $.ajax({
        url:window.location.href+'-action',
        type:'POST',
        data: obj,
        success:function(data){
          // alert(data)
         // console.log(data)
          if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         alert(data.message);
         if(data.status){
         location.href='user/accounts/trips/details?eid='+data.response.new_eid;
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
  function show_stop_types(row_id){
   get_trip_stop_types().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('tr#'+row_id+' [name="stop_type_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_stop_types('start_row')
show_stop_types('end_row')
</script>



<script type="text/javascript">
  function show_salary_parameters(row_id){
   get_salary_parameters().then(function(data) {
  // Run this when your request was successful\
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('tr#'+row_id+' [name="parameter_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_salary_parameters();
</script>

<script type="text/javascript">
function show_stop_states(param,row_id){
 get_states(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('tr#'+row_id+' [name="stop_state_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}

    $(document.body).on('change', '[name="stop_state_id"]' ,function(){
      let row_id=$(this).parents('tr').attr('id')
      show_stop_locations({state_id:$(this).val()},row_id)
    // driver_id_selected=$(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    // if(driver_id_selected!=undefined){
    //   $(this).data('selected-driver-id',driver_id_selected)
    // }
  });
</script>


<script type="text/javascript">
  function show_stop_locations(param,row_id){
    $('tr#'+row_id+' [name="stop_location_id"]').html(``)
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
      $('tr#'+row_id+' [name="stop_location_id"]').html(options);

    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
//show_stop_locations({},'start_row');
show_stop_states({},'start_row');
//show_stop_locations({},'end_row');
show_stop_states({},'end_row');



$(document).on("click", "[data-location-refresh]" , function() {

  let row_id=$(this).parents('tr').attr('id')
//---check the state id selected for this row
let state_id=$(this).parents('tr').find('[name="stop_state_id"]').val();
//--if a state id is selected than show cities belongs to this this
if(state_id!=''){
  show_stop_locations({state_id:state_id},row_id)
}

});


$(document).on("click", "[data-add-city]" , function() {
open_child_window({url:'../user/masters/locations/cities/quick-add-new',name:'AddCity',width:500,height:500})
});
</script>





<script type="text/javascript">
  function show_driver_groups(param){

   get_driver_groups(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    $('[name="driver_group_id"]').html(`<option value="">- - Select - -</option>`)
    if(data.response.list){
      $.each(data.response.list, function(index, item) {
        $('[name="driver_group_id"]').append(`<option value="`+item.id+`">`+item.name+`</option>`);               
      })

    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_driver_groups()
</script>
<script type="text/javascript">
  function show_ppm_plans(param){

   get_driver_ppm_plans(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    $('[name="ppm_plan_id"]').html(`<option value="">- - Select - -</option>`)
    if(data.response.list){
      $.each(data.response.list, function(index, item) {
        $('[name="ppm_plan_id"]').append(`<option data-incentive-per-mile="${item.incentive_per_mile}" data-ppm="`+item.ppm+`" value="`+item.id+`">`+item.name+`</option>`);               
      })

    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
</script>
<script type="text/javascript">
  setInterval(hide_processing_modal, 1000)
</script>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>