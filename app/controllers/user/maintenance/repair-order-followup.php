<?php
$nav_type='maintenance';
if(in_array('P0007', USER_PRIV)){

	switch (getUri()) {

		case 'user/maintenance/repair-order-followup/add-new':
		if(in_array('P0008', USER_PRIV)){
			require_once APPROOT.'/views/user/maintenance/repair-order-followup-add-new.php';
		}
		break;
		case 'user/maintenance/repair-order-followup/add-new-action':	
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/repair-order-followup/add-new',$_POST);
		}
		break;

		case 'user/maintenance/repair-order-followup-ajax':
		if(in_array('P0009', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/maintenance/repair-order-followup/list',$param);
		}
		break;

		case 'user/maintenance/repair-order-followup':
		if(in_array('P0009', USER_PRIV)){
			require_once APPROOT.'/views/user/maintenance/repair-order-followup.php';
		}
		break;
		case 'user/maintenance/repair-order-followup/details':
		if(in_array('P0009', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['details']=[];
				$response =callSGWS('user/maintenance/repair-order-followup/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/repair-order-followup-details.php';
				}
			}
		}	
		break;	

		case 'user/maintenance/repair-order-followup/update':
		if(in_array('P0010', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				$data['details']=[];
			    $response =callSGWS('user/maintenance/repair-order-followup/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/repair-order-followup-update.php';
				}
			}
		}
		break;

		case 'user/maintenance/repair-order-followup/update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/repair-order-followup/update',$_POST);
		}
		break;
		
		case 'user/maintenance/repair-order-followup/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/repair-order-followup/delete',$_POST);
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