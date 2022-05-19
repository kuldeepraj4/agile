<?php
$nav_type='masters';

if(in_array('P0012', USER_PRIV)){


	switch (getUri()) {


		case 'user/masters/locations/states/add-new':
			if(in_array('P0013', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/locations/states-add-new.php';
			}
			break;

		case 'user/masters/locations/states/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/locations/states/add-new',$_POST);
			}
			break;

		case 'user/masters/locations/states-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/locations/states/list',$param);
			break;

		case 'user/masters/locations/states':
			require_once APPROOT.'/views/user/masters/locations/states.php';	
			break;

		case 'user/masters/locations/states/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/locations/states/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/locations/states-update.php';
					}

					}
			break;

		case 'user/masters/locations/states/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/locations/states/update',$_POST);
						}
			break;
		case 'user/masters/locations/states/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/locations/states/delete',$_POST);
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