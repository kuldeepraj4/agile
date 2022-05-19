<?php
require_once APPROOT . '/views/includes/user/header.php';
//$ro_details = $data['ro_details'];
// print_r($ro_details)
?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - Add New Storage</div>
    <form autocomplete="off" class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
        <section class="section-111">
        </section>
        <section class="section-111" style="max-width: 1200px">
            <div>
                <fieldset>
                    <legend>Add New Storage</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Storage Type</label>
                            <select name="type_id_fk" required></select>
                        </div>
                    </div>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Storage Name</label>
                            <input name="storage" type="text" required>
                        </div>
                    </div>
                   
                </fieldset>
                <br>
                <section class="action-button-box">

                    <button type="submit" class="btn_green">SAVE</button>
                    &nbsp; &nbsp;&nbsp;<button type="button" class="btn_green" onclick="back_alert()">BACK</button>
                </section>
            </div>
        </section>
    </form>
</section>
<script type="text/javascript">
    function save() {
        //show_processing_modal()
        //submit_to_wait_btn('#submit', 'loading')
        $('#formErro').show()
        var form = document.getElementById('MyForm');
        var isValidForm = form.checkValidity();
        //var currentForm = $('#MyForm')[0];
        // var formData = new FormData(currentForm);
        if (isValidForm) {
            var arr = $('#MyForm').serializeArray();

            var form_data = new FormData();

            var obj = {
                storage: $('[name="storage"]').val(),
                type_id_fk: $('[name="type_id_fk"]').val(),
            }
            // console.log(obj)
            // alert("data logged in console")
            for (var key in obj) {
                form_data.append(key, obj[key]);
            }
            form_data.append(key, obj[key]);
            $.ajax({
                url: window.location.pathname + '-action',
                type: 'POST',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                    }
                    alert(data.message);
                    if (data.status) {
                        window.history.back();
                        wait_to_submit_btn('#submit', 'ADD')
                        hide_processing_modal()
                    } else {
                        hide_processing_modal()
                        wait_to_submit_btn('#submit', 'ADD')
                    }
                }
            })
        }
        return false
    }
</script>
<script type="text/javascript">
    function show_storage_type(){
        get_storage_types().then(function(data) {
  // Run this when your request was successful
  if(data.status){

    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
          if(item.storage_type_status == 'ACTIVE'){
            options+=`<option value="${item.id}">${item.storage_type}</option>`;  
          }         
    })
      $('[name="type_id_fk"]').html(options);     
  }
}
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}

show_storage_type()

</script>
<script type="text/javascript">
    function back_alert() {
        if (confirm('Are you Sure ?')) {
            window.history.back();
        }
    }
</script>

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>