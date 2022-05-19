<?php
$nav_type='masters';

if(in_array('P0032', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/companies/add-new':
			if(in_array('P0033', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/companies/companies-add-new.php';
			}
			break;

		case 'user/masters/companies/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/companies/add-new',$_POST);
			}
			break;
		case 'user/masters/companies-list-ajax':
		if(in_array('P0034', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/companies/list',$param);
			}	
			break;
		case 'user/masters/companies':
		if(in_array('P0034', USER_PRIV)){
			require_once APPROOT.'/views/user/masters/companies/companies.php';
			}	
			break;
		case 'user/masters/companies/update':
		if(in_array('P0035', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/companies/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/companies-update.php';
					}

					}
				}
			break;

		case 'user/masters/companies/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/companies/update',$_POST);
						}
			break;
		case 'user/masters/companies/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/companies/delete',$_POST);
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