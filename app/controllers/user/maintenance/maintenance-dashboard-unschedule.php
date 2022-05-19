<?php

$nav_type='maintenance';
switch (getUri()) 
{

        //List Mode

	case 'user/maintenance/maintenance-dashboard-unschedule':

	require_once APPROOT.'/views/user/maintenance/maintenance-dashboard-unschedule.php';    

	break;

	case 'user/maintenance/maintenance-dashboard-unschedule-ajax':

	$param['user_key']=USER_KEY;

	if(isset($_POST))
	{

		$param=array_merge($param,$_POST);

	}

	echo callSGWS('user/maintenance/maintenance-dashboard-unschedule/list',$param);

	break;
	
	default:

	echo NOT_VALID_REQUEST;

	break;

}

?>