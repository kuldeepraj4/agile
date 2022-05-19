<?php
$nav_type='safety';
if(in_array('P0017', USER_PRIV) || in_array('P0340', USER_PRIV) || in_array('P0369', USER_PRIV) || in_array('P0374', USER_PRIV)){

	switch (getUri()) {
		case 'user/masters/trucks/quick-view':
		if(isset($_GET['eid'])){
			$data=[];
			$data['details']=[];
			$response =callSGWS('user/masters/trucks/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/masters/trucks/truck-quick-view.php';
			}

		}
		
		break;			
		case 'user/masters/trucks/add-new':
		if(in_array('P0018', USER_PRIV)){
			require_once APPROOT.'/views/user/masters/trucks/trucks-add-new.php';
		}
		break;

		case 'user/masters/trucks/add-new-action':	
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trucks/add-new',$_POST);
		}
		break;
		case 'user/masters/trucks-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/trucks/list',$param);
		break;

		case 'user/masters/trucks-quick-list-ajax':
		$param['user_key']=USER_KEY;
		$param=array_merge($param,$_POST);
		echo callSGWS('user/masters/trucks/quick-list',$param);
		break;

		case 'user/masters/trucks':
			require_once APPROOT.'/views/user/masters/trucks/trucks.php';
	
		break;
		case 'user/masters/trucks/details':
		if(in_array('P0019', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['details']=[];
				$response =callSGWS('user/masters/trucks/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/masters/trucks/truck-details.php';
				}

			}
		}	
		break;	

		case 'user/masters/trucks/trucks-verify':
		if(in_array('P0334', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['details']=[];
				$response =callSGWS('user/masters/trucks/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/masters/trucks/trucks-verify.php';
				}

			}
		}	
		break;	


		case 'user/masters/trucks/approve-details-action':
		if(in_array('P0334', USER_PRIV)){
		$_POST['user_key']=USER_KEY;	 
		echo $response =callSGWS('user/masters/trucks/approve-details',$_POST);
		}
		break;

		case 'user/masters/trucks/reject-details-action':
		if(in_array('P0334', USER_PRIV)){
		$_POST['user_key']=USER_KEY;	
		echo $response =callSGWS('user/masters/trucks/reject-details',$_POST);
		}
		break;





		
		case 'user/masters/trucks/update':
		if(in_array('P0020', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				$data['details']=[];
				$response =callSGWS('user/masters/trucks/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/masters/trucks/trucks-update.php';
				}

			}
		}
		break;

		case 'user/masters/trucks/update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trucks/update',$_POST);
		}
		break;
		case 'user/masters/trucks/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trucks/delete',$_POST);
		}
		break;			
		case 'user/masters/trucks/documents-quick-totals':
		
		if(isset($_POST)){
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
			echo $response =callSGWS('user/masters/trucks-documents/quick-totals',$param);

		}
		
		
		break;
		case 'user/masters/trucks/documents-ajax':
		$param['user_key']=USER_KEY;
		$param['truck_eid']='VkpZdWJYQ1hQazg9';
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo $response =callSGWS('user/masters/trucks-documents/truck-documents',$param);
		
		break;
		case 'user/masters/trucks/documents':
		if(isset($_GET['eid'])){
			$data['truck_eid']=$_GET['eid'];
			$data['truck_code']=$_GET['code'];
			require_once APPROOT.'/views/user/masters/trucks/documents.php';
		}				
		break;

		case 'user/masters/trucks/documents/upload':
		if(isset($_GET['truck_eid']) && isset($_GET['document_eid']) && isset($_GET['document_name']) && in_array('P0147', USER_PRIV)){
			$data=[];
			$data['truck_eid']=$_GET['truck_eid'];
			$data['document_eid']=$_GET['document_eid'];
			$data['document_name']=$_GET['document_name'];
			require_once APPROOT.'/views/user/masters/trucks/documents-upload.php';
		}
		
		break;
		case 'user/masters/trucks/documents/upload-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trucks-documents/upload',$_POST,$_FILES['document']);
		}
		break;
		case 'user/masters/trucks/documents/verify':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trucks-documents/verify',$_POST);

		}
		break;
		case 'user/masters/trucks/documents/reject':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trucks-documents/reject',$_POST);

		}			
		break;
		
		case 'user/masters/trucks/documents/pending-uploads-ajax':
		if(isset($_POST)){
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
			echo $response =callSGWS('user/masters/trucks-documents/pending-uploads',$param);
		}
		break;
		case 'user/masters/trucks/documents/pending-uploads':
		require_once APPROOT.'/views/user/masters/trucks/document-pending-uploads.php';
		break;		
		case 'user/masters/trucks/all-trucks-documents-ajax':
		
		if(isset($_POST)){
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
			echo $response =callSGWS('user/masters/trucks-documents/all-trucks-documents',$param);
		}
		break;

		
		case 'user/masters/trucks/all-trucks-documents':
		$data=[];
		$data['is_uploaded']='';
		if(isset($_GET['is-uploaded'])){
			if(in_array($_GET['is-uploaded'], [true,false])){
				$data['is_uploaded']=$_GET['is-uploaded'];
			}
		}
		$data['is_required']='';
		if(isset($_GET['is-required'])){
			if(in_array($_GET['is-required'], [true,false])){
				$data['is_required']=$_GET['is-required'];
			}
		}
		$data['is_expired']='';
		if(isset($_GET['is-expired'])){
			if(in_array($_GET['is-expired'], [true,false])){
				$data['is_expired']=$_GET['is-expired'];
			}
		}
		$data['expiry_alert']='';
		if(isset($_GET['expiry-alert'])){
			if(in_array($_GET['expiry-alert'], [true,false])){
				$data['expiry_alert']=$_GET['expiry-alert'];
			}
		}
		$data['verification_status']='';
		if(isset($_GET['verification-status'])){
			if(in_array($_GET['verification-status'], [true,false])){
				$data['verification_status']=$_GET['verification-status'];
			}
		}
		require_once APPROOT.'/views/user/masters/trucks/all-trucks-documents.php';						
		break;
		case 'user/masters/trucks/documents/document-history-ajax':
		echo $response =callSGWS('user/masters/trucks-documents/document-history',array_merge(['user_key'=>USER_KEY],$_POST));
		break;
		case 'user/masters/trucks/documents/document-history':
		if(isset($_GET['truck_eid']) && isset($_GET['document_type_eid'])){
			$data=[];
			$data['truck_eid']=$_GET['truck_eid'];
			$data['document_type_eid']=$_GET['document_type_eid'];
			require_once APPROOT.'/views/user/masters/trucks/document-history.php';
		}

		break;

		case 'user/masters/trucks/engine-hours-status-ajax':
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
			echo callSGWS('user/masters/trucks/engine-hours-status',$param);

	
		break;		

		case 'user/masters/trucks/engine-hours-status':
			require_once APPROOT.'/views/user/masters/trucks/engine-hours-status.php';
		break;

		case 'user/masters/trucks/update-engine-hours-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trucks/update-engine-hours-status',$_POST);
		}			
		break;


		case 'user/masters/trucks/odometer-status-ajax':
		
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
			echo callSGWS('user/masters/trucks/odometer-status',$param);

		break;		

		case 'user/masters/trucks/odometer-status':
	
			require_once APPROOT.'/views/user/masters/trucks/odometer-status.php';	
		break;

		case 'user/masters/trucks/update-odometer-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trucks/update-odometer-status',$_POST);
		}			
		break;
		case 'user/masters/trucks-update-live-locations':
			$_POST['user_key']=USER_KEY;
				echo callSGWS('user/masters/trucks/update-live-locations',$_POST);	
			break;


		default:
		//GT_default_page();
		break;
	}
}else{
	GT_default_page();
}
?>