<?php require_once APPROOT.'/views/includes/user/header-quick-view.php';
$details=$data['details'];
// echo "<pre>";
// print_r($details);
// echo "</pre>"; 
?>
<style type="text/css">
  .driver-leasves-alert-view,
  .data-truck-assigned-driver-list{
    padding:10px;
    color: red;
    font-size: .9em;
  }
  div [data-truck-assigned-driver-list]{
    color: green;
  }
</style>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">Update Long Haul Assignment</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-111" style="max-width: 700px"> 
      <input type="hidden" name="update_eid" value="<?php echo $details['eid']; ?>">    
      <div>
        <fieldset>
          <legend>Basic Information</legend>

          <div style="display:flex;">
            <div class="field-section single-column"   style="width:100%">

              <div class="field-p">
                <label>Team/ Solo</label>
                <select name="is_team_driver" onchange="hide_show_driver_b_option()" data-default-select="<?php echo $details['is_team_driver'] ?>">
                  <option value=""> - - Select - -</option>
                  <option value="SOLO">SOLO</option>
                  <option value="TEAM">TEAM</option>
                </select>
              </div>
              <div class="field-p">
                <label>Driver A</label>
                <input style="width:70px" type="text" list="quick_list_drivers" value="<?php echo $details['driver_name'] ?>" data-selected-driver-id="<?php echo $details['driver_id'] ?>" data-search-driver  name="driver_id">
              </div>
              <div data-driver-a-leaves-list></div>
              <div class="field-p" data-driver-b>

                <?php
                if($details['is_team_driver']=="TEAM"){
                  ?>
                  <label>Driver B</label>
                  <input style="width:70px" type="text" list="quick_list_drivers" data-selected-driver-id="<?php echo $details['driver_b_id'] ?>" value="<?php echo $details['driver_b_name'] ?>" data-search-driver  name="driver_b_id">
                  <?php
                }
                ?>
              </div>
              <div data-driver-b-leaves-list></div>

              <div class="field-p">
                <label>Truck</label>
                <input style="width:70px" type="text"  list="quick_list_trucks" value="<?php echo $details['truck_code'] ?>" data-selected-truck-id="<?php echo $details['truck_id'] ?>" name="truck_id">
              </div>
              <div data-truck-assigned-driver-list></div>

              <div class="field-p">
                <label>Start date</label>
                <input type="text" data-date-picker name="driver_start_date" value="<?php echo $details['driver_start_date'] ?>">
              </div>

              <div class="field-p">
                <label></label>
                <textarea name="driver_notes" style="height: 100px"><?php echo $details['driver_notes'] ?></textarea>
              </div>

<!--               <div class="field-p">
                <label>Current Status</label>
                <input type="text"  name="driver_current_status" value="<?php echo $details['driver_current_status'] ?>">
              </div>

              <div class="field-p">
                <label>Current Location</label>
                <input type="text"  name="driver_current_location" value="<?php echo $details['driver_current_location'] ?>">
              </div>

              <div class="field-p">
                <label>ETA to planned to load</label>
                <input type="text"  name="driver_eta_to_planned_load" value="<?php echo $details['driver_eta_to_planned_load'] ?>">
              </div> -->


            </div>            
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
    submit_to_wait_btn('#submit','loading')
    $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    var formData=new FormData(currentForm);
    if(isValidForm){

      driver_b_id=(($('[name="driver_b_id"]').length)==1)?$('[name="driver_b_id"]').data('selected-driver-id'):''
      is_team_driver=$('[name="is_team_driver"]').val()
      var obj={
        update_eid:$('[name="update_eid"]').val(),
        is_team_driver:is_team_driver,
        driver_id:$('[name="driver_id"]').data('selected-driver-id'),
        driver_b_id:driver_b_id,
        truck_id:$('[name="truck_id"]').data('selected-truck-id'),
        driver_start_date:$('[name="driver_start_date"]').val(),
        driver_notes:$('[name="driver_notes"]').val(),
        driver_current_status:$('[name="driver_current_status"]').val(),
        driver_current_location:$('[name="driver_current_location"]').val(),
        driver_eta_to_planned_load:$('[name="driver_eta_to_planned_load"]').val(),

      }
      $.ajax({
        url:'../user/dispatch/lh-assignment/update-action',
        type:'POST',
        data: obj,
        success:function(data){
          alert(data)
          if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         alert(data.message);
         if(data.status){
           window.opener.show_list()
           window.close();
         }
         wait_to_submit_btn('#submit','SAVE')
       }
     })
    }
    return false
  }
</script>


<script type="text/javascript">
  function  display_leaves(driver_id,section,driver_name) {
    $.ajax({
      url:'../user/masters/drivers/driver-leave-quick-list-ajax',
      type:'POST',
      data:{
        driver_id:driver_id,
        perion_from_date:'<?php echo date('m/d/Y') ?>'
      },
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data)
         $(section).html();
         if(data.status){
            d_leaves=`
            <div class="driver-leasves-alert-view">
            <i>Active leaves of <b>${driver_name}</b></i>
            <ul>`;
            l_count=0;
           $.each(data.response.list, function(index, item) {
            l_count++;
                 d_leaves+=`<li>${l_count} ) &nbsp  ${item.from_datetime} &nbsp - &nbsp ${item.to_datetime}</li>`;       
          })
           d_leaves+=`</ul>
           </div>`;
           $(section).html(`${d_leaves}`);

         }
       }
     }
   })
  }
     </script>
<datalist id="quick_list_drivers"></datalist>

     <script type="text/javascript">

      $(document.body).on('change', '[data-search-driver]' ,function(){

        
        switch($(this).attr('name')){
          case 'driver_id':
          driver_section='[data-driver-a-leaves-list]'
          break;
          
          case 'driver_b_id':
          driver_section='[data-driver-b-leaves-list]'
          break;

          default:
          driver_section='data-not-available' 
        }
        
        //---make leaves section blank
        $(driver_section).html('')
        //---make leaves section blank
        driver_id_selected=$(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
        if($(this).val()!=''){
          if(driver_id_selected==undefined){
            alert('Invalid driver selected');
            driver_id_selected=''
            $(this).val('')
            $(this).focus()
          }else{
            display_leaves(driver_id_selected,driver_section,$(this).val())
          }
        }else{
          driver_id_selected=''
        }
        $(this).data('selected-driver-id',driver_id_selected);
      });

      quick_list_drivers().then(function(data) {

  // Run this when your request was successful

  if(data.status){



    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option data-driver-filter-rows="" data-value="" value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option data-driver-filter-rows="`+item.code+' '+item.name+`" data-value="${item.id}" value="`+item.code+' '+item.name+`"></option>`;               

      })

      $('#quick_list_drivers').html(options);     

    }

  }

})



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
    let truck_code=$(this).val();
    truck_id_selected=$(`option[value="${$(this).val()}"]`).data('value');
    $('[data-truck-assigned-driver-list]').html(``);
    if($(this).val()!=''){
      if(truck_id_selected==undefined){
        alert('Invalid truck selected');
        truck_id_selected=''
        $(this).val('')
        $(this).focus()
      }else{
        //--  dispaly/hide old assigned driver on $this truck
        
    $.ajax({
      url:'../user/dispatch/long-haul-assignments/last-assigned-drivers-on-truck-quick-list-ajax',
      type:'POST',
      data:{
        truck_id:truck_id_selected,
      },
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data)
         if(data.status){
            d_assi=`
            <div>
            <i>Last assigned drivers on Truck<b> ${truck_code}</b></i>
            <ul>`;
            l_count=0;
           $.each(data.response.list, function(index, item) {
            l_count++;
                 d_assi+=`<li> ${l_count}) ${item.is_team_driver} &nbsp ${item.driver_code} ${item.driver_name}`
                 if(item.is_team_driver=='TEAM'){
                  d_assi+=`, ${item.driver_b_code} ${item.driver_b_name}`
                 }
                 d_assi+=`</li>`;       
          })
           d_assi+=`</ul>
           </div>`;
           $('[data-truck-assigned-driver-list]').html(`${d_assi}`);

         }
       }
     }
   })


      }
    }else{
      truck_id_selected=''
    }
    $(this).data('selected-truck-id',truck_id_selected);
  });


  quick_list_trucks().then(function(data) {

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
        <input style="width:70px" type="text" list="quick_list_drivers" data-search-driver  name="driver_b_id">`)
    }
  }
</script>

<datalist id="quick_list_trailers"></datalist>

<script type="text/javascript">

  $(document.body).on('change', '[data-selected-trailer-id]' ,function(){
    trailer_id_selected=$(`option[value="${$(this).val()}"]`).data('value');
    if(trailer_id_selected!=undefined){
      $(this).data('selected-trailer-id',trailer_id_selected)

    }
  });


  quick_list_trailers({body_type:'<?php echo $filter_trailer; ?>'}).then(function(data) {

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

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>