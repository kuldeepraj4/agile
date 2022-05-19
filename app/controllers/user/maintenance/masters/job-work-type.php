<?php
$nav_type='maintenance';

if(in_array('P0206', USER_PRIV)){

	switch (getUri()) {
		//List Mode	
		case 'user/maintenance/masters/job-work-type-list-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/job-work-type/list',$param);
		break;
		
		case 'user/maintenance/masters/job-work-type':
		require_once APPROOT.'/views/user/maintenance/masters/job-work-type.php';	
		break;

		//Add New Mode	
		case 'user/maintenance/masters/job-work-type/add-new':
		if(in_array('P0207', USER_PRIV)){
			require_once APPROOT.'/views/user/maintenance/masters/job-work-type-add-new.php';
		}
		break;
		case 'user/maintenance/masters/job-work-type/add-new-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/masters/job-work-type/add-new',$_POST);
		}
		break;

        //Modify Mode
		case 'user/maintenance/masters/job-work-type/update':
		if(isset($_GET['eid'])){
			$data=[];
			$data['eid']=$_GET['eid'];
			$data['details']=[];
			$response =callSGWS('user/maintenance/masters/job-work-type/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				require_once APPROOT.'/views/user/maintenance/masters/job-work-type-update.php';
			}
		}
		break;
		case 'user/maintenance/masters/job-work-type/update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/masters/job-work-type/update',$_POST);
		}
		break;

        //Delete Mode
		case 'user/maintenance/masters/job-work-type/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/masters/job-work-type/delete',$_POST);
		}
		break;

		/*case 'user/maintenance/masters/assets_type-list-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/job-work-type/list',$param);
		break;

		case 'user/maintenance/masters/reasons_list-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/job-work/list',$param);
		break;*/

		default:
		echo NOT_VALID_REQUEST;
		break;
	}
}else{
	echo NOT_VALID_REQUEST;
}
?>