<?php

require_once APPROOT . '/views/includes/user/header.php';

?>



<br><br>

<section class="lg-form-outer">

    <div class="lg-form-header">ADD NEW - INSPECTION</div>

    <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">



        <section class="section-111">

            <div>

                <fieldset>
                    <legend>Inspection sheet Entry</legend>
                    <div class="field-section single-column">

                        <div class="field-p">

                            <label>Inspection ID</label>

                            <input name="inspection_id" type="text" required>

                        </div>
                        <div class="field-p">

                            <label>Inspection No.</label>

                            <input name="inspection_no" type="text" required>

                        </div>
                        <div class="field-p">
                            <label>Inspection Date</label>
                            <input name="inspection_date" data-date-picker type="text" required>
                        </div>
                        <div class="field-p">
                            <label>From Time (HH:MM)</label>
                            <span><input size="2" placeholder="HH" name="from_time_hh" type="text" required><input size="2" placeholder="MM" name="from_time_mm" type="text" required>
                                <select data-filter="from_time_am_pm" onchange="show_list(this.value)">
                                    <option>-select-</option>
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select></span>
                        </div>
                        <div class="field-p">
                            <label>To Time (HH:MM)</label>
                            <span><input size="2" placeholder="HH" name="to_time_hh" type="text" required><input size="2" placeholder="MM" name="to_time_mm" type="text" required>
                                <select data-filter="to_time_am_pm" onchange="show_list(this.value)">
                                    <option>-select-</option>
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select></span>
                        </div>
                        <div class="field-p">
                            <label>Status</label>
                            <select data-filter="status_id" onchange="show_list(this.value)">
                                <option>-select-</option>
                                <option value="open">Open</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>
                        <div class="field-p">

                            <label>Reference No.</label>

                            <input name="reference_no" type="text" required>

                        </div>
                        <div class="field-p">
                            <label>Driver Name</label>
                            <select data-filter="driver_id" onchange="show_list()">
                            </select>
                        </div>
                        <div class="field-p">
                            <label>Co-Driver ID</label>
                            <select data-filter="co_driver_id" onchange="show_list()">
                            </select>
                        </div>
                        <div class="field-p">
                            <label>Truck ID</label>
                            <select data-filter="truck_id" onchange="show_list()">
                            </select>
                        </div>
                        <div class="field-p">
                            <label>Trailer ID</label>
                            <select data-filter="trailer_id" onchange="show_list()">
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>



            <div>
                <fieldset>
                    <legend>Inspection sheet entry</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Company</label>
                            <select data-filter="company_id" onchange="show_list(this.value)">

                            </select>
                        </div>
                        <div class="field-p">

                            <label>Location</label>

                            <input name="location" type="text" required>

                        </div>
                        <div class="field-p">
                            <label>Violation Reported</label>
                            <select data-filter="violation_reported_id" onchange="show_list(this.value)">
                                <option>--select--</option>
                                <option value="good_inspection">Good Inspection</option>
                                <option value="fined">Fined</option>
                                <option value="violation">Violation</option>
                                <option value="warning">Warning</option>
                                <option value="quad_trans_inc">Scale Ticket</option>
                                <option value="out_of_service">Out Of Service</option>
                            </select>
                        </div>
                        <div class="field-p">

                            <label>Fined Amount</label>

                            <input name="fined_amount" type="text" required>

                        </div>
                        <div class="field-p">

                            <label>Bond</label>

                            <input name="bond" type="text" required>

                        </div>
                        <div class="field-p">

                            <label>Contact No.</label>

                            <input name="contact_no" type="text" required>

                        </div>
                        <div class="field-p">

                            <label>Remarks</label>

                            <input name="remarks" type="text" required>

                        </div>
                        <div class="field-p">

                            <label>CDL No./Expiry</label>

                            <input name="cdl_no_expiry" type="text" required>

                        </div>
                        <div class="field-p">

                            <label>VIN No.</label>

                            <input name="vin_no" type="text" required>

                        </div>
                        <div class="field-p">

                            <label>Citation Category</label>
                            <ul>
                                <li>Overspeed<input type="checkbox" data-filter="overspeed" value="overspeed"></li>
                                <li>Lane Restriction<input type="checkbox" data-filter="lane_restriction" value="lane_restriction"></li>
                                <li>Following too close<input type="checkbox" data-filter="following_too_close" value="following_too_close"></li>
                            </ul>
                        </div>
                    </div>
                </fieldset>
            </div>
        </section>


        <section class="section-1" style="width:100%">
            <div>
                <fieldset>
                    <legend>Reason, Remarks & Corrective Action</legend>
                    <h3 style="text-align: center;background-color:azure">Driver</h3>
                    <div class="field-section table-rows">
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Asset Type</th>
                                    <th>Reason</th>
                                    <th>Remarks</th>
                                    <th>Corrective action</th>
                                </tr>
                            </thead>
                            <tbody id="issue_table">
                                <tr id="issue_row1" data-stop-row>
                                    <td>1</td>
                                    <td><select data-filter="asset_type_id" onchange="show_list(this.value)">
                                            <option>--select--</option>
                                            <option value="driver">Driver</option>
                                            <option value="truck">Truck</option>
                                            <option value="trailer">Trailer</option>
                                        </select></td>
                                    <td><select data-filter="reason_id" onchange="show_list(this.value)">
                                            <option>--select--</option>
                                            <option value="driver_docs">Driver Docs</option>
                                            <option value="unit_1_maintenance">Unit 1 maintenance</option>
                                            <option value="driver_fault">Driver fault</option>
                                            <option value="driver_hos">Driver HOS</option>
                                            <option value="unit_2_maintenance">Unit 2 Maintenance</option>
                                            <option value="overspeed">Overspeed</option>
                                            <option value="lane_restriction">Lane Restriction</option>
                                            <option value="following_too_close">Following too close</option>
                                        </select></td>
                                    <td><input type="text" class="w-800" name="remarks" required></td>
                                    <td><select data-filter="corrective_action_id" onchange="show_list(this.value)">
                                            <option>--select--</option>
                                            <option value="driver">Warning Letter</option>
                                            <option value="truck">Verbal Warning</option>
                                        </select></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8"><button type="button" class="btn_blue" onclick="add_stop()">Add Row</button></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>
            </div>
        </section>



        <section class="action-button-box">

            <button type="submit" class="btn_green">Save</button>

        </section>



    </form>

</section>



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

                    $('[name="order_class_id"]').html(options);

                }

            }

        }).catch(function(err) {

            // Run this when promise was rejected via reject()

        })

    }

    show_class_filter()
</script>
<script type="text/javascript">
    get_drivers().then(function(data) {

        // Run this when your request was successful

        if (data.status) {

            //Run this if response has list

            if (data.response.list) {

                var options = "";

                options += `<option value="">- - Select - -</option>`

                $.each(data.response.list, function(index, item) {
                    // console.log(item)

                    options += `<option value="` + item.id + `">` + item.code + ' ' + item.name_first + `</option>`;

                })

                $('[data-filter="driver_id"]').html(options);

            }

        }

    })
</script>
<script type="text/javascript">
    get_companies().then(function(data) {

        // Run this when your request was successful

        if (data.status) {

            //Run this if response has list

            if (data.response.list) {

                var options = "";

                options += `<option value="">- - Select - -</option>`

                $.each(data.response.list, function(index, item) {
                    //console.log(item)
                    options += `<option value="` + item.name + `">` + item.name + `</option>`;

                })

                $('[data-filter="company_id"]').html(options);

            }

        }

    })
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

                    $('[name="order_status_id"]').html(options);

                }

            }

        }).catch(function(err) {

            // Run this when promise was rejected via reject()

        })

    }

    show_status_filter()
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

                    $('[name="order_type_id"]').html(options);

                }

            }

        }).catch(function(err) {

            // Run this when promise was rejected via reject()

        })

    }

    show_type_filter()
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

                    $('[name="order_stage_id"]').html(options);

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
    var counter = 1

    var $issue_table = $('#issue_table');



    function add_stop() {

        ++counter;

        var $add_rowissue = `<tr id="issue_row${counter}"  data-stop-row>

    <td>${counter}</td>
    <td><select data-filter="asset_type_id" onchange="show_list(this.value)">
                                            <option>--select--</option>
                                            <option value="driver">Driver</option>
                                            <option value="truck">Truck</option>
                                            <option value="trailer">Trailer</option>
                                        </select></td>
                                    <td><select data-filter="reason_id" onchange="show_list(this.value)">
                                            <option>--select--</option>
                                            <option value="driver_docs">Driver Docs</option>
                                            <option value="unit_1_maintenance">Unit 1 maintenance</option>
                                            <option value="driver_fault">Driver fault</option>
                                            <option value="driver_hos">Driver HOS</option>
                                            <option value="unit_2_maintenance">Unit 2 Maintenance</option>
                                            <option value="overspeed">Overspeed</option>
                                            <option value="lane_restriction">Lane Restriction</option>
                                            <option value="following_too_close">Following too close</option>
                                        </select></td>
                                    <td><input type="text" class="w-800" name="remarks" required></td>
                                    <td><select data-filter="corrective_action_id" onchange="show_list(this.value)">
                                            <option>--select--</option>
                                            <option value="driver">Warning Letter</option>
                                            <option value="truck">Verbal Warning</option>
                                        </select></td>
    <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>
    </tr>`;
        $('#issue_table').append($add_rowissue);
        show_repairordercategory('issue_row' + counter)
        show_repairordercriticalitylevel('issue_row' + counter)
        show_repairorderjobwork('issue_row' + counter)
    }
    $(document.body).on('click', '[data-remove-stop-button=""]', function() {
        $(this).parent().parent().remove();
    });

    //-----------/remove stop
</script>



<script type="text/javascript">
    function show_repairordercategory(row_id) {

        get_repairordercategory().then(function(data) {

            //console.log(data);

            // Run this when your request was successful

            if (data.status) {

                //Run this if response has list

                if (data.response.list) {

                    var options = "";

                    options += `<option value="">- - Select - -</option>`

                    $.each(data.response.list, function(index, item) {

                        options += `<option value="` + item.id + `">` + item.name + `</option>`;

                    })

                    $('tr#' + row_id + ' [name="categoryid"]').html(options);

                }

            }

        }).catch(function(err) {

            // Run this when promise was rejected via reject()

        })

    }

    show_repairordercategory('issue_row1')
</script>



<script type="text/javascript">
    function show_repairordercriticalitylevel(row_id) {

        get_repairordercriticalitylevel().then(function(data) {

            // Run this when your request was successful

            if (data.status) {

                //Run this if response has list

                if (data.response.list) {

                    var options = "";

                    options += `<option value="">- - Select - -</option>`

                    $.each(data.response.list, function(index, item) {

                        options += `<option value="` + item.id + `">` + item.name + `</option>`;

                    })

                    $('tr#' + row_id + ' [name="criticalitylevelid"]').html(options);

                }

            }

        }).catch(function(err) {

            // Run this when promise was rejected via reject()

        })

    }

    show_repairordercriticalitylevel('issue_row1')
</script>



<script type="text/javascript">
    function show_repairorderjobwork(row_id) {

        get_jobwork().then(function(data) {

            // Run this when your request was successful

            if (data.status) {

                //Run this if response has list

                if (data.response.list) {

                    var options = "";

                    options += `<option value="">- - Select - -</option>`

                    $.each(data.response.list, function(index, item) {

                        options += `<option value="` + item.id + `">` + item.name + `</option>`;

                    })

                    $('tr#' + row_id + ' [name="jobworkid"]').html(options);

                }

            }

        }).catch(function(err) {

            // Run this when promise was rejected via reject()

        })

    }

    show_repairorderjobwork('issue_row1')
</script>



<script type="text/javascript">
    function add_new() {

        submit_to_wait_btn('#submit', 'loading')

        $('#formErro').show()

        var form = document.getElementById('MyForm');

        var isValidForm = form.checkValidity();

        var currentForm = $('#MyForm')[0];

        var formData = new FormData(currentForm);

        if (isValidForm) {

            var arr = $('#MyForm').serializeArray();

            /*

            var obj={}

            for(var a=0;a<arr.length;a++ ){

              obj[arr[a].name]=arr[a].value

            }

            */



            var $data_stop_rows = $("[data-stop-row]");

            data_stop_array = []



            $data_stop_rows.each(function(index)

                {

                    var $data_stop_row = $(this);

                    var stop_row =

                        {

                            categoryid: $data_stop_row.find('[name="categoryid"]').val(),

                            criticalitylevelid: $data_stop_row.find('[name="criticalitylevelid"]').val(),

                            jobworkid: $data_stop_row.find('[name="jobworkid"]').val(),

                            issuereported: $data_stop_row.find('[name="issuereported"]').val(),

                            issuedescription: $data_stop_row.find('[name="issuedescription"]').val()

                        }

                    data_stop_array.push(stop_row)

                })



            var obj = {

                order_date: $('[name="order_date"]').val(),

                order_class_id: $('[name="order_class_id"]').val(),

                order_status_id: $('[name="order_status_id"]').val(),

                order_driver_id: $('[name="order_driver_id"]').val(),

                order_type_id: $('[name="order_type_id"]').val(),

                order_stage_id: $('[name="order_stage_id"]').val(),

                order_start_date: $('[name="order_start_date"]').val(),

                order_start_time: $('[name="order_start_time"]').val(),

                order_end_date: $('[name="order_end_date"]').val(),

                order_end_time: $('[name="order_end_time"]').val(),

                order_unittype_id: $('[name="unit_type_id"]').val(),

                order_unit_no: $('[name="order_unit_no"]').val(),

                order_refdoctype_id: $('[name="order_refdoctype_id"]').val(),

                order_refdoc_no: $('[name="order_refdoc_no"]').val(),

                order_contact_person: $('[name="order_contact_person"]').val(),

                order_contact_no: $('[name="order_contact_no"]').val(),

                //stops:data_stop_array,

                stops: JSON.stringify(data_stop_array)

            }

            console.log(obj)

            $.ajax({

                    url: window.location.href + '-action',

                    type: 'POST',

                    data: obj,

                    success: function(data) {

                        //console.log(data)

                        // alert(data)

                        if ((typeof data) == 'string') {

                            data = JSON.parse(data)

                        }

                        alert(data.message);

                        if (data.status) {

                            location.href = "../user/maintenance/repair-order-entry"

                            wait_to_submit_btn('#submit', 'ADD')

                        } else {

                            wait_to_submit_btn('#submit', 'ADD')

                        }

                    }

                }

            )

        }

        return false

    }
</script>



<?php

require_once APPROOT . '/views/includes/user/footer.php';

?>