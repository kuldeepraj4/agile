<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="rv content-box" style="margin: auto;max-width: 1600px">
  <h1 class="rv-heading">Submit Factoring</h1>
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
          <th>Customer</th>
          <th>Terminal</th>
          <th>Line Haul Amount</th>
          <th>Accessories</th>
          <th>Total Amount</th>
          <th>Approved By</th>
          <th>Check Box</th>
          <th>Cancel Freight Bill</th>
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
      url: '../user/dispatch/billing/submit-factoring-list-ajax',
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
          $('#tabledata').html("");
          if (data.status) {
            // var counter = 1;
            $.each(data.response.list, function(index, item) {
              var row = `<tr>
           <td>${item.sr_no}</td>
           <td>${item.load_id}</td>
           <td><span class="tooltip">${item.customer_code}<span class="tooltiptext">${item.customer_name}</span></span></td>
           <td>${item.terminal}</td>
           <td>${item.line_haul_amount}</td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>`;
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
  function sort_table() {
    show_list()
  }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>