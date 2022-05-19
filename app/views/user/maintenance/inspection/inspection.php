<?php

require_once APPROOT . '/views/includes/user/header.php';

?>



<br><br>

<section class="list-200 content-box" style="margin: auto;max-width: 1400px">

  <h1 class="list-200-heading">Inspection Entry</h1>

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
        <label>Status</label>
        <select data-filter="status_id" onchange="show_list(this.value)">
          <option>---SELECT---</option>
          <option value="open">Open</option>
          <option value="closed">Closed</option>
        </select>
      </div>
      <div class="filter-item">

        <label>Entered By</label>

        <select data-filter="entered_by_id" onchange="show_list(this.value)">

        </select>

      </div>
      <div class="filter-item">

        <label>Driver</label>

        <select data-filter="driver_id" onchange="show_list(this.value)">

        </select>

      </div>
      <div class="filter-item">

        <label>Truck No.</label>

        <select data-filter="truck_no_id" onchange="show_list(this.value)">

        </select>

      </div>
      <div class="filter-item">
        <label>Violation</label>
        <select data-filter="violation_id" onchange="show_list(this.value)">
          <option>---SELECT---</option>
          <option value="good_inspection">Good Inspection</option>
          <option value="fined">Fined</option>
          <option value="violation">Violation</option>
          <option value="warning">Warning</option>
          <option value="scale_ticket">Scale Ticket</option>
          <option value="out_of_service">Out of Service</option>
        </select>
      </div>
      <div class="filter-item">

        <label>Trailer No.</label>

        <select data-filter="trailer_no_id" onchange="show_list(this.value)">

        </select>

      </div>
      <div class="filter-item">
        <label>Company</label>
        <select data-filter="company_id" onchange="show_list(this.value)">

        </select>
      </div>
      <div class="filter-item">
        <label>Inspection date</label>
        <input type="text" data-filter="inspection_date" data-date-picker onkeyup="show_list(this.value)">
      </div>










      <div class="filter-item">

      </div>

    </div>

    <div class="list-200-top-action-right">

      <div>

        <?php

        if (in_array('P0266', USER_PRIV)) {

          echo "<button class='btn_grey button_href'><a href='../user/maintenance/inspection-entry/add-new'>Add New</a></button>";
        }

        ?>

      </div>

    </div>

  </section>



  <div class="table  table-a">

    <table>

      <thead>

        <tr>

          <th>Sr. No.</th>

          <th>Inspection ID</th>

          <th>Status</th>

          <th>Driver</th>

          <th>Driver ID</th>

          <th>Driver Lic No.</th>

          <th>Truck Name</th>

          <th>Truck VIN</th>

          <th>Trailer Name</th>

          <th>Trailer VIN</th>

          <th>Co Driver</th>
          <th>Co Driver ID</th>

          <th>Co Driver Lic No.</th>

          <th>Company</th>

          <th>Inspection date</th>

          <th>Location</th>

          <th>Time From</th>

          <th>Time To</th>

          <th>Violations Reported</th>
          <th>Fine Amount</th>
          <th>Bond Amount</th>
          <th>Contact No.</th>
          <th>Remarks</th>
          <th>Violation Against</th>
          <th>Day Count</th>
          <th>Enter By</th>
          <th>Doc Uploaded</th>

        </tr>

      </thead>

      <tbody id="tabledata"></tbody>

    </table>

  </div>

</section>



<script type="text/javascript">
  function show_list() {

    var sort_by = $('#sort_by').val();

    var status_id = $('[data-filter="status_id"]').val();

    var entered_by = $('[data-filter="entered_by"]').val();

    var driver_id = $('[data-filter="driver_id"]').val();
    var truck_no_id = $('[data-filter="truck_no_id"]').val();
    var violation_id = $('[data-filter="violation_id"]').val();
    var trailer_no_id = $('[data-filter="trailer_no_id"]').val();
    var company_id = $('[data-filter="company_id"]').val();
    var inspection_date = $('[data-filter="inspection_date"]').val();


    $.ajax({

        url: location.pathname + '-ajax',

        type: 'POST',

        data: {

          sort_by: sort_by,
          status_id: status_id,
          entered_by: entered_by,
          driver_id: driver_id,
          truck_no_id: truck_no_id,
          violation_id: violation_id,
          trailer_no_id: trailer_no_id,
          company_id: company_id,
          inspection_date: inspection_date,
        },

        success: function(data) {

          if ((typeof data) == 'string') {

            data = JSON.parse(data)

            //console.log(data)

            $('#tabledata').html("");

            if (data.status) {

              var counter = 0;

              $.each(data.response.list, function(index, item) {

                counter++;

                var row = `<tr>

             <td>${counter}</td>

             <td>${item.inspection_id}</td>
             <td>${item.status}</td>
             <td>${item.driver}</td>
             <td>${item.driver_id}</td>
             <td>${item.driver_lic_no}</td>
             <td>${item.truck_name}</td>
             <td>${item.truck_vin}</td>
             <td>${item.trailer_name}</td>
             <td>${item.trailer_vin}</td>
             <td>${item.co_driver}</td>
             <td>${item.co_driver_id}</td>
             <td>${item.co_driver_lic_no}</td>
             <td>${item.company}</td>
             <td>${item.inspection_date}</td>
             <td>${item.location}</td>
             <td>${item.time_from}</td>
             <td>${item.time_to}</td>
             <td>${item.violations_reported}</td>
             <td>${item.fine_amount}</td>
             <td>${item.bond_amount}</td>
             <td>${item.contact_no}</td>
             <td>${item.remarks}</td>
             <td>${item.violation_against}</td>
             <td>${item.day_count}</td>
             <td>${item.enter_by}</td>
             <td>${item.doc_uploaded}</td>
             <td style="white-space:nowrap">`;



                <?php if (in_array('P0268', USER_PRIV)) {

                ?>

                  row += `<button title="Edit" class="btn_grey_c"><a href="../user/maintenance/inspection-entry/update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button>`;

                <?php

                }

                if (in_array('P0269', USER_PRIV)) {

                ?>

                  row += `<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="${item.eid}"><i class="fa fa-trash"></i></button>`;

                <?php

                } ?>

                row += `</td> 

           </tr>`;

                $('#tabledata').append(row);

              })

            } else {

              var false_message = `<tr><td colspan="18">` + data.message + `<td></tr>`;

              $('#tabledata').html(false_message);
               if(check_url_params('page_no') > 1){
               goto_page(1);
                 }
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