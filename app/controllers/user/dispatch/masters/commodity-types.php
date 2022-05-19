<?php
$nav_type='dispatch';
switch (getUri()) {
	case 'user/dispatch/loads/add-new':

		case 'user/dispatch/commodity-types-ajax':
		if(in_array('P0174', USER_PRIV)){
			$param['user_key']=USER_KEY;
			if(isset($_POST)){
				$param=array_merge($param,$_POST);
			}
			echo callSGWS('user/dispatch/commodity-types/list',$param);
			}	
			break;
		case 'user/dispatch/loads':

				
	
		default:
			//GT_default_page();
			break;
	}

?>