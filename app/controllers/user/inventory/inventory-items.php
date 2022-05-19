<?php
$nav_type = 'inventory';
switch (getUri()) {
    case 'user/inventory/inventory-items':
        if(in_array('P0410', USER_PRIV)){
        require_once APPROOT . '/views/user/inventory/inventory-items.php';
        }
        break;

    case 'user/inventory/inventory-items-list-ajax':
        $param['user_key'] = USER_KEY;
        if (isset($_POST)) {
            $param = array_merge($param, $_POST);
        }
        echo callSGWS('user/inventory/inventory-items/list', $param);
        break;

    case 'user/inventory/inventory-items-quick-totals':
        $param['user_key'] = USER_KEY;
        if (isset($_POST)) {
            $param = array_merge($param, $_POST);
        }
        echo callSGWS('user/inventory/inventory-items/quick-totals', $param);
        break;

    default:
        echo NOT_VALID_REQUEST;
        break;
}