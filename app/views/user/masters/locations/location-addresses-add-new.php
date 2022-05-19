<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>

<section class="lg-form-outer">
  <div class="lg-form-header">ADD NEW LOCATION ADDRESS</div>

  <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">
    <section>
      <div style="float: right !important; display:flex;">
        <div>
          <?php
          if (in_array('P0178', USER_PRIV)) {
            // echo "<span style='cursor:pointer;margin-right:10px;' class='btn_green' data-add-city style='width:150px;height:40px;'>Add New Stop Off</span>";
            echo "<button class='btn_grey button_href' style='margin-right:10px;' data-add-city><a>Add New Stop Off</a></button>";
          }
          ?>
        </div>
        <div>
          <?php
          if (in_array('P0178', USER_PRIV)) {
            echo "<button class='btn_grey button_href'><a href='../user/masters/locations/location-addresses/add-new-manual'>Add New Location Manually</a></button>";
          }
          ?>
        </div>
      </div>
    </section>
    <br>
    <section class="section-11">
      <div>
        <fieldset>
          <legend>Location Address</legend>
          <div class="field-section single-column">
            <div class="field-p" id="address_as_per_google"></div>
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
        url: window.location.href + '-action',
        type: 'POST',
        data: obj,
        success: function(data) {
         // alert(data)
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message);
          if (data.status) {
            location.href = '../user/masters/locations/location-addresses';
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
  $(document).on("click", "[data-add-city]", function() {
    open_child_window({
      url: '../user/masters/locations/stopoff/quick-add-new',
      name: 'AddStopOff',
      width: 500,
      height: 500
    })
  });
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>