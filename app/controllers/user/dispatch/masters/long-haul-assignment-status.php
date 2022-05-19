<?php

$nav_type='dispatch';

switch (getUri()) {

	case 'user/dispatch/long-haul-assignment-status-list-ajax':
			if(isset($_POST)){
				$_POST['user_key']=USER_KEY;
				echo callSGWS('user/dispatch/long-haul-assignment-status/list',$_POST);
			}
			break;
		default:
			//GT_default_page();
			break;
	}

?>