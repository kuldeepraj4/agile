<?php
require_once APPROOT.'/views/includes/user/header.php';
//$page=isset($_GET['page'])?$_GET['page']:1;
$driver_eid=isset($_GET['eid'])?$_GET['eid']:"N/a";
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1300px">
  <h1 class="list-200-heading" id="heading">Driver Payments</h1>
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
      <!-- //input used for sory by call-->
      

      <div class="filter-item">
        <label>Payment ID</label>
        <input type="text" data-filter="id" onchange="set_params('id', this.value), goto_page(1)">
      </select>
    </div>            
    <div class="filter-item"></div>
  </div>
  <div class="list-200-top-action-right">
  </div>
  
</section>
<div class="table  table-a">
  <table data-ro-table>
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Payment ID</th>
        <th>Type</th>
        <th style="text-align: left;">Category</th>
        <th>Trip ID</th>
        <th>Parameter ID</th>
        <th style="text-align: right;">Payable</th>
        <th style="text-align: right;">Paid</th>
        <th style="text-align: right;">Balance</th>
        <th style="max-width:160px;word-wrap: break-word;">Remarks</th>
        <th>Action</th>
      </tr>                       
    </thead>
    <tbody id="tabledata"></tbody>
  </table>
  </div>
<div data-pagination></div>
</section>


<script type="text/javascript">
  
  function show_list(){
    var sort_by=$('#sort_by').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var id=$('[data-filter="id"]').val();
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        page: page_no,
        sort_by: sort_by,
        batch: batch,
        driver_eid:'<?php echo $driver_eid; ?>',
        id:id
      },
      // beforeSend: function() {
      //   show_table_data_loading('[data-ro-table]')
      // },
      success:function(data){
       if((typeof data)=='string'){
         data=JSON.parse(data)
         console.log(data)
         $('#tabledata').html("");
         if(data.status){


           $.each(data.response.list, function(index, item) {
          
              $('#heading').html(`Settlements of ${item.driver_code} ${item.driver_name}`);                   
              var row=`<tr>
              <td>${item.sr_no}</td>
              <td>${item.id}</td>
              <td>${item.type}</td>
              <td style="text-align:left">${item.category}</td>`;
              if(item.trip_id){
               row+=`<td class="text-link"  onclick="open_child_window({url:'../user/accounts/trips/details?eid=${item.trip_eid}'})">${item.trip_id}</td>`;
            }else{
              row+= `<td></td>`; 
            }
               row+=`<td>${item.parameter_name}</td>           
              <td style="text-align:right">${item.amount}</td>                          
              <td style="text-align:right">${item.amount_paid}</td>                          
              <td style="text-align:right">${item.balance}</td>                          
              <td style="text-align:left;max-width:160px;word-wrap: break-word;">${item.remarks}</td>`
              row+= `<td>`; 
              if(item.edit_earning_and_deduction){
                <?php if(in_array('P0142', USER_PRIV)){
                ?>
               row+= `<button title="View" class="btn_grey_c"><a href="../user/accounts/drivers-payments/update-earnings-and-deductions?eid=`+item.eid+`"><i class="fa fa-pen"></i></a></button>`


               <?php } if(in_array('P0143', USER_PRIV)){
                ?>
                row+=`<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="`+item.eid+`"><i class="fa fa-trash"></i></button>`;
                <?php
              } ?> 
            

}


            row+= `</td>`; 

            row+=`</tr>`;
            $('#tabledata').append(row);

            console.log(data.response.batch)
          
        })
        set_pagination({
              selector: '[data-pagination]',
              totalPages: data.response.totalPages,
              currentPage: data.response.currentPage,
              batch: data.response.batch
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
          
          if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         
         if(data.status){
          $(this).parent().parent().fadeOut();
          show_list();
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

<br><br><br><br><br>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>