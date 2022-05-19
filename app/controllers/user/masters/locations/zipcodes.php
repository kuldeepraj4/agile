<?php
$nav_type = 'masters';

if (in_array('P0012', USER_PRIV)) {


	switch (getUri()) {
		case 'user/masters/locations/zipcodes/add-new':
			if (in_array('P0013', USER_PRIV)) {
				require_once APPROOT . '/views/user/masters/locations/zipcodes-add-new.php';
			}
			break;

		case 'user/masters/locations/zipcodes/add-new-action':
			if (isset($_POST)) {
				$_POST['user_key'] = USER_KEY;
				echo $response = callSGWS('user/masters/locations/zipcodes/add-new', $_POST);
			}
			break;

		case 'user/masters/locations/zipcodes-ajax':
			$param['user_key'] = USER_KEY;
			if (isset($_POST)) {
				$param = array_merge($param, $_POST);
			}
			echo callSGWS('user/masters/locations/zipcodes/list', $param);
			break;

		case 'user/masters/locations/zipcodes':
			require_once APPROOT . '/views/user/masters/locations/zipcodes.php';
			break;

		case 'user/masters/locations/zipcodes/update':
			if (isset($_GET['eid'])) {
				$data = [];
				$data['eid'] = $_GET['eid'];
				$data['details'] = [];
				$response = callSGWS('user/masters/locations/zipcodes/details', array('user_key' => USER_KEY, 'details_for_eid' => $_GET['eid']));
				$OBJ = json_decode($response, true);
				if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
					$data['details'] = $OBJ['response']['details'];
					require_once APPROOT . '/views/user/masters/locations/zipcodes-update.php';
				}
			}
			break;

		case 'user/masters/locations/zipcodes/update-action':
			if (isset($_POST)) {
				$_POST['user_key'] = USER_KEY;
				echo $response = callSGWS('user/masters/locations/zipcodes/update', $_POST);
			}
			break;
		case 'user/masters/locations/zipcodes/delete-action':
			if (isset($_POST)) {
				$_POST['user_key'] = USER_KEY;
				echo $response = callSGWS('user/masters/locations/zipcodes/delete', $_POST);
			}
			break;
		case 'user/masters/locations/zipcodes/quick-add-new':
			if (in_array('P0013', USER_PRIV)) {
				require_once APPROOT . '/views/user/masters/locations/zipcodes-quick-add-new.php';
			}
			break;


		default:
			//GT_default_page();
			break;
	}
} else {
	GT_default_page();
}
