<ul id="menu-main">

  <!--
<?php
// if(in_array('P0118',USER_PRIV)){
?>
  
    <li><a>Trips</a>
    <ul>
      <li><a  href="../user/accounts/trips">Trips</a></li>
      <li><a  href="../user/accounts/trips/drivers-trips-list">Drivers trips list</a></li>
      <li><a  href="../user/accounts/trips/pending-approval">Trips pending approval</a></li>
      <?php
      //echo (in_array('PADMIN', USER_PRIV)) ? '<li><a href="../user/accounts/trip-stop-types">Trip Stop Types</a></li>':"";
      ?>
           
    </ul>

  </li>
<?php
//}
?>
<li><a>Drivers</a>
  
    <ul>
      <li><a  href="../user/accounts/drivers-payments/all-drivers-payment-status">Driver's payment status</a></li>
      <li><a  href="../user/accounts/drivers-payments/payments">Payments</a></li>
      <li><a  href="../user/accounts/drivers-payments/transactions">Transactions</a></li>
      <li><a  href="../user/accounts/drivers-payments/group-transactions">Group transactions</a></li>
      
       <?php
        //echo (in_array('P0125', USER_PRIV)) ? '<li><a  href="../user/accounts/drivers-payments/group-payment-make">Make Group Transaction</a></li>':"";
        ?>     
      
      <li><a  href="../user/accounts/drivers-payments/monthy-hold-incentives-all-drivers">Drivers hold incentive</a></li>
      <li><a  href="../user/accounts/drivers-payments/monthy-hold-incentives-all-drivers-move">Move drivers hold incentive</a></li>
          
    </ul>
</li>-->

  <?php
  if (in_array('P0119', USER_PRIV) || in_array('P0118', USER_PRIV)  || in_array('P0124', USER_PRIV) || in_array('P0127', USER_PRIV) || in_array('P0352', USER_PRIV)) {
  ?>
    <li><a>Settlements</a>

      <ul>
        <?php
        echo (in_array('P0119', USER_PRIV)) ? '<li><a  href="../user/accounts/trips/add-new">Add new trip</a></li>' : "";

        if (in_array('P0118', USER_PRIV)) { ?>
          <li>
            <a class="third-nav">Trips</a>
            <ul>
              <?php
              echo (in_array('P0120', USER_PRIV)) ? '  <li><a  href="../user/accounts/trips">All trips</a></li>' : ""; ?>
              <?php
              echo (in_array('P0123', USER_PRIV)) ? '<li><a href="../user/accounts/trips/pending-approval">Waiting for approval</a></li>' : ""; ?>
            </ul>
          </li>

        <?php }

        if (in_array('P0124', USER_PRIV)) { ?>




          <li>
            <a class="third-nav">Settlement</a>
            <ul>
              <?php
              echo (in_array('P0140', USER_PRIV)) ? '<li><a href="../user/accounts/drivers-payments/all-drivers-payment-status">Driver settlement ledger</a></li>' : ""; ?>

              <?php echo (in_array('P0125', USER_PRIV)) ? '<li><a  href="../user/accounts/drivers-payments/group-payment-make">
      Process settlement</a></li>' : ""; ?>

            </ul>
          </li>


        <?php }

        if (in_array('P0353', USER_PRIV)) { ?>

          <li>
            <a class="third-nav">Reports</a>
            <ul>
              <li><a href="../user/accounts/drivers-payments/payments">All settlement details</a></li>
              <li><a href="../user/accounts/trips/drivers-trips-list">Approved driver trips details</a></li>
              <li><a href="../user/accounts/drivers-payments/transactions">List paid transaction report</a></li>
              <li><a href="../user/accounts/drivers-payments/group-transactions">Group paid transaction report</a></li>
            </ul>
          </li>


        <?php } ?>




        <?php if (in_array('P0127', USER_PRIV)) { ?>

          <li>
            <a class="third-nav">Incentive</a>
            <ul>
              <?php echo (in_array('P0348', USER_PRIV)) ?  '<li><a href="../user/accounts/drivers-payments/monthy-hold-incentives-all-drivers">Drivers incentive report</a></li>' : "";

              echo (in_array('P0128', USER_PRIV)) ? '<li><a href="../user/accounts/drivers-payments/monthy-hold-incentives-all-drivers-move">Process driver incentive</a></li>' : ""; ?>
            </ul>
          </li>

        <?php } ?>




      </ul>
    </li>
  <?php
  }

  if (in_array('P0349', USER_PRIV) || in_array('P0259', USER_PRIV) || in_array('P0262', USER_PRIV)) {
  ?>
    <li><a>Payables</a>
      <ul>

        <?php
        echo (in_array('P0349', USER_PRIV)) ? '<li><a  href="../user/accounts/vendors-payments/vendor-pending-approval">Vendor Waiting For Approval</a></li>' : "";
        ?>

        <?php
        echo (in_array('P0259', USER_PRIV)) ? '<li><a  href="../user/accounts/vendors-payments/vendor-process-payment">Vendor Process Payment</a></li>' : "";
        ?>

        <?php
        echo (in_array('P0262', USER_PRIV)) ? '<li><a  href="../user/accounts/vendors-payments/vendor-payment-reconcilation">Vendor Payment Reconciliation</a></li>' : "";
        ?>
      </ul>

    <?php
  }

  if (in_array('P0273', USER_PRIV)) {
    ?>
    <li>
      <a class="third-nav">Reports</a>
      <ul>
        <?php
        echo (in_array('P0274', USER_PRIV)) ? '<li><a href="../user/accounts/vendors-payments/transactions">List paid transaction report</a></li>' : "";
        ?>
        <?php
        echo (in_array('P0276', USER_PRIV)) ? '<li><a href="../user/accounts/vendors-payments/group-transactions">Group paid transaction report</a></li>' : "";
        ?>

      </ul>
    </li>



  <?php
  }
  echo (in_array('P0390', USER_PRIV)) ? '<li ><a href="../user/accounts/assets-management">Assets Management</a></li>' : "";
  ?>
  <li><a>Billing</a>
    <ul>
      <?php
      echo '<li><a href="../user/accounts/billing/ready-to-bill">Ready To Bill</a></li>';
      echo '<li><a href="../user/accounts/billing/freight-bill-processing-queue">Freight Bill Processing Queue</a></li>';
      echo '<li><a href="../user/accounts/billing/freight-bill-print-queue">Freight Bill Print Queue</a></li>';
      echo '<li><a href="../user/accounts/billing/submit-factoring-list">Submit Factoring</a></li>';
      ?>
    </ul>
  </li>