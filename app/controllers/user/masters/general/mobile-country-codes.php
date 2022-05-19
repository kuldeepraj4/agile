<?php
$nav_type='masters';
if(in_array('P0097', USER_PRIV)){

	switch (getUri()) {
		case 'user/masters/mobile-country-codes/add-new':

			if(in_array('P0098', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/general/mobile-country-codes-add-new.php';
			}
			break;

		case 'user/masters/mobile-country-codes/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/mobile-country-codes/add-new',$_POST);
			}
			break;
		case 'user/masters/mobile-country-codes-list-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/mobile-country-codes/list',$param);
			break;

		case 'user/masters/mobile-country-codes':
			require_once APPROOT.'/views/user/masters/general/mobile-country-codes.php';	
			break;




		case 'user/masters/mobile-country-codes/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/mobile-country-codes/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/general/mobile-country-codes-update.php';
					}

					}
			break;

		case 'user/masters/mobile-country-codes/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/mobile-country-codes/update',$_POST);
						}
			break;
		case 'user/masters/mobile-country-codes/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/mobile-country-codes/delete',$_POST);
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