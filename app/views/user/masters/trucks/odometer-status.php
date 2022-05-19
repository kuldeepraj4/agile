<?php
require_once APPROOT . '/views/includes/user/header.php'; ?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1000px">
  <h1 class="list-200-heading">Truck Odometer Status</h1>
  <section class="list-200-top-section">
    <div>
    </div>
    <div>
    </div>
  </section>
  <section class="list-200-top-action" style="display: none;">
    <div class="list-200-top-action-left">
      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
       <input type='hidden' id='sort' value='asc'>
      <!-- //input used for sory by call-->
      <div class="filter-item">
        <label>ID</label>
        <input type="text" data-filter="code" onchange="set_params('code', this.value), goto_page(1)">
      </div>            
      <div class="filter-item"></div>
    </div>
    <div class="list-200-top-action-right"></div>
  </section>
  <div class="table  table-a">
    <table data-ro-table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th data-table-sort-by="code" style="text-align: left;">Code</th>
          <th style="text-align: left;">Update Type</th>
          <th>Updated On</th>
          <th style="text-align: right;">Current Odometre Reading</th>
          
          
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
  if (url_params.hasOwnProperty('code')) {
    $("[data-filter='code']").val(url_params.code);
  }
</script>
<script type="text/javascript">
  batch=10;
  function show_list(){
   
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var code = check_url_params('code');
     var sort_by_order_type = $('#sort').val();
    var status = check_url_params('status');
    var sort_by = $('#sort_by').val();
  
  var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
  var webapi = "pagination";
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        page: page_no,
        sort_by: sort_by,
        sort_by_order_type:sort_by_order_type,
        batch: batch,
        code:code,
        status_id:status,
        webapi:  webapi
      
    },
    success:function(data){
     if((typeof data)=='string'){
       data=JSON.parse(data)
       $('#tabledata').html("");
       if(data.status){
        var counter=0;    
        $.each(data.response.list, function(index, item) {
         row=`<tr data-trailer-eid="${item.eid}">
         <td>${item.sr_no}</td>
         <td style="text-align:left">${item.code}</td>
         <td style="text-align: left;">${item.odometer_update_type}</td>`
         row+=`<td style="text-align: left;">${item.updated_by}  ${item.updated_on}</td>`;

         if(item.odometer_update_type=='MANUAL'){

          <?php if(in_array('P0376', USER_PRIV)){  ?>
          row+=`<td style="text-align: right;"><input type="text" name="current_reading" style="width:100px" value="${item.current_odometer_reading}"></td>;
          <td><button title="Update odometer reading" class="btn_green" data-action="update-reading">Save</button></td>`;
        <?php }else{ ?>
           row+=`<td style="text-align: right;"><input type="text" name="current_reading" style="width:100px" value="${item.current_odometer_reading}" disabled></td>`;

          <?php } ?>
        }else{
          row+=`<td style="text-align: right;"><input type="text" name="current_reading" style="width:100px" value="${item.current_odometer_reading}" disabled></td>
          <td></td>`
        }
        

        row+=`</tr>`;
        $('#tabledata').append(row);
      })

      }else{
        var false_message=`<tr><td colspan="18">`+data.message+`<td></tr>`;
        $('#tabledata').html(false_message);
      }set_pagination({
    selector: '[data-pagination]',
    totalPages: data.response.totalPages,
    currentPage: data.response.currentPage,
    batch: data.response.batch
  })
      
      }
  }
})
  }
  show_list()
</script>

<script type="text/javascript">

  $(document).ready(function(){
   $(document).on("click", "[data-action='update-reading']",function(){
    if(confirm('Do you want to update?')){
      var eid=$(this).parents('tr').data('trailer-eid');
      var current_reading=$(this).parents('tr').find('[name="current_reading"]').val()
      $.ajax({
        url:window.location.pathname+'/../update-odometer-action',
        type:'POST',
        data:{
          truck_eid:eid,
          current_reading:current_reading
        },
        context: this,
        success:function(data){
         if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         
         if(data.status){
          show_list();
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
<?php require_once APPROOT . '/views/includes/user/footer.php';
?>
