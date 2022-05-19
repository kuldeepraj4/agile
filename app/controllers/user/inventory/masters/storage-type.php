<?php
$nav_type = 'inventory';
switch (getUri()) {
    case 'user/inventory/masters/storage-type':
        if(in_array('P0405', USER_PRIV)){
        require_once APPROOT . '/views/user/inventory/masters/storage-type.php';
        }
        break;
    case 'user/inventory/masters/storage-type-list-ajax':
        $param['user_key'] = USER_KEY;
        if (isset($_POST)) {
            $param = array_merge($param, $_POST);
        }
        echo callSGWS('user/inventory/masters/storage-type/list', $param);
        break;

    case 'user/inventory/masters/storage-type/add-new':
        if(in_array('P0406', USER_PRIV)){
        require_once APPROOT . '/views/user/inventory/masters/storage-type-add-new.php';
        }
        break;

    case 'user/inventory/masters/storage-type/add-new-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/masters/storage-type/add-new', $_POST);
        }
        break;
    case 'user/inventory/masters/storage-type/delete-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/masters/storage-type/delete', $_POST);
        }
        break;

    case 'user/inventory/masters/storage-type/update':
        if (isset($_GET['eid'])) {
            $data = [];
            $data['eid'] = $_GET['eid'];
            $data['details'] = [];
            $response = callSGWS('user/inventory/masters/storage-type/details', array('user_key' => USER_KEY, 'eid' => $_GET['eid']));
            $OBJ = json_decode($response, true);
            if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
                $data['details'] = $OBJ['response']['details'];
                require_once APPROOT . '/views/user/inventory/masters/storage-type-update.php';
            }
        }
        break;

    case 'user/inventory/masters/storage-type/update-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/masters/storage-type/update', $_POST);
        }
        break;
   
    default:
        echo NOT_VALID_REQUEST;
        break;
}
