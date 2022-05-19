<?php
switch (getUri()) {
	case 'user/quick-details/quick-history-details':
        if(isset($_GET['reference']) && isset($_GET['eid'])){
            $data=[];
            $data['reference']=$_GET['reference'];
            $data['eid']=$_GET['eid'];
            require_once APPROOT.'/views/user/quick-details/quick-history-details.php';
        }	
    break;

 
    case 'user/quick-details/quick-history-details-action':
    
    echo $response =callSGWS('user/quick-details/quick-history-details',array_merge(['user_key'=>USER_KEY],$_POST));

    break;
      


            
	default:
		GT_default_page();
		break;
}
?>
