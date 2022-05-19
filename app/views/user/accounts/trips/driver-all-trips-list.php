<?php
require_once APPROOT.'/views/includes/user/header.php';
  $page=isset($_GET['page'])?$_GET['page']:1;
  $driver_eid=isset($_GET['eid'])?$_GET['eid']:"N/a";

?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1050px">
    <h1 class="list-200-heading" data-list-heading>Driver Trips List</h1>
    <section class="list-200-top-section">
        <div>
            
        </div>
        <div>
            
        </div>
    </section>

            <!-- input used for sory by call-->
            <input type="hidden" id="sort_by" value="">
            <!-- //input used for sory by call-->
    <div class="table  table-a">
        <table>
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Trip ID</th>
                    <th>Trip Date</th>
                    <th>Truck ID</th>
                    <th style="text-align: right;">Miles</th>
                    <th>PPM</th>
                    <th style="text-align: right;">Basic Earnings</th>
                    <th style="text-align: right;">Incentive</th>
                    <th></th>
                </tr>                       
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
      </div>
<div data-pagination></div>
</section>


<script type="text/javascript">
  function show_list(){
     var sort_by = $('#sort_by').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var webapi = "pagination";
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        page:'<?php echo $page; ?>',
        driver_eid:'<?php echo $driver_eid; ?>',
        page:page_no,
        sort_by:sort_by,
        batch:batch,
         webapi:  webapi
      },
      success:function(data){
       if((typeof data)=='string'){
        
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
           $.each(data.response.list, function(index, item) {     
             var row=`<tr>
             <td>${item.sr_no}</td>
             <td class="text-link"  onclick="open_child_window({url:'../user/accounts/trips/details?eid=${item.eid}'})">${item.id}</td>
             <td>${item.date}</td>
             <td>${item.truck_code}</td>
             <td style="text-align: right;">${item.miles}</td>             
             <td  >${item.pay_per_mile}</td>             
             <td  style="text-align: right;">${item.basic_earnings}</td>
             <td  style="text-align: right;">${item.incentive}</td>
            </tr>`;
            $('#tabledata').append(row);
          
        })

           
      set_pagination({
              selector: '[data-pagination]',
              totalPages: data.response.totalPages,
              currentPage: data.response.currentPage,
              batch: data.response.batch
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

<br><br><br><br><br>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>