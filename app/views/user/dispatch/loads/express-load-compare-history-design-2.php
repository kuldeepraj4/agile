<?php
require_once APPROOT.'/views/includes/user/header.php';
$bi=$data['details']['basic_info'];
?>
<style type="text/css">
  .dtlv{
    box-shadow: 0 0 10px -1px darkgrey;
    background: white;
    text-align: center;
    padding:10px;
    display: block;
    border-radius: 12px;
  }
  .dtlv-heading{
    margin-bottom: 10px;
    font-size: 2em;
    color: var(--theme-color-four);
  }
  .dtlv>section{
    border:1px solid lightgrey;
    border-radius: 8px;
    overflow: hidden;
    margin: 25px auto;
  }
  .dtlv .dtlv-sec-head{
    display: flex;
    justify-content: space-between;
    padding:5px 10px;
    background: #486e94;
    border-bottom: 1px solid lightgrey;
  }
  .dtlv .dtlv-sec-heading{
    font-weight: bold;
    font-size: 1.1em;
    color: white;
  }
  .dtlv-sec-heading.angle_down::after{
    color: grey;
    font-family: "Font Awesome 5 Free"; 
    font-weight: 900;
    content: "\f107";
    font-size: 1.2em;
  }
  .dtlv .dtlv-sec-head a{
    color: white;
  }
  .dtlv .dtlv-dtl{
  }
  .dtlv .dtlv-dtl .dtlv-dtl-content{
    padding: 8px;
    display: flex;
    justify-content: space-between;
  }
  .dtlv .dtlv-dtl .dtlv-dtl-action-bar{
    display: flex;
    justify-content: flex-end;
  }
  .dtlv .dtlv-dtl .dtlv-dtl-content>div{
    margin: 8px;
    flex-grow: 1;
  }

  .dtlv .dtlv-attr-val-list ul{
  }
  .dtlv .dtlv-attr-val-list li{
    display: flex;
  }
  .dtlv .dtlv-attr-val-list li>div{
    padding:3px 10px;
  }
  .dtlv .dtlv-attr-val-list li>div:nth-child(1){
    width: 40%;
    font-style: italic;
    text-align: left;
  }
  .dtlv .dtlv-attr-val-list li>div:nth-child(2){
    width: 55%;
    flex-grow: 1;
    text-align: left;
  }
  .icon{
    font-family: "Font Awesome 5 Free"; 
    font-weight: 900;
  }
  .icon:hover{
    transform: scale(1.1);
  }
  .icon.white{
    color: white !important;
  }
  .icon.grey{
    color: grey !important;
  }
  .icon.view::after{
    content: "\f06e";
  }
  .icon.view:hover{
    color: green;
  }

  .icon.edit::after{ 
    content: "\f304";
  }
  .icon.edit:hover{
    color: steelblue;
  }

  .icon.delete::after{
    content: "\f1f8";
  } 
  .icon.delete:hover{
    color: red;
  }
  .icon.angle_down::after{
    content: "\f107";
    font-size: 1.2em;
  }
  .icon.angle_up::after{
    content: "\f106";
    font-size: 1.2em;
  }
  .icon.toggle-on::after{
    content: "\f205";
    font-size: 1.2em;
  }
  .icon.toggle-off::after{
    content: "\f204";
    font-size: 1.2em;
  }
  .icon.toggle-off:hover,  
  .icon.toggle-on:hover{
    color: steelblue;
  }

  .dtlv-dtl-list>table{
    border:1px solid darkgrey;
    border-collapse: collapse;
    background: white;
    overflow: auto;
    box-sizing: border-box;
    width: 95%;
    margin:8px auto;
  }
  .dtlv-dtl-list>table>thead{
    background: #f2f2f2;
    color: black;
  }
  .dtlv-dtl-list>table>thead>tr{
    border-bottom:1px solid darkgrey;
  }
  .dtlv-dtl-list>table>thead>tr>th{
    padding:8px 12px;
    font-weight: normal;
  }

  .dtlv-dtl-list>table>tbody>tr>td{
    padding: 8px 12px;

  }
  .dtlv-dtl-list>table>tbody>tr{
    border-bottom: 1px solid #f0f0f0
  }
  .dtlv-dtl-list>table>tbody>tr:last-child{
    border-bottom: none;
  }
  .dtlv-dtl-list>table>thead>tr>td{
    text-align: center;
  }
  .dtlv-dtl-list>table>tbody>tr>td{
    text-align: center;
  }


  .dtlv-dtl-list.dtlv-dtl-list-a{
  }
  .dtlv-dtl-list.dtlv-dtl-list-a>table>thead{
    background: #486e94;
  }
  .dtlv-dtl-list.dtlv-dtl-list-a>table>thead>tr{
    border:1px solid grey;
  }
  .comp-high{
    color: red;
    font-weight: bolder;
  }
  .comp-hist{
    color: lightgrey;
    font-style: italic;
    font-size: .9em;
  }
</style>
<br><br>
<section class="dtlv content-box" style="margin: auto;max-width: 1200px">
  <h1 class="dtlv-heading">EXPRESS LOAD <?php echo $bi['id']['old']; ?></h1>

  <section>
    <div class="dtlv-sec-head" data-hide-show-details>
      <div class="dtlv-sec-heading">Basic Information</div>
      <div>
        <button class="icon angle_up white" data-up-down-button></button>
      </div>
    </div>
    <div class="dtlv-dtl">
      <div class="dtlv-dtl-action-bar">
        <button style="display: none;" title="Edit" class="icon edit grey" onclick="open_child_window({url:'../user/dispatch/loads/load-information-update&eid=<?php echo $bi['eid']; ?>',width:1000,height:500})"></button>
      </div>
      <div class="dtlv-dtl-content">
        <div class="dtlv-attr-val-list" style="max-width: 500px;">
          <ul >
            <li>
              <div>Customer</div>
              <div>
                <?php
                if($bi['customer']['current']==$bi['customer']['old']){
                  echo "<span>".$bi['customer']['current']."</span>";
                }else{
                  echo "<span class='comp-high'>".$bi['customer']['current']."</span><br><span class='comp-hist'>".$bi['customer']['old']."</span>";
                }
                ?>

              </div>
            </li>
            <li>
              <div>PO Number</div>
              <div><?php
              if($bi['po_number']['current']==$bi['po_number']['old']){
                echo "<span>".$bi['po_number']['current']."</span>";
              }else{
                echo "<span class='comp-high'>".$bi['po_number']['current']."</span> <span class='comp-hist'>".$bi['po_number']['old']."</span>";
              }
              ?></div>
            </li>
            <li>
              <div>Rate</div>
              <div><?php
              if($bi['rate']['current']==$bi['rate']['old']){
                echo "<span>".$bi['rate']['current']."</span>";
              }else{
                echo "<span class='comp-high'>".$bi['rate']['current']."</span> <span class='comp-hist'>".$bi['rate']['old']."</span>";
              }
              ?></div>
            </li>

            <li>
              <div>Load Type</div>
              <div><?php
              if($bi['load_type']['current']==$bi['load_type']['old']){
                echo "<span>".$bi['load_type']['current']."</span>";
              }else{
                echo "<span class='comp-high'>".$bi['load_type']['current']."</span><br><span class='comp-hist'>".$bi['load_type']['old']."</span>";
              }
              ?></div>
            </li>
            <li>
              <div>Trailer Type</div>
              <div><?php
              if($bi['trailer_type']['current']==$bi['trailer_type']['old']){
                echo "<span>".$bi['trailer_type']['current']."</span>";
              }else{
                echo "<span class='comp-high'>".$bi['trailer_type']['current']."</span><br><span class='comp-hist'>".$bi['trailer_type']['old']."</span>";
              }
              ?></div>
            </li>

          </ul>
        </div>


        <div class="dtlv-attr-val-list" style="max-width: 500px;">
          <ul >
            <li>
              <div>Reefer Mode </div>
              <div><?php
              if($bi['reefer_mode']['current']==$bi['reefer_mode']['old']){
                echo "<span>".$bi['reefer_mode']['current']."</span>";
              }else{
                echo "<span class='comp-high'>".$bi['reefer_mode']['current']."</span><br><span class='comp-hist'>".$bi['reefer_mode']['old']."</span>";
              }
              ?></div>
            </li>
            <li>
              <div>Reefer Temp </div>
              <div><?php
              if($bi['temperature_to_maintain']['current']==$bi['temperature_to_maintain']['old']){
                echo "<span>".$bi['temperature_to_maintain']['current']."</span>";
              }else{
                echo "<span class='comp-high'>".$bi['temperature_to_maintain']['current']."</span> <span class='comp-hist'>".$bi['temperature_to_maintain']['old']."</span>";
              }
              ?></div>
            </li>
            <li>
              <div>Temp As Per Shipper </div>
              <div><?php
              if($bi['temperature_as_per_shipper']['current']==$bi['temperature_as_per_shipper']['old']){
                echo "<span>".$bi['temperature_as_per_shipper']['current']."</span>";
              }else{
                echo "<span class='comp-high'>".$bi['temperature_as_per_shipper']['current']."</span><br><span class='comp-hist'>".$bi['temperature_as_per_shipper']['old']."</span>";
              }
              ?></div>
            </li>                   
          </ul>
        </div>
      </div>


<!-- Drop at shipper comparsion-->
<?php
if($bi['has_shipper_range']['current']=='YES' || $bi['has_shipper_range']['current']=='YES'){
  ?>
      <div class="dtlv-dtl-list">
        <table>
          <thead>
            <tr>
              <th style='text-align:left'>Category</th>
              <th>Type</th>
              <th>Appointment</th>
              <th>City</th>
              <th>Date</th>
              <th>Time</th>
            </tr>
          </thead></table>

  <?php
}
?>
<!-- /Drop at shipper comparsion-->

      <div class="dtlv-dtl-list">
        <table>
          <thead>
            <tr>
              <th style='text-align:left'>Category</th>
              <th>Type</th>
              <th>Appointment</th>
              <th>City</th>
              <th>Date</th>
              <th>Time</th>
            </tr>
          </thead>
          <tbody>
            <?php

                  //----print shipper range here if given
            if($bi['has_shipper_range']=='YES'){
              echo "<tr>
              <td style='text-align:left'>Drop at Shipper</td>
              <td></td>
              <td></td>
              <td></td>
              <td>".$bi['drop_at_shipper_date']."</td>
              <td>".$bi['drop_at_shipper_time_from']." - ".$bi['drop_at_shipper_time_to']."</td>";
              "</tr>";              
            }

                  //----print shipper row
            echo "<tr>
            <td style='text-align:left'>".$bi['shipper']['category']."</td>
            <td>".$bi['shipper']['type']."</td>
            <td>".$bi['shipper']['appointment_type']."</td>
            <td>".$bi['shipper']['location']."</td>
            <td>".$bi['shipper']['date']."</td>";
            if($bi['shipper']['datetime_tbd']=='NO'){
              echo "<td>".$bi['shipper']['time_from']." - ".$bi['shipper']['time_to']."</td>";
            }elseif ($bi['shipper']['datetime_tbd']=='YES') {
              echo "<td>TBD</td>";
            }

            "</tr>";
                  //----print all in-between stops

            foreach ($bi['stops'] as $stp) {
              echo "<tr>
              <td style='text-align:left'>".$stp['category']."</td>
              <td>".$stp['type']."</td>
              <td>".$stp['appointment_type']."</td>
              <td>".$stp['location']."</td>
              <td>".$stp['date']."</td>";
              if($stp['datetime_tbd']=='NO'){
                echo "<td>".$stp['time_from']." - ".$stp['time_to']."</td>";
              }elseif ($stp['datetime_tbd']=='YES') {
                echo "<td>TBD</td>";
              }

              "</tr>";
            }

                  //----print consignee row
            echo "<tr>
            <td style='text-align:left'>".$bi['consignee']['category']."</td>
            <td>".$bi['consignee']['type']."</td>
            <td>".$bi['consignee']['appointment_type']."</td>
            <td>".$bi['consignee']['location']."</td>
            <td>".$bi['consignee']['date']."</td>";
            if($bi['consignee']['datetime_tbd']=='NO'){
              echo "<td>".$bi['consignee']['time_from']." - ".$bi['consignee']['time_to']."</td>";
            }elseif ($bi['consignee']['datetime_tbd']=='YES') {
              echo "<td>TBD</td>";
            }

                  //----print consignee range here if given
            if($bi['has_consignee_range']=='YES'){
              echo "<tr>
              <td style='text-align:left'>Pick from Consignee</td>
              <td></td>
              <td></td>
              <td></td>
              <td>".$bi['drop_at_shipper_date']."</td>
              <td>".$bi['drop_at_shipper_time_from']." - ".$bi['drop_at_shipper_time_to']."</td>";
              "</tr>";              
            }

            "</tr>";
            ?>                    
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section>
    <div class="dtlv-sec-head hide" data-hide-show-details>
      <div class="dtlv-sec-heading">Dispatch Information </div>
      <div>
        <button class="icon angle_down white" data-up-down-button></button>
      </div>
    </div>

    <div class="dtlv-dtl">
      <div class="dtlv-dtl-action-bar">
        <button title="Edit" style="display: none;" class="icon edit grey" onclick="open_child_window({url:'../user/dispatch/loads/stop-information-update&eid=<?php echo $shipper['eid']; ?>',width:1000,height:500})"></button>
      </div>
      <div class="dtlv-dtl-content">
        <div class="dtlv-attr-val-list" style="max-width: 500px;">
          <ul >
            <li><div>Truck</div><div><?php echo $bi['alloted_truck_code']; ?></div></li>
            <li><div>Trailer</div>
              <div><?php echo $bi['alloted_trailer_code']; ?></div>
            </li>
          </ul>
        </div>

        <div class="dtlv-attr-val-list" style="max-width: 500px;">
          <ul >
            <li><div>Team/Solo</div><div><?php echo $bi['is_team_driver']; ?></div></li>
            <li><div>Drivers</div>
              <div><?php echo $bi['alloted_driver_code'].' '.$bi['alloted_driver_name']; 
              if($bi['is_team_driver']=='TEAM'){
                echo "<br>".$bi['alloted_driver_b_code'].' '.$bi['alloted_driver_b_name'];
              }
              ?></div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</section>

<script type="text/javascript">
  $('[data-hide-show-details]').each(function() {

    if($(this).hasClass('hide')){
      $(this).siblings('.dtlv-dtl').slideUp(1);
    }
  })
 // $(document.body).on('change', '[name="customer_id_search"]' ,function(){
  $(document.body).on('click','[data-hide-show-details]',function(){
    if($(this).hasClass('hide')){
      $(this).siblings('.dtlv-dtl').slideDown('fast')
      $(this).find('[data-up-down-button]').removeClass('angle_down')
      $(this).find('[data-up-down-button]').addClass('angle_up')
      $(this).removeClass('hide')  
    }else{
     $(this).siblings('.dtlv-dtl').slideUp('fast')
     $(this).find('[data-up-down-button]').removeClass('angle_up')
     $(this).find('[data-up-down-button]').addClass('angle_down')

     $(this).addClass('hide')
   }

 })
</script>


<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>
<br>



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

      <input type = 'hidden' name = 'express_load_eid' value = "<?php echo $bi['eid'] ?>">
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
        url:'<?php echo AJAXROOT; ?>'+'user/dispatch/notes/express-load-notes-list-ajax',
        type:'POST',
        data: {
          express_load_eid:'<?php echo $bi['eid']; ?>',
          reference_type_id:'EXPRESS LOAD'
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
        obj['reference_type_id']='EXPRESS LOAD';

        for ( var a = 0; a<arr.length; a++ ) {
          obj[arr[a].name] = arr[a].value
        }
        obj['high_priority']=($('[name="high_priority"]').prop("checked") == true)?'YES':'NO';
        $.ajax( {
          url:'<?php echo AJAXROOT; ?>'+'user/dispatch/notes/add-new-action',
          type:'POST',
          data: obj,
          success:function( data ) {
            console.log(data)
            if ( ( typeof data ) == 'string' ) {
              data = JSON.parse( data )
            }
            if ( data.status ) {
              $( '#addNewNoteForm' )[0].reset()
              show_d_notes()
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
<br><br><br><br>
<br><br><br><br>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>