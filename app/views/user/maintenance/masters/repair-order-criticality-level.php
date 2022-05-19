<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 500px">
    <h1 class="list-200-heading">Repair Order Criticality Level</h1>


    <section class="list-200-top-action">
        <div class="list-200-top-action-left">

            <!-- input used for sory by call-->
            <input type="hidden" id="sort_by" value="">
            <!-- //input used for sory by call-->
            
            <div class="filter-item-full">
                <label>Search</label>
                <input type="text" placeholder="name" data-filter="search" onkeyup="set_params('page_no', 1);show_list()">
            </select>
        </div>            

    </div>
    <div class="list-200-top-action-right">
        <div>
            <?php
            if(in_array('P0088', USER_PRIV)){
                echo "<button class='btn_grey button_href'><a href='../user/maintenance/masters/repair-order-criticality-level/add-new'>Add New</a></button>";
            }
            ?>
        </div>
    </div>

</section>

<div class="table  table-a">
    <table>
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th data-table-sort-by="name">Name</th>
                <th></th>
            </tr>                       
        </thead>
        <tbody id="tabledata"></tbody>
    </table>
</div>
</section>

<script type="text/javascript">
    function show_list(){
      var sort_by=$('#sort_by').val();
      var value=$('[data-filter="search"]').val();
      let param={
          sort_by:sort_by
      }

      get_repair_order_criticality_level(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
        $('#tabledata').html("");
        var counter=0;
        $.each(data.response.list, function(index, item) {
            // if(item.name.toLowerCase().includes(value)){
                counter++;
                var row=``;
                row+=`<tr>`;
                row+=`<td>`+counter+`</td>`;
                row+=`<td>`+item.name+`</td>`;
                row+=`<td>`;
                <?php if(in_array('P0090', USER_PRIV)){
                    ?>
                    row+=`<button title="Edit" class="btn_grey_c"><a href="../user/maintenance/masters/repair-order-criticality-level/update?eid=`+item.eid+`"><i class="fa fa-pen"></i></a></button>`;
                    <?php
                } ?>
                <?php if(in_array('P0091', USER_PRIV)){
                    ?>
                    row+=`<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="`+item.eid+`"><i class="fa fa-trash"></i></button>`;
                    <?php
                } ?>

                row+=`</td>`; 

                row+=`</tr>`;
                $('#tabledata').append(row);

            // }
        })   
    }
}
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_list()
</script>

<script type="text/javascript">

    $(document).ready(function(){
     $(document).on("click", "[data-action='delete']",function(){
        if(confirm('Do you want to delete repair order criticality level ?')){
            var eid=$(this).data("eid");
            $.ajax({
              url:window.location.pathname+'/delete-action',
              type:'POST',
              data:{
                delete_eid:eid
            },
            context: this,
            success:function(data){
               if((typeof data)=='string'){
                   data=JSON.parse(data) 
               }

               if(data.status){
                $(this).parent().parent().fadeOut();
            }else{
                alert(data.message)
            }
        }
    })
        }
    });
 });

</script>

<script type="text/javascript">
  function sort_table(){
    show_list()
}
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>