<?php
$nav_type='settings';
switch (getUri()) {
		case 'user/settings/profile/reset-password':
		require_once APPROOT.'/views/user/settings/profile/reset-password.php';
		break;
		case 'user/settings/profile/reset-password-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/settings/profile/reset-password',$_POST);
		break;
			case 'login-action':
			$Sp=[];// send paramter array;
			$Sp=$_POST;
			$Sp['request']='login';
			$response =callSGWS('user/login',$Sp);
			$OBJ=json_decode($response,true);
			if($OBJ['status']){
				$_SESSION['userKey']=$OBJ['response']['userkey'];
				$_SESSION['userName']=$OBJ['response']['username'];
				$_SESSION['userPriv']=explode(',',$OBJ['response']['userPriv']);
			}
			echo json_encode(($OBJ));
			break;		

		default:
			//GT_default_page();
			break;
	}

?>