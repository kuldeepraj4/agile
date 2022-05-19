<?php
$nav_type='masters';

if(in_array('P0002', USER_PRIV)){


	switch (getUri()) {
	    		case 'user/masters/users/quick-list-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/users/quick-list',$param);
			break;
	    
		case 'user/masters/users/add-new':
			if(in_array('P0003', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/users/users-add-new.php';
			}
			break;

		case 'user/masters/users/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/users/add-new',$_POST);
			}
			break;
		case 'user/masters/users-ajax':
		
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/users/list',$param);
			break;

		case 'user/masters/users':
			require_once APPROOT.'/views/user/masters/users/users.php';	
			break;

			case 'user/masters/users/users-details':

				if(in_array('P0004', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['details']=[];
					$response =callSGWS('user/masters/users/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/users/users-details.php';

					}

					}
		}
			break;

			case 'user/masters/users/users-verify':
			if(in_array('P0336', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['details']=[];
					$response =callSGWS('user/masters/users/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/users/users-verify.php';	
					}

					}
				}
			
			break;


			case 'user/masters/users/approve-details-action':
			if(in_array('P0336', USER_PRIV)){
		$_POST['user_key']=USER_KEY;	 
		echo $response =callSGWS('user/masters/users/approve-details',$_POST);
		}
		break;

		case 'user/masters/users/reject-details-action':
		if(in_array('P0336', USER_PRIV)){
		$_POST['user_key']=USER_KEY;	
		echo $response =callSGWS('user/masters/users/reject-details',$_POST);
		}
		break;


		
		case 'user/masters/users/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/users/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/users/users-update.php';
					}

					}
			break;

		case 'user/masters/users/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/users/update',$_POST);
						}
			break;
		case 'user/masters/users/password-update':
		if(isset($_GET['eid'])){
		require_once APPROOT.'/views/user/masters/users/password-update.php';
	}
		break;

		case 'user/masters/users/password-update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/users/password-update',$_POST);
		}
		break;
			
			
		case 'user/masters/users/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/users/delete',$_POST);
						}
			break;

		case 'user/masters/users/assign-roles-group':
			if(isset($_GET['eid'])){
				$data=[];
				$data['assigned-roles-groups']=[];
				$response= callSGWS('user/masters/users/roles-groups/roles-groups-users-junction',array('user_key'=>USER_KEY,'user_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status'] && isset($OBJ['response']['list'])){
					foreach ($OBJ['response']['list'] as $list) {
						array_push($data['assigned-roles-groups'], $list['group_eid']);
					}
				}
					require_once APPROOT.'/views/user/masters/users/users-assign-roles-groups.php';

					}
			break;

		case 'user/masters/users/assign-roles-group-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/users/assign-roles-group',$_POST);
						}
			break;			


		default:
			//GT_default_page();
			break;
	}
}else{
	GT_default_page();
}
?>