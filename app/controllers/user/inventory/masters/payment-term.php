<?php
$nav_type = 'inventory';
switch (getUri()) {
    case 'user/inventory/masters/payment-term':
        if(in_array('P0405', USER_PRIV)){
        require_once APPROOT . '/views/user/inventory/masters/payment-term.php';
        }
        break;
    case 'user/inventory/masters/payment-term-list-ajax':
        $param['user_key'] = USER_KEY;
        if (isset($_POST)) {
            $param = array_merge($param, $_POST);
        }
        echo callSGWS('user/inventory/masters/payment-term/list', $param);
        break;

    case 'user/inventory/masters/payment-term/add-new':
        if(in_array('P0406', USER_PRIV)){
        require_once APPROOT . '/views/user/inventory/masters/payment-term-add-new.php';
        }
        break;

    case 'user/inventory/masters/payment-term/add-new-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/masters/payment-term/add-new', $_POST);
        }
        break;
    case 'user/inventory/masters/payment-term/delete-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/masters/payment-term/delete', $_POST);
        }
        break;

    case 'user/inventory/masters/payment-term/update':
        if (isset($_GET['eid'])) {
            $data = [];
            $data['eid'] = $_GET['eid'];
            $data['details'] = [];
            $response = callSGWS('user/inventory/masters/payment-term/details', array('user_key' => USER_KEY, 'eid' => $_GET['eid']));
            $OBJ = json_decode($response, true);
            if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
                $data['details'] = $OBJ['response']['details'];
                require_once APPROOT . '/views/user/inventory/masters/payment-term-update.php';
            }
        }
        break;

    case 'user/inventory/masters/payment-term/update-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/masters/payment-term/update', $_POST);
        }
        break;
    case 'user/inventory/masters/payment-term/delete-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/masters/payment-term/delete', $_POST);
        }
        break;
    default:
        echo NOT_VALID_REQUEST;
        break;
}
