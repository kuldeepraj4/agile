<?php
$nav_type='maintenance';

if(in_array('P0087', USER_PRIV)){

    switch (getUri()) {
        
        //List Mode
        case 'user/maintenance/masters/repair-order-criticality-level-list-ajax':
        $param['user_key']=USER_KEY;
        if(isset($_POST)){
            $param=array_merge($param,$_POST);
        }
        echo callSGWS('user/maintenance/masters/repair-order-criticality-level/list',$param);
        break;
        
        case 'user/maintenance/masters/repair-order-criticality-level':
        require_once APPROOT.'/views/user/maintenance/masters/repair-order-criticality-level.php';    
        break;

        //Add New Mode
        case 'user/maintenance/masters/repair-order-criticality-level/add-new':
        if(in_array('P0088', USER_PRIV)){
            require_once APPROOT.'/views/user/maintenance/masters/repair-order-criticality-level-add-new.php';
        }
        break;
        
        case 'user/maintenance/masters/repair-order-criticality-level/add-new-action':
        if(isset($_POST)){
            $_POST['user_key']=USER_KEY;
            echo $response =callSGWS('user/maintenance/masters/repair-order-criticality-level/add-new',$_POST);
        }
        break;

        //Modify Mode
        case 'user/maintenance/masters/repair-order-criticality-level/update':
        if(isset($_GET['eid'])){
            $data=[];
            $data['eid']=$_GET['eid'];
            $data['details']=[];
            $response =callSGWS('user/maintenance/masters/repair-order-criticality-level/details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
            $OBJ=json_decode($response,true);
            if($OBJ['status']==true && isset($OBJ['response']['details'])){
                $data['details']=$OBJ['response']['details'];
                require_once APPROOT.'/views/user/maintenance/masters/repair-order-criticality-level-update.php';
            }
        }
        break;
        case 'user/maintenance/masters/repair-order-criticality-level/update-action':
        if(isset($_POST)){
            $_POST['user_key']=USER_KEY;
            echo $response =callSGWS('user/maintenance/masters/repair-order-criticality-level/update',$_POST);
        }
        break;

        //Delete Mode
        case 'user/maintenance/masters/repair-order-criticality-level/delete-action':
        if(isset($_POST)){
            $_POST['user_key']=USER_KEY;
            echo $response =callSGWS('user/maintenance/masters/repair-order-criticality-level/delete',$_POST);
        }
        break;          
        default:
       echo NOT_VALID_REQUEST;
        break;
    }
}else{
    echo NOT_VALID_REQUEST;
}
?>