<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1400px">
  <h1 class="list-200-heading">Work Order List</h1>
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
        <label>Unit Type</label>
        <select data-filter="unit_type_id" onchange="show_list(this.value), show_unit_filter({unit_type_id:this.value})"></select>
      </select>
    </div> 

    <div class="filter-item">
      <label>Order ID</label>
      <input data-filter="order_id" onkeyup="show_list(this.value)"></select>
    </div>
    <div class="filter-item">
      <label>Unit ID</label>
      <select data-filter="unit_id" onchange="show_list(this.value)">
      </select>
    </div>
    <div class="filter-item">
      <label>Vendor Name</label>
      <select data-filter="vendor_id" onchange="show_list(this.value)">
      </select>
    </div>

    <div class="filter-item">
      <label>Vendor State</label>
      <select data-filter="state_id" onchange="show_list(this.value),show_cities({state_id:this.value})">
      </select>
    </div>  
    <div class="filter-item">
      <label>Vendor City</label>
      <select data-filter="city_id" onchange="show_list(this.value)">
      </select>
    </div> 

    <div class="filter-item">
      <label>Status</label>
      <select data-filter="status_id" onchange="show_list(this.value)">
      </select>
    </div>        
    <div class="filter-item">
    </div>
  </div>
  <div class="list-200-top-action-right">
    <div>
      <?php
      if(in_array('P0008', USER_PRIV)){
        echo "<button class='btn_grey button_href'><a href='../user/maintenance/work-order-entry/add-new'>Add New</a></button>";
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
        <th>Workorder ID</th>
        <th>Workorder Date</th>
        <th>Repairorder ID</th>
        <th>Unit Type</th>
        <th>Unit ID</th>
        <th>Vendor</th>
        <th>State</th>
        <th>City</th>
        <th>Amount</th>
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
    var unit_type_id=$('[data-filter="unit_type_id"]').val();
    var unit_id=$('[data-filter="unit_id"]').val();
    var order_id=$('[data-filter="order_id"]').val();
    var status_id=$('[data-filter="status_id"]').val();
    var type_id=$('[data-filter="type_id"]').val();
    var driver_id=$('[data-filter="driver_id"]').val();
    var stage_id=$('[data-filter="stage_id"]').val();
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        sort_by:sort_by,
        unit_type_id:unit_type_id,
        unit_id:unit_id,
        order_id:order_id,
        status_id:status_id,
        type_id:type_id,
        driver_id:driver_id,
        stage_id:stage_id,
      },
      success:function(data){
        console.log(data)
        if((typeof data)=='string'){
         data=JSON.parse(data)
         console.log(data)
         $('#tabledata').html("");
         if(data.status){
           var counter=0;    
           $.each(data.response.list, function(index, item) {
             counter++;
             var row=`<tr>
             <td>${counter}</td>
             <td>${item.id}</td>
             <td>${item.workorder_date}</td>
             <td>${item.repairorder_id}</td>
             <td>${item.unittype_name}</td>
             <td>${item.asset_name}</td>
             <td>${item.vendor_name}</td>
             <td>${item.state_name}</td>
             <td>${item.city_name}</td>
             <td>${item.workorder_amount}</td>
             <td style="white-space:nowrap">`;

             <?php if(in_array('P0010', USER_PRIV))
             {
              ?>
              row+=`<button title="Edit" class="btn_grey_c"><a href="../user/maintenance/work-order-entry/update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button>`;
              <?php
            }
            if(in_array('P0021', USER_PRIV))
            {
              ?>
              row+=`<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="${item.eid}"><i class="fa fa-trash"></i></button>`;
              <?php
            } ?>

            row+=`</td> 
            </tr>`;
            $('#tabledata').append(row);
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
  function show_status_filter(){
   get_repairorderstatus().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="status_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_status_filter()
</script>

<script type="text/javascript">
  function show_vendor_filter(){
   get_vendormaster().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="vendor_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_vendor_filter()
</script>

<script type="text/javascript">
  function show_states(){
   get_states().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="state_id"]').html(options);                 
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_states()
</script>

<script type="text/javascript">
  function show_cities(param){
   get_cities(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="city_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
</script>

<script type="text/javascript">
  function show_unittype_filter(){
   get_vehicles().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="unit_type_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_unittype_filter()
</script>

<script type="text/javascript">
  function show_unit_filter(param){
    if(param.unit_type_id==1){
      get_trucks().then(function(data){
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.code+`</option>`;               
      })
      $('[data-filter="unit_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
})
}else if(param.unit_type_id==2){
  get_trailers().then(function(data){
  //console.log(data)
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.code+`</option>`;               
      })
      $('[data-filter="unit_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
})
} 
}
</script>

<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>
