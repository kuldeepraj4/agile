<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 800px">
  <h1 class="list-200-heading">Driver Settlement Ledger</h1>
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
      <input type='hidden' id='sort' value='asc'>


      <div class="filter-item">
        <label>Driver ID</label>
        <input type="text" data-filter="code" name="quick_list_drivers_search" list="quick_list_drivers" data-driver-id>
      </div>            
      <div class="filter-item">
      </div>
    </div>
    <div class="list-200-top-action-right">
      <div>
        <?php
        if(in_array('P0119', USER_PRIV)){
          echo "<button class='btn_grey button_href'><a href='../user/accounts/drivers-payments/group-payment-make'>Make Payment</a></button>";
        }
        ?>
      </div>
    </div>

  </section>
  <div class="table  table-a">
    <table data-table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th style="text-align: left;" data-table-sort-by="driver">Driver</th>
          <th style="text-align: left;">Payable Balance</th>
          <?php   if(in_array('P0166', USER_PRIV)){ ?>
          <th style="text-align: center;">Settlement Status</th>

          <?php } ?>
          <th style="text-align: center;">Action</th>
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
      set_params('driver_id', '')
      set_params('driver_name', '')
      $(`[data-driver-id]`).val('')
      goto_page(1)
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

</script>



<script type="text/javascript">
  var driver_id = '';
  function show_list(){

   var sort_by = $('#sort_by').val();
   var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
   var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
   var webapi = "pagination";
   var sort_by_order_type = $('#sort').val();
   var driver_id = check_url_params('driver_id')

   $.ajax({
    url:location.pathname+'-ajax',
    type:'POST',
    data:{
     page: page_no,
     sort_by: sort_by,
     sort_by_order_type:sort_by_order_type,
     batch: batch,
     driver_id: driver_id,
     webapi:  webapi
   },

   success:function(data){
    if((typeof data)=='string'){
     data=JSON.parse(data)
     $('#tabledata').html('');
     if(data.status){
      var counter=0;    
      $.each(data.response.list, function(index, item) {
            //console.log(item)
            var settlement_status="";
            if(item.driver_settlement_status=="ON"){
              settlement_status='checked';  
            }else{
              settlement_status=''; 
            }


            var row=`<tr>
            <td>${item.sr_no}</td>
            <td style="white-space:nowrap;text-align: left;">
            <span class="text-link"  onclick="open_quick_view_driver('${item.driver_eid}')">${item.driver_display_name}</span></td>         
            <td style="text-align:left">${item.balance}</td>`

            <?php if(in_array('P0166', USER_PRIV)){ ?>
              row +=`<td style="text-align:center">
              <input type="checkbox" ${settlement_status} data-toggle-settlement-status data-driver-eid="${item.driver_eid}"></td>`;

            <?php }
            if(in_array('P0141', USER_PRIV)){ ?>
              row +=`<td style="text-align:right" ><a style="color:blue" href="../user/accounts/drivers-payments/add-earnings-and-deductions?eid=`+item.driver_eid+`">Add Earning/ Deduction</a></td>`;

            <?php  } ?>

            row+=`<td><button title="View" class="btn_grey_c"><a href="../user/accounts/drivers-payments/driver-pending-paybles?eid=`+item.driver_eid+`"><i class="fa fa-eye"></i></a></button></td>`;

            row+=`</tr>`;
            $('#tabledata').append(row);
            set_pagination({
              selector: '[data-pagination]',
              totalPages: data.response.totalPages,
              currentPage: data.response.currentPage,
              batch: data.response.batch
            })

          })

    }else{
      var false_message=`<tr><td colspan="18">`+data.message+`<td></tr>`;
      $('#tabledata').html(false_message);
    }
  }

}

})
 }
 show_list()

</script>

<script type="text/javascript">
 $(document).on("click", "[data-toggle-settlement-status]",function(){
  var driver_eid=$(this).data('driver-eid')
  var settlement_status=($(this).prop("checked"))?'ON':'OFF';
  $.ajax({
    url:"<?php echo AJAXROOT; ?>"+'user/accounts/drivers-payments/drivers-toggle-settlement-status',
    type:'POST',
    data:{
      driver_eid:driver_eid,
      settlement_status:settlement_status
    },
    context: this,
    success:function(data){
     if((typeof data)=='string'){
       data=JSON.parse(data) 
     }

     if(data.status){
     }else{
      alert(data.message)
    }
  }
})
});
</script>


<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>

<br><br><br><br><br>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>
