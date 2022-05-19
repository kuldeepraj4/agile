<?php
$nav_type='masters';

if(in_array('P0067', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/vehicles/colors/add-new':
			if(in_array('P0068', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/vehicles/colors-add-new.php';
			}
			break;

		case 'user/masters/vehicles/colors/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/vehicles/colors/add-new',$_POST);
			}
			break;
		case 'user/masters/vehicles/colors-list-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/vehicles/colors/list',$param);
			break;

		case 'user/masters/vehicles/colors':
			require_once APPROOT.'/views/user/masters/vehicles/colors.php';	
			break;




		case 'user/masters/vehicles/colors/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/vehicles/colors/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/vehicles/colors-update.php';
					}

					}
			break;

		case 'user/masters/vehicles/colors/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/vehicles/colors/update',$_POST);
						}
			break;
		case 'user/masters/vehicles/colors/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/vehicles/colors/delete',$_POST);
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