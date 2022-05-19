<?php
$nav_type='maintenance';

if(in_array('P0195', USER_PRIV)){

	switch (getUri()) {
		//List Mode	
		case 'user/maintenance/masters/repair-order-stage-list-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/repair-order-stage/list',$param);
		break;
		
		case 'user/maintenance/masters/repair-order-stage':
		require_once APPROOT.'/views/user/maintenance/masters/repair-order-stage.php';	
		break;

		//Add New Mode	
		case 'user/maintenance/masters/repair-order-stage/add-new':
		if(in_array('P0197', USER_PRIV)){
			require_once APPROOT.'/views/user/maintenance/masters/repair-order-stage-add-new.php';
		}
		break;
		case 'user/maintenance/masters/repair-order-stage/add-new-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/masters/repair-order-stage/add-new',$_POST);
		}
		break;

        //Modify Mode
		case 'user/maintenance/masters/repair-order-stage/update':

		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			 $response =callSGWS('user/maintenance/masters/repair-order-stage/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/maintenance/masters/repair-order-stage-update.php';
			}
		}
		break;
		case 'user/maintenance/masters/repair-order-stage/update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/masters/repair-order-stage/update',$_POST);
		}
		break;

        //Delete Mode
		case 'user/maintenance/masters/repair-order-stage/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/masters/repair-order-stage/delete',$_POST);
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