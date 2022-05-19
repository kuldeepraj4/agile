
<?php
switch (getUri()) {
		case 'login':
		require_once '../app/views/home/login.php';
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
				$_SESSION['user_locked_time']=$OBJ['response']['user_locked_time'];
				$_SESSION['userPriv']=explode(',',$OBJ['response']['userPriv']);
				$_SESSION['loggedin_time'] = time();
			}
			echo json_encode(($OBJ));
			break;		
		case 'login-forget-password':
		require_once '../app/views/home/forget-password.php';
		break;

		case 'login-forget-password-action':
		echo $response =callSGWS('user/login-forget-password',$_POST);
		break;


		case 'login-set-new-password':
		if(isset($_GET['token'])){
			$data['token']=$_GET['token'];
		require_once '../app/views/home/set-new-password.php';
		}else{
			echo "invalid page";
		}
		break;

		case 'login-set-new-password-action':
		echo $response =callSGWS('user/login-set-new-password',$_POST);
		break;
		default:

			//GT_default_page();
			break;
	}

?>