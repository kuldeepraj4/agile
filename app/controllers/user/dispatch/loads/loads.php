<?php
$nav_type='dispatch';
switch (getUri()) {
	case 'user/dispatch/loads/testing':
	$_POST['user_key']=USER_KEY;
	$_POST['eid']='a2xGN2orQzk0N289';
	echo $a=callSGWS('user/dispatch/loads/dispatch-details-driver-share',$_POST);
	break;

	case 'user/dispatch/loads/test-auto-status-load':
	$_POST['user_key']=USER_KEY;
	$_POST['load_id']=100011;
	echo $response =callSGWS('user/dispatch/loads/test-auto-status-of-load',$_POST);
	break;

	case 'user/dispatch/loads/express-to-main-load':
	if(in_array('DIS002', USER_PRIV)){
		if(isset($_GET['exp-load'])){
					//--get deatail of express load
					//--use the response data as pre filled record;
			$response =callSGWS('user/dispatch/loads/express-details',array('user_key'=>USER_KEY,'eid'=>$_GET['exp-load']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/load/express-to-main-load.php';
			}
		}
	}
	break;



	case 'user/dispatch/loads/express-add-new-action':
		$_POST['user_key']=USER_KEY;
		if(isset($_FILES['document'])){
			$document=$_FILES['document'];
		}else{
			$document=$_FILES;
		}
		echo $response =callSGWS('user/dispatch/loads/express-add-new',$_POST,$document);
	
	break;

	case 'user/dispatch/loads/express-to-main-load-action':
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/loads/express-to-main-load',$_POST);
	break;

	case 'user/dispatch/loads/allocation-info-update':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/dispatch/loads/allocation-details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/load/allocation-info-update.php';
			}

		}
	}
	break;

	case 'user/dispatch/loads/load-status-update':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/dispatch/loads/load-status-details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/load/load-status-update.php';
			}

		}
	}
	break;
	case 'user/dispatch/loads/load-status-update-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/load-status-update',$_POST);
	
	break;

	case 'user/dispatch/loads/express-update':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/dispatch/loads/express-details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/load/express-update.php';
			}

		}
	}
	break;
	case 'user/dispatch/loads/express-update-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/express-update',$_POST);
	
	break;



	case 'user/dispatch/loads/allocation-info-update-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/allocation-info-update',$_POST);
	break;


	case 'user/dispatch/loads/booking-info-update':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/dispatch/loads/booking-details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/load/booking-info-update.php';
			}

		}
	}
	break;

	case 'user/dispatch/loads/booking-info-update-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/booking-info-update',$_POST);
	
	break;

	case 'user/dispatch/loads/available-loads-list-ajax':
	if(in_array('DIS003', USER_PRIV)){
		$_POST['user_key']=USER_KEY;
		echo callSGWS('user/dispatch/loads/available-loads-list',$_POST);
	}	
	break;

	case 'user/dispatch/loads/available-loads':
	if(in_array('DIS003', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/load/available-loads.php';
	}	
	break;

	case 'user/dispatch/loads/status-wise-totals-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/loads/status-wise-total',$_POST);
	break;

	case 'user/dispatch/loads/add-new':
	// if(in_array('P0173', USER_PRIV)){
	// 	if(isset($_GET['exp-load'])){
	// 				//--get deatail of express load details
	// 				//--use the response data as pre filled record;

	// 		$response =callSGWS('user/dispatch/express-loads/details',array('user_key'=>USER_KEY,'eid'=>$_GET['exp-load']));
	// 		$OBJ=json_decode($response,true);
	// 		if($OBJ['status']==true && isset($OBJ['response']['details'])){
	// 			$data['details']=$OBJ['response']['details'];
	// 			require_once APPROOT.'/views/user/dispatch/loads/loads-add-new.php';
	// 		}


	// 	}

	// }
	break;

	case 'user/dispatch/loads/add-new-action':	
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/add-new',$_POST);
	
	break;
	case 'user/dispatch/loads-ajax':
	if(in_array('P0174', USER_PRIV)){
		$_POST['user_key']=USER_KEY;
		
		echo callSGWS('user/dispatch/loads/list',$_POST);
	}	
	break;

	case 'user/dispatch/loads/list-ajax':
	if(in_array('DIS003', USER_PRIV)){
		$_POST['user_key']=USER_KEY;
		echo callSGWS('user/dispatch/loads/loads-list',$_POST);
	}	
	break;

	case 'user/dispatch/loads/list':
	if(in_array('DIS003', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/load/loads.php';
	}	
	break;

	case 'user/dispatch/loads/details':
	if(in_array('DIS003', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['details']=[];
			$response =callSGWS('user/dispatch/loads/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/load/load-details.php';
			}

		}
	}	
	break;
	case 'user/dispatch/loads/load-information-update':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/dispatch/loads/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/load/load-information-update.php';
			}

		}
	}
	break;

	case 'user/dispatch/loads/load-information-update-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/load-information-update',$_POST);
	
	break;

	case 'user/dispatch/loads/stop-information-update':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/dispatch/loads/stop-details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/load/stop-information-update.php';
			}

		}
	}
	break;							
	case 'user/dispatch/loads/stop-information-update-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/load-stop-information-update',$_POST);
	
	break;

	case 'user/dispatch/loads/update-tentative-start-date':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			require_once APPROOT.'/views/user/dispatch/load/update-tentative-start-date.php';
		}
	}
	break;

	case 'user/dispatch/loads/update-tentative-start-date-action':
	$_POST['user_key']=USER_KEY;	
	echo $response =callSGWS('user/dispatch/loads/update-tentative-start-date',$_POST);
	break;

	case 'user/dispatch/loads/notes':
	if(in_array('DIS003', USER_PRIV)){
		if(isset($_GET['eid'])){
			require_once APPROOT.'/views/user/dispatch/load/notes.php';

		}
	}	
	break;


	case 'user/dispatch/loads/add-dispatch':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$response =callSGWS('user/dispatch/loads/dispatch-info-details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				$data['details']['eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/dispatch/load/dispatch-add-new.php';
			}

		}
	}
	break;

	case 'user/dispatch/loads/add-dispatch-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/add-dispatch',$_POST);
	
	break;
	case 'user/dispatch/loads/dispatch-loads-list-ajax':
	if(in_array('DIS003', USER_PRIV)){
		$_POST['user_key']=USER_KEY;
		echo $res=  callSGWS('user/dispatch/loads/dispatch-loads-list',$_POST);
	}	
	break;

	case 'user/dispatch/loads/dispatch-loads':
	if(in_array('DIS003', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/load/dispatch-loads.php';
	}	
	break;

	case 'user/dispatch/loads/empty-movements-ajax':
	if(in_array('DIS003', USER_PRIV)){
		$_POST['user_key']=USER_KEY;
		echo $res=  callSGWS('user/dispatch/loads/empty-movements-list',$_POST);
	}	
	break;

	case 'user/dispatch/loads/empty-movements':
	if(in_array('DIS003', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/load/empty-movements.php';
	}	
	break;

	case 'user/dispatch/loads/empty-movements/update':
	if(in_array('DIS003', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			echo $response =callSGWS('user/dispatch/loads/empty-movements-details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				$data['details']['eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/dispatch/load/empty-movements-update.php';
			}

		}
	}
	break;
	case 'user/dispatch/loads/empty-movements/update-action':
		$_POST['user_key']=USER_KEY;
		echo $res=  callSGWS('user/dispatch/loads/empty-movements/update',$_POST);

	break;

	case 'user/dispatch/loads/dispatch-update':
	if(in_array('DIS003', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$response =callSGWS('user/dispatch/loads/dispatch-details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				$data['details']['eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/dispatch/load/dispatch-update.php';
			}

		}
	}
	break;

	case 'user/dispatch/loads/validate-driver-dispatch-assignment':
	$_POST['user_key']=USER_KEY;	
	echo $response =callSGWS('user/dispatch/loads/validate-driver-dispatch-assignment',$_POST);
	break;

	case 'user/dispatch/loads/validate-truck-dispatch-assignment':
	$_POST['user_key']=USER_KEY;	
	echo $response =callSGWS('user/dispatch/loads/validate-truck-dispatch-assignment',$_POST);
	break;


	case 'user/dispatch/loads/validate-trailer-dispatch-assignment':
	$_POST['user_key']=USER_KEY;	
	echo $response =callSGWS('user/dispatch/loads/validate-trailer-dispatch-assignment',$_POST);
	break;

	case 'user/dispatch/loads/update-dispatch-basic-info-action':
				$_POST['user_key']=USER_KEY;
					echo $response =callSGWS('user/dispatch/loads/update-dispatch-basic-info',$_POST);
				
	break;

	case 'user/dispatch/loads/update-dispatch-stop-info-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/update-dispatch-stop-info',$_POST);
	break;

	case 'user/dispatch/loads/update-dispatch-status-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/update-dispatch-status',$_POST);
	break;

	case 'user/dispatch/loads/update-roc-file':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			require_once APPROOT.'/views/user/dispatch/load/update-roc-file.php';

		}
	}
	break;


	case 'user/dispatch/loads/roc-history-list-ajax':
	if(in_array('DIS003', USER_PRIV)){
		$_POST['user_key']=USER_KEY;
		echo $res=  callSGWS('user/dispatch/loads/roc-history-list',$_POST);
	}	
	break;

	case 'user/dispatch/loads/roc-history-list':
	if(in_array('DIS003', USER_PRIV)){
		if(isset($_GET['eid'])){
			require_once APPROOT.'/views/user/dispatch/load/roc-history-list.php';
		}
	}	
	break;


	case 'user/dispatch/loads/update-roc-file-action':
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/loads/update-roc-file',$_POST,$_FILES['document']);
	break;

	case 'user/dispatch/loads/update-bol-file':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			require_once APPROOT.'/views/user/dispatch/load/update-bol-file.php';

		}
	}
	break;

	case 'user/dispatch/loads/update-pod-file':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			require_once APPROOT.'/views/user/dispatch/load/update-pod-file.php';

		}
	}
	break;

	case 'user/dispatch/loads/load-details-express':
	if(in_array('DIS003', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['details']=[];
			$response =callSGWS('user/dispatch/loads/details-express',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/load/load-details-express.php';
			}

		}
	}	
	break;
	case 'user/dispatch/loads/update-bol-file-action':
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/loads/update-bol-file',$_POST,$_FILES['document']);
	break;

	case 'user/dispatch/loads/update-pod-file-action':
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/loads/update-pod-file',$_POST,$_FILES['document']);
	break;




	case 'user/dispatch/lh-assignment/assign-load':
	if(in_array('DIS054', USER_PRIV)){
		if(isset($_GET['lha-id'])){
			require_once APPROOT.'/views/user/dispatch/lh-assignment/assign-load.php';
		}
		
	}
	break;

	case 'user/dispatch/loads/stop-allocation-info-update':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['details']=[];
			
			$response =callSGWS('user/dispatch/loads/stop-allocation-details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				$data['details']['eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/dispatch/load/stop-allocation-info-update.php';
			}

		}
	}
	break;

	case 'user/dispatch/loads/stop-allocation-info-update-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/stop-allocation-info-update',$_POST);
	break;


	

	// case 'user/dispatch/loads/add-cross-dock-action':
	// 	$_POST['user_key']=USER_KEY;
	// 	echo $response =callSGWS('user/dispatch/loads/add-cross-dock',$_POST);
	// break;

	case 'user/dispatch/loads/add-stop-off-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/add-stop-off',$_POST);
	break;

	// case 'user/dispatch/loads/change-dispatch-stops-order-action':
	// 	$_POST['user_key']=USER_KEY;
	// 	echo $response =callSGWS('user/dispatch/loads/change-dispatch-stops-order',$_POST);
	// break;

	// case 'user/dispatch/loads/cancel-dispatch-action':
	// 	$_POST['user_key']=USER_KEY;
	// 	echo $response =callSGWS('user/dispatch/loads/cancel-dispatch',$_POST);
	// break;

	// case 'user/dispatch/loads/dispatch-assign-stops-action':
	// 	$_POST['user_key']=USER_KEY;
	// 	echo $response =callSGWS('user/dispatch/loads/dispatch-assign-stops',$_POST);
	// break;

	// case 'user/dispatch/loads/dispatch-unassign-stops-action':
	// 	$_POST['user_key']=USER_KEY;
	// 	echo $response =callSGWS('user/dispatch/loads/dispatch-unassign-stops',$_POST);
	// break;	


	case 'user/dispatch/loads/available-unassigned-load-stops-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/loads/available-unassigned-load-stops',$_POST);
	break;

	case 'user/dispatch/loads/dispatch-stops-assignment-status-ajax':
	$_POST['user_key']=USER_KEY;
	echo $a=callSGWS('user/dispatch/loads/dispatch-stops-assignment-status',$_POST);
	break;

	case 'user/dispatch/loads/dispatch-update-stops-assignment-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/dispatch-update-stops-assignment',$_POST);
	break;	


	case 'user/dispatch/loads/dispatch-details-driver-share':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$_POST['user_key']=USER_KEY;
			$_POST['eid']=$_GET['eid'];
			$response=callSGWS('user/dispatch/loads/dispatch-details-driver-share',$_POST);
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				$data['details']['eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/dispatch/load/dispatch-details-driver-share.php';
			}
		}
	}
	break;

	case 'user/dispatch/loads/billing-information-update':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/dispatch/loads/billing-details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);

			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/load/billing-information-update.php';
			}

		}
	}
	break;

	case 'user/dispatch/loads/billing-information-update-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/billing-information-update',$_POST);
	break;



	case 'user/dispatch/loads/stop-earning-losses-update':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/dispatch/loads/stop-earning-losses-details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/load/stop-earning-losses-update.php';
			}

		}
	}
	break;							
	case 'user/dispatch/loads/stop-earning-losses-update-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/stop-earning-losses-update',$_POST);
	break;



	case 'user/dispatch/loads/update-enl-file':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			require_once APPROOT.'/views/user/dispatch/load/update-enl-file.php';

		}
	}
	break;

	case 'user/dispatch/loads/update-enl-file-action':
	$_POST['user_key']=USER_KEY;
	echo $response =callSGWS('user/dispatch/loads/update-enl-file',$_POST,$_FILES['document']);
	break;


	case 'user/dispatch/loads/delete-stop-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/delete-stop',$_POST);
	break;

	case 'user/dispatch/loads/available-cross-dock-loads-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/loads/available-cross-dock-loads',$_POST);
	break;	

	case 'user/dispatch/loads/available-cross-docks-list':
	if(in_array('DIS003', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/load/available-cross-docks.php';
	}
	break;

	case 'user/dispatch/loads/available-cross-dock-load-stops-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/loads/available-cross-dock-load-stops',$_POST);
	break;
	

	case 'user/dispatch/loads/add-new-stop-action':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/loads/add-new-stop',$_POST);
	break;

	case 'user/dispatch/loads/customer-update-email-after-scheduling':
	if(in_array('DIS002', USER_PRIV)){
		if(isset($_GET['load-eid'])){
			$response =callSGWS('user/dispatch/loads/customer-update',array('user_key'=>USER_KEY,'load_eid'=>$_GET['load-eid']));
			$OBJ=json_decode($response,true);

			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/dispatch/load/customer-update-email-after-scheduling.php';
			}
		}
	}
	break;

	case 'user/dispatch/loads/dispath-mark-as-completed':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/loads/dispath-mark-as-completed',$_POST);
	break;

	case 'user/dispatch/loads/dispath-reopen':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/loads/dispath-reopen',$_POST);
	break;

	case 'user/dispatch/loads/dispath-re-submit':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/loads/dispath-re-submit',$_POST);
	break;


	case 'user/dispatch/loads/update-expected-delivery':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=['load_eid'=>$_GET['eid']];
			require_once APPROOT.'/views/user/dispatch/load/update-expected-delivery.php';
		}
		
	}
	break;

	case 'user/dispatch/loads/update-expected-delivery-action':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/loads/update-expected-delivery',$_POST);
	break;


	case 'user/dispatch/loads/load-weight-update':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/dispatch/loads/weight-details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				
				$data['details']=$OBJ['response']['details'];
				$data['details']['load_eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/dispatch/load/load-weight-details-update.php';
			}

		}
	}
	break;


	case 'user/dispatch/loads/weight-detials-update-action':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/loads/weight-detials-update',$_POST);
	break;

	case 'user/dispatch/loads/toggle-pick-confirmed-with-customer-action':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/dispatch/loads/toggle-pick-confirmed-with-customer',$_POST);
	break;

	case 'user/dispatch/loads/validate-po-action':
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/validate-po',$_POST);
	}
	break;
	case 'user/dispatch/loads/load-add-stop-off':
		if (in_array('DIS003', USER_PRIV)) {
			require_once APPROOT . '/views/user/dispatch/load/load-add-stop-off.php';
		}
		break;

case 'user/dispatch/loads/update-tracking':
	if(in_array('DIS004', USER_PRIV)){
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];

			$response =callSGWS('user/dispatch/loads/tracking-details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				
				$data['details']=$OBJ['response']['details'];
				$data['details']['load_eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/dispatch/load/update-tracking.php';
			}

		}
	}
	break;
	case 'user/dispatch/loads/update-tracking-action':
			$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/update-tracking',$_POST);
	break;
	default:
			//GT_default_page();
	break;
}

?>