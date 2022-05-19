<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1000px">
  <h1 class="list-200-heading">Trucks Documents Pending Uploads</h1>

    <section class="list-200-top-action">
    <div class="list-200-top-action-left">

      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
      <input type="hidden" data-filter="driver_id"  value="">
      <!-- //input used for sory by call-->

      <div class="filter-item">
        <label>Search Truck</label>
        <input type="text" data-selected-truck-id=""  list="truck_id_search" name="truck_id_search" >
      </div>            
      <div class="filter-item">
        <label>Document Type</label>
        <select data-filter="document_type_id" onchange="show_list({})"></select>
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
          <th style='text-align:left'>Truck ID</th>
          <th style='text-align:left'>Document</th>
          <th>Is Required</th>
          <th>Upload</th>
          <th>Notes</th> 
        </tr>                       
      </thead>

      <tbody id="tabledata">
      </tbody>
    </table>
    </div>
<div data-pagination></div>
</section>


<script type="text/javascript">

    $.ajax({
      url:"<?php echo AJAXROOT; ?>"+'user/masters/trucks/document-types-ajax',
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
      }
    }

  }

})

</script>
<datalist id="truck_id_search"></datalist>
<script type="text/javascript">

  $(document.body).on('change', '[name="truck_id_search"]' ,function(){

    truck_id_selected=$(`[data-truck-filter-rows="${$(this).val()}"]`).data('value');
    if(truck_id_selected!=undefined){
      $(this).data('selected-truck-id',truck_id_selected)
      show_list({})
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
    page=1;
    if(param.hasOwnProperty('page_no')==true){
      page=param.page_no;
    }


    $.ajax({
      url:window.location.pathname+'-ajax',
      type:'POST',
      data:{
        page:page,
        document_type_id:$('[data-filter="document_type_id"]').val(),
        truck_id:$('[name="truck_id_search"]').data('selected-truck-id'),
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

              row +=`
              <td style="white-space:nowrap">
              <button disabled style="cursor:auto"><i class="fa fa-upload"></i></button>`

              <?php if(in_array('P0145', USER_PRIV)){
                ?>
                row+=`<button title="Edit" class="btn_grey_c"><a href="../user/masters/trucks/documents/upload?truck_eid=${item.truck_eid}&document_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-upload"></i></a></button>`;
                <?php
              } ?>
            

            row+=`<td style="white-space:nowrap">
            <button title="Notes" class="btn_grey_c" onclick="open_notes({url:'../user/miscellaneous/notes/details?reference=TRUCK-DOCUMENT&eid=${item.truck_eid}&document-type-eid=${item.type_eid}'})"><i class="fa fa-sticky-note"></i></a></button></td>`

            row+=`</tr>`

            $('#tabledata').append(row);


          })
           set_pagination({selector:'[data-pagination]',totalPages:data.response.totalPages,currentPage:data.response.currentPage})

         }else{
          var false_message=`<tr><td colspan="18">`+data.message+`<td></tr>`;
          $('#tabledata').html(false_message);
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
    
  });
 });

</script>

<br><br><br><br>


<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>