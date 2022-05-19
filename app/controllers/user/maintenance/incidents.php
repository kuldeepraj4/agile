<?php
$nav_type='maintenance';
if(in_array('P0277', USER_PRIV)){

	switch (getUri()) {
		case 'user/maintenance/incidents':
		require_once APPROOT.'/views/user/maintenance/incidents/incidents.php';
		break;

		case 'user/maintenance/incidents-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/incidents/list',$param);
		break;

		case 'user/maintenance/incidents/add-new':
		if(in_array('P0278', USER_PRIV)){
			require_once APPROOT.'/views/user/maintenance/incidents/incidents-add-new.php';
		}
		break;
		
		case 'user/maintenance/incidents/add-new-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/incidents/add-new',$_POST);
		}
		break;

		case 'user/maintenance/incidents/details':
		if(in_array('P0279', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['details']=[];
				$response =callSGWS('user/maintenance/incidents/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/incidents/incidents-details.php';
				}
			}
		}	
		break;

		case 'user/maintenance/incidents/update':
		if(in_array('P0280', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				$data['details']=[];
				$response =callSGWS('user/maintenance/incidents/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				//echo ($response);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/incidents/incidents-update.php';
				}
			}
		}
		break;

		case 'user/maintenance/incidents/update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/incidents/update',$_POST);
		}
		break;
	
		case 'user/maintenance/incidents/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/incidents/delete',$_POST);
		}
		break;

		case 'user/maintenance/incidents/update-status-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/maintenance/incidents/update-status',$_POST);	
		break;

		case 'user/maintenance/incidents/documents-list-ajax':
		$_POST['user_key']=USER_KEY;
		echo callSGWS('user/maintenance/incidents/documents-list',$_POST);
		break;

		case 'user/maintenance/incidents/documents':
		//if(in_array('P0229', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/maintenance/incidents/incidents-documents.php';
			}
		//}
		break;

		case 'user/maintenance/incidents/upload-document':
		//if(in_array('P0229', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/maintenance/incidents/upload-document.php';
			}
		//}
		break;
		case 'user/maintenance/incidents/upload-document-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/incidents/upload-document',$_POST,$_FILES['document']);

		}
		break;

		case 'user/maintenance/incidents/add-followup':
			//if(in_array('P0229', USER_PRIV)){
				if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					require_once APPROOT.'/views/user/maintenance/incidents/add-followup.php';
				}
			//}
			break;

		case 'user/maintenance/incidents/follow-up-list-ajax':

		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/incidents/follow-ups-list',$param);
		break;

		case 'user/maintenance/incidents/add-follow-up-action':

		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);

		}
		
		echo $response =callSGWS('user/maintenance/incidents/add-follow-up',$param);
		
		break;

		case 'user/maintenance/incidents/delete-document-action':
		$_POST['user_key']=USER_KEY;
		echo callSGWS('user/maintenance/incidents/delete-document',$_POST);
		break;

		case 'user/maintenance/incidents/quick-documents':
			//if(in_array('P0229', USER_PRIV)){
				if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					require_once APPROOT.'/views/user/maintenance/incidents/incidents-quick-documents.php';
				}
			//}
			break;

		default:
		echo NOT_VALID_REQUEST;
		break;
	}
}else{
	echo NOT_VALID_REQUEST;
}
?>