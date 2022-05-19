<?php
$nav_type='masters';

if(in_array('P0238', USER_PRIV)){


	switch (getUri()) {
		// case 'user/masters/locations/cities/add-new':
		// if(in_array('P0013', USER_PRIV)){
		// 	require_once APPROOT.'/views/user/masters/locations/cities-add-new.php';
		// }
		// break;

		case 'user/masters/locations/stopoff/quick-add-new':
		if(in_array('P0238', USER_PRIV)){
			require_once APPROOT.'/views/user/masters/locations/stopoff-quick-add-new.php';
		}
		break;

		// case 'user/masters/locations/cities/add-new-action':
		// if(isset($_POST)){
		// 	$_POST['user_key']=USER_KEY;
		// 	echo $response =callSGWS('user/masters/locations/cities/add-new',$_POST);
		// }
		// break;
		

		default:
		GT_default_page();
		break;
	}
}else{
	GT_default_page();
}
