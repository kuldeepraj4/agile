<?php
$nav_type = 'inventory';
switch (getUri()) {
    case 'user/inventory/masters/product-type':
        if(in_array('P0405', USER_PRIV)){
        require_once APPROOT . '/views/user/inventory/masters/product-type.php';
        }
        break;
    case 'user/inventory/masters/product-type-list-ajax';
        $param['user_key'] = USER_KEY;
        if (isset($_POST)) {
            $param = array_merge($param, $_POST);
        }
        echo callSGWS('user/inventory/masters/product-type/list', $param);
        break;

    case 'user/inventory/masters/product-type/add-new':
        if(in_array('P0406', USER_PRIV)){
        require_once APPROOT . '/views/user/inventory/masters/product-type-add-new.php';
        }
        break;

    case 'user/inventory/masters/product-type/add-new-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/masters/product-type/add-new', $_POST);
        }
        break;
    case 'user/inventory/masters/product-type/delete-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/masters/product-type/delete', $_POST);
        }
        break;

    case 'user/inventory/masters/product-type/update':
        if (isset($_GET['eid'])) {
            $data = [];
            $data['eid'] = $_GET['eid'];
            $data['details'] = [];
            $response = callSGWS('user/inventory/masters/product-type/details', array('user_key' => USER_KEY, 'eid' => $_GET['eid']));
            $OBJ = json_decode($response, true);
            if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
                $data['details'] = $OBJ['response']['details'];
                require_once APPROOT . '/views/user/inventory/masters/product-type-update.php';
            }
        }
        break;

    case 'user/inventory/masters/product-type/update-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/masters/product-type/update', $_POST);
        }
        break;
   
    default:
        echo NOT_VALID_REQUEST;
        break;
}
