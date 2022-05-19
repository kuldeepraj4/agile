<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 700px">
  <h1 class="list-200-heading">States</h1>

  <section class="list-200-top-action">
    <div class="list-200-top-action-left">

      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
      <!-- //input used for sory by call-->
      

      <div class="filter-item">
        <label>Search</label>
        <input type="text" placeholder="Name / Country" data-filter="search" onkeyup="set_params('page_no', 1);show_list()">
      </select>
    </div>            

  </div>
  <div class="list-200-top-action-right">
    <div>
      <?php
      if(in_array('P0013', USER_PRIV)){
        echo "<button class='btn_grey button_href'><a href='../user/masters/locations/states/add-new'>Add New</a></button>";
      }
      ?>
    </div>
  </div>
  
</section>

<div class="table  table-a">
  <table data-table-td-counter data-ro-table> 
    <thead>
      <input type='hidden' id='sort' value='asc'>
      <tr>
        <th>Sr. No.</th>
        <th data-table-sort-by="name">Name</th>
        <th data-table-sort-by="mini_code">Mini Code</th>
        <th data-table-sort-by="region">Region</th>
        <th data-table-sort-by="country">Country</th>
        <th>Action</th>
      </tr>                       
    </thead>
    <tbody id="tabledata"></tbody>
  </table>
   
</div>
<div data-pagination></div>
</section>

<script type="text/javascript">
  function show_list(){
    show_table_data_loading('[data-table-td-counter]');
    

  var value=$('[data-filter="search"]').val().toUpperCase();
  var sort_by = $('#sort_by').val();
  var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
  var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
  var webapi = "pagination";
  var sort_by_order_type = $('#sort').val();


    $.ajax({
        url:location.pathname + '-ajax',
        type:'POST',
        data:{
            value:value,
            page: page_no,
            sort_by: sort_by,
            batch: batch,
            sort_by_order_type:sort_by_order_type,
            webapi:  webapi
        },
    success: function(data) {
    // Run this when your request was successful
    if ((typeof data) == 'string') {

        data = JSON.parse(data)
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      $('#tabledata').html("");
      var counter=0;
      $.each(data.response.list, function(index, item) {
        // if(item.name.toUpperCase().includes(value) || item.country.toUpperCase().includes(value) || item.region.toUpperCase().includes(value) || item.mini_code.toUpperCase().includes(value)){
          counter++;
          var row=``;
          row+=`<tr>`;
          row+=`<td>`+item.sr_no+`</td>`;
          row+=`<td>`+item.name+`</td>`;
          row+=`<td>`+item.mini_code+`</td>`;
          row+=`<td>`+item.region+`</td>`;
          row+=`<td>`+item.country+`</td>`;
          row+=`<td>`;
          <?php if(in_array('P0015', USER_PRIV)){
            ?>
            row+=`<button title="Edit" class="btn_grey_c"><a href="../user/masters/locations/states/update?eid=`+item.eid+`"><i class="fa fa-pen"></i></a></button>`;
            <?php
          } ?>
          <?php if(in_array('P0016', USER_PRIV)){
            ?>
            row+=`<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="`+item.eid+`"><i class="fa fa-trash"></i></button>`;
            <?php
          } ?>
          
          row+=`</td>`; 

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
    }
  } else {
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

  $(document).ready(function(){
   $(document).on("click", "[data-action='delete']",function(){
    if(confirm('Do you want to delete state ?')){
      var eid=$(this).data("eid");
      $.ajax({
        url:window.location.pathname+'/delete-action',
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
          show_list()
        }else{
          alert(data.message)
        }
      }
    })
    }
  });
 });

</script>

<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>



<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>