<?php
switch (getUri()) {
	case 'user/quick-details/quick-trip-details':
        
        if(isset($_GET['eid'])){
            $data=[];
            $data['details']=[];
            $response =callSGWS('user/quick-details/quick-trip-details',array('user_key'=>USER_KEY,'details_for_eid'=>$_GET['eid']));
            $OBJ=json_decode($response,true);
            if($OBJ['status']==true && isset($OBJ['response']['details'])){
                $data['details']=$OBJ['response']['details'];
                   require_once APPROOT.'/views/user/quick-details/quick-trip-details.php';
            }

            }
        	
    break;

 
    case 'user/quick-details/quick-trip-details-document':
    
          
            $param['user_key']=USER_KEY;
            if(isset($_POST)){
                $param=array_merge($param,$_POST,$_GET);
            }
            echo callSGWS('user/quick-details/quick-trip-details-document',$param);
        
            break;


            
	default:
		//GT_default_page();
		break;
}
?>
