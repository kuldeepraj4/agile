<?php
require_once APPROOT . '/views/includes/user/header.php';

// echo "<pre>";
// print_r($data);
// echo "</pre>";

$details = $data['details'];
if ($details['latitude'] != "") {
  $latitude = $details['latitude'];
} else {
  $latitude = 30.3540629;
}
if ($details['longitude'] != "") {
  $longitude = $details['longitude'];
} else {
  $longitude = 76.3974363;
}

?>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">UPDATE LOCATION - <?php echo $details['id']; ?></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">

    <input hidden="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">

    <section class="section-11">
      <div>
        <fieldset>
          <legend>Location Address</legend>
          <div class="field-section single-column">
            <div class="field-p" id="address_as_per_google"></div>
            <div id="span" style="visibility: hidden;height:0px;width:0px;"></div>
            <input type="hidden" name="latitude" value="<?php echo $latitude; ?>">
            <input type="hidden" name="longitude" value="<?php echo $longitude; ?>">
            <div class="field-p">
              <label>Location Name</label>
              <div><?php echo $details['name'] ?></div>
              <!-- <input type="text" name="name" value="<?php //echo $details['name'] 
                                                          ?>" required> -->
            </div>

            <div class="field-p">
              <label>Address Line</label>
              <div><?php echo $details['address_line'] ?></div>
              <!-- <input type="text" name="address_line" value="<?php //echo $details['address_line'] 
                                                                  ?>" required> -->
            </div>
            <div class="field-p">
              <label>City</label>
              <div><?php echo $details['city'] ?></div>
              <!-- <input type="text" name="city" value="<?php //echo $details['city'] 
                                                          ?>" required> -->
            </div>
            <div class="field-p">
              <label>State</label>
              <div><?php echo $details['state'] ?></div>
              <!-- <input type="text" name="state" value="<?php //echo $details['state'] 
                                                          ?>" required> -->
            </div>
            <div class="field-p">
              <label>Zipcode</label>
              <div><?php echo $details['zipcode'] ?></div>
              <!-- <input type="text" name="zipcode" value="<?php // echo $details['zipcode'] 
                                                            ?>" required> -->
            </div>
            <div class="field-p">
              <label>Phone Number</label>
              <input type="text" name="phone_number" value="<?php echo $details['phone_number'] ?>">
            </div>
            <div class="field-p">
              <label>Fax Number</label>
              <input type="text" name="fax_number" value="<?php echo $details['fax_number'] ?>">
            </div>
            <div class="field-p">
              <label>Sales Representative</label>
              <input type="text" name="sales_respresentative" value="<?php echo $details['sales_respresentative'] ?>">
            </div>
            <div class="field-p">
              <label>Customer service Representative</label>
              <input type="text" name="customer_service_respresentative" value="<?php echo $details['customer_service_respresentative'] ?>">
            </div>
            <div class="field-p">
              <label>Hours of operation</label>
              <input type="text" name="hours_of_operation" value="<?php echo $details['hours_of_operation'] ?>">
            </div>
            <div class="field-p">
              <label>Remarks</label>
              <textarea name="remarks" style="height:80px"><?php echo $details['remarks'] ?></textarea>
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

  function add_new() {
    submit_to_wait_btn('#submit', 'loading')

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
        url: window.location.pathname + '-action',
        type: 'POST',
        data: obj,
        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message);
          if (data.status) {
            location.href = "../user/masters/locations/location-addresses";
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
<!-- ---------------GOOGLE API START HERE-------------GOOGLE API START HERE--------------------------------- -->
<script type="text/javascript">
  var autocomplete;

  function activatePlacesSearch() {
    console.log("working")
    // var input = document.getElementById('search_item')
    //autocomplete = new google.maps.places.Autocomplete(input)
    //autocomplete.addListener("place_changed", fillInAddress);
  }

  // function fillInAddress() {
  //   // Get the place details from the autocomplete object.
  //   const place = autocomplete.getPlace();
  //   //console.log(place)
  //   //console.log(place.address_components)
  //   //console.log(place.address_components[5].types[0])
  //   //console.log(place.address_components.length)
  //   address_length = place.address_components.length;
  //   var zipcode = "";
  //   for(i=0; i<address_length; i++){
  //     if(place.address_components[i].types[0]=="postal_code"){
  //     zipcode = place.address_components[i].long_name;
  //   }
  // }
  //   var google_place_id = place.place_id;
  //   latitude = place.geometry['location'].lat();
  //   longitude = place.geometry['location'].lng();
  //   var adr = place.adr_address;
  //   $('#span').html(adr)
  //   if($(".region").length){
  //     var state = $('.region').html()
  //   }else{
  //     var state = "";
  //   }
  //   if($(".locality").length){
  //     var city = $('.locality').html()
  //   }else{
  //     var city = "";
  //   }
  //   if($(".country-name").length){
  //     var country = $('.country-name').html();
  //   }else{
  //     var country = "";
  //   }
  //   var state_trim = state.trim();
  //   var city_trim = city.trim();
  //   var zipcode_trim = zipcode.trim();
  //   var country_trim = country.trim();
  //   var formatted_address = place.formatted_address;
  //   var new_formatted_address_array = [];
  //   var formatted_address_array = formatted_address.split(",")
  //   $.each(formatted_address_array, function(key, value) {
  //     var val = value.trim();
  //     if (val == city_trim) {

  //       return false;
  //     }
  //     new_formatted_address_array.push(val)
  //   })
  //   var address_line_new = new_formatted_address_array.toString();
  //   if ($(".street-address").length) {
  //     var street_address = $('.street-address').html();
  //   } else {
  //     var street_address = "";
  //   }
  //   if ($(".extended-address").length) {
  //     var extended_address = $('.extended-address').html();
  //   } else {
  //     var extended_address = "";
  //   }

  //   $('[name="google_place_id"]').val(google_place_id);
  //   $('[name="latitude"]').val(latitude);
  //   $('[name="longitude"]').val(longitude);

  //   $('[name="address_line"]').val(address_line_new);
  //   $('[name="city"]').val(city_trim);
  //   $('[name="state"]').val(state_trim);
  //   $('[name="zipcode"]').val(zipcode_trim);
  //   $('[name="address_as_per_google"]').val(formatted_address);
  //   $('#address_as_per_google').html('Address as per Google:  '+formatted_address);
  //   initialize()
  //}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAg2C9RCeB_ViJ875s_iF-yO1m-TnLjj0&libraries=places&callback=activatePlacesSearch">
</script>
<script>
  function initialize() {
    if($('[name="latitude"]').val() != ""){
      var latitude = $('[name="latitude"]').val();
    }else{
      var latitude = 30.3540629;
    }
    if($('[name="longitude"]').val() != ""){
      var longitude = $('[name="longitude"]').val();
    }else{
      var longitude = 76.3974363;
    }
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
  // window.addEventListener('load',initialize)
</script>
<script>
  initialize();
</script>
<!-- -------------------GOOGLE API END HERE-------------------GOOGLE API END HERE--------------------------------------- -->

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>