<?php
$nav_type = 'maintenance';
switch (getUri()) {
	case 'user/maintenance/preventive-maintenance/trucks-alert-ajax':
		$param['user_key'] = USER_KEY;
		if (isset($_POST)) {
			$param = array_merge($param, $_POST);
		}
		echo callSGWS('user/maintenance/preventive-maintenance-trucks-alert', $param);
		break;

	case 'user/maintenance/preventive-maintenance/trucks-alert':
		require_once APPROOT . '/views/user/maintenance/preventive-maintenance/trucks-alert.php';
		break;

	case 'user/maintenance/preventive-maintenance/trailers-alert-ajax':
		$param['user_key'] = USER_KEY;
		if (isset($_POST)) {
			$param = array_merge($param, $_POST);
		}
		echo callSGWS('user/maintenance/preventive-maintenance-trailers-alert', $param);
		break;

	case 'user/maintenance/preventive-maintenance/trailers-alert':
		require_once APPROOT . '/views/user/maintenance/preventive-maintenance/trailers-alert.php';
		break;



		//Number of total criticality  level
        case 'user/maintenance/preventive-maintenance-criticality-ajax':
        $param['user_key']=USER_KEY;
        if(isset($_POST)){
            $param=array_merge($param,$_POST);
        }
        echo callSGWS('user/maintenance/preventive-maintenance-criticality-total',$param);
        break;

    case 'user/maintenance/preventive-maintenance/trucks-alert/addpmtemparory-action':
		$param['user_key'] = USER_KEY;
		if (isset($_POST)) {
			$param = array_merge($param, $_POST);
		}
		echo callSGWS('user/maintenance/preventive-maintenance-trucks-alert-addpmtemparory', $param);
	break; 

	case 'user/maintenance/preventive-maintenance/trailers-alert/addpmtemparory-action':
		$param['user_key'] = USER_KEY;
		if (isset($_POST)) {
			$param = array_merge($param, $_POST);
		}
		echo callSGWS('user/maintenance/preventive-maintenance-trailers-alert-addpmtemparory', $param);
	break;   

	default:
		echo NOT_VALID_REQUEST;
		break;
}

	// switch (getUri()) {
	// 	case 'user/maintenance/preventive-maintenance/trailers-alert-ajax':
	// 	$param['user_key']=USER_KEY;
	// 	if(isset($_POST)){
	// 		$param=array_merge($param,$_POST);
	// 	}
	// 	echo callSGWS('user/maintenance/preventive-maintenance-trailers-alert',$param);
	// 	break;

	// 	case 'user/maintenance/preventive-maintenance/trailers-alert':
	// 	require_once APPROOT.'/views/user/maintenance/preventive-maintenance/trailers-alert.php';
	// 	break;

	// 	default:
	// 	echo NOT_VALID_REQUEST;
	// 	break;
	// }
