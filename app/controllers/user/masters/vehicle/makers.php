<?php
$nav_type='masters';
if(in_array('P0052', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/vehicles/makers/add-new':
			if(in_array('P0053', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/vehicles/makers-add-new.php';
			}
			break;

		case 'user/masters/vehicles/makers/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/vehicles/makers/add-new',$_POST);
			}
			break;

		case 'user/masters/vehicles/makers-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/vehicles/makers/list',$param);
			break;

		case 'user/masters/vehicles/makers':
			require_once APPROOT.'/views/user/masters/vehicles/makers.php';	
			break;



		case 'user/masters/vehicles/makers':
			$data=[];
			$data['list']=[];


			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			$response =callSGWS('user/masters/vehicles/makers/list',$param);
			$OBJ=json_decode($response,true);
			if(isset($OBJ['response']['list'])){
				$data['list']=$OBJ['response']['list'];
			}
			print_r($OBJ);
			if(isset($_POST['ajax'])){
				echo $response;
			}else{
				require_once APPROOT.'/views/user/masters/vehicles/makers.php';
			}
								
		
			break;




		case 'user/masters/vehicles/makers/update':

			if(isset($_GET['eid'])){
					$data=[];
					$data['details']=[];
					$data['eid']=$_GET['eid'];
					$response =callSGWS('user/masters/vehicles/makers/detials',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/vehicles/makers-update.php';
					}
					

					}
			break;

		case 'user/masters/vehicles/makers/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/vehicles/makers/update',$_POST);
						}
			break;
		case 'user/masters/vehicles/makers/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/vehicles/makers/delete',$_POST);
						}
			break;			


		default:
			//GT_default_page();
			break;
	}
}else{
	//GT_default_page();
}
?>