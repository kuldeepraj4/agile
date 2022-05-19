<?php
$nav_type='maintenance';

    switch (getUri()) 
    {
        //List Mode
        case 'user/maintenance/masters/work-order-status-list-ajax':
        $param['user_key']=USER_KEY;
        if(isset($_POST))
        {
            $param=array_merge($param,$_POST);
        }
        echo callSGWS('user/maintenance/masters/work-order-status/list',$param);
        break;

        case 'user/maintenance/masters/work-order-approval-status-list-ajax':
        $param['user_key']=USER_KEY;
        if(isset($_POST))
        {
            $param=array_merge($param,$_POST);
        }
        echo callSGWS('user/maintenance/masters/work-order-approval-status/list',$param);
        break;


        case 'user/maintenance/masters/work-order-status-list-approved-ajax':
        $param['user_key']=USER_KEY;
        if(isset($_POST))
        {
            $param=array_merge($param,$_POST);
        }
        echo callSGWS('user/maintenance/masters/work-order-status/approved',$param);
        break;
        
        default:
        echo NOT_VALID_REQUEST;
        break;
    }


?>