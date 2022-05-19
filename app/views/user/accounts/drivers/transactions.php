<?php

require_once APPROOT.'/views/includes/user/header.php'; 

  // $page=isset($_GET['page'])?$_GET['page']:1;

  $group_transaction_id=isset($_GET['group-transaction-id'])?$_GET['group-transaction-id']:'';

?>



<br><br>

<section class="list-200 content-box" style="margin: auto;max-width: 900px">

    <h1 class="list-200-heading" id="heading">Transactions</h1>

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

           <div class="filter-item">

        <label>Driver</label>
        <input type="text" list="quick_list_drivers" data-filter="driver_id" data-driver-id>


      </div>

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

                    <th>Driver</th>

                    <th style="text-align: right;" data-table-sort-by="amount">Amount</th>

                    <th>Gr. Transaction ID</th>

                    <th>Created By</th>

                    <th>Created Datetime</th>

                    <th></th>

                </tr>                       

            </thead>

            <tbody id="tabledata"></tbody>

        </table>
        
      <!-- <div class="table-pagination" data-list-pagination style="margin:5px"></div> -->

    </div>
<div data-pagination></div>
</section>
<script type="text/javascript">
  var url_params = get_params();
  // if (url_params.hasOwnProperty('followup_date')) {
  //   $("[data-filter='followup_date']").val(url_params.followup_date);
  // }
</script>


<script type="text/javascript">

  function show_list(){


    var sort_by=$('#sort_by').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var id=$('[data-filter="code"]').val();
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
     var driver_id = check_url_params('driver_id');
     var sort_by_order_type = $('#sort').val();

    $.ajax({

      url:location.pathname+'-ajax',

      type:'POST',

      data:{
        sort_by_order_type:sort_by_order_type,
        page: page_no,
        sort_by: sort_by,
        batch: batch,
         driver_id: driver_id,
         
        group_transaction_id:'<?php echo $group_transaction_id; ?>',

        id:$('[data-filter="id"]').val(),

        added_date_from:$('[data-filter="start_date_from"]').val(),

        added_date_to:$('[data-filter="start_date_to"]').val()

      },

      beforeSend:function(){
      //show_processing_modal()
        $('#tabledata').html(`<tr><td colspan="18">Loading . . . <td></tr>`);

      },
      // complete:function(){
      //   hide_processing_modal()
      // },

      success:function(data){

        if((typeof data)=='string'){

         data=JSON.parse(data)

         $('#tabledata').html("");

         if(data.status){

           $.each(data.response.list, function(index, item) {

             var row=`<tr>

             <td>${item.sr_no}</td>

             <td>${item.id}</td>

             <td style="text-align:left">${item.driver_code} ${item.driver_name}</td>

             <td style="text-align:right">${item.amount}</td>

             <td>${item.transaction_group_id}</td>

             <td>${item.added_by_user_name}<br>${item.added_by_user_code}</td> 

             <td>${item.added_on_datetime}</td>

             <td><button title="View" class="btn_grey_c"><a href="../user/accounts/drivers-payments/transactions-details?eid=`+item.eid+`"><i class="fa fa-eye"></i></a></button></td> 

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
          var row=`<tr><td colspan="20">`+data.message+`</td></tr>`;
          $('#tabledata').append(row);
          $('[data-pagination]').html('');

        }

      }



    }



  })

  }

  show_list()



</script>

<datalist id="quick_list_drivers"></datalist>

<script type="text/javascript">
  $(document.body).on('input', '[data-driver-id]', function() {
    //alert("hhhh")
    id_selected = $(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if (id_selected != undefined) {
      $(this).data('driver-id', id_selected)
      set_params('driver_id', id_selected)
      set_params('driver_name', $(`[data-driver-id]`).val())
      goto_page(1)
    }
  });
</script>
<script type="text/javascript">
  $(document.body).on('change', '[data-driver-id]', function() {
    id_selected = $(`[data-driver-filter-rows="${$(this).val()}"]`).data('value');
    if (id_selected == undefined) {
      alert("Please enter correct DriverID")
      $(`[data-driver-id]`).val('')
    }
  });
</script>


<script type="text/javascript">
  function show_quick_list_drivers() {

    quick_list_drivers().then(function(data) {

      // Run this when your request was successful

      if (data.status) {



        //Run this if response has list

        if (data.response.list) {

          var options = "";

          options += `<option data-driver-filter-rows="" data-value="" value="">- - Select - -</option>`

          $.each(data.response.list, function(index, item) {

            options += `<option data-driver-filter-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" value="` + item.code + ' ' + item.name + `"></option>`;

          })

          $('#quick_list_drivers').html(options);
              if (url_params.hasOwnProperty('driver_name')) {
            $(`[data-driver-id]`).val(check_url_params('driver_name'))
            // $("[data-filter='vehicle_id'] option[value=" + url_params.vehicle_id + "]").prop('selected', true);
          }



        }

      }

    }).catch(function(err) {

      // Run this when promise was rejected via reject()

    })

  }

  show_quick_list_drivers()

 function onchage_driver_filter(value) {

    var this_driver_id = $(`[data-driver-filter-rows="${value}"]`).data('value');

    if (this_driver_id != undefined) {

      driver_id = this_driver_id

      show_list();

    }

  }
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