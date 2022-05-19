<?php
if(in_array('P7', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/drivers':
			require_once APPROOT.'/views/user/masters/drivers/index.php';					
		
			break;
		case 'user/masters/drivers/add-new':
			if(in_array('P8', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/drivers/add-new.php';
			}
			break;

		case 'user/masters/drivers/add-new/action':
			if(isset($_POST)){

			$_POST['request']='add_new_driver';
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters-drivers/add-new',$_POST);
			//$OBJ=json_decode($response,true);
			//echo json_encode(($OBJ));
			}
			break;					

		default:
			GT_default_page();
			break;
	}
}else{
	GT_default_page();
}
?>