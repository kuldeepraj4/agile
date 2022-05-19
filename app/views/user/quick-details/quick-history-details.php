  <?php
  require_once APPROOT.'/views/includes/user/header.php';
  ?>

  <br><br>
  <section class="list-200 content-box" style="margin: auto;max-width: 1400px">
    <h1 class="list-200-heading">Compare <?php echo $_GET['reference']; ?></h1>
    <section class="list-200-top-section">
      <div>
      </div>
      <div>
      </div>
    </section>

    <div class="table  table-a">
      <table data-ro-table>
        <thead >
          <tr id="tablehead" style="white-space:nowrap;"></tr>           
        </thead>
        <tbody id="tabledata"></tbody>
      </table>
    </div>
    Showing : 
    <select data-batch-selector="" onchange="set_batch(this.value) " data-default-select="${param.batch}"  style="margin-top:10px; ">
      <option value="10">10</option>
      <option value="25">25</option>
      <option value="50">50</option>
      <option value="100">100</option>
      <option value="500">500</option>
      <option value="1000">1000</option>
    </select>
  </section>

  <style>  
    td{
      white-space:nowrap;
    }
    .warningrow {
      background-color: #fdfd96;

    }

    .dangerrow {
      background-color: #ff6961; 

    }

    /*.success{
       background-color: #ff6861;
    }*/
  </style>
  <script>
    function set_td_idcount(){

     $('.rows').each(function(index, item) {
      var this_row = $(this);
      var vv = 1;
      var td = $(this).find('td');
      $.each(td, function(ind, itm){

        $(this).attr('id', 'td'+vv);
        vv++;
      })
    })
   }

   function rowsold() {
    var counter = 0;
    $('.rows').each(function(index, item) {
      var this_row = $(this);
      var td = $(this).find('td');
      var count = 1;
      $.each(td, function(ind, itm){
        if(index == 0){
          var newname = $(itm).html();
        }else{
          var newname = $('#row'+counter).find('#td'+count).html();
          count++
        }
        var a= $(this).html()
      //console.log(a +"      "+newname)
      if(a!=newname){
       $(this).addClass('warningrow')
     }
   })
      counter++;
    })
  }

  function rows() {
    var count = 1;
    var row1 = $('#row1').find('td');
    //console.log(row1)
    $.each(row1, function(ind, itm){
      var a = $(itm).html();
      var check_row2_exist = $('#row2').length;
      var row2_td = $('#row2').find('#td'+count).html();

      if(check_row2_exist){
        if(a!=row2_td){
          $(this).addClass('dangerrow')
          $('#row2').find('#td'+count).addClass('warningrow')
        }
      }
      count++;
    })

  }
</script>

<script type="text/javascript">
 function show_list(){
  var sort_by = $('#sort_by').val();
  var sort_by_order_type = $('#sort').val();
  var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
  var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
  var eid = check_url_params('eid');
  var reference = check_url_params('reference');
  var webapi = "pagination";
  $.ajax({
    url:location.pathname+'-action',
    type:'POST',
    data:{
      page:page_no,
      sort_by:sort_by,
      batch:batch,
      reference:reference,
      eid:eid,
      webapi:  webapi
    },
    beforeSend:function() {
      show_table_data_loading("[data-my-table]")
      show_processing_modal();
    },
    complete:function(){
      hide_processing_modal();
    },
    success:function(data){

     if((typeof data)=='string'){

       data=JSON.parse(data)
       $('#tabledata').html("");
       if(data.status){

        $.each(data.response.list, function(index, item) {  
       
              //table head in html
              var row=`<tr class="rows" id="row${item.sr_no}">`
               
              $.each( item, function( key, value ) {
                 if(index===0){
                $('#tablehead').append('<th  style="padding:20px;">'+key.replaceAll('_', ' ')+'</th>');
                 //console.log(index);
              }
              if(key==='sr_no'){
                row+=`<td style="background-color:#fff;">`+value+`</td>`;

               }else{

                row+=`<td>`+value+`</td>`;
              }
              
              });

             row+=`</tr>`;
           
           
         

         $('#tabledata').append(row);
       })

  set_pagination({
    selector: '[data-pagination]',
    totalPages: data.response.totalPages,
    currentPage: data.response.currentPage,
    batch: data.response.batch
  })


}else{
  $('#tabledata').html("");
  var row=`<tr><td colspan="30">`+data.message+`</td></tr>`;
  $('#tabledata').append(row);

}
}
set_td_idcount()
rows()
rowsold()

}
})

}
show_list()



</script>

<br><br><br><br>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>