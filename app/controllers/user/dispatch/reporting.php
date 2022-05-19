<?php
$nav_type = 'dispatch';
switch (getUri()) {
	case 'user/dispatch/reporting/customer-reporting/list-ajax':
		$_POST['user_key'] = USER_KEY;
		echo 		$a = callSGWS('user/dispatch/reporting/customer-reporting-list', $_POST);
		// echo "<pre>";
		// print_r(json_decode($a,true));
		// echo "</pre>";
		break;
	case 'user/dispatch/reporting/customer-reporting/list':
		if (in_array('DIS003', USER_PRIV)) {
			require_once APPROOT . '/views/user/dispatch/reporting/customer-reporting-list.php';
		}
		break;


	case 'user/dispatch/reporting/customer-reporting/loads-ajax':
		$_POST['user_key'] = USER_KEY;
		echo 		$a = callSGWS('user/dispatch/reporting/customer-reporting-loads', $_POST);
		break;


	case 'user/dispatch/reporting/customer-reporting/add-new-action':
		$_POST['user_key'] = USER_KEY;
		echo 		$a = callSGWS('user/dispatch/reporting/customer-reporting/add-new', $_POST);
		break;

	case 'user/dispatch/reporting/customer-reporting/loads':
		if (in_array('DIS003', USER_PRIV)) {
			require_once APPROOT . '/views/user/dispatch/reporting/customer-reporting-loads.php';
		}
		break;

	case 'user/dispatch/reporting/customer-reporting/make':
		if (in_array('DIS003', USER_PRIV)) {
			require_once APPROOT . '/views/user/dispatch/reporting/customer-reporting-make.php';
		}
		break;
	case 'user/dispatch/reporting/customer-reporting/make-ajax':
		$_POST['user_key'] = USER_KEY;
		echo 		$a = callSGWS('user/dispatch/reporting/customer-reporting-loads', $_POST);
		break;
	case 'user/dispatch/reporting/customer-reporting/report-details':
		if (in_array('DIS003', USER_PRIV)) {
			if (isset($_GET['eid'])) {
				$data = [];
				$data['details'] = [];
				$response = callSGWS('user/dispatch/reporting/customer-reporting/report-details', array('user_key' => USER_KEY, 'eid' => $_GET['eid']));
				$OBJ = json_decode($response, true);
				if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
					$data['details'] = $OBJ['response']['details'];
					require_once APPROOT . '/views/user/dispatch/reporting/customer-reporting-report-details.php';
				}
			}
		}
		break;

	case 'user/dispatch/reporting/customer-reporting/load-details':
		$_POST['user_key'] = USER_KEY;
		echo 		$a = callSGWS('user/dispatch/reporting/customer-reporting-list', $_POST);
		// echo "<pre>";
		// print_r(json_decode($a,true));
		// echo "</pre>";
		break;

	case 'user/dispatch/reporting/dispatch-continuity-ajax':
		$_POST['user_key'] = USER_KEY;
		echo 		$a = callSGWS('user/dispatch/reporting/dispatch-continuity', $_POST);
		// echo "<pre>";
		// print_r(json_decode($a, true));
		// echo "</pre>";
		break;
	case 'user/dispatch/reporting/dispatch-continuity':
		if (in_array('DIS003', USER_PRIV)) {
			require_once APPROOT . '/views/user/dispatch/reporting/dispatch-continuity.php';
		}
		break;

	case 'user/dispatch/reporting/dispatch-continuity/add-empty-miles':
		if (in_array('DIS004', USER_PRIV)) {
			require_once APPROOT . '/views/user/dispatch/reporting/dispatch-continuity-add-empty-miles.php';
		}
		break;

	case 'user/dispatch/reporting/dispatch-continuity/add-empty-miles-action':
		$_POST['user_key'] = USER_KEY;

		echo 		$a = callSGWS('user/dispatch/reporting/dispatch-continuity/add-empty-miles', $_POST);
		// echo "<pre>";
		// print_r(json_decode($a, true));
		// echo "</pre>";
	break;

case 'user/dispatch/reporting/reefer-reporting/list-ajax-dumy':
		$_POST['user_key'] = USER_KEY;
		$a = callSGWS('user/dispatch/reporting/reefer-reporting-list', $_POST);
		echo "<pre>";
		print_r(json_decode($a,true));
		echo "</pre>";
		break;


	case 'user/dispatch/reporting/reefer-reporting/list-ajax':
		$_POST['user_key'] = USER_KEY;
		echo 		$a = callSGWS('user/dispatch/reporting/reefer-reporting-list', $_POST);
		break;
	case 'user/dispatch/reporting/reefer-reporting/list':
		if (in_array('DIS003', USER_PRIV)) {
			require_once APPROOT . '/views/user/dispatch/reporting/reefer-reporting-list.php';
		}
		break;


	default:
		//GT_default_page();
		break;
}
