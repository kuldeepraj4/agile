<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width:1300px">
  <h1 class="list-200-heading">Users</h1>
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
             <input type='hidden' id='sort' value='asc'>


      <div class="filter-item">
        <label>User ID</label>
        <input type="text" data-filter="code" onkeyup="set_params('code', this.value), goto_page(1)">
      </div>
      <div class="filter-item">
        <label>Status</label>
        <select data-filter="status_id" onchange="set_params('status_id', this.value), goto_page(1)"></select>
      </div>
      <div class="filter-item">
        <label>Name</label>
        <input type="text" data-filter="name" onchange="set_params('name', this.value), goto_page(1)"></select>
      </div>
      <div class="filter-item"></div>            

    </div>
    <div class="list-200-top-action-right">
      <div>
        <?php
        if(in_array('P0003', USER_PRIV)){
          echo "<button class='btn_grey button_href'><a href='../user/masters/users/add-new'>Add New</a></button>";
        }
        ?>
      </div>
    </div>

  </section>
  <div class="table  table-a">
    <table data-ro-table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th data-table-sort-by="code" style="text-align: left;">User ID</th>
          <th style="text-align: left;"  data-table-sort-by="name">Name</th>
          <th>Mobile No.</th>
          <th>Email</th>
          <th data-table-sort-by="status">Status</th>
         
          <th>Assigned Roles Groups</th>
          
           <?php  if(in_array('P0003', USER_PRIV)){ ?>
          <th></th>
          <?php } ?>
          <th>action</th>
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
  if (url_params.hasOwnProperty('status_id')) {
    $("[data-filter='status_id']").val(url_params.status_id);
  }
   if (url_params.hasOwnProperty('name')) {
    $("[data-filter='name']").val(url_params.name);
  }
</script>

<script type="text/javascript">
  function show_list(){
   var sort_by_order_type = $('#sort').val();
 var sort_by = $('#sort_by').val();
  var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
  var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10
  var webapi = "pagination";
  var name = $('[data-filter="name"]').val().toUpperCase();
    var code= $('[data-filter="code"]').val().toUpperCase();
    var status_id = $('[data-filter="status_id"]').val();
    if(status_id == 'All') {
      status_id = "";
    }
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        value:code,
        page: page_no,
        sort_by_order_type:sort_by_order_type,
        sort_by: sort_by,
        batch: batch,
        webapi:  webapi,
        status_id:status_id,
        user_name:name,
      },
       
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
          var counter=0;    
          $.each(data.response.list, function(index, item) {
            console.log(item)
            if(item.code.toUpperCase().includes(code)){       
             counter++;
             var row=``;
             row+=`<tr>`;
             row+=`<td>`+item.sr_no+`</td>`;
             row+=`<td style="text-align:left">`+item.code+`</td>`;
             row+=`<td style="white-space:nowrap;text-align:left">`+item.name+` `+item.middle_name+` `+item.last_name+`</td>`;
             if(item.mobile){
             row+=`<td>+`+item.mobile_cc+` `+item.mobile+`</td>`;
             }else{
              row+=`<td></td>`;
             }
             row+=`<td>`+item.email+`</td>`;
             row+=`<td>`+item.status+`</td>`;

             if(item.status != 'Terminated'){

             row+=`<td>`+item.roles_group.join(',<br>')+`</td>`;
           }else{
            row+=`<td></td>`;
           }

           <?php  if(in_array('P0005', USER_PRIV)){ ?>
             row+=`<td><a style="color:blue" href="../user/masters/users/assign-roles-group?eid=`+item.eid+`">Assign Roles</a></td>`;
               <?php  } ?>
             row+=`<td style="white-space:nowrap">`;
             <?php 
             if(in_array('P0005', USER_PRIV)){
              ?>
             
               row+=`<button title="Edit" class="btn_grey_c"><a href="../user/masters/users/update?eid=`+item.eid+`&page="><i class="fa fa-pen"></i></a></button>`;
             
              <?php
            }
            if(in_array('P0004', USER_PRIV)){
            ?>

            
             row+=`<button title="view" class="btn_grey_c" ><a href="../user/masters/users/users-details?eid=`+item.eid+`"><i class="fa fa-eye"></i></a></button>`;
            <?php 
          }

            if(in_array('PADMIN', USER_PRIV)){
              ?>
              row+=`<button title="Edit Password" class="btn_grey_c"><a href="../user/masters/users/password-update?eid=`+item.eid+`"><i class="fa fa-lock"></i></a></button>`;
              <?php
            }  
            ?>


            <?php

            if(in_array('P0336', USER_PRIV)){
              ?>
              if(item.approval_status!=='VERIFIED' || item.approval_status==''){
                row+=` <td><a title="Compare History" href="../user/masters/users/users-verify?eid=${item.eid}" title="Verify Trucks"><button class="btn_blue">Verify</button></a></td>`;
              }else  if(item.approval_status=='VERIFIED'){
               row+=`<td><a href="../user/quick-details/quick-history-details?reference=users&eid=${item.eid}" title="Compare History"><button class="btn_blue">Compare</button></a></td>`;
             }

           <?php } ?>



            row+=`</td>`; 
            row+=`</tr>`;
            $('#tabledata').append(row);
          } set_pagination({
    selector: '[data-pagination]',
    totalPages: data.response.totalPages,
    currentPage: data.response.currentPage,
    batch: data.response.batch
  })
         
        })

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
  

</script>


<script type="text/javascript">
  function show_employee_status_id_options(){
   get_employees_status().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="All">All</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="status_id"]').html(options);     
      //$('[data-filter="status_id"] option:contains("Active")').prop('selected', true)
      if (url_params.hasOwnProperty('status_id')) {
        $("[data-filter='status_id'] option[value=" + url_params.status_id + "]").prop('selected', true);
      }
      show_list()    
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_employee_status_id_options()

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