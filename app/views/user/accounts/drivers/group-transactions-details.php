<?php
require_once APPROOT.'/views/includes/user/header.php';
$transactions_list=$data['transactions-list'];
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1200px">
  <h1 class="list-200-heading" id="heading">Group Transaction Details</h1>
  <section class="list-200-top-section">
    <div> 

    </div>
    <div>

    </div>
  </section>
  <div class="table  table-a">
    <table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Transaction ID</th>
          <th style="text-align: left;">Driver</th>
          <th style="text-align: right;">Amount</th>
          <th>Created By</th>
          <th>Created Datetime</th>
          <th>Payment Mode</th>
          <th>Transaction referance</th>
        </tr>                       
      </thead>
      <tbody id="tabledata"></tbody>
      <?php
      $counter=0;
      foreach ($transactions_list as $tl) {
        echo "<tr>
              <td>".++$counter."</td>
              <td>".$tl['id']."</td>
              <td style='text-align:left'>".$tl['driver_code'].' - '.$tl['driver_name']."</td>
              <td style='text-align:right'>".$tl['amount']."</td>
              <td>".$tl['added_by_user_code'].' - '.$tl['added_by_user_name']."</td>
              <td>".$tl['added_on_datetime']."</td>
              <td>".$tl['payment_mode']."</td>
              <td>".$tl['transaction_referance']."</td>
            </tr>";
      }
      ?>
    </table>
  </div>
</section>


<br><br><br><br><br>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>