<?php
$nav_type='masters';

switch (getUri()) {

		case 'user/masters/employees/salary-parameters/add-new':

			if(in_array('P0130', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/employees/salary-parameters-add-new.php';
			}
			break;

		case 'user/masters/employees/salary-parameters/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/salary-parameters/add-new',$_POST);
			}
			break;


		case 'user/masters/employees/salary-parameters-types-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/salary-parameter-types/list',$param);
			break;

		case 'user/masters/employees/salary-parameters-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/salary-parameters/list',$param);
			break;

		case 'user/masters/employees/salary-parameters':
			require_once APPROOT.'/views/user/masters/employees/salary-parameters.php';	
			break;




		case 'user/masters/employees/salary-parameters/update':
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/salary-parameters/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/employees/salary-parameters-update.php';
					}

					}
			break;

		case 'user/masters/employees/salary-parameters/update-action':
					if(isset($_POST)){

						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/salary-parameters/update',$_POST);
						}
			break;
		case 'user/masters/employees/salary-parameters/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/salary-parameters/delete',$_POST);
						}
			break;			


		default:
			//GT_default_page();
			break;
	}

?>