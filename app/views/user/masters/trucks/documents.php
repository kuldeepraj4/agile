<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1300px">
  <h1 class="list-200-heading">Truck Documents<div>Code  <?php echo $data['truck_code'] ?></div></h1>

     <section class="list-200-top-action">
        <div class="list-200-top-action-left">
            

            <div class="filter-item">
                <label>Truck Search</label>
            <input type="text" data-filter="code" name="quick_list_trucks_search" list="quick_list_trucks">
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
          <th>Expiry Date</th>
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
</section>

<datalist id="quick_list_trucks"></datalist>

<script type="text/javascript">
  
  var url_params = get_params();
  if (url_params.hasOwnProperty('code')) {
    $("[data-filter='code']").val(url_params.code);
  }




  
  $(document.body).on('change', '[name="quick_list_trucks_search"]' ,function(){
    if($('[name="quick_list_trucks_search"]').val() !== ""){
    truck_eid_selected=$(`[data-truck-filter-rows="${$(this).val()}"]`).data('value');
    truck_code_selected=$(`[data-truck-filter-rows="${$(this).val()}"]`).data('code');
    if(truck_eid_selected!=undefined){
      location.href=`user/masters/trucks/documents?eid=${truck_eid_selected}&code=${truck_code_selected}`

      //$(this).data('selected-Truck-id',Truck_id_selected)
    }else{
      alert("Please enter correct Truck ID");
      $('[name="quick_list_trucks_search"]').val("");
    }
  }
  });






  function bind_quick_list_trucks(){

   quick_list_trucks().then(function(data) {

  // Run this when your request was successful

  if(data.status){



    //Run this if response has list

    if(data.response.list){

      var options="";

      options+=`<option data-Truck-filter-rows="" data-name="" data-value="" value="">- - Select - -</option>`

      $.each(data.response.list, function(index, item) {
         if(item.status='Active'){
        options+=`<option data-Truck-filter-rows="`+item.code+`" data-value="${item.eid}" data-name="${item.code}" data-code="${item.code}" value="`+item.code+`"></option>`;        
        }       

      })

      $('#quick_list_trucks').html(options);     

    }

  }

}).catch(function(err) {

  // Run this when promise was rejected via reject()

}) 

}

bind_quick_list_trucks()

</script>


<script type="text/javascript">
  function show_list(){
    var truck_eid='<?php echo $data['truck_eid'] ?>'
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        truck_eid:truck_eid
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
              let document_details = item.document_details;
              let row=`<tr>`;
                         
               
 

             row+=` <td>${++counter}</td>
              <td style='text-align:left'>${item.type_name}</td>
              <td><span class='${required_option_class}'><span></td>`


              if(item.is_uploaded){
                remarks=item.document_details.remarks;
               let expiry_alert=(item.document_details.expiry_alert)?'bg-red text-white':'';



               row +=`<td><span class='check-green'><span></td>
               <td class='${expiry_alert}'>${item.document_details.expiry_days_left}</td>
               <td>${item.document_details.expiry_date}</td>
               <td style="white-space:nowrap">
               
               <button class='btn_grey_c' onclick="open_document('${item.document_details.file_path}')"><i class='fa fa-file'></i></button>`


               
               <?php if(in_array('P0145', USER_PRIV)){
                ?>
                row+=`<button title="Edit" class="btn_grey_c"><a href="../user/masters/trucks/documents/upload?truck_eid=<?php echo $data['truck_eid']; ?>&document_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-upload"></i></a></button>`;
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
                  row+=`<td></td>`;
                  <?php
                }

                ?>




              }else{
                row+=`<td>${item.document_details.verification_status}</td>`;
              }




           
              

              row+=`<td>${item.document_details.added_by_user_code} <br> ${item.document_details.added_by_user_name} <br> <span style="white-space:nowrap"> ${item.document_details.added_on_datetime}</span></td>
              <td>${item.document_details.verified_by_user_code} <br> ${item.document_details.verified_by_user_name} <br> <span style="white-space:nowrap"> ${item.document_details.verified_on_datetime}</span></td>
              <td>${item.document_details.rejected_by_user_code} <br> ${item.document_details.rejected_by_user_name} <br> <span style="white-space:nowrap"> ${item.document_details.rejected_on_datetime}</span></td>`
            }else{
              row +=`<td><span class='cross-red'><span></td>
              <td></td>
              <td></td> 
              <td style="white-space:nowrap">
              <button disabled style="cursor:auto"><i class="fa fa-upload"></i></button>`

              <?php if(in_array('P0145', USER_PRIV)){
                ?>
                row+=`<button title="Edit" class="btn_grey_c"><a href="../user/masters/trucks/documents/upload?truck_eid=<?php echo $data['truck_eid']; ?>&document_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-upload"></i></a></button>`;
                <?php
              } ?>
              row+=`<td></td>
              <td></td>
              <td></td>
              <td></td>`

            }



            row+=`<td style="white-space:nowrap">
            <button title="History" class="btn_grey_c"><a href="../user/masters/trucks/documents/document-history?truck_eid=<?php echo $data['truck_eid']; ?>&document_type_eid=${item.type_eid}&document_name=${item.type_name}"><i class="fa fa-history"></i></a></button>
            <button title="Notes" class="btn_grey_c" onclick="open_notes({url:'../user/miscellaneous/notes/details?reference=TRUCK-DOCUMENT&eid=<?php echo $data['truck_eid']; ?>&document-type-eid=${item.type_eid}'})"><i class="fa fa-sticky-note"></i></a></button></td>`

            row+=`</tr>`

            $('#tabledata').append(row);

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
          // alert(data)
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