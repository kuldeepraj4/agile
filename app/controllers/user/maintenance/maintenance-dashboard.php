<?php

$nav_type='maintenance';

switch (getUri()) 

    {

        //List Mode

        case 'user/maintenance/maintenance-dashboard':

        require_once APPROOT.'/views/user/maintenance/maintenance-dashboard.php';    

        break;

        case 'user/maintenance/maintenance-dashboard-ajax':

        $param['user_key']=USER_KEY;

        if(isset($_POST))

        {

            $param=array_merge($param,$_POST);

        }

        echo callSGWS('user/maintenance/maintenance-dashboard/list',$param);

        break;

        case 'user/maintenance/maintenance-dashboard/update-live-dashboard-pm':
            $param['user_key']=USER_KEY;
            if(isset($_POST))
            {
                $param=array_merge($param,$_POST);
            }
            echo callSGWS('user/maintenance/maintenance-dashboard/update-live-dashboard-pm',$param);  
        break;

        default:

        echo NOT_VALID_REQUEST;

        break;

    }

?>