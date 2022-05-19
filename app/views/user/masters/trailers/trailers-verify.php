  <?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details'];
?>
<section class="profile-ms-outer" style="padding: 20px 200px; background-color:#fff;">
  <div class="profile-ms-header">TRAILER ID <?php echo $details['code']; ?><span id="last_update"></span> </div>
 <div class="profile-ms">
    <section class="profile-ms-section-3"  style="background-color:#fff;">

<div></div>
<div>
      <fieldset>
        <legend>Status</legend>
        <div class="field-section">
        <div class="field">
          <label>Status</label>
          <div id="match0"><?php echo $details['status']; ?></div>
        </div>
        </div>                  
      </fieldset>
</div>
<div></div>
     
<div>
      <fieldset>
        <legend>Basic Details 1</legend>
        <div class="field-section">
        <div class="field">
          <label>Trailer ID</label>
          <div id="match1"><?php echo $details['code']; ?></div>
        </div>
        <div class="field">
          <label>Company</label>
          <div id="match2"><?php echo $details['company']; ?></div>
        </div>
        <div class="field">
          <label>Make Year</label>
          <div id="match3"><?php echo $details['make_year']; ?></div>
        </div>
        <div class="field">
          <label>Make</label>
          <div id="match4"><?php echo $details['make']; ?></div>
        </div>
        <div class="field">
          <label>Model</label>
          <div id="match5"><?php echo $details['model']; ?></div>
        </div>

        <div class="field">
          <label>Body Type</label>
          <div id="match6"><?php echo $details['body_type']; ?></div>
        </div>

        <div class="field">
          <label>Reefer Type</label>
          <div id="match7"><?php echo $details['reefer_company']; ?></div>
        </div>


        <div class="field">
          <label>VIN</label>
         <div id="match8"><?php echo $details['vin']; ?></div>
        </div>
        <div class="field">
          <label>Licence tag no.</label>
          <div id="match9"><?php echo $details['licence_tag_no']; ?></div>
        </div>
        <div class="field">
          <label>Licence tag Expiry</label>
          <div id="match10"><?php echo $details['licence_tag_expiry_date']; ?></div>
        </div> 
        <div class="field">
          <label>State</label>
          <div id="match11"><?php echo $details['licence_state']; ?></div>
        </div>        
        </div>                  
      </fieldset>
</div>
<div>
      <fieldset>
        <legend>Insurance details</legend>
        <div class="field-section">
        <div class="field">
          <label>Insurance status</label>
          <div id="match12"><?php echo $details['insurance_status']; ?></div>
        </div>
        <div class="field">
          <label>Insurance carrier</label>
          <div id="match13"><?php echo $details['insurance_company_name']; ?></div>
        </div>        
        <div class="field">
          <label>Insurance start date</label>
          <div id="match14"><?php echo $details['insurance_start_date']; ?></div>
        </div>
        <div class="field">
          <label>Insurance Expiry date</label>
          <div id="match15"><?php echo $details['insurance_expiry_date']; ?></div>
        </div>
        <div class="field">
          <label>P/D value</label>
        <div id="match16"><?php echo $details['pd_value']; ?></div>
        </div>
        <div class="field">
          <label>Loss pay info</label>
          <div id="match17"><?php echo $details['loss_pay_info']; ?></div>
        </div>        
        <div class="field">
          <label>P/D value new</label>
          <div id="match18"><?php echo $details['new_pd_value']; ?></div>
        </div>
        
        </div>                  
      </fieldset>


</div>


<div>
  <fieldset>
    <legend>---</legend>
    <div class="field-section">        
      <div class="field">
        <label>Device type</label>
        <div id="match19"><?php echo $details['device_company_name']; ?></div>
      </div>
      <div class="field">
        <label>Device Sr. no.</label>
        <div id="match20"><?php echo $details['device_serial_no']; ?></div>
      </div>                              
    </div>                  
  </fieldset>

  <fieldset>
    <legend>Lease details</legend>
    <div class="field-section">
      <div class="field">
        <label>Ownership Type</label>
        <div id="match21"><?php echo $details['ownership_type']; ?></div>
      </div>        
      <div class="field">
        <label>Lease Ref no</label>
        <div id="match22"><?php echo $details['lease_ref_no']; ?></div>
      </div>                               
      <div class="field">
        <label>Leasing company</label>
        <div id="match23"><?php echo $details['lease_company']; ?></div>
      </div>        
      <div class="field">
        <label>Leasing expiry</label>
        <div id="match24"><?php echo $details['lease_expiry_date']; ?></div>
      </div>                               
    </div>                  
  </fieldset>

  <fieldset>
    <legend>IOT Devices</legend>
    <div class="field-section">
      <div class="field">
        <label>Engine Hours Update Type</label>
        <div id="match25"><?php echo $details['engine_hours_update_type']; ?></div>
      </div>
                                       
    </div>                  
  </fieldset>

  <?php   if($details['trailer_approval_status']!=''){?>
  <fieldset>
    <legend>Trailers Status </legend>
    <div class="field-section">        
      <div class="field">
        <label>Approval Status</label>
        <div id="match"><?php echo $details['trailer_approval_status']; ?></div>
      </div>

      <?php   if($details['trailer_approval_status']=='REJECTED'){?>
      <div class="field" style="background: #ffd1d1;">
        <label>Reason of Rejection</label>
        <div ><?php echo $details['rejected_reason']; ?></div>
      </div>       
        <div class="field">
        <label>Rejected By</label>
        <div id="match"><?php echo $details['rejected_by_user_code']; ?> (<?php echo $details['rejected_by_user_name']; ?>)</div>
      </div> 
    <div class="field">
        <label>Rejected Time</label>
        <div id="match"><?php echo $details['trailer_rejected_on']; ?></div>
    </div>
     <?php } ?>                              
    </div>                  
  </fieldset>
  <?php } ?>
</div>

<div>

</div>
    </section>
  
<div style="text-align: center;">
  <button class="btn_green" data-action="approve-el">Approve</button> &nbsp
  <button class="btn_red" data-action="want-to-reject">Want to reject ?</button>
</div>
<div data-reject-section style="display: flex;align-items: center;flex-direction: column;"></div>
<br>
<br>
</section>
<br>
<script type="text/javascript">

  $(document).ready(function(){
     $(document).on("click", "[data-action='approve-el']",function(){
        if(confirm('Do you want to approve this ?')){
          var eid=$(this).data("eid");
          $.ajax({
            url:'user/masters/trailers/approve-details-action',
            type:'POST',
            data:{
              trailer_eid:"<?php echo $_GET['eid'] ?>",
               user_email:"<?php echo $details['user_last_edit_email']; ?>"
          },
          context: this,
          success:function(data){
           if((typeof data)=='string'){
             data=JSON.parse(data) 
         }
         
         if(data.status){
             window.history.back()
         }else{
          alert(data.message)
      }
  }
})
      }
  });
 });

</script>



<script type="text/javascript">

    $(document).ready(function(){
       $(document).on("click", "[data-action='want-to-reject']",function(){
          $('[data-reject-section]').html(`<textarea placeholder="Write reason of rejection here" data-reason-of-rejection required style="width: 100%;
            max-width: 500px;margin:10px auto;resize: none;height: 150px"></textarea>
            <section class="action-button-box">
            <button type="submit" data-submit data-action='reject-el'></button>
            <button type="button" class="btn_red" onclick="set_pref(0)">Reject & Back</button> &nbsp &nbsp
            <?php 
             if(in_array('P0025', USER_PRIV)){
              ?>
            <button type="button" class="btn_red" onclick="set_pref(1)">Reject & Edit</button> &nbsp &nbsp
            <?php } ?>
            </section>`)
      });
   });

</script>

<script type="text/javascript">
    var return_to = 0

    function set_pref(val) {
        return_to = val;
        $('[data-submit]').trigger('click');
    }
</script>
<script type="text/javascript">

  $(document).ready(function(){
     $(document).on("click", "[data-action='reject-el']",function(){
        if(confirm('Do you want to reject this ?')){
          $.ajax({
            url:'user/masters/trailers/reject-details-action',
            type:'POST',
            data:{
              trailer_eid:"<?php echo $_GET['eid'] ?>",
              user_email:"<?php echo $details['user_last_edit_email']; ?>",
              reason_of_rejection:$('[data-reason-of-rejection]').val()
          },
          beforeSend:function(){
          show_processing_modal()
          },
       complete:function(){
         hide_processing_modal()
       },

          context: this,
          success:function(data){
           if((typeof data)=='string'){
             data=JSON.parse(data) 
         }
         
         if(data.status){
            if (return_to == 0) {
                window.history.back();
            } else if (return_to == 1) {
                location.href = '../user/masters/trailers/update?call-back-page=user/masters/trailers/&eid=<?php echo $_GET['eid'] ?>&page=verify';
            }
        }else{
          alert(data.message)
      }
  }
})
      }
  });
 });

</script>
<style>  
  td{
    white-space:nowrap;
  }
  .warningrow {
    color: gray;
    font-style: italic;


  }

  .dangerrow {
    color: red; 

  }
  .last_update{
    font-size: 18px;
    padding-top: 10px;


  }
</style>

<script type="text/javascript">
  function show_list(){
    var sort_by = $('#sort_by').val();
    var sort_by_order_type = $('#sort').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var eid = check_url_params('eid');
    var webapi = "pagination";
    $.ajax({
      url:'user/quick-details/quick-history-details-action',
      type:'POST',
      data:{
        page:page_no,
        //sort_by:sort_by,
        batch:batch,
        reference:'TRAILERS',
        eid:eid,
        last_recode:'last_recode',
        webapi:  webapi
      },
      beforeSend:function() {
        show_table_data_loading("[data-my-table]")
        show_processing_modal();
      },
      complete:function(){
        hide_processing_modal();
      },
      success:function(data){

       if((typeof data)=='string'){

         data=JSON.parse(data)

         $('#tabledata').html("");
         if(data.status){


           var count = 0;

           $.each(data.response.list, function(index, item) {  
        

             $('<p class="last_update">Last Update: '+item.last_updated_time+'</p>').appendTo('#last_update');
             $.each( item, function( key, value ) {

               var row1 =  $('#match'+count).html();
               var row2_td = value;
               if(row1!=row2_td){
                $('#match'+count).addClass('dangerrow');
                $('<p class="warningrow">'+row2_td+'</p>').appendTo('#match'+count);

              }

              console.log(key+' |-    '+row2_td+'   '+row1)
              count++;
            });
           })

           set_pagination({
            selector: '[data-pagination]',
            totalPages: data.response.totalPages,
            currentPage: data.response.currentPage,
            batch: data.response.batch
          })


         }else{
          $('#tabledata').html("");
          var row=`<tr><td colspan="30">`+data.message+`</td></tr>`;
          $('#tabledata').append(row);

        }
      }
    }
  })
}
  show_list()


</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>