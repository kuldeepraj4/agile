<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1000px">
    <h1 class="list-200-heading">Driver Document Types</h1>
    <section class="list-200-top-section">
        <div>
            
        </div>
        <div>
            
        </div>
    </section>



    <section class="list-200-top-action">
        <div class="list-200-top-action-left">

            <!-- input used for sory by call-->
            <input type="hidden" id="sort_by" value="">
             <input type='hidden' id='sort' value='asc'>
            <!-- //input used for sory by call-->
            

            <div class="filter-item">
                <label>Name</label>
            <input type="text" data-filter="name" onkeyup="set_params('page_no', 1);show_list()">
            </div>
            <div class="filter-item"></div>            
        </div>
        <div class="list-200-top-action-right">
            <div>
            <?php
            if(in_array('P0151', USER_PRIV)){
                echo "<button class='btn_grey button_href'><a href='../user/masters/drivers/document-types/add-new'>Add New</a></button>";
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
                    <th style="text-align:left" data-table-sort-by="name">Name</th>
                    <th>Issue Required</th>
                    <th>Expiry Required</th>
                    <th>Expiry option</th>
                    <th>Expiry alert days</th>
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
     var sort_by = $('#sort_by').val();
 var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
 var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
 
 var name= $('[data-filter="name"]').val().toUpperCase();
 var sort_by_order_type = $('#sort').val();
 var webapi = "pagination";
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{

    sort_by_order_type:sort_by_order_type,
    sort_by: sort_by,
    page: page_no,
    batch: batch,
    webapi:  webapi,
    value:name,
      },
      success:function(data){
       if((typeof data)=='string'){
         data=JSON.parse(data)
         //console.log(data.response.list[0])
         $('#tabledata').html("");
         if(data.status){
           var counter=0;    
           $.each(data.response.list, function(index, item) {
            // if(item.name.toUpperCase().includes(name)){       
             

             let required_option_class='cross-red'
            if(item.is_required){
              required_option_class='check-green'
            }
            let expiry_option_class='cross-red'
            if(item.expiry_option){
              expiry_option_class='check-green'
            }
            let expiry_issue_option='cross-red'
            if(item.issue_option){
              expiry_issue_option='check-green'
            }
             var row=`<tr>
             <td>${item.sr_no}</td>
             <td style="text-align:left">${item.name}</td>
             <td><span class='${expiry_issue_option}'><span></td>
             <td><span class='${required_option_class}'><span></td>
             <td><span class='${expiry_option_class}'><span></td>
             <td>${item.expiry_alert_days}</td>
             <td style="white-space:nowrap">`;

             <?php if(in_array('P0153', USER_PRIV)){
              ?>
             row+=`<button title="Edit" class="btn_grey_c"><a href="../user/masters/drivers/document-types/update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button>`;
              <?php
            }
            if(in_array('P0154', USER_PRIV)){
              ?>
              row+=`<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="${item.eid}"><i class="fa fa-trash"></i></button>`;
              <?php
            }
            
            ?>

            row+=`</td> 
            </tr>`;
            $('#tabledata').append(row);
          // } 
          set_pagination({
    selector: '[data-pagination]',
    totalPages: data.response.totalPages,
    currentPage: data.response.currentPage,
    batch: data.response.batch
  })
})   
    
  } else {
    
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
      url:window.location.pathname+'/delete-action',
      type:'POST',
       data:{
        delete_eid:eid
       },
       context: this,
        success:function(data){
            // alert(data)
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