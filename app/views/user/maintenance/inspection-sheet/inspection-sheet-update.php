<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];
/*echo "<pre>";
print_r($details);
echo "</pre>"; */
?>

<br><br>

<section class="lg-form-outer">

    <div class="lg-form-header">UPDATE - INSPECTION SHEET</div>

    <br>

    <div class="lg-form-header">Inspection ID : <?php echo $details['id']; ?></div>
    <section class="lg-form" style="text-align:right;">
    <?php
  if (in_array('P0279', USER_PRIV)) {
  ?>
    <button class='btn_blue' onclick="location.href='../user/maintenance/inspection-sheet/details?eid=<?php echo $_GET['eid']; ?>'">View Inspection/Change Status</button>
  <?php
  }
  ?>
    <?php
    if (in_array('P0268', USER_PRIV)) {
    ?>
        <button class='btn_blue' onclick="open_child_window({url:'../user/maintenance/inspection-sheet/quick-documents?eid=<?php echo $_GET['eid']; ?>',width:1000,height:700,name:'Upload-Documents'})">Upload/View Documents</button>
    <?php
    }
    ?>
    </section>
    <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
        <input type="hidden" name="update_eid" value="<?php echo $details['eid']; ?>">
        <section class="section-111">

            <div>

                <fieldset>
                    <legend>Basic Information</legend>
                    <div class="field-section single-column" group-enable-disable>
                        <!-- <div class="field-p">
                            <label>Status</label>
                            <?php //if (in_array('P0268', USER_PRIV)) {
                            ?>
                                <select name="status_id" data-default-select="<?php //echo $details['status_id'] ?>">
                                </select>
                            <?php //} else { ?>
                                <input name="status_id" type="text" value="<?php //echo $details['status_id']; ?>"required disabled>
                            <?php //} ?>

                        </div> -->
                        <div class="field-p">
                            <label>Status</label>
                            <div><?php echo $details['status_id'] ?></div>
                        </div>

                        <div class="field-p">
                            <label>Inspection Date</label>
                            <input name="inspection_date" data-date-picker type="text" value="<?php echo $details['inspection_date']; ?>" required>
                        </div>
                        <div class="field-p">
                            <label>Start Time</label>
                            <input name="from_time" data-time-picker type="text" value="<?php echo $details['from_time']; ?>" required>
                        </div>
                        <div class="field-p">
                            <label>End Time</label>
                            <input name="to_time" data-time-picker-inspection type="text" value="<?php echo $details['to_time']; ?>">
                        </div>

                        <div class="field-p">
                            <label>Reference No.</label>
                            <input name="reference_no" type="text" required onchange="if(this.value!=''){inspection_sheet_reference(this.value)}" value="<?php echo $details['reference_no']; ?>">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Asset Information</legend>
                    <div class="field-section single-column" group-enable-disable>
                        <div class="field-p">
                            <label>Driver ID</label>
                            <input type="hidden" name="driver_id" value="<?php echo $details['driver_id'] ?>" required><br>
                            <input type="text" value="<?php echo $details['driver_a_display_name'] ?>" list="quick_list_driver_id" data-driver-id required>
                        </div>
                        <div class="field-p">
                            <label>Co-driver ID</label>
                            <input type="hidden" name="codriver_id" value="<?php echo $details['co_driver_id'] ?>" required><br>
                            <input type="text" value="<?php echo $details['driver_b_display_name'] ?>" list="quick_list_codriver_id" data-codriver-id>
                        </div>
                        <div class="field-p">
                            <label>Truck ID</label>
                            <input type="hidden" name="truck_id" value="<?php echo $details['truck_id'] ?>"><br>
                            <input type="text" value="<?php echo $details['truck_code'] ?>" list="quick_list_truck_id" data-truck-id required>
                        </div>
                        <div class="field-p">
                            <label>Trailer ID</label>
                            <input type="hidden" name="trailer_id" value="<?php echo $details['trailer_id'] ?>"><br>
                            <input type="text" value="<?php echo $details['trailer_code'] ?>" list="quick_list_trailer_id" data-trailer-id>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Level</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Level</label>
                            <select name="level_id" data-filter="level_id" data-default-select="<?php echo $details['level_id']; ?>" required>
                                <option value="">- - Select - -</option>
                                <option value="LEVEL 1">Level 1</option>
                                <option value="LEVEL 2">Level 2</option>
                                <option value="LEVEL 3">Level 3</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div>
                <fieldset>
                    <legend>Verbal Warning Information</legend>
                    <div class="field-section single-column" group-enable-disable>
                        <div class="field-p">
                            <label>Given By</label>
                            <input type="hidden" name="user_id" value="<?php echo $details['user_id'] ?>"><br>
                            <input type="text" value="<?php echo $details['user_name']; ?>" list="quick_list_user_id" data-user-id>
                            </select>
                        </div>
                        <div class="field-p">
                            <label>Date & Time</label>
                            <input name="verbal_warning_given_date" style="width:100px" data-date-picker type="text" value="<?php echo $details['verbal_warning_given_date']; ?>">
                            <input name="verbal_warning_given_time" style="width: 40px" data-time-picker type="text" value="<?php echo $details['verbal_warning_given_time']; ?>">
                            </input>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Driver Statement</legend>
                    <div class="field-section single-column" group-enable-disable>
                        <div class="field-p">
                            <textarea name="driver_statement" style="height: 100px" type="text"><?php echo $details['driver_statement']; ?></textarea>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Book Transfer Information</legend>
                    <div class="field-section single-column" group-enable-disable>
                        <div class="field-p">
                            <label>Book Transfer</label>
                            <select name="book_transfer_id" data-filter="book_transfer_id" data-default-select="<?php echo $details['book_transfer_id']; ?>" required>
                                <option value="">- - Select - -</option>
                                <option value="YES">Yes</option>
                                <option value="NO">No</option>
                            </select>
                        </div>
                        <div class="field-p">
                            <label>Book Tag</label>
                            <select name="book_tag_id" data-filter="book_tag_id" data-default-select="<?php echo $details['book_tag_id']; ?>" required>
                                <option value="">- - Select - -</option>
                                <option value="MB">MB</option>
                                <option value="TB">TB</option>
                                <option value="MB MS">MB MS</option>
                                <option value="MB ES">MB ES</option>
                                <option value="TB MS">TB MS</option>
                                <option value="TB ES">TB ES</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div>
                <fieldset>
                    <legend>Location Information</legend>
                    <div class="field-section single-column" group-enable-disable>
                        <div class="field-p">
                            <label>Company Name</label>
                            <select name="company_id" data-filter="company_id" required></select>
                        </div>
                        <div class="field-p">
                            <label>Location</label>
                            <input name="location" type="text" value="<?php echo $details['location']; ?>">
                        </div>
                        <div class="field-p">
                            <label>State</label>
                            <select name="state_id" data-filter="state_id" id="state_id" type="text" onchange="show_cities({state_id:this.value})" required data-optional></select>
                        </div>
                        <div class="field-p">
                            <label>City</label>
                            <select name="city_id" data-filter="city_id" data-default-select="<?php echo $details['city_id']; ?>" required disabled></select>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Violation Information</legend>
                    <div class="field-section single-column" group-enable-disable>
                        <div class="field-p">
                            <label>Violation Reported</label>
                            <select name="violation_reported_id" data-filter="violation_reported_id" data-default-select="<?php echo $details['violation_reported_id']; ?>" required></select>
                        </div>
                        <div class="field-p">
                            <label>Fined Amount</label>
                            <input name="fined_amount" type="number" step="any" class="zero" value="<?php echo $details['fined_amount']; ?>">
                        </div>
                        <div class="field-p">
                            <label>Bond Amount</label>
                            <input name="bond_amount" type="number" step="any" class="zero" value="<?php echo $details['bond_amount']; ?>">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Remarks</legend>
                    <div class="field-section single-column" group-enable-disable>
                        <div class="field-p">
                            <textarea name="remarks" style="height: 80px" type="text"><?php echo $details['remarks']; ?></textarea>
                        </div>
                    </div>
                </fieldset>
            </div>
        </section>

        <section class="section-1" style="width:100%">
            <div>
                <fieldset>
                    <legend>Driver's List</legend>
                    <div class="field-section table-rows" id="show_hide_driver">
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <!-- <th></th> -->
                                    <th>Sr. No.</th>
                                    <th></th>
                                    <th></th>
                                    <th>Reason</th>
                                    <th>Remarks</th>
                                    <th>Corrective Action</th>
                                    <th>Add New Ref. Document</th>
                                    <th>Latest Reference ID</th>
                                    <th></th>
                                    <th>View Ref. Document</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="asset_drivers">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <!-- <button type="button" class="btn_blue" onclick="add_row_drivers({})">Add Row</button> -->
                                        <?php
                                        echo '<button type="button" class="btn_blue add-row1" onclick="add_row_drivers({})">Add Row</button>';
                                        ?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>
            </div>
        </section>

        <script>
            function show_hide(my_obj, id) {
                var chk = my_obj.checked;
                if (chk === true) {
                    document.getElementById(id).style.display = "block";
                } else {
                    document.getElementById(id).style.display = "none";
                }
            }
        </script>

        <section class="section-1" style="width:100%">
            <div>
                <fieldset>
                    <legend>Truck's List</legend>
                    <div class="field-section table-rows" id="show_hide_truck">
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <!-- <th></th> -->
                                    <th>Sr. No.</th>
                                    <th></th>
                                    <th></th>
                                    <th>Reason</th>
                                    <th>Remarks</th>
                                    <th>Corrective Action</th>
                                    <th>Add New Ref. Document</th>
                                    <th>Latest Reference ID</th>
                                    <th></th>
                                    <th>View Ref. Document</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="asset_trucks">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <!-- <button type="button" class="btn_blue" onclick="add_row_trucks({})">Add Row</button> -->
                                        <?php
                                        echo '<button type="button" class="btn_blue add-row1" onclick="add_row_trucks({})">Add Row</button>';
                                        ?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>
            </div>
        </section>

        <section class="section-1" style="width:100%">
            <div>
                <fieldset>
                    <legend>Trailer's List</legend>
                    <div class="field-section table-rows" id="show_hide_trailer">
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <!-- <th></th> -->
                                    <th>Sr. No.</th>
                                    <th></th>
                                    <th></th>
                                    <th>Reason</th>
                                    <th>Remarks</th>
                                    <th>Corrective Action</th>
                                    <th>Add New Ref. Document</th>
                                    <th>Latest Reference ID</th>
                                    <th></th>
                                    <th>View Ref. Document</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="asset_trailers">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <!-- <button type="button" class="btn_blue" onclick="add_row_trailers({})">Add Row</button> -->
                                        <?php
                                        echo '<button type="button" class="btn_blue add-row1" onclick="add_row_trailers({})">Add Row</button>';
                                        ?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>
            </div>
        </section>

        <section class="action-button-box">
            <!-- <button type="submit" class="btn_green">SAVE</button> -->
            <?php
            echo '<button type="submit" class="btn_green save1">SAVE</button>';
            ?>
            &nbsp; &nbsp;
            <button type="button" class="btn_green" onclick="back_alert()">BACK</button>
        </section>

    </form>

</section>

<script type="text/javascript">
    var status = '<?php echo $details['status_id']; ?>';
    if (status === "CLOSED" || status === "RESOLVED") {
        //$(".save").prop('disabled', true)
        //$(".add-row").prop('disabled', true)
        $(document).find('input, select, .save1, .add-row1, textarea').prop('disabled', true);
        //$(".control-enable-disable").prop('disabled', true)
    } else if (status === "OPEN" || status === "RFC") {
        // $(".save").prop('disabled', false)
        // $(".add-row").prop('disabled', false)
        $(document).find('input, select, .save1, .add-row1, textarea').prop('disabled', false);
        // $(".control-enable-disable").prop('disabled', false)
    }
</script>

<script type="text/javascript">
    function inspection_sheet_reference(param) {
        $.ajax({
            url: "<?php echo AJAXROOT; ?>" + 'user/maintenance/inspection-sheet-ajax',
            type: 'POST',
            data: {
                refence_no: param,
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    if (data.status) {
                        $.each(data.response.list, function(index, item) {
                            if(item['reference_no'] === param){
                    alert('Reference Number Already exits/ Entering Same reference No.');
                    $('[name="reference_no"]').val('').focus();
                  }
                        })
                    }
                }
            }
        })
    }
</script>

<datalist id="quick_list_driver_id"></datalist>
<script type="text/javascript">
    $(document.body).on('input', '[data-driver-id]', function() {
        id_selected = $(`[data-driver-id-rows="${$(this).val()}"]`).data('value');
        if (id_selected != undefined) {
            $(this).data('driver-id', id_selected)
        }
    });

    $(document.body).on('change', '[data-driver-id]', function() {
        id_selected = $(`[data-driver-id-rows="${$(this).val()}"]`).data('value');
        if ($(this).val() != '') {
            if (id_selected == undefined) {
                alert("Please enter correct Driver ID")
                id_selected = ''
                $(this).val('')
                $(this).focus()
            }
        } else {
            id_selected = ''
        }
        $('[name="driver_id"]').val(id_selected)
    });

    quick_list_drivers().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
            //Run this if response has list
            if (data.response.list) {
                var options = "";
                options += `<option data-driver-id-rows="" data-value="" value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option data-driver-id-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" value="` + item.code + ' ' + item.name + `"></option>`;

                })
                $('#quick_list_driver_id').html(options);
            }
        }
    }).catch(function(err) {
        // Run this when promise was rejected via reject()
    })
</script>

<datalist id="quick_list_codriver_id"></datalist>
<script type="text/javascript">
    $(document.body).on('input', '[data-codriver-id]', function() {
        id_selected = $(`[data-codriver-id-rows="${$(this).val()}"]`).data('value');
        if (id_selected != undefined) {
            $(this).data('codriver-id', id_selected)
        }
    });

    $(document.body).on('change', '[data-codriver-id]', function() {
        id_selected = $(`[data-codriver-id-rows="${$(this).val()}"]`).data('value');
        if ($(this).val() != '') {
            if (id_selected == undefined) {
                alert("Please enter correct Co-Driver ID")
                id_selected = ''
                $(this).val('')
                $(this).focus()
            }
        } else {
            id_selected = ''
        }
        $('[name="codriver_id"]').val(id_selected)
    });

    quick_list_drivers().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
            //Run this if response has list
            if (data.response.list) {
                var options = "";
                options += `<option data-codriver-id-rows="" data-value="" value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option data-codriver-id-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" value="` + item.code + ' ' + item.name + `"></option>`;

                })
                $('#quick_list_codriver_id').html(options);
            }
        }
    }).catch(function(err) {
        // Run this when promise was rejected via reject()
    })
</script>

<datalist id="quick_list_truck_id"></datalist>
<script type="text/javascript">
    $(document.body).on('input', '[data-truck-id]', function() {
        id_selected = $(`[data-truck-id-rows="${$(this).val()}"]`).data('value');
        if (id_selected != undefined) {
            $(this).data('truck-id', id_selected)
        }
    });

    $(document.body).on('change', '[data-truck-id]', function() {
        id_selected = $(`[data-truck-id-rows="${$(this).val()}"]`).data('value');
        if ($(this).val() != '') {
            if (id_selected == undefined) {
                alert("Please enter correct Truck ID")
                id_selected = ''
                $(this).val('')
                $(this).focus()
            }
        } else {
            id_selected = ''
        }
        $('[name="truck_id"]').val(id_selected)
    });

    quick_list_trucks().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
            //Run this if response has list
            if (data.response.list) {
                var options = "";
                options += `<option data-truck-id-rows="" data-value="" value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option data-truck-id-rows="` + item.code + `" data-value="${item.id}" value="` + item.code + `"></option>`;
                })
                $('#quick_list_truck_id').html(options);
            }
        }
    }).catch(function(err) {
        // Run this when promise was rejected via reject()
    })
</script>

<datalist id="quick_list_trailer_id"></datalist>
<script type="text/javascript">
    $(document.body).on('input', '[data-trailer-id]', function() {
        id_selected = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
        if (id_selected != undefined) {
            $(this).data('trailer-id', id_selected)
        }
    });

    $(document.body).on('change', '[data-trailer-id]', function() {
        id_selected = $(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
        if ($(this).val() != '') {
            if (id_selected == undefined) {
                alert("Please enter correct Trailer ID")
                id_selected = ''
                $(this).val('')
                $(this).focus()
            }
        } else {
            id_selected = ''
        }
        $('[name="trailer_id"]').val(id_selected)
    });

    quick_list_trailers().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
            //Run this if response has list
            if (data.response.list) {
                var options = "";
                options += `<option data-trailer-id-rows="" data-value="" value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option data-trailer-id-rows="` + item.code + `" data-value="${item.id}" value="` + item.code + `"></option>`;
                })
                $('#quick_list_trailer_id').html(options);
            }
        }
    }).catch(function(err) {
        // Run this when promise was rejected via reject()
    })
</script>

<datalist id="quick_list_user_id"></datalist>
<script type="text/javascript">
    $(document.body).on('input', '[data-user-id]', function() {
        id_selected = $(`[data-user-id-rows="${$(this).val()}"]`).data('value');
        if (id_selected != undefined) {
            $(this).data('user-id', id_selected)
        }
    });

    $(document.body).on('change', '[data-user-id]', function() {
        id_selected = $(`[data-user-id-rows="${$(this).val()}"]`).data('value');
        if ($(this).val() != '') {
            if (id_selected == undefined) {
                alert("Please enter correct warning given by ID")
                id_selected = ''
                $(this).val('')
                $(this).focus()
            }
        } else {
            id_selected = ''
        }
        $('[name="user_id"]').val(id_selected)
    });

    quick_list_users().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
            //Run this if response has list
            if (data.response.list) {
                var options = "";
                options += `<option data-user-id-rows="" data-value="" value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option data-user-id-rows="` + item.user_display_name + `" data-value="${item.id}" value="` + item.user_display_name + `"></option>`;
                })
                $('#quick_list_user_id').html(options);
            }
        }
    }).catch(function(err) {
        // Run this when promise was rejected via reject()  
    })
</script>

<!-- <script type="text/javascript">
    function show_status_filter() {
        get_repair_order_status().then(function(data) {

            if (data.status) {

                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('[name="status_id"]').html(options);
                    select_default('[name="status_id"]')
                }
            }
        }).catch(function(err) {

        })
    }
    show_status_filter()
</script> -->

<script type='text/javascript'>
    function back_alert() {
        if (confirm('Are you Sure to go back?')) {
            window.history.back();
            //window.location.href = '../user/maintenance/inspection-sheet';
        }
    }
</script>

<script type="text/javascript">
    function load_violation_reported() {
        get_violation_reported_list().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('[data-filter="violation_reported_id"]').html(options);
                    select_default('[data-filter="violation_reported_id"]')
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    load_violation_reported()
</script>

<script type="text/javascript">
    function show_states() {
        var state_id = "<?php echo $details['state_id'] ?>";
        get_states().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if (state_id == item.id) {
                            options += `<option selected value="` + item.id + `">` + item.name + `</option>`;
                            show_cities({
                                state_id: item.id
                            });
                        } else {
                            options += `<option value="` + item.id + `">` + item.name + `</option>`;
                        }
                    })
                    $('[data-filter="state_id"]').html(options);
                    if (url_params.hasOwnProperty('state_id')) {
                        $("[data-filter='state_id'] option[value=" + url_params.state_id + "]").prop('selected', true);
                    }
                    show_cities({
                        state_id: '<?php echo $details['state_id']; ?>'
                    });
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_states()
</script>

<script type="text/javascript">
    function show_cities(param) {
        //console.log(param.state_id);
        if (param.state_id === '') {
            $('[data-filter="city_id"]').html('');
            $('[name="city_id"]').prop('disabled', true);
        } else if (param.state_id !== '') {
            $('[name="city_id"]').prop('disabled', false);
            get_cities(param).then(function(data) {
                // Run this when your request was successful
                if (data.status) {
                    //Run this if response has list
                    if (data.response.list) {
                        var options = "";
                        options += `<option value="">- - Select - -</option>`
                        $.each(data.response.list, function(index, item) {
                            //console.log(item)
                            options += `<option value="` + item.id + `">` + item.name + `</option>`;
                        })
                        $('[data-filter="city_id"]').html(options);
                        $('[data-filter="city_id"] option[value="<?php echo $details['city_id']; ?>"]').prop('selected', true);
                    }
                }
            }).catch(function(err) {
                // Run this when promise was rejected via reject()
            })
        }
    }
</script>

<script type="text/javascript">
    var company_id = '<?php echo $details['company_id']; ?>';

    function show_companies() {
        get_companies().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if (company_id == item.id) {
                            options += `<option selected value="` + item.id + `">` + item.name + `</option>`;
                        } else {
                            options += `<option value="` + item.id + `">` + item.name + `</option>`;
                        }
                    })
                    $('[data-filter="company_id"]').html(options);
                    if (url_params.hasOwnProperty('company_id')) {
                        $("[data-filter='company_id'] option[value=" + url_params.company_id + "]").prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_companies()
</script>

<script type="text/javascript">
    var status = '<?php echo $details['status_id']; ?>';
    if (status === "CLOSED") {
        var $disabled = 'disabled';
    }

    var counter_drivers = 0
    var $asset_drivers = $('#asset_drivers');

    function add_row_drivers(param) {
        ++counter_drivers;
        if (param.hasOwnProperty('default_asset_id_drivers')) {
            default_asset_id_drivers = param.default_asset_id_drivers
        } else {
            default_asset_id_drivers = ''
        }

        if (param.hasOwnProperty('default_select_asset_type_id_drivers')) {
            default_select_asset_type_id_drivers = param.default_select_asset_type_id_drivers
        } else {
            default_select_asset_type_id_drivers = ''
        }

        if (param.hasOwnProperty('default_select_asset_reason_id_drivers')) {
            default_select_asset_reason_id_drivers = param.default_select_asset_reason_id_drivers
        } else {
            default_select_asset_reason_id_drivers = ''
        }

        if (param.hasOwnProperty('default_asset_remarks_drivers')) {
            default_asset_remarks_drivers = param.default_asset_remarks_drivers
        } else {
            default_asset_remarks_drivers = ''
        }

        if (param.hasOwnProperty('default_select_asset_corrective_id_drivers')) {
            default_select_asset_corrective_id_drivers = param.default_select_asset_corrective_id_drivers
        } else {
            default_select_asset_corrective_id_drivers = ''
        }

        if (param.hasOwnProperty('default_select_asset_reference_document_id_drivers')) {
            default_select_asset_reference_document_id_drivers = param.default_select_asset_reference_document_id_drivers
        } else {
            default_select_asset_reference_document_id_drivers = ''
        }

        if (param.hasOwnProperty('default_select_asset_reference_document_eid_drivers')) {
            default_select_asset_reference_document_eid_drivers = param.default_select_asset_reference_document_eid_drivers
        } else {
            default_select_asset_reference_document_eid_drivers = ''
        }

        var fault_reason = "";
        if (default_select_asset_reference_document_id_drivers == '') {
            fault_reason = "<td><select class='w-150' name='asset_reason_id' required></select></td>";
        } else {
            fault_reason = "<td><select class='w-150' name='asset_reason_id' required disabled></select></td>";
        }

        var corrective_action = "";
        if (default_select_asset_reference_document_id_drivers == '') {
            corrective_action = "<td><select class='w-150 corr_act' name='asset_corrective_id'></select></td>";
        } else {
            corrective_action = "<td><select class='w-150 corr_act' name='asset_corrective_id' disabled></select></td>";
        }

        var addrefdoc = "<td><button type='button' class='btn_red_c' add-ref-doc-driver>+</button></td>";
        if (default_select_asset_corrective_id_drivers == '') {
            addrefdoc = "<td style='white-space:nowrap'></td>";
        }

        var viewrefdoc = "<td style='white-space:nowrap'><button type='button' class='btn_grey_c view-ref-doc-drivers'><i class='fa fa-eye'></i></button></td>";
        if (default_select_asset_reference_document_id_drivers == '') {
            viewrefdoc = "<td style='white-space:nowrap'></td>";
        }

        var deldoc = "";
        //if(default_select_asset_reference_document_id_drivers == '' && counter_drivers!= 1)
        if (default_select_asset_reference_document_id_drivers == '') {
            deldoc = "<td><input type='checkbox' class='chkbox' name='asset_select_drivers' checked></td>";
        } else {
            deldoc = "<td><input type='checkbox' class='chkbox' name='asset_select_drivers' checked disabled></td>";
        }

        var $add_row_drivers = `<tr id="issue_row${counter_drivers}"  data-drivers-row>
    <td class="counterdriver">${counter_drivers}</td>
    <td><input style="width:40" name="asset_id" value='${default_asset_id_drivers}' type="text" disabled hidden></input></td>
    <td><select class="w-150 asset_type" name="asset_type_id" hidden></select></td>
    ${fault_reason}
    <td><input class="w-150" name="asset_remarks" value='${default_asset_remarks_drivers}' type="text" ${$disabled}></td>
    ${corrective_action}
    ${addrefdoc}

    <td><input style="width:100" class="asset_reference_document_id_drivers" name="asset_reference_document_id_drivers" value='${default_select_asset_reference_document_id_drivers}' type="text" disabled></td>

    <td><input class="asset_reference_document_eid_drivers" name="asset_reference_document_eid_drivers" value='${default_select_asset_reference_document_eid_drivers}' type="text" hidden></td>

    ${viewrefdoc}
    ${deldoc}
    
    </tr>`;

        $('#asset_drivers').append($add_row_drivers);
        show_assets_type_drivers({
            row_id: 'issue_row' + counter_drivers,
            default_select: default_select_asset_type_id_drivers
        })
        show_reasons_list_drivers({
            row_id: 'issue_row' + counter_drivers,
            default_select: default_select_asset_reason_id_drivers
        })
        show_corrective_list_drivers({
            row_id: 'issue_row' + counter_drivers,
            default_select: default_select_asset_corrective_id_drivers
        })
    }
    $(document.body).on('click', '[data-remove-drivers-button=""]', function() {
        $(this).parent().parent().remove();
        // for re-calculating total amount code by swaran
        var a = 0;
        var b = 0;
        $('[data-row-amount-drivers]').each(function(index, item) {
            b = $(this).val();
            a = eval(a) + eval(b);
        })
        $('[data-total-amount-drivers]').val(a)
        // for re-calculating total amount code by swaran ENDS HERE
        // for re-setting dynamic-counter code by swaran
        counter_drivers = 0;
        $('.counterdriver').each(function(index, item) {
            counter_drivers = counter_drivers + 1;
            $(this).html(counter_drivers)
        })
    });

    //-----------/remove stop
</script>

<script type="text/javascript">
    $(document.body).on('click', '[add-ref-doc-driver]', function() {
        if (confirm('Are you Sure to add?')) {
            var asset_id = $(this).parent().siblings().find('.asset_id_drivers').val()
            var asset_val = $(this).parent().siblings().find('.asset_type').val()
            var corr_act = $(this).parent().siblings().find('.corr_act').val()
            if (asset_val == '1' && corr_act == '') {
                alert("Select Corrective Action & Save")
            }
            if (asset_val == '1' && corr_act == '1') {
                //add_new_repair_order_trucks(asset_id)
                alert("No link provided For This Corrective Action")
            }
            if (asset_val == '1' && corr_act == '2') {
                //add_new_capa_trucks(asset_id)
                alert("No link provided For This Corrective Action")
            }
        }
    })

    var driver_id = '<?php echo $details['driver_id']; ?>'

    function add_new_warning_letter_drivers(driver_id) {
        //window.location.href = '../user/maintenance/repair-orders/add-new?status_id=OPEN&class_id=UNSCHEDULE&vehicle_type=TRUCK&vehicle_id='+driver_id
    }

    function add_new_verbal_warning_drivers(driver_id) {
        //window.location.href = '../user/maintenance/repair-orders/add-new?status_id=OPEN&class_id=UNSCHEDULE&vehicle_type=TRUCK&vehicle_id='+driver_id
    }
</script>
<script type="text/javascript">
    $(document.body).on('click', '.view-ref-doc-drivers', function() {
        if (confirm('Are you Sure to view?')) {
            var asset_id = $(this).parent().siblings().find('.asset_id_drivers').val()
            var asset_val = $(this).parent().siblings().find('.asset_type').val()
            var corr_act = $(this).parent().siblings().find('.corr_act').val()
            var in_document_filename = $(this).parent().siblings().find('.asset_reference_document_id_drivers').val()
            var in_document_efilename = $(this).parent().siblings().find('.asset_reference_document_eid_drivers').val()
            if (in_document_filename == '' || in_document_filename == undefined) {
                alert("Add Reference Document First");
            } else {
                if (asset_val == '1' && corr_act == '1') {
                    open_repair_order_drivers(in_document_efilename)
                }
                if (asset_val == '1' && corr_act == '2') {
                    open_capa_drivers(in_document_efilename)
                }

                function open_repair_order_drivers(in_document_efilename) {
                    //window.location.href = '../user/maintenance/repair-orders/details?eid=' + in_document_efilename
                }

                function open_capa_drivers(in_document_efilename) {
                    //window.location.href = '../user/maintenance/repair-orders/details?eid=' + in_document_efilename
                }
            }
        }
    });
</script>

<script type="text/javascript">
    var status = '<?php echo $details['status_id']; ?>';
    if (status === "CLOSED") {
        var $disabled = 'disabled';
    }

    var counter_trucks = 0
    var $asset_trucks = $('#asset_trucks');

    function add_row_trucks(param) {
        ++counter_trucks;
        if (param.hasOwnProperty('default_asset_id_trucks')) {
            default_asset_id_trucks = param.default_asset_id_trucks
        } else {
            default_asset_id_trucks = ''
        }

        if (param.hasOwnProperty('default_select_asset_type_id_trucks')) {
            default_select_asset_type_id_trucks = param.default_select_asset_type_id_trucks
        } else {
            default_select_asset_type_id_trucks = ''
        }
        if (param.hasOwnProperty('default_select_asset_reason_id_trucks')) {
            default_select_asset_reason_id_trucks = param.default_select_asset_reason_id_trucks
        } else {
            default_select_asset_reason_id_trucks = ''
        }

        if (param.hasOwnProperty('default_asset_remarks_trucks')) {
            default_asset_remarks_trucks = param.default_asset_remarks_trucks
        } else {
            default_asset_remarks_trucks = ''
        }

        if (param.hasOwnProperty('default_select_asset_corrective_id_trucks')) {
            default_select_asset_corrective_id_trucks = param.default_select_asset_corrective_id_trucks
        } else {
            default_select_asset_corrective_id_trucks = ''
        }
        //alert(default_select_asset_corrective_id_trucks);
        if (param.hasOwnProperty('default_asset_reference_document_id_trucks')) {
            default_asset_reference_document_id_trucks = param.default_asset_reference_document_id_trucks
        } else {
            default_asset_reference_document_id_trucks = ''
        }

        if (param.hasOwnProperty('default_asset_reference_document_eid_trucks')) {
            default_asset_reference_document_eid_trucks = param.default_asset_reference_document_eid_trucks
        } else {
            default_asset_reference_document_eid_trucks = ''
        }

        if (param.hasOwnProperty('default_asset_reference_document_eid_trucks')) {
            default_asset_reference_document_eid_trucks = param.default_asset_reference_document_eid_trucks
        } else {
            default_asset_reference_document_eid_trucks = ''
        }

        var fault_reason = "";
        if (default_asset_reference_document_id_trucks == '') {
            fault_reason = "<td><select class='w-150' name='asset_reason_id_trucks' required></select></td>";
        } else {
            fault_reason = "<td><select class='w-150' name='asset_reason_id_trucks' required disabled></select></td>";
        }

        var remarks = "";
        if (default_asset_reference_document_id_trucks == '') {
            remarks = "<td><select class='w-150' name='asset_remarks_trucks'></select></td>";
        } else {
            remarks = "<td><select class='w-150' name='asset_remarks_trucks' disabled></select></td>";
        }

        var corrective_action = "";
        if (default_asset_reference_document_id_trucks == '') {
            corrective_action = "<td><select class='w-150 asset_corrective_id_trucks' name='asset_corrective_id_trucks'></select></td>";
        } else {
            corrective_action = "<td><select class='w-150 asset_corrective_id_trucks' name='asset_corrective_id_trucks' disabled></select></td>";
        }

        var addrefdoc = "<td><button type='button' class='btn_red_c' add-ref-doc-truck>+</button></td>";
        if (default_select_asset_corrective_id_trucks == '') {
            addrefdoc = "<td style='white-space:nowrap'></td>";
        }

        var viewrefdoc = "<td style='white-space:nowrap'><button title='open' type='button' class='btn_grey_c view-ref-doc-trucks'><i class='fa fa-eye'></i></button></td>";
        if (default_asset_reference_document_id_trucks == '') {
            viewrefdoc = "<td style='white-space:nowrap'></td>";
        }

        var deldoc = "";
        //if(default_asset_reference_document_id_trucks == '' && counter_trucks!= 1)
        if (default_asset_reference_document_id_trucks == '') {
            deldoc = "<td><input type='checkbox' class='chkbox' name='asset_select_trucks' checked></td>";
        } else {
            deldoc = "<td><input type='checkbox' class='chkbox' name='asset_select_trucks' checked disabled></td>";
        }

        var $add_row_trucks = `<tr id="issue_row1${counter_trucks}" data-trucks-row>
    <td class="countertrucks">${counter_trucks}</td>
    <td><input style="width:40" class="asset_id_trucks" name="asset_id_trucks" value='${default_asset_id_trucks}' type="text" disabled hidden></input></td>
    <td><select class="w-150 asset_type_id_trucks" name="asset_type_id_trucks" hidden></select></td>
    ${fault_reason}
    <td><input class="w-150" name="asset_remarks_trucks" value='${default_asset_remarks_trucks}' type="text" ${$disabled}></td>
    ${corrective_action}
    ${addrefdoc}

    <td><input style="width:100" class="asset_reference_document_id_trucks" name="asset_reference_document_id_trucks" value='${default_asset_reference_document_id_trucks}' type="text" disabled></td>

    <td><input class="asset_reference_document_eid_trucks" name="asset_reference_document_eid_trucks" value='${default_asset_reference_document_eid_trucks}' type="text" hidden></td>

    ${viewrefdoc}
    ${deldoc}
    </tr>`;

        $('#asset_trucks').append($add_row_trucks);

        show_assets_type_trucks({
            row_id: 'issue_row1' + counter_trucks,
            default_select: default_select_asset_type_id_trucks
        })
        show_reasons_list_trucks({
            row_id: 'issue_row1' + counter_trucks,
            default_select: default_select_asset_reason_id_trucks
        })
        show_corrective_list_trucks({
            row_id: 'issue_row1' + counter_trucks,
            default_select: default_select_asset_corrective_id_trucks
        })
    }
    $(document.body).on('click', '[data-remove-trucks-button=""]', function() {
        $(this).parent().parent().remove();
        // for re-calculating total amount code by swaran
        var a = 0;
        var b = 0;
        $('[data-row-amount-trucks]').each(function(index, item) {
            b = $(this).val();
            a = eval(a) + eval(b);
        })
        $('[data-total-amount-trucks]').val(a)
        // for re-calculating total amount code by swaran ENDS HERE
        // for re-setting dynamic-counter code by swaran
        counter_trucks = 0;
        $('.countertrucks').each(function(index, item) {
            counter_trucks = counter_trucks + 1;
            $(this).html(counter_trucks)
        })
    });

    //-----------/remove stop
</script>

<script type="text/javascript">
    $(document.body).on('click', '[add-ref-doc-truck]', function() {
        if (confirm('Are you Sure to add?')) {
            var asset_id = $(this).parent().siblings().find('.asset_id_trucks').val()
            var asset_val = $(this).parent().siblings().find('.asset_type_id_trucks').val()
            var corr_act = $(this).parent().siblings().find('.asset_corrective_id_trucks').val()
            if (asset_val == '2' && corr_act == '') {
                alert("Select Corrective Action & Save")
            }
            if (asset_val == '2' && corr_act == '3') {
                add_new_repair_order_trucks(asset_id)
            }
            if (asset_val == '2' && corr_act == '4') {
                //add_new_capa_trucks(asset_id)
                alert("No link provided For This Corrective Action")
            }
        }
    })

    var trucks_id = '<?php echo $details['truck_id']; ?>'
    var reference_name = 'Inspection Sheet'
    var reference_id = '<?php echo $details['id']; ?>'
    var driver_id = '<?php echo $details['driver_id']; ?>'
    var order_type_id = '7'

    function add_new_repair_order_trucks(asset_id) {
        window.location.href = '../user/maintenance/repair-orders/add-new?status_id=OPEN&class_id=UNSCHEDULE&vehicle_type=TRUCK&vehicle_id=' + trucks_id + '&reference_name=' + reference_name + '&reference_id=' + reference_id + '&reference_rowid=' + asset_id + '&driver_id=' + driver_id + '&order_type_id=' + order_type_id
    }

    function add_new_capa_trucks(asset_id) {

    }
</script>

<script type="text/javascript">
    $(document.body).on('click', '.view-ref-doc-trucks', function() {
        if (confirm('Are you Sure to view?')) {
            var asset_id = $(this).parent().siblings().find('.asset_id_trucks').val()
            var asset_val = $(this).parent().siblings().find('.asset_type_id_trucks').val()
            var corr_act = $(this).parent().siblings().find('.asset_corrective_id_trucks').val()
            var in_document_filename = $(this).parent().siblings().find('.asset_reference_document_id_trucks').val()
            var in_document_efilename = $(this).parent().siblings().find('.asset_reference_document_eid_trucks').val()

            // alert(asset_id);
            // alert(asset_val);
            // alert(corr_act);
            // alert(in_document_filename);
            // alert(in_document_efilename);

            if (in_document_filename == '' || in_document_filename == undefined) {
                alert("Add Reference Document First");
            } else {
                if (asset_val == '2' && corr_act == '3') {
                    open_repair_order_trucks(in_document_efilename)
                }
                if (asset_val == '2' && corr_act == '4') {
                    open_capa_trucks(in_document_efilename)
                }

                function open_repair_order_trucks(in_document_efilename) {
                    window.location.href = '../user/maintenance/repair-orders/details?eid=' + in_document_efilename
                }

                function open_capa_trucks(in_document_efilename) {
                    //window.location.href = '../user/maintenance/repair-orders/details?eid=' + in_document_efilename
                }
            }
        }
    });
</script>

<script type="text/javascript">
    var status = '<?php echo $details['status_id']; ?>';
    if (status === "CLOSED") {
        var $disabled = 'disabled';
    }

    var counter_trailers = 0
    var $asset_trailers = $('#asset_trailers');

    function add_row_trailers(param) {
        ++counter_trailers;
        if (param.hasOwnProperty('default_asset_id_trailers')) {
            default_asset_id_trailers = param.default_asset_id_trailers
        } else {
            default_asset_id_trailers = ''
        }
        if (param.hasOwnProperty('default_select_asset_type_id_trailers')) {
            default_select_asset_type_id_trailers = param.default_select_asset_type_id_trailers
        } else {
            default_select_asset_type_id_trailers = ''
        }
        if (param.hasOwnProperty('default_select_asset_reason_id_trailers')) {
            default_select_asset_reason_id_trailers = param.default_select_asset_reason_id_trailers
        } else {
            default_select_asset_reason_id_trailers = ''
        }

        if (param.hasOwnProperty('default_asset_remarks_trailers')) {
            default_asset_remarks_trailers = param.default_asset_remarks_trailers
        } else {
            default_asset_remarks_trailers = ''
        }

        if (param.hasOwnProperty('default_select_asset_corrective_id_trailers')) {
            default_select_asset_corrective_id_trailers = param.default_select_asset_corrective_id_trailers
        } else {
            default_select_asset_corrective_id_trailers = ''
        }

        if (param.hasOwnProperty('default_select_asset_reference_document_id_trailers')) {
            default_select_asset_reference_document_id_trailers = param.default_select_asset_reference_document_id_trailers
        } else {
            default_select_asset_reference_document_id_trailers = ''
        }

        if (param.hasOwnProperty('default_select_asset_reference_document_eid_trailers')) {
            default_select_asset_reference_document_eid_trailers = param.default_select_asset_reference_document_eid_trailers
        } else {
            default_select_asset_reference_document_eid_trailers = ''
        }

        var fault_reason = "";
        if (default_select_asset_reference_document_id_trailers == '') {
            fault_reason = "<td><select class='w-150' name='asset_reason_id_trailers' required></select></td>";
        } else {
            fault_reason = "<td><select class='w-150' name='asset_reason_id_trailers' required disabled></select></td>";
        }

        var corrective_action = "";
        if (default_select_asset_reference_document_id_trailers == '') {
            corrective_action = "<td><select class='w-150 corr_act' name='asset_corrective_id_trailers'></select></td>";
        } else {
            corrective_action = "<td><select class='w-150 corr_act' name='asset_corrective_id_trailers' disabled></select></td>";
        }

        var addrefdoc = "<td><button type='button' class='btn_red_c' add-ref-doc-trailers>+</button></td>";
        if (default_select_asset_corrective_id_trailers == '') {
            addrefdoc = "<td style='white-space:nowrap'></td>";
        }

        var viewrefdoc = "<td style='white-space:nowrap'><button title='open' type='button' class='btn_grey_c view-ref-doc-trailer'><i class='fa fa-eye'></i></button></td>";
        if (default_select_asset_reference_document_id_trailers == '') {
            viewrefdoc = "<td style='white-space:nowrap'></td>";
        }

        var deldoc = "";
        //if(default_select_asset_reference_document_id_trailers == '' && counter_trailers!= 1)
        if (default_select_asset_reference_document_id_trailers == '') {
            deldoc = "<td><input type='checkbox' class='chkbox' name='asset_select_trailers' checked></td>";
        } else {
            deldoc = "<td><input type='checkbox' class='chkbox' name='asset_select_trailers' checked disabled></td>";
        }

        var $add_row_trailers = `<tr id="issue_row2${counter_trailers}" data-trailers-row>
    <td class="countertrailers">${counter_trailers}</td>
    <td><input style="width:40" name="asset_id_trailers" value='${default_asset_id_trailers}' type="text" disabled hidden></input></td>
    <td><select class="w-150 asset_type" name="asset_type_id_trailers" hidden></select></td>
    ${fault_reason}
    <td><input class="w-150" name="asset_remarks_trailers" value='${default_asset_remarks_trailers}' type="text" ${$disabled}></td>
    ${corrective_action}
    ${addrefdoc}

    <td><input style="width:100" class="asset_reference_document_id_trailers" name="asset_reference_document_id_trailers" value='${default_select_asset_reference_document_id_trailers}' type="text" disabled></td>

    <td><input class="asset_reference_document_eid_trailers" name="asset_reference_document_eid_trailers" value='${default_select_asset_reference_document_eid_trailers}' type="text" hidden></td>

    ${viewrefdoc}
    ${deldoc}
    </tr>`;

        $('#asset_trailers').append($add_row_trailers);

        show_assets_type_trailers({
            row_id: 'issue_row2' + counter_trailers,
            default_select: default_select_asset_type_id_trailers
        })
        show_reasons_list_trailers({
            row_id: 'issue_row2' + counter_trailers,
            default_select: default_select_asset_reason_id_trailers
        })
        show_corrective_list_trailers({
            row_id: 'issue_row2' + counter_trailers,
            default_select: default_select_asset_corrective_id_trailers
        })
    }
    $(document.body).on('click', '[data-remove-trailers-button=""]', function() {
        $(this).parent().parent().remove();
        // for re-calculating total amount code by swaran
        var a = 0;
        var b = 0;
        $('[data-row-amount-trailers]').each(function(index, item) {
            b = $(this).val();
            a = eval(a) + eval(b);
        })
        $('[data-total-amount-trailers]').val(a)
        // for re-calculating total amount code by swaran ENDS HERE
        // for re-setting dynamic-counter code by swaran
        counter_trailers = 0;
        $('.countertrailers').each(function(index, item) {
            counter_trailers = counter_trailers + 1;
            $(this).html(counter_trailers)
        })
    });

    //-----------/remove stop
</script>

<script type="text/javascript">
    $(document.body).on('click', '[add-ref-doc-trailers]', function() {
        if (confirm('Are you Sure to add?')) {
            var asset_id = $(this).parent().siblings().find('.asset_id_trailers').val()
            var asset_val = $(this).parent().siblings().find('.asset_type').val()
            var corr_act = $(this).parent().siblings().find('.corr_act').val()
            if (asset_val == '3' && corr_act == '') {
                alert("Select Corrective Action & Save")
            }
            if (asset_val == '3' && corr_act == '5') {
                add_new_repair_order_trailers(asset_id)
            }
            if (asset_val == '3' && corr_act == '6') {
                //add_new_capa_trucks(asset_id)
                alert("No link provided For This Corrective Action")
            }
        }
    })

    var trailer_id = '<?php echo $details['trailer_id']; ?>'
    var reference_name = 'Inspection Sheet'
    var reference_id = '<?php echo $details['id']; ?>'
    var driver_id = '<?php echo $details['driver_id']; ?>'
    var order_type_id = '7'

    function add_new_repair_order_trailers(asset_id) {
        window.location.href = '../user/maintenance/repair-orders/add-new?status_id=OPEN&class_id=UNSCHEDULE&vehicle_type=TRAILER&vehicle_id=' + trailer_id + '&reference_name=' + reference_name + '&reference_id=' + reference_id + '&reference_rowid=' + asset_id + '&driver_id=' + driver_id + '&order_type_id=' + order_type_id
    }
</script>

<script type="text/javascript">
    $(document.body).on('click', '.view-ref-doc-trailer', function() {
        if (confirm('Are you Sure to view?')) {
            var asset_id = $(this).parent().siblings().find('.asset_id_trailers').val()
            var asset_val = $(this).parent().siblings().find('.asset_type').val()
            var corr_act = $(this).parent().siblings().find('.corr_act').val()
            var in_document_filename = $(this).parent().siblings().find('.asset_reference_document_id_trailers').val()
            var in_document_efilename = $(this).parent().siblings().find('.asset_reference_document_eid_trailers').val()
            if (in_document_filename == '' || in_document_filename == undefined) {
                alert("Add Reference Document First");
            } else {
                if (asset_val == '3' && corr_act == '5') {
                    open_repair_order_trailers(in_document_efilename)
                }
                if (asset_val == '3' && corr_act == '6') {
                    open_capa_trailers(in_document_efilename)
                }

                function open_repair_order_trailers(in_document_efilename) {
                    window.location.href = '../user/maintenance/repair-orders/details?eid=' + in_document_efilename
                }

                function open_capa_trailers(in_document_efilename) {
                    //window.location.href = '../user/maintenance/repair-orders/details?eid=' + in_document_efilename
                }
            }
        }
    });
</script>



<script type="text/javascript">
    function show_assets_type_drivers(param) {
        get_assets_type().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    // options+=`<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if (item.status == "ACT" || item.status == "ACTIVE") {
                            options += `<option value="` + item.id + `">` + item.name + `</option>`;
                        }
                    })
                    $('tr#' + param.row_id + ' [name="asset_type_id"]').html(options);
                    if (param.hasOwnProperty('default_select')) {
                        $('tr#' + param.row_id + ' [name="asset_type_id"] option[value="' + param.default_select + '"]').prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_assets_type_drivers('issue_row1')
</script>

<script type="text/javascript">
    function show_assets_type_trucks(param) {
        get_assets_type_trucks().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    // options+=`<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if (item.status == "ACT" || item.status == "ACTIVE") {
                            options += `<option value="` + item.id + `">` + item.name + `</option>`;
                        }
                    })
                    $('tr#' + param.row_id + ' [name="asset_type_id_trucks"]').html(options);
                    if (param.hasOwnProperty('default_select')) {
                        $('tr#' + param.row_id + ' [name="asset_type_id_trucks"] option[value="' + param.default_select + '"]').prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_assets_type_trucks('issue_row1')
</script>

<script type="text/javascript">
    function show_assets_type_trailers(param) {
        get_assets_type_trailers().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    // options+=`<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if (item.status == "ACT" || item.status == "ACTIVE") {
                            options += `<option value="` + item.id + `">` + item.name + `</option>`;
                        }
                    })
                    $('tr#' + param.row_id + ' [name="asset_type_id_trailers"]').html(options);
                    if (param.hasOwnProperty('default_select')) {
                        $('tr#' + param.row_id + ' [name="asset_type_id_trailers"] option[value="' + param.default_select + '"]').prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })

    }
    show_assets_type_trailers('issue_row1')
</script>

<script type="text/javascript">
    function show_reasons_list_drivers(param) {
        get_reasons_list().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if (item.status == "ACT" || item.status == "ACTIVE") {
                            options += `<option value="` + item.id + `">` + item.name + `</option>`;
                        }
                    })
                    $('tr#' + param.row_id + ' [name="asset_reason_id"]').html(options);
                    if (param.hasOwnProperty('default_select')) {
                        $('tr#' + param.row_id + ' [name="asset_reason_id"] option[value="' + param.default_select + '"]').prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_reasons_list_drivers('issue_row1')
</script>

<script type="text/javascript">
    function show_reasons_list_trucks(param) {
        get_reasons_list_trucks().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if (item.status == "ACT" || item.status == "ACTIVE") {
                            options += `<option value="` + item.id + `">` + item.name + `</option>`;
                        }
                    })
                    $('tr#' + param.row_id + ' [name="asset_reason_id_trucks"]').html(options);
                    if (param.hasOwnProperty('default_select')) {
                        $('tr#' + param.row_id + ' [name="asset_reason_id_trucks"] option[value="' + param.default_select + '"]').prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_reasons_list_trucks('issue_row1')
</script>

<script type="text/javascript">
    function show_reasons_list_trailers(param) {
        get_reasons_list_trailers().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if (item.status == "ACT" || item.status == "ACTIVE") {
                            options += `<option value="` + item.id + `">` + item.name + `</option>`;
                        }
                    })
                    $('tr#' + param.row_id + ' [name="asset_reason_id_trailers"]').html(options);
                    if (param.hasOwnProperty('default_select')) {
                        $('tr#' + param.row_id + ' [name="asset_reason_id_trailers"] option[value="' + param.default_select + '"]').prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_reasons_list_trailers('issue_row1')
</script>

<script type="text/javascript">
    function show_corrective_list_drivers(param) {
        get_corrective_list().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if (item.status == "ACT" || item.status == "ACTIVE") {
                            options += `<option value="` + item.id + `">` + item.name + `</option>`;
                        }
                    })
                    $('tr#' + param.row_id + ' [name="asset_corrective_id"]').html(options);
                    if (param.hasOwnProperty('default_select')) {
                        $('tr#' + param.row_id + ' [name="asset_corrective_id"] option[value="' + param.default_select + '"]').prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_corrective_list_drivers('issue_row1')
</script>

<script type="text/javascript">
    function show_corrective_list_trucks(param) {
        get_corrective_list_trucks().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if (item.status == "ACT" || item.status == "ACTIVE") {
                            options += `<option value="` + item.id + `">` + item.name + `</option>`;
                        }
                    })
                    $('tr#' + param.row_id + ' [name="asset_corrective_id_trucks"]').html(options);
                    if (param.hasOwnProperty('default_select')) {
                        $('tr#' + param.row_id + ' [name="asset_corrective_id_trucks"] option[value="' + param.default_select + '"]').prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_corrective_list_trucks('issue_row1')
</script>

<script type="text/javascript">
    function show_corrective_list_trailers(param) {
        get_corrective_list_trailers().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if (item.status == "ACT" || item.status == "ACTIVE") {
                            options += `<option value="` + item.id + `">` + item.name + `</option>`;
                        }
                    })
                    $('tr#' + param.row_id + ' [name="asset_corrective_id_trailers"]').html(options);
                    if (param.hasOwnProperty('default_select')) {
                        $('tr#' + param.row_id + ' [name="asset_corrective_id_trailers"] option[value="' + param.default_select + '"]').prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_corrective_list_trailers('issue_row1')
</script>

<script type="text/javascript">
    function save() {
        submit_to_wait_btn('#submit', 'loading')
        $('#formErro').show()
        var form = document.getElementById('MyForm');
        var isValidForm = form.checkValidity();
        var currentForm = $('#MyForm')[0];
        var formData = new FormData(currentForm);
        if (isValidForm) {
            var arr = $('#MyForm').serializeArray();

            var $data_drivers_rows = $("[data-drivers-row]");
            data_drivers_array = [];
            var flagMessageForSetting = 0;
            var flagMessageForSetting2 = 0;
            var flagMessageForSetting3 = 0;
            var lastFlag = 1;
            $data_drivers_rows.each(function(index) {
                var $data_drivers_row = $(this);
                var drivers_row = {
                    asset_id: $data_drivers_row.find('[name="asset_id"]').val(),
                    asset_type_id: $data_drivers_row.find('[name="asset_type_id"]').val(),
                    asset_reason_id: $data_drivers_row.find('[name="asset_reason_id"]').val(),
                    asset_remarks: $data_drivers_row.find('[name="asset_remarks"]').val(),
                    asset_corrective_id: $data_drivers_row.find('[name="asset_corrective_id"]').val(),
                    asset_reference_document_id: $data_drivers_row.find('[name="asset_reference_document_id_drivers"]').val(),
                    //asset_reference_document_id: ($data_drivers_row.find('[name="asset_reference_document_id"]').prop('value')==undefined)?'':val(),
                    asset_checked: ($data_drivers_row.find('[name="asset_select_drivers"]').prop('checked') == true) ? 'ON' : 'OFF'
                }
                data_drivers_array.push(drivers_row);
                //alert($data_drivers_row.find('[name="asset_reason_id"]').val());
                if ($data_drivers_row.find('[name="asset_reason_id"]').val() != undefined && $data_drivers_row.find('[name="asset_reason_id"]').val() != "") {
                    flagMessageForSetting = 1;
                } else {
                    flagMessageForSetting = 0;
                    lastFlag = 0;
                }

            })
            //return;
            var $data_trucks_rows = $("[data-trucks-row]");
            data_trucks_array = []
            $data_trucks_rows.each(function(index) {
                var $data_trucks_row = $(this);
                var trucks_row = {
                    asset_id: $data_trucks_row.find('[name="asset_id_trucks"]').val(),
                    asset_type_id: $data_trucks_row.find('[name="asset_type_id_trucks"]').val(),
                    asset_reason_id: $data_trucks_row.find('[name="asset_reason_id_trucks"]').val(),
                    asset_remarks: $data_trucks_row.find('[name="asset_remarks_trucks"]').val(),
                    asset_corrective_id: $data_trucks_row.find('[name="asset_corrective_id_trucks"]').val(),
                    asset_reference_document_id: $data_trucks_row.find('[name="asset_reference_document_id_trucks"]').val(),
                    //asset_reference_document_id: ($data_trucks_row.find('[name="asset_reference_document_id_trucks"]').prop('value')==undefined)?'':val(),
                    asset_checked: ($data_trucks_row.find('[name="asset_select_trucks"]').prop('checked') == true) ? 'ON' : 'OFF'
                }
                data_trucks_array.push(trucks_row);
                if ($data_trucks_row.find('[name="asset_reason_id_trucks"]').val() != undefined && $data_trucks_row.find('[name="asset_reason_id_trucks"]').val() != "") {
                    flagMessageForSetting2 = 1;
                } else {
                    flagMessageForSetting2 = 0;
                    lastFlag = 0;
                }


            })

            var $data_trailers_rows = $("[data-trailers-row]");
            data_trailers_array = []
            $data_trailers_rows.each(function(index) {
                var $data_trailers_row = $(this);
                var trailers_row = {
                    asset_id: $data_trailers_row.find('[name="asset_id_trailers"]').val(),
                    asset_type_id: $data_trailers_row.find('[name="asset_type_id_trailers"]').val(),
                    asset_reason_id: $data_trailers_row.find('[name="asset_reason_id_trailers"]').val(),
                    asset_remarks: $data_trailers_row.find('[name="asset_remarks_trailers"]').val(),
                    asset_corrective_id: $data_trailers_row.find('[name="asset_corrective_id_trailers"]').val(),
                    asset_reference_document_id: $data_trailers_row.find('[name="asset_reference_document_id_trailers"]').val(),
                    //asset_reference_document_id: ($data_trailers_row.find('[name="asset_reference_document_id_trailers"]').prop('value')==undefined)?'':val(),
                    asset_checked: ($data_trailers_row.find('[name="asset_select_trailers"]').prop('checked') == true) ? 'ON' : 'OFF'
                }
                data_trailers_array.push(trailers_row);
                if ($data_trailers_row.find('[name="asset_reason_id_trailers"]').val() != undefined && $data_trailers_row.find('[name="asset_reason_id_trailers"]').val() != "") {
                    flagMessageForSetting3 = 1;
                } else {
                    flagMessageForSetting3 = 0;
                    lastFlag = 0;
                }
            })

            // if ($('[name="violation_reported_id"]').val()!='Good Inspection') 
            // {
            //     if (flagMessageForSetting == 0 && flagMessageForSetting2 == 0 && flagMessageForSetting3 == 0)
            //     {
            //         alert('Please provide at least one record of driver or truck or trailer list');
            //         return
            //     } 
            //     if(lastFlag == 0) {
            //         alert('Please provide of added row');
            //         return;
            //     }
            // }

            var obj = {
                status_id: $('[name="status_id"]').val(),
                ins_date: $('[name="inspection_date"]').val(),
                from_time: $('[name="from_time"]').val(),
                to_time: $('[name="to_time"]').val(),
                reference_no: $('[name="reference_no"]').val(),
                driver_id: $('[name="driver_id"]').val(),
                codriver_id: $('[name="codriver_id"]').val(),
                truck_id: $('[name="truck_id"]').val(),
                trailer_id: $('[name="trailer_id"]').val(),
                company_id: $('[name="company_id"]').val(),
                location: $('[name="location"]').val(),
                state_id: $('[name="state_id"]').val(),
                city_id: $('[name="city_id"]').val(),
                violation_reported_id: $('[name="violation_reported_id"]').val(),
                fine_amount: $('[name="fined_amount"]').val(),
                bond_amount: $('[name="bond_amount"]').val(),
                remarks: $('[name="remarks"]').val(),
                level_id: $('[name="level_id"]').val(),

                book_transfer_id: $('[name="book_transfer_id"]').val(),
                book_tag_id: $('[name="book_tag_id"]').val(),

                driver_statement: $('[name="driver_statement"]').val(),

                verbal_warning_given_by_id: $('[name="user_id"]').val(),
                verbal_warning_given_date: $('[name="verbal_warning_given_date"]').val(),
                verbal_warning_given_time: $('[name="verbal_warning_given_time"]').val(),

                stops: data_drivers_array,
                trucks: data_trucks_array,
                trailers: data_trailers_array,
                update_eid: $('[name="update_eid"]').val(),
            }
            // console.log(obj)
            $.ajax({
                url: '../user/maintenance/inspection-sheet/update-action',
                type: 'POST',
                data: obj,
                success: function(data) {
                    // console.log(data)
                    // alert(data)
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                    }
                    alert(data.message);
                    if (data.status) {
                        //window.location.reload()
                        window.history.back();
                        //window.location.href = '../user/maintenance/inspection-sheet';
                        wait_to_submit_btn('#submit', 'ADD')
                    } else {
                        wait_to_submit_btn('#submit', 'ADD')
                    }
                }
            })
        }
        return false
    }
</script>

<script type="text/javascript">
    async function f() {
        var asset_list_drivers = '<?php echo json_encode($details['asset_list_drivers']) ?>';
        asset_list_drivers = JSON.parse(asset_list_drivers)
        $.each(asset_list_drivers, function(index, item) {
            add_row_drivers({
                default_asset_id_drivers: item.asset_id_drivers,
                default_select_asset_type_id_drivers: item.asset_type_id_drivers,
                default_select_asset_reason_id_drivers: item.asset_reason_id_drivers,
                default_asset_remarks_drivers: item.asset_remarks_drivers,
                default_select_asset_corrective_id_drivers: item.asset_corrective_id_drivers,
                default_select_asset_reference_document_id_drivers: item.asset_reference_document_id_drivers,
                default_select_asset_reference_document_eid_drivers: item.asset_reference_document_eid_drivers
            })
        })
    }
    f()
</script>

<script type="text/javascript">
    async function get_trucks() {
        var asset_list_trucks = '<?php echo json_encode($details['asset_list_trucks']) ?>';
        asset_list_trucks = JSON.parse(asset_list_trucks)
        $.each(asset_list_trucks, function(index, item) {
            //alert(item.asset_corrective_id_trucks)
            add_row_trucks({
                default_asset_id_trucks: item.asset_id_trucks,
                default_select_asset_type_id_trucks: item.asset_type_id_trucks,
                default_select_asset_reason_id_trucks: item.asset_reason_id_trucks,
                default_asset_remarks_trucks: item.asset_remarks_trucks,
                default_select_asset_corrective_id_trucks: item.asset_corrective_id_trucks,
                default_asset_reference_document_id_trucks: item.asset_reference_document_id_trucks,
                default_asset_reference_document_eid_trucks: item.asset_reference_document_eid_trucks
            })
        })
    }
    get_trucks()
</script>

<script type="text/javascript">
    async function get_trailers() {
        var asset_list_trailers = '<?php echo json_encode($details['asset_list_trailers']) ?>';
        asset_list_trailers = JSON.parse(asset_list_trailers)
        $.each(asset_list_trailers, function(index, item) {
            add_row_trailers({
                default_asset_id_trailers: item.asset_id_trailers,
                default_select_asset_type_id_trailers: item.asset_type_id_trailers,
                default_select_asset_reason_id_trailers: item.asset_reason_id_trailers,
                default_asset_remarks_trailers: item.asset_remarks_trailers,
                default_select_asset_corrective_id_trailers: item.asset_corrective_id_trailers,
                default_select_asset_reference_document_id_trailers: item.asset_reference_document_id_trailers,
                default_select_asset_reference_document_eid_trailers: item.asset_reference_document_eid_trailers
            })
        })
    }
    get_trailers()
</script>

<script type="text/javascript">
    $(document.body).on('change', '.zero', function() {
        if ($(this).val().trim().length === 0) {
            $(this).val(0);
        }
    })
</script>

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>