<?php
if(in_array('P2', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/users':
			$data=[];
			$data['list']=[];
			$response =callSGWS('user/masters-users/list',array('user_key'=>USER_KEY));
			$OBJ=json_decode($response,true);
			if(isset($OBJ['response']['list'])){
				$data['list']=$OBJ['response']['list'];
			}
			//echo json_encode(($OBJ));
			require_once APPROOT.'/views/user/masters/users/index.php';					
		
			break;
		case 'user/masters/users/add-new':
			if(in_array('P3', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/users/add-new.php';
			}
			break;

		case 'user/masters/users/add-new/action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters-users/add-new',$_POST);
			}
			break;
		case 'user/masters/users/update':
		if(isset($_GET['type'])){
			switch ($_GET['type']) {
				case 'user-update-form':
					if(isset($_GET['eid'])){
					$data=[];
					$data['details']=[];
					$response =callSGWS('user/masters-users/user-details',array('user_key'=>USER_KEY,'user_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if(isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
					}
					require_once APPROOT.'/views/user/masters/users/update.php';

					}
					break;
				case 'user-update-action':
					if(isset($_POST)){
						if(isset($_GET['eid'])){
						$_POST['user_key']=USER_KEY;
						$_POST['update_eid']=$_GET['eid'];
							echo $response =callSGWS('user/masters-users/update-user',$_POST);
					}
					}
					break;	
				
				default:
					# code...
					break;
			}
								
		}
			break;


		default:
			//GT_default_page();
			break;
	}
}else{
	GT_default_page();
}
?>