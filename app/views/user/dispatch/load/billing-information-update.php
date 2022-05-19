<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
$details=$data['details'];
// echo "<pre>";
// print_r($details);
// echo "</pre>";



?>


<script type="text/javascript">
    function show_accessories(param) {
    get_dispatch_load_billing_accessories().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $(`[data-accessory-row="${param.ba_row_counter}"]`).find(`[name="accessory_type_id"]`).html(options);

          if (param.hasOwnProperty('default_select')) {
            $(`[data-accessory-row="${param.ba_row_counter}"]`).find(`[name="accessory_type_id"] option[value="${param.default_select}"]`).prop(`selected`, true)
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
</script>
<br><br><br>
<br>
<section class="lg-form-outer">
  <div class="lg-form-header">Update Billing Information of Load <?php echo $details['load_id']; ?></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-111">     
      <div>
        <fieldset>
          <legend>Billing Information</legend>

          <div style="display:flex;">
            <div class="field-section single-column"   style="width:50%">

              <div class="field-p">
                <br>
                <label>Freight/ Line haul charges</label>
                <input type="text" name="rate" value="<?php echo $details['rate']; ?>">
              </div>


            </div>            
            <div class="field-section single-column" style="width:50%">
              <div class="field-table">
                  <table>
                    <thead>
                      <th>Accessory Type</th>
                      <th>Amount</th>
                    </thead>
                    <tbody data-accessories-table>
                      <?php
                      $ba_row_counter=0;
                        foreach($details['accessories'] AS $acc){
                          $ba_row_counter++;
                          ?>
                          <tr data-accessory-row="<?php echo $ba_row_counter; ?>" data-eid="<?php echo $acc['eid']; ?>" style="border:2px solid pink;">
                        <td style="width:70%"><select name="accessory_type_id" style="width:100%;"><option> - - - Select - - </option></select></td>
                        <td style="width:20%"><input name="amount" type="text" style="width: 100%;" value="<?php echo $acc['amount'] ?>"></td>
                        <td style="width: 10%"><button type="button" class="btn-dark-red" data-action="delete-pickup-row"><i style="color:red" class="fa fa-trash"></td>
                      </tr>
                      <script type="text/javascript">
                        show_accessories({ba_row_counter:'<?php echo $ba_row_counter; ?>',default_select:'<?php echo $acc['accessory_type_id'] ?>'})
                      </script>
                          <?php
                        }
                      ?>

                      
                      <tfoot>
                        <tr>
                          <td colspan="4" style="padding:8px;text-align:right;"><button type="button" data-action="add-accessory-row" class="btn_blue">Add</button></td>
                        </tr>
                      </tfoot>
                    </tbody>
                  </table>
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
 <script type="text/javascript">

  function save(){
    
    show_processing_modal()
    submit_to_wait_btn('#submit','loading')
    $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    if(isValidForm){
accessories=[]
 
        $('[data-accessory-row]').each(function(ind) {

          pd_row=($(this));
          accessories.push({
            load_accessory_eid:pd_row.data('eid'),
            accessory_type_id:pd_row.find('[name="accessory_type_id"]').val(),
            amount:pd_row.find('[name="amount"]').val(),
          });
        })
         
      var obj={

       load_eid:'<?php echo $details['load_eid']; ?>',
       rate:$('[name="rate"]').val(),
       accessories:accessories
     }
     $.ajax({
      url:'../user/dispatch/loads/billing-information-update-action',
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
    <script type="text/javascript">
//ba_row_counter='<?php echo $ba_row_counter ?>'
      $(document.body).on('click', '[data-action="add-accessory-row"]', function() {
        let ba_row_counter=$('[data-accessories-table] tr:last').data('accessory-row');
        ba_row_counter=(ba_row_counter===undefined)?1:ba_row_counter+1;
        
        /*-----------appned $this table body with fresh row*/
        $('[data-accessories-table]').append(`<tr data-accessory-row="${ba_row_counter}" data-eid="NEW" style="border:2px solid pink;">
                        <td style="width:70%"><select name="accessory_type_id" style="width:100%;"><option> - - - Select - - </option></select></td>
                        <td style="width:20%"><input name="amount" type="text" style="width: 100%;"></td>
                        <td style="width: 10%"><button type="button" class="btn-dark-red" data-action="delete-pickup-row"><i style="color:red" class="fa fa-trash"></td>
                      </tr>`)
      show_accessories({ba_row_counter:ba_row_counter})
      })
      $(document.body).on('click', '[data-action="delete-pickup-row"]', function() {
        $(this).parents('tr').remove()
      })



    </script>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>