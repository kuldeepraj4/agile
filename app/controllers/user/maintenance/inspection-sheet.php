<?php
$nav_type='maintenance';
if(in_array('P0265', USER_PRIV)){

	switch (getUri()) {
		case 'user/maintenance/inspection-sheet':
		require_once APPROOT.'/views/user/maintenance/inspection-sheet/inspection-sheet.php';
		break;

		case 'user/maintenance/inspection-sheet-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/inspection-sheet/list',$param);
		break;

		case 'user/maintenance/inspection-sheet/add-new':
		if(in_array('P0266', USER_PRIV)){
			require_once APPROOT.'/views/user/maintenance/inspection-sheet/inspection-sheet-add-new.php';
		}
		break;
		
		case 'user/maintenance/inspection-sheet/add-new-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/inspection-sheet/add-new',$_POST);
		}
		break;

		case 'user/maintenance/inspection-sheet/details':
		//if(in_array('P0267', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['details']=[];
				$response =callSGWS('user/maintenance/inspection-sheet/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/inspection-sheet/inspection-sheet-details.php';
				}
			}
		//}	
		break;

		case 'user/maintenance/inspection-sheet/update':
		//if(in_array('P0268', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				$data['details']=[];
				$response =callSGWS('user/maintenance/inspection-sheet/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				//echo ($response);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/inspection-sheet/inspection-sheet-update.php';
				}
			}
		//}
		break;

		case 'user/maintenance/inspection-sheet/update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/inspection-sheet/update',$_POST);
		}
		break;

		case 'user/maintenance/inspection-sheet/upload-document':
		//if(in_array('P0229', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/maintenance/inspection-sheet/upload-document.php';
			}
		//}
		break;

		case 'user/maintenance/inspection-sheet/upload-document-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/inspection-sheet/upload-document',$_POST,$_FILES['document']);
		}
		break;
		
		case 'user/maintenance/inspection-sheet/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/inspection-sheet/delete',$_POST);
		}
		break;

		// case 'user/maintenance/inspection-sheet/follow-up-list-ajax':
		// $param['user_key']=USER_KEY;
		// if(isset($_POST)){
		// 	$param=array_merge($param,$_POST);
		// }
		// echo callSGWS('user/maintenance/inspection-sheet/follow-ups-list',$param);
		// break;

		// case 'user/maintenance/inspection-sheet/add-follow-up-action':
		// $_POST['user_key']=USER_KEY;
		// echo $response =callSGWS('user/maintenance/inspection-sheet/add-follow-up',$_POST);
		// break;

		case 'user/maintenance/inspection-sheet/update-status-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/maintenance/inspection-sheet/update-status',$_POST);	
		break;

		case 'user/maintenance/inspection-sheet/documents-list-ajax':
		$_POST['user_key']=USER_KEY;
		echo callSGWS('user/maintenance/inspection-sheet/documents-list',$_POST);
		break;

		case 'user/maintenance/inspection-sheet/documents':
		//if(in_array('P0229', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/maintenance/inspection-sheet/inspection-sheet-documents.php';
			}
		//}
		break;

		case 'user/maintenance/inspection-sheet/delete-document-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/inspection-sheet/delete-document',$_POST);
		}
		break;

		case 'user/maintenance/inspection-sheet/quick-documents':
			//if(in_array('P0229', USER_PRIV)){
				if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					require_once APPROOT.'/views/user/maintenance/inspection-sheet/inspection-sheet-quick-documents.php';
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