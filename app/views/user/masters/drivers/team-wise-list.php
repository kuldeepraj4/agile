<?php
require_once APPROOT . '/views/includes/user/header.php'; ?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1000px">
  <h1 class="list-200-heading">Drivers Team Wise List</h1>
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
      <input type='hidden' id='sort' value='asc'>
      <!-- //input used for sory by call-->
      <div class="filter-item">
        <label>Driver</label>
        <input type="hidden" data-filter="driver_id">
        <input type="text" onchange="set_params('driver_id', this.value), goto_page(1)" list="quick_list_drivers_for_search" data-search-driver >
      </div>            
      <div class="filter-item">
        <label>Team</label>
        <select data-filter="team_id" onchange="set_params('team_id', this.value), goto_page(1)" name="team_id"></select>
      </div>
      <div class="filter-item">
        <label> Status</label>
        <select data-filter="team_assignment_status" onchange="set_params('team_assignment_status', this.value), goto_page(1)"  name="team_assignment_status">
          <option value="">ALL</option>
          <option value="ASSIGNED">Assigned</option>
          <option value="UNASSIGNED">Un-Assigned</option>
        </select>
      </div>
      <div class="filter-item"></div>      
    </div>
  </section>
  <div class="table  table-a">
    <table data-ro-table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th data-table-sort-by="code" style="text-align: center;">Driver</th>
          <th>Mobile</th>
          <th style="text-align: center;" data-table-sort-by="team">Team</th>
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
  $('[data-filter="driver_id"]').val(check_url_params('driver_id'))
  $('[data-search-driver]').val(check_url_params('driver_name'))
  $(`[data-filter='team_assignment_status'] option[value="${check_url_params('team_assignment_status')}"]`).prop('selected', true);
  function show_list(){
    var code = check_url_params('code')
    var status = check_url_params('status')
    var sort_by = $('#sort_by').val();
    var sort_by_order_type = $('#sort').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var webapi = "pagination";  
    
    $.ajax({
      url:'user/masters/drivers/team-wise-list-ajax',
      type:'POST',
      data:{
        page: page_no,
        sort_by_order_type:sort_by_order_type,
        sort_by: sort_by,
        batch: batch,
        webapi:  webapi,
        driver_id:check_url_params('driver_id'),
        team_id:check_url_params('team_id'),
        team_assignment_status:check_url_params('team_assignment_status')
      },
      beforeSend:function() {
       show_table_data_loading("[data-ro-table]")
       show_processing_modal();
     },
     complete:function(){
      hide_processing_modal();
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
         <td style="text-align:center">${item.code} ${item.name}</td>
         <td>${item.mobile_number_display}</td>
         <td style="text-align: center;">${item.team}</td>`;
         <?php if(in_array('P0382', USER_PRIV)){ ?>
         row+=         
         `<td style="width:50px;"><button title="Edit" class="btn_grey_c"><a onclick="open_child_window({url:'../user/masters/drivers/update-driver-team?driver-name=${item.code} ${item.name}&eid=`+item.eid+`',width:700,height:500})"><i class="fa fa-pen"></i></a></button></td>`
          <?php } ?>
        row+=`</tr>`;
        $('#tabledata').append(row);
      })
        set_pagination({
    selector: '[data-pagination]',
    totalPages: data.response.totalPages,
    currentPage: data.response.currentPage,
    batch: data.response.batch
  })

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

$(document.body).on('input', '[data-search-driver]' ,function(){
    driver_id_filter=$(`[data-driver-search-rows="${$(this).val()}"]`).data('value');
    if(driver_id_filter!=undefined){
        $('[data-filter="driver_id"]').val(driver_id_filter)
        set_params('driver_id', driver_id_filter);
        set_params('driver_name', $(this).val());
        goto_page(1);
    }
});

  $(document.body).on('change', '[data-search-driver]' ,function(){
    driver_id_filter=$(`[data-driver-search-rows="${$(this).val()}"]`).data('value');
    if(driver_id_filter!=undefined){
        $('[data-filter="driver_id"]').val(driver_id_filter)
        set_params('driver_id', driver_id_filter);
        set_params('driver_name', $(this).val());
        goto_page(1);
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
  quick_list_driver_teams().then(function(data) {
  // Run this when your request was successful

  if(data.status){



    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option value="${item.id}">${item.name}</option>`;               

      })

      $('[data-filter="team_id"]').html(options);
      $(`[data-filter='team_id'] option[value="${check_url_params('team_id')}"]`).prop('selected', true);     

    }

  }

})
</script>
<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>
<?php require_once APPROOT . '/views/includes/user/footer.php';
?>
