<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
        <section class="form-a" style="max-width: 600px">
            <div class="form-a-header">ADD NEW ZIP Code</div>
            <form method="POST" id="MyForm" onsubmit="return add_new()">
                <div>
                    <label>Country</label>
                    <select name="country_id" required="required" id="country_id"></select>
                </div>
                <div>
                    <label>State</label>
                    <select name="state_id" required="required" id="state_id"></select>
                </div>
                <div>
                    <label>City</label>
                    <select name="city_id" required="required" id="city_id"></select>
                </div>
                <div>
                  <label>ZIP Code</label>
                    <input type="text" name="name" pattern="[a-zA-Z0-9]{3,}" required="required">
                </div>
                <div>
                    <button class="form-submit-btn" id="submit">SAVE</button>
                    <button type="button" class="form-submit-btn" onclick="back_alert()" style="margin-top: 10px;">BACK</button>
                </div>
            </form>
         </section>
<script type="text/javascript">
    function back_alert() {
        if (confirm('Are you Sure ?')) {
        window.history.back();
        }
    }

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
    $.ajax({

        url:window.location.href+'-action',
        type:'POST',
        data: obj,
        success:function(data){
               if((typeof data)=='string'){
               data=JSON.parse(data) 
               }
               alert(data.message);
               if(data.status){
                location.href='../user/masters/locations/zipcodes';
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
<script type="text/javascript">
// function show_states(){
//  get_cities().then(function(data) {
//   // Run this when your request was successful
 
//   if(data.status){

//     //Run this if response has list
//     if(data.response.list){
//       var options="";
//           options+=`<option value="">- - Select - -</option>`
//         $.each(data.response.list, function(index, item) {
//             options+=`<option value="`+item.id+`">`+item.name+', '+item.state+', '+item.country+`</option>`;               
//         })
//         $('#city_id').html(options);     
//     }
//   }
// }).catch(function(err) {
//   // Run this when promise was rejected via reject()
// }) 
// }

// show_states()

</script>

<script>
showCountries();

function showCountries(){
    $('#state_id').prop('disabled', 'disabled');
    $('#city_id').prop('disabled', 'disabled');

    get_countries().then(function(data) {
    if(data.status){
        if(data.response.list){
            var options="";
            options+=`<option value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
                options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
            })
            $('#country_id').html(options); 
        }
    }
    else {
        var options="";
        options+=`<option value="">- - Select - -</option>`
        $('#country_id').html(options);
    }
    }).catch(function(err) {
    // Run this when promise was rejected via reject()
    }) 
}

$(document.body).on('change', '#country_id', function() {
    $('#state_id').html('');
    $('#state_id').prop('disabled', 'disabled');
    $('#city_id').html('');
    $('#city_id').prop('disabled', 'disabled');

    get_states({country_id: $(this).val()}).then(function(data) {
        if(data.status){
            if(data.response.list){
                var options="";
                options+=`<option value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
                })
                $('#state_id').html(options);
                $('#state_id').prop('disabled', false);
            }
        }
    }).catch(function(err) {
    // Run this when promise was rejected via reject()
    })

})

$(document.body).on('change', '#state_id', function() {
    $('#city_id').html('');
    $('#city_id').prop('disabled', 'disabled');

    get_cities({state_id: $(this).val()}).then(function(data) {
        if(data.status){
            if(data.response.list){
                var options="";
                options+=`<option value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
                })
                $('#city_id').html(options);
                $('#city_id').prop('disabled', false); 
            }
        }
    }).catch(function(err) {
    // Run this when promise was rejected via reject()
    })

})


</script>



<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>