<ul id="menu-main">
  <?php
  if(in_array('P0338',USER_PRIV)){



    ?>
     <li><a  href="../user/safety/dashboard">Dashboard</a></li>
    
        <?php
        if(in_array('P0150', USER_PRIV) || in_array('P0155', USER_PRIV) || in_array('P0167', USER_PRIV) || in_array('P0359', USER_PRIV) || in_array('P0364', USER_PRIV) || in_array('P0369', USER_PRIV) || in_array('P0374', USER_PRIV)){
          ?>
          <li><a>Master</a>
      <ul>
        <?php  if(in_array('P0150', USER_PRIV) || in_array('P0155', USER_PRIV) || in_array('P0167', USER_PRIV) ){ ?>
          <li><a class="third-nav">Document types</a>
            <ul>
              <?php
              echo (in_array('P0150', USER_PRIV)) ? '<li><a href="../user/masters/drivers/document-types">Drivers </a></li>':"";
              echo (in_array('P0155', USER_PRIV)) ? '<li><a href="../user/masters/trucks/document-types">Trucks</a></li>':"";
              echo (in_array('P0167', USER_PRIV)) ? '<li><a href="../user/masters/trailers/document-types">Trailers</a></li>':"";
              ?>
            </ul>
          </li>
        <?php 
              
              }
        
        echo (in_array('P0359', USER_PRIV)) ? '<li><a href="../user/masters/drivers/drivers-leave-list">Driver Leave</a></li>':"";
        echo (in_array('P0364', USER_PRIV)) ? '<li><a href="../user/masters/driver-teams/list">Driver Teams</a></li>':"";

        
          if(in_array('P0369', USER_PRIV)){
          ?>
          <li><a class="third-nav">Engine Hours Status</a>
            <ul>
              <?php
              echo (in_array('P0370', USER_PRIV)) ? '<li><a href="../user/masters/trucks/engine-hours-status">Trucks</a></li>':"";
              echo (in_array('P0372', USER_PRIV)) ? '<li><a href="../user/masters/trailers/engine-hours-status">Trailers</a></li>':"";
              ?>
            </ul>
          </li>
        <?php   } 
         echo (in_array('P0374', USER_PRIV)) ? '<li><a href="../user/masters/trucks/odometer-status">Truck Odometer Status</a></li>':"";
         ?> 

      </ul>
    </li>


    <?php 
  
}
    if(in_array('P0007',USER_PRIV) || in_array('P0339',USER_PRIV) || in_array('P0102',USER_PRIV) || in_array('P0380',USER_PRIV)){ 
    ?>
   
    <li><a>Drivers</a>
      <ul>
        <?php
        echo (in_array('P0007', USER_PRIV)) ? '<li><a href="../user/masters/drivers">Drivers</a></li>':"";
        echo (in_array('P0339', USER_PRIV)) ? '<li><a href="../user/masters/drivers/all-drivers-documents">All Driver Documents</a></li>':"";
        echo (in_array('P0102', USER_PRIV)) ? '<li><a href="../user/masters/drivers/checklists">Check list</a></li>':"";
        echo (in_array('P0380', USER_PRIV)) ? '<li><a href="../user/masters/drivers/team-wise-list">Team Wise List</a></li>':"";
        ?>   
      </ul>
    </li>
<?php 
}
    if(in_array('P0017',USER_PRIV) || in_array('P0340',USER_PRIV)){ 
    ?>

    <li><a>Trucks</a>
      <ul>
        <?php
        echo (in_array('P0017', USER_PRIV)) ? '<li><a  href="../user/masters/trucks">Trucks</a></li>':"";
        echo (in_array('P0340', USER_PRIV)) ? '<li><a href="../user/masters/trucks/all-trucks-documents">All Trucks Documents</a></li>':"";
       // echo (in_array('P0017', USER_PRIV)) ? '<li><a href="../user/masters/trucks/locations">Truck Locations</a></li>':"";
        ?>

      </ul>
    </li>

    <?php 
  }
    if(in_array('P0022',USER_PRIV) || in_array('P0341',USER_PRIV) || in_array('P0387',USER_PRIV)){ 
    ?>
    <li><a>Trailers</a>
      <ul>
        <?php
        echo (in_array('P0024', USER_PRIV)) ? '<li><a  href="../user/masters/trailers">Trailers</a></li>':"";
        echo (in_array('P0341', USER_PRIV)) ? '<li><a href="../user/masters/trailers/all-trailers-documents">All Trailers Documents</a></li>':"";
        //echo (in_array('P0387', USER_PRIV)) ? '<li><a href="../user/masters/trailers/locations">Trailer Locations</a></li>':""; 
        ?>

      </ul>
    </li>
  </ul>
</li>
<?php
}
}
?>
</ul> 