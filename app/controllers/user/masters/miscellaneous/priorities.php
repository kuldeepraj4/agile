<?php
$nav_type='masters';

	switch (getUri()) {
		case 'user/masters/miscellaneous/priorities-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/priorities/list',$param);
				
			break;
		case 'user/masters/miscellaneous/priorities':
			require_once APPROOT.'/views/user/masters/miscellaneous/priorities.php';
			break;
		default:
			//GT_default_page();
			break;
	}

?>