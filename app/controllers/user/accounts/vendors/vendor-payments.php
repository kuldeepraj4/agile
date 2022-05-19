<?php
$nav_type='accounts';
if(in_array('P0117', USER_PRIV)){

	switch (getUri()) 
	{
		case 'user/accounts/vendors-payments/vendor-payment-reconcilation':
		if(in_array('P0263', USER_PRIV))
			{
				require_once APPROOT.'/views/user/accounts/vendors/vendor-payment-reconcilation.php';
			}
		break;

		case 'user/accounts/vendors-payments/vendor-payment-reconcilation-ajax':
		if(in_array('P0263', USER_PRIV))
		{
			$param['user_key']=USER_KEY;
			if(isset($_POST))
			{
					$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/vendors-payments/all-vendors-paid-list',$param);
	    }
		break;

		case 'user/accounts/vendors-payments/vendor-payment-reconcilation-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/accounts/vendors-payments/make-verification-transaction',$_POST);
		}
		break;			

		case 'user/accounts/vendors-payments/vendor-process-payment':
		if(in_array('P0260', USER_PRIV))
			{
				require_once APPROOT.'/views/user/accounts/vendors/vendor-process-payment.php';
			}
		break;

		case 'user/accounts/vendors-payments/vendor-process-payment-ajax':
		if(in_array('P0260', USER_PRIV))
		{
			$param['user_key']=USER_KEY;
			if(isset($_POST))
			{
					$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/vendors-payments/all-vendors-payable-list',$param);
	    }
		break;

		case 'user/accounts/vendors-payments/vendor-process-payment-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/accounts/vendors-payments/make-vendor-group-transaction',$_POST);
		}
		break;

		case 'user/accounts/vendors-payments/vendor-pending-approval':
			if(in_array('P0350', USER_PRIV)){
				require_once APPROOT.'/views/user/accounts/vendors/vendor-pending-approval.php';
			}	
		break;

		case 'user/accounts/vendors-payments/vendor-pending-approval-ajax':
		if(in_array('P0350', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/vendors-payments/vendor-pending-approval',$param);
			}
		break;	

		case 'user/accounts/vendors-payments/vendor-pending-approval-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/accounts/vendors-payments/make-vendor-approval-transaction',$_POST);
		}
		break;	

		case 'user/accounts/vendors-payments/transactions':
		if(in_array('P0274', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/vendors/transactions.php';
		}
		break;

		case 'user/accounts/vendors-payments/transactions-ajax':
		if(in_array('P0274', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/accounts/vendors-payments/transactions-list',$param);
		}
		break;

		case 'user/accounts/vendors-payments/transactions-details':
				if(in_array('P0274', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['details']=[];

					$param['user_key']=USER_KEY;
					$param=array_merge($param,$_POST,$_GET);
					$response =callSGWS('user/accounts/vendors-payments/transactions-details',$param);
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['list'])){
						$data['list']=$OBJ['response']['list'];
						require_once APPROOT.'/views/user/accounts/vendors/transactions-details.php';
					}

					}
				}	
		break;

		case 'user/accounts/vendors-payments/group-transactions':
		if(in_array('P0274', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/vendors/group-transactions.php';
		}
		break;

		case 'user/accounts/vendors-payments/group-transactions-ajax':
		if(in_array('P0274', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/accounts/vendors-payments/group-transactions-list',$param);
		}
		break;
	
		case 'user/accounts/vendors-payments/group-transactions-details':
				if(in_array('P0276', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['details']=[];
					$response =callSGWS('user/accounts/vendors-payments/group-transactions-details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['transactions-list']=$OBJ['response']['details']['transactions-list'];
						require_once APPROOT.'/views/user/accounts/vendors/group-transactions-details.php';
					}

					}
				}	
		break;
					

		default:
			//GT_default_page();
		break;
	}
}
else
{
	GT_default_page();
}
?>