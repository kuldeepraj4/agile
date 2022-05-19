
<?php
$nav_type='dispatch';
switch (getUri()) {

	case 'user/dispatch/masters/bill-accessories/quick-list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/masters/bill-accessories/quick-list',$_POST);
	break;

	case 'user/dispatch/masters/bill-accessories/list-ajax':
	if(in_array('DIS010', USER_PRIV)){
$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/masters/bill-accessories/list',$_POST);
	}
	
	break;
	case 'user/dispatch/masters/bill-accessories/list':
	if(in_array('DIS010', USER_PRIV)){
	require_once APPROOT.'/views/user/dispatch/masters/bill-accessories-list.php';	
}
	break;

	case 'user/dispatch/masters/bill-accessories/add-new':
	if(in_array('DIS009', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/masters/bill-accessories-add-new.php';
	}
	break;

	case 'user/dispatch/masters/bill-accessories/add-new-action':	
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/masters/bill-accessories/add-new',$_POST);
	}
	break;
	
	case 'user/dispatch/masters/bill-accessories/update':
	if(in_array('DIS011', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/dispatch/masters/bill-accessories/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/masters/bill-accessories-update.php';
			}

		}
	}
	break;

	case 'user/dispatch/masters/bill-accessories/update-action':
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/masters/bill-accessories/update',$_POST);
	}
	break;
	case 'user/dispatch/masters/bill-accessories/delete-action':
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/masters/bill-accessories/delete',$_POST);
	}
	break;			
	default:
	//GT_default_page();
	break;
}

?>