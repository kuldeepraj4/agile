<?php

switch (getUri()) {
	case 'user/masters/location-zones-quick-list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/masters/location-zones/quick-list',$_POST);
	break;		

	case 'user/masters/location-zones-list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/masters/location-zones/list',$_POST);
	break;

	default:
		//GT_default_page();
	break;
}

?>