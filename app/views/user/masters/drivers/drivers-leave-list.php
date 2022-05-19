<?php
require_once APPROOT.'/views/includes/user/header.php';
$page=isset($_GET['page'])?$_GET['page']:1;
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1300px">
  <h1 class="list-200-heading">All Drivers Leave</h1>
  <section class="list-200-top-action">
    <div class="list-200-top-action-left">

      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
      <!-- //input used for sory by call-->

                  
    <div class="filter-item fourth">
        <label>Date From</label>
        <input type="text" data-date-picker="" data-filter="period_date_from" onchange="set_params('period_date_from', this.value), goto_page(1)" value="<?php echo date('m/d/Y') ?>">
    </div>
    <div class="filter-item fourth">
        <label>Date To</label>
        <input data-date-picker="" type="text" data-filter="period_date_to" onchange="set_params('period_date_to', this.value), goto_page(1)" value="" />
    </div>
    <div class="filter-item">
        <label>Search Driver</label>
        <input type="text" data-selected-driver-id=""  list="quick_list_drivers_for_search" name="quick_list_drivers_search" data-search-driver>
      </div>
    </div>
    <?php
        if(in_array('P0360', USER_PRIV)) { ?>
    <div class="list-200-top-action-right">
      <div><button class='btn_grey button_href'><a href='../user/masters/drivers/drivers-leave-add-new'>Add New</a></button>
      </div>
    </div>
  <?php } ?>
  </section>
  <div class="table  table-a">
    <table data-table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Leave Id</th>
          <th>Team/Solo</th>
          <th style='text-align:left'>Driver</th>
          <th>Truck</th>
          <th>Trailer</th>
          <th>From Datetime</th>
          <th>To Datetime</th>
          <th style="text-align:left">Reason</th>
          <th style="text-align:left">Location</th>
          <th>Remarks</th>
          <th>Added By</th>
          <th></th> 
        </tr>                       
      </thead>

      <tbody id="tabledata">
      </tbody>
    </table>
    </div>
<div data-pagination></div>
</section>
<script type="text/javascript">
  $('[data-search-driver]').val(check_url_params('driver_name'))
  function show_list(){
    show_processing_modal()
    $.ajax({
      url:'../user/masters/drivers/driver-leave-ajax',
      type:'POST',
      data:{
        sort_by:$('#sort_by').val(),
        page: (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1,
        batch:(check_url_params('batch') != undefined) ? check_url_params('batch') : 10,
        driver_id:check_url_params('driver_id'),
        period_date_from:check_url_params('period_date_from'),
        period_date_to:check_url_params('period_date_to'),
      },
      beforeSend:function() {
        show_table_data_loading("[data-my-table]")
      },
      complete:function() {
        hide_processing_modal()
      },
      success:function(data){
        
        if((typeof data)=='string'){
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
           var counter=1;    
           $.each(data.response.list, function(index, item) {
            row=`<tr>
            <td style="max-width:80px;">${item.sr_no}</td>
            <td style="max-width:80px;">${item.id}</td>
                    <td>${item.is_team_driver}</td>
                    <td style="white-space:nowrap;text-align:left">
                    <span class="text-link"  onclick="open_quick_view_driver('${item.driver_eid}')">${item.driver_code} ${item.driver_name}</span>`


                    if(item.driver_b_eid!=""){
                        row+=`<br><span class="text-link"  onclick="open_quick_view_driver('${item.driver_b_eid}')">${item.driver_b_code} ${item.driver_b_name}</span>`
                    }

                    row+=`</td>
                    <td><span class="text-link"  onclick="open_quick_view_truck('${item.truck_eid}')">${item.truck_code}</span></td>
                    <td><span class="text-link"  onclick="open_quick_view_trailer('${item.trailer_eid}')">${item.trailer_code}</span></td>
            <td>${item.from_datetime}</td>
            <td>${item.to_datetime}</td>
            <td style="text-align:left">${item.location}</td>
            <td style="text-align:left">${item.remarks}</td>
            <td style="text-align:left">${item.reason}</td>
            <td>${item.added_by_user}<br>${item.added_on_datetime}</td>`;
            <?php
        if(in_array('P0362', USER_PRIV)) { ?>
            row+=`<td><button title="Edit" class="btn_grey_c"><a href="user/masters/drivers/drivers-leave-update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button></td>`;
          <?php } ?>

           row+=` </tr>`;
            $('#tabledata').append(row);
          })
           set_pagination({selector:'[data-pagination]',totalPages:data.response.totalPages,currentPage:data.response.currentPage,batch:data.response.batch})
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

<datalist id="quick_list_drivers_for_search"></datalist>

<script type="text/javascript">

  $(document.body).on('change', '[name="quick_list_drivers_search"]' ,function(){
    driver_id_filter=$(`[data-driver-search-rows="${$(this).val()}"]`).data('value');
    if(driver_id_filter!=undefined){
      $('[data-filter="driver_id"]').val(driver_id_filter)
      set_params('driver_id', driver_id_filter);
      set_params('driver_name', $(this).val());
      goto_page(1);
      show_group_list()
    }
  });
  function bind_quick_list_drivers_in_search(){

   quick_list_drivers().then(function(data) {

  // Run this when your request was successful

  if(data.status){



    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option data-driver-search-rows="" data-value="" value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option data-driver-search-rows="`+item.code+' '+item.name+`" data-value="${item.id}" value="`+item.code+' '+item.name+`"></option>`;               

      })

      $('#quick_list_drivers_for_search').html(options);     

    }

  }

}).catch(function(err) {

  // Run this when promise was rejected via reject()

}) 
}
bind_quick_list_drivers_in_search()
</script>
<script type="text/javascript">

  $(document).ready(function(){
   $(document).on("change", "[data-action='update-verification-status']",function(){
    var eid=$(this).data('document-eid');
    var verification_status=$(this).val();
    if(verification_status=='VERIFIED'){
      var url="<?php echo AJAXROOT; ?>"+'user/masters/drivers/documents/verify'
    }else if(verification_status=='REJECTED'){
      var url="<?php echo AJAXROOT; ?>"+'user/masters/drivers/documents/reject'
    }
    $.ajax({
      url:url,
      type:'POST',
      data:{
        document_eid:eid,
        verification_status:verification_status,
      },
      context: this,
      success:function(data){
        
       if((typeof data)=='string'){
         data=JSON.parse(data) 
       }
       alert(data.message)
       if(data.status){
        show_list()
      }else{
        alert(data.message)
      }
    }
  })
    
  });
 });

</script>

<br><br><br><br>


<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>