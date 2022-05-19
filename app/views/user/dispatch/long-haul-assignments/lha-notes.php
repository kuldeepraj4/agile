<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
?>
<style type = 'text/css'>
  .aaf{
    display: flex;
  }
  .add-action {
    width: 80%;
  }
  .aaf-a{
    width: 70%;
  }
  .aaf-b {
    padding-left: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    justify-content: space-between;
    width: 30%
  }
  .aaf-b>div {
    width: 100%;
  }
  .aaf-b>div select {
    height: 35px
  }
  .notes-b .bg-high-priority{
    background:pink;
  }
</style>
<section class = 'list-200 content-box notes-b' style = 'margin: auto;max-width: 1200px'>
  <h1 class = 'list-200-heading'>Notes</h1>
  <br>
  <div style="display: flex;padding: 5px;justify-content: flex-end;"><button data-action="open-add-new-note" class="btn_blue">Add New Note</button></div>
  <div id="addNewNoteSec" style="margin: 10px auto;display: none;">
    <div style="display: flex;padding: 5px;justify-content: flex-end;"><button data-action="close-add-new-note" class="btn_red">Close</button></div>
    <form method = 'POST' id = 'addNewNoteForm' class ='aaf' onsubmit = 'return add_d_note()'>
      
      <input type = 'hidden' name = 'long_haul_assignment_eid' value = "<?php echo $_GET['eid'] ?>">
      <div class="aaf-a">
        <textarea name = 'description' style = 'min-height:100px;width: 100%' placeholder = 'Write note description here'></textarea>
      </div>
      <div class = 'aaf-b'>
        <div>
          <label>High Priority  &nbsp<input type="checkbox" name="high_priority"></label>
        </div>
        <div>
          <button class ='form-submit-btn' id= 'saveNote' style="width: 100%;">Save</button>
        </div>
      </div>
      <div>
      </div>
    </form>
  </div>
  <div class = 'table  table-a' >
    <table data-follow-up-table>
      <thead>
        <tr>
          <th style = 'width: 200px;'>Datetime</th>
          <th style = 'text-align: left;'>Description</th>
          <th style = 'width: 200px;'>Added by</th>
          <th style = 'width: 120px;'>High Priority</th>
          <th></th>
        </tr>
      </thead>
      <tbody data-follow-ups-list>
      </tbody>
    </table>
  </div>
  <script type = 'text/javascript'>
    function show_d_notes() {
      $.ajax( {
        url:'../user/dispatch/notes/long-haul-assignments-notes-list-ajax',
        type:'POST',
        data: {
          long_haul_assignment_eid:'<?php echo $_GET['eid']; ?>'
        },
        beforeSend:function(data){
          show_table_data_loading('[data-follow-up-table]')
        },
        success:function( data ) {
          if ( ( typeof data ) == 'string' ) {
            data = JSON.parse( data )
            $( '[data-follow-ups-list]' ).html( '' );
            if ( data.status ) {
              $.each ( data.response.list, function( index, item ) {
                var high_priority_class=(item.high_priority=='YES')?'bg-high-priority':'';
                var high_priority_checked=(item.high_priority=='YES')?'checked':'';
                var row = `<tr class="${high_priority_class}" data-eid="${item.eid}">
                <td style = 'width: 200px;'>${item.added_on_datetime}</td>
                <td style ='text-align: left;'>${item.description}</td>
                <td style = 'width: 200px;'>${item.added_by_user} <br>${item.added_on_datetime}</td>`
                
                if(item.added_by_user_type=='SELF'){
                  row+=`<td style = 'width: 120px;'><input type="checkbox" data-toggle-high-priority-status ${high_priority_checked}></td>
                  <td><i class="ic delete" data-delete-d-note></i></td>`
                }else{
                  row+=`<td></td><td></td>`
                }
                row+=`</tr>`;
                $( '[data-follow-ups-list]' ).append( row );
              }
              )
            } else {
              var false_message = `<tr><td colspan = '4'>`+data.message+`<td></tr>`;
              $( '[data-follow-ups-list]' ).html( false_message );
            }
          }
        }
      }
      )
    }
    show_d_notes()
  </script>

  <script type = 'text/javascript'>
    function add_d_note() {
      show_processing_modal()
      submit_to_wait_btn( '#saveNote', 'loading' )
      var form = document.getElementById( 'addNewNoteForm' );
      var isValidForm = form.checkValidity();
      var currentForm = $( '#addNewNoteForm' )[0];
      if ( isValidForm ) {
        var arr = $( '#addNewNoteForm' ).serializeArray();
        var obj = {
        }
        obj['reference_type_id']='LONG HAUL ASSIGNMENT';
        
        for ( var a = 0; a<arr.length; a++ ) {
          obj[arr[a].name] = arr[a].value
        }
        obj['high_priority']=($('[name="high_priority"]').prop("checked") == true)?'YES':'NO';
        $.ajax( {
          url:'<?php echo AJAXROOT; ?>'+'user/dispatch/notes/add-new-action',
          type:'POST',
          data: obj,
          success:function( data ) {
            if ( ( typeof data ) == 'string' ) {
              data = JSON.parse( data )
            }
            if ( data.status ) {
              $( '#addNewNoteForm' )[0].reset()
              show_d_notes()

              if(!window.opener.closed){
                window.opener.show_list()
              }

              wait_to_submit_btn( '#saveNote', 'SAVE' )
              hide_processing_modal()
            } else {
              alert( data.message );
              wait_to_submit_btn( '#saveNote', 'SAVE' )
              hide_processing_modal()
            }

          }
        }
        )
      }
      return false
    }
  </script>
  <script type="text/javascript">
   $(document).on("click", "[data-action='open-add-new-note']", function() {
    $('#addNewNoteSec').slideDown();
    $("[data-action='open-add-new-note']").parent().slideUp()
  })
   $(document).on("click", "[data-action='close-add-new-note']", function() {
    $('#addNewNoteSec').slideUp();
    $("[data-action='open-add-new-note']").parent().slideDown()
  })
</script>




<script type="text/javascript">
  $(document).on("click", "[data-toggle-high-priority-status]",function(){
    var note_eid=$(this).parents('tr').data('eid')
    var high_priority=($(this).prop("checked"))?'YES':'NO';
    $.ajax({
      url:"<?php echo AJAXROOT; ?>"+'user/dispatch/notes/toggle-high-priority-status-action',
      type:'POST',
      data:{
        note_eid:note_eid,
        high_priority:high_priority
      },
      context: this,
      success:function(data){
       if((typeof data)=='string'){
         data=JSON.parse(data) 
       }

       if(data.status){
        if(!window.opener.closed){
          window.opener.show_list()
        }
        if(high_priority=='YES'){
          $(this).parents('tr').addClass('bg-high-priority');
        }else{
          $(this).parents('tr').removeClass('bg-high-priority');
        }
      }else{
        alert(data.message)
      }
    }
  })
  });

  $(document).on("click", "[data-delete-d-note]",function(){

    if(confirm('Do you want to delete note ?')){
      var note_eid=$(this).parents('tr').data('eid')
      $.ajax({
        url:"<?php echo AJAXROOT; ?>"+'user/dispatch/notes/delete-action',
        type:'POST',
        data:{
          note_eid:note_eid,
        },
        context: this,
        success:function(data){
          if(!window.opener.closed){
            window.opener.show_list()
          }
          if((typeof data)=='string'){
           data=JSON.parse(data) 
         }

         if(data.status){
          $(this).parents('tr').slideUp();
        }else{
          alert(data.message)
        }
      }
    })
    }
  });

</script>
</section>

<?php

require_once APPROOT.'/views/includes/user/footer.php';

?>