<?php
require_once APPROOT.'/views/includes/user/header.php';
$detail = $data['details'];
// echo "<pre>";
//print_r($data);
// echo "</pre>"; 
?>
<br><br>
<section class = 'lg-form-outer'>
  <div class = 'lg-form-header'>REPAIR ORDER - <?php echo $detail['id']?></div>
  <section class="lg-form" style="text-align:right;">
  <?php
  if (in_array('P0229', USER_PRIV)) {
  ?>
    <button class='btn_blue' onclick="location.href='../user/maintenance/repair-orders/update?eid=<?php echo $_GET['eid']; ?>'">Edit Repair Order</button>
  <?php
  }
  ?>
  </section>
  <form class="lg-form">
    <input type="hidden" name="workordercount" id="workordercount" >
    <section class="section-111">
      <div></div>
      <div>
        <fieldset>
          <legend>Status</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Status</label>
              <select name="status" <?php if (!in_array('P0229', USER_PRIV)) {  echo 'disabled'; } ?> data-default-select="<?php echo $detail['status']?>"></select>
            </div>
            <div class="<?php  if($detail['status']=='RFC' && $detail['rfc_reason'] > 0) {   }else{ echo 'd-none';  }?> " id="rfc_on">
            <div class="field-p">
              <label>Reason</label>
              <select name="reason" <?php   if(!in_array('P0229', USER_PRIV)) {  echo 'disabled'; } ?> data-default-select="<?php echo $detail['rfc_reason']?>"></select>
            </div>
          </div>
          </div>                  
        </fieldset>
      </div>

<script type="text/javascript">

  $('[name="status"],[name="reason"]').on('change', function() {
    if($('[name="status"]').val() == 'RFC'){

        $("#rfc_on").removeClass("d-none");
        
        if($('[name="reason"]').val() > 0){
  
           update_data();
        }
      
    }else{
      
        $('[name="reason"]').prop('selectedIndex',0);
      $("#rfc_on").addClass("d-none");
      
update_data()
 
    }


  })
</script>





      <script type="text/javascript">
        function update_data(){
        //$(document).on('change', '[name="status"]', function() {
          //alert($('[name="workordercount"]').val());
          //lert($('[name="status"]').val());
          show_processing_modal();
          if($('[name="workordercount"]').val() > 0 && ($('[name="status"]').val() == "RESOLVED" || $('[name="status"]').val() == "CLOSED" || $('[name="status"]').val() == "OPEN" 
            || $('[name="status"]').val() == "RFC" || $('[name="status"]').val() == "RESOLVED AND INVOICE PENDING")) {
              if(confirm('Do you want to update status ?')){
                $.ajax({
                  url:window.location.pathname+'/../update-status-action',
                  type:'POST',
                  data:{
                    eid:'<?php echo $detail['eid'] ?>',
                    reason: $('[name="reason"]').val() ? $('[name="reason"]').val() : '0',
                    status:$('[name="status"]').val()

                  },
                  context: '[name="status"]',
                  success:function(data){
                    //console.log(data);
                    if((typeof data)=='string'){
                     data=JSON.parse(data) 
                   }
                   //alert(data.message)
                   if(data.status){
                      alert(data.message);
                      hide_processing_modal();
                   } else {
                    alert(data.message);
                    window.location.reload();
                  }
                }
              })
            } else {
              window.location.reload();
            }
          } else 
          if ($('[name="workordercount"]').val() == 0 && ($('[name="status"]').val() == "OPEN" || $('[name="status"]').val() == "RFC" || $('[name="status"]').val() == "RESOLVED AND INVOICE PENDING")) {
            if(confirm('Do you want to update status ?')){
                $.ajax({
                  url:window.location.pathname+'/../update-status-action',
                  type:'POST',
                  data:{
                    eid:'<?php echo $detail['eid'] ?>',
                    reason: $('[name="reason"]').val() ? $('[name="reason"]').val() : '0',
                    status:$('[name="status"]').val()
                  },
                  context: '[name="status"]',
                  success:function(data){
                    if((typeof data)=='string'){
                     data=JSON.parse(data) 
                   }
                   //alert(data.message)
                   if(data.status){
                      alert(data.message);
                      hide_processing_modal();
                   } else {
                    alert(data.message);
                    window.location.reload();
                  }
                }
              })
            } else {
              window.location.reload();
            }
          } else {
            alert("Work order not exist for this record");
            window.location.reload();
          }
       // })
      }
      </script>
      <div></div>
    </section>
    <section class = 'section-111' style = 'max-width: 1200px'>
      <div>
        <fieldset>
          <legend>Basic Details</legend>
          <div class = 'field-section single-column'>
            <div class = 'field-p'>
              <label>Class</label>
              <div><?php echo $detail['class'] ?></div>
            </div>
            <div class = 'field-p'>
              <label>Vehicle Type</label>
              <div><?php echo $detail['vehicle_type'] ?></div>
            </div>
            <div class = 'field-p'>
              <label>Vehicle ID</label>
              <div><?php echo $detail['vehicle_code'] ?></div>
            </select>
          </div>
          <div class = 'field-p'>
            <label>VIN No</label>
            <div><?php echo $detail['vehicle_vin_number'] ?></div>
          </div>
        </div>
      </fieldset>
    </div>
    <div>
      <fieldset>
        <legend> - - - </legend>
        <div class = 'field-section single-column'>
          <div class = 'field-p'>
            <label>Driver</label>
            <div><?php echo $detail['driver_code']. '   ' . $detail['driver_name'] ?></div>
          </div>
          <div class = 'field-p'>
            <label>Type</label>
            <div><?php echo $detail['type'] ?></div>
          </div>
          <div class = 'field-p'>
            <label>Stage</label>
            <div><?php echo $detail['stage'] ?></div>
          </div>

          <div class = 'field-p'>
            <label>Yard Name</label>
            <div><?php echo $detail['yard_name'] ?></div>
          </div>
          <div class = 'field-p'>
            <label>Vendor Name</label>
            <div><?php echo $detail['vendor_name'] ?></div>
          </div>
          <div class = 'field-p'>
            <label>State</label>
            <div><?php echo $detail['vendor_state_name'] ?></div>
          </div>
          <div class = 'field-p'>
            <label>City</label>
            <div><?php echo $detail['vendor_city_name'] ?></div>
          </div>

          <div class = 'field-p'>
            <label>Start Date Time</label>
            <div><?php echo $detail['start_date'].' &nbsp'.$detail['start_time'] ?></div>
          </div>
        </div>
      </fieldset>
    </div>
    <div>
      <fieldset>
        <legend>Contact Information</legend>
        <div class = 'field-section single-column'>
          <div class = 'field-p'>
            <label>Contact Person</label>
            <div><?php echo $detail['contact_person'] ?></div>
          </div>
          <div class = 'field-p'>
            <label>Contact No</label>
            <div><?php echo $detail['contact_number'] ?></div>
          </div>
        </div>
      </fieldset>
    </div>
    <div>
      <fieldset>
        <legend>Link Reference Doc No</legend>
        <div class = 'field-section single-column'>
          <div class = 'field-p'>
            <label>Reference Type</label>
            <div><?php echo $detail['reference_name'] ?></div>
          </div>
          <div class = 'field-p'>
            <label>Reference ID</label>
            <div><?php echo $detail['reference_id'] ?></div>
          </div>
          <div class = 'field-p'>
            <label>Row ID</label>
            <div><?php echo $detail['reference_rowid'] ?></div>
          </div>
        </div>
      </fieldset>
    </div>
  </section>
</form>
<section class = 'list-200 content-box' style = 'margin: auto;max-width: 1200px'>
  <h1 class = 'list-200-heading'>Issue List</h1>
  <section class = 'list-200-top-section'>
    <div>
    </div>
    <div>
    </div>
  </section>
  <div class = 'table  table-a'>
    <table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Category</th>
          <th>Criticality Level</th>
          <th>Jobs Work</th>
          <th style = 'width: 25%;text-align: left;'>Issue Reported</th>
          <th style = 'width: 25%;text-align: left;'>Issue Description</th>
          <th>Last Work Order</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $counter = 0;
        foreach ( $detail['issue_list'] as $jwl ) {
          /*if($counter < 4 && $detail['id'] == "PM22000189") {
            echo "
            <tr>
            <td>" . ++$counter . "</td>
            <td>" . $jwl['category'] . "</td>
            <td>" . $jwl['criticality_level_id'] . "</td>
            <td>" . $jwl['job_work'] . "</td>
            <td style = 'width: 25%;text-align: left;'>" . $jwl['issue_reported'] . "</td>
            <td style = 'width: 25%;text-align: left;'>" . $jwl['issue_description'] . "</td>
            <td>" . $jwl['work_order_id_fk'] . "</td>
            </tr>";
            if($counter == 3){
              return;
            }
           } else {*/
              echo "
              <tr>
              <td>" . ++$counter . "</td>
              <td>" . $jwl['category'] . "</td>
              <td>" . $jwl['criticality_level_id'] . "</td>
              <td>" . $jwl['job_work'] . "</td>
              <td style = 'width: 25%;text-align: left;'>" . $jwl['issue_reported'] . "</td>
              <td style = 'width: 25%;text-align: left;'>" . $jwl['issue_description'] . "</td>
              <td>" . $jwl['work_order_id_fk'] . "</td>
              </tr>";
            //}
          }
        ?>
      </tbody>
    </table>
  </div>
</section>



<br>
<br>


<style type = 'text/css'>
  .aaf{
    display: flex;
  }
  .add-action {
    width: 80%;
  }
  .aaf-a{
    width: 70%;
  }
  .aaf-b {
    padding-left: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    justify-content: space-between;
  }
  .aaf-b>div {
    width: 100%
  }
  .aaf-b>div input {
    height: 35px
  }
</style>

<?php  if (in_array('P0229', USER_PRIV)) { ?>
<section class = 'list-200 content-box' style = 'margin: auto;max-width: 1200px'>
  <h1 class = 'list-200-heading'>Follow Ups</h1>
  <form method = 'POST' id = 'MyForm' class ='aaf' onsubmit = 'return add_follow_up()'>
    <input type = 'hidden' name = 'repair_order_eid' value = "<?php echo $detail['eid'] ?>">
    <div class="aaf-a">
      <textarea name = 'description' style = 'min-height:100px;width: 100%' placeholder = 'Write description here'></textarea>
    </div>
    <div class = 'aaf-b'>
      <div>
        <label>Next Follow Date &nbsp </label>
        <input type = 'text' name = 'follow_up_next_date' required = 'required' data-date-picker style="width: 100%;">
      </div>
      <div>
        <button class ='form-submit-btn' id= 'submit' style="width: 100%;">Save</button>
      </div>
    </div>
    <div>
    </div>
  </form>
  <br>
  <div class = 'table  table-a' >
    <table data-follow-up-table>
      <thead>
        <tr>
          <th style = 'width: 120px;'>Datetime</th>
          <th style = 'width: 100px;text-align: left;'>Description</th>
          <th style = 'width: 100px;'>Next Follow-Up Date</th>
          <th style = 'width: 200px;'>Added by</th>
        </tr>
      </thead>
      <tbody data-follow-ups-list>
      </tbody>
    </table>
  </div>
 

<script type = 'text/javascript'>
  function show_follow_ups() {
    $.ajax( {
      url:'<?php echo AJAXROOT; ?>/user/maintenance/repair-orders/follow-up-list-ajax',
      type:'POST',
      data: {
        repair_order_eid:'<?php echo $detail['eid']; ?>'
      },
      beforeSend:function(data){
        show_table_data_loading('[data-follow-up-table]')
      },
      success:function( data ) {
        if ( ( typeof data ) == 'string' ) {
          data = JSON.parse( data )
          $( '[data-follow-ups-list]' ).html( '' );
          if ( data.status ) {
            var counter = 0;
            $.each ( data.response.list, function( index, item ) {
              counter++;
              var row = `<tr>
              <td>${item.added_on_datetime}</td>
              <td style ='width: 100px;text-align: left;'>${item.description}</td>
              <td>${item.follow_up_next_date}</td>
              <td>${item.added_by_user_code}-${item.added_by_user_name}</td>
              </tr>`;
              $( '[data-follow-ups-list]' ).append( row );
            }
            )
          } else {
            var false_message = `<tr><td colspan = '4'>`+data.message+`<td></tr>`;
            $( '[data-follow-ups-list]' ).html( false_message );
          }
        }
      }
    }
    )
  }
  show_follow_ups()
</script>

<script type = 'text/javascript'>
  function add_follow_up() {
    show_processing_modal()
    submit_to_wait_btn( '#submit', 'loading' )
    $( '#formErro' ).show()
    var form = document.getElementById( 'MyForm' );
    var isValidForm = form.checkValidity();
    var currentForm = $( '#MyForm' )[0];
    var formData = new FormData( currentForm );
    if ( isValidForm ) {
      var arr = $( '#MyForm' ).serializeArray();
      var obj = {
      }
      for ( var a = 0; a<arr.length; a++ ) {
        obj[arr[a].name] = arr[a].value
      }
      $.ajax( {
        url:'<?php echo AJAXROOT; ?>'+'user/maintenance/repair-orders/add-follow-up-action',
        type:'POST',
        data: obj,
        success:function( data ) {
          if ( ( typeof data ) == 'string' ) {
            data = JSON.parse( data )
          }
          if ( data.status ) {
            $( '#MyForm' )[0].reset()
            show_follow_ups()
            wait_to_submit_btn( '#submit', 'ADD' )
            hide_processing_modal()
          } else {
            alert( data.message );
            wait_to_submit_btn( '#submit', 'ADD' )
            hide_processing_modal()
          }

        }
      }
      )
    }
    return false
  }
</script>
</section>

<br><br>
      <?php
}
        ?>
        <?php  if (in_array('P0233', USER_PRIV)) { ?>
<section class = 'list-200 content-box' style = 'margin: auto;max-width: 1200px'>
  <h1 class = 'list-200-heading'>Work Orders</h1>
    <?php
        if(in_array('P0232', USER_PRIV)){
        echo " <button class='btn_grey button_href' style='float:right;'><a href='../user/maintenance/work-orders/add-new?ro-eid=".$detail['eid']."'>Add New</a></button>";
        }
        ?>
       <section class="list-200-top-action">
         
  </section>
  <div class = 'table  table-a'>
    <table data-work-orders-table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>id</th>
          <th>Date</th>
          <th>Engine Hours</th>
          <th>Odometer</th>
          <th>Vendor</th>
          <th>Vendor City, State</th>
          <th>Amount</th>
          <th>Invoice No.</th>
          <th>Payment Status</th>
          <th>Invoice Document</th>
          <th>Payment Mode</th>
          <th>Payment Ref No.</th>
          <th>Payment Date</th>
          <th>Payment Remarks</th>
          <th>Created By</th>
          <th></th>
        </tr>
      </thead>
      <tbody data-work-orders-list>
      </tbody>
    </table>
  </div>
</section>

<?php  }?>

<script type="text/javascript">
    function show_status_filter(){
     get_repair_order_status().then(function(data) {

      if(data.status){

        if(data.response.list){
          var options="";
          options+=`<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
          })
          $('[name="status"]').html(options);
          select_default('[name="status"]')     
        }
      }
    }).catch(function(err) {

    }) 
  }
  show_status_filter()
</script>


<script type="text/javascript">
    function show_reason_filter(){
     get_repair_order_rfc_error().then(function(data) {

      if(data.status){

        if(data.response.list){
          var options="";
          options+=`<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            if(item.status=='Active'){
            options+=`<option value="`+item.id+`">`+item.name+`</option>`; 
            }              
          })
          $('[name="reason"]').html(options);
          select_default('[name="reason"]')     
        }
      }
    }).catch(function(err) {

    }) 
  }
  show_reason_filter()
</script>

<script type = 'text/javascript'>
  function show_work_orders() {
    $.ajax( {
      url:'<?php echo AJAXROOT; ?>/user/maintenance/work-orders-ajax',
      type:'POST',
      data: {
        repair_order_id:'<?php echo $detail['id']; ?>'
      },
      beforeSend:function(data){
        show_table_data_loading('[data-work-orders-table]')
      },
      success:function( data ) {
        $('[name="workordercount"]').val(0);
        if ( ( typeof data ) == 'string' ) {
          data = JSON.parse( data )
          $( '[data-work-orders-list]' ).html( '' );
          if ( data.status ) {
            var counter = 0;
            $.each ( data.response.list, function( index, item ) {
              var row = `<tr>
              <td>${++counter}</td>
              <td style ='text-align: left;'>${item.id}</td>
              <td>${item.date}</td>


              <td>${item.engine_hours}</td>

              <td>${item.odometer_reading}</td>

              <td>${item.vendor_name}</td>
              <td>${item.vendor_city_name}, ${item.vendor_state_name} </td>
              <td>${item.amount}</td>

              <td>${item.invoice_no}</td>

              <td>${item.payment_status}</td>`
                         if(item.invoice_file!=''){
            row+=`<td><span onclick='open_document("${item.invoice_file}")' class="fa fa-file" title="View Invoice" style="color:  grey;cursor:pointer;"></span></td>`;
          }else{
            row+='<td></td>';
          }

              row+=`<td>${item.payment_mode}</td>

              <td>${item.payment_ref_no}</td>

              <td>${item.payment_date}</td>

              <td>${item.payment_remarks}</td>

              <td>${item.added_by_user_code}<br>
              ${item.added_by_user_name}<br>

              ${item.added_on_datetime}</td>
              <td style="white-space:nowrap"><button title="View" class="btn_grey_c"><a href="../user/maintenance/work-orders/details?eid=${item.eid}"><i class="fa fa-eye"></i></a></button>`

              <?php
              if(in_array('P0234', USER_PRIV))
              {
                ?>
                row+=`<button title="Edit" class="btn_grey_c"><a href="../user/maintenance/work-orders/update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button>`;
                <?php
              }
              if(in_array('P0235', USER_PRIV))
              {
               ?>
               row+=`<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="${item.eid}"><i class="fa fa-trash"></i></button>`;
               <?php
             } ?>


             row+=`</td>
             </tr>`;
             $( '[data-work-orders-list]' ).append(row);
             $('[name="workordercount"]').val(counter);
           }
           )
          } else {
            var false_message = `<tr><td colspan = '19'>`+data.message+`<td></tr>`;
            $( '[data-work-orders-list]' ).html( false_message );
          }
        }
      }
    }
    )
  }
  show_work_orders()
</script>
<br><br>

<section class = 'list-200 content-box' style = 'margin: auto;max-width: 1200px'>
  <h1 class = 'list-200-heading'>Documents List</h1>
  <section class = 'list-200-top-section'>
    <div>
    </div>
    <div>
    </div>
  </section>
  <div class = 'table  table-a'>
    <table data-document-table>
      <thead>
        <tr>
          <th style="width: 10%">Sr. No.</th>
          <th style="width: 30%; text-align: left;">Name</th>
          <th style="width: 40%;text-align: left;">Remarks</th>
          <th style="width: 20%;">Uploaded By</th>
        </tr>
      </thead>
      <tbody data-documents-list></tbody>
      <tfoot>
        <?php if(in_array('P0229', USER_PRIV)){ ?>
       <tr><td colspan="3"></td><td style="padding: 4px;text-align: right;"><button type="button" class="btn_blue" onclick="open_child_window({url:'../user/maintenance/repair-orders/upload-document&eid=<?php echo $detail['eid'] ?>',width:600,height:500})">Add Document</button></td></tr><?php } ?>
     </tfoot>
   </table>
 </div>
</section>

</section>
<br><br>
<div style="text-align:center;"><button type="button" class="btn_green" onclick="window.history.back()">BACK</button></div>
<script type = 'text/javascript'>
  function show_documents() {
    $.ajax( {
      url:'<?php echo AJAXROOT; ?>/user/maintenance/repair-orders/documents-list-ajax',
      type:'POST',
      data: {
        repair_order_eid:'<?php echo $detail['eid']; ?>'
      },
      beforeSend:function(data){
        show_table_data_loading('[data-document-table]')
      },
      success:function( data ) {
        if ( ( typeof data ) == 'string' ) {
          data = JSON.parse( data )
          $( '[data-documents-list]' ).html( '' );
          if ( data.status ) {
            var counter = 0;
            $.each ( data.response.list, function( index, item ) {
              var row = `<tr>
              <td>${++counter}</td>
              <td style ='text-align: left;' class="text-link" onclick="open_document('${item.file_path}')">${item.name}</td>
              <td style ='text-align: left;'>${item.remarks}</td>
              <td>${item.added_by_user_code} - ${item.added_by_user_name} - ${item.added_on_datetime}</td>
              </tr>`;
              $( '[data-documents-list]' ).append( row );
            }
            )
          } else {
            var false_message = `<tr><td colspan = '4'>`+data.message+`<td></tr>`;
            $( '[data-documents-list]' ).html( false_message );
          }
        }
      }
    }
    )
  }
  show_documents()
</script>
<br><br>
<br><br>
<br><br>
<br><br>
</section>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>