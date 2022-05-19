<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1400px">
  <h1 class="list-200-heading">Work Order List</h1>
  <section class="list-200-top-action">
    <div class="list-200-top-action-left">
      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
      <!-- //input used for sort by call-->
      <div class="filter-item">
        <label>ID</label>
        <input type="text" data-filter="id" onchange="set_params('id', this.value), goto_page(1)">
      </div>
      <div class="filter-item">
        <label>Vendor Name</label>
        <!-- <select data-filter="vendor_id" style="text-overflow: ellipsis;overflow: hidden !important;max-width: 300px" onchange="set_params('vendor_id', this.value), goto_page(1)"></select> -->
        <input type="text" list="quick_list_vendors" data-filter="vendor_id" data-vendor-id>
        <datalist id="quick_list_vendors"></datalist>
      </div>
      <div class="filter-item">
        <label>Vehicle Type</label>
        <select data-filter="vehicle_type" onchange="$(`[data-vehicle-id]`).val(''),set_params('vehicle_type', this.value),set_params('vehicle_code', ''),set_params('vehicle_id', ''),goto_page(1), show_unit_filter({vehicle_type:this.value}),switch_vid_attr()"></select>
        <!-- <select data-filter="vehicle_type" onchange="set_params('vehicle_type', this.value),set_params('vehicle_id', ''), goto_page(1), show_unit_filter({vehicle_type:this.value})"></select> -->
      </div>
      <div class="filter-item">
        <label>Vendor State</label>
        <select data-filter="vendor_state_id" type="text" onchange="set_params('vendor_state_id', this.value),set_params('vendor_city_id', ''),goto_page(1), show_cities({state_id:this.value})">
        </select>
      </div>
      <div class="filter-item">
        <label>Vehicle ID</label>
        <input type="text" data-filter="vehicle_id" list="quick_list_vehicle_id" data-vehicle-id>
        <!-- <select data-filter="vehicle_id" onchange="set_params('vehicle_id', this.value), goto_page(1)">
        </select> -->
      </div>
      <div class="filter-item">
        <label>Vendor City</label>
        <select data-filter="vendor_city_id" onchange="set_params('vendor_city_id', this.value), goto_page(1)" disabled>
        </select>
      </div>
      <div class="filter-item">
        <label>Repair Order Status</label>
        <select data-filter="repair_order_status" onchange="set_params('repair_order_status', this.value), goto_page(1)">
        </select>
      </div>
      <div class="filter-item">
        <label>Repair Order ID</label>
         <input type="text" data-filter="repair_order_id" onchange="set_params('repair_order_id', this.value), goto_page(1)">
        </select>
      </div>
      <div class="filter-item">
        <label>Amount</label>
        <input type="text" data-filter="amount" onchange="set_params('amount', this.value), goto_page(1)">
        </select>
      </div>
       
      <div class="filter-item">
        <label>Added By</label>
        <select data-filter="added_by_user_name" onchange="set_params('added_by_user_name', this.value), goto_page(1)">
        </select>
      </div>
      <div class="filter-item">
        <label>Date From</label>
        <input type="text" data-filter="date_from" data-date-picker onchange="set_params('date_from', this.value), goto_page(1)">
        </input>
      </div>
      <div class="filter-item">
        <label>Date To</label>
        <input type="text" data-filter="date_to" data-date-picker onchange="set_params('date_to', this.value), goto_page(1)">
        </input>
      </div> 
      <div class="filter-item">
        <label>Approval Status</label>
        <select name="status_id" onchange="set_params('status_id', this.value), goto_page(1)">
        </select>
      </div>
  </section>
  <div class="table  table-a">
    <input type='hidden' id='sort' value='asc'>
    <table data-ro-table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th data-table-sort-by="id">ID</th>
          <th data-table-sort-by="date">Date</th>
          <th data-table-sort-by="repair_order_id">Repair Order ID</th>
          <th data-table-sort-by="repair_order_status">Repair Order Status</th>
          <th data-table-sort-by="vehicle">Vehicle</th>
          <th data-table-sort-by="vehicle_code">Vehicle Code</th>
          <th data-table-sort-by="vehicle_hours">Vehicle Hours</th>
          <th data-table-sort-by="odometer">Odometer</th>
          <th data-table-sort-by="vendor">Vendor</th>
          <th data-table-sort-by="city">City, State</th>
          <th data-table-sort-by="amount">Amount</th>
          <th>Approval Status</th>
          <th data-table-sort-by="invoice_no">Invoice No.</th>
          <th data-table-sort-by="Invoice">Invoice</th>
          <th data-table-sort-by="payment_status">Payment Status</th>
          <th data-table-sort-by="payment_mode">Payment Mode</th>
          <th data-table-sort-by="payment_ref">Payment Ref No.</th>
          <th data-table-sort-by="payment_date">Payment Date</th>
          <th data-table-sort-by="payment_remarks">Payment Remarks</th>
          <th>Reconciliation Status</th>
          <th>Created By</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tabledata"></tbody>
    </table>
    </div>
<div data-pagination></div>
</section>

<script type="text/javascript">
  // $(document).ready(function () {
  //   showGraph();
  // });

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

<script type="text/javascript">
 var url_params = get_params();
  if (url_params.hasOwnProperty('id')) {
    $("[data-filter='id']").val(url_params.id);
  }
  if (url_params.hasOwnProperty('amount')) {
    $("[data-filter='amount']").val(url_params.amount);
  }
  if (url_params.hasOwnProperty('date_from')) {
    $("[data-filter='date_from']").val(url_params.date_from);
  }
  if (url_params.hasOwnProperty('date_to')) {
    $("[data-filter='date_to']").val(url_params.date_to);
  }
  if (url_params.hasOwnProperty('added_by_user_name')) {
    $("[data-filter='added_by_user_name'] option[value=" + url_params.added_by_user_name + "]").prop('selected', true);
  }
  if (url_params.hasOwnProperty('repair_order_id')) {
    $("[data-filter='repair_order_id']").val(url_params.repair_order_id);
  }
  </script>

<!-- <script type="text/javascript">
  function on_state_change(param) {
    show_list()
    show_cities()
  }
</script> -->
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
  function show_list() {
    var sort_by = $('#sort_by').val();
    var sort_by_order_type = $('#sort').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;

    var id = check_url_params('id')
    var vehicle_type = check_url_params('vehicle_type')
    var vehicle_id = check_url_params('vehicle_id')
    var repair_order_id = check_url_params('repair_order_id')
    var repair_order_status = check_url_params('repair_order_status')
    var vendor_id = check_url_params('vendor_id')
    var vendor_state_id = check_url_params('vendor_state_id')
    var vendor_city_id = check_url_params('vendor_city_id')
    var amount = check_url_params('amount')
    var date_from = check_url_params('date_from')
    var date_to = check_url_params('date_to')
    var added_by_user_name = check_url_params('added_by_user_name')
    var status_id = (check_url_params('status_id') != undefined) ? check_url_params('status_id') : "ALL";
    $.ajax({
      url: location.pathname + '-ajax',
      type: 'POST',
      beforeSend: function() {
        show_table_data_loading('[data-ro-table]')
      },
      data: {
        sort_by: sort_by,
        sort_by_order_type:sort_by_order_type,
        page: page_no,
        batch: batch,
        repair_order_id:repair_order_id,
        id: id,
        vehicle_type: vehicle_type,
        vehicle_id: vehicle_id,
        repair_order_status: repair_order_status,
        vendor_id: vendor_id,
        vendor_state_id: vendor_state_id,
        vendor_city_id: vendor_city_id,
        amount: amount,
        date_from: date_from,
        date_to: date_to,
        added_by_user_name: added_by_user_name,
        status_id:status_id
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          $('#tabledata').html("");
          if (data.status) { 
            $.each(data.response.list, function(index, item) {
              var row = `<tr>
           <td>${item.sr_no}</td>
           <td>${item.id}</td>
           <td>${item.date}</td>
           <td>${item.repair_order_id}</td>
           <td>${item.repair_order_status}</td>
           <td>${item.vehicle_type}</td>
           <td>${item.vehicle_code}</td>
           <td>${item.engine_hours}</td>
           <td>${item.odometer_reading}</td>
           <td>${item.vendor_name}</td>`;
           if(item.vendor_city_name !="" || item.vendor_state_name !=""){
          row+=` <td>${item.vendor_city_name},<br>${item.vendor_state_name} </td>`;
           }
          else{
            row+=`<td></td>`;
          }
          row+=` <td>${item.amount}</td>

          `;
              if (item.approval_status.indexOf('APPROVED') >= 0) {
                row += `<td style="background-color:lightgreen">${item.approval_status}</td>`;
              } else if (item.approval_status.indexOf('APPROVED') <= -1 && item.approval_status.indexOf('RFC') >= 0) {
                row += `<td style="background-color:#fff0b3">${item.approval_status}</td>`;
              } else {
                row += `<td style="background-color:white">${item.approval_status}</td>`;
              }
              row += `

          <td>${item.invoice_no}</td>`
              if (item.invoice_file != '') {
                row += `<td><span onclick='open_document("${item.invoice_file}")' class="fa fa-file" title="View Invoice" style="color:  grey;cursor:pointer;"></span></td>`;
              } else {
                row += '<td></td>';
              }
              row += `<td>${item.payment_status}</td>
          <td>${item.payment_mode}</td>
          <td>${item.payment_ref_no}</td>
          <td>${item.payment_date}</td>
          <td>${item.payment_remarks}</td>
          <td>${item.status}</td>
          <td>${item.added_by_user_code} ${item.added_by_user_name}
          <br>
          ${item.added_on_datetime}</td>
          <td style="white-space:nowrap">`;
              row += `<button title="View" class="btn_grey_c"><a href="../user/maintenance/work-orders/details?eid=${item.eid}"><i class="fa fa-eye"></i></a></button>`;
              <?php
              if (in_array('P0234', USER_PRIV)) {
              ?>
                row += `<button title="Edit" class="btn_grey_c"><a href="../user/maintenance/work-orders/update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button>`;
              <?php
              }
              if (in_array('P0235', USER_PRIV)) {
              ?>
                row += `<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="${item.eid}"><i class="fa fa-trash"></i></button>`;
              <?php
              } ?>
              row += `</td> 
         </tr>`;
              $('#tabledata').append(row);
            })
            set_pagination({
              selector: '[data-pagination]',
              totalPages: data.response.totalPages,
              currentPage: data.response.currentPage,
              batch: data.response.batch
            })
          } else {
             $('#tabledata').html("");
    var row=`<tr><td colspan="20">`+data.message+`</td></tr>`;
    $('#tabledata').append(row);
      $('[data-pagination]').html('');
       if(check_url_params('page_no') > 1){
            goto_page(1);
          }
          } 
        }
      }
    })
  }
  show_list()
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
          $('[data-filter="repair_order_status"]').html(options);
          if (url_params.hasOwnProperty('repair_order_status')) {
            $("[data-filter='repair_order_status'] option[value=" + url_params.repair_order_status + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_status_filter()
</script>
<!-- <script type="text/javascript">
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
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_class_filter()
</script> -->
<!-- <script type="text/javascript">
  function show_drivers() {
    get_drivers().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.code + ' ' + item.name_first + `</option>`;
          })
          $('[data-filter="driver_id"]').html(options);
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_drivers()
</script> -->
<!-- <script type="text/javascript">
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
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_stage_filter()
</script> -->
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
          switch_vid_attr();
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
    if (param.vehicle_type == '') {
     // $('[data-filter="vehicle_id"]').html('');
     $('#quick_list_vehicle_id').html('');
    }
    else if (param.vehicle_type == 'TRUCK') {
      quick_list_trucks().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            //options += `<option value="">- - Select - -</option>`
            options+=`<option data-vehicle-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
             // options += `<option value="` + item.id + `">` + item.code + `</option>`;
             options+=`<option data-vehicle-id-rows="`+item.code+`" data-value="${item.id}" value="`+item.code+`"></option>`;
            })
            $('#quick_list_vehicle_id').html(options);
            //$('[data-filter="vehicle_id"]').html(options);
            if (url_params.hasOwnProperty('vehicle_code')) {
              $(`[data-vehicle-id]`).val(check_url_params('vehicle_code'))
             // $("[data-filter='vehicle_code'] option[value=" + url_params.vehicle_code + "]").prop('selected', true);
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
            //options += `<option value="">- - Select - -</option>`
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
      if (confirm('Do you want to delete work order ?')) {
        var eid = $(this).data("eid");

        $.ajax({
          url: window.location.origin+window.location.pathname+ '/delete-action',

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
              show_list();
              alert(data.message)
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
<script type="text/javascript">
  get_maintenace_vendors().then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option data-vendor-filter-rows="" data-name="" data-value="" value="">- - Select - -</option>`
        // options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option data-vendor-filter-rows="` + item.id + ' ' + item.name + `"  data-value="${item.id}" value="` + item.id + ` ` + item.name +`"></option>`;
        })
        // $('[data-filter="vendor_id"]').html(options);
        $('#quick_list_vendors').html(options);
        if (url_params.hasOwnProperty('vendor_name')) {
            // $("[data-filter='vendor_id'] option[value=" + url_params.vendor_id + "]").prop('selected', true);
            $(`[data-vendor-id]`).val(check_url_params('vendor_name'))
          }
      }
    }
  })
</script>
<script type="text/javascript">
  $(document.body).on('input', '[data-vendor-id]', function() {
    //alert("hhhh")
    id_selected = $(`[data-vendor-filter-rows="${$(this).val()}"]`).data('value');
    if (id_selected != undefined) {
      $(this).data('vendor-id', id_selected)
      set_params('vendor_id', id_selected)
      set_params('vendor_name', $(`[data-vendor-id]`).val())
      goto_page(1)
    }
  });
</script>
<script type="text/javascript">
  $(document.body).on('change', '[data-vendor-id]', function() {
    id_selected = $(`[data-vendor-filter-rows="${$(this).val()}"]`).data('value');
    if (id_selected == undefined) {
      alert("Please enter correct Vendor ID")
      set_params('vendor_id', '')
      set_params('vendor_name', '')
      $(`[data-vendor-id]`).val('').focus();
      goto_page(1)
    }
  });
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
        $('[data-filter="vendor_state_id"]').html(options);
        if (url_params.hasOwnProperty('vendor_state_id')) {
            $("[data-filter='vendor_state_id'] option[value=" + url_params.vendor_state_id + "]").prop('selected', true);
            show_cities({
            state_id: url_params.vendor_state_id
          })
          }
      }
    }
  })
</script>
<script type="text/javascript">
  function show_cities(param) {
     if (param.state_id === '') {
      $('[data-filter="vendor_city_id"]').html('');
      $('[data-filter="vendor_city_id"]').prop('disabled', 'disabled');
    }
    else if (param.state_id !== ''){
      $('[data-filter="vendor_city_id"]').prop('disabled', false);
    get_cities(param).then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            //console.log(item)
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[data-filter="vendor_city_id"]').html(options);
          if (url_params.hasOwnProperty('vendor_city_id')) {
              $("[data-filter='vendor_city_id'] option[value=" + url_params.vendor_city_id + "]").prop('selected', true);
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
  var urlParamsValue = "";
  var url_params = get_params();
  if (url_params.hasOwnProperty('status_id')) {
    urlParamsValue = url_params.status_id;
  } else {
    set_params('status_id', 'ALL');
    urlParamsValue = url_params.status_id;
  }
  if (url_params.hasOwnProperty('id')) {
    $("[data-filter='id']").val(url_params.id);
  }
</script>

<script type="text/javascript">
  function show_status_filter_1() {
    get_workorder_status_approved().then(function(data) {
      if (data.status) {
        if (data.response.list) {
          var options = "";
          //options += `<option value="">PENDING & RFC</option>`
          if(urlParamsValue == "ALL") {
            options += `<option value="ALL" selected>ALL</option>`;
          } else {
            options += `<option value="ALL">ALL</option>`;
          }
         
          $('[name="status_id"]').html(options);
          //console.log(urlParamsValue);
          $.each(data.response.list, function(index, item) {
            //console.log(item);
            if (urlParamsValue ==  item.id ){
              options += `<option value="` + item.id + `" selected>` + item.name + `</option>`;
            } else if(urlParamsValue == item.id) {
              options += `<option value="` + item.id + `" selected>` + item.name + `</option>`;
            } else {
              options += `<option value="` + item.id + `">` + item.name + `</option>`;
            }
          })
          $('[name="status_id"]').html(options);
        }
      }
    }).catch(function(err) {})
  }
  show_status_filter_1()
</script>

<script>
  $(document.body).on('change', "[data-filter='date_from']", function() {
    var g1 = new Date(check_url_params('date_from'))
    var g2 = new Date(check_url_params('date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Date From should be less than from Date To")
      $("[data-filter='date_from']").val("").focus();
      set_params('date_from', "")
      goto_page(1)
    }
  });

  $(document.body).on('change', "[data-filter='date_to']", function() {
    var g1 = new Date(check_url_params('date_from'))
    var g2 = new Date(check_url_params('date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Date To should be greater than from Date From")
      $("[data-filter='date_to']").val("").focus();
      set_params('date_to', "")
      goto_page(1)
    }
  });
</script>

<br><br><br><br>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>