<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];
// echo "<pre>";
// print_r($details);
// echo "</pre>"; 
?>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">Work Order Details <?php echo $details['id']; ?></div>
  <section class="lg-form" style="text-align:right;">
  <?php
  if (in_array('P0234', USER_PRIV)) {
  ?>
    <button class='btn_blue' onclick="location.href='../user/maintenance/work-orders/update?eid=<?php echo $_GET['eid']; ?>'">Edit Work Order</button>
  <?php
  }
  ?>
  </section>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-111">
    </section>
    <section class="section-111" style="max-width: 1200px">
      <div>
        <fieldset>
          <legend>Work Order Details</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>ID</label> 
              <div><?php echo $details['repair_order_id']; ?></div>
            </div>
            <div class="field-p">
              <label>Unit</label>
              <div><?php echo $details['vehicle_type']; ?></div>
            </div>
            <div class="field-p">
              <label>Unit ID</label>
              <div><?php echo $details['vehicle_code']; ?></div>
            </div>
            <div class="field-p">
              <label>VIN No</label>
              <div><?php echo $details['vehicle_vin_number']; ?></div>
            </div>
            <div class="field-p">
              <label>Date</label>
              <div><?php echo $details['date']; ?></div>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend>Other Information</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Odometer Reading</label>
              <div><?php echo $details['odometer_reading']; ?></div>
            </div>
            <div class="field-p">
              <label>Engine Hours</label>
              <div><?php echo $details['engine_hours']; ?></div>
            </div>
            <div class="field-p">
              <label>Technician Comments</label>
              <div><?php echo $details['technician_comments']; ?></div>
            </div>
          </div>
        </fieldset>
      </div>
      <div>
        <fieldset>
          <legend> Repair and Vendor Details </legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Yard Name</label>
              <div><?php echo $details['yard_name']; ?></div>
            </div>
            <div class="field-p">
              <label>Vendor Name</label>
              <div><?php echo $details['vendor_name']; ?></div>
            </div>
            <div class="field-p">
              <label>Vendor State</label>
              <div><?php echo $details['vendor_state_name']; ?></div>
            </div>
            <div class="field-p">
              <label>Vendor City</label>
              <div><?php echo $details['vendor_city_name']; ?></div>
            </div>
            <div class="field-p">
              <label>Contact Person</label>
              <div><?php echo $details['vendor_contact_person']; ?></div>
            </div>
            <div class="field-p">
              <label>Contact No</label>
              <div><?php echo $details['vendor_contact_number']; ?></div>
            </div>
            <div class="field-p">
              <label>Email ID</label>
              <div><?php echo $details['vendor_email']; ?></div>
            </div>
          </div>
        </fieldset>
      </div>
      <div>
        <fieldset>
          <legend> Billing Details </legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Payment Status</label>
              <div><?php echo $details['payment_status']; ?></div>
            </div>
            <div class="field-p">
              <label>Payment Mode</label>
              <div><?php echo $details['payment_mode']; ?></div>
            </div>
            <div class="field-p">
              <label>Payment Ref No</label>
              <div><?php echo $details['payment_ref_no']; ?></div>
            </div>
            <div class="field-p">
              <label>Invoice No</label>
              <div><?php echo $details['invoice_no']; ?></div>
            </div>
            <div class="field-p">
              <label>Date Paid</label>
              <div><?php echo ($details['payment_status'] == 'PAID') ? $details['payment_date']: ''; ?></div>
            </div>
            <div class="field-p">
              <label>Payment Remarks</label>
              <div><?php echo $details['payment_remarks']; ?></div>
            </div>
            <div class="field-p">
              <label>Invoice File</label>
              <div>
                <?php
                if($details['invoice_file']!=""){
                  ?>
                  <span onclick='open_document("<?php echo $details['invoice_file']; ?>")' class="fa fa-file" title="View Invoice" style="color:  grey;cursor:pointer;"></span>
                  <?php
                }
                if(in_array('P0234', USER_PRIV)){ 
                ?>
                &nbsp &nbsp
                <span onclick="open_child_window({url:'../user/maintenance/work-orders/update-invoice&eid=<?php echo $details['eid'] ?>',width:600,height:500})" class="fa fa-pen" title="Update Invoice" style="color:  grey;cursor:pointer;">
                  
                </span>
              <?php }?>
                </div>
            </div> 
          </div>
        </fieldset>
        <fieldset>
          <legend> Approval Status</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Approval Status</label>
              <div><?php  echo $details['approval_status'] ?></div>
            </div>
        
            <div class="field-p">
              <label>Remarks</label>
              <div><?php  echo $details['approval_remarks'] ?></div>
            </div>
            
          <div class="field-p">
              <label>WO Remarks</label>
              <div><?php  echo $details['remarks'] ?></div>
          </div>
          </div>
        </fieldset>
      </div>

    </section>
    <section class="list-200 content-box" style="margin: auto;max-width: 1400px">
      <h1 class="list-200-heading">Job Work List</h1>
      <section class="list-200-top-section">
        <div>
        </div>
        <div>
        </div>
      </section>
      <div class="table  table-a">
        <table>
          <thead>
            <tr>
              <th>Sr. No.</th>
              <th style='text-align:left'>Type</th>
              <th style='text-align:left'>Job Work</th>
              <th style='text-align:left'>Description</th>
              <th>No Charge</th>
              <th>Warranty</th>
              <th>Warranty Period</th>
              <th>Quantity</th>
              <th>Rate</th>
              <th>Amount</th>
              
            </tr>
          </thead>
          <tbody id="tabledata">
          
            
          <?php 
    $counter=0;
    foreach($details['job_works_list'] as $jwl){
$no_charge=($jwl['is_no_charge'])?'YES':'';
      echo "
<tr>
<td>".++$counter."</td>
<td style='text-align:left'>".$jwl['job_work_type_name']."</td>
<td style='text-align:left'>".$jwl['job_work']."</td>
<td style='text-align:left'>".$jwl['description']."</td>
<td>".$no_charge."</td>
<td>".$jwl['warranty_type']."</td>
<td>".$jwl['warranty_period']."</td>
<td>".$jwl['quantity']."</td>
<td>".$jwl['rate']."</td>
<td>".$jwl['amount']."</td>
</tr>";
    }
    
    echo "
      <tr>
      <td colspan='10' style='text-align: right;padding-right: 3%;'>Total: ".$details['amount']."</td>
      </tr>";

    ?>          
          </tbody>
        </table>
      </div>

    </section>
    <br><br><br><br><br>
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
              <?php if(in_array('P0234', USER_PRIV)){ ?>
             <tr><td colspan="3"></td><td style="padding: 4px;text-align: right;"><button type="button" class="btn_blue" onclick="open_child_window({url:'../user/maintenance/work-orders/upload-document&eid=<?php echo $details['eid'] ?>',width:600,height:500})">Add Document</button></td></tr>
           <?php } ?>
           </tfoot>
      </table>
    </div>
  </section>
  <br><br>
</section>

<div style="text-align:center;">
  <?php if(in_array('P0228', USER_PRIV)){ ?>
  <button type="button" class="btn_green" onclick="window.location.href='../user/maintenance/repair-orders/details?eid=<?php echo $details['repair_order_eid'] ?>'">Go to RO Detail</button> 
<?php } ?>

   <button type="button" class="btn_green" onclick="back_alret()">BACK</button></div>

 
  <script type = 'text/javascript'>
    
    function show_documents() {
      $.ajax( {
        url:'<?php echo AJAXROOT; ?>/user/maintenance/work-orders/documents-list-ajax',
        type:'POST',
        data: {
          work_order_eid:'<?php echo $details['eid']; ?>'
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
                <td>${item.added_by_user_code} - ${item.added_on_datetime}</td>
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


  
  <script type = 'text/javascript'>
   function back_alret(){
    if(confirm('Are you Sure ?')){
        window.history.back();
    }
}
 </script>
  <br><br><br>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>