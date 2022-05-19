<?php
require_once APPROOT.'/views/includes/user/header.php';
$driver_name=isset($_GET['driver_name'])?$_GET['driver_name']:'';
$driver_code=isset($_GET['driver_code'])?$_GET['driver_code']:'';
$driver_eid=isset($_GET['eid'])?$_GET['eid']:'';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1300px">
  <h1 class="list-200-heading">Driver Documents </h1>
  <p style="text-align:center;font-size:1em;"><?php echo $driver_code.' '.$driver_name ?></p>


    <section class="list-200-top-action">
        <div class="list-200-top-action-left">
            

            <div class="filter-item">
                <label>Driver Search</label>
            <input type="text" data-filter="code" name="quick_list_drivers_search" list="quick_list_drivers">
            </div>
            <div class="filter-item"></div>            


           
        </div>
        <div class="list-200-top-action-right">
            <div>
            <?php
            // if(in_array('P0008', USER_PRIV)){
            //     echo "<button class='btn_grey button_href'><a href='../user/masters/drivers/add-new'>Add New</a></button>";
            // }
            ?>
        </div>
        </div>
                
    </section>

  <div class="table  table-a">
    <table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th style='text-align:left'>Document Name</th>
          <th>Is Required</th>
          <th>Is Uploaded</th>
          <th>Expiry Days Left</th>
          <th>Issue Date</th>
          <th>Expiry Date</th>
          <th></th>
          <th>Verify</th>
          <th>Added By</th>
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
  if (url_params.hasOwnProperty('driver_code')) {
    $("[data-filter='code']").val(url_params.driver_code+' '+url_params.driver_name );
  }
  
</script>

<datalist id="quick_list_drivers"></datalist>

<script type="text/javascript">

  $(document.body).on('change', '[name="quick_list_drivers_search"]' ,function(){
    if($('[name="quick_list_drivers_search"]').val() !== ""){
    driver_eid_selected=$(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    driver_name_selected=$(`[data-driver-filter-rows="${$(this).val()}"]`).data('name');
    driver_code_selected=$(`[data-driver-filter-rows="${$(this).val()}"]`).data('code');
    if(driver_eid_selected!=undefined){
      location.href=`user/masters/drivers/documents?eid=${driver_eid_selected}&driver_name=${driver_name_selected}&driver_code=${driver_code_selected}`

      //$(this).data('selected-driver-id',driver_id_selected)
    }else{
      alert("Please enter correct Driver ID");
      $('[name="quick_list_drivers_search"]').val("");
    }
  }
  });






  function bind_quick_list_drivers(){

   quick_list_drivers().then(function(data) {

  // Run this when your request was successful

  if(data.status){



    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option data-driver-filter-rows="" data-name="" data-value="" value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {

        options+=`<option data-driver-filter-rows="`+item.code+' '+item.name+`" data-value="${item.eid}" data-name="${item.name}" data-code="${item.code}" value="`+item.code+' '+item.name+`"></option>`;               

      })

      $('#quick_list_drivers').html(options);     

    }

  }

}).catch(function(err) {

  // Run this when promise was rejected via reject()

}) 

}

bind_quick_list_drivers()

</script>

<script type="text/javascript">
  function show_list(){
    var driver_eid='<?php echo $data['driver_eid'] ?>'
    var sort_by = $('#sort_by').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var webapi = "pagination";
    $.ajax({
      url:window.location.pathname+'-ajax',
      type:'POST',
      data:{
        driver_eid:driver_eid,
        page:page_no,
        sort_by:sort_by,
        batch:batch,
        webapi:  webapi,
      },
      success:function(data){
       if((typeof data)=='string'){
         data=JSON.parse(data)
        // console.log(data)
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
              <td style='text-align:left'>${item.type_name}</td>
              <td><span class='${required_option_class}'><span></td>`


              if(item.is_uploaded){
                remarks=item.document_details.remarks;
               let expiry_alert=(item.document_details.expiry_alert)?'bg-red text-white':'';
               row +=`<td><span class='check-green'><span></td>
               <td class='${expiry_alert}'>${item.document_details.expiry_days_left}</td>`;
               row+=`<td>${item.document_details.issue_date}</td>`;

               row+=`<td>${item.document_details.expiry_date}</td>`;

                row+=`<td style="white-space:nowrap"><button class='btn_grey_c' onclick="open_document('${item.document_details.file_path}')"><i class='fa fa-file'></i></button>`;
            

               
               <?php if(in_array('P0145', USER_PRIV)){
                ?>
                row+=`<button title="Edit" class="btn_grey_c"><a href="../user/masters/drivers/documents/upload?driver_eid=<?php echo $driver_eid; ?>&document_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-upload"></i></a></button>`;
                <?php
              } ?>



              if(item.document_details.verification_status=='PENDING'){
                
                <?php if(in_array('P0146', USER_PRIV)){
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




              row+=`<td>${item.document_details.added_by_user_code} <br> ${item.document_details.added_by_user_name} <br> <span style="white-space:nowrap"> ${item.document_details.added_on_datetime}</span></td>
              <td>${item.document_details.verified_by_user_code} <br> ${item.document_details.verified_by_user_name} <br> <span style="white-space:nowrap"> ${item.document_details.verified_on_datetime}</span></td>
              <td>${item.document_details.rejected_by_user_code} <br> ${item.document_details.rejected_by_user_name} <br> <span style="white-space:nowrap"> ${item.document_details.rejected_on_datetime}</span></td>
              `
            }else{
              row +=`<td><span class='cross-red'><span></td>
              <td></td>
              <td></td>
              <td style="white-space:nowrap">
              <button disabled style="cursor:auto"><i class="fa fa-upload"></i></button>`

              <?php if(in_array('P0145', USER_PRIV)){
                ?>
                row+=`<button title="Edit" class="btn_grey_c"><a href="../user/masters/drivers/documents/upload?driver_eid=<?php echo $driver_eid; ?>&document_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-upload"></i></a></button>`;
                <?php
              } ?>
              row+=`<td></td>
              <td></td>
              <td></td><td></td><td></td>`

            }

            row+=`<td>${remarks}</td>
            <td style="white-space:nowrap">
            <button title="History" class="btn_grey_c"><a href="../user/masters/drivers/documents/document-history?driver_eid=<?php echo $driver_eid; ?>&document_type_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-history"></i></a></button>
              
              <button title="Notes" class="btn_grey_c" onclick="open_notes({url:'../user/miscellaneous/notes/details?reference=driver-DOCUMENT&eid=<?php echo $driver_eid; ?>&document-type-eid=${item.type_eid}'})"><i class="fa fa-sticky-note"></i></a></button></td>`

            row+=`</tr>`

            $('#tabledata').append(row);


            set_pagination({
              selector: '[data-pagination]',
              totalPages: data.response.totalPages,
              currentPage: data.response.currentPage,
              batch: data.response.batch
            })

          })
      
         }
      }else{
            $('#tabledata').html("");
          var row=`<tr><td colspan="20">`+data.message+`</td></tr>`;
          $('#tabledata').append(row);
          $('[data-pagination]').html('');
        }

    }

  })
}
show_list()

</script>

<script type="text/javascript">

  $(document).ready(function(){
   $(document).on("change", "[data-action='update-verification-status']",function(){
      if (confirm('Are you sure to change the verification status ?')) {
    var eid=$(this).data('document-eid');
    var verification_status=$(this).val();
    if(verification_status=='VERIFIED'){
      var url=window.location.pathname+'/verify'
    }else if(verification_status=='REJECTED'){
      var url=window.location.pathname+'/reject'
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

<br><br><br><br>


<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>