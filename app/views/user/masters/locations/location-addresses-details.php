<?php
require_once APPROOT.'/views/includes/user/header.php';
/*
echo "<pre>";
print_r($data);
echo "</pre>";
*/
$details=$data['details']; 

?>
<br><br>
<section class="lg-form-outer">
  <div class="lg-form-header">VIEW - LOCATION ID -  <?php echo $details['id']; ?></div>
  <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">


    <section class="section-11">     
      <div>
        <fieldset>
          <legend>Location Address</legend>
          <div class="field-section single-column">

            <div class="field-p">
              <label>Location Name</label>
              <div><?php echo $details['name'] ?></div>
            </div>

            <div class="field-p">
              <label>Address Line</label>
              <div><?php echo $details['address_line'] ?></div>
            </div>
            <div class="field-p">
              <label>City</label>
              <div><?php echo $details['city'] ?></div>
            </div>       
            <div class="field-p">
              <label>State</label>
              <div><?php echo $details['state'] ?></div>
            </div>
            <div class="field-p">
              <label>Zipcode</label>
              <div><?php echo $details['zipcode'] ?></div>
            </div>
            <div class="field-p">
              <label>Phone Number</label>
              <div><?php echo $details['phone_number'] ?></div>
            </div>
            <div class="field-p">
              <label>Fax Number</label>
              <div><?php echo $details['fax_number'] ?></div>
            </div>
            <div class="field-p">
              <label>Sales Representative</label>
              <div><?php echo $details['sales_respresentative'] ?></div>
            </div>
            <div class="field-p">
              <label>Customer service Representative</label>
              <div><?php echo $details['customer_service_respresentative'] ?></div>
            </div>
            <div class="field-p">
              <label>Hours of operation</label>
              <div><?php echo $details['hours_of_operation'] ?></div>
            </div>
            <div class="field-p">
              <label>Remarks</label>
              <div><?php echo $details['remarks'] ?></div>
              </textarea>
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

  </form>
</section>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAg2C9RCeB_ViJ875s_iF-yO1m-TnLjj0&libraries=places">
    </script>
<script>
        function initialize() {
          var latitude = "<?php echo $details['latitude'] ?>";
          var longitude = "<?php echo $details['longitude'] ?>";
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
        //initialize();
    </script>
<!-- -------------------GOOGLE API END HERE-------------------GOOGLE API END HERE--------------------------------------- -->
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>