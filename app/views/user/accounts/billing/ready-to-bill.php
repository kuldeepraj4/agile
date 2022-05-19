<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<style type="text/css">
  .pending-cell {
    background: red;
    color: white;
  }
</style>
<section class="rv content-box" style="margin: auto;max-width: 1600px">
  <h1 class="rv-heading">Ready To Bill</h1>
  <section class="rv-filter-section">
    <!-- input used for sory by call-->
    <input type="hidden" id="sort_by" value="">
    <!-- //input used for sory by call-->
  </section>
  <div class="rv-table fixedheader">
    <input type='hidden' id='sort' value='asc'>
    <table data-my-table>
      <thead>
        <tr>
          <th>Sr No</th>
          <th>Load ID</th>
          <th>Status</th>
          <th>Customer</th>
          <th>Terminal</th>
          <th>Pick Up Location</th>
          <th>Pick Up Nos.</th>
          <th>Delivery Location</th>
          <th>Delivery Number</th>
          <th>Delivery Date</th>
          <th>Line Haul Amount</th>
          <th>Accessories</th>
          <th>Total Amount</th>
          <th>Rate Contract</th>
          <th>Proof Of Delivery</th>
          <th>Ready To Bill</th>
          <th>Bill Without Required Documents</th>
        </tr>
      </thead>
      <tbody id="tabledata"></tbody>
    </table>
  </div>
  <div data-pagination></div>
</section>


<script type="text/javascript">
  function show_list() {
    $.ajax({
      url: '../user/dispatch/billing/ready-to-bill-ajax',
      type: 'POST',
      data: {
        sort_by: $('#sort_by').val(),
        sort_by_order_type: $('#sort').val(),
        page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
        batch: (check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
        webapi: 'pagination',
        status_id: check_url_params('status_id'),
      },
      beforeSend: function() {
        show_table_data_loading("[data-my-table]")
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          // console.log(data)
          $('#tabledata').html("");
          if (data.status) {
            // var counter = 1;
            $.each(data.response.list, function(index, item) {
              var roc_bg_class = (item.roc_file == '') ? 'red' : 'white';
              var row = `<tr data-eid="${item.load_eid}">
           <td>${item.sr_no}</td>`;
              row += `<td style="white-space:nowrap" class="bg-white"><a class="text-link"  href="../user/dispatch/loads/details?eid=` + item.load_eid + `">${item.load_id}</a></td>`;
              row += `<td>${item.load_status_id}</td>
           <td><span class="tooltip">${item.customer_code}<span class="tooltiptext">${item.customer_name}</span></span></td>
           <td>${item.terminal}</td>
           <td>${item.shipper_location}</td>
           <td>${item.pick_up_numbers}</td>
           <td>${item.consignee_location}</td>
           <td>${item.delivery_numbers}</td>
           <td>${(item.delivery_date != "") ? date_format(item.delivery_date) : ''}</td>
           <td>${item.line_haul_amount}</td>
           <td></td>
           <td></td>
           
           `
              if (item.roc_file == '') {
                row += `<td style="background:#fc5353;">${item.po_number}</td>`;
              } else {
                row += `<td style="font-weight:bolder" ><span onclick="open_document('${item.roc_file}')">${item.po_number}</span></td>`;
              }

              row += `<td></td>
           <td style="white-space:nowrap;display:flex;align-item:center"> <input type="checkbox" data-ready-to-bill title="Ready to bill" /> <button class="btn_disabled" title="Create Bill"  date-create-bill disabled>Create Bill</button</td>
           <td><input type="checkbox" name="is_bill_without_docs" title="Bill without required documents"></td>`;
              row += `</tr>`;
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
            var row = `<tr><td colspan="5">` + data.message + `</td></tr>`;
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
  $(document).on('click', '[data-ready-to-bill]', function() {
    if ($(this).prop('checked') == true) {
      $(this).siblings('[date-create-bill]').prop('disabled', false).removeClass('btn_disabled').addClass('btn_green');
    } else {
      $(this).siblings('[date-create-bill]').prop('disabled', true).removeClass('btn_green').addClass('btn_disabled');
    }
  })

  $(document).on('click', '[date-create-bill]', function() {

    $.ajax({
      url: '../user/dispatch/billing/mark-ready-to-bill-action',
      type: 'POST',
      data: {
        load_eid: $(this).parents('tr').data('eid')
      },
      success: function(data) {
        alert(data)
        console.log(data)
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          if (data.status) {
            window.location.reload()
          }

        }

      }
    })
  })
</script>





<script type="text/javascript">
  function sort_table() {
    show_list()
  }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>