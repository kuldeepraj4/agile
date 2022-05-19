<?php
require_once APPROOT.'/views/includes/user/header.php';
$page=isset($_GET['page'])?$_GET['page']:1;
?>
<style type="text/css">

    .rv{
        background: white;
        padding:5px;
        border-radius:8px;
        box-shadow: 0 0 10px -1px darkgrey;
        font-size: 12px;
    }

    .rv-heading{
        background: white;
        color: var(--theme-color-four);
        font-size:2em;
        text-align: center;
        padding:10px;
        display: block;
    }
    .rv-action-bar{
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
    }
    .rv-action-bar button{
        margin: 0 2px;
    }

    .rv-filter-section{
        background: white;
        padding: 8px;
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
    .rv-filter-section div.filter-item{
        width:100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin:2px;
        padding:2px;
        background:#f2f2f2;
        border: 1px solid #f4f4f4;
        border-radius: 5px;
        flex-grow: 1;
    }
    .rv-filter-section div.filter-item.half{
        width: 50%;
    }
    .rv-filter-section div.filter-item.half{
        width: 32%;
    }
    .rv-filter-section div.filter-item.fourth{
        width: 24%;
    }
    .rv-filter-section div.filter-item label{
        width: 40%;
        flex-grow: 1;
        font-size: 1.2em;
        padding:5px 8px;
        background: #f1f1f1;
        margin-right: 5px;
    }
    .rv-filter-section div.filter-item input,
    .rv-filter-section div.filter-item select{
     width:55%;
     border: none;
 }
 .rv-filter-buttons ul{
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    font-size: 1.2em;
}
.rv-filter-buttons ul li{
    border: 1px solid #f2f2f2;
    border-radius: 5px;
    margin: 3px;
    padding:1px 5px;
    display: flex;
    align-items: center;
    cursor: pointer;
}
.rv-filter-buttons input[type='checkbox']{
    width: 10px;
}
.rv-filter-buttons ul li span{
    display: block;
    padding:1px 3px;
    font-weight: bold;
}

.rv-table{
    background: white;
    width:100%;
    overflow-x: auto;
}


.rv-table-a .rv-table-info{
    display: flex;
    flex-wrap: wrap;
}
.rv-table-a .rv-table-info>div{
    width: 50%;
}

.rv-table-a .rv-table-info>div.full-width{
    width: 100%;
}
.rv-table-a .rv-table-info>div.error-message{
   color: red;
   text-align: center;
   font-size: bolder;
}

.rv-table>table{
    border:1px solid darkgrey;
    border-collapse: collapse;
    background: white;
    box-sizing: border-box;
    width: 100%;
    font-size: 1.1em;
}
.rv-table>table>thead{
    background: #486e94;
    color: white;
}
.rv-table>table>thead>tr>th{
    padding:3px 3px;
    font-weight: normal;
    border: 1px solid grey;
    font-weight: bold;
}
[data-table-sort-by]:after{
    font-family: "Font Awesome 5 Free"; 
    font-weight: 900; 
    content: "\f0dc";
    margin-left: 5px;
    font-size: .8em;
    color: white;
}

[data-table-sort-by-active]:after{
    font-size: 1.1em;
}
.rv-table>table>tbody>tr>td{
    padding:1px 5px;
    border: .5px solid grey;
    text-align: center;
}
.rv-table>table>tbody>tr>td input,
.rv-table>table>tbody>tr>td select{
    height: 1.6em !important;
    font-size: .9em;
    padding: 2px !important;
    margin: 1.5px;
}

.rv-table>table>tbody>tr{
    border-bottom: 1px solid #f0f0f0
}

.rv-table>table>tbody>tr:last-child{
    border-bottom: none;
}
.rv-table>table>tbody>tr>td.act-box i{
    margin:2px 3px;
}

</style>
<section class="rv content-box" style="margin: auto;max-width: 1350px">
    <h1 class="rv-heading">Tickets Summary</h1>

    <section class="rv-action-bar"></section>

<section class="rv-filter-section">
     <!-- input used for sory by call-->
            <input type="hidden" id="sort_by" value="">
            <!-- //input used for sory by call-->
             <input type='hidden' id='sort' value='asc'>


    <div class="filter-item fourth">
        <label>ID</label>
        <input type="text" data-filter="id" onchange="set_params('id',this.value), goto_page(1)">
    </div>            
    <div class="filter-item fourth">
        <label>Priority</label>
        <select data-filter="priority" onchange="set_params('priority',this.value), goto_page(1)"></select>
    </div>

    <div class="filter-item fourth">
        <label>Assigned to User</label>
        <select data-filter="assigned_to_user_id" onchange="set_params('assigned_to_user_id',this.value), goto_page(1)">
        </select>
    </div>
    <div class="filter-item fourth">
        <label>Assigned to Levels</label>
        <select data-filter="assigned_to_level_id" onchange="set_params('assigned_to_level_id',this.value), goto_page(1)">
        </select>
    </div>

<!--     <div class="filter-item fourth">
        <label>Assigned Time</label>
        <select>
          <option value="">- - Sele - -</option>
        </select>
    </div> -->
        <div class="filter-item fourth">
        <label>Assigned Period</label>
        <select data-filter="assigned_date_period" onchange="set_params('assigned_date_period',this.value), goto_page(1)">
          <option value="">- - Select - - </option>
          <option value="TODAY">Today</option>
          <option value="YESTERDAY">Yesterday</option>
          <option value="LAST WEEK">Last Week</option>
          <option value="LAST MONTH">Last Month</option>
          <option value="CUSTOM RANGE">Custom Range</option>
        </select>
    </div>

<!-- <script type="text/javascript">
    $(document.body).on('change', '[data-search-driver]' ,function(){

    driver_id_selected=$(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if(driver_id_selected!=undefined){
      $(this).data('selected-driver-id',driver_id_selected)
    }
  });
</script> -->

    <div class="filter-item fourth">
        <label>Assigned Date From</label>
        <input type="text" data-date-picker="" data-filter="assigned_date_from" onchange="set_params('assigned_date_from',this.value), goto_page(1)">
    </div>
    <div class="filter-item fourth">
        <label>Assigned Date To</label>
        <input data-date-picker="" type="text" data-filter="assigned_date_to" onchange="set_params('assigned_date_to',this.value), goto_page(1)" />
    </div>
    <div class="filter-item fourth"></div>




</section>

<section class="rv-filter-buttons">
    <ul id="rv-filter-buttons-container"></ul>
    <div></div>
</section>
<section>
  <ul style="display: flex;">
    <li style="padding:10px 15px">Average FRT = <span style="font-weight: bold" data-avg-frt></span></li>
    <li style="padding:10px 15px">Average RT = <span style="font-weight: bold" data-avg-rt></span></li>
    <li style="padding:10px 15px">Average NRT = <span style="font-weight: bold" data-avg-nrt></span></li>
  </ul>
</section>
<div class="rv-table table table-a">
    <table>
      <thead>
        <tr>
          <th style="min-width: 70px">Sr. No.</th>
          <th data-table-sort-by="code">ID</th>
          <th data-table-sort-by="assignedby">Assigned By</th>
          <th data-table-sort-by="assignedusers">Assigned to users</th>
          <th >Assigned to Levels</th>
          <th data-table-sort-by="priority" style="min-width: 100px;">Priority</th>
          <th>First Response Time (FRT) Hrs.</th>
          <th >Resolution Time (RT) Hrs.</th>
          <th>Net Resolution Time (NRT) Hrs.</th>
          <th>Closed Time Hrs.</th>
          <th></th>
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

  var assigned_date_from = (check_url_params('assigned_date_from') != undefined) ? check_url_params('assigned_date_from') : '';
  $('[data-filter="assigned_date_from"]').val(assigned_date_from)

  var assigned_date_to = (check_url_params('assigned_date_to') != undefined) ? check_url_params('assigned_date_to') : '';
  var assigned_date_period = (check_url_params('assigned_date_period') != undefined) ? check_url_params('assigned_date_period') : '';
  $('[data-filter="assigned_date_to"]').val(assigned_date_to)
  $(`[data-filter="assigned_date_period"] option[value="${assigned_date_period}"]`).prop('selected',true)

  function show_list(){
    var sort_by_order_type = $('#sort').val();
    var sort_by = $('#sort_by').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    // var sort_by = (check_url_params('sort_by') != undefined) ? check_url_params('sort_by') : '';
    var id = (check_url_params('id') != undefined) ? check_url_params('id') : '';
    $('[data-filter="id"]').val(id);

    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        id:id,
        page:page_no,
        batch:batch,
        sort_by_order_type:sort_by_order_type,
        sort_by: sort_by,
        stage_id:'CLOSED',
        priority:(check_url_params('priority') != undefined) ? check_url_params('priority') : '',
        assigned_to_user_id:(check_url_params('assigned_to_user_id') != undefined) ? check_url_params('assigned_to_user_id') : '',
        assigned_to_level_id:(check_url_params('assigned_to_level_id') != undefined) ? check_url_params('assigned_to_level_id') : '',
        assigned_date_from: (check_url_params('assigned_date_from') != undefined) ? check_url_params('assigned_date_from') : '',
        assigned_date_to: (check_url_params('assigned_date_to') != undefined) ? check_url_params('assigned_date_to') : '',
        assigned_date_period: (check_url_params('assigned_date_period') != undefined) ? check_url_params('assigned_date_period') : ''
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
        console.log(data)
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
             <td style="white-space:nowrap;text-align:left">${item.assigned_to_users.map(e => e.user_display_name).join(",<br>")}</td>
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
  get_ticket_priorities().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="priority"]').html(options);     
      $(`[data-filter="priority"] option[value=${check_url_params('priority')}]`).prop('selected',true);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
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