<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1300px">
  <h1 class="list-200-heading">ROC History </h1>
  <p style="text-align:center;font-size:1em;"></p>

  <div class="table  table-a">
    <table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Updated On Datetime</th>
          <th>Updated By</th>
          <th>View</th>
          <th>Remarks</th>  
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
      url:'../user/dispatch/loads/roc-history-list-ajax',
      type:'POST',
      data:{
        load_eid:'<?php echo $_GET['eid'] ?>',
      },
      success:function(data){
       if((typeof data)=='string'){
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){
           var counter=0;    
           $.each(data.response.list, function(index, item) {
            $('#tabledata').append(`
              <tr>
              <td>${++counter}</td>
              <td>${item.updated_on_datetime}</td>
              <td>${item.updated_by_user}</td>
              <td><button class='btn_grey_c' title="View ROC file" onclick="open_document('${item.file_path}')"><i class='fa fa-file'></i></button></td>
              <td>${item.file_remarks}</td>
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