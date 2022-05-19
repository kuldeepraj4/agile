<?php

	switch (getUri()) {

		case 'user/miscellaneous/notes/add-new-action':
			if(isset($_POST)){
			$_POST['user_key']=USER_KEY;
			echo $response =callSGWS('user/miscellaneous/notes/add-new',$_POST);
			}
			break;

		case 'user/miscellaneous/notes/list-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/miscellaneous/notes/list',$param);
			break;

		case 'user/miscellaneous/notes/details':
			if(isset($_GET['reference']) && isset($_GET['eid'])){

				$document_type_eid=isset($_GET['document-type-eid'])?$_GET['document-type-eid']:'';

				$data=[
					'reference'=>$_GET['reference'],
					'eid'=>$_GET['eid'],
					'document_type_eid'=>$document_type_eid,
				];
			require_once APPROOT.'/views/user/quick-view/notes.php';				
			}

			break;

		case 'user/miscellaneous/notes/toggle-high-priority-status':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/miscellaneous/notes/toggle-high-priority-status',$_POST);
						}
			break;
		case 'user/miscellaneous/notes/delete-action':
					if(isset($_POST)){
						$_POST['user_key']=USER_KEY;
							echo $response =callSGWS('user/miscellaneous/notes/delete',$_POST);
						}
			break;						

		default:
			//GT_default_page();
			break;
	}

?>