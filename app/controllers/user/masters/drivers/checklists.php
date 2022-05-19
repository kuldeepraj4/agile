<?php
$nav_type='safety';
if(in_array('P102', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/drivers/add-new':
			if(in_array('P103', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/drivers/drivers-add-new.php';
			}
			break;

		case 'user/masters/drivers/add-new-action':	
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/drivers/add-new',$_POST);
			}
			break;
		case 'user/masters/drivers-ajax':
		if(in_array('P104', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/drivers/list',$param);
			}	
			break;
		case 'user/masters/drivers/checklists':
		if(in_array('P104', USER_PRIV)){
			require_once APPROOT.'/views/user/masters/drivers/checklists.php';
			}	
			break;
		case 'user/masters/drivers/details':
				if(in_array('P9', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['details']=[];
					$response =callSGWS('user/masters/drivers/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/drivers/truck-details.php';
					}

					}
				}	
			break;			
		case 'user/masters/drivers/update':
		if(in_array('P10', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/drivers/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/drivers/drivers-update.php';
					}

					}
				}
			break;

		case 'user/masters/drivers/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/drivers/update',$_POST);
						}
			break;
		case 'user/masters/drivers/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/drivers/delete',$_POST);
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