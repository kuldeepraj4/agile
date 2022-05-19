<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details']; 

// echo '<pre>';
// print_r($details);
// echo '</pre>';
// exit;

?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - Receipts</div>
    <form class="lg-form" method="POST" id="MyForm" onsubmit="return update()">
        <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
        <section class="section-111">
        </section>
        <section class="section-111">
            <div>
                <fieldset>
                    <legend>PO Details</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>PO Number</label>
                            <div><?php echo $details['po_details']['po_number'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>PO Date</label>
                            <div><?php echo $details['po_details']['po_date'] ?></div>
                        </div>           
                        <div class="field-p">
                            <label>Vendor</label>
                            <div><?php echo $details['po_details']['vendor_name'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Delivery Expected</label>
                            <div><?php echo $details['po_details']['expected_delivery_date'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Shipment Preference</label>
                            <div><?php echo $details['po_details']['shipment_preference'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Payment Term</label>
                            <div><?php echo $details['po_details']['payment_term'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Location</label>
                            <div><?php echo $details['po_details']['location'] ?></div>
                        </div>
                        
                    </div>
                </fieldset>
                </div>
                <div>
                    <fieldset>
                    <legend> Billing Details </legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                        <label>Payment Status</label>
                        <div><?php echo $details['payment_status'] ?></div>
                        
                        </div>
                        <div class="field-p">
                            <label>Payment Mode</label>
                            <div><?php echo $details['payment_mode'] ?></div>
                           
                        </div>
                        <div class="field-p">
                            <label>Payment Ref No</label>
                            <div><?php echo $details['payment_ref_no'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Invoice No</label>
                            <div><?php echo $details['invoice_no'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Date Paid</label>
                            <div><?php echo $details['payment_date'] ?></div>
                        </div>

                        <div class="field-p">
                            <label>Payment Notes</label>
                            <div><?php echo $details['payment_remarks'] ?></div>
                        </div>
                    
                        <div class="field-p">
                            <label>Received By</label>
                            <div><?php echo $details['receiver'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Receipt Date</label>
                            <div><?php echo $details['receipt_date'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Invoice</label>
                            <div>
                            <?php
                            if($details['invoice_file']!=""){
                            ?>
                            <span onclick='open_document("<?php echo $details['invoice_file']; ?>")' class="fa fa-file" title="View Invoice" style="color:  grey;cursor:pointer;"></span>
                            <?php
                            }
                            ?>
                            &nbsp &nbsp
                            <span onclick="open_child_window({url:'../user/inventory/receipts/update-invoice?eid=<?php echo $details['eid'] ?>',width:600,height:500})" class="fa fa-pen" title="Update Invoice" style="color:  grey;cursor:pointer;">
                            
                            </span>
                            </div>
                        </div>
                    </div>
                    </fieldset>
                </div>
               
        </section>
        <section class="section-111">
            <div>
                <fieldset>
                    <legend>PO Item Details</legend>
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
                                    
                                </tr>
                            </thead>
                            <tbody id="po_item_tbody">
                            <?php if(!empty($details['po_details']['items'])) { 
                                   $total = 0; 
                                    ?>
                                <?php foreach($details['po_details']['items'] as $key => $value) { 
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
                                <td colspan="6" style="padding-right:50px;font-weight: bold;"><span >Total: <?php echo $total ?></span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>
            </div>
            <div>
                <fieldset>
                    <legend>Final Item Details</legend>
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
                                    
                                </tr>
                            </thead>
                            <tbody id="receipt_item_tbody">
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
                                    <td colspan="6" style="padding-right:50px;font-weight: bold;"><span >Total: <?php echo $total ?></span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>
            </div>
        </section>
        <section class="action-button-box">

            &nbsp; &nbsp;&nbsp;<button type="button" class="btn_green" onclick="back_alert()">BACK</button>
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
require_once APPROOT.'/views/includes/user/footer.php';
?>