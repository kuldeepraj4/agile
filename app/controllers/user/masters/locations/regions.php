<?php

	switch (getUri()) {
case 'user/masters/location-regions-list-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
			echo callSGWS('user/masters/location-regions/list',$param);
		break;		


		default:
		//GT_default_page();
		break;
	}

?>