<?php
$nav_type='masters';

if(in_array('P0012', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/locations/cities/add-new':
		if(in_array('P0013', USER_PRIV)){
			require_once APPROOT.'/views/user/masters/locations/cities-add-new.php';
		}
		break;

		case 'user/masters/locations/cities/quick-add-new':
		if(in_array('P0013', USER_PRIV)){
			require_once APPROOT.'/views/user/masters/locations/cities-quick-add-new.php';
		}
		break;

		case 'user/masters/locations/cities/add-new-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/locations/cities/add-new',$_POST);
		}
		break;

		case 'user/masters/locations/cities-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/masters/locations/cities/list',$param);
		break;

		case 'user/masters/locations/cities':
		require_once APPROOT.'/views/user/masters/locations/cities.php';	
		break;

		case 'user/masters/locations/cities/update':
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/masters/locations/cities/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/masters/locations/cities-update.php';
			}

		}
		break;

		case 'user/masters/locations/cities/update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/locations/cities/update',$_POST);
		}
		break;
		case 'user/masters/locations/cities/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/locations/cities/delete',$_POST);
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