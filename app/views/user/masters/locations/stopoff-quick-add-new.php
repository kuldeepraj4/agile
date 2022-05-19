<?php
require_once APPROOT . '/views/includes/user/header-quick-view.php';
?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">ADD NEW STOP - OFF</div>
    <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">
        <section class="section-11">
            <div>
                <fieldset>
                    <legend>Location Address</legend>
                    <div class="field-section single-column">
                        <div id="span" style="visibility: hidden;height:0px;width:0px;"></div>
                        <input type="hidden" name="google_place_id" required="required">
                        <!-- <input type="hidden" name="state_shortname" required="required"> -->
                        <input type="hidden" name="latitude" required="required">
                        <input type="hidden" name="longitude" required="required">
                        <input type="hidden" name="location_type" value="STOP OFF">
                        <div class="field-p">
                            <label>Search</label>
                            <input type="text" id="search_item" name="" class="Autocomplete">
                        </div>
                        <div class="field-p">
                            <label>City</label>
                            <input type="text" name="city" required>
                        </div>
                        <div class="field-p">
                            <label>State</label>
                            <input type="text" name="state" required="required">
                        </div>
                        <div class="field-p">
                            <label>Zipcode</label>
                            <input type="text" name="zipcode" required="required">
                        </div>
                    </div>
                </fieldset>
            </div>
        </section>

        <section class="action-button-box">
            <button type="submit" class="btn_green">SAVE</button>
            <!-- <button type="button" class="btn_green" onclick="back_alert()" style="margin-left: 10px;">BACK</button> -->
        </section>
    </form>
</section>
<!-- <script type="text/javascript">
    function back_alert() {
        if (confirm('Are you Sure ?')) {
            window.history.back();
        }
    }
</script> -->
<!-- ---------------GOOGLE API START HERE-------------GOOGLE API START HERE--------------------------------- -->
<script type="text/javascript">
    var autocomplete;
    var latitude;
    var longitude;

    function activatePlacesSearch() {
        var input = document.getElementById('search_item')
        autocomplete = new google.maps.places.Autocomplete(input)
        autocomplete.addListener("place_changed", fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = autocomplete.getPlace();
        //console.log(place)
        //console.log(place.address_components)
        //console.log(place.address_components[5].types[0])
        //console.log(place.address_components.length)
        address_length = place.address_components.length;
        var zipcode = "";
        for (i = 0; i < address_length; i++) {
            if (place.address_components[i].types[0] == "postal_code") {
                zipcode = place.address_components[i].long_name;
            }
        }
        var google_place_id = place.place_id;
        latitude = place.geometry['location'].lat();
        longitude = place.geometry['location'].lng();
        var adr = place.adr_address;
        $('#span').html(adr)
        if ($(".region").length) {
            var state = $('.region').html()
        } else {
            var state = "";
        }
        if ($(".locality").length) {
            var city = $('.locality').html()
        } else {
            var city = "";
        }
        // if($(".postal-code").length){
        //   var zipcode = $('.postal-code').html()
        // }else{
        //   var zipcode = "";
        // }
        if ($(".country-name").length) {
            var country = $('.country-name').html();
        } else {
            var country = "";
        }
        var state_trim = state.trim();
        var city_trim = city.trim();
        var zipcode_trim = zipcode.trim();
        // var country_trim = country.trim();
        // var formatted_address = place.formatted_address;
        // var new_formatted_address_array = [];
        // var formatted_address_array = formatted_address.split(",")
        // $.each(formatted_address_array, function(key, value) {
        //     var val = value.trim();
        //     if (val == city_trim) {
        //         //var ind = key
        //         return false;
        //     }
        //     new_formatted_address_array.push(val)
        // })
        // var address_line_new = new_formatted_address_array.toString();
        // if ($(".street-address").length) {
        //     var street_address = $('.street-address').html();
        // } else {
        //     var street_address = "";
        // }
        // if ($(".extended-address").length) {
        //     var extended_address = $('.extended-address').html();
        // } else {
        //     var extended_address = "";
        // }
        // var str = address_line.split(',')
        // var s = str.slice(0,-1);
        // var new_str = s.toString();
        //var address_line = street_address + ', ' + extended_address;
        // var addrline1 = address_line.trim();
        //addrline2 = addrline1 + ',';
        // addrline3 = addrline2.replace(/,*$/, "");
        // addrline4 = addrline3.replace(/^,*/, "");
        // addrline5 = addrline4.trim();
        $('[name="google_place_id"]').val(google_place_id);
        $('[name="latitude"]').val(latitude);
        $('[name="longitude"]').val(longitude);
        //$('[name="address_line"]').val(new_str);
        //$('[name="address_line"]').val(addrline5);
        // $('[name="address_line"]').val(address_line_new);
        $('[name="city"]').val(city_trim);
        $('[name="state"]').val(state_trim);
        $('[name="zipcode"]').val(zipcode_trim);
        // $('[name="address_as_per_google"]').val(formatted_address)
        //$('#address_as_per_google').html('Address as per Google:  ' + formatted_address)
        //initialize()
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAg2C9RCeB_ViJ875s_iF-yO1m-TnLjj0&libraries=places&callback=activatePlacesSearch">
</script>
<!-- <script>
    function initialize() {
        var markerCenter = new google.maps.LatLng(latitude, longitude);
        var marker = null;
        var mapProp = {
            center: new google.maps.LatLng(latitude, longitude),
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map"), mapProp);
        var marker = new google.maps.Marker({
            position: markerCenter,
            animation: google.maps.Animation.BOUNCE
        });
        marker.setMap(map);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script> -->
<!-- -------------------GOOGLE API END HERE-------------------GOOGLE API END HERE--------------------------------------- -->


<script type="text/javascript">
    function back_alert() {
        if (confirm('Are you Sure ?')) {
            window.history.back();
        }
    }

    function add_new() {
        submit_to_wait_btn('#submit', 'loading')
        $('#formErro').show()
        var form = document.getElementById('MyForm');
        var isValidForm = form.checkValidity();
        var currentForm = $('#MyForm')[0];
        var formData = new FormData(currentForm);
        if (isValidForm) {
            var arr = $('#MyForm').serializeArray();
            var obj = {}
            for (var a = 0; a < arr.length; a++) {
                obj[arr[a].name] = arr[a].value
            }
            //console.log(obj)
            $.ajax({
                url: '../user/masters/locations/location-addresses/add-new-action',
                type: 'POST',
                data: obj,
                success: function(data) {
                    // alert(data)
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                    }
                    alert(data.message);
                    if (data.status) {
                       window.opener.location.reload();
                       window.close()
                        wait_to_submit_btn('#submit', 'SAVE')
                    } else {
                        wait_to_submit_btn('#submit', 'SAVE')
                    }
                }
            })
        }
        return false
    }
</script>

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>