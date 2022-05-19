<?php
require_once APPROOT . '/views/includes/user/header.php';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1700px">
  <h1 class="list-200-heading">Vendor Pending For Approval</h1>
  <section class="list-200-top-section">
    <div>
    </div>
    <div>
    </div>
  </section>
  <section class="list-200-top-action">
    <div class="list-200-top-action-left">
      <div class="filter-item">
        <label>Status ID</label>
        <select name="order_status_id" onchange="set_params('order_status_id', this.value), goto_page(1)">
        </select>
      </div>

      <div class="filter-item">
        <label>Vendor Name</label>
        <input type="text" onchange="set_params('vendor_name', this.value), goto_page(1)"  list="quick_list_vendor_name" data-vendor-name>
        </select>
      </div>

      <div class="filter-item">
        <label>Unit Type</label>
        <select data-filter="vehicle_type" onchange="$(`[data-vehicle-id]`).val(''),set_params('vehicle_type', this.value),set_params('vehicle_code', ''),set_params('vehicle_id', ''),switch_vid_attr(),goto_page(1), show_unit_filter({vehicle_type:this.value})"></select>
      </div>

      <div class="filter-item">
        <label>Unit No</label>
        <input type="text" data-filter="vehicle_id" list="quick_list_vehicle_id" data-vehicle-id disabled>
        </select>
      </div>

      <div class="filter-item">
        <label>WO No.</label>
        <input type="text" data-filter="wo_id" onchange="set_params('wo_id', this.value), goto_page(1)">
        </input>
      </div>

      <div class="filter-item">
        <label>Invoice No.</label>
        <input type="text" data-filter="invoice_no" onchange="set_params('invoice_no', this.value), goto_page(1)">
        </input>
      </div>

      <div class="filter-item">
        <input type="text" data-filter="name" onkeyup="show_list()" hidden>
      </div>
    </div>
    <div><select name="status_id" hidden>
        </select></div>
  </section>
  <div class="table  table-a">
    <table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Vendor ID</th>
          <th style="text-align: left;">Vendor Name</th>
          <th style="text-align: left;">Unit Type</th>
          <th style="text-align: left;">Unit No.</th>
          <th>WO No.</th>
          <th>Invoice No.</th>
          <th style="text-align: right;">Amount</th>
          <th>WO Date</th>
          <th>WO Remarks</th>
          <th>Status</th>
          <th>Remarks</th>
        </tr>
      </thead>
      <tbody id="tabledata"></tbody>
      <tfoot style="display: none;">
        <tr>
          <td colspan="4"></td>
          <td style="text-align: right;font-size: 1.3em;font-weight: bolder">Total = </td>
          <td data-show-total style="text-align: right;font-size: 1.3em;font-weight: bolder">0</td>
          <td></td>
        </tr>
      </tfoot>
    </table>
    <div class="table-pagination" data-list-pagination style="margin:5px"></div>
    <ul class="color-code-explainer">
    </ul>
  </div>
</section>
<br><br>

<section class="action-button-box">
    <!-- <?php// echo in_array('P0264', USER_PRIV)?'<button type="button" class="btn_green" onclick="save()">SAVE</button>':""; ?> -->
</section>




<datalist id="quick_list_vendor_name"></datalist>
<script type="text/javascript">
  get_maintenace_vendors().then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option value="" data-vendor-name-rows="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options+=`<option data-vendor-name-rows="`+item.name+`" data-value="${item.id}" value="`+item.name+`"></option>`;
        })
        $('#quick_list_vendor_name').html(options);
        
      }
    }
  })

$(document.body).on('change', '[data-vendor-name]' ,function(){
     id_selected=$(`[data-vendor-name-rows="${$(this).val()}"]`).data('value');
    if(id_selected==undefined){
     set_params('vendor_name', '');
       $(`[data-vendor-name]`).val('');
       goto_page(1);
    alert("Please enter correct Vendor Name")

    }
  });

  </script>








<script type="text/javascript">
  var urlParamsValue = "1";
  var url_params = get_params();
  if (url_params.hasOwnProperty('order_status_id')) {
    urlParamsValue = url_params.order_status_id;
  } else {
    set_params('order_status_id', 'ALL')
    urlParamsValue = url_params.order_status_id;
  }
  if (url_params.hasOwnProperty('id')) {
    $("[data-filter='id']").val(url_params.id);
  }
</script>

<script type="text/javascript">
  function show_status_filter_1() {
    get_workorder_status_approved().then(function(data) {
      if (data.status) {
        if (data.response.list) {
          var options = "";
          //options += `<option value="- - Select - -"></option>`
          if(urlParamsValue == "ALL") {
            options += `<option value="ALL" selected>PENDING & RFC</option>`;
          } else {
            options += `<option value="ALL">PENDING & RFC</option>`;
          }

          //$('[name="order_status_id"]').html(options);
          console.log(urlParamsValue);
          $.each(data.response.list, function(index, item) {
            //console.log(item);
            if (urlParamsValue ==  item.id ){
              options += `<option value="` + item.id + `" selected>` + item.name + `</option>`;
            } else {
              options += `<option value="` + item.id + `">` + item.name + `</option>`;
            }
          })
          $('[name="order_status_id"]').html(options);
        }
      }
    }).catch(function(err) {})
  }
  show_status_filter_1()
</script>

<script type="text/javascript">
  status_array = [];
  options2="";
  function show_status_filter(){
   get_workorder_status_approved().then(function(data) {
    if(data.status){
      if(data.response.list){
        options2+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options2+=`<option value="`+item.id+`">`+item.name+`</option>`;   
           status_array.push(item.id); 
        })
        $('[name="status_id"]').html(options2);  
       // if(param.hasOwnProperty('default_select'))
        // {
        // $('tr#'+param.row_id+' [name="status_id"] option[value="'+param.default_select+'"]').prop('selected',true); 
        // }
    }
  }
  }).catch(function(err) {
  }) 
}

show_status_filter()
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
          switch_vid_attr()
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
  $(document.body).on('input', '[data-vehicle-id]' ,function(){
    //alert("hhhh")
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
  $(document.body).on('change', '[data-vehicle-id]' ,function(){
     id_selected=$(`[data-vehicle-id-rows="${$(this).val()}"]`).data('value');
    if(id_selected==undefined){
    alert("Please enter correct VehicleID")
    }
  });
  </script>

<script type="text/javascript">
function switch_vid_attr(){
  var attr = check_url_params('vehicle_type')
  if((attr =='TRAILER') || (attr =='TRUCK')){
    $(`[data-vehicle-id]`).prop('disabled', false)
  }else{
    $(`[data-vehicle-id]`).prop('disabled', true)
  }
}
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
  ///----code to show sum of checkbox in releted field
  $(document).ready(function() {
    $(document).on("change", "[data-checkbox]", function() {
      var this_checkbox_driver_eid = $(this).data('checkbox-driver-eid')
      var this_checkbox_payment_eid = $(this).data('checkbox-payment-eid')
      var this_checkbox_balance = $(this).data('checkbox-balance')
      var paying_now = ($(this).prop("checked") == true) ? this_checkbox_balance : 0
      $(`[data-paynow-payment-eid="${this_checkbox_payment_eid}"]`).val(paying_now)
      calculate_driver_sum(this_checkbox_driver_eid)
    })
  })

  function calculate_driver_sum(driver_eid) {
    var this_amount = 0;
    $(`[data-paynow-driver-eid="${driver_eid}"]`).each(function() {
      this_amount = this_amount + parseFloat($(this).val())
    })
    $(`[data-sum-driver-eid="${driver_eid}"]`).val(this_amount)
  }
</script>

<script>

var can_change_pending_status = false;

<?php if(in_array('P0351', USER_PRIV)) { ?>
  can_change_pending_status = true;
<?php } ?>  

var can_change_approved_status = false;

<?php if(in_array('P0326', USER_PRIV)) { ?>
  can_change_approved_status = true;
<?php } ?>


</script>



<script type="text/javascript">
  function show_list() {
    // show_processing_modal()
    var sort_by = $('#sort_by').val();
    var driver_code = $('[data-filter="name"]').val();

    var order_status_id = (check_url_params('order_status_id') != undefined) ? check_url_params('order_status_id') : "ALL";

    var vendor_name=check_url_params('vendor_name');
    
    var vehicle_type=check_url_params('vehicle_type');
    var vehicle_id=check_url_params('vehicle_id');
    var wo_id=check_url_params('wo_id');
    var invoice_no=check_url_params('invoice_no');

    $.ajax({
      url: location.pathname + '-ajax',
      type: 'POST',
      data: {
        page: '<?php echo $page; ?>',
        sort_by: sort_by,
        order_status_id: order_status_id,
        vendor_name:vendor_name,
        
        vehicle_type:vehicle_type,
        vehicle_id:vehicle_id,
        wo_id:wo_id,
        invoice_no:invoice_no
      },
      beforeSend: function() {
        $('#tabledata').html(`<tr><td colspan="12" style="text-align:center"> Loading . . . <td><tr>`);
      },
      success: function(data) {
        status = $('[name="status_id"]').html();
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
        console.log(data)
          $('#tabledata').html("");
          if (data.status) {
            counter = 0;
            var rows = ``;
            $.each(data.response.list, function(index, item) {
              if (item.driver_code.toLowerCase().includes(driver_code)) {
                let payments_list_length = item.payments_list.length;
                if (payments_list_length > 0) {
                  let row_span_condtion = 0;
                  $.each(item.payments_list, function(index2, item2) {
                    var row_bg_color = '';
                   // if (row_span_condtion < 1) {
                      counter++
                      rows += `<tr data-driver-row data-stop-row class="${row_bg_color}">
                    <td rowspan="">${counter}</td>

                    <td style="text-align:left" rowspan="">${item.driver_code}</td>
                    
                    <td style="text-align:left" rowspan="">${item.driver_name}</td>

                    <td style="text-align:left">${item2.unit_type}</td>`
                    if (item2.unit_type == "") {
                        rows += `<td style="text-align:left"><span class="text-link">${item2.unit_no}</span></td>`;
                      }
                      if (item2.unit_type == "TRUCK") {
                        rows += `<td style="text-align:left"><span class="text-link" onclick="open_quick_view_truck('${item2.unit_eid}')">${item2.unit_no}</span></td>`;
                      }
                      if (item2.unit_type == "TRAILER") {
                        rows += `<td style="text-align:left"><span class="text-link" onclick="open_quick_view_trailer('${item2.unit_eid}')">${item2.unit_no}</span></td>`;
                      }
                    // rows += `
                    // <td name="trip_id">
                    // <button title="View" class="text-link"><a href="../user/maintenance/work-orders/details?eid=${item2.wo_eid}">
                    // <i class="">${item2.trip_id}</i></a></button>                    
                    // </td>`;
                    rows += `<td style="text-align:left"><span class="text-link" onclick="open_quick_view_work_order('${item2.wo_eid}')">${item2.trip_id}</span></td>`;

                      if (item2.invoice_file != '') {
                        rows += `<td style="text-align:left"><span onclick='open_document("${item2.invoice_file}")' class="text-link" title="View Invoice" style="cursor:pointer;">${item2.invoice_no}</span></td>`;
                      } else {
                        rows += '<td></td>';
                      }
                      rows += `<td style="text-align:right">${item2.amount}</td>
                    <td style="text-align:center">${item2.wo_date}</td><td style="text-align:center">${item2.wo_remarks}</td>`;

                    if(order_status_id == 'APPROVED'){
                      if(can_change_approved_status) {
                        rows += `<td><select data-trip_id="${item2.trip_id}" name="reconcilation_id" class="op" required>
                          <option value="">- - Select - -</option>`;
                            status_array.forEach(function(e){
                              //console.log('<option value='+e+'>'+e+'</option>')
                              if(item2.status_id == e){
                                rows+= '<option value='+e+' selected>'+e+'</option>';
                              }else{
                                rows+= '<option value='+e+'>'+e+'</option>';
                              }
                            });
                        rows +=`</select></td>`;
                        }
                        else {
                          rows +=`<td style="text-align:center">${item2.status_id}</td>`;
                        }
                    }
                    else{
                      if(can_change_pending_status) {
                        rows += `<td><select data-trip_id="${item2.trip_id}" name="reconcilation_id" class="op" required>
                          <option value="">- - Select - -</option>`;
                            status_array.forEach(function(e){
                              //console.log('<option value='+e+'>'+e+'</option>')
                              if(item2.status_id == e){
                                rows+= '<option value='+e+' selected>'+e+'</option>';
                              }else{
                                rows+= '<option value='+e+'>'+e+'</option>';
                              }
                            });
                        rows +=`</select></td>`;
                        }
                        else {
                          rows +=`<td style="text-align:center">${item2.status_id}</td>`;
                        }
                    }

                    
                    
                    
                    rows+=`<td><input id="remark_${item2.trip_id}" name="remarks" type="text" value="${item2.remarks}"></td>
                    </tr>`;                
                  })
                }
              }
            })
            $('#tabledata').html(rows);
          } else {
            var false_message = `<tr><td colspan="18">` + data.message + `<td></tr>`;
            $('#tabledata').html(false_message);
          }
        }
        // hide_processing_modal()
      }
    })
  }
</script>
<script type="text/javascript">
  function sort_table() {
    show_list()
  }
</script>

<script type="text/javascript">

function save(){
var $issue_rows = $("[data-stop-row]");
issues_array=[]
$issue_rows.each(function (index) 
{
  var $data_stop_row = $(this);
  var stop_row=
  {
    trip_id : $.trim($data_stop_row.find('[name="trip_id"]').text()),
    reconcilation_id : $data_stop_row.find('[name="reconcilation_id"]').val(),
    remarks : $data_stop_row.find('[name="remarks"]').val(),
  }
  issues_array.push(stop_row)  
})

var obj={
  issues:issues_array,
  //stops:JSON.stringify(issues_array)
}
console.log(obj)
$.ajax({
  url:window.location.pathname+'-action',
  type:'POST',
  data: obj,
  success:function(data){
    if((typeof data)=='string'){
     data=JSON.parse(data) 
   }
   alert(data.message);
   if(data.status){
    show_list();
   }
   else
   {
    }
}
})

return false

}

</script>

<?php if(in_array('P0351', USER_PRIV)) { ?>
<script>

  

   $(document).on('change', '[name="reconcilation_id"]', function() {

    var order_status_id = (check_url_params('order_status_id') != undefined) ? check_url_params('order_status_id') : "ALL";

    if(order_status_id == 'APPROVED' && !can_change_approved_status){
      return;
    }

    if($(this).val())
    {
      if(!confirm('Do you want to update status ?' )){
       goto_page(1);
                return;

      }
      issues_array = [];
      var stop_row=
      {
        trip_id : $(this).data('trip_id'),
        reconcilation_id : $.trim($(this).val()),
        remarks : $('#remark_'+$(this).data('trip_id')).val(),
      }
      issues_array.push(stop_row);
      var obj={
        issues:issues_array
      }
      console.log(obj)
      $.ajax({
        url:window.location.pathname+'-action',
        type:'POST',
        data: obj,
        success:function(data){
          if((typeof data)=='string'){
          data=JSON.parse(data) 
        }
        alert(data.message);
        if(data.status){
          show_list();
        }
        else
        {
          }
      }
      })

    }
    
   });

</script>
<?php } ?>

<script>
  show_list()
</script>
<br><br><br><br><br>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>