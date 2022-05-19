<?php
$nav_type='maintenance';
if(in_array('P0007', USER_PRIV)){

	switch (getUri()) {

		case 'user/maintenance/preventive-maintenance-list-truck-ajax':
		if(in_array('P0009', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/maintenance/preventive-maintenance-list-truck/list',$param);
		}
		break;

		case 'user/maintenance/preventive-maintenance-list-truck':
		if(in_array('P0009', USER_PRIV)){
			require_once APPROOT.'/views/user/maintenance/preventive-maintenance-list-truck.php';
		}
		break;
	
		default:
		GT_default_page();
		break;
	}
}else{
	GT_default_page();
}
?>