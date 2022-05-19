<?php
require_once APPROOT . '/views/includes/user/header.php';
//$page=isset($_GET['page'])?$_GET['page']:1;
$vehicle_type = isset($_GET['vehicle_type']) ? $_GET['vehicle_type'] : '';
?>
<style type="text/css">
  .checkbox-button{
  display: flex; 
  vertical-align: top;
  margin-top:10px;
  }
 .checkbox-button-color{
  padding:5px 14px;
   margin-right:15px;
    border-radius: 3px;
 }



select[data-multi-select-plugin] {
    display: none !important;
}

.multi-select-component {
    position: relative;
    /*display: flex;
*/    flex-direction: row;
    flex-wrap: wrap;
    height: auto;
    width: 136%;
    padding: 3px 8px;
    font-size: 14px;
    line-height: 1.42857143;
    padding-bottom: 0px;
    color: #555;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -webkit-transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
    -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}

.autocomplete-list {
    border-radius: 4px 0px 0px 4px;
}

.multi-select-component:focus-within {
    box-shadow: inset 0px 0px 0px 2px #78ABFE;
}

.multi-select-component .btn-group {
    display: none !important;
}

.multiselect-native-select .multiselect-container {
    width: 100%;
}

.selected-wrapper {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    display: inline-block;
    border: 1px solid #d9d9d9;
    background-color: #ededed;
    white-space: nowrap;
    margin: 1px 5px 5px 0;
    height: 22px;
    vertical-align: top;
    cursor: default;
}

.selected-wrapper .selected-label {
    max-width: 514px;
    display: inline-block;
    overflow: hidden;
    text-overflow: ellipsis;
    padding-left: 4px;
    vertical-align: top;
}

.selected-wrapper .selected-close {
    display: inline-block;
    text-decoration: none;
    font-size: 14px;
    line-height: 1.49em;
    margin-left: 5px;
    padding-bottom: 10px;
    height: 100%;
    vertical-align: top;
    padding-right: 4px;
    opacity: 0.2;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    font-weight: 700;
}

.search-container {
    display: flex;
    flex-direction: row;
}

.search-container .selected-input {
    background: none;
    border: 0;
    height: 20px;
    width: 60px;
    padding: 0;
    margin-bottom: 6px;
    -webkit-box-shadow: none;
    box-shadow: none;
}

.search-container .selected-input:focus {
    outline: none;
}

.dropdown-icon.active {
    transform: rotateX(180deg)
}

.search-container .dropdown-icon {
    display: inline-block;
    padding: 10px 5px;
    position: absolute;
    top: 5px;
    right: 5px;
    width: 10px;
    height: 10px;
    border: 0 !important;
    /* needed */
    -webkit-appearance: none;
    -moz-appearance: none;
    /* SVG background image */
    background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2212%22%20height%3D%2212%22%20viewBox%3D%220%200%2012%2012%22%3E%3Ctitle%3Edown-arrow%3C%2Ftitle%3E%3Cg%20fill%3D%22%23818181%22%3E%3Cpath%20d%3D%22M10.293%2C3.293%2C6%2C7.586%2C1.707%2C3.293A1%2C1%2C0%2C0%2C0%2C.293%2C4.707l5%2C5a1%2C1%2C0%2C0%2C0%2C1.414%2C0l5-5a1%2C1%2C0%2C1%2C0-1.414-1.414Z%22%20fill%3D%22%23818181%22%3E%3C%2Fpath%3E%3C%2Fg%3E%3C%2Fsvg%3E");
    background-position: center;
    background-size: 10px;
    background-repeat: no-repeat;
}

.search-container ul {
    position: absolute;
    list-style: none;
    padding: 0;
    z-index: 3;
    margin-top: 29px;
    width: 100%;
    right: 0px;
    background: #fff;
    border: 1px solid #ccc;
    border-top: none;
    border-bottom: none;
    -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
    box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
}

.search-container ul :focus {
    outline: none;
}

.search-container ul li {
    display: block;
    text-align: left;
    padding: 8px 29px 2px 12px;
    border-bottom: 1px solid #ccc;
    font-size: 14px;
    min-height: 31px;
}

.search-container ul li:first-child {
    border-top: 1px solid #ccc;
    border-radius: 4px 0px 0 0;
}

.search-container ul li:last-child {
    border-radius: 4px 0px 0 0;
}


.search-container ul li:hover.not-cursor {
    cursor: default;
}

.search-container ul li:hover {
    color: #333;
    background-color: rgb(251, 242, 152);
    ;
    border-color: #adadad;
    cursor: pointer;
}

/* Adding scrool to select options */
.autocomplete-list {
    max-height: 130px;
    overflow-y: auto;
}
.button:hover{
  background:#a4a9fd;
}
.dialog{
  border:5px solid #666;
  padding:10px;
  background:#3A3A3A;
  position:absolute;
  display:none;
}
.dialog label{
  display:inline-block;
  color:#cecece;
}
input[type=text]{
  border:1px solid #333;
  display:inline-block;
  margin:5px;
}
.button-3 {
  appearance: none;
  background-color: #486e94;
  border: 1px solid rgba(27, 31, 35, .15);
  border-radius: 6px;
  box-shadow: rgba(27, 31, 35, .1) 0 1px 0;
  box-sizing: border-box;
  color: white;
  cursor: pointer;
  display: inline-block;
  font-family: -apple-system,system-ui,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji";
  font-size: 14px;
  font-weight: 600;
  line-height: 20px;
  padding: 6px 16px;
  position: relative;
  text-align: center;
  text-decoration: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: middle;
  white-space: nowrap;
}

.button-3:focus:not(:focus-visible):not(.focus-visible) {
  box-shadow: none;
  outline: none;
}

.button-3:hover {
  background-color: #1e446a;
}

.button-3:focus {
  box-shadow: rgba(46, 164, 79, .4) 0 0 0 3px;
  outline: none;
}

.button-3:disabled {
  background-color: #486e94;
  border-color: rgba(27, 31, 35, .1);
  color: rgba(255, 255, 255, .8);
  cursor: default;
}

.button-3:active {
  background-color: #486e94;
  box-shadow: rgba(20, 70, 32, .2) 0 1px 0 inset;
}
</style>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1400px">
  <h1 class="list-200-heading">Preventive Maintenace Trailer Alert</h1>

  <section class="list-200-top-action">
    <div class="list-200-top-action-left">
      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
      <!-- //input used for sory by call-->
      <input type='hidden' id='sort' value='asc'>
      <div class="filter-item">
        <label>Trailer ID</label>
        <input type="text" data-filter="trailer_code" list="quick_list_vehicle_id" data-vehicle-id>
      </div>
      <!-- <div class="filter-item">
        <label>Criticality</label>
        <select data-filter="criticality_level" onchange="set_params('criticality_level', this.value), goto_page(1)">
          <option value="ALLDATA">All</option>
          <option value="ALL">ALL</option>
          <option value="HIGH">HIGH</option>
          <option value="MEDIUM">MEDIUM</option>
          <option value="LOW">LOW</option>
        </select>
      </div> -->
      <div class="filter-item">
      </div>
      <div class="filter-item">
        <label>WorkOrder From Date</label>
        <input type="text" data-date-picker="" data-date-from data-filter="start_date_from" onchange="set_params('start_date_from', this.value)">
      </div>
      <div class="filter-item">
        <label>WorkOrder To Date</label>
        <input data-date-picker="" type="text" data-date-to data-filter="start_date_to" onchange="set_params('start_date_to', this.value)" />
      </div>
      <div class="filter-item"  style="width:100%;">
        <label  style="width:20%;">Job Work</label>
        <select multiple data-multi-select-plugin data-filter="job_work_name">  
           
        </select><!-- <span style="color:green; padding-left: 10px; cursor: pointer; font-size: 20px;" ><i class="fa fa-search search_job_filter" ></i></span> -->
        <!-- <select data-filter="job_work_name" onchange="set_params('job_work_name', this.value), goto_page(1)">
        </select> -->
      </div>
       <script type="text/javascript">
  function show_total_criticality() { 
    get_preventive_maintenance_criticality().then(function(data) {
      // Run this when your request was successful
      
      if (data.status) {
        //Run this if response has list 
        if (data.response.listtrailer) {
         
         // options += `<option value="">- - Select - -</option>`
          $.each(data.response.listtrailer, function(index, item) {



           row = `<div class="checkbox-button">
            <label style="width: 30%; padding: 5px 8px; background: #f1f1f1; margin-right: 5px;">Criticality</label>
             <div class="checkbox-button-color "  style=" background: #ffcce0;">
              <input type="checkbox" id="HIGH" name="HIGH" value="HIGH" data-status-id-group checked>
                <label for="HIGH"> HIGH - <span>`+ item.hightrailer +`</span></label>
            </div>
            <div class="checkbox-button-color" style="background: #fff0b3;">
              <input type="checkbox" id="MEDIUM" name="MEDIUM" value="MEDIUM" data-status-id-group checked>
              <label for="MEDIUM" > MEDIUM - <span>`+ item.mediumtrailer +`</span></label>
               </div>
               <div class="checkbox-button-color" style="background: #dddddd;">
              <input type="checkbox" id="LOW" name="LOW" value="LOW" data-status-id-group>
              <label for="LOW"> LOW - <span>`+ item.lowtrailer +`</span></label>
              </div>
            </div>

          </div>`;
            
          })
          $('[data-filter="criticality_level_menu"]').html(row);
          // if (url_params.hasOwnProperty('job_work_name')) {
          //   $("[data-filter='job_work_name'] option[value=" + url_params.job_work_name + "]").prop('selected', true);
          // }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  //show_total_criticality()
</script>


  <div data-filter="criticality_level_menu" style="width: 49%!important">
    <div class="checkbox-button">
        <label style="width: 27%; padding: 5px 8px; background: #f1f1f1; margin-right: 5px;">Criticality</label>
         <div class="checkbox-button-color"  style=" background: #ffcce0;">
          <input type="checkbox" id="HIGH" name="HIGH" value="HIGH" data-status-id-group checked>
            <label for="HIGH"> HIGH - <span id="highcount"></span></label>
        </div>

        <div class="checkbox-button-color" style="background: #fff0b3;">
          <input type="checkbox" id="MEDIUM" name="MEDIUM" value="MEDIUM" data-status-id-group checked>
          <label for="MEDIUM" > MEDIUM - <span id="mediumcount"></span></label>
        </div>
        
        <div class="checkbox-button-color" style="background: #dddddd;">
          <input type="checkbox" id="LOW" name="LOW" value="LOW" data-status-id-group>
          <label for="LOW"> LOW - <span id="lowcount"></span></label>
          </div>
        </div>

      </div>
      <div class="filter-item" style="width: 10%!important">
          <button class="search_job_filter form-submit-btn">Search</button>
      </div>
  </div>

  <div class="list-200-top-action-right">
    <div>
      <?php if (in_array('P0403', USER_PRIV)) {
        echo "<button class='btn_grey button_href'><a onclick='update_records_for_view()'>Update PM Trailer Alert</a></button>";
      } ?>
    </div>
  </div>
</section>


  <div class="table  table-a">
    <input type='hidden' id='sort' value='asc'>
    <table data-ro-table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Trailer</th>
          <th>Job Work</th>
          <th>Current Odo Meter</th>
          <th>Current Engine Hours</th>
          <th>Last Work Order</th>
          <th>WO Date</th>
          <th>WO Odometer</th>
          <th>WO Engine Hours</th>
          <th>PM Value Actual (A)</th>
          <th>PM Value Temporary(B)</th>
          <th>PM Value (A+B)</th>
          <th>PM Advance Alert Actual (X)</th>
          <th>PM Advance Alert Temporary (Y)</th>
          <th>PM Advance Alert (X+Y)</th>
          <th>PM Mode </th>
          <th>Difference <br>(Current Value - Old Value)</th>
          <th>Criticality</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tabledata"></tbody>
    </table>
    </div>
<div data-pagination></div>
</section>

<div id="panel">
  <!-- Dialog Box-->
  <div class="dialog" id="myform" style="display: block;top: 174px;left: 50%;margin-left:-272px;background: #ddd;">
    <div align="center">
      <h1 style="color: black;text-align: center;">Please Add PM Value Temporary</h1>
    </div>
    <form>
      <label id="valueFromMyButton" style="color: black">
        PM Value Temporary:
      </label>
      <input type="text" id="PMValueTemparory">
      <input type="hidden" name="truck_id" id="truck_id">
       <input type="hidden" name="job_work_id" id="job_work_id">
      <div align="center">
        <input class="button-3" type="button" value="Back" id="btnBack" style=" display: block;width: 30%;float: left;margin-left: 124px;margin-right: 2px;">
        <input class="button-3" type="button" value="Save" id="btnSave" style=" display: block;width: 30%;float: left;">
      </div>
  </form>
  </div>
</div>

<script type="text/javascript">
  $("#myform").hide();
  $(function() {
    $("#btn1").click(function() {
        $("#myform #valueFromMyButton").text($(this).val().trim());
        $("#PMValueTemparory").val('');
        $("#myform").show(100);
    });
    $("#btnBack").click(function() {
        $("#myform").hide(100);
    });
    $("#btnSave").click(function() {
        var PMValueTemparory = $("#PMValueTemparory").val().trim();
        var truck_id = $("#truck_id").val().trim();
        var job_work_id = $("#job_work_id").val().trim();
        if (PMValueTemparory){
            $.ajax({
              url:'../user/maintenance/preventive-maintenance/trailers-alert/addpmtemparory-action',
              type:'POST',
              data:{
                pmvaluetemparory:PMValueTemparory,
                trailer_id:truck_id,
                job_work_id:job_work_id,
              },
              success:function(data){
              if((typeof data)=='string'){
                data=JSON.parse(data) 
              }
              if(data.status){
                $("#myform").hide(100);
                window.location.reload();
              }else{
                alert(data.message)
              }
            }
          })
        } else {
          alert('Add PM Value Temporary');
        }
    });
});
function AddValuesForTemparory(truck_id, job_work_id) {
  $("#PMValueTemparory").val('');
  $("#truck_id").val(truck_id);
  $("#job_work_id").val(job_work_id);
  $("#myform").show(100);
}
</script>

<script type="text/javascript">
    //---select or deselect group button checkboxes
    /*$(document.body).on('click', '[data-status-id-group]', function() {
        $(this).children("input").click()
        active_status_id_array = [];

        $('[data-status-id-group]:checked').each(function() {
         
            active_status_id_array.push($(this).val())
        })
       // show_list();
        goto_page(1);
    });*/
    //---/select or deselect group button checkboxes
</script>

<script type="text/javascript">
  var url_params = get_params();
  if (url_params.hasOwnProperty('start_date_from')) {
    $("[data-filter='start_date_from']").val(url_params.start_date_from);
  }
  if (url_params.hasOwnProperty('start_date_to')) {
    $("[data-filter='start_date_to']").val(url_params.start_date_to);
  }
  if (url_params.hasOwnProperty('criticality_level')) {
    $("[data-filter='criticality_level'] option[value=" + url_params.criticality_level + "]").prop('selected', true);
  }
</script>
<script type="text/javascript">
  $(document.body).on('change', '[data-date-from]', function() {
    var g1 = new Date(check_url_params('start_date_from'))
    var g2 = new Date(check_url_params('start_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Please enter the valid date!. Start date should be less than end date")
      $("[data-filter='start_date_from']").val("");
      set_params('start_date_from', "")
      //goto_page(1)
    }
  });

  $(document.body).on('change', '[data-date-to]', function() {
    var g1 = new Date(check_url_params('start_date_from'))
    var g2 = new Date(check_url_params('start_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Please enter the valid date!. End date should be greater than start date")
      $("[data-filter='start_date_to']").val("");
      set_params('start_date_to', "")
      //goto_page(1)
    }
  });
</script>

<datalist id="quick_list_vehicle_id"></datalist>
<script type="text/javascript">
  $(document.body).on('input', '[data-vehicle-id]', function() {
    //alert("hhhh")
    id_selected = $(`[data-vehicle-id-rows="${$(this).val()}"]`).data('value');
    if (id_selected != undefined) {
      $(this).data('vehicle-id', id_selected)
      set_params('trailer_code', id_selected)
      set_params('trailer_name', $(`[data-vehicle-id]`).val())
      //goto_page(1)
    }
  });
</script>
<script type="text/javascript">
  $(document.body).on('change', '[data-vehicle-id]', function() {
    id_selected = $(`[data-vehicle-id-rows="${$(this).val()}"]`).data('value');
    if (id_selected == undefined) {
      alert("Please enter correct TruckID")
      set_params('trailer_code', '')
      set_params('trailer_name', '')
      $(`[data-vehicle-id]`).val('')
      //goto_page(1)
    }
  });
</script>

<script type="text/javascript">
  quick_list_trailers().then(function(data) {
    // Run this when your request was successful
    if (data.status) {
      //Run this if response has list
      if (data.response.list) {
        var options = "";
        // options += `<option value="">- - Select - -</option>`
        options += `<option data-vehicle-id-rows="" data-value="" value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option data-vehicle-id-rows="` + item.code + `" data-value="${item.id}" value="` + item.code + `"></option>`;
          // options += `<option value="` + item.id + `">` + item.code + `</option>`;   //old code
        })
        $('#quick_list_vehicle_id').html(options);
        //$('[data-filter="vehicle_id"]').html(options);   //old code
        if (url_params.hasOwnProperty('trailer_name')) {
          $(`[data-vehicle-id]`).val(check_url_params('trailer_name'))
          // $("[data-filter='vehicle_id'] option[value=" + url_params.vehicle_id + "]").prop('selected', true);
        }
      }
    }
  }).catch(function(err) {
    // Run this when promise was rejected via reject()
  })
</script>
<script type="text/javascript">
  function show_jobwork() { 
    get_preventive_maintenance().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list 
        if (data.response.list) {
          var options = "";
         // options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
              if (item.vehicle_type_id == "TRAILER") {
              options += `<option data-jobwork-id-rows="` + item.id + `" data-value="${item.name}" value="` + item.name + `"></option>`;
            }
          })
          $('[data-filter="job_work_name"]').html(options);
          if (url_params.hasOwnProperty('job_work_name')) {
            $("[data-filter='job_work_name'] option[value=" + url_params.job_work_name + "]").prop('selected', true);
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_jobwork()
</script>


<script type="text/javascript">


</script>

<!-- <script type="text/javascript">
  function show_status_filter(){
   get_repair_order_status().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
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
  function show_class_filter(){
   get_repair_order_class().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
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
  function show_type_filter(param){
   get_repair_order_type(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;
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
  function show_drivers(){
   quick_list_drivers().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.code+' '+item.name+`</option>`;               
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
  function show_stage_filter(param){
   get_repair_order_stage(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
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
  function show_unittype_filter(){
   get_vehicles().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="vehicle_type"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_unittype_filter()
</script>

<script type="text/javascript">
  function show_unit_filter(param){
    if(param.vehicle_type=='TRUCK'){
      quick_list_trucks().then(function(data){
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.code+`</option>`;               
      })
      $('[data-filter="vehicle_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
})
}else if(param.vehicle_type=='TRAILER'){
 quick_list_trailers().then(function(data){
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.code+`</option>`;               
      })
      $('[data-filter="vehicle_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
})
} 
}
</script>
<script type="text/javascript">

  $(document).ready(function(){
   $(document).on("click", "[data-action='delete']",function(){
    if(confirm('Do you want to delete job work ?')){
      var eid=$(this).data("eid");
      $.ajax({
        url:window.location.href+'/delete-action',
        type:'POST',
        data:{
          delete_eid:eid
        },
        context: this,
        success:function(data){
         if((typeof data)=='string'){
           data=JSON.parse(data) 
         }

         if(data.status){
          $(this).parent().parent().fadeOut();
        }else{
          alert(data.message)
        }
      }
    })
    }
  });
 });

</script> -->
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



  
  // Initialize function, create initial tokens with itens that are already selected by the user
function init(element) {
    // Create div that wroaps all the elements inside (select, elements selected, search div) to put select inside
    const wrapper = document.createElement("div");
    wrapper.addEventListener("click", clickOnWrapper);
    wrapper.classList.add("multi-select-component");

    // Create elements of search
    const search_div = document.createElement("div");
    search_div.classList.add("search-container");
    const input = document.createElement("input");
    input.classList.add("selected-input");
    input.setAttribute("autocomplete", "off");
    input.setAttribute("tabindex", "0");
    input.addEventListener("keyup", inputChange);
    input.addEventListener("keydown", deletePressed);
    input.addEventListener("click", openOptions);

    const dropdown_icon = document.createElement("span");
    dropdown_icon.setAttribute("href", "close");
    dropdown_icon.classList.add("dropdown-icon");

    dropdown_icon.addEventListener("click", clickDropdown);
    const autocomplete_list = document.createElement("ul");
    autocomplete_list.classList.add("autocomplete-list")
    search_div.appendChild(input);
    search_div.appendChild(autocomplete_list);
    search_div.appendChild(dropdown_icon);

    // set the wrapper as child (instead of the element)
    element.parentNode.replaceChild(wrapper, element);
    // set element as child of wrapper
    wrapper.appendChild(element);
    wrapper.appendChild(search_div);

    createInitialTokens(element);
    addPlaceholder(wrapper);

}

function removePlaceholder(wrapper) {
    const input_search = wrapper.querySelector(".selected-input");
    input_search.removeAttribute("placeholder");
}

function addPlaceholder(wrapper) {
    const input_search = wrapper.querySelector(".selected-input");
    const tokens = wrapper.querySelectorAll(".selected-wrapper");
    if (!tokens.length && !(document.activeElement === input_search))
        input_search.setAttribute("placeholder", "Select options");
}


// Function that create the initial set of tokens with the options selected by the users
function createInitialTokens(select) {
    let {
        options_selected
    } = getOptions(select);
    const wrapper = select.parentNode;
    for (let i = 0; i < options_selected.length; i++) {
        createToken(wrapper, options_selected[i]);
    }


}


// Listener of user search
function inputChange(e) {
    const wrapper = e.target.parentNode.parentNode;
    const select = wrapper.querySelector("select");
    const dropdown = wrapper.querySelector(".dropdown-icon");

    const input_val = e.target.value;

    if (input_val) {
        dropdown.classList.add("active");
        populateAutocompleteList(select, input_val.trim());
    } else {
        dropdown.classList.remove("active");
        const event = new Event('click');
        dropdown.dispatchEvent(event);
    }
}


// Listen for clicks on the wrapper, if click happens focus on the input
function clickOnWrapper(e) {
    const wrapper = e.target;
    if (wrapper.tagName == "DIV") {
        const input_search = wrapper.querySelector(".selected-input");
        const dropdown = wrapper.querySelector(".dropdown-icon");
        if (!dropdown.classList.contains("active")) {
            const event = new Event('click');
            dropdown.dispatchEvent(event);
        }
        input_search.focus();
        removePlaceholder(wrapper);
    }

}

function openOptions(e) {
    const input_search = e.target;
    const wrapper = input_search.parentElement.parentElement;
    const dropdown = wrapper.querySelector(".dropdown-icon");
    if (!dropdown.classList.contains("active")) {
        const event = new Event('click');
        dropdown.dispatchEvent(event);
    }
    e.stopPropagation();

}

// Function that create a token inside of a wrapper with the given value
function createToken(wrapper, value) {

    const search = wrapper.querySelector(".search-container");
    // Create token wrapper
    const token = document.createElement("div");
    token.classList.add("selected-wrapper");
    const token_span = document.createElement("span");
    token_span.classList.add("selected-label");
    token_span.innerText = value;
    const close = document.createElement("span");
    close.classList.add("selected-close");
    close.setAttribute("tabindex", "-1");
    close.setAttribute("data-option", value);
    close.setAttribute("data-hits", 0);
    close.setAttribute("href", "close");
    close.innerText = "x";
    close.addEventListener("click", removeToken)
    token.appendChild(token_span);
    token.appendChild(close);
    wrapper.insertBefore(token, search);

}


// Listen for clicks in the dropdown option
function clickDropdown(e) {

    const dropdown = e.target;
    const wrapper = dropdown.parentNode.parentNode;
    const input_search = wrapper.querySelector(".selected-input");
    const select = wrapper.querySelector("select");
    dropdown.classList.toggle("active");

    if (dropdown.classList.contains("active")) {
        removePlaceholder(wrapper);
        input_search.focus();

        if (!input_search.value) {
            populateAutocompleteList(select, "", true);
        } else {
            populateAutocompleteList(select, input_search.value);

        }
    } else {
        clearAutocompleteList(select);
        addPlaceholder(wrapper);
    }
    
}


// Clears the results of the autocomplete list
function clearAutocompleteList(select) {
    const wrapper = select.parentNode;

    const autocomplete_list = wrapper.querySelector(".autocomplete-list");
    autocomplete_list.innerHTML = "";
}

// Populate the autocomplete list following a given query from the user
function populateAutocompleteList(select, query, dropdown = false) {
    const {
        autocomplete_options
    } = getOptions(select);


    let options_to_show;

    if (dropdown)
        options_to_show = autocomplete_options;
    else
        options_to_show = autocomplete(query, autocomplete_options);

    const wrapper = select.parentNode;
    const input_search = wrapper.querySelector(".search-container");
    const autocomplete_list = wrapper.querySelector(".autocomplete-list");
    autocomplete_list.innerHTML = "";
    const result_size = options_to_show.length;

    if (result_size == 1) {

        const li = document.createElement("li");
        li.classList.add("selected-input-li");
        li.innerText = options_to_show[0];
        li.setAttribute('data-value', options_to_show[0]);
        li.addEventListener("click", selectOption);
        autocomplete_list.appendChild(li);
        if (query.length == options_to_show[0].length) {
            const event = new Event('click');
            li.dispatchEvent(event);

        }
    } else if (result_size > 1) {

        for (let i = 0; i < result_size; i++) {
            const li = document.createElement("li");
             li.classList.add("selected-input-li");
            li.innerText = options_to_show[i];
            li.setAttribute('data-value', options_to_show[i]);
            li.addEventListener("click", selectOption);
            autocomplete_list.appendChild(li);
        }
    } else {
        const li = document.createElement("li");

        li.classList.add("not-cursor");
        li.innerText = "No options found";
        autocomplete_list.appendChild(li);
    }
}


// Listener to autocomplete results when clicked set the selected property in the select option 
function selectOption(e) {
    const wrapper = e.target.parentNode.parentNode.parentNode;
    const input_search = wrapper.querySelector(".selected-input");
    const option = wrapper.querySelector(`select option[value="${e.target.dataset.value}"]`);

    option.setAttribute("selected", "");
    createToken(wrapper, e.target.dataset.value);
    if (input_search.value) {
        input_search.value = "";
    }

    input_search.focus();

    e.target.remove();
    const autocomplete_list = wrapper.querySelector(".autocomplete-list");


    if (!autocomplete_list.children.length) {
        const li = document.createElement("li");
        li.classList.add("not-cursor");
        li.innerText = "No options found";
        autocomplete_list.appendChild(li);
    }

    const event = new Event('keyup');
    input_search.dispatchEvent(event);
    e.stopPropagation();
}


// function that returns a list with the autcomplete list of matches
function autocomplete(query, options) {
    // No query passed, just return entire list
    if (!query) {
        return options;
    }
    let options_return = [];

    for (let i = 0; i < options.length; i++) {
        if (query.toLowerCase() === options[i].slice(0, query.length).toLowerCase()) {
            options_return.push(options[i]);
           // newoptioncheck(options[i]);

        }
    }
    return options_return;
}


// Returns the options that are selected by the user and the ones that are not
function getOptions(select) {


    // Select all the options available
    const all_options = Array.from(
        select.querySelectorAll("option")
    ).map(el => el.value);

    // Get the options that are selected from the user
    const options_selected = Array.from(
        select.querySelectorAll("option:checked")
    ).map(el => el.value);
    
     // $('option:checked').each(function(index, item) {
     //  options_selected.push(item);
       newoptioncheck(options_selected);
     // })
    // Create an autocomplete options array with the options that are not selected by the user
    const autocomplete_options = [];

    all_options.forEach(option => {
        if (!options_selected.includes(option)) {
            autocomplete_options.push(option);
        }

    });

    autocomplete_options.sort();

    return {

        options_selected,
        autocomplete_options
    };

}

// Listener for when the user wants to remove a given token.
function removeToken(e) {
    // Get the value to remove
    const value_to_remove = e.target.dataset.option;
    const wrapper = e.target.parentNode.parentNode;
    const input_search = wrapper.querySelector(".selected-input");
    const dropdown = wrapper.querySelector(".dropdown-icon");
    // Get the options in the select to be unselected
    const option_to_unselect = wrapper.querySelector(`select option[value="${value_to_remove}"]`);
    option_to_unselect.removeAttribute("selected");
    // Remove token attribute
    e.target.parentNode.remove();
    input_search.focus();
    dropdown.classList.remove("active");
    const event = new Event('click');
    dropdown.dispatchEvent(event);
    e.stopPropagation();
}

// Listen for 2 sequence of hits on the delete key, if this happens delete the last token if exist
function deletePressed(e) {
    // const wrapper = e.target.parentNode.parentNode;
    // const input_search = e.target;
    // const key = e.keyCode || e.charCode;
    // const tokens = wrapper.querySelectorAll(".selected-wrapper");

    // if (tokens.length) {
    //     const last_token_x = tokens[tokens.length - 1].querySelector("a");
    //     let hits = +last_token_x.dataset.hits;

    //     if (key == 8 || key == 46) {
    //         if (!input_search.value) {

    //             if (hits > 1) {
    //                 // Trigger delete event
    //                 const event = new Event('click');
    //                 last_token_x.dispatchEvent(event);
    //             } else {
    //                 last_token_x.dataset.hits = 2;
    //             }
    //         }
    //     } else {
    //         last_token_x.dataset.hits = 0;
    //     }
    // }
    return true;
}

// You can call this function if you want to add new options to the select plugin
// Target needs to be a unique identifier from the select you want to append new option for example #multi-select-plugin
// Example of usage addOption("#multi-select-plugin", "tesla", "Tesla")
// function addOption(target, val, text) {

//     const select = document.querySelector(target);
//     let opt = document.createElement('option');
//    // opt.value = val;
//    // opt.innerHTML = text;
//     select.appendChild(opt);
// }

document.addEventListener("DOMContentLoaded", () => {

    // get select that has the options available
    const select = document.querySelectorAll("[data-multi-select-plugin]");
    select.forEach(select => {

        init(select);

    });

    // Dismiss on outside click
    document.addEventListener('click', () => {
        // get select that has the options available
        const select = document.querySelectorAll("[data-multi-select-plugin]");
        for (let i = 0; i < select.length; i++) {
            if (event) {
                var isClickInside = select[i].parentElement.parentElement.contains(event.target);

                if (!isClickInside) {
                    const wrapper = select[i].parentElement.parentElement;
                    const dropdown = wrapper.querySelector(".dropdown-icon");
                    const selected_label = wrapper.querySelector(".selected-wrapper");
                    const autocomplete_list = wrapper.querySelector(".autocomplete-list");
                    //the click was outside the specifiedElement, do something
                    dropdown.classList.remove("active");
                    autocomplete_list.innerHTML = "";
                    addPlaceholder(wrapper);
                    //console.log(wrapper);
                    //show_list();
                    
                }
            }
        }
    });
});
</script>

<script type="text/javascript">

</script>

<script type="text/javascript">
  function update_records_for_view() {
    show_processing_modal()
    $.ajax({
      url: '../user/maintenance/maintenance-dashboard/update-live-dashboard-pm',
      type: 'POST',
      data: {
        refreshname: 'PMTrailerAlert'
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          if (data.status) {
            show_list()
            alert(data.message)
          } else {
            show_list()
            alert(data.message)
          }
          hide_processing_modal()
        }
      }
    })
  }
</script>


<script type="text/javascript">
   var options_selected_new = "";

var options_selected_new = "";

   function newoptioncheck(item) {
      options_selected_new = []
      options_selected_new.push(item);  

  $('.selected-close').click( function(){ 
   
   if(item.length == 1){
     goto_page(1);

   }

    });
}


   $(document.body).on('click', '.search_job_filter' ,function(){ 
     show_list()
     //goto_page(1);
       
  });
 



var active_status_id_array = ['HIGH', 'MEDIUM'];

  function show_list() {
    var sort_by_order_type = $('#sort').val();
    var sort_by = $('#sort_by').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var webapi = "pagination";
    var trailer_code = check_url_params('trailer_code');
    var start_date_from = check_url_params('start_date_from');
    var start_date_to = check_url_params('start_date_to');
    var criticality_level = check_url_params('criticality_level');
     var options_selected = options_selected_new.toString();
     var active_status_id_array = [];
      $('[data-status-id-group]:checked').each(function() {
              active_status_id_array.push($(this).val())
      })
      var status_ids = active_status_id_array.toString();

    $.ajax({
      url: location.pathname + '-ajax',
      type: 'POST',
      data: { 
        batch: batch,
        page: page_no,
        sort_by: sort_by,
        sort_by_order_type: sort_by_order_type,
        webapi: webapi,
        trailer_code: trailer_code,
        start_date_from: start_date_from,
        start_date_to: start_date_to,
        // criticality_level: criticality_level,
        job_work_name: options_selected,
         status_ids: status_ids,
      },
      beforeSend: function() {
        show_table_data_loading('[data-ro-table]')
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          console.log(data)
          data = JSON.parse(data)
          $('#tabledata').html("");
          if (data.status) {
            //console.log(data)
            var counter = 0;
            $.each(data.response.list, function(index, item) {

              criticality_bg = "";
              if (item.criticality_level == 'HIGH') {
                criticality_bg = '#ffcce0'
              } else if (item.criticality_level == 'MEDIUM') {
                criticality_bg = '#fff0b3'
              }

              counter++;
              var row = `<tr>
           <td>${item.sr_no}</td>
           <td>${item.trailer_code}</td>
           <td>${item.job_work_name}</td>
           <td>${item.current_odometer_reading}</td>
           <td>${item.current_engine_hours}</td>
           <td>${item.last_work_order}</td>
           <td style="white-space:nowrap">${item.work_order_date}</td>
           <td>${item.work_order_odometer}</td>
           <td>${item.work_order_engine_hours}</td>
           <td>${item.pm_value_actual}</td>
           <td>${item.pm_value_temporary}</td>
           <td>${item.pm_value}</td>
           <td>${item.pm_advance_alert_actual}</td>
           <td>${item.pm_advance_alert_temporary}</td>
           <td>${item.pm_advance_alert}</td>
           <td>${item.pm_mode}</td>
           <td>${item.difference}</td>
           <td style="background:${criticality_bg}">${item.criticality_level}</td>

           <td><input type="button" class="button-3" value="Add PM Value Temporary" id="btn1" onClick="AddValuesForTemparory(${item.trailer_id},${item.job_work_id})"></td>

           <td style="white-space:nowrap; display: none;">`;

              <?php
              if (in_array('P0228', USER_PRIV)) {
              ?>
                a = `<button title="View" class="btn_grey_c"><a href="../user/maintenance/repair-orders/details?eid=${item.eid}"><i class="fa fa-eye"></i></a></button>`;
              <?php
              }
              if (in_array('P0229', USER_PRIV)) {
              ?>
                b = `<button title="Edit" class="btn_grey_c"><a href="../user/maintenance/repair-orders/update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button>`;
              <?php
              }
              if (in_array('P0230', USER_PRIV)) {
              ?>
                r = `<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="${item.eid}"><i class="fa fa-trash"></i></button>`;
              <?php
              }
              if (in_array('P0232', USER_PRIV)) {
              ?>
                r = `<button class="btn_blue"><a href="../user/maintenance/work-orders/add-new?ro-eid=${item.eid}">Create Work Order</a></button>`;
              <?php
              } ?>
              row += `</td> 
         </tr>`;
              $('#tabledata').append(row);

              $('#highcount').text(data.response.highcount);
              $('#mediumcount').text(data.response.mediumcount);
              $('#lowcount').text(data.response.lowcount);

              set_pagination({
                selector: '[data-pagination]',
                totalPages: data.response.totalPages,
                currentPage: data.response.currentPage,
                batch: data.response.batch
              })
            })
            /*set_pagination({selector:'[data-pagination]',totalPages:data.response.totalPages,currentPage:data.response.currentPage,batch:data.response.batch})*/
          } else {
            var false_message = `<tr><td colspan="18">` + data.message + `<td></tr>`;
            $('#tabledata').html(false_message);
             $('[data-pagination]').html('');

          }
        }
      }
    })
  }
  show_list()
</script>



<br><br><br><br>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>