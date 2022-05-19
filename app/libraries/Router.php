<?php
  /*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
  class Router {
    public function __construct(){
      $uri = $this->getUri();

      $routes= array(
        '/^login/i' => 'home/login',
        '/^logout/i' => 'home/logout',
        '/^driver-salary-slips-list/i' => 'general/driver-salary-slips-list',
        '/^driver-salary-slip/i' => 'general/driver-salary-slip',
        '/^user\/home/i' => 'user/index',
        '/^user\/masters\/dashboard$/i' => 'user/masters/dashboard',
        '/^user\/masters\/vehicles\/makers/i' => 'user/masters/vehicle/makers',
        '/^user\/masters\/mobile-country-codes/i' => 'user/masters/general/mobile-country-codes',
        '/^user\/masters\/route-types/i' => 'user/masters/general/route-types',
        '/^user\/masters\/yards/i' => 'user/masters/general/yards',
        '/^user\/masters\/employees\/salary-parameters/i' => 'user/masters/employees/salary-parameters',
        '/^user\/masters\/employees\/status/i' => 'user/masters/employees/status',
        '/^user\/masters\/employees\/prefix/i' => 'user/masters/employees/prefix',
        '/^user\/masters\/employees\/residency/i' => 'user/masters/employees/residency',
        '/^user\/masters\/vehicles\/models/i' => 'user/masters/vehicle/models',
        '/^user\/masters\/vehicles\/status/i' => 'user/masters/vehicle/status',
        '/^user\/masters\/vehicles\/ownership-types/i' => 'user/masters/vehicle/ownership-types',
        '/^user\/masters\/vehicles\/colors/i' => 'user/masters/vehicle/colors',
        '/^user\/masters\/vehicles\/lease-companies/i' => 'user/masters/vehicle/lease-companies',
        '/^user\/masters\/vehicles\/device-companies/i' => 'user/masters/vehicle/device-companies',
        '/^user\/masters\/vehicles\/insurance-companies/i' => 'user/masters/vehicle/insurance-companies',
        '/^user\/masters\/vehicles/i' => 'user/masters/vehicle/vehicles',
        '/^user\/masters\/locations\/countries/i' => 'user/masters/locations/countries',
        '/^user\/masters\/locations\/states/i' => 'user/masters/locations/states',
        '/^user\/masters\/locations\/cities/i' => 'user/masters/locations/cities',
        '/^user\/masters\/locations\/zipcodes/i' => 'user/masters/locations/zipcodes',
        '/^user\/masters\/locations\/location-addresses/i' => 'user/masters/locations/location-addresses',
        '/^user\/masters\/locations\/old-location-addresses/i' => 'user/masters/locations/location-addresses',
        '/^user\/masters\/locations\/stopoff/i' => 'user/masters/locations/stopoff',
        '/^user\/masters\/location-regions/i' => 'user/masters/locations/regions',
        '/^user\/masters\/location-zones/i' => 'user/masters/locations/zones',
        '/^user\/masters\/trucks-conditions/i' => 'user/masters/trucks/trucks-conditions',
        '/^user\/masters\/trucks\/document-types/i' => 'user/masters/trucks/document-types',
        '/^user\/masters\/trucks/i' => 'user/masters/trucks/trucks',
        '/^user\/masters\/trailers\/reefer-companies/i' => 'user/masters/trailers/reefer-companies',
        '/^user\/masters\/trailers\/document-types/i' => 'user/masters/trailers/document-types',
        '/^user\/masters\/trailers/i' => 'user/masters/trailers/trailers',
        '/^user\/masters\/companies/i' => 'user/masters/companies/companies',
        '/^user\/safety\/dashboard$/i' => 'user/safety/dashboard',
        '/^user\/dashboard$/i' => 'user/dashboard',
        '/^user\/masters\/drivers\/checklist\/categories/i' => 'user/masters/drivers/checklist-categories',
        '/^user\/masters\/drivers\/ppm-plans/i' => 'user/masters/drivers/ppm-plans',
        '/^user\/masters\/drivers\/groups/i' => 'user/masters/drivers/groups',
        '/^user\/masters\/driver-teams/i' => 'user/masters/drivers/teams',
        '/^user\/masters\/drivers\/types/i' => 'user/masters/drivers/types',
        '/^user\/masters\/drivers\/document-types/i' => 'user/masters/drivers/document-types',
        '/^user\/masters\/drivers/i' => 'user/masters/drivers/drivers',
        '/^user\/masters\/dispatch\/asset-current-status/i' => 'user/masters/dispatch/asset-current-status',
        '/^user\/masters\/dispatch/i' => 'user/masters/dispatch/load-cancellation-reasons',
        '/^user\/accounts\/dashboard/i' => 'user/accounts/dashboard',
        '/^user\/accounts\/trip-stop-types/i' => 'user/accounts/trips/trip-stop-types',
        '/^user\/accounts\/trips/i' => 'user/accounts/trips/trips',
        '/^user\/accounts\/drivers-payments/i' => 'user/accounts/drivers/payments',
        '/^user\/accounts\/billing/i' => 'user/accounts/billing/billing',
        
        '/^user\/accounts\/vendors-payments/i' => 'user/accounts/vendors/vendor-payments',
         '/^user\/accounts\/assets-management/i' => 'user/accounts/assets-management',

        '/^user\/settings\/dashboard/i' => 'user/settings/dashboard',
        '/^user\/settings\/profile/i' => 'user/settings/profile',
        '/^user\/masters\/users\/roles-groups/i' => 'user/masters/users/roles-groups',
        '/^user\/masters\/users\/department/i' => 'user/masters/users/department',
        '/^user\/masters\/users\/designation/i' => 'user/masters/users/designation',
        '/^user\/masters\/users/i' => 'user/masters/users/users',
        '/^user\/masters\/hierarchy\/levels/i' => 'user/masters/hierarchy/levels',
        '/^user\/masters\/miscellaneous\/priorities/i' => 'user/masters/miscellaneous/priorities',
        '/^user\/masters\/miscellaneous\/payment-modes/i' => 'user/masters/miscellaneous/payment-modes',
        '/^user\/miscellaneous\/notes/i' => 'user/miscellaneous/notes',
        '/^user\/quick-view/i' => 'user/quick-view/quick-view',
        '/^user\/dropdown/i' => 'user/dropdown/dropdown-list',

        '/^user\/quick-details\/quick-search/i' => 'user/quick-details/quick-search',
        '/^user\/quick-details\/quick-driver-details/i' => 'user/quick-details/quick-driver-details',
        '/^user\/quick-details\/quick-truck-details/i' => 'user/quick-details/quick-truck-details',
        '/^user\/quick-details\/quick-trailer-details/i' => 'user/quick-details/quick-trailer-details',
        '/^user\/quick-details\/quick-trip-details/i' => 'user/quick-details/quick-trip-details',
        '/^user\/quick-details\/quick-history-details/i' => 'user/quick-details/quick-history-details',


        '/^user\/task-management\/dashboard/i' => 'user/task-management/dashboard',
        '/^user\/task-management\/tickets-stages/i' => 'user/task-management/tickets-stages',
        '/^user\/task-management\/ticket-priorities/i' => 'user/task-management/ticket-priorities',
        '/^user\/task-management\/ticket-notifications/i' => 'user/task-management/ticket-notifications',
        '/^user\/task-management\/tickets/i' => 'user/task-management/tickets',
        '/^user\/safety\/dashboard/i' => 'user/safety/dashboard',
       


        '/^user\/maintenance\/dashboard/i' => 'user/maintenance/dashboard',
        '/^user\/maintenance\/dashboard$/i' => 'user/maintenance/dashboard',
        '/^user\/maintenance\/masters\/repair-order-class/i' => 'user/maintenance/masters/repair-order-class',
        '/^user\/maintenance\/masters\/repair-order-type/i' => 'user/maintenance/masters/repair-order-type',
        '/^user\/maintenance\/masters\/repair-order-stage/i' => 'user/maintenance/masters/repair-order-stage',
        '/^user\/maintenance\/masters\/repair-order-status/i' => 'user/maintenance/masters/repair-order-status',
        '/^user\/maintenance\/masters\/repair-order-rfc-error/i' => 'user/maintenance/masters/repair-order-rfc-error',

        '/^user\/maintenance\/masters\/work-order-status/i' => 'user/maintenance/masters/work-order-status',

        '/^user\/maintenance\/masters\/repair-order-category/i' => 'user/maintenance/masters/repair-order-category',
        '/^user\/maintenance\/masters\/repair-order-criticality-level/i' => 'user/maintenance/masters/repair-order-criticality-level',
        '/^user\/maintenance\/masters\/vendor/i' => 'user/maintenance/masters/vendor',
        '/^user\/maintenance\/masters\/job-work-type/i' => 'user/maintenance/masters/job-work-type',
        '/^user\/maintenance\/masters\/job-work/i' => 'user/maintenance/masters/job-work',
        '/^user\/maintenance\/masters\/preventive-maintenance/i' => 'user/maintenance/masters/preventive-maintenance',

        '/^user\/maintenance\/maintenance-dashboard-schedule/i' => 'user/maintenance/maintenance-dashboard-schedule',
        '/^user\/maintenance\/maintenance-dashboard-unschedule/i' => 'user/maintenance/maintenance-dashboard-unschedule',
        '/^user\/maintenance\/maintenance-dashboard/i' => 'user/maintenance/maintenance-dashboard',
        
        '/^user\/maintenance\/repair-orders/i' => 'user/maintenance/repair-orders',
        '/^user\/maintenance\/preventive-maintenance/i' => 'user/maintenance/preventive-maintenance',
        '/^user\/maintenance\/repair-order-followup/i' => 'user/maintenance/repair-order-followup',    
        '/^user\/maintenance\/work-orders/i' => 'user/maintenance/work-orders',
        //'/^user\/maintenance\/preventive-maintenance-list-trailer/i' => 'user/maintenance/preventive-maintenance-list-trailer',
        //'/^user\/maintenance\/preventive-maintenance-list-truck/i' => 'user/maintenance/preventive-maintenance-list-truck',

        '/^user\/maintenance\/incidents/i' => 'user/maintenance/incidents',
        '/^user\/maintenance\/claims/i' => 'user/maintenance/claims',
        '/^user\/maintenance\/inspection-sheet/i' => 'user/maintenance/inspection-sheet',


        '/^user\/dispatch\/dashboard/i' => 'user/dispatch/dashboard',
       '/^user\/dispatch\/masters\/bill-accessories/i' => 'user/dispatch/masters/bill-accessories',
        '/^user\/dispatch\/masters\/load-earning-losses-types/i' => 'user/dispatch/masters/load-earning-losses-types',

        '/^user\/dispatch\/customers/i' => 'user/dispatch/customers/customers',

        '/^user\/dispatch\/express-loads/i' => 'user/dispatch/loads/express-loads',

        '/^user\/dispatch\/loads/i' => 'user/dispatch/loads/loads',
        
        '/^user\/dispatch\/load-status/i' => 'user/dispatch/masters/load-status',
        '/^user\/dispatch\/load-types/i' => 'user/dispatch/masters/load-types',
        '/^user\/dispatch\/load-tracking-status/i' => 'user/dispatch/masters/load-tracking-status',
        '/^user\/dispatch\/long-haul-assignment-status/i' => 'user/dispatch/masters/long-haul-assignment-status',
        '/^user\/dispatch\/lh-assignment/i' => 'user/dispatch/lh-assignment',
        '/^user\/dispatch\/commodity-types/i' => 'user/dispatch/masters/commodity-types',
        '/^user\/dispatch\/notes/i' => 'user/dispatch/notes',
        '/^user\/dispatch\/long-haul-assignments/i' => 'user/dispatch/long-haul-assignments',
       '/^user\/dispatch\/sales/i' => 'user/dispatch/sales',
        '/^user\/dispatch\/trucks-planning/i' => 'user/dispatch/trucks-planning',
        '/^user\/dispatch\/trailers-planning/i' => 'user/dispatch/trailers-planning',
        '/^user\/dispatch\/pick-ups/i' => 'user/dispatch/pick-ups',
        '/^user\/dispatch\/quality/i' => 'user/dispatch/quality',
        
        '/^user\/dispatch\/reporting/i' => 'user/dispatch/reporting',
        '/^user\/dispatch\/tracking/i' => 'user/dispatch/tracking',
        '/^user\/dispatch\/west-delivery-assignment/i' => 'user/dispatch/west-delivery-assignment',
        '/^user\/dispatch\/cross-docks/i' => 'user/dispatch/cross-docks',

        '/^user\/maintenance\/masters\/assets-type-list-ajax/i' => 'user/maintenance/masters/inspection-assets-reason',
        '/^user\/maintenance\/masters\/reasons-list-ajax/i' => 'user/maintenance/masters/inspection-assets-reason',
        '/^user\/maintenance\/masters\/corrective-list-ajax/i' => 'user/maintenance/masters/inspection-assets-reason',
        
        '/^user\/maintenance\/masters\/assets-type-list-trucks-ajax/i' => 'user/maintenance/masters/inspection-assets-reason',
        '/^user\/maintenance\/masters\/reasons-list-trucks-ajax/i' => 'user/maintenance/masters/inspection-assets-reason',
        '/^user\/maintenance\/masters\/corrective-list-trucks-ajax/i' => 'user/maintenance/masters/inspection-assets-reason',

        '/^user\/maintenance\/masters\/assets-type-list-trailers-ajax/i' => 'user/maintenance/masters/inspection-assets-reason',
        '/^user\/maintenance\/masters\/reasons-list-trailers-ajax/i' => 'user/maintenance/masters/inspection-assets-reason',
        '/^user\/maintenance\/masters\/corrective-list-trailers-ajax/i' => 'user/maintenance/masters/inspection-assets-reason',


        '/^user\/maintenance\/masters\/fault-reason-trucks/i' => 'user/maintenance/masters/fault-reason-trucks',
        '/^user\/maintenance\/masters\/fault-reason-trailers/i' => 'user/maintenance/masters/fault-reason-trailers',
        '/^user\/maintenance\/masters\/fault-reason/i' => 'user/maintenance/masters/fault-reason',

        '/^user\/maintenance\/masters\/corrective-action-trucks/i' => 'user/maintenance/masters/corrective-action-trucks',
        '/^user\/maintenance\/masters\/corrective-action-trailers/i' => 'user/maintenance/masters/corrective-action-trailers',
        '/^user\/maintenance\/masters\/corrective-action/i' => 'user/maintenance/masters/corrective-action',

        '/^user\/maintenance\/masters\/incident-documents/i' => 'user/maintenance/masters/incident-documents',

        '/^user\/maintenance\/masters\/claim-type/i' => 'user/maintenance/masters/claim-type',
        '/^user\/maintenance\/masters\/violation-reported/i' => 'user/maintenance/masters/violation-reported',

        '/^user\/maintenance\/masters\/yard-maintenance/i' => 'user/maintenance/masters/yard-maintenance',

        '/^user\/inventory\/dashboard/i' => 'user/inventory/dashboard',
        '/^user\/inventory\/masters\/items/i' => 'user/inventory/masters/items',
        '/^user\/inventory\/masters\/products/i' => 'user/inventory/masters/products',
        '/^user\/inventory\/masters\/product-maker/i' => 'user/inventory/masters/product-maker',
        '/^user\/inventory\/masters\/locations/i' => 'user/inventory/masters/locations',
        '/^user\/inventory\/masters\/uom/i' => 'user/inventory/masters/uom',
        '/^user\/inventory\/masters\/product-type/i' => 'user/inventory/masters/product-type',
        '/^user\/inventory\/masters\/storage-type/i' => 'user/inventory/masters/storage-type',
        '/^user\/inventory\/masters\/storage/i' => 'user/inventory/masters/storage',
        '/^user\/inventory\/masters\/payment-term/i' => 'user/inventory/masters/payment-term',
        '/^user\/inventory\/masters\/shipment-preference/i' => 'user/inventory/masters/shipment-preference',
        '/^user\/inventory\/masters\/product-model/i' => 'user/inventory/masters/product-model',
        '/^user\/inventory\/purchase-orders/i' => 'user/inventory/purchase-orders',
        '/^user\/inventory\/issue-items/i' => 'user/inventory/issue-items',
        '/^user\/inventory\/return-items/i' => 'user/inventory/return-items',
        '/^user\/inventory\/inventory-items/i' => 'user/inventory/inventory-items',
        '/^user\/inventory\/receipts/i' => 'user/inventory/receipts',
      
        '/^error/'=> 'error-page'
      );

      $has_matching_controller=false;
      
      foreach ($routes as $key => $value) {

        if(preg_match($key, $uri)){
          $has_matching_controller=true;
            //--check if the requesed controller exists
          if(file_exists('../app/controllers/'.$value.'.php')){

              //--if the requested controller is login or logout
            if(preg_match('/^login/i', $uri) || preg_match('/^logout/i', $uri)){

              require_once '../app/controllers/'.$value. '.php';
              
            }elseif(preg_match('/^user\/+/i', $uri)){
              if(isset($_SESSION['userKey']) && isset($_SESSION['userPriv'])){
                define('USER_KEY',$_SESSION['userKey'] );
                define('USER_PRIV',$_SESSION['userPriv']);
                require_once '../app/controllers/'.$value. '.php';
              }else{
                GT_login_page();
              }
            }else{
              require_once '../app/controllers/'.$value. '.php';
              //GT_default_page();
            }



          }else{
            echo "file not exists";
          }
          break;
          exit();
        }
      }
      if(!$has_matching_controller){
       echo "Inavlid page request";
     }





   }
   public function getUrl(){
    if(isset($_GET['url'])){
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }
  public function getUri(){

    if(isset($_GET['url'])){
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      return $url;
    }else{
      GT_login_page();
    }
  } 


}


