<?php
require_once APPROOT.'/views/includes/user/header.php';
  $list=$data['list'];
?>
<br><br>
<section class="lg-form-outer">
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return update()">
<input type="hidden" name="driver_eid" value="<?php echo $data['details']['driver_eid']; ?>">
<input type="hidden" name="trip_eid" value="<?php echo $data['details']['trip_eid']; ?>">

    <section class="section-1" style="max-width: 700px;">
    <div>
      <fieldset>
        <legend>UPDATE SALARY PARAMETERS</legend>
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

<section class="lg-form-action-button-box">
  <button title="Go to trip" class="button_href btn_blue" type="button"><a href="../user/accounts/trips/details?eid=<?php echo $data['details']['trip_eid']; ?>"><i class="fa fa-arrow-left"></i> Back to trip</a></button>
  <button type="submit" id="submit" class="btn_green">SAVE</button>
</section>
</form></section>
<script type="text/javascript">



  var tr_counter=0


 function show_salary_parameters(row_id,hasValue){
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
      $('tr#'+row_id+' [name="parameter_id"] option[value="'+hasValue+'"]').prop('selected',true);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}





var list='<?php echo json_encode($list) ?>';
list=JSON.parse(list);
$.each(list, function(index, item) {
  ++tr_counter;
      let row=`<tr id="counter${tr_counter}">
      <td><select style="width: 250px" data-eid="${item.trip_salary_parameter_eid}" name="parameter_id" required></select></td>
      <td><input type="text" pattern="[0-9.-]{1,}" name="parameter_amount" value="${item.amount}" required></td>
      <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>
      </tr>`;
      $('#salary_parameters').append(row)
      show_salary_parameters('counter'+tr_counter,item.parameter_id);
})

 $('#add-parameter').click(function(){
      ++tr_counter;
      let row=`<tr id="counter${tr_counter}">
      <td><select style="width: 250px" data-eid="" name="parameter_id" required></select></td>
      <td><input type="text" pattern="[0-9.-]{1,}" name="parameter_amount" value="0" required></td>
      <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>
      </tr>`;
      $('#salary_parameters').append(row)
      show_salary_parameters('counter'+tr_counter,'')
 });

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




///---------get driver a payment details
      var parameters=[];
      $('#salary_parameters tr').each(function (index) {
      let row={
          trip_salary_parameter_eid :$(this).find("[name=parameter_id]").data('eid'),
          parameter_id :$(this).find("[name=parameter_id]").val(),
          parameter_amount : $(this).find("[name=parameter_amount]").val(),
        }
        parameters.push(row)
      })


///---------/get driver a payment details


      var obj={
        trip_eid:$('[name="trip_eid"]').val(),
        driver_eid:$('[name="driver_eid"]').val(),
        parameters:parameters
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
          location.href='user/accounts/trips/details?eid=<?php echo $details['trip_eid'] ?>';
          wait_to_submit_btn('#submit','UPDATE')
        }else{
          wait_to_submit_btn('#submit','UPDATE')
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
  });
  ///-----------/revmove stop
</script>



<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>