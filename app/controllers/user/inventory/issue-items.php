<?php
$nav_type = 'inventory';
switch (getUri()) {
    case 'user/inventory/issue-items':
         if(in_array('P0425', USER_PRIV)){
        require_once APPROOT . '/views/user/inventory/issue-items.php';
         }
        break;
    case 'user/inventory/issue-items-list-ajax':
        $param['user_key'] = USER_KEY;
        if (isset($_POST)) {
            $param = array_merge($param, $_POST);
        }
        echo callSGWS('user/inventory/issue-items/list', $param);
        break;

    case 'user/inventory/issue-items/add-new':
         if(in_array('P0426', USER_PRIV)){
        require_once APPROOT . '/views/user/inventory/issue-items-add-new.php';
         }
        break;

    case 'user/inventory/issue-items/add-new-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/issue-items/add-new', $_POST);
        }
        break;
    case 'user/inventory/issue-items/delete-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/issue-items/delete', $_POST);
        }
        break;

    case 'user/inventory/issue-items/update':
        if (isset($_GET['eid'])) {
            $data = [];
            $data['eid'] = $_GET['eid'];
            $data['details'] = [];
            $response = callSGWS('user/inventory/issue-items/details', array('user_key' => USER_KEY, 'eid' => $_GET['eid']));
            $OBJ = json_decode($response, true);
            if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
                $data['details'] = $OBJ['response']['details'];
                require_once APPROOT . '/views/user/inventory/issue-items-update.php';
            }
        }
        break;

    case 'user/inventory/issue-items/update-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/issue-items/update', $_POST);
        }
        break;
    case 'user/inventory/issue-items/delete-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/issue-items/delete', $_POST);
        }
        break;
    default:
        echo NOT_VALID_REQUEST;
        break;
}