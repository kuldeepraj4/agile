<?php
$nav_type='masters';

if(in_array('P0047', USER_PRIV)){

	switch (getUri()) {

		//List Mode	
		case 'user/masters/vehicles-list-ajax':
		if(in_array('P0049', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/vehicles/list',$param);
			}	
			break;
		default:
			//GT_default_page();
			break;
	}
}else{
	//GT_default_page();
}
?>