<?php
$nav_type='masters';

	switch (getUri()) {
		case 'user/masters/miscellaneous/payment-modes-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/payment-modes/list',$param);
				
			break;
		default:
			//GT_default_page();
			break;
	}

?>