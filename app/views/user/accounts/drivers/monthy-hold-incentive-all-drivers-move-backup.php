<?php
require_once APPROOT.'/views/includes/user/header.php';
  $page=isset($_GET['page'])?$_GET['page']:1;
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 800px">
    <h1 class="list-200-heading">Move Incentive of Drivers</h1>
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

                
    </section>
    <div class="table  table-a">
        <table>
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th><input type="checkbox" id="select_all"></th>
                    <th>Month</th>
                    <th>Driver ID</th>
                    <th>Driver Name</th>
                    <th style="text-align: right;">Amount</th>
                </tr>                       
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
      <div class="table-pagination" data-list-pagination style="margin:5px"></div>
    </div>
</section>
    <section class="action-button-box">
      <?php echo in_array('PADMIN', USER_PRIV)?'<button type="button" class="btn_green" data-action="move-incentive">Move Incentive</button>':""; ?>
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
      $('[data-filter="trips_month"] option[value="<?php echo date('F-y'); ?>"]').attr('selected',true);
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
    var driver_code=$('[data-filter="code"]').val();
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        page:'<?php echo $page; ?>',
        trips_month:$('[data-filter="trips_month"]').val(),
        sort_by:sort_by
      },
      success:function(data){

       if((typeof data)=='string'){
         data=JSON.parse(data)
          console.log(data)
         $('#tabledata').html("");
         if(data.status){
          counter=0;
          var rows=``;
           $.each(data.response.list, function(index, item) {
            if(item.driver_code.toLowerCase().includes(driver_code)){       
             rows+=`<tr>
             <td>${++counter}</td>
             <td><input type="checkbox" data-move-incentive-row data-driver-eid='${item.driver_eid}' data-month='${item.month}'></td>
             <td>${item.month}</td>
             <td>${item.driver_code}</td>
             <td>${item.driver_name}</td>
             <td style="text-align:right">${item.amount}</td>
            </tr>`;
          }

        })
        
          $('#tabledata').html(rows);
      }else{
        var false_message=`<tr><td colspan="18">`+data.message+`<td></tr>`;
        $('#tabledata').html(false_message);
      }
    }

  }

})
}
show_list()

</script>

<script type="text/javascript">

$(document).ready(function(){
 $(document).on("click", "[data-action='move-incentive']",function(){
  
    if(confirm('Do you want to move incentives ?')){
show_processing_modal()


var incentiveMoveArray=[];
$('[data-move-incentive-row]:checked').each(function () {  
  incentiveMoveArray.push({driver_eid:$(this).data("driver-eid"),month:$(this).data("month")});
});
    $.ajax({
      url:window.location.pathname+'-action',
      type:'POST',
       data:{
        move_incentive_array:incentiveMoveArray
       },
       context: this,
        success:function(data){
          console.log(data)
               if((typeof data)=='string'){
               data=JSON.parse(data) 
               }
               
               if(data.status){
                    location.reload();
               }else{
                alert(data.message)
               }
               hide_processing_modal()
      }
    })
    }
  });
});






$("#select_all").click(function(){
        $("[data-move-incentive-row]").prop('checked', $(this).prop('checked'));

});

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