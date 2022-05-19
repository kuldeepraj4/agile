<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details'];
?>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">DRIVER <?php echo $details['code'].' '.$details['name']; ?>   <span id="last_update"></span></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">
    <section class="section-111">
      <div></div>
      <div>
        <fieldset>
          <legend>Status</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Status</label>
              <div id="match0"><?php echo $details['status']; ?></div>
            </div>
          </div>                  
        </fieldset>
      </div>
      <div></div>
    </section>
    <section class="section-111">     
      <div>
        <fieldset>
          <legend>Personal Details</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Driver ID</label>
              <div id="match1"><?php echo $details['code']; ?></div> 
            </div>
            <div class="field-p">
              <label>Name</label>
              <div id="match2"><?php echo $details['prefix'].' '.$details['name']; ?></div>
            </div>
            <div class="field-p">
              <label>Date of Birth</label>
              <div id="match3"><?php echo $details['dob']; ?></div>
            </div>       
          </div>                  
        </fieldset>
        <fieldset>
          <legend>Contact Information</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Mobile No.</label>
              <div id="match4"><?php echo $details['mobile_number_display']; ?></div>
            </div>

            <div class="field-p">
              <label>Email iD</label>
              <div id="match5"><?php echo $details['email']; ?></div>
            </div>

          </div>                  
        </fieldset>

        <fieldset>
          <legend>Present Address</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Address Line</label>
              <div id="match6"><?php echo $details['address_line']; ?></div>
            </div>        
            <div class="field-p">
              <label>State</label>
              <div id="match7"><?php echo $details['address_state_name']; ?></div>
            </div>
            <div class="field-p">
              <label>City</label>
              <div id="match8"><?php echo $details['address_city_name']; ?></div>
            </div>
            <div class="field-p">
              <label>ZIP Code</label>
              <div id="match9"><?php echo $details['address_zipcode_name']; ?></div>
            </div>                              
          </div>                  
        </fieldset>
      </div>
      <div>
        <fieldset>
          <legend>------</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Company Name</label>
              <div id="match10"><?php echo $details['company']; ?></div>
            </div>
            <div class="field-p">
              <label>Joining Date</label>
              <div id="match11"><?php echo $details['date_of_joining']; ?></div>
            </div>
            <div class="field-p">
              <label>Route Type</label>
              <div id="match12"><?php echo $details['route_type']; ?></div>
            </div>        
            <div class="field-p">
              <label>CDL No.</label>
              <div id="match13"><?php echo $details['cdl_number']; ?></div>
            </div>                               
            <div class="field-p">
              <label>CDL State</label>
              <div id="match14"><?php echo $details['cdl_state']; ?></div>
            </div>                               
            <div class="field-p">
              <label>CDL Issue Date</label>
              <div id="match15"><?php echo $details['cdl_issue_date']; ?></div>
            </div>        
            <div class="field-p">
              <label>CDL Expiry Date</label>
              <div id="match16"><?php echo $details['cdl_expiry_date']; ?></div>
            </div>
            <div class="field-p">
              <label>SSN No.</label>
              <div id="match17"><?php echo $details['ssn_number']; ?></div>
            </div>
            <div class="field-p">
              <label>Residency</label>
              <div id="match18"><?php echo $details['residency_type']; ?></div>
            </div>
            <div class="field-p">
              <label>Residency Expiry Date</label>
              <div id="match19"><?php echo $details['residency_expiry_date']; ?></div>
            </div>
            <div class="field-p">
              <label>Medical Issue Date</label>
              <div id="match20"><?php echo $details['medical_issue_date']; ?></div>
            </div>        
            <div class="field-p">
              <label>Medical Expiry Date</label>
              <div id="match21"><?php echo $details['medical_expiry_date']; ?></div>
            </div>
            <div class="field-p">
              <label>GFR</label>
              <div id="match22"><?php echo $details['gfr']; ?></div>
            </div>
            <div class="field-p">
              <label>EPN Enroll</label>
              <div id="match23"><?php echo $details['epn_enroll_status']; ?></div>
            </div>

          </div>                  
        </fieldset>
      </div>

      <div>
        <fieldset>
          <legend>Followups / Technical Details</legend>
          <div class="field-section">        
            <div class="field-p">
              <label>Last Annual Review Date</label>
              <div id="match24"><?php echo $details['last_annual_review_date']; ?></div>
            </div>
            <div class="field-p">
              <label>Next Annual Review Date</label>
              <div id="match25"><?php echo $details['next_annual_review_date']; ?></div>
            </div>       
            <div class="field-p">
              <label>Truck Assigned</label>
              <div id="match26"><?php echo $details['truck_code']; ?></div>
            </div> 
            <div class="field-p">
              <label>Insurance Added</label>
              <div id="match27"><?php echo $details['insurance_added_status']; ?></div>
            </div>
            <div class="field-p">
              <label>Group</label>
              <div id="match28"><?php echo $details['group']; ?></div>
            </div>
            <div class="field-p">
              <label>Driver Type</label>
              <div id="match28"><?php echo $details['driver_type_name']; ?></div>
            </div>                                
          </div>                  
        </fieldset>

        <?php   if($details['driver_approval_status']!=''){?>
          <fieldset>
            <legend>Driver Details Status </legend>
            <div class="field-section">        
              <div class="field-p">
                <label>Approval Status</label>
                <div ><?php echo $details['driver_approval_status']; ?></div>
              </div>

              <?php   if($details['driver_approval_status']=='REJECTED'){?>
                <div class="field-p" style="background: #ffd1d1;">
                  <label>Reason of Rejection</label>
                  <div ><?php echo $details['rejected_reason']; ?></div>
                </div>       
                <div class="field-p">
                  <label>Rejected By</label>
                  <div><?php echo $details['rejected_by_user_code']; ?> (<?php echo $details['rejected_by_user_name']; ?>)</div>
                </div> 
                <div class="field-p">
                  <label>Rejected Time</label>
                  <div><?php echo $details['driver_rejected_on']; ?></div>
                </div>
              <?php } ?>                              
            </div>                  
          </fieldset>
        <?php } ?>
      </div>

    </section>




  </form>
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
        url:'user/masters/drivers/approve-details-action',
        type:'POST',
        data:{
          driver_eid:"<?php echo $_GET['eid'] ?>",
          user_email:"<?php echo $details['user_last_edit_email'] ?>"
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
      if(in_array('P0010', USER_PRIV)){
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
        url:'user/masters/drivers/reject-details-action',
        type:'POST',
        data:{
          driver_eid:"<?php echo $_GET['eid'] ?>",
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
            location.href = '../user/masters/drivers/update?call-back-page=user/masters/drivers/&eid=<?php echo $_GET['eid'] ?>&page=verify';
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
        reference:'DRIVERS',
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