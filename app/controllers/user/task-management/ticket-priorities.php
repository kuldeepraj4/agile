<?php
$nav_type='task-management';

	switch (getUri()) {
		case 'user/task-management/ticket-priorities/list-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/task-management/ticket-priorities',$param);
			break;

		default:
			//GT_default_page();
			break;
	}
?>