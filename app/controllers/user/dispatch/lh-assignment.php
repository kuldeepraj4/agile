<?php
$nav_type='dispatch';
switch (getUri()) {

	case 'user/dispatch/lh-assignment/driver-wise-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/lh-assignment/list-driver-wise',array_merge($_POST));
	break;

	case 'user/dispatch/lh-assignment/driver-wise-un-assigned-quick-list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/lh-assignment/list-driver-wise-un-assigned-quick-list',array_merge($_POST));
	break;

	case 'user/dispatch/lh-assignment/driver-wise':
	if(in_array('DIS053', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/lh-assignment/driver-wise.php';
	}	
	break;

	case 'user/dispatch/lh-assignment/load-wise-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/lh-assignment/list-load-wise',$_POST);
	break;

	case 'user/dispatch/lh-assignment/load-wise-un-assigned-quick-list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/lh-assignment/list-load-wise-un-assigned-quick-list',$_POST);
	break;




	case 'user/dispatch/lh-assignment/load-wise':
	if(in_array('DIS053', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/lh-assignment/load-wise.php';
	}	
	break;

	case 'user/dispatch/lh-assignment/add-new':
	if(in_array('DIS052', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/lh-assignment/add-new.php';
	}
	break;

	case 'user/dispatch/lh-assignment/add-new-action':	
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/lh-assignment/add-new',$_POST);
	break;

	case 'user/dispatch/lh-assignment/update':
	if(in_array('DIS054', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			 $response =callSGWS('user/dispatch/lh-assignment/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/lh-assignment/update.php';
			}

		}
	}
	break;
	case 'user/dispatch/lh-assignment/update-action':	
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/lh-assignment/update',$_POST);
	break;

	case 'user/dispatch/lh-assignment/history-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/lh-assignment/history',array_merge($_POST));
	break;

	case 'user/dispatch/lh-assignment/history':
	if(in_array('DIS053', USER_PRIV)){
		if(isset($_GET['eid'])){
			require_once APPROOT.'/views/user/dispatch/lh-assignment/lha-history.php';
		}
	}
	break;



	case 'user/dispatch/lh-assignment/assign-load':
	if(in_array('DIS054', USER_PRIV)){
		if(isset($_GET['lha-id'])){
			require_once APPROOT.'/views/user/dispatch/lh-assignment/assign-load.php';
		}
		
	}
	break;

	case 'user/dispatch/lh-assignment/assign-load-action':
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/lh-assignment/assign-load',$_POST);
	break;

	
	case 'user/dispatch/lh-assignment/assign-driver-truck':
	if(in_array('DIS054', USER_PRIV)){
		if(isset($_GET['id'])){
			require_once APPROOT.'/views/user/dispatch/lh-assignment/assign-driver-truck.php';
		}
		
	}
	break;

	case 'user/dispatch/lh-assignment/assign-driver-truck-action':
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/lh-assignment/assign-load',$_POST);
	break;


	case 'user/dispatch/lh-assignment/un-assign-load-action':
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/lh-assignment/un-assign-load',$_POST);
	break;


	case 'user/dispatch/lh-assignment/update-driver-started-at-datetime':
	if(in_array('DIS054', USER_PRIV)){
		if(isset($_GET['eid'])){

			if(isset($_GET['driver-started-date-time']) && $_GET['driver-started-date-time']!=""){
				$data['driver_start_date']=date('m/d/Y',strtotime($_GET['driver-started-date-time']));
				$data['driver_start_time']=date('H:i',strtotime($_GET['driver-started-date-time']));
			}else{
				$data['driver_start_date']="";
				$data['driver_start_time']="";
			}

			require_once APPROOT.'/views/user/dispatch/lh-assignment/update-driver-started-at-datetime.php';
		}
		
	}
	break;

	case 'user/dispatch/lh-assignment/update-driver-started-at-datetime-action':
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/lh-assignment/update-driver-started-at-datetime',$_POST);
	break;

	case 'user/dispatch/lh-assignment/notes':
		if(isset($_GET['eid'])){
		require_once APPROOT.'/views/user/dispatch/lh-assignment/lh-notes.php';

		}
		
	break;

	case 'user/dispatch/lh-assignment/last-assigned-drivers-on-truck-quick-list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/lh-assignment/last-assigned-drivers-on-truck-quick-list',array_merge($_POST));
	break;

	case 'user/dispatch/lh-assignment/date-wise-total-drivers-ajax':
	$_POST['user_key']=USER_KEY;

	echo callSGWS('user/dispatch/lh-assignment/date-wise-total-drivers',$_POST);
	break;


	case 'user/dispatch/lh-assignment/date-wise-total-loads-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/lh-assignment/date-wise-total-loads',$_POST);

	break;


	case 'user/dispatch/lh-assignment/cancel':
	if(isset($_GET['eid'])){
	$_POST['user_key']=USER_KEY;
	require_once APPROOT.'/views/user/dispatch/lh-assignment/lha-cancel.php';
}
	break;

	case 'user/dispatch/lh-assignment/cancel-action':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/lh-assignment/cancel',$_POST);
	break;

	default:
			//GT_default_page();
	break;
}

?>