<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
$details=$data['details'];
?>
<br><br><br>
<br>
<section class="lg-form-outer">
  <div class="lg-form-header">Update Load Information of Load <?php echo $details['id']; ?></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return update()">
    <section class="section-111">     
      <div>
        <fieldset>
          <legend>Load Information</legend>

          <div style="display:flex;">
            <div class="field-section single-column"   style="width:50%">

              <div class="field-p">

                <label>Customer</label>

                <input type="hidden" name="customer_id" value="<?php echo $details['customer_id'] ?>" required><br>

                <input type="text" value="<?php echo $details['customer_code'].' - '.$details['customer_name'] ?>" list="quick_list_customers" name="customer_id_search" required>

              </div>

              <div class="field-p">
                <label>Rate</label>
                <input type="text" name="rate" value="<?php echo $details['rate']; ?>">
              </div>

              <div class="field-p">
                <label>PO Number</label>
                <input type="text" name="po_number" value="<?php echo $details['po_number']; ?>" >
              </div>




            </div>            
            <div class="field-section single-column" style="width:50%">

              <div class="field-p">
                <label>Commodity Type <?php echo $details['commodity_type']; ?></label>
                <select name="commodity_type_id"></select>
              </div>
              <div class="field-p">
                <label>Bill of Lading</label>
                <input type="text" name="bill_of_lading" value="<?php echo $details['bill_of_lading']; ?>">
              </div> 


              <div class="field-p">
                <label>Trailer Type</label>
                <select name="trailer_type" data-default-select="<?php echo $details['trailer_type']; ?>">

                  <option value="">- - Select - -</option>

                  <option value="REEFER">REEFER</option>

                  <option value="DRY">DRY</option>

                </select>
              </div>


              <?php
              if($details['trailer_type']=='REEFER'){
                ?>
                <div class="field-p">
                  <label>Temperature to maintain ( in <span>&#8457;</span> )</label>
                  <input type="text" name="temperature_to_maintain" value="<?php echo $details['temperature_to_maintain']; ?>">
                </div> 
                <?php
              }else{
                ?>
                <div class="field-p" data-temperature-option style="display:none;"></div>
                <?php
              }
              ?>

            </div>  
          </div>                
        </fieldset>
      </div>
    </section>


    <script type="text/javascript">
      //-------- hide/show temperature to maintain option based on the trailer type selection
      $(document.body).on('change', '[name="trailer_type"]' ,function(){
        if($("[name='trailer_type'] :selected").text()=='REEFER'){
          $('[data-temperature-option]').show();
          $('[data-temperature-option]').html(`<label>Temperature to maintain ( in <span>&#8457;</span> )</label>
            <input type="text" name="temperature_to_maintain" pattern="[0-9.-]{1,}" required>`);

        }else{
          $('[data-temperature-option]').hide();
        }
      });
      //--------/ hide/show temperature to maintain option based on the trailer type selection
    </script>




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
     var allow_duplicate_po_number=false;
     function update(){
      var form = document.getElementById('MyForm');
      var isValidForm = form.checkValidity();
      var currentForm = $('#MyForm')[0];
      var formData=new FormData(currentForm);
      if(isValidForm){
        var arr=$('#MyForm').serializeArray();   
        var temperature_to_maintain='';

        if($("[name='trailer_type'] :selected").text()=='REEFER'){
          temperature_to_maintain=$('[name="temperature_to_maintain"]').val()

        }
        var obj={
          update_eid:'<?php echo $details['eid'] ?>',
          customer_id:$('[name="customer_id"]').val(),
          po_number:$('[name="po_number"]').val(),
          rate:$('[name="rate"]').val(),
          commodity_type_id:$('[name="commodity_type_id"]').val(),
          bill_of_lading:$('[name="bill_of_lading"]').val(),
          trailer_type:$('[name="trailer_type"]').val(),
          temperature_to_maintain:temperature_to_maintain,
          allow_duplicate_po_number:allow_duplicate_po_number
        }

        console.log(obj)

        $.ajax({

          url:'/user/dispatch/loads/load-information-update-action',

          type:'POST',

          data: obj,

          success:function(data){
            console.log(data)
            if((typeof data)=='string'){
             data=JSON.parse(data) 
           }

           if(data.status){
            window.opener.location.reload();
             alert(data.message);
             window.close();
           }else{
            if(data.message=="CONFIRM"){
              switch(data.confirm){
                case 'ALLOW DUPLICATE PO NUMBER':
                let conf = confirm(data.confirm_message);
                if(conf==true){
                  allow_duplicate_po_number=true;
                  update()
                }
                break;
              }
            }else{
              alert(data.message);
            }

          }

        }

      })

      }

      return false

    }
  </script>



  <datalist id="quick_list_customers"></datalist>

  <script type="text/javascript">

    $(document.body).on('change', '[name="customer_id_search"]' ,function(){

      customer_id_selected=$(`[data-customer-filter-rows="${$(this).val()}"]`).data('value');

      if(customer_id_selected!=undefined){

        $('[name="customer_id"]').val(customer_id_selected)

      }

    });





    function show_quick_list_customers(){

     quick_list_customers().then(function(data) {

  // Run this when your request was successful

  if(data.status){



    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option data-customer-filter-rows="" data-value="" value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option data-customer-filter-rows="`+item.code+' '+item.name+`" data-value="${item.id}" value="`+item.code+' '+item.name+`"></option>`;               

      })
      $('#quick_list_customers').html(options);     

    }

  }

}).catch(function(err) {

  // Run this when promise was rejected via reject()

}) 

}

show_quick_list_customers()

</script>

<script type="text/javascript">
  function show_commodity_types(){
   get_commodity_types().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="commodity_type_id"]').html(options);     
      $('[name="commodity_type_id"] option[value="<?php echo $details['commodity_type_id']; ?>"]').prop('selected',true);     
    }
  }
}).catch(function(err) {
  console.log(err)
  // Run this when promise was rejected via reject()
}) 
}
show_commodity_types()
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>