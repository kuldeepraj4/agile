<?php require_once APPROOT.'/views/includes/user/header-quick-view.php';
$data=$_GET;
$default_date=(isset($data['tentative-start-date']) && $data['tentative-start-date']!='')?date('m/d/Y',strtotime($data['tentative-start-date'])):'';
?>
<section class="rv content-box" style="margin: auto;max-width: 750px">
    <h1 class="rv-heading">Choose Cross Dock Load</h1>

<div class="rv-table">
    <table data-my-table>
        <thead>
            <tr>
                <th data-table-sort-by="id">ID</th>
                <th>PO Number</th>
                <th>Assignment Status</th>
                <th></th>
            </tr>                       
        </thead>
        <tbody id="tabledata"></tbody>
    </table>
    </div>
<div data-pagination></div>
</section>

<script type="text/javascript">
     
    function show_list(){
        show_processing_modal()
        $.ajax({
            url:'../user/dispatch/loads/available-cross-dock-loads-ajax',
            type:'POST',
            beforeSend:function() {
                show_table_data_loading("[data-my-table]")
            },
            complete:function() {
                hide_processing_modal()
            },
            success:function(data){
                if((typeof data)=='string'){
                 data=JSON.parse(data)
                 $('#tabledata').html("");
                 if(data.status){   
                     var counter=1;    
                     $.each(data.response.list, function(index, item) {
                        var row=`<tr id="row${item.id}">
                        <td style="white-space:nowrap">${item.id}</td>
                        <td>${item.po_number}</td>
                        <td>${item.stop_assignment_status}</td>`

                        row+=`
                          <td style="background:white !important"><button class="btn_green" data-action="choose-load" data-load-eid="${item.eid}">Choose</button></td>
                        </tr>`;
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
   $(document).on("click", "[data-action='choose-load']",function(){
      $.ajax({
        url:'../user/dispatch/loads/available-cross-dock-load-stops-ajax',
        type:'POST',
        data:{
          load_eid:$(this).data("load-eid")
        },
        context: this,
        success:function(data){
         if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         if(data.status){
         window.opener.append_cross_dock_stops(data.response.list)
         window.close()
        }else{
          alert(data.message)
        }
      }
    })
    
  });
 });

</script>
<br><br><br>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>