<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
$dtl=$data['details'];
?>
<br><br><br>
<br>
<section class="lg-form-outer">
  <div class="lg-form-header">Update Tracking</div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
    <section class="section-111" style="max-width: 600px"> 
      <input type="hidden" name="load_eid" value="<?php echo $_GET['eid']; ?>">    
      <div>
        <fieldset>
          <legend></legend>

          <div style="display:flex;">
            <div class="field-section single-column"   style="width:100%">

              <div class="field-p">
                <label>Tracking Status</label>
                <select name="tracking_status"></select>
              </div>
              <div class="field-p">
                <label>Tracking Note</label>
                <textarea name="tracking_note" placeholder="Write your note here" style="height:110px"><?php echo $dtl['tracking_note'] ?></textarea>
              </div>
              <div class="field-p">
                <label>Next Follow Up</label>
                <select name="next_follow_up_on">
                  <option value=""> - - Select - - </option>
                  <option>15 Minutes</option>
                  <option>30 Minutes</option>
                  <option>01 Hour</option>
                  <option>02 Hours</option>
                  <option>04 Hours</option>
                  <option>06 Hours</option>
                  <option>09 Hours</option>
                </select>
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
    get_load_tracking_status({}).then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.name + `">` + item.name + `</option>`;
          })
          $('[name="tracking_status"]').html(options);
          $(`[name="tracking_status"] option[value="<?php echo $dtl['tracking_status'] ?>"]`).prop(`selected`, true);
        }
      }
    }).catch(function(err) {

      // Run this when promise was rejected via reject()

    })

</script>
<script type="text/javascript">
  function save(){

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
      url:'../user/dispatch/loads/update-tracking-action',
      type:'POST',
      data: obj,
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data) 
       }
       alert(data.message);
       if(data.status){
         window.opener.show_list()
         window.close()
        wait_to_submit_btn('#submit','SAVE')
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