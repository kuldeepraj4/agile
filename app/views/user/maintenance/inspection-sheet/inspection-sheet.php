<?php
require_once APPROOT . '/views/includes/user/header.php'; 
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 2400px">
  <h1 class="list-200-heading">Inspection Sheet List</h1>
  <section class="list-200-top-action">
    <div class="list-200-top-action-left">
      <input type="hidden" id="sort_by" value="">
      <div class="filter-item">
        <label>Status</label>
        <select data-filter="status_id" onchange="set_params('status_id', this.value), goto_page(1)">
        </select>
      </div>
      
      <div class="filter-item">
        <label>Inspection ID</label>
        <input type="text" data-filter="id" onkeyup="show_list(this.value)" onchange="set_params('id', this.value), goto_page(1)">
      </div>

      <div class="filter-item">
        <label>Driver ID</label>
        <input type="text" data-filter="driver_id" list="quick_list_driver_id" data-driver-id>
      </div>

      <div class="filter-item">
        <label>Truck ID</label>
        <input type="text" data-filter="truck_id" list="quick_list_truck_id" data-truck-id>
      </div>

      <div class="filter-item">
        <label>Violation Reported</label>
        <select data-filter="violation_id" onchange="set_params('violation_id', this.value), goto_page(1)">
        </select>
      </div>

      <div class="filter-item">
        <label>Trailer ID</label>
        <input type="text" data-filter="trailer_id" list="quick_list_trailer_id" data-trailer-id>
      </div>

      <div class="filter-item">
        <label>Company Name</label>
        <select data-filter="company_id" onchange="set_params('company_id', this.value), goto_page(1)">
        </select>
      </div>

      <div class="filter-item">
        <label>Level</label>
        <select data-filter="level_id" onchange="set_params('level_id', this.value), goto_page(1)">
              <option value="">- - Select - -</option>
              <option value="LEVEL 1">Level 1</option>
              <option value="LEVEL 2">Level 2</option>
              <option value="LEVEL 3">Level 3</option>
        </select>
      </div>

       <div class="filter-item">
        <label>Fault Reason Driver's</label>
        <select data-filter="asset_reason" onchange="set_params('asset_reason', this.value), goto_page(1)">
        </select>
      </div>

      <div class="filter-item">
        <label>Inspection Date</label>
        <input type="text" style="width: 136px" data-filter="from_date" from-date onchange="set_params('from_date', this.value), goto_page(1)" data-date-picker> - 
        <input type="text" style="width: 136px" data-filter="to_date" to-date onchange="set_params('to_date', this.value), goto_page(1)" data-date-picker>
      </div>
    </div>

    <div class="list-200-top-action-right">

      <div>

        <?php

        if (in_array('P0266', USER_PRIV)) {

          echo "<button class='btn_grey button_href'><a href='../user/maintenance/inspection-sheet/add-new'>Add New</a></button>";
        }

        ?>

      </div>

    </div>

  </section>

  <div class="table  table-a">
    <input type='hidden' id='sort' value='asc'>
    <table data-ro-table>

      <thead>

        <tr>

          <th>Sr. No.</th>
          <th data-table-sort-by="id" >Inspection ID</th>
          <th data-table-sort-by="inspection_date" >Inspection Date</th>
          <th data-table-sort-by="status" >Status</th>
          <th data-table-sort-by="driver_name" >Driver Name</th>
          <th data-table-sort-by="driver_id" >Driver ID</th>
          <th data-table-sort-by="driver_lic_no">Driver Lic. No.</th>
          <th data-table-sort-by="truck_id">Truck ID</th>
          <th>Truck VIN No.</th>
          <th data-table-sort-by="trailer_id">Trailer ID</th>
          <th>Trailer VIN No.</th>
          <th>Co-driver Name</th>
          <th>Co-driver ID</th>
          <th>Co-driver Lic. No.</th>
          <th>Company Name</th>
          <th>Fault Reason Driver's</th>
          <!-- <th>Location</th> -->
          <th>State</th>
          <th data-table-sort-by="time_from">Time From</th>
          <th data-table-sort-by="time_to">Time To</th>
          <th>Violation Reported</th>
          <th>Fine Amount</th>
          <th>Bond Amount</th>
          <th>Remarks</th>
          <th>Day Count</th>  
          <th>Level</th>
          <th>Created By</th>
          <th>Updated By</th>
          <th>Closed By</th>  
          <th>Violation Against</th>
          <th>Action</th>    
        </tr>

      </thead>

      <tbody id="tabledata"></tbody>

    </table>
  </div>
  <div data-pagination></div>
</section>
<script type="text/javascript">
  function show_reasons_list(){
     get_reasons_list().then(function(data) {
    // Run this when your request was successful
    if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        if(item.status == "ACT" || item.status == "ACTIVE") {
          options+=`<option value="`+item.id+`">`+item.name+`</option>`;     
        }          
      })
     $('[data-filter="asset_reason"]').html(options);
          select_default('[data-filter="asset_reason"]')    
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_reasons_list()
</script>
<script type="text/javascript">
  function load_violation_reported() {
    get_violation_reported_list().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
        })
          $('[data-filter="violation_id"]').html(options);
          select_default('[data-filter="violation_id"]')
      }
  }
}).catch(function(err) {
      // Run this when promise was rejected via reject()
  })
}
load_violation_reported()
</script>


<script type="text/javascript">
  var url_params = get_params();
  // if (url_params.hasOwnProperty('status_id')) {
  //   $("[data-filter='status_id'] option[value=" + url_params.status_id + "]").prop('selected', true);
  // }
  if (url_params.hasOwnProperty('status_id')) {} else {
    set_params('status_id', 'OPEN')
  }
  if (url_params.hasOwnProperty('truck_id')) {
    $("[data-filter='truck_id'] option[value=" + url_params.truck_id + "]").prop('selected', true);
  }
  if (url_params.hasOwnProperty('trailer_id')) {
    $("[data-filter='trailer_id'] option[value=" + url_params.trailer_id + "]").prop('selected', true);
  }
  if (url_params.hasOwnProperty('asset_reason')) {
    $("[data-filter='asset_reason'] option[value=" + url_params.asset_reason + "]").prop('selected', true);
  }
  if (url_params.hasOwnProperty('driver_id')) {
    $("[data-filter='driver_id'] option[value=" + url_params.driver_id + "]").prop('selected', true);
  }
  if (url_params.hasOwnProperty('violation_id')) {
    $("[data-filter='violation_id'] option[value=" + url_params.violation_id + "]").prop('selected', true);
  }
  if (url_params.hasOwnProperty('company_id')) {
    $("[data-filter='company_id'] option[value=" + url_params.company_id + "]").prop('selected', true);
  }
  if (url_params.hasOwnProperty('id')) {
    $("[data-filter='id']").val(url_params.id);
  }
  if (url_params.hasOwnProperty('from_date')) {
    $("[data-filter='from_date']").val(url_params.from_date);
  }
  if (url_params.hasOwnProperty('to_date')) {
    $("[data-filter='to_date']").val(url_params.to_date);
  }
    if (url_params.hasOwnProperty('level_id')) {
    $("[data-filter='level_id']").val(url_params.level_id);
  }
</script>

<datalist id="quick_list_truck_id"></datalist>
<script type="text/javascript">
  $(document.body).on('input', '[data-truck-id]' ,function(){
   id_selected=$(`[data-truck-id-rows="${$(this).val()}"]`).data('value');
   if(id_selected!=undefined){
     $(this).data('truck-id', id_selected)
     set_params('truck_id', id_selected)
     set_params('truck_code', $(`[data-truck-id]`).val())
     goto_page(1)
   }
 });

  $(document.body).on('change', '[data-truck-id]' ,function(){
   id_selected=$(`[data-truck-id-rows="${$(this).val()}"]`).data('value');
   if(id_selected==undefined){
    alert("Please enter correct Truck ID")
    id_selected=''
    set_params('truck_id', '')
    set_params('truck_code', '')
    goto_page(1)
    $(this).val('')
    $(this).focus()
  }
});
  
  quick_list_trucks().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options+=`<option data-truck-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-truck-id-rows="`+item.code+`" data-value="${item.id}" value="`+item.code+`"></option>`;
            })
            $('#quick_list_truck_id').html(options);
            if (url_params.hasOwnProperty('truck_code')) {
              $(`[data-truck-id]`).val(check_url_params('truck_code'))
            }
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    </script>

    <datalist id="quick_list_trailer_id"></datalist>
    <script type="text/javascript">
      $(document.body).on('input', '[data-trailer-id]' ,function(){
       id_selected=$(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
       if(id_selected!=undefined){
         $(this).data('trailer-id', id_selected)
         set_params('trailer_id', id_selected)
         set_params('trailer_code', $(`[data-trailer-id]`).val())
         goto_page(1)
       }
     });

      $(document.body).on('change', '[data-trailer-id]' ,function(){
       id_selected=$(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
       if(id_selected==undefined){
        alert("Please enter correct Trailer ID")
        id_selected=''
        set_params('trailer_id', '')
        set_params('trailer_code', '')
        goto_page(1)
        $(this).val('')
        $(this).focus()
      }
    });

      quick_list_trailers().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options+=`<option data-trailer-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-trailer-id-rows="` + item.code + `" data-value="${item.id}" value="` + item.code + `"></option>`;
            })
            $('#quick_list_trailer_id').html(options);
            if (url_params.hasOwnProperty('trailer_code')) {
              $(`[data-trailer-id]`).val(check_url_params('trailer_code'))
            }
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    </script>

    <datalist id="quick_list_driver_id"></datalist>
    <script type="text/javascript">
      $(document.body).on('input', '[data-driver-id]' ,function(){
        id_selected=$(`[data-driver-id-rows="${$(this).val()}"]`).data('value');
        if(id_selected!=undefined){
         $(this).data('driver-id', id_selected)
         set_params('driver_id', id_selected)
         set_params('driver_code', $(`[data-driver-id]`).val())
         goto_page(1)
       }
     });

      $(document.body).on('change', '[data-driver-id]' ,function(){
       id_selected=$(`[data-driver-id-rows="${$(this).val()}"]`).data('value');
       if(id_selected==undefined){
        alert("Please enter correct Driver ID")
        id_selected=''
        set_params('driver_id', '')
        set_params('driver_code', '')
        goto_page(1)
        $(this).val('')
        $(this).focus()
      }
    });

      quick_list_drivers().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options+=`<option data-driver-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-driver-id-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" value="`+ item.code + ' ' + item.name + `"></option>`;

            })
            $('#quick_list_driver_id').html(options);
            if (url_params.hasOwnProperty('driver_code')) 
            {
              $(`[data-driver-id]`).val(check_url_params('driver_code'))
            }
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    </script>

    <script>
      $(document.body).on('change', '[from-date]', function() {
        var g1 = new Date(check_url_params('from_date'))
        var g2 = new Date(check_url_params('to_date'))
        if (g1.getTime() > g2.getTime()) {
          alert("Please enter the valid date!. Inspection From Date should be less than Inspection To Date")
          $("[data-filter='from_date']").val("");
          set_params('from_date', "")
          goto_page(1)
          $(this).val('')
          $(this).focus()
        }
      });

      $(document.body).on('change', '[to-date]', function() {
        var g1 = new Date(check_url_params('from_date'))
        var g2 = new Date(check_url_params('to_date'))
        if (g1.getTime() > g2.getTime()) {
          alert("Please enter the valid date!. Inspection To Date should be greater than Inspection From Date")
          $("[data-filter='to_date']").val("");
          set_params('to_date', "")
          goto_page(1)
          $(this).val('')
          $(this).focus()
        }
      });
    </script>

    <script type="text/javascript">
      var url_params = get_params();
      if (url_params.hasOwnProperty('status_id')) {} else {
        set_params('status_id', 'ALL')
      }
      if (url_params.hasOwnProperty('id')) {
        $("[data-filter='id']").val(url_params.id);
      }
      if (url_params.hasOwnProperty('trailer_code')) {
        $("[data-filter='trailer_code']").val(url_params.trailer_code);
      }
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

      $('[data-search-trailer]').val(check_url_params('trailer_name'))
      function show_list() {
        show_processing_modal()
        var sort_by = $('#sort_by').val();
        var sort_by_order_type = $('#sort').val();
        var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
        var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
        // var status_id = $('[data-filter="status_id"]').val();
        var status_id = check_url_params('status_id');
        var driver_id = check_url_params('driver_id');
        var truck_id =  check_url_params('truck_id');
        var violation_id = $('[data-filter="violation_id"]').val();
        var trailer_id = check_url_params('trailer_id');
        var company_id = $('[data-filter="company_id"]').val();
        var inspection_id = $('[data-filter="id"]').val();
        var from_date = $('[data-filter="from_date"]').val();
        var to_date = $('[data-filter="to_date"]').val();
        var asset_reason = $('[data-filter="asset_reason"]').val();
        var level_id =  check_url_params('level_id');

        $.ajax({

          url: location.pathname + '-ajax',
          type: 'POST',
          data: {
            page: page_no,
            sort_by: sort_by,
            batch: batch,
            sort_by_order_type:sort_by_order_type,
            status_id: status_id,
            driver_id: driver_id,
            truck_id: truck_id,
            violation_id: violation_id,
            trailer_id: trailer_id,
            company_id: company_id,
            asset_reason:asset_reason,
            inspection_id: inspection_id,
            from_date: from_date,
            to_date: to_date,
            level_id: level_id,
          },

          success: function(data) {

            if ((typeof data) == 'string') {

              data = JSON.parse(data)

              console.log(data)

              $('#tabledata').html("");

              if (data.status) {

                var counter = 0;

                $.each(data.response.list, function(index, item) {

                  counter++;

                  var row = `<tr>

                  <td>${item.sr_no}</td>
                  <td>${item.id}</td>
                  <td>${item.inspection_date}</td>
                  <td>${item.status}</td>
                  <td>${item.driver_name}</td> 
                  <td>${item.driver_id}</td>
                  <td>${item.driver_lic_no}</td>
                  <td>${item.truck_id}</td>
                  <td>${item.truck_vin_no}</td>
                  <td>${item.trailer_id}</td>
                  <td>${item.trailer_vin_no}</td>             
                  <td>${item.co_driver_name}</td>
                  <td>${item.co_driver_id}</td>
                  <td>${item.co_driver_lic_no}</td>
                  <td>${item.company_name}</td>
                  <td>${item.fault_reason_name}</td>
                  <!--<td>${item.location}</td>-->
                  <td>${item.state}</td>
                  <td>${item.time_from}</td>
                  <td>${item.time_to}</td>
                  <td>${item.violation_reported}</td>
                  <td>${item.fine_amount}</td>
                  <td>${item.bond_amount}</td>
                  <td>${item.remarks}</td>
                  <td>${item.day_count}</td>;
                  <td>${item.level_id}</td>;

                  <td>${item.added_by_code} - ${item.added_by_name}</td>
                  <td>${item.updated_by_code} - ${item.updated_by_name}</td>
                  <td>${item.closed_by_code} - ${item.closed_by_name}</td>
                  <td>${item.violation_against}</td>

                  <td style="white-space:nowrap">`;
                  <?php
                  if (in_array('P0267', USER_PRIV)) 
                  { 
                    ?>
                    row += `<button title="View" class="btn_grey_c"><a href="../user/maintenance/inspection-sheet/details?eid=${item.eid}"><i class="fa fa-eye"></i></a></button>`;
                    <?php
                  }
                  if (in_array('P0268', USER_PRIV)) 
                  {
                    ?>
                    row += `<button title="Edit" class="btn_grey_c"><a href="../user/maintenance/inspection-sheet/update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button>`;
                    <?php
                  }
                  if (in_array('P0268', USER_PRIV)) 
                  {
                    ?>
                    row+=`<button title="Upload/View Docs" class="btn_grey_c"><a href="../user/maintenance/inspection-sheet/documents&eid=${item.eid}"><i class="fa fa-file"></i></a></button>`;
                    <?php
                  } 
                  if (in_array('P0269', USER_PRIV)) 
                  {
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

                var false_message = `<tr><td colspan="18">` + data.message + `<td></tr>`;
                $('#tabledata').html(false_message);
                 if(check_url_params('page_no') > 1){
                   goto_page(1);
                  }
              }

              hide_processing_modal()

            }

          }

        }

        )

}

show_list()
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
  function show_companies() {
    get_companies().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` +  item.name + `</option>`;
          })
          $('[data-filter="company_id"]').html(options);
          if (url_params.hasOwnProperty('company_id')) {
            $("[data-filter='company_id'] option[value=" + url_params.company_id + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_companies()
</script>

<script type="text/javascript">
  function show_user() {
    get_companies().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` +  item.name + `</option>`;
          })
          $('[data-filter="company_id"]').html(options);
          if (url_params.hasOwnProperty('company_id')) {
            $("[data-filter='company_id'] option[value=" + url_params.company_id + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_companies()
</script>

<script type="text/javascript">
  function show_truck() {
    quick_list_trucks().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` +  item.code + `</option>`;
          })
          $('[data-filter="truck_id"]').html(options);
          if (url_params.hasOwnProperty('truck_id')) {
            $("[data-filter='truck_id'] option[value=" + url_params.truck_id + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_truck()
</script>

<script type="text/javascript">
  function show_trailers() {
    quick_list_trailers().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` +  item.code + `</option>`;
          })
          $('[data-filter="trailer_id"]').html(options);
          if (url_params.hasOwnProperty('trailer_id')) {
            $("[data-filter='trailer_id'] option[value=" + url_params.trailer_id + "]").prop('selected', true);
            $(`[data-filter='trailer_id']`).val(check_url_params('trailer_code'))
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_trailers()
</script>

<script type="text/javascript">
  function show_users() {
    quick_list_users().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` +  item.name + `</option>`;
          })
          $('[data-filter="user_id"]').html(options);
          if (url_params.hasOwnProperty('user_id')) {
            $("[data-filter='user_id'] option[value=" + url_params.user_id + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_users()
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
  $(document).ready(function() {
    $(document).on("click", "[data-action='delete']", function() {
      if (confirm('Do you want to delete inspection?')) {
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

<?php

require_once APPROOT . '/views/includes/user/footer.php';

?>