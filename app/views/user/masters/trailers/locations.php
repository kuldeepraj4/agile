<?php
require_once APPROOT . '/views/includes/user/header.php'; ?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1000px">
  <h1 class="list-200-heading">Trailers Locations Status</h1>
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
        <div class="filter-item fourth">
            <label>Trailer ID</label>
            <input type="hidden" data-filter="trailer_id">
            <input type="text" list="quick_list_trailer_search" data-search-trailer>
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
           <?php if(in_array('P0389', USER_PRIV)){ ?>
          <th style="text-align: left;">Update Type</th>
          <?php }?>
          <th style="text-align: left;">Device</th>
          <th style="text-align: left;">Location</th>
          <th style="text-align: left;">Longitude</th>
          <th style="text-align: left;">Latitude</th>
          <th style="text-align: left;">Last Message Dateime</th>
          <th style="text-align: left;">Updated By</th>
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
      $('[data-filter="trailer_id"]').val(check_url_params('trailer_id'))
    $('[data-search-trailer]').val(check_url_params('trailer_name'))
  function show_list(){
    var sort_by = $('#sort_by').val();
    var sort_by_order_type = $('#sort').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var code = check_url_params('code')
    var status = check_url_params('status')
    var webapi = "pagination";
    $.ajax({
      url:'../user/dispatch/tracking/trailers/locations-ajax',
      type:'POST',
      data:{
        page: page_no,
        sort_by: sort_by,
        sort_by_order_type:sort_by_order_type,
        batch: batch,
        trailer_id: check_url_params('trailer_id'),
        status_id:status,
        webapi:  webapi
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

          udpate_type_button_class=(item.update_type=='AUTO')?'toggle-on':'toggle-off'
          edit_button_display=(item.update_type=='AUTO')?'none':''
          row=`<tr data-trailer-eid="${item.eid}">
          <td>${item.sr_no}</td>
          <td style="text-align:left">${item.code}</td>`;
           <?php if(in_array('P0389', USER_PRIV)){ ?>
          row+=` 
          <td style="text-align: left;"><span>${item.update_type}</span> <i data-type="${item.update_type}" data-action="toggle-update-type" class="ic ${udpate_type_button_class}"></i></td>`
          <?php } ?>
          row+=`
          <td style="text-align: left; max-width:150px">${item.device_company_name}</td>
          <td style="text-align: left; max-width:150px">${item.location}</td>
          <td style="text-align: left; max-width:150px">${item.longitude}</td>
          <td style="text-align: left; max-width:150px">${item.latitude}</td>
          <td style="text-align: left; max-width:150px">${item.message_on}</td>
          <td style="text-align: left; max-width:150px">${item.updated_by}</td>`;
          <?php if(in_array('P0389', USER_PRIV)){ ?>
          row+=`<td>
          <i style="display:${edit_button_display}" data-display-edit-button onclick="open_child_window({url:'../user/masters/trailers/locations/update?eid=${item.eid}&location=${item.location}&longitude=${item.longitude}&latitude=${item.latitude}&trailer-code=${item.code}',width:700,height:500,name:'update-trailer-location'})" class="ic edit" title="Update location"></i>
          </td>`;
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

<script type="text/javascript">

  $(document).ready(function(){
   $(document).on("click", "[data-action='update-engine-hours']",function(){
    if(confirm('Do you want to update?')){
      var eid=$(this).parents('tr').data('trailer-eid');
      var current_reading=$(this).parents('tr').find('[name="current_reading"]').val()
      $.ajax({
        url:window.location.pathname+'/../update-engine-hours-action',
        type:'POST',
        data:{
          trailer_eid:eid,
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
  $(document).ready(function(){
    $(document).on("click", "[data-action='toggle-update-type']",function(){
      toggle_status=$(this).data('type');
      new_update_type=($(this).data('type')=='MANUAL')?'AUTO':'MANUAL';
      var eid=$(this).parents('tr').data("trailer-eid");
      $.ajax({
        url:'../user/masters/trailers/locations/toggle-update-type-action',
        type:'POST',
        data:{
          update_eid:eid,
          location_update_type:new_update_type
        },
        context: this,
        success:function(data){
          if((typeof data)=='string'){
            data=JSON.parse(data) 
          }

          if(data.status){
            if(new_update_type=='AUTO'){
              $(this).siblings('span').html('AUTO');
              $(this).removeClass('toggle-off');
              $(this).addClass('toggle-on');
              $(this).parents('tr').find('[data-display-edit-button]').css('display','none')
            }else{
             $(this).siblings('span').html('MANUAL');
              $(this).addClass('toggle-off');
              $(this).removeClass('toggle-on');
              $(this).parents('tr').find('[data-display-edit-button]').css('display','block')              
            }
            $(this).data('type',new_update_type)
          }else{
            alert(data.message)
          }
        }
      })
    });
  });
</script>


<datalist id="quick_list_trailer_search"></datalist>
<script type="text/javascript">
    $(document.body).on('change', '[data-search-trailer]', function() {
        trailer_id_filter = $(`[data-trailer-search-rows="${$(this).val()}"]`).data('value');
        if (trailer_id_filter != undefined) {
            $('[data-filter="trailer_id"]').val(trailer_id_filter)
            set_params('trailer_id', trailer_id_filter);
            set_params('trailer_name', $(this).val());
            goto_page(1);
            show_group_list()
        }
    });
    quick_list_trailers().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
            //Run this if response has list
            if (data.response.list) {
                var options = "";
                options += `<option data-trailer-search-rows="" data-value="" value="">- - Select - -</option>`
                $.each(data.response.list, function(index, item) {
                    options += `<option data-trailer-search-rows="` + item.code + `" data-value="${item.id}" value="` + item.code + `"></option>`;
                })
                $('#quick_list_trailer_search').html(options);
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
