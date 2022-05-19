<script type="text/javascript">
  //





  //   function set_params(key,value,replace=false){

  //           //----get url

  //           let primaryUrl = decodeURI(window.location.href.split('?')[0]);



  //           let paramObj =get_params();



  //           paramObj[key]=value;

  //           console.log(paramObj)





  //           var paramString = encodeURI(Object.keys(paramObj).map(key => key + '=' + paramObj[key]).join('&'));



  //           history.pushState(null, null, (primaryUrl+'?'+paramString))



  //       }

  // function get_params() {



  //           //----get url

  //           let urlString =window.location.href;



  //       //---split param part from url and decode from url to normal string

  //       let paramString = decodeURI(urlString.split('?')[1]);



  //       //---convert paramstring to paramObj

  //       let paramArray=paramString.split('&');



  //       paramObj={};

  //       for (let i = 0; i < paramArray.length; i++) {



  //           let pair = paramArray[i].split('=');

  //           paramObj[pair[0]]=pair[1]

  //       }

  //       return paramObj

  //   }

  function get_load_row_bg(status_id) {
    switch (status_id) {
      case 'ALLOCATED':
        row_bg_class = 'bg-mild-grey';
        break;
      case 'DISPATCHED':
        row_bg_class = 'bg-mild-yellow';
        break;

      case 'DELIVERED':
        row_bg_class = 'bg-mild-green';
        break;  
      case 'PICKED':
        row_bg_class = 'bg-mild-green';
        break;
      case 'LOADED':
        row_bg_class = 'bg-mild-green';
        break;
      case 'AT SITE':
        row_bg_class = 'bg-mild-blue';
        break;
      case 'BOUNCED':
        row_bg_class = 'bg-mild-red';
        break;
      case 'CANCELLED':
        row_bg_class = 'bg-mild-red';
        break;
      case 'TONU':
        row_bg_class = 'bg-cyan';
        break;
      case 'UNDER DECISION':
        row_bg_class = 'bg-light-red';
        break;
      default:
        row_bg_class = ''
        break
    }
    return row_bg_class;
  }








  function get_params() {

    //

    // Address of the current window

    address = window.location.search

    // Returns a URLSearchParams object instance

    parameterList = new URLSearchParams(address)



    // Storing every key value pair in the map

    let newParams = {};



    var newUrl = window.location.pathname;

    parameterList.forEach((value2, key2) => {

      newParams[key2] = value2

    })



    return newParams

  }

  function set_params(key, value, callBack, replace = false) {

    //----get url

    let primaryUrl = decodeURI(window.location.href.split('?')[0]);

    let paramObj = get_params();

    //console.log(paramObj)

    paramObj[key] = value;

    //console.log(paramObj)

    var paramString = encodeURI(Object.keys(paramObj).map(key => key + '=' + paramObj[key]).join('&'));

    history.replaceState(null, null, (primaryUrl + '?' + paramString))

  }

  function check_url_params(arg) {
    let url_params = get_params();
    if (url_params.hasOwnProperty('' + arg + '')) {
      return url_params[arg];
    } else {
      return $(`[data-filter="` + arg + `"]`).val();
    }
  }

  function get_from_url(arg) {
    let url_params = get_params();
    if (url_params.hasOwnProperty('' + arg + '')) {
      return url_params[arg];
    } else {
      return '';
    }
  }

  function show_table_data_loading(table_refrance) {
    let tds = $(table_refrance).children('thead').children('tr').children('th').length;
    $(table_refrance).children('tbody').html(`<tr><td style="font-size:1.5em;padding:15px;" colspan='${tds}'><i class='fa fa-spinner fa-spin'></i> Loading . . . . </td></tr>`);
  }

  function open_child_window(param) {
    if (param.hasOwnProperty('width') == false) {
      param.width = 1200;
    }
    if (param.hasOwnProperty('height') == false) {
      param.height = 1000;
    }
    if (param.hasOwnProperty('name') == false) {
      param.name = 'myNewWindow';
    }
    window.open(param.url, param.name, `width=${param.width}, height=${param.height},location=no`);
  }

  function date_format(date, newFormat = 'd-M') {
    var mydate = new Date(date);
    var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
      "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ][mydate.getMonth()];

    switch (newFormat) {
      case 'd-M':
        result = mydate.getDate() + '-' + month;
        break;

      default:
        result = mydate.getDate() + '-' + month;

    }
    return result
  }

  function copyToClipboard(text) {
    var sampleTextarea = document.createElement("textarea");
    document.body.appendChild(sampleTextarea);
    sampleTextarea.value = text; //save main text in it
    sampleTextarea.select(); //select textarea contenrs
    document.execCommand("copy");
    document.body.removeChild(sampleTextarea);
  }

  function open_quick_view_truck(truck_eid) {
    open_child_window({
      url: `user/quick-view/truck?eid=${truck_eid}`
    })
  }


  function open_quick_view_user(user_eid) {
    open_child_window({
      url: `user/quick-view/user?eid=${user_eid}`
    })
  }



  function open_quick_view_trailer(trailer_eid) {
    open_child_window({
      url: `user/quick-view/trailer?eid=${trailer_eid}`
    })
  }

  function open_quick_view_driver(driver_eid) {
    open_child_window({
      url: `user/quick-view/driver?eid=${driver_eid}`
    })
  }

  function open_quick_view_work_order(wo_eid) {
    open_child_window({
      url: `user/quick-view/wo?eid=${wo_eid}`
    })
  }

  function open_document(path) {
    open_child_window({
      url: path
    })
  }

  function open_notes(param) {
    if (param.hasOwnProperty('width') == false) {
      param.width = 500;
    }
    if (param.hasOwnProperty('height') == false) {
      param.height = 600;
    }
    if (param.hasOwnProperty('name') == false) {
      param.name = 'myNewWindow';
    }
    window.open(param.url, param.name, `width=${param.width}, height=${param.height},location=no`);
  }

  function get_list(url, param2) {
    param1 = {}
    let param = Object.assign(param1, param2);
    return new Promise(function(resolve, reject) {
      $.ajax({
        url: "<?php echo AJAXROOT; ?>" + url,
        data: param,
        type: 'POST',
        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          resolve(data)
        },
        error: function(err) {
          reject(err)
        }
      })
    });
  }

  function get_trucks(param2) {
    return get_list('user/dropdown/trucks-quick-list-ajax', param2)
  }

  function quick_list_trucks(param2) {
    return get_list('user/dropdown/trucks-quick-list-ajax', param2)
  }

  function quick_list_trailers(param2) {
    return get_list('user/dropdown/trailers/quick-list-ajax', param2)
  }

  function get_drivers(param2) {
    return get_list('user/dropdown/drivers-ajax', param2)
  }

  function get_countries(param2) {
    return get_list('user/dropdown/locations/countries-ajax', param2)
  }

  function get_states(param2) {
    return get_list('user/dropdown/locations/states-ajax', param2)
  }

  function get_cities(param2) {
    return get_list('user/dropdown/locations/cities-ajax', param2)
  }

  function get_zipcodes(param2) {
    return get_list('user/dropdown/locations/zipcodes-ajax', param2)
  }

  function get_mobile_country_codes(param2) {
    return get_list('user/dropdown/mobile-country-codes-list-ajax', param2)
  }

  function get_route_types(param2) {
    return get_list('user/dropdown/route-types-list-ajax', param2)
  }

  function get_vehicles(param2) {
    return get_list('user/dropdown/vehicles-quick-list', param2)
  }

  function get_vehicle_makers(param2) {
    return get_list('user/dropdown/vehicles/makers-ajax', param2)
  }

  function get_vehicle_models(param2) {
    return get_list('user/dropdown/vehicles/models-ajax', param2)
  }

  function get_vehicles_status(param2) {
    return get_list('user/dropdown/vehicles/status-list-ajax', param2)
  }

  function get_salary_parameters(param2) {
    return get_list('user/dropdown/employees/salary-parameters-ajax', param2)
  }

  function get_salary_parameter_types(param2) {
    return get_list('user/dropdown/employees/salary-parameters-types-ajax', param2)
  }

  function get_employees_status(param2) {
    return get_list('user/dropdown/employees/status-list-ajax', param2)
  }

  function get_employees_prefix(param2) {
    return get_list('user/dropdown/employees/prefix-list-ajax', param2)
  }

  function get_employees_residency(param2) {
    return get_list('user/dropdown/employees/residency-list-ajax', param2)
  }

  function get_vehicles_ownership_types(param2) {
    return get_list('user/dropdown/vehicles/ownership-types-list-ajax', param2)
  }

  function get_vehicles_colors(param2) {
    return get_list('user/dropdown/vehicles/colors-list-ajax', param2)
  }

  function get_companies(param2) {
    return get_list('user/dropdown/companies-list-ajax', param2)
  }

  function get_lease_companies(param2) {
    return get_list('user/dropdown/vehicles/lease-companies-list-ajax', param2)
  }

  function get_device_companies(param2) {
    return get_list('user/dropdown/vehicles/device-companies-list-ajax', param2)
  }

  function get_insurance_companies(param2) {
    return get_list('user/dropdown/vehicles/insurance-companies-list-ajax', param2)
  }

  function get_reefer_companies(param2) {
    return get_list('user/dropdown/trailers/reefer-companies-ajax', param2)
  }

  function get_driver_groups(param2) {
    return get_list('user/dropdown/drivers/groups-ajax', param2)
  }

  function quick_list_driver_types(param2) {
    return get_list('user/masters/drivers/types-ajax', param2)
  }

  function get_driver_ppm_plans(param2) {
    return get_list('user/dropdown/drivers/ppm-plans-ajax', param2)
  }

  function get_drivers_leave_reasons(param2) {
    return get_list('user/dropdown/drivers/driver-leave-reasons-ajax', param2)
  }

  function get_trip_stop_types(param2) {
    return get_list('user/dropdown/trip-stop-types-list-ajax', param2)
  }

  function get_roles_groups(param2) {
    return get_list('user/dropdown/users/roles-groups-ajax', param2)
  }
  /*
  function get_hierarchy_levels(param2){
    return get_list('user/dropdown/hierarchy/levels-ajax',param2)
  }*/
  function get_users(param2) {
    return get_list('user/dropdown/users-ajax', param2)
  }

  function quick_list_users(param2) {
    return get_list('user/dropdown/users/quick-list-ajax', param2)
  }

  function quick_list_hierarchy_levels(param2) {
    return get_list('user/dropdown/hierarchy/levels-ajax', param2)
  }

  function get_users(param2) {
    return get_list('user/dropdown/users-ajax', param2)
  }

  function get_trips_months_list(param2) {
    return get_list('user/dropdown/trips/months-list', param2)
  }

  function get_tickets_statges(param2) {
    return get_list('user/dropdown/tickets-stages/tickets-stages-ajax', param2)
  }

  function get_tickets_stages(param2) {
    return get_list('user/dropdown/tickets-stages/tickets-stages-ajax', param2)
  }

  function quick_list_trips(param2) {
    return get_list('user/dropdown/trips/quick-list', param2)
  }

  function quick_list_drivers(param2) {
    return get_list('user/dropdown/drivers-quick-list-ajax', param2)
  }

  function quick_list_driver_teams(param2) {
    return get_list('user/dropdown/driver-teams/quick-list-ajax', param2)
  }

  function get_ticket_priorities(param2) {
    return get_list('user/dropdown/ticket-priorities/list-ajax', param2)
  }



  //Add by gafoor (main list )
  function get_repair_order_class(param2) {
    return get_list('user/dropdown/masters/repair-order-class-list-ajax', param2)
  }

  function get_repair_order_stage(param2) {
      return get_list('user/dropdown/masters/repair-order-stage-list-ajax', param2)
    }

  function get_repair_order_type(param2) {
    return get_list('user/dropdown/masters/repair-order-type-list-ajax', param2)
  }


  function get_repair_order_class_list(param2) {
    return get_list('user/dropdown/masters/repair-order-class-list-ajax', param2)
  }

     function get_repair_order_rfc_error(param2) {
      return get_list('user/dropdown/masters/repair-order-rfc-error-quick-list-ajax', param2)
    }
    

    function get_repair_order_category(param2) {
      return get_list('user/dropdown/masters/repair-order-category-quick-list', param2)
    }

  function get_repair_order_status(param2) {
    return get_list('user/dropdown/masters/repair-order-status-list-ajax', param2)
  }

  function get_repair_order_category(param2) {
    return get_list('user/dropdown/masters/repair-order-category-quick-list', param2)
  }

  function get_repair_order_criticality_level(param2) {
    return get_list('user/dropdown/masters/repair-order-criticality-level-list-ajax', param2)
  }

  function get_maintenace_vendors(param2) {
    return get_list('user/dropdown/masters/vendor-quick-list', param2)
  }

  function get_maintenace_vendors_quick_list(param2) {
    return get_list('user/dropdown/masters/vendor-quick-list', param2)
  }

  function get_job_work_type(param2) {
    return get_list('user/dropdown/masters/job-work-type-list-ajax', param2)
  }

  function get_job_work(param2) {
    return get_list('user/dropdown/masters/job-work-quick-list', param2)
  }

  function get_quick_job_work(param2) {
    return get_list('user/dropdown/masters/job-work-quick-list', param2)
  }

  function get_drivermaster(param2) {
    return get_list('user/dropdown/drivers-ajax', param2)
  }

  function get_workordertype(param2) {
    return get_list('user/dropdown/masters/work-order-type-master-list-ajax', param2)
  }

  function get_workorder_status(param2) {
    return get_list('user/dropdown/masters/work-order-status-list-ajax', param2)
  }

  function get_workorder_status_approved(param2) {
    return get_list('user/dropdown/masters/work-order-status-list-approved-ajax', param2)
  }

  function get_preventive_maintenance(param2) {
    return get_list('user/dropdown/masters/preventive-maintenance-list-ajax', param2)
  }

  function get_preventive_maintenance_criticality(param2) {
    return get_list('user/dropdown/preventive-maintenance-criticality-ajax', param2)
  }


  function quick_list_payment_modes(param2) {
    return get_list('user/dropdown/masters/miscellaneous/payment-modes-ajax', param2)
  }
  //Added by gafoor

  function get_commodity_types(param2) {
    return get_list('user/dispatch/commodity-types-ajax', param2)
  }

  function get_location_addresses(param2) {
    return get_list('user/dropdown/locations/location-addresses-ajax', param2)
  }

  function quick_list_location_addresses(param2) {
    return get_list('user/dropdown/locations/location-addresses-quick-list-ajax', param2)
  }

  function get_location_address_details(param2) {
    return get_list('user/dropdown/locations/location-addresses-detail-ajax', param2)
  }

  function get_location_regions(param2) {
    return get_list('user/dropdown/location-regions-list-ajax', param2)
  }

  function get_location_zones_quick_list(param2) {
    return get_list('user/dropdown/location-zones-quick-list-ajax', param2)
  }

  function get_load_status(param2) {
    return get_list('user/dispatch/load-status-list-ajax', param2)
  }


   function get_load_tracking_status(param2) {
    return get_list('user/dispatch/load-tracking-status-quick-list-ajax', param2)
  }

  function get_long_haul_assignment_status(param2) {
    return get_list('user/dispatch/long-haul-assignment-status-list-ajax', param2)
  }

  function quick_load_types(param2) {
    return get_list('user/dispatch/load-types-quick-list-ajax', param2)
  }


  // all driver show for quick list

  function quick_all_list_drivers(param2) {
    return get_list('user/quick-details/quick-driver-details-alllist', param2)
  }

  // department show for quick list  





  function get_department(param2) {
    return get_list('user/dropdown/users/department-ajax', param2)
  }

  function get_designation(param2) {
    return get_list('user/dropdown/users/designation-ajax', param2)
  }


function get_assets_type(param2) {
  return get_list('user/dropdown/masters/assets-type-list-ajax', param2)
}
function get_reasons_list(param2) {
  return get_list('user/dropdown/masters/reasons-list-ajax', param2)
}  
function get_corrective_list(param2) {
  return get_list('user/dropdown/masters/corrective-list-ajax', param2)
}  

function get_assets_type_trucks(param2) {
  return get_list('user/dropdown/masters/assets-type-list-trucks-ajax', param2)
}
function get_reasons_list_trucks(param2) {
  return get_list('user/dropdown/masters/reasons-list-trucks-ajax', param2)
} 

function get_corrective_list_trucks(param2) {
  return get_list('user/dropdown/masters/corrective-list-trucks-ajax', param2)
} 

function get_assets_type_trailers(param2) {
  return get_list('user/dropdown/masters/assets-type-list-trailers-ajax', param2)
}

function get_reasons_list_trailers(param2) {
  return get_list('user/dropdown/masters/reasons-list-trailers-ajax', param2)
} 

function get_corrective_list_trailers(param2) {
  return get_list('user/dropdown/masters/corrective-list-trailers-ajax', param2)
} 

function get_incident_documents_list(param2) {
  return get_list('user/dropdown/masters/incident-documents-list-ajax', param2)
}
function get_claim_type_list(param2) {
  return get_list('user/dropdown/masters/claim-type-list-ajax', param2)
}
function get_violation_reported_list(param2) {
  return get_list('user/dropdown/masters/violation-reported-list-ajax', param2)
}

function get_violation_reported_quick_list(param2) {
  return get_list('user/dropdown/masters/violation-reported-quick-list', param2)
}

function get_old_location_addresses(param2){
  return get_list('user/masters/locations/old-location-addresses-ajax',param2)
}

function get_dispatch_load_cancellation_reason(param2) {
  return get_list('user/masters/dispatch/load-cancellation-reasons/quick-list-ajax', param2)
}

function get_dispatch_load_billing_accessories(param2) {
  return get_list('user/dispatch/masters/bill-accessories/quick-list-ajax', param2)
}
function get_dispatch_load_earning_losses_types(param2) {
  return get_list('user/dispatch/masters/load-earning-losses-types/quick-list-ajax', param2)
}
function get_maintenace_yard(param2) {
  return get_list('user/maintenance/masters/yard-maintenance-list-ajax', param2)
}

function get_asset_current_status_truck(param2) {
  return get_list('user/masters/dispatch/asset-current-status/truck-quick-list-ajax', param2)
}

function get_asset_current_status_trailer(param2) {
  return get_list('user/masters/dispatch/asset-current-status/trailer-quick-list-ajax', param2)
}

function get_asset_current_status_driver(param2) {
  return get_list('user/masters/dispatch/asset-current-status/driver-quick-list-ajax', param2)
}

function get_yards_quick_list(param2) {
  return get_list('user/masters/yards/quick-list-ajax', param2)
}






function get_items_list(param2) {
  return get_list('user/inventory/masters/items-list-ajax', param2)
}
function get_product_makers(param2) {
  return get_list('user/inventory/masters/product-maker-list-ajax', param2)
}
function get_product_locations(param2) {
  return get_list('user/inventory/masters/locations-list-ajax', param2)
}
function get_product_names(param2) {
  return get_list('user/inventory/masters/products-list-ajax', param2)
}
function get_product_vendors(param2) {
  return get_list('user/inventory/masters/vendors-list-ajax', param2)
}
function get_unit_of_measurement(param2) {
  return get_list('user/inventory/masters/uom-list-ajax', param2)
}
function get_product_type(param2) {
  return get_list('user/inventory/masters/product-type-list-ajax', param2)
}
function get_storage_types(param2) {
  return get_list('user/inventory/masters/storage-type-list-ajax', param2)
}
function get_product_models(param2) {
  return get_list('user/inventory/masters/product-models-list-ajax', param2)
}
function get_storage_names(param2) {
  return get_list('user/inventory/masters/storage-list-ajax', param2)
}
function get_shipment_preferences(param2) {
  return get_list('user/inventory/masters/shipment-preference-list-ajax', param2)
}
function get_payment_terms(param2) {
  return get_list('user/inventory/masters/payment-term-list-ajax', param2)
}


function quick_list_customers(param2) {
         param1={}
    let param = Object.assign(param1, param2);
    return new Promise(function(resolve, reject) {
      var url = "<?php echo AJAXROOT; ?>" + 'user/dispatch/customers-quick-list-ajax';
      $.ajax({
        url: url,
        data: param,
        type: 'POST',
        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          resolve(data)
        },
        error: function(err) {
          reject(err)
        }
      })

    });
  }
</script>