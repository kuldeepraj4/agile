<?php
require_once APPROOT . '/views/includes/user/header.php';
// $page = isset($_GET['page']) ? $_GET['page'] : 1;
//$vehicle_type=isset($_GET['vehicle_type'])?$_GET['vehicle_type']:'';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;">
  <h1 class="list-200-heading">Repair Order Report</h1>

  <section class="list-200-top-action">
    <div class="list-200-top-action-left">
      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
      <!-- //input used for sort by call-->
      <div class="filter-item">
        <label>Order ID</label>
        <input type="text" data-filter="id" onchange="set_params('id', this.value), goto_page(1)">
      </div>
      <!-- <div class="filter-item">
        <label>Driver</label>
        <select data-filter="driver_id" onchange="set_params('driver_id', this.value), goto_page(1)">
        </select>
      </div> -->
      <div class="filter-item">
        <label>Class</label>
        <select data-filter="class_id" onchange="set_params('class_id', this.value), goto_page(1), show_all_result_details_list()">
        </select>
      </div>
      <div class="filter-item">
        <label>Status</label>
        <select data-filter="status_id" onchange="set_params('status_id', this.value), goto_page(1), show_all_result_details_list()">
        </select>   
      </div>
      <div class="filter-item">
        <label>Unit Type</label>
        <select data-filter="vehicle_type" onchange="$(`[data-vehicle-id]`).val(''),set_params('vehicle_type', this.value),set_params('vehicle_code', ''),set_params('vehicle_id', ''),goto_page(1), show_unit_filter({vehicle_type:this.value})"></select>
      </div>
      <div class="filter-item">
        <label>Type</label>
        <select data-filter="type_id" onchange="set_params('type_id', this.value), goto_page(1), show_all_result_details_list()">
        </select>
      </div>
      <div class="filter-item">
        <label>Unit ID</label>
        <input type="text" data-filter="vehicle_id" list="quick_list_vehicle_id" data-vehicle-id>
        <!-- <select data-filter="vehicle_id" onchange="set_params('vehicle_id', this.value), goto_page(1)">        //old method
        </select> -->
      </div>
      <div class="filter-item">
        <label>Stage</label>
        <select data-filter="stage_id" onchange="set_params('stage_id', this.value), goto_page(1), show_all_result_details_list()">
        </select>
      </div>   
      <div class="filter-item">
        <label>Report Type</label>
        <select data-filter="report_id" onchange="set_params('report_id', this.value), goto_page(1)">
            <option value="">- - Select - -</option>
            <option value="Equipment_Type">Equipment Type</option>
            <option value="Repair_Order_Type">Repair Order Type</option>
            <option value="Equipment_Year_Make_Model">Equipment Year/Make/Model</option>
            <option value="Equipment">Equipment</option>
            <option value="Equipment_Category">Equipment Category</option>
            <option value="Vendor">Vendor</option>
            <option value="Job_Work">Job Work</option>
        </select>
      </div>
    </div>
    <div class="list-200-top-action-right">
      <div>   
        <?php
        
        ?>
      </div>
    </div>
  </section>

  <section class="list-200-top-action">
    <div class="list-200-top-action-left" style="width: 50%;">
      <div class="table  table-a" style="width: 99%;">
      Repair Class Analysis 
      <table style="height: 94%;">
        <thead>
          <tr style="height: 5px;">
            <th></th>
            <th>Charge</th>
            <th>No Charge</th>
            <th>Un Paid</th>
          </tr>
        </thead>
        <tbody id="tabledatarepair">
          <tr>
           <td style="text-align: left;">Scheduled</td>
           <td id='Scheduled_Charge'></td>
           <td id='Scheduled_No_Charge'></td>
           <td id='Scheduled_Un_Paid'></td>
         </tr>
         <tr>
           <td style="text-align: left;">Unscheduled</td>
           <td id='Unscheduled_Charge'></td>
           <td id='Unscheduled_No_Charge'></td>
           <td id='Unscheduled_Un_Paid'></td>
         </tr>
         <tr>
           <td style="text-align: left;">Total</td>
           <td id='Total_Charge'></td>
           <td id='Total_No_Charge'></td>
           <td id='Total_Un_Paid'></td>
         </tr>
        </tbody>
      </table>
    </div>
    </div>
    
    <div class="list-200-top-action-left" style="width: 50%;">
      <div class="table  table-a" style="width: 99%;">
        Result Details
        <table style="height: 94%;">
            <tbody id="tabledataresultdetails">
              <tr>
                 <td style="float: left;">Repair Orders</td>
                 <td id='Repair_Orders_Count'></td>
               </tr>

               <tr>
                 <td style="float: left;">Equipments</td>
                 <td id='Equipments'></td>
               </tr>

               <tr>
                 <td style="float: left;">Average Repair</td>
                 <td id='Average_Repair'></td>
               </tr>

               <tr>
                 <td style="float: left;">Max Repair</td>
                 <td id='Max_Repair'></td>
               </tr>

               <tr>
                 <td style="float: left;">Min Repair</td>
                 <td id='Min_Repair'></td>
               </tr>

               <tr>
                 <td style="float: left;">Average Per Vehicle</td>
                 <td id='Average_Per_Vehicle'></td>
               </tr>

               <tr>
                 <td style="float: left;">Average Downtime</td>
                 <td id='Average_Downtime'></td>
               </tr>

               <tr>
                 <td style="float: left;">Total Downtime</td>
                 <td id='Total_Downtime'></td>
               </tr>
            </tbody>
        </table>
      </div>
    </div>
    
  </section>

  <div class="table  table-a">
    <input type='hidden' id='sort' value='asc'>
    <table data-ro-table>
      <thead id="tablehead"></thead>
      <tbody id="tabledata"></tbody>
    </table>
    <div data-pagination></div>
  </div>
</section>
 
<script type="text/javascript">
  var url_params = get_params();
  if (url_params.hasOwnProperty('status_id')) {} else {
    set_params('status_id', 'OPEN')
  }
  if (url_params.hasOwnProperty('id')) {
    $("[data-filter='id']").val(url_params.id);
  }
</script>
<script type="text/javascript">
  function show_list() {
    let url_params = get_params();
    var sort_by = $('#sort_by').val();
    var sort_by_order_type = $('#sort').val();

    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var id = check_url_params('id')
    var class_id = check_url_params('class_id')
    var vehicle_type = check_url_params('vehicle_type')
    var status_id = check_url_params('status_id')
    var vehicle_id = check_url_params('vehicle_id')
    var type_id = check_url_params('type_id')
    var driver_id = check_url_params('driver_id')
    var stage_id = check_url_params('stage_id')
    var report_id = check_url_params('report_id')
    if(report_id!=undefined && report_id!="") {
      $.ajax({
        url: location.pathname + '-ajax',
        type: 'POST',
        data: {
          page: page_no,
          sort_by: sort_by,
          batch: batch,
          class_id: class_id,
          id: id,
          vehicle_type: vehicle_type,
          status_id: status_id,
          vehicle_id: vehicle_id,
          type_id: type_id,
          driver_id: driver_id,
          stage_id: stage_id,
          report_id:report_id
        },
        beforeSend: function() {
          show_table_data_loading('[data-ro-table]')
        },
        success: function(data) {
          console.log(data);
          //Type  RO Count  RO Parts  RO Labor  Total RO Cost RO Parts - No Charge  RO Labor - No Charge  Average TAT
          if(report_id == "Equipment_Type"){
            var rowhead = `<tr>
              <th>Sr No</th>
              <th>Type</th>
              <th>RO Count</th>
              <th>RO Parts</th>
              <th>RO Labor</th>
              <th>Total RO Cost</th>
              <th>RO Parts - No Charge</th>
              <th>RO Labor - No Charge</th>
              <th>Average TAT</th>
            </tr>`;
          }else if(report_id == "Repair_Order_Type"){
            //Type  RO Count  RO Parts  RO Labor  Total RO Cost RO Parts - No Charge  RO Labor - No Charge  Average TAT
            var rowhead = `<tr>
              <th>Sr No</th>
              <th>Type</th>
              <th>RO Count</th>
              <th>RO Parts</th>
              <th>RO Labor</th>
              <th>Total RO Cost</th>
              <th>RO Parts - No Charge</th>
              <th>RO Labor - No Charge</th>
              <th>Average TAT</th>
            </tr>`;
          }else if(report_id == "Equipment_Year_Make_Model"){
            //Type  RO Count  RO Parts  RO Labor  Total RO Cost Total Revenue Miles CPM RPM RO Parts - No Charge  RO Labor - No Charge  Average TAT
           var rowhead = `<tr>
              <th>Sr No</th>
              <th>Type</th>
              <th>RO Count</th>
              <th>RO Parts</th>
              <th>RO Labor</th>
              <th>Total RO Cost</th>
              <th>Total Revenue</th>
              <th>Miles</th>
              <th>CPM</th>
              <th>RPM</th>
              <th>RO Parts - No Charge</th>
              <th>RO Labor - No Charge</th>
              <th>Average TAT</th>
            </tr>`;
          }else if(report_id == "Equipment"){
            //Type  RO Count  RO Parts  RO Labor  Total RO Cost Total Revenue Miles CPM RPM RO Parts - No Charge  RO Labor - No Charge  Average TAT
            var rowhead = `<tr>
              <th>Sr No</th>
              <th>Type</th>
              <th>RO Count</th>
              <th>RO Parts</th>
              <th>RO Labor</th>
              <th>Total RO Cost</th>
              <th>Total Revenue</th>
              <th>Miles</th>
              <th>CPM</th>
              <th>RPM</th>
              <th>RO Parts - No Charge</th>
              <th>RO Labor - No Charge</th>
              <th>Average TAT</th>
            </tr>`;
          }else if(report_id == "Equipment_Category"){
            //Type  RO Count  RO Parts  RO Labor  Total RO Cost Total Revenue Miles CPM RPM RO Parts - No Charge  RO Labor - No Charge  Average TAT
            var rowhead = `<tr>
              <th>Sr No</th>
              <th>Type</th>
              <th>RO Count</th>
              <th>RO Parts</th>
              <th>RO Labor</th>
              <th>Total RO Cost</th>
              <th>Total Revenue</th>
              <th>Miles</th>
              <th>CPM</th>
              <th>RPM</th>
              <th>RO Parts - No Charge</th>
              <th>RO Labor - No Charge</th>
              <th>Average TAT</th>
            </tr>`;
          }else if(report_id == "Vendor"){
            //Type  RO Count  RO Parts  RO Labor  Total RO Cost RO Parts - No Charge  RO Labor - No Charge  Average TAT
            var rowhead = `<tr>
              <th>Sr No</th>
              <th>Type</th>
              <th>RO Count</th>
              <th>RO Parts</th>
              <th>RO Labor</th>
              <th>Total RO Cost</th>
              <th>RO Parts - No Charge</th>
              <th>RO Labor - No Charge</th>
              <th>Average TAT</th>
            </tr>`;
          }else if(report_id == "Job_Work"){
            //Type  RO Count  RO Parts  RO Labor  Total RO Cost RO Parts - No Charge  RO Labor - No Charge  Average TAT
            var rowhead = `<tr>
              <th>Sr No</th>
              <th>Type</th>
              <th>RO Count</th>
              <th>RO Parts</th>
              <th>RO Labor</th>
              <th>Total RO Cost</th>
              <th>RO Parts - No Charge</th>
              <th>RO Labor - No Charge</th>
              <th>Average TAT</th>
            </tr>`;
          }else {
            var rowhead = `<tr>
              <th>Sr No All</th>
              <th>Type</th>
              <th>RO Count</th>
              <th>RO Parts Cost</th>
              <th>RO Labor Cost</th>
              <th>Total RO Cost</th>
              <th>RO Parts - No Charge</th>
              <th>RO Labor - No Charge</th>
              <th></th>
            </tr>`;
          }
          $('#tablehead').html(rowhead);


          if ((typeof data) == 'string') {
            data = JSON.parse(data)
            $('#tabledata').html("");
            if (data.status) {
            //console.log(data);
              var counter = 0;
              $.each(data.response.list, function(index, item) {
                counter++;
                if(report_id == "Equipment_Type" || report_id == "Repair_Order_Type"){
                  var row = `<tr>
                   <td>${item.sr_no}</td>
                   <td>${item.type}</td>
                   <td>${item.rocount}</td>
                   <td>${item.roparts}</td>
                   <td>${item.rolabor}</td>
                   <td>${item.totalrocost}</td>
                   <td>${item.ropartsnocharge}</td>
                   <td>${item.rolabornocharge}</td>
                   <td>${item.roaveragetat}</td>
                   </tr>`;
                  $('#tabledata').append(row);
                }
                if(report_id == "Equipment_Year_Make_Model" || report_id == "Equipment" || report_id == "Equipment_Category"){
                  var row = `<tr>
                   <td>${item.sr_no}</td>
                   <td>${item.type}</td>
                   <td>${item.rocount}</td>
                   <td>${item.roparts}</td>
                   <td>${item.rolabor}</td>
                   <td>${item.totalrocost}</td>
                   <td>${item.totalrevenue}</td>
                   <td>${item.miles}</td>
                   <td>${item.cpm}</td>
                   <td>${item.rpm}</td>
                   <td>${item.ropartsnocharge}</td>
                   <td>${item.rolabornocharge}</td>
                   <td>${item.roaveragetat}</td>
                   </tr>`;
                  $('#tabledata').append(row);
                }
                // 8 columns
                if(report_id == "Vendor" || report_id == "Job_Work"){
                  var row = `<tr>
                   <td>${item.sr_no}</td>
                   <td>${item.type}</td>
                   <td>${item.rocount}</td>
                   <td>${item.roparts}</td>
                   <td>${item.rolabor}</td>
                   <td>${item.totalrocost}</td>
                   <td>${item.ropartsnocharge}</td>
                   <td>${item.rolabornocharge}</td>
                   <td>${item.roaveragetat}</td>
                   </tr>`;
                  $('#tabledata').append(row);
                }
                //stats.push(item.status) 
              })
              set_pagination({
                selector: '[data-pagination]',
                totalPages: data.response.totalPages,
                currentPage: data.response.currentPage,
                batch: data.response.batch
              })
            } else {
              var false_message = `<tr><td colspan="8">` + data.message + `<td></tr>`;
              $('#tabledata').html(false_message);
            }
          }
        }
      })

  } else {
      var rowhead = `<tr>
        <th>Sr No</th>
        <th>Type</th>
        <th>RO Count</th>
        <th>RO Parts Cost</th>
        <th>RO Labor Cost</th>
        <th>Total RO Cost</th>
        <th>RO Parts - No Charge</th>
        <th>RO Labor - No Charge</th>
        <th></th>
      </tr>`;
      $('#tablehead').html(rowhead);
      var false_message = `<tr><td colspan="8">Please select any Report Type <td></tr>`;
      $('#tabledata').html(false_message);
    }
  }


  function show_all_repair_analysis_result_details_list(){
      $.ajax({
        url: location.pathname + '-all_repair_analysis_result_details',
        type: 'POST',
        data: {},
        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
            if (data.status) {
              // console.log("records response");
              // console.log(data);
               $.each(data.response.list, function(index, item) {
                  //Repair Class Analysis 
                  $('#Scheduled_Charge').text(item.scheduled_charge);
                  $('#Scheduled_No_Charge').text(item.scheduled_no_charge);
                  $('#Scheduled_Un_Paid').text(item.scheduled_un_paid);
                  $('#Unscheduled_Charge').text(item.unscheduled_charge);
                  $('#Unscheduled_No_Charge').text(item.unscheduled_no_charge);
                  $('#Unscheduled_Un_Paid').text(item.unscheduled_un_paid);
                  $('#Total_Charge').text(item.total_charge);
                  $('#Total_No_Charge').text(item.total_no_charge);
                  $('#Total_Un_Paid').text(item.total_un_paid);
               });
            } else {
              alert('Records not exist for Repair Class Analysis');
            }
          }
        }
      })
  }

  function show_all_result_details_list(){

    let url_params = get_params();
    var id = check_url_params('id')
    var class_id = check_url_params('class_id')
    var vehicle_type = check_url_params('vehicle_type')
    var status_id = check_url_params('status_id')
    var vehicle_id = check_url_params('vehicle_id')
    var type_id = check_url_params('type_id')
    var driver_id = check_url_params('driver_id')
    var stage_id = check_url_params('stage_id')

      $.ajax({
        url: location.pathname + '-all_result_details',
        type: 'POST',
        data: {
          id: id,
          class_id: class_id,
          vehicle_type: vehicle_type,
          status_id: status_id,
          vehicle_id: vehicle_id,
          type_id: type_id,
          driver_id: driver_id,
          stage_id: stage_id,
        },
        beforeSend: function() {
          //show_table_data_loading('[data-ro-table]')
        },

        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
            if (data.status) {
              //console.log("records response");
              //console.log(data);
               $.each(data.response.list, function(index, item) {
                  //Result Details 
                  //console.log(item.repair_orders_cont);
                  //console.log(item[0].equipments);
                  $('#Repair_Orders_Count').text(item.repair_orders_cont);
                  $('#Equipments').text(item.equipments);
                  //$('#Average_Repair').text(item.total_repair/item.repair_orders_cont);
                  $('#Average_Repair').text(item.average_repair);
                  $('#Max_Repair').text(item.max_repair);
                  $('#Min_Repair').text(item.min_repair);
                  //$('#Average_Per_Vehicle').text(item.total_downtime/item.equipments);
                  $('#Average_Per_Vehicle').text(item.average_per_vehicle);
                  //$('#Average_Downtime').text(item.total_downtime/item.repair_orders_cont);
                  $('#Average_Downtime').text(item.average_downtime);
                  $('#Total_Downtime').text(item.total_downtime);
               });
            } else {
              alert('Records not exist for Result Details');
            }
          }
        }
      })
  }
  show_list();
  show_all_repair_analysis_result_details_list();
  show_all_result_details_list();
</script>

<script type="text/javascript">
  function show_status_filter() {
    get_repair_order_status().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[data-filter="status_id"]').html(options);
          if (url_params.hasOwnProperty('status_id')) {
            $("[data-filter='status_id'] option[value=" + url_params.status_id + "]").prop('selected', true);
          } else {
            $("[data-filter='status_id'] option[value=OPEN]").prop('selected', true);
            //set_params('status_id', 'OPEN')
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_status_filter()
</script>

<script type="text/javascript">
  function show_class_filter() {
    get_repair_order_class().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[data-filter="class_id"]').html(options);
          if (url_params.hasOwnProperty('class_id')) {
            $("[data-filter='class_id'] option[value=" + url_params.class_id + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_class_filter()
</script>

<script type="text/javascript">
  function show_type_filter(param) {
    get_repair_order_type(param).then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[data-filter="type_id"]').html(options);
          if (url_params.hasOwnProperty('type_id')) {
            $("[data-filter='type_id'] option[value=" + url_params.type_id + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_type_filter()
</script>

<script type="text/javascript">
  function show_drivers() {
    quick_list_drivers().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.code + ' ' + item.name + `</option>`;
          })
          $('[data-filter="driver_id"]').html(options);
          if (url_params.hasOwnProperty('driver_id')) {
            $("[data-filter='driver_id'] option[value=" + url_params.driver_id + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_drivers()
</script>

<script type="text/javascript">
  function show_stage_filter(param) {
    get_repair_order_stage(param).then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[data-filter="stage_id"]').html(options);
          if (url_params.hasOwnProperty('stage_id')) {
            $("[data-filter='stage_id'] option[value=" + url_params.stage_id + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_stage_filter()
</script>

<script type="text/javascript">
  function show_unittype_filter() {
    get_vehicles().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[data-filter="vehicle_type"]').html(options);
          if (url_params.hasOwnProperty('vehicle_type')) {
            $("[data-filter='vehicle_type'] option[value=" + url_params.vehicle_type + "]").prop('selected', true);
            show_unit_filter({
              vehicle_type: url_params.vehicle_type
            })
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_unittype_filter()
</script>

<datalist id="quick_list_vehicle_id"></datalist>
<script type="text/javascript">
  $(document.body).on('change', '[data-vehicle-id]' ,function(){
     id_selected=$(`[data-vehicle-id-rows="${$(this).val()}"]`).data('value');
    if(id_selected!=undefined){
     $(this).data('vehicle-id', id_selected)
     set_params('vehicle_id', id_selected)
     set_params('vehicle_code', $(`[data-vehicle-id]`).val())
     goto_page(1)
    }
  });
  </script>

<script type="text/javascript">
  function show_unit_filter(param) {
    // to make filter blank by swaran
    if (param.vehicle_type == '') {
     // $('[data-filter="vehicle_id"]').html('');
     $('#quick_list_vehicle_id').html('');
    }
    // to make filter blank by swaran ENDS here
    else if (param.vehicle_type == 'TRUCK') {
      quick_list_trucks().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
           // options += `<option value="">- - Select - -</option>`
           options+=`<option data-vehicle-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-vehicle-id-rows="`+item.code+`" data-value="${item.id}" value="`+item.code+`"></option>`;
             // options += `<option value="` + item.id + `">` + item.code + `</option>`;   //old code
            })
            $('#quick_list_vehicle_id').html(options);
            //$('[data-filter="vehicle_id"]').html(options);   //old code
             if (url_params.hasOwnProperty('vehicle_code')) {
              $(`[data-vehicle-id]`).val(check_url_params('vehicle_code'))
             // $("[data-filter='vehicle_id'] option[value=" + url_params.vehicle_id + "]").prop('selected', true);
             }
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    } else if (param.vehicle_type == 'TRAILER') {
      quick_list_trailers().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options+=`<option data-vehicle-id-rows="" data-value="" value="">- - Select - -</option>`
           // options += `<option value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-vehicle-id-rows="`+item.code+`" data-value="${item.id}" value="`+item.code+`"></option>`;
              //options += `<option value="` + item.id + `">` + item.code + `</option>`;
            })
            //$('[data-filter="vehicle_id"]').html(options);
            $('#quick_list_vehicle_id').html(options);
            if (url_params.hasOwnProperty('vehicle_code')) {
              $(`[data-vehicle-id]`).val(check_url_params('vehicle_code'))
             // $("[data-filter='vehicle_id'] option[value=" + url_params.vehicle_id + "]").prop('selected', true);
            }
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    }
  }
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on("click", "[data-action='delete']", function() {
      if (confirm('Do you want to delete job work ?')) {
        var eid = $(this).data("eid");
        $.ajax({
          url: window.location.href + '/delete-action',
          type: 'POST',
          data: {
            delete_eid: eid
          },
          context: this,
          success: function(data) {
            if ((typeof data) == 'string') {
              data = JSON.parse(data)
            }
            if (data.status) {
              $(this).parent().parent().fadeOut();
            } else {
              alert(data.message)
            }
          }
        })
      }
    });
  });
</script>
<script type="text/javascript">
  function on_change_class(value) {
    show_list();
    //show_type_filter({class:value});
  }
</script>
<script type="text/javascript">
  function sort_table() {
    show_list()
  }
</script>
<!-- <script type="text/javascript">
  $(window).on('popstate', function() {
    location.reload(true);
  });
</script> -->
<br><br><br><br>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>