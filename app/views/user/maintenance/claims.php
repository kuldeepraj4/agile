<?php

require_once APPROOT . '/views/includes/user/header.php';

?>



<br><br>

<section class="list-200 content-box" style="margin: auto;max-width: 1400px">

    <h1 class="list-200-heading">Claim Entry</h1>

    <section class="list-200-top-section">
        <div>
        </div>
        <div>
        </div>
    </section>

    <section class="list-200-top-action">
        <div class="list-200-top-action-left">
            <!-- input used for sory by call-->
            <input type="hidden" id="sort_by" value="">
            <!-- //input used for sort by call-->
            <div class="filter-item">
                <label>Claim ID</label>
                <input type="text" data-filter="claim_id" onkeyup="show_list(this.value)">
            </div>
            <div class="filter-item">
                <label>Incident Date </label>
                <input type="text" data-filter="incident_date" data-date-picker onkeyup="show_list(this.value)">
            </div>
            <div class="filter-item">
                <label>Status</label>
                <select data-filter="status_id" onchange="show_list(this.value)">
                    <option>---SELECT---</option>
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                </select>
            </div>
            <div class="filter-item">
                <label>Report Date</label>
                <input type="text" data-filter="report_date" data-date-picker onkeyup="show_list(this.value)">
            </div>
            <div class="filter-item">
                <label>ClaimType</label>
                <select data-filter="claim_type_id" onchange="show_list()">
                </select>
            </div>
            <div class="filter-item">
                <label>Follow Up</label>
                <input type="text" data-filter="follow_up" onkeyup="show_list(this.value)">
            </div>
            <div class="filter-item">
                <label>Claimant</label>
                <input type="text" data-filter="claimant" onkeyup="show_list(this.value)">
            </div>
            <div class="filter-item">
                <label>Driver Terminal</label>
                <select data-filter="driver_terminal_id" onchange="show_list(this.value)">
                    <option>---SELECT---</option>
                    <option value="freon_logistics">Freon Logistics</option>
                    <option value="jaspreet_kaur">Jaspreet Kaur</option>
                    <option value="freon_trucking">Freon Trucking Inc</option>
                    <option value="ldh_xpress_inc">LDH Xpress Inc</option>
                    <option value="quad_trans_inc">Quad Trans Inc</option>
                    <option value="sigea_solutions">Sigea Solutions</option>
                </select>
            </div>
            <div class="filter-item">
                <label>Load ID</label>
                <input type="text" data-filter="load_id" onkeyup="show_list(this.value)">
            </div>
            <div class="filter-item">
                <label>Load Terminal</label>
                <select data-filter="load_terminal_id" onchange="show_list(this.value)">
                    <option>---SELECT---</option>
                    <option value="freon_logistics">Freon Logistics</option>
                    <option value="jaspreet_kaur">Jaspreet Kaur</option>
                    <option value="freon_trucking">Freon Trucking Inc</option>
                    <option value="ldh_xpress_inc">LDH Xpress Inc</option>
                    <option value="quad_trans_inc">Quad Trans Inc</option>
                    <option value="sigea_solutions">Sigea Solutions</option>
                </select>
            </div>
            <div class="filter-item">
                <label>Representative</label>
                <select data-filter="representative_id" onchange="show_list()">
                </select>
            </div>
            <div class="filter-item">
                <label>Customer</label>
                <select data-filter="customer_id" onchange="show_list()">
                </select>
            </div>
            <div class="filter-item">
                <label>State</label>
                <select data-filter="state_id" onchange="show_list()">
                </select>
            </div>
            <div class="filter-item">
                <label>Broker Carrier</label>
                <select data-filter="broker_carrier_id" onchange="show_list()">
                </select>
            </div>
            <div class="filter-item">
                <label>City</label>
                <select data-filter="city_id" onchange="show_list()">
                </select>
            </div>
            <div class="filter-item">
                <label>Driver</label>
                <select data-filter="driver_id" onchange="show_list()">
                </select>
            </div>
            <div class="filter-item">
                <label>DOT Reported</label>
                <select data-filter="dot_reported_id" onchange="show_list(this.value)">
                    <option>---SELECT---</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <div class="filter-item">
                <label>Truck</label>
                <select data-filter="truck_id" onchange="show_list()">
                </select>
            </div>

        </div>
    </section>

    <div class="table  table-a">
        <table>
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Claim ID</th>
                    <th>Claim no.</th>
                    <th>Claim status</th>
                    <th>Incident ID</th>
                    <th>Claim Type</th>
                    <th>Law suit</th>
                    <th>Internal Representative</th>
                    <th>Report Date</th>
                    <th>Close Date</th>
                    <th>Claim Reserve</th>
                    <th>Description of claim</th>
                    <th>Insurance company</th>
                    <th>Insurance policy no.</th>
                    <th>Insurance contact name</th>
                    <th>Insurance Address</th>
                    <th>Insurance state name</th>
                    <th>Insurance city name</th>
                    <th>Insurance ZIP Code</th>
                    <th>Insurance Phone no.</th>
                    <th>Insurance Fax no.</th>
                    <th>Insurance Email</th>
                    <th>Claimant Name</th>
                    <th>Claimant address</th>
                    <th>Claimant State Name</th>
                    <th>Claimant City name</th>
                    <th>Claimant ZIP Code</th>
                    <th>Claimant Phone No.</th>
                    <th>Claimant Fax no.</th>
                    <th>Claimant Email</th>
                    <th>Load No.</th>
                    <th>Driver Name</th>
                    <th>Truck Name</th>
                    <th>Trailer Name</th>
                    <th>Customer Name</th>
                    <th>Broker Carrier Name</th>
                    <th>Bodily Injury</th>
                    <th>CargoDamage</th>
                    <th>LossOfUse</th>
                    <th>LostWages</th>
                    <th>Medical</th>
                    <th>Others</th>
                    <th>Physical Damge</th>
                    <th>Property</th>
                    <th>Salvage</th>
                    <th>TowStorage</th>
                    <th>VehicleID</th>
                    <th>OODeductable</th>
                    <th>File Name</th>
                    <th>Doc Attached</th>
                </tr>
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
        </div>
<div data-pagination></div>
</section>



<script type="text/javascript">
    function show_list() {

        var sort_by = $('#sort_by').val();

        var claim_id = $('[data-filter="claim_id"]').val();

        var incident_date = $('[data-filter="incident_date"]').val();

        var status_id = $('[data-filter="status_id"]').val();

        var report_date = $('[data-filter="report_date"]').val();

        var claim_type_id = $('[data-filter="claim_type_id"]').val();

        var follow_up = $('[data-filter="follow_up"]').val();

        var claimant = $('[data-filter="claimant"]').val();

        var driver_terminal_id = $('[data-filter="driver_terminal_id"]').val();
        var load_id = $('[data-filter="load_id"]').val();
        var load_terminal_id = $('[data-filter="load_terminal_id"]').val();
        var representative_id = $('[data-filter="representative_id"]').val();
        var customer_id = $('[data-filter="customer_id"]').val();
        var state_id = $('[data-filter="state_id"]').val();
        var broker_carrier_id = $('[data-filter="broker_carrier_id"]').val();
        var city_id = $('[data-filter="city_id"]').val();
        var driver_id = $('[data-filter="driver_id"]').val();
        var dot_reported_id = $('[data-filter="dot_reported_id"]').val();
        var truck_id = $('[data-filter="truck_id"]').val();

        var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;

        var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;

         var webapi = "pagination";


        $.ajax({

                url: location.pathname + '-ajax',

                type: 'POST',

                data: {

                    sort_by: sort_by,
                    page: page_no,
                    batch: batch,
                    claim_id: claim_id,
                    incident_date: incident_date,
                    status_id: status_id,
                    report_date: report_date,
                    claim_type: claim_type,
                    follow_up: follow_up,
                    claimant: claimant,
                    driver_terminal_id: driver_terminal_id,
                    load_id: load_id,
                    load_terminal_id: load_terminal_id,
                    representative_id: representative_id,
                    customer_id: customer_id,
                    state_id: state_id,
                    broker_carrier_id: broker_carrier_id,
                    city_id: city_id,
                    driver_id: driver_id,
                    dot_reported_id: dot_reported_id,
                    truck_id: truck_id,
                    webapi:  webapi

                },

                success: function(data) {

                    if ((typeof data) == 'string') {

                        data = JSON.parse(data)

                        console.log(data)

                        $('#tabledata').html("");

                        if (data.status) {

                            var counter = 0;

                            $.each(data.response.list, function(index, item) {

                                counter++;

                                var row = `<tr>

             <td>${item.sr_no}</td>
             <td>${item.claim_id}</td>
             <td>${item.claim_no}</td>
             <td>${item.claim_status}</td>
             <td>${item.incident_id}</td>
             <td>${item.claim_type}</td>
             <td>${item.law_suit}</td>
             <td>${item.internal_representative}</td>
             <td>${item.report_date}</td>
             <td>${item.close_date}</td>
             <td>${item.claim_reserve}</td>
             <td>${item.description_of_claim}</td>
             <td>${item.insurance_company}</td>
             <td>${item.insurance_policy_no}</td>
             <td>${item.insurance_contact_name}</td>
             <td>${item.insurance_address}</td>
             <td>${item.insurance_state_name}</td>
             <td>${item.insurance_city_name}</td>
             <td>${item.insurance_zip_code}</td>
             <td>${item.insurance_phone_no}</td>
             <td>${item.insurance_fax_no}</td>
             <td>${item.insurance_email}</td>
             <td>${item.claimant_name}</td>
             <td>${item.claimant_address}</td>
             <td>${item.claimant_state_name}</td>
             <td>${item.claimant_city_name}</td>
             <td>${item.claimant_zip_code}</td>
             <td>${item.claimant_phone_no}</td>
             <td>${item.claimant_fax_no}</td>
             <td>${item.claimant_email}</td>
             <td>${item.load_no}</td>
             <td>${item.driver_name}</td>
             <td>${item.truck_name}</td>
             <td>${item.trailer_name}</td>
             <td>${item.customer_name}</td>
             <td>${item.broker_carrier_name}</td>
             <td>${item.bodily_injury}</td>
             <td>${item.cargodamage}</td>
             <td>${item.lossofuse}</td>
             <td>${item.lostwages}</td>
             <td>${item.medical}</td>
             <td>${item.others}</td>
             <td>${item.physical_damage}</td>
             <td>${item.property}</td>
             <td>${item.salvage}</td>
             <td>${item.towstorage}</td>
             <td>${item.vehicle_id}</td>
             <td>${item.oodeductable}</td>
             <td>${item.file_name}</td>
             <td>${item.doc_attached}</td>

             <td style="white-space:nowrap">`;



                                <?php if (in_array('P0010', USER_PRIV)) {

                                ?>

                                    row += `<button title="Edit" class="btn_grey_c"><a href="../user/maintenance/claim-entry/update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button>`;

                                <?php

                                }

                                if (in_array('P0021', USER_PRIV)) {

                                ?>

                                    row += `<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="${item.eid}"><i class="fa fa-trash"></i></button>`;

                                <?php

                                } ?>

                                row += `</td> 

           </tr>`;

                                $('#tabledata').append(row);

                            })
                            set_pagination({
    selector: '[data-pagination]',
    totalPages: data.response.totalPages,
    currentPage: data.response.currentPage,
    batch: data.response.batch
  })

                        } else {

                            var false_message = `<tr><td colspan="18">` + data.message + `<td></tr>`;

                            $('#tabledata').html(false_message);

                        }

                    }

                }

            }

        )

    }

    show_list()
</script>



<script type="text/javascript">
    function show_status_filter() {

        get_repairorderstatus().then(function(data) {

            // Run this when your request was successful

            if (data.status) {

                //Run this if response has list

                if (data.response.list) {

                    var options = "";

                    options += `<option value="">- - Select - -</option>`

                    $.each(data.response.list, function(index, item) {

                        options += `<option value="` + item.id + `">` + item.name + `</option>`;

                    })

                    $('[data-filter="status_id"]').html(options);

                }

            }

        }).catch(function(err) {

            // Run this when promise was rejected via reject()

        })

    }

    show_status_filter()
</script>



<script type="text/javascript">
    function show_class_filter() {

        get_repairorderclass().then(function(data) {

            // Run this when your request was successful

            if (data.status) {

                //Run this if response has list

                if (data.response.list) {

                    var options = "";

                    options += `<option value="">- - Select - -</option>`

                    $.each(data.response.list, function(index, item) {

                        options += `<option value="` + item.id + `">` + item.name + `</option>`;

                    })

                    $('[data-filter="class_id"]').html(options);

                }

            }

        }).catch(function(err) {

            // Run this when promise was rejected via reject()

        })

    }

    show_class_filter()
</script>



<script type="text/javascript">
    function show_type_filter(param) {

        get_repairordertype1(param).then(function(data) {

            // Run this when your request was successful

            if (data.status) {

                //Run this if response has list

                if (data.response.list) {

                    var options = "";

                    options += `<option value="">- - Select - -</option>`

                    $.each(data.response.list, function(index, item) {

                        options += `<option value="` + item.id + `">` + item.name + `</option>`;

                    })

                    $('[data-filter="type_id"]').html(options);

                }

            }

        }).catch(function(err) {

            // Run this when promise was rejected via reject()

        })

    }

    show_type_filter()
</script>



<script type="text/javascript">
    function show_drivers() {

        get_drivers().then(function(data) {

            // Run this when your request was successful

            if (data.status) {

                //Run this if response has list

                if (data.response.list) {

                    var options = "";

                    options += `<option value="">- - Select - -</option>`

                    $.each(data.response.list, function(index, item) {

                        options += `<option value="` + item.id + `">` + item.code + ' ' + item.name_first + `</option>`;

                    })

                    $('[data-filter="driver_id"]').html(options);

                }

            }

        }).catch(function(err) {

            // Run this when promise was rejected via reject()

        })

    }

    show_drivers()
</script>



<script type="text/javascript">
    function show_stage_filter(param) {

        get_repairorderstage(param).then(function(data) {

            // Run this when your request was successful

            if (data.status) {

                //Run this if response has list

                if (data.response.list) {

                    var options = "";

                    options += `<option value="">- - Select - -</option>`

                    $.each(data.response.list, function(index, item) {

                        options += `<option value="` + item.id + `">` + item.name + `</option>`;

                    })

                    $('[data-filter="stage_id"]').html(options);

                }

            }

        }).catch(function(err) {

            // Run this when promise was rejected via reject()

        })

    }

    show_stage_filter()
</script>



<script type="text/javascript">
    function show_unittype_filter() {

        get_vehicles().then(function(data) {

            // Run this when your request was successful

            if (data.status) {

                //Run this if response has list

                if (data.response.list) {

                    var options = "";

                    options += `<option value="">- - Select - -</option>`

                    $.each(data.response.list, function(index, item) {

                        options += `<option value="` + item.id + `">` + item.name + `</option>`;

                    })

                    $('[data-filter="unit_type_id"]').html(options);

                }

            }

        }).catch(function(err) {

            // Run this when promise was rejected via reject()

        })

    }

    show_unittype_filter()
</script>



<script type="text/javascript">
    function show_unit_filter(param) {

        if (param.unit_type_id == 1) {

            get_trucks().then(function(data) {

                // Run this when your request was successful

                if (data.status) {

                    //Run this if response has list

                    if (data.response.list) {

                        var options = "";

                        options += `<option value="">- - Select - -</option>`

                        $.each(data.response.list, function(index, item) {

                            options += `<option value="` + item.id + `">` + item.code + `</option>`;

                        })

                        $('[data-filter="unit_id"]').html(options);

                    }

                }

            }).catch(function(err) {

                // Run this when promise was rejected via reject()

            })

        } else if (param.unit_type_id == 2) {

            get_trailers().then(function(data) {

                //console.log(data)

                // Run this when your request was successful

                if (data.status) {

                    //Run this if response has list

                    if (data.response.list) {

                        var options = "";

                        options += `<option value="">- - Select - -</option>`

                        $.each(data.response.list, function(index, item) {

                            options += `<option value="` + item.id + `">` + item.code + `</option>`;

                        })

                        $('[data-filter="unit_id"]').html(options);

                    }

                }

            }).catch(function(err) {

                // Run this when promise was rejected via reject()

            })

        }

    }
</script>



<script type="text/javascript">
    function on_change_class(value) {

        show_list();

        //show_type_filter({class:value});

    }
</script>



<script type="text/javascript">
    function sort_table() {

        show_list()

    }
</script>



<?php

require_once APPROOT . '/views/includes/user/footer.php';

?>