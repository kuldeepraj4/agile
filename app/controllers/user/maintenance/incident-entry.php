<?php
$nav_type='maintenance';
if(in_array('P0007', USER_PRIV)){

	switch (getUri()) {

		case 'user/maintenance/incident-entry/add-new':
		if(in_array('P0008', USER_PRIV)){
			require_once APPROOT.'/views/user/maintenance/incident-entry-add-new.php';
		}
		break;
		case 'user/maintenance/incident-entry/add-new-action':	
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/incident-entry/add-new',$_POST);
		}
		break;

		case 'user/maintenance/incident-entry-ajax':
		if(in_array('P0009', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/maintenance/incident-entry/list',$param);
		}
		break;

		case 'user/maintenance/incident-entry':
		if(in_array('P0009', USER_PRIV)){
			require_once APPROOT.'/views/user/maintenance/incident-entry.php';
		}
		break;
		case 'user/maintenance/incident-entry/details':
		if(in_array('P0009', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['details']=[];
				$response =callSGWS('user/maintenance/incident-entry/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/incident-entry-details.php';
				}
			}
		}	
		break;	

		case 'user/maintenance/incident-entry/update':
		if(in_array('P0010', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				$data['details']=[];
			    $response =callSGWS('user/maintenance/incident-entry/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/incident-entry-update.php';
				}
			}
		}
		break;

		case 'user/maintenance/incident-entry/update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/incident-entry/update',$_POST);
		}
		break;
		
		case 'user/maintenance/incident-entry/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/incident-entry/delete',$_POST);
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