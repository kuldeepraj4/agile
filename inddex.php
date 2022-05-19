<?php
//$con=mysqli_connect("localhost","root","","sigealogistics_sws_new_v1");
//error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sigealogistics_sws_new_v1";
// Create connection to database
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    //die("Connection failed: " . mysqli_connect_error());
}

$get_last_id = mysqli_query($conn, "SELECT `location_id` FROM `locations` ORDER BY `auto` DESC LIMIT 1");
$next_id = (mysqli_num_rows($get_last_id) == 1) ? (mysqli_fetch_assoc($get_last_id)['location_id']) + 1 : 0;
///-----//Generate New Unique Id
$q = mysqli_query($conn, "SELECT `location_id`, `zipcode` FROM `a_zip_dumy`");
// $q = mysqli_query($conn, "SELECT `location_id`, `location_name`, `city`, `zipcode`, `loc_id` FROM `locations` LEFT JOIN `a_zip_dumy` ON `a_zip_dumy`.`loc_id`=`locations`.`location_id`");

//if (mysqli_num_rows($q) < 1) {
// $rows = mysqli_fetch_assoc($q);
while ($rows = mysqli_fetch_assoc($q)) {
    $city_id = $rows['location_id'];
     $loc_name = $rows['zipcode'];

    $q2 = mysqli_query($conn, "SELECT `location_id` FROM `locations` WHERE `location_name`='$loc_name'");
    if (mysqli_num_rows($q2) < 1) {
        $insert = mysqli_query($conn, "INSERT INTO `locations`(`location_id`,`location_name`,`location_type`, `location_city_id_fk`,`location_state_id_fk`,`location_country_id_fk`, `location_status`) VALUES ('$next_id','$loc_name','ZIPCODE','$city_id','0','0','ACT')");
    }
    $next_id++;
    //  echo $city_id." ".$loc_name." ".$location_name."<br>";
    // // echo $rows["location_name"] . "<br>";
    //  $insert = mysqli_query($conn, "INSERT INTO `locations`(`location_id`,`location_name`,`location_type`, `location_city_id_fk`,`location_state_id_fk`,`location_country_id_fk`, `location_status`) VALUES ('$next_id','$loc_name','ZIPCODE','$city_id','0','0','ACT')");
    //echo $next_id;
    //$next_id++;
}
//}
