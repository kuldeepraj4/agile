<?php
$nav_type='accounts';
if(in_array('P0117', USER_PRIV)){


	switch (getUri()) {
		case 'user/accounts/trips/add-new':
			if(in_array('P0119', USER_PRIV)){
				require_once APPROOT.'/views/user/accounts/trips/trips-add-new.php';
			}
			break;

		case 'user/accounts/trips/add-new-action':	
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/accounts/trips/add-new',$_POST);
			}
			break;
		case 'user/accounts/trips-ajax':
		if(in_array('P0120', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/trips/list',$param);
			}	
			break;
		case 'user/accounts/trips':
		if(in_array('P0120', USER_PRIV)){
		    $data['approval_status']=(isset($_GET['approval-status']))?$_GET['approval-status']:'';
			require_once APPROOT.'/views/user/accounts/trips/trips.php';
			}	
			break;

		case 'user/accounts/trips/pending-approval-ajax':
		if(in_array('P0120', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/trips/list-pending-approval',$param);
			}
			break;	

		case 'user/accounts/trips/pending-approval':
		if(in_array('P0120', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/trips/trips-pending-approval.php';
		}	
			break;	

		case 'user/accounts/trips/pending-approval-approve':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
						echo $response =callSGWS('user/accounts/trips/pending-approval-approve',$_POST);
						}
			break;
		case 'user/accounts/trips/pending-approval-reject':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
						echo $response =callSGWS('user/accounts/trips/pending-approval-reject',$_POST);
						}
			break;				

		case 'user/accounts/trips/drivers-trips-list-ajax':
		if(in_array('P0120', USER_PRIV) || in_array('P0353', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/trips/driver-trips-list',$param);
			}
			break;


		case 'user/accounts/trips/drivers-trips-list':
		if(in_array('P0120', USER_PRIV) || in_array('P0353', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/trips/drivers-trips-list.php';
		}	
			break;

		case 'user/accounts/trips/driver-all-trips-list-ajax':
		if(in_array('P0120', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/trips/driver-all-trips-list',$param);
			}
			break;

		case 'user/accounts/trips/driver-all-trips-list':
		if(in_array('P0120', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/trips/driver-all-trips-list.php';
		}	
			break;			



		case 'user/accounts/trips/details':
				if(in_array('P0120', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/accounts/trips/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/accounts/trips/trips-details.php';
					}

					}
				}	
			break;

		case 'user/accounts/trips/update-salary-parameters':
				if(in_array('P0134', USER_PRIV)){
			if(isset($_GET['trid']) && isset($_GET['drid'])){
					$data=[];


					

					$response =callSGWS('user/accounts/trips/driver-trip-parameters-details',array('user_key'=>USER_KEY,'trip_eid'=>$_GET['trid'],'driver_eid'=>$_GET['drid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['list'])){
					$details=[];
					$details['trip_eid']=$_GET['trid'];
					$details['driver_eid']=$_GET['drid'];
					$data['details']=$details;
						$data['list']=$OBJ['response']['list'];
						require_once APPROOT.'/views/user/accounts/trips/trip-driver-salary-parameter-update.php';
					}

					}
				}	
			break;
		case 'user/accounts/trips/update-salary-parameters-action':	
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/accounts/trips/driver-trip-parameters-details-update',$_POST);
			}
			break;										
		case 'user/accounts/trips/update':
		if(in_array('P0121', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/accounts/trips/details-for-updation',array('user_key'=>USER_KEY,'trip_eid'=>$_GET['eid']));

					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/accounts/trips/trips-update.php';
					}

					}
				}
			break;

		case 'user/accounts/trips/update-action':	
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/accounts/trips/update',$_POST);
			}
			break;	
		case 'user/accounts/trips/quick-list':
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST,$_GET);
			echo callSGWS('user/accounts/trips/quick-list',$param);
				
			break;

		case 'user/accounts/trips/months-list':
			if(isset($_POST)){
				$_POST['user_key']=USER_KEY;
				echo callSGWS('user/accounts/trips/months-list',$_POST);
			}
			
				
			break;
		case 'user/accounts/trips/cancel-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
						echo $response =callSGWS('user/accounts/trips/cancel',$_POST);
						}
			break;	

		case 'user/accounts/trips/resettle':
		if(in_array('P0121', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/accounts/trips/details-for-updation',array('user_key'=>USER_KEY,'trip_eid'=>$_GET['eid']));

					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/accounts/trips/trips-resettle.php';
					}

					}
				}
			break;

		case 'user/accounts/trips/resettle-action':	
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/accounts/trips/resettle',$_POST);
			}
			break;

		case 'user/accounts/trips/quick-totals-ajax':
		if(isset($_POST)){
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
			echo $response =callSGWS('user/accounts/trips/quick-totals',$param);
		}
		break;
		default:
		//	GT_default_page();
			break;
	}
}else{
	//GT_default_page();
}
?>