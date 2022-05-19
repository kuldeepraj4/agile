<?php
$nav_type='safety';

	switch (getUri()) {

		case 'user/masters/drivers/groups-ajax':
				$param['user_key']=USER_KEY;
				$param=array_merge($param,$_POST);
			echo callSGWS('user/masters/driver-groups/list',$param);
				
			break;

		default:
			//GT_default_page();
			break;
	}

?>