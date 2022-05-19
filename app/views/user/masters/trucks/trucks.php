<?php
require_once APPROOT . '/views/includes/user/header.php'; ?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1400px">
  <h1 class="list-200-heading">Trucks</h1>
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
      <input type='hidden' id='sort' value='asc'>
      <!-- //input used for sory by call-->
      <div class="filter-item">
        <label>Truck Code</label>
        <input type="text" data-filter="code" list="quick_list_vehicle_id" data-vehicle-id>
      </div>            
      <div class="filter-item">
        <label>Status</label>
        <select data-filter="status_id" onchange="set_params('status_id', this.value), goto_page(1)">
        </select>
      </div>
      <div class="filter-item">
        <label>Own/lease type</label>
        <select data-filter="ownership_type" onchange="set_params('ownership_type', this.value), goto_page(1)">
        </select>
      </div>
      <div class="filter-item">
        <label>Company Name</label>
        <select data-filter="company_id" onchange="set_params('company_id', this.value), goto_page(1)">
        </select>
      </div>
      <div class="filter-item">
        <label>Leasing Company</label>
        <select data-filter="lease_company_id" onchange="set_params('lease_company_id', this.value), goto_page(1)">
        </select>
      </div>
       <div class="filter-item">
        <label>Truck type</label>
          <select name="truck_type" data-filter="truck_type" onchange="set_params('truck_type', this.value), goto_page(1)">
          <option value="">- -Select- -</option>  
          <option value="normal">Normal</option>
          <option value="box">Box</option>
       </select>
      </div>
      <div class="filter-item">
        <label>VIN No.</label>
        <input type="text" data-filter="vin_number" onchange="set_params('vin_number', this.value), goto_page(1)">

      </div>
      <div class="filter-item">
        <label>Truck Details Status</label>
        <select data-filter="truck_status_id" onchange="set_params('truck_status_id', this.value), goto_page(1)">
          <option value="">- - Select - -</option>
          <option>Pending</option>
          <option>Rejected</option>
          <option>Verified</option>
        </select>
      </div> 
      <div class="filter-item">
        <label>licence plate No.</label>
        <input type="text" data-filter="licence_plate_number" name="licence_plate_number" onchange="set_params('licence_plate_number', this.value), goto_page(1)">
        </select>
      </div>            
      <!-- <div class="filter-item">
        <label>License Plate No.</label>
        <input type="text" data-filter="license_number" onchange="set_params('license_number', this.value), goto_page(1)">
      </div> -->
    </div>
    <div class="list-200-top-action-right">
            <div>
        <?php if (in_array('P0018', USER_PRIV)) {
          echo "<button class='btn_grey button_href'><a onclick='update_locations()'>Update Locations</a></button>";
         // echo "<button class='btn_grey button_href'><a href='../user/masters/trucks-update-live-locations'>Update Locations</a></button>";
        } ?>
      </div>&nbsp;
      <div>
        <?php if (in_array('P0018', USER_PRIV)) {
          echo "<button class='btn_grey button_href'><a href='../user/masters/trucks/add-new'>Add New</a></button>";
        } ?>
      </div>

    </div>
  </section>
  <div class="table  table-a">
    <table data-ro-table>
      <thead>
        <tr>
          <th>Sr No</th>
          <th data-table-sort-by="status">Status</th>
          <th data-table-sort-by="code">Code</th>
          <th data-table-sort-by="company">Company Name</th>
          <th data-table-sort-by="year">Year</th>
          <th data-table-sort-by="make">Maker Company</th>
          <th data-table-sort-by="model">Model</th>
          <th>Color</th>
          <th>VIN No.</th>
          <th>Lic. Plate No.</th>
          <th data-table-sort-by="state">State</th>
          <th>Tag Expiry</th>
          <th data-table-sort-by="own">Own/Lease</th>
          <th>Leasing Company</th>
          <th>Leasing Ref. No.</th>
          <th>Leasing Expiry</th>
          <th data-table-sort-by="device">Device</th>
          <th data-table-sort-by="truck_type">Truck Types</th>
          <th>Gateway Sr. No.</th>
          <th>Dash Cam. No.</th>
          <th data-table-sort-by="insurancestatus">Insurance Status</th>
          <th data-table-sort-by="insurancecompany">Insurance Company</th>
          <th>Insurance Start Date</th>
          <th>Insurance Expiry Date</th>
          <th data-table-sort-by="liability">Liability Status</th>
          <th data-table-sort-by="cargo">Cargo Status</th>
          <th data-table-sort-by="pdvalue">PD Value</th>
          <th data-table-sort-by="pdnewValue">PD New Value</th>
          <th>Loss Pay Info.</th>
          <th data-table-sort-by="FHVUTStatus">FHVUT Status</th>
          <th>FHVUT Paid Date</th>
          <th data-table-sort-by="OregonPermit">Oregon Permit Status</th>
          <th>Family Engine Number</th>
          <th data-table-sort-by="IFTA">IFTA Status</th>
          <th data-table-sort-by="PIFTA">PIFTA Status</th>
          <th data-table-sort-by="NM">NM Status</th>
          <th>Pre Pass</th>
          <th>Pre Pass Remark</th>
          <th>HUT</th>
          <th>HUT Remark</th>
          <th>Engine Hours</th>
          <th>Odometer Reading</th>
          <th>Location</th>
          <th>Last Note</th>
          <th>Added By</th>
          <th>Updated By</th>
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
  var url_params = get_params();
  if (url_params.hasOwnProperty('code')) {
    $("[data-filter='code']").val(url_params.code);
  }
   if (url_params.hasOwnProperty('truck_type')) {
    $("[data-filter='truck_type']").val(url_params.truck_type);
  }
  if (url_params.hasOwnProperty('truck_status_id')) {
    $("[data-filter='truck_status_id']").val(url_params.truck_status_id);
  }
  if (url_params.hasOwnProperty('vin_number')) {
    $("[data-filter='vin_number']").val(url_params.vin_number);
  }
  if (url_params.hasOwnProperty('licence_plate_number')) {
    $("[data-filter='licence_plate_number']").val(url_params.licence_plate_number);
  }
</script>




<datalist id="quick_list_vehicle_id"></datalist>
<script type="text/javascript">
  $(document.body).on('input', '[data-vehicle-id]', function() {
    //alert("hhhh")
    id_selected = $(`[data-vehicle-id-rows="${$(this).val()}"]`).data('value');
    if (id_selected != undefined) {
      $(this).data('vehicle-id', id_selected)
      // set_params('code', id_selected)
      set_params('code', $(`[data-vehicle-id]`).val())
      goto_page(1)
    }
  });
</script>
<script type="text/javascript">
  $(document.body).on('change', '[data-vehicle-id]', function() {
    id_selected = $(`[data-vehicle-id-rows="${$(this).val()}"]`).data('value');
    if (id_selected == undefined) {
      alert("Please enter correct truck ID") 
      set_params('code', '')
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
        if (url_params.hasOwnProperty('code')) {
          $(`[data-vehicle-id]`).val(check_url_params('code'))
          // $("[data-filter='vehicle_id'] option[value=" + url_params.vehicle_id + "]").prop('selected', true);
        }
      }
    }
  }).catch(function(err) {
    // Run this when promise was rejected via reject()
  })
</script>
<script type="text/javascript">
  function update_locations() {
    show_processing_modal()
    $.ajax({
      url: '../user/masters/trucks-update-live-locations',
      type: 'POST',
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          if (data.status) {
            show_list()
            alert(data.message)
          } else {
            show_list()
            alert(data.message)
          }
          hide_processing_modal()
        }
      }
    })
  }
</script>

<script type="text/javascript">

  function show_list(){
    var sort_by = $('#sort_by').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var sort_by_order_type = $('#sort').val();
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var code = check_url_params('code')
    var status_id = check_url_params('status_id')
    var company_id = check_url_params('company_id')
    var lease_company_id = check_url_params('lease_company_id')
    var ownership_type = check_url_params('ownership_type')
    var webapi = "pagination";
    var truck_status_id = check_url_params('truck_status_id');
    var vin_number = check_url_params('vin_number');
    //var license_number = check_url_params('license_number');
    var truck_type = check_url_params('truck_type');
    var licence_plate_number = check_url_params('licence_plate_number');
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        page: page_no,
        sort_by: sort_by,
        batch: batch,
        licence_plate_number:licence_plate_number,
        sort_by_order_type:sort_by_order_type,
        code:code,
        webapi:  webapi,
        truck_status_id:truck_status_id,
        status_id:status_id,
        vin_number:vin_number,
        truck_type:truck_type,
        company_id:company_id,
        lease_company_id:lease_company_id,
        ownership_type:ownership_type
        //license_number:license_number,
      },
      success:function(data){

       if((typeof data)=='string'){
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
           var counter=0;   
           $.each(data.response.list, function(index, item) {

             counter++;
             var row=`
             <tr>
             <td>`+item.sr_no+`</td>
             <td>`+item.status+`</td>
             <td>`+item.code+`</td>
             <td>`+item.company+`</td>
             <td>`+item.make_year+`</td>
             <td>`+item.make+`</td>
             <td>`+item.model+`</td>
             <td>`+item.color+`</td>
             <td>`+item.vin+`</td>
             <td>`+item.licence_tag_no+`</td>
             <td>`+item.licence_state+`</td>
             <td>`+item.licence_tag_expiry_date+`</td>
             <td>`+item.ownership_type+`</td>
             <td>`+item.leasing_company+`</td>
             <td>`+item.leasing_ref_no+`</td>
             <td>`+item.leasing_expiry+`</td>
             <td>`+item.device_company_name+`</td>
              <td>`+item.truck_type+`</td>
             <td>`+item.device_serial_no+`</td>
             <td>`+item.device_dash_cam_no+`</td>
             <td>`+item.insurance_status+`</td>
             <td>`+item.insurance_company_name+`</td>
             <td>`+item.insurance_start_date+`</td>
             <td>`+item.insurance_expiry_date+`</td>
             <td>`+item.liability_status+`</td>
             <td>`+item.cargo_status+`</td>
             <td>`+item.pd_value+`</td>
             <td>`+item.new_pd_value+`</td>
             <td>`+item.loss_pay_info+`</td>
             <td>`+item.fhvut_status+`</td>
             <td>`+item.fhvut_paid_date+`</td>
             <td>`+item.oregon_permit_status+`</td>
             <td>`+item.family_engine_number+`</td>
             <td>`+item.ifta_status+`</td>
             <td>`+item.pifta_status+`</td>
             <td>`+item.nm_status+`</td>
             <td>`+item.pre_pass+`</td>
             <td>`+item.pre_pass_remark+`</td>
             <td>`+item.hut+`</td>
             <td>`+item.hut_remark+`</td>
             <td>`+item.engine_hours_current_reading+`<br>`+item.engine_hours_updated_on+`</td>
             <td>`+item.odometer_current_reading+`<br>`+item.odometer_updated_on+`</td>
             <td style="min-width:150px;">`+item.current_location+`<br>`+item.current_location_updated_on+`</td>
              <td>`+item.last_note+`</td>
             <td style="white-space:nowrap">`+item.added_by_user_code+`<br>`+item.added_by_user_name+`<br>`+item.added_on_datetime+`</td>
             <td style="white-space:nowrap">`+item.updated_by_user_code+`<br>`+item.updated_by_user_name+`<br>`+item.updated_on_datetime+`</td>`;
             row+=`<td style="white-space:nowrap">`;
             <?php
             if (in_array('P0015', USER_PRIV)) { 
              ?>
              row+=`<button title="View" class="btn_grey_c"><a href="../user/masters/trucks/details?eid=`+item.eid+`"><i class="fa fa-eye"></i></a></button>`;
            <?php }
            if (in_array('P0020', USER_PRIV)) { ?>
              row+=`<button title="View" class="btn_grey_c"><a href="../user/masters/trucks/update?eid=`+item.eid+`&page="><i class="fa fa-pen"></i></a></button>`;
            <?php }
            if (in_array('P0147', USER_PRIV)) { ?>
              row+=`<button title="Upload Docs" class="btn_grey_c"><a href="../user/masters/trucks/documents?eid=${item.eid}&code=${item.code}""><i class="fa fa-file"></i></a></button>`;
            <?php }
            ?>
            row+=`<button title="Notes" class="btn_grey_c" onclick="open_notes({url:'../user/miscellaneous/notes/details?reference=TRUCKS&eid=${item.eid}'})"><i class="fa fa-sticky-note"></i></a></button></td>`; 

            <?php

            if(in_array('P0334', USER_PRIV)){
              ?>
              if(item.approval_status!=='VERIFIED' || item.approval_status==''){
                row+=` <td><a title="Compare History" href="../user/masters/trucks/trucks-verify?eid=${item.eid}" title="Verify Trucks"><button class="btn_blue">Verify</button></a></td>`;
              }else  if(item.approval_status=='VERIFIED'){
               row+=`<td><a href="../user/quick-details/quick-history-details?reference=Trucks&eid=${item.eid}" title="Compare History"><button class="btn_blue">Compare</button></a></td>`;
             }

           <?php } ?>




           row+=`</tr>`;
           $('#tabledata').append(row);

         })
set_pagination({
  selector: '[data-pagination]',
  totalPages: data.response.totalPages,
  currentPage: data.response.currentPage,
  batch: data.response.batch
})
}else{
  $('#tabledata').html("");
  var row=`<tr><td colspan="20">`+data.message+`</td></tr>`;
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
  function show_truck_status_filter(){
   get_vehicles_status().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="status_id"]').html(options);
      if (url_params.hasOwnProperty('status_id')) {
        $("[data-filter='status_id'] option[value=" + url_params.status_id + "]").prop('selected', true);
      }
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_truck_status_filter()
</script>
<script type="text/javascript">
  function show_companies_filter(){
   get_companies().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
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
show_companies_filter()
</script>
<script type="text/javascript">
  function show_lease_companies_filter(){
   get_lease_companies().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="lease_company_id"]').html(options);     
      if (url_params.hasOwnProperty('lease_company_id')) {
        $("[data-filter='lease_company_id'] option[value=" + url_params.lease_company_id + "]").prop('selected', true);
      }
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_lease_companies_filter()
</script>
<script type="text/javascript">
  function show_ownership_types_filter(){
   get_vehicles_ownership_types().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="ownership_type"]').html(options);     
      if (url_params.hasOwnProperty('ownership_type')) {
        $("[data-filter='ownership_type'] option[value=" + url_params.ownership_type + "]").prop('selected', true);
      }
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_ownership_types_filter()
</script>
<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>
<?php require_once APPROOT . '/views/includes/user/footer.php';
?>
