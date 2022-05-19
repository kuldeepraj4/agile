<?php
$nav_type='maintenance';

if(in_array('P0244', USER_PRIV)){

	switch (getUri()) {
		
		//List Mode	
		case 'user/maintenance/masters/repair-order-class-list-ajax':
		if(in_array('P0246', USER_PRIV)){
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/repair-order-class/list',$param);
		}
		break;
				
		default:
		echo NOT_VALID_REQUEST;
		break;
	}
}else{
	echo NOT_VALID_REQUEST;
}
?>