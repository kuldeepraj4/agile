<?php
$nav_type='masters';

	switch (getUri()) {
		case 'user/masters/users/designation':
			if(in_array('P0323', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/users/designation.php';
			}
			break;

			case 'user/masters/users/designation-add-new':
			if(in_array('P0322', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/users/designation-add-new.php';
			}
			break;






		case 'user/masters/users/designation-add-new-action':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/users/designation-add-new',$param);


			
			break;


			case 'user/masters/users/designation/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/users/designation/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/users/designation-update.php';
					}

					}
			break;


			case 'user/masters/users/designation/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/users/designation-update',$_POST);
						}
			break;



		case 'user/masters/users/designation-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/users/designation/list',$param);
			break;


		

		
		case 'user/masters/users/designation/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/users/designation/delete',$_POST);
						}
			break;

	

		default:
			//GT_default_page();
			break;
	}

?>