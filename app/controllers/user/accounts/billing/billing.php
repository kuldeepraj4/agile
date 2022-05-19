<?php
$nav_type='accounts';
switch (getUri()) {


    case 'user/accounts/billing/ready-to-bill-ajax':
    // if(in_array('DIS003', USER_PRIV)){
        $_POST['user_key']=USER_KEY;
        echo  callSGWS('user/accounts/billing/ready-to-bill',$_POST);
        // $a= callSGWS('user/dispatch/loads/pick-ups-list',$_POST);
        // echo "<pre>";
        // print_r(json_decode($a,true));
        // echo "</pre>";
    // }   
    break;


    case 'user/accounts/billing/ready-to-bill':
        // if(in_array('P0162', USER_PRIV)){
        require_once APPROOT . '/views/user/accounts/billing/ready-to-bill.php';
        // }
        break;

    case 'user/accounts/billing/freight-bill-processing-queue-ajax':
    // if(in_array('DIS003', USER_PRIV)){
        $_POST['user_key']=USER_KEY;
        echo  callSGWS('user/accounts/billing/freight-bill-processing-queue',$_POST);
        // $a= callSGWS('user/dispatch/loads/pick-ups-list',$_POST);
        // echo "<pre>";
        // print_r(json_decode($a,true));
        // echo "</pre>";
    // }   
    break;



    case 'user/accounts/billing/freight-bill-processing-queue':
        // if(in_array('P0162', USER_PRIV)){
        require_once APPROOT . '/views/user/accounts/billing/freight-bill-processing-queue.php';
        // }
        break;

    case 'user/accounts/billing/freight-bill-print-queue-ajax':
    // if(in_array('DIS003', USER_PRIV)){
        $_POST['user_key']=USER_KEY;
        echo  callSGWS('user/accounts/billing/freight-bill-print-queue',$_POST);
        // $a= callSGWS('user/dispatch/loads/pick-ups-list',$_POST);
        // echo "<pre>";
        // print_r(json_decode($a,true));
        // echo "</pre>";
    // }   
    break;

    case 'user/accounts/billing/freight-bill-print-queue':
        // if(in_array('P0162', USER_PRIV)){
        require_once APPROOT . '/views/user/accounts/billing/freight-bill-print-queue.php';
        // }
        break;


    case 'user/accounts/billing/submit-factoring-list-ajax':
    // if(in_array('DIS003', USER_PRIV)){
        $_POST['user_key']=USER_KEY;
        echo  callSGWS('user/accounts/billing/submit-factoring-list',$_POST);
        // $a= callSGWS('user/dispatch/loads/pick-ups-list',$_POST);
        // echo "<pre>";
        // print_r(json_decode($a,true));
        // echo "</pre>";
    // }   
    break;


        
    case 'user/accounts/billing/submit-factoring-list':
        // if(in_array('P0162', USER_PRIV)){
        require_once APPROOT . '/views/user/accounts/billing/submit-factoring-list.php';
        // }
        break;


    case 'user/accounts/billing/mark-ready-to-bill-action':
    // if(in_array('DIS003', USER_PRIV)){
        $_POST['user_key']=USER_KEY;
        echo  callSGWS('user/accounts/billing/mark-ready-to-bill',$_POST);
        // $a= callSGWS('user/dispatch/loads/pick-ups-list',$_POST);
        // echo "<pre>";
        // print_r(json_decode($a,true));
        // echo "</pre>";
    // }   
    break;
    default:
        //GT_default_page();
        break;
}
