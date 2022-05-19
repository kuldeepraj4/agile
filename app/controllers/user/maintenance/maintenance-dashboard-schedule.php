<?php

$nav_type='maintenance';


    switch (getUri()) 
    {

        //List Mode

        case 'user/maintenance/maintenance-dashboard-schedule':

        require_once APPROOT.'/views/user/maintenance/maintenance-dashboard-schedule.php';    

        break;

        case 'user/maintenance/maintenance-dashboard-schedule-ajax':

        $param['user_key']=USER_KEY;

        if(isset($_POST))
        {

            $param=array_merge($param,$_POST);

        }

        echo callSGWS('user/maintenance/maintenance-dashboard-schedule/list',$param);

        break;
                
        default:

        echo NOT_VALID_REQUEST;

        break;

    }


?>