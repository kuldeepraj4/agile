<?php 

require_once APPROOT . '/views/includes/user/header.php';

?>

<style>
/* Tooltip container */
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;
 
  /* Position the tooltip text - see examples below! */
  position: absolute;
  z-index: 1;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>

<br><br>

<section class="list-200 content-box" style="margin: auto;max-width: 1400px">

  <h1 class="list-200-heading">Incident List</h1>

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
      <select data-filter="status_id" onchange="set_params('status_id', this.value), show_list(this.value)"></select>
    </div>

      <div class="filter-item">

        <label>Incident ID</label>

        <input type="text" data-filter="incident_id" onkeyup="set_params('incident_id', this.value), show_list(this.value)">

      </div>

      <div class="filter-item">
        <label>Incident Date</label>
        <input style="width: 136px" incident-date-from type="text" data-filter="incident_date_from" data-date-picker onchange="set_params('incident_date_from', this.value), goto_page(1)">
        </input> - 
        <input style="width: 136px" incident-date-to type="text" data-filter="incident_date_to" data-date-picker onchange="set_params('incident_date_to', this.value), goto_page(1)">
        </input>
      </div>

      <div class="filter-item">

        <label>State</label>

        <select data-filter="state_id" onchange="set_params('state_id', this.value),
        set_params('city_id', ''),goto_page(1) 
        show_list(this.value),
        show_cities({state_id:this.value})
        ">

      </select>

    </div>

    <div class="filter-item">

      <label>Driver ID</label>
      <input type="text" data-filter="driver_id" list="quick_list_driver_id" data-driver-id>
      </select>

    </div>

    <div class="filter-item">
      <label>City</label>
      <select data-filter="city_id" onchange="set_params('city_id', this.value), show_list(this.value)"></select>
    </div>

    <div class="filter-item">
      <label>Truck ID</label>
        <input type="text" data-filter="truck_id" list="quick_list_truck_id" data-truck-id>
      </select>
    </div>

    <div class="filter-item">
      <label>Trailer ID</label>
      <input type="text" data-filter="trailer_id" list="quick_list_trailer_id" data-trailer-id>
    </div>

    <div class="filter-item">

      <label>Load Terminal</label>

      <select data-filter="load_terminal_id" onchange="set_params('load_terminal_id', this.value), show_list(this.value)">

      </select>

    </div>

    <div class="filter-item">

      <label>Driver Terminal</label>

      <select data-filter="driver_terminal_id" onchange="set_params('driver_terminal_id', this.value), show_list(this.value)">

      </select>

    </div>

    <div class="filter-item">
        <label>Followup Date</label>
        <input style="width: 136px" followup-date-from type="text" data-filter="followup_date_from" data-date-picker onchange="set_params('followup_date_from', this.value), goto_page(1)">
        </input> - 
        <input style="width: 136px" followup-date-to type="text" data-filter="followup_date_to" data-date-picker onchange="set_params('followup_date_to', this.value), goto_page(1)">
        </input>
      </div>

    <div class="filter-item">
      <label>Followup Added By</label>
      <input type="text" data-filter="followup_added_by_id" list="quick_list_user_id" data-followup-added-by-id>
      </select>
    </div>


    <!-- <div class="filter-item">
      <label>Claim No</label>
        <input type="text" data-filter="claim_no" list="quick_list_claim_no" data-claim-no onkeyup="set_params('claim_no', this.value), show_list(this.value)">
      </select>
    </div> -->

    <div class="filter-item">
      <label>Load ID</label>
      <input type="text" data-filter="load_id" list="quick_list_load_id" data-load-id onkeyup="set_params('load_id', this.value), show_list(this.value)">
    </div>

    <div class="filter-item">
        <label>Claim Details</label>
        <input type="text" data-filter="claim_no" placeholder="ID / Name / Contact No." list="quick_list_claim_no" data-claim-no onkeyup="set_params('claim_no', this.value), show_list(this.value)">
    </div>

    <!-- <div class="filter-item">
        <label>Claim No</label>
        <select name="claim_no" data-filter="claim_no" onchange="set_params('claim_no', this.value), show_list(this.value)"></select>
    </div> -->

  </div>

  <div class="list-200-top-action-right">

    <div>

      <?php

      if (in_array('P0278', USER_PRIV)) {

        echo "<button class='btn_grey button_href'><a href='../user/maintenance/incidents/add-new'>Add New</a></button>";
      }

      ?>

    </div>

  </div>

</section>

<div class="table  table-a">
  <input type='hidden' id='sort' value='asc'>

  <table data-ro-table>

    <thead>

        <th>Sr. No.</th>
        <!-- <th>Sr No</th> -->
        <th data-table-sort-by="id" >Incident ID</th>

        <th data-table-sort-by="incident_date" >Incident Date</th>

        <th data-table-sort-by="in_reported_date">Date Reported</th>

        <th>Load Terminal</th>

        <th>Driver ID</th>

        <th>Driver Name</th>

        <th>Driver Terminal</th>

        <th data-table-sort-by="in_truck">Truck ID</th>

        <th data-table-sort-by="in_trailer">Trailer ID</th>

        <th>Accident Address</th>

        <th>State</th>

        <th>City</th>

        <th>Status</th>

        <th>Cargo Claim</th>

        <th>Physical Damage</th>

        <th>Third Party Damage</th>

        <th>Other Party Details</th>

        <th>Created By</th>
        <th>Updated By</th>
        <th>Closed By</th>
        <th>Last Follow Up</th>
        <th data-table-sort-by="in_next_follow_up_datetime">Next Follow Up Date</th>
        <th>Follow Added By</th>

        <th>Actions</th>

      </tr>

    </thead>

    <tbody id="tabledata"></tbody>

  </table>
</div>
<div data-pagination></div>

</section>

    <datalist id="quick_list_driver_id"></datalist>
    <script type="text/javascript">
      $(document.body).on('input', '[data-driver-id]' ,function(){
        id_selected=$(`[data-driver-id-rows="${$(this).val()}"]`).data('value');
        if(id_selected!=undefined){
         $(this).data('driver-id', id_selected)
         set_params('driver_id', id_selected)
         set_params('driver_code', $(`[data-driver-id]`).val())
         goto_page(1)
       }
     });

      $(document.body).on('change', '[data-driver-id]' ,function(){
       id_selected=$(`[data-driver-id-rows="${$(this).val()}"]`).data('value');
       if(id_selected==undefined){
        alert("Please enter correct Driver ID")
        id_selected=''
        set_params('driver_id', '')
        set_params('driver_code', '')
        goto_page(1)
        $(this).val('')
        $(this).focus()
      }
    });

      quick_list_drivers().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options+=`<option data-driver-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-driver-id-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" value="`+ item.code + ' ' + item.name + `"></option>`;

            })
            $('#quick_list_driver_id').html(options);
            if (url_params.hasOwnProperty('driver_code')) 
            {
              $(`[data-driver-id]`).val(check_url_params('driver_code'))
            }
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    </script>

<datalist id="quick_list_truck_id"></datalist>
<script type="text/javascript">
  $(document.body).on('input', '[data-truck-id]' ,function(){
   id_selected=$(`[data-truck-id-rows="${$(this).val()}"]`).data('value');
   if(id_selected!=undefined){
     $(this).data('truck-id', id_selected)
     set_params('truck_id', id_selected)
     set_params('truck_code', $(`[data-truck-id]`).val())
     goto_page(1)
   }
 });

  $(document.body).on('change', '[data-truck-id]' ,function(){
   id_selected=$(`[data-truck-id-rows="${$(this).val()}"]`).data('value');
   if(id_selected==undefined){
    alert("Please enter correct Truck ID")
    id_selected=''
    set_params('truck_id', '')
    set_params('truck_code', '')
    goto_page(1)
    $(this).val('')
    $(this).focus()
  }
});
  
  quick_list_trucks().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options+=`<option data-truck-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-truck-id-rows="`+item.code+`" data-value="${item.id}" value="`+item.code+`"></option>`;
            })
            $('#quick_list_truck_id').html(options);
            if (url_params.hasOwnProperty('truck_code')) {
              $(`[data-truck-id]`).val(check_url_params('truck_code'))
            }
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    </script>

    <datalist id="quick_list_trailer_id"></datalist>
    <script type="text/javascript">
      $(document.body).on('input', '[data-trailer-id]' ,function(){
       id_selected=$(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
       if(id_selected!=undefined){
         $(this).data('trailer-id', id_selected)
         set_params('trailer_id', id_selected)
         set_params('trailer_code', $(`[data-trailer-id]`).val())
         goto_page(1)
       }
     });

      $(document.body).on('change', '[data-trailer-id]' ,function(){
       id_selected=$(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
       if(id_selected==undefined){
        alert("Please enter correct Trailer ID")
        id_selected=''
        set_params('trailer_id', '')
        set_params('trailer_code', '')
        goto_page(1)
        $(this).val('')
        $(this).focus()
      }
    });

      quick_list_trailers().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options+=`<option data-trailer-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-trailer-id-rows="` + item.code + `" data-value="${item.id}" value="` + item.code + `"></option>`;
            })
            $('#quick_list_trailer_id').html(options);
            if (url_params.hasOwnProperty('trailer_code')) {
              $(`[data-trailer-id]`).val(check_url_params('trailer_code'))
            }
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    </script>

    <datalist id="quick_list_user_id"></datalist>
    <script type="text/javascript">
      $(document.body).on('input', '[data-followup-added-by-id]' ,function(){
       id_selected=$(`[data-followup-added-by-id-rows="${$(this).val()}"]`).data('value');
       if(id_selected!=undefined){
         $(this).data('followup-added-by-id', id_selected)
         set_params('followup_added_by_id', id_selected)
         set_params('followup_added_by_code', $(`[data-followup-added-by-id]`).val())
         goto_page(1)
       }
     });

      $(document.body).on('change', '[data-followup-added-by-id]' ,function(){
       id_selected=$(`[data-followup-added-by-id-rows="${$(this).val()}"]`).data('value');
       if(id_selected==undefined){
        alert("Please enter correct User ID")
        id_selected=''
        set_params('followup_added_by_id', '')
        set_params('followup_added_by_code', '')
        goto_page(1)
        $(this).val('')
        $(this).focus()
      }
    });

      quick_list_users().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options+=`<option data-followup-added-by-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-followup-added-by-id-rows="` + item.name + `" data-value="${item.id}" value="` + item.name + `"></option>`;
            })
            $('#quick_list_user_id').html(options);
            if (url_params.hasOwnProperty('followup_added_by_id')) {
              $(`[data-followup-added-by-id]`).val(check_url_params('followup_added_by_id'))
              //$("[data-followup-added-by-id] option[value=" + url_params.followup_added_by_id + "]").prop('selected', true);
            }
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    </script>

    <script>
      $(document.body).on('change', '[incident-date-from]', function() {
        var g1 = new Date(check_url_params('incident_date_from'))
        var g2 = new Date(check_url_params('incident_date_to'))
        if (g1.getTime() > g2.getTime()) {
          alert("Please enter the valid date!. Incident From Date should be less than Incident To Date")
          $("[data-filter='incident_date_from']").val("");
          set_params('incident_date_from', "")
          goto_page(1)
          $(this).val('')
          $(this).focus()
        }
      });

      $(document.body).on('change', '[incident-date-to]', function() {
        var g1 = new Date(check_url_params('incident_date_from'))
        var g2 = new Date(check_url_params('incident_date_to'))
        if (g1.getTime() > g2.getTime()) {
          alert("Please enter the valid date!. Incident To Date should be greater than Incident From Date")
          $("[data-filter='incident_date_to']").val("");
          set_params('incident_date_to', "")
          goto_page(1)
          $(this).val('')
          $(this).focus()
        }
      });
    </script>

    <script>
      $(document.body).on('change', '[followup-date-from]', function() {
        var g1 = new Date(check_url_params('followup_date_from'))
        var g2 = new Date(check_url_params('followup_date_to'))
        if (g1.getTime() > g2.getTime()) {
          alert("Please enter the valid date!. Followup From Date should be less than Followup To Date")
          $("[data-filter='followup_date_from']").val("");
          set_params('followup_date_from', "")
          goto_page(1)
          $(this).val('')
          $(this).focus()
        }
      });

      $(document.body).on('change', '[followup-date-to]', function() {
        var g1 = new Date(check_url_params('followup_date_from'))
        var g2 = new Date(check_url_params('followup_date_to'))
        if (g1.getTime() > g2.getTime()) {
          alert("Please enter the valid date!. Followup To Date should be greater than Followup From Date")
          $("[data-filter='followup_date_to']").val("");
          set_params('followup_date_to', "")
          goto_page(1)
          $(this).val('')
          $(this).focus()
        }
      });
    </script>

    <!-- get param without function -->
    <script type="text/javascript">
      var url_params = get_params();
      if (url_params.hasOwnProperty('incident_id')) {
        $("[data-filter='incident_id']").val(url_params.incident_id);
      }
      if (url_params.hasOwnProperty('status_id')) {
        $("[data-filter='status_id']").val(url_params.status_id);
      }
    </script>
    <!-- get param without function -->

    <!-- get param without -->
      <script type="text/javascript">
        var url_params = get_params();
        if (url_params.hasOwnProperty('claim_no')) {
          $("[data-filter='claim_no']").val(url_params.claim_no);
        }
        if (url_params.hasOwnProperty('load_id')) {
          $("[data-filter='load_id']").val(url_params.load_id);
        }
        if (url_params.hasOwnProperty('incident_date_from')) {
          $("[data-filter='incident_date_from']").val(url_params.incident_date_from);
        }
        if (url_params.hasOwnProperty('incident_date_to')) {
          $("[data-filter='incident_date_to']").val(url_params.incident_date_to);
        }
        if (url_params.hasOwnProperty('followup_date_from')) {
          $("[data-filter='followup_date_from']").val(url_params.followup_date_from);
        }
        if (url_params.hasOwnProperty('followup_date_to')) {
          $("[data-filter='followup_date_to']").val(url_params.followup_date_to);
        }
      </script>
      <script type="text/javascript">
      function show_claim_filter(param) {
        get_claim_type_list().then(function(data) {
          // Run this when your request was successful
          if (data.status) {
            //Run this if response has list
            if (data.response.list) {
              var options = "";
              options += `<option value="">- - Select - -</option>`
              $.each(data.response.list, function(index, item) {
                options += `<option value="` + item.id + `">` + item.name + `</option>`;
              })
              $('[data-filter="claim_no"]').html(options);
              select_default('[data-filter="claim_no"]');
              if (url_params.hasOwnProperty('claim_no')) {
                $("[data-filter='claim_no'] option[value=" + url_params.claim_no + "]").prop('selected', true);
              }
            }
          }
        }).catch(function(err) {
          // Run this when promise was rejected via reject()
        })
      }
      show_claim_filter()
    </script>
  <!-- get param without function -->

    <script type="text/javascript">
      function show_list() {
        let url_params = get_params()
        var sort_by = $('#sort_by').val();
        var sort_by_order_type = $('#sort').val();

        if (url_params.hasOwnProperty('claim_no')) {
          var claim_no = url_params.claim_no;
        } else {
          var claim_no = $('[data-filter="claim_no"]').val();
        }
        if (url_params.hasOwnProperty('load_id')) {
          var load_id = url_params.load_id;
        } else {
          var load_id = $('[data-filter="load_id"]').val();
        }


        if (url_params.hasOwnProperty('incident_id')) {
          var incident_id = url_params.incident_id;
        } else {
          var incident_id = $('[data-filter="incident_id"]').val();
        }
        if (url_params.hasOwnProperty('status_id')) {
          var status_id = url_params.status_id;
        } else {
          var status_id = $('[data-filter="status_id"]').val();
        }
        if (url_params.hasOwnProperty('state_id')) {
          var state_id = url_params.state_id;
        } else {
          var state_id = $('[data-filter="state_id"]').val();
        }
        if (url_params.hasOwnProperty('city_id')) {
          var city_id = url_params.city_id;
        } else {
          var city_id = $('[data-filter="city_id"]').val();
        }
        if (url_params.hasOwnProperty('driver_id')) {
          var driver_id = url_params.driver_id;
        } else {
          var driver_id = $('[data-filter="driver_id"]').val();
        }
        if (url_params.hasOwnProperty('truck_id')) {
          var truck_id = url_params.truck_id;
        } else {
          var truck_id = $('[data-filter="truck_id"]').val();
        }
        if (url_params.hasOwnProperty('trailer_id')) {
          var trailer_id = url_params.trailer_id;
        } else {
          var trailer_id = $('[data-filter="trailer_id"]').val();
        }
        if (url_params.hasOwnProperty('load_terminal_id')) {
          var load_terminal_id = url_params.load_terminal_id;
        } else {
          var load_terminal_id = $('[data-filter="load_terminal_id"]').val();
        }
        if (url_params.hasOwnProperty('driver_terminal_id')) {
          var driver_terminal_id = url_params.driver_terminal_id;
        } else {
          var driver_terminal_id = $('[data-filter="driver_terminal_id"]').val();
        }
        if (url_params.hasOwnProperty('followup_date_from')) {
          var followup_date_from = url_params.followup_date_from;
        } else {
          var followup_date_from = $('[data-filter="followup_date_from"]').val();
        }
        if (url_params.hasOwnProperty('followup_date_to')) {
          var followup_date_to = url_params.followup_date_to;
        } else {
          var followup_date_to = $('[data-filter="followup_date_to"]').val();
        }
        if (url_params.hasOwnProperty('followup_added_by_id')) {
          var followup_added_by_id = url_params.followup_added_by_id;
        } else {
          var followup_added_by_id = $('[data-filter="followup_added_by_id"]').val();
        }
        if (url_params.hasOwnProperty('incident_date_from')) {
          var incident_date_from = url_params.incident_date_from;
        } else {
          var incident_date_from = $('[data-filter="incident_date_from"]').val();
        }
        if (url_params.hasOwnProperty('incident_date_to')) {
          var incident_date_to = url_params.incident_date_to;
        } else {
          var incident_date_to = $('[data-filter="incident_date_to"]').val();
        }

        var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;

        var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;

        var webapi = "pagination";


        $.ajax({

          url: location.pathname + '-ajax',

          type: 'POST',

          data: {

            page: page_no,
            batch: batch,
            sort_by_order_type:sort_by_order_type,
            sort_by: sort_by,
            incident_id: incident_id,
            status_id: status_id,
            state_id: state_id,
            city_id: city_id,
            driver_id: driver_id,
            truck_id: truck_id,
            trailer_id: trailer_id,
            load_terminal_id: load_terminal_id,
            driver_terminal_id: driver_terminal_id,
            followup_date_from: followup_date_from,
            followup_date_to: followup_date_to,
            followup_added_by_id: followup_added_by_id,
            incident_date_from: incident_date_from,
            incident_date_to: incident_date_to,
            webapi:  webapi,
            claim_no: claim_no,
            load_id: load_id,

          },
          beforeSend:function(){
            show_table_data_loading('[data-ro-table]')
          },
          success: function(data) {

            if ((typeof data) == 'string') {

              data = JSON.parse(data)

              console.log(data)

              $('#tabledata').html("");

              if (data.status) {

                var counter = 0;

                $.each(data.response.list, function(index, item) {
                  console.log(item)
                  counter++;

                  let desciptionsResult = item.in_last_follow_up.substring(0, 30);

                  var row = `<tr>

                  <td>${item.sr_no}</td>

                  <td>${item.id}</td>
                  `;

                  if (item.in_incident_date < '12/31/1799') {

                    row += `<td>${item.in_incident_date}</td>`;
                  }else{
                    row += `<td></td>`;
                  }

                 

                  if (item.in_reported_date < '12/31/1799') {

                    row += `<td>${item.in_reported_date}</td>`;
                  }else{
                    row += `<td></td>`;
                  }

                  row += `

                  <td>${item.in_load_terminal}</td>

                  <td>${item.in_driver_id}</td>

                  <td>${item.in_driver_name}</td>

                  <td>${item.in_driver_terminal}</td>

                  <td>${item.in_truck}</td>

                  <td>${item.in_trailer}</td>

                  <td style="white-space:nowrap">${item.in_accident_address}</td>

                  <td>${item.in_accident_state}</td>

                  <td>${item.in_accident_city}</td>

                  <td>${item.in_status}</td>


                  <td style="white-space:nowrap">${item.cargo_name} <br> ${item.cargo_adjusters_name} <br> ${item.cargo_adjusters_email} <br> ${item.cargo_adjusters_phone} </td>

                  <td style="white-space:nowrap">${item.physical_name} <br> ${item.physical_adjusters_name} <br> ${item.physical_adjusters_email} <br> ${item.physical_adjusters_phone} </td>

                  <td style="white-space:nowrap">${item.third_party_name} <br> ${item.third_party_adjusters_name} <br> ${item.third_party_adjusters_email} <br> ${item.third_party_adjusters_phone} </td>

                  <td style="white-space:nowrap">${item.other_party_claim_id} <br> ${item.other_party_adjusters_name} <br> ${item.other_party_adjusters_email} <br> ${item.other_party_adjusters_phone} </td>


                  <td>${item.in_added_by_code} - ${item.in_added_by_name}</td>
                  <td>${item.in_updated_by_code} - ${item.in_updated_by_name}</td>
                  <td>${item.in_closed_by_code} - ${item.in_closed_by_name}</td>

                  <td style="background-color:#fff0b3;width: 200px;text-align: left;cursor: pointer;">
                  <a class="btn_blue1" onclick="open_child_window({url:'../user/maintenance/incidents/add-followup&eid=${item.eid}',width:1000,height:600})">
                  <div class="tooltip">${desciptionsResult}
                  <span class="tooltiptext">Click On For Full Details</span>
                  </div> 
                  </a>
                  </td>

                  <td style="background-color:#fff0b3">${item.in_next_follow_up_datetime}</td>
                  <td style="background-color:#fff0b3">${item.in_last_follow_up_added_by_code} - ${item.in_last_follow_up_added_by_name}</td>

                  <td style="white-space:nowrap">`;

                  <?php

                  if (in_array('P0279', USER_PRIV)) {

                    ?>

                    row += `<button title="View" class="btn_grey_c"><a href="../user/maintenance/incidents/details?eid=${item.eid}"><i class="fa fa-eye"></i></a></button>`;

                    <?php
                  }
                  if (in_array('P0280', USER_PRIV)) {

                    ?>

                    row += `<button title="Edit" class="btn_grey_c"><a href="../user/maintenance/incidents/update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button>`;

                    <?php

                  }

                  if (in_array('P0279', USER_PRIV)) {
                    ?>
                    row+=`<button title="Upload/View Docs" class="btn_grey_c"><a href="../user/maintenance/incidents/documents&eid=${item.eid}"><i class="fa fa-file"></i></a></button>`; 
                    <?php
                  }

                  if (in_array('P0280', USER_PRIV)) 
                  {
                    ?>
                    row += `<button class="btn_blue" onclick="open_child_window({url:'../user/maintenance/incidents/add-followup&eid=${item.eid}',width:1000,height:600})">Follow Up</button>`;
                    <?php
                  }

                  if (in_array('P0281', USER_PRIV)) 
                  {
                    ?>
                    row += `<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="${item.eid}"><i class="fa fa-trash"></i></button>`;
                    <?php
                  } 
                  ?>
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
              } 
              else 
              {
                var false_message = `<tr><td colspan="15">` + data.message + `<td></tr>`;
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
    get_repair_order_status().then(function(data) {
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
          if (url_params.hasOwnProperty('status_id')) {
            $("[data-filter='status_id'] option[value=" + url_params.status_id + "]").prop('selected', true);
          } else {
            $("[data-filter='status_id'] option[value=OPEN]").prop('selected', true);
            //set_params('status_id', 'OPEN')
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_status_filter()
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
          if (url_params.hasOwnProperty('driver_id')) {
            $("[data-filter='driver_id'] option[value=" + url_params.driver_id + "]").prop('selected', true);
          }

        }

      }

    }).catch(function(err) {

      // Run this when promise was rejected via reject()

    })

  }

  show_drivers()
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

    quick_list_trucks().then(function(data) {

      // Run this when your request was successful

      if (data.status) {

        //Run this if response has list

        if (data.response.list) {

          var options = "";

          options += `<option value="">- - Select - -</option>`

          $.each(data.response.list, function(index, item) {

            options += `<option value="` + item.id + `">` + item.code + `</option>`;

          })

          $('[data-filter="truck_id"]').html(options);
          if (url_params.hasOwnProperty('truck_id')) {
            $("[data-filter='truck_id'] option[value=" + url_params.truck_id + "]").prop('selected', true);
          }

        }

      }

    }).catch(function(err) {

      // Run this when promise was rejected via reject()

    })

  }

  show_unit_filter()
</script>

<script type="text/javascript">
  function show_states() {
    get_states().then(function(data) {
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
          $('[data-filter="state_id"]').html(options);
           // get param with function start here by swaran -->
           if (url_params.hasOwnProperty('state_id')) {
            $("[data-filter='state_id'] option[value=" + url_params.state_id + "]").prop('selected', true);
            show_cities({
              state_id: url_params.state_id
            })
          }
        // get param with function end here by swaran -->
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
    if (param.state_id === '') {
      $('[data-filter="city_id"]').html('');
    } else if (param.state_id !== ''){
      get_cities(param).then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options += `<option value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              console.log(item)
              options += `<option value="` + item.id + `">` + item.name + `</option>`;
            })
            $('[data-filter="city_id"]').html(options);
            if (url_params.hasOwnProperty('city_id')) {
              $("[data-filter='city_id'] option[value=" + url_params.city_id + "]").prop('selected', true);
            }
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    }
  }
</script>

<script type="text/javascript">
  function load_terminal() {

    get_companies().then(function(data) {

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

          $('[data-filter="load_terminal_id"]').html(options);
          if (url_params.hasOwnProperty('load_terminal_id')) {
            $("[data-filter='load_terminal_id'] option[value=" + url_params.load_terminal_id + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  load_terminal()
</script>

<script type="text/javascript">
  function driver_terminal() {
    get_companies().then(function(data) {
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
          $('[data-filter="driver_terminal_id"]').html(options);
          if (url_params.hasOwnProperty('driver_terminal_id')) {
            $("[data-filter='driver_terminal_id'] option[value=" + url_params.driver_terminal_id + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  driver_terminal()
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

<script type="text/javascript">
  $(document).ready(function() {
    $(document).on("click", "[data-action='delete']", function() {
      if (confirm('Do you want to delete incident?')) {
        var eid = $(this).data("eid");

        $.ajax({
          url: window.location.origin+window.location.pathname+ '/delete-action',

          type: 'POST',
          data: {
            delete_eid: eid
          },  
          context: this,
          success: function(data) {
            if ((typeof data) == 'string') {
              data = JSON.parse(data)
            }
            if (data.status) {
              $(this).parent().parent().fadeOut();
              show_list();
              alert(data.message)
            } else {
              alert(data.message)
            }
          }
        })
      }
    });
  });
</script>

<?php

require_once APPROOT . '/views/includes/user/footer.php';

?>