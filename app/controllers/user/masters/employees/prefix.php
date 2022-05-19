<?php
$nav_type='masters';
if(in_array('P0087', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/employees/prefix/add-new':

			if(in_array('P0088', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/employees/prefix-add-new.php';
			}
			break;

		case 'user/masters/employees/prefix/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/employees/prefix/add-new',$_POST);
			}
			break;
		case 'user/masters/employees/prefix-list-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/employees/prefix/list',$param);
			break;

		case 'user/masters/employees/prefix':
			require_once APPROOT.'/views/user/masters/employees/prefix.php';	
			break;




		case 'user/masters/employees/prefix/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/employees/prefix/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/employees/prefix-update.php';
					}

					}
			break;

		case 'user/masters/employees/prefix/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/employees/prefix/update',$_POST);
						}
			break;
		case 'user/masters/employees/prefix/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/employees/prefix/delete',$_POST);
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