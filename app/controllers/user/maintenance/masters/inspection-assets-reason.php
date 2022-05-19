<?php
$nav_type='maintenance';

if(in_array('P0206', USER_PRIV)){

	switch (getUri()) {
		case 'user/maintenance/masters/assets-type-list-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/asset-type/list',$param);
		break;

		case 'user/maintenance/masters/reasons-list-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/fault-reason/list',$param);
		break;

		case 'user/maintenance/masters/corrective-list-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/corrective-action/list',$param);
		break;

		case 'user/maintenance/masters/assets-type-list-trucks-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/asset-type-trucks/list',$param);
		break;

		case 'user/maintenance/masters/reasons-list-trucks-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/fault-reason-trucks/list',$param);
		break;

		case 'user/maintenance/masters/corrective-list-trucks-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/corrective-action-trucks/list',$param);
		break;

		case 'user/maintenance/masters/assets-type-list-trailers-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/asset-type-trailers/list',$param);
		break;

		case 'user/maintenance/masters/reasons-list-trailers-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/fault-reason-trailers/list',$param);
		break;

		case 'user/maintenance/masters/corrective-list-trailers-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/masters/corrective-action-trailers/list',$param);
		break;
		
		default:
		echo NOT_VALID_REQUEST;
		break;
	}
}else{
	echo NOT_VALID_REQUEST;
}
?>