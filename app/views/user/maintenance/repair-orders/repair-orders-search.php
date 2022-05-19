<?php
require_once APPROOT . '/views/includes/user/header.php';
// $page = isset($_GET['page']) ? $_GET['page'] : 1;
//$vehicle_type=isset($_GET['vehicle_type'])?$_GET['vehicle_type']:'';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;">
  <h1 class="list-200-heading">Repair Order Search</h1>
  <section class="list-200-top-action">
    <div class="list-200-top-action-left">
      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
      <!-- //input used for sort by call-->
      <div class="filter-item">
        <label>Order ID</label>
        <input type="text" data-filter="id" onchange="set_params('id', this.value), goto_page(1)">
      </div>
      <div class="filter-item">
        <label>Driver</label>
        <select data-filter="driver_id" onchange="set_params('driver_id', this.value), goto_page(1)">
        </select>
      </div>
      <div class="filter-item">
        <label>Class</label>
        <select data-filter="class_id" onchange="set_params('class_id', this.value), goto_page(1)">
        </select>
      </div>
      <div class="filter-item">
        <label>Status</label>
        <select data-filter="status_id" onchange="set_params('status_id', this.value), goto_page(1)">
        </select>   
      </div>
      <div class="filter-item">
        <label>Vehicle Type</label>
        <select data-filter="vehicle_type" onchange="$(`[data-vehicle-id]`).val(''),set_params('vehicle_type', this.value),set_params('vehicle_code', ''),set_params('vehicle_id', ''),goto_page(1), show_unit_filter({vehicle_type:this.value})"></select>
      </div>
      <div class="filter-item">
        <label>Type</label>
        <select data-filter="type_id" onchange="set_params('type_id', this.value), goto_page(1)">
        </select>
      </div>
      <div class="filter-item">
        <label>Vehicle ID</label>
        <input type="text" data-filter="vehicle_id" list="quick_list_vehicle_id" data-vehicle-id>
        <!-- <select data-filter="vehicle_id" onchange="set_params('vehicle_id', this.value), goto_page(1)">        //old method
        </select> -->
      </div>
      <div class="filter-item">
        <label>Stage</label>
        <select data-filter="stage_id" onchange="set_params('stage_id', this.value), goto_page(1)">
        </select>
      </div>   
      <div class="filter-item">     
      </div>
    </div>
    <div class="list-200-top-action-right">
      <div>   
        <?php
        
        ?>
      </div>
    </div>
  </section>
  <div class="table  table-a">
    <table data-ro-table>
      <thead>
        <tr>
          <th>Sr No</th>
          <th>Order ID</th>
          <th>Created on</th>
          <th>Status</th>
          <th>Class</th>
          <th>Type</th>
          <th>Driver</th>
          <th>Stage</th>
          <th>Vehicle Type</th>
          <th>Vehicle ID</th>
          <th>Start Date</th>
          <th>Start Time</th>
          <th>End Date</th>
          <th>End Time</th>
          <th>Down Time</th>
        </tr>
      </thead>
      <tbody id="tabledata"></tbody>
    </table>
    <div data-pagination></div>
  </div>
</section>
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
    set_params('status_id', 'CLOSED')
  }
  if (url_params.hasOwnProperty('id')) {
    $("[data-filter='id']").val(url_params.id);
  }
</script>
<script type="text/javascript">
  function show_list() {
    var sort_by = $('#sort_by').val();
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
           <td>${item.vehicle_type}</td>
           <td>${item.vehicle_code}</td>
           <td>${item.start_date}</td>
           <td>${item.start_time}</td>
           <td>${item.end_date}</td>
           <td>${item.end_time}</td>
           <td>${item.down_time}</td>
     
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
            var false_message = `<tr><td colspan="18">` + data.message + `<td></tr>`;
            $('#tabledata').html(false_message);
          }
        }
      }
    })
  }
  show_list()

</script>
<script type="text/javascript">

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
            $("[data-filter='status_id'] option[value=CLOSED]").prop('selected', true);
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