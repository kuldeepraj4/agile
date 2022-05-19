<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1350px">
    <h1 class="list-200-heading">Loads</h1>
    <section class="list-200-top-action">
        <div class="list-200-top-action-left">

            <!-- input used for sory by call-->
            <input type="hidden" id="sort_by" value="">
            <!-- //input used for sory by call-->
            

            <div class="filter-item">
                <label>Search</label>
            <input type="text" data-filter="common_search" placeholder="ID, PO, Customer name" onkeyup="show_list()">

            </div>            
            <div class="filter-item">
            </div>
        </div>
        <div class="list-200-top-action-right">
            <div>
            <?php
            //if(in_array('P0173', USER_PRIV)){
                //echo "<button class='btn_grey button_href'><a href='../user/dispatch/loads/add-new'>Add New</a></button>";
            //
            ?>
        </div>
        </div>
                
    </section>
    <div class="table  table-a">
        <table>
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th data-table-sort-by="id">ID</th>
                    <th data-table-sort-by="po_number">PO Number</th>
                    <th data-table-sort-by="customer_code" style="text-align:left">Customer</th>
                    <th>Shipeer</th>
                    <th>Origin</th>
                    <th>Consingee</th>
                    <th>Destination</th>
                    <th>Pick-up Date</th>
                    <th>Delivery Date</th>
                    <th>Created By</th>
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
        var sort_by=$('#sort_by').val();
        var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
        var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
        var webapi = "pagination";
            var common_search=$('[data-filter="common_search"]').val();
        //var customer_id=$('[data-filter="customer_id"]').val();
        $.ajax({
            url:location.pathname+'-ajax',
            type:'POST',
            data:{
                page: page_no,
                sort_by: sort_by,
                batch: batch,
                webapi:  webapi,
                common_search:common_search,
            },
            success:function(data){
             if((typeof data)=='string'){
                 data=JSON.parse(data)
                 $('#tabledata').html("");
                 if(data.status){
                    console.log(data.response.list[2])
                 var counter=0;    
              $.each(data.response.list, function(index, item) {
                var pick_up_datetime='';
                var drop_datetime=''
                var pick_up_location='';
                var drop_location=''                
                     var row=`<tr>
                     <td>${++counter}</td>
                     <td>${item.id}</td>
                     <td>${item.po_number}</td>
                     <td style="text-align:left">${item.customer_code} - ${item.customer_name}</td>
                     <td style="text-align:left; white-space:nowrap">${item.shipper.location_id}</td>
                     <td style="text-align:left; white-space:nowrap">${item.shipper.location_city},${item.shipper.location_state}</td>
                     <td style="text-align:left; white-space:nowrap">${item.consignee.location_id}</td>
                     <td style="text-align:left; white-space:nowrap">${item.consignee.location_city},${item.consignee.location_state}</td>
                     <td>${item.shipper.date}</td>
                     <td>${item.consignee.date}</td>
                     <td style="white-space:nowrap">${item.added_by_user_code}<br>${item.added_on_datetime}</td>
                     <td style="white-space:nowrap">
                     <button title="View" class="btn_grey_c"><a href="../user/dispatch/loads/details?eid=`+item.eid+`"><i class="fa fa-eye"></i></a></button>`;
                    <?php  if(in_array('P0170', USER_PRIV)){
                        ?>
                        row+=`<button title="View" class="btn_grey_c"><a href="../user/dispatch/express-loads/update?eid=`+item.eid+`"><i class="fa fa-pen"></i></a></button>`;
                        <?php
                    }
                                      
                    ?>
                        
                        row+=`</td>`; 
                     row+=`</tr>`;
                     $('#tabledata').append(row);
                    set_pagination({
    selector: '[data-pagination]',
    totalPages: data.response.totalPages,
    currentPage: data.response.currentPage,
    batch: data.response.batch
  })

                 })
              
          }else {
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
<br><br><br>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>