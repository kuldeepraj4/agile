  <?php
  require_once APPROOT.'/views/includes/user/header.php';
  ?>
  <br><br>
  <section class="list-200 content-box" style="margin: auto;max-width: 1400px">
    <h1 class="list-200-heading">Compare Drivers</h1>
    <section class="list-200-top-section">
      <div>
      </div>
      <div>
      </div>
    </section>

    <div class="table  table-a">
      <table data-ro-table>
        <thead>
          <tr>
           
            <th>Sr. No.</th>
             <th>Last Changed By</th>
            <th>Status</th>
            <th>Code</th>
            <th>Company</th>
            <th>Group</th>
            <th>Driver Name</th>
            <th>D.O.B.</th>
            <th>Mobile No.</th>
            <th>Email ID</th>
            <th>Address</th>
            <!-- <th>Company</th> -->
            <th>D.O.J.</th>
            <th>Route Type</th>
            <th>CDL No.</th>
            <th>CDL State</th>
            <th>CDL Issue Date</th>
            <th>CDL Expiry Date</th>
            <th>SSN No.</th>
            <th>Residency Type</th>
            <th>Residency Expiry</th>
            <th>Medical Issue Date</th>
            <th>Medical Expiry Date</th>
            <th>GFR</th>
            <th>EPN Enroll</th>
            <th>Last Annual Review</th>
            <th>Next Annual Review</th>
            <th>Truck Assigned</th>
            <th>Insurance Added</th> 
            
          </tr>                       
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
    var driver_eid = check_url_params('eid');
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
        driver_eid:driver_eid,
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
           var row=`
           
           <tr class="rows" id="row${item.sr_no}" >

           <td style="background-color:#fff;">${item.sr_no}</td>
           <td >${item.updated_by_user_code} ${item.updated_by_user_name}<br>${item.updated_on_datetime}</td>
           <td>${item.status}</td>
           <td>${item.code}</td>
           <td>${item.company}</td>
           <td>${item.group}</td>
           <td data-filter-name>${item.name_prfix} ${item.name}</td>
           <td>${item.dob}</td>
           <td style="white-space:nowrap">${item.mobile_number_display}</td>
           <td>${item.email}</td>

           <td style="min-width:200px;">${item.address}</td>

           <td>${item.date_of_joining}</td>
           <td>${item.route_type}</td>
           <td>${item.cdl_number}</td>
           <td>${item.cdl_state}</td>
           <td>${item.cdl_issue_date}</td>
           <td>${item.cdl_expiry_date}</td>
           <td>${item.ssn_number}</td>
           <td data-filter-residency>${item.residency_type}</td>
           <td>${item.residency_expiry_date}</td>
           <td>${item.medical_issue_date}</td>
           <td>${item.medical_expiry_date}</td>
           <td>${item.gfr}</td>
           <td>${item.epn_enroll_status}</td>
           <td>${item.last_annual_review_date}</td>
           <td>${item.next_annual_review_date}</td>
           <td>${item.truck_code}</td>`;

           if(item.inusrance_added_status == "0" || item.inusrance_added_status == null){
             row+=`<td></td>`;
           }else{
            row+=`<td>${item.inusrance_added_status}</td>`;

          }

          row+=` </tr>`;
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