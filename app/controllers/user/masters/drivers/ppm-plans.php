<?php
$nav_type='masters';
	switch (getUri()) {
		case 'user/masters/drivers/ppm-plans/add-new':
			if(in_array('P0355', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/drivers/ppm-plans-add-new.php';
			}
			break;

		case 'user/masters/drivers/ppm-plans/add-new-action':	
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/driver-ppm-plans/add-new',$_POST);
			}
			break;
		case 'user/masters/drivers/ppm-plans-list-ajax':
				$param['user_key']=USER_KEY;
				$param=array_merge($param,$_POST);
			echo callSGWS('user/masters/driver-ppm-plans/list',$param);
				
			break;
		case 'user/masters/drivers/ppm-plans':
		if(in_array('P0354', USER_PRIV)){
			require_once APPROOT.'/views/user/masters/drivers/ppm-plans.php';
			}	
			break;
		case 'user/masters/drivers/ppm-plans/details':
				if(in_array('P0356', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['details']=[];
					$response =callSGWS('user/masters/drivers/ppm-plans/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/drivers/ppm-plans/truck-details.php';
					}

					}
				}	
			break;			
		case 'user/masters/drivers/ppm-plans/update':
		if(in_array('P0357', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/driver-ppm-plans/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/drivers/ppm-plans-update.php';
					}

					}
				}
			break;

		case 'user/masters/drivers/ppm-plans/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/driver-ppm-plans/update',$_POST);
						}
			break;
		case 'user/masters/drivers/ppm-plans/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/driver-ppm-plans/delete',$_POST);
						}
			break;			


		default:
			//GT_default_page();
			break;
	}

?>