<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
            <section class="list-200 content-box" style="margin: auto;max-width: 800px">
            <h1 class="list-200-heading">RFC DETAILS</h1>


    <section class="list-200-top-action">
    <div class="list-200-top-action-left">

            <!-- input used for sory by call-->
            <input type="hidden" id="sort_by" value="">
            <!-- //input used for sory by call-->
             <input type='hidden' id='sort' value='asc'>
            



         <div class="filter-item">
        <label>Repair order ID</label>
        <input type="text" placeholder="RO ID/ Reason" data-filter="search" onkeyup="set_params('search', this.value),show_list()">
      </div>
      <div class="filter-item">
        <label>Reason</label>
        <select name="reason" <?php   if(!in_array('P0229', USER_PRIV)) {  echo 'disabled'; } ?> data-default-select="<?php echo $detail['rfc_reason']?>" onchange="set_params('reason', this.value), goto_page(1), show_list()"></select>
      </div>
      <div class="filter-item">
        <label>Last Updated Date From</label>
         <input type="text" data-filter="last_updated_date_from" data-date-picker  onchange="set_params('last_updated_date_from', this.value), goto_page(1), show_list()">
        </select>
      </div>
      <div class="filter-item">
        <label>Last Updated Date To</label>
         <input type="text" data-filter="last_updated_date_to" data-date-picker  onchange="set_params('last_updated_date_to', this.value), goto_page(1), show_list()">
        </select>
      </div>
      <div class="filter-item">
        <label>Last Updated By</label>
        <input type="text" data-filter="updated_by" list="quick_list_updated_by" data-user-id onchange="set_params('updated_by', this.value), goto_page(1), show_list()">
        </select>
      </div>


            <div></div>            

        </div>
      
                
    </section>

            <div class="table  table-a">

                <table data-ro-table>
                   
                    <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th data-table-sort-by="id">Repair order ID</th>
                        <th data-table-sort-by="reason">Reason</th>
                        <th data-table-sort-by="lfu">Last Follow Up</th>
                        <th data-table-sort-by="rfc">RFC by</th>
                        <th data-table-sort-by="resolved">Last Updated by</th>
                        <th data-table-sort-by="status_reason">Last action</th>
                        <th>View</th>
                    </tr>                       
                    </thead>
                    <tbody id="tabledata"></tbody>
                </table>
            </div>
        <div data-pagination></div>
        </section>




<script>
  $(document.body).on('change', "[data-filter='last_updated_date_from']", function() {
    var g1 = new Date(check_url_params('last_updated_date_from'))
    var g2 = new Date(check_url_params('last_updated_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Last Updated Date From should be less than from Last Updated Date To")
      $("[data-filter='last_updated_date_from']").val("").focus();
      set_params('last_updated_date_from', "")
      goto_page(1)
    }
  });

  $(document.body).on('change', "[data-filter='last_updated_date_to']", function() {
    var g1 = new Date(check_url_params('last_updated_date_from'))
    var g2 = new Date(check_url_params('last_updated_date_to'))
    if (g1.getTime() > g2.getTime()) {
      alert("Last Updated Date To should be greater than from Last Updated Date From")
      $("[data-filter='last_updated_date_to']").val("").focus();
      set_params('last_updated_date_to', "")
      goto_page(1)
    }
  });
</script>




<script type="text/javascript">


var url_params = get_params();
  if (url_params.hasOwnProperty('search')) {
    $("[data-filter='search']").val(url_params.search);
  }
  if (url_params.hasOwnProperty('last_updated_date_to')) {
    $("[data-filter='last_updated_date_to']").val(url_params.last_updated_date_to);
  }
  if (url_params.hasOwnProperty('last_updated_date_from')) {
    $("[data-filter='last_updated_date_from']").val(url_params.last_updated_date_from);
  }
  if (url_params.hasOwnProperty('updated_by')) {
    $("[data-filter='updated_by']").val(url_params.updated_by);
  }
  if (url_params.hasOwnProperty('reason')) {
    $("[data-filter='reason']").val(url_params.reason);
  }


function show_list(){

  
  var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
  var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
  var webapi = "pagination";
  var value=$('[data-filter="search"]').val().toUpperCase();
 var sort_by_order_type = $('#sort').val();
 var sort_by = $('#sort_by').val();
 var reason = check_url_params('reason');
 var updated_by = check_url_params('user_id');
 var last_updated_date_from = check_url_params('last_updated_date_from');
 var last_updated_date_to = check_url_params('last_updated_date_to');
 $.ajax({
        url:location.pathname + '-list-ajax',
        type:'POST',
        data:{
            value:value,
            page: page_no,
            sort_by: sort_by,
            batch: batch,
            sort_by_order_type:sort_by_order_type,
            webapi:  webapi,
            reason: reason,
            updated_by:updated_by,
            last_updated_date_to:last_updated_date_to,
            last_updated_date_from:last_updated_date_from


        },
    success: function(data) {
    // Run this when your request was successful
    if ((typeof data) == 'string') {

        data = JSON.parse(data)
          // Run this when your request was successful
  if(data.status){

$('#tabledata').html("");
var counter=0;
$.each(data.response.list, function(index, item) {
    // if(item.name.toUpperCase().includes(value) ||item.city.toUpperCase().includes(value) || item.state.toUpperCase().includes(value) || item.country.toUpperCase().includes(value)){
    counter++;
    var row=``;
    row+=`<tr>`;
    row+=`<td>`+item.sr_no+`</td>`;
    row+=`<td>`+item.name+`</td>`;
    row+=`<td>`+item.reason+`</td>`;
    row+=`<td>`+item.last_follow_up+`</td>`;
    row+=`<td>`+item.rfc_by_user_code+` `+item.rfc_by_user_name+`<br>`+item.rfc_on_date+`</td>`;
    row+=`<td>`+item.resolved_by_user_code+` `+item.resolved_by_user_name+`<br>`+item.resolved_on_date+`</td>`;
    row+=`<td>`+item.last_action+`</td>`;
    
    row+=`<td>`;
<?php if(in_array('P0015', USER_PRIV)){
    ?>
    row+=`<button title="view" class="btn_grey_c"><a href="../user/maintenance/repair-orders/details?eid=`+item.eid+`"><i class="fa fa-eye"></i></a></button>`;
    <?php
} ?>
<?php if(in_array('P0016', USER_PRIV)){
    ?>

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
    if(confirm('Do you want to delete zipcode?')){
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



<datalist id="quick_list_updated_by"></datalist>
<script type="text/javascript">
 $(document.body).on('input', '[data-user-id]' ,function(){
        id_selected=$(`[data-user-id-rows="${$(this).val()}"]`).data('value');
        if(id_selected!=undefined){
         $(this).data('user_id-id', id_selected)
         set_params('user_id', id_selected)
         goto_page(1)
       }
     });

      $(document.body).on('change', '[data-user-id]' ,function(){
       id_selected=$(`[data-user-id-rows="${$(this).val()}"]`).data('value');
       if(id_selected==undefined){
        alert("Please enter correct Last Updated By")
        id_selected=''
        set_params('user_id', '')
        goto_page(1)
        $(this).val('')
        $(this).focus()
      }
    });

  quick_list_users().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options+=`<option data-user-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-user-id-rows="` + item.user_display_name + `" data-value="${item.id}" value="` + item.user_display_name + `"></option>`;
          })
            $('#quick_list_updated_by').html(options);
            if (url_params.hasOwnProperty('updated_by')) 
            {
              $(`[data-user-id]`).val(check_url_params('updated_by'))
            }
        }
    }
}).catch(function(err) {
        // Run this when promise was rejected via reject()  
    })
</script>


<script type="text/javascript">
    function show_reason_filter(){
     get_repair_order_rfc_error().then(function(data) {

      if(data.status){

        if(data.response.list){
          var options="";
          options+=`<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            if(item.status=='Active'){
            options+=`<option value="`+item.id+`">`+item.name+`</option>`; 
            }              
          })
          $('[name="reason"]').html(options);
          select_default('[name="reason"]')  
          if (url_params.hasOwnProperty('reason')) {
            $("[name='reason'] option[value=" + url_params.reason + "]").prop('selected', true);
          }   
        }
      }
    })
  }
  show_reason_filter()
</script>


<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>



<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>