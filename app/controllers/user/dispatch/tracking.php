<?php
$nav_type = 'dispatch';
switch (getUri()) {

    case 'user/dispatch/tracking/tms-truck-group-wise-ajax':
    $_POST['user_key'] = USER_KEY;
    echo callSGWS('user/dispatch/tracking/tms-truck-group-wise', $_POST);
    break;

    case 'user/dispatch/tracking/tracking-truck':
    if (in_array('DIS003', USER_PRIV)) {
        require_once APPROOT . '/views/user/dispatch/tracking/tracking-truck.php';
    }
    break;
    case 'user/dispatch/tracking/tracking-trailer':
    if (in_array('DIS003', USER_PRIV)) {
        require_once APPROOT . '/views/user/dispatch/tracking/tracking-trailer.php';
    }
    break;
    case 'user/dispatch/tracking/tracking-driver':
    if (in_array('DIS003', USER_PRIV)) {
        require_once APPROOT . '/views/user/dispatch/tracking/tracking-driver.php';
    }
    break;
    case 'user/dispatch/tracking/tracking-truck-ajax':
    $_POST['user_key'] = USER_KEY;
    echo  callSGWS('user/dispatch/tracking/trucks', $_POST);
    break;
    case 'user/dispatch/tracking/tracking-trailer-ajax':
    $_POST['user_key'] = USER_KEY;
    echo callSGWS('user/dispatch/tracking/trailers', $_POST);
    break;
    case 'user/dispatch/tracking/tracking-driver-ajax':
    $_POST['user_key'] = USER_KEY;
    echo  callSGWS('user/dispatch/tracking/drivers', $_POST);
    break;
    case 'user/dispatch/tracking/tracking-truck-update':
    if (in_array('DIS003', USER_PRIV)) {
        require_once APPROOT . '/views/user/dispatch/tracking/tracking-truck-update.php';
    }
    break;
    case 'user/dispatch/tracking/tracking-truck-update-action':
    $_POST['user_key'] = USER_KEY;
    echo  callSGWS('user/dispatch/tracking/truck-update', $_POST);
    break;

    case 'user/dispatch/tracking/tracking-trailer-update':
    if (in_array('DIS003', USER_PRIV)) {
        require_once APPROOT . '/views/user/dispatch/tracking/tracking-trailer-update.php';
    }
    break;
    case 'user/dispatch/tracking/tracking-trailer-update-action':
    $_POST['user_key'] = USER_KEY;
    echo callSGWS('user/dispatch/tracking/trailer-update', $_POST);
    break;

    case 'user/dispatch/tracking/tracking-driver-update':
    if (in_array('DIS003', USER_PRIV)) {
        require_once APPROOT . '/views/user/dispatch/tracking/tracking-driver-update.php';
    }
    break;
    case 'user/dispatch/tracking/tracking-driver-update-action':
    $_POST['user_key'] = USER_KEY;
    echo  callSGWS('user/dispatch/tracking/driver-update', $_POST);
    break;

    case 'user/dispatch/tracking/tms-tracker':
    if (in_array('DIS003', USER_PRIV)) {
        require_once APPROOT . '/views/user/dispatch/tracking/tms-tracker.php';
    }
    break;

    case 'user/dispatch/tracking/trailers/locations-ajax':
    $_POST['user_key'] = USER_KEY;
    echo callSGWS('user/masters/trailers/locations', $_POST);

    break;

    case 'user/dispatch/tracking/trailers/locations':
    require_once APPROOT . '/views/user/masters/trailers/locations.php';
    break;


    case 'user/dispatch/tracking/loads-tracking-status-wise-total':
    $_POST['user_key'] = USER_KEY;
    echo callSGWS('user/dispatch/tracking/loads-tracking-status-wise-total', $_POST);
    break;


    case 'user/dispatch/tracking/loads-ajax':
    $_POST['user_key'] = USER_KEY;
    echo callSGWS('user/dispatch/tracking/loads', $_POST);
    break;

    case 'user/dispatch/tracking/tracking-loads':
    if (in_array('DIS003', USER_PRIV)) {
        require_once APPROOT . '/views/user/dispatch/tracking/tracking-loads.php';
    }
    break;

    case 'user/dispatch/tracking/load-details':
    require_once APPROOT.'/views/user/dispatch/tracking/tracking-loads-details.php';
    if (in_array('DIS003', USER_PRIV)) {
     if(isset($_GET['eid'])){
        $data=[];
        $data['eid']=$_GET['eid'];
        $data['details']=[];
        $response =callSGWS('user/dispatch/tracking/load-details',array('user_key'=>USER_KEY,'eid'=>$_GET['eid']));
        $OBJ=json_decode($response,true);
        if($OBJ['status']==true && isset($OBJ['response']['details'])){
            $data['details']=$OBJ['response']['details'];
            require_once APPROOT.'/views/user/dispatch/load/load-status-update.php';
        }

    }
}
break;
case 'user/dispatch/tracking/load-tracking-history-ajax':
$_POST['user_key'] = USER_KEY;
echo callSGWS('user/dispatch/tracking/load-tracking-history', $_POST);
break;

case 'user/dispatch/tracking/load-tracking-history':
if (in_array('DIS003', USER_PRIV)) {
 if(isset($_GET['eid'])){
    $data['eid']=$_GET['eid'];
    require_once APPROOT.'/views/user/dispatch/tracking/tracking-load-hisotory.php';
}
}
break;

default:
        //GT_default_page();
break;
}
