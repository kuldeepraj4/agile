<?php
$nav_type='masters';

	switch (getUri()) {
		case 'user/masters/users/roles-groups/add-new':
			if(in_array('P0136', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/users/roles-groups-add-new.php';
			}
			break;

		case 'user/masters/users/roles-groups/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/users/roles-groups/add-new',$_POST);
			}
			break;
		case 'user/masters/users/roles-groups-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/users/roles-groups/list',$param);
			break;

		case 'user/masters/users/roles-groups':
			require_once APPROOT.'/views/user/masters/users/roles-groups.php';	
			break;

		case 'user/masters/users/roles-groups/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/users/roles-groups/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/users/roles-groups-update.php';
					}

					}
			break;

		case 'user/masters/users/roles-groups/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/users/roles-groups/update',$_POST);
						}
			break;
		
			
			
		case 'user/masters/users/roles-groups/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/users/roles-groups/delete',$_POST);
						}
			break;

		case 'user/masters/users/roles-groups/roles':
			if(isset($_GET['eid']) && in_array('P0135', USER_PRIV)){
					$data=[];
					$data['eid']=$_GET['eid'];
				    $all_roles =callSGWS('user/masters/users/roles-groups-all-roles',array('user_key'=>USER_KEY));
					$all_OBJ=json_decode($all_roles,true);
					
					$group_roles =callSGWS('user/masters/users/roles-groups-roles',array('user_key'=>USER_KEY,'group_eid'=>$_GET['eid']));
					$group_OBJ=json_decode($group_roles,true);				

					if($all_OBJ['status']==true && $group_OBJ['status']){
						$data['all_roles']=$all_OBJ['response']['list'];
						$data['group_roles']=$group_OBJ['response']['list'];
						require_once APPROOT.'/views/user/masters/users/roles.php';
					}

					}

			break;

		case 'user/masters/users/roles-groups/roles-update':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/users/roles-groups-roles-update',$_POST);
						}
			break;


		case 'user/masters/users/roles-groups/assign-users':
			if(isset($_GET['eid']) && in_array('P0135', USER_PRIV)){
				$data=[];
				$data['assigned-users-array']=[];
				$response= callSGWS('user/masters/users/roles-groups/roles-groups-users-junction',array('user_key'=>USER_KEY,'group_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status'] && isset($OBJ['response']['list'])){
					foreach ($OBJ['response']['list'] as $list) {
						array_push($data['assigned-users-array'], $list['user_eid']);
					}
				}
					require_once APPROOT.'/views/user/masters/users/roles-groups-assign-users.php';

					}
			break;
		case 'user/masters/users/roles-groups/assign-users-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/users/roles-groups/assign-users',$_POST);
						}
			break;

		default:
			//GT_default_page();
			break;
	}

?>