<?php
require_once APPROOT.'/views/includes/user/header.php';
//$page=isset($_GET['page'])?$_GET['page']:1;
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1500px">
  <h1 class="list-200-heading">All Trips</h1>
  <section class="list-200-top-section">
    <div>

    </div>
    <div>

    </div>
  </section>



  <section class="list-200-top-action">
    <div class="list-200-top-action-left">

      <!-- input used for sory by call-->
            <input type="hidden" id="sort_by" value="">
            <!-- //input used for sory by call-->
             <input type='hidden' id='sort' value='asc'>


      <div class="filter-item">
        <label>Trip ID</label>
        <input type="text" list="quick_list_trips" data-filter="trip_id" onkeyup="set_params('trip_id', this.value), goto_page(1)">
      </div>
      <div class="filter-item">
        <label>Approval Status</label>
        <select data-filter="approval_status_id" onchange="set_params('approval_status_id', this.value), goto_page(1)">
          <option value="">ALL</option>
          <option value="APPROVED" <?php if($data['approval_status']=='APPROVED'){echo 'selected';} ?>>APPROVED</option>
          <option value="CANCELLED" <?php if($data['approval_status']=='CANCELLED'){echo 'selected';} ?>>CANCELLED</option>
          <option value="PENDING" <?php if($data['approval_status']=='PENDING'){echo 'selected';} ?>>PENDING</option>
          <option value="REJECTED" <?php if($data['approval_status']=='REJECTED'){echo 'selected';} ?>>REJECTED</option>
          
        </select>
      </div>
      <div class="filter-item">
        <label>Driver</label>
        <!-- <input type="text" list="quick_list_drivers" data-filter="driver_id" onkeyup="onchage_driver_filter(this.value)"> -->
        <input type="text" list="quick_list_drivers" data-filter="driver_id" data-driver-id>
      </div>
      <div class="filter-item">
        <label>Truck ID</label>
        <!-- <input type="text" data-filter="truck_code" onkeyup="set_params('truck_code', this.value), goto_page(1)"> -->
        <input type="text" data-filter="truck_code" list="quick_list_vehicle_id" data-vehicle-id>
      </div>           
      <div class="filter-item">
        <label>Start From Date</label>
        <input type="text" data-date-picker="" data-date-from data-filter="start_date_from" onchange="set_params('start_date_from', this.value), goto_page(1)">
      </div>
      <div class="filter-item">
        <label>Start To Date</label>
        <input data-date-picker="" type="text" data-date-to data-filter="start_date_to" onchange="set_params('start_date_to', this.value), goto_page(1)" />
      </div>
    </div>
    <div class="list-200-top-action-right">
      <div>
        <?php
        if(in_array('P0119', USER_PRIV)){
          echo "<button class='btn_grey button_href'><a href='../user/accounts/trips/add-new'>Add New</a></button>";
        }
        ?>
      </div>
    </div>

  </section>
  <div class="table  table-a">
    <table data-ro-table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th data-table-sort-by="id">ID</th>
          <th data-table-sort-by="trip_start_date"  style="white-space: nowrap;">Start Time</th>
          <th>End Time</th>                    
          <th data-table-sort-by="truck_code" style="white-space: nowrap;">Truck ID</th>
          <th style="width: 200px;">Stops</th>
          <th>Miles</th>
          <th>PPM</th>
          <th>Payout</th>
          <th>Incentive Rate</th>
          <th>Incentive</th>
          <th>Parameter Reimbursement</th>
          <th>Parameter Earning</th>
          <th>Parameter Deduction</th>
          <th data-table-sort-by="driver_group_name" style="white-space: nowrap;">Group Type</th>
          <th>Driver A</th>
          <th>Driver B</th>
          <th data-table-sort-by="approval_status"  style="white-space: nowrap;">Approval Status</th>
          <th>Created By</th>
          <th style="white-space: nowrap;">Approved By</th>
          <th></th>
        </tr>                       
      </thead>
      <tbody id="tabledata"></tbody>
    </table>
    </div>
    <div data-pagination></div>
    <!-- <div data-list-pagination-total-pages="0" data-list-pagination-active-pages="0" data-list-pagination style="margin:5px"> -->
    <!-- Page :<ul>
        <li>1</li>
        <li>2</li>
      </ul> -->
    </div>
   <!--  <div data-pagination></div> -->
</section>

<script>
  $(document.body).on('change', '[data-date-from]', function() {
    var g1 = new Date(check_url_params('start_date_from'))
    var g2 = new Date(check_url_params('start_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Start From Date should be less than from Start To Date.")
      $("[data-filter='start_date_from']").val("").focus();
      set_params('start_date_from', "")
      goto_page(1)
    }
  });

  $(document.body).on('change', '[data-date-to]', function() {
    var g1 = new Date(check_url_params('start_date_from'))
    var g2 = new Date(check_url_params('start_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Start To Date should be greater than from Start From Date.")
      $("[data-filter='start_date_to']").val("").focus();
      set_params('start_date_to', "")
      goto_page(1)
    }
  });
</script>
<script type="text/javascript">
  var url_params = get_params();
  if (url_params.hasOwnProperty('approval_status_id')) {
    $("[data-filter='approval_status_id']").val(url_params.approval_status_id);
  }
  if (url_params.hasOwnProperty('trip_id')) {
    $("[data-filter='trip_id']").val(url_params.trip_id);
  }
  // if (url_params.hasOwnProperty('truck_code')) {
  //   $("[data-filter='truck_code']").val(url_params.truck_code);
  // }
  if (url_params.hasOwnProperty('start_date_from')) {
    $("[data-filter='start_date_from']").val(url_params.start_date_from);
  }
  if (url_params.hasOwnProperty('start_date_to')) {
    $("[data-filter='start_date_to']").val(url_params.start_date_to);
  }
</script>





<script type="text/javascript">
  var driver_id='';
  function show_list(){
    var sort_by = $('#sort_by').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var driver_id = check_url_params('driver_id')
    var approval_status_id = check_url_params('approval_status_id')
    var trip_id = check_url_params('trip_id')
    var truck_code = check_url_params('truck_code')
    var start_date_from = check_url_params('start_date_from')
    var sort_by_order_type = $('#sort').val();
    var start_date_to = check_url_params('start_date_to')
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        page: page_no,
        sort_by_order_type:sort_by_order_type,
        sort_by: sort_by,
        batch: batch,
        driver_id:driver_id,
        approval_status_id:approval_status_id,
        trip_id:trip_id,
        truck_code:truck_code,
        start_date_from:start_date_from,
        start_date_to:start_date_to
      },
      beforeSend:function(){
        $('#tabledata').html(`<tr><td colspan="18">Loading . . . <td></tr>`);
      },
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
         // console.log(data)
           $.each(data.response.list, function(index, item) {
             var row=`<tr>
             <td>${item.sr_no}</td>
             <td>${item.id}</td>
             <td>${item.start_date}</td>
             <td>${item.end_date}</td>
             <td><span class="text-link"  onclick="open_quick_view_truck('${item.truck_eid}')">${item.truck_code}</span></td>
             <td style="text-align:left">${item.trip_stops_names}</td>             
             <td>${item.miles}</td>             
             <td>${item.ppm}</td>             
             <td>${item.payout}</td>             
             <td>${item.incentive_rate}</td>             
             <td>${item.incentive}</td>             
             <td>${item.salary_parameters_reimbursement}</td>             
             <td>${item.salary_parameters_earning}</td>             
             <td>${item.salary_parameters_deduction}</td>             
             <td>${item.driver_group_name}</td>             
             <td style="white-space:nowrap">  <span class="text-link"  onclick="open_quick_view_driver('${item.trip_drivers[0].driver_eid}')">${item.trip_drivers[0].driver_code} - ${item.trip_drivers[0].driver_name}</span></td>`

             if(item.trip_drivers.length==2){
              row+=`<td  style="white-space:nowrap"><span class="text-link"  onclick="open_quick_view_driver('${item.trip_drivers[1].driver_eid}')">${item.trip_drivers[1].driver_code} - ${item.trip_drivers[1].driver_name}</span></td>`
            }else{
              row+=`<td></td>`;
            }        
            row+=`<td>${item.approval_status}</td>
            <td>${item.added_by_user_code}<br>${item.added_by_user_name}<br><span style="white-space:nowrap">${item.added_on_datetime}</span></td>
            <td>${item.approved_by_user_code}<br>${item.approved_by_user_name}<br><span style="white-space:nowrap">${item.approved_on_datetime}</span></td>
            <td style="white-space:nowrap">`;

            <?php if(in_array('P0120', USER_PRIV)){
              ?>
              row+=`<button title="View" class="btn_grey_c"><a href="../user/accounts/trips/details?eid=`+item.eid+`"><i class="fa fa-eye"></i></a></button>`;
              <?php
            } ?>
            row+=`</td>
            </tr>`;
            $('#tabledata').append(row);

          })
          set_pagination({
              selector: '[data-pagination]',
              totalPages: data.response.totalPages,
              currentPage: data.response.currentPage,
              batch: data.response.batch
            })
           ///--pagination
          // $('[data-list-pagination]').data('list-pagination-total-pages',data.response.totalPages); //set total page value to pagination
          // $('[data-list-pagination]').data('list-pagination-active-pages',data.response.currentPage);
          // do_pagination()
           ///--/pagination

         }else{
          $('#tabledata').html("");
    var row=`<tr><td colspan="25">`+data.message+`</td></tr>`;
    $('#tabledata').append(row);
      $('[data-pagination]').html('');
        }
      }

    }

  })
  }
  show_list()

</script>



<script type="text/javascript">
  function sort_table(){
    show_list()
  }



</script>






<!---------trip id filter-------->

<datalist id="quick_list_trips"></datalist>
<script type="text/javascript">
  $(document.body).on('input', '[data-driver-id]', function() {
    //alert("hhhh")
    id_selected = $(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if (id_selected != undefined) {
      $(this).data('driver-id', id_selected)
      set_params('driver_id', id_selected)
      set_params('driver_name', $(`[data-driver-id]`).val())
      goto_page(1)
    }
  });
</script>
<script type="text/javascript">
  $(document.body).on('change', '[data-driver-id]', function() {
    id_selected = $(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if (id_selected == undefined) {
      alert("Please enter correct DriverID")
      set_params('driver_id', '')
      set_params('driver_name', '')
      $(`[data-driver-id]`).val('')
      goto_page(1)
    }
  });
</script>
<script type="text/javascript">
  $('[data-filter="trip_id"]').on('input', function () {
    show_list()
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
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`"></option>`;               
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
<script type="text/javascript">
  $('[data-filter="trip_id"]').on('input', function () {
    show_list()
  });
</script>
<datalist id="quick_list_drivers"></datalist>
<script type="text/javascript">
  function show_quick_list_drivers(){
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
      if (url_params.hasOwnProperty('driver_name')) {
            $(`[data-driver-id]`).val(check_url_params('driver_name'))
            // $("[data-filter='vehicle_id'] option[value=" + url_params.vehicle_id + "]").prop('selected', true);
          }
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_quick_list_drivers()

function onchage_driver_filter(value){
  var this_driver_id=$(`[data-driver-filter-rows="${value}"]`).data('value');
  if(this_driver_id!=undefined){
    driver_id=this_driver_id
    show_list();
  }
}

</script>

<!---------trip id filter-------->

<datalist id="quick_list_vehicle_id"></datalist>
<script type="text/javascript">
  $(document.body).on('input', '[data-vehicle-id]', function() {
    //alert("hhhh")
    id_selected = $(`[data-vehicle-id-rows="${$(this).val()}"]`).data('value');
    if (id_selected != undefined) {
      $(this).data('vehicle-id', id_selected)
      // set_params('truck_code', id_selected)
      set_params('truck_code', $(`[data-vehicle-id]`).val())
      goto_page(1)
    }
  });
</script>
<script type="text/javascript">
  $(document.body).on('change', '[data-vehicle-id]', function() {
    id_selected = $(`[data-vehicle-id-rows="${$(this).val()}"]`).data('value');
    if (id_selected == undefined) {
      alert("Please enter correct TruckID")
      set_params('truck_code', '')
      $(`[data-vehicle-id]`).val('').focus();
      goto_page(1)
    }
  });
</script>

<script type="text/javascript">
  quick_list_trucks().then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        // options += `<option value="">- - Select - -</option>`
        options += `<option data-vehicle-id-rows="" data-value="" value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option data-vehicle-id-rows="` + item.code + `" data-value="${item.id}" value="` + item.code + `"></option>`;
          // options += `<option value="` + item.id + `">` + item.code + `</option>`;   //old code
        })
        $('#quick_list_vehicle_id').html(options);
        //$('[data-filter="vehicle_id"]').html(options);   //old code
        if (url_params.hasOwnProperty('truck_code')) {
          $(`[data-vehicle-id]`).val(check_url_params('truck_code'))
          // $("[data-filter='vehicle_id'] option[value=" + url_params.vehicle_id + "]").prop('selected', true);
        }
      }
    }
  }).catch(function(err) {
    // Run this when promise was rejected via reject()
  })
</script>


<br><br><br><br><br>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>