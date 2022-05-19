<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1200px">
  <h1 class="list-200-heading">Location Addresses</h1>
  <section class="list-200-top-action">
    <div class="list-200-top-action-left">
      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
      <input type='hidden' id='sort' value='asc'>
      <!-- //input used for sory by call-->
      <div class="filter-item-full">
        <label>Search</label>
        <input type="text" placeholder="ID/ Name/ City/ State" data-filter="search" onkeyup="set_params('page_no', 1);show_list()">
        </select>
      </div>
      <div class="filter-item-full">
        <label style="margin-left:30px;">Location Type</label>
        <select data-filter="location_type" onchange="set_params('location_type', this.value), goto_page(1)">
          <option value="">--- Select ---</option>
          <option value="ALL">All</option>
          <option value="STOP OFF">Stop Off</option>
          <option value="ADDRESSES">Addresses</option>
        </select>
      </div>
    </div>
    <div class="list-200-top-action-right">
      <div>
        <?php
        if (in_array('P0240', USER_PRIV)) {
          // echo "<span style='cursor:pointer;margin-right:10px;' class='btn_green' data-add-city style='width:150px;height:40px;'>Add New Stop Off</span>";

           echo "<button class='btn_grey button_href' style='margin-right:10px;' onclick='update_locations()'><a>Update Locations</a></button>";
         }
            if (in_array('P0238', USER_PRIV)) {
          echo "<button class='btn_grey button_href' style='margin-right:10px;' data-add-city><a>Add New Stop Off</a></button>";
        }
        ?>
        <?php
        if (in_array('P0238', USER_PRIV)) {
          echo "<button class='btn_grey button_href'><a href='../user/masters/locations/location-addresses/add-new'>Add New</a></button>";
        }
        ?>
      </div>
    </div>
  </section>
  <div class="table  table-a">
    <table data-table-td-counter>
      <thead>
        <tr>
          <th>Sr No</th>
          <th style="text-align:left;">ID</th>
          <th data-table-sort-by="name" style="text-align:left;">Location Name</th>
          <th style="text-align:left;">Address Line</th>
          <th style="text-align:left;">City, State, Zipcode</th>
          <th style="text-align:left;">City</th>
          <th style="text-align:left;">State</th>
          <th style="text-align:left;">State mini code</th>
          <th style="text-align:left;">zipcode</th>
          <th style="text-align:left;">Zone</th>
          <th style="text-align:left;">region</th>

          <th></th>
        </tr>
      </thead>
      <tbody id="tabledata"></tbody>
    </table>
  </div>
  <div data-pagination></div>
</section>
<script type="text/javascript">
  var url_params = get_params();
  if (url_params.hasOwnProperty('location_type')) {} else {
    set_params('location_type', 'ADDRESSES')
    $("[data-filter='location_type'] option[value='ADDRESSES']").prop('selected', true);
  }
</script>


<script type="text/javascript">
  var url_params = get_params();
  if (url_params.hasOwnProperty('location_type')) {} else {
    set_params('location_type', 'ADDRESSES')
    $("[data-filter='location_type'] option[value='ADDRESSES']").prop('selected', true);
  }

</script>





<script type="text/javascript">
  function show_list() {
    show_table_data_loading('[data-table-td-counter]');
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var webapi = "pagination";
    var sort_by = $('#sort_by').val();
    var value = $('[data-filter="search"]').val().toUpperCase();
    var location_type = check_url_params('location_type');
    var sort_by_order_type = $('#sort').val();
    let param = {
      sort_by_order_type: sort_by_order_type,
      sort_by: sort_by,
      page: page_no,
      batch: batch,
      webapi: webapi,
      value: value,
      location_type: location_type
    }
    get_location_addresses(param).then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          $('#tabledata').html("");
          var counter = 0;
          $.each(data.response.list, function(index, item) {
            // if (item.name.toUpperCase().includes(value) || item.address_line.toUpperCase().includes(value) || item.city.toUpperCase().includes(value) || item.state.toUpperCase().includes(value)) {
            counter++;
            var row = `<tr>
    <td>${item.sr_no}</td>
    <td style="text-align:left;">${item.id}</td>
    <td style="text-align:left;">${item.name}</td>
    <td style="text-align:left;">${item.address_line}</td>
    <td style="text-align:left;">${item.city}, ${item.state}, ${item.zipcode}</td>
    <td style="text-align:left;">${item.city_name}</td>
    <td style="text-align:left;">${item.state_name}</td>
    <td style="text-align:left;">${item.state_mini_code}</td>
    <td style="text-align:left;">${item.zipcode}</td>
    <td style="text-align:left;">${item.zone_name}</td>
    <td style="text-align:left;">${item.region}</td>    
    <td>
    <button title="Edit" class="btn_grey_c"><a href="../user/masters/locations/location-addresses/details?eid=` + item.eid + `"><i class="fa fa-eye"></i></a></button>
    `;
            <?php if (in_array('P0240', USER_PRIV)) {

            ?>
              row += `<button title="Edit" class="btn_grey_c"><a href="../user/masters/locations/location-addresses/update?eid=` + item.eid + `"><i class="fa fa-pen"></i></a></button>`;
            <?php
            }
            ?>
            <?php if (in_array('P0241', USER_PRIV)) {
            ?>
              //row+=`<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="`+item.eid+`"><i class="fa fa-trash"></i></button>`;
            <?php
            } ?>
            row += `</td>`;
            row += `</tr>`;
            $('#tabledata').append(row);
            // }
            set_pagination({
              selector: '[data-pagination]',
              totalPages: data.response.totalPages,
              currentPage: data.response.currentPage,
              batch: data.response.batch
            })
          })
        }
      } else {
        $('#tabledata').html("");
        var row = `<tr><td colspan="5">` + data.message + `</td></tr>`;
        $('#tabledata').append(row);
        $('[data-pagination]').html('');
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_list()
</script>
<script type="text/javascript">
  $(document).ready(function() {

    $(document).on("click", "[data-action='delete']", function() {

      if (confirm('Do you want to delete address location ?')) {

        var eid = $(this).data("eid");

        $.ajax({

          url: window.location.pathname + '/delete-action',

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

            } else {

              alert(data.message)

            }

          }
        });
      }
    });
  });
</script>
<script type="text/javascript">
  function sort_table() {
    show_list()
  }
</script>
<script type="text/javascript">
  $(document).on("click", "[data-add-city]", function() {
    open_child_window({
      url: '../user/masters/locations/stopoff/quick-add-new',
      name: 'AddStopOff',
      width: 500,
      height: 500
    })
  });





  function update_locations() {
  show_processing_modal()
    $.ajax({
      url: window.location.pathname + '/update_locations',
      type: 'POST',
      success: function(data) {
        
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          alert(data.message)
          if (data.status) {
            
          }
          show_list()
          hide_processing_modal()
        }
      }
    })
  }


</script>



<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>