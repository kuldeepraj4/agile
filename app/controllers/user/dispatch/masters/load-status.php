<?php

$nav_type='dispatch';

switch (getUri()) {

		case 'user/dispatch/load-status-list-ajax':

			if(isset($_POST)){
				$param['user_key']=USER_KEY;
				$param=array_merge($param,$_POST);
				echo callSGWS('user/dispatch/load-status/list',$param);
			}

			break;


		default:

			//GT_default_page();

			break;

	}



?>