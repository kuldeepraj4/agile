<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<section class="form-a" style="max-width: 600px">
    <div class="form-a-header">ADD NEW - YARD MAINTENANCE MASTER</div>
    <form method="POST" id="MyForm" onsubmit="return add_new()">

         <div>
            <label>Yard Name</label>
            <input type="text" data-msg="50" name="yard_name" required="required">
        </div>

        <div>
            <label>Yard State</label>
            <select name="yard_state_id" data-filter="yard_state_id" type="text" onchange="show_cities({state_id:this.value})">
            </select>
        </div>

        <div>
            <label>Yard City</label>
            <select name="yard_city_id" data-filter="yard_city_id" disabled>
        </select>
        </div>
        
        <div>
            <button class="form-submit-btn" id="submit">SAVE</button>
        </div>
        <div style="text-align:center;"><button type="button" class="form-submit-btn" onclick="back_alret()">BACK</button></div>
</form>
</section>

<script type="text/javascript">
  var url_params = get_params();
</script>

<script type="text/javascript">
  get_states().then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="` + item.id + `">` + item.name + `</option>`;
        })
        $('[data-filter="yard_state_id"]').html(options);
        if (url_params.hasOwnProperty('yard_state_id')) {
            $("[data-filter='yard_state_id'] option[value=" + url_params.yard_state_id + "]").prop('selected', true);
            show_cities({
            state_id: url_params.yard_state_id
          })
          }
      }
    }
  })
</script>
<script type="text/javascript">
    function show_cities(param) {
      if (param.state_id === '') {
        $('[data-filter="yard_city_id"]').html('');
        $('[data-filter="yard_city_id"]').prop('disabled', 'disabled');
    }
    else if (param.state_id !== ''){
      $('[data-filter="yard_city_id"]').prop('disabled', false);
      get_cities(param).then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            //console.log(item)
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[data-filter="yard_city_id"]').html(options);
          if (url_params.hasOwnProperty('yard_city_id')) {
              $("[data-filter='yard_city_id'] option[value=" + url_params.yard_city_id + "]").prop('selected', true);
            }
        }
      } else {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $('[name="yard_city_id"]').html(options);
      }

    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  }
</script>

<script type="text/javascript">
    function add_new(){
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
            $.ajax(
            {
                url:window.location.href+'-action',
                type:'POST',
                data: obj,
                success:function(data)
                {
                  // // alert(data)
                   // console.log(data)
                 if((typeof data)=='string')
                 {
                     data=JSON.parse(data) 
                 }
                alert(data.message);
                if(data.status)
                {
                    location.href='../user/maintenance/masters/yard-maintenance';
                    wait_to_submit_btn('#submit','SAVE')
                }
                else
                {
                    wait_to_submit_btn('#submit','SAVE')
                    $('[data-msg='+data.flagformessage+']').focus();
                }
            }
        }
        )
        }
        return false
    }
</script>
<script>
  function back_alret(){
    if(confirm('Are you Sure ?')){
      window.history.back();
    }
  }
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>