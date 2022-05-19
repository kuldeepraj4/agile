<?php
$nav_type='masters';
if(in_array('P0092', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/employees/residency/add-new':

			if(in_array('P0093', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/employees/residency-add-new.php';
			}
			break;

		case 'user/masters/employees/residency/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/employees/residency/add-new',$_POST);
			}
			break;
		case 'user/masters/employees/residency-list-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/employees/residency/list',$param);
			break;

		case 'user/masters/employees/residency':
			require_once APPROOT.'/views/user/masters/employees/residency.php';	
			break;




		case 'user/masters/employees/residency/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/employees/residency/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/employees/residency-update.php';
					}

					}
			break;

		case 'user/masters/employees/residency/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/employees/residency/update',$_POST);
						}
			break;
		case 'user/masters/employees/residency/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/employees/residency/delete',$_POST);
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