<?php
$nav_type='dispatch';
switch (getUri()) {

	case 'user/dispatch/long-haul-assignments-driver-wise-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/long-haul-assignments/list-driver-wise',array_merge($_POST));
	break;

	case 'user/dispatch/long-haul-assignments-driver-wise-un-assigned-quick-list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/long-haul-assignments/list-driver-wise-un-assigned-quick-list',array_merge($_POST));
	break;

	case 'user/dispatch/long-haul-assignments-driver-wise':
	if(in_array('DIS053', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/long-haul-assignments/lha-list-driver-wise.php';
	}	
	break;

	case 'user/dispatch/long-haul-assignments-load-wise-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/long-haul-assignments/list-load-wise',$_POST);
	break;

	case 'user/dispatch/long-haul-assignments-load-wise-un-assigned-quick-list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/long-haul-assignments/list-load-wise-un-assigned-quick-list',$_POST);
	break;



	case 'user/dispatch/long-haul-assignments-load-wise':
	if(in_array('DIS053', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/long-haul-assignments/lha-list-load-wise.php';
	}	
	break;

	case 'user/dispatch/long-haul-assignments/add-new':
	if(in_array('DIS052', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/long-haul-assignments/lha-add-new.php';
	}
	break;

	case 'user/dispatch/long-haul-assignments/add-new-action':	
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/long-haul-assignments/add-new',$_POST);
	break;

	case 'user/dispatch/long-haul-assignments/update':
	if(in_array('DIS054', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/dispatch/long-haul-assignments/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/long-haul-assignments/lha-update.php';
			}

		}
	}
	break;
	case 'user/dispatch/long-haul-assignments/update-action':	
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/long-haul-assignments/update',$_POST);
	break;

	case 'user/dispatch/long-haul-assignments/history-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/long-haul-assignments/history',array_merge($_POST));
	break;

	case 'user/dispatch/long-haul-assignments/history':
	if(in_array('DIS053', USER_PRIV)){
		if(isset($_GET['eid'])){
			require_once APPROOT.'/views/user/dispatch/long-haul-assignments/lha-history.php';
		}
	}
	break;



	case 'user/dispatch/long-haul-assignments/assign-load':
	if(in_array('DIS054', USER_PRIV)){
		if(isset($_GET['lha-id'])){
			require_once APPROOT.'/views/user/dispatch/long-haul-assignments/lha-assign-load.php';
		}
		
	}
	break;

	case 'user/dispatch/long-haul-assignments/assign-driver-truck':
	if(in_array('DIS054', USER_PRIV)){
		if(isset($_GET['id'])){
			require_once APPROOT.'/views/user/dispatch/long-haul-assignments/lha-assign-driver-truck.php';
		}
		
	}
	break;



	case 'user/dispatch/long-haul-assignments/assign-load-action':
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/long-haul-assignments/assign-load',$_POST);
	break;

	case 'user/dispatch/long-haul-assignments/assign-load-action':
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/long-haul-assignments/assign-load',$_POST);
	break;

	case 'user/dispatch/long-haul-assignments/un-assign-load-action':
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/long-haul-assignments/un-assign-load',$_POST);
	break;


	case 'user/dispatch/long-haul-assignments/update-driver-started-at-datetime':
	if(in_array('DIS054', USER_PRIV)){
		if(isset($_GET['eid'])){
			require_once APPROOT.'/views/user/dispatch/long-haul-assignments/update-driver-started-at-datetime.php';
		}
		
	}
	break;

	case 'user/dispatch/long-haul-assignments/update-driver-started-at-datetime-action':
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/long-haul-assignments/update-driver-started-at-datetime',$_POST);
	break;

	case 'user/dispatch/long-haul-assignments/notes':
		if(isset($_GET['eid'])){
		require_once APPROOT.'/views/user/dispatch/long-haul-assignments/lha-notes.php';

		}
		
	break;

	case 'user/dispatch/long-haul-assignments/last-assigned-drivers-on-truck-quick-list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/long-haul-assignments/last-assigned-drivers-on-truck-quick-list',array_merge($_POST));
	break;

	case 'user/dispatch/long-haul-assignments/date-wise-total-drivers-ajax':
	$_POST['user_key']=USER_KEY;

	echo callSGWS('user/dispatch/long-haul-assignments/date-wise-total-drivers',$_POST);
	break;


	case 'user/dispatch/long-haul-assignments/date-wise-total-loads-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/long-haul-assignments/date-wise-total-loads',$_POST);

	break;


	case 'user/dispatch/long-haul-assignments/cancel':
	if(isset($_GET['eid'])){
	$_POST['user_key']=USER_KEY;
	require_once APPROOT.'/views/user/dispatch/long-haul-assignments/lha-cancel.php';
}
	break;

	case 'user/dispatch/long-haul-assignments/cancel-action':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/long-haul-assignments/cancel',$_POST);

	break;

	default:
			//GT_default_page();
	break;
}

?>