<?php

$nav_type='maintenance';

if(in_array('P0007', USER_PRIV)){

	switch (getUri()) 
	{
		case 'user/maintenance/inspection':
		if(in_array('P0009', USER_PRIV))
		{
			require_once APPROOT.'/views/user/maintenance/inspection/inspection.php';
		}
		break;

		case 'user/maintenance/inspection-ajax':
		if(in_array('P0009', USER_PRIV))
		{
			$param['user_key']=USER_KEY;
			if(isset($_POST))
			{
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/maintenance/inspection/list',$param);
		}
		break;

		case 'user/maintenance/inspection/inspection-add-new':
		if(in_array('P0008', USER_PRIV))
		{
			require_once APPROOT.'/views/user/maintenance/inspection-add-new.php';
		}
		break;

		case 'user/maintenance/inspection/inspection-add-new-action':	
		if(isset($_POST))
		{
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/inspection/add-new',$_POST);
		}
		break;

		case 'user/maintenance/inspection/inspection-details':
		if(in_array('P0009', USER_PRIV))
		{
			if(isset($_GET['eid']))
			{
				$data=[];
				$data['details']=[];
				$response =callSGWS('user/maintenance/inspection/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details']))
				{
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/inspection-details.php';
				}
			}
		}	
		break;	

		case 'user/maintenance/inspection/inspection-update':
		if(in_array('P0010', USER_PRIV))
		{
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				$data['details']=[];
			    $response =callSGWS('user/maintenance/inspection/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details']))
				{
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/inspection-update.php';
				}
			}
		}
		break;

		case 'user/maintenance/inspection/inspection-update-action':
		if(isset($_POST))
		{
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/inspection/update',$_POST);
		}
		break;

		case 'user/maintenance/inspection/inspection-delete-action':
		if(isset($_POST))
		{
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/inspection/delete',$_POST);
		}
		break;			
		default:
		GT_default_page();
		break;
	}
}
else
{
	GT_default_page();
}

?>