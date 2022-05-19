<?php
$nav_type='dispatch';
switch (getUri()) {

	case 'user/dispatch/quality/approval-status-list-ajax':
	if(in_array('DIS007', USER_PRIV)){
		$_POST['user_key']=USER_KEY;
		echo $a= callSGWS('user/dispatch/loads/approval-status-list',$_POST);
	}	
	break;


	case 'user/dispatch/quality/load-approval-status':
	if(in_array('DIS007', USER_PRIV)){
		require_once APPROOT.'/views/user/dispatch/quality/load-approval-status-list.php';
	}	
	break;

	// case 'user/dispatch/sales/add-express-load':
	// if(in_array('DIS002', USER_PRIV)){
	// 	require_once APPROOT.'/views/user/dispatch/load/express-load-add-new.php';
	// }
	// break;

	// case 'user/dispatch/loads/express-add-new-action':
	// if(isset($_POST)){
	// 	$_POST['user_key']=USER_KEY;
	// 	if(isset($_FILES['document'])){
	// 		$document=$_FILES['document'];
	// 	}else{
	// 		$document=$_FILES;
	// 	}
	// 	echo $response =callSGWS('user/dispatch/loads/express-add-new',$_POST,$document);
	// }
	// break;



	break;
	default:
			//GT_default_page();
	break;
}

?>