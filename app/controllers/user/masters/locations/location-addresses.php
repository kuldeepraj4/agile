<?php
$nav_type = 'masters';

if (in_array('P0237', USER_PRIV)) {
	switch (getUri()) {
		case 'user/masters/locations/location-addresses/add-new':
			if (in_array('P0238', USER_PRIV)) {
				require_once APPROOT . '/views/user/masters/locations/location-addresses-add-new.php';
			}
			break;

		case 'user/masters/locations/location-addresses/add-new-action':
			if (isset($_POST)) {
				$_POST['user_key'] = USER_KEY;
				echo $response = callSGWS('user/masters/locations/addresses/add-new', $_POST);
			}
			break;

		case 'user/masters/locations/location-addresses-quick-list-ajax':
			$param['user_key'] = USER_KEY;
			if (isset($_POST)) {
				$param = array_merge($param, $_POST);
			}
			echo callSGWS('user/masters/locations/addresses/list', $param);
			break;


		case 'user/masters/locations/location-addresses/update_locations':
			$param['user_key'] = USER_KEY;
			if (isset($_POST)) {
				$param = array_merge($param, $_POST);
			}
			echo callSGWS('user/masters/locations/addresses/update_locations', $param);
			break;



		case 'user/masters/locations/location-addresses-ajax':
			$param['user_key'] = USER_KEY;
			if (isset($_POST)) {
				$param = array_merge($param, $_POST);
			}
			echo callSGWS('user/masters/locations/addresses/list', $param);
			break;

		case 'user/masters/locations/location-addresses':
			require_once APPROOT . '/views/user/masters/locations/location-addresses.php';
			break;

		case 'user/masters/locations/location-addresses-detail-ajax':
			echo callSGWS('user/masters/locations/addresses/details', array('user_key' => USER_KEY, 'eid' => $_POST['eid']));
			break;

		case 'user/masters/locations/location-addresses/details':
			if (isset($_GET['eid'])) {
				$data = [];
				$data['eid'] = $_GET['eid'];
				$data['details'] = [];
				$response = callSGWS('user/masters/locations/addresses/details', array('user_key' => USER_KEY, 'eid' => $_GET['eid']));
				$OBJ = json_decode($response, true);
				if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
					$data['details'] = $OBJ['response']['details'];
					require_once APPROOT . '/views/user/masters/locations/location-addresses-details.php';
				}
			}
			break;
		case 'user/masters/locations/location-addresses/update':
			if (isset($_GET['eid'])) {
				$data = [];
				$data['eid'] = $_GET['eid'];
				$data['details'] = [];
				$response = callSGWS('user/masters/locations/addresses/details', array('user_key' => USER_KEY, 'eid' => $_GET['eid']));
				$OBJ = json_decode($response, true);
				if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
					$data['details'] = $OBJ['response']['details'];
					require_once APPROOT . '/views/user/masters/locations/location-addresses-update.php';
				}
			}
			break;

		case 'user/masters/locations/location-addresses/update-action':
			if (isset($_POST)) {
				$_POST['user_key'] = USER_KEY;
				echo $response = callSGWS('user/masters/locations/addresses/update', $_POST);
			}
			break;
		case 'user/masters/locations/location-addresses/delete-action':
			if (isset($_POST)) {
				$_POST['user_key'] = USER_KEY;
				echo $response = callSGWS('user/masters/locations/location-addresses/delete', $_POST);
			}
			break;
		case 'user/masters/locations/old-location-addresses':
			require_once APPROOT . '/views/user/masters/locations/old-location-addresses.php';
			break;
		case 'user/masters/locations/old-location-addresses-ajax':
			$param['user_key'] = USER_KEY;
			if (isset($_POST)) {
				$param = array_merge($param, $_POST);
			}
			echo callSGWS('user/masters/locations/old-addresses/list', $param);
			break;
		case 'user/masters/locations/old-location-addresses/convert-from-old':
			if (isset($_GET['eid'])) {
				$data = [];
				$data['eid'] = $_GET['eid'];
				$data['details'] = [];
				$response = callSGWS('user/masters/locations/old-addresses/old-details', array('user_key' => USER_KEY, 'eid' => $_GET['eid']));
				$OBJ = json_decode($response, true);
				if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
					$data['details'] = $OBJ['response']['details'];
					require_once APPROOT . '/views/user/masters/locations/old-location-addresses-convert-from-old.php';
				}
			}
			break;

		case 'user/masters/locations/location-addresses/add-new-manual':
			if (in_array('P0238', USER_PRIV)) {
				require_once APPROOT . '/views/user/masters/locations/location-addresses-add-new-manual.php';
			}
			break;

		case 'user/masters/locations/location-addresses/add-new-manual-action':
			if (isset($_POST)) {
				$_POST['user_key'] = USER_KEY;
				echo $response = callSGWS('user/masters/locations/addresses/add-new-manual', $_POST);
			}
			break;
		case 'user/masters/locations/old-location-addresses/reject-action':
			if (isset($_POST)) {
				$_POST['user_key'] = USER_KEY;
				echo $response = callSGWS('user/masters/locations/old-location-addresses/reject', $_POST);
			}
			break;

		case 'user/masters/locations/location-addresses/quick-add-new':
			if (in_array('P0238', USER_PRIV)) {
				require_once APPROOT . '/views/user/masters/locations/location-addresses-quick-add-new.php';
			}
			break;

		default:
			//GT_default_page();
			break;
	}
} else {
	//GT_default_page();
}
