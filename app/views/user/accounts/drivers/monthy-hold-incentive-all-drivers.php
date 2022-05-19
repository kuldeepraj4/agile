<?php
require_once APPROOT.'/views/includes/user/header.php';
//$page=isset($_GET['page'])?$_GET['page']:1;
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 800px">
  <h1 class="list-200-heading">Hold Incentive of All Drivers</h1>
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
      <!-- //input used for sory by call-->


      <div class="filter-item">
        <label>ID</label>
        <input type="text" data-filter="code" onkeyup="show_list()">
      </div>            
      <div class="filter-item">
        <label>Month</label>
        <select data-filter="trips_month" onchange="show_list()"></select>
      </div>
    </div>
    <div class="list-200-top-action-right">
      <div>
        <?php
        if(in_array('P0128', USER_PRIV)){
          echo "<button class='btn_grey button_href'><a href='../user/accounts/drivers-payments/monthy-hold-incentives-all-drivers-move'>Move Incentive</a></button>";
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
          <th>Driver ID</th>
          <th>Driver Name</th>
          <th style="text-align: left;">Trip Month</th>
          <th style="text-align: left;">Trip ID</th>
          <th style="text-align: right;">Amount</th>
          <th></th>
        </tr>                       
      </thead>
      <tbody id="tabledata"></tbody>
    </table>
    </div>
<div data-pagination></div>
</section>



<script type="text/javascript">
  function show_trip_months(){
   get_trips_months_list().then(function(data) {
  // Run this when your request was successful
  if(data.status){

    //Run this if response has list
    if(data.response.list){
      var options="";
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item+`">`+item+`</option>`;               
      })
      $('[data-filter="trips_month"]').html(options);

   if (localStorage.getItem("trips_month") === null){
     sessionStorage.setItem('trips_month','<?php echo date('F-y'); ?>')
   }   
      
      $('[data-filter="trips_month"] option[value="'+sessionStorage.getItem('trips_month')+'"]').attr('selected',true);
      show_list()     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_trip_months()
</script>
<script type="text/javascript">

  function show_list(){
    var sort_by=$('#sort_by').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
  var webapi = "pagination";
    var driver_code=$('[data-filter="code"]').val();
sessionStorage.setItem('trips_month',$('[data-filter="trips_month"]').val())    
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        batch: batch,
        page: page_no,
        value:driver_code,
        trips_month:$('[data-filter="trips_month"]').val(),
        sort_by:sort_by,
        webapi:  webapi
      },
      beforeSend: function(){
        $('#tabledata').html(`<tr><td colspan="5" style="text-align:center"> Loading . . . <td><tr>`);
      },
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
          counter=0;
          var rows=``;
          $.each(data.response.list, function(index, item) {
            if(item.driver_code.toLowerCase().includes(driver_code)){       

             let incentives_list_length=item.incentives_list.length;
             if(incentives_list_length<1){
              rows+=`<tr>
              <td>${item.sr_no}</td>
              <td>${item.driver_code}</td>
              <td style="text-align:left">${item.driver_name}</td>
              <td>-</td>
              <td>-</td>
              <td style="text-align:right">0</td>
              <td></td>
              </tr>`
            }else{
              let row_span_condtion=0;
              $.each(item.incentives_list, function(index2, item2) {

                if(row_span_condtion<1){
                rows+=`<tr>
              <td rowspan="${incentives_list_length}">${++counter}</td>
              <td rowspan="${incentives_list_length}">${item.driver_code}</td>
              <td style="text-align:left" rowspan="${incentives_list_length}">${item.driver_name}</td>
              <td>${item2.trip_id}</td>
              <td>${item2.month}</td>
              <td style="text-align:right">${item2.amount}</td>
              <td></td>
              </tr>`                  
            }else{
              rows+=`<tr>
              <td>${item2.trip_id}</td>
              <td>${item2.month}</td>
              <td style="text-align:right">${item2.amount}</td>
              <td></td>
              </tr>`
            }
            row_span_condtion++
            
              })


            }
$('#tabledata').html(rows);

            
          }set_pagination({
    selector: '[data-pagination]',
    totalPages: data.response.totalPages,
    currentPage: data.response.currentPage,
    batch: data.response.batch
  })

        })



          
        }else{
          var false_message=`<tr><td colspan="18">`+data.message+`<td></tr>`;
          $('#tabledata').html(false_message);
          $('[data-pagination]').html('');
        }
      }

    } 

  })
  }

</script>
<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>


<br><br><br><br><br>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>