<?php
$nav_type='task-management';
switch (getUri()) {

	case 'user/task-management/tickets/summary-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/task-management/tickets/summary',$param);
	break;

	case 'user/task-management/tickets/summary':
	require_once APPROOT.'/views/user/task-management/tickets/tickets-summary.php';
	break;


	case 'user/task-management/tickets/create-new':
	require_once APPROOT.'/views/user/task-management/tickets/tickets-create-new.php';
	break;

	case 'user/task-management/tickets/create-new-action':	
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		if(isset($_FILES['document'])) {
			echo $response =callSGWS('user/task-management/tickets/add-new',$_POST, $_FILES['document']);	
		}else {
			echo $response =callSGWS('user/task-management/tickets/add-new',$_POST, "");
		}
		
	}
	break;
	case 'user/task-management/tickets/tickets-by-user-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/task-management/tickets/tickets-by-user',$param);
	break;

	case 'user/task-management/tickets/tickets-by-user':
	$data=[];
	$data['stage_id']='';
	if(isset($_GET['stage'])){
		$data['stage_id']=$_GET['stage'];
	}

	require_once APPROOT.'/views/user/task-management/tickets/tickets-by-user.php';
	break;


	case 'user/task-management/tickets/tickets-for-user-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/task-management/tickets/tickets-for-user',$param);
	break;

	case 'user/task-management/tickets/tickets-for-user':
	$data=[];
	$data['stage_id']='';
	if(isset($_GET['stage'])){
		$data['stage_id']=$_GET['stage'];
	}

	require_once APPROOT.'/views/user/task-management/tickets/tickets-for-user.php';
	break;


	case 'user/task-management/tickets/tickets-for-team-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo $a=callSGWS('user/task-management/tickets/tickets-for-team',$param);
	break;

	case 'user/task-management/tickets/tickets-for-team':
	$data=[];
	$data['stage_id']='';
	if(isset($_GET['stage'])){
		$data['stage_id']=$_GET['stage'];
	}
	
	require_once APPROOT.'/views/user/task-management/tickets/tickets-for-team.php';
	break;



	case 'user/task-management/tickets/details':
	if(isset($_GET['eid'])){
		$data=[];
		$data['eid']=$_GET['eid'];
		$response =callSGWS('user/task-management/tickets/details',array('user_key'=>USER_KEY,'ticket_eid'=>$_GET['eid']));
		$OBJ=json_decode($response,true);
		if($OBJ['status']==true && isset($OBJ['response']['details'])){
			$data['details']=$OBJ['response']['details'];
			require_once APPROOT.'/views/user/task-management/tickets/ticket-details.php';
		}

	}

	break;

	case 'user/task-management/tickets/tickets-add-action':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo $response =callSGWS('user/task-management/tickets/tickets-add-action',$param);

	break;			
		case 'user/task-management/tickets/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/task-management/tickets/details',array('user_key'=>USER_KEY,'ticket_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/task-management/tickets/tickets-update.php';
					}

					}
			break;

		case 'user/task-management/tickets/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							if(isset($_FILES['document'])) {
								echo $response =callSGWS('user/task-management/tickets/update',$_POST, $_FILES['document']);
							} else {
								echo $response =callSGWS('user/task-management/tickets/update',$_POST, '');
							}
						}
			break;

		case 'user/task-management/tickets/tickets-by-user/delete-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/task-management/tickets/delete',$_POST);
		break;
			
	default:
	GT_default_page();
	break;
}

?>
