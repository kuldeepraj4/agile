<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1400px">
  <h1 class="list-200-heading">Drivers</h1>
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
        <label>Driver Code</label>
        <input type="text" data-filter="code" onchange="set_params('code', this.value), goto_page(1)">
      </div>  
      <div class="filter-item">
        <label>Driver Name</label>
        <input type="text" data-filter="driver_name" onchange="set_params('driver_name', this.value), goto_page(1)">
      </div>  
      <div class="filter-item">
        <label>Mobile No.</label> 
        <input type="text" placeholder="Enter 10 digit no. without code" data-filter="driver_mobile_no" onchange="set_params('driver_mobile_no', this.value), goto_page(1)">
      </div>  
      <div class="filter-item">
        <label>CDL No.</label>
        <input type="text" data-filter="driver_cdl_no" onchange="set_params('driver_cdl_no', this.value), goto_page(1)">
      </div>               
      <div class="filter-item">
        <label>Status</label>
        <select data-filter="status_id" data-default-select='1' onchange="set_params('status_id', this.value), goto_page(1)"></select>
      </div>
      <div class="filter-item">
        <label>Driver Profile Status</label>
        <select data-filter="driver_status_id" onchange="set_params('driver_status_id', this.value), goto_page(1)">
          <option value="">- - Select - -</option>
          <option>Pending</option>
          <option>Rejected</option>
          <option>Verified</option>
        </select>
      </div>
      <div class="filter-item">
        <label>Company Name</label>
        <select data-filter="company_id" onchange="set_params('company_id', this.value), goto_page(1)"></select>
      </div>
      <div class="filter-item">
      </div>
    </div>
    <div class="list-200-top-action-right">
      <div>
        <?php
        if(in_array('P0008', USER_PRIV)){
          echo "<button class='btn_grey button_href'><a href='../user/masters/drivers/add-new'>Add New</a></button>";
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
          <th data-table-sort-by="condition">Status</th>
          <th data-table-sort-by="code">Code</th>
          <th data-table-sort-by="company">Company</th>
          <th data-table-sort-by="group">Group</th>
          <th data-table-sort-by="name">Driver Name</th>
          <th data-table-sort-by="dob">D.O.B.</th>
          <th>Mobile No.</th>
          <th>Email ID</th>
          <th>Address</th>
          <!-- <th>Company</th> -->
          <th data-table-sort-by="doj">D.O.J.</th>
          <th>Route Type</th>
          <th>CDL No.</th>
          <th data-table-sort-by="cdlstate">CDL State</th>
          <th>CDL Issue Date</th>
          <th>CDL Expiry Date</th>
          <th>SSN No.</th>
          <th data-table-sort-by="residency">Residency Type</th>
          <th>Residency Expiry</th>
          <th>Medical Issue Date</th>
          <th>Medical Expiry Date</th>
          <th data-table-sort-by="grf">GFR</th>
          <th data-table-sort-by="epn">EPN Enroll</th>
          <th>Last Annual Review</th>
          <th>Next Annual Review</th>
          <th data-table-sort-by="tassigned">Truck Assigned</th>
          <th data-table-sort-by="addInsurance">Insurance Added</th> 
          <th>Last Note</th>
          <th>Added By</th>
          <th>Updated By</th>
          <th>Action</th>
          <th></th>
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
  if (url_params.hasOwnProperty('driver_status_id')) {
    $("[data-filter='driver_status_id']").val(url_params.driver_status_id);
  }

   if (url_params.hasOwnProperty('driver_name')) {
    $("[data-filter='driver_name']").val(url_params.driver_name);
  }

   if (url_params.hasOwnProperty('driver_mobile_no')) {
    $("[data-filter='driver_mobile_no']").val(url_params.driver_mobile_no);
  }
   
   if (url_params.hasOwnProperty('driver_cdl_no')) {
    $("[data-filter='driver_cdl_no']").val(url_params.driver_cdl_no);
  }

   set_params('status_id', '1')

  select_default('[data-filter="status_id"]')

</script>
<script type="text/javascript">
  function show_list(){
    var sort_by = $('#sort_by').val();
    var sort_by_order_type = $('#sort').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var code = check_url_params('code')
    var driver_name = check_url_params('driver_name')
    var driver_mobile_no = check_url_params('driver_mobile_no')
    var driver_cdl_no = check_url_params('driver_cdl_no')
    var company_id = check_url_params('company_id')
    var status_id = check_url_params('status_id')
    var driver_status_id = check_url_params('driver_status_id')
     var webapi = "pagination";
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        page:page_no,
        sort_by:sort_by,
        batch:batch,
        code:code,
        driver_name:driver_name,
        driver_mobile_no:driver_mobile_no,
         sort_by_order_type:sort_by_order_type,
        driver_cdl_no:driver_cdl_no,
        company_id:company_id,
        driver_status_id:driver_status_id,
        status_id:status_id,
        webapi:  webapi
      },
      beforeSend:function() {
        show_table_data_loading("[data-my-table]")
        show_processing_modal();
      },
      complete:function(){
        hide_processing_modal();
      },
      success:function(data){
       if((typeof data)=='string'){
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
          $.each(data.response.list, function(index, item) {    
             var row=`<tr>
             <td>${item.sr_no}</td>
             <td>${item.status}</td>
             <td>${item.code}</td>
             <td>${item.company}</td>
             <td>${item.group}</td>
             <td>${item.name}</td>
             <td>${item.dob}</td>
             <td style="white-space:nowrap">${item.mobile_number_display}</td>
             <td>${item.email}</td>
             
             <td style="min-width:200px;">${item.address}</td>
             
             <td>${item.date_of_joining}</td>
             <td>${item.route_type}</td>
             <td>${item.cdl_number}</td>
             <td>${item.cdl_state}</td>
             <td>${item.cdl_issue_date}</td>
             <td>${item.cdl_expiry_date}</td>
             <td>${item.ssn_number}</td>
             <td>${item.residency_type}</td>
             <td>${item.residency_expiry_date}</td>
             <td>${item.medical_issue_date}</td>
             <td>${item.medical_expiry_date}</td>
             <td>${item.gfr}</td>
             <td>${item.epn_enroll_status}</td>
             <td>${item.last_annual_review_date}</td>
             <td>${item.next_annual_review_date}</td>
             <td>${item.truck_code}</td>`;

             if(item.inusrance_added_status == "0" || item.inusrance_added_status == null){
             row+=`<td></td>`;
           }else{
            row+=`<td>${item.inusrance_added_status}</td>`;
               
           }
            row+=` <td>`+item.last_note+`</td>`;


            row+=` <td>`+item.added_by_user_code+`<br>`+item.added_by_user_name+`<br>`+item.added_on_datetime+`</td>
                     <td>`+item.updated_by_user_code+`<br>` +item.updated_by_user_name+`<br>`+item.updated_on_datetime+`</td>`;

             row+=`<td style="white-space:nowrap">`;
             <?php if(in_array('P0009', USER_PRIV)){
              ?>
              row+=`<button title="View" class="btn_grey_c" onclick="open_quick_view_driver('${item.eid}')"><i class="fa fa-eye"></i></button>`;

              
              <?php
            }
            if(in_array('P0010', USER_PRIV)){
              ?>
              row+=`<button title="Edit" class="btn_grey_c"><a href="../user/masters/drivers/update?eid=${item.eid}&page="><i class="fa fa-pen"></i></a></button>`;

              <?php
            }
            if(in_array('P0011', USER_PRIV)){
              ?>
              // row+=`<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="${item.eid}"><i class="fa fa-trash"></i></button>`;
              <?php
            }
            
            if(in_array('P0383', USER_PRIV)){
              ?>
              row+=`<button title="Password Reset" class="btn_grey_c"><a href="../user/masters/drivers/password-reset?eid=${item.eid}"><i class="fa fa-lock"></i></a></button>`;
              <?php
            }
            if(in_array('P0377', USER_PRIV)){
              ?>
              row+=`<button title="Upload Docs" class="btn_grey_c"><a href="../user/masters/drivers/documents?eid=${item.eid}&driver_name=${item.name}&driver_code=${item.code}"><i class="fa fa-file"></i></a></button>`;
              <?php
            }            
            ?>
          row+=`<button title="Notes" class="btn_grey_c" onclick="open_notes({url:'../user/miscellaneous/notes/details?reference=DRIVERS&eid=${item.eid}'})"><i class="fa fa-sticky-note"></i></a></button>`;
                         row+=`</td><td>`;

                          <?php
           
            if(in_array('P0333', USER_PRIV)){
              ?>
                        if(item.approval_status!=='VERIFIED' || item.approval_status==''){
                        row+=` <td><a title="Compare History" href="../user/masters/drivers/details?eid=${item.eid}"><button class="btn_blue">Verify</button></a></td>`;
                       }else  if(item.approval_status=='VERIFIED'){
                         row+=`<td><a href="../user/quick-details/quick-history-details?reference=DRIVERS&eid=${item.eid}" title="Compare History"><button class="btn_blue">Compare</button></a></td>`;
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
 get_employees_status().then(function(data) {
  // Run this when your request was successful
  if(data.status){
   // console.log(data)
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">All</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="status_id"]').html(options);         
      if (url_params.hasOwnProperty('status_id')) {
              $("[data-filter='status_id'] option[value=" + url_params.status_id + "]").prop('selected', true);
            }else {
    set_params('status_id', '1')
  }
  select_default('[data-filter="status_id"]')
     // show_list()   
    }
  }
})
</script>
<script type="text/javascript">
function show_companies_filter(){
 get_companies().then(function(data) {
 // console.log(data)
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
  function sort_table(){
    show_list()
  }
</script>
<br><br><br><br>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>