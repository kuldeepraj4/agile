<?php
$nav_type='masters';

	switch (getUri()) {

		case 'user/masters/drivers/types-ajax':
				$param['user_key']=USER_KEY;
				$param=array_merge($param,$_POST);
			echo callSGWS('user/masters/driver-types/quick-list',$param);
				
			break;

		default:
			//GT_default_page();
			break;
	}

?>