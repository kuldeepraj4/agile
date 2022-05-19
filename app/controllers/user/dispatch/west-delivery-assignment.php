<?php
$nav_type='dispatch';
switch (getUri()) {


	case 'user/dispatch/west-delivery-assignment-ajax-dumy':
	if(in_array('DIS003', USER_PRIV)){
		$_POST['user_key']=USER_KEY;
		$_POST['delivery_date']='05/03/2022';
		$a=  callSGWS('user/dispatch/planning/west-delivery-assignment-list',$_POST);
		echo "<pre>";
		print_r(json_decode($a,true));
		echo "</pre>";
	}	
	break;


	case 'user/dispatch/west-delivery-assignment-ajax':
	if(in_array('DIS003', USER_PRIV)){
		$_POST['user_key']=USER_KEY;
		//$_POST['delivery_date']='05/03/2022';
		echo  callSGWS('user/dispatch/planning/west-delivery-assignment-list',$_POST);
	}	
	break;
	case 'user/dispatch/west-delivery-assignment':
	if(in_array('DIS003', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/planning/west-delivery-assignment.php';
	}
	break;			
	
case 'user/dispatch/west-delivery-assignment/date-wise-total-deliveries-ajax':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			 // $_POST['delivery_date_from']='05/03/2022';
			 // $_POST['delivery_date_to']='05/09/2022';
			echo $response =callSGWS('user/dispatch/planning/west-deliveries/date-wise-total-deliveries',$_POST);
		}
		break;	

	default:
			//GT_default_page();
	break;
}

?>