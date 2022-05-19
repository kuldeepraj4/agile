<?php
$nav_type='masters';
	switch (getUri()) {

		case 'user/masters/hierarchy/levels/user-children':
		$param['user_key']=USER_KEY;
				echo $response =callSGWS('user/masters/hierarchy/levels/user-children',$param);
			echo "<pre>";
			print_r(json_decode($response,true));
			echo "</pre>";
			break;
		case 'user/masters/hierarchy/levels/add-new':
			if(in_array('PADMIN', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/hierarchy/levels-add-new.php';
			}
			break;

		case 'user/masters/hierarchy/levels/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/hierarchy/levels/add-new',$_POST);
			}
			break;

		case 'user/masters/hierarchy/levels-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/hierarchy/levels/list',$param);
			break;

		case 'user/masters/hierarchy/levels':
			require_once APPROOT.'/views/user/masters/hierarchy/levels.php';	
			break;

		case 'user/masters/hierarchy/levels/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/hierarchy/levels/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/hierarchy/levels-update.php';
					}

					}
			break;

		case 'user/masters/hierarchy/levels/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/hierarchy/levels/update',$_POST);
						}
			break;
		
			
			
		case 'user/masters/hierarchy/levels/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/hierarchy/levels/delete',$_POST);
						}
			break;

		case 'user/masters/hierarchy/levels/assign-users':
			if(isset($_GET['eid']) && in_array('PADMIN', USER_PRIV)){
				$data=[];
				$data['assigned-users-array']=[];
				$response= callSGWS('user/masters/hierarchy/levels/levels-users-junction',array('user_key'=>USER_KEY,'level_eid'=>$_GET['eid']));
				
				$OBJ=json_decode($response,true);
				if($OBJ['status'] && isset($OBJ['response']['list'])){
					foreach ($OBJ['response']['list'] as $list) {
						array_push($data['assigned-users-array'], $list['user_eid']);
					}
				}
					require_once APPROOT.'/views/user/masters/hierarchy/levels-assign-users.php';

					}
			break;
		case 'user/masters/hierarchy/levels/assign-users-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/hierarchy/levels/assign-users',$_POST);
						}
			break;

		default:
			//GT_default_page();
			break;
	}

?>