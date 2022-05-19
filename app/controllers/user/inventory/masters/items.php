<?php
$nav_type = 'inventory';
switch (getUri()) {
    case 'user/inventory/masters/items':
        if(in_array('P0410', USER_PRIV)){
        require_once APPROOT . '/views/user/inventory/masters/items.php';
        }
        break;
    case 'user/inventory/masters/items-list-ajax':
        $param['user_key'] = USER_KEY;
        if (isset($_POST)) {
            $param = array_merge($param, $_POST);
        }
        echo callSGWS('user/inventory/masters/items/list', $param);
        break;

    case 'user/inventory/masters/items-location-list-ajax':
        $param['user_key'] = USER_KEY;
        if (isset($_POST)) {
            $param = array_merge($param, $_POST);
        }
        echo callSGWS('user/inventory/masters/items-location/list', $param);
        break;

    case 'user/inventory/masters/items/details':
        if(in_array('P0412', USER_PRIV)){
        if (isset($_GET['eid'])) {
            $data = [];
            $data['eid'] = $_GET['eid'];
            $data['details'] = [];
            $response = callSGWS('user/inventory/masters/items/details', array('user_key' => USER_KEY, 'eid' => $_GET['eid']));
            $OBJ = json_decode($response, true);
            if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
                $data['details'] = $OBJ['response']['details'];
                require_once APPROOT . '/views/user/inventory/masters/items-details.php';
            }
        }
        }	
        break;
    case 'user/inventory/masters/items/add-new':
        if(in_array('P0411', USER_PRIV)){
        require_once APPROOT . '/views/user/inventory/masters/items-add-new.php';
        }
        break;

    case 'user/inventory/masters/items/add-new-action':
        // if (isset($_POST)) {
        //     $_POST['user_key'] = USER_KEY;
        //     echo $response = callSGWS('user/inventory/masters/items/add-new', $_POST);
        // }
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            if(isset($_FILES['document'])){
				$document=$_FILES['document'];
			}else{
				$document=$_FILES;
			}
            echo $response = callSGWS('user/inventory/masters/items/add-new', $_POST, $document);
        }
        break;
    case 'user/inventory/masters/items/delete-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/masters/items/delete', $_POST);
        }
        break;

    case 'user/inventory/masters/items/update':
        if (isset($_GET['eid'])) {
            $data = [];
            $data['eid'] = $_GET['eid'];
            $data['details'] = [];
            $response = callSGWS('user/inventory/masters/items/details', array('user_key' => USER_KEY, 'eid' => $_GET['eid']));
            $OBJ = json_decode($response, true);
            if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
                $data['details'] = $OBJ['response']['details'];
                require_once APPROOT . '/views/user/inventory/masters/items-update.php';
            }
        }
        break;

    case 'user/inventory/masters/items/update-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/masters/items/update', $_POST);
        }
        break;
    case 'user/inventory/masters/items/delete-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/masters/items/delete', $_POST);
        }
        break;

    case 'user/inventory/masters/items/update-image':
        if(in_array('P0413', USER_PRIV)){
            if(isset($_GET['eid'])){
                $data=[];
                $data['eid']=$_GET['eid'];
                require_once APPROOT.'/views/user/inventory/masters/items-update-image.php';
            }
        }
        break;
    case 'user/inventory/masters/items/update-image-action':
        if(isset($_POST)){
            $_POST['user_key']=USER_KEY;
            echo $response =callSGWS('user/inventory/masters/items/update-image',$_POST,$_FILES['document']);
        }
        break;
    default:
        echo NOT_VALID_REQUEST;
        break;
}
