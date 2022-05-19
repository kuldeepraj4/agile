<?php
$nav_type='dispatch';
switch (getUri()) {
	case 'user/dispatch/load-types-quick-list-ajax':
	$param['user_key']=USER_KEY;
	$param=array_merge($param,$_POST);
	echo callSGWS('user/dispatch/load-types/quick-list',$param);
	break;
	case 'user/dispatch/express-loads/add-new':
	if(in_array('P0175', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/loads/express-loads-add-new.php';
	}
	break;

	default:
			//GT_default_page();
	break;
}

?>