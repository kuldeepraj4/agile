<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];

// echo '<pre>';
// print_r($details);
// echo '</pre>';
// exit; 
?>

<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - PO</div>
    <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
        <section class="section-111" style="max-width: 400px">
        <div>
            <fieldset>
                     <legend>Purchase Order</legend>
                    <div class="field-section single-column">
                    <div class="field-p">
                        <label>PO Number</label>
                        <div><?php echo $details['po_number'] ?></div>
                    </div>
                    <div class="field-p">
                        <label>PO Date</label>
                        <div><?php echo $details['po_date'] ?></div>
                    </div>
                    <div class="field-p">
                    <label>Status</label>
                    <div><?php echo $details['po_status'] ?></div>
                    </div>
                    </div>
            </fieldset>
        </div>
        </section>
        <section class="section-111" style="max-width: 1200px">
            <div>
                <fieldset>
                   
                    <legend>Purchase Order Details</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Vendor</label>
                            <div><?php echo $details['vendor_name'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Delivery Date</label>
                            <div><?php echo $details['expected_delivery_date'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Shipment Preference</label>
                            <div><?php echo $details['shipment_preference'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Payment Terms</label>
                            <div><?php echo $details['payment_term'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Location</label>
                            <div><?php echo $details['location'] ?></div>
                        </div>
                    </div>
                </fieldset>
                <br>

            </div>
        </section>
        <section class="section-111">
            <div>
                <fieldset>
                    <legend>Item Details</legend>
                    <div class="field-section table-rows">
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Rate</th>
                                    <th>Tax (%)</th>
                                    <th>Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="item_tbody">

                                <?php if(!empty($details['items'])) { 
                                   $total = 0; 
                                    ?>
                                <?php foreach($details['items'] as $key => $value) { 
                                    $amount = $value['quantity'] * $value['rate'];
                                    $amount = $amount + ($value['tax']/ 100)*$amount;
                                    $total += $amount;
                                    ?>
                                <tr>
                                    <td class="cc"><?php echo $key+1 ?></td>
                                    <td>
                                        <?php echo $value['item_name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $value['quantity'] ?>
                                    </td>
                                    <td>
                                        <?php echo $value['rate'] ?>
                                    </td>
                                    <td>
                                        <?php echo $value['tax'] ?>
                                    </td>
                                    <td>
                                        <?php echo $amount ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>

                                <tr>
                                    <td colspan="6" style="padding-right:50px;font-weight: bold;"><span id="total" data-total-amount>Total: <?php echo $total ?></span></td>
                                   
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>
            </div>
        </section>
        <section class="action-button-box">

        <?php if (in_array('P0418', USER_PRIV)) { ?>
            <button class="btn_green"><a href="../user/inventory/purchase-orders/update?eid=<?php echo $details['eid'] ?>">Edit</a></button>
        <?php } ?>
            &nbsp; &nbsp;&nbsp;
            
            <button type="button" class="btn_green" onclick="back_alert()">BACK</button>
            
            &nbsp; &nbsp;&nbsp;

            <?php if (in_array('P0421', USER_PRIV)) { ?>
            <?php if($details['po_status'] != 'Closed') { ?>
            <button type="button" class="btn_green" ><a href="../user/inventory/receipts/add-new?po-eid=<?php echo $details['eid'] ?>">Receipt</a></button>
            <?php } ?>
            <?php } ?>
        </section>
    </form>
</section>

<script type="text/javascript">
    function back_alert() {
        if (confirm('Are you Sure ?')) {
            window.history.back();
        }
    }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>