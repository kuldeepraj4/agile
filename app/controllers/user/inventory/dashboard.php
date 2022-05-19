<?php

$nav_type='inventory';


switch (getUri()) {


	case 'user/inventory/dashboard':
	require_once APPROOT.'/views/user/inventory/dashboard.php';
	break;



	default:

	echo NOT_VALID_REQUEST;

	break;

}


?>