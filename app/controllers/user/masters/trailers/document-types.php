<?php
$nav_type='safety';
	switch (getUri()) {
		case 'user/masters/trailers/document-types/add-new':
			if(in_array('P0168', USER_PRIV)){
				require_once APPROOT.'/views/user/masters/trailers/document-types-add-new.php';
			}
			break;

		case 'user/masters/trailers/document-types/add-new-action':	
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/masters/trailers-document-types/add-new',$_POST);
			}
			break;
		case 'user/masters/trailers/document-types-ajax':
				$param['user_key']=USER_KEY;
				$param=array_merge($param,$_POST);
			echo callSGWS('user/masters/trailers-document-types/list',$param);
				
			break;
		case 'user/masters/trailers/document-types':
			require_once APPROOT.'/views/user/masters/trailers/document-types.php';
			break;
		
		case 'user/masters/trailers/document-types/update':
		if(in_array('P0170', USER_PRIV)){
			if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					$data['details']=[];
					$response =callSGWS('user/masters/trailers-document-types/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
					$OBJ=json_decode($response,true);
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data['details']=$OBJ['response']['details'];
						require_once APPROOT.'/views/user/masters/trailers/document-types-update.php';
					}

					}
				}
			break;

		case 'user/masters/trailers/document-types/update-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/trailers-document-types/update',$_POST);
						}
			break;
		case 'user/masters/trailers/document-types/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/masters/trailers-document-types/delete',$_POST);
						}
			break;			

		default:
			//GT_default_page();
			break;
	}

?>