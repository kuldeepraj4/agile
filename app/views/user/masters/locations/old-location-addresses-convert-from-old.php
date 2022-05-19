<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];

// echo '<pre>';
// print_r($details);
// echo '</pre>';
// exit;
if (isset($_GET['eid'])) {
    $old_address_eid = $_GET['eid'];
} else {
    $old_address_eid = '';
}
?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">CONVERT OLD LOCATION TO NEW LOCATION ADDRESS</div>
    <br>
    <div style="text-align:center;">
        <div class="field-p">
            <label>Old Name</label>
            <input style="min-width:400px;" type="text" value="<?php echo $details['name']; ?>">&nbsp;&nbsp;
            <label>Old Address</label>
            <input style="min-width:400px;" type="text" id="address" value="<?php echo $details['address']; ?>"><button id="copy" class="btn_green">Copy to Search</button>&nbsp;&nbsp;<br><br>
            <label>Old City</label>
            <input style="min-width:300px;" type="text" value="<?php echo $details['city']; ?>">&nbsp;&nbsp;
            <label>Old State</label>
            <input style="min-width:300px;" type="text" value="<?php echo $details['state']; ?>">&nbsp;&nbsp;
            <label>Old Zipcode</label>
            <input style="min-width:300px;" type="text" value="<?php echo $details['zipcode']; ?>">
        </div>
    </div>
    <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">
        <section class="section-11">
            <div>
                <fieldset>
                    <legend>Location Address</legend>
                    <div class="field-section single-column">
                        <div class="field-p" id="address_as_per_google"></div>
                        <input type="hidden" name="old_address_eid" value="<?php echo $old_address_eid; ?>">
                        <div id="span" style="visibility: hidden;height:0px;width:0px;"></div>
                        <input type="hidden" name="google_place_id" required="required">
                        <!-- <input type="hidden" name="state_shortname" required="required"> -->
                        <input type="hidden" name="latitude" required="required">
                        <input type="hidden" name="longitude" required="required">
                        <input type="hidden" name="address_as_per_google">
                        <div class="field-p">
                            <label>Search</label>
                            <input type="text" id="search_item" name="" class="Autocomplete">
                        </div>
                        <div class="field-p">
                            <label>Location Name</label>
                            <input type="text" name="name" required="required">
                        </div>
                        <div class="field-p">
                            <label>Address Line</label>
                            <input type="text" name="address_line" required>
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
                        <div class="field-p">
                            <label>Phone Number</label>
                            <input type="text" name="phone_number">
                        </div>
                        <div class="field-p">
                            <label>Fax Number</label>
                            <input type="text" name="fax_number">
                        </div>
                        <div class="field-p">
                            <label>Sales Representative</label>
                            <input type="text" name="sales_respresentative">
                        </div>
                        <div class="field-p">
                            <label>Customer service Representative</label>
                            <input type="text" name="customer_service_respresentative">
                        </div>
                        <div class="field-p">
                            <label>Hours of operation</label>
                            <input type="text" name="hours_of_operation">
                        </div>
                        <div class="field-p">
                            <label>Remarks</label>
                            <textarea name="remarks" style="height:80px"></textarea>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div>
                <div style="width:100%;height:100%;border:1px solid grey;">
                    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13771.561838154592!2d76.3974363!3d30.3540629!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3e9fcdc279398431!2sSIGEA%20SOLUTIONS!5e0!3m2!1sen!2sin!4v1631860245440!5m2!1sen!2sin" style="border:0; width: 100%;height: 100%;" allowfullscreen="" loading="lazy"></iframe> -->
                    <div id="map" style="border:0; width: 100%;height: 100%;"></div>
                </div>
            </div>
        </section>
        <section class="action-button-box">
            <button type="submit" class="btn_green" data-action="reject">REJECT</button>&nbsp;&nbsp;
            <button type="submit" class="btn_green">SAVE</button>
            <button type="button" class="btn_green" onclick="back_alert()" style="margin-left: 10px;">BACK</button>
        </section>
    </form>
</section>
<script type="text/javascript">
    function back_alert() {
        if (confirm('Are you Sure ?')) {
            window.history.back();
        }
    }
</script>
<script type="text/javascript">
    $(document.body).on('click', '#copy', function() {
        $copy_address = $('#address').val();
        $('#search_item').val($copy_address);
        $("#search_item").focus();
    })
</script>
<!-- ---------------GOOGLE API START HERE-------------GOOGLE API START HERE--------------------------------- -->
<script type="text/javascript">
    var autocomplete;
    var latitude = 30.3540629;
    var longitude = 76.3974363;

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
        var country_trim = country.trim();
        var formatted_address = place.formatted_address;
        var new_formatted_address_array = [];
        var formatted_address_array = formatted_address.split(",")
        $.each(formatted_address_array, function(key, value) {
            var val = value.trim();
            if (val == city_trim) {
                //var ind = key
                return false;
            }
            new_formatted_address_array.push(val)
        })
        var address_line_new = new_formatted_address_array.toString();
        if ($(".street-address").length) {
            var street_address = $('.street-address').html();
        } else {
            var street_address = "";
        }
        if ($(".extended-address").length) {
            var extended_address = $('.extended-address').html();
        } else {
            var extended_address = "";
        }
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
        $('[name="address_line"]').val(address_line_new);
        $('[name="city"]').val(city_trim);
        $('[name="state"]').val(state_trim);
        $('[name="zipcode"]').val(zipcode_trim);
        $('[name="address_as_per_google"]').val(formatted_address)
        $('#address_as_per_google').html('<b>Address as per Google:</b>  ' + formatted_address)
        initialize()
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAg2C9RCeB_ViJ875s_iF-yO1m-TnLjj0&libraries=places&callback=activatePlacesSearch">
</script>
<script>
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
</script>
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
            $.ajax({
                url: '../user/masters/locations/location-addresses/add-new-action',
                type: 'POST',
                data: obj,
                success: function(data) {
                    //alert(data)
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                    }
                    alert(data.message);
                    if (data.status) {
                        //location.href = '../user/masters/locations/old-location-addresses';
                        window.history.back();
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
<script type="text/javascript">
    function show_employee_status() {
        get_employees_status().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('[name="status_id"]').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_employee_status()
</script>
<script type="text/javascript">
    function show_driver_groups() {
        get_driver_groups().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('[name="group_id"]').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_driver_groups()
</script>
<script type="text/javascript">
    function show_route_types() {
        get_route_types().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('[name="route_type_id"]').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_route_types()
</script>
<script type="text/javascript">
    function show_mobile_country_code() {
        get_mobile_country_codes().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('[name="mobile_country_code_id"]').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_mobile_country_code()
</script>
<!-- <script type="text/javascript">
    function show_employee_prefix() {
        get_employees_prefix().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('[name="prefix_id"]').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_employee_prefix()
</script> -->
<script type="text/javascript">
    function show_cdl_states() {
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
                    $('[name="cdl_state_id"]').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_cdl_states()
</script>
<script type="text/javascript">
    function show_addess_states() {
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
                    $('[name="address_state_id"]').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_addess_states()
</script>
<script type="text/javascript">
    function show_addess_cities(param) {
        get_cities(param).then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('[name="address_city_id"]').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
</script>
<script type="text/javascript">
    function show_address_zipcodes(param) {
        get_zipcodes(param).then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('[name="address_zipcode_id"]').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
</script>
<!-- <script type="text/javascript">
    function show_companies_options() {
        get_companies().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('[name="company_id"]').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_companies_options()
</script> -->
<!-- <script type="text/javascript">
    function show_truck_id_options() {
        get_trucks().then(function(data) {
            // console.log(data)
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.code + `</option>`;
                    })
                    $('[name="assigned_truck_id"]').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_truck_id_options()
</script> -->
<!-- <script type="text/javascript">
    function show_residency_options() {
        get_employees_residency().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('[name="residency_id"]').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_residency_options()
</script> -->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", "[data-action='reject']", function() {
            if (confirm('Do you want to reject this address location ?')) {
                var eid = "<?php echo $old_address_eid; ?>";
                $.ajax({
                    url: '../user/masters/locations/old-location-addresses/reject-action',
                    type: 'POST',
                    data: {
                        reject_eid: eid
                    },
                    context: this,
                    success: function(data) {
                        if ((typeof data) == 'string') {
                            data = JSON.parse(data)
                        }
                        if (data.status) {
                            alert(data.message)
                            window.history.back()
                        } else {
                            alert(data.message)
                        }
                    }
                });
            }
        });
    });
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>