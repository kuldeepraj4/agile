<?php
$nav_type = 'masters';

switch (getUri()) {

    case 'user/masters/dispatch/asset-current-status/truck-quick-list-ajax':
        $_POST['user_key'] = USER_KEY;
        echo callSGWS('user/masters/asset-current-status/truck-quick-list', $_POST);

        break;
    case 'user/masters/dispatch/asset-current-status/trailer-quick-list-ajax':
        $_POST['user_key'] = USER_KEY;
        echo callSGWS('user/masters/asset-current-status/trailer-quick-list', $_POST);

        break;
    case 'user/masters/dispatch/asset-current-status/driver-quick-list-ajax':
        $_POST['user_key'] = USER_KEY;
        echo callSGWS('user/masters/asset-current-status/driver-quick-list', $_POST);

        break;

    default:
        //GT_default_page();
        break;
}
