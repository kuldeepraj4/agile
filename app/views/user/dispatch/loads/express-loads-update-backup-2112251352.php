<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
$details=$data['details'];
$shipper=$data['details']['shipper'];
$consignee=$data['details']['consignee'];
?>

<br><br>



<script type="text/javascript">

  show_processing_modal()

  function show_stop_locations(param,row_id){

   get_cities(param).then(function(data) {

  // Run this when your request was successful

  if(data.status){

    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option value="`+item.id+`">`+item.name+`, `+item.state_mini_code+`</option>`;               

      })

      $('tr#'+row_id+' [name="stop_location_id"]').html(options);

      $(`tr#`+row_id+` [name="stop_location_id"] option[value="${param.default_select}"]`).prop(`selected`,true);

      



    }

  }

}).catch(function(err) {

  // Run this when promise was rejected via reject()

}) 

}

</script>

<style type="text/css">

  [data-location-refresh]{

    color: grey;

    font-size: .9em;

  }

</style>

<section class="lg-form-outer">

  <div class="lg-form-header">UPDATE EXPRESS LOAD <?php echo $details['id'] ?></div>

  <form class="lg-form" method="POST" id="MyForm" onsubmit="return update()">

    <section class="section-1" style="max-width: 900px;">

      <input type="hidden" name="update_eid" value="<?php echo $details['eid'];?>">

      <div>

        <fieldset>

          <legend>Primary Detials</legend> 

          <div class="field-section single-column">

            <div class="field-p">

              <label>Customer</label>

              <input type="hidden" name="customer_id" value="<?php echo $details['customer_id'] ?>" required><br>

              <input type="text" value="<?php echo $details['customer_code'].' - '.$details['customer_name'] ?>" list="quick_list_customers" name="customer_id_search" required>

            </div>

            <div class="field-p">

              <label>PO Number</label>

              <input type="text" name="po_number" value="<?php echo $details['po_number'] ?>" onchange="validate_po(this.value)" required>

            </div>



            <div class="field-p">

              <label>Trailer Type</label>

              <select name="trailer_type" data-default-select="<?php echo $details['trailer_type']  ?>" required>

                <option value="">- - Select - -</option>

                <option value="REEFER">Reefer</option>

                <option value="Van">Van</option>
                <option value="VAN/REEFER">Van/Reefer</option>

              </select>

            </div>



            <?php

            if($details['trailer_type']=='REEFER'){

              ?>

              <div class="field-p" data-temperature-option>

                <label>Temperature to maintain ( in <span>&#8457;</span> )</label>
                <div>
                  <input type="text" class="w-150" name="temperature_to_maintain" value="<?php echo $details['temperature_to_maintain']; ?>" pattern="[0-9.-]{1,}"> 
                  <select  class="w-150" name="reefer_mode" data-default-select="<?php echo $details['reefer_mode']; ?>">
                    <option value="START/STOP">START/STOP</option>
                    <option value="CONTINUOUS">CONTINUOUS</option>
                  </select></div>
                </div>

                <?php  

              }else{

                ?>

                <div class="field-p" data-temperature-option style="display:none;"></div>

                <?php

              }

              ?>





              <div class="field-p">

                <label>Rate (in USD)</label>

                <input type="text" name="rate" value="<?php echo $details['rate'] ?>" pattern="[0-9.-]{1,}" required>

              </div>

            </div>

          </fieldset>

        </div>



      </section>





      <section class="section-1" style="width:1100px;">

        <div>

          <fieldset>

            <legend>Stops</legend>

            <div class="field-section table-rows">

              <table style="width: 100%">

                <thead>

                  <tr>

                    <th></th>

                    <th>Stop Type</th>

                    <th>Appointment Type</th>

                    <th>City</th>

                    <th style="white-space: nowrap;">Date</th>

                    <th>Time</th>

                    <th>TBD*</th>

                    <th></th>



                  </tr>

                </thead>

                <tbody id="stops_table">

                  <tr id="shipper_row" data-stop-row data-stop-category="SHIPPER">

                    <td>Shipper</td>

                    <td><select class="w-100" name="stop_type"  required disabled>
                      <option value="PICK" selected>PICK</option>
                    </select>

                  </td>

                  <td><select class="w-100" name="appointment_type" data-default-select="<?php echo $shipper['appointment_type'] ?>" required>

                    <option value="">- Select -</option>

                    <option value="FCFS">FCFS</option>

                    <option value="FIRM">FIRM</option>

                  </select>

                </td>

                <td><select class="w-150" name="stop_location_id" data-default-select="<?php echo $shipper['location_id'] ?>" required></select> <i data-location-refresh class="fas fa-sync-alt"></i></td>

                <td><input class="w-100" type="text" name="stop_date" value="<?php echo $shipper['date'];  ?>" data-date-picker="" required></td>

                <td>
                  <input class="w-100" type="text" data-time-picker style="width:60px" name="stop_time_from" value="<?php echo $shipper['time_from'];  ?>" required> &nbsp <input class="w-100" type="text" data-time-picker style="width:60px" value="<?php echo $shipper['time_to'];  ?>" name="stop_time_to" required>
                </td>

                <td> <input  type="checkbox" name="stop_datetime_tbd" <?php if($shipper['datetime_tbd']=='YES'){echo "checked";} ?>></td>

                <td></td>

              </tr>
              <script type="text/javascript">

                show_stop_locations({default_select:'<?php echo $shipper['location_id']; ?>'},'shipper_row');

              </script>

              <?php

              $count=0;

              $total_stops=count($details['stops']);

              foreach ($details['stops'] as $stop) {

                $count++;
                $row_id='stop_row'.$count;
                $row_name='Stop '.$count;
                ?>



                <tr id="<?php echo $row_id; ?>" data-stop-row data-stop-category="STOP">

                  <td><?php echo $row_name; ?></td>

                  <td><select class="w-100" name="stop_type" data-default-select="<?php echo $stop['stop_type'];  ?>" required>

                    <option value="">- Select -  </option>

                    <option value="PICK">PICK</option>

                    <option value="DROP">DROP</option>

                  </select>

                </td>

                <td><select class="w-100" name="appointment_type" data-default-select="<?php echo $stop['appointment_type'];  ?>" required>

                  <option value="">- Select -</option>

                  <option value="FCFS">FCFS</option>

                  <option value="FIRM">FIRM</option>

                </select>

              </td>

              <td>

                <select class="w-150" name="stop_location_id" data-default-select="<?php echo $stop['location_id'];  ?>"  required></select><i data-location-refresh class="fas fa-sync-alt"></i>

              </td>

              <td>

                <input class="w-100" type="text" name="stop_date" value="<?php echo $stop['date'];  ?>" data-date-picker="" required>

              </td>

              <td>

                <input class="w-100" type="text" data-time-picker style="width:60px" value="<?php echo $stop['time_from'];  ?>" name="stop_time_from" required> &nbsp
                <input class="w-100" type="text" data-time-picker style="width:60px" value="<?php echo $stop['time_to'];  ?>" name="stop_time_to" required>

              </td>

              <td>

                <input  type="checkbox" name="stop_datetime_tbd" <?php if($stop['datetime_tbd']=='YES'){echo "checked";} ?>>

              </td>

              <td></td>

            </tr>

            <script type="text/javascript">

              show_stop_locations({default_select:'<?php echo $stop['location_id']; ?>'},'<?php echo $row_id; ?>');

            </script>

            <?php
          }
          ?>
          <tr id="consignee_row" data-stop-row data-stop-category="CONSIGNEE">

            <td>Consignee</td>

            <td><select class="w-100" name="stop_type"  required disabled>
              <option value="DROP" selected>DROP</option>
            </select>

          </td>

          <td><select class="w-100" name="appointment_type" data-default-select="<?php echo $consignee['appointment_type'] ?>" required>

            <option value="">- Select -</option>

            <option value="FCFS">FCFS</option>

            <option value="FIRM">FIRM</option>

          </select>

        </td>

        <td><select class="w-150" name="stop_location_id" data-default-select="<?php echo $consignee['location_id'] ?>" required></select> <i data-location-refresh class="fas fa-sync-alt"></i></td>

        <td><input class="w-100" type="text" name="stop_date" value="<?php echo $consignee['date'];  ?>" data-date-picker="" required></td>

        <td>
          <input class="w-100" type="text" data-time-picker style="width:60px" name="stop_time_from" value="<?php echo $consignee['time_from'];  ?>" required> &nbsp <input class="w-100" type="text" data-time-picker style="width:60px" value="<?php echo $consignee['time_to'];  ?>" name="stop_time_to" required>
        </td>

        <td> <input  type="checkbox" name="stop_datetime_tbd" <?php if($consignee['datetime_tbd']=='YES'){echo "checked";} ?>></td>

        <td></td>

      </tr>
      <script type="text/javascript">

        show_stop_locations({default_select:'<?php echo $consignee['location_id']; ?>'},'consignee_row');

      </script>
    </tbody>

    <tfoot>

     <tr>

      <td colspan="6" style="text-align: left;">

        <br>

        *Mark the check box under TBD (To Be Done) if appointment date/time are not available

      </td>

      <td colspan="2">

        <button type="button" class="btn_blue" onclick="add_stop()">Add Stop</button>

      </td>

    </tr>

  </tfoot>

</table>

</div>                  

</fieldset>

</div>

</section>







<section class="lg-form-action-button-box">

  <button type="submit" id="submit" class="btn_green">SAVE</button>

</section>

</form>

</section>

<datalist id="quick_list_customers"></datalist>

<script type="text/javascript">

  $(document.body).on('change', '[name="customer_id_search"]' ,function(){

    customer_id_selected=$(`[data-customer-filter-rows="${$(this).val()}"]`).data('value');

    if(customer_id_selected!=undefined){

      $('[name="customer_id"]').val(customer_id_selected)

    }

  });





  function show_quick_list_customers(){

   quick_list_customers().then(function(data) {

  // Run this when your request was successful

  if(data.status){



    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option data-customer-filter-rows="" data-value="" value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option data-customer-filter-rows="`+item.code+' '+item.name+`" data-value="${item.id}" value="`+item.code+' '+item.name+`"></option>`;               

      })

      $('#quick_list_customers').html(options);     

    }

  }

}).catch(function(err) {

  // Run this when promise was rejected via reject()

}) 

}

show_quick_list_customers()

</script>





<script type="text/javascript">

      //-------- hide/show temperature to maintain option based on the trailer type selection

      $(document.body).on('change', '[name="trailer_type"]' ,function(){

        if($(this).val()=='REEFER'){

          $('[data-temperature-option]').show();

          $('[data-temperature-option]').html(`<label>Temperature to maintain ( in <span>&#8457;</span> )</label>

            <div>
            <input type="text" class="w-150" name="temperature_to_maintain" pattern="[0-9.-]{1,}"> 
            <select  class="w-150" name="reefer_mode">
            <option value="CONTINUOUS" selected>CONTINUOUS</option>
            <option value="START/STOP">START/STOP</option>
            </select></div>`);



        }else{

          $('[data-temperature-option]').hide();

        }

      });

      //--------/ hide/show temperature to maintain option based on the trailer type selection

    </script>



    <script type="text/javascript">

      //-------- add/remove required attribute based on TBD check box 

      $(document.body).on('change', '[name="stop_datetime_tbd"]' ,function(){

        if($(this).prop("checked") == true){

          //$(this).parent().siblings().children('[name="stop_date"]').removeAttr('required')

          $(this).parent().siblings().children('[name="stop_time_from"]').removeAttr('required')
          $(this).parent().siblings().children('[name="stop_time_from"]').prop('disabled',true)
          $(this).parent().siblings().children('[name="stop_time_from"]').val('')

          $(this).parent().siblings().children('[name="stop_time_to"]').removeAttr('required')
          $(this).parent().siblings().children('[name="stop_time_to"]').prop('disabled',true)
          $(this).parent().siblings().children('[name="stop_time_to"]').val('')

        }

        else if($(this).prop("checked") == false){

          //$(this).parent().siblings().children('[name="stop_date"]').attr('required',true)

          $(this).parent().siblings().children('[name="stop_time_from"]').attr('required',true)
          $(this).parent().siblings().children('[name="stop_time_from"]').prop('disabled',false)
          $(this).parent().siblings().children('[name="stop_time_to"]').attr('required',true)
          $(this).parent().siblings().children('[name="stop_time_to"]').prop('disabled',false)

        }

      });

      //--------/ add/remove required attribute based on TBD check box 

    </script>



    <script type="text/javascript">

  /*function show_customer_id_options(){

   quick_list_customers().then(function(data) {

  // Run this when your request was successful

  if(data.status){

    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option value="${item.eid}">${item.eid} - ${item.customer_name}</option>`;               

      })

      $('[name="customer_id"]').html(options);     

    }

  }

}).catch(function(err) {

  // Run this when promise was rejected via reject()

}) 

}

show_customer_id_options()*/

</script>
<script type="text/javascript">



  ///-----------Add new stop


  var counter=0

  var $stops_table = $('#stops_table');

  function add_stop(){

    var $stop_row=`<tr id="stop_row${++counter}"  data-stop-row  data-stop-category="STOP">

    <td>Stop </td>

    <td><select class="w-100" name="stop_type" required>

    <option value="">- Select -  </option>

    <option value="PICK">PICK</option>

    <option value="DROP">DROP</option>

    </select>

    </td>

    <td><select class="w-100" name="appointment_type" required>

    <option value="">- Select -</option>

    <option value="FCFS">FCFS</option>

    <option value="FIRM">FIRM</option>

    </select>

    </td>

    <td><select class="w-150" name="stop_location_id" required></select> <i data-location-refresh class="fas fa-sync-alt"></i></td>

    <td><input class="w-100" type="text" name="stop_date" data-date-picker="" required></td>

    <td><input class="w-100" type="text" data-time-picker style="width:60px" name="stop_time_from" required>&nbsp <input class="w-100" type="text" data-time-picker style="width:60px" name="stop_time_to" required></td>

    <td><input  type="checkbox" name="stop_datetime_tbd"></td>      

    <td><button type="button" class="btn_red_c" data-remove-stop-button><i class="fa fa-trash"></i></button></td>

    </tr>`;

    $('#consignee_row').before($stop_row);

    $( "[data-date-picker]" ).datepicker();

    show_stop_locations({},'stop_row'+counter)

  }

  ///-----------//Add new stop

  ///-----------remove stop



  $(document.body).on('click', '[data-remove-stop-button]' ,function(){

    $(this).parent().parent().remove();

    cal_total_miles()

  });

  ///-----------/revmove stop

</script>



<script type="text/javascript">
 var allow_duplicate_po_number=false;
 function update(){
    //show_processing_modal()
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
        var stop_datetime_tbd='NO';
        if($(this).find("[name=stop_datetime_tbd]").prop("checked") == true){
          stop_datetime_tbd='YES';
        }
        var stop_row={
          stop_category:$data_stop_row.data('stop-category'),
          stop_type : $data_stop_row.find("[name=stop_type]").val(),
          appointment_type : $data_stop_row.find("[name=appointment_type]").val(),
          stop_location_id : $data_stop_row.find("[name=stop_location_id]").val(),
          stop_date : $data_stop_row.find("[name=stop_date]").val(),
          stop_time_from : $data_stop_row.find("[name=stop_time_from]").val(),
          stop_time_to : $data_stop_row.find("[name=stop_time_to]").val(),
          stop_datetime_tbd : stop_datetime_tbd
        }
        data_stop_array.push(stop_row)
      })

      var temperature_to_maintain='';
      var reefer_mode='';

      if($("[name='trailer_type']").val()=='REEFER'){

        temperature_to_maintain=$('[name="temperature_to_maintain"]').val()
        reefer_mode=$('[name="reefer_mode"]').val()

      }

      var obj={
        update_eid:$('[name="update_eid"]').val(),
        customer_id:$('[name="customer_id"]').val(),

        po_number:$('[name="po_number"]').val(),

        trailer_type:$('[name="trailer_type"]').val(),

        rate:$('[name="rate"]').val(),
        booked_by_id:$('[name="booked_by_id"]').val(),

        temperature_to_maintain:temperature_to_maintain,
        reefer_mode:reefer_mode,

        stops:data_stop_array,
        allow_duplicate_po_number:allow_duplicate_po_number

      }
      $.ajax({

        url:window.location.pathname+'-action',

        type:'POST',

        data: obj,

        success:function(data){
          if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         if(data.status){
           window.opener.show_group_list()
           window.opener.show_list()
           window.close();
         }else{

          if(data.message=="CONFIRM"){
            switch(data.confirm){
              case 'ALLOW DUPLICATE PO NUMBER':
              let conf = confirm(data.confirm_message);
              if(conf==true){
                allow_duplicate_po_number=true;
                update()
              }
              break;
            }
          }else{
            alert(data.message)
          }
        }

        hide_processing_modal()

      }

    })

    }

    return false

  }

</script>

<script type="text/javascript">

/*
 var allow_duplicate_po_number=false;


 function update(){

    //show_processing_modal()

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



        var stop_datetime_tbd='NO';

        if($(this).find("[name=stop_datetime_tbd]").prop("checked") == true){

          stop_datetime_tbd='YES'

        }





        var stop_row={
          stop_category:$data_stop_row.data('stop-category'),
          stop_type : $data_stop_row.find("[name=stop_type]").val(),
          appointment_type : $data_stop_row.find("[name=appointment_type]").val(),
          stop_location_id : $data_stop_row.find("[name=stop_location_id]").val(),
          stop_date : $data_stop_row.find("[name=stop_date]").val(),
          stop_time_from : $data_stop_row.find("[name=stop_time_from]").val(),
          stop_time_to : $data_stop_row.find("[name=stop_time_to]").val(),
          stop_datetime_tbd : stop_datetime_tbd
        }

        data_stop_array.push(stop_row)

      })

      var temperature_to_maintain='';
      var reefer_mode=''
      if($("[name='trailer_type'] :selected").text()=='REEFER'){

        temperature_to_maintain=$('[name="temperature_to_maintain"]').val()
        reefer_mode=$('[name="reefer_mode"]').val()
      }

      var obj={

        update_eid:$('[name="update_eid"]').val(),

        customer_id:$('[name="customer_id"]').val(),

        po_number:$('[name="po_number"]').val(),

        trailer_type:$('[name="trailer_type"]').val(),

        rate:$('[name="rate"]').val(),

        temperature_to_maintain:temperature_to_maintain,
        reefer_mode:reefer_mode,
        stops:data_stop_array,
        allow_duplicate_po_number:allow_duplicate_po_number
      }

      $.ajax({

        url:window.location.pathname+'-action',

        type:'POST',

        data: obj,

        success:function(data){
          console.log(data)
          if((typeof data)=='string'){

           data=JSON.parse(data) 
           console.log(data)
         }

         if(data.status){
           window.opener.show_list()
           window.close();
         }else{


          if(data.message=="CONFIRM"){
            switch(data.confirm){
              case 'ALLOW DUPLICATE PO NUMBER':
              let conf = confirm(data.confirm_message);
              if(conf==true){
                allow_duplicate_po_number=true;
                update()
              }
              break;
            }
          }

        }

        hide_processing_modal()

      }

    })

    }

    return false

  }
  */
</script>

<script type="text/javascript">









  $(document).on("click", "[data-location-refresh]" , function() {

    let row_id=$(this).parent().parent().attr('id')

    show_stop_locations({},row_id)

  });



</script>

<script type="text/javascript">

  hide_processing_modal()

  //setInterval(hide_processing_modal, 1000)

</script>


<script type="text/javascript">
  function validate_po(value){
    show_processing_modal()
      $.ajax({
        url:"<?php echo AJAXROOT.'/user/dispatch/express-loads/validate-po-action' ?>",
        type:'POST',
        data: {
          po:value,
          exclude_id:"<?php echo $details['id']?>"
        },
        success:function(data){
         if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         
         if(!data.status){
          alert(data.message);
        }
        hide_processing_modal()
      }
    })
  }
</script>


<?php

require_once APPROOT.'/views/includes/user/footer.php';

?>