<?php
require_once APPROOT . '/views/includes/user/header-quick-view.php';
$details = $data['details'];
?>
<br><br>
    <section class="rv content-box" style="margin: auto;max-width: 1200px !important;">
        <h1 class="rv-heading">Customer Reporting Report-Details</h1>
        <div class="rv-table fixedheader">
            <input type='hidden' id='sort' value='asc'>
            <table data-my-table>
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Customer</th>
                        <th>Load PO #</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Reefer Temperature</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody id="tabledata">
                    <?php
                    $counter = 1;
                    foreach ($details['list'] as $list) {
                        echo "<tr><td>$counter</td>
                                <td>" . $details['customer_name'] . "</td>
                                <td>" . $list['load_po'] . "</td>
                                <td>" . $list['location'] . "</td>
                                <td>" . $list['status'] . "</td>
                                <td>" . $list['reefer_temperature'] . "</td>
                                <td>" . $list['remarks'] . "</td></tr>";
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

</section>

</form>

<script type="text/javascript">
    function back_alert() {
        if (confirm('Are you Sure ?')) {
            window.history.back();
        }
    }
</script>