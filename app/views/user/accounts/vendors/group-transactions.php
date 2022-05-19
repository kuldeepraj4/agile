<?php

require_once APPROOT.'/views/includes/user/header.php';

  // $page=isset($_GET['page'])?$_GET['page']:1;

?>

<br><br>

<section class="list-200 content-box" style="margin: auto;max-width: 900px">

    <h1 class="list-200-heading" id="heading">Vendor - Group Transactions</h1>

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
             <input type='hidden' id='sort' value='asc'>

             <div class="filter-item">

                <label>ID</label>

            <input type="text" data-filter="id" onchange="goto_page(1)">

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

                    <th data-table-sort-by="id">ID</th>

                    <th style="text-align: right;" data-table-sort-by="amount">Amount</th>

                    <th>Created By</th>

                    <th>Created Datetime</th>

                    <th></th>

                </tr>                       

            </thead>

            <tbody id="tabledata"></tbody>

        </table>
        <div data-pagination></div>
      <!-- <div class="table-pagination" data-list-pagination style="margin:5px"></div> -->

    </div>

</section>



<script type="text/javascript">

  function show_list(){
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var sort_by_order_type = $('#sort').val();
 var sort_by = $('#sort_by').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var id=$('[data-filter="code"]').val();

    $.ajax({

      url:location.pathname+'-ajax',

      type:'POST',

      data:{
        sort_by_order_type:sort_by_order_type,
        page: page_no,
        sort_by: sort_by,
        batch: batch,

        id:$('[data-filter="id"]').val(),

        added_date_from:$('[data-filter="start_date_from"]').val(),

        added_date_to:$('[data-filter="start_date_to"]').val()

      },

      beforeSend:function(){
      
        $('#tabledata').html(`<tr><td colspan="18">Loading . . . <td></tr>`);

      },
      
      success:function(data){

        if((typeof data)=='string'){

         data=JSON.parse(data)

         console.log(data)

         $('#tabledata').html("");

         if(data.status){

           $.each(data.response.list, function(index, item) {

             var row=`<tr>

             <td>${item.sr_no}</td>

             <td>${item.id}</td>

             <td style="text-align:right">${item.amount}</td>

             <td>${item.added_by_user_name}<br>${item.added_by_user_code}</td> 

             <td>${item.added_on_datetime}</td>

             <td><button title="View" class="btn_grey_c"><a href="../user/accounts/vendors-payments/transactions?group-transaction-id=`+item.id+`"><i class="fa fa-eye"></i></a></button></td> 

            </tr>`;

            $('#tabledata').append(row);



          })
          set_pagination({
              selector: '[data-pagination]',
              totalPages: data.response.totalPages,
              currentPage: data.response.currentPage,
              batch: data.response.batch
            })


           ///--pagination

          // $('[data-list-pagination]').data('list-pagination-total-pages',data.response.totalPages); //set total page value to pagination

          // $('[data-list-pagination]').data('list-pagination-active-pages',data.response.currentPage);

          // do_pagination()

           ///--/pagination

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

  function sort_table(){

    show_list()

  }

</script>



<br><br><br><br><br>

<?php

require_once APPROOT.'/views/includes/user/footer.php';

?>