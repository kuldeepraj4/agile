
<?php
$nav_type='dispatch';
switch (getUri()) {

	case 'user/dispatch/masters/load-earning-losses-types/quick-list-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/masters/load-earning-losses-types/quick-list',$_POST);
	break;

// 	case 'user/dispatch/masters/load-earning-losses-types/list-ajax':
// 	if(in_array('DIS010', USER_PRIV)){
// $_POST['user_key']=USER_KEY;
// 	echo callSGWS('user/dispatch/masters/load-earning-losses-types/list',$_POST);
// 	}
	
// 	break;
// 	case 'user/dispatch/masters/load-earning-losses-types/list':
// 	if(in_array('DIS010', USER_PRIV)){
// 	require_once APPROOT.'/views/user/dispatch/masters/load-earning-losses-types-list.php';	
// }
// 	break;

// 	case 'user/dispatch/masters/load-earning-losses-types/add-new':
// 	if(in_array('DIS009', USER_PRIV)){
// 		require_once APPROOT.'/views/user/dispatch/masters/load-earning-losses-types-add-new.php';
// 	}
// 	break;

// 	case 'user/dispatch/masters/load-earning-losses-types/add-new-action':	
// 	if(isset($_POST)){
// 		$_POST['user_key']=USER_KEY;
// 		echo $response =callSGWS('user/dispatch/masters/load-earning-losses-types/add-new',$_POST);
// 	}
// 	break;
	
// 	case 'user/dispatch/masters/load-earning-losses-types/update':
// 	if(in_array('DIS011', USER_PRIV)){
// 		if(isset($_GET['eid'])){
// 			$data=[];
// 			$data['eid']=$_GET['eid'];
// 			$data['details']=[];
// 			$response =callSGWS('user/dispatch/masters/load-earning-losses-types/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
// 			$OBJ=json_decode($response,true);
// 			if($OBJ['status']==true && isset($OBJ['response']['details'])){
// 				$data['details']=$OBJ['response']['details'];
// 				require_once APPROOT.'/views/user/dispatch/masters/load-earning-losses-types-update.php';
// 			}

// 		}
// 	}
// 	break;

// 	case 'user/dispatch/masters/load-earning-losses-types/update-action':
// 	if(isset($_POST)){
// 		$_POST['user_key']=USER_KEY;
// 		echo $response =callSGWS('user/dispatch/masters/load-earning-losses-types/update',$_POST);
// 	}
// 	break;
// 	case 'user/dispatch/masters/load-earning-losses-types/delete-action':
// 	if(isset($_POST)){
// 		$_POST['user_key']=USER_KEY;
// 		echo $response =callSGWS('user/dispatch/masters/load-earning-losses-types/delete',$_POST);
// 	}
// 	break;			
	default:
	//GT_default_page();
	break;
}

?>