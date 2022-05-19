<?php
$nav_type='maintenance';
//if(in_array('P0231', USER_PRIV)){
	switch (getUri()) {
		case 'user/maintenance/work-orders/add-new':
		if(in_array('P0232', USER_PRIV)){
			if(isset($_GET['ro-eid'])){
				$data=[];
				$data['ro_eid']=$_GET['ro-eid'];
			    $ro_detail =callSGWS('user/maintenance/repair-orders/details',array('user_key'=>USER_KEY,'eid'=>$_GET['ro-eid']));
				$OBJ=json_decode($ro_detail,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['ro_details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/work-orders/work-orders-add-new.php';
				}
			}
		}
		break;

		case 'user/maintenance/work-orders/add-new-action':	
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			if(isset($_FILES['document'])){
				$document=$_FILES['document'];
			}else{
				$document=$_FILES;
			}
			echo $response =callSGWS('user/maintenance/work-orders/add-new',$_POST,$document);
		}
		break;

		case 'user/maintenance/work-orders-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/maintenance/work-orders/list',$param);
	
		break;

		case 'user/maintenance/work-orders':
			require_once APPROOT.'/views/user/maintenance/work-orders/work-orders.php';
	
		break;
		case 'user/maintenance/work-orders/details':
		//if(in_array('P0233', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['details']=[];
				$response =callSGWS('user/maintenance/work-orders/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/work-orders/work-order-details.php';
				}
			}
		//}	
		break;
		case 'user/maintenance/work-orders/quick-details':
			//if(in_array('P0233', USER_PRIV)){
				if(isset($_GET['eid'])){
					$data=[];
					$data['details']=[];
					$response =callSGWS('user/maintenance/work-orders/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/maintenance/work-orders/work-order-quick-details.php';
					}
				}
			//}	
		break;	

		case 'user/maintenance/work-orders/update':
		if(in_array('P0234', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				$data['details']=[];
			    $response =callSGWS('user/maintenance/work-orders/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/work-orders/work-orders-update.php';
				}
			}
		}
		break;

		case 'user/maintenance/work-orders/update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/work-orders/update',$_POST);
		}
		break;
		
		case 'user/maintenance/work-orders/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/work-orders/delete',$_POST);
		}
		break;

		case 'user/maintenance/work-orders/documents-list-ajax':
		$_POST['user_key']=USER_KEY;
		echo callSGWS('user/maintenance/work-orders/documents-list',$_POST);
		break;

		case 'user/maintenance/work-orders/upload-document':
		if(in_array('P0234', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/maintenance/work-orders/upload-document.php';
			}
		}
		break;
		case 'user/maintenance/work-orders/upload-document-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/work-orders/upload-document',$_POST,$_FILES['document']);

		}
		break;

		case 'user/maintenance/work-orders/update-invoice':
		if(in_array('P0234', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/maintenance/work-orders/update-invoice.php';
			}
		}
		break;
		case 'user/maintenance/work-orders/update-invoice-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/work-orders/update-invoice',$_POST,$_FILES['document']);
		}
		break;

		// case 'user/maintenance/work-orders/work-orders-pending-approval':
		// if(in_array('P0120', USER_PRIV)){
		// 	require_once APPROOT.'/views/user/maintenance/work-orders/work-orders-pending-approval.php';
		// }	
		// break;	

		// case 'user/maintenance/work-orders/work-orders-pending-approval-ajax':
		// if(in_array('P0120', USER_PRIV)){
		// 	$param['user_key']=USER_KEY;
		// 	if(isset($_POST)){
		// 		$param=array_merge($param,$_POST,$_GET);
		// 	}
		// 	echo callSGWS('user/maintenance/work-orders/list-pending-approval',$param);
		// }
		// break;	

		default:
		echo NOT_VALID_REQUEST;
		break;
	}
//}else{
//	echo NOT_VALID_REQUEST;
//}
?>