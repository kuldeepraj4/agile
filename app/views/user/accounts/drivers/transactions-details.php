<?php
require_once APPROOT.'/views/includes/user/header.php';
  $page=isset($_GET['page'])?$_GET['page']:1;
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 500px">
    <h1 class="list-200-heading" id="heading">Transactions Details</h1>
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
                    <th>Paid For Payment Id</th>
                    <th>Amount Paid</th>
                </tr>                       
            </thead>
            <tbody>
              <?php

              foreach ($data['list'] as $list) {
                echo "<tr>
                <td>".$list['sr_no']."</td>
                <td>".$list['payment_id']."</td>
                <td>".$list['amount_paid']."</td>
                </tr>";
              }
              ?>
            </tbody>
        </table>
      <div class="table-pagination" data-list-pagination style="margin:5px"></div>
    </div>
</section>
<br><br><br><br>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>