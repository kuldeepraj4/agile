<?php
$nav_type='accounts';
if(in_array('P0117', USER_PRIV)){


	switch (getUri()) {

		case 'user/accounts/drivers-payments/group-transactions-ajax':
		if(in_array('P0140', USER_PRIV) || in_array('P0353', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/drivers-payments/group-transactions-list',$param);
		}
		break;
		case 'user/accounts/drivers-payments/group-transactions':
		if(in_array('P0140', USER_PRIV) || in_array('P0353', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/drivers/group-transactions.php';
		}
		break;

		case 'user/accounts/drivers-payments/group-transactions-details':
				if(in_array('P0140', USER_PRIV) || in_array('P0353', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['details']=[];
					$response =callSGWS('user/accounts/drivers-payments/group-transactions-details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['transactions-list']=$OBJ['response']['details']['transactions-list'];
						require_once APPROOT.'/views/user/accounts/drivers/group-transactions-details.php';
					}

					}
				}	
		break;


		case 'user/accounts/drivers-payments/drivers-toggle-settlement-status':
		if(in_array('P0166', USER_PRIV)){
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/drivers/toggle-settlement-status',$_POST);
		}
	}
		break;
	




		case 'user/accounts/drivers-payments/transactions-ajax':
		if(in_array('P0140', USER_PRIV) || in_array('P0353', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/accounts/drivers-payments/transactions-list',$param);
		}
		break;
		case 'user/accounts/drivers-payments/transactions':
		if(in_array('P0140', USER_PRIV) || in_array('P0353', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/drivers/transactions.php';
		}
		break;

		case 'user/accounts/drivers-payments/transactions-details':
				if(in_array('P0140', USER_PRIV) || in_array('P0353', USER_PRIV)){
				if(isset($_GET['eid'])){
					$data=[];
					$data['details']=[];
					$param['user_key']=USER_KEY;
					$param=array_merge($param,$_POST,$_GET);
					$response =callSGWS('user/accounts/drivers-payments/transactions-details',$param);
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['list'])){
						$data['list']=$OBJ['response']['list'];
						require_once APPROOT.'/views/user/accounts/drivers/transactions-details.php';
					}

					}
				}	
		break;




		case 'user/accounts/drivers-payments/payments-ajax':
		if(in_array('P0140', USER_PRIV) || in_array('P0353', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/drivers-payments/payements-list',$param);
		}
		break;
		case 'user/accounts/drivers-payments/payments':
		if(in_array('P0140', USER_PRIV) || in_array('P0353', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/drivers/payments.php';
		}
		break;

		case 'user/accounts/drivers-payments/payments-paid-ajax':
		if(in_array('P0140', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo $dumy=callSGWS('user/accounts/drivers-payments/payements-paid-list',$param);
		}
		echo "<pre>";
		print_r(json_decode($dumy));
		echo "</pre>";
		break;
		case 'user/accounts/drivers-payments/payments':
		if(in_array('P0140', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/drivers/payments.php';
		}
		break;



		case 'user/accounts/drivers-payments/all-drivers-payment-status-ajax':
		if(in_array('P0140', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/drivers-payments/all-drivers-payment-status',$param);
		}
		break;
		case 'user/accounts/drivers-payments/all-drivers-payment-status':
		if(in_array('P0140', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/drivers/all-drivers-payment-status.php';
		}
		break;


		case 'user/accounts/drivers-payments/group-payment-make-ajax':
		if(in_array('P0125', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/drivers-payments/all-drivers-payble-list',$param);
		}
		break;

		case 'user/accounts/drivers-payments/group-payment-make':
		if(in_array('P0125', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/drivers/group-payment-make.php';
		}
		break;

		case 'user/accounts/drivers-payments/group-payment-make-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/accounts/drivers-payments/make-drivers-group-transaction',$_POST);
		}
		break;			

		

		case 'user/accounts/drivers-payments/driver-pending-paybles-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST,$_GET);
		}
		echo callSGWS('user/accounts/drivers-payments/driver-pending-paybles',$param);
		

		break;

		case 'user/accounts/drivers-payments/driver-pending-paybles':	
		require_once APPROOT.'/views/user/accounts/drivers/driver-pending-paybles.php';				
		
		break;		
		case 'user/accounts/drivers-payments/driver-pending-paybles/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/accounts/drivers-payments/earnings-and-deductions-delete',$_POST);
		}
		break;	

		case 'user/accounts/drivers-payments/monthy-hold-incentives-all-drivers-ajax':
		if(in_array('P0348', USER_PRIV)){
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST,$_GET);
		}
		echo callSGWS('user/accounts/drivers-payments/monthy-hold-incentives-all-drivers',$param);
		
		}
		break;	


		case 'user/accounts/drivers-payments/monthy-hold-incentives-all-drivers':
		require_once APPROOT.'/views/user/accounts/drivers/monthy-hold-incentive-all-drivers.php';
		
		break;

		case 'user/accounts/drivers-payments/monthy-hold-incentives-all-drivers-move-ajax':
		if(in_array('P0128', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/drivers-payments/monthy-hold-incentives-all-drivers',$param);
		}

		break;

		case 'user/accounts/drivers-payments/monthy-hold-incentives-all-drivers-move':
		if(in_array('P0128', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/drivers/monthy-hold-incentive-all-drivers-move.php';
		}
		break;

		case 'user/accounts/drivers-payments/monthy-hold-incentives-all-drivers-move-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/accounts/drivers-payments/move-trips-incentive',$_POST);
		}
		break;
		case 'user/accounts/drivers-payments/add-earnings-and-deductions':
		if(in_array('P0141', USER_PRIV) && isset($_GET['eid'])){
			require_once APPROOT.'/views/user/accounts/drivers/add-earnings-and-deductions.php';
		}
		break;
		case 'user/accounts/drivers-payments/add-earnings-and-deductions-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/accounts/drivers-payments/add-earnings-and-deductions',$_POST);
		}
		break;

		case 'user/accounts/drivers-payments/transactions-ajax':
		if(in_array('PADMIN', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/drivers-payments/transactions',$param);
		}
		break;
		case 'user/accounts/drivers-payments/transactions':
		if(in_array('PADMIN', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/drivers/transactions.php';
		}
		break;


		case 'user/accounts/drivers-payments/update-earnings-and-deductions':
		if(in_array('P0142', USER_PRIV) && isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];

			$response =callSGWS('user/accounts/drivers-payments/earnings-and-deductions-details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/accounts/drivers/earnings-and-deductions-update.php';
			}
		}
		break;
		case 'user/accounts/drivers-payments/update-earnings-and-deductions-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/accounts/drivers-payments/earnings-and-deductions-update',$_POST);
		break;										
/*
		case 'user/accounts/trips-ajax':
		if(in_array('PADMIN', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/trips/list',$param);
			}	
			break;
		case 'user/accounts/trips':
		if(in_array('PADMIN', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/trips/trips.php';
			}	
			break;

		case 'user/accounts/trips/pending-approval-ajax':
		if(in_array('PADMIN', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/trips/list-pending-approval',$param);
			}
			break;	

		case 'user/accounts/trips/pending-approval':
		if(in_array('PADMIN', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/trips/trips-pending-approval.php';
		}	
			break;	

		case 'user/accounts/trips/pending-approval-approve':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
						echo $response =callSGWS('user/accounts/trips/pending-approval-approve',$_POST);
						}
			break;	


		case 'user/accounts/trips/details':
				if(in_array('PADMIN', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
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
		case 'user/accounts/trips/update':
		if(in_array('PADMIN', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/accounts/trips/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/accounts/trips/drivers-update.php';
					}

					}
				}
			break;

		case 'user/accounts/trips/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/accounts/trips/update',$_POST);
						}
						break;*/
						


						default:
			//GT_default_page();
						break;
					}
				}else{
					GT_default_page();
				}
				?>