<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
$details=$data['details'];
?>
<style type="text/css">
  .add-load-table{
    border: 1px solid red;
    border-collapse: collapse;
  }
  .add-load-table  td,
  .add-load-table  th{
    border: 1px solid grey;
  }
</style>
<section class="lg-form-outer">
  <div class="lg-form-header">Add Dispatch For Load <?php echo $details['load_id']; ?></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <input type="hidden" name="eid" value="<?php echo $details['eid'] ?>">
    <section class="section-1" style="max-width: 1000px;">    
      <div>
        <fieldset>
          <legend>Load Information</legend>

          <div style="display:flex;">
            <div class="field-section single-column"   style="width:50%">
<!--               <div class="field-p">
                <label>Status</label>
                <select data-default-select="<?php echo $details['status_id'] ?>" name="status_id"></select>
              </div>   -->
              <div class="field-p">
                <label>Driver Type</label>
                <select name="driver_type_id" required></select>
              </div>

              <div class="field-p">
                <label>Team/ Solo</label>
                <select name="is_team_driver" onchange="hide_show_driver_b_option()" required>
                  <option value=""> - - Select - -</option>
                  <option value="SOLO">SOLO</option>
                  <option value="TEAM">TEAM</option>
                </select>
              </div>

              <div class="field-p">
                <label>Driver A</label>
                <input style="width:70px" type="text" list="quick_list_drivers" value="" data-selected-driver-id="" data-search-driver  name="driver_id" required disabled>
              </div>
              <div class="field-p" data-driver-b></div>

              <div class="field-p">
                <label>Truck</label>
                <input style="width:70px" type="text"  list="quick_list_trucks" value="" data-selected-truck-id="" name="truck_id" required>
              </div>
              <div class="field-p">
                <label>Trailer</label>
                <input style="width:70px" type="text"  list="quick_list_trailers" data-selected-trailer-id="" name="trailer_id" required>
              </div>

            </div>            
            <div class="field-section single-column" style="width:50%"></div>  
          </div>                
        </fieldset>
      </div>
    </section>

    <section class="section-1" style="width:1000px;">

      <div>

        <fieldset>

          <legend>Starting Point Details</legend>

          <div class="field-section table-rows">

            <table style="width: 100%">

              <thead>

                <tr>
                  <th style="text-align:left">Address</th>
                  <th>Start Datetime</th>
                </tr>

              </thead>

              <tbody>
                <tr>
                  <td style="text-align:left"><input type="text" value="" list="quick_list_addresses" data-selected-address-id="" name="addresses_id_search" required> &nbsp;<i data-address-refresh class="fas fa-sync-alt" title="Refresh Addresses List"></i>  &nbsp;<i data-add-address class="fa fa-plus" title="Add Address"></i></td>
                  <td><input type="text" name="start_address_date" data-date-picker style="width:100px"><input type="text" name="start_address_time" data-time-picker style="width:60px"></td>
                </tr>

              </tbody>


            </table>

          </div>                  

        </fieldset>

      </div>

    </section>


    <section class="section-1" style="width:1000px;">

      <div>

        <fieldset>

          <legend>Stops</legend>

          <div class="field-section table-rows">

            <table style="width: 100%">

              <thead>

                <tr>

                  <th>Inc</th>

                  <th>Assignment</th>

                  <th>Type</th>

                  <th style="text-align:left">Address</th>

                  <th style="display:none;">Arrival</th>
                  <th style="display:none;">Departure</th>
                </tr>

              </thead>

              <tbody id="stops_table" data-stop-table>
                <?php
                foreach($details['stops'] AS $stp){
                  ?>
                  <tr data-stop-row data-stop-id="<?php echo $stp['id']; ?>">
                    <td><input type="checkbox" name="is_included" <?php echo ($stp['assignment_status']=='ASSIGNED')?'disabled':'' ?>></td>
                    <td><?php echo $stp['assignment_status']; ?></td>
                    <td><?php echo $stp['category_abbr'] ?></td>
                    <td style="max-width: 200px;text-align: left;"><?php echo $stp['address'] ?></td>
                    <td style="display:none;"><input type="text" name="arrival_date" data-date-picker style="width:100px"><input type="text" name="arrival_time" data-time-picker style="width:60px"></td>
                    <td style="display:none;"><input type="text" name="departure_date" data-date-picker style="width:100px"><input type="text" name="departure_time" data-time-picker style="width:60px"></td>
                    <td style='white-space:nowrap;'>  <i class='fas fa-caret-square-up fa-lg' data-stop-order-up></i> &nbsp<i class='fas fa-caret-square-down fa-lg' data-stop-order-down></i></td>
                  </tr>
                  <?php
                }

                ?>
              </tbody>
              <tfoot><tr><td colspan="4"></td><td colspan="2"><button class="btn_blue" type="button" onclick="open_child_window({url:'../user/dispatch/loads/load-add-stop-off?eid=<?php echo $_GET['eid']; ?>',width:600,height:270,name:'Make-Format'})">Add Stop Off</button></td></tr></tfoot>
            </table>

          </div>                  

      <div>
        </fieldset>

      </div>

    </section>
    <section class="lg-form-action-button-box">
      <button class="btn_green">SAVE</button>
    </section>
<!--     <section class="lg-form-action-button-box">
      <button type="button" id="button" class="btn_green" onclick="set_pref('close')">SAVE & CLOSE</button>
      <button type="button" id="button" class="btn_green" onclick="set_pref('add-more')">SAVE & ADD NEW DISPATCH</button>
      <button type="submit" data-submit></button> 
    </section> -->
  </form>
</section>

<script type="text/javascript">
$(document).on("click", "[data-address-refresh]", function() {
  show_processing_modal()
  show_quick_list_addresses();
  hide_processing_modal()
});

$(document).on("click", "[data-add-address]", function() {
    open_child_window({
      url: '../user/masters/locations/location-addresses/quick-add-new',
      name: 'AddAddress',
      width: 1000,
      height: 800,
    })
  });
</script>
<script type="text/javascript">
      //---change stop orders
    $(document).on('click','[data-stop-order-up]',function(){
      let last_row=$(this).parents('tr').prev('tr');
      $(last_row).before($(this).parents('tr'))
    })
    $(document).on('click','[data-stop-order-down]',function(){
      let next_row=$(this).parents('tr').next('tr');
      $(next_row).after($(this).parents('tr'))
    })
  //---/change stop orders
</script>
<script type="text/javascript">

 var return_to = 'close'

 function set_pref(val) {
  return_to = val;
  $('[data-submit]').trigger('click');
}



function save(){

  show_processing_modal()
  submit_to_wait_btn('#submit','loading')
  $('#formErro').show()
  var form = document.getElementById('MyForm');
  var isValidForm = form.checkValidity();

  if(isValidForm){
    assigned_stops_array=[]
    let stop_sr_no=0;
    $('[data-stop-row] [name="is_included"]:checked').each(function (index) {
      assigned_stops_array.push({
        stop_sr_no:++stop_sr_no,
        id:$(this).parents('tr').data('stop-id'),
        arrival_date:$(this).parents('tr').find("[name='arrival_date']").val(),
        arrival_time:$(this).parents('tr').find("[name='arrival_time']").val(),
        departure_date:$(this).parents('tr').find("[name='departure_date']").val(),
        departure_time:$(this).parents('tr').find("[name='departure_time']").val(),
      })
    })

    obj={};
    driver_b_id=(($('[name="driver_b_id"]').length)==1)?$('[name="driver_b_id"]').data('selected-driver-id'):''
    is_team_driver=$('[name="is_team_driver"]').val()
    var obj={
     load_eid:$('[name="eid"]').val(),
     status_id:$('[name="status_id"]').val(),
     truck_id:$('[name="truck_id"]').data('selected-truck-id'),
     trailer_id:$('[name="trailer_id"]').data('selected-trailer-id'),
     start_address_id:$('[name="addresses_id_search"]').data('selected-address-id'),
     start_date:$('[name="start_address_date"]').val(),
     start_time:$('[name="start_address_time"]').val(),
     is_team_driver:is_team_driver,
     driver_type_id:$('[name="driver_type_id"]').val(),
     driver_id:$('[name="driver_id"]').data('selected-driver-id'),
     driver_b_id:driver_b_id,
     assigned_stops:assigned_stops_array
   }

   $.ajax({
    url:'../user/dispatch/loads/add-dispatch-action',
    type:'POST',
    data: obj,
    success:function(data){
      alert(data)
      if((typeof data)=='string'){
       data=JSON.parse(data) 
     }
     alert(data.message)
     if(data.status){
       window.opener.show_list()

       if (return_to == 'add-more') {

        $('#MyForm')[0].reset()
      }else{
        window.close();
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
  quick_list_driver_types().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option data-value="" value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="${item.id}">${item.name}</option>`;    

      })

      $('[name="driver_type_id"]').html(options);   

    }

  }

})

</script>

<datalist id="quick_list_drivers"></datalist>


<script type="text/javascript">

  $(document.body).on('change', '[name="driver_type_id"]' ,function(){
$('#quick_list_drivers').html('');
$('[name="driver_id"],[name="driver_b_id"]').val(''); 
$('[name="driver_id"],[name="driver_b_id"]').data('selected-driver-id','');

  $('[name="driver_id"],[name="driver_b_id"]').prop('disabled',true)


 quick_list_drivers({status_ids:'ACTIVE',type:$(this).val()}).then(function(data) {
  // Run this when your request was successful
  if(data.status){
if((data.response.list.length)>0){
$('[name="driver_id"],[name="driver_b_id"]').prop('disabled',false)
}


    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option data-driver-filter-rows="" data-value="" value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option data-driver-filter-rows="`+item.code+' '+item.name+`" data-value="${item.id}" value="`+item.code+' '+item.name+`"></option>`;               

      })

      $('#quick_list_drivers').html(options);

    }

  }else{

  }

})

  });

 
</script>











<script type="text/javascript">

  $(document.body).on('change', '[data-search-driver]' ,function(){
    driver_id_selected=$(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if($(this).val()!=''){
      if(driver_id_selected==undefined){
        alert('Invalid driver selected');
        driver_id_selected=''
        $(this).val('')
        $(this).focus()
      }else{
        show_processing_modal()
        $.ajax({
          url:'../user/dispatch/loads/validate-driver-dispatch-assignment',
          type:'POST',
          data:{
            driver_id:driver_id_selected
          },
          success:function(data){
            if((typeof data)=='string'){
             data=JSON.parse(data) 
           }
           if(data.status==false){
           alert(data.message)
           }
           hide_processing_modal()
         }
       })
      }
    }else{
      driver_id_selected=''
    }
    $(this).data('selected-driver-id',driver_id_selected);
  });

//   quick_list_drivers({status_ids:'ACTIVE'}).then(function(data) {
//   // Run this when your request was successful

//   if(data.status){



//     //Run this if response has list

//     if(data.response.list){

//       var options="";

//       options+=`<option data-driver-filter-rows="" data-value="" value="">- - Select - -</option>`

//       $.each(data.response.list, function(index, item) {

//         options+=`<option data-driver-filter-rows="`+item.code+' '+item.name+`" data-value="${item.id}" value="`+item.code+' '+item.name+`"></option>`;               

//       })

//       $('#quick_list_drivers').html(options);     

//     }

//   }

// })
</script>





<script type="text/javascript">
 get_load_status().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="status_id"]').html(options);
      select_default('[name="status_id"]')

    }
  }
}).catch(function(data){
})

</script>


<datalist id="quick_list_trucks"></datalist>

<script type="text/javascript">

  $(document.body).on('change', '[data-selected-truck-id]' ,function(){
    truck_id_selected=$(`option[value="${$(this).val()}"]`).data('value');
    if($(this).val()!=''){
      if(truck_id_selected==undefined){
        alert('Invalid truck selected');
        truck_id_selected=''
        $(this).val('')
        $(this).focus()
      }else{
                show_processing_modal()
        $.ajax({
          url:'../user/dispatch/loads/validate-truck-dispatch-assignment',
          type:'POST',
          data:{
            truck_id:truck_id_selected
          },
          success:function(data){
            if((typeof data)=='string'){
             data=JSON.parse(data) 
           }
           if(data.status==false){
           alert(data.message)
           }
           hide_processing_modal()
         }
       })
      }
    }else{
      truck_id_selected=''
    }
    $(this).data('selected-truck-id',truck_id_selected);
  });


  quick_list_trucks({status_ids:'ACTIVE','body_type':'<?php echo ($details['trailer_type']=="VAN/REEFER")?"":$details['trailer_type'] ?>'}).then(function(data) {

  // Run this when your request was successful

  if(data.status){



    //Run this if response has list

    if(data.response.list){


      var options="";

      options+=`<option data-driv-filter-rows="" data-value="" value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option data-value="${item.id}" value="`+item.code+`"></option>`;               

      })

      $('#quick_list_trucks').html(options);   

    }

  }

})

</script>
<script type="text/javascript">

  function hide_show_driver_b_option(){
    if($('[name="is_team_driver"]').val()=='SOLO'){
      $('[data-driver-b]').html('');
    }else if($('[name="is_team_driver"]').val()=='TEAM'){
      $('[data-driver-b]').html(`<label>Driver B</label>
        <input style="width:70px" type="text" list="quick_list_drivers" data-search-driver  name="driver_b_id" disabled>`)
    }
  }
</script>

<datalist id="quick_list_trailers"></datalist>

<script type="text/javascript">

  $(document.body).on('change', '[data-selected-trailer-id]' ,function(){

    trailer_id_selected=$(`option[value="${$(this).val()}"]`).data('value');
    if($(this).val()!=''){
      if(trailer_id_selected==undefined){
        alert('Invalid trailer selected');
        trailer_id_selected=''
        $(this).val('')
        $(this).focus()
      }else{
                        show_processing_modal()
        $.ajax({
          url:'../user/dispatch/loads/validate-trailer-dispatch-assignment',
          type:'POST',
          data:{
            trailer_id:trailer_id_selected
          },
          success:function(data){
            if((typeof data)=='string'){
             data=JSON.parse(data) 
           }
           if(data.status==false){
           alert(data.message)
           }
           hide_processing_modal()
         }
       })
      }
    }else{
      trailer_id_selected=''
    }
    $(this).data('selected-trailer-id',trailer_id_selected);

  });


  quick_list_trailers({status_ids:'ACTIVE'}).then(function(data) {

  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option data-value="" value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option data-value="${item.id}" value="`+item.code+`"></option>`;    

      })

      $('#quick_list_trailers').html(options);   

    }

  }

})

</script>
<datalist id="quick_list_addresses"></datalist>
<script type="text/javascript">
  $(document.body).on('change', '[name="addresses_id_search"]' ,function(){
    address_id_selected=$(`[data-addresses-filter-rows="${$(this).val()}"]`).data('value');
    if($(this).val()!=''){
      if(address_id_selected==undefined){
        alert('Invalid address selected');
        address_id_selected=''
        $(this).val('')
        $(this).focus()
      }
    }else{
      address_id_selected=''
    }
    $(this).data('selected-address-id',address_id_selected);
  });


  function show_quick_list_addresses(){
   quick_list_location_addresses().then(function(data) {
          // Run this when your request was successful
          if(data.status){

            //Run this if response has list
            if(data.response.list){
              var options="";
              options+=`<option data-addresses-filter-rows="" data-value="" value="">- - Select - -</option>`
              $.each(data.response.list, function(index, item) {
                options+=`<option data-addresses-filter-rows="`+item.id+' '+item.name+`" data-value="${item.id}" data-eid="${item.eid}" value="`+item.id+' '+item.name+`"></option>`;               
              })
              $('#quick_list_addresses').html(options);     
            }
          }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
          }) 
      }
      show_quick_list_addresses()
    </script>



    <?php
    require_once APPROOT.'/views/includes/user/footer.php';
  ?>