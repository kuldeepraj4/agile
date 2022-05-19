<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];
// echo '<pre>';
// print_r($details);
// echo '</pre>';
//exit;
?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - View Item</div>
    <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
        <section class="section-111" style="max-width: 400px">
            <div>
                <fieldset>
                    <legend>Item Code</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Item Code</label>
                            <div><?php echo $details['item_code'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Status</label>
                            <div><?php echo $details['status'] ?></div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </section>
        <section class="section-111">
            <div>
                <fieldset>
                    <legend>Item Details</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Item Type</label>
                            <div><?php echo $details['product_type'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Item Name</label>
                            <div><?php echo $details['product'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Maker</label>
                            <div><?php echo $details['maker'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Model</label>
                            <div><?php echo $details['model'] ?></div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Description</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Description</label>
                            <div><?php echo nl2br($details['description']) ?></div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div>
                <fieldset>
                    <legend>UOM</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>UOM</label>
                            <?php echo $details['uom'] ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Reorder Level</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Minimum</label>
                            <div><?php echo $details['reorder_min'] ?></div>
                        </div>
                        <div class="field-p">
                            <label>Maximum</label>
                            <div><?php echo $details['reorder_max'] ?></div>
                        </div>
                    </div>
                    <div class="field-p">
                        <label>Image</label>
                        <div>
                        <?php
                        if($details['item_image']!=""){
                        ?>
                        <span onclick='open_document("<?php echo $details['item_image']; ?>")' class="fa fa-file" title="View Invoice" style="color:  grey;cursor:pointer;"></span>
                        <?php
                        }
                        ?>
                        &nbsp &nbsp
                        <span onclick="open_child_window({url:'../user/inventory/masters/items/update-image?eid=<?php echo $details['eid'] ?>',width:600,height:500})" class="fa fa-pen" title="Update Invoice" style="color:  grey;cursor:pointer;">
                        
                        </span>
                        </div>
                    </div>
                </fieldset>
            </div>
        </section>
        <section class="section-111">
            <div>
                <fieldset>
                    <legend>Storage</legend>
                    <div class="field-section table-rows">
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Location</th>
                                    <th>Storage</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($details['locations'])) { ?>
                                <?php foreach($details['locations'] as $key => $value) { ?>
                                <tr>
                                    <td class="cc"><?php echo $key+1 ?></td>
                                    <td>
                                        <?php echo $value['location'] ?>
                                    </td>
                                    <td>
                                        <table style="width: 100%;border: 1px solid;padding: 10px">
                                            <tbody>
                                                <?php if(!empty($value['storage'])) { ?>
                                                <?php foreach($value['storage'] as $key2 => $value2) { ?>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div style="width: 300px; text-align: center">
                                                            <?php echo $value2['storage_type'] ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <div style="width: 300px; text-align: center">
                                                            <?php echo $value2['storage'] ?>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                            
                                        </table>
                                    </td>
                                    <td></td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
                            </tbody>
                            
                        </table>
                    </div>
                </fieldset>
            </div>
        </section>
        <section class="action-button-box">
            <button type="button" class="btn_green" onclick="back_alert()">BACK</button>
        </section>
        
    </form>
</section>
<script type="text/javascript">
    function back_alert() {
            window.history.back();
        
    }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>