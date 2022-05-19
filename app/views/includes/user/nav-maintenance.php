<ul id="menu-main">
  <?php  if(in_array('P0190', USER_PRIV) || in_array('P0195', USER_PRIV) || in_array('P0393', USER_PRIV) || in_array('P0201', USER_PRIV) || in_array('P0221', USER_PRIV) || in_array('P0206', USER_PRIV) || in_array('P0211', USER_PRIV) || in_array('P0216', USER_PRIV) || in_array('P0313', USER_PRIV) || in_array('P0308', USER_PRIV) || in_array('P0328', USER_PRIV) || in_array('P0282', USER_PRIV) || in_array('P0295', USER_PRIV)){ ?>
  <li><a>Masters</a>

    <ul>
     <?php
     echo (in_array('P0190', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/repair-order-type">Repair Order Type</a></li>' : "";
     echo (in_array('P0195', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/repair-order-stage">Repair Order Stage</a></li>' : "";
     echo (in_array('P0393', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/repair-order-rfc-error">Repair Order RFC Reason</a></li>' : "";
     echo (in_array('P0328', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/violation-reported">Violation Reported</a></li>' : "";
     echo (in_array('P0221', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/vendor">Vendor</a></li>' : "";
     echo (in_array('P0206', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/job-work-type">Job Work Type</a></li>' : "";
     echo (in_array('P0211', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/job-work">Job Work</a></li>' : "";
     echo (in_array('P0216', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/preventive-maintenance">Preventive Maintenance</a></li>' : "";
     echo (in_array('P0313', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/incident-documents">Incidents Documents</a></li>' : "";
     echo (in_array('P0308', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/claim-type">Claim Type</a></li>' : "";
     echo (in_array('P0328', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/violation-reported">Violation Reported</a></li>' : "";
     ?>
       <?php if(in_array('P0282', USER_PRIV)){ ?>
     <li>
      <a class="third-nav">Fault Reason</a>
      <ul>
        <?php
        echo (in_array('P0284', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/fault-reason">Drivers</a></li>' : "";
        echo (in_array('P0288', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/fault-reason-trucks">Trucks</a></li>' : "";
        echo (in_array('P0292', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/fault-reason-trailers">Trailers</a></li>' : "";
        ?>
      </ul>         
    </li>
       <?php } if(in_array('P0295', USER_PRIV)){ ?>
    <li>
      <a class="third-nav">Corrective Action</a>
      <ul>
        <?php
        echo (in_array('P0297', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/corrective-action">Drivers</a></li>' : "";
        echo (in_array('P0301', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/corrective-action-trucks">Trucks</a></li>' : "";
        echo (in_array('P0305', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/corrective-action-trailers">Trailers</a></li>' : "";
        ?>
      </ul>         
    </li>
    <?php
      echo (in_array('P0216', USER_PRIV)) ? '<li><a href="../user/maintenance/masters/yard-maintenance">Yard Maintenance</a></li>' : "";
    ?>
     <?php } ?>
  </ul>
</li>
<?php } if(in_array('P0228', USER_PRIV)){
  ?>


<li><a>Dashboard</a>
  <ul>
    <li><a href="../user/maintenance/maintenance-dashboard">Dashboard - Scheduled/Un-scheduled</a></li>
    <li><a href="../user/maintenance/maintenance-dashboard-schedule">Dashboard - Scheduled</a></li>
    <li><a href="../user/maintenance/maintenance-dashboard-unschedule">Dashboard - Un-scheduled</a></li>
  </ul>
</li>
<?php } if(in_array('P0226', USER_PRIV)){ ?>
 <li><a>Repair Orders</a>
  <ul>
    <?php
    echo (in_array('P0226', USER_PRIV)) ? '<li> <a href="../user/maintenance/repair-orders">Repair Orders</a></li>': "";
    echo (in_array('P0226', USER_PRIV)) ? ' <li><a href="../user/maintenance/repair-orders-history-rfc">Repair Orders RFC Details</a></li>' :  "";
    ?>
  </ul>
</li> 

<?php
}
    // echo (in_array('P0226', USER_PRIV)) ? '<li>
    // <a href="../user/maintenance/repair-orders">Repair Orders</a><ul><li><a href="../user/maintenance/repair-orders-history-rfc">Repair Orders RFC</a></li></ul>' : "";

 ?>

<!-- <li><a>Work Orders</a>
  <ul>
    <?php
    echo (in_array('P0231', USER_PRIV)) ? '<li><a href="../user/maintenance/work-orders">Work Orders</a></li>' : "";
    ?>
  </ul>
</li> -->

<?php
  echo (in_array('P0231', USER_PRIV)) ? '<li><a href="../user/maintenance/work-orders">Work Orders</a></li>' : "";
?>
 <?php  if(in_array('P0386', USER_PRIV)){ ?>
<li><a>Preventive Maintenance Alert</a>
  <ul>
   <?php  echo (in_array('P0384', USER_PRIV)) ? '<li><a href="../user/maintenance/preventive-maintenance/trucks-alert">Trucks</a></li>': "";
   echo (in_array('P0385', USER_PRIV)) ? ' <li><a href="../user/maintenance/preventive-maintenance/trailers-alert">Trailer</a></li>': ""; ?>
  </ul>
</li>
 <?php } ?>
<!-- <li><a>Inspections</a>
  <ul>
    <?php
    echo (in_array('P0265', USER_PRIV)) ? '<li><a href="../user/maintenance/inspection-sheet">Inspections</a></li>' : "";
    ?>
  </ul>
</li> -->

<?php
  echo (in_array('P0265', USER_PRIV)) ? '<li><a href="../user/maintenance/inspection-sheet">Inspections</a></li>' : "";
?>

<!-- <li><a>Incidents</a>
  <ul>
    <?php
    echo (in_array('P0277', USER_PRIV)) ? '<li><a href="../user/maintenance/incidents">Incidents</a></li>' : "";
    ?>            
  </ul>
</li> -->

<?php
    echo (in_array('P0277', USER_PRIV)) ? '<li><a href="../user/maintenance/incidents">Incidents</a></li>' : "";
?>

<!-- <li><a>Claims</a>
  <ul>
    <?php
    echo (in_array('P0308', USER_PRIV)) ? '<li><a href="../user/maintenance/claims">Claims</a></li>' : "";
    ?>            
  </ul>
</li> -->

<?php
   echo (in_array('P0308', USER_PRIV)) ? '<li><a href="../user/maintenance/claims">Claims</a></li>' : "";
?>

  <li><a>Reports</a>
    <ul>
        <li><a href="../user/maintenance/repair-orders-search">Repair Order Search</a></li>
        <li><a href="../user/maintenance/repair-orders-report">Repair Order Report</a></li>
    </ul>
  </li>



</ul>