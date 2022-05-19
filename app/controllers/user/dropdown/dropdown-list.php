<?php
switch (getUri()) {

	
	case 'user/dropdown/trucks-quick-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/trucks/quick-list', $param);
	break;

	
	case 'user/dropdown/trailers/quick-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/trailers/quick-list', $param);
	break;

	case 'user/dropdown/truck-document-types-ajax':
	$param['user_key']=USER_KEY;
	$param=array_merge($param,$_POST);
	echo callSGWS('user/masters/trucks-document-types/quick-list',$param);
	break;

	case 'user/dropdown/driver-document-types-ajax':
	$param['user_key']=USER_KEY;
	$param=array_merge($param,$_POST);
	echo callSGWS('user/masters/driver-document-types/quick-list',$param);
	break;


	case 'user/dropdown/trailer-document-types-ajax':
	$param['user_key']=USER_KEY;	
	$param=array_merge($param,$_POST);
	echo callSGWS('user/masters/trailers-document-types/quick-list',$param);
	break;
	
	case 'user/dropdown/drivers-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/drivers/quick-list', $param);
	break;
	
	case 'user/dropdown/locations/countries-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/locations/countries/quick-list', $param);
	break;
	
	case 'user/dropdown/locations/cities-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/locations/cities/quick-list',$param);
	break;

	case 'user/dropdown/locations/states-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/locations/states/quick-list',$param);
	break;

	
	case 'user/dropdown/locations/zipcodes-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/locations/zipcodes/quick-list',$param);
	break;

	
	case 'user/dropdown/mobile-country-codes-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/mobile-country-codes/quick-list', $param);
	break;

	
	case 'user/dropdown/route-types-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/route-types/quick-list', $param);
	break;

	
	case 'user/dropdown/vehicles-quick-list':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/vehicles/quick-list', $param);
	break;
	
	case 'user/dropdown/vehicles/makers-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/vehicles/makers/quick-list', $param);
	break;
	
	case 'user/dropdown/vehicles/models-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/vehicles/models/quick-list', $param);
	break;

	
	case 'user/dropdown/vehicles/status-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/vehicles/status/quick-list', $param);
	break;

	
	case 'user/dropdown/employees/salary-parameters-ajax':
	$_POST['user_key']=USER_KEY;
	echo callSGWS('user/masters/salary-parameters/quick-list', $_POST);
	break;

	
	case 'user/dropdown/employees/salary-parameters-types-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/salary-parameter-types/list', $param);
	break;

	
	case 'user/dropdown/employees/status-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/employees/status/quick-list', $param);
	break;

	
	case 'user/dropdown/employees/prefix-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/employees/prefix/quick-list', $param);
	break;

	
	case 'user/dropdown/employees/residency-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/employees/residency/quick-list', $param);
	break;

	
	case 'user/dropdown/vehicles/ownership-types-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/vehicles/ownership-types/quick-list', $param);
	break;

	
	case 'user/dropdown/vehicles/colors-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/vehicles/colors/quick-list', $param);
	break;

	
	case 'user/dropdown/companies-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/companies/list', $param);
	break;
	
	case 'user/dropdown/vehicles/lease-companies-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/lease-companies/quick-list', $param);
	break;

	
	case 'user/dropdown/vehicles/device-companies-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/device-companies/quick-list', $param);
	break;
	
	case 'user/dropdown/vehicles/insurance-companies-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/insurance-companies/quick-list', $param);
	break;

	
	case 'user/dropdown/trailers/reefer-companies-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/reefer-companies/quick-list', $param);
	break;

	
	case 'user/dropdown/drivers/groups-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/driver-groups/list', $param);
	break;
	
	case 'user/dropdown/drivers/ppm-plans-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/driver-ppm-plans/quick-list', $param);
	break;

	
	case 'user/dropdown/drivers/driver-leave-reasons-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/drivers-leave/reasons-list', $param);
	break;

	
	case 'user/dropdown/trip-stop-types-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/trip-stop-types/list', $param);
	break;

	
	case 'user/dropdown/users/roles-groups-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/users/roles-groups/list', $param);
	break;

	
	case 'user/dropdown/users-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/users/list', $param);
	break;

	
	case 'user/dropdown/users/quick-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/users/quick-list', $param);
	break;

	
	case 'user/dropdown/hierarchy/levels-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/hierarchy/levels/list', $param);
	break;

	
	case 'user/dropdown/users-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/users/list', $param);
	break;

	
	case 'user/dropdown/users/quick-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/users/quick-list', $param);
	break;
	
	case 'user/dropdown/trips/months-list':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/accounts/trips/months-list', $param);
	break;

	
	case 'user/dropdown/tickets-stages/tickets-stages-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/task-management/tickets-stages/tickets-stages', $param);
	break;
	
	case 'user/dropdown/trips/quick-list':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/accounts/trips/quick-list', $param);
	break;

	
	case 'user/dropdown/drivers-quick-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/drivers/quick-list', $param);
	break;

	
	case 'user/dropdown/ticket-priorities/list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/task-management/ticket-priorities', $param);
	break;

	
	case 'user/dropdown/driver-teams/quick-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/driver-teams/quick-list', $param);
	break;

	
	case 'user/dropdown/masters/repair-order-class-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/repair-order-class/list', $param);
	break;

	
	case 'user/dropdown/masters/repair-order-stage-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/repair-order-stage/quick-list', $param);
	break;

	
	case 'user/dropdown/masters/repair-order-type-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/repair-order-type/quick-list', $param);
	break;

	
	case 'user/dropdown/masters/repair-order-status-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/repair-order-status/quick-list', $param);
	break;


	case 'user/dropdown/masters/repair-order-rfc-error-quick-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/repair-order-rfc-error/quick-list', $param);
	break;
	
	case 'user/dropdown/masters/repair-order-category-quick-list':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/repair-order-category/quick-list', $param);
	break;

	
	case 'user/dropdown/masters/repair-order-criticality-level-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/repair-order-criticality-level/list', $param);
	break;

	
	case 'user/dropdown/masters/vendor-quick-list':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/vendor/qucik-list', $param);
	break;

	
	case 'user/dropdown/masters/job-work-type-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/job-work-type/quick-list', $param);
	break;

	
	case 'user/dropdown/masters/job-work-quick-list':
	$param['user_key']=USER_KEY;
        if(isset($_POST))
        {
            $param=array_merge($param,$_POST);
        }
	echo callSGWS('user/maintenance/masters/job-work/quick-list', $param);
	break;

	case 'user/dropdown/masters/job-work-quick-list':
	$param['user_key']=USER_KEY;
        if(isset($_POST))
        {
            $param=array_merge($param,$_POST);
        }
	echo callSGWS('user/maintenance/masters/job-work/quick-list', $param);
	break;
	
	case 'user/dropdown/masters/work-order-status-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/work-order-status/qucik-list', $param);
	break;

	
	case 'user/dropdown/masters/work-order-status-list-approved-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/work-order-status/approved-quick-list', $param);
	break;

	
	case 'user/dropdown/masters/preventive-maintenance-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/preventive-maintenance/quick-list', $param);
	break;

	
	case 'user/dropdown/masters/miscellaneous/payment-modes-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/payment-modes/list', $param);
	break;

	
	case 'user/dispatch/commodity-types-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/dispatch/commodity-types/list', $param);
	break;
	
	case 'user/dropdown/locations/location-addresses-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/locations/addresses/list', $param);
	break;

	
	case 'user/dropdown/locations/location-addresses-quick-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/locations/addresses/list', $param);
	break;

	
	case 'user/dropdown/locations/location-addresses-detail-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/locations/addresses/details', $param);
	break;

	
	case 'user/dropdown/location-regions-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/location-regions/list', $param);
	break;

	
	case 'user/dropdown/location-zones-quick-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/location-zones/quick-list', $param);
	break;

	
	case 'user/dispatch/load-status-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/dispatch/load-status/list', $param);
    break;

	
	case 'user/dispatch/long-haul-assignment-status-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/dispatch/long-haul-assignment-status/list', $param);
	break;

	
	case 'user/dispatch/load-types-quick-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/dispatch/load-types/quick-list', $param);
	break;

	
	case 'user/quick-details/quick-driver-details-alllist':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/quick-details/quick-driver-details-alllist', $param);

	break;

	
	case 'user/dropdown/users/department-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/users/department/list', $param);
	break;

	
	case 'user/dropdown/users/designation-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/masters/users/designation/list', $param);
	break;

	
	case 'user/dropdown/masters/assets-type-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/asset-type/list', $param);
	break;

	
	case 'user/dropdown/masters/reasons-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/fault-reason/quick-list', $param);
	break;
	
	case 'user/dropdown/masters/corrective-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/corrective-action/quick-list', $param);
	break;

	
	case 'user/dropdown/masters/assets-type-list-trucks-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/asset-type-trucks/list', $param);
	break;

	
	case 'user/dropdown/masters/reasons-list-trucks-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/fault-reason-trucks/quick-list', $param);
	break;

	
	case 'user/dropdown/masters/corrective-list-trucks-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/corrective-action-trucks/quick-list', $param);
	break;

	
	case 'user/dropdown/masters/assets-type-list-trailers-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/asset-type-trailers/list', $param);
	break;

	
	case 'user/dropdown/masters/reasons-list-trailers-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/fault-reason-trailers/quick-list', $param);
	break;

	
	case 'user/dropdown/masters/corrective-list-trailers-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/corrective-action-trailers/quick-list', $param);
	break;

	
	case 'user/dropdown/masters/incident-documents-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/incident-documents/quick-list', $param);
	break;

	
	case 'user/dropdown/masters/claim-type-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/claim-type/quick-list', $param);
	break;

	
	case 'user/dropdown/masters/violation-reported-list-ajax':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/violation-reported/quick-list', $param);
	break;

	case 'user/dropdown/masters/violation-reported-quick-list':
	$param['user_key']=USER_KEY;
	if(isset($_POST)){
		$param=array_merge($param,$_POST);
	}
	echo callSGWS('user/maintenance/masters/violation-reported/quick-list', $param);
	break;

	default:
   //GT_default_page();
	break;


}