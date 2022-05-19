<?php
$nav_type='masters';

if(in_array('P0072', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/vehicles/insurance-companies/add-new':
			if(in_array('P0073', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/vehicles/insurance-companies-add-new.php';
			}
			break;

		case 'user/masters/vehicles/insurance-companies/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/insurance-companies/add-new',$_POST);
			}
			break;
		case 'user/masters/vehicles/insurance-companies-list-ajax':
		
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/insurance-companies/list',$param);
				
			break;
		case 'user/masters/vehicles/insurance-companies':
		if(in_array('P0072', USER_PRIV)){
			require_once APPROOT.'/views/user/masters/vehicles/insurance-companies.php';
			}	
			break;
		case 'user/masters/vehicles/insurance-companies/update':
		if(in_array('P0075', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/insurance-companies/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/vehicles/insurance-companies-update.php';
					}

					}
				}
			break;

		case 'user/masters/vehicles/insurance-companies/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/insurance-companies/update',$_POST);
						}
			break;
		case 'user/masters/vehicles/insurance-companies/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/insurance-companies/delete',$_POST);
						}
			break;			


		default:
			//GT_default_page();
			break;
	}
}else{
	GT_default_page();
}
?>