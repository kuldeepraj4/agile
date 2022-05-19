<?php
$nav_type='maintenance';
if(in_array('P0226', USER_PRIV)){

	switch (getUri()) {
		case 'user/maintenance/repair-orders-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/repair-orders/list',$param);
		break;
		case 'user/maintenance/repair-orders':	
		require_once APPROOT.'/views/user/maintenance/repair-orders/repair-orders.php';
		break;
		case 'user/maintenance/repair-orders/add-new':
		if(in_array('P0227', USER_PRIV)){
			require_once APPROOT.'/views/user/maintenance/repair-orders/repair-orders-add-new.php';
		}
		break;
		case 'user/maintenance/repair-orders/add-new-action':	
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/repair-orders/add-new',$_POST);
		}
		break;
		case 'user/maintenance/repair-orders/details':
		if(in_array('P0228', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['details']=[];
				$response =callSGWS('user/maintenance/repair-orders/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/repair-orders/repair-order-details.php';
				}
			}
		}	
		break;
		case 'user/maintenance/repair-orders/update':
		if(in_array('P0229', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				$data['details']=[];
				$response =callSGWS('user/maintenance/repair-orders/details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
				$OBJ=json_decode($response,true);
				if($OBJ['status']==true && isset($OBJ['response']['details'])){
					$data['details']=$OBJ['response']['details'];
					require_once APPROOT.'/views/user/maintenance/repair-orders/repair-orders-update.php';
				}
			}
		}
		break;

		case 'user/maintenance/repair-orders/update-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/repair-orders/update',$_POST);
		}
		break;
		case 'user/maintenance/repair-orders/upload-document':
		if(in_array('P0227', USER_PRIV) || in_array('P0229', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/maintenance/repair-orders/upload-document.php';
			}
		}
		break;
		case 'user/maintenance/repair-orders/upload-document-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/repair-orders/upload-document',$_POST,$_FILES['document']);

		}
		break;
		
		case 'user/maintenance/repair-orders/delete-action':
		if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/maintenance/repair-orders/delete',$_POST);
		}
		break;

		case 'user/maintenance/repair-orders/follow-up-list-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/repair-orders/follow-ups-list',$param);
		break;


		case 'user/maintenance/repair-orders/add-follow-up-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/maintenance/repair-orders/add-follow-up',$_POST);
		
		break;

		case 'user/maintenance/repair-orders/update-status-action':
		$_POST['user_key']=USER_KEY;
		echo $response =callSGWS('user/maintenance/repair-orders/update-status',$_POST);
		
		break;
		case 'user/maintenance/repair-orders/documents-list-ajax':
		$_POST['user_key']=USER_KEY;
		echo callSGWS('user/maintenance/repair-orders/documents-list',$_POST);
		break;
		case 'user/maintenance/repair-orders/documents':
		
		if(in_array('P0227', USER_PRIV) || in_array('P0229', USER_PRIV)){
			if(isset($_GET['eid'])){
				$data=[];
				$data['eid']=$_GET['eid'];
				require_once APPROOT.'/views/user/maintenance/repair-orders/repair-order-documents.php';
			}
		}
		break;
		case 'user/maintenance/repair-orders/add-followup':
			if(in_array('P0229', USER_PRIV)){
				if(isset($_GET['eid'])){
					$data=[];
					$data['eid']=$_GET['eid'];
					require_once APPROOT.'/views/user/maintenance/repair-orders/add-followup.php';
				}
			}
			break;




		//repair order search added
		case 'user/maintenance/repair-orders-search':
		require_once APPROOT.'/views/user/maintenance/repair-orders/repair-orders-search.php';
		break;

		case 'user/maintenance/repair-orders-search-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST))
		{
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/repair-orders-search/list',$param);
		break;
		//repair order report added
		case 'user/maintenance/repair-orders-report':
		require_once APPROOT.'/views/user/maintenance/repair-orders/repair-orders-report.php';
		break;

		case 'user/maintenance/repair-orders-report-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST))
		{
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/repair-orders-report/list',$param);
		break;

		case 'user/maintenance/repair-orders-report-all_repair_analysis_result_details':
		$param['user_key']=USER_KEY;
		if(isset($_POST))
		{
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/repair-orders-report/all_repair_analysis_result_details',$param);
		break;

		case 'user/maintenance/repair-orders-report-all_result_details':
		$param['user_key']=USER_KEY;
		if(isset($_POST))
		{
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/repair-orders-report/all_result_details',$param);
		break;

		case 'user/maintenance/repair-orders-graph':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/repair-orders/graph',$param);
		break;


		case 'user/maintenance/repair-orders-history-rfc':	
		require_once APPROOT.'/views/user/maintenance/repair-orders/repair-order-history-rfc.php';
		break;


		case 'user/maintenance/repair-orders-history-rfc-list-ajax':
		$param['user_key']=USER_KEY;
		if(isset($_POST)){
			$param=array_merge($param,$_POST);
		}
		echo callSGWS('user/maintenance/repair-orders/repair-order-history-rfc-list',$param);
		break;
	
		default:
		echo NOT_VALID_REQUEST;
		break;
	}
}else{
	echo NOT_VALID_REQUEST;
}
?>