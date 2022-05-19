<?php
$nav_type='masters';
if(in_array('P0057', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/vehicles/models/add-new':
			if(in_array('P0058', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/vehicles/models-add-new.php';
			}
			break;

		case 'user/masters/vehicles/models/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/vehicles/models/add-new',$_POST);
			}
			break;

		case 'user/masters/vehicles/models-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/vehicles/models/list',$param);
			break;

		case 'user/masters/vehicles/models':
			require_once APPROOT.'/views/user/masters/vehicles/models.php';	
			break;

		case 'user/masters/vehicles/models/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['details']=[];
					$data['eid']=$_GET['eid'];
					$response =callSGWS('user/masters/vehicles/models/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/vehicles/models-update.php';
					}
					

					}
			break;

		case 'user/masters/vehicles/models/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/vehicles/models/update',$_POST);
						}
			break;
		case 'user/masters/vehicles/models/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/vehicles/models/delete',$_POST);
						}
			break;			


		default:
			//GT_default_page();
			break;
	}
}else{
	//GT_default_page();
}
?>