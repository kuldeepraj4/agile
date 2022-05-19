<?php
$nav_type='dispatch';
switch (getUri()) {
	case 'user/dispatch/trucks-planning-ajax':
		$_POST['user_key']=USER_KEY;
		echo  callSGWS('user/dispatch/planning/trucks-planning-list',$_POST);
	break;
	case 'user/dispatch/trucks-planning':
		require_once APPROOT.'/views/user/dispatch/planning/trucks-planning.php';
	break;			

	default:
			//GT_default_page();
	break;
}

?>