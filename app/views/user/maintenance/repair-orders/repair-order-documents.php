<?php
require_once APPROOT . '/views/includes/user/header.php';
require_once APPROOT.'/views/includes/user/header-quick-view.php';
?>

<section class = 'list-200 content-box' style = 'margin: auto;max-width: 1200px'>
  <h1 class = 'list-200-heading'>Documents List</h1>
  <section class = 'list-200-top-section'>
    <div>
    </div>
    <div>
    </div>
  </section>
  <div class = 'table  table-a'>
    <table data-document-table>
      <thead>
        <tr>
          <th style="width: 10%">Sr. No.</th>
          <th style="width: 30%; text-align: left;">Name</th>
          <th style="width: 40%;text-align: left;">Remarks</th>
          <th style="width: 20%;">Uploaded By</th>
        </tr>
      </thead>
      <tbody data-documents-list></tbody>
      <tfoot>
       <tr><td colspan="3"></td><td style="padding: 4px;text-align: right;"><button type="button" class="btn_blue" onclick="open_child_window({url:'../user/maintenance/repair-orders/upload-document&eid=<?php echo $data['eid'] ?>',width:600,height:500})">Add Document</button></td></tr>
     </tfoot>
   </table>
   <div style="display: flex;justify-content: center;padding: 10px"><button class="btn_green" onclick="location.href='../user/maintenance/repair-orders'">Back To List</button></div>
 </div>
</section>

<script type = 'text/javascript'>
  function show_documents() {
    $.ajax( {
      url:'<?php echo AJAXROOT; ?>/user/maintenance/repair-orders/documents-list-ajax',
      type:'POST',
      data: {
        repair_order_eid:'<?php echo $data['eid']; ?>'
      },
      beforeSend:function(data){
        show_table_data_loading('[data-document-table]')
      },
      success:function( data ) {
        if ( ( typeof data ) == 'string' ) {
          data = JSON.parse( data )
          $( '[data-documents-list]' ).html( '' );
          if ( data.status ) {
            var counter = 0;
            $.each ( data.response.list, function( index, item ) {
              //console.log(item)
              var row = `<tr>
              <td>${++counter}</td>
              <td style ='text-align: left;' class="text-link" onclick="open_document('${item.file_path}')">${item.name}</td>
              <td style ='text-align: left;'>${item.remarks}</td>
              <td>${item.added_by_user_code}-${item.added_by_user_name} - ${item.added_on_datetime}</td>
              </tr>`;
              $( '[data-documents-list]' ).append( row );
            }
            )
          } else {
            var false_message = `<tr><td colspan = '4'>`+data.message+`<td></tr>`;
            $( '[data-documents-list]' ).html( false_message );
          }
        }
      }
    }
    )
  }
  show_documents()
</script>
<br><br>
<br><br>
<br><br>
<br><br>
</section>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>