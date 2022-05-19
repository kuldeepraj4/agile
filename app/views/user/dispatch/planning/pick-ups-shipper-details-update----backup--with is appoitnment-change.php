<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
$dtl=$data['details'];
echo "<pre>";
print_r($dtl);
echo "</pre>"
?>
<style type="text/css">
  .dtfv{
    box-shadow: 0 0 10px -1px darkgrey;
    background: white;
    
    text-align: center;
    padding:10px;
    display: block;
    border-radius: 12px;
  }
  .dtfv-heading{
    margin-bottom: 10px;
    font-size: 2em;
    color: var(--theme-color-four);
  }
  .dtfv>section{
    border:1px solid lightgrey;
    border-radius: 8px;
    overflow: hidden;
    margin: 25px auto;
  }
  .dtfv .dtfv-sec-head{
    display: flex;
    justify-content: space-between;
    padding:5px 10px;
    background: #486e94;
    border-bottom: 1px solid lightgrey;
  }
  .dtfv .dtfv-sec-heading{
    font-weight: bold;
    font-size: 1.1em;
    color: white;
  }
  .dtfv-sec-heading.angle_down::after{
    color: grey;
    font-family: "Font Awesome 5 Free"; 
    font-weight: 900;
    content: "\f107";
    font-size: 1.2em;
  }
  .dtfv .dtfv-sec-head a{
    color: white;
  }
  .dtfv .dtfv-dtl{
  }
  .dtfv .dtfv-dtl-double{
    display: flex;
  }
  .dtfv .dtfv-dtl-double>div{
    padding: 10px;
    width: 50%;
  }
  .dtfv .dtfv-dtl-double>div:first-child{
    border-right: 1px solid #f2f2f2;
  }
  .dtfv .dtfv-dtl-double>div>ul{
    max-width: 550px;
    margin: auto;
  }
  .dtfv .dtfv-dtl-double>div>ul>li{
    display: flex;
    margin-bottom: 6px;
  }
  .dtfv .dtfv-dtl-double>div>ul>li>label{
    width: 35%;
    text-align: left;
  }
  .dtfv .dtfv-dtl-double>div>ul>li>select,
  .dtfv .dtfv-dtl-double>div>ul>li>input,
  .dtfv .dtfv-dtl-double>div>ul>li>div
  {
    width: 60%;
    flex-grow: 1;
  }
  .dtfv-dtl-action-bar{
    padding: 10px;
  }

  .dtfv-dtl-table>table{
    border:1px solid darkgrey;
    border-collapse: collapse;
    background: white;
    overflow: auto;
    box-sizing: border-box;
    width: 95%;
    margin:8px auto;
  }
  .dtfv-dtl-table>table>thead{
    background: #f2f2f2;
    color: black;
  }

  .dtfv-dtl-table .bg-grey{
    background: grey;
    color: white;
  }
  .dtfv-dtl-table>table>thead>tr{
    border-bottom:1px solid darkgrey;
  }
  .dtfv-dtl-table>table>thead>tr>th{
    padding:8px 12px;
    font-weight: normal;
    border: 1px solid grey;
  }
  .dtfv-dtl-table>table>thead>tr>th.bg-grey{
    background: lightgrey;
    color: black;
    font-weight: bold;

  }
  .dtfv-dtl-table>table>tbody>tr>td{
    padding: 8px 12px;

  }
  .dtfv-dtl-table>table>tbody>tr{
    border-bottom: 1px solid #f0f0f0
  }
  .dtfv-dtl-table>table>tbody>tr:last-child{
    border-bottom: none;
  }
  .dtfv-dtl-table>table>thead>tr>td{
    text-align: center;
  }
  .dtfv-dtl-table>table>tbody>tr>td{
    text-align: center;
  }

</style>
<br><br>
<section class="dtfv content-box" style="margin: auto;max-width: 1100px">
  <h1 class="dtfv-heading">Update Dispatch Shipper Info</h1>


  <section>
    <div class="dtfv-sec-head show" data-hide-show-details>
      <div class="dtfv-sec-heading"> <span style="font-weight: normal;font-style: italic;font-size: .8em;">Shipper Information</span></div>
      <div>

      </div>
    </div>

    <form method="POST" id="MyForm" onsubmit="return save_shipper_details()" class="dtfv-dtl">
      <input type="hidden" name="stop_eid" value="<?php echo $dtl['stop_eid'] ?>">
      <div class="dtfv-dtl-double">
        <div>
          <ul >
            <li>
              <label>Address </label>
              <div style="text-align:left;"><?php echo $dtl['location_full_address'] ?></div>
            </li>
            <li>
              <label>Shipper Confirmation </label>
              <select name="ship_confirmation_status" data-default-select="<?php echo $dtl['ship_confirmation_status']; ?>">
                <option value=""> - - Select - -</option>
                <option value="PENDING">Pending</option>
                <option value="CONFIRMED">Confirmed</option>
              </select>
            </li>              
            <li>
              <label>Is Appointment change ?</label>
              <div style="text-align:left;"><input type="checkbox" name="is_appointment_change" <?php echo ($dtl['is_appointment_change']=='YES')?'checked':'' ?>></div>
            </li>
            <li>
              <label>Appointment Type</label>
              <select name="appointment_type" data-default-select="<?php echo $dtl['appointment_type']; ?>" <?php echo ($dtl['is_appointment_change']=='NO')?'disabled':'' ?>>
                <option value=""> - - Select - -</option>
                <option value="FCFS">FCFS</option>
                <option value="FIRM">FIRM</option>
              </select>
            </li>              
            <li>
              <label>Date</label>
              <input type="text" value="<?php echo $dtl['appointment_date'] ?>" name="appointment_date" data-date-picker <?php echo ($dtl['is_appointment_change']=='YES')?'disabled':'' ?> <?php echo ($dtl['is_appointment_change']=='NO')?'disabled':'' ?>>
            </li>
            <li>
              <label>Time</label>
              <div style="text-align:left;">
                <input type="text" value="<?php echo $dtl['appointment_time_from'] ?>" name="appointment_time_from" data-time-picker style="width:40%" <?php echo ($dtl['is_appointment_change']=='NO')?'disabled':'' ?>>
                <input type="text" value="<?php echo $dtl['appointment_time_to'] ?>" name="appointment_time_to" data-time-picker style="width:40%" <?php echo ($dtl['is_appointment_change']=='NO')?'disabled':'' ?>></div>
            </li>                            
          </ul>
        </div>
        <div>
          <ul >
            <li>
              <label>Contact Person</label>
              <input type="text" value="<?php echo $dtl['ship_contact_person'] ?>" name="ship_contact_person">
            </li>
            <li>
              <label>Contact Number</label>
              <input type="text" value="<?php echo $dtl['ship_contact_number'] ?>" name="ship_contact_number">
            </li>
            <li>
              <label>Remarks</label>
              <div><textarea style="height: 70px; width: 100%;" name="ship_remarks"><?php echo $dtl['ship_remarks'] ?></textarea></div>
            </li>                                          
          </ul>
        </div>
      </div>

      <div class="dtfv-dtl-table" style="width:100%;max-width: 700px;margin: auto;">
        <table>
          <thead>
            <tr>
              <th rowspan="2">#</th>
              <th rowspan="2">Ref No</th>
              <th colspan="2" class="bg-grey">As Per ROC</th>
              <th colspan="2" class="bg-grey">As Per Shipper</th>
            </tr>
            <tr>
              <th>Pallet</th>
              <th>Case</th>
              <th>Pallet</th>
              <th>Case</th>                
            </tr>
          </thead>
          <tbody>

            <?php foreach ($dtl['quantity_roc'] AS $qty) {
              ?>
              <tr data-quantity-details-row>
                <td style="min-width:150px"><?php echo $qty['pd_number'] ?></td>
                <td style="min-width:150px"><?php echo $qty['reference_number'] ?></td>
                <td style="min-width:70"><?php echo $qty['pallet_count_roc'] ?></td>
                <td style="min-width:70"><?php echo $qty['case_count_roc'] ?></td>
                <td>
                  <input type="hidden" name="quantity_row_id" value="<?php echo $qty['id'] ?>">
                  <input type="text" name="pallet_count_ship" style="width:80px" value="<?php echo $qty['pallet_count_ship'] ?>"></td>
                  <td><input type="text" name="case_count_ship" style="width:80px" value="<?php echo $qty['case_count_ship'] ?>"></td>
                </tr>
                <?php
              } ?>


            </tbody>
          </table>
        </div>





        <div class="dtfv-dtl-action-bar">
          <button class="btn_green">Save</button>
        </div>
      </form>
    </section>


  </section>

<script type="text/javascript">
  //-------- add/remove required attribute based on TBD check box 

  $(document.body).on('change', '[name="is_appointment_change"]', function() {
    if ($(this).prop("checked") == true) {
      $('[name="appointment_type"], [name="appointment_date"], [name="appointment_time_from"], [name="appointment_time_to"]').prop('disabled',false);
      $('[name="appointment_date"]').datepicker();
    } else {
      $('[name="appointment_type"], [name="appointment_date"], [name="appointment_time_from"], [name="appointment_time_to"]').prop('disabled',true);
    }
  });
  //--------/ add/remove required attribute based on TBD check box 
</script>


  <script type="text/javascript">

    function save_shipper_details(){
      show_processing_modal()
      submit_to_wait_btn('#submit','loading')
      $('#formErro').show()
      var form = document.getElementById('MyForm');
      var isValidForm = form.checkValidity();
      var currentForm = $('#MyForm')[0];
      if(isValidForm){
        quantity_details_ship=[]
        $('[data-quantity-details-row]').each(function(ind) {

          pd_row=($(this));
          quantity_details_ship.push({
            quantity_row_id:pd_row.find('[name="quantity_row_id"]').val(),
            case_count_ship:pd_row.find('[name="case_count_ship"]').val(),
            pallet_count_ship:pd_row.find('[name="pallet_count_ship"]').val(),
          });
        })
        var obj={

         stop_eid:$('[name="stop_eid"]').val(),
         ship_confirmation_status:$('[name="ship_confirmation_status"]').val(),
         is_appointment_change:$('[name="is_appointment_change"]').val(),
         appointment_type:$('[name="appointment_type"]').val(),
         appointment_date:$('[name="appointment_date"]').val(),
         appointment_time_from:$('[name="appointment_time_from"]').val(),
         appointment_time_to:$('[name="appointment_time_to"]').val(),
         is_appointment_change:($("[name=is_appointment_change]").prop("checked") == true)?'YES':'NO',
         ship_contact_person:$('[name="ship_contact_person"]').val(),
         ship_contact_number:$('[name="ship_contact_number"]').val(),
         ship_remarks:$('[name="ship_remarks"]').val(),
         stop_eid:$('[name="stop_eid"]').val(),
         quantity_details_ship:quantity_details_ship
       }
       $.ajax({
        url:'../user/dispatch/pick-ups/shipper-details-update-action',
        type:'POST',
        data: obj,
        success:function(data){
          if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         alert(data.message)
         if(data.status){
          window.opener.show_list()
          window.location.reload()
          window.close();
        }
        
        hide_processing_modal()
      }
    })
     }
     return false
   }
 </script>
 <script type="text/javascript">
  $('[data-hide-show-details]').each(function() {

    if($(this).hasClass('hide')){
      $(this).siblings('.dtfv-dtl').slideUp(1);
    }
  })
 // $(document.body).on('change', '[name="customer_id_search"]' ,function(){
  $(document.body).on('click','[data-hide-show-details]',function(){
    if($(this).hasClass('hide')){
      $(this).siblings('.dtfv-dtl').slideDown('fast')
      $(this).find('[data-up-down-button]').removeClass('angle_down')
      $(this).find('[data-up-down-button]').addClass('angle_up')
      $(this).removeClass('hide')  
    }else{
     $(this).siblings('.dtfv-dtl').slideUp('fast')
     $(this).find('[data-up-down-button]').removeClass('angle_up')
     $(this).find('[data-up-down-button]').addClass('angle_down')

     $(this).addClass('hide')
   }

 })
</script>


<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>