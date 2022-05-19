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
<section class="i-boxes shadow-1">
  <h1>Drivers Documents</h1>
  <section class="i-boxes-cover">
    <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0377', USER_PRIV)) ? '../user/masters/drivers/all-drivers-documents':"javascript:void(0)"; ?>">
        <h2>All</h3>
        <h1 data-drivers-documents-total-all><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>  
    <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0377', USER_PRIV)) ? '../user/masters/drivers/all-drivers-documents?is-uploaded=false&is-required=true':"javascript:void(0)"; ?> ">
        <h2>Pending Uploads</h3>
        <h1 data-drivers-documents-total-pending-uploads><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
        <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0377', USER_PRIV)) ? '../user/masters/drivers/all-drivers-documents?verification-status=PENDING':"javascript:void(0)"; ?>">
        <h2>Pending For Verification</h2>
        <h1 data-drivers-documents-total-pending-verification><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
    <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0377', USER_PRIV)) ? '../user/masters/drivers/all-drivers-documents?verification-status=REJECTED':"javascript:void(0)"; ?>">
        <h2>Rejected</h2>
        <h1 data-drivers-documents-total-rejected><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
        <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0377', USER_PRIV)) ? '../user/masters/drivers/all-drivers-documents?expiry-alert=true':"javascript:void(0)"; ?>">
        <h2>Expiry Alerts</h2>
        <h1 data-drivers-documents-total-expiry-alerts><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
        <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0377', USER_PRIV)) ? '../user/masters/drivers/all-drivers-documents?is-expired=true':"javascript:void(0)"; ?>">
        <h2>Expired</h2>
        <h1 data-drivers-documents-total-expired><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
  </section>    
</section>

<script type="text/javascript">
  function get_drivers_document_details(){
    $.ajax({
      url:"<?php echo AJAXROOT; ?>"+'user/safety/dashboard/drivers-documents-quick-totals',
      type:'POST',
      data:{},
      beforeSend:function(){
        $('#tabledata').html('loading data');
      },
      success:function(data){

       if((typeof data)=='string'){
        console.log(data)
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
           //---assign values to i boxes
           $('[data-drivers-documents-total-all]').html(data.response.total)
           $('[data-drivers-documents-total-pending-uploads]').html(data.response.pending_uploads)
           $('[data-drivers-documents-total-pending-verification]').html(data.response.pending_verification)
           $('[data-drivers-documents-total-rejected]').html(data.response.rejected)
           $('[data-drivers-documents-total-expiry-alerts]').html(data.response.expiry_alert)
           $('[data-drivers-documents-total-expired]').html(data.response.expired)
           
           //---assign color codes to i boxes
           if(data.response.expiry_alert>0){
            $('[data-drivers-documents-total-expiry-alerts]').parent().parent().addClass('i-box-alert')
           }
            if(data.response.expired>0){
            $('[data-drivers-documents-total-expired]').parent().parent().addClass('i-box-danger')
           }
        
         }
      }

    }

  })

  }
  get_drivers_document_details()

</script>




<br><br><br>
<section class="i-boxes shadow-1">
  <h1>Trucks Documents</h1>
  <section class="i-boxes-cover">
    <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0378', USER_PRIV)) ? '../user/masters/trucks/all-trucks-documents':"javascript:void(0)"; ?>">
        <h2>All</h3>
        <h1 data-trucks-documents-total-all><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>  
    <div class="i-box" data-my-box> 
      <a href="<?php echo (in_array('P0378', USER_PRIV)) ? '../user/masters/trucks/all-trucks-documents?is_uploaded=false&is_required=true':"javascript:void(0)"; ?>">
        <h2>Pending Uploads</h3>
        <h1 data-trucks-documents-total-pending-uploads><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
        <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0378', USER_PRIV)) ? '../user/masters/trucks/all-trucks-documents?verification-status=PENDING':"javascript:void(0)"; ?>">
        <h2>Pending For Verification</h2>
        <h1 data-trucks-documents-total-pending-verification><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
    <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0378', USER_PRIV)) ? '../user/masters/trucks/all-trucks-documents?verification-status=REJECTED':"javascript:void(0)"; ?>">
        <h2>Rejected</h2>
        <h1 data-trucks-documents-total-rejected><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
        <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0378', USER_PRIV)) ? '../user/masters/trucks/all-trucks-documents?expiry-alert=true':"javascript:void(0)"; ?>">
        <h2>Expiry Alerts</h2>
        <h1 data-trucks-documents-total-expiry-alerts><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
        <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0378', USER_PRIV)) ? '../user/masters/trucks/all-trucks-documents?is-expired=true':"javascript:void(0)"; ?>">
        <h2>Expired</h2>
        <h1 data-trucks-documents-total-expired><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
  </section>    
</section>

<script type="text/javascript">
  function get_trucks_document_details(){
    $.ajax({
      url:"<?php echo AJAXROOT; ?>"+'user/safety/dashboard/trucks-documents-quick-totals',
      type:'POST',
      data:{},
      beforeSend:function(){
        $('#tabledata').html('loading data');
      },
      success:function(data){
       // console.log(data)
       if((typeof data)=='string'){
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
              
           //---assign values to i boxes
           $('[data-trucks-documents-total-all]').html(data.response.total)
           $('[data-trucks-documents-total-pending-uploads]').html(data.response.pending_uploads)
           $('[data-trucks-documents-total-pending-verification]').html(data.response.pending_verification)
           $('[data-trucks-documents-total-rejected]').html(data.response.rejected)
           $('[data-trucks-documents-total-expiry-alerts]').html(data.response.expiry_alert)
           $('[data-trucks-documents-total-expired]').html(data.response.expired)
           
           //---assign color codes to i boxes
           if(data.response.expiry_alert>0){
            $('[data-trucks-documents-total-expiry-alerts]').parent().parent().addClass('i-box-alert')
           }
            if(data.response.expired>0){
            $('[data-trucks-documents-total-expired]').parent().parent().addClass('i-box-danger')
           }

        
         }
      }

    }

  })

  }
  get_trucks_document_details()

</script>





<br><br><br>
<section class="i-boxes shadow-1">
  <h1>Trailers Documents</h1>
  <section class="i-boxes-cover">
    <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0379', USER_PRIV)) ? '../user/masters/trailers/all-trailers-documents':"javascript:void(0)"; ?>">
        <h2>All</h3>
        <h1 data-trailer-documents-total-all><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>  
    <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0379', USER_PRIV)) ? '../user/masters/trailers/all-trailers-documents?is-uploaded=false&is-required=true':"javascript:void(0)"; ?>">
        <h2>Pending Uploads</h3>
        <h1 data-trailer-documents-total-pending-uploads><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
        <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0379', USER_PRIV)) ? '../user/masters/trailers/all-trailers-documents?verification-status=PENDING':"javascript:void(0)"; ?>">
        <h2>Pending For Verification</h2>
        <h1 data-trailer-documents-total-pending-verification><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
    <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0379', USER_PRIV)) ? '../user/masters/trailers/all-trailers-documents?verification-status=REJECTED':"javascript:void(0)"; ?>">
        <h2>Rejected</h2>
        <h1 data-trailer-documents-total-rejected><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
        <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0379', USER_PRIV)) ? '../user/masters/trailers/all-trailers-documents?expiry-alert=true':"javascript:void(0)"; ?>">
        <h2>Expiry Alerts</h2>
        <h1 data-trailer-documents-total-expiry-alerts><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
        <div class="i-box" data-my-box>
      <a href="<?php echo (in_array('P0379', USER_PRIV)) ? '../user/masters/trailers/all-trailers-documents?is-expired=true':"javascript:void(0)"; ?>">
        <h2>Expired</h2>
        <h1 data-trailer-documents-total-expired><i class="fa fa-spinner fa-spin"></i></h1>
      </a>
    </div>
  </section>    
</section>

<script type="text/javascript">
  function get_trailers_document_details(){
    $.ajax({
      url:"<?php echo AJAXROOT; ?>"+'user/safety/dashboard/trailers-documents-quick-totals',
      type:'POST',
      data:{},
      beforeSend:function(){
        $('#tabledata').html('loading data');
      },
      success:function(data){
        console.log(data)
       if((typeof data)=='string'){
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){

           //---assign values to i boxes
           $('[data-trailer-documents-total-all]').html(data.response.total)
           $('[data-trailer-documents-total-pending-uploads]').html(data.response.pending_uploads)
           $('[data-trailer-documents-total-pending-verification]').html(data.response.pending_verification)
           $('[data-trailer-documents-total-rejected]').html(data.response.rejected)
           $('[data-trailer-documents-total-expiry-alerts]').html(data.response.expiry_alert)
           $('[data-trailer-documents-total-expired]').html(data.response.expired)
           
           //---assign color codes to i boxes
           if(data.response.expiry_alert>0){
            $('[data-trailer-documents-total-expiry-alerts]').parent().parent().addClass('i-box-alert')
           }
            if(data.response.expired>0){
            $('[data-trailer-documents-total-expired]').parent().parent().addClass('i-box-danger')
           }
         }
      }
    }
  })
  }
get_trailers_document_details()

</script>












<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>