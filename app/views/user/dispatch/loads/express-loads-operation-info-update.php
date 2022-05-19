<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
$details=$data['details'];
if($details['trailer_type']=="REEFER"){
  $filter_trailer="REEFER";
}elseif ($details['trailer_type']=="VAN") {
  $filter_trailer="VAN";
}else{
  $filter_trailer="";
}
?>


<br><br><br>
<br>
<section class="lg-form-outer">
  <div class="lg-form-header">Update Operation Information of Load <?php echo $details['id']; ?></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-111" style="max-width: 700px"> 
      <input type="hidden" name="update_eid" value="<?php echo $details['eid']; ?>">    
      <div>
        <fieldset>
          <legend>Operation Info</legend>

          <div style="display:flex;">
            <div class="field-section single-column"   style="width:100%">

              <div class="field-p">
                <label>Status</label>
                <select data-default-select="<?php echo $details['status_id'] ?>" name="status_id"></select>
              </div>

              <div class="field-p">
                <label>Truck</label>
                <input style="width:70px" type="text"  list="quick_list_trucks" value="<?php echo $details['alloted_truck_code'] ?>" data-selected-truck-id="<?php echo $details['alloted_truck_id'] ?>" name="truck_id">
              </div>
              <?php
              if(($details['load_type_id']=='LOT01' || $details['load_type_id']=='LOT03')){
                ?>
                <div class="field-p">
                  <label>Trailer</label>
                  <input style="width:70px" type="text"  list="quick_list_trailers" value="<?php echo $details['alloted_trailer_code'] ?>" data-selected-trailer-id="<?php echo $details['alloted_trailer_id'] ?>" name="trailer_id">
                </div>

                <?php
              }
              ?>

              <div class="field-p">
                <label>Team/ Solo</label>
                <select name="is_team_driver" onchange="hide_show_driver_b_option()" data-default-select="<?php echo $details['is_team_driver'] ?>">
                  <option value="SOLO">SOLO</option>
                  <option value="TEAM">TEAM</option>
                </select>
              </div>

              <div class="field-p">
                <label>Driver A</label>
                <input style="width:70px" type="text" list="quick_list_drivers" value="<?php echo $details['alloted_driver_code'].' '.$details['alloted_driver_name'] ?>" data-selected-driver-id="<?php echo $details['alloted_driver_id'] ?>" data-search-driver  name="driver_id">
              </div>
              <div class="field-p" data-driver-b>

                <?php
                if($details['is_team_driver']=="TEAM"){
                  if($details['alloted_driver_b_code']!=''){
                    $driver_b_fn=$details['alloted_driver_b_code'].' - '.$details['alloted_driver_b_name'];
                  }else{
                    $driver_b_fn='';
                  }
                  ?>
                  <label>Driver B</label>
                  <input style="width:70px" type="text" list="quick_list_drivers" data-selected-driver-id="<?php echo $details['alloted_driver_b_id'] ?>" value="<?php echo $driver_b_fn; ?>" data-search-driver  name="driver_b_id">
                  <?php
                }
                ?>
              </div>
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
       status_id:$('[name="status_id"]').val(),
       truck_id:$('[name="truck_id"]').data('selected-truck-id'),
       trailer_id:$('[name="trailer_id"]').data('selected-trailer-id'),
       is_team_driver:is_team_driver,
       driver_id:$('[name="driver_id"]').data('selected-driver-id'),
       driver_b_id:driver_b_id
     }
     $.ajax({
      url:'../user/dispatch/express-loads/operation-info-update-action',
      type:'POST',
      data: obj,
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data) 
       }
       alert(data.message);
       if(data.status){
         window.opener.show_group_list()
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



<datalist id="quick_list_drivers"></datalist>

<script type="text/javascript">

  $(document.body).on('change', '[data-search-driver]' ,function(){
    driver_id_selected=$(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if($(this).val()!=''){
      if(driver_id_selected==undefined){
        alert('Invalid driver selected');
        driver_id_selected=''
        $(this).val('')
        $(this).focus()
      }
    }else{
      driver_id_selected=''
    }
$(this).data('selected-driver-id',driver_id_selected);
  });

  quick_list_drivers({status_ids:'ACTIVE'}).then(function(data) {
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
    truck_id_selected=$(`option[value="${$(this).val()}"]`).data('value');
    if($(this).val()!=''){
      if(truck_id_selected==undefined){
        alert('Invalid truck selected');
        truck_id_selected=''
        $(this).val('')
        $(this).focus()
      }
    }else{
      truck_id_selected=''
    }
$(this).data('selected-truck-id',truck_id_selected);
  });


  quick_list_trucks({status_ids:'ACTIVE'}).then(function(data) {

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
    if($(this).val()!=''){
      if(trailer_id_selected==undefined){
        alert('Invalid trailer selected');
        trailer_id_selected=''
        $(this).val('')
        $(this).focus()
      }
    }else{
      trailer_id_selected=''
    }
$(this).data('selected-trailer-id',trailer_id_selected);
  });


  quick_list_trailers({body_type:'<?php echo $filter_trailer; ?>',status_ids:'ACTIVE'}).then(function(data) {

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