<?php
$nav_type='masters';
if(in_array('P0077', USER_PRIV)){


	switch (getUri()) {
		case 'user/masters/trailers/reefer-companies/add-new':
			if(in_array('P0078', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/trailers/reefer-companies-add-new.php';
			}
			break;

		case 'user/masters/trailers/reefer-companies/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/reefer-companies/add-new',$_POST);
			}
			break;
		case 'user/masters/trailers/reefer-companies-list-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/reefer-companies/list',$param);
				
			break;
		case 'user/masters/trailers/reefer-companies':
		if(in_array('P0077', USER_PRIV)){
			require_once APPROOT.'/views/user/masters/trailers/reefer-companies.php';
			}	
			break;
		case 'user/masters/trailers/reefer-companies/update':
		if(in_array('P0080', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					 $response =callSGWS('user/masters/reefer-companies/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/trailers/reefer-companies-update.php';
					}

					}
				}
			break;

		case 'user/masters/trailers/reefer-companies/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/reefer-companies/update',$_POST);
						}
			break;
		case 'user/masters/trailers/reefer-companies/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/reefer-companies/delete',$_POST);
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