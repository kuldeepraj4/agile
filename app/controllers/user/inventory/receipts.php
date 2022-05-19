<?php
$nav_type = 'inventory';
switch (getUri()) {
    case 'user/inventory/receipts':
        if(in_array('P0420', USER_PRIV)){
        require_once APPROOT . '/views/user/inventory/receipts.php';
        }
        break;
    case 'user/inventory/receipts-list-ajax':
        $param['user_key'] = USER_KEY;
        if (isset($_POST)) {
            $param = array_merge($param, $_POST);
        }
        echo callSGWS('user/inventory/receipts/list', $param);
        break;

    case 'user/inventory/receipts/add-new':
        if(in_array('P0421', USER_PRIV)){
        // require_once APPROOT . '/views/user/inventory/receipts-add-new.php';
        if (isset($_GET['po-eid'])) {
            $data = [];
            $data['eid'] = $_GET['po-eid'];
            $data['details'] = [];
            $response = callSGWS('user/inventory/purchase-orders/details', array('user_key' => USER_KEY, 'eid' => $_GET['po-eid']));
       
            $OBJ = json_decode($response, true);
            if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
                $data['details'] = $OBJ['response']['details'];
                require_once APPROOT . '/views/user/inventory/receipts-add-new.php';
            }
        }
        
        }
        break;

    case 'user/inventory/receipts/add-new-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            if(isset($_FILES['document'])){
				$document=$_FILES['document'];
			}else{
				$document=$_FILES;
			}
            echo $response = callSGWS('user/inventory/receipts/add-new', $_POST, $document);
        }
        break;

        case 'user/inventory/receipts/details':
            if (isset($_GET['eid'])) {
                $data = [];
                $data['eid'] = $_GET['eid'];
                $data['details'] = [];
                $response = callSGWS('user/inventory/receipts/details', array('user_key' => USER_KEY, 'eid' => $_GET['eid']));
                $OBJ = json_decode($response, true);
                if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
                    $data['details'] = $OBJ['response']['details'];
                    require_once APPROOT . '/views/user/inventory/receipts-details.php';
                }
            }
            break;
        
    case 'user/inventory/receipts/delete-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/receipts/delete', $_POST);
        }
        break;

    case 'user/inventory/receipts/update':
        if (isset($_GET['eid'])) {
            $data = [];
            $data['eid'] = $_GET['eid'];
            $data['details'] = [];
            $response = callSGWS('user/inventory/receipts/details', array('user_key' => USER_KEY, 'eid' => $_GET['eid']));
            $OBJ = json_decode($response, true);
            if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
                $data['details'] = $OBJ['response']['details'];
                require_once APPROOT . '/views/user/inventory/receipts-update.php';
            }
        }
        break;

    case 'user/inventory/receipts/update-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/receipts/update', $_POST);
        }
        break;
    case 'user/inventory/receipts/delete-action':
        if (isset($_POST)) {
            $_POST['user_key'] = USER_KEY;
            echo $response = callSGWS('user/inventory/receipts/delete', $_POST);
        }
        break;

    case 'user/inventory/receipts/update-invoice':
        if(in_array('P0423', USER_PRIV)){
            if(isset($_GET['eid'])){
                $data=[];
                $data['eid']=$_GET['eid'];
                require_once APPROOT.'/views/user/inventory/receipts-update-invoice.php';
            }
        }
        break;
    case 'user/inventory/receipts/update-invoice-action':
        if(isset($_POST)){
            $_POST['user_key']=USER_KEY;
            echo $response =callSGWS('user/inventory/receipts/update-invoice',$_POST,$_FILES['document']);
        }
        break;
    default:
        echo NOT_VALID_REQUEST;
        break;
}