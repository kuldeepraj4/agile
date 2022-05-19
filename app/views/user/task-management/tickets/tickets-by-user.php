<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1250px">
  <h1 class="list-200-heading">Tickets By Me</h1>

  <section class="list-200-top-action">
    <div class="list-200-top-action-left">

       <!-- input used for sory by call-->
            <input type="hidden" id="sort_by" value="">
            <!-- //input used for sory by call-->
             <input type='hidden' id='sort' value='asc'>

      <div class="filter-item">
        <label>ID</label>
        <input type="text" data-filter="id" onkeyup="show_list()">

      </div>            
      <div class="filter-item">
        <!--<label>Status</label>
        <select data-filter="status" onchange="show_list()">
        </select>-->
      </div>

    </div>
    <div class="list-200-top-action-right">
      <div>

        <button class='btn_grey button_href'><a href='../user/task-management/tickets/create-new'>Add New</a></button>
      </div>
    </div>

  </section>
  <div class="table  table-a">
    <table>
      <thead>
        <tr>
          <th style="min-width: 70px">Sr. No.</th>
          <th data-table-sort-by="code">ID</th>
          <th data-table-sort-by="text" style="text-align:left">Text</th>
          <th data-table-sort-by="status" style="min-width: 100px;">Status</th>
          <th data-table-sort-by="priority" style="min-width: 100px;">Priority</th>
          <th data-table-sort-by="duedate">Due Date</th>
          <th>Assigned to Levels</th>
          <th>Assigned to users</th>
          <th>Resolved by & Datetime</th>
          <th>Created by & Datetime</th>
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
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var webapi = "pagination";
    
    var id=$('[data-filter="id"]').val();
    var company_id=$('[data-filter="company"]').val();
     var sort_by_order_type = $('#sort').val();
      var sort_by = $('#sort_by').val();
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        id:id,
        batch: batch,
         sort_by_order_type:sort_by_order_type,
        sort_by: sort_by,
        page: page_no,
         webapi:  webapi,
        stage_id:'<?php echo $data['stage_id']; ?>'
      },
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data)
         console.log(data)
         $('#tabledata').html("");
         if(data.status){
          var counter=0;    
          
          $.each(data.response.list, function(index, item) {

            $('#tabledata').append(`<tr>
             <td>${++counter}</td>
             <td>${item.id}</td>
             <td style="white-space:pre-line;text-align:left;max-width:450px;">${item.text.substr(0, 90)}</td>
             <td>${item.stage}</td>
             <td>${item.priority}</td>
             <td>${item.due_date}</td>
             <td style="text-align:left">${item.assigned_to_levels.map(e => e.level_name).join(" ,<br>")}</td>
             <td style="white-space:nowrap;text-align:left">${item.assigned_to_users.map(e => e.user_display_name).join(",<br>")}</td>
             <td>${item.resolved_by_user_name} <br>${item.resolved_on_datetime}</td>
             <td>${item.added_by_user_code} <br>${item.added_on_datetime}</td>
             <td  style="white-space:nowrap;">
             <button title="View" class="btn_grey_c"><a href="../user/task-management/tickets/details?eid=${item.eid}"><i class="fa fa-eye"></i></a></button>
             <button title="Edit" class="btn_grey_c"><a href="../user/task-management/tickets/update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button>
             <button title="Delete" class="btn_grey_c" data-eid=${item.eid}" data-action="delete"><i class="fa fa-trash"></i></a></button>
             </td>
             </tr>`);

          })
          set_pagination({
    selector: '[data-pagination]',
    totalPages: data.response.totalPages,
    currentPage: data.response.currentPage,
    batch: data.response.batch
  })
        }

        else{
          var false_message=`<tr><td colspan="18">`+data.message+`<td></tr>`;
          $('#tabledata').html(false_message);
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