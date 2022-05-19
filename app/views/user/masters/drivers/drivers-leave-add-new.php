<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br><br>
<br>
<section class="lg-form-outer">
	<div class="lg-form-header">ADD DRIVER LEAVE</div>
	<form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
		<section class="section-111" style="max-width: 700px"> 
			<input type="hidden" name="update_eid" value="<?php echo $details['eid']; ?>">    
			<div>
				<fieldset>
					<legend>Basic Details</legend>

					<div style="display:flex;">
						<div class="field-section single-column"   style="width:100%">
							<div class="field-p">
								<label>Team/ Solo*</label>
								<select name="is_team_driver" onchange="hide_show_driver_b_option()" data-default-select="<?php echo $details['is_team_driver'] ?>">
									<option value="SOLO">SOLO</option>
									<option value="TEAM">TEAM</option>
								</select>
							</div>

							<div class="field-p">
								<label>Driver A*</label>
								<input style="width:70px" type="text" list="quick_list_drivers" value="" data-selected-driver-id="" data-search-driver  name="driver_id">
							</div>
							<div class="field-p" data-driver-b></div>

							<div class="field-p">
								<label>Truck</label>
								<input style="width:70px" type="text"  list="quick_list_trucks" value="" data-selected-truck-id="" name="truck_id">
							</div>
							<div class="field-p">
								<label>Trailer</label>
								<input style="width:70px" type="text"  list="quick_list_trailers" value="" data-selected-trailer-id="" name="trailer_id">
							</div>
							<div class="field-p">
								<label>Reason*</label>
								<select name="reason_id" required></select>
							</div>

							<div class="field-p">
								<label>Location (State/City)</label>
								<select name="state_id" style="width:150px" onchange="show_cities(this.value)"></select>
								<select name="city_id" style="width:150px"></select>
							</div>

							<div class="field-p">
								<label>From Datetime*</label>
								<input type="text" name="from_date" data-date-picker >
								<input type="text" name="from_time" style="width: 100px;" data-time-picker value="00:00">
							</div>

							<div class="field-p">
								<label>To Datetime*</label>
								<input type="text" name="to_date" data-date-picker >
								<input type="text" name="to_time" style="width: 100px;" data-time-picker value="00:00">
							</div>

							<div class="field-p">
								<label>Remarks</label>
								<textarea name="remarks" style="height: 100px"></textarea>
							</div>

						</div>            
					</div>                
				</fieldset>
			</div>
		</section>
		<section class="action-button-box">
			<button type="submit" class="btn_green">SAVE</button>
			<button type="button" class="btn_green" onclick="back_alert()" style="margin-left: 10px;">BACK</button>
		</section>
	</form>
</section>

<script type="text/javascript">

function back_alert() {
        if (confirm('Are you Sure ?')) {
        window.history.back();
        }
    }
	
	function save(){

		submit_to_wait_btn('#submit','loading')
		$('#formErro').show()
		var form = document.getElementById('MyForm');
		var isValidForm = form.checkValidity();
		if(isValidForm){
			driver_b_id=(($('[name="driver_b_id"]').length)==1)?$('[name="driver_b_id"]').data('selected-driver-id'):''
			is_team_driver=$('[name="is_team_driver"]').val()
			$.ajax({
				url:'../user/masters/drivers/drivers-leave-add-new-action',
				type:'POST',
				data: {
					is_team_driver:is_team_driver,
					driver_id:$('[name="driver_id"]').data('selected-driver-id'),
					driver_b_id:driver_b_id,
					truck_id:$('[name="truck_id"]').data('selected-truck-id'),
					trailer_id:$('[name="trailer_id"]').data('selected-trailer-id'),
					city_id:$('[name="city_id"]').val(),
					reason_id:$('[name="reason_id"]').val(),
					from_date:$('[name="from_date"]').val(),
					from_time:$('[name="from_time"]').val(),
					to_date:$('[name="to_date"]').val(),
					to_time:$('[name="to_time"]').val(),
					remarks:$('[name="remarks"]').val(),
				},
				success:function(data){
					if((typeof data)=='string'){
						data=JSON.parse(data) 
					}
					alert(data.message);
					if(data.status){
						window.history.back()
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
<datalist id="quick_list_drivers"></datalist>

<script type="text/javascript">

	$(document.body).on('change', '[data-search-driver]' ,function(){

		driver_id_selected=$(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
		if(driver_id_selected!=undefined){
			$(this).data('selected-driver-id',driver_id_selected)
		}else{
			$(this).data('selected-driver-id','')
		}
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



	get_drivers_leave_reasons().then(function(data) {

  // Run this when your request was successful

  if(data.status){



    //Run this if response has list

    if(data.response.list){

    	var options="";

    	options+=`<option value="">- - Select - -</option>`

    	$.each(data.response.list, function(index, item) {

    		options+=`<option value="${item.id}">${item.name}</option>`;               

    	})

    	$('[name="reason_id"]').html(options);     

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
<datalist id="quick_list_trucks"></datalist>

<script type="text/javascript">

	$(document.body).on('change', '[data-selected-truck-id]' ,function(){
		truck_id_selected=$(`option[value="${$(this).val()}"]`).data('value');
		if(truck_id_selected!=undefined){
			$(this).data('selected-truck-id',truck_id_selected)
		}else{
			$(this).data('selected-truck-id','')
		}
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
<datalist id="quick_list_trailers"></datalist>

<script type="text/javascript">

	$(document.body).on('change', '[data-selected-trailer-id]' ,function(){
		trailer_id_selected=$(`option[value="${$(this).val()}"]`).data('value');
		if(trailer_id_selected!=undefined){
			$(this).data('selected-trailer-id',trailer_id_selected)
		}else{
			$(this).data('selected-trailer-id','')
		}
	});


	quick_list_trailers().then(function(data) {

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


function show_states(){
 get_states().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="${item.id}">${item.name}</option>`;               
        })
        $('[name="state_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_states();
function show_cities(state_id){
	$('[name="city_id"]').html(``);
	if(state_id!=''){
		 get_cities({state_id:state_id}).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="${item.id}">${item.name}</option>`;               
        })
        $('[name="city_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
})
	}
 
}
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>