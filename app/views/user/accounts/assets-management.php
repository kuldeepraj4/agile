<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 700px">
  <h1 class="list-200-heading">Assets Management</h1>

  <section class="list-200-top-action">
    <div class="list-200-top-action-left">

      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
      <input type='hidden' id='sort' value='asc'>
      <!-- //input used for sory by call-->
      
      <div class="filter-item">
        <label>Vehicle Type</label>
        <select data-filter="vehicle_type" onchange="set_params('vehicle_type', this.value),show_list()"></select>
      </select>
    </div> 
    <div class="filter-item">
      <label>Search</label>
      <input type="text" placeholder="Unit No. / Vin No." data-filter="search" onkeyup="set_params('page_no', 1),show_list()">
    </select>
  </div> </div>

  <div class="list-200-top-action-right">

      <div><button class='btn_green' data-button-export-to-excel onclick="report_view()">Excel</button>

      </div>

  
         

</div>

</section>

<div class="table  table-a">
  <table data-table-td-counter data-ro-table> 
    <thead>
     
      <tr>
        <th>Sr. No.</th>
        <th data-table-sort-by="unit">Unit No.</th>
        <th data-table-sort-by="make_year">Make</th>
        <th data-table-sort-by="vin_no">VIN No.</th>
        <th data-table-sort-by="ownership_type">Own/Lease</th>
        <th>Assets Booked</th>
        <th>Last Updated by</th>
      </tr>                       
    </thead>
    <tbody id="tabledata"></tbody>
  </table>

</div>
<div data-pagination></div>
</section>


<script type="text/javascript">
  var url_params = get_params();
  if (url_params.hasOwnProperty('vehicle_type')) {
    $("[data-filter='vehicle_type']").val(url_params.payment_id);
  }

</script>

<script type="text/javascript">
 function show_list(){
  var sort_by = $('#sort_by').val();
  var sort_by_order_type = $('#sort').val();
  var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
  var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
  var vehicle_type = check_url_params('vehicle_type');
  var webapi = "pagination";
  var value=$('[data-filter="search"]').val().toUpperCase();
  $.ajax({
    url:location.pathname+'/list-ajax',
    type:'POST',
    data:{
      page:page_no,
      sort_by_order_type:sort_by_order_type,
      sort_by:sort_by,
      batch:batch,
      value:value,
      vehicle_type:vehicle_type,
      webapi:  webapi
    },
    success:function(data){

     if((typeof data)=='string'){
       data=JSON.parse(data)
       $('#tabledata').html("");

       if(data.status){
        $.each(data.response.list, function(index, item) { 

  console.log(item);
        var assets_status="";
        if(item.assets_status=="YES"){
          assest_status='checked';  
        }else{
          assest_status=''; 
        }


        // if(item.name.toUpperCase().includes(value) || item.country.toUpperCase().includes(value) || item.region.toUpperCase().includes(value) || item.mini_code.toUpperCase().includes(value)){

          var row=``;
          row+=`<tr>`;
          row+=`<td>`+item.sr_no+`</td>`;
          row+=`<td>`+item.code+`</td>`;
          row+=`<td>`+item.make_year+`</td>`;
          row+=`<td>`+item.vin_number+`</td>`;
          row+=`<td>`+item.ownership_type+`</td>`;
          row+=`<td style="text-align:center">`;
          <?php if(in_array('P0392', USER_PRIV)){
            ?>
            row+=`
            <input type="checkbox" ${assest_status} data-toggle-settlement-status data-vehicle-eid="${item.vehicle_eid}" ></td>
            <td>`+item.added_by_user_name+`<br>`+item.added_by_user_code+`<br>`+item.added_on_datetime+`</td>`;
            <?php
          } ?>

          


          row+=`</tr>`;
          $('#tabledata').append(row);
        // }
        set_pagination({
          selector: '[data-pagination]',
          totalPages: data.response.totalPages,
          currentPage: data.response.currentPage,
          batch: data.response.batch
        })
      })   

      }else{
        $('#tabledata').html("");
        var row=`<tr><td colspan="20">`+data.message+`</td></tr>`;
        $('#tabledata').append(row);
        $('[data-pagination]').html('');
      }
    }
  }
})
}
show_list()
</script>


<script type="text/javascript">
  function sort_table(){
    show_list()
  }
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
          $('[data-filter="vehicle_type"]').html(options);
         
          if (url_params.hasOwnProperty('vehicle_type')) {
            $("[data-filter='vehicle_type'] option[value=" + url_params.vehicle_type + "]").prop('selected', true);
            show_unit_filter({
              vehicle_type: url_params.vehicle_type
            })
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  show_unittype_filter()
</script>



<script type="text/javascript">






 $(document).on("click", "[data-toggle-settlement-status]",function(){
   if(confirm('Are you sure want to change?')){
var vehicle_eid=$(this).data('vehicle-eid')
 
var assest_status=($(this).prop("checked"))?'YES':'NO';

var vehicle_type = check_url_params('vehicle_type');
    $.ajax({
      url:location.pathname+'/update-action',
      type:'POST',
      data:{
        vehicle_eid:vehicle_eid,
        vehicle_type:vehicle_type,
        assest_status:assest_status
      },
      context: this,
      success:function(data){
       if((typeof data)=='string'){
         data=JSON.parse(data) 
       }

       if(data.status){
        alert('Updated Successfully');
        show_list();
      }else{
        alert(data.message);
      }
    }
  })
  }else{
    show_list()
  }
});

</script>


<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>




<!------report view-->

<div id="reportSection"></div>

<!----//report view-->

<script type="text/javascript">
  function report_view() {

   filetype = 'CSV';


    $.ajax({

      url: location.pathname+'/list-ajax',

      type: 'POST',

      data: {

        report_view: true,

        vehicle_type: check_url_params('vehicle_type'),


      },

      beforeSend: function() {

        show_processing_modal();

        $('#reportSection').show();

        $('#reportSection').html(`<table id="reportTable"><thead><tr>

        <th>Sr. No.</th>
        <th>Unit No</th>
        <th>Make</th>
        <th>VIN No.</th>
        <th>Own/Lease</th>
        <th>Assets Booked</th>
        <th>Last Updated Name</th> 
        <th>Last Updated Code</th>
        <th>Last Updated time</th>                  

                </tr>                       

            </thead>

            <tbody id="reportTableBody"></tbody></table>`);

      },

      success: function(data) {

        if ((typeof data) == 'string') {

          data = JSON.parse(data)

          if (data.status) {

            $.each(data.response.list, function(index, item) {


              var row = `<tr>

          
        

             <td>${item.sr_no}</td>
             <td>${item.code}</td>
             <td>${item.make_year}</td>
             <td>${item.vin_number}</td>
             <td>${item.ownership_type}</td>
             <td>${item.assets_status}</td>      

              <td>${item.added_by_user_name}</td>
              <td>${item.added_by_user_code}</td>
              <td>${item.added_on_datetime}</td>
            </tr>`;

              $('#reportTableBody').append(row);

              // default action is 'download'



            })

            if (filetype == 'CSV') {

              $('#reportTable').first().table2csv({
                filename: 'assest-payments.csv'
              });

            }

            $('#reportSection').hide();

            hide_processing_modal()




          } else {
            $('#reportSection').hide();
            alert(data.message)
            hide_processing_modal();
          }

        }



      }



    })

  }
</script>





<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>