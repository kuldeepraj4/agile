<?php
if(isset($_GET['trip-id'])  && isset($_GET['driver-id'])){

					echo $response =callSGWS('driver-salary-slips/list',array('trip_eid'=>$_GET['trip-id'],'driver_eid'=>$_GET['driver-id']));
					$OBJ=json_decode($response,true);
					echo "<pre>";
					print_r($OBJ['response']['details']);
					echo "</pre>";
					if($OBJ['status']==true && isset($OBJ['response']['details'])){
						$data=$OBJ['response']['details'];
						require_once '../app/views/general/driver-salary-slip.php';
					}

					}
?>