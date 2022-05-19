<?php
switch (getUri()) {
	case 'user/quick-details/quick-search':
		require_once APPROOT . '/views/user/quick-details/quick-search.php';
		break;

	default:
		//GT_default_page();
		break;
}


?>