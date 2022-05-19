<?php
$nav_type='masters';

if(in_array('P0082', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/employees/status/add-new':
			if(in_array('P0083', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/employees/status-add-new.php';
			}
			break;

		case 'user/masters/employees/status/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/employees/status/add-new',$_POST);
			}
			break;
		case 'user/masters/employees/status-list-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/employees/status/list',$param);
			break;

		case 'user/masters/employees/status':
			require_once APPROOT.'/views/user/masters/employees/status.php';	
			break;




		case 'user/masters/employees/status/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/employees/status/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/employees/status-update.php';
					}

					}
			break;

		case 'user/masters/employees/status/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/employees/status/update',$_POST);
						}
			break;
		case 'user/masters/employees/status/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/employees/status/delete',$_POST);
						}
			break;			


		default:
			//GT_default_page();
			break;
	}
}else{
	//GT_default_page();
}
?>