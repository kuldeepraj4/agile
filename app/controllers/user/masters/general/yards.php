<?php
$nav_type='masters';

	switch (getUri()) {

		case 'user/masters/yards/quick-list-ajax':
			$param['user_key']=USER_KEY;
			echo callSGWS('user/masters/yards/quick-list',$param);
			break;

		case 'user/masters/route-types':
			require_once APPROOT.'/views/user/masters/general/route-types.php';	
			break;
		default:
			//GT_default_page();
			break;
	}

?>