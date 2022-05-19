<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details']; 

// echo '<pre>';
// print_r($details);
// echo '</pre>';


?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - Update Location</div>
    <form autocomplete="off" class="lg-form" method="POST" id="MyForm" onsubmit="return update()">
        <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
        <section class="section-111">
        </section>
        <section class="section-111" style="max-width: 1200px">
            <div>
                <fieldset>
                    <legend>Update Location</legend>
                    <div class="field-section single-column">
                    <div class="field-p">
                            <label>Location Name</label>
                            <input name="location_name" type="text" required value="<?php echo $details['location_name'] ?>">
                        </div>
                        <div class="field-p">
                            <label>Country</label>
                            <select name="country_id_fk" required="required" id="country_id_fk" data-default-select="<?php echo $details['country_id_fk']; ?>"></select>
                        </div>
                        <div class="field-p">
                            <label>State</label>
                            <select name="state_id_fk" required="required" id="state_id_fk" data-default-select="<?php echo $details['state_id_fk']; ?>"></select>
                        </div>
                        <div class="field-p">
                            <label>City</label>
                            <select name="city_id_fk" required="required" id="city_id_fk" data-default-select="<?php echo $details['city_id_fk']; ?>"></select>
                        </div>
                        <div class="field-p">
                            <label>ZIP Code</label>
                            <select name="address_zipcode_id_fk" id="address_zipcode_id_fk" disabled data-default-select="<?php echo $details['address_zipcode_id_fk']; ?>"></select>
                        </div>
                        <div class="field-p">
                            <label>Status</label>
                            <select name="location_status" id="status" data-filter="status" required data-default-select="<?php echo $details['location_status']; ?>">
                                <option value="">--Select--</option>
                                <option value="ACTIVE">Active</option>
                                <option value="INACTIVE">Inactive</option>
                            </select>
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
    function update(){
        var location = $('[name="location_name"]').val();
        location += ($('[name="city_id_fk"]').val()) ? ', '+$('[name="city_id_fk"] option:selected').text() : '';
        location += ($('[name="state_id_fk"]').val()) ? ', '+$('[name="state_id_fk"] option:selected').text() : '';
        location += ($('[name="country_id_fk"]').val()) ? ', '+$('[name="country_id_fk"] option:selected').text() : '';
        location += ($('[name="address_zipcode_id_fk"]').val()) ? ', '+$('[name="address_zipcode_id_fk"] option:selected').text() : '';

        submit_to_wait_btn('#submit','loading')
        $('#formErro').show()
        var form = document.getElementById('MyForm');
        var isValidForm = form.checkValidity();
        //var currentForm = $('#MyForm')[0];
        //var formData=new FormData(currentForm);
        if(isValidForm){
            var arr=$('#MyForm').serializeArray();
            var obj={}
            for(var a=0;a<arr.length;a++ ){
                obj[arr[a].name]=arr[a].value
            }
            obj['location']= location;
            // console.log(obj);return false;
            $.ajax({
                url:window.location.pathname+'-action',
                type:'POST',
                data: obj,
                success:function(data){
                 if((typeof data)=='string'){
                     data=JSON.parse(data) 
                 }
                 alert(data.message);
                 if(data.status){;
                    window.location.href="../user/inventory/masters/locations"
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
    function back_alert() {
        if (confirm('Are you Sure ?')) {
            window.history.back();
        }
    }
</script>
<script>
    function showCountries(){
    $('[name="state_id_fk"]').prop('disabled', 'disabled');
    $('[name="city_id_fk"]').prop('disabled', 'disabled');
    $('[name="address_zipcode_id_fk"]').prop('disabled', 'disabled');

    get_countries().then(function(data) {
    if(data.status){
        if(data.response.list){
            var options="";
            options+=`<option value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
                options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
            })
            $('[name="country_id_fk"]').html(options);
            select_default('[name="country_id_fk"]'); 
        }
    }
    else {
        var options="";
        options+=`<option value="">- - Select - -</option>`
        $('[name="country_id_fk"]').html(options);
    }
    }).catch(function(err) {
    // Run this when promise was rejected via reject()
    }) 
    }
    showCountries();

    $(document.body).on('change', '[name="country_id_fk"]', function() {
        $('[name="state_id_fk"]').html('');
        $('[name="state_id_fk"]').prop('disabled', 'disabled');
        $('[name="city_id_fk"]').html('');
        $('[name="city_id_fk"]').prop('disabled', 'disabled');
        $('[name="address_zipcode_id_fk"]').html('');
        $('[name="address_zipcode_id_fk"]').prop('disabled', 'disabled');

        show_states($(this).val());

    })

    function show_states(id)
    {
        get_states({country_id: id}).then(function(data) {
            if(data.status){
                if(data.response.list){
                    var options="";
                    options+=`<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
                    })
                    $('[name="state_id_fk"]').html(options);
                    $('[name="state_id_fk"]').prop('disabled', false);
                    select_default('[name="state_id_fk"]');
                }
            }
        }).catch(function(err) {
        // Run this when promise was rejected via reject()
        })
    }
    show_states(<?php echo $details['country_id_fk'] ?>);

    $(document.body).on('change', '[name="state_id_fk"]', function() {
        $('[name="city_id_fk"]').html('');
        $('[name="city_id_fk"]').prop('disabled', 'disabled');
        $('[name="address_zipcode_id_fk"]').html('');
        $('[name="address_zipcode_id_fk"]').prop('disabled', 'disabled');

        show_cities($(this).val());

    })

    function show_cities(id)
    {
        get_cities({state_id: id}).then(function(data) {
            if(data.status){
                if(data.response.list){
                    var options="";
                    options+=`<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
                    })
                    $('[name="city_id_fk"]').html(options);
                    $('[name="city_id_fk"]').prop('disabled', false);
                    select_default('[name="city_id_fk"]');
                }
            }
        }).catch(function(err) {
        // Run this when promise was rejected via reject()
        })
    }

    show_cities(<?php echo $details['state_id_fk'] ?>);

    $(document.body).on('change', '#city_id_fk', function() {
        $('[name="address_zipcode_id_fk"]').html('');
        $('[name="address_zipcode_id_fk"]').prop('disabled', 'disabled');

        show_zipcodes($(this).val());

    })

    function show_zipcodes(id)
    {
        get_zipcodes({city_id: id }).then(function(data) {
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
                    $('[name="address_zipcode_id_fk"]').html(options);
                    $('[name="address_zipcode_id_fk"]').prop('disabled', false);
                    select_default('[name="address_zipcode_id_fk"]'); 
                }
                else{
                var options="";
                options+=`<option value="">- - Select - -</option>`;
                $('[name="address_zipcode_id_fk"]').html(options);
                }
            }
            else{
                var options="";
                options+=`<option value="">- - Select - -</option>`;
                $('[name="address_zipcode_id_fk"]').html(options);
                }
            }).catch(function(err) {
            // Run this when promise was rejected via reject()
            })
    }
    show_zipcodes(<?php echo $details['city_id_fk'] ?>);
</script>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>