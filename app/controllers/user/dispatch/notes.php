<?php
switch (getUri()) {
	
	case 'user/dispatch/notes/express-load-notes-list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/notes/express-load-notes-list',$_POST);
	break;

	case 'user/dispatch/notes/long-haul-assignments-notes-list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/notes/long-haul-assignments-notes-list',$_POST);
	break;
	case 'user/dispatch/notes/lh-assignment/notes-list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/notes/lh-assignment/notes-list',$_POST);
	break;

	case 'user/dispatch/notes/loads/notes-list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/notes/loads/notes-list',$_POST);
	break;


	case 'user/dispatch/notes/toggle-high-priority-status-action':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/notes/toggle-high-priority-status',$_POST);
	break;

	case 'user/dispatch/notes/add-new-action':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/notes/add-new/',$_POST);
	break;

	case 'user/dispatch/notes/delete-action':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/notes/delete',$_POST);
	break;

	default:
			//GT_default_page();
	break;
}

?>