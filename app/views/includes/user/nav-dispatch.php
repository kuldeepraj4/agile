<ul id="menu-main">

  <?php


  if (in_array('DIS008', USER_PRIV)) {
  ?>
    <li><a>Masters</a>
      <ul>
        <?php
        echo (in_array('DIS009', USER_PRIV)) ? '<li><a  href="../user/dispatch/masters/bill-accessories/list">Bill Accessories</a></li>' : "";
        ?>
      </ul>
    </li>

  <?php
  }

  ?>


  <li><a>Customers</a>
    <ul>
      <?php
      echo (in_array('P0160', USER_PRIV)) ? '<li><a  href="../user/dispatch/customers">List</a></li>' : "";
      ?>
    </ul>
  </li>
  <li><a>Express Loads</a>
    <ul>
      <?php
      echo (in_array('P0176', USER_PRIV)) ? '<li><a  href="../user/dispatch/express-loads">List</a></li>' : "";
      echo '<li><a  href="../user/dispatch/express-loads/approval-status-list">Approval Status</a></li>';
      ?>
    </ul>
  </li>
  <li><a>Loads</a>
    <ul>

      <?php

      echo (in_array('DIS003', USER_PRIV)) ? '<li><a  href="../user/dispatch/loads/list">All Loads</a></li>' : "";
      echo (in_array('DIS003', USER_PRIV)) ? '<li><a  href="../user/dispatch/loads/available-loads">Available Loads</a></li>' : "";
      echo (in_array('DIS003', USER_PRIV)) ? '<li><a  href="../user/dispatch/loads/dispatch-loads">Dispatch Loads</a></li>' : "";
      echo (in_array('DIS003', USER_PRIV)) ? '<li><a  href="../user/dispatch/loads/empty-movements">Empty Movements</a></li>' : "";
      ?>
      <li>
        <a class="third-nav">Long Haul Assignments</a>
        <ul>
          <?php
          echo (in_array('DIS053', USER_PRIV)) ? '<li><a  href="../user/dispatch/long-haul-assignments-driver-wise">Driver Wise</a></li>' : "";
          echo (in_array('DIS053', USER_PRIV)) ? '<li><a  href="../user/dispatch/long-haul-assignments-load-wise">Load Wise</a></li>' : "";
          ?>
        </ul>
      </li>
      <?php
      ?>
    </ul>
  </li>
  <li><a>Planning</a>
    <ul>
      <?php
      echo (in_array('DIS002', USER_PRIV)) ? '<li><a  href="../user/dispatch/sales/planning-list">Sales</a></li>' : "";
      echo '<li><a href="../user/dispatch/trucks-planning">Trucks Planning</a></li>';
      echo '<li><a href="../user/dispatch/trailers-planning">Trailers Planning</a></li>';
      ?>
    </ul>
  </li>

<li><a>Opr. Planning</a>
    <ul>
      <?php
      echo (in_array('DIS053', USER_PRIV)) ? '<li><a  href="../user/dispatch/lh-assignment/driver-wise">LH Assignment</a></li>' : "";
      echo '<li><a href="../user/dispatch/pick-ups">Pick Ups</a></li>';
      echo '<li><a href="../user/dispatch/west-delivery-assignment">West Delivery Assignment</a></li>';
      echo '<li><a href="../user/dispatch/cross-docks">Cross Docks</a></li>';
      ?>
    </ul>
  </li>


  <li style="display:none;"><a>Reporting</a>
    <ul>
      <?php
      echo '<li><a href="../user/dispatch/reporting/reefer-temperature">Reefer Temperature</a></li>';
      ?>
    </ul>
  </li>
  
  <li><a>Driver</a>
    <ul>
      <?php
      echo '<li><a href="../user/masters/drivers/drivers-leave-list">Leave</a></li>';
      ?>
    </ul>
  </li>
  <li><a>Reporting</a>
    <ul>
      <?php
      echo '<li><a href="../user/dispatch/reporting/customer-reporting/list">Customer Reporting</a></li>';
      echo '<li><a href="../user/dispatch/reporting/dispatch-continuity">Dispatch Continuity</a></li>';
      echo '<li><a href="../user/dispatch/reporting/reefer-reporting/list">Reefer Reporting</a></li>';
      ?>
    </ul>
  </li>
  <li><a>Tracking</a>
    <ul>
      <?php
      echo '<li><a href="../user/dispatch/tracking/tracking-loads">Tracking Loads</a></li>';
      echo '<li><a href="../user/dispatch/tracking/tms-tracker">TMS Tracker</a></li>';
      echo '<li><a href="../user/dispatch/tracking/tracking-truck">Truck</a></li>';
      echo '<li><a href="../user/dispatch/tracking/tracking-trailer">Trailer</a></li>';
      echo '<li><a href="../user/dispatch/tracking/tracking-driver">Driver</a></li>';
      echo '<li><a href="../user/dispatch/tracking/trailers/locations">Trailer Locations</a></li>'; 
      ?>
    </ul>
  </li>
  <?php
  if (in_array('DIS006', USER_PRIV)) {

    echo "<li><a>Quality</a>
    <ul>";

    echo '<li><a href="../user/dispatch/quality/load-approval-status">Load Approval Status</a></li>';
    echo "</ul>
    </li>";
  }

  ?>


</ul>