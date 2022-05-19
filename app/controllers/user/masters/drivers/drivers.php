<?php
$nav_type='safety';
if(in_array('P0007', USER_PRIV) || in_array('P0339', USER_PRIV) || in_array('P0359', USER_PRIV) || in_array('P0380', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/drivers/add-new':
		if(in_array('P0008', USER_PRIV)){
			require_once APPROOT.'/views/user/masters/drivers/drivers-add-new.php';
		}
		break;

		case 'user/masters/drivers/add-new-action':	
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/drivers/add-new',$_POST);
		}
		break;
		case 'user/masters/drivers-quick-list-ajax':
		$_POST['user_key']=USER_KEY;
		$_POST['status_ids']='ACTIVE';
		echo callSGWS('user/masters/drivers/quick-list',$_POST);
		break;			
		case 'user/masters/drivers-ajax':
			$_POST['user_key']=USER_KEY;
			echo callSGWS('user/masters/drivers/list',$_POST);
	
		break;
		case 'user/masters/drivers':
			require_once APPROOT.'/views/user/masters/drivers/drivers.php';
			
		break;

		case 'user/masters/drivers/details':
			if(isset($_GET['eid'])){
				$data=[];
				$data['details']=[];
				$response =callSGWS('user/masters/drivers/details',array('user_key'=>USER_KEY,'driver_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/masters/drivers/drivers-details.php';
				}

			}
	
		break;	

		case 'user/masters/drivers/approve-details-action':
		$_POST['user_key']=USER_KEY;	 
			echo $response =callSGWS('user/masters/drivers/approve-details',$_POST);
		break;

		case 'user/masters/drivers/reject-details-action':
		$_POST['user_key']=USER_KEY;	
			echo $response =callSGWS('user/masters/drivers/reject-details',$_POST);
		break;


		case 'user/masters/drivers/update':
		if(in_array('P0010', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				$data['details']=[];
				$response =callSGWS('user/masters/drivers/details',array('user_key'=>USER_KEY,'driver_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/masters/drivers/drivers-update.php';
				}

			}
		}
		break;

		case 'user/masters/drivers/update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/drivers/update',$_POST);
		}
		break;



		case 'user/masters/drivers/password-reset':
		if(in_array('P0010', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/masters/drivers/password-reset.php';
			}
		}
		break;			

		case 'user/masters/drivers/password-reset-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/drivers/password-reset',$_POST);
		}
		break;			
		case 'user/masters/drivers/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/drivers/delete',$_POST);
		}
		break;			

		

		case 'user/masters/drivers/documents-quick-totals':
		if(isset($_POST)){
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
			echo $response =callSGWS('user/masters/drivers-documents/quick-totals',$param);
		}
		break;


		case 'user/masters/drivers/documents-ajax':

		if(isset($_POST)){
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
			echo $response =callSGWS('user/masters/drivers-documents/driver-documents',$param);

		}


		break;
		case 'user/masters/drivers/documents':
		if(isset($_GET['eid'])){
			$data['driver_eid']=$_GET['eid'];
			require_once APPROOT.'/views/user/masters/drivers/documents.php';
		}				
		break;
		case 'user/masters/drivers/documents/upload':
		if(isset($_GET['driver_eid']) && isset($_GET['document_eid']) && isset($_GET['document_name']) && in_array('P0145', USER_PRIV)){
			$data=[];
			$data['driver_eid']=$_GET['driver_eid'];
			$data['document_eid']=$_GET['document_eid'];
			$data['document_name']=$_GET['document_name'];
			require_once APPROOT.'/views/user/masters/drivers/documents-upload.php';
		}

		break;
		case 'user/masters/drivers/documents/upload-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/drivers-documents/upload',$_POST,$_FILES['document']);

		}
		break;
		case 'user/masters/drivers/documents/verify':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/drivers-documents/verify',$_POST);

		}
		break;
		case 'user/masters/drivers/documents/reject':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/drivers-documents/reject',$_POST);

		}			
		break;

		case 'user/masters/drivers/all-drivers-documents-ajax':

		if(isset($_POST)){
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
			echo $response =callSGWS('user/masters/drivers-documents/all-drivers-documents',$param);
		}
		break;

		
		case 'user/masters/drivers/all-drivers-documents':
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
		require_once APPROOT.'/views/user/masters/drivers/all-drivers-documents.php';						
		break;

		case 'user/masters/drivers/documents/document-history-ajax':
		echo $response =callSGWS('user/masters/drivers-documents/document-history',array_merge(['user_key'=>USER_KEY],$_POST));
		break;
		case 'user/masters/drivers/documents/document-history':
		if(isset($_GET['driver_eid']) && isset($_GET['document_type_eid'])){
			$data=[];
			$data['driver_eid']=$_GET['driver_eid'];
			$data['document_type_eid']=$_GET['document_type_eid'];
			require_once APPROOT.'/views/user/masters/drivers/document-history.php';
		}
		break;
		

		case 'user/masters/drivers/driver-leave-reasons-ajax':
		$_POST['user_key']=USER_KEY;
		echo callSGWS('user/masters/drivers-leave/reasons-list',$_POST);
		break;

		case 'user/masters/drivers/driver-leave-ajax':
		$_POST['user_key']=USER_KEY;
		echo callSGWS('user/masters/drivers-leave/list',$_POST);
		break;

		case 'user/masters/drivers/driver-leave-quick-list-ajax':
		$_POST['user_key']=USER_KEY;
		echo callSGWS('user/masters/drivers-leave/driver-leaves-quick-list',$_POST);
		break;

		case 'user/masters/drivers/drivers-leave-list':
		require_once APPROOT.'/views/user/masters/drivers/drivers-leave-list.php';
		break;

		case 'user/masters/drivers/drivers-leave-add-new':
		require_once APPROOT.'/views/user/masters/drivers/drivers-leave-add-new.php';
		break;

		case 'user/masters/drivers/drivers-leave-add-new-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/drivers-leave/add-new',$_POST);

		}			
		break;

		case 'user/masters/drivers/drivers-leave-update':
					if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				$data['details']=[];
				$response =callSGWS('user/masters/drivers-leave/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/masters/drivers/drivers-leave-update.php';
				}

			}
		
		break;

		case 'user/masters/drivers/drivers-leave-update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/drivers-leave/update',$_POST);

		}			
		break;

		case 'user/masters/drivers/team-wise-list-ajax':
			if(isset($_POST)){
				$param['user_key']=USER_KEY;
				$param=array_merge($param,$_POST);
				echo $response =callSGWS('user/masters/drivers/team-wise-list',$param);
			}
			break;

		case 'user/masters/drivers/team-wise-list':
			require_once APPROOT.'/views/user/masters/drivers/team-wise-list.php';
		break;

		case 'user/masters/drivers/update-driver-team':
		if(in_array('P0382', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/drivers/details',array('user_key'=>USER_KEY,'driver_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/drivers/update-driver-team.php';
					}

					}
				}
			break;

		case 'user/masters/drivers/update-driver-team-action':
			if(isset($_POST)){
				$_POST['user_key']=USER_KEY;
					echo $response =callSGWS('user/masters/drivers/update-driver-team',$_POST);
				}
		break;


		case 'user/masters/drivers/drivers-history':
			
			require_once APPROOT.'/views/user/masters/drivers/drivers-history.php';
		
		break;


		case 'user/masters/drivers/drivers-history-action':
			if(isset($_POST['driver_eid'])){
				$_POST['user_key']=USER_KEY;
				$param['eid'] = $_POST['driver_eid'];
				$param['reference'] = $_POST['reference'];
				$param=array_merge($param,$_POST);
				echo $response =callSGWS('user/quick-details/quick-history-details',$param);
			}
			break;
			
		case 'user/masters/drivers-quick-list-all-ajax':
			$_POST['user_key']=USER_KEY;
			$_POST['status_ids']='ACTIVE,INACTIVE';
			echo callSGWS('user/masters/drivers/quick-list-all', $_POST);
		break;

		default:
			//GT_default_page();
		break;
	}
}else{
		



	//GT_default_page();
}



?>
