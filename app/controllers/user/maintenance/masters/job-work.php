<?php
$nav_type='maintenance';

if(in_array('P0211', USER_PRIV)){

	switch (getUri()) {
		//List Mode	
		case 'user/maintenance/masters/job-work-list-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/job-work/list',$param);
		break;
		
		case 'user/maintenance/masters/job-work':
		require_once APPROOT.'/views/user/maintenance/masters/job-work.php';	
		break;

		//Add New Mode	
		case 'user/maintenance/masters/job-work/add-new':
		if(in_array('P0212', USER_PRIV)){
			require_once APPROOT.'/views/user/maintenance/masters/job-work-add-new.php';
		}
		break;
		case 'user/maintenance/masters/job-work/add-new-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/masters/job-work/add-new',$_POST);
		}
		break;

        //Modify Mode
		case 'user/maintenance/masters/job-work/update':
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/maintenance/masters/job-work/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/maintenance/masters/job-work-update.php';
			}
		}
		break;
		
		case 'user/maintenance/masters/job-work/update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/masters/job-work/update',$_POST);
		}
		break;

        //Delete Mode
		case 'user/maintenance/masters/job-work/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/masters/job-work/delete',$_POST);
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