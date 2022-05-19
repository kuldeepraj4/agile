<?php
$nav_type='accounts';


	switch (getUri()) {
			case 'user/accounts/assets-management':
				require_once APPROOT.'/views/user/accounts/assets-management.php';			
			break;



		case 'user/accounts/assets-management/list-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/accounts/assets-management/list',$param);
						
		break;

		case 'user/accounts/assets-management/list-excel-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/accounts/assets-management/list',$param);
						
		break;

		
		case 'user/accounts/assets-management/update-action':	
		if(isset($_POST)){

			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/accounts/assets-management/update',$_POST);
		}
		break;
				
		default:
			//GT_default_page();
			break;
	}

?>

