<?php
$nav_type='dispatch';
switch (getUri()) {
	case 'user/dispatch/express-loads-load-status-wise-list-ajax':
	$param['user_key']=USER_KEY;
	$param=array_merge($param,$_POST);
	echo callSGWS('user/dispatch/express-loads/load-status-wise-total',$param);
	break;
	case 'user/dispatch/express-loads/add-new':
	if(in_array('P0175', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/loads/express-loads-add-new.php';
	}
	break;


	case 'user/dispatch/express-loads/add-new-action':	
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		if(isset($_FILES['document'])){
			$document=$_FILES['document'];
		}else{
			$document=$_FILES;
		}
		echo $response =callSGWS('user/dispatch/express-loads/add-new',$_POST,$document);
	}
	break;
	case 'user/dispatch/express-loads-ajax':
	if(in_array('P0176', USER_PRIV)){
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/dispatch/express-loads/list',$param);
	}	
	break;
/*
	case 'user/dispatch/express-loads/list-b':

	if(in_array('P0169', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/loads/express-loads-list-b.php';
	}	
	break;
*/
	case 'user/dispatch/express-loads':

	if(in_array('P0176', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/loads/express-loads.php';
	}	
	break;

	case 'user/dispatch/express-loads/details':
	if(in_array('P0176', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['details']=[];
			$response =callSGWS('user/dispatch/express-loads/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/loads/express-load-details.php';
			}

		}
	}	
	break;

	case 'user/dispatch/express-loads/notes':
	if(in_array('P0176', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['details']=[];
			$response =callSGWS('user/dispatch/express-loads/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/loads/express-load-notes.php';
			}

		}
	}	
	break;



	case 'user/dispatch/express-loads/update':
	if(in_array('P0177', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/dispatch/express-loads/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/loads/express-loads-update.php';
			}

		}
	}
	break;

	case 'user/dispatch/express-loads/operation-info-update':
	if(in_array('P0177', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/dispatch/express-loads/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/loads/express-loads-operation-info-update.php';
			}

		}
	}
	break;

	case 'user/dispatch/express-loads/operation-info-update-action':
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/express-loads/update-opration-info',$_POST);
	}
	break;

	case 'user/dispatch/express-loads/booking-info-update':
	if(in_array('P0177', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/dispatch/express-loads/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/loads/express-loads-booking-info-update.php';
			}

		}
	}
	break;
	case 'user/dispatch/express-loads/booking-info-update-action':
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/express-loads/update-booking-info',$_POST);
	}
	break;

	case 'user/dispatch/express-loads/update-action':
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/express-loads/update',$_POST);
	}
	break;				


	case 'user/dispatch/express-loads/document-update-roc-file':
	if(in_array('P0177', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			require_once APPROOT.'/views/user/dispatch/loads/express-loads-document-update-roc-file.php';

		}
	}
	break;

	case 'user/dispatch/express-loads/document-update-roc-file-action':
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/express-loads/document-update-roc-file',$_POST,$_FILES['document']);

	}
	break;
	case 'user/dispatch/express-loads/validate-po-action':
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/express-loads/validate-po',$_POST);
	}
	break;

	case 'user/dispatch/express-loads/approval-status-list-ajax':
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/express-loads/approval-status-list',$_POST);
	}
	break;

	case 'user/dispatch/express-loads/approval-status-list':
	if(in_array('DIS056', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/loads/express-load-approval-status-list.php';
		}	
	break;


	case 'user/dispatch/express-loads/approve-details-action':
	$_POST['user_key']=USER_KEY;	
		echo $response =callSGWS('user/dispatch/express-loads/approve-details',$_POST);
	break;

	case 'user/dispatch/express-loads/reject-details-action':
	$_POST['user_key']=USER_KEY;	
		echo $response =callSGWS('user/dispatch/express-loads/reject-details',$_POST);
	break;

	case 'user/dispatch/express-loads/compare-history':
	if(in_array('DIS056', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['details']=[];
			$response =callSGWS('user/dispatch/express-loads/compare-history',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['comparison'])){
				$data['details']=$OBJ['response']['comparison'];
				require_once APPROOT.'/views/user/dispatch/loads/express-load-compare-history.php';
			}

		}
	}	
	break;

	case 'user/dispatch/express-loads/approve-new':
	if(in_array('DIS056', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['details']=[];
			$response =callSGWS('user/dispatch/express-loads/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/loads/express-load-approve.php';
			}

		}
	}	
	break;

	case 'user/dispatch/express-loads-excel-ajax':
	if(in_array('P0176', USER_PRIV)){
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/dispatch/express-loads-excel/list',$param);
	}	
	break;


	case 'user/dispatch/express-loads/quick-update-tentative-start-date':
	if(in_array('P0177', USER_PRIV)){
		if(isset($_GET['eid'])){
			require_once APPROOT.'/views/user/dispatch/loads/express-load-update-tentative-start-date.php';
		}
	}
	break;

	case 'user/dispatch/express-loads/update-tentative-start-date-action':
	$_POST['user_key']=USER_KEY;	
		echo $response =callSGWS('user/dispatch/express-loads/update-tentative-start-date',$_POST);
	break;

	default:
			//GT_default_page();
	break;
}

?>