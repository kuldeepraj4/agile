<?php
$nav_type='task-management';

switch (getUri()) {
    case 'user/task-management/ticket-notifications/user-notifications':
	require_once APPROOT.'/views/user/task-management/tickets/ticket-notifications-quick-view.php';
	break;
	case 'user/task-management/ticket-notifications/user-notifications-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/task-management/ticket-notifications/user-notifications',$param);
	break;

	case 'user/task-management/ticket-notifications/user-total-unread-notifications-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/task-management/ticket-notifications/user-total-unread-notifications',$param);
	break;
	default:
			//GT_default_page();
	break;
}
?>