<?php
$nav_type='safety';
if(in_array('P0022', USER_PRIV) || in_array('P0341', USER_PRIV)	|| in_array('P0369', USER_PRIV) || in_array('P0387', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/trailers/add-new':
		if(in_array('P0023', USER_PRIV)){
			require_once APPROOT.'/views/user/masters/trailers/trailers-add-new.php';
		}
		break;

		case 'user/masters/trailers/add-new-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trailers/add-new',$_POST);
		}
		break;

		case 'user/masters/trailers/quick-list-ajax':
			$_POST['user_key']=USER_KEY;
			echo callSGWS('user/masters/trailers/quick-list',$_POST);	
		break;

		case 'user/masters/trailers-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/trailers/list',$param);
			
		break;
		case 'user/masters/trailers':
			require_once APPROOT.'/views/user/masters/trailers/trailers.php';
	
		break;
		case 'user/masters/trailers/details':
			if(isset($_GET['eid'])){
				$data=[];
				$data['details']=[];
				$response =callSGWS('user/masters/trailers/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/masters/trailers/trailer-details.php';
				}

			}
			
		break;

		case 'user/masters/trailers/trailers-verify':
		if(in_array('P0335', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['details']=[];
				$response =callSGWS('user/masters/trailers/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/masters/trailers/trailers-verify.php';
				}

			}
		}	
		break;

		case 'user/masters/trailers/approve-details-action':
		if(in_array('P0335', USER_PRIV)){
		$_POST['user_key']=USER_KEY;	 
		echo $response =callSGWS('user/masters/trailers/approve-details',$_POST);
		}
		break;

		case 'user/masters/trailers/reject-details-action':
		if(in_array('P0335', USER_PRIV)){
		$_POST['user_key']=USER_KEY;	
		echo $response =callSGWS('user/masters/trailers/reject-details',$_POST);
		}
		break;


			
		case 'user/masters/trailers/update':
		if(in_array('P0025', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				$data['details']=[];
				$response =callSGWS('user/masters/trailers/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/masters/trailers/trailers-update.php';
				}

			}
		}
		break;

		case 'user/masters/trailers/update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trailers/update',$_POST);
		}
		break;
		case 'user/masters/trailers/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trailers/delete',$_POST);
		}
		break;			
		case 'user/masters/trailers/documents-quick-totals':
		if(isset($_POST)){
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
			echo $response =callSGWS('user/masters/trailers-documents/quick-totals',$param);
		}
		break;

		case 'user/masters/trailers/documents-ajax':
		$param['user_key']=USER_KEY;
		$param['trailer_eid']='VkpZdWJYQ1hQazg9';
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo $response =callSGWS('user/masters/trailers-documents/trailer-documents',$param);
		break;

		case 'user/masters/trailers/documents':
		if(isset($_GET['eid'])){
			$data['trailer_eid']=$_GET['eid'];
			require_once APPROOT.'/views/user/masters/trailers/documents.php';
		}				
		break;

		case 'user/masters/trailers/documents/document-history':
		if(isset($_GET['trailer_eid']) && isset($_GET['document_type_eid'])){
			$data=[];
			$data['trailer_eid']=$_GET['trailer_eid'];
			$data['document_type_eid']=$_GET['document_type_eid'];
			require_once APPROOT.'/views/user/masters/trailers/document-history.php';
		}
		
		break;


		case 'user/masters/trailers/documents/document-history-ajax':
		echo $response =callSGWS('user/masters/trailers-documents/document-history',array_merge(['user_key'=>USER_KEY],$_POST));
		break;

		
		case 'user/masters/trailers/documents/upload':
		if(isset($_GET['trailer_eid']) && isset($_GET['document_eid']) && isset($_GET['document_name']) && in_array('P0172', USER_PRIV)){
			$data=[];
			$data['trailer_eid']=$_GET['trailer_eid'];
			$data['document_eid']=$_GET['document_eid'];
			$data['document_name']=$_GET['document_name'];
			require_once APPROOT.'/views/user/masters/trailers/documents-upload.php';
		}
		break;

		case 'user/masters/trailers/documents/upload-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trailers-documents/upload',$_POST,$_FILES['document']);
		}
		break;

		case 'user/masters/trailers/documents/verify':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trailers-documents/verify',$_POST);
		}
		break;

		case 'user/masters/trailers/documents/reject':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trailers-documents/reject',$_POST);
		}			
		break;	

		case 'user/masters/trailers/all-trailers-documents-ajax':
		if(isset($_POST)){
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
			echo $response =callSGWS('user/masters/trailers-documents/all-trailers-documents',$param);
		}
		break;
		
		case 'user/masters/trailers/all-trailers-documents':
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
		require_once APPROOT.'/views/user/masters/trailers/all-trailers-documents.php';						
		break;


		case 'user/masters/trailers/engine-hours-status-ajax':
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
		 echo callSGWS('user/masters/trailers/engine-hours-status',$param);

		
		break;


		case 'user/masters/trailers/engine-hours-status':
			require_once APPROOT.'/views/user/masters/trailers/engine-hours-status.php';
		
		break;

		case 'user/masters/trailers/update-engine-hours-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trailers/update-engine-hours-status',$_POST);
		}			
		break;

		case 'user/masters/trailers/locations-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/trailers/locations',$param);
			
		break;

		case 'user/masters/trailers/locations':
			require_once APPROOT.'/views/user/masters/trailers/locations.php';	
		break;

		case 'user/masters/trailers/locations/toggle-update-type-action':
		$_POST['user_key']=USER_KEY;
		echo callSGWS('user/masters/trailers/locations/toggle-update-type',$_POST);	
		break;

		case 'user/masters/trailers/locations/update':
		if(in_array('P0389', USER_PRIV)){
			if(isset($_GET['eid']) && isset($_GET['trailer-code']) && isset($_GET['location']) && isset($_GET['longitude']) && isset($_GET['latitude']))
				$data['eid']=$_GET['eid'];
				$data['trailer-code']=$_GET['trailer-code'];
				$data['location']=$_GET['location'];
				$data['longitude']=$_GET['longitude'];
				$data['latitude']=$_GET['latitude'];
			require_once APPROOT.'/views/user/masters/trailers/locations-update.php';
		}	
		break;

		case 'user/masters/trailers/locations/update-action':
		$_POST['user_key']=USER_KEY;
		echo callSGWS('user/masters/trailers/locations/update',$_POST);	
		break;

		case 'user/masters/trailers-update-live-locations':
			$_POST['user_key']=USER_KEY;
				echo callSGWS('user/masters/trailers/update-live-locations',$_POST);	
			break;

		
		default:
        echo NOT_VALID_REQUEST;
		break;
	}
}else{
        echo NOT_VALID_REQUEST;
}
?>
