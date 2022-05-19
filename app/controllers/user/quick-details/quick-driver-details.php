<?php
switch (getUri()) {

	case 'user/quick-details/quick-driver-details':
		if (isset($_GET['eid'])) {
			$data = [];
			$data['details'] = [];
			$param['user_key']=USER_KEY;
			$param['driver_eid']=$_GET['eid'];
			$param=array_merge($param,$_GET);
			$response = callSGWS('user/quick-details/quick-driver-details',$param);
			$OBJ = json_decode($response, true);
			if ($OBJ['status'] == true && isset($OBJ['response']['details'])) {
				$data['details'] = $OBJ['response']['details'];
				require_once APPROOT . '/views/user/quick-details/quick-driver-details.php';
			}


		}
 


		break;

		case 'user/quick-details/quick-driver-details-alllist':


            $param['user_key']=USER_KEY;
			$param=array_merge($param,$_POST);
            echo callSGWS('user/quick-details/quick-driver-details-alllist',$param);
            
           break;

		case 'user/quick-details/quick-driver-details-rolist':


            
            $param['user_key']=USER_KEY;
            if(isset($_POST)){
                $param=array_merge($param,$_POST,$_GET);
                
            }
            echo callSGWS('user/quick-details/quick-driver-details-rolist',$param);
           
           break;

		case 'user/quick-details/quick-driver-details-trip':

		
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/quick-details/quick-driver-details-trip',$param);
			
			break;
			

		break;

		case 'user/quick-details/quick-driver-details-payment':

			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/quick-details/quick-driver-details-payment',$param);
		
			break;



			case 'user/quick-details/quick-driver-details-document':

			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST,$_GET);
			}
			echo callSGWS('user/quick-details/quick-driver-details-document',$param);
			
			break;
			









	default:
		//GT_default_page();
		break;
}



?>

