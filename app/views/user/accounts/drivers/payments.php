<?php

require_once APPROOT . '/views/includes/user/header.php';

// $page = isset($_GET['page']) ? $_GET['page'] : 1;



?>



<br><br>

<section class="list-200 content-box" style="margin: auto;max-width:1300px">

  <h1 class="list-200-heading" id="heading">All Settlements Details</h1>

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





      <div class="filter-item">

        <label>Payment ID</label>

        <input type="text" data-filter="payment_id" onkeyup="set_params('payment_id', this.value), goto_page(1)">

        </select>

      </div>



      <div class="filter-item">

        <label>Driver</label>

        <!-- <input type="text" list="quick_list_drivers" data-filter="driver_id" onkeyup="onchage_driver_filter(this.value)"> -->
        <input type="text" list="quick_list_drivers" data-filter="driver_id" data-driver-id>


      </div>

      <div class="filter-item">

        <label>Create Date From</label>

        <input type="text" data-date-picker="" data-date-from data-filter="created_date_from" onchange="set_params('created_date_from', this.value), goto_page(1)">

      </div>

      <div class="filter-item">

        <label>Create Date To</label>

        <input data-date-picker="" type="text" data-date-to data-filter="created_date_to" onchange="set_params('created_date_to', this.value), goto_page(1)" />

      </div>



      <div class="filter-item">

        <label>Paid Date From</label>

        <input type="text" data-date-picker="" paid-date-from data-filter="paid_date_from" onchange="set_params('paid_date_from', this.value), goto_page(1)">

      </div>

      <div class="filter-item">

        <label>Paid Date To</label>

        <input data-date-picker=""  paid-date-to type="text" data-filter="paid_date_to" onchange="set_params('paid_date_to', this.value), goto_page(1)" />

      </div>



    </div>

    <div class="list-200-top-action-right">

      <div><button class='btn_green' data-button-export-to-excel onclick="report_view()">Excel</button>

      </div>

    </div>



  </section>

  <!-- <div class="list-200-records-info" style="padding: 5px;display: flex;flex-wrap: wrap;"><br> -->
     <div class="list-200-records-info" ><br>
    <!-- <div>Total records : <b id="total-records"></b></div>
  </div> -->

  <div class="table table-a">

    <table data-ro-table>

      <thead>

        <tr>

          <th>Sr. No.</th>

          <th data-table-sort-by="id">Payment ID</th>

          <th style="text-align: left;" data-table-sort-by="driver_code">Driver</th>

          <th>Category</th>

          <th>Trip ID</th>

          <th>Type</th>

          <th style="text-align: right;">Amount</th>

          <th style="text-align: right;">Paid</th>

          <th style="text-align: right;">Balance</th>

          <th>Paid By</th>

          <th>Created By</th>

          <th>Created Datetime</th>

          <th>Remarks</th>

        </tr>

      </thead>

      <tbody id="tabledata"></tbody>

    </table>
    
    <input type='hidden' id='sort' value='asc'>
    <!-- <div class="table-pagination" data-list-pagination style="margin:5px"></div> -->

  </div>
<div data-pagination></div>
</section>



<script>
  $(document.body).on('change', '[data-date-from]', function() {
    var g1 = new Date(check_url_params('created_date_from'))
    var g2 = new Date(check_url_params('created_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Create Date From should be less than from Create Date To")
      $("[data-filter='created_date_from']").val("");
      set_params('start_date_from', "")
      goto_page(1)
    }
  });

  $(document.body).on('change', '[data-date-to]', function() {
    var g1 = new Date(check_url_params('created_date_from'))
    var g2 = new Date(check_url_params('created_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Create Date From should be less than from Create Date To")
      $("[data-filter='created_date_to']").val("");
      set_params('created_date_to', "")
      goto_page(1)
    }
  });
</script>





<script>
  $(document.body).on('change', '[paid-date-from]', function() {
    var g1 = new Date(check_url_params('paid_date_from'))
    var g2 = new Date(check_url_params('paid_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Paid Date From should be less than from Paid Date To")
      $("[data-filter='paid_date_from']").val("");
      set_params('paid_date_from', "")
      goto_page(1)
    }
  });

  $(document.body).on('change', '[paid-date-to]', function() {
    var g1 = new Date(check_url_params('paid_date_from'))
    var g2 = new Date(check_url_params('paid_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Paid Date From should be less than from Paid Date To")
      $("[data-filter='paid_date_to']").val("");
      set_params('paid_date_to', "")
      goto_page(1)
    }
  });
</script>



<script type="text/javascript">
  var url_params = get_params();
  if (url_params.hasOwnProperty('payment_id')) {
    $("[data-filter='payment_id']").val(url_params.payment_id);
  }
  if (url_params.hasOwnProperty('created_date_from')) {
    $("[data-filter='created_date_from']").val(url_params.created_date_from);
  }
  if (url_params.hasOwnProperty('created_date_to')) {
    $("[data-filter='created_date_to']").val(url_params.created_date_to);
  }
  if (url_params.hasOwnProperty('paid_date_from')) {
    $("[data-filter='paid_date_from']").val(url_params.paid_date_from);
  }
  if (url_params.hasOwnProperty('paid_date_to')) {
    $("[data-filter='paid_date_to']").val(url_params.paid_date_to);
  }
</script>

<script type="text/javascript">
 // driver_id = '';
  function show_list() {
    var sort_by_order_type = $('#sort').val();
    var sort_by = $('#sort_by').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var payment_id = check_url_params('payment_id')
    var driver_id = check_url_params('driver_id')
    var created_date_from = check_url_params('created_date_from')
    var created_date_to = check_url_params('created_date_to')
    var paid_date_from = check_url_params('paid_date_from')
    var paid_date_to = check_url_params('paid_date_to')
    var webapi = "pagination";
    $.ajax({

      url: location.pathname + '-ajax',

      type: 'POST',

      data: {
        page: page_no,

        sort_by_order_type:sort_by_order_type,
        
        sort_by: sort_by,

        batch: batch,
      
    webapi:  webapi,

        driver_id: driver_id,

        payment_id: payment_id,

        pay_status: $('[data-filter="pay_status"]').val(),

        created_date_from: created_date_from,

        created_date_to: created_date_to,

        paid_date_from: paid_date_from,

        paid_date_to: paid_date_to,

        id: $('[data-filter="id"]').val(),

        //added_date_from:$('[data-filter="start_date_from"]').val(),

        //added_date_to:$('[data-filter="start_date_to"]').val()

      },

      beforeSend: function() {

        $('#tabledata').html(`<tr><td colspan="18">Loading . . . <td></tr>`);

      },

      success: function(data) {

        console.log(data)

        if ((typeof data) == 'string') {

          data = JSON.parse(data)

          console.log(data)

          $('#tabledata').html("");

          if (data.status) {

            

            $.each(data.response.list, function(index, item) {

              $('#total-records').html(data.response.list.length)

              var paid_by = (item.paid_by_user_code != '') ? item.paid_by_user_code : '-';

              var paid_time = (item.paid_on_datetime != '') ? item.paid_on_datetime : '-';

              var parameter_name = (item.parameter_name != '') ? `<br>(` + item.parameter_name + `)` : '';






              var row = `<tr>

             <td>${item.sr_no}</td>

             <td>${item.id}</td>

             <td style="white-space:nowrap;text-align: left;">

             <span class="text-link"  onclick="open_quick_view_driver('${item.driver_eid}')">${item.driver_code} - ${item.driver_name}</span></td>

             <td>

             ${item.category}${parameter_name}</td>`


             if(item.trip_eid != ''){
             row += `<td class="text-link"  onclick="open_child_window({url:'../user/accounts/trips/details?eid=${item.trip_eid}'})">${item.trip_id}</td>`
           }else{
              row += `<td></td>`
           }



             row += `<td>${item.type}</td>

             <td style="text-align:right">${item.amount}</td>

             <td style="text-align:right">${item.amount_paid}</td>

             

             <td style="text-align:right">${item.balance}</td>

             <td style="text-align:center">${item.paid_details[0].paid_by_user_name} <br> ${item.paid_details[0].paid_by_user_code} <br> ${item.paid_details[0].paid_on_datetime}</td> 

             <td>${item.added_by_user_name} <br> ${item.added_by_user_code}</td> 

             <td>${item.added_on_datetime}</td> 

             <td style="text-align:left;white-space:pre">${item.remarks}</td> 

            </tr>`;

              $('#tabledata').append(row);



            })

            set_pagination({
              selector: '[data-pagination]',
              totalPages: data.response.totalPages,
              currentPage: data.response.currentPage,
              batch: data.response.batch
            })

            ///--pagination

            // $('[data-list-pagination]').data('list-pagination-total-pages',data.response.totalPages); //set total page value to pagination

            // $('[data-list-pagination]').data('list-pagination-active-pages',data.response.currentPage);

            // do_pagination()

            //  ///--/pagination



          } else {

            $('#tabledata').html("");
    var row=`<tr><td colspan="5">`+data.message+`</td></tr>`;
    $('#tabledata').append(row);
      $('[data-pagination]').html('');

          }

        }



      }



    })

  }

  show_list()
</script>







<!------report view-->

<div id="reportSection"></div>

<!----//report view-->

<script type="text/javascript">
  function report_view(param2) {

    param1 = {}

    let param = Object.assign(param1, param2);

    if (param.hasOwnProperty('filetype') == false) {

      param.filetype = 'CSV';

    }

    var sort_by = $('#sort_by').val();

    $.ajax({

      url: location.pathname + '-ajax',

      type: 'POST',

      data: {

        report_view: true,

        sort_by: sort_by,

        driver_id: check_url_params('driver_id'),

        payment_id: $('[data-filter="payment_id"]').val(),

        pay_status: $('[data-filter="pay_status"]').val(),

        created_date_from: $('[data-filter="created_date_from"]').val(),

        created_date_to: $('[data-filter="created_date_to"]').val(),

        paid_date_from: $('[data-filter="paid_date_from"]').val(),

        paid_date_to: $('[data-filter="paid_date_to"]').val(),

        id: $('[data-filter="id"]').val(),

      },

      beforeSend: function() {

        show_processing_modal();

        $('#reportSection').show();

        $('#reportSection').html(`<table id="reportTable"><thead><tr>

                    <th>Sr. No.</th>

                    <th>ID</th>

                    <th>Driver</th>

                    <th>Category</th>

                    <th>Trip ID</th>

                    <th>Type</th>

                    <th>Amount</th>

                    <th>Status</th>

                    <th>Created By</th>

                    <th>Created Datetime</th>

                    <th>Paid By</th>

                    <th>Paid Datetime</th>                    

                </tr>                       

            </thead>

            <tbody id="reportTableBody"></tbody></table>`);

      },

      success: function(data) {

        if ((typeof data) == 'string') {

          data = JSON.parse(data)

          if (data.status) {

            $.each(data.response.list, function(index, item) {

              var paid_by = (item.paid_by_user_code != '') ? item.paid_by_user_code : '-';

              var paid_time = (item.paid_on_datetime != '') ? item.paid_on_datetime : '-';

              var parameter_name = (item.parameter_name != '') ? `<br>(` + item.parameter_name + `)` : '';

              var row = `<tr>

             <td>${item.sr_no}</td>

             <td>${item.id}</td>

             <td style="white-space:nowrap;text-align: left;">

             <span class="text-link"  onclick="open_child_window({url:'../user/masters/drivers/details?eid=${item.driver_eid}'})">${item.driver_code} - ${item.driver_name}</span></td>

             <td>

             ${item.category}${parameter_name}</td>

            <td class="text-link"  onclick="open_child_window({url:'../user/accounts/trips/details?eid=${item.trip_eid}'})">${item.trip_id}</td>

             <td>${item.type}</td>

             <td style="text-align:right">${item.amount}</td>

             <td>${item.status}</td>

             <td>${item.added_by_user_code}</td> 

             <td>${item.added_on_datetime}</td> 

             <td>${paid_by}</td> 

             <td>${paid_time}</td>           

            </tr>`;

              $('#reportTableBody').append(row);

              // default action is 'download'



            })

            if (param.filetype == 'CSV') {

              $('#reportTable').first().table2csv({
                filename: 'report-payments.csv'
              });

            }

            $('#reportSection').hide();

            hide_processing_modal()





            ///--pagination

            $('[data-list-pagination]').data('list-pagination-total-pages', data.response.totalPages); //set total page value to pagination

            $('[data-list-pagination]').data('list-pagination-active-pages', data.response.currentPage);

            do_pagination()

            ///--/pagination



          } else {
            $('#reportSection').hide();
            alert(data.message)
            hide_processing_modal();
          }

        }



      }



    })

  }
</script>







<script type="text/javascript">
  function sort_table() {

    show_list()

  }
</script>













<datalist id="quick_list_drivers"></datalist>

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
      $(`[data-driver-id]`).val('')
    }
  });
</script>


<script type="text/javascript">
  function show_quick_list_drivers() {

    quick_list_drivers().then(function(data) {

      // Run this when your request was successful

      if (data.status) {



        //Run this if response has list

        if (data.response.list) {

          var options = "";

          options += `<option data-driver-filter-rows="" data-value="" value="">- - Select - -</option>`

          $.each(data.response.list, function(index, item) {

            options += `<option data-driver-filter-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" value="` + item.code + ' ' + item.name + `"></option>`;

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

  show_quick_list_drivers()



  function onchage_driver_filter(value) {

    var this_driver_id = $(`[data-driver-filter-rows="${value}"]`).data('value');

    if (this_driver_id != undefined) {

      driver_id = this_driver_id

      show_list();

    }

  }
</script>

<br><br><br><br><br>

<?php

require_once APPROOT . '/views/includes/user/footer.php';

?>