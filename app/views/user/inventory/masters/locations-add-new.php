<?php
require_once APPROOT . '/views/includes/user/header.php';
//$ro_details = $data['ro_details'];
// print_r($ro_details)
?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - Add New Location</div>
    <form autocomplete="off" class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
        <section class="section-111">
        </section>
        <section class="section-111" style="max-width: 1200px">
            <div>
                <fieldset>
                    <legend>Add New Location</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Location Name</label>
                            <input name="location_name" type="text" required>
                        </div>
                        <div class="field-p">
                            <label>Country</label>
                            <select name="country_id" required="required" id="country_id"></select>
                        </div>
                        <div class="field-p">
                            <label>State</label>
                            <select name="state_id" required="required" id="state_id"></select>
                        </div>
                        <div class="field-p">
                            <label>City</label>
                            <select name="city_id" required="required" id="city_id"></select>
                        </div>
                        <div class="field-p">
                            <label>ZIP Code</label>
                            <select name="address_zipcode_id" id="address_zipcode_id" disabled></select>
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
        var location = $('[name="location_name"]').val();
        location += ($('[name="city_id"]').val()) ? ', '+$('[name="city_id"] option:selected').text() : '';
        location += ($('[name="state_id"]').val()) ? ', '+$('[name="state_id"] option:selected').text() : '';
        location += ($('[name="country_id"]').val()) ? ', '+$('[name="country_id"] option:selected').text() : '';
        location += ($('[name="address_zipcode_id"]').val()) ? ', '+$('[name="address_zipcode_id"] option:selected').text() : '';

        if (isValidForm) {
            var arr = $('#MyForm').serializeArray();

            var form_data = new FormData();

            var obj = {
                location: location,
                location_name: $('[name="location_name"]').val(),
                country_id_fk: $('[name="country_id"]').val(),
                state_id_fk: $('[name="state_id"]').val(),
                city_id_fk: $('[name="city_id"]').val(),
                address_zipcode_id_fk: $('[name="address_zipcode_id"]').val(),
            }
            // console.log(obj)
            // alert("data logged in console")
            for (var key in obj) {
                form_data.append(key, obj[key]);
            }
            form_data.append(key, obj[key]);
            // console.log(obj);return false;
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
    function back_alert() {
        if (confirm('Are you Sure ?')) {
            window.history.back();
        }
    }
</script>
<script>
showCountries();

function showCountries(){
    $('#state_id').prop('disabled', 'disabled');
    $('#city_id').prop('disabled', 'disabled');
    $('#address_zipcode_id').prop('disabled', 'disabled');

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
    $('#address_zipcode_id').html('');
    $('#address_zipcode_id').prop('disabled', 'disabled');

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
    $('#address_zipcode_id').html('');
    $('#address_zipcode_id').prop('disabled', 'disabled');

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

$(document.body).on('change', '#city_id', function() {
    $('#address_zipcode_id').html('');
    $('#address_zipcode_id').prop('disabled', 'disabled');

    get_zipcodes({city_id: $(this).val() }).then(function(data) {
  // Run this when your request was successful
        console.log(data);
        if(data.status){
            //Run this if response has list
            if(data.response.list){
            var options="";
                options+=`<option value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
                })
                $('[name="address_zipcode_id"]').html(options);
                $('#address_zipcode_id').prop('disabled', false);    
            }
            else{
            var options="";
            options+=`<option value="">- - Select - -</option>`;
            $('[name="address_zipcode_id"]').html(options);
            }
        }
        else{
            var options="";
            options+=`<option value="">- - Select - -</option>`;
            $('[name="address_zipcode_id"]').html(options);
            }
        }).catch(function(err) {
        // Run this when promise was rejected via reject()
        }) 

})


</script>

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>