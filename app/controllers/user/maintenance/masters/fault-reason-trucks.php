<?php
$nav_type='maintenance';

if(in_array('P0189', USER_PRIV)){

	switch (getUri()) {
		//List Mode	
		case 'user/maintenance/masters/fault-reason-trucks-list-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/fault-reason-trucks/list',$param);
		break;
		
		case 'user/maintenance/masters/fault-reason-trucks':
		require_once APPROOT.'/views/user/maintenance/masters/fault-reason-trucks.php';	
		break;

		//Add New Mode	
		case 'user/maintenance/masters/fault-reason-trucks/add-new':
		if(in_array('P0287', USER_PRIV)){
			require_once APPROOT.'/views/user/maintenance/masters/fault-reason-trucks-add-new.php';
		}
		break;
		case 'user/maintenance/masters/fault-reason-trucks/add-new-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/masters/fault-reason-trucks/add-new',$_POST);
		}
		break;

        //Modify Mode
		case 'user/maintenance/masters/fault-reason-trucks/update':
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/maintenance/masters/fault-reason-trucks/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/maintenance/masters/fault-reason-trucks-update.php';
			}
		}
		break;
		
		case 'user/maintenance/masters/fault-reason-trucks/update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/masters/fault-reason-trucks/update',$_POST);
		}
		break;

        //Delete Mode
		case 'user/maintenance/masters/fault-reason-trucks/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/masters/fault-reason-trucks/delete',$_POST);
		}
		break;			
		default:
		echo NOT_VALID_REQUEST;
		break;
	}
}else{
	echo NOT_VALID_REQUEST;
}
?>