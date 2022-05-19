<?php
$nav_type = 'inventory';
switch (getUri()) {
    case 'user/inventory/purchase-orders':
        if(in_array('P0415', USER_PRIV)){
        require_once APPROOT . '/views/user/inventory/purchase-orders.php';
        }
        break;
    case 'user/inventory/purchase-orders-list-ajax':
        $param['user_key'] = USER_KEY;
        if (isset($_POST)) {
            $param = array_merge($param, $_POST);
        }
        echo callSGWS('user/inventory/purchase-orders/list', $param);
        break;

    case 'user/inventory/purchase-orders/add-new':
         if(in_array('P0416', USER_PRIV)){
        $data = [];
        if (isset($_GET['item-location-eid'])) {
            
            $data['eid'] = $_GET['item-location-eid'];
            $data['details'] = [];
            $response = callSGWS('user/inventory/receipts/last-receipt-item', array('user_key' => USER_KEY, 'eid' => $_GET['item-location-eid']));
        
            $OBJ = json_decode($response, true);
            if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
                $data['details'] = $OBJ['response']['details'];
                require_once APPROOT . '/views/user/inventory/purchase-orders-add-new.php';
            }
            else {
                require_once APPROOT . '/views/user/inventory/purchase-orders-add-new.php';
            }
        }
        else {
            require_once APPROOT . '/views/user/inventory/purchase-orders-add-new.php';
        }
        
         }
        break;

    case 'user/inventory/purchase-orders/add-new-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/purchase-orders/add-new', $_POST);
        }
        break;
    case 'user/inventory/purchase-orders/delete-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/purchase-orders/delete', $_POST);
        }
        break;
    case 'user/inventory/purchase-orders/details':
            if (isset($_GET['eid'])) {
                $data = [];
                $data['eid'] = $_GET['eid'];
                $data['details'] = [];
                $response = callSGWS('user/inventory/purchase-orders/details', array('user_key' => USER_KEY, 'eid' => $_GET['eid']));
                $OBJ = json_decode($response, true);
                if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
                    $data['details'] = $OBJ['response']['details'];
                    require_once APPROOT . '/views/user/inventory/purchase-orders-details.php';
                }
            }
            break;

    case 'user/inventory/purchase-orders/update':
        if (isset($_GET['eid'])) {
            $data = [];
            $data['eid'] = $_GET['eid'];
            $data['details'] = [];
            $response = callSGWS('user/inventory/purchase-orders/details', array('user_key' => USER_KEY, 'eid' => $_GET['eid']));
            $OBJ = json_decode($response, true);
            if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
                $data['details'] = $OBJ['response']['details'];
                require_once APPROOT . '/views/user/inventory/purchase-orders-update.php';
            }
        }
        break;

    case 'user/inventory/purchase-orders/update-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/purchase-orders/update', $_POST);
        }
        break;
    case 'user/inventory/purchase-orders/delete-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/purchase-orders/delete', $_POST);
        }
        break;

    case 'user/inventory/purchase-orders-quick-totals':
        $param['user_key'] = USER_KEY;
        if (isset($_POST)) {
            $param = array_merge($param, $_POST);
        }
        echo callSGWS('user/inventory/purchase-orders/quick-totals', $param);
        break;

    default:
        echo NOT_VALID_REQUEST;
        break;
}