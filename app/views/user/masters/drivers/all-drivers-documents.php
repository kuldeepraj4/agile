<?php
require_once APPROOT . '/views/includes/user/header.php';
//$page=isset($_GET['page'])?$_GET['page']:1;
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1500px">
  <h1 class="list-200-heading">All Drivers Documents</h1>
  <section class="list-200-top-action">
    <div class="list-200-top-action-left">
      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
      <input type='hidden' id='sort' value='asc'>
      <input type="hidden" data-filter="driver_id" value="">
      <!-- //input used for sory by call-->
      <div class="filter-item">
        <label>Search Driver</label>
        <!-- <input type="text" data-selected-driver-id="" list="quick_list_drivers" name="quick_list_drivers_search">
         -->
         <input type="text" list="quick_list_drivers" data-filter="driver_id" data-driver-id>
      </div>
      <div class="filter-item">
        <label>Document Type</label>
        <select data-filter="document_type_id" onchange="set_params('document_type_id', this.value), goto_page(1)"></select>
      </div>
      <div class="filter-item">
        <label>Expiry Date From</label>
        <input type="text" data-date-from data-filter="expiry_days_from" data-date-picker onchange="set_params('expiry_days_from', this.value), goto_page(1)">
        </input>
      </div>
      <div class="filter-item">
        <label>Expiry Date To</label>
        <input type="text" data-date-to data-filter="expiry_days_to" data-date-picker onchange="set_params('expiry_days_to', this.value), goto_page(1)">
        </input>
      </div>
      <div class="filter-item">
        <label>Uploaded By</label>
        <select data-filter="document_added_by" onchange="set_params('document_added_by', this.value), goto_page(1)">
        </select>
      </div> 
       <div class="filter-item">
        <label>Verified By</label>
        <select data-filter="document_verified_by" onchange="set_params('document_verified_by', this.value), goto_page(1)">
        </select>
      </div>
      <div class="filter-item">
        <label>Is Required</label>
        <select data-filter="is_required" onchange="set_params('is_required', this.value), goto_page(1)">
          <option value=""> - - Select - -</option>
          <option value="true">Yes</option>
          <option value="false">No</option>
        </select>
      </div>
      <div class="filter-item">
        <label>Is Uploaded</label>
        <select data-filter="is_uploaded" onchange="set_params('is_uploaded', this.value), goto_page(1)">
          <option value=""> - - Select - -</option>
          <option value="true">Yes</option>
          <option value="false">No</option>
        </select>
      </div>
      <div class="filter-item">
        <label>Expiry Days Left</label>
        <input type="number" data-filter="expiry_days_left" data-filter="expiry_days_left" onkeyup="show_list()">
        </select>
      </div> 
      <div class="filter-item">
        <label>CDL No.</label>
        <input type="text" data-filter="cdl_no" onkeyup="set_params('cdl_no', this.value), goto_page(1)">
      </div>
      <div class="filter-item"></div>
    </div>
    <div class="list-200-top-action-right">
    </div>
  </section>
  <div class="table  table-a">
    <table data-ro-table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th style='text-align:left' data-table-sort-by="driver">Driver</th>
           <th style='text-align:left' data-table-sort-by="cdl_no_sr">CDL No.</th>
          <th style='text-align:left' data-table-sort-by="document">Document Type</th>
          
          <th>Is Required</th>
          <th>Is Uploaded</th>

          <th data-table-sort-by="expiryleft">Expiry Days Left</th>
          <th data-table-sort-by="issue_date">Issue Date</th>
          <th data-table-sort-by="expiryd">Expiry Date</th>

          <th></th>
          <th>Verify</th>
          <th>Uploaded By</th>
          <th>Verified By</th>
          <th>Rejected By</th>
          <th>Remarks</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="tabledata">
      </tbody>
    </table>
    </div>
<div data-pagination></div>
</section>

<script type="text/javascript">
  var url_params = get_params();
  if (url_params.hasOwnProperty('expiry_days_from')) {
    $("[data-filter='expiry_days_from']").val(url_params.expiry_days_from);
  }
  if (url_params.hasOwnProperty('expiry_days_to')) {
    $("[data-filter='expiry_days_to']").val(url_params.expiry_days_to);
  }
  if (url_params.hasOwnProperty('is_required')) {
    $("[data-filter='is_required'] option[value=" + url_params.is_required + "]").prop('selected', true);
  }
  if (url_params.hasOwnProperty('is_uploaded')) {
    $("[data-filter='is_uploaded'] option[value=" + url_params.is_uploaded + "]").prop('selected', true);
  }
  if (url_params.hasOwnProperty('cdl_no')) {
    $("[data-filter='cdl_no']").val(url_params.cdl_no);
  }
</script>


<script>
  $(document.body).on('change', '[data-date-from]', function() {
    var g1 = new Date(check_url_params('expiry_days_from'))
    var g2 = new Date(check_url_params('expiry_days_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Expiry Date From should be less than from Expiry Date To")
      $("[data-filter='expiry_days_from']").val("").focus();
      set_params('expiry_days_from', "")
      goto_page(1)
    }
  });

  $(document.body).on('change', '[data-date-to]', function() {
    var g1 = new Date(check_url_params('expiry_days_from'))
    var g2 = new Date(check_url_params('expiry_days_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Expiry Date From should be less than from Expiry Date To")
      $("[data-filter='expiry_days_to']").val("").focus();
      set_params('expiry_days_to', "")
      goto_page(1)
    }
  });
</script>









<script type="text/javascript">
  function verified_by() {
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
          $('[data-filter="document_verified_by"]').html(options);
          if (url_params.hasOwnProperty('document_verified_by')) {
            $("[data-filter='document_verified_by'] option[value=" + url_params.document_verified_by + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  verified_by()
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
          $('[data-filter="document_added_by"]').html(options);
          if (url_params.hasOwnProperty('document_added_by')) {
            $("[data-filter='document_added_by'] option[value=" + url_params.document_added_by + "]").prop('selected', true);
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
  $.ajax({
    url: "<?php echo AJAXROOT; ?>" + 'user/dropdown/driver-document-types-ajax',
    type: 'POST',
    data: {},
    success: function(data) {
      if ((typeof data) == 'string') {
        data = JSON.parse(data)
        //$('#tabledata').html("");
        options = '<option value=""> - - Select - - </option>';
        if (data.status) {
          $.each(data.response.list, function(index, item) {
            options += `<option value="${item.id}">${item.name}</option>`;
          })
          $('[data-filter="document_type_id"]').html(options);
          if (url_params.hasOwnProperty('document_type_id')) {
            $("[data-filter='document_type_id'] option[value=" + url_params.document_type_id + "]").prop('selected', true);
          }
        }
      }
    }
  })
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
<datalist id="quick_list_drivers"></datalist>
<script type="text/javascript">
  $(document.body).on('change', '[name="quick_list_drivers_search"]', function() {
    driver_id_selected = $(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if (driver_id_selected != undefined) {
      $(this).data('selected-driver-id', driver_id_selected)
      set_params('driver_id', driver_id_selected)
      set_params('driver_name', $(`[data-selected-driver-id]`).val())
      goto_page(1)
    }
  });

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
   var driver_id='';
  function show_list() {
    var sort_by = $('#sort_by').val();
    var expiry_days_left =$('[data-filter="expiry_days_left"]').val().toUpperCase();
     var sort_by_order_type = $('#sort').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var driver_id = check_url_params('driver_id')
    var document_type_id = check_url_params('document_type_id')
    var expiry_days_from = check_url_params('expiry_days_from')
    var expiry_days_to = check_url_params('expiry_days_to')
    var expiry_date = check_url_params('expiry_date')
    var document_added_by = check_url_params('document_added_by')
    var document_verified_by = check_url_params('document_verified_by')
    var is_required = (check_url_params('is_required') != '') ? check_url_params('is_required') : check_url_params('is-required');
    var is_uploaded = (check_url_params('is_uploaded') != '') ? check_url_params('is_uploaded') : check_url_params('is-uploaded');
    var cdl_no = check_url_params('cdl_no');
    $.ajax({
      url: window.location.pathname + '-ajax',
      type: 'POST',
      data: {
        page: page_no,
        sort_by_order_type:sort_by_order_type,
        sort_by: sort_by,
        cdl_no:cdl_no,
        batch: batch,
        expiry_days_left:expiry_days_left,
        driver_id: driver_id,
        //driver_id: $('[name="quick_list_drivers_search"]').data('selected-driver-id'),
        //document_type_id: document_type_id,
        expiry_days_from: expiry_days_from,
        expiry_days_to: expiry_days_to,
        expiry_date: expiry_date,
        document_added_by: document_added_by,
        document_verified_by: document_verified_by,

       // driver_id:$('[name="quick_list_drivers_search"]').data('selected-driver-id'),
        document_type_id:$('[data-filter="document_type_id"]').val(),
        is_uploaded:is_uploaded,
        is_required:is_required,
        is_expired:'<?php echo $data['is_expired']; ?>',
        expiry_alert:'<?php echo $data['expiry_alert']; ?>',
        verification_status:'<?php echo $data['verification_status']; ?>'
      },
      beforeSend: function() {
         $('#tabledata').html(`<tr><td colspan="18">Loading . . . <td></tr>`)
      },
      success: function(data) {

        if ((typeof data) == 'string') {
         
          data = JSON.parse(data)
          $('#tabledata').html("");
          if (data.status) {
            var counter = 0;
            $.each(data.response.list, function(index, item) {
              //console.log(item)
              let required_option_class = 'cross-red'
              if (item.type_required_option) {
                required_option_class = 'check-green'
              }
              let remarks = "";
              let row = `<tr>
            <td>${item.sr_no}</td>
              <td style='text-align:left'> ${item.driver_name}</td>
               <td style='text-align:left'>${item.cdl_no_driver}</td>
              <td style='text-align:left'>${item.type_name}</td>

             
              <td><span class='${required_option_class}'><span></td>`

              if (item.is_uploaded) {
                remarks = item.document_details.remarks;
              if(get_params().hasOwnProperty('expiry-alert')){
              var expiry_alert = 'bg-orange text-white';
            } if(get_params().hasOwnProperty('is-expired')){
              var expiry_alert='bg-red text-white';
            }

            


                row += `<td><span class='check-green'><span></td>`;
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
                
              row += ` <td>${item.document_details.issue_date}</td><td>${item.document_details.expiry_date}</td>
               <td style="white-space:nowrap">
               <button class='btn_grey_c' onclick="open_document('${item.document_details.file_path}')"><i class='fa fa-file'></i></button>`
                <?php if (in_array('P0145', USER_PRIV)) {
                ?>
                  row += `<button title="Edit" class="btn_grey_c"><a href="../user/masters/drivers/documents/upload?driver_eid=${item.driver_eid}&document_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-upload"></i></a></button>`;
                <?php
                } ?>
                if (item.document_details.verification_status == 'PENDING') {
                  <?php if (in_array('P0146', USER_PRIV)) {
                  ?>
                    row += `<td>
                  <select data-action="update-verification-status" data-document-eid="${item.document_details.eid}">
                  <option value="" > Select</option>
                  <option value="VERIFIED"> VERIFY </option>
                  <option value="REJECTED"> REJECT </option>
                  </select>
                  </td>`
                  <?php
                  } else {
                  ?>
                    row += `<td></td>`
                  <?php
                  }
                  ?>
                } else {
                  row += `<td>${item.document_details.verification_status}</td>`;
                }
                row += `<td>${item.document_details.added_by_user_code} <br>${item.document_details.added_by_user_name}<br> <span style="white-space:nowrap"> ${item.document_details.added_on_datetime}</span></td>
              <td>${item.document_details.verified_by_user_code} <br> ${item.document_details.verified_by_user_name} <span style="white-space:nowrap"> ${item.document_details.verified_on_datetime}</span></td>
              <td>${item.document_details.rejected_by_user_code} <br> ${item.document_details.rejected_by_user_name} <span style="white-space:nowrap"> ${item.document_details.rejected_on_datetime}</span></td>
              `
              } else {
                row += `<td><span class='cross-red'><span></td>
              <td></td>
              <td></td>
              <td style="white-space:nowrap">
              <button disabled style="cursor:auto"><i class="fa fa-upload"></i></button>`
                <?php if (in_array('P0145', USER_PRIV)) {
                ?>
                  row += `<button title="Edit" class="btn_grey_c"><a href="../user/masters/drivers/documents/upload?driver_eid=${item.driver_eid}&document_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-upload"></i></a></button>`;
                <?php
                } ?>
                row += `<td></td>
              <td></td>
              <td></td>
              <td></td>`

            }
            if(remarks != null){
            row+=`<td>${remarks}</td>`
          }else{
              row+=`<td></td>` 
          }
              row +=`
            <td style="white-space:nowrap">
            <button title="History" class="btn_grey_c"><a href="../user/masters/drivers/documents/document-history?driver_eid=${item.driver_eid}&document_type_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-history"></i></a></button>
            <button title="Notes" class="btn_grey_c" onclick="open_notes({url:'../user/miscellaneous/notes/details?reference=DRIVER-DOCUMENT&eid=${item.driver_eid}&document-type-eid=${item.type_eid}'})"><i class="fa fa-sticky-note"></i></a></button></td>`
              row += `</tr>`
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
          }
        }
      }
    })
  }
  show_list()
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on("change", "[data-action='update-verification-status']", function() {
      if (confirm('Are you sure to change the verification status ?')) {
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
            show_list()
          } else {
            alert(data.message)
          }
        }
      })
    }else{
      $("[data-action='update-verification-status']").prop('selectedIndex', 0);
    }
    });
  });
</script>
<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>

<br><br><br><br>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>