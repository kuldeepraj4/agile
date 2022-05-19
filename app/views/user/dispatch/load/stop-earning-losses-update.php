<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
$details=$data['details'];
// echo "<pre>";
// print_r($details);
// echo "</pre>";
?>


<script type="text/javascript">
    function show_earning_losses_types(param) {
    get_dispatch_load_earning_losses_types().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $(`[data-enl-row="${param.ba_row_counter}"]`).find(`[name="earning_loss_type_id"]`).html(options);

          if (param.hasOwnProperty('default_select')) {
            $(`[data-enl-row="${param.ba_row_counter}"]`).find(`[name="earning_loss_type_id"] option[value="${param.default_select}"]`).prop(`selected`, true)
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
  <div class="lg-form-header">Update Earning & Losses</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()" style="max-width:700px;margin: auto;">
    <section class="section-111">     
      <div>
        <fieldset>
          <legend>Earning & Losses Details</legend>

          <div style="display:flex;">
      
            <div class="field-section single-column" style="width:100%">
              <div class="field-table">
                  <table>
                    <thead>
                      <tr style="width:100%">
                        <th style="width:60%">Type</th>
                      <th style="width:20%">Amount</th>
                      <th style="width:10%"></th>
                      <th style="width:10%"></th>
                      </tr>
                    </thead>
                    <tbody data-accessories-table>
                      <?php
                      $ba_row_counter=0;
                        foreach($details['list'] AS $acc){
                          $ba_row_counter++;
                          ?>
                          <tr data-enl-row="<?php echo $ba_row_counter; ?>" data-eid="<?php echo $acc['eid']; ?>" style="border:2px solid pink;">
                        <td style="width:60%"><select name="earning_loss_type_id" style="width:100%;"><option> - - - Select - - </option></select></td>
                        <td style="width:20%"><input name="amount" type="text" style="width: 100%;" value="<?php echo $acc['amount'] ?>"></td>
                        <td style="width:10%">
                          <i class="ic upload" style="color:grey" title="Update BOL"  onclick="open_child_window({url:'../user/dispatch/loads/update-enl-file&eid=<?php echo $acc['eid'] ?>',width:600,height:500,name:'update-enl-file'})"></i>
                          <?php if($acc['receipt_path']!=""){
                          ?>
                          <i class="ic file" style="color:grey" title="View BOL"  onclick="open_document('<?php echo $acc['receipt_path'] ?>')"></i>
                          <?php
                        }
                        ?>
                        </td>
                        <td style="width: 10%"><button type="button" class="btn-dark-red" data-action="delete-pickup-row"><i style="color:red" class="fa fa-trash"></td>
                      </tr>
                      <script type="text/javascript">
                        show_earning_losses_types({ba_row_counter:'<?php echo $ba_row_counter; ?>',default_select:'<?php echo $acc['earning_loss_type_id'] ?>'})
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
enl_array=[]
 
        $('[data-enl-row]').each(function(ind) {

          pd_row=($(this));
          enl_array.push({
            earning_loss_eid:pd_row.data('eid'),
            earning_loss_type_id:pd_row.find('[name="earning_loss_type_id"]').val(),
            amount:pd_row.find('[name="amount"]').val(),
          });
        })
         
      var obj={

       load_stop_eid:'<?php echo $_GET['eid']; ?>',
       rate:$('[name="rate"]').val(),
       earning_losses:enl_array
     }
     $.ajax({
      url:'../user/dispatch/loads/stop-earning-losses-update-action',
      type:'POST',
      data: obj,
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data) 
       }
       alert(data.message)
       if(data.status){
        window.opener.location.reload()
        window.location.reload()
        //window.close()
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
        let ba_row_counter=$('[data-accessories-table] tr:last').data('enl-row');
        ba_row_counter=(ba_row_counter===undefined)?1:ba_row_counter+1;
        
        /*-----------appned $this table body with fresh row*/
        $('[data-accessories-table]').append(`<tr data-enl-row="${ba_row_counter}" data-eid="NEW" style="border:2px solid pink;">
                        <td style="width:60%"><select name="earning_loss_type_id" style="width:100%;"><option> - - - Select - - </option></select></td>
                        <td style="width:20%"><input name="amount" type="text" style="width: 100%;"></td>
                        <td style="width:10%"></td>
                        <td style="width: 10%"><button type="button" class="btn-dark-red" data-action="delete-pickup-row"><i style="color:red" class="fa fa-trash"></td>
                      </tr>`)
      show_earning_losses_types({ba_row_counter:ba_row_counter})
      })
      $(document.body).on('click', '[data-action="delete-pickup-row"]', function() {
        $(this).parents('tr').remove()
      })



    </script>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>