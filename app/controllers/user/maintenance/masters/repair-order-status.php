<?php
$nav_type='maintenance';


    switch (getUri()) 
    {

        //List Mode
        case 'user/maintenance/masters/repair-order-status-list-ajax':
        $param['user_key']=USER_KEY;
        if(isset($_POST))
        {
            $param=array_merge($param,$_POST);
        }
        echo callSGWS('user/maintenance/masters/repair-order-status/list',$param);
        break;
        
        default:
        echo NOT_VALID_REQUEST;
        break;
    }


?>