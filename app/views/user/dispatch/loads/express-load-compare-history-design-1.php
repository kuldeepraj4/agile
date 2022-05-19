<?php
require_once APPROOT.'/views/includes/user/header.php';
$dtl=$data['details'];
?>
<br><br>
            <section class="list-200 content-box" style="margin: auto;max-width: 1000px">
            <h1 class="list-200-heading">Express Loads Comparison</h1>

<br>
<h3 style="text-align: center;">Basic information</h3>
            <div class="table  table-a">

                <table data-table-td-counter>
                    <thead>
                    <tr>
                        <th style="text-align: left;width: 40%">Field</th>
                        <th style="text-align: left;width: 30%">New</th>
                        <th style="text-align: left;width: 30%">History</th>
                    </tr>                       
                    </thead>
                    <tbody id="tabledata">
                      <?php
                      foreach ($dtl['basic_info'] as $bi) {
                        $bg=($bi['current']!=$bi['old'])?'red':'';
                        echo "<tr>
                          <td style='text-align: left; width: 16%;background:".$bg."'>".$bi['name']."</td>
                          <td style='text-align: left; width: 42%'>".$bi['current']."</td>
                          <td style='text-align: left; width: 42%'>".$bi['old']."</td>
                        </tr>";
                        
                      }
                      ?>

                    </tbody>
                </table>
            </div>
            <br><br><br>
            <h3 style="text-align: center;">Stops</h3>
                        <div class="table  table-a">

                <table data-table-td-counter>
                    <thead>
                    <tr>
                        <th style="text-align: left;width: 4%">Stop Number</th>
                        <th style="text-align: left;width: 16%">Field</th>
                        <th style="text-align: left;width: 40%">New</th>
                        <th style="text-align: left;width: 40%">History</th>
                    </tr>                       
                    </thead>
                    <tbody id="tabledata">
                      <?php
                      $stop_no=0;
                      foreach ($dtl['stops'] as $aro) {
                        $stop_no++;
                        foreach ($aro as $ari) {
                        $bg2=($ari['current']!=$ari['old'])?'red':'';
                        echo "<tr>
                        <td style='text-align:center; width: 4%'>".$stop_no."</td>
                          <td style='text-align: left; width: 16%;background:".$bg2."'>".$ari['name']."</td>
                          <td style='text-align: left; width: 40%'>".$ari['current']."</td>
                          <td style='text-align: left; width: 40%'>".$ari['old']."</td>
                        </tr>";
                        }
                       
                      }
                      ?>

                    </tbody>
                </table>
            </div>
        </section>


<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>