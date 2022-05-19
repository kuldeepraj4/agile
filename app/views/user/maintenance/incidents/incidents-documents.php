<?php
require_once APPROOT . '/views/includes/user/header.php';
//require_once APPROOT.'/views/includes/user/header-quick-view.php';
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
          <th style="width: 10%">Sr No</th>
          <th style="width: 30%; text-align: left;">Name</th>
          <th style="width: 40%;text-align: left;">Remarks</th>
          <th style="width: 20%;">Uploaded By</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody data-documents-list></tbody>
      <tfoot>
         <?php 
              if (in_array('P0280', USER_PRIV) || in_array('P0278', USER_PRIV)) 
              {
                ?>
       <tr><td colspan="3"></td><td style="padding: 4px;text-align: right;"><button type="button" class="btn_blue" onclick="open_child_window({url:'../user/maintenance/incidents/upload-document&eid=<?php echo $data['eid'] ?>',width:600,height:500})">Add Document</button></td></tr>
        <?php 
             }
                ?>
     </tfoot>
   </table>
   <div style="display: flex;justify-content: center;padding: 10px">

    <button class="btn_green" onclick=" window.history.back()">Back To List</button>

  </div>
 </div>
</section>

<script type='text/javascript'>
  function back_alert() {
    if (confirm('Are you Sure ?')) {
      window.history.back();
  }
}
</script>

<script type = 'text/javascript'>
  function show_documents() {
    $.ajax( {
      url:'<?php echo AJAXROOT; ?>/user/maintenance/incidents/documents-list-ajax',
      type:'POST',
      data: {
        incident_eid:'<?php echo $data['eid']; ?>'
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
              console.log(item);
              var row = `<tr>
              <td>${++counter}</td>
              <td style ='text-align: left;' class="text-link" onclick="open_document('${item.file_path}')">${item.name}</td>
              <td style ='text-align: left;'>${item.remarks}</td>
              <td>${item.added_by_user_code}-${item.added_by_user_name} - ${item.added_on_datetime}</td>`;

              <?php 
              if (in_array('P0317', USER_PRIV)) 
              {
                ?>
                row += `<td style="white-space:nowrap"><button title="Delete" class="btn_grey_c" data-action="delete" data-eid="${item.eid}" data-document_id="${item.document_id}" ><i class="fa fa-trash"></i></button><td/>`;
                <?php
              } 
              ?>
              row += `</tr>`;
              $( '[data-documents-list]' ).append( row );
            }
            )
          } else {
            var false_message = `<tr><td colspan = '5'>`+data.message+`<td></tr>`;
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


<script type="text/javascript">
  $(document).ready(function() {
    $(document).on("click", "[data-action='delete']", function(){
      if (confirm('Do you want to delete docs?')){
        var eid = $(this).data("eid");
        var document_id = $(this).data("document_id");
        $.ajax({
          url: 'user/maintenance/incidents/delete-document-action',
          type: 'POST',
          data: {
            delete_eid: '<?php echo $data['eid']; ?>',
            document_id:document_id
          },  
          context: this,
          success: function(data) {
            if ((typeof data) == 'string') {
              console.log('show details with params');
              //console.log(data);
              data = JSON.parse(data)
            }
            if (data.status) {
              $(this).parent().parent().fadeOut();
              show_documents();
              alert(data.message);
            } else {
              alert(data.message)
            }
          }
        })
      }
    });
  });
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>