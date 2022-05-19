<ul id="menu-main">


<?php if (in_array('P0404', USER_PRIV)) { ?>
    <li><a>Masters</a>

        <ul>
            <?php
            echo '<li><a href="../user/inventory/masters/product-type">Product Types</a></li>';
            echo '<li><a href="../user/inventory/masters/products">Products</a></li>';
            echo '<li><a href="../user/inventory/masters/product-maker">Makers</a></li>';
            echo '<li><a href="../user/inventory/masters/product-model">Models</a></li>';
            echo '<li><a href="../user/inventory/masters/locations">Locations</a></li>';
            echo '<li><a href="../user/inventory/masters/uom">Units of Measurement</a></li>';
            echo '<li><a href="../user/inventory/masters/storage-type">Storage Types</a></li>';
            echo '<li><a href="../user/inventory/masters/storage">Storage</a></li>';
            echo '<li><a href="../user/inventory/masters/payment-term">Payment Terms</a></li>';
            echo '<li><a href="../user/inventory/masters/shipment-preference">Shipment Preferences</a></li>';
            // echo '<li><a href="../user/inventory/masters/items">Items</a></li>';
            ?>
            
        </ul>
    </li>
<?php } ?>

<?php if (in_array('P0410', USER_PRIV)) { ?>
    <li><a>Inventory</a>
        <ul>
            <?php
            echo '<li><a href="../user/inventory/masters/items">Add Items</a></li>';
            ?>
             <?php
            echo '<li><a href="../user/inventory/inventory-items">Total Items</a></li>';
            ?>
            
        </ul>
    </li>
<?php } ?>

<?php if (in_array('P0415', USER_PRIV) || in_array('P0420', USER_PRIV)) { ?>
    <li><a>Purchase</a>

        <ul>
            <?php
            echo (in_array('P0415', USER_PRIV)) ? '<li><a href="../user/inventory/purchase-orders">Purchase Orders</a></li>': '';
            ?>
             <?php
            echo (in_array('P0420', USER_PRIV)) ? '<li><a href="../user/inventory/receipts">Receipts</a></li>': '';
            ?>
            
        </ul>
    </li>
<?php } ?>

<?php if (in_array('P0425', USER_PRIV) || in_array('P0430', USER_PRIV)) { ?>
    <li><a>Issue</a>

        <ul>
            <?php
            echo (in_array('P0425', USER_PRIV)) ? '<li><a href="../user/inventory/issue-items">Items Issued</a></li>': '';
            echo (in_array('P0430', USER_PRIV)) ? '<li><a href="../user/inventory/return-items">Items Returned</a></li>': '';
            ?>
            
        </ul>
    </li>
<?php } ?>
   

</ul>