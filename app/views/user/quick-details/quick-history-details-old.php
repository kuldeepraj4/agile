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
         if(index===0){
              //table head in html
              $.each( item, function( key, value ) {
                $('#tablehead').append('<th  style="padding:20px;">'+key.replaceAll('_', ' ')+'</th>');
              });
            }
            console.log(data.reference);
            if(data.reference=='DRIVERS'){
             var row=`

             <tr class="rows" id="row${item.sr_no}" >

             <td style="background-color:#fff;">${item.sr_no}</td>
             <td>${item.last_update_by}</td>
             <td>${item.status}</td>
             <td>${item.driver_code}</td>
              <td data-filter-name>${item.driver_name}</td>
             
            
             <td>${item.dob}</td>
             <td style="white-space:nowrap">${item.mobile_number}</td>
             <td>${item.email_id}</td>
             <td style="min-width:200px;">${item.address}</td>
             <td>${item.company_name}</td>
             <td>${item.date_of_joining}</td>
             <td>${item.route_type}</td>
             <td>${item.CDL_number}</td>
             <td>${item.CDL_state}</td>
             <td>${item.CDL_issue_date}</td>
             <td>${item.CDL_expiry_date}</td>
             <td>${item.SSN_number}</td>
             <td data-filter-residency>${item.residency_type}</td>
             <td>${item.residency_expiry_date}</td>
             <td>${item.medical_issue_date}</td>
             <td>${item.medical_expiry_date}</td>
             <td>${item.GFR}</td>
             <td>${item.epn_enroll_status}</td>
             <td>${item.last_annual_review_date}</td>
             <td>${item.next_annual_review_date}</td>
             <td>${item.truck_code}</td>`;

             if(item.insurance_added_status == "0" || item.insurance_added_status == null){
               row+=`<td></td>`;
             }else{
              row+=`<td>${item.insurance_added_status}</td>`;

            }

            row+=`<td>${item.group_type}</td></tr>`;


          }else if(data.reference=='Trucks'){

           var row=`
           <tr class="rows" id="row${item.sr_no}">
           <td style="background-color:#fff;">`+item.sr_no+`</td>
           <td>`+item.last_update_by+`</td>
           <td>`+item.status+`</td>
           <td>`+item.code+`</td>
           <td>`+item.truck_group_type+`</td>
           <td>`+item.company_name+`</td>
           <td>`+item.make_year+`</td>
           <td>`+item.make_company+`</td>
           <td>`+item.model+`</td>
           <td>`+item.color+`</td>
           <td>`+item.vin_number+`</td>
           <td>`+item.licence_plate_number+`</td>
           <td>`+item.licence_tag_expiry_date+`</td>
           <td>`+item.licence_state+`</td>
           <td>`+item.insurance_status+`</td>
           <td>`+item.insurance_company_name+`</td>
           <td>`+item.insurance_start_date+`</td>
           <td>`+item.insurance_expiry_date+`</td>
           <td>`+item.liability_status+`</td>
           <td>`+item.cargo_status+`</td>
           <td>`+item.pd_value+`</td>
           <td>`+item.new_pd_value+`</td>
           <td>`+item.loss_pay_info+`</td>
           <td>`+item.fhvut_status+`</td>
           <td>`+item.fhvut_paid_date+`</td>
           <td>`+item.oregon_permit_status+`</td>
           <td>`+item.family_engine_number+`</td>
           <td>`+item.ifta_status+`</td>
           <td>`+item.pifta_status+`</td>
           <td>`+item.nm_status+`</td>
           <td>`+item.pre_pass+`</td>
           <td>`+item.pre_pass_remark+`</td>
           <td>`+item.hut+`</td>
           <td>`+item.hut_remark+`</td>
           <td>`+item.ownership_type+`</td>
           <td>`+item.leasing_company+`</td>
           <td>`+item.leasing_ref_no+`</td>
           <td>`+item.leasing_expiry+`</td>
           <td>`+item.insurance_status+`</td>
           <td>`+item.device+`</td>
           <td>`+item.device_dash_cam_no+`</td>
           <td>`+item.halo_number+`</td>
           <td>`+item.odometer_update_type+`</td>
           <td>`+item.engine_hours_update_type+`</td>`

           row+=`</tr>`;

         }else if(data.reference=='TRAILERS'){

           var row=`
           <tr class="rows" id="row${item.sr_no}">
           <td style="background-color:#fff;">`+item.sr_no+`</td>
           <td>`+item.last_update_by+`</td>
           <td>`+item.status+`</td>
           <td>`+item.code+`</td>
           <td>`+item.company_name+`</td>
           <td>`+item.make_year+`</td>
           <td>`+item.make_company+`</td>
           <td>`+item.model+`</td>
           <td>`+item.body_type+`</td>
           <td>`+item.reefer_type+`</td>
           <td>`+item.vin+`</td>
           <td>`+item.licence_plate_number+`</td>
            <td>`+item.licence_tag_expiry_date+`</td>
           <td>`+item.licence_state+`</td>
           <td>`+item.insurance_status+`</td>
           <td>`+item.insurance_company_name+`</td>
           <td>`+item.insurance_start_date+`</td>
           <td>`+item.insurance_expiry_date+`</td>
           <td>`+item.trailer_pd_value+`</td>
           <td>`+item.trailer_loss_pay_info+`</td>
           <td>`+item.trailer_new_pd_value+`</td>
           <td>`+item.device+`</td>
           <td>`+item.device_serial_no+`</td>
           <td>`+item.ownership_type+`</td>
           <td>`+item.leasing_company+`</td>
           <td>`+item.leasing_ref_no+`</td>
           <td>`+item.leasing_expiry+`</td>
           <td>`+item.engine_hours_update_type+`</td>`

           row+=`</tr>`;

         }else if(data.reference=='users'){

           var row=`
           <tr class="rows" id="row${item.sr_no}">
           <td style="background-color:#fff;">`+item.sr_no+`</td>
           <td>`+item.last_update_by+`</td>
           <td>`+item.status_name+`</td>
           <td>`+item.name+`</td>
           <td>`+item.mobile+`</td>
           <td>`+item.office_phone+`</td>
           <td>`+item.extension+`</td>
           <td>`+item.company_email+`</td>
           <td>`+item.personal_email+`</td>
           <td>`+item.email+`</td>
           <td>`+item.address+`</td>
           <td>`+item.company_name+`</td>
           <td>`+item.department_name+`</td>
           <td>`+item.designation_name+`</td>
            <td>`+item.team_name+`</td>
           <td>`+item.force_password_renewal+`</td>
           <td>`+item.force_password_renewal_period+`</td>
           <td>`+item.account_locked_out+`</td>
           <td>`+item.account_locked_out_period+`</td>`
          

           row+=`</tr>`;

         }
         

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