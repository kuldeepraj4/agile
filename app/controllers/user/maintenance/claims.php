<?php

$nav_type='maintenance';

if(in_array('P0007', USER_PRIV)){

	switch (getUri()) {

		case 'user/maintenance/claims/add-new':
		if(in_array('P0008', USER_PRIV)){
			require_once APPROOT.'/views/user/maintenance/claims/claims-add-new.php';
		}
		break;

		case 'user/maintenance/claims/add-new-action':	
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/claims/claims/add-new',$_POST);
		}
		break;

		case 'user/maintenance/claims-ajax':
		if(in_array('P0009', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/maintenance/claims/list',$param);
		}
		break;

		case 'user/maintenance/claims':
		if(in_array('P0009', USER_PRIV)){
			require_once APPROOT.'/views/user/maintenance/claims/claims.php';
		}
		break;

		case 'user/maintenance/claims/details':
		if(in_array('P0009', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['details']=[];
				$response =callSGWS('user/maintenance/claims/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/claims-details.php';
				}
			}
		}	
		break;	

		case 'user/maintenance/claims/update':
		if(in_array('P0010', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				$data['details']=[];
			    $response =callSGWS('user/maintenance/claims/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/claims-update.php';
				}
			}
		}
		break;

		case 'user/maintenance/claims/update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/claims/update',$_POST);
		}
		break;

		case 'user/maintenance/claims/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/claims/delete',$_POST);
		}
		break;			

		default:
		GT_default_page();
		break;
	}
}
else
{
	GT_default_page();
}

?>