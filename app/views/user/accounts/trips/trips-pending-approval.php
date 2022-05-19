<?php
require_once APPROOT.'/views/includes/user/header.php';
$page=isset($_GET['page'])?$_GET['page']:1;
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1500px">
  <h1 class="list-200-heading">Trips Waiting For Approval</h1>
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
        <input type="text" list="quick_list_trips" data-filter="trip_id" onkeyup="show_list()">
      </div>
      <div class="filter-item"></div>
      <div class="filter-item">
        <label>Driver</label>
        <!-- <input type="text" list="quick_list_drivers" data-filter="driver_id" onkeyup="onchage_driver_filter(this.value)"> -->
        <input type="text" list="quick_list_drivers" data-filter="driver_id" data-driver-id>
      </div>
      <div class="filter-item">
        <label>Truck ID</label>
        <!-- <input type="text" data-filter="truck_code" onkeyup="show_list()"> -->
        <input type="text" data-filter="truck_code" list="quick_list_vehicle_id" data-vehicle-id>
      </div>          
      <div class="filter-item">
        <label>Start From Date</label>
        <input type="text" data-date-picker="" data-date-from data-filter="start_date_from" onchange="show_list()">
      </div>
      <div class="filter-item">
        <label>Start To Date</label>
        <input data-date-picker="" data-date-to type="text" data-filter="start_date_to" onchange="show_list()" />
      </div>
    </div>


  </section>
  <div class="table  table-a">
    <table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th><input type="checkbox" id="select_all"></th>
          <th data-table-sort-by="id">ID</th>
          <th data-table-sort-by="trip_start_date"  style="white-space: nowrap;">Start Time</th>
          <th>End Time</th>                    
          <th data-table-sort-by="truck_code" style="white-space: nowrap;">Truck ID</th>
          <th>Miles</th>
          <th>Pay/Mile</th>
          <th>Payout</th>
          <th>Incentive Rate</th>
          <th>Incentive</th>
          <th>Team/Solo</th>
          <th>Driver A</th>
          <th>Driver B</th>
          <th>Created By</th>
          <th>Created Datetime</th>
          <th>Status</th>
          <th></th>
        </tr>                       
      </thead>
      <tbody id="tabledata"></tbody>
    </table>
    </div>
<div data-pagination></div>
     <!--  <div data-list-pagination-total-pages="0" data-list-pagination-active-pages="0" data-list-pagination style="margin:5px">
    Page :<ul>
        <li>1</li>
        <li>2</li>
      </ul>
    </div> -->
</section>
<section class="action-button-box">
  <?php 
  echo   in_array('P0123', USER_PRIV)?'<button type="button" class="btn_green" data-action="approve">Approve</button> ':""; 

  echo  in_array('P0123', USER_PRIV)?' <button type="button" class="btn_red" data-action="reject">Reject</button>':""; 

  ?>
</section>
<script type="text/javascript">
  var url_params = get_params();
  </script>

<script>
  $(document.body).on('change', '[data-date-from]', function() {
    var g1 = new Date($('[data-filter="start_date_from"]').val())
    var g2 = new Date($('[data-filter="start_date_to"]').val())
    if (g1.getTime() > g2.getTime()) {
      alert("Please enter the valid date!. Start date should be less than end date")
      $("[data-filter='start_date_from']").val("");
      // set_params('start_date_from', "")
      show_list()
    }
  });

  $(document.body).on('change', '[data-date-to]', function() {
    var g1 = new Date(check_url_params('start_date_from'))
    var g2 = new Date(check_url_params('start_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Please enter the valid date!. End date should be greater than start date")
      $("[data-filter='start_date_to']").val("");
      //set_params('start_date_to', "")
      show_list()
    }
  });
</script>
<script type="text/javascript">
  //var driver_id='';
  function show_list(){
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var webapi = "pagination";
    var sort_by=$('#sort_by').val();
     var sort_by_order_type = $('#sort').val();
    var trip_id=$('[data-filter="trip_id"]').val();
    var driver_id = check_url_params('driver_id')
    var truck_code = check_url_params('truck_code')
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        page: page_no,
        sort_by_order_type:sort_by_order_type,
        sort_by: sort_by,
        batch: batch,
        trip_id:trip_id,
        driver_id:driver_id,
        webapi:  webapi,
        truck_code: truck_code,
        //truck_code:$('[data-filter="truck_code"]').val(),
        start_date_from:$('[data-filter="start_date_from"]').val(),
        start_date_to:$('[data-filter="start_date_to"]').val()        
      },
      success:function(data){

       if((typeof data)=='string'){
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
           $.each(data.response.list, function(index, item) {      
             var row=`<tr>
             <td>${item.sr_no}</td>
             <td><input type="checkbox" data-eid='${item.eid}'></td>
             <td class="text-link"  onclick="open_child_window({url:'../user/accounts/trips/details?eid=${item.eid}'})">${item.id}</td>
             <td>${item.start_date}</td>
             <td>${item.end_date}</td>
           <td><span class="text-link"  onclick="open_quick_view_truck('${item.truck_eid}')">${item.truck_code}</span></td>
             <td>${item.miles}</td>
             <td>${item.ppm}</td>  
             <td>${item.payout}</td>  
             <td>${item.incentive_rate}</td>
             <td>${item.incentive}</td>                            
             <td>${item.driver_group_name}</td>             
             <td style="white-space:nowrap">  <span class="text-link"  onclick="open_quick_view_driver('${item.trip_drivers[0].driver_eid}')">${item.trip_drivers[0].driver_code} - ${item.trip_drivers[0].driver_name}</span></td>`

             if(item.trip_drivers.length==2){
              row+=`<td  style="white-space:nowrap"><span class="text-link"  onclick="open_quick_view_driver('${item.trip_drivers[1].driver_eid}')">${item.trip_drivers[1].driver_code} - ${item.trip_drivers[1].driver_name}</span></td>`
            }else{
              row+=`<td></td>`;
            } 
            row+=`<td>${item.added_by_user_code}<br>${item.added_by_user_name}</td>
            <td>${item.added_on_datetime}</td>
            <td>${item.approval_status}</td>
            <td style="white-space:nowrap">`;

            <?php if(in_array('P10', USER_PRIV)){
              ?>
              row+=`<button title="View" class="btn_grey_c"><a href="../user/accounts/trips/details?eid=`+item.eid+`"><i class="fa fa-eye"></i></a></button>`;
              <?php
            }?>

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
    var row=`<tr><td colspan="5">`+data.message+`</td></tr>`;
    $('#tabledata').append(row);
      $('[data-pagination]').html('');
        }
      }

    }

  })
  if ($('#select_all').prop("checked") == true) {
      $('#select_all').prop('checked', false)
    }
    $('[data-action="approve"]').prop('disabled', true)
    $('[data-action="reject"]').prop('disabled', true)
    $('[data-action="approve"]').css("cursor", "default").fadeTo(100, 0.4);
    $('[data-action="reject"]').css("cursor", "default").fadeTo(100, 0.4);
  }
  show_list(<?php echo $page; ?>)

</script>
<script type="text/javascript">
  var checked_array = [];
  $(document.body).on('change', '[data-eid]', function() {
    checked_array = [];
    $('[data-eid]').each(function() {
      if ($(this).prop("checked") == true) {
        checked_array.push($(this).data('eid'))
      }
    })
    if (checked_array.length > 0) {
      $('[data-action="approve"]').prop('disabled', false)
      $('[data-action="reject"]').prop('disabled', false)
      $('[data-action="approve"]').fadeTo(500, 1);
      $('[data-action="reject"]').fadeTo(500, 1);
    } else {
      $('[data-action="approve"]').prop('disabled', true)
      $('[data-action="reject"]').prop('disabled', true)
      $('[data-action="approve"]').css("cursor", "default").fadeTo(500, 0.4);
      $('[data-action="reject"]').css("cursor", "default").fadeTo(500, 0.4);
    }
  })
</script>

<script type="text/javascript">

 function open_trip(tripid){
  var myWindow = window.open(`../user/accounts/trips/details?eid=${tripid}`, "tripWindow", "width=1200, height=1000");
 } 
  $(document).ready(function(){


//---------Approval section 

$(document).on("click", "[data-action='approve']",function(){
  if(confirm('Do you want to approve trips ?')){
      show_processing_modal()
    var checkedArray=[];
    $('[data-eid]:checked').each(function () { 
      var status = (this.checked ? $(this).val() : ""); 
      checkedArray.push($(this).data("eid"));
    });
    $.ajax({
      url:window.location.pathname+'-approve',
      type:'POST',
      data:{
        approve_eid_list:checkedArray
      },
      context: this,
      success:function(data){
        // alert(data)
       if((typeof data)=='string'){
         data=JSON.parse(data) 
       }

       if(data.status){
        location.reload();
      }else{
        alert(data.message)
      }
    }
  })
      hide_processing_modal()
  }
});
//---------/Approval section 

//---------Approval section 

$(document).on("click", "[data-action='reject']",function(){
  if(confirm('Do you want to reject trips ?')){
    show_processing_modal()
    var checkedArray=[];
    $('[data-eid]:checked').each(function () { 
      var status = (this.checked ? $(this).val() : ""); 
      checkedArray.push($(this).data("eid"));
    });
    $.ajax({
      url:window.location.pathname+'-reject',
      type:'POST',
      data:{
        reject_eid_list:checkedArray
      },
      context: this,
      success:function(data){
       if((typeof data)=='string'){
         data=JSON.parse(data) 
       }

       if(data.status){
        location.reload();
      }else{
        alert(data.message)
      }
    }
  })
    hide_processing_modal()
  }
});
//---------/Approval section 





});

  $("#select_all").click(function(){
    $("[data-eid]").prop('checked', $(this).prop('checked'));
    var checked_array = [];
    checked_array = [];
    $('[data-eid]').each(function() {
      if ($(this).prop("checked") == true) {
        checked_array.push($(this).data('eid'))
      }
    })
    if (checked_array.length > 0) {
      $('[data-action="approve"]').prop('disabled', false)
      $('[data-action="reject"]').prop('disabled', false)
      $('[data-action="approve"]').fadeTo(500, 1);
      $('[data-action="reject"]').fadeTo(500, 1);
    } else {
      $('[data-action="approve"]').prop('disabled', true)
      $('[data-action="reject"]').prop('disabled', true)
      $('[data-action="approve"]').css("cursor", "default").fadeTo(500, 0.4);
      $('[data-action="reject"]').css("cursor", "default").fadeTo(500, 0.4);
    }
  });
</script>



<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>
<!---------trip id filter-------->

<datalist id="quick_list_trips"></datalist>
<script type="text/javascript">
  $('[data-filter="trip_id"]').on('input', function () {
    show_list()
  });
</script>
<script type="text/javascript">
  function show_quick_list_trips_id(){

    quick_list_trips({approval_status_id:'PENDING'}).then(function(data) {
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
<!---------trip id filter-------->


<datalist id="quick_list_drivers"></datalist>
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

// function onchage_driver_filter(value){
//   var this_driver_id=$(`[data-driver-filter-rows="${value}"]`).data('value');
//   if(this_driver_id!=undefined){
//     driver_id=this_driver_id
//     show_list();
//   }
// }

</script>

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
      $(`[data-vehicle-id]`).val('')
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