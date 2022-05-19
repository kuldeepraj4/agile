<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
$details=$data['details'];
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
  <h1 class="dtfv-heading">Update <?php echo $details['category'] ?> Information</h1>


    <section>
      <div class="dtfv-sec-head show" data-hide-show-details>
        <div class="dtfv-sec-heading"> <span style="font-weight: normal;font-style: italic;font-size: .8em;"><?php echo $details['category'] ?> Information</span></div>
        <div>
          
        </div>
      </div>

      <form method="POST" id="MyForm" onsubmit="return save()" class="dtfv-dtl">
        <input type="hidden" name="update_eid" value="<?php echo $details['eid'] ?>">
        <div class="dtfv-dtl-double">
          <div>
            <ul >
              <li>
                <label>Search</label>
                <input type="text" list="quick_list_addresses" value="<?php echo $details['address_id'].' '.$details['address_name'] ?>" name="addresses_id_search" data-selected-address-id="<?php echo $details['address_id'] ?>" required>
              </li>              
              <li>
                <label>Company</label>
                <input type="text" name="company" value="<?php echo $details['address_name'] ?>" disabled>
              </li>
              <li>
                <label>Address Line</label>
                <input type="text" name="address_line" value="<?php echo $details['address_line'] ?>" disabled>
              </li>              
              <li>
                <label>State</label>
                <input type="text" name="state" value="<?php echo $details['address_state'] ?>" disabled>
              </li>
              <li>
                <label>City</label>
                <input type="text" name="city" value="<?php echo $details['address_city'] ?>" disabled>
              </li>

              <li>
                <label>Zip Code</label>
                <input type="text" name="zipcode" value="<?php echo $details['address_zipcode'] ?>" disabled>
              </li>                                           
            </ul>
          </div>
          <div>
            <ul >



              <li>
                <label>Stop Type</label>
                <select class="w-100" name="stop_type" data-default-select="<?php echo $details['type']  ?>" disabled>
                  <option value="">- Select -</option>
                  <option value="DROP">DROP</option>
                  <option value="PICK">PICK</option>
                </select>
              </li>

              <li>
                <label>Appointment Type</label>
                <select class="w-100" name="appointment_type" data-default-select="<?php echo $details['appointment_type']  ?>" >
                  <option value="">- Select -</option>
                  <option value="FCFS">FCFS</option>
                  <option value="FIRM">FIRM</option>
                </select>
              </li>
              <li>
                <label>Date</label>
                <input class="w-100" value="<?php echo $details['date']  ?>" type="text" name="date" data-date-picker="">
              </li>
              <li>
                <label>Time</label>
                
                <div style="text-align:left;">
                  <input data-time-picker style="width:100px" type="text" name="time_from"

                  <?php if ($details['datetime_tbd']=="YES") {
                    echo 'disabled';
                  }else{
                    echo " value='".$details['time_from']."'"; 
                  } ?>
                  >
                <input data-time-picker style="width:100px" type="text" name="time_to"
                  <?php if ($details['datetime_tbd']=="YES") {
                    echo 'disabled';
                  }else{
                    echo " value='".$details['time_to']."'"; 
                  } ?>
                >
                 <input  type="checkbox" name="datetime_tbd" title="TBD"
                  <?php if ($details['datetime_tbd']=="YES") {
                    echo 'checked';
                  } ?>
                > TBD
                </div>
              </li>
              <li>
                <label>Special Instructions/Directions</label>
                <div>
                  <textarea style="width: 100%;height:80px !important" name="special_instructions"><?php echo $details['special_instructions'] ?></textarea>
                </div>
              </li>                                          
            </ul>
          </div>
        </div>

        <div class="dtfv-dtl-table" style="width:100%;max-width: 700px;margin: auto;">
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Ref No</th>
                <th>Pallet</th>
                <th>Case</th>
                <th></th>                
              </tr>
            </thead>
            <tbody>

              <?php 
              $qty_counter=0;
               foreach ($details['quantity_details'] AS $qty) {
                ?>
                <tr data-quantity-details-row>
                  <td >
                    <input type="hidden" value="<?php echo $qty['id'] ?>" name="quantity_row_id">
                    <input style="min-width:150px;width: 100%;" type="text" name="pd_number"  value="<?php echo $qty['pd_number'] ?>"></td>
                  <td ><input style="min-width:150px;width: 100%;" type="text" name="reference_number" value="<?php echo $qty['reference_number'] ?>"></td>
                  <td><input style="min-width:150;width: 100%;" type="text" name="pallet_count" value="<?php echo $qty['pallet_count_roc'] ?>"></td>
                  <td><input style="min-width:150;width: 100%;" type="text" name="case_count"  value="<?php echo $qty['case_count_roc'] ?>"></td>
                  <td><?php
                    if($qty_counter>0){
                      ?>
                      <button type="button" class="btn_red_c" data-remove-stop-button><i class="fa fa-trash"></i></button>
                      <?php
                    }
                  ?></td>
                  </tr>
                  <?php
                   $qty_counter++;
                } 
               
                ?>


              </tbody>
              <tfoot>
                    <tr>
                      <td colspan="4" style="padding:8px;text-align:right;"><button type="button" data-action="add-quantity-row" class="btn_blue">Add</button></td>
                    </tr></tfoot>
            </table>
          </div>





          <div class="dtfv-dtl-action-bar">
            <button class="btn_green">Save</button>
          </div>
        </form>
      </section>


  </section>
 <script type="text/javascript">

  function save(){
    
    show_processing_modal()
    submit_to_wait_btn('#submit','loading')
    $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    if(isValidForm){
quantity_details=[]
 
        $('[data-quantity-details-row]').each(function(ind) {

          pd_row=($(this));
          quantity_details.push({
            quantity_row_id:pd_row.find('[name="quantity_row_id"]').val(),
            pd_number:pd_row.find('[name="pd_number"]').val(),
            reference_number:pd_row.find('[name="reference_number"]').val(),
            case_count:pd_row.find('[name="case_count"]').val(),
            pallet_count:pd_row.find('[name="pallet_count"]').val(),
          });
        })
         
      var obj={

       stop_eid:$('[name="update_eid"]').val(),
       address_id:$('[name="addresses_id_search"]').data('selected-address-id'),
       appointment_type:$('[name="appointment_type"]').val(),
       date:$('[name="date"]').val(),
       time_from:$('[name="time_from"]').val(),
       time_to:$('[name="time_to"]').val(),
       datetime_tbd:($("[name=datetime_tbd]").prop("checked") == true)?'YES':'NO',
       special_instructions:$('[name="special_instructions"]').val(),
       quantity_details:quantity_details
     }

     $.ajax({
      url:'../user/dispatch/loads/stop-information-update-action',
      type:'POST',
      data: obj,
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data) 
       }
       alert(data.message)
       if(data.status){
        window.opener.location.reload()
        window.close()
      }
       
      hide_processing_modal()
    }
  })
   }
   return false
 }
</script>


<datalist id="quick_list_addresses"></datalist>
<script type="text/javascript">
  $(document.body).on('change', '[name="addresses_id_search"]' ,function(){
    address_id_selected=$(`[data-addresses-filter-rows="${$(this).val()}"]`).data('value');

    if($(this).val()!=''){
      if(address_id_selected==undefined){
        alert('Invalid address selected');
        address_id_selected=''
        $(this).val('')
        $(this).focus()
      }else{
        get_location_address_details({eid:$(`[data-addresses-filter-rows="${$(this).val()}"]`).data('eid')}).then(function(data) {
                      // Run this when your request was successful
                      if(data.status){
                        //Run this if response has list
                        if(data.response.details){
                          var details=data.response.details;
                          $('[name="company"]').val(details.name)    
                          $('[name="address_line"]').val(details.address_line)    
                          $('[name="state"]').val(details.state)    
                          $('[name="city"]').val(details.city)    
                          $('[name="zipcode"]').val(details.zipcode)    
                          $('[name="phone_number"]').val(details.phone_number)    
                          $('[name="fax_number"]').val(details.fax_number)    
                          $('[name="email"]').val(details.email)   
                        }
                      }
                    }).catch(function(err) {
                        // Run this when promise was rejected via reject()
                      })

                  }
                }else{
                  address_id_selected=''
                }
                alert(address_id_selected)
                $(this).data('selected-address-id',address_id_selected);
              });



      $(document.body).on('change', '[name="datetime_tbd"]' ,function(){

        if($(this).prop("checked") == true){
          $(this).siblings('[name="time_from"],[name="time_to"]').prop('disabled',true)
          $(this).siblings('[name="time_from"],[name="time_to"]').val('')
        }

        else if($(this).prop("checked") == false){

          $(this).siblings('[name="time_from"],[name="time_to"]').prop('disabled',false)

        }

      });

  function show_quick_list_addresses(){
   quick_list_location_addresses().then(function(data) {
          // Run this when your request was successful
          if(data.status){

            //Run this if response has list
            if(data.response.list){
              var options="";
              options+=`<option data-addresses-filter-rows="" data-value="" value="">- - Select - -</option>`
              $.each(data.response.list, function(index, item) {
                options+=`<option data-addresses-filter-rows="`+item.id+' '+item.name+`" data-value="${item.id}" data-eid="${item.eid}" value="`+item.id+' '+item.name+`"></option>`;               
              })
              $('#quick_list_addresses').html(options);     
            }
          }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
          }) 
      }
      show_quick_list_addresses()
    </script>
<script type="text/javascript">
  $(document.body).on('click','[data-action="add-quantity-row"]',function(){
    /*-----------appned $this table body with fresh row*/
    $(this).parents('table').children('tbody').append(`<tr data-quantity-details-row>
      <td style="min-width: 50px;max-width: 120px;">
      <input type="hidden" value="NEW" name="quantity_row_id">
      <input name="pd_number" type="text" style="width: 100%;"></td>
      <td style="min-width: 50px;max-width: 120px;"><input name="reference_number" type="text" style="width: 100%;"></td>
      <td style="min-width: 50px;max-width: 80px;"><input name="pallet_count" type="text" style="width: 100%;"></td>
      <td style="min-width: 50px;max-width: 80px;"><input name="case_count" type="text" style="width: 100%;"></td>
      <td style="width: 20px;"><button type="button" class="btn_red_c" data-remove-stop-button><i class="fa fa-trash"></i></button></td>
      </tr>`)
  })
  $(document.body).on('click', '[data-remove-stop-button]' ,function(){
    $(this).parents('tr').remove();
  });
</script>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>