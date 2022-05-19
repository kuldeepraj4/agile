<ul id="menu-main">
<?php
  if(in_array('P0012',USER_PRIV) || in_array('P0237',USER_PRIV)){
?>
  <li><a>Location</a>
    <ul>
      <?php if(in_array('P0012',USER_PRIV)){ ?>
      <li><a href="../user/masters/locations/zipcodes">ZIP Code</a></li>
      <li><a href="../user/masters/locations/cities">City</a></li>
      <li><a href="../user/masters/locations/states">State</a></li>
      <li><a href="../user/masters/locations/countries">Country</a></li>     
      <?php } ?> 
      <?php echo (in_array('P0237', USER_PRIV)) ? '<li><a href="../user/masters/locations/location-addresses">Addresses</a></li>':""; ?> 
      <?php echo (in_array('P0237', USER_PRIV)) ? '<a href="../user/masters/locations/old-location-addresses">OLD Addresses</a></li> ':""; ?>        
    </ul>
  </li>
<?php
  }

if(in_array('P0052', USER_PRIV) || in_array('P0057', USER_PRIV) || in_array('P0027', USER_PRIV) || in_array('P0072', USER_PRIV) || in_array('P0037', USER_PRIV) || in_array('P0042', USER_PRIV) || in_array('P0062', USER_PRIV) || in_array('P0067', USER_PRIV) || in_array('P0077', USER_PRIV)){
?>
  <li><a>Vehicles</a>
    <ul>
      <?php
    echo (in_array('P0052', USER_PRIV)) ? '<li><a href="../user/masters/vehicles/makers">Makers</a></li>':"";
    echo (in_array('P0057', USER_PRIV)) ? '<li><a href="../user/masters/vehicles/models">Models</a></li>':"";
    echo (in_array('P0027', USER_PRIV)) ? '<li><a href="../user/masters/vehicles/status">Status</a></li>':"";
    echo (in_array('P0072', USER_PRIV)) ? '<li><a href="../user/masters/vehicles/insurance-companies">Insurance companies</a></li>':"";
    echo (in_array('P0037', USER_PRIV)) ? '<li><a href="../user/masters/vehicles/ownership-types">Ownership types</a></li>':"";
    echo (in_array('P0042', USER_PRIV)) ? '<li><a href="../user/masters/vehicles/lease-companies">Lease companies</a></li>':"";
    echo (in_array('P0062', USER_PRIV)) ? '<li><a href="../user/masters/vehicles/device-companies">Device companies</a></li>':"";
    echo (in_array('P0067', USER_PRIV)) ? '<li><a href="../user/masters/vehicles/colors">Colors</a></li>':"";
    echo (in_array('P0077', USER_PRIV)) ? '<li><a href="../user/masters/trailers/reefer-companies">Reefer Companies</a></li>':"";
      ?>   
    </ul>
  </li>
<?php
 }

if(in_array('P0082', USER_PRIV) || in_array('P0087', USER_PRIV) || in_array('P0092', USER_PRIV)){
?>


 <li><a>Employees</a>
    <ul>
      <?php
    echo (in_array('P0082', USER_PRIV)) ? '<li><a href="../user/masters/employees/status">Status</a></li>':"";
    echo (in_array('P0087', USER_PRIV)) ? '<li><a href="../user/masters/employees/prefix">Prefix</a></li>':"";
    echo (in_array('P0092', USER_PRIV)) ? '<li><a href="../user/masters/employees/residency">Residency</a></li>':"";
        
      ?>   
    </ul>
  </li>
<?php
 }

if(in_array('P0097', USER_PRIV) || in_array('P0107', USER_PRIV)){
?>


  <li><a>General</a>
    <ul>
      <?php
    echo (in_array('P0097', USER_PRIV)) ? '<li><a href="../user/masters/mobile-country-codes">Mobile country codes</a></li>':"";
    echo (in_array('P0107', USER_PRIV)) ? '<li><a href="../user/masters/route-types">Route types</a></li>':"";
      ?>   
    </ul>
  </li> 
<?php
  
}
  if(in_array('P0002',USER_PRIV)){
?>
  <li><a>Users</a>
    <ul>
      
       <?php
      echo (in_array('P0004', USER_PRIV)) ? '<li><a href="../user/masters/users">Users</a></li>':"";
      echo (in_array('P0319', USER_PRIV)) ? '<li><a href="../user/masters/users/department">Department</a></li>':"";
      echo (in_array('P0323', USER_PRIV)) ? '<li><a href="../user/masters/users/designation">Designation</a></li>':"";
      echo (in_array('P0137', USER_PRIV)) ? '<li><a href="../user/masters/users/roles-groups">Roles groups</a></li>':"";
      ?>

            
    </ul>
  </li>
<?php
}
  if(in_array('P0343',USER_PRIV) || in_array('P0129', USER_PRIV) || in_array('P0354', USER_PRIV)){
?>
  <li><a>Trips</a>
    <ul>
      
       <?php
       echo (in_array('P0354', USER_PRIV)) ? '<li><a href="../user/masters/drivers/ppm-plans">PPM plans</a></li>':"";
      echo (in_array('P0345', USER_PRIV)) ? '<li><a href="../user/accounts/trip-stop-types">Stop types</a></li> ':"";
      echo (in_array('P0129', USER_PRIV)) ? '<li><a href="../user/masters/employees/salary-parameters">Salary parameter</a></li>':"";
      ?>

            
    </ul>
  </li>
<?php } ?>


      
        <?php
echo (in_array('PADMIN', USER_PRIV)) ? '<li><a>Hierarchy</a>
    <ul>
      <li><a href="../user/masters/hierarchy/levels">Levels</a></li>     
    </ul>
  </li>':"";
      ?>
    
<?php
  
 ?>       
</ul> 