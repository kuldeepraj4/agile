<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br><br>
<style type="text/css">
  [data-my-box]{
    width: 100px;
    height: 100px;
  }
</style>

<section class="i-boxes shadow-1" style="margin-bottom: 16px;">
  <h1>Filter</h1>
  <section class="i-boxes-cover" style="background-color: white;">
      <div class="filter-item" style="margin: auto!important;">
        <label>Location </label>
        <select data-filter="location_id" onchange="set_params('location_id', this.value),get_item_totals(),get_po_totals() ">
        </select>
      </div>
  </section>
</section>

<section class="i-boxes shadow-1">
  <h1>Items</h1>
  <section class="i-boxes-cover">
    <div class="i-box" data-my-box>
      <a href="../user/inventory/inventory-items">
        <h2>All</h3>
        <h1 data-item-all><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>  
    <div class="i-box" data-my-box>
      <a href="user/inventory/inventory-items">
        <h2>Active</h3>
        <h1 data-item-active><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
        <div class="i-box" data-my-box>
      <a href="user/inventory/inventory-items ">
        <h2>In-Active</h2>
        <h1 data-item-inactive><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>

  </section>    
</section>
<br><br><br>

<section class="i-boxes shadow-1">
  <h1>Purchase Orders</h1>
  <section class="i-boxes-cover">
    <div class="i-box" data-my-box>
      <a href="../user/inventory/purchase-orders">
        <h2>All</h3>
        <h1 data-po-all><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>  
    <div class="i-box" data-my-box>
      <a href="user/inventory/purchase-orders?po_status=Open">
        <h2>Open</h3>
        <h1 data-po-open><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
    <div class="i-box" data-my-box>
      <a href="user/inventory/purchase-orders?po_status=Closed">
        <h2>Closed</h3>
        <h1 data-po-closed><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
    <div class="i-box" data-my-box>
      <a href="user/inventory/purchase-orders?po_status=Pending">
        <h2>Pending</h2>
        <h1 data-po-pending><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
    <div class="i-box" data-my-box>
      <a href="user/inventory/purchase-orders?po_status=Cancelled">
        <h2>Cancelled</h3>
        <h1 data-po-cancelled><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
    <div class="i-box" data-my-box>
      <a href="user/inventory/purchase-orders?po_status=Rejected">
        <h2>Rejected</h2>
        <h1 data-po-rejected><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
   
  </section>    
</section>
<br><br><br>


<script type="text/javascript">

var url_params = get_params();
  
  if (url_params.hasOwnProperty('location_id')) {
      $("[data-filter='location_id']").val(url_params.location_id);
  }

function show_locations() {
        get_product_locations().then(function(data) {
            // Run this when your request was successful
            if (data.status) {

                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="${item.id}">${item.location}</option>`;
                    })
                    $('[data-filter="location_id"]').html(options);
                    if (url_params.hasOwnProperty('location_id')) {
                        $("[data-filter='location_id'] option[value=" + url_params.location_id + "]").prop('selected', true);
                    }
                
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
  }

    show_locations();
  

  function get_item_totals(){
    
    if(check_url_params('location_id')){
      location_id = check_url_params('location_id');
    }
    else {
      location_id = '';
    }
    $.ajax({
      url:"<?php echo AJAXROOT; ?>"+'user/inventory/inventory-items-quick-totals',
      type:'POST',
      data: {location_id: location_id},
      beforeSend:function(){
        $('#tabledata').html('loading data');
      },
      success:function(data){
      // $('#time_period').val(time_period);
      // console.log(data);return;
       if((typeof data)=='string'){
       // console.log(data)
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
           //---assign values to i boxes
           $('[data-item-all]').html(data.response.total_items)
           $('[data-item-active]').html(data.response.active_items)
           $('[data-item-inactive]').html(data.response.inactive_items)            
         }
      }
    }
  })
  }
  get_item_totals()

  function get_po_totals(){
    
    if(check_url_params('location_id')){
      location_id = check_url_params('location_id');
    }
    else {
      location_id = '';
    }

    $.ajax({
      url:"<?php echo AJAXROOT; ?>"+'user/inventory/purchase-orders-quick-totals',
      type:'POST',
      data: {location_id: location_id},
      beforeSend:function(){
        $('#tabledata').html('loading data');
      },
      success:function(data){
      // $('#time_period').val(time_period);
      // console.log(data);return;
       if((typeof data)=='string'){
       // console.log(data)
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
           //---assign values to i boxes
           $('[data-po-all]').html(data.response.po_total)
           $('[data-po-open]').html(data.response.po_open) 
           $('[data-po-pending]').html(data.response.po_pending) 
           $('[data-po-closed]').html(data.response.po_closed) 
           $('[data-po-rejected]').html(data.response.po_rejected) 
           $('[data-po-cancelled]').html(data.response.po_cancelled)           
         }
      }
    }
  })
  }
  get_po_totals()
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>