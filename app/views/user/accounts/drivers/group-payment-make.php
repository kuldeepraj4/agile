<?php
require_once APPROOT.'/views/includes/user/header.php';
// $page=isset($_GET['page'])?$_GET['page']:0;
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1400px">
  <h1 class="list-200-heading">Process Settlements</h1>
  <section class="list-200-top-section">
    <div>

    </div>
    <div>

    </div>
  </section>



  <section class="list-200-top-action">
    <div class="list-200-top-action-left">

      <!-- input used for sory by-->
      <input type="hidden" id="sort_by" value="">
      <!-- //input used for sory by call-->


      <div class="filter-item">
        <label>Driver Code</label>
        <input type="text" data-filter="code" onkeyup="show_list()">
      </div>
      <div class="filter-item">
      </div>                  
    </div>
    <div class="list-200-top-action-right">

    </div>

  </section>
  <div class="table  table-a">
    <table data-ro-table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Driver ID</th>
          <th  style="text-align: left;">Driver Name</th>
          <th style="text-align: left;">Category</th>
          <th >Trip ID</th>
          <th >Created By</th>
          <th style="text-align: right;">Payable</th>
          <th style="text-align: right;">Paid</th>
          <th style="text-align: right;">Balance</th>
          <th style="text-align: right;"></th>
          <th>Paying Now</th>
          <th>Sum</th>
          <th>Payment Mode</th>
          <th>Transaction Reference</th>
        </tr>                       
      </thead>
      <tbody id="tabledata"></tbody>
      <tfoot style="display: none;"><tr>
        <td colspan="4"></td>
        <td style="text-align: right;font-size: 1.3em;font-weight: bolder">Total = </td>
        <td data-show-total style="text-align: right;font-size: 1.3em;font-weight: bolder">0</td>
        <td></td></tr></tfoot>
      </table>
      <div data-list-pagination></div>
      <!-- <div class="table-pagination" data-list-pagination style="margin:5px"></div> -->
      <ul class="color-code-explainer">
        <li><span class="bg-red-light"></span> &nbsp<span> Settlement status OFF</span></li>
      </ul>
    </div>
  </section>


  <section class="action-button-box">
    <?php echo in_array('P0125', USER_PRIV)?'<button type="button" class="btn_green" data-action="make-transaction">Create Transaction</button>':""; ?>
  </section>







  <script type="text/javascript">
  ///----code to show sum of checkbox in releted field
  $(document).ready(function(){
   $(document).on("change", "[data-checkbox]",function(){
    var this_checkbox_driver_eid=$(this).data('checkbox-driver-eid')
    var this_checkbox_payment_eid=$(this).data('checkbox-payment-eid')
    var this_checkbox_balance=$(this).data('checkbox-balance')
    var paying_now= ($(this).prop("checked") == true)?this_checkbox_balance:0
    
    $(`[data-paynow-payment-eid="${this_checkbox_payment_eid}"]`).val(paying_now)

    calculate_driver_sum(this_checkbox_driver_eid)
  })
 })


  function calculate_driver_sum(driver_eid){
   var  this_amount=0;
   $(`[data-paynow-driver-eid="${driver_eid}"]`).each(function () {
    this_amount=this_amount+parseFloat($(this).val())
  })
   $(`[data-sum-driver-eid="${driver_eid}"]`).val(this_amount)
 } 
</script>

<!-- -------code by swaran to make all of the paynow input work in table----STARTS HERE------ -->
<script type="text/javascript">
$(document).on("keyup", "[data-paynow]",function(){
  var this_paynow_driver_eid=$(this).data('paynow-driver-eid')
  var  this_amount=0;
   $(`[data-paynow-driver-eid="${this_paynow_driver_eid}"]`).each(function () {
    this_amount=this_amount+parseFloat($(this).val())
  })
   $(`[data-sum-driver-eid="${this_paynow_driver_eid}"]`).val(this_amount)
})
  </script>
<!-- -------code by swaran to make all of the paynow input work in table----ENDS HERE------ -->







<script type="text/javascript">

  function show_list(){
    show_processing_modal()
    var sort_by=$('#sort_by').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var driver_code=$('[data-filter="code"]').val(); 
     var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
  var webapi = "pagination";  
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        batch: batch,
        page: page_no,
         webapi:  webapi,
        sort_by:sort_by
      },
      // beforeSend: function(){
      //   $('#tabledata').html(`<tr><td colspan="5" style="text-align:center"> Loading . . . <td><tr>`);
      // },
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data)
        // console.log(data)
         $('#tabledata').html("");
         if(data.status){
          counter=0;
          var rows=``;
          $.each(data.response.list, function(index, item) {
            if(item.driver_code.toLowerCase().includes(driver_code)){       

              let payments_list_length=item.payments_list.length;
              if(payments_list_length>0){

                let row_span_condtion=0;
                $.each(item.payments_list, function(index2, item2) {

                  var row_bg_color='';
                  if(item.driver_settlement_status=='OFF'){
                    row_bg_color='bg-red-light';
                  }
                  console.log(row_bg_color)

                  if(row_span_condtion<1){
                    counter++
                    rows+=`<tr data-driver-row class="${row_bg_color}">
                    <td rowspan="${payments_list_length}">${counter}</td>
                    <td rowspan="${payments_list_length}" data-driver-eid="${item.driver_eid}" style="text-align:left">${item.driver_display_name}</td>
                    <td style="text-align:left">${item2.category}</td>
                    <td>${item2.trip_id}</td>
                    <td>${item2.added_by_user_code}</td>
                    <td style="text-align:right">${item2.amount}</td>
                    <td style="text-align:right">${item2.amount_paid}</td>
                    <td style="text-align:right">${item2.balance}</td>
                    

                    <td><input type="checkbox" data-checkbox data-checkbox-payment-eid="${item2.payment_eid}" data-checkbox-driver-eid="${item.driver_eid}" data-checkbox-balance="${item2.balance}"></td>
                    <td><input type="text" value="0" data-paynow data-paynow-payment-eid='${item2.payment_eid}' data-paynow-driver-eid="${item.driver_eid}" onkeyup="calculate_driver_sum('${item.driver_eid}')" class="w-100"></td>
                    <td rowspan="${payments_list_length}">
                    <input type="text" data-sum-driver-eid="${item.driver_eid}" class="w-100" disabled>
                    </td>
                    <td rowspan="${payments_list_length}">
                    <select data-payment-mode required>
                    <option value="">- - Select - -</option>
                    <option value="1">Cheque</option>
                    <option value="2">EFS</option>
                    <option value="3">ACH</option>
                    </select>
                    </td>
                    <td rowspan="${payments_list_length}">
                    <input type="text" data-payment-notes placeholder="Transaction reference" class="w-200">
                    </td>                                          
                    </tr>`                  
                  }else{
                    rows+=`<tr class="${row_bg_color}">
                    <td style="text-align:left">${item2.category}</td>
                    <td>${item2.trip_id}</td>
                    <td>${item2.added_by_user_code}</td>
                    <td style="text-align:right">${item2.amount}</td>
                    <td style="text-align:right">${item2.amount_paid}</td>
                    <td style="text-align:right">${item2.balance}</td>                    
                    <td><input type="checkbox" data-checkbox data-checkbox-payment-eid="${item2.payment_eid}" data-checkbox-driver-eid="${item.driver_eid}" data-checkbox-balance="${item2.balance}"></td>
                    <td><input type="text" value="0" data-paynow data-paynow-payment-eid='${item2.payment_eid}' data-paynow-driver-eid="${item.driver_eid}" onkeyup="calculate_driver_sum('${item.driver_eid}'')" class="w-100"></td>           
                    </tr>`
                  }
                  row_span_condtion++
                })
                


              }



            }


          })



          $('#tabledata').html(rows);

        }else{
          var false_message=`<tr><td colspan="18">`+data.message+`<td></tr>`;
          $('#tabledata').html(false_message);
        }
        set_pagination({
    selector: '[data-pagination]',
    totalPages: data.response.totalPages,
    currentPage: data.response.currentPage,
    batch: data.response.batch
  })


      }
      hide_processing_modal()
    }

  })
}

</script>
<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>

<script type="text/javascript">

  $(document).ready(function(){
   $(document).on("click", "[data-action='make-transaction']",function(){

    if(confirm('Do you want to make transaction ?')){
      show_processing_modal()

      var transactionArray=[];
      $('[data-driver-row]').each(function () {

        var driver_eid=$(this).find('[data-driver-eid]').data('driver-eid')
        paymentsList=[];
        $(`[data-checkbox-driver-eid=${driver_eid}]:checked`).each(function () {
          let item_payment_eid=$(this).data('checkbox-payment-eid')
          let item_paynow=$(`[data-paynow-payment-eid="${item_payment_eid}"]`).val()
          paymentsList.push({payment_eid:item_payment_eid,amount_paynow:item_paynow});
        })
//------if one or more checkboxes has been send
if(paymentsList.length>0){
  var entry={driver_eid:driver_eid,
    payments_list:paymentsList,
    payments_mode_id:$(this).find('[data-payment-mode]').val(),
    payments_notes:$(this).find('[data-payment-notes]').val()
  }
  transactionArray.push(entry)
}


});

      $.ajax({
        url:window.location.pathname+'-action',
        type:'POST',
        data:{
          transactions_array:transactionArray
        },
        context: this,
        success:function(data){
          if((typeof data)=='string'){
           data=JSON.parse(data) 
         }

         if(data.status){
          location.reload();
        }else{
          alert(data.message)
        }
        hide_processing_modal()
      }
    })
    }
  });
 });






  $("#select_all").click(function(){
    $("[data-move-incentive-row]").prop('checked', $(this).prop('checked'));

  });
  show_list()

</script>
<br><br><br><br><br>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>