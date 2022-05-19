<!-- <style>
  body {
    /* font-size: 14px; */
  }
</style> -->

<?php
error_reporting(0);
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];
$driver_eid = isset($_GET['eid']) ? $_GET['eid'] : "N/a";
?>
<?php
require_once APPROOT . '/views/user/quick-details/quick-driver-excel.php';
?>
<!-- ---------------------DRIVER BASIC INFORMATION SECTION START HERE--------------------------------------------------------------------------------- -->
<section>

</section>
<section class="lg-form-outer lg-form list-200 content-box">
  <div class="lg-form-header" style="font-weight:bolder; color:brown;">DRIVER <?php echo $details['code'] . ' ' . $details['name']; ?> 
  <div class="dropdown" style="float:right; margin-right:10px;">
  <button class="dropbtn"><i class="fas fa-file-excel"></i>&nbsp;Excel &nbsp; <span style="border-left:1px solid #fff; padding-left:10px; ">  <i class="fas fa-caret-down"></i></span></button>
  <div class="dropdown-content">
  <a onclick="tableToExcel('personal', 'All Data Exports')" >All</a>
  <a onclick="tableToExcel('tabledata_trip_excel', 'Trip Excel')">Driver Trips</a>
  <a onclick="tableToExcel('tabledata_payment_excel', 'Payment Excel')">Settlements</a>
  <a onclick="tableToExcel('tabledata_document_excel', 'Document Excel')">All Driver Documents</a>
  <a onclick="tableToExcel('tabledata_rolist_excel', 'Rolist Excel')">RO list</a>
  </div>
</div>
 <!-- <button class='btn_green' data-button-export-to-excel onclick="report_view()" style="float: right; margin-right: 20px;">Excel</button> --> 
</div>

    
  <!-- <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()"> -->
  <section class="section-111" style="margin-top:-35px;">
    <div></div>
    <div>
    </div>
    <div></div>
  </section>
  <section class="section-111">
    <div>
      <fieldset>
        <legend>Status</legend>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Status</label>
            <div><?php echo $details['status']; ?></div>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend>Personal Details</legend>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Driver ID</label>
            <div><?php echo $details['code']; ?></div>
          </div>
          <div class="field-p">
            <label>Name</label>
            <div><?php echo $details['prefix'] . ' ' . $details['name']; ?></div>
          </div>
          <div class="field-p">
            <label>Date of Birth</label>
            <div><?php echo $details['dob']; ?></div>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend>Contact Information</legend>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Mobile No</label>
            <div><?php echo $details['mobile_number_display']; ?></div>
          </div>
          <div class="field-p">
            <label>Email</label>
            <div><?php echo $details['email']; ?></div>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend>Present Address</legend>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Address Line</label>
            <div><?php echo $details['address_line']; ?></div>
          </div>
          <div class="field-p">
            <label>State</label>
            <div><?php echo $details['address_state_name']; ?></div>
          </div>
          <div class="field-p">
            <label>City</label>
            <div><?php echo $details['address_city_name']; ?></div>
          </div>
          <div class="field-p">
            <label>ZIP Code</label>
            <div><?php echo $details['address_zipcode_name']; ?></div>
          </div>
        </div>
      </fieldset>
    </div>
    <div>
      <fieldset>
        <legend>------</legend>
        <div class="field-section single-column">
          <div class="field-p">
            <label>Company</label>
            <div><?php echo $details['company']; ?></div>
          </div>
          <div class="field-p">
            <label>Joining Date</label>
            <div><?php echo $details['date_of_joining']; ?></div>
          </div>
          <div class="field-p">
            <label>Route Type</label>
            <div><?php echo $details['route_type']; ?></div>
          </div>
          <div class="field-p">
            <label>CDL No</label>
            <div><?php echo $details['cdl_number']; ?></div>
          </div>
          <div class="field-p">
            <label>CDL State</label>
            <div><?php echo $details['cdl_state']; ?></div>
          </div>
          <div class="field-p">
            <label>CDL Issue Date</label>
            <div><?php echo $details['cdl_issue_date']; ?></div>
          </div>
          <div class="field-p">
            <label>CDL Expiry Date</label>
            <div><?php echo $details['cdl_expiry_date']; ?></div>
          </div>
          <div class="field-p">
            <label>SSN No</label>
            <div><?php echo $details['ssn_number_enc']; ?></div>
          </div>
          <div class="field-p">
            <label>Residency</label>
            <div><?php echo $details['residency_type']; ?></div>
          </div>
          <div class="field-p">
            <label>Residency Expiry Date</label>
            <div><?php echo $details['residency_expiry_date']; ?></div>
          </div>
          <div class="field-p">
            <label>Medical Issue Date</label>
            <div><?php echo $details['medical_issue_date']; ?></div>
          </div>
          <div class="field-p">
            <label>Medical Expiry Date</label>
            <div><?php echo $details['medical_expiry_date']; ?></div>
          </div>
          <div class="field-p">
            <label>GFR</label>
            <div><?php echo $details['gfr']; ?></div>
          </div>
          <div class="field-p">
            <label>EPN Enroll</label>
            <div><?php echo $details['epn_enroll_status']; ?></div>
          </div>
        </div>
      </fieldset>
    </div>
    <div>
      <fieldset>
        <legend>Followups / Technical Details</legend>
        <div class="field-section">
          <div class="field-p">
            <label>Last Annual Review Date</label>
            <div><?php echo $details['last_annual_review_date']; ?></div>
          </div>
          <div class="field-p">
            <label>Next Annual Review Date</label>
            <div><?php echo $details['next_annual_review_date']; ?></div>
          </div>
          <div class="field-p">
            <label>Truck Assigned</label>
            <div><?php echo $details['truck_code']; ?></div>
          </div>
          <div class="field-p">
            <label>Insurance Added</label>
            <div><?php echo $details['insurance_added_status']; ?></div>
          </div>
          <div class="field-p">
            <label>Group</label>
            <div><?php echo $details['group']; ?></div>
          </div>
        </div>
      </fieldset>
    </div>
  </section>
  <!-- </form> -->
</section><br>
<!-- ---------------------DRIVER BASIC INFORMATION SECTION ENDS HERE--------------------------------------------------------------------------------- -->
<!-- ---------------------SET BATCH AND PAGINATION SECTION START HERE--------------------------------------------------------------------------------- -->
<script type="text/javascript">
  function goto_page_my(pageno, pagename) {
    set_params('pageno_' + pagename, pageno)
    switch (pagename) {
      case "trip":
        show_list_trip();
        break;
      case "payment":
        show_list_payment();
        break;
      case "document":
        show_list_document();
        break;
      case "rolist":
        show_list_rolist();
        break;
      default:
        break;
    }
  }
</script>
<script type="text/javascript">
  function set_batch_my(batch_name, value) {
    var items = value;
    if (items <= 12) {
      $(".table-a").css("height", "auto");
    } else {
      $(".table-a").css("height", "90%");
    }
    set_params('batch_' + batch_name, value)
    switch (batch_name) {
      case "trip":

        //show_list_trip();
         goto_page_my(1, 'trip');
        break;
      case "payment":
       // show_list_payment();
        goto_page_my(1, 'payment');
        break;
      case "document":
      //  show_list_document();
        goto_page_my(1, 'document');
        break;
      case "rolist":
       // show_list_rolist();
        goto_page_my(1, 'rolist');
        break;
      default:
        break;
    }
  }
</script>
<!-- ---------------------SET BATCH AND PAGINATION SECTION END HERE--------------------------------------------------------------------------------- -->
<!-- ---------------------DRIVER TRIPS LIST SECTION START HERE--------------------------------------------------------------------------------- -->
<section class="list-200 content-box" style="margin: auto;max-width: 1050px">
  <h1 class="list-200-heading" data-list-heading>Driver Trips List</h1>
  <section class="list-200-top-section">
    <div>
    </div>
    <div>
    </div>
  </section>
  <!-- input used for sory by call-->
  <input type="hidden" id="sort_by" value="">
  <!-- //input used for sory by call-->
  <div class="table  table-a">
    <table  id="tabledata_trip_excel">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Trip ID</th>
          <th>Trip Date</th>
          <th>Truck ID</th>
          <th style="text-align: right;">Miles</th>
          <th>PPM</th>
          <th style="text-align: right;">Basic Earnings</th>
          <th style="text-align: right;">Incentive</th>
          <th></th>
        </tr> 
      </thead>
      <tbody id="tabledata_trip"></tbody>
    </table>
  </div>
  <div data-pagination-trip></div>
</section>
<script type="text/javascript">
  function show_list_trip() {
    var sort_by = $('#sort_by').val();
    var page_no = (check_url_params('pageno_trip') != undefined) ? check_url_params('pageno_trip') : 1;
    var batch = (check_url_params('batch_trip') != undefined) ? check_url_params('batch_trip') : 10;
    var webapi = "pagination";
    var dd = check_url_params('eid')
    $.ajax({
      url: location.pathname + '-trip',
      type: 'POST',
      data: {
        driver_eid: dd,
        page: page_no,
        sort_by: sort_by,
        batch: batch,
        webapi: webapi
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          $('#tabledata_trip').html("");
          $('#trip_excel').html("");
          if (data.status) {
            $.each(data.response.list, function(index, item) {
              var row = `<tr>
             <td>${item.sr_no}</td>
             <td>${item.id}</td>
             <td>${item.date}</td>
             <td>${item.truck_code}</td>
             <td style="text-align: right;">${item.miles}</td>             
             <td>${item.pay_per_mile}</td>             
             <td  style="text-align: right;">${item.basic_earnings}</td>
             <td  style="text-align: right;">${item.incentive}</td>
            </tr>`;
              $('#tabledata_trip').append(row);
              $('#trip_excel').append(row);
            })
            set_pagination_batch(data.response.batch, data.response.totalPages, data.response.currentPage, "trip")
          } else {
            $('#tabledata_trip').html("");
            $('#trip_excel').html("");
            var row = `<tr><td colspan="20">` + data.message + `</td></tr>`;
            $('#tabledata_trip').append(row);
            $('#trip_excel').append(row);
            $('[data-pagination-trip]').html('');
          }
        }
      }
    })
  }
  show_list_trip()
</script>
<script type="text/javascript">
  function sort_table() {
    show_list_trip()
  }
</script>
<br><br>
<!-- ---------------------DRIVER TRIPS LIST SECTION ENDS HERE--------------------------------------------------------------------------------- -->
<!-- ---------------------DRIVER PAYMENTS SECTION START HERE--------------------------------------------------------------------------------- -->
<section class="list-200 content-box" style="margin: auto;max-width: 1300px">
  <h1 class="list-200-heading" id="heading">Driver Payments</h1>
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
      <!-- <div class="filter-item">
        <label>Payment ID</label>
        <input type="text" data-filter="id" onchange="set_params('id', this.value), goto_page(1)">
        </select>
      </div> -->
      <div class="filter-item"></div>
    </div>
    <div class="list-200-top-action-right">
    </div>
  </section>
  <div class="table  table-a">
    <table data-ro-table-payment id="tabledata_payment_excel">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Payment ID</th>
          <th>Type</th>
          <th style="text-align: left;">Category</th>
          <th>Trip ID</th>
          <th>Parameter ID</th>
          <th style="text-align: right;">Payable</th>
          <th style="text-align: right;">Paid</th>
          <th style="text-align: right;">Balance</th>
          <th style="max-width:160px;word-wrap: break-word;">Remarks</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="tabledata_payment"></tbody>
    </table>
  </div>
  <div data-pagination-payment></div>
</section>
<script type="text/javascript">
  function show_list_payment() {
    var sort_by = $('#sort_by').val();
    var page_no = (check_url_params('pageno_payment') != undefined) ? check_url_params('pageno_payment') : 1;
    var batch = (check_url_params('batch_payment') != undefined) ? check_url_params('batch_payment') : 10;
    // var id = $('[data-filter="id"]').val();
    $.ajax({
      url: location.pathname + '-payment',
      type: 'POST',
      data: {
        page: page_no,
        sort_by: sort_by,
        batch: batch,
        driver_id: check_url_params('eid'),
        // id: id
      },
      // beforeSend: function() {
      //   show_table_data_loading('[data-ro-table-payment]')
      // },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          $('#tabledata_payment').html("");
          $('#payment_excel').html("");
          if (data.status) {
            $.each(data.response.list, function(index, item) {
              $('#heading').html(`Settlements of ${item.driver_code} ${item.driver_name}`);
              var row = `<tr>
              <td>${item.sr_no}</td>
              <td>${item.id}</td>
              <td>${item.type}</td>
              <td style="text-align:left">${item.category}</td>`;

              //if (item.trip_id){
              // row += `<td class="text-link"  onclick="open_child_window({url:'../user/accounts/trips/details?eid=${item.trip_eid}'})">${item.trip_id }
               row += `<td>${item.trip_id}</td>`;
            // }else{
               // row += `<td></td>`;
           //  }


               row +=`
              <td>${item.parameter_name}</td>           
              <td style="text-align:right">${item.amount}</td>                          
              <td style="text-align:right">${item.amount_paid}</td>                          
              <td style="text-align:right">${item.balance}</td>                          
              <td style="text-align:left;max-width:160px;word-wrap: break-word;">${item.remarks}</td>`
              row += `<td>`;
              if (item.edit_earning_and_deduction) {
                // row += `<button title="View" class="btn_grey_c"><a href="../user/accounts/drivers-payments/update-earnings-and-deductions?eid=` + item.eid + `"><i class="fa fa-pen"></i></a></button>`
                <?php if (in_array('P0143', USER_PRIV)) {
                ?>
                  // row += `<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="` + item.eid + `"><i class="fa fa-trash"></i></button>`;
                <?php
                } ?>
              }
              row += `</td>`;
              row += `</tr>`;
              $('#tabledata_payment').append(row);
              $('#payment_excel').append(row);
            })
            set_pagination_batch(data.response.batch, data.response.totalPages, data.response.currentPage, "payment")
          } else {
            var false_message = `<tr><td colspan="18">` + data.message + `<td></tr>`;
            $('#tabledata_payment').html(false_message);
            $('#payment_excel').html(false_message);
          }
        }
      }
    })
  }
  show_list_payment()
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on("click", "[data-action='delete']", function() {
      if (confirm('Do you want to delete ?')) {
        var eid = $(this).data("eid");
        $.ajax({
          url: window.location.pathname + '/delete-action',
          type: 'POST',
          data: {
            delete_eid: eid
          },
          context: this,
          success: function(data) {
            // alert(data)
            if ((typeof data) == 'string') {
              data = JSON.parse(data)
            }
            if (data.status) {
              $(this).parent().parent().fadeOut();
              show_list_payment();
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
  function sort_table() {
    show_list_payment()
  }
</script>
<!-- ---------------------DRIVER PAYMENTS SECTION ENDS HERE--------------------------------------------------------------------------------- -->

<!-- ---------------------ALL TRUCK REPAIR ORDER SECTION START HERE--------------------------------------------------------------------------------- -->
<section class="list-200 content-box" style="margin: auto;">
  <h1 class="list-200-heading">Repair Order List</h1>
  <section class="list-200-top-action">
    <div class="list-200-top-action-left">
      <!-- input used for sory by call-->
    </div>
    <div class="list-200-top-action-right">
    </div>
  </section>
  <div class="table  table-a">
    <table data-ro-table-rolist id="tabledata_rolist_excel">
      <input type='hidden' id='sort' value='asc'>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th data-table-sort-by-none="id">Order ID</th>
          <th data-table-sort-by-none="created_on">Created on</th>
          <th data-table-sort-by-none="status">Status</th>
          <th data-table-sort-by-none="class">Class</th>
          <th data-table-sort-by-none="type">Type</th>
          <th data-table-sort-by-none="driver">Driver</th>
          <th data-table-sort-by-none="stage">Stage</th>
          <th data-table-sort-by-none="vehicle">Vehicle</th>
          <th data-table-sort-by-none="vehicle_id">Vehicle ID</th>
          <th data-table-sort-by-none="start_date">Start Date</th>
          <th data-table-sort-by-none="end_date">End Date</th>
          <th style="min-width:500px;" data-table-sort-by-none="last_follow_up">Last Follow Up</th>
          <th data-table-sort-by-none="next_follow_up">Next Follow Up Date</th>
          <th style="text-align: left;" data-table-sort-by-none="issues_reported">Issues Reported</th>
          <th style="text-align: left;" data-table-sort-by-none="issues_description">Issues Description</th>
          <th>Created By</th>
          <th>Resolved By</th>
          <th>Closed By</th>
          <!-- <th></th>
          <th></th> -->
        </tr>
      </thead>
      <tbody id="tabledata_rolist"></tbody>
    </table>
  </div>
  <div data-pagination-rolist></div>
</section>
<script type="text/javascript">
  function show_list_rolist() {
    // var sort_by = $('#sort_by').val();
    // var sort_by_order_type = $('#sort').val();
    var page_no = (check_url_params('pageno_rolist') != undefined) ? check_url_params('pageno_rolist') : 1;
    var batch = (check_url_params('batch_rolist') != undefined) ? check_url_params('batch_rolist') : 10;
    $.ajax({
      url: location.pathname + '-rolist',
      type: 'POST',
      data: {
        //sort_by_order_type:sort_by_order_type,
        page: page_no,
        // sort_by: sort_by,
        batch: batch,
        driver_id: check_url_params('eid'),
      },
      beforeSend: function() {
        show_table_data_loading('[data-ro-table-rolist]')
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          $('#tabledata_rolist').html("");
          $('#rolist_excel').html("");
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
           <td>${item.end_date}</td>
           <td>${item.last_follow_up}</td>
           <td>${item.next_follow_up_datetime}</td>
           <td style="min-width:150px;text-align:left">${issue_reported}</td>
           <td style="min-width:150px;text-align:left">${issue_description}</td>
           <td>${item.added_by_user_code} ${item.added_by_user_name} ${item.added_on_datetime}</td>
           <td>${item.ro_resolved_by} ${item.ro_resolved_on}</td>
           <td>${item.closed_by_user_code} ${item.closed_by_user_name} ${item.closed_on_datetime}</td>`;
           $('#rolist_excel').append(row);
          
           // row+=`<td style="white-space:nowrap">`;
              <?php
             // if (in_array('P0228', USER_PRIV)) {
              ?>
               // row += `<button title="View" class="btn_grey_c"><a href="../user/maintenance/repair-orders/details?eid=${item.eid}"><i class="fa fa-eye"></i></a></button>`;
              <?php
              //}
              //if (in_array('P0229', USER_PRIV)) {
              ?>
               // row += `<button title="Edit" class="btn_grey_c"><a href="../user/maintenance/repair-orders/update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button>`;
              <?php
              //}
              //if (in_array('P0230', USER_PRIV)) {
              ?>
               //row += `<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="${item.eid}"><i class="fa fa-trash"></i></button>`;
              <?php
              // }
              //if (in_array('P0232', USER_PRIV)) {
              ?>//row += `<button class="btn_blue" onclick="open_child_window({url:'../user/maintenance/repair-orders/add-followup&eid=${item.eid}',width:1000,height:600})">Follow Up</button>`;
              //row += `&nbsp;&nbsp;<button class="btn_blue"><a href="../user/maintenance/work-orders/add-new?ro-eid=${item.eid}">Create Work Order</a></button>`;
            <?php
              //} ?>
            row += `

         </tr>`;
            $('#tabledata_rolist').append(row);
            //stats.push(item.status) 
            })
            set_pagination_batch(data.response.batch, data.response.totalPages, data.response.currentPage, "rolist")
          } else {
            $('[data-pagination-rolist]').html('')
            var false_message = `<tr><td colspan="18">` + data.message + `<td></tr>`;
            $('#tabledata_rolist').html(false_message);
            $('#rolist_excel').html(row);
          }
        }
      }
    })
  }
  show_list_rolist()
</script>
<script type="text/javascript">
  function sort_table() {
    show_list_rolist()
  }
</script><br><br>
<!-- ---------------------ALL TRUCK REPAIR ORDER SECTION END HERE--------------------------------------------------------------------------------- -->
<!-- ---------------------ALL DRIVER NOTES SECTION START HERE--------------------------------------------------------------------------------- -->
<br><br>
<style type="text/css">
  .notes-area {
    width: 95%;
    /*max-width: 1440px;*/
    margin: auto;
    background: lightblue;
    border: 1px solid grey;
    overflow: hidden;
    border-radius: 8px;
  }

  .notes-area h1 {
    text-align: center;
    background: #f1f1f1;
  }

  .notes-area .notes-box {
    height: 400px;
    overflow-y: auto;
    padding: 5px
  }

  .notes-area .note {
    background: white;
    padding: 6px;
    border-radius: 8px;
    margin: 5px auto;
    display: flex;
    width: 90%;
  }

  .notes-area .note.user-other {
    float: left;
  }

  .notes-area .note.user-self {
    float: right;
  }

  .notes-area .note.high-priority-true {
    background: var(--theme-color-red-light) !important;
  }

  .notes-area .note>div:nth-child(1) {
    width: 30px;
    text-align: center;
  }

  .notes-area .note .note-info {
    padding: 0 4px;
    color: grey;
    text-align: right;
    font-size: .8em;
    display: flex;
    align-items: center;
    margin-bottom: 5px;
  }

  .notes-area .note .note-info>div:nth-child(1) {
    width: 70%;
    text-align: left;
    color: var(--theme-color-blue)
  }

  .notes-area .note .note-info>div:nth-child(2) {
    width: 25%;
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    text-align: right;
  }

  .notes-area .note .note-text {
    white-space: pre-line;
    text-align: left;
    min-height: 50px;
  }

  .notes-area .notes-add-new-box {
    display: flex;
    align-items: center;
    padding: 10px;
    padding-top: 15px;
    background: #f2f2f2;
  }

  .notes-area .notes-add-new-box>div:nth-child(2) {
    width: 80px;
    padding: 8px;
  }

  .notes-area .notes-add-new-box>div:nth-child(1) {
    flex-grow: 1;
  }

  .notes-area .notes-add-new-box textarea {
    width: 100%;
    min-height: 100px;
  }

  .notes-area .notes-save-button {
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    font-size: 25px;
    background: var(--theme-color-green);
  }
</style>
<script type="text/javascript"></script>
<div data-notes-area="first"></div>
<script type="text/javascript">
  function create_notes_section(param) {
    $(`[data-notes-area="${param.notes_area}"]`).html(`<section class="notes-area">
      <h1>Notes</h1>
      <div class="notes-box"></div>
      <div class="notes-add-new-box">
      <div><textarea name="text" placeholder="Type something here. . . . "></textarea></div>
      <div><button  class="notes-save-button" title="Add notes" data-action="add-notes"><i class="fab fa-telegram-plane" style="color:white"></i></button></div>
      </div>
      </section>`);
  }
  var last_note_eid = 0;
  $driver_eid = check_url_params('eid');

  function show_notes(param1) {
    param2 = {
      reference_eid: check_url_params('eid'),
      reference_type_id: 'DRIVERS',
      document_type_eid: check_url_params('eid'),
    }
    let param = Object.assign(param1, param2);
    var notes_area = `[data-notes-area="${param.notes_area}"]`;
    $.ajax({
      url: "<?php echo AJAXROOT; ?>" + 'user/miscellaneous/notes/list-ajax',
      type: 'POST',
      data: param,
      beforeSend: function() {
        // $(notes_area+` .notes-box`).html(`<i class="fa fa-spinner fa-span">Loading</i>`);
      },
      success: function(data) {
        //console.log(data)
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          // $(notes_area+` .notes-box`).html(``);
          if (data.status) {
            last_note_eid = data.response.last_note_eid;
            $.each(data.response.list, function(index, item) {
              var user_type = 'user-self';
              if (item.user_type == 'OTHER') {
                user_type = 'user-other';
              }
              var high_priority_status = '';
              var high_priority_status_checked = '';
              if (item.high_priority_status == 'ON') {
                high_priority_status = 'high-priority-true';
                high_priority_status_checked = 'checked'
              }
              var note = `<div class="note ${user_type} ${high_priority_status}"  data-note-eid="${item.eid}">
          <div style="flex-grow:1">
          <div class="note-info">
          <div><b>${item.added_by_user_code} </b> (${item.added_by_user_name}) <span style="color:grey">${item.added_on_datetime} </span></div>
          <div>`
              if (user_type == 'user-self') {
                note += `<input type="checkbox" data-notes-toggle-high-priority-status ${high_priority_status_checked} title="highpriority status"/> &nbsp<i data-note-delete class="fa fa-trash" style="font-size:.9em;color:var(--theme-color-grey)"></i>`
              }
              note += `</div>
          </div>
          <div class="note-text">${item.text}</div>
          </div></div>`;
              $(notes_area + ` .notes-box`).append(note);
            })
            $(notes_area + ` .notes-box`).animate({
              scrollTop: $(notes_area + ` .notes-box`)[0].scrollHeight
            }, 0);
            $(notes_area + ' [name="text"]').val('')
          }
        }
      }
    })
  }
  create_notes_section({
    notes_area: 'first'
  })
  show_notes({
    notes_area: 'first',
  })
</script>
<div id="demo"></div>
<script>
  var myVar;

  function showTime() {
    show_notes({
      notes_area: 'first',
      reference_eid: $driver_eid,
      last_note_eid: last_note_eid
    })
  }

  function stopFunction() {
    clearInterval(myVar); // stop the timer
  }
  $(document).ready(function() {
    myVar = setInterval("showTime()", 10000);
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on("click", "[data-action='add-notes']", function() {
      var text = $(this).parent().parent().find('[name="text"]').val()
      if (text.length) {
        $.ajax({
          url: "<?php echo AJAXROOT; ?>" + 'user/miscellaneous/notes/add-new-action',
          type: 'POST',
          data: {
            reference_eid: check_url_params('eid'),
            reference_type_id: 'DRIVERS',
            document_type_eid: check_url_params('eid'),
            text: text
          },
          context: this,
          success: function(data) {
            if ((typeof data) == 'string') {
              data = JSON.parse(data)
            }
            if (data.status) {
              show_notes({
                notes_area: 'first',
                reference_eid: $driver_eid,
                last_note_eid: last_note_eid
              });
              var text = $(this).parent().parent().find('[name="text"]').val('')
            } else {
              alert(data.message)
            }
          }
        })
      } else {
        alert('Please write some text')
      }
    });
  });
</script>
<!-- ---------------------ALL DRIVER NOTES SECTION ENDS HERE--------------------------------------------------------------------------------- -->



<!------report view-->



<!----//report view-->


 <!-- ---------------------ALL DRIVER DOCUMENTS SECTION STARTS HERE--------------------------------------------------------------------------------- -->
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1500px">
  <h1 class="list-200-heading">All Drivers Documents</h1>
  <section class="list-200-top-action">
    <div class="list-200-top-action-left">
      <input type="hidden" id="sort_by" value="">
      <input type='hidden' id='sort' value='asc'>
    </div>
  </section>
  <div class="table  table-a">
    <table data-ro-table-document id="tabledata_document_excel">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th style='text-align:left' data-table-sort-by-none="driver">Driver</th>
          <th style='text-align:left' data-table-sort-by-none="document">Document</th>
          <th>Is Required</th>
          <th>Is Uploaded</th>
          <th data-table-sort-by-none="expiryleft">Expiry Days Left</th>
          <th data-table-sort-by-none="expiryd">Expiry Date</th>
          <th></th>
           <th>Verify</th>
          <th>Uploaded By</th>
          <th>Verified By</th>
          <th>Rejected By</th>
          <th>Remarks</th>
          <!-- <th></th> -->
        </tr>
      </thead>
      <tbody id="tabledata_document">
      </tbody>
    </table>
  </div>
  <div data-pagination-document></div>
</section>
<script type="text/javascript">
  function show_list_document() {
    // var sort_by = $('#sort_by').val();
    //  var sort_by_order_type = $('#sort').val();
    var page_no = (check_url_params('pageno_document') != undefined) ? check_url_params('pageno_document') : 1;
    var batch = (check_url_params('batch_document') != undefined) ? check_url_params('batch_document') : 10;
    var webapi = "pagination";
    $.ajax({
      url: window.location.pathname + '-document',
      type: 'POST',
      data: {
        driver_id: check_url_params('eid'),
        page: page_no,
        // sort_by: sort_by,
        batch: batch,
        // webapi: webapi
      },
      beforeSend: function() {
        $('#tabledata_document').html(`<tr><td colspan="18">Loading . . . <td></tr>`)
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          $('#tabledata_document').html("");
          $('#document_excel').html("");
          if (data.status) {
            var counter = 0;
            $.each(data.response.list, function(index, item) {
              let required_option_class = 'cross-red'
              let required_option_verify = 'NO'
              if (item.type_required_option) {
                required_option_class = 'check-green'
                required_option_verify = 'YES'
              }
              let remarks = "";
              let row = `<tr>
            <td>${item.sr_no}</td>
              <td style='text-align:left'>${item.driver_code}  ${item.driver_name}</td>
              <td style='text-align:left'>${item.type_name}</td>
              <td><span class='${required_option_class}'></span><span class="d-none">${required_option_verify}</span></td>`
              if (item.is_uploaded) {
                remarks = item.document_details.remarks;
                if (get_params().hasOwnProperty('expiry-alert')) {
                  var expiry_alert = 'bg-orange text-white';
                }
                if (get_params().hasOwnProperty('is-expired')) {
                  var expiry_alert = 'bg-red text-white';
                }
                row += `<td><span class='check-green'></span><span class='d-none'>YES</span></td>`;
                 if(item.document_details.is_expired == true){
                row += ` <td class='bg-red text-white'>${item.document_details.expiry_days_left}</td>`;
                }else

                if(item.document_details.expiry_alert == true){
                row += ` <td class='bg-orange text-white'>${item.document_details.expiry_days_left}</td>`;
                }else
                  if(item.document_details.expiry_days_left != ""){
                      row += ` <td>${item.document_details.expiry_days_left}</td>`;
                 }else{
                   row += `<td></td>`;
                 }
                row += `
               <td>${item.document_details.expiry_date}</td>
               <td style="white-space:nowrap">
               <button class='btn_grey_c' onclick="open_document('${item.document_details.file_path}')"><i class='fa fa-file'></i></button>`
                <?php //if (in_array('P0145', USER_PRIV)) {
                ?>
                 // row += `<button title="Edit" class="btn_grey_c"><a href="../user/masters/drivers/documents/upload?driver_eid=${item.driver_eid}&document_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-upload"></i></a></button>`;
                <?php
               // } ?>
                 if (item.document_details.verification_status == 'PENDING') {
                  <?php if (in_array('P0146', USER_PRIV)) {
                   ?>
                //     row += `<td>
                //   <select data-action="update-verification-status" data-document-eid="${item.document_details.eid}">
                //   <option value="" > Select</option>
                //   <option value="VERIFIED"> VERIFY </option>
                //   <option value="REJECTED"> REJECT </option>
                //   </select>
                //   </td>`
                   <?php
                  } else {
                  ?>
                    row += `<td>PENDING</td>`
                   <?php
                   }
                  ?>
                  } else {
                  row += `<td>${item.document_details.verification_status}</td>`;
                }
                row += `<td>${item.document_details.added_by_user_code} <br>${item.document_details.added_by_user_name}<br> <span style="white-space:nowrap"> ${item.document_details.added_on_datetime}</span></td>
              <td>${item.document_details.verified_by_user_code} <br> ${item.document_details.verified_by_user_name}  <br><span style="white-space:nowrap"> ${item.document_details.verified_on_datetime}</span></td>
              <td>${item.document_details.rejected_by_user_code} <br> ${item.document_details.rejected_by_user_name}  <br><span style="white-space:nowrap"> ${item.document_details.rejected_on_datetime}</span></td>
              `
              } else {
                row += `<td><span class='cross-red'><span><span class='d-none'>NO</span></td>
              <td></td>
              <td></td>
              <td style="white-space:nowrap">
              <button disabled style="cursor:auto"><i class="fa fa-upload"></i></button>`
                <?php if (in_array('P0145', USER_PRIV)) {
                ?>
                  // row += `<button title="Edit" class="btn_grey_c"><a href="../user/masters/drivers/documents/upload?driver_eid=${item.driver_eid}&document_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-upload"></i></a></button>`;
                <?php
                } ?>
                row += `<td></td>
              
              <td></td>
              <td></td>`  
              }
              if (remarks != null) {
                row += `<td>${remarks}</td>`
              } else {
                row += `<td></td>`
              }
              $('#document_excel').append(row);
            //   row += `
            // <td style="white-space:nowrap">
            // <button title="History" class="btn_grey_c"><a href="../user/masters/drivers/documents/document-history?driver_eid=${item.driver_eid}&document_type_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-history"></i></a></button>
            // <button title="Notes" class="btn_grey_c" onclick="open_notes({url:'../user/miscellaneous/notes/details?reference=DRIVER-DOCUMENT&eid=${item.driver_eid}&document-type-eid=${item.type_eid}'})"><i class="fa fa-sticky-note"></i></a></button></td>`
              row += `</tr>`
              $('#tabledata_document').append(row);
              
            })
            set_pagination_batch(data.response.batch, data.response.totalPages, data.response.currentPage, "document")
          } else {
            var false_message = `<tr><td colspan="18">` + data.message + `<td></tr>`;
            $('#tabledata_document').html(false_message);
            $('#document_excel').html(false_message);
          }
        }
      }
    })
  }
  show_list_document()
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on("change", "[data-action='update-verification-status']", function() {
      var eid = $(this).data('document-eid');
      var verification_status = $(this).val();
      if (verification_status == 'VERIFIED') {
        var url = "<?php echo AJAXROOT; ?>" + 'user/masters/drivers/documents/verify'
      } else if (verification_status == 'REJECTED') {
        var url = "<?php echo AJAXROOT; ?>" + 'user/masters/drivers/documents/reject'
      }
      $.ajax({
        url: url,
        type: 'POST',
        data: {
          document_eid: eid,
          verification_status: verification_status,
        },
        context: this,
        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message)
          if (data.status) {
            show_list_document()
          } else {
            alert(data.message)
          }
        }
      })
    });
  });
</script>
<script type="text/javascript">
  function sort_table() {
    show_list_document()
  }
</script><br><br>
<!-- ---------------------ALL DRIVER DOCUMENTS SECTION ENDS HERE--------------------------------------------------------------------------------- -->








<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>