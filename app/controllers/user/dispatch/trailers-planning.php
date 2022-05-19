<?php
$nav_type='dispatch';
switch (getUri()) {
	case 'user/dispatch/trailers-planning-ajax':
		$_POST['user_key']=USER_KEY;
		echo  callSGWS('user/dispatch/planning/trailers-planning-list',$_POST);
	break;
	case 'user/dispatch/trailers-planning':
		require_once APPROOT.'/views/user/dispatch/planning/trailers-planning.php';
	break;			

	default:
			//GT_default_page();
	break;
}

?>