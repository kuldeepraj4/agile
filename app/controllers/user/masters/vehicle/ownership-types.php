<?php
$nav_type='masters';

if(in_array('P0037', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/vehicles/ownership-types/add-new':
			if(in_array('P0038', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/vehicles/ownership-types-add-new.php';
			}
			break;

		case 'user/masters/vehicles/ownership-types/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/vehicles/ownership-types/add-new',$_POST);
			}
			break;
		case 'user/masters/vehicles/ownership-types-list-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/vehicles/ownership-types/list',$param);
			break;

		case 'user/masters/vehicles/ownership-types':
			require_once APPROOT.'/views/user/masters/vehicles/ownership-types.php';	
			break;




		case 'user/masters/vehicles/ownership-types/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/vehicles/ownership-types/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/vehicles/ownership-types-update.php';
					}

					}
			break;

		case 'user/masters/vehicles/ownership-types/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/vehicles/ownership-types/update',$_POST);
						}
			break;
		case 'user/masters/vehicles/ownership-types/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/vehicles/ownership-types/delete',$_POST);
						}
			break;			


		default:
			GT_default_page();
			break;
	}
}else{
	GT_default_page();
}
?>