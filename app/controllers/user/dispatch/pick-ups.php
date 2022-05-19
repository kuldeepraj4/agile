<?php
$nav_type='dispatch';
switch (getUri()) {
	case 'user/dispatch/pick-ups-ajax':
	if(in_array('DIS003', USER_PRIV)){
		$_POST['user_key']=USER_KEY;
		//$_POST['shipper_date']='04/22/2022';
		echo  callSGWS('user/dispatch/loads/pick-ups-list',$_POST);
		// $a= callSGWS('user/dispatch/loads/pick-ups-list',$_POST);
		// echo "<pre>";
		// print_r(json_decode($a,true));
		// echo "</pre>";
	}	
	break;
	case 'user/dispatch/pick-ups':
	if(in_array('DIS003', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/planning/pick-ups.php';
	}
	break;			
	

	case 'user/dispatch/pick-ups/shipper-details-update':
	if(in_array('DIS003', USER_PRIV)){
		if(isset($_GET['stop-eid'])){
			$data=[];
			$response =callSGWS('user/dispatch/loads/dispatch-shipper-details',array('user_key'=>USER_KEY,'stop_eid'=>$_GET['stop-eid']));
			$OBJ=json_decode($response,true);
			if($OBJ['status']==true && isset($OBJ['response']['details'])){
				$data['details']=$OBJ['response']['details'];
				$data['details']['eid']=$_GET['stop-eid'];
				require_once APPROOT.'/views/user/dispatch/planning/pick-ups-shipper-details-update.php';
			}

		}
	}
	break;

	case 'user/dispatch/pick-ups/shipper-details-update-action':
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/dispatch/loads/dispatch-shipper-details-update',$_POST);
	}
	break;

	case 'user/dispatch/pick-ups/date-wise-total-loads-ajax':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			// $_POST['shipper_date_from']='03/22/2022';
			// $_POST['shipper_date_to']='03/29/2022';
			echo $response =callSGWS('user/dispatch/loads/pick-ups/date-wise-total-loads',$_POST);
		}
		break;

	default:
			//GT_default_page();
	break;
}

?>