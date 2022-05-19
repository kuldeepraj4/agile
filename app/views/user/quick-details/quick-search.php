<?php
require_once APPROOT . '/views/includes/user/header-quick-view.php';
?>
<section class="lg-form-outer lg-form">
    <div class="lg-form-header"></div>
    <section class="section-111" style="max-width: 500px">
        <div>
            <fieldset>
                <legend>Quick Launch Menu</legend>
                <div class="field-section single-column">
                    <div class="field-p">
                        <label>Driver ID</label>
                        <input type="text" data-filter="driver_id" list="quick_list_drivers" data-driver-id>
                    </div>
                    <div class="field-p">
                        <label>Truck ID</label>
                        <input type="text" data-filter="truck_id" list="quick_list_trucks" data-truck-id >
                    </div>
                    <div class="field-p">
                        <label>Trailer ID</label>
                        <input type="text" data-filter="trailer_id" list="quick_list_trailers" data-trailer-id>
                    </div>
                    <div class="field-p">
                        <label>Trip ID</label>
                        <input type="text" data-filter="trip_id" list="quick_list_trips" data-trip-id>
                    </div>
                    <!-- <div class="field-p">
                        <label>Tractor ID</label>
                        <input type="text" data-filter="vehicle_id" list="quick_list_vehicle_id" data-vehicle-id>
                    </div>
                    <div class="field-p">
                        <label>Customer ID</label>
                        <input type="text" data-filter="vehicle_id" list="quick_list_vehicle_id" data-vehicle-id>
                    </div>
                    <div class="field-p">
                        <label>Load ID</label>
                        <input type="text" data-filter="vehicle_id" list="quick_list_vehicle_id" data-vehicle-id>
                    </div> -->
                </div>
            </fieldset>
        </div>
    </section>
</section>
<script type="text/javascript">
    var url_params = get_params();
</script>
<!-- <script type="text/javascript">
        function RefreshParent() {
            if (window.opener != null && !window.opener.closed) {
                window.opener.location.reload();
                window.close();
            }
        }
    </script> -->
<!-- -----------------------------Driver function start here ------------------------------------------------------>
<script type="text/javascript">
    $(document.body).on('input', '[data-driver-id]', function() {
        id_selected = $(`[data-driver-id-rows="${$(this).val()}"]`).data('value');
        eid_selected = $(`[data-driver-id-rows="${$(this).val()}"]`).data('eid');
        if (id_selected != undefined && id_selected != "") {
            $(this).data('driver-id', id_selected)
            //window.location.href = '../user/quick-view/driver?eid='+eid_selected;
            window.opener.location.href = '../user/quick-details/quick-driver-details?eid='+eid_selected;
            window.close();
            // set_params('driver_id', id_selected)
            //set_params('driver_name', $(`[data-driver-id]`).val())
        }
    });
</script>
<script type="text/javascript">
    $(document.body).on('change', '[data-driver-id]', function() {
        id_selected = $(`[data-driver-id-rows="${$(this).val()}"]`).data('value');
        if (id_selected == undefined) {
            alert("Please enter correct DriverID")
            //set_params('driver_id', '')
            //set_params('driver_name', '')
            $(`[data-driver-id]`).val('')
        }
    });
</script>
<datalist id="quick_list_drivers"></datalist>
<script type="text/javascript">
    function show_quick_list_drivers() {
        quick_all_list_drivers().then(function(data) {
            if (data.status) {
                if (data.response.list) {
                    var options = "";
                    options += `<option data-driver-id-rows="" data-value="" value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option data-driver-id-rows="`+item.code+' '+item.name+`" data-value="${item.id}" data-eid="${item.eid}" value="`+item.code+' '+item.name+`"></option>`;
                    })
                    $('#quick_list_drivers').html(options);
                    // if (url_params.hasOwnProperty('driver_name')) {
                    //     $(`[data-driver-id]`).val(check_url_params('driver_name'))
                    // }
                }
            }
        }).catch(function(err) {})
    }
    show_quick_list_drivers()
</script>
<!-- -----------------------------Driver function end here ------------------------------------------------------>
<!-- -----------------------------truck function start here ------------------------------------------------------>
<datalist id="quick_list_trucks"></datalist>
<script type="text/javascript">
    $(document.body).on('input', '[data-truck-id]', function() {
        id_selected = $(`[data-truck-id-rows="${$(this).val()}"]`).data('value');
        eid_selected = $(`[data-truck-id-rows="${$(this).val()}"]`).data('eid');
        if (id_selected != undefined && id_selected != "") {
            $(this).data('truck-id', id_selected)
            window.opener.location.href = '../user/quick-details/quick-truck-details?eid='+eid_selected;
            window.close();
            // set_params('truck_code', id_selected)
            // set_params('truck_code', $(`[data-truck-id]`).val())
        }
    });
</script>
<script type="text/javascript">
    $(document.body).on('change', '[data-truck-id]', function() {
        id_selected = $(`[data-truck-id-rows="${$(this).val()}"]`).data('value');
        if (id_selected == undefined) {
            alert("Please enter correct TruckID")
            //set_params('truck_code', '')
            $(`[data-truck-id]`).val('')
        }
    });
</script>
<script type="text/javascript">
    quick_list_trucks().then(function(data) {
        if (data.status) {
            if (data.response.list) {
                var options = "";
                options += `<option data-truck-id-rows="" data-value="" value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option data-truck-id-rows="`+item.code+`" data-value="${item.id}" data-eid="${item.eid}" value="`+item.code+`"></option>`;
                })
                $('#quick_list_trucks').html(options);
                // if (url_params.hasOwnProperty('truck_code')) {
                //     $(`[data-truck-id]`).val(check_url_params('truck_code'))
                // }
            }
        }
    }).catch(function(err) {})
</script>
<!-- -----------------------------truck function end here ---------------------------------------->
<!-- -----------------------------trailer function start here ---------------------------------------->
<datalist id="quick_list_trailers"></datalist>
<script type="text/javascript">
    $(document.body).on('input', '[data-trailer-id]', function() {
        id_selected = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
        eid_selected = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('eid');
        if (id_selected != undefined && id_selected != "") {
            $(this).data('trailer-id', id_selected)
            window.opener.location.href = '../user/quick-details/quick-trailer-details?eid='+eid_selected;
            window.close();
            // set_params('trailer_code', id_selected)
            // set_params('trailer_code', $(`[data-vehicle-id]`).val())
        }
    });
</script>
<script type="text/javascript">
    $(document.body).on('change', '[data-trailer-id]', function() {
        id_selected = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
        if (id_selected == undefined) {
            alert("Please enter correct TruckID")
            //set_params('trailer_code', '')
            $(`[data-trailer-id]`).val('')
        }
    });
</script>
<script type="text/javascript">
    quick_list_trailers().then(function(data) {
        if (data.status) {
            if (data.response.list) {
                var options = "";
                options += `<option data-trailer-id-rows="" data-value="" value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    console.log(item)
                    options += `<option data-trailer-id-rows="`+item.code+`" data-value="${item.id}" data-eid="${item.eid}" value="`+item.code+`"></option>`;
                })
                $('#quick_list_trailers').html(options);
                // if (url_params.hasOwnProperty('trailer_code')) {
                //     $(`[data-trailer-id]`).val(check_url_params('trailer_code'))
                // }
            }
        }
    }).catch(function(err) {})
</script>
<!-- -----------------------------trailer function end here ---------------------------------------->
<datalist id="quick_list_trips"></datalist>
<script type="text/javascript">
    $(document.body).on('input', '[data-trip-id]', function() {
        id_selected = $(`[data-trip-id-rows="${$(this).val()}"]`).data('value');
        eid_selected = $(`[data-trip-id-rows="${$(this).val()}"]`).data('eid');
        if (id_selected != undefined && id_selected != "") {
            $(this).data('trip-id', id_selected)
            window.opener.location.href = '../user/quick-details/quick-trip-details?eid='+eid_selected;
            window.close();
            // set_params('trailer_code', id_selected)
            // set_params('trailer_code', $(`[data-vehicle-id]`).val())
        }
    });
</script>
<script type="text/javascript">
    $(document.body).on('change', '[data-trip-id]', function() {
        id_selected = $(`[data-trip-id-rows="${$(this).val()}"]`).data('value');
        if (id_selected == undefined) {
            alert("Please enter correct TripID")
            //set_params('trailer_code', '')
            $(`[data-trip-id]`).val('')
        }
    });
</script>
<script type="text/javascript">
  function show_quick_list_trips_id(){
   quick_list_trips().then(function(data) {
  // Run this when your request was successful
  if(data.status){

    //Run this if response has list
    if(data.response.list){
      var options="";
      options += `<option data-trip-id-rows="" data-value="" value="">- - Select - -</option>`
      //options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
          console.log(item)
        options += `<option data-trip-id-rows="`+item.id+`" data-value="${item.id}" data-eid="${item.eid}" value="`+item.id+`"></option>`;
       // options+=`<option value="`+item.id+`"></option>`;               
      })
      $('#quick_list_trips').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_quick_list_trips_id()
</script>