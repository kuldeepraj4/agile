<?php
$nav_type='dispatch';


	switch (getUri()) {
		case 'user/dispatch/dashboard':
				require_once APPROOT.'/views/user/dispatch/dashboard.php';			
			break;
				
		default:
			//GT_default_page();
			break;
	}

?>

