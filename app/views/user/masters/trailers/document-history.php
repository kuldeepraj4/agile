<?php
require_once APPROOT.'/views/includes/user/header.php';
// $trailer_name=isset($_GET['trailer-name'])?$_GET['trailer-name']:'';
// $trailer_code=isset($_GET['trailer-code'])?$_GET['trailer-code']:'';
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1300px">
  <h1 class="list-200-heading">Document History </h1>
  

  <div class="table  table-a">
    <table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Uploaded datetime</th>
          <th>Uploaded By</th>
          <th>View</th>
          <th>Expiry Date</th>
          <th>Verification Status</th>
          <th>Verified By</th>
          <th>Rejected By</th> 
          <th>Notes</th>  
        </tr>                       
      </thead>

      <tbody id="tabledata">
      </tbody>
    </table>
  </div>
</section>

<script type="text/javascript">
  function show_list(){
    $.ajax({
      url:window.location.pathname+'-ajax',
      type:'POST',
      data:{
        trailer_eid:'<?php echo $data['trailer_eid'] ?>',
        document_type_eid:'<?php echo $data['document_type_eid'] ?>',
      },
      success:function(data){
       if((typeof data)=='string'){
         data=JSON.parse(data)
         console.log(data)
         $('#tabledata').html("");
         if(data.status){
           var counter=0;    
           $.each(data.response.list, function(index, item) {
            $('#tabledata').append(`
              <tr>
              <td>${++counter}</td>
              <td>${item.added_on_datetime}</td>
              <td>${item.added_by_user_code}<br>${item.added_by_user_name} </td>
              <td><button class='btn_grey_c' onclick="open_document('${item.file_path}')"><i class='fa fa-file'></i></button></td>
              <td>${item.expiry_date}</td>
              <td>${item.verification_status}</td>
              <td>${item.verified_by_user_code} <br> ${item.verified_by_user_name} <br> ${item.verified_on_datetime}</td>
              <td>${item.rejected_by_user_code}<br>${item.rejected_by_user_name} <br> ${item.rejected_on_datetime}</td>
              <td><button title="Notes" class="btn_grey_c" onclick="open_notes({url:'../user/miscellaneous/notes/details?reference=trailer-DOCUMENT&eid=<?php echo $data['trailer_eid'] ?>&document-type-eid=${item.type_eid}'})"><i class="fa fa-sticky-note"></i></a></button></td>
              <tr>
              `);

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
    
  });
 });

</script>

<br><br><br><br>


<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>