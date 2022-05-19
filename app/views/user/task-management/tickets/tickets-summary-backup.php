<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1650px">
  <h1 class="list-200-heading">Tickets Summary</h1>

  <section class="list-200-top-action">
    <div class="list-200-top-action-left">

      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
      <!-- //input used for sory by call-->


      <div class="filter-item">
        <label>ID</label>
        <input type="text" data-filter="id" onchange="set_params('id',this.value), goto_page(1)">

      </div>            
      <div class="filter-item">
        <label>Status</label>
        <select data-filter="stage" onchange="set_params('stage',this.value), goto_page(1)">
        </select>
      </div>

      <div class="filter-item">
        <label>Assigned to User</label>
        <select data-filter="assigned_to_user_id" onchange="set_params('assigned_to_user_id',this.value), goto_page(1)">
        </select>
      </div>
      <div class="filter-item">
        <label>Assigned to Levels</label>
        <select data-filter="assigned_to_level_id" onchange="set_params('assigned_to_level_id',this.value), goto_page(1)">
        </select>
      </div>

    </div>

  </section>
<section>
  <ul style="display: flex;">
    <li style="padding:10px 15px">Average FRT = <span style="font-weight: bold" data-avg-frt></span></li>
    <li style="padding:10px 15px">Average RT = <span style="font-weight: bold" data-avg-rt></span></li>
    <li style="padding:10px 15px">Average NRT = <span style="font-weight: bold" data-avg-nrt></span></li>
  </ul>
</section>

  <div class="table  table-a">
    <table>
      <thead>
        <tr>
          <th style="min-width: 70px">Sr. No.</th>
          <th>ID</th>
          <th>Assigned By</th>
          <th>Assigned to users</th>
          <th>Assigned to Levels</th>
          <th style="min-width: 100px;">Priority</th>
          <th>First Response Time (FRT) Hrs.</th>
          <th>Resolution Time (RT) Hrs.</th>
          <th>Net Resolution Time (NRT) Hrs.</th>
          <th>Closed Time Hrs.</th>
        </tr>                       
      </thead>
      <tbody id="tabledata"></tbody>
    </table>
    </div>
<div data-pagination></div>
</section>

<script type="text/javascript">
  var stage = (check_url_params('stage') != undefined) ? check_url_params('stage') : '';
  var assigned_to_user_id = (check_url_params('assigned_to_user_id') != undefined) ? check_url_params('assigned_to_user_id') : '';
  var assigned_to_level_id = (check_url_params('assigned_to_level_id') != undefined) ? check_url_params('assigned_to_level_id') : '';
  function show_list(){
    var sort_by=$('#sort_by').val();
    

    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var sort_by = (check_url_params('sort_by') != undefined) ? check_url_params('sort_by') : '';
    var id = (check_url_params('id') != undefined) ? check_url_params('id') : '';
    $('[data-filter="id"]').val(id);

    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        id:id,
        page:page_no,
        batch:batch,
        stage_id:'CLOSED',
        assigned_to_user_id:(check_url_params('assigned_to_user_id') != undefined) ? check_url_params('assigned_to_user_id') : '',
        assigned_to_level_id:(check_url_params('assigned_to_level_id') != undefined) ? check_url_params('assigned_to_level_id') : '',
      },
      beforeSend:function(data){
        show_processing_modal()
        $('[data-avg-frt]').html('')
        $('[data-avg-rt]').html('')
        $('[data-avg-nrt]').html('')
      },
      complete:function(data){
        hide_processing_modal()
      },
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data)
         console.log(data)
         $('#tabledata').html("");
         if(data.status){
          var counter=0;    
        $('[data-avg-frt]').html(data.response.other_results.average_frt)
        $('[data-avg-rt]').html(data.response.other_results.average_rt)
        $('[data-avg-nrt]').html(data.response.other_results.average_nrt)
          $.each(data.response.list, function(index, item) {

            $('#tabledata').append(`<tr>
             <td>${item.sr_no}</td>
             <td>${item.id}</td>
             <td>${item.added_by_user_name}<br>${item.added_on_datetime}</td>
             <td style="white-space:nowrap;text-align:left">${item.assigned_to_users.map(e => e.user_name).join(",<br>")}</td>
             <td style="text-align:left">${item.assigned_to_levels.map(e => e.level_name).join(" ,<br>")}</td>
             <td>${item.priority}</td>
             <td style"text-align:right">${item.first_response_time}</td>
             <td style"text-align:right">${item.resolution_time}</td>
             <td style"text-align:right">${item.net_resolution_time}</td>
             <td style"text-align:right">${item.closed_time}</td>            
             <td  style="white-space:nowrap;">
             <button title="View" class="btn_grey_c"><a href="../user/task-management/tickets/details?eid=${item.eid}"><i class="fa fa-eye"></i></a></button></td>
             </tr>`);

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
<script type="text/javascript">

  $(document).ready(function(){
   $(document).on("click", "[data-action='delete']",function(){
    if(confirm('Do you want to delete ?')){
      var eid=$(this).data("eid");
      $.ajax({
        url:'../user/task-management/tickets/tickets-by-user/delete-action',
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

 get_tickets_stages().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="stage"]').html(options);     
      $(`[data-filter="stage"] option[value=${stage}]`).prop('selected',true);     
    }
  }
}).catch(function(err){
})
</script>


<script type="text/javascript">
  quick_list_users().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="${item.id}">${item.name}</option>`;               
      })
      $('[data-filter="assigned_to_user_id"]').html(options);
      $(`[data-filter="assigned_to_user_id"] option[value="${assigned_to_user_id}"]`).prop('selected',true);
    }
  }
})
</script>
<script type="text/javascript">
  quick_list_hierarchy_levels().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="${item.id}">${item.name}</option>`;               
      })
      $('[data-filter="assigned_to_level_id"]').html(options);
      $(`[data-filter="assigned_to_level_id"] option[value="${assigned_to_level_id}"]`).prop('selected',true);
    }
  }
})
</script>

<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>
<br>
<br>
<br>
<br>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>