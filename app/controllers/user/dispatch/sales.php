<?php
$nav_type='dispatch';
switch (getUri()) {

	case 'user/dispatch/sales/planning-list-ajax':
	if(in_array('DIS003', USER_PRIV)){
		$_POST['user_key']=USER_KEY;
		echo $a= callSGWS('user/dispatch/loads/sales-planning-list',$_POST);
	}	
	break;


	case 'user/dispatch/sales/planning-list':
	if(in_array('DIS003', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/planning/sales-planning-list.php';
	}	
	break;

	case 'user/dispatch/sales/add-express-load':
	if(in_array('DIS002', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/load/express-load-add-new.php';
	}
	break;

	case 'user/dispatch/loads/express-add-new-action':
	if(isset($_POST)){
		$_POST['user_key']=USER_KEY;
		if(isset($_FILES['document'])){
			$document=$_FILES['document'];
		}else{
			$document=$_FILES;
		}
		echo $response =callSGWS('user/dispatch/loads/express-add-new',$_POST,$document);
	}
	break;



	break;
	default:
			//GT_default_page();
	break;
}

?>