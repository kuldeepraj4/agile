<?php
require_once APPROOT.'/views/includes/user/header.php';
  $list=$data['list'];
?>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">UPDATE SALARY PARAMETERS TRIP <?php echo $details['id']; ?></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">


    <section class="section-1" style="max-width: 700px;">
    <div>
      <fieldset>
        <legend>Driver A's Earning & Deductions</legend>
        <div class="field-section table-rows">

          <table style="width: 100%">
            <thead>
              <tr>
                <th>Parameter Type</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody id="salary_parameters">
            </tbody>
            <tfoot>
             <tr><td colspan="8"><button type="button" class="btn_blue" id="add-parameter">Add</button></td></tr>
           </tfoot>
         </table>



       </div>                  
     </fieldset>
   </div>
</section>
<tr id="dumy">
<td><select style="width: 250px"  name="parameter_id" required>
  <option value="0">0</option>
  <option value="1">1</option>
</select>
</td></tr>
<section class="lg-form-action-button-box">
  <button type="submit" id="submit" class="btn_green">SAVE</button>
</section>
</form></section>
<script type="text/javascript">



  var tr_counter=0


 function show_salary_parameters(row_id){
   get_salary_parameters().then(function(data) {
  // Run this when your request was successful\
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="none">- - noe - -</option>`
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





var list='<?php echo json_encode($list) ?>';
list=JSON.parse(list);
console.log(list)
$.each(list, function(index, item) {
  ++tr_counter;
      let row=`<tr id="counter${tr_counter}">
      <td><select style="width: 250px" data-test="AKKKK" name="parameter_id" required></select></td>
      <td><input type="text" pattern="[0-9.-]{1,}" name="parameter_amount" value="${item.amount}" required></td>
      <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>
      </tr>`;
      $('#salary_parameters').append(row)
      show_salary_parameters('counter'+tr_counter);
      document.write('1')
})

      show_salary_parameters('dumy');

$('[name="parameter_id"]').each(function () {
document.write('2') 
 // var mydata = (this.checked ? $(this).val() : "");
  console.log($(this).data("test"));
  $('[name="parameter_id"] option[value="1"]').prop('selected',true); 
});

 $('#add-parameter').click(function(){
      ++tr_counter;
      let row=`<tr id="counter${tr_counter}">
      <td><select style="width: 250px" name="parameter_id" required></select></td>
      <td><input type="text" pattern="[0-9.-]{1,}" name="parameter_amount" value="0" required></td>
      <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>
      </tr>`;
      $('#salary_parameters').append(row)
      show_salary_parameters('counter'+tr_counter)
 });

</script>











<script type="text/javascript">
  function add_new(){
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
        }
        driver_a_salry_parameter_array.push(row)
      })

      driver_a={
        id:$('[name="driver_a_id"]').val(),
        //miles:$('[name="driver_a_miles"]').val(),
        //basic_earnings:$('[name="driver_a_basic_earning"]').val(),
        //incentive:$('[name="driver_a_incentive"]').val(),
        salary_parameters:driver_a_salry_parameter_array
      }

///---------/get driver a payment details

      if(driver_group_id=="Team"){

      var driver_b_salry_parameter_array=[];
      $('#salary_parameter_driver_b tr').each(function (index) {
      let row={
          parameter_id :$(this).find("[name=parameter_id]").val(),
          parameter_amount : $(this).find("[name=parameter_amount]").val(),
        }
        driver_b_salry_parameter_array.push(row)
      })

      driver_b={
        id:$('[name="driver_b_id"]').val(),
        //miles:$('[name="driver_a_miles"]').val(),
        //basic_earnings:$('[name="driver_a_basic_earning"]').val(),
        //incentive:$('[name="driver_a_incentive"]').val(),
        salary_parameters:driver_b_salry_parameter_array
      }

      }else{
        driver_b="";
      }

      var obj={
        truck_id:$('[name="truck_id"]').val(),
        driver_group_id:$('[name="driver_group_id"]').val(),
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
          if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         alert(data.message);
         if(data.status){
          location.href='../user/accounts/trips';
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

  ///-----------remove stop

  $(document.body).on('click', '[data-remove-stop-button=""]' ,function(){
    $(this).parent().parent().remove();
    cal_total_miles()
  });
  ///-----------/revmove stop
</script>



<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>