<?php

$nav_type='maintenance';

switch (getUri()) {
	case 'user/maintenance/dashboard':
	require_once APPROOT.'/views/user/maintenance/dashboard.php';
	break;
	case 'user/maintenance/dashboard/truck-quick-totals':
	if(isset($_POST)){
		$param['user_key']=USER_KEY;
		$param=array_merge($param,$_POST);
		echo $response =callSGWS('user/maintenance/miscellaneous/truck-quick-totals',$param);
	}
	break;

	case 'user/maintenance/dashboard/trailer-quick-totals':
	if(isset($_POST)){
		$param['user_key']=USER_KEY;
		$param=array_merge($param,$_POST);
		echo $response =callSGWS('user/maintenance/miscellaneous/trailer-quick-totals',$param);
	}
	break;

	case 'user/maintenance/dashboard-graph':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/miscellaneous/graph',$param);
		break;

	default:

	echo NOT_VALID_REQUEST;

	break;

}


?>