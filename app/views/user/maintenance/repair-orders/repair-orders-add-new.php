<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br>
<section class="lg-form-outer">
    <div class="lg-form-header">ADD NEW - REPAIR ORDER</div>
    <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">

        <section class="section-111" style="max-width: 1200px">
            <div>
                <fieldset>
                    <legend>Basic Details</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Class</label>
                            <select name="order_class_id" required="required" id="getchcck" disabled></select>
                        </div>
                        <div class="field-p">
                            <label>Unit Type</label>
                            <select name="unit_type_id" onchange="show_unit_filter({unit_type_id:this.value})" disabled></select>
                        </div>
                        <div class="field-p">
                            <label>Unit No</label>
                            <select name="unit_id" data-filter="unit_id" disabled="true">
                            </select>
                        </div>
                        <div class="field-p">
                            <label>VIN No</label>
                            <input name="order_vin_no" type="text" disabled="true" value="">
                        </div>
                    </div>
                </fieldset>
            </div>
            <div>
                <fieldset>
                    <legend> - - - </legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Driver</label>
                            <select name="driver_id" type="text" required></select>
                        </div>
                        <div class="field-p">
                            <label>Type</label>
                            <select name="order_type_id" type="text" required></select>
                        </div>
                        <div class="field-p">
                            <label>Stage</label>
                            <select id="order_stage_id" name="order_stage_id" type="text" required></select>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend> Yard Name </legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Yard Name</label>
                            <select class="removereq mode0" name="yard_id" type="text" style="text-overflow: ellipsis;overflow: hidden !important;max-width: 250px" required data-optional></select>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend> Vendor Detail </legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                          <label>Vendor Name</label>
                          <select class="removereq mode1"  name="vendor_id" type="text" style="text-overflow: ellipsis;overflow: hidden !important;max-width: 250px" required data-optional></select>
                      </div>
                      <div class="field-p">
                          <label>Vendor State</label>
                          <select class="removereq mode2"  name="vendor_state_id" id="vendor_state_id" type="text" onchange="show_cities({state_id:this.value})" required data-optional></select>
                      </div>
                      <div class="field-p">
                          <label>Vendor City</label>
                          <select class="removereq mode3"  name="vendor_city_id" type="text" required data-optional></select>
                      </div>
                  </div>
              </fieldset>
              <fieldset>
                <legend> Start Date & Time </legend>
                <div class="field-section single-column">
                  <div class="field-p">
                    <label>Start Date</label>
                    <input name="order_start_date" type="text" id="mindateer" pattern="\d{1,2}/\d{1,2}/\d{4}" start_date_from data-date-picker="" required placeholder="MM/DD/YYYY" >
                </div>
                <div class="field-p">
                    <label>Start Time</label>
                    <input name="order_start_time" data-time-picker type="text" required placeholder="HH:MM">
                </div>
            </div>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend>Contact Information</legend>
            <div class="field-section single-column">
                <div class="field-p">
                    <label>Contact Person</label>
                    <input name="contact_person" type="text">
                </div>
                <div class="field-p">
                    <label>Contact No</label>
                    <input name="contact_no" type="text" name="mobile_number" pattern="[0-9][0-9]{9}" placeholder="1234567890">
                </div>
            </div>
        </fieldset>
        <fieldset>

            <legend>Link Reference Doc No</legend>
            <div class="field-section single-column">
              <div class="field-p">
                <label>Reference Type</label>
                <input name="reference_name" type="text" disabled>            
            </div> 
            <div class="field-p">
                <label>Reference ID</label>
                <input name="reference_id" type="text" disabled>
            </div>     
            <div class="field-p">
                <label>Row ID</label>
                <input name="reference_rowid" type="text" disabled>
            </div>
        </div>                  
    </fieldset>
</div>
</section>
<section class="section-1" style="width:100%">
    <div>
        <fieldset>
            <legend>Issue List</legend>
            <div class="field-section table-rows">
                <table style="width: 100%">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Category</th>
                            <th>Criticality Level</th>
                            <th>Job Work</th>
                            <th>Issue Reported</th>
                            <th>Issue Description</th>
                        </tr>
                    </thead>
                    <tbody id="issue_table">
                        <tr id="issue_row1" data-stop-row>
                            <td>1</td>
                            <td><select class="w-150" name="category_id" required></select></td>
                            <td><select class="w-150" name="criticality_level_id" required></select></td>
                            <td><select class="w-150 jbr" name="job_work_id" required></select></td>
                            <td><input type="text" class="w-150" name="issue_reported" required></td>
                            <td><input type="text" class="w-150" name="issue_description" required></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8"><button type="button" class="btn_blue" onclick="add_row()">Add Row</button></td>
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
            <legend>Follow Up</legend>
            <div class="field-section table-rows">
                <table style="width: 100%">
                    <thead>
                        <tr>
                            <th>Comment</th>
                            <th>Next Follow Up Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 70%"><textarea name="follow_up_description" style="height: 70px;width: 100%"></textarea></td>
                            <td><input name="next_follow_up_date" data-date-picker type="text" pattern="\d{1,2}/\d{1,2}/\d{4}"  start_date_from  placeholder="MM/DD/YYYY"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
</section>
<section class="action-button-box">
    <button type="submit" data-submit></button>
    <button type="button" class="btn_green" onclick="set_pref(0)">SAVE</button> &nbsp &nbsp
    <button type="button" class="btn_green" onclick="set_pref(1)">SAVE & UPLOAD DOCUMENTS</button> &nbsp &nbsp
    <button type="button" class="btn_green" onclick="set_pref(2)">SAVE & CREATE NEW WORK ORDER</button> &nbsp &nbsp
    <button type="button" class="btn_green" onclick="back_alret()">BACK</button>
</section>
</form>
</section>


<!-- <script>
  $(document.body).on('change', '[start_date_from]', function() {
    var d = new Date();
    var month = d.getMonth()+1;
var day = d.getDate();

var year = d.getFullYear();
var g1 =  month+ '/' +day+ '/' +year;
var g2 =  $(this).val();
var curr1 = new Date(g1);
var curr2 = new Date(g2);


    

  
    if (curr1.getTime() > curr2.getTime()) {
      alert("Please enter the valid date!. Date should not be less than current date")
      $('[start_date_from]').val("");
     
    }
  });

  
</script> -->



<script>
    // $(document).ready(function() {

    //   $(function() {
    //     $( "[data-date-picker]" ).datepicker({
    //          minDate: 0
    //     });
    //   });
    // })

    $(document.body).on('change', '[name="follow_up_description"]', function() {
      if ($(this).val()=="") {
        $('[name="next_follow_up_date"]').prop('required', false)
    }else{

        $('[name="next_follow_up_date"]').prop('required', true)
    }

})


    

    function back_alret(){
        if(confirm('Are you Sure ?')){
            window.history.back();
        }
    }
</script>

<script type="text/javascript">
  var yard_status = {
    yard_status: 1
}
get_maintenace_yard(yard_status).then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="` + item.id + `">` + item.name + `</option>`;
      })
        $('[name="yard_id"]').html(options);
    }
}
})
</script>

<script type="text/javascript">
  var vendor_status = {
    vendor_status: 1
}
get_maintenace_vendors(vendor_status).then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="` + item.id + `">` + item.name + `</option>`;
      })
        $('[name="vendor_id"]').html(options);
    }
}
})
</script>

<script type="text/javascript">
  get_states().then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="` + item.id + `">` + item.name + `</option>`;
      })
        $('[name="vendor_state_id"]').html(options);
    }
}
})
</script>

<script type="text/javascript">
  function show_cities(param) {
    if (param.state_id === '') {
      $('[name="vendor_city_id"]').html('');
  } else if (param.state_id !== '') {
      get_cities(param).then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options += `<option value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
            $('[name="vendor_city_id"]').html(options);
        }
    }
    else {
      var options = "";
      options += `<option value="">- - Select - -</option>`
      $('[name="vendor_city_id"]').html(options);
  }
}).catch(function(err) {
        // Run this when promise was rejected via reject()
    })
}
}

$(".removereq").prop('required', false)
$('.mode1').prop('selectedIndex',0).prop('disabled', true);
$('.mode2').val('').prop('disabled', true);
$('.mode3').val('').prop('disabled', true);
$('.mode0').val('').prop('disabled', true);
$(document.body).on('change', '#order_stage_id' ,function() {
    $(".removereq").prop('required', false)
    $('.mode1').val('').prop('disabled', true);
    $('.mode2').val('').prop('disabled', true);
    $('.mode3').val('').prop('disabled', true);
    $('.mode0').val('').prop('disabled', true);
    var value = $(this).val();
if (value === "1") {
  $(".removereq").prop('required', true)
  $('.mode1').val('').prop('disabled', false);
  $('.mode2').val('').prop('disabled', false);
  $('.mode3').val('').prop('disabled', false);
  $('.mode0').val('').prop('disabled', true);
} else if(value == 10) {
  $(".removereq").prop('required', false)
  $('.mode1').val('').prop('disabled', true);
  $('.mode2').val('').prop('disabled', true);
  $('.mode3').val('').prop('disabled', true);
  $('.mode0').val('').prop('disabled', false);
} else if (value === "") {
  $(".removereq").prop('required', false)
  $('.mode1').val('').prop('disabled', true);
  $('.mode2').val('').prop('disabled', true);
  $('.mode3').val('').prop('disabled', true);
  $('.mode0').val('').prop('disabled', true);
  }
});

</script>





<script type="text/javascript">
    var url_params = get_params();
    if (url_params.hasOwnProperty('class_id') && url_params.class_id === "UNSCHEDULE") {
        var set_attr = true;
        if (set_attr) {
            $(".jbr").removeAttr('required')
        }
    }
    if (url_params.hasOwnProperty('reference_name')) {
        $('[name="reference_name"]').val(url_params.reference_name);
    }
    if (url_params.hasOwnProperty('reference_id')) {
        $('[name="reference_id"]').val(url_params.reference_id);
    }
    if (url_params.hasOwnProperty('reference_rowid')) {
        $('[name="reference_rowid"]').val(url_params.reference_rowid);
    }
</script>
<script type="text/javascript">
    var return_to = 0

    function set_pref(val) {
        return_to = val;
        $('[data-submit]').trigger('click');
    }
</script>
<script type="text/javascript">
    get_repair_order_class().then(function(data) {
        if (data.status) {
            if (data.response.list) {
                var options = "";
                options += `<option value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option value="` + item.id + `">` + item.name + `</option>`;
                })
                $('[name="order_class_id"]').html(options);
                if (url_params.hasOwnProperty('class_id')) {
                    $("[name='order_class_id'] option[value=" + url_params.class_id + "]").prop('selected', true);
                }
            }
        }
    })
</script>
<script type="text/javascript">
    function show_status_filter() {
        get_repair_order_status().then(function(data) {
            if (data.status) {
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('[name="order_status_id"]').html(options);
                }
            }
        }).catch(function(err) {})
    }
    show_status_filter()
</script>


<script type="text/javascript">
    get_repair_order_type().then(function(data) {
        if (data.status) {
            if (data.response.list) {
                var options = "";
                var class_get_name = '<?php print_r($_GET['class_id']); ?>';
                var url_params = get_params();

                options += `<option value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {

                    if(item.status == 'ACTIVE')
                    {
                        if (url_params.class_id == 'SCHEDULE' && item.class_name == 'Schedule' )
                        {
                          options += `<option value="` + item.id + `">` + item.name + `</option>`;
                      }

                      if (url_params.class_id == 'UNSCHEDULE' && item.class_name == 'Unschedule' )
                      {
                         options += `<option value="` + item.id + `">` + item.name + `</option>`;
                     } 

                     if (url_params.class_id == '' )
                     {
                         options += `<option value="` + item.id + `">` + item.name + `</option>`;
                     }
                 }
             })
                $('[name="order_type_id"]').html(options);
                $('[name="order_type_id"]').prop('disabled',false); 

                if (url_params.hasOwnProperty('order_type_id')) {
                    $("[name='order_type_id'] option[value=" + url_params.order_type_id + "]").prop('selected', true);
                    $('[name="order_type_id"]').prop('disabled',true); 
                }
            }
        }
    })
</script>
<script type="text/javascript">
    get_repair_order_stage().then(function(data) {
        if (data.status) {
            if (data.response.list) {
                var options = "";
                options += `<option value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                 if(item.status == 'Active'){


                    options += `<option value="` + item.id + `">` + item.name + `</option>`;
                }
            })
                $('[name="order_stage_id"]').html(options);
            }
        }
    })
</script>
<script type="text/javascript">
    quick_list_drivers().then(function(data) {
        if (data.status) {
            if (data.response.list) {
                var options = "";
                options += `<option value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                   if(item.status == 'Active'){
                    options += `<option value="` + item.id + `">` + item.code + ' ' + item.name + `</option>`;
                }
            })
                $('[name="driver_id"]').html(options);
                $('[name="driver_id"]').prop('disabled',false); 
                if (url_params.hasOwnProperty('driver_id')) {
                    $("[name='driver_id'] option[value=" + url_params.driver_id + "]").prop('selected', true);
                    $('[name="driver_id"]').prop('disabled',true); 
                }
            }
        }
    })
</script>
<script type="text/javascript">
    get_vehicles().then(function(data) {
        if (data.status) {
            if (data.response.list) {
                var options = "";
                options += `<option value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option value="` + item.id + `">` + item.name + `</option>`;
                })
                $('[name="unit_type_id"]').html(options);
                if (url_params.hasOwnProperty('vehicle_type')) {
                    $("[name='unit_type_id'] option[value=" + url_params.vehicle_type + "]").prop('selected', true);
                    show_unit_filter({
                        unit_type_id: url_params.vehicle_type
                    })
                }
            }
        }
    })
</script>
<script type="text/javascript">
    function show_unit_filter(param) {
        var options = "";
        if (param.unit_type_id == 'TRUCK') {
            quick_list_trucks().then(function(data) {
                if (data.status) {
                    if (data.response.list) {
                        options += `<option value="">- - Select - -</option>`
                        $.each(data.response.list, function(index, item) {
                            options += `<option value="` + item.id + `">` + item.code + `</option>`;
                        })
                        $('[name="unit_id"]').html(options);
                        if (url_params.hasOwnProperty('vehicle_id')) {
                            $("[name='unit_id'] option[value=" + url_params.vehicle_id + "]").prop('selected', true);
                        }
                    }
                }
            }).catch(function(err) {})
        } else if (param.unit_type_id == 'TRAILER') {
            quick_list_trailers().then(function(data) {
                if (data.status) {
                    if (data.response.list) {
                        var options = "";
                        options += `<option value="">- - Select - -</option>`
                        $.each(data.response.list, function(index, item) {
                            options += `<option value="` + item.id + `">` + item.code + `</option>`;
                        })
                        $('[name="unit_id"]').html(options);
                        if (url_params.hasOwnProperty('vehicle_id')) {
                            $("[name='unit_id'] option[value=" + url_params.vehicle_id + "]").prop('selected', true);
                        }
                    }
                }
            }).catch(function(err) {})
        }
    }
</script>
<script type="text/javascript">
    var counter = 1
    var $issue_table = $('#issue_table');

    function add_row() {
        ++counter;
        var $add_rowissue = `<tr id="issue_row${counter}"  data-stop-row>
        <td class="counter">${counter}</td>
        <td><select class="w-150" name="category_id" required></select></td>
        <td><select class="w-150" name="criticality_level_id" required></select></td>`;
        if (set_attr) {
            $add_rowissue += `<td><select class="w-150 jbr" name="job_work_id"></select></td>`;
        } else {
            $add_rowissue += `<td><select class="w-150" name="job_work_id" required></select></td>`;
        }
        $add_rowissue += `<td><input type="text" class="w-150" name="issue_reported" required></td>
        <td><input type="text" class="w-150" name="issue_description" required></td>
        <td><button type="button" class="btn_red_c" data-remove-stop-button=""><i class="fa fa-trash"></i></button></td>
        </tr>`;
        $('#issue_table').append($add_rowissue);
        show_repair_order_category('issue_row' + counter)
        show_repair_order_criticality_level('issue_row' + counter)
        show_repair_order_job_work('issue_row' + counter)
    }
    $(document.body).on('click', '[data-remove-stop-button=""]', function() {

        $(this).parent().parent().remove();
        counter = 1;
        $('.counter').each(function(index,item){
          counter= counter+1;
          $(this).html(counter)
      })
    });
    //-----------/remove stop
</script>
<script type="text/javascript">
    function show_repair_order_category(row_id) {
        get_repair_order_category().then(function(data) {
            
            if (data.status) {
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if(item.status == 'ACTIVE'){
                            options += `<option value="` + item.id + `">` + item.name + `</option>`;
                        }
                    })
                    $('tr#' + row_id + ' [name="category_id"]').html(options);
                }
            }
        }).catch(function(err) {})
    }
    show_repair_order_category('issue_row1')
</script>
<script type="text/javascript">
    function show_repair_order_criticality_level(row_id) {
        get_repair_order_criticality_level().then(function(data) {
            if (data.status) {
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="` + item.id + `">` + item.name + `</option>`;
                    })
                    $('tr#' + row_id + ' [name="criticality_level_id"]').html(options);
                }
            }
        }).catch(function(err) {})
    }
    show_repair_order_criticality_level('issue_row1')
</script>
<script type="text/javascript">
    function show_repair_order_job_work(row_id) {
        get_job_work().then(function(data) {
            if (data.status) {
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if(item.status == 'ACTIVE'){
                            options += `<option value="` + item.id + `">` + item.name + `</option>`;
                        }
                    })
                    $('tr#' + row_id + ' [name="job_work_id"]').html(options);
                }
            }
        }).catch(function(err) {})
    }
    show_repair_order_job_work('issue_row1')
</script>
<script type="text/javascript">
    function add_new() {
        show_processing_modal()
        submit_to_wait_btn('#submit', 'loading')
        $('#formErro').show()
        var form = document.getElementById('MyForm');
        var isValidForm = form.checkValidity();
        var currentForm = $('#MyForm')[0];
        var formData = new FormData(currentForm);
        if (isValidForm) {
            var arr = $('#MyForm').serializeArray();
            var $issue_rows = $("[data-stop-row]");
            issues_array = []
            $issue_rows.each(function(index) {
                var $data_stop_row = $(this);
                var stop_row = {
                    category_id: $data_stop_row.find('[name="category_id"]').val(),
                    criticality_level_id: $data_stop_row.find('[name="criticality_level_id"]').val(),
                    job_work_id: $data_stop_row.find('[name="job_work_id"]').val(),
                    issue_reported: $data_stop_row.find('[name="issue_reported"]').val(),
                    issue_description: $data_stop_row.find('[name="issue_description"]').val()
                }
                issues_array.push(stop_row)
            })
            var obj = {
                class_id: $('[name="order_class_id"]').val(),
                unit_type_id: $('[name="unit_type_id"]').val(),
                unit_id: $('[name="unit_id"]').val(),
                driver_id: $('[name="driver_id"]').val(),
                type_id: $('[name="order_type_id"]').val(),
                stage_id: $('[name="order_stage_id"]').val(),
                start_date: $('[name="order_start_date"]').val(),
                start_time: $('[name="order_start_time"]').val(),
                contact_person: $('[name="contact_person"]').val(),
                contact_no: $('[name="contact_no"]').val(),
                follow_up_description: $('[name="follow_up_description"]').val(),
                next_follow_up_date: $('[name="next_follow_up_date"]').val(),
                issues: issues_array,
                reference_name:$('[name="reference_name"]').val(),
                reference_id:$('[name="reference_id"]').val(),
                reference_rowid:$('[name="reference_rowid"]').val(),
                vendor_id: $('[name="vendor_id"]').val(),
                vendor_state_id: $('[name="vendor_state_id"]').val(),
                vendor_city_id: ($('[name="vendor_city_id"]').val() !== null) ? $('[name="vendor_city_id"]').val() : '',

                yard_id: $('[name="yard_id"]').val(),
            }

            $.ajax({
                url: window.location.pathname + '-action',
                type: 'POST',
                data: obj,
                success: function(data) {
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                    }
                    alert(data.message);
                    if (data.status) {
                        if (return_to == 0) {
                            window.history.back();
                        } else if (return_to == 1) {
                            location.href = '../user/maintenance/repair-orders/documents?eid=' + data.response.new_eid;
                        } else if (return_to == 2) {
                            location.href = '../user/maintenance/work-orders/add-new?ro-eid=' + data.response.new_eid;
                        }
                        wait_to_submit_btn('#submit', 'SAVE')
                    } else {
                        wait_to_submit_btn('#submit', 'SAVE')
                    }
                    hide_processing_modal();
                }
            })
        }
        return false
    }
</script>


<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>