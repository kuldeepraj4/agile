<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1350px">
  <h1 class="list-200-heading">Customers</h1>
  <section class="list-200-top-action">
    <div class="list-200-top-action-left">

      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
      <!-- //input used for sory by call-->


      <div class="filter-item">
        <label>Code</label>
        <input type="text" data-filter="code" onkeyup="show_list();goto_page(1)">

      </div>            
      <div class="filter-item">
        <label>Type ID</label>
        <select data-filter="type_id" onchange="show_list();goto_page(1)">
          <option value=""> - - Select - - </option>
          <option value="BROKER">BROKER</option>
          <option value="SHIPPER">SHIPPER</option>
          <option value="3PL">3PL</option>
        </select>
      </div>
      <div class="filter-item">
        <label>Terminal</label>
        <select data-filter="terminal_id" onchange="show_list();goto_page(1)"></select>
      </div>
          <div class="filter-item">
      </div>  

    </div>
    <div class="list-200-top-action-right">
      <div>
        <?php
        if(in_array('P0163', USER_PRIV)){
          echo "<button class='btn_grey button_href'><a href='../user/dispatch/customers/add-new'>Add New</a></button>";
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
          <th data-table-sort-by="type_id">Type</th>
          <th data-table-sort-by="code">Code</th> 
          <th data-table-sort-by="name" style="text-align:left">Name</th>
          <th style="text-align:left">Terminal</th>
          <th>Address</th>
          <th>Phone Number</th>
          <th>Email</th>
          <th>Toll Free Number</th>
          <th>Action</th>
          <th></th>
        </tr>                       
      </thead>
      <tbody id="tabledata"></tbody>
    </table>
    </div>
<div data-pagination></div>
</section>
<script type="text/javascript">
function show_terminal_options(){
 get_companies().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
          options+=`<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
            options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
        })
        $('[data-filter="terminal_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_terminal_options()
</script>
<script type="text/javascript">

 
  function show_list(){
     var sort_by = $('#sort_by').val();
  var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
  var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
  var webapi = "pagination";
 var sort_by_order_type = $('#sort').val();
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        sort_by_order_type:sort_by_order_type,
        page:page_no,
        sort_by:$('#sort_by').val(),
        batch:batch,
        webapi:  webapi,
        type_id:$('[data-filter="type_id"]').val(),
        customer_code:$('[data-filter="code"]').val(),
        terminal_id:$('[data-filter="terminal_id"]').val()
      },    
      beforeSend:function(){
      show_table_data_loading('[data-ro-table]')
    },
      success:function(data){
       if((typeof data)=='string'){
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
          var counter=1;    
          $.each(data.response.list, function(index, item) {
           var row=`<tr>
           <td>${item.sr_no}</td>
           <td>${item.customer_type}</td>
           <td>${item.customer_code}</td>
           <td style="text-align:left">${item.customer_name}</td>
           <td style="text-align:left">${item.terminal}</td>
           <td style="max-width:200px;text-align:left">${item.address}</td>
           <td>${item.phone_number}</td>
           <td>${item.company_email}</td>
           <td>${item.toll_free_number}</td>
           <td>`;
           <?php if(in_array('P0163', USER_PRIV)){
            ?>
            row+=`<button title="View" class="btn_grey_c"><a href="../user/dispatch/customers/details?eid=`+item.eid+`"><i class="fa fa-eye"></i></a></button>`;
            <?php
          }
          if(in_array('P0164', USER_PRIV)){
            ?>
            row+=`<button title="View" class="btn_grey_c"><a href="../user/dispatch/customers/update?eid=`+item.eid+`&page="><i class="fa fa-pen"></i></a></button>`;
            <?php
          }

          

          if(in_array('P0337', USER_PRIV)){
              ?>
              if(item.approval_status!=='VERIFIED' || item.approval_status==''){
                row+=` <td><a title="Compare History" href="../user/dispatch/customers/customers-verify?eid=${item.eid}" title="Verify Trucks"><button class="btn_blue">Verify</button></a></td>`;
              }else  if(item.approval_status=='VERIFIED'){
               row+=`<td><a href="../user/quick-details/quick-history-details?reference=customers&eid=${item.eid}" title="Compare History"><button class="btn_blue">Compare</button></a></td>`;
             }

           <?php } ?>

          row+=`</td>`; 
          row+=`</tr>`;
          $('#tabledata').append(row);
          

        })
          set_pagination({selector:'[data-pagination]',
            totalPages:data.response.totalPages,currentPage:data.response.currentPage,batch:data.response.batch})
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


<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>