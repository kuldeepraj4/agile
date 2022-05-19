<?php
$nav_type = 'dispatch';
switch (getUri()) {
	case 'user/dispatch/cross-docks-ajax':
		if (in_array('DIS003', USER_PRIV)) {
			$_POST['user_key'] = USER_KEY;
			echo $a = callSGWS('user/dispatch/planning/cross-docks-list', $_POST);
			// echo "<pre>";
			// print_r(json_decode($a,true));
			// echo '</pre>';
		}
		break;
	case 'user/dispatch/cross-docks':
		if (in_array('DIS003', USER_PRIV)) {
			require_once APPROOT . '/views/user/dispatch/planning/cross-docks.php';
		}
		break;

	case 'user/dispatch/cross-docks-info-update-action':
		$_POST['user_key'] = USER_KEY;
		// $_POST['dispatch_stop_eid']='bEhXYWFGZzFFRWM9';
		// $_POST['cross_dock_status']='COMPLETED';
		// $_POST['remarks']="remarks will be here ee";
		echo callSGWS('user/dispatch/planning/cross-docks-info-update', $_POST);
		break;

	case 'user/dispatch/cross-docks-info-update':
		if (in_array('DIS004', USER_PRIV)) {
			require_once APPROOT . '/views/user/dispatch/planning/cross-docks-info-update.php';
		}
		break;

	case 'user/dispatch/cross-docks/release-source-trailer-action':
		$_POST['user_key'] = USER_KEY;
		echo callSGWS('user/dispatch/planning/release-source-trailer', $_POST);
		break;

	default:
		//GT_default_page();
		break;
}
