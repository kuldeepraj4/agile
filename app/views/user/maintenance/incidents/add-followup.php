<style type="text/css">
    .scrollTop i{
      position: fixed;
      right: 25px;
      bottom:70px;
      font-size: 40px;
      opacity: .4;
      cursor:pointer;
      display:none;
    }
    .scrollBottom i{
      position: fixed;
      right: 25px;
      top:170px;
      font-size: 40px;
      opacity: .4;
      cursor:pointer;
      display:none;
    }
  </style>
<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
 if(isset($_GET['eid'])){
     $detail=[];
     $detail['eid']=$_GET['eid'];
//     echo $detail['eid'];
 }
?>
<br><br>
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
  }
  .aaf-b>div {
    width: 100%
  }
  .aaf-b>div input {
    height: 35px
  }
</style>


<section class = 'list-200 content-box' style = 'margin: auto;'>
  <h1 class = 'list-200-heading'>Follow Ups</h1>
  <form method = 'POST' id = 'MyForm' class ='aaf' onsubmit = 'return add_follow_up()'>
    <input type = 'hidden' name = 'repair_order_eid' value = "<?php echo $detail['eid'] ?>">
    <div class="aaf-a">
      <textarea name = 'description' style = 'min-height:100px;width: 100%' placeholder = 'Write description here'></textarea>
    </div>
    <div class = 'aaf-b'>
      <div>
        <label>Next Follow Date &nbsp </label>
        <input type = 'text' name = 'follow_up_next_date' required = 'required' data-date-picker style="width: 100%;">
      </div>
      <div>
        <button class ='form-submit-btn' id= 'submit' style="width: 100%;">Save</button>
      </div>
    </div>
    <div>
    </div>
  </form>
  <br>
  <div class = 'table  table-a' >
    <table data-follow-up-table>
      <thead>
        <tr>
          <th style = 'width: 20px;'>Datetime</th>
          <th style = 'width: 500px;text-align: left;'>Description</th>
          <th style = 'width: 10px;'>Next Follow-Up Date</th>
          <th style = 'width: 20px;'>Added by</th>
        </tr>
      </thead>
      <tbody data-follow-ups-list>
      </tbody>
    </table>
  </div>
 </form>
</section>


<script type = 'text/javascript'>
  function show_follow_ups() {
    $.ajax( { 
      url:'<?php echo AJAXROOT; ?>/user/maintenance/incidents/follow-up-list-ajax',
      type:'POST',
      data: {
        repair_order_eid:'<?php echo $detail['eid']; ?>'
      },
      beforeSend:function(data){
        show_table_data_loading('[data-follow-up-table]')
      },
      success:function( data ) {
        if ( ( typeof data ) == 'string' ) {
          data = JSON.parse( data )
          $( '[data-follow-ups-list]' ).html( '' );
          if ( data.status ) {
            var counter = 0;
            $.each ( data.response.list, function( index, item ) {
             // console.log(item)
              counter++;
              var row = `<tr>`;
              if (item.added_on_datetime < '12/31/1799') {
                row += `<td>${item.added_on_datetime}</td>`;
              }else{
                row += `<td></td>`;
              }

              row += `<td style ='width: 100px;text-align: left;'>${item.description}</td>`;

              if (item.follow_up_next_date < '12/31/1799') {
                row += `<td>${item.follow_up_next_date}</td>`;
              }else{
                row += `<td></td>`;
              }

              row += `
              <td>${item.added_by_user_code} - ${item.added_by_user_name}</td>
              </tr>`;
              $( '[data-follow-ups-list]' ).append( row );
            }
            )
          } else {
            var false_message = `<tr><td colspan = '3'>`+data.message+`<td></tr>`;
            $( '[data-follow-ups-list]' ).html( false_message );
          }
        }
      }
    }
    )
  }
  show_follow_ups()
</script>

<script type = 'text/javascript'>
  function add_follow_up() {
    show_processing_modal()
    submit_to_wait_btn( '#submit', 'loading' )
    $( '#formErro' ).show()
    var form = document.getElementById( 'MyForm' );
    var isValidForm = form.checkValidity();
    var currentForm = $( '#MyForm' )[0];
    var formData = new FormData( currentForm );
    if ( isValidForm ) {
      var arr = $( '#MyForm' ).serializeArray();
      var obj = {
      }
      for ( var a = 0; a<arr.length; a++ ) {
        obj[arr[a].name] = arr[a].value
      }
      $.ajax( {
        url:'<?php echo AJAXROOT; ?>'+'user/maintenance/incidents/add-follow-up-action',
        type:'POST',
        data: obj,
        success:function( data ) {
          if ( ( typeof data ) == 'string' ) {
            data = JSON.parse( data )
          }
          if ( data.status ) {
            $( '#MyForm' )[0].reset()
            show_follow_ups()
            wait_to_submit_btn( '#submit', 'ADD' )
            hide_processing_modal()
            RefreshParent()
          } else {
            alert( data.message );
            wait_to_submit_btn( '#submit', 'ADD' )
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
        function RefreshParent() {
            if (window.opener != null && !window.opener.closed) {
                window.opener.location.reload();
                window.close();
                alert('Followup added successfully')
            }
        }
    </script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>