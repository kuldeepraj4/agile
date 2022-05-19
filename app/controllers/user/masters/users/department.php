<?php
$nav_type='masters';

	switch (getUri()) {
		case 'user/masters/users/department':
			if(in_array('P0319', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/users/department.php';
			}
			break;

			case 'user/masters/users/department-add-new':
			if(in_array('P0318', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/users/department-add-new.php';
			}
			break;

		case 'user/masters/users/department-add-new-action':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/users/department-add-new',$param);


			
			break;


		case 'user/masters/users/department-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/users/department/list',$param);
			break;


		case 'user/masters/users/department/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/users/department/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/users/department-update.php';
					}

					}
			break;		
		

		
			case 'user/masters/users/department/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/users/department-update',$_POST);
						}
			break;



		
		case 'user/masters/users/department/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/users/department/delete',$_POST);
						}
			break;

	

		default:
			//GT_default_page();
			break;
	}

?>