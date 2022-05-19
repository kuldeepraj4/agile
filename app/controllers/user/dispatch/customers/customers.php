<?php
$nav_type='dispatch';
switch (getUri()) {
	case 'user/dispatch/customers/add-new':
	if(in_array('P0162', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/customers/customers-add-new.php';
	}
	break;

	case 'user/dispatch/customers/add-new-action':	
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/customers/add-new',$_POST);
	}
	break;

	case 'user/dispatch/customers-quick-list-ajax':
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo callSGWS('user/dispatch/customers/quick-list',$_POST);
	}
	

	case 'user/dispatch/customers/customers-verify':
	if(in_array('P0337', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['details']=[];
			$response =callSGWS('user/dispatch/customers/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/customers/customers-verify.php';
			}

		}
	}	
	break;


	case 'user/dispatch/customers/approve-details-action':
	if(in_array('P0337', USER_PRIV)){
	$_POST['user_key']=USER_KEY;	 
	echo $response =callSGWS('user/dispatch/customers/approve-details',$_POST);
	}
	break;

	case 'user/dispatch/customers/reject-details-action':
	if(in_array('P0337', USER_PRIV)){
	$_POST['user_key']=USER_KEY;	
	echo $response =callSGWS('user/dispatch/customers/reject-details',$_POST);
	}
	break;


	break;	
	case 'user/dispatch/customers-ajax':
	if(in_array('P0163', USER_PRIV)){
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/dispatch/customers/list',$param);
	}	
	break;
	case 'user/dispatch/customers':

	if(in_array('P0163', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/customers/customers.php';
	}	
	break;

	case 'user/dispatch/customers/details':
	if(in_array('P0163', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['details']=[];
			$response =callSGWS('user/dispatch/customers/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/customers/customers-details.php';
			}

		}
	}	
	break;
	case 'user/dispatch/customers/update':
	if(in_array('P0164', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/dispatch/customers/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/customers/customers-update.php';
			}

		}
	}
	break;

	case 'user/dispatch/customers/update-action':
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/customers/update',$_POST);
	}
	break;				
	
	default:
			//GT_default_page();
	break;
}

?>