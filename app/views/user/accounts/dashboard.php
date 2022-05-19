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
  <section class="i-boxes-cover" style="width: 214px;background-color: white;">
      <div class="filter-item">
        <label>Time Period </label>
        <select id="time_period" onchange="set_params('time_period', this.value); get_trips_details();">
        <option value="ALL" >All</option>
        <option value="TODAY">Today</option>
        <option value="YESTERDAY">Yesterday</option>
        <option value="WEEKLY" >Weekly</option>
        </select>
      </div>
  </section>
</section>

<section class="i-boxes shadow-1">
  <h1>Trips</h1>
  <section class="i-boxes-cover">
    <div class="i-box" data-my-box>
    
      <a href="<?php echo (in_array('P0120', USER_PRIV)) ? '../user/accounts/trips':"javascript:void(0)"; ?>"> 
        <h2>All</h2>
        <h1 data-trips-all><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
   
    </div>  
    <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0120', USER_PRIV)) ? 'user/accounts/trips?approval-status=PENDING':"javascript:void(0)"; ?>">
        <h2>Pending Approval</h2>
        <h1 data-trips-pending-approval><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
        <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0120', USER_PRIV)) ? 'user/accounts/trips?approval-status=APPROVED':"javascript:void(0)"; ?>">
        <h2>Approved</h2>
        <h1 data-trips-approved><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
    <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0120', USER_PRIV)) ? 'user/accounts/trips?approval-status=CANCELLED':"javascript:void(0)"; ?>">
        <h2>Cancelled </h2>
        <h1 data-trips-cancelled><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
    <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0120', USER_PRIV)) ? 'user/accounts/trips?approval-status=REJECTED':"javascript:void(0)"; ?>">
        <h2>Rejected </h2>
        <h1 data-trips-rejected><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
  </section>    
</section>
<br><br><br>
<!-- <section class="i-boxes shadow-1">
  <h1>Settlements</h1>
  <section class="i-boxes-cover">
    <div class="i-box" data-my-box>
      <a href="">
        <h2>All</h3>
        <h1 data-trips-all><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>  
    <div class="i-box" data-my-box>
      <a href="">
        <h2>Pending Approval</h3>
        <h1 data-trips-pending-approval><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
        <div class="i-box" data-my-box>
      <a href="">
        <h2>Approved</h2>
        <h1 data-trips-approved><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
  </section>    
</section> -->

<script type="text/javascript">
  var time_period = 'ALL';

  function get_trips_details(){
    
    if(check_url_params('time_period')){
      time_period = check_url_params('time_period');
    }

    $.ajax({
      url:"<?php echo AJAXROOT; ?>"+'user/accounts/trips/quick-totals-ajax',
      type:'POST',
      data: {time_period:time_period},
      beforeSend:function(){
        $('#tabledata').html('loading data');
      },
      success:function(data){
      $('#time_period').val(time_period);
       if((typeof data)=='string'){
       // console.log(data)
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
           //---assign values to i boxes
           $('[data-trips-all]').html(data.response.total)
           $('[data-trips-pending-approval]').html(data.response.waiting_approval)
           $('[data-trips-approved]').html(data.response.approved)    
           $('[data-trips-cancelled]').html(data.response.cancelled)
           $('[data-trips-rejected]').html(data.response.rejected)            
         }
      }
    }
  })
  }
  get_trips_details()
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>