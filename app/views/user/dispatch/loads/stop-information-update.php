<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
$details=$data['details'];
echo "<pre>";
print_r($details);
echo "</pre>";
?>
<br><br>

<section class="lg-form-outer">
  <div class="lg-form-header">Update <?php echo $details['category'] ?> Information</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return update()">
    <section class="section-111">     
      <div>
        <fieldset id="shipper" >
          <legend><?php echo $details['category'] ?> Information</legend>
          <div class="field-section single-column" data-stop-row data-stop-category="SHIPPER">
            <input type="hidden" name="update_eid" value="<?php echo $details['eid']; ?>">
            <input type="hidden" name="address_id" value="<?php echo $details['location_id'] ?>">

            <?php
            if($details['category']=='STOP'){
              ?>
              <div class="field-p">
                <label>Stop Type</label>
                <select class="w-100" name="stop_type" data-default-select="<?php echo $details['stop_type']; ?>" required>
                  <option value="">- Select -  </option>
                  <option value="PICK">PICK</option>
                  <option value="DROP">DROP</option>
                </select>
              </div>
              <?php  
            }
            ?>




            <div class="field-p">
              <label>Search</label>
              <input type="text" list="quick_list_addresses" value="<?php echo $details['location_id'].' '.$details['location_name'] ?>" name="addresses_id_search" required>
            </div>


            <div class="field-p">
              <label>Company</label>
              <input type="text" name="company" value="<?php echo $details['location_name'] ?>" disabled>
            </div>                            
            <div class="field-p">
              <label>Address Line</label>
              <input type="text" name="address_line" value="<?php echo $details['location_address_line'] ?>" disabled>
            </div>        
            <div class="field-p">
              <label>State</label>
              <input type="text" name="state" value="<?php echo $details['location_state'] ?>" disabled>
            </div>
            <div class="field-p">
              <label>City</label>
              <input type="text" name="city" value="<?php echo $details['location_city'] ?>" disabled>
            </div>
            <div class="field-p">
              <label>ZIP Code</label>
              <input type="text" name="zipcode" value="<?php echo $details['location_zipcode'] ?>" disabled>
            </div>          
            <div class="field-p">
              <label>Pick Up Number</label>
              <input class="w-100" type="text" value="<?php echo $details['pick_up_number'] ?>" name="pick_up_number" >
            </div>
            <div class="field-p">
              <label>Confirm Number</label>
              <input class="w-100" type="text" value="<?php echo $details['confirm_number'] ?>" name="confirm_number" >
            </div>
            <div class="field-p">
              <label>Case Count</label>
              <input class="w-100" type="text" value="<?php echo $details['case_count'] ?>" name="case_count" >
            </div>
            <div class="field-p">
              <label>Pallet Count</label>
              <input class="w-100" type="text" value="<?php echo $details['pallet_count'] ?>" name="pallet_count" >
            </div>
            <div class="field-p">
              <label>Appointment Type</label>
              <select class="w-100" name="appointment_type" data-default-select="<?php echo $details['appointment_type']  ?>" >
                <option value="">- Select -</option>
                <option value="FCFS">FCFS</option>
                <option value="FIRM">FIRM</option>
              </select>
            </div>          
            <div class="field-p">
              <label>Date</label>
              <input class="w-100" value="<?php echo $details['date']  ?>" type="text" name="date" data-date-picker="">
            </div>
            <div class="field-p">
              <label>Time</label>
              <input class="w-150" style="max-width: 80px;" value="<?php echo $details['time_from']  ?>" type="text" data-time-picker name="time_from"> &nbsp - &nbsp
              <input class="w-150" style="max-width: 80px;" value="<?php echo $details['time_to']  ?>" type="text" data-time-picker name="time_to">
            </div>                              

            <div class="field-p">
              <label>Special Instructions/Directions</label>
              <div>
                <textarea style="width: 100%;height:80px !important" name="special_instructions"><?php echo $details['special_instructions'] ?></textarea>
              </div>
            </div>     


          </div>                  
        </fieldset>
      </div>
    </section>


    <section class="action-button-box">
      <button type="submit" class="btn_green">SAVE</button>
    </section>
  </form>
</section>

<datalist id="quick_list_addresses"></datalist>
<script type="text/javascript">
  $(document.body).on('change', '[name="addresses_id_search"]' ,function(){
    address_id_selected=$(`[data-addresses-filter-rows="${$(this).val()}"]`).data('value');
    if(address_id_selected!=undefined){
      row_parent=$(this).parents('[data-stop-row]')
      $('[name="address_id"]').val(address_id_selected)
      get_location_address_details({eid:$(`[data-addresses-filter-rows="${$(this).val()}"]`).data('eid')}).then(function(data) {
                      // Run this when your request was successful
                      if(data.status){
                        //Run this if response has list
                        if(data.response.details){
                          var details=data.response.details;
                          row_parent.find('[name="company"]').val(details.name)    
                          row_parent.find('[name="address_line"]').val(details.address_line)    
                          row_parent.find('[name="state"]').val(details.state)    
                          row_parent.find('[name="city"]').val(details.city)    
                          row_parent.find('[name="zipcode"]').val(details.zipcode)    
                          row_parent.find('[name="phone_number"]').val(details.phone_number)    
                          row_parent.find('[name="fax_number"]').val(details.fax_number)    
                          row_parent.find('[name="email"]').val(details.email)   
                        }
                      }
                    }).catch(function(err) {
                        // Run this when promise was rejected via reject()
                      })
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

      function update(){

        submit_to_wait_btn('#submit','loading')

        $('#formErro').show()

        var form = document.getElementById('MyForm');

        var isValidForm = form.checkValidity();

        var currentForm = $('#MyForm')[0];

        var formData=new FormData(currentForm);

        if(isValidForm){

          var arr=$('#MyForm').serializeArray();

          var obj={}

          for(var a=0;a<arr.length;a++ ){

            obj[arr[a].name]=arr[a].value

          }
          $.ajax({

            url:'user/dispatch/loads/stop-information-update-action',

            type:'POST',

            data: obj,

            success:function(data){
              if((typeof data)=='string'){

               data=JSON.parse(data) 

             }

             alert(data.message);

             if(data.status){
             window.opener.location.reload();
             window.close();

            }else{

              wait_to_submit_btn('#submit','SAVE')

            }

          }

        })

        }

        return false

      }

    </script>


    <?php
    require_once APPROOT.'/views/includes/user/footer.php';
  ?>