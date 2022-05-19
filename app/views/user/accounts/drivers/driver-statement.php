<?php
require_once APPROOT.'/views/includes/user/header.php';
  $page=isset($_GET['page'])?$_GET['page']:1;
  $driver_eid=isset($_GET['eid'])?$_GET['eid']:"N/a";
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1000px">
    <h1 class="list-200-heading" id="heading">Driver Statement</h1>
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
                <label>Transection ID</label>
            <input type="text" data-filter="id" onkeyup="show_list()">
            </select>
            </div>            
            <div class="filter-item"></div>
        </div>
        <div class="list-200-top-action-right">
        </div>
                
    </section>
    <div class="table  table-a">
        <table>
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Date</th>
                    <th>Transaction ID</th>
                    <th>Type</th>
                    <th style="text-align: left;">Description</th>
                    <th style="text-align: right;">Cr</th>
                    <th style="text-align: right;">Dr</th>
                    <th style="text-align: right;">Balance</th>
                </tr>                       
            </thead>
            <tbody id="tabledata"></tbody>
        </table>
      <div class="table-pagination" data-list-pagination style="margin:5px"></div>
    </div>
</section>


<script type="text/javascript">
  function show_list(){
    var sort_by=$('#sort_by').val();
    var id=$('[data-filter="id"]').val();
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        driver_eid:'<?php echo $driver_eid; ?>',
        page:'<?php echo $page; ?>',
        sort_by:sort_by
      },
      success:function(data){

       if((typeof data)=='string'){
         data=JSON.parse(data)
         $('#tabledata').html("");
         if(data.status){

$('#heading').html(`Statement of ${data.response.driver_details.driver_code} ${data.response.driver_details.driver_name}`);

           $.each(data.response.list, function(index, item) {
            if(item.id.toLowerCase().includes(id)){       
             var row=`<tr>
             <td>${item.sr_no}</td>
             <td>${item.date}</td>
             <td>${item.id}</td>
             <td>${item.type}</td>
             <td style="text-align:left">${item.description}</td>             
             <td style="text-align:right">${item.amount_cr}</td>             
             <td style="text-align:right">${item.amount_dr}</td>
             <td style="text-align:right">${item.balance}</td>
             </tr>`;
            $('#tabledata').append(row);
          } 
        })

           ///--pagination
           let pagination=``;
           console.log(data)
           if(data.response.currentPage >1){
            pagination+=`<button class="btn_green" onclick="change_url_and_execute('page',${data.response.currentPage-1})">Previous<i class="fa fa-angle-double-left`
            
           }
           if(data.response.currentPage<data.response.totalPages){
              pagination+=`<button class="btn_green" onclick="change_url_and_execute('page',${data.response.currentPage+1})">NEXT<i class="fa fa-angle-double-right`          
           }

           $('[data-list-pagination]').html(pagination)
           ///--/pagination

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
  function sort_table(){
    show_list()
  }
</script>

<br><br><br><br><br>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>