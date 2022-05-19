<?php
$nav_type='masters';
	switch (getUri()) {
		case 'user/accounts/trip-stop-types/add-new':
			if(in_array('P0344', USER_PRIV)){
				require_once APPROOT.'/views/user/accounts/trips/trip-stop-types-add-new.php';
			}
			break;

		case 'user/accounts/trip-stop-types/add-new-action':	
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trip-stop-types/add-new',$_POST);
			}
			break;
		case 'user/accounts/trip-stop-types-list-ajax':
			$param['user_key']=USER_KEY;
				$param=array_merge($param,$_POST);
			echo callSGWS('user/masters/trip-stop-types/list',$param);			
			break;
		case 'user/accounts/trip-stop-types':
		if(in_array('P0345', USER_PRIV)){
			require_once APPROOT.'/views/user/accounts/trips/trip-stop-types.php';
			}	
			break;
		case 'user/accounts/trip-stop-types/details':
				if(in_array('P0345', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['details']=[];
					$response =callSGWS('user/accounts/trip-stop-types/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'views/user/accounts/trips/trip-stop-types-update.php';
					}

					}
				}	
			break;			
		case 'user/accounts/trip-stop-types/update':
		if(in_array('P0346', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/trip-stop-types/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/accounts/trips/trip-stop-types-update.php';
					}

					}
				}
			break;

		case 'user/accounts/trip-stop-types/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/trip-stop-types/update',$_POST);
						}
			break;
		case 'user/accounts/trip-stop-types/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/trip-stop-types/delete',$_POST);
						}
			break;			


		default:
			//GT_default_page();
			break;
	}

?>