<?php
require_once APPROOT . '/views/includes/user/header-quick-view.php';
?>
<br><br>
<form class="lg-form" method="POST" id="MyForm">
  <section class="rv content-box" style="margin: auto;max-width: 1200px !important;">
    <h1 class="rv-heading">Customer Reporting Make</h1>
    <div class="rv-table fixedheader">
      <input type='hidden' id='sort' value='asc'>
      <table data-my-table>
        <thead>
          <tr>
            <th>Sr No</th>
            <th>Customer</th>
            <th>Load PO</th>
            <th>Location</th>
            <th>Status</th>
            <th>Reefer Temperature</th>
            <th>Remarks</th>
          </tr>
        </thead>
        <tbody id="tabledata"></tbody>
      </table>
    </div>
</form>
<div data-pagination></div>
</section>
<section class="lg-form-action-button-box">
  <button type="submit" id="button" class="btn_green" onclick="add_new()">SAVE</button>
</section>
</form>
<script type="text/javascript">
  function show_list() {
    $.ajax({
      url: location.pathname + '-ajax',
      type: 'POST',
      data: {
        customer_eid: check_url_params('eid'),
      },
      beforeSend: function() {
        show_table_data_loading("[data-my-table]")
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          $('#tabledata').html("");
          if (data.status) {
            var counter = 1;
            $.each(data.response.list, function(index, item) {
              var row = `<tr data-make-row data-loadpo="${item.po_number}">
           <td>${counter}</td>
           <td>${item.customer_code} - ${item.customer_name}</td>
           <td >${item.po_number}</td>
           <td><textarea name="location" style="min-height:70px">${item.truck_location}</textarea></td>
           <td><textarea name="status" style="min-height:70px"> ${item.load_status_id}</textarea></td>
           <td><textarea name="reefer_temperature" style="min-height:70px">${item.reefer_temperature}</textarea></td>
           <td><textarea name="remarks" style="min-height:70px">${item.remarks}</textarea></td>`;
              row += `</tr>`;
              $('#tabledata').append(row);
              counter++;
            })
          } else {
            $('#tabledata').html("");
            var row = `<tr><td colspan="5">` + data.message + `</td></tr>`;
            $('#tabledata').append(row);
          }
        }
      }
    })
  }
  show_list()
</script>


<script type="text/javascript">
  function add_new() {
    var customer_eid = "<?php echo $_GET['eid']; ?>";


    var $data_make_rows = $("[data-make-row]");
    data_make_array = []
    let make_sr_no = 0;
    $data_make_rows.each(function(index) {
      var $data_stop_row = $(this);
      var make_row = {
        make_sr_no: ++make_sr_no,
        load_po: $data_stop_row.data("loadpo"),
        location: $data_stop_row.find("[name=location]").val(),
        status: $data_stop_row.find("[name=status]").val(),
        reefer_temperature: $data_stop_row.find("[name=reefer_temperature]").val(),
        remarks: $data_stop_row.find("[name=remarks]").val(),
      }
      data_make_array.push(make_row)
    })

    var obj = {
      customer_eid: customer_eid,
      report_details: data_make_array,
    }
    $.ajax({
      url: '../user/dispatch/reporting/customer-reporting/add-new-action',
      type: 'POST',
      data: obj,
      success: function(data) {
        alert(data)
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
        }
        alert(data.message)
        if (data.status) {
          
          window.location.href = "../user/dispatch/reporting/customer-reporting/report-details?eid=" + data.response.new_eid;
        }
        hide_processing_modal()
      }
    })

  }
</script>