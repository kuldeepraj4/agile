<?php
require_once APPROOT . '/views/includes/user/header.php';
// $page = isset($_GET['page']) ? $_GET['page'] : 1;
//$vehicle_type=isset($_GET['vehicle_type'])?$_GET['vehicle_type']:'';
?>
<br><br>

<style type="text/css">
  #chart-container {
    width: 100%;
    height: auto;
  }
</style>

<section class="list-200 content-box" style="margin: auto;">
  <h1 class="list-200-heading">Repair Order List</h1>
  <section class="list-200-top-action">
    <div class="list-200-top-action-left">
      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
      <!-- //input used for sort by call-->
      <div class="filter-item">
        <label>Order ID</label>
        <input type="text" data-filter="id" onchange="set_params('id', this.value), goto_page(1), showGraph()">
      </div>
      <div class="filter-item">
        <label>Driver</label>
        <select data-filter="driver_id" onchange="set_params('driver_id', this.value), goto_page(1), showGraph()">
        </select>
      </div>
      <div class="filter-item">
        <label>Class</label>
        <select data-filter="class_id" onchange="set_params('class_id', this.value), goto_page(1), showGraph()">
        </select>
      </div>
      <div class="filter-item">
        <label>Status</label>
        <select data-filter="status_id" onchange="set_params('status_id', this.value), goto_page(1), showGraph()">
        </select>   
      </div>
      <div class="filter-item">
        <label>Vehicle Type</label>
        <select data-filter="vehicle_type" onchange="$(`[data-vehicle-id]`).val(''),set_params('vehicle_type', this.value),set_params('vehicle_code', ''),set_params('vehicle_id', ''),switch_vid_attr(),goto_page(1), show_unit_filter({vehicle_type:this.value}), showGraph()"></select>
      </div>
      <div class="filter-item">
        <label>Type</label>
        <select data-filter="type_id" onchange="set_params('type_id', this.value), goto_page(1), showGraph()">
        </select>
      </div>
      <div class="filter-item">
        <label>Vehicle ID</label>
        <input type="text" data-filter="vehicle_id" list="quick_list_vehicle_id" onchange="showGraph()" data-vehicle-id disabled>
        <!-- <select data-filter="vehicle_id" onchange="set_params('vehicle_id', this.value), goto_page(1)">        //old method
        </select> -->
      </div>
      <div class="filter-item">
        <label>Stage</label>
        <select data-filter="stage_id" onchange="set_params('stage_id', this.value), goto_page(1), showGraph()">
        </select>
      </div> 
      <div class="filter-item">
        <label>Created Date From</label>
        <input type="text" data-filter="created_date_from" data-date-picker onchange="set_params('created_date_from', this.value), goto_page(1), showGraph()">
      </input>
    </div>
    <div class="filter-item">
      <label>Created Date To</label>
      <input type="text" data-filter="created_date_to" data-date-picker onchange="set_params('created_date_to', this.value), goto_page(1), showGraph()">
    </input>
  </div>  
  <div class="filter-item">
    <label>Created By</label>
    <select data-filter="added_by_user_name" onchange="set_params('added_by_user_name', this.value), goto_page(1), showGraph()">
    </select>
  </div>
  <div class="filter-item">
    <label>Resolved By</label>
    <select data-filter="resolved_by_user_name" onchange="set_params('resolved_by_user_name', this.value), goto_page(1), showGraph()">
    </select>
  </div>

  <div class="filter-item">     
  </div>
</div>
<div class="list-200-top-action-right">

  <div id="chart-container" style="margin-right:10px">
    <canvas id="graphCanvas"></canvas>
  </div>
  <div>   
    <?php
    if (in_array('P0226', USER_PRIV)) {
      echo "<button style='display:block;padding 5px 10px;' class='btn_grey' onclick='showAlert()'>Add New</button>";
          //echo "<button class='btn_grey button_href' onclick='showAlert()'><a href='../user/maintenance/repair-orders/add-new'>Add New</a></button>";
    }
    ?>
  </div>
</div>
</section>
<div class="table  table-a">
  <table data-ro-table>
    <input type='hidden' id='sort' value='asc'>
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th data-table-sort-by="id">Order ID</th>
        <th data-table-sort-by="created_on">Created on</th>
        <th data-table-sort-by="status">Status</th>
        <th data-table-sort-by="class">Class</th>
        <th data-table-sort-by="type">Type</th>
        <th data-table-sort-by="driver">Driver</th>
        <th data-table-sort-by="stage">Stage</th>
        <th>Vendor <br/>City, <br/>State</th>
        <th>Yard <br/>City, <br/>State</th>
        <th data-table-sort-by="vehicle">Vehicle</th>
        <th data-table-sort-by="vehicle_id">Vehicle ID</th>
        <th data-table-sort-by="start_date">Start Date</th>
        <th data-table-sort-by="end_date">End Date</th>
        <th style="min-width:500px;" data-table-sort-by="last_follow_up">Last Follow Up</th>
        <th data-table-sort-by="next_follow_up">Next Follow Up Date</th>
        <th style="text-align: left;" data-table-sort-by="issues_reported">Issues Reported</th>
        <th style="text-align: left;" data-table-sort-by="issues_description">Issues Description</th>
        <th>Created By</th>
        <th>Resolved By</th>
        <th>Closed By</th>
        <th>Action</th>
        <th></th>
      </tr>
    </thead>
    <tbody id="tabledata"></tbody>
  </table>
</div>
<div data-pagination></div>
</section>

<script type="text/javascript">
  $(document).ready(function () {
    showGraph();
  });

  function showGraph()
  {
    var sort_by = $('#sort_by').val();
    var sort_by_order_type = $('#sort').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var id = check_url_params('id')
    var driver_id = check_url_params('driver_id')
    var class_id = check_url_params('class_id')
    var status_id = check_url_params('status_id')
    var vehicle_type = check_url_params('vehicle_type')
    var type_id = check_url_params('type_id')
    var vehicle_id = check_url_params('vehicle_id')
    var stage_id = check_url_params('stage_id')
    var created_date_from = check_url_params('created_date_from')
    var created_date_to = check_url_params('created_date_to')
    var added_by_user_name = check_url_params('added_by_user_name')
    var resolved_by_user_name = check_url_params('resolved_by_user_name')
      //$.post('user/maintenance/repair-orders-graph',
      $.ajax({
        url: location.pathname + '-graph',
        type: 'POST',
        data: {
          class_id: class_id,
          id: id,
          vehicle_type: vehicle_type,
          status_id: status_id,
          vehicle_id: vehicle_id,
          type_id: type_id,
          driver_id: driver_id,
          stage_id: stage_id,
          created_date_from: created_date_from,
          created_date_to: created_date_to,
          added_by_user_name: added_by_user_name,
          resolved_by_user_name: resolved_by_user_name,
        },
        success: function (data)
        {
         if ((typeof data) == 'string') {
          datas = JSON.parse(data);
          var name = [];
          var marks = [];
          for (var i in datas.response.data) {
            name.push(datas.response.data[i].student_name);
            marks.push(datas.response.data[i].marks);
          }
          var chartdata = {
            labels: name,
            datasets: [
            {
              label: 'Counts',
              backgroundColor: '#002346',
              borderColor: '#46d5f1',
              hoverBackgroundColor: '#CCCCCC',
              hoverBorderColor: '#666666',
              data: marks
            }
            ]
          };
          var graphTarget = $("#graphCanvas");
          var barGraph = new Chart(graphTarget, {
            type: 'bar',
            data: chartdata
          });
        }
      }
      });
    }
  </script>

  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/Chart.min.js"></script>

  <!-- code for making filters compulsory  to enable add button by swaran START HERE  -->
  <script type="text/javascript">
    function showAlert() {
      var default_params = get_params();
      var show_add=true;
      if('class_id' in default_params == false || default_params['class_id'] == undefined || default_params.class_id === "") {
        alert('Please select Class')
        show_add=false;
      } 
      else if('vehicle_type' in default_params == false || default_params['vehicle_type'] == undefined || default_params.vehicle_type === "") {
        alert('Please select Vehicle Type')
        show_add=false;
      } 
      else if('vehicle_id' in default_params == false || default_params['vehicle_id'] == undefined || default_params.vehicle_id === "") {
        alert('Please select Vehicle ID')
        show_add=false;
    } //else {
      else if(show_add=true)
        if($("[data-filter='st']").html() === 'OPEN'){
          var r = confirm("RO is already opened for this unit\nDo you want to proceed ?");
          if (r == true) {
            var url = new URLSearchParams(default_params).toString()
            window.location.href = '../user/maintenance/repair-orders/add-new?' + url
          } else {
          } 
        }else{
          var url = new URLSearchParams(default_params).toString()
          window.location.href = '../user/maintenance/repair-orders/add-new?' + url
        }
      }
    </script>
    <!-- code for making filters compulsory  to enable add button by swaran END HERE -->
    <script type="text/javascript">
      var url_params = get_params();
      if (url_params.hasOwnProperty('status_id')) {} else {
        set_params('status_id', 'OPEN')
      }
      if (url_params.hasOwnProperty('id')) {
        $("[data-filter='id']").val(url_params.id);
      }
      if (url_params.hasOwnProperty('created_date_from')) {
        $("[data-filter='created_date_from']").val(url_params.created_date_from);
      }
      if (url_params.hasOwnProperty('created_date_to')) {
        $("[data-filter='created_date_to']").val(url_params.created_date_to);
      }
  // if (url_params.hasOwnProperty('added_by_user_name')) {
  //   $("[data-filter='added_by_user_name'] option[value=" + url_params.added_by_user_name + "]").prop('selected', true);
  // }
  // if (url_params.hasOwnProperty('resolved_by_user_name')) {
  //   $("[data-filter='resolved_by_user_name'] option[value=" + url_params.resolved_by_user_name + "]").prop('selected', true);
  // }
</script>

<script type="text/javascript">
  function added_by() {
    quick_list_users().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[data-filter="added_by_user_name"]').html(options);
          if (url_params.hasOwnProperty('added_by_user_name')) {
            $("[data-filter='added_by_user_name'] option[value=" + url_params.added_by_user_name + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  added_by()
</script>
<script type="text/javascript">
  function resolved_by() {
    quick_list_users().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[data-filter="resolved_by_user_name"]').html(options);
          if (url_params.hasOwnProperty('resolved_by_user_name')) {
            $("[data-filter='resolved_by_user_name'] option[value=" + url_params.resolved_by_user_name + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  resolved_by()
</script>

<script>
  $(document.body).on('change', "[data-filter='created_date_from']", function() {
    var g1 = new Date(check_url_params('created_date_from'))
    var g2 = new Date(check_url_params('created_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Created Date From should be less than from Created Date To")
      $("[data-filter='created_date_from']").val("").focus();
      set_params('created_date_from', "")
      goto_page(1)
    }
  });

  $(document.body).on('change', "[data-filter='created_date_to']", function() {
    var g1 = new Date(check_url_params('created_date_from'))
    var g2 = new Date(check_url_params('created_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Created Date To should be greater than from Created Date From")
      $("[data-filter='created_date_to']").val("").focus();
      set_params('created_date_to', "")
      goto_page(1)
    }
  });
</script>

<script type="text/javascript">
  function show_list() {
    var sort_by = $('#sort_by').val();
    var sort_by_order_type = $('#sort').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var id = check_url_params('id')
    var driver_id = check_url_params('driver_id')
    var class_id = check_url_params('class_id')
    var status_id = check_url_params('status_id')
    var vehicle_type = check_url_params('vehicle_type')
    var type_id = check_url_params('type_id')
    var vehicle_id = check_url_params('vehicle_id')
    var stage_id = check_url_params('stage_id')
    var created_date_from = check_url_params('created_date_from')
    var created_date_to = check_url_params('created_date_to')
    var added_by_user_name = check_url_params('added_by_user_name')
    var resolved_by_user_name = check_url_params('resolved_by_user_name')
    $.ajax({
      url: location.pathname + '-ajax',
      type: 'POST',
      data: {
        sort_by_order_type:sort_by_order_type,
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
        created_date_from: created_date_from,
        created_date_to: created_date_to,
        added_by_user_name: added_by_user_name,
        resolved_by_user_name: resolved_by_user_name,
      },
      beforeSend: function() {
        show_table_data_loading('[data-ro-table]')
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)

          $('#tabledata').html("");
          if (data.status) {

            var counter = 0;
            $.each(data.response.list, function(index, item) {
// console.log(item)
issue_reported = []
issue_description = []
$.each(item.issues_list, function(in2, it2) {
  if (it2['issue_reported'] != "") {
    issue_reported.push(it2['issue_reported'])
    issue_description.push(it2['issue_description'])
  }
})
issue_reported = (issue_reported.length > 0) ? issue_reported.join(',<br>') : ''
issue_description = (issue_description.length > 0) ? issue_description.join(',<br>') : ''
counter++;
var row = `<tr>
<td>${item.sr_no}</td>
<td>${item.id}</td>
<td>${item.added_on_datetime}</td>
<td data-filter="st">${item.status}</td>
<td>${item.class}</td>
<td>${item.type}</td>
<td>${item.driver_code} ${item.driver_name}</td>
<td>${item.stage}</td>
<td>${item.vendor_name}  ${item.vendor_city_name} ${item.vendor_state_name}</td>
<td>${item.yard_name}  ${item.yard_city_name} ${item.yard_state_name}</td>
<td>${item.vehicle_type}</td>
<td>${item.vehicle_code}</td>
<td>${item.start_date}</td>`;
if (item.end_date < '12/31/1799') {

  row += `<td>${item.end_date}</td>`;
}else{
  row += `<td></td>`;
} 
row += `
<td>${item.last_follow_up}</td>
<td>${item.next_follow_up_datetime}</td>
<td style="min-width:150px;text-align:left">${issue_reported}</td>
<td style="min-width:150px;text-align:left">${issue_description}</td>
<td>${item.added_by_user_code} ${item.added_by_user_name} ${item.added_on_datetime}</td>
<td>${item.ro_resolved_by} ${item.ro_resolved_on}</td>
<td>${item.closed_by_user_code} ${item.closed_by_user_name} ${item.closed_on_datetime}</td>
<td></td>
<td style="white-space:nowrap">`;
<?php
if (in_array('P0228', USER_PRIV)) { 
  ?>
  row += `<button title="View" class="btn_grey_c"><a href="../user/maintenance/repair-orders/details?eid=${item.eid}"><i class="fa fa-eye"></i></a></button>`;
  <?php
}
if (in_array('P0229', USER_PRIV)) {
  ?>
  row += `<button title="Edit" class="btn_grey_c"><a href="../user/maintenance/repair-orders/update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button>`;
  <?php
}
              // if (in_array('P0230', USER_PRIV)) {
                ?>
              //   row += `<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="${item.eid}"><i class="fa fa-trash"></i></button>`;
              <?php
              // }
              if (in_array('P0232', USER_PRIV)) {
                ?>
                row += `<button class="btn_blue" onclick="open_child_window({url:'../user/maintenance/repair-orders/add-followup&eid=${item.eid}',width:1000,height:600})">Follow Up</button>`;
                if(item.status != 'CLOSED'){
                  row += `&nbsp;&nbsp;<button class="btn_blue"><a href="../user/maintenance/work-orders/add-new?ro-eid=${item.eid}">Create Work Order</a></button>`;
                }
                <?php
              } ?>
              row += `</td> 
              </tr>`;
              $('#tabledata').append(row);
              //stats.push(item.status) 
            })
            set_pagination({
              selector: '[data-pagination]',
              totalPages: data.response.totalPages,
              currentPage: data.response.currentPage,
              batch: data.response.batch
            })
          } else {
            $('[data-pagination]').html('')
            var false_message = `<tr><td colspan="18">` + data.message + `<td></tr>`;
            $('#tabledata').html(false_message);
            if(check_url_params('page_no') > 1){
            goto_page(1);
          }
          }
        }
      }
    })
}
show_list()
showGraph()
</script>
<script type="text/javascript">
  // function follup(){

  // }
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

  function bind_quick_list_drivers() {
    quick_list_drivers().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option data-driver-filter-rows="" data-name="" data-value="" value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option data-driver-filter-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" data-name="${item.name}" data-code="${item.code}" value="` + item.code + ' ' + item.name + `"></option>`;
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
  bind_quick_list_drivers()
</script>
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
      $(`[data-driver-id]`).val('').focus();
      goto_page(1)
    }
  });
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
          switch_vid_attr()
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
  $(document.body).on('input', '[data-vehicle-id]' ,function(){
    //alert("hhhh")
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
  $(document.body).on('change', '[data-vehicle-id]' ,function(){
   id_selected=$(`[data-vehicle-id-rows="${$(this).val()}"]`).data('value');
   if(id_selected==undefined){
    alert("Please enter correct VehicleID")
  }
});
</script>
<script type="text/javascript">
  function switch_vid_attr(){
    var attr = check_url_params('vehicle_type')
    if((attr =='TRAILER') || (attr =='TRUCK')){
      $(`[data-vehicle-id]`).prop('disabled', false)
    }else{
      $(`[data-vehicle-id]`).prop('disabled', true)
    }
  }
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