<?php
$nav_type='safety';


	switch (getUri()) {
		case 'user/safety/dashboard':
				require_once APPROOT.'/views/user/safety/dashboard.php';			
			break;


		case 'user/safety/dashboard/drivers-documents-quick-totals':
		if(isset($_POST)){
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
			echo $response =callSGWS('user/masters/drivers-documents/quick-totals',$param);
		}
		break;

		case 'user/safety/dashboard/trailers-documents-quick-totals':
		if(isset($_POST)){
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
			echo $response =callSGWS('user/masters/trailers-documents/quick-totals',$param);
		}
		break;

		case 'user/safety/dashboard/trucks-documents-quick-totals':
		
		if(isset($_POST)){
			$param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
			echo $response =callSGWS('user/masters/trucks-documents/quick-totals',$param);

		}
		
		
		break;



		default:
			//GT_default_page();
			break;
	}

?>

