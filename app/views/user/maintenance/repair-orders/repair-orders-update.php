<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details'];
// echo "<pre>";
// print_r($details);
// echo "</pre>"; 
?>

<br>

<section class="lg-form-outer">

  <div class="lg-form-header">UPDATE REPAIR ORDER - <?php echo $details['id']; ?></div>
  <section class="lg-form" style="text-align:right;">
    <?php
  if (in_array('P0228', USER_PRIV)) {
  ?>
    <button class='btn_blue' onclick="location.href='../user/maintenance/repair-orders/details?eid=<?php echo $_GET['eid']; ?>'">View Repair Order</button>
  <?php
  }
  ?>
  </section>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">

   <section class="section-111" style="max-width: 1200px">     

    <div>

      <fieldset>

        <legend>Basic Details</legend>

        <div class="field-section single-column">

          <div class="field-p">

            <label>Class</label>

            <select name="order_class_id" data-default-select="<?php echo $details['class']; ?>"  id="checkclass" required="required" disabled="true"></select>

          </div>

          <div class="field-p">

            <label>Unit Type</label>

            <select name="unit_type_id" data-default-select="<?php echo $details['vehicle_type']; ?>" onchange="show_unit_filter({unit_type_id:this.value})" disabled="true"></select>

          </div>

          <div class="field-p">

            <label>Unit No</label>

            <select name="unit_id" data-default-select="<?php echo $details['vehicle_id']; ?>" disabled="true"></select>

          </div>

          <div class="field-p">

            <label>VIN No</label>

            <input name="order_vin_no" type="text" value="<?php echo $details['vehicle_vin_number']; ?>" disabled="true">

          </div>      

        </div>                  

      </fieldset>
    </div>
    
    <div>

      <fieldset>

        <legend> - - - </legend>

        <div class="field-section single-column">

          <div class="field-p">

            <label style="width: 24%!important;">Driver</label>

            <select style="width: 200px!important;" name="driver_id" data-default-select="<?php echo $details['driver_id']; ?>" type="text" required></select>

          </div>

          <div class="field-p">

            <label>Type</label>

            <select name="order_type_id" data-default-select="<?php echo $details['type_id']; ?>" required></select>

          </div>     

          <div class="field-p">

            <label>Stage</label>

            <select name="order_stage_id" id="order_stage_id" data-default-select="<?php echo $details['stage_id']; ?>" required></select>

          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend> Yard Name </legend>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Yard Name</label>
            <select class="removereq mode10" name="yard_id" type="text" data-default-select="<?php echo $details['ro_yard_id_fk'] ?>" style="text-overflow: ellipsis;overflow: hidden !important;max-width: 250px" required data-optional></select>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend> Vendor Detail </legend>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Vendor Name</label>
            <select class="removereq mode1"  name="vendor_id" type="text" data-default-select="<?php echo $details['ro_vendor_id_fk'] ?>" style="text-overflow: ellipsis;overflow: hidden !important;max-width: 250px" required data-optional></select>
          </div>
          <div class="field-p">
            <label>Vendor State</label>
            <select class="removereq mode2"  name="vendor_state_id" id="vendor_state_id"  data-default-select="<?php echo $details['ro_vendor_state_id_fk'] ?>" type="text" onchange="show_cities({state_id:this.value})" required data-optional></select>
          </div>
          <div class="field-p">
            <label>Vendor City</label>
            <select class="removereq mode3"  name="vendor_city_id" type="text" data-default-select="<?php echo $details['ro_vendor_city_id_fk'] ?>" required data-optional></select>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend> Start Date & Time </legend>
        <div class="field-section single-column">
          <div class="field-p">

            <label>Start Date</label>

            <input name="order_start_date" value="<?php echo $details['start_date']; ?>" placeholder="MM/DD/YYYY" start_date_from type="text" data-date-picker="" required>

          </div>

          <div class="field-p">

            <label>Start Time</label>

            <input name="order_start_time" value="<?php echo $details['start_time']; ?>" placeholder="HH:MM" data-time-picker type="text" required>

          </div>

        </div>                  

      </fieldset>
    </div>
    
    <div>

      <fieldset>

        <legend>Contact Information</legend>

        <div class="field-section single-column">

          <div class="field-p">

            <label>Contact Person</label>

            <input name="contact_person" value="<?php echo $details['contact_person']; ?>" type="text" >

          </div>     

          <div class="field-p">

            <label>Contact No</label>

            <input name="contact_no" value="<?php echo $details['contact_number']; ?>" type="text" pattern="[0-9][0-9]{9}" placeholder="1234567890">

          </div>

        </div>                  

      </fieldset>


      <fieldset>

        <legend>Link Reference Doc No</legend>

        <div class="field-section single-column">

          <div class="field-p">

            <label>Reference Type</label>

            <select name="reference_type" data-default-select="<?php echo $details['reference_name']; ?>" disabled>
             <option value="">- - Select - -</option>
             <option value="Inspection Sheet">Inspection Sheet</option>
           </select>

         </div> 

         <div class="field-p">

          <label>Reference ID</label>

          <input name="reference_id" value="<?php echo $details['reference_id']; ?>" type="text" disabled>

        </div>     

        <div class="field-p">

          <label>Row ID</label>

          <input name="reference_rowid" value="<?php echo $details['reference_rowid']; ?>" type="text" disabled>

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

              <th>Category</th>

              <th>Criticality Level</th>

              <th>Job Work</th>

              <th>Issue Reported</th>

              <th>Issue Description</th>

            </tr>

          </thead>

          <tbody id="issue_table">
          </tbody>

          <tfoot>

           <tr><td colspan="8"><button type="button" class="btn_blue" onclick="add_row({})">Add Row</button></td></tr>

         </tfoot>

       </table>

     </div>                  

   </fieldset>

 </div>

</section>

<section class="action-button-box">

  <button type="submit" class="btn_green">SAVE</button>
  &nbsp &nbsp<button type="button" class="btn_green" onclick="back_alret()">BACK</button>

</section>

</form>

</section>



<!-- <script>
  $(document.body).on('change', '[start_date_from]', function() {
    var d = new Date();
    var month = d.getMonth()+1;
var day = d.getDate();

var year = d.getFullYear();
var g1 =  month+ '/' +day+ '/' +year;
var g2 =  $(this).val();
var curr1 = new Date(g1);
var curr2 = new Date(g2);


    

  
    if (curr1.getTime() > curr2.getTime()) {
      alert("Please enter the valid date!. Date should not be less than current date")
      $('[start_date_from]').val("");
     
    }
  });

  
</script> -->

<script>
    // $(document).ready(function() {

    //   $(function() {
    //     $( "[data-date-picker]" ).datepicker({
    //          minDate: 0
    //     });
    //   });
    // })




    function back_alret(){
      if(confirm('Are you Sure ?')){
        window.history.back();
      }
    }
  </script>

  <script type="text/javascript">
    var yard_status = {
      yard_status: 1
    }
    get_maintenace_yard(yard_status).then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="` + item.id + `">` + item.name + `</option>`;
        })
        $('[name="yard_id"]').html(options);
        select_default('[name="yard_id"]');
      }
    }
  })
</script>

  <script type="text/javascript">
    var vendor_status = {
      vendor_status: 1
    }
    get_maintenace_vendors(vendor_status).then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="` + item.id + `">` + item.name + `</option>`;
        })
        $('[name="vendor_id"]').html(options);
        select_default('[name="vendor_id"]');
      }
    }
  })
</script>

<script type="text/javascript">
  get_states().then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="` + item.id + `">` + item.name + `</option>`;
        })
        $('[name="vendor_state_id"]').html(options);
        select_default('[name="vendor_state_id"]');
        show_cities({
          state_id: '<?php echo $details['ro_vendor_state_id_fk']; ?>'
        });
      }
    }
  })
</script>

<script type="text/javascript">
  function show_cities(param) {
    if (param.state_id === '') {
      $('[name="vendor_city_id"]').html('');
    } else if (param.state_id !== '') {
      get_cities(param).then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options += `<option value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options += `<option value="` + item.id + `">` + item.name + `</option>`;
            })
            $('[name="vendor_city_id"]').html(options);
            select_default('[name="vendor_city_id"]');
          }
        }
        else {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $('[name="vendor_city_id"]').html(options);
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    }
  }

  $(document).ready(function() {
    var stage_id = '<?php echo $details['stage_id']; ?>';
    if(stage_id == 1) {
      $(".removereq").prop('required', true)
      $('.mode1').val('').prop('disabled', false);
      $('.mode2').val('').prop('disabled', false);
      $('.mode3').val('').prop('disabled', false);
      $('.mode10').val('').prop('disabled', true);
    } else if(stage_id == 10) {
      $(".removereq").prop('required', false)
      $('.mode1').val('').prop('disabled', true);
      $('.mode2').val('').prop('disabled', true);
      $('.mode3').val('').prop('disabled', true);
      $('.mode10').val('').prop('disabled', false);
    } else {
     $(".removereq").prop('required', false)
     $('.mode1').prop('selectedIndex',0).prop('disabled', true);
     $('.mode2').val('').prop('disabled', true);
     $('.mode3').val('').prop('disabled', true);
     $('.mode10').val('').prop('disabled', true);
   }
 });

  $(document.body).on('change', '#order_stage_id' ,function() {
    $(".removereq").prop('required', false)
    $('.mode1').val('').prop('disabled', true);
    $('.mode2').val('').prop('disabled', true);
    $('.mode3').val('').prop('disabled', true);
    $('.mode10').val('').prop('disabled', true);
    var value = $(this).val();
    if (value === "1"){
      $(".removereq").prop('required', true)
      $('.mode1').val('').prop('disabled', false);
      $('.mode2').val('').prop('disabled', false);
      $('.mode3').val('').prop('disabled', false);
      $('.mode10').val('').prop('disabled', true);
    } else if(value === "10"){
      $(".removereq").prop('required', false)
      $('.mode1').val('').prop('disabled', true);
      $('.mode2').val('').prop('disabled', true);
      $('.mode3').val('').prop('disabled', true);
      $('.mode10').val('').prop('disabled', false);
    } else if (value === "") {
      $(".removereq").prop('required', false)
      $('.mode1').val('').prop('disabled', true);
      $('.mode2').val('').prop('disabled', true);
      $('.mode3').val('').prop('disabled', true);
      $('.mode10').val('').prop('disabled', true);
    }
  });

</script>





<script type="text/javascript">

 get_repair_order_class().then(function(data) {

  if(data.status){

    if(data.response.list){

      var options="";

      options+=`<option value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option value="`+item.id+`">`+item.name+`</option>`;

      })

      $('[name="order_class_id"]').html(options);
      select_default('[name="order_class_id"]')     

    }

  }

})

</script>

<script type="text/javascript">

  function show_status_filter(){

   get_repair_order_status().then(function(data) {

    if(data.status){

      if(data.response.list){

        var options="";

        options+=`<option value="">- - Select - -</option>`

        $.each(data.response.list, function(index, item) {

          options+=`<option value="`+item.id+`">`+item.name+`</option>`;               

        })

        $('[name="order_status_id"]').html(options); 
        select_default('[name="order_status_id"]')     

      }

    }

  }).catch(function(err) {

  }) 

}

show_status_filter()

</script>

<script type="text/javascript">

 get_repair_order_type().then(function(data) {

  if(data.status){

    if(data.response.list){

      var options="";
      var url_params = get_params();
      var classcheck =  '<?php echo $details['class']; ?>';
      options+=`<option value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        if(item.status == 'ACTIVE'){

          console.log(item.class_name);
                    // console.log(class_get_name);
                  //  if(class_get_name == 'Schedule'){ 


                   if (classcheck == 'SCHEDULE' && item.class_name == 'Schedule' ){
                    options += `<option value="` + item.id + `">` + item.name + `</option>`;
                  }

                  if (classcheck == 'UNSCHEDULE' && item.class_name == 'Unschedule' ){
                   options += `<option value="` + item.id + `">` + item.name + `</option>`;
                 } 

                 if (classcheck == '' ){
                   options += `<option value="` + item.id + `">` + item.name + `</option>`;
                 }



               }
             })

      $('[name="order_type_id"]').html(options);
      select_default('[name="order_type_id"]')      

    }

  }

})
</script>

<script type="text/javascript">

 get_repair_order_stage().then(function(data) {

  if(data.status){
    console.log(data);

    if(data.response.list){

      var options="";

      options+=`<option value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {
        if(item.status == 'Active'){
          options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        }
      })

      $('[name="order_stage_id"]').html(options);     
      select_default('[name="order_stage_id"]')

    }

  }

})

</script>

<script type="text/javascript">

 quick_list_drivers().then(function(data) {

  if(data.status){

    if(data.response.list){

      var options="";

      options+=`<option value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {
        if(item.status == 'Active'){
          options+=`<option value="`+item.id+`">`+item.code+' '+item.name+`</option>`;   
        }            

      })

      $('[name="driver_id"]').html(options);  
      select_default('[name="driver_id"]')               

    }

  }

})

</script>

<script type="text/javascript">

 get_vehicles().then(function(data) {

  if(data.status){

    if(data.response.list){

      var options="";

      options+=`<option value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               

      })

      $('[name="unit_type_id"]').html(options);  
      select_default('[name="unit_type_id"]')   
      show_unit_filter({unit_type_id:'<?php echo $details['vehicle_type']; ?>'}); 
    }

  }

})

</script>

<script type="text/javascript">

  function show_unit_filter(param){

    if(param.unit_type_id=='TRUCK'){
      quick_list_trucks().then(function(data){
        if(data.status){

          if(data.response.list){

            var options="";

            options+=`<option value="">- - Select - -</option>`

            $.each(data.response.list, function(index, item) {

              options+=`<option value="`+item.id+`">`+item.code+`</option>`;               

            })

            $('[name="unit_id"]').html(options); 
            select_default('[name="unit_id"]')     

          }

        }

      }).catch(function(err) {

      })

    }else if(param.unit_type_id=='TRAILER'){

      quick_list_trailers().then(function(data){

        if(data.status){

          if(data.response.list){

            var options="";

            options+=`<option value="">- - Select - -</option>`

            $.each(data.response.list, function(index, item) {

              options+=`<option value="`+item.id+`">`+item.code+`</option>`;               

            })

            $('[name="unit_id"]').html(options);     
            select_default('[name="unit_id"]')

          }

        }

      }).catch(function(err) {

      })

    } 

  }

</script>

<script type="text/javascript">

  var counter=0

  var $issue_table = $('#issue_table');

  function add_row(param){


    ++counter;

    if(param.hasOwnProperty('default_select_criticality_id')){
      default_select_criticality_id=param.default_select_criticality_id
    }else{
      default_select_criticality_id=''
    }

    if(param.hasOwnProperty('default_select_category_id')){
      default_select_category_id=param.default_select_category_id
    }else{
      default_select_category_id=''
    }

    if(param.hasOwnProperty('default_select_job_work_id')){
      default_select_job_work_id=param.default_select_job_work_id
    }else{
      default_select_job_work_id=''
    }

    if(param.hasOwnProperty('default_issue_reported')){
      default_issue_reported=param.default_issue_reported
    }else{
      default_issue_reported=''
    }

    if(param.hasOwnProperty('default_issue_description')){
      default_issue_description=param.default_issue_description
    }else{
      default_issue_description=''
    }        

    var $add_rowissue=`<tr id="issue_row${counter}"  data-stop-row>

    <td class="counter">${counter}</td>

    <td><select class="w-150" name="category_id" required></select></td>

    <td><select class="w-150" name="criticality_level_id" required></select></td>`;
    var jbr = "<?php echo $details['class']; ?>"
     //console.log(jbr)
     if(jbr === "UNSCHEDULE"){
      $add_rowissue+=`<td><select class="w-150" name="job_work_id"></select></td>`;
    }else{
      $add_rowissue+=`<td><select class="w-150" name="job_work_id" required></select></td>`;
    }
    $add_rowissue+=`<td><input type="text" class="w-150" value='${default_issue_reported}' name="issue_reported" required></td>

    <td><input type="text" class="w-150" value='${default_issue_description}' name="issue_description" required></td>

    <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>

    </tr>`;

    $('#issue_table').append($add_rowissue);

    show_repair_order_category({row_id:'issue_row'+counter,default_select:default_select_category_id})

    show_repair_order_criticality_level({row_id:'issue_row'+counter,default_select:default_select_criticality_id})

    show_repair_order_job_work({row_id:'issue_row'+counter,default_select:default_select_job_work_id})

  }

  $(document.body).on('click', '[data-remove-stop-button=""]' ,function(){

    $(this).parent().parent().remove();
    counter = 0;
    $('.counter').each(function(index,item){
      counter= counter+1;
      $(this).html(counter)
    })

  });

  //-----------/remove stop

</script>

<script type="text/javascript">

  function show_repair_order_category(param){

   get_repair_order_category().then(function(data) {

    if(data.status){

      if(data.response.list){

        var options="";

        options+=`<option value="">- - Select - -</option>`

        $.each(data.response.list, function(index, item) {
          if(item.status == 'ACTIVE'){
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;
          }               

        })
        $('tr#'+param.row_id+' [name="category_id"]').html(options);  

        if(param.hasOwnProperty('default_select')){

          $('tr#'+param.row_id+' [name="category_id"] option[value="'+param.default_select+'"]').prop('selected',true);  

        } 

      }

    }

  }).catch(function(err) {

  }) 

}

show_repair_order_category('issue_row1')

</script>

<script type="text/javascript">

  function show_repair_order_criticality_level(param){

   get_repair_order_criticality_level().then(function(data) {

    if(data.status){

      if(data.response.list){

        var options="";

        options+=`<option value="">- - Select - -</option>`

        $.each(data.response.list, function(index, item) {

          options+=`<option value="`+item.id+`">`+item.name+`</option>`;               

        })

        $('tr#'+param.row_id+' [name="criticality_level_id"]').html(options);     

        if(param.hasOwnProperty('default_select')){

          $('tr#'+param.row_id+' [name="criticality_level_id"] option[value="'+param.default_select+'"]').prop('selected',true); 

        } 

      }

    }

  }).catch(function(err) {

  }) 

}

show_repair_order_criticality_level('issue_row1')

</script>

<script type="text/javascript">

  function show_repair_order_job_work(param){

   get_job_work().then(function(data) {

    if(data.status){

      if(data.response.list){

        var options="";

        options+=`<option value="">- - Select - -</option>`

        $.each(data.response.list, function(index, item) {
          if(item.status == 'ACTIVE'){
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;     
          }          

        })

        $('tr#'+param.row_id+' [name="job_work_id"]').html(options);     

        if(param.hasOwnProperty('default_select')){

          $('tr#'+param.row_id+' [name="job_work_id"] option[value="'+param.default_select+'"]').prop('selected',true);  

        }  

      }

    }

  }).catch(function(err) {

  }) 

}

show_repair_order_job_work('issue_row1')

</script>

<script type="text/javascript">

  function save(){

    //submit_to_wait_btn('#submit','loading')

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

var $issue_rows = $("[data-stop-row]");

issues_array=[]

$issue_rows.each(function (index) 

{

  var $data_stop_row = $(this);

  var stop_row=

  {

    category_id : $data_stop_row.find('[name="category_id"]').val(),

    criticality_level_id : $data_stop_row.find('[name="criticality_level_id"]').val(),

    job_work_id : $data_stop_row.find('[name="job_work_id"]').val(),

    issue_reported : $data_stop_row.find('[name="issue_reported"]').val(),

    issue_description : $data_stop_row.find('[name="issue_description"]').val()

  }

  issues_array.push(stop_row)

})

var obj={

  update_eid:'<?php echo $details['eid']; ?>',

  class_id:$('[name="order_class_id"]').val(),

  unit_type_id:$('[name="unit_type_id"]').val(),

  unit_id:$('[name="unit_id"]').val(),

  driver_id:$('[name="driver_id"]').val(),

  type_id:$('[name="order_type_id"]').val(),

  stage_id:$('[name="order_stage_id"]').val(),

  start_date:$('[name="order_start_date"]').val(),

  start_time:$('[name="order_start_time"]').val(),

  contact_person:$('[name="contact_person"]').val(),

  contact_no:$('[name="contact_no"]').val(),

  reference_type:$('[name="reference_type"]').val(),
  reference_id:$('[name="reference_id"]').val(),
  reference_rowid:$('[name="reference_rowid"]').val(),

  issues:issues_array,

  yard_id: $('[name="yard_id"]').val(),

  vendor_id: $('[name="vendor_id"]').val(),
  vendor_state_id: $('[name="vendor_state_id"]').val(),
  vendor_city_id: ($('[name="vendor_city_id"]').val() !== null) ? $('[name="vendor_city_id"]').val() : '',

  //stops:JSON.stringify(issues_array)

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
    window.history.back();
     //location.href="../user/maintenance/repair-order-entry"

     //wait_to_submit_btn('#submit','SAVE')

   }else{

    //wait_to_submit_btn('#submit','SAVE')

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
      add_row(
      {
        default_select_category_id:item.category_id,
        default_select_criticality_id:item.criticality_level_id,
        default_select_job_work_id:item.job_work_id,
        default_issue_reported:item.issue_reported,
        default_issue_description:item.issue_description,
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