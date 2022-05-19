
<?php
$nav_type='safety';
switch (getUri()) {

	case 'user/masters/driver-teams/quick-list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/masters/driver-teams/quick-list',$_POST);

	break;

	case 'user/masters/driver-teams/list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/masters/driver-teams/list',$_POST);
	break;
	case 'user/masters/driver-teams/list':
	require_once APPROOT.'/views/user/masters/drivers/teams-list.php';	
	break;

	case 'user/masters/driver-teams/add-new':
	if(in_array('P0365', USER_PRIV)){
		require_once APPROOT.'/views/user/masters/drivers/teams-add-new.php';
	}
	break;

	case 'user/masters/driver-teams/add-new-action':	
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/masters/driver-teams/add-new',$_POST);
	}
	break;
	
	case 'user/masters/driver-teams/update':
	if(in_array('P0367', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/masters/driver-teams/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/masters/drivers/teams-update.php';
			}

		}
	}
	break;

	case 'user/masters/driver-teams/update-action':
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/masters/driver-teams/update',$_POST);
	}
	break;
	case 'user/masters/driver-teams/delete-action':
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/masters/driver-teams/delete',$_POST);
	}
	break;			
	default:
	//GT_default_page();
	break;
}

?>