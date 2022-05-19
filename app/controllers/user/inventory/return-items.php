<?php
$nav_type = 'inventory';
switch (getUri()) {
    case 'user/inventory/return-items':
        if(in_array('P0430', USER_PRIV)){
        require_once APPROOT . '/views/user/inventory/return-items.php';
        }
        break;
    case 'user/inventory/return-items-list-ajax':
        $param['user_key'] = USER_KEY;
        if (isset($_POST)) {
            $param = array_merge($param, $_POST);
        }
        echo callSGWS('user/inventory/return-items/list', $param);
        break;

    case 'user/inventory/return-items/add-new':
        if(in_array('P0431', USER_PRIV)){
            if (isset($_GET['issue-eid'])) {
                $data = [];
                $data['eid'] = $_GET['issue-eid'];
                $data['details'] = [];
                $response = callSGWS('user/inventory/issue-items/details', array('user_key' => USER_KEY, 'eid' => $_GET['issue-eid']));
                $OBJ = json_decode($response, true);
                if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
                    $data['details'] = $OBJ['response']['details'];
                    require_once APPROOT . '/views/user/inventory/return-items-add-new.php';
                }
            }
        // require_once APPROOT . '/views/user/inventory/return-items-add-new.php';
        }
        break;

    case 'user/inventory/return-items/add-new-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/return-items/add-new', $_POST);
        }
        break;
    case 'user/inventory/return-items/delete-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/return-items/delete', $_POST);
        }
        break;

    case 'user/inventory/return-items/update':
        if (isset($_GET['eid'])) {
            $data = [];
            $data['eid'] = $_GET['eid'];
            $data['details'] = [];
            $response = callSGWS('user/inventory/return-items/details', array('user_key' => USER_KEY, 'eid' => $_GET['eid']));
            $OBJ = json_decode($response, true);
            if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
                $data['details'] = $OBJ['response']['details'];
                require_once APPROOT . '/views/user/inventory/return-items-update.php';
            }
        }
        break;

    case 'user/inventory/return-items/update-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/return-items/update', $_POST);
        }
        break;
    case 'user/inventory/return-items/delete-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/return-items/delete', $_POST);
        }
        break;
    default:
        echo NOT_VALID_REQUEST;
        break;
}