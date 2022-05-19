<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 700px">
    <h1 class="list-200-heading">Bill Accessories</h1>


    <section class="list-200-top-action">
        <div class="list-200-top-action-left">

            <!-- input used for sory by call-->
            <input type="hidden" id="sort_by" value="">
            <input type='hidden' id='sort' value='asc'>
            <!-- //input used for sory by call-->
        

    </div>
    <div class="list-200-top-action-right">
        <div>
            <?php
            if(in_array('DIS009', USER_PRIV)){
                echo "<button class='btn_grey button_href'><a href='../user/dispatch/masters/bill-accessories/add-new'>Add New</a></button>";
            }
            ?>
        </div>
    </div>

</section>

<div class="table  table-a">
    <table data-ro-table>
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th data-table-sort-by="name" style="text-align:center;">Name</th>
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
   var sort_by_order_type = $('#sort').val();
    var sort_by = $('#sort_by').val();
   $.ajax({
      url:'../user/dispatch/masters/bill-accessories/list-ajax',
      type:'POST',
      data:{
        search:$('[data-filter="search"]').val(),
         sort_by_order_type:sort_by_order_type,
        sort_by: sort_by,
    },   
    beforeSend:function(){
      show_table_data_loading('[data-ro-table]')
  },
  success:function(data){
    if((typeof data)=='string'){
       data=JSON.parse(data)
       $('#tabledata').html("");
       if(data.status){
          var counter=0;    
          $.each(data.response.list, function(index, item) {
             var row=`<tr>
             <td>${++counter}</td>
             <td style="text-align:center">${item.name}</td>
             <td>`;
             <?php 
             if(in_array('DIS011', USER_PRIV)){
                ?>
                row+=`<button title="Edit" class="btn_grey_c"><a href="../user/dispatch/masters/bill-accessories/update?eid=`+item.eid+`"><i class="fa fa-pen"></i></a></button>`;
                <?php
            }
            if(in_array('DIS011', USER_PRIV)){
                ?>
                row+=`<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="`+item.eid+`"><i class="fa fa-trash"></i></button>`;
                <?php
            }
            ?>

            row+=`</td>`; 
            row+=`</tr>`;
            $('#tabledata').append(row);


        })
      }else{
         $('#tabledata').html("");
         var row=`<tr><td colspan="5">`+data.message+`</td></tr>`;
         $('#tabledata').append(row);
         $('[data-pagination]').html('');
     }
 }

}

})
}
show_list()

</script>



<script type="text/javascript">

    $(document).ready(function(){
       $(document).on("click", "[data-action='delete']",function(){
        if(confirm('Do you want to delete ?')){
            var eid=$(this).data("eid");
            $.ajax({
              url:'../user/dispatch/masters/bill-accessories/delete-action',
              type:'POST',
              data:{
                delete_eid:eid
            },
            context: this,
            success:function(data){
                alert(data)
             if((typeof data)=='string'){
                 data=JSON.parse(data) 
             }

             if(data.status){
                $(this).parent().parent().fadeOut();
                show_list()
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