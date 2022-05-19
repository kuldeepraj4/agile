<?php
$nav_type='masters';

	switch (getUri()) {

		case 'user/masters/dispatch/load-cancellation-reasons/quick-list-ajax':
				$_POST['user_key']=USER_KEY;
			echo callSGWS('user/masters/dispatch/load-cancellation-reasons/quick-list',$_POST);
				
			break;

		default:
			//GT_default_page();
			break;
	}

?>