<?php
require_once APPROOT.'/views/includes/user/header.php';
 // $page=isset($_GET['page'])?$_GET['page']:1;
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 800px">
    <h1 class="list-200-heading">Approved Driver Trips</h1>
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
                <!-- <label>Status</label>
            <select data-filter="code" onchange="show_list()">
            </select> -->
            </div>
        </div>
        <div class="list-200-top-action-right">
        </div>
                
    </section>
    <div class="table  table-a">
        <table>
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Miles</th>
                    <th>Total Trips</th>
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
    var value=$('[data-filter="code"]').val().toUpperCase();
    var sort_by=$('#sort_by').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
  var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
  var webapi = "pagination";
    var driver_code=$('[data-filter="code"]').val();
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
         page: page_no,
         batch: batch,
        webapi:  webapi,
        value:value,
        sort_by:sort_by
      },
      success:function(data){
        console.log(data)
       if((typeof data)=='string'){
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
           $.each(data.response.list, function(index, item) {
            if(item.driver_code.toLowerCase().includes(driver_code)){       
             var row=`<tr>
             <td>${item.sr_no}</td>
             <td>${item.driver_code}</td>
             <td style="text-align:left">${item.driver_name}</td>
             <td>${item.total_miles_driven}</td>             
             <td>${item.total_trips_by_driver}</td>             
             <td style="white-space:nowrap">`;

             <?php if(in_array('P0120', USER_PRIV)){
              ?>
             row+=`<button title="View" class="btn_grey_c"><a href="../user/accounts/trips/driver-all-trips-list?eid=`+item.driver_eid+`"><i class="fa fa-eye"></i></a></button>`;
              <?php
            } ?>

            row+=`</td> 
            </tr>`;
            $('#tabledata').append(row);
          } 
          set_pagination({
    selector: '[data-pagination]',
    totalPages: data.response.totalPages,
    currentPage: data.response.currentPage,
    batch: data.response.batch
  })

        })

           ///--pagination
           let pagination=``;
           console.log(data)
           if(data.response.currentPage >1){
            pagination+=`<button class="btn_green" onclick="change_url_and_execute('page',${data.response.currentPage-1})">Previous<i class="fa fa-angle-double-left`
            
           }
           if(data.response.currentPage<data.response.totalPages){
              pagination+=`<button class="btn_green" onclick="change_url_and_execute('page',${data.response.currentPage+1})">NEXT<i class="fa fa-angle-double-right`          
           }

           $('[data-list-pagination]').html(pagination)
           ///--/pagination

      }else{
        $('#tabledata').html("");
    var row=`<tr><td colspan="5">`+data.message+`</td></tr>`;
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