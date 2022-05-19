<?php
$nav_type='masters';

	switch (getUri()) {
		case 'user/masters/route-types/add-new':

			if(in_array('P0108', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/general/route-types-add-new.php';
			}
			break;

		case 'user/masters/route-types/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/route-types/add-new',$_POST);
			}
			break;
		case 'user/masters/route-types-list-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/route-types/list',$param);
			break;

		case 'user/masters/route-types':
			require_once APPROOT.'/views/user/masters/general/route-types.php';	
			break;




		case 'user/masters/route-types/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/route-types/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/general/route-types-update.php';
					}

					}
			break;

		case 'user/masters/route-types/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/route-types/update',$_POST);
						}
			break;
		case 'user/masters/route-types/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/route-types/delete',$_POST);
						}
			break;			


		default:
			//GT_default_page();
			break;
	}

?>