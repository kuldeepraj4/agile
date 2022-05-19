<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1400px">
  <h1 class="list-200-heading">All Trucks Documents</h1>

    <section class="list-200-top-action">
    <div class="list-200-top-action-left">

      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
      <input type='hidden' id='sort' value='asc'>
      <input type="hidden" data-filter="driver_id"  value="">
      <!-- //input used for sory by call-->

      <div class="filter-item">
        <label>Search Truck</label>
        <input type="text" data-selected-truck-id=""  onchange="set_params('truck_id_search', this.value), goto_page(1)" list="truck_id_search" name="truck_id_search" >
      </div>            
      <div class="filter-item">
        <label>Document Type</label>
        <select data-filter="document_type_id" onchange="set_params('document_type_id', this.value), goto_page(1)"></select>
      </div>
    </div>
    <div class="list-200-top-action-right">
    </div>

  </section>


  <div class="table  table-a">
    <table data-table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th style='text-align:left' data-table-sort-by="id">Truck ID</th>
          <th style='text-align:left' data-table-sort-by="document">Document Type</th>
          <th>Is Required</th>
          <th>Is Uploaded</th>
          <th data-table-sort-by="expiryleft">Expiry Days Left</th>
          <th data-table-sort-by="expiryd">Expiry Date</th>
          <th></th>
          <th>Verify</th>
          <th>Uploaded By</th>
          <th>Verified By</th>  
          <th>Rejected By</th>  
          <th>Remarks</th>
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

   var url_params = get_params();
  if (url_params.hasOwnProperty('truck_id_search')) {
    $("[name='truck_id_search']").val(url_params.truck_id_search);
  }


    $.ajax({
      url:"<?php echo AJAXROOT; ?>"+'user/dropdown/truck-document-types-ajax',
      type:'POST',
      data:{},
      success:function(data){
       if((typeof data)=='string'){
         data=JSON.parse(data)
         $('#tabledata').html("");
          options='<option value=""> - - Select - - </option>';
         if(data.status){   
         
      $.each(data.response.list, function(index, item) {
        options+=`<option value="${item.id}">${item.name}</option>`;               
      })

      $('[data-filter="document_type_id"]').html(options); 
      if (url_params.hasOwnProperty('document_type_id')) {
           $("[data-filter='document_type_id'] option[value=" + url_params.document_type_id + "]").prop('selected', true);
        }
      }
    }

  }

})

</script>
<datalist id="truck_id_search"></datalist>
<script type="text/javascript">
  
 $(document.body).on('input', '[name="truck_id_search"]', function() {
    //alert("hhhh")
    truck_id_selected=$(`[data-truck-filter-rows="${$(this).val()}"]`).data('value');
    if(truck_id_selected!=undefined){
      $(this).data('selected-truck-id',truck_id_selected)
      goto_page(1)
    }
  });

  $(document.body).on('change', '[name="truck_id_search"]' ,function(){

    truck_id_selected=$(`[data-truck-filter-rows="${$(this).val()}"]`).data('value');
    if(truck_id_selected!=undefined){
      $(this).data('selected-truck-id',truck_id_selected)
      goto_page(1)
    }else{
      alert("Please enter correct truck ID")
          $(this).data('selected-truck-id',"")
          $(`[name="truck_id_search"]`).val('').focus();
     
         goto_page(1);
    }
  });






  function bind_quick_list_trucks(){

   get_trucks().then(function(data) {

  // Run this when your request was successful

  if(data.status){
    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option data-truck-filter-rows="" data-name="" data-value="" value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option data-truck-filter-rows="`+item.code+`" data-value="${item.id}"  value="`+item.code+`"></option>`;               

      })

      $('#truck_id_search').html(options);     

    }

  }

}).catch(function(err) {

  // Run this when promise was rejected via reject()

}) 

}

bind_quick_list_trucks()

</script>




<script type="text/javascript">
     
  function show_list(param){

      var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
  var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
  var webapi = "pagination";
 var sort_by = $('#sort_by').val();
     var sort_by_order_type = $('#sort').val();
     var is_required = (check_url_params('is_required') != '') ? check_url_params('is_required') : check_url_params('is-required');
    var is_uploaded = (check_url_params('is_uploaded') != '') ? check_url_params('is_uploaded') : check_url_params('is-uploaded');
    var document_type_id = check_url_params('document_type_id');
    var truck_id_search = check_url_params('truck_id_search');
    $.ajax({
      url:window.location.pathname+'-ajax',
      type:'POST',
      data:{
        page:page_no,
        sort_by_order_type:sort_by_order_type,
        sort_by: sort_by,
        batch:batch,
        webapi:  webapi,
        document_type_id:document_type_id,
        truck_code: truck_id_search,
        is_uploaded:is_uploaded,
        is_required:is_required,
        is_expired:'<?php echo $data['is_expired']; ?>',
        expiry_alert:'<?php echo $data['expiry_alert']; ?>',
        verification_status:'<?php echo $data['verification_status']; ?>'
      },
      beforeSend:function(){
        show_table_data_loading('[data-table]')
      },
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
           var counter=0;

           $.each(data.response.list, function(index, item) {
            let required_option_class='cross-red'
            if(item.type_required_option){
              required_option_class='check-green'
            }

            let remarks="";
            let row=`<tr>
            <td>${item.sr_no}</td>
            <td style='text-align:left'>${item.truck_code}</td>
            <td style='text-align:left'>${item.type_name}</td>
            <td><span class='${required_option_class}'><span></td>`


            if(item.is_uploaded){
              remarks=item.document_details.remarks;

              if(get_params().hasOwnProperty('expiry-alert')){
              var expiry_alert = 'bg-orange text-white';
            } if(get_params().hasOwnProperty('is-expired')){
              var expiry_alert='bg-red text-white';
            }

            

             row += `<td><span class='check-green'><span></td>`;
                 if(item.document_details.is_expired == true){
                row += ` <td class='bg-red text-white'>${item.document_details.expiry_days_left}</td>`;
                }else

                if(item.document_details.expiry_alert == true){
                row += ` <td class='bg-orange text-white'>${item.document_details.expiry_days_left}</td>`;
                }else
                  if(item.document_details.expiry_days_left != ""){
                      row += ` <td>${item.document_details.expiry_days_left}</td>`;
                 }else{
                   row += `<td></td>`;
                 }
             
            


              //let expiry_alert=(item.document_details.expiry_alert)?'bg-red text-white':'';

            

              row +=`<td>${item.document_details.expiry_date}</td>
              <td style="white-space:nowrap">
              <button class='btn_grey_c' onclick="open_document('${item.document_details.file_path}')"><i class='fa fa-file'></i></button>`



              <?php if(in_array('P0147', USER_PRIV)){
                ?>
                row+=`<button title="Edit" class="btn_grey_c"><a href="../user/masters/trucks/documents/upload?truck_eid=${item.truck_eid}&document_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-upload"></i></a></button>`;
                <?php
              } ?>



              if(item.document_details.verification_status=='PENDING'){

                <?php if(in_array('P0148', USER_PRIV)){
                  ?>
                  row+=`<td>
                  <select data-action="update-verification-status" data-document-eid="${item.document_details.eid}">
                  <option value="" > Select</option>
                  <option value="VERIFIED"> VERIFY </option>
                  <option value="REJECTED"> REJECT </option>
                  </select>
                  </td>`
                  <?php
                }else{
                  ?>
                  row+=`<td></td>`
                  <?php
                }

                ?>




              }else{
                row+=`<td>${item.document_details.verification_status}</td>`;
              }




              row+=`<td>${item.document_details.added_by_user_code} <br>${item.document_details.added_by_user_name} <span style="white-space:nowrap"> ${item.document_details.added_on_datetime}</span></td>
              <td>${item.document_details.verified_by_user_code} <br> ${item.document_details.verified_by_user_name} <br> <span style="white-space:nowrap"> ${item.document_details.verified_on_datetime}</span></td>
              <td>${item.document_details.rejected_by_user_code} <br> ${item.document_details.rejected_by_user_name} <span style="white-space:nowrap"> ${item.document_details.rejected_on_datetime}</span></td>
              `
            }else{
              row +=`<td><span class='cross-red'><span></td>
              <td></td>
              <td></td>
              <td style="white-space:nowrap">
              <button disabled style="cursor:auto"><i class="fa fa-upload"></i></button>`

              <?php if(in_array('P0147', USER_PRIV)){
                ?>
                row+=`<button title="Edit" class="btn_grey_c"><a href="../user/masters/trucks/documents/upload?truck_eid=${item.truck_eid}&document_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-upload"></i></a></button>`;
                <?php
              } ?>
              row+=`<td></td>
              <td></td>
              <td></td>
              <td></td>`

            }
            if(remarks != null){
            row+=`<td>${remarks}</td>`
          }else{
              row+=`<td></td>` 
          }
           row+=` <td style="white-space:nowrap">
            <button title="History" class="btn_grey_c"><a href="../user/masters/trucks/documents/document-history?truck_eid=${item.truck_eid}&document_type_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-history"></i></a></button>

            <button title="Notes" class="btn_grey_c" onclick="open_notes({url:'../user/miscellaneous/notes/details?reference=TRUCK-DOCUMENT&eid=${item.truck_eid}&document-type-eid=${item.type_eid}'})"><i class="fa fa-sticky-note"></i></a></button></td>`

            row+=`</tr>`

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
           $('[data-pagination]').html('');
        }
      }

    }

  })
}
show_list({})

</script>

<script type="text/javascript">

  $(document).ready(function(){
   $(document).on("change", "[data-action='update-verification-status']",function(){
     if (confirm('Are you sure to change the verification status ?')) {
    var eid=$(this).data('document-eid');
    var verification_status=$(this).val();
    if(verification_status=='VERIFIED'){
      var url="<?php echo AJAXROOT; ?>"+'user/masters/trucks/documents/verify'
    }else if(verification_status=='REJECTED'){
      var url="<?php echo AJAXROOT; ?>"+'user/masters/trucks/documents/reject'
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
     }else{
      $("[data-action='update-verification-status']").prop('selectedIndex', 0);
    }
  });
 });

</script>
<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>

<br><br><br><br>


<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>