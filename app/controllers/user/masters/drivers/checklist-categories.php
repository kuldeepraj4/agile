<?php
$nav_type='safety';
	switch (getUri()) {

		case 'user/masters/drivers/checklist/categories-list-ajax':
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/masters/drivers/checklist/categories/list',$param);
				
			break;

		
		default:
			//GT_default_page();
			break;
	}
?>